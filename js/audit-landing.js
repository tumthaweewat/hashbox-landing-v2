/**
 * Campaign audit landing tracking + UTM preservation.
 */
(function () {
  'use strict';

  var UTM_KEYS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
  var STORAGE_KEY = 'hashbox_utm_params';

  function readStoredUtms() {
    try {
      var raw = window.localStorage.getItem(STORAGE_KEY);
      return raw ? JSON.parse(raw) : {};
    } catch (err) {
      return {};
    }
  }

  function writeStoredUtms(data) {
    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
    } catch (err) {}
  }

  function captureUtms() {
    var params = new URLSearchParams(window.location.search);
    var stored = readStoredUtms();
    var next = Object.assign({}, stored);
    var found = false;

    UTM_KEYS.forEach(function (key) {
      var value = params.get(key);
      if (value) {
        next[key] = value;
        found = true;
      }
    });

    if (found) writeStoredUtms(next);
    return next;
  }

  function applyUtms(data) {
    UTM_KEYS.forEach(function (key) {
      document.querySelectorAll('[data-utm-field="' + key + '"]').forEach(function (input) {
        input.value = data[key] || input.dataset.utmDefault || '';
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

  function preserveUtmsOnInternalLinks(data) {
    document.querySelectorAll('a[href]').forEach(function (link) {
      var url = sameOriginUrl(link.getAttribute('href'));
      if (!url || url.hash && url.pathname === window.location.pathname) return;

      var changed = false;
      UTM_KEYS.forEach(function (key) {
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

    if (eventName === 'audit_request_submit' && typeof window.fbq === 'function') {
      window.fbq('track', 'Lead', {
        content_name: payload.audit_slug,
        content_category: payload.service_interest
      });
    }

    if (
      eventName === 'audit_request_submit' &&
      typeof window.lintrk === 'function' &&
      window.hbLinkedInLeadConversionId
    ) {
      window.lintrk('track', { conversion_id: window.hbLinkedInLeadConversionId });
    }
  };

  var utms = captureUtms();
  var root = document.querySelector('.hb-audit');
  if (root && root.dataset.utmContent && !utms.utm_content) {
    utms.utm_content = root.dataset.utmContent;
  }
  applyUtms(utms);
  preserveUtmsOnInternalLinks(utms);

  document.querySelectorAll('[data-audit-form]').forEach(function (form) {
    form.addEventListener('submit', function () {
      applyUtms(readStoredUtms());
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
