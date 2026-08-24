/**
 * Campaign audit landing tracking + attribution preservation.
 */
(function () {
  'use strict';

  var ATTRIBUTION_KEYS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid'];
  var CLICK_ID_KEYS = ['gclid', 'wbraid', 'gbraid'];
  var ATTRIBUTION_STORAGE_PREFIX = 'hashbox_attribution_v2_';
  var LEGACY_ATTRIBUTION_STORAGE_KEY = 'hashbox_attribution_params';
  var ATTRIBUTION_TTL_MS = 90 * 24 * 60 * 60 * 1000;
  var AI_CONVERSION_DESTINATION = 'AW-18190672421/qx_ICPKggN0cEKXE_uFD';
  var AI_PENDING_LEAD_KEY = 'hashbox_ai_pending_lead_ref';
  var AI_LEAD_STORAGE_PREFIX = 'hashbox_ai_lead_v2_';
  var AI_LEAD_MEMORY_STATE = {};

  function attributionStorageKey(scope) {
    return ATTRIBUTION_STORAGE_PREFIX + String(scope || 'site').replace(/[^a-z0-9_-]/gi, '_');
  }

  function readStoredAttribution(scope) {
    try {
      var key = attributionStorageKey(scope);
      var raw = window.localStorage.getItem(key);
      if (!raw) return { data: {}, identity: '' };

      var record = JSON.parse(raw);
      var capturedAt = Number(record && record.capturedAt) || 0;
      if (!record || record.version !== 2 || !record.data || !capturedAt || Date.now() - capturedAt > ATTRIBUTION_TTL_MS) {
        window.localStorage.removeItem(key);
        return { data: {}, identity: '' };
      }

      var data = {};
      ATTRIBUTION_KEYS.forEach(function (keyName) {
        if (typeof record.data[keyName] === 'string' && record.data[keyName]) {
          data[keyName] = record.data[keyName];
        }
      });

      return {
        data: data,
        identity: typeof record.identity === 'string' ? record.identity : ''
      };
    } catch (err) {
      return { data: {}, identity: '' };
    }
  }

  function writeStoredAttribution(scope, data, identity) {
    try {
      window.localStorage.setItem(attributionStorageKey(scope), JSON.stringify({
        version: 2,
        capturedAt: Date.now(),
        identity: identity || '',
        data: data
      }));
      window.localStorage.removeItem(LEGACY_ATTRIBUTION_STORAGE_KEY);
    } catch (err) {}
  }

  function attributionIdentity(data) {
    var clickIdentity = '';
    CLICK_ID_KEYS.some(function (key) {
      if (!data[key]) return false;
      clickIdentity = 'click:' + key + ':' + data[key];
      return true;
    });
    if (clickIdentity) return clickIdentity;

    var campaignParts = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content'].map(function (key) {
      return data[key] || '';
    });
    return campaignParts.some(Boolean) ? 'utm:' + campaignParts.join('|') : '';
  }

  function captureAttribution(scope) {
    var params = new URLSearchParams(window.location.search);
    var stored = readStoredAttribution(scope);
    var incoming = {};
    var found = false;

    ATTRIBUTION_KEYS.forEach(function (key) {
      var value = params.get(key);
      if (value) {
        incoming[key] = value;
        found = true;
      }
    });

    if (!found) return stored.data;

    var incomingIdentity = attributionIdentity(incoming);
    var next = incomingIdentity && stored.identity && incomingIdentity !== stored.identity
      ? {}
      : Object.assign({}, stored.data);

    ATTRIBUTION_KEYS.forEach(function (key) {
      if (incoming[key]) next[key] = incoming[key];
    });

    writeStoredAttribution(scope, next, incomingIdentity || stored.identity);
    return next;
  }

  function withAttributionDefaults(data, root) {
    var next = Object.assign({}, data || {});
    if (root && root.dataset.utmContent && !next.utm_content) {
      next.utm_content = root.dataset.utmContent;
    }
    return next;
  }

  function applyAttribution(data) {
    ATTRIBUTION_KEYS.forEach(function (key) {
      document.querySelectorAll('[data-attribution-field="' + key + '"]').forEach(function (input) {
        input.value = data[key] || input.dataset.attributionDefault || '';
      });
    });
  }

  function sameOriginUrl(href) {
    try {
      var url = new URL(href, window.location.href);
      return url.origin === window.location.origin ? url : null;
    } catch (err) {
      return null;
    }
  }

  function preserveAttributionOnInternalLinks(data) {
    document.querySelectorAll('a[href]').forEach(function (link) {
      var url = sameOriginUrl(link.getAttribute('href'));
      if (!url || url.hash && url.pathname === window.location.pathname) return;

      var changed = false;
      ATTRIBUTION_KEYS.forEach(function (key) {
        if (data[key] && !url.searchParams.has(key)) {
          url.searchParams.set(key, data[key]);
          changed = true;
        }
      });
      if (changed) link.href = url.toString();
    });
  }

  function baseParams(extra) {
    var root = document.querySelector('.hb-audit');
    return Object.assign({
      page_path: window.location.pathname,
      audit_slug: root ? root.dataset.auditSlug : '',
      service_interest: root ? root.dataset.serviceInterest : '',
      utm_content: root ? root.dataset.utmContent : ''
    }, extra || {});
  }

  window.hashboxTrack = function (eventName, params) {
    var payload = baseParams(params);

    if (typeof window.gtag === 'function') {
      window.gtag('event', eventName, Object.assign({ transport_type: 'beacon' }, payload));
    }

    // audit_request_submit is engagement telemetry only. Lead conversions fire
    // after the server confirms wp_mail() success below.
  };

  function cleanSuccessParams() {
    var cleanUrl = new URL(window.location.href);
    cleanUrl.searchParams.delete('contact');
    cleanUrl.searchParams.delete('lead_ref');
    cleanUrl.searchParams.delete('lead_sig');
    cleanUrl.searchParams.delete('confirmation');
    window.history.replaceState({}, '', cleanUrl.pathname + (cleanUrl.searchParams.toString() ? '?' + cleanUrl.searchParams.toString() : '') + cleanUrl.hash);
  }

  function isValidLeadRef(leadRef) {
    return /^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i.test(leadRef || '');
  }

  function aiLeadStorageKey(leadRef) {
    return AI_LEAD_STORAGE_PREFIX + leadRef;
  }

  function legacyAiLeadStorageKey(leadRef) {
    return 'hashbox_ai_lead_' + leadRef;
  }

  function migrateLegacyAiLeadState(leadRef) {
    try {
      var legacyKey = legacyAiLeadStorageKey(leadRef);
      var raw = window.sessionStorage.getItem(legacyKey);
      if (!raw) return null;

      var stored = raw === '1' ? { ads: true, meta: true } : JSON.parse(raw);
      var migrated = {
        // The legacy analytics flag only proves ai_consultation_lead was queued.
        // The canonical generate_lead event still needs to be sent once.
        analytics: false,
        ads: stored.ads === true,
        meta: stored.meta === true
      };

      if (writeAiLeadState(leadRef, migrated)) {
        window.sessionStorage.removeItem(legacyKey);
      }
      return migrated;
    } catch (err) {
      return null;
    }
  }

  function readAiLeadState(leadRef) {
    var empty = { analytics: false, ads: false, meta: false };
    var raw = null;
    try {
      raw = window.localStorage.getItem(aiLeadStorageKey(leadRef));
    } catch (err) {}

    if (!raw) {
      try {
        raw = window.sessionStorage.getItem(aiLeadStorageKey(leadRef));
      } catch (err) {}
    }

    if (!raw && AI_LEAD_MEMORY_STATE[leadRef]) {
      return Object.assign({}, AI_LEAD_MEMORY_STATE[leadRef]);
    }
    if (!raw) return migrateLegacyAiLeadState(leadRef) || empty;
    if (raw === '1') return { analytics: true, ads: true, meta: true };

    try {
      var stored = JSON.parse(raw);
      return {
        analytics: stored.analytics === true,
        ads: stored.ads === true,
        meta: stored.meta === true
      };
    } catch (err) {
      return AI_LEAD_MEMORY_STATE[leadRef]
        ? Object.assign({}, AI_LEAD_MEMORY_STATE[leadRef])
        : empty;
    }
  }

  function writeAiLeadState(leadRef, state) {
    var key = aiLeadStorageKey(leadRef);
    var serialized = JSON.stringify(state);
    AI_LEAD_MEMORY_STATE[leadRef] = {
      analytics: state.analytics === true,
      ads: state.ads === true,
      meta: state.meta === true
    };
    try {
      window.localStorage.setItem(key, serialized);
      try { window.sessionStorage.removeItem(key); } catch (err) {}
      return true;
    } catch (err) {}

    // Storage-restricted browsers still need same-session protection so the
    // retry loop cannot queue GA4/Ads repeatedly while waiting for Meta.
    try {
      window.sessionStorage.setItem(key, serialized);
      return true;
    } catch (err) {}
    return false;
  }

  function rememberPendingAiLead(leadRef) {
    try {
      window.sessionStorage.setItem(AI_PENDING_LEAD_KEY, leadRef);
      return true;
    } catch (err) {
      return false;
    }
  }

  function clearPendingAiLead(leadRef) {
    try {
      if (window.sessionStorage.getItem(AI_PENDING_LEAD_KEY) === leadRef) {
        window.sessionStorage.removeItem(AI_PENDING_LEAD_KEY);
      }
    } catch (err) {}
  }

  function confirmedAiLeadRef(root) {
    if (!root || root.dataset.auditSlug !== 'ai-workflow-audit') return '';

    // Only trust references the server confirmed by printing the signed meta
    // tag (contact=ai_sent&lead_ref&lead_sig verified against the submit-time
    // transient). A crafted success URL must never fire ad conversions.
    var meta = document.querySelector('meta[name="hashbox-confirmed-ai-lead"]');
    var confirmedRef = meta ? meta.getAttribute('content') || '' : '';
    if (!isValidLeadRef(confirmedRef)) return '';

    var params = new URLSearchParams(window.location.search);
    var leadRef = params.get('contact') === 'ai_sent' ? params.get('lead_ref') || '' : '';
    if (isValidLeadRef(leadRef)) {
      return leadRef === confirmedRef ? confirmedRef : '';
    }

    try {
      leadRef = window.sessionStorage.getItem(AI_PENDING_LEAD_KEY) || '';
    } catch (err) {
      leadRef = '';
    }
    return isValidLeadRef(leadRef) && leadRef === confirmedRef ? confirmedRef : '';
  }

  function trackConfirmedAiLead(root, leadRef, attempt) {
    if (!root || root.dataset.auditSlug !== 'ai-workflow-audit' || !isValidLeadRef(leadRef)) return;

    var state = readAiLeadState(leadRef);

    if (typeof window.gtag === 'function') {
      if (!state.analytics) {
        // Use GA4's recommended lead-generation event so Website and AI
        // submissions populate the same lead funnel and key-event reports.
        window.gtag('event', 'generate_lead', {
          form_id: 'ai-workflow-audit',
          form_name: 'AI Opportunity Screening',
          lead_source: 'ai_consulting',
          currency: 'THB',
          value: 1,
          transaction_id: leadRef
        });
        state.analytics = true;
      }

      if (!state.ads) {
        window.gtag('event', 'conversion', {
          send_to: AI_CONVERSION_DESTINATION,
          transaction_id: leadRef,
          currency: 'THB',
          value: 1
        });
        state.ads = true;
      }
    }

    if (!state.meta && typeof window.fbq === 'function') {
      window.fbq('track', 'Lead', { content_name: 'AI Opportunity Screening' }, { eventID: leadRef });
      state.meta = true;
    }

    var stateStored = writeAiLeadState(leadRef, state);
    var pendingStored = state.meta ? true : rememberPendingAiLead(leadRef);

    if (state.meta) clearPendingAiLead(leadRef);

    if (state.analytics && state.ads && (state.meta || stateStored && pendingStored)) {
      cleanSuccessParams();
    }

    if (state.analytics && state.ads && state.meta) return;

    if (attempt < 120) {
      window.setTimeout(function () { trackConfirmedAiLead(root, leadRef, attempt + 1); }, 500);
    }
  }

  function focusContactAlert() {
    var alert = document.querySelector('[data-contact-alert]');
    if (!alert) return;

    window.setTimeout(function () {
      try {
        alert.focus({ preventScroll: true });
      } catch (err) {
        alert.focus();
      }
    }, 0);
  }

  function initAiContactRequirement(form) {
    var preference = form.querySelector('[data-ai-contact-preference]');
    var detail = form.querySelector('[data-ai-contact-detail]');
    var requiredMark = form.querySelector('[data-ai-contact-required]');
    if (!preference || !detail) return;

    function syncRequirement() {
      var required = preference.value === 'LINE' || preference.value === 'โทร';
      detail.required = required;
      if (required) {
        detail.setAttribute('aria-required', 'true');
      } else {
        detail.removeAttribute('aria-required');
      }
      if (requiredMark) requiredMark.hidden = !required;
    }

    preference.addEventListener('change', syncRequirement);
    detail.addEventListener('invalid', function () {
      var disclosure = detail.closest('details');
      if (disclosure) disclosure.open = true;
    });
    syncRequirement();
  }

  function initAiStickyCta(root) {
    if (root.dataset.auditSlug !== 'ai-workflow-audit') return;

    var sticky = root.querySelector('[data-ai-sticky-cta]');
    var heroCta = root.querySelector('.hb-ai-hero__primary');
    var formSection = root.querySelector('[data-audit-form]');
    if (!sticky || !heroCta || !formSection || typeof window.IntersectionObserver !== 'function') return;

    var compactViewport = window.matchMedia('(max-width: 720px)');
    var heroCtaPassedAbove = false;
    var formVisible = false;

    function syncStickyState() {
      var visible = compactViewport.matches && heroCtaPassedAbove && !formVisible;
      sticky.classList.toggle('is-visible', visible);
      sticky.setAttribute('aria-hidden', visible ? 'false' : 'true');
      if (visible) {
        sticky.removeAttribute('inert');
      } else {
        sticky.setAttribute('inert', '');
      }
    }

    new IntersectionObserver(function (entries) {
      var entry = entries[0];
      heroCtaPassedAbove = !entry.isIntersecting && entry.boundingClientRect.bottom <= 0;
      syncStickyState();
    }, { threshold: 0.05 }).observe(heroCta);

    new IntersectionObserver(function (entries) {
      formVisible = entries[0].isIntersecting;
      syncStickyState();
    }, { threshold: 0, rootMargin: '0px 0px -45% 0px' }).observe(formSection);

    if (typeof compactViewport.addEventListener === 'function') {
      compactViewport.addEventListener('change', syncStickyState);
    } else if (typeof compactViewport.addListener === 'function') {
      compactViewport.addListener(syncStickyState);
    }

    syncStickyState();
  }

  var root = document.querySelector('.hb-audit');
  var attributionScope = root ? root.dataset.auditSlug : 'site';
  var attribution = withAttributionDefaults(captureAttribution(attributionScope), root);
  applyAttribution(attribution);
  preserveAttributionOnInternalLinks(attribution);
  if (root) {
    if (root.dataset.auditSlug === 'ai-workflow-audit') {
      var retryConfirmedLead = function () {
        window.removeEventListener('hashbox:third-party-ready', retryConfirmedLead);
        var pendingLeadRef = confirmedAiLeadRef(root);
        if (pendingLeadRef) trackConfirmedAiLead(root, pendingLeadRef, 0);
      };
      window.addEventListener('hashbox:third-party-ready', retryConfirmedLead);

      var leadRef = confirmedAiLeadRef(root);
      if (leadRef) trackConfirmedAiLead(root, leadRef, 0);
    }
    initAiStickyCta(root);
  }
  focusContactAlert();

  document.querySelectorAll('[data-audit-form]').forEach(function (form) {
    initAiContactRequirement(form);
    form.addEventListener('submit', function () {
      applyAttribution(attribution);
      window.hashboxTrack('audit_request_submit', {
        service_interest: form.querySelector('[name="service"]') ? form.querySelector('[name="service"]').value : '',
        budget: form.querySelector('[name="budget"]') ? form.querySelector('[name="budget"]').value : '',
        timeline: form.querySelector('[name="timeline"]') ? form.querySelector('[name="timeline"]').value : '',
        contact_preference: form.querySelector('[name="contact_preference"]') ? form.querySelector('[name="contact_preference"]').value : ''
      });
    });
  });

  document.addEventListener('click', function (event) {
    var link = event.target.closest('a');
    if (!link) return;

    var eventName = link.dataset.trackEvent || '';
    var href = link.getAttribute('href') || '';

    if (!eventName && href.indexOf('https://lin.ee/') === 0) eventName = 'line_click';
    if (!eventName && href.indexOf('tel:') === 0) eventName = 'phone_click';
    if (!eventName && href.indexOf('mailto:') === 0) eventName = 'email_click';
    if (!eventName) return;

    window.hashboxTrack(eventName, {
      link_url: href,
      link_text: (link.textContent || '').trim().slice(0, 120)
    });
  });
})();
