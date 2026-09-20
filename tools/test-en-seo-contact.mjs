import assert from 'node:assert/strict';
import vm from 'node:vm';
import { readFile } from 'node:fs/promises';

const source = await readFile(new URL('../js/en-seo-contact.js', import.meta.url), 'utf8');

const ATTRIBUTION_KEY = 'hashbox_en_seo_attribution';
const DRAFT_KEY = 'hashbox_en_seo_contact_draft';
const TTL = 30 * 60 * 1000;
const NOW = Date.UTC(2026, 8, 20, 8);
const flush = () => new Promise(resolve => setImmediate(resolve));

function environment({
  state = '', receipt = '', initialStorage = {}, failNonce = false,
  deferNonce = false, nonceResponse, now = NOW,
  search = '?utm_source=example&utm_campaign=seo', useGtag = true,
  initialFields = {}
} = {}) {
  const values = new Map(Object.entries(initialStorage));
  const events = [];
  const listeners = {};
  const buttonListeners = {};
  const windowListeners = {};
  const nativePosts = [];
  const nonceRequests = [];
  let releaseNonce;
  const nonceGate = deferNonce ? new Promise(resolve => { releaseNonce = resolve; }) : Promise.resolve();
  let submitted = 0;
  let submitEvents = 0;
  let requests = 0;
  const controls = {};
  const errors = {};
  for (const name of ['name', 'email', 'website', 'message', 'pdpa', 'hashbox_nonce']) {
    controls[name] = {
      id: 'en-seo-' + name,
      name,
      tagName: 'INPUT',
      type: name === 'pdpa' ? 'checkbox' : name === 'email' ? 'email' : 'text',
      value: '',
      checked: false,
      validity: { valid: true },
      setAttribute(key, value) { this[key] = value; },
      focus() { this.focused = true; }
    };
    errors['en-seo-' + name + '-error'] = { textContent: '' };
  }
  Object.assign(controls.name, { value: 'Test Visitor' });
  Object.assign(controls.email, { value: 'visitor@example.com' });
  Object.assign(controls.website, { value: 'example.com' });
  controls.pdpa.checked = true;
  for (const [name, value] of Object.entries(initialFields)) {
    if (name === 'pdpa') controls[name].checked = value;
    else controls[name].value = value;
  }
  const status = { textContent: '', hidden: true, focus() {} };
  const label = { textContent: 'Get a free SEO audit' };
  const submit = { disabled: false, querySelector() { return label; }, addEventListener(name, callback) { buttonListeners[name] = callback; } };
  const form = {
    dataset: { status: state, confirmedReceipt: receipt, nonceUrl: 'https://hashbox.example/wp-admin/admin-ajax.php' },
    elements: controls,
    querySelector(selector) {
      if (selector === '[data-en-seo-submit]') return submit;
      const match = selector.match(/^input\[name="(.+)"\]$/);
      return match ? controls[match[1]] || null : null;
    },
    appendChild(field) { controls[field.name] = field; },
    setAttribute(key, value) { this[key] = value; },
    addEventListener(name, callback) { listeners[name] = callback; },
    requestSubmit() {
      submitEvents++;
      let prevented = false;
      listeners.submit({ preventDefault() { prevented = true; } });
      if (!prevented) {
        submitted++;
        nativePosts.push(Object.fromEntries(Object.entries(controls).map(([name, field]) => [name, field.type === 'checkbox' ? field.checked : field.value])));
      }
    }
  };
  const document = {
    querySelector() { return form; },
    getElementById(id) { return id === 'en-seo-contact-status' ? status : errors[id]; },
    createElement() { return {}; }
  };
  const window = {
    location: { search },
    sessionStorage: {
      getItem(key) { return values.get(key) ?? null; },
      setItem(key, value) { values.set(key, String(value)); },
      removeItem(key) { values.delete(key); }
    },
    ...(useGtag ? { gtag(...args) { events.push(args); } } : {}),
    addEventListener(name, callback) { windowListeners[name] = callback; },
    setTimeout,
    clearTimeout
  };
  vm.runInNewContext(source, {
    document, window, URL, URLSearchParams, AbortController,
    Date: class extends Date { static now() { return now; } },
    fetch: async (url, options) => {
      requests++;
      nonceRequests.push({ url, options });
      await nonceGate;
      if (failNonce) throw new Error('offline');
      return nonceResponse || { ok: true, json: async () => ({ success: true, data: { nonce: 'fresh-nonce' } }) };
    }
  });
  return { controls, form, status, submit, label, values, events, listeners, windowListeners, window, nativePosts, nonceRequests,
    requests: () => requests, submitted: () => submitted, submitEvents: () => submitEvents,
    analytics: () => useGtag ? events : (window.dataLayer || []).map(args => Array.from(args)),
    click() { buttonListeners.click(); },
    async send() { buttonListeners.click(); await flush(); },
    async finishNonce() { releaseNonce(); await flush(); },
    async enter(field) { listeners.keydown({ key: 'Enter', target: field, preventDefault() {} }); await flush(); }
  };
}

