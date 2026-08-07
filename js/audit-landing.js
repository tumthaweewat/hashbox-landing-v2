/**
 * Campaign audit landing tracking + attribution preservation.
 */
(function () {
  'use strict';

  var ATTRIBUTION_KEYS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid'];
  var STORAGE_KEY = 'hashbox_attribution_params';
  var AI_CONVERSION_DESTINATION = 'AW-18190672421/qx_ICPKggN0cEKXE_uFD';

  function readStoredAttribution() {
    try {
      var raw = window.localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : {};
    } catch (err) {
      return {};
    }
  }

  function writeStoredAttribution(data) {
    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    } catch (err) {}
  }

  function captureAttribution() {
    var params = new URLSearchParams(window.location.search);
    var stored = readStoredAttribution();
    var next = Object.assign({}, stored);
    var found = false;

    ATTRIBUTION_KEYS.forEach(function (key) {
      var value = params.get(key);
      if (value) {
        next[key] = value;
        found = true;
      }
    });

    if (found) writeStoredAttribution(next);
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
    window.history.replaceState({}, '', cleanUrl.pathname + (cleanUrl.searchParams.toString() ? '?' + cleanUrl.searchParams.toString() : '') + cleanUrl.hash);
  }

  function trackConfirmedAiLead(root, attempt) {
    var params = new URLSearchParams(window.location.search);
    var leadRef = params.get('lead_ref') || '';
    var storageKey = 'hashbox_ai_lead_' + leadRef;

    if (root.dataset.auditSlug !== 'ai-workflow-audit' || params.get('contact') !== 'ai_sent' || !leadRef) return;

    try {
      if (window.sessionStorage.getItem(storageKey)) {
        cleanSuccessParams();
        return;
      }
    } catch (err) {}

    window.hashboxAiLeadTracked = window.hashboxAiLeadTracked || { analytics: false, ads: false, meta: false };

    if (typeof window.gtag === 'function') {
      if (!window.hashboxAiLeadTracked.analytics) {
        window.gtag('event', 'ai_consultation_lead', {
          form_id: 'ai-workflow-audit',
          form_name: 'AI Opportunity Screening',
          lead_source: 'ai_consulting',
          currency: 'THB',
          value: 1,
          transaction_id: leadRef
        });
        window.hashboxAiLeadTracked.analytics = true;
      }

      if (!window.hashboxAiLeadTracked.ads) {
        window.gtag('event', 'conversion', {
          send_to: AI_CONVERSION_DESTINATION,
          transaction_id: leadRef,
          currency: 'THB',
          value: 1
        });
        window.hashboxAiLeadTracked.ads = true;
      }
    }

    if (!window.hashboxAiLeadTracked.meta && typeof window.fbq === 'function') {
      window.fbq('track', 'Lead', { content_name: 'AI Opportunity Screening' });
      window.hashboxAiLeadTracked.meta = true;
    }

    if (window.hashboxAiLeadTracked.analytics && window.hashboxAiLeadTracked.ads) {
      try {
        window.sessionStorage.setItem(storageKey, '1');
      } catch (err) {}
      cleanSuccessParams();
      return;
    }

    if (attempt < 40) {
      window.setTimeout(function () { trackConfirmedAiLead(root, attempt + 1); }, 250);
    }
  }

  var attribution = captureAttribution();
  var root = document.querySelector('.hb-audit');
  if (root && root.dataset.utmContent && !attribution.utm_content) {
    attribution.utm_content = root.dataset.utmContent;
  }
  applyAttribution(attribution);
  preserveAttributionOnInternalLinks(attribution);
  if (root) trackConfirmedAiLead(root, 0);

  document.querySelectorAll('[data-audit-form]').forEach(function (form) {
    form.addEventListener('submit', function () {
      applyAttribution(readStoredAttribution());
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
