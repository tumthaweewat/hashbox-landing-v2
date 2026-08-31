import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import vm from 'node:vm';

const scriptSource = await readFile(
  new URL('../js/website-audit-tracking.js', import.meta.url),
  'utf8'
);
const functionsSource = await readFile(
  new URL('../functions.php', import.meta.url),
  'utf8'
);

const VALID_LEAD_REF = '11111111-1111-4111-8111-111111111111';
const OTHER_LEAD_REF = '22222222-2222-4222-8222-222222222222';
const VALID_CONVERSION_REF = 'HB-WEB-20260825-143015123456000000002';
const GA4_EVENT = 'hb_web_ga4_lead_v1';
const ADS_EVENT = 'hb_web_ads_lead_v1';
const EXPECTED_PAYLOAD = {
  hb_schema_version: 1,
  hb_transaction_id: VALID_CONVERSION_REF,
  hb_value: 1,
  hb_currency: 'THB',
  hb_form_id: 'hashbox_contact',
  hb_form_name: 'Website Project Evaluation',
  hb_lead_source: 'website_audit'
};
const PII_KEYS = new Set(['name', 'email', 'phone', 'tel', 'lead_ref', 'company', 'contact_detail', 'website']);
const UUID_PATTERN = /^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i;

class MemoryStorage {
  constructor(initial = {}) {
    this.values = new Map(Object.entries(initial));
  }

  getItem(key) {
    return this.values.has(key) ? this.values.get(key) : null;
  }

  setItem(key, value) {
    this.values.set(key, String(value));
  }

  removeItem(key) {
    this.values.delete(key);
  }
}

function runTracking({
  leadRef = VALID_LEAD_REF,
  confirmedRef = VALID_LEAD_REF,
  conversionRef = VALID_CONVERSION_REF,
  localStorage = new MemoryStorage(),
  sessionStorage = new MemoryStorage(),
  hasFbq = true,
  invokeAdsCallback = true
} = {}) {
  let pageUrl = new URL(
    'https://hashbox.co.th/website-audit/' +
      '?utm_source=tracking_test' +
      '&contact=sent' +
      '&lead_ref=' + encodeURIComponent(leadRef) +
      '&lead_sig=' + 'a'.repeat(64) +
      '#audit-form'
  );
  const fields = new Map();
  const gtagCalls = [];
  const dataLayerPushes = [];
  const fbqCalls = [];
  const historyCalls = [];
  const timers = [];

  const submit = { disabled: false, textContent: '' };
  const status = { textContent: '', dataset: {} };
  const form = {
    elements: [],
    dataset: {},
    querySelector(selector) {
      if (selector === '[data-hb5-submit]') return submit;
      if (selector === '[data-hb5-status]') return status;
      const match = selector.match(/^input\[name="([^"]+)"\]$/);
      return match ? fields.get(match[1]) || null : null;
    },
    querySelectorAll() {
      return [];
    },
    appendChild(field) {
      fields.set(field.name, field);
      this.elements.push(field);
    },
    addEventListener() {},
    setAttribute() {}
  };
  const meta = confirmedRef
    ? {
        getAttribute(name) {
          if (name === 'content') return confirmedRef;
          if (name === 'data-conversion-ref') return conversionRef;
          return null;
        }
      }
    : null;

  const location = {};
  function syncLocation() {
    location.href = pageUrl.toString();
    location.search = pageUrl.search;
    location.pathname = pageUrl.pathname;
    location.origin = pageUrl.origin;
    location.hash = pageUrl.hash;
  }
  syncLocation();

  const document = {
    querySelector(selector) {
      if (selector === 'form[data-hb5-form]') return form;
      if (selector === 'meta[name="hashbox-confirmed-website-lead"]') return meta;
      return null;
    },
    createElement() {
      return {
        type: '',
        name: '',
        value: '',
        disabled: false,
        setAttribute() {}
      };
    }
  };

  const dataLayer = [];
  dataLayer.push = (...items) => {
    for (const item of items) {
      dataLayerPushes.push(item);
      // GTM semantics: eventCallback runs once every tag for the event has
      // fired (or eventTimeout elapsed). A blocked/never-loaded container
      // never invokes it, which is what invokeAdsCallback=false simulates.
      if (invokeAdsCallback && item && item.event === ADS_EVENT && typeof item.eventCallback === 'function') {
        item.eventCallback();
      }
    }
    return Array.prototype.push.apply(dataLayer, items);
  };
  const window = {
    document,
    location,
    localStorage,
    sessionStorage,
    dataLayer,
    hashboxWebsiteAuditTracking: {},
    history: {
      replaceState(_state, _title, nextUrl) {
        historyCalls.push(nextUrl);
        pageUrl = new URL(nextUrl, pageUrl);
        syncLocation();
      }
    },
    gtag(...args) {
      gtagCalls.push(args);
    },
    addEventListener() {},
    setTimeout(callback) {
      timers.push(callback);
      return timers.length;
    }
  };
  if (hasFbq) {
    window.fbq = (...args) => fbqCalls.push(args);
  }

  vm.runInNewContext(scriptSource, {
    window,
    document,
    URL,
    URLSearchParams,
    Date,
    console
  });

  while (timers.length) timers.shift()();

  return { gtagCalls, dataLayerPushes, fbqCalls, historyCalls, localStorage, sessionStorage, form };
}

