import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import vm from 'node:vm';

const scriptSource = await readFile(
  new URL('../js/audit-landing.js', import.meta.url),
  'utf8'
);

const VALID_LEAD_REF = '11111111-1111-4111-8111-111111111111';
const OTHER_LEAD_REF = '22222222-2222-4222-8222-222222222222';
const AI_ADS_DESTINATION = 'AW-18190672421/qx_ICPKggN0cEKXE_uFD';

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

class ThrowingStorage {
  getItem() {
    throw new Error('storage unavailable');
  }

  setItem() {
    throw new Error('storage unavailable');
  }

  removeItem() {
    throw new Error('storage unavailable');
  }
}

function runTracking({
  leadRef = VALID_LEAD_REF,
  confirmedRef = VALID_LEAD_REF,
  localStorage = new MemoryStorage(),
  sessionStorage = new MemoryStorage(),
  hasFbq = true
} = {}) {
  let pageUrl = new URL(
    'https://hashbox.co.th/ai-workflow-audit/' +
      '?utm_source=tracking_test' +
      '&contact=ai_sent' +
      '&lead_ref=' + encodeURIComponent(leadRef) +
      '&lead_sig=' + 'a'.repeat(64) +
      '&confirmation=queued#audit-form'
  );
  const gtagCalls = [];
  const fbqCalls = [];
  const historyCalls = [];
  const timers = [];

  const root = {
    dataset: {
      auditSlug: 'ai-workflow-audit',
      serviceInterest: 'AI Consulting',
      utmContent: 'ai_workforce_v4'
    },
    querySelector() {
      return null;
    }
  };

  const meta = confirmedRef
    ? {
        getAttribute(name) {
          return name === 'content' ? confirmedRef : null;
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
      if (selector === '.hb-audit') return root;
      if (selector === 'meta[name="hashbox-confirmed-ai-lead"]') return meta;
      return null;
    },
    querySelectorAll() {
      return [];
    },
    addEventListener() {}
  };

  const window = {
    document,
    location,
    localStorage,
    sessionStorage,
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
    removeEventListener() {},
    setTimeout(callback) {
      timers.push(callback);
    },
    matchMedia() {
      return {
        matches: false,
        addEventListener() {},
        addListener() {}
      };
    }
  };
  if (hasFbq) {
    window.fbq = (...args) => {
      fbqCalls.push(args);
    };
  }

  vm.runInNewContext(scriptSource, {
    window,
    document,
    URL,
    URLSearchParams,
    console
  });

  return {
    gtagCalls,
    fbqCalls,
    historyCalls,
    timers,
    localStorage,
    sessionStorage
  };
}

function eventCalls(result, eventName) {
  return result.gtagCalls.filter(
    (args) => args[0] === 'event' && args[1] === eventName
  );
}

const firstRun = runTracking();
const leadEvents = eventCalls(firstRun, 'generate_lead');
const legacyLeadEvents = eventCalls(firstRun, 'ai_consultation_lead');
const adsEvents = eventCalls(firstRun, 'conversion');

assert.equal(leadEvents.length, 1, 'AI success must emit one canonical generate_lead event');
assert.equal(legacyLeadEvents.length, 0, 'AI success must not emit a second custom lead event');
assert.equal(adsEvents.length, 1, 'AI success must emit one Google Ads conversion');
assert.equal(leadEvents[0][2].lead_source, 'ai_consulting');
assert.equal(leadEvents[0][2].transaction_id, VALID_LEAD_REF);
assert.equal(adsEvents[0][2].transaction_id, VALID_LEAD_REF);
assert.equal(adsEvents[0][2].send_to, AI_ADS_DESTINATION);
assert.equal(firstRun.fbqCalls.length, 1, 'AI success must emit one Meta Lead event');
assert.ok(
  firstRun.historyCalls.at(-1).includes('utm_source=tracking_test'),
  'success URL cleanup must preserve attribution'
);
assert.ok(
  !/[?&](contact|lead_ref|lead_sig|confirmation)=/.test(firstRun.historyCalls.at(-1)),
  'success URL cleanup must remove signed conversion parameters'
);

const crossSessionRun = runTracking({
  localStorage: firstRun.localStorage,
  sessionStorage: new MemoryStorage()
});
assert.equal(
  eventCalls(crossSessionRun, 'generate_lead').length,
  0,
  'the same signed lead must not emit GA4 again in a new session'
);
assert.equal(
  eventCalls(crossSessionRun, 'conversion').length,
  0,
  'the same signed lead must not emit Google Ads again in a new session'
);
assert.equal(
  crossSessionRun.fbqCalls.length,
  0,
  'the same signed lead must not emit Meta again in a new session'
);

