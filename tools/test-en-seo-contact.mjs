import assert from 'node:assert/strict';
import vm from 'node:vm';
import { readFile } from 'node:fs/promises';

const source = await readFile(new URL('../js/en-seo-contact.js', import.meta.url), 'utf8');

function environment({ state = '', receipt = '', initialStorage = {}, failNonce = false } = {}) {
  const values = new Map(Object.entries(initialStorage));
  const events = [];
  const listeners = {};
  const buttonListeners = {};
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
      type: name === 'pdpa' ? 'checkbox' : 'text',
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
  const status = { textContent: '', hidden: true, focus() {} };
  const label = { textContent: 'Request SEO audit' };
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
      if (!prevented) submitted++;
    }
  };
  const document = {
    querySelector() { return form; },
    getElementById(id) { return id === 'en-seo-contact-status' ? status : errors[id]; },
    createElement() { return {}; }
  };
  const window = {
    location: { search: '?utm_source=example&utm_campaign=seo' },
    sessionStorage: {
      getItem(key) { return values.get(key) ?? null; },
      setItem(key, value) { values.set(key, String(value)); },
      removeItem(key) { values.delete(key); }
    },
    gtag(...args) { events.push(args); },
    addEventListener() {},
    setTimeout,
    clearTimeout
  };
  vm.runInNewContext(source, {
    document, window, URL, URLSearchParams, AbortController, Date,
    fetch: async () => {
      requests++;
      if (failNonce) throw new Error('offline');
      return { ok: true, json: async () => ({ success: true, data: { nonce: 'fresh-nonce' } }) };
    }
  });
  return { controls, form, status, submit, values, events, listeners, requests: () => requests, submitted: () => submitted, submitEvents: () => submitEvents,
    async send() { buttonListeners.click(); await new Promise(resolve => setImmediate(resolve)); },
    async enter(field) { listeners.keydown({ key: 'Enter', target: field, preventDefault() {} }); await new Promise(resolve => setImmediate(resolve)); }
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

const invalid = environment();
invalid.controls.website.value = 'facebook.com/business';
await invalid.send();
assert.equal(invalid.requests(), 0, 'Invalid URLs cannot reach the backend.');
assert.equal(invalid.controls.website['aria-invalid'], 'true');

const offline = environment({ failNonce: true });
await offline.send();
assert.equal(offline.submitted(), 0);
assert.equal(offline.submit.disabled, false);
assert.match(offline.status.textContent, /could not connect/i);
assert.equal(offline.form.dataset.status, 'error');
assert.equal(offline.submitEvents(), 0, 'Failed preparation does not emit a submission.');
assert.equal(offline.events.length, 0);

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

const confirmed = environment({ state: 'sent', receipt: 'a'.repeat(32) });
assert.equal(confirmed.events.length, 1);
assert.equal(confirmed.events[0][1], 'generate_lead');
assert.equal(confirmed.events[0][2].lead_source, 'en_seo');
assert.deepEqual(Object.keys(confirmed.events[0][2]).sort(), ['form_id', 'form_name', 'lead_source', 'send_to']);
assert.equal(confirmed.events[0][2].send_to, 'G-WQ4CG18QQT');
const reloaded = environment({ state: 'sent', receipt: 'a'.repeat(32), initialStorage: Object.fromEntries(confirmed.values) });
assert.equal(reloaded.events.length, 0, 'Reloading a receipt must not duplicate the lead event.');

console.log('EN SEO contact: validation, nonce refresh, error recovery, attribution and confirmed-only analytics passed.');