function eventPushes(result, eventName) {
  return result.dataLayerPushes.filter((item) => item && item.event === eventName);
}

function assertNamespacedPayload(push, label) {
  for (const [key, value] of Object.entries(EXPECTED_PAYLOAD)) {
    assert.equal(push[key], value, `${label} must carry ${key}`);
  }
  for (const [key, value] of Object.entries(push)) {
    if (key === 'event' || key === 'eventCallback' || key === 'eventTimeout') continue;
    assert.match(key, /^hb_/, `${label} field ${key} must be namespaced with hb_`);
    assert.ok(!PII_KEYS.has(key.replace(/^hb_/, '')), `${label} must not carry PII field ${key}`);
    assert.ok(!UUID_PATTERN.test(String(value)), `${label} must not leak a UUID lead_ref via ${key}`);
  }
  assert.ok(!('lead_ref' in push), `${label} must not include lead_ref`);
}

function assertNoDirectGoogleCalls(result, label) {
  assert.equal(
    result.gtagCalls.filter((args) => args[0] === 'config' || args[0] === 'event').length,
    0,
    `${label}: GTM owns Google tagging — runtime must not call gtag config/event directly`
  );
}

// 1. First run: GA4 1 + Ads 1 + Meta 1, Ads callback cleans the signed URL.
const firstRun = runTracking();
const ga4First = eventPushes(firstRun, GA4_EVENT);
const adsFirst = eventPushes(firstRun, ADS_EVENT);
assert.equal(ga4First.length, 1, 'first run must push one GA4 lead event');
assert.equal(adsFirst.length, 1, 'first run must push one Ads lead event');
assertNamespacedPayload(ga4First[0], 'GA4 event');
assertNamespacedPayload(adsFirst[0], 'Ads event');
assert.equal(typeof adsFirst[0].eventCallback, 'function', 'Ads event must carry eventCallback for delivery confirmation');
assert.equal(adsFirst[0].eventTimeout, 6000, 'Ads event must bound the callback wait');
assert.ok(!('eventCallback' in ga4First[0]), 'GA4 event must not own URL cleanup');
assertNoDirectGoogleCalls(firstRun, 'first run');
assert.equal(firstRun.fbqCalls.length, 1, 'first run must emit one Meta Lead event');
assert.equal(firstRun.fbqCalls[0][3].eventID, VALID_LEAD_REF, 'Meta must retain the UUID eventID');
assert.equal(firstRun.form.dataset.state, 'success');
assert.ok(
  !/[?&](contact|lead_ref|lead_sig)=/.test(firstRun.historyCalls.at(-1)),
  'success URL cleanup must remove signed conversion parameters'
);
assert.equal(
  firstRun.localStorage.getItem('hashbox_website_audit_conversion_' + VALID_LEAD_REF),
  'delivered',
  'Ads callback must persist delivered state'
);

// 2. Reload after Ads callback: nothing fires again.
const replayRun = runTracking({ localStorage: firstRun.localStorage });
assert.equal(eventPushes(replayRun, GA4_EVENT).length, 0, 'reload after callback must push no GA4 lead');
assert.equal(eventPushes(replayRun, ADS_EVENT).length, 0, 'reload after callback must push no Ads lead');
assert.equal(replayRun.fbqCalls.length, 0, 'reload after callback must emit no Meta event');
assertNoDirectGoogleCalls(replayRun, 'replay');

// 3. Retry before Ads callback: GA4 0 + Ads 1, URL kept for another retry.
const pendingAdsStorage = new MemoryStorage();
const pendingAdsFirstRun = runTracking({
  localStorage: pendingAdsStorage,
  invokeAdsCallback: false
});
assert.equal(eventPushes(pendingAdsFirstRun, GA4_EVENT).length, 1);
assert.equal(eventPushes(pendingAdsFirstRun, ADS_EVENT).length, 1);
assert.equal(
  pendingAdsStorage.getItem('hashbox_website_audit_conversion_' + VALID_LEAD_REF),
  null,
  'without the Ads callback the conversion must stay undelivered'
);
const pendingAdsReloadRun = runTracking({
  localStorage: pendingAdsStorage,
  invokeAdsCallback: false
});
assert.equal(
  eventPushes(pendingAdsReloadRun, GA4_EVENT).length,
  0,
  'retry before Ads callback must not queue GA4 lead twice'
);
assert.equal(
  eventPushes(pendingAdsReloadRun, ADS_EVENT).length,
  1,
  'retry before Ads callback must re-push the same deduped Ads transaction'
);
assert.equal(
  eventPushes(pendingAdsReloadRun, ADS_EVENT)[0].hb_transaction_id,
  VALID_CONVERSION_REF,
  'retry must reuse the same HB-WEB transaction id'
);
assert.equal(pendingAdsReloadRun.fbqCalls.length, 0, 'retry must not duplicate the Meta event');