const valid = environment();
await valid.send();
assert.equal(valid.controls.website.value, 'https://example.com/');
assert.equal(valid.controls.hashbox_nonce.value, 'fresh-nonce');
assert.equal(valid.controls.utm_source.value, 'example');
assert.equal(valid.submitted(), 1);
assert.equal(valid.submitEvents(), 1, 'Integrations see exactly one submit event per click.');
assert.equal(valid.events.length, 0, 'An attempt is never reported as a lead.');
assert.equal(valid.nativePosts[0].hashbox_nonce, 'fresh-nonce');
assert.equal(valid.nonceRequests[0].options.method, 'POST');
assert.equal(valid.nonceRequests[0].options.body.get('action'), 'hashbox_en_seo_contact_nonce');

// The deferred response keeps the real asynchronous preparation window open.
// Native form POSTs are simulated; this suite never sends a production lead.
const rapid = environment({ deferNonce: true });
rapid.click();
rapid.click();
rapid.click();
await rapid.enter(rapid.controls.website);
assert.equal(rapid.requests(), 1, 'Repeated clicks/Enter share one pending nonce request.');
assert.equal(rapid.submitted(), 0, 'No native POST happens before the nonce arrives.');
assert.equal(rapid.submitEvents(), 0, 'Collected-form integrations do not see preparation attempts.');
assert.equal(rapid.submit.disabled, true);
assert.equal(rapid.form['aria-busy'], 'true');
await rapid.finishNonce();
assert.equal(rapid.nativePosts.length, 1, 'Rapid submission creates exactly one native POST.');
assert.equal(rapid.submitEvents(), 1);
assert.equal(rapid.events.length, 0);

const invalid = environment();
invalid.controls.website.value = 'facebook.com/business';
await invalid.send();
assert.equal(invalid.requests(), 0, 'Invalid URLs cannot reach the backend.');
assert.equal(invalid.controls.website['aria-invalid'], 'true');

for (const name of ['name', 'email', 'pdpa']) {
  const invalidField = environment();
  if (name === 'pdpa') invalidField.controls.pdpa.checked = false;
  else if (name === 'email') {
    invalidField.controls.email.value = 'not-an-email';
    // In a browser this comes from native input[type=email] validity.
    invalidField.controls.email.validity.valid = false;
  } else invalidField.controls.name.value = '   ';
  await invalidField.send();
  assert.equal(invalidField.requests(), 0, `${name}: invalid data must not request a nonce.`);
  assert.equal(invalidField.submitEvents(), 0, `${name}: no native submission attempt.`);
  assert.equal(invalidField.nativePosts.length, 0);
  assert.equal(invalidField.controls[name]['aria-invalid'], 'true');
  assert.equal(invalidField.controls[name].focused, true);
  assert.equal(invalidField.events.length, 0);
}