const legacyStateRun = runTracking({
  localStorage: new MemoryStorage(),
  sessionStorage: new MemoryStorage({
    ['hashbox_ai_lead_' + VALID_LEAD_REF]: JSON.stringify({
      analytics: true,
      ads: true,
      meta: true
    })
  })
});
assert.equal(
  eventCalls(legacyStateRun, 'generate_lead').length,
  1,
  'legacy custom-event state must not suppress the canonical event migration'
);
assert.equal(
  eventCalls(legacyStateRun, 'conversion').length,
  0,
  'legacy Google Ads delivery state must prevent an Ads re-fire during migration'
);
assert.equal(
  legacyStateRun.fbqCalls.length,
  0,
  'legacy Meta delivery state must prevent a Meta re-fire during migration'
);
assert.equal(
  legacyStateRun.sessionStorage.getItem('hashbox_ai_lead_' + VALID_LEAD_REF),
  null,
  'successfully migrated legacy state must be removed from sessionStorage'
);

const legacyCompleteRun = runTracking({
  localStorage: new MemoryStorage(),
  sessionStorage: new MemoryStorage({
    ['hashbox_ai_lead_' + VALID_LEAD_REF]: '1'
  })
});
assert.equal(eventCalls(legacyCompleteRun, 'generate_lead').length, 1);
assert.equal(eventCalls(legacyCompleteRun, 'conversion').length, 0);
assert.equal(legacyCompleteRun.fbqCalls.length, 0);

const legacyPartialRun = runTracking({
  localStorage: new MemoryStorage(),
  sessionStorage: new MemoryStorage({
    ['hashbox_ai_lead_' + VALID_LEAD_REF]: JSON.stringify({
      analytics: true,
      ads: true,
      meta: false
    })
  })
});
assert.equal(eventCalls(legacyPartialRun, 'generate_lead').length, 1);
assert.equal(eventCalls(legacyPartialRun, 'conversion').length, 0);
assert.equal(legacyPartialRun.fbqCalls.length, 1);

const restrictedSessionStorage = new MemoryStorage();
const restrictedFirstRun = runTracking({
  localStorage: new ThrowingStorage(),
  sessionStorage: restrictedSessionStorage
});
const restrictedReloadRun = runTracking({
  localStorage: new ThrowingStorage(),
  sessionStorage: restrictedSessionStorage
});
assert.equal(eventCalls(restrictedFirstRun, 'generate_lead').length, 1);
assert.equal(eventCalls(restrictedReloadRun, 'generate_lead').length, 0);
assert.equal(eventCalls(restrictedReloadRun, 'conversion').length, 0);
assert.equal(restrictedReloadRun.fbqCalls.length, 0);

const fullyRestrictedRun = runTracking({
  localStorage: new ThrowingStorage(),
  sessionStorage: new ThrowingStorage(),
  hasFbq: false
});
assert.equal(eventCalls(fullyRestrictedRun, 'generate_lead').length, 1);
assert.equal(eventCalls(fullyRestrictedRun, 'conversion').length, 1);
assert.equal(fullyRestrictedRun.timers.length, 1);
fullyRestrictedRun.timers[0]();
assert.equal(
  eventCalls(fullyRestrictedRun, 'generate_lead').length,
  1,
  'in-memory state must stop GA4 requeueing when both web storages are blocked'
);
assert.equal(
  eventCalls(fullyRestrictedRun, 'conversion').length,
  1,
  'in-memory state must stop Ads requeueing when both web storages are blocked'
);

const mismatchedMetaRun = runTracking({ confirmedRef: OTHER_LEAD_REF });
assert.equal(mismatchedMetaRun.gtagCalls.length, 0, 'mismatched signed meta must emit no Google events');
assert.equal(mismatchedMetaRun.fbqCalls.length, 0, 'mismatched signed meta must emit no Meta event');

const malformedLeadRun = runTracking({ leadRef: 'not-a-uuid' });
assert.equal(malformedLeadRun.gtagCalls.length, 0, 'malformed lead_ref must emit no Google events');
assert.equal(malformedLeadRun.fbqCalls.length, 0, 'malformed lead_ref must emit no Meta event');

console.log('audit-landing tracking tests passed');