// 3b. Retry that finally gets the callback settles delivered state.
const pendingAdsSettledRun = runTracking({ localStorage: pendingAdsStorage });
assert.equal(eventPushes(pendingAdsSettledRun, ADS_EVENT).length, 1);
assert.equal(
  pendingAdsStorage.getItem('hashbox_website_audit_conversion_' + VALID_LEAD_REF),
  'delivered'
);
assert.equal(eventPushes(runTracking({ localStorage: pendingAdsStorage }), ADS_EVENT).length, 0);

// 4. Forged / mismatched / invalid references fail closed.
const forgedRun = runTracking({ confirmedRef: null });
assert.equal(forgedRun.dataLayerPushes.length, 0, 'forged contact=sent without server meta must push nothing');
assert.equal(forgedRun.fbqCalls.length, 0, 'forged contact=sent must emit no Meta event');
assertNoDirectGoogleCalls(forgedRun, 'forged');

const mismatchedMetaRun = runTracking({ confirmedRef: OTHER_LEAD_REF });
assert.equal(mismatchedMetaRun.dataLayerPushes.length, 0, 'mismatched meta must push no Google events');
assert.equal(mismatchedMetaRun.fbqCalls.length, 0, 'mismatched meta must emit no Meta event');

for (const invalidConversionRef of ['', VALID_LEAD_REF, 'HB-AI-20260825-000000002', 'HB-WEB-20260825-2']) {
  const invalidConversionRun = runTracking({ conversionRef: invalidConversionRef });
  assert.equal(invalidConversionRun.dataLayerPushes.length, 0, 'invalid Website conversion ref must fail closed');
  assert.equal(invalidConversionRun.gtagCalls.length, 0, 'invalid Website conversion ref must not call gtag');
  assert.equal(invalidConversionRun.fbqCalls.length, 0, 'invalid Website conversion ref must emit no Meta event');
  assert.equal(invalidConversionRun.form.dataset.state, 'success', 'legacy signed success UI must remain intact');
  assert.ok(
    invalidConversionRun.historyCalls.length > 0 &&
      !/[?&](contact|lead_ref|lead_sig)=/.test(invalidConversionRun.historyCalls.at(-1)),
    'legacy signed success must clean its signed URL'
  );
}

// 5. Source-level contracts: no direct Ads destination in the runtime, GTM not delayed.
assert.doesNotMatch(scriptSource, /AW-18190672421/, 'runtime must not embed the Ads destination — GTM owns it');
assert.doesNotMatch(scriptSource, /gtag\('config'/, 'runtime must not configure Google tags directly');
const delayFilterStart = functionsSource.indexOf('function hashbox_delay_third_party_scripts(');
const delayFilterEnd = functionsSource.indexOf('function hashbox_start_third_party_delay_buffer()', delayFilterStart);
const delayFilterSource = functionsSource.slice(delayFilterStart, delayFilterEnd);
assert.doesNotMatch(delayFilterSource, /googletagmanager\\\.com\|/, 'GTM host must not be delayed wholesale');
assert.doesNotMatch(delayFilterSource, /gtm\\\.js/, 'GTM container snippet must load without interaction delay');
assert.match(functionsSource, /gtag\('consent', 'default'/, 'Consent Mode defaults must be emitted by the theme');
assert.match(
  functionsSource,
  /add_action\( 'wp_head', 'hashbox_print_consent_mode_defaults', 0 \);/,
  'Consent defaults must run before any Google tag in wp_head'
);
assert.match(
  delayFilterSource,
  /G-WQ4CG18QQT/,
  'cutover filter must reference the standalone GA4 id it strips (GTM owns GA4)'
);
assert.ok(
  delayFilterSource.includes("gtag/js\\?id=G-WQ4CG18QQT") &&
    delayFilterSource.includes("gtag('config', 'G-WQ4CG18QQT')"),
  'cutover filter must strip both the standalone GA4 loader and its config'
);

const delayLoaderStart = functionsSource.indexOf(
  'function hashbox_print_third_party_delay_loader()'
);
const delayLoaderEnd = functionsSource.indexOf(
  "add_action( 'wp_footer', 'hashbox_print_third_party_delay_loader', 25 );",
  delayLoaderStart
);
const delayLoaderSource = functionsSource.slice(delayLoaderStart, delayLoaderEnd);
assert.match(
  delayLoaderSource,
  /isConfirmedWebsiteLead = successUuidPattern\.test\(confirmedWebsiteLeadRef\)[\s\S]{0,180}websiteConversionRefPattern\.test\(confirmedWebsiteConversionRef\)/,
  'Website loader activation must require server meta UUID and scoped conversion ref'
);
assert.doesNotMatch(
  delayLoaderSource,
  /isConfirmedWebsiteLead[\s\S]{0,220}searchParams\.get\('contact'\)/i,
  'Website loader activation must survive signed URL cleanup'
);

console.log('website-audit tracking tests passed');