const offline = environment({ failNonce: true });
await offline.send();
assert.equal(offline.submitted(), 0);
assert.equal(offline.submit.disabled, false);
assert.match(offline.status.textContent, /could not connect/i);
assert.equal(offline.form.dataset.status, 'error');
assert.equal(offline.submitEvents(), 0, 'Failed preparation does not emit a submission.');
assert.equal(offline.events.length, 0);
assert.equal(offline.label.textContent, 'Get a free SEO audit', 'Recovery restores the approved CTA.');

for (const nonceResponse of [
  { ok: false, json: async () => ({}) },
  { ok: true, json: async () => ({ success: false }) },
  { ok: true, json: async () => ({ success: true, data: {} }) },
  { ok: true, json: async () => { throw new Error('invalid JSON'); } }
]) {
  const failed = environment({ nonceResponse });
  await failed.send();
  assert.equal(failed.nativePosts.length, 0, 'A failed nonce response cannot submit.');
  assert.equal(failed.submitEvents(), 0);
  assert.equal(failed.submit.disabled, false);
  assert.equal(failed.form.dataset.status, 'error');
  assert.equal(failed.events.length, 0);
}

const keyboard = environment();
await keyboard.enter(keyboard.controls.website);
assert.equal(keyboard.submitted(), 1);
assert.equal(keyboard.submitEvents(), 1, 'Enter emits one final submit event.');

const touched = environment();
touched.controls.email.value = 'bad';
touched.controls.email.validity.valid = false;
touched.listeners.blur({ target: touched.controls.email });
assert.equal(touched.controls.email['aria-invalid'], 'true');
touched.controls.email.value = 'stillbad';
touched.listeners.input({ target: touched.controls.email });
assert.equal(touched.controls.email['aria-invalid'], 'true', 'An error remains until the value is actually valid.');
touched.controls.email.value = 'valid@example.com';
touched.controls.email.validity.valid = true;
touched.listeners.input({ target: touched.controls.email });
assert.equal(touched.controls.email['aria-invalid'], 'false');

const restored = environment({ state: 'error', initialStorage: Object.fromEntries(offline.values) });
assert.equal(restored.controls.name.value, 'Test Visitor');
assert.equal(restored.controls.website.value, 'https://example.com/');

const forged = environment({ state: 'sent' });
assert.equal(forged.events.length, 0, 'A success state alone cannot trigger lead tracking.');

for (const useGtag of [true, false]) {
  for (const state of ['', 'error', 'invalid', 'unconfirmed', 'expired']) {
    const unsuccessful = environment({ state, receipt: 'b'.repeat(32), useGtag });
    assert.equal(unsuccessful.analytics().length, 0, `${state || 'unconfirmed'}: no lead event, even with a receipt.`);
  }
  for (const receipt of ['', 'invalid', 'a'.repeat(31), 'a'.repeat(33), 'g'.repeat(32)]) {
    const unconfirmed = environment({ state: 'sent', receipt, useGtag });
    assert.equal(unconfirmed.analytics().length, 0, 'Only a valid confirmed receipt can count as a lead.');
  }
}

const confirmed = environment({ state: 'sent', receipt: 'a'.repeat(32) });
assert.equal(confirmed.events.length, 1);
assert.equal(confirmed.events[0][1], 'generate_lead');
assert.equal(confirmed.events[0][2].lead_source, 'en_seo');
assert.deepEqual(Object.keys(confirmed.events[0][2]).sort(), ['form_id', 'form_name', 'lead_source', 'send_to']);
assert.equal(confirmed.events[0][2].send_to, 'G-WQ4CG18QQT');
const reloaded = environment({ state: 'sent', receipt: 'a'.repeat(32), initialStorage: Object.fromEntries(confirmed.values) });
assert.equal(reloaded.events.length, 0, 'Reloading a receipt must not duplicate the lead event.');

