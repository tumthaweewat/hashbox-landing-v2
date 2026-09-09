import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import vm from 'node:vm';

const source = await readFile(new URL('../js/v2.js', import.meta.url), 'utf8');
// Exercise the actual homepage form controller without loading unrelated nav UI.
const controller = source.slice(source.indexOf("  const contact ="), source.indexOf('  /* ----------------------------------------------------------------------'));
function field(value = '', id = '') {
  return { value, id, checked: false, disabled: false, required: false, validity: { valid: true },
    listeners: {}, addEventListener(name, fn) { this.listeners[name] = fn; },
    setCustomValidity(message) { this.validity.valid = !message; }, setAttribute() {} };
}
function run(search) {
  const elements = { request_intent: field('audit'), website: field(), no_website: field(),
    phone: field('', 'contact-phone'), line_id: field('', 'contact-line'), contact_preference: field('email') };
  const services = [field('ai-search'), field('seo'), field('ai-consulting')];
  const submit = {};
  const detailInput = field();
  const details = { hidden: false, open: false, querySelectorAll: () => [detailInput] };
  const nodes = { 'contact-project-details': details };
  const getNode = id => nodes[id] ||= {};
  const contact = { elements, addEventListener() {},
    querySelector: selector => selector === '[type="submit"]' ? submit : getNode(selector),
    querySelectorAll: selector => selector === '[name="services[]"]' ? services : [] };
  const listeners = {};
  vm.runInNewContext(controller, {
    document: { getElementById: id => id === 'homepage-contact' ? contact : getNode(id) },
    window: { location: { search }, addEventListener: (name, fn) => { listeners[name] = fn; } },
    URL, URLSearchParams
  });
  return { services, elements, submit, listeners, nodes };
}
const ai = run('?utm_source=google&service=ai-search');
assert.equal(ai.services[0].checked, true);
assert.equal(ai.services[0].disabled, false, 'Audit must submit the selected service');
assert.equal(ai.elements.website.required, true);
assert.match(ai.submit.textContent, /SEO \+ AI Search/);
ai.services[0].checked = false;
ai.services[1].checked = true;
ai.services[0].listeners.change();
ai.listeners.pageshow();
assert.equal(ai.services[0].checked, false, 'pageshow must preserve the visitor choice');
assert.equal(ai.submit.textContent, 'ขอ Audit ฟรี →');
ai.elements.request_intent.value = 'project';
ai.services[1].listeners.change();
assert.equal(ai.elements.phone.required, true, 'Project contact validation remains intact');
assert.equal(ai.services[1].disabled, false);
for (const search of ['', '?service=unknown', '?service=%3Cscript%3E']) {
  assert.ok(run(search).services.every(service => !service.checked));
}
const home = await readFile(new URL('../front-page.php', import.meta.url), 'utf8');
assert.match(home, /<fieldset class="contact-services">/);
const php = await readFile(new URL('../functions.php', import.meta.url), 'utf8');
assert.match(php, /: \( \$is_website_audit_form \? '' : \$service \);/,
  'Non-Website enquiries must retain their service in the CRM payload');
for (const path of ['page-ai-search.php', 'page-geo-checker.php']) {
  const template = await readFile(new URL('../' + path, import.meta.url), 'utf8');
  assert.ok(!template.includes("home_url( '/#contact' )"), `${path} must retain AI Search context`);
  assert.ok(template.includes('/?service=ai-search#contact'));
}
console.log('AI Search routing tests passed: prefill, editable service, audit/project validation, unknown values and CRM fallback.');
