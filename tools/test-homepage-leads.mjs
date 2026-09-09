import assert from 'node:assert/strict';
import fs from 'node:fs';
import vm from 'node:vm';
const source = fs.readFileSync(new URL('../js/homepage-leads.js', import.meta.url), 'utf8');
const storage = () => { const map = new Map(); return {getItem:k=>map.get(k)||null,setItem:(k,v)=>map.set(k,v),removeItem:k=>map.delete(k)}; };
const ref = 'HB-HOME-20260909-123456789';
const receipt = {status:'sent',conversion_ref:ref,services:['ai-search','seo'],intent:'audit'};
function run({url='https://hashbox.co.th/',receipt={},local=storage(),session=storage(),hasForm=true,fetcher,denyStorage=false}={}) {
  let calls=0, submits=0, listener, status;
  const inputs = {}, button={disabled:false};
  const form={querySelector:s=>s==='[type="submit"]'?button:inputs[s.match(/name="(.+)"/)[1]]||null,
    appendChild:e=>{if(e.type==='hidden') inputs[e.name]=e; else status=e;},
    addEventListener:(n,fn)=>{if(n==='submit') listener=fn;},
    requestSubmit:()=>{ const e={defaultPrevented:false,preventDefault(){this.defaultPrevented=true;}};listener(e);if(!e.defaultPrevented)submits++; }
  };
  const location=new URL(url);
  const denied={getItem(){throw Error('denied');},setItem(){throw Error('denied');}};
  const window={location,sessionStorage:denyStorage?denied:session,localStorage:denyStorage?denied:local,
    hashboxHomeLeads:{ajaxUrl:'https://hashbox.co.th/wp-admin/admin-ajax.php',receipt},
    history:{state:null,replaceState:(state,t,path)=>{window.location=new URL(path,location);}},
    addEventListener(){},setTimeout:()=>1,clearTimeout(){}};
  const context={window,URL,URLSearchParams,AbortController,document:{getElementById:()=>hasForm?form:null,createElement:()=>({setAttribute(){}})},
    fetch:async (...args)=>{calls++;return fetcher?fetcher(...args):{ok:true,json:async()=>({success:true,data:{lead_ref:'11111111-1111-4111-8111-111111111111',nonce:'fresh'}})};}};
  vm.runInNewContext(source, context);
  return {window,inputs,button,submit:(prevented=false)=>{const e={defaultPrevented:prevented,preventDefault(){this.defaultPrevented=true;}};listener(e);return e;},counts:()=>({calls,submits}),getStatus:()=>status?.textContent};
}
for(const bad of [{},{status:'failed',conversion_ref:ref},{status:'sent',conversion_ref:'HB-WEB-20260909-123456789'}]) {
  assert.equal(run({url:'https://hashbox.co.th/?contact=sent',receipt:bad}).window.dataLayer,undefined);
}
const local=storage();
const a=run({url:'https://hashbox.co.th/?contact=sent&lead_sig=fake&lead_ref=private#contact',receipt,local});
assert.equal(a.window.dataLayer.length,1);assert.equal(a.window.dataLayer[0].hb_services,'ai-search,seo');
assert.equal(a.window.location.search,'');
assert.ok(!JSON.stringify(a.window.dataLayer).includes('lead_ref'));assert.ok(!('hb_value' in a.window.dataLayer[0]));
assert.equal(run({receipt,local}).window.dataLayer,undefined);
assert.equal(run({receipt,denyStorage:true}).window.dataLayer.length,1);
const session=storage();
run({url:'https://hashbox.co.th/services/ai-search/?utm_source=google&utm_campaign=geo&gclid=click-a',session,hasForm:false});
const attributed=run({url:'https://hashbox.co.th/?service=ai-search',session});
assert.equal(attributed.inputs.gclid.value,'click-a');assert.equal(attributed.inputs.service_path.value,'/services/ai-search/');
const next=run({url:'https://hashbox.co.th/?utm_source=linkedin&utm_campaign=new',session});
assert.equal(next.inputs.gclid.value,'');assert.equal(next.inputs.utm_source.value,'linkedin');
assert.equal(next.inputs.entry_path.value,'/services/ai-search/');
const flush=()=>new Promise(resolve=>setImmediate(resolve));
const s=run();s.submit(true);assert.equal(s.counts().calls,0);
s.submit();s.submit();assert.equal(s.counts().calls,1);await flush();
assert.equal(s.counts().submits,1);assert.equal(s.inputs.home_tracking_version.value,'1');s.submit();assert.equal(s.counts().submits,1);
assert.equal(s.window.dataLayer,undefined,'submit attempt is not a lead');
const fail=run({fetcher:async()=>{throw Error('offline');}});fail.submit();await flush();assert.equal(fail.counts().submits,0);assert.equal(fail.button.disabled,false);assert.match(fail.getStatus(),/กรุณาลองอีกครั้ง/);
console.log('Homepage lead JS tests passed: signed receipt, dedup, attribution, validation, concurrent submit and failure.');