const acquisition = environment({ search: '?utm_source=google&utm_medium=cpc&utm_campaign=seo-audit&utm_content=hero&utm_term=technical-seo&gclid=click-123&wbraid=web-123&gbraid=app-123' });
const attributionValues = JSON.parse(acquisition.values.get(ATTRIBUTION_KEY)).values;
const navigated = environment({ search: '', now: NOW + 10 * 60 * 1000, initialStorage: Object.fromEntries(acquisition.values) });
for (const [key, value] of Object.entries(attributionValues)) assert.equal(navigated.controls[key].value, value, `${key} survives navigation without query parameters.`);
const attributionReload = environment({ search: '', now: NOW + 20 * 60 * 1000, initialStorage: Object.fromEntries(navigated.values) });
for (const [key, value] of Object.entries(attributionValues)) assert.equal(attributionReload.controls[key].value, value, `${key} survives reload within the session TTL.`);
await attributionReload.send();
for (const [key, value] of Object.entries(attributionValues)) assert.equal(attributionReload.nativePosts[0][key], value, `${key} reaches the simulated backend POST.`);
for (const elapsed of [TTL, TTL + 1]) {
  const expired = environment({ search: '', now: NOW + elapsed, initialStorage: Object.fromEntries(acquisition.values) });
  for (const key of Object.keys(attributionValues)) assert.equal(expired.controls[key].value, '', `${key} expires after 30 minutes without refresh.`);
  assert.deepEqual(JSON.parse(expired.values.get(ATTRIBUTION_KEY)).values, {});
}
const newCampaign = environment({ search: '?utm_source=newsletter&utm_medium=email', initialStorage: Object.fromEntries(acquisition.values), now: NOW + 1000 });
assert.equal(newCampaign.controls.utm_source.value, 'newsletter');
assert.equal(newCampaign.controls.utm_campaign.value, '', 'A new campaign must not inherit an old campaign name.');
assert.equal(newCampaign.controls.gclid.value, '', 'A new campaign must not inherit an old paid click ID.');

const expiredDraft = environment({ state: 'error', now: NOW + TTL, initialStorage: Object.fromEntries(offline.values) });
assert.equal(expiredDraft.values.has(DRAFT_KEY), false, 'Expired personal drafts are removed.');

for (const useGtag of [true, false]) {
  const privateValues = { name: 'Private Test Name', email: 'private-person@example.org', website: 'https://private-business.example.org/', message: 'Private project requirements' };
  const receipt = (useGtag ? 'c' : 'd').repeat(32);
  const analytics = environment({ state: 'sent', receipt, useGtag, initialFields: privateValues, search: '?utm_term=private-search-term&gclid=private-click-id', initialStorage: Object.fromEntries(offline.values) });
  const emitted = analytics.analytics();
  assert.equal(emitted.length, 1);
  assert.equal(emitted[0][0], 'event');
  assert.equal(emitted[0][1], 'generate_lead');
  assert.deepEqual(JSON.parse(JSON.stringify(emitted[0][2])), {
    send_to: 'G-WQ4CG18QQT', form_id: 'en-seo-contact-form', form_name: 'Technical SEO audit (English)', lead_source: 'en_seo'
  }, 'The gtag and dataLayer fallback contracts expose only approved non-personal fields.');
  for (const value of [...Object.values(privateValues), receipt, 'private-search-term', 'private-click-id']) {
    assert.equal(JSON.stringify(emitted).includes(value), false, 'No personal form values, attribution values or receipts enter analytics.');
  }
  assert.equal(analytics.values.has(DRAFT_KEY), false, 'Confirmed success removes the personal draft.');
  const repeat = environment({ state: 'sent', receipt, useGtag, search: '', initialStorage: Object.fromEntries(analytics.values) });
  assert.equal(repeat.analytics().length, 0, 'Reload is deduplicated for both gtag and the dataLayer fallback.');
}

console.log('EN SEO contact: validation, pending double-submit prevention, nonce/error recovery, attribution TTL and PII-free confirmed-only analytics passed (offline; native POST simulated).');
