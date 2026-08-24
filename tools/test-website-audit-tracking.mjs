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
const WEBSITE_ADS_DESTINATION = 'AW-18190672421/zT9ACPe6ttocEKXE_uFD';

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

  const window = {
    document,
    location,
    localStorage,
    sessionStorage,
    hashboxWebsiteAuditTracking: {
      conversionDestination: WEBSITE_ADS_DESTINATION
    },
    history: {
      replaceState(_state, _title, nextUrl) {
        historyCalls.push(nextUrl);
        pageUrl = new URL(nextUrl, pageUrl);
        syncLocation();
      }
    },
    gtag(...args) {
      gtagCalls.push(args);
      const payload = args[0] === 'event' && args[1] === 'conversion' ? args[2] : null;
      if (invokeAdsCallback && payload && typeof payload.event_callback === 'function') payload.event_callback();
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

  return { gtagCalls, fbqCalls, historyCalls, localStorage, sessionStorage, form };
}

function eventCalls(result, eventName) {
  return result.gtagCalls.filter(
    (args) => args[0] === 'event' && args[1] === eventName
  );
}

const firstRun = runTracking();
const leadEvents = eventCalls(firstRun, 'generate_lead');
const adsEvents = eventCalls(firstRun, 'conversion');
assert.equal(leadEvents.length, 1, 'Website success must emit one generate_lead event');
assert.equal(adsEvents.length, 1, 'Website success must emit one direct Ads conversion');
assert.equal(leadEvents[0][2].transaction_id, VALID_CONVERSION_REF);
assert.equal(adsEvents[0][2].transaction_id, VALID_CONVERSION_REF);
assert.equal(adsEvents[0][2].send_to, WEBSITE_ADS_DESTINATION);
assert.equal(firstRun.fbqCalls.length, 1, 'Website success must emit one Meta Lead event');
assert.equal(firstRun.fbqCalls[0][3].eventID, VALID_LEAD_REF, 'Meta must retain the UUID eventID');
assert.equal(firstRun.form.dataset.state, 'success');
assert.ok(
  !/[?&](contact|lead_ref|lead_sig)=/.test(firstRun.historyCalls.at(-1)),
  'success URL cleanup must remove signed conversion parameters'
);

const replayRun = runTracking({ localStorage: firstRun.localStorage });
assert.equal(eventCalls(replayRun, 'generate_lead').length, 0, 'replay must emit no GA4 lead');
assert.equal(eventCalls(replayRun, 'conversion').length, 0, 'replay must emit no Ads conversion');
assert.equal(replayRun.fbqCalls.length, 0, 'replay must emit no Meta event');

const pendingAdsStorage = new MemoryStorage();
const pendingAdsFirstRun = runTracking({
  localStorage: pendingAdsStorage,
  invokeAdsCallback: false
});
const pendingAdsReloadRun = runTracking({
  localStorage: pendingAdsStorage,
  invokeAdsCallback: false
});
assert.equal(eventCalls(pendingAdsFirstRun, 'generate_lead').length, 1);
assert.equal(eventCalls(pendingAdsFirstRun, 'conversion').length, 1);
assert.equal(
  eventCalls(pendingAdsReloadRun, 'generate_lead').length,
  0,
  'reload before Ads callback must not queue GA4 generate_lead twice'
);
assert.equal(
  eventCalls(pendingAdsReloadRun, 'conversion').length,
  1,
  'reload before Ads callback may retry the same deduped Ads transaction'
);

const mismatchedMetaRun = runTracking({ confirmedRef: OTHER_LEAD_REF });
assert.equal(mismatchedMetaRun.gtagCalls.length, 0, 'mismatched meta must emit no Google events');
assert.equal(mismatchedMetaRun.fbqCalls.length, 0, 'mismatched meta must emit no Meta event');

for (const invalidConversionRef of ['', VALID_LEAD_REF, 'HB-AI-20260825-000000002', 'HB-WEB-20260825-2']) {
  const invalidConversionRun = runTracking({ conversionRef: invalidConversionRef });
  assert.equal(invalidConversionRun.gtagCalls.length, 0, 'invalid Website conversion ref must fail closed');
  assert.equal(invalidConversionRun.fbqCalls.length, 0, 'invalid Website conversion ref must emit no Meta event');
  assert.equal(invalidConversionRun.form.dataset.state, 'success', 'legacy signed success UI must remain intact');
  assert.ok(
    invalidConversionRun.historyCalls.length > 0 &&
      !/[?&](contact|lead_ref|lead_sig)=/.test(invalidConversionRun.historyCalls.at(-1)),
    'legacy signed success must clean its signed URL'
  );
}

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
