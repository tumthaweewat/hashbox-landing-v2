/**
 * Website Audit attribution + confirmed conversion tracking.
 *
 * The WordPress page body is managed in the editor, so this runtime injects
 * correlation and attribution fields without coupling them to page content.
 */
(function () {
  'use strict';

  var ATTRIBUTION_KEYS = [
    'utm_source',
    'utm_medium',
    'utm_campaign',
    'utm_content',
    'utm_term',
    'gclid',
    'wbraid',
    'gbraid'
  ];
  var CLICK_ID_KEYS = ['gclid', 'wbraid', 'gbraid'];
  var STORAGE_KEY = 'hashbox_attribution_v3_website_audit';
  var STORAGE_TTL_MS = 90 * 24 * 60 * 60 * 1000;
  var ANALYTICS_STATE_PREFIX = 'hashbox_website_audit_analytics_';
  var CONVERSION_STATE_PREFIX = 'hashbox_website_audit_conversion_';
  var META_STATE_PREFIX = 'hashbox_website_audit_meta_';
  var UUID_V4_PATTERN = /^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i;
  var WEB_CONVERSION_REF_PATTERN = /^HB-WEB-[0-9]{8}-[0-9]{9,40}$/;
  var config = window.hashboxWebsiteAuditTracking || {};
  var form = document.querySelector('form[data-hb5-form]');

  if (!form) return;

  function readStoredAttribution() {
    try {
      var raw = window.localStorage.getItem(STORAGE_KEY);
      if (!raw) return { data: {}, identity: '' };

      var record = JSON.parse(raw);
      var capturedAt = Number(record && record.capturedAt) || 0;
      if (!record || record.version !== 3 || !record.data || !capturedAt || Date.now() - capturedAt > STORAGE_TTL_MS) {
        window.localStorage.removeItem(STORAGE_KEY);
        return { data: {}, identity: '' };
      }

      var data = {};
      ATTRIBUTION_KEYS.forEach(function (key) {
        if (typeof record.data[key] === 'string' && record.data[key]) {
          data[key] = record.data[key];
        }
      });
      return { data: data, identity: typeof record.identity === 'string' ? record.identity : '' };
    } catch (err) {
      return { data: {}, identity: '' };
    }
  }

  function attributionIdentity(data) {
    var clickIdentity = '';
    CLICK_ID_KEYS.some(function (key) {
      if (!data[key]) return false;
      clickIdentity = 'click:' + key + ':' + data[key];
      return true;
    });
    if (clickIdentity) return clickIdentity;

    var campaign = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content'].map(function (key) {
      return data[key] || '';
    });
    return campaign.some(Boolean) ? 'utm:' + campaign.join('|') : '';
  }

  function captureAttribution() {
    var stored = readStoredAttribution();
    var params = new URLSearchParams(window.location.search);
    var incoming = {};
    var found = false;

    ATTRIBUTION_KEYS.forEach(function (key) {
      var value = params.get(key);
      if (!value) return;
      incoming[key] = value;
      found = true;
    });

    if (!found) return stored.data;

    var incomingIdentity = attributionIdentity(incoming);
    var next = incomingIdentity && stored.identity && incomingIdentity !== stored.identity
      ? {}
      : Object.assign({}, stored.data);

    ATTRIBUTION_KEYS.forEach(function (key) {
      if (incoming[key]) next[key] = incoming[key];
    });

    try {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify({
        version: 3,
        capturedAt: Date.now(),
        identity: incomingIdentity || stored.identity,
        data: next
      }));
    } catch (err) {}

    return next;
  }

  function ensureHiddenField(name) {
    var field = form.querySelector('input[name="' + name + '"]');
    if (field) return field;

    field = document.createElement('input');
    field.type = 'hidden';
    field.name = name;
    field.setAttribute('data-hashbox-tracking-field', name);
    form.appendChild(field);
    return field;
  }

  function applyAttribution(data) {
    ATTRIBUTION_KEYS.forEach(function (key) {
      ensureHiddenField(key).value = data[key] || '';
    });
  }

  function pushDiagnosticEvent(eventName, fields) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(assign({
      event: eventName,
      hb_schema_version: 1,
      hb_lead_source: 'website_audit'
    }, fields || {}));
  }

  function closestFormField(control) {
    var node = control;
    while (node && node !== form) {
      if ((' ' + (node.className || '') + ' ').indexOf(' hb5-field ') !== -1) return node;
      node = node.parentNode;
    }
    return null;
  }

  function initDiagnosticEvents() {
    var formStarted = false;
    var validationReported = false;

    function markFormStart() {
      if (formStarted) return;
      formStarted = true;
      pushDiagnosticEvent('hb_web_form_start_v1', { hb_form_step: 1 });
    }

    form.addEventListener('input', markFormStart, { once: true });
    form.addEventListener('change', markFormStart, { once: true });
    form.addEventListener('invalid', function (event) {
      if (validationReported) return;
      validationReported = true;
      pushDiagnosticEvent('hb_web_form_validation_error_v1', {
        hb_field_name: event && event.target && event.target.name
          ? String(event.target.name)
          : 'unknown'
      });
      window.setTimeout(function () { validationReported = false; }, 1000);
    }, true);
    form.addEventListener('submit', function (event) {
      if (event.defaultPrevented) return;
      pushDiagnosticEvent('hb_web_form_submit_attempt_v1', { hb_form_step: 1 });
    });

    if (typeof document.querySelectorAll !== 'function') return;
    Array.prototype.forEach.call(document.querySelectorAll('a[href*="#project-form"]'), function (link) {
      link.addEventListener('click', function () {
        pushDiagnosticEvent('hb_web_cta_click_v1', {
          hb_cta_location: link.closest && link.closest('.hb5-mobile') ? 'mobile_sticky' : 'page'
        });
      });
    });
    function trackOutboundClick(link, eventName) {
      link.addEventListener('click', function (event) {
        var location = link.closest && link.closest('.hb5-mobile') ? 'mobile_sticky' : 'page';
        var opensNewContext = link.target === '_blank' || event.metaKey || event.ctrlKey || event.shiftKey || event.button === 1;
        if (opensNewContext) {
          pushDiagnosticEvent(eventName, { hb_cta_location: location });
          return;
        }
        // Same-tab navigation: give GTM a short, bounded window to flush the
        // event, then open the original link directly (no redirect hop).
        event.preventDefault();
        var released = false;
        function release() {
          if (released) return;
          released = true;
          window.location.href = link.href;
        }
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push(assign({
          event: eventName,
          hb_schema_version: 1,
          hb_lead_source: 'website_audit',
          hb_cta_location: location,
          eventCallback: release,
          eventTimeout: 400
        }, {}));
        window.setTimeout(release, 450);
      });
    }
    Array.prototype.forEach.call(document.querySelectorAll('.hb5 a[href*="lin.ee"], .hb5 a[href*="line.me"]'), function (link) {
      trackOutboundClick(link, 'hb_web_line_click_v1');
    });
    Array.prototype.forEach.call(document.querySelectorAll('.hb5 a[href^="tel:"]'), function (link) {
      trackOutboundClick(link, 'hb_web_phone_click_v1');
    });
  }

  function initConversionForm() {
    var grid = form.querySelector('.hb5-form-grid');
    if (!grid || grid.getAttribute('data-hb5-cro-ready') === '1') return;

    // Funnel V2: single-step form. Only contact essentials stay required;
    // qualification fields move behind an optional disclosure. Server-side
    // validation in functions.php enforces the same contract.
    var contactNames = ['name', 'email', 'contact_detail'];
    var optionalNames = ['project_type', 'budget', 'timeline', 'company', 'website', 'message'];
    var contactFields = [];
    var optionalFields = [];

    function fieldFor(name) {
      var control = form.querySelector('[name="' + name + '"]');
      return control ? closestFormField(control) : null;
    }

    contactNames.forEach(function (name) {
      var field = fieldFor(name);
      if (field) contactFields.push(field);
    });
    optionalNames.forEach(function (name) {
      var field = fieldFor(name);
      if (field) optionalFields.push(field);
    });

    var consent = form.querySelector('.hb5-consent');
    var status = form.querySelector('[data-hb5-status]');
    var submit = form.querySelector('[data-hb5-submit]');
    if (contactFields.length !== contactNames.length || !consent || !status || !submit) {
      return;
    }

    optionalNames.forEach(function (name) {
      var control = form.querySelector('[name="' + name + '"]');
      if (control) control.required = false;
    });

    var emailLabel = form.querySelector('label[for="hb5-email"]');
    if (emailLabel) emailLabel.textContent = 'อีเมลที่สะดวกให้ติดต่อกลับ *';
    submit.textContent = 'รับ Scope + ราคาฟรี';

    var main = document.createElement('fieldset');
    main.className = 'hb5-form-step';
    var legend = document.createElement('legend');
    legend.className = 'hb5-form-step__legend';
    legend.textContent = 'ข้อมูลสำหรับติดต่อกลับ';
    main.appendChild(legend);
    contactFields.forEach(function (field) { main.appendChild(field); });

    var optional = document.createElement('details');
    optional.className = 'hb5-optional';
    var optionalSummary = document.createElement('summary');
    optionalSummary.textContent = 'เพิ่มข้อมูลโปรเจกต์ (ไม่บังคับ)';
    var optionalBody = document.createElement('div');
    optionalBody.className = 'hb5-optional__fields';
    optionalFields.forEach(function (field) { optionalBody.appendChild(field); });
    optional.appendChild(optionalSummary);
    optional.appendChild(optionalBody);
    main.appendChild(optional);
    main.appendChild(consent);
    main.appendChild(status);

    var submitActions = document.createElement('div');
    submitActions.className = 'hb5-step-actions hb5-step-actions--submit';
    submitActions.appendChild(submit);
    main.appendChild(submitActions);

    grid.appendChild(main);
    grid.setAttribute('data-hb5-cro-ready', '1');
  }

  function setFormReady(nonceValue, message) {
    var nonce = form.querySelector('input[name="hashbox_nonce"]');
    var submit = form.querySelector('[data-hb5-submit]');
    var status = form.querySelector('[data-hb5-status]');

    if (nonce && nonceValue && !nonce.value) nonce.value = nonceValue;
    if (submit && nonce && nonce.value) submit.disabled = false;
    if (status && message) {
      status.textContent = message;
      status.dataset.state = nonce && nonce.value ? 'success' : 'error';
    }
  }

  function showPreparationError() {
    var submit = form.querySelector('[data-hb5-submit]');
    var status = form.querySelector('[data-hb5-status]');
    if (submit) submit.disabled = true;
    if (status) {
      status.textContent = 'ระบบรับข้อมูลยังไม่พร้อม กรุณารีเฟรชหน้าแล้วลองอีกครั้ง';
      status.dataset.state = 'error';
    }
  }

  function prepareLead() {
    if (!config.prepareUrl || !config.prepareAction || typeof window.fetch !== 'function') {
      showPreparationError();
      return;
    }

    var body = new URLSearchParams();
    body.set('action', config.prepareAction);
    var controller = typeof window.AbortController === 'function' ? new window.AbortController() : null;
    var settled = false;
    var timeout = window.setTimeout(function () {
      if (settled) return;
      showPreparationError();
      if (controller) controller.abort();
    }, 5000);

    window.fetch(config.prepareUrl, {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
      body: body.toString(),
      signal: controller ? controller.signal : undefined
    })
      .then(function (response) {
        if (!response.ok) throw new Error('prepare');
        return response.json();
      })
      .then(function (payload) {
        var data = payload && payload.success && payload.data ? payload.data : null;
        if (!data || !UUID_V4_PATTERN.test(data.lead_ref || '') || !data.nonce) throw new Error('payload');

        ensureHiddenField('lead_ref').value = data.lead_ref;
        setFormReady(data.nonce, 'ข้อมูลจะถูกส่งอย่างปลอดภัยไปยังทีม Hashbox');
      })
      .catch(function () {
        showPreparationError();
      })
      .then(function () {
        settled = true;
        window.clearTimeout(timeout);
      });
  }

  function conversionAlreadyDelivered(leadRef) {
    try {
      return window.localStorage.getItem(CONVERSION_STATE_PREFIX + leadRef) === 'delivered';
    } catch (err) {
      return false;
    }
  }

  function analyticsAlreadyQueued(leadRef) {
    if (window.hashboxWebsiteAuditAnalyticsLeadRef === leadRef) return true;
    try {
      if (window.localStorage.getItem(ANALYTICS_STATE_PREFIX + leadRef) === 'queued') return true;
    } catch (err) {}
    try {
      return window.sessionStorage.getItem(ANALYTICS_STATE_PREFIX + leadRef) === 'queued';
    } catch (err) {
      return false;
    }
  }

  function markAnalyticsQueued(leadRef) {
    window.hashboxWebsiteAuditAnalyticsLeadRef = leadRef;
    try {
      window.localStorage.setItem(ANALYTICS_STATE_PREFIX + leadRef, 'queued');
    } catch (err) {}
    try {
      window.sessionStorage.setItem(ANALYTICS_STATE_PREFIX + leadRef, 'queued');
    } catch (err) {}
  }

  function markConversionDelivered(leadRef) {
    try {
      window.localStorage.setItem(CONVERSION_STATE_PREFIX + leadRef, 'delivered');
    } catch (err) {}
  }

  function metaAlreadyQueued(leadRef) {
    try {
      return window.localStorage.getItem(META_STATE_PREFIX + leadRef) === 'queued';
    } catch (err) {
      return false;
    }
  }

  function markMetaQueued(leadRef) {
    try {
      window.localStorage.setItem(META_STATE_PREFIX + leadRef, 'queued');
    } catch (err) {}
  }

  function cleanSuccessParams() {
    var cleanUrl = new URL(window.location.href);
    cleanUrl.searchParams.delete('contact');
    cleanUrl.searchParams.delete('lead_ref');
    cleanUrl.searchParams.delete('lead_sig');
    window.history.replaceState(
      {},
      '',
      cleanUrl.pathname + (cleanUrl.searchParams.toString() ? '?' + cleanUrl.searchParams.toString() : '') + cleanUrl.hash
    );
  }

  function finishConfirmedLead(leadRef) {
    if (!window.hashboxWebsiteAuditMetaLeadSent && typeof window.fbq === 'function') {
      window.fbq(
        'track',
        'Lead',
        { content_name: 'Website Project Evaluation' },
        { eventID: leadRef }
      );
      window.hashboxWebsiteAuditMetaLeadSent = true;
    }
    if (window.hashboxWebsiteAuditMetaLeadSent) markMetaQueued(leadRef);
  }

  function scheduleConfirmedLeadFinish(leadRef) {
    if (metaAlreadyQueued(leadRef)) window.hashboxWebsiteAuditMetaLeadSent = true;
    window.addEventListener('hashbox:third-party-ready', function () {
      finishConfirmedLead(leadRef);
    }, { once: true });
    // Logged-in sessions do not use the delayed loader, so give Meta one more
    // chance here. Google Ads still owns URL cleanup through its callback so a
    // blocked request can retry the same deduped transaction on reload.
    window.setTimeout(function () { finishConfirmedLead(leadRef); }, 8000);
  }

  function confirmedLead() {
    var meta = document.querySelector('meta[name="hashbox-confirmed-website-lead"]');
    var params = new URLSearchParams(window.location.search);
    var leadRef = params.get('contact') === 'sent'
      ? params.get('lead_ref') || ''
      : window.hashboxConfirmedWebsiteLeadRef || '';
    if (!meta || !UUID_V4_PATTERN.test(leadRef) || meta.getAttribute('content') !== leadRef) return null;
    var conversionRef = meta.getAttribute('data-conversion-ref') || '';
    return {
      leadRef: leadRef,
      conversionRef: WEB_CONVERSION_REF_PATTERN.test(conversionRef) && conversionRef.length <= 64
        ? conversionRef
        : ''
    };
  }

  function renderSuccessState() {
    Array.prototype.forEach.call(form.elements || [], function (control) {
      control.disabled = true;
    });
    Array.prototype.forEach.call(form.querySelectorAll('.hb5-field, .hb5-consent'), function (field) {
      field.hidden = true;
    });

    var submit = form.querySelector('[data-hb5-submit]');
    var status = form.querySelector('[data-hb5-status]');
    form.dataset.state = 'success';
    form.setAttribute('aria-disabled', 'true');
    if (submit) {
      submit.disabled = true;
      submit.textContent = 'ส่งข้อมูลเรียบร้อยแล้ว';
    }
    if (status) {
      status.textContent = 'ส่งข้อมูลเรียบร้อยแล้ว ทีม Hashbox จะติดต่อกลับโดยเร็วที่สุด';
      status.dataset.state = 'success';
    }
  }

  function queueConfirmedConversion(leadRef, conversionRef) {
    // Claim the legacy page-builder conversion flag before DOMContentLoaded so
    // the unsigned contact=sent handler cannot send a duplicate event.
    window.hashboxGa4LeadSent = true;

    if (conversionAlreadyDelivered(leadRef)) {
      scheduleConfirmedLeadFinish(leadRef);
      cleanSuccessParams();
      return;
    }

    // GTM (GTM-5G2P48V2) owns Google tagging. This runtime only pushes two
    // namespaced dataLayer events for the signed success state:
    //   hb_web_ga4_lead_v1 — GA4 generate_lead, queued once per lead
    //   hb_web_ads_lead_v1 — Ads conversion, retried on reload until GTM
    //                        confirms delivery through eventCallback
    // No PII and no UUID lead_ref ever enter the dataLayer; Google receives
    // only the scoped HB-WEB-* transaction id.
    window.dataLayer = window.dataLayer || [];
    var payload = {
      hb_schema_version: 1,
      hb_transaction_id: conversionRef,
      hb_value: 1,
      hb_currency: 'THB',
      hb_form_id: 'hashbox_contact',
      hb_form_name: 'Website Project Evaluation',
      hb_lead_source: 'website_audit'
    };

    if (!analyticsAlreadyQueued(leadRef)) {
      window.dataLayer.push(assign({ event: 'hb_web_ga4_lead_v1' }, payload));
      markAnalyticsQueued(leadRef);
    }

    var deliveryRecorded = false;
    function recordDelivery() {
      if (deliveryRecorded) return;
      deliveryRecorded = true;
      markConversionDelivered(leadRef);
      cleanSuccessParams();
    }
    window.dataLayer.push(assign({
      event: 'hb_web_ads_lead_v1',
      eventCallback: recordDelivery,
      eventTimeout: 6000
    }, payload));

    scheduleConfirmedLeadFinish(leadRef);
  }

  function assign(target, source) {
    for (var key in source) {
      if (Object.prototype.hasOwnProperty.call(source, key)) target[key] = source[key];
    }
    return target;
  }

  var attribution = captureAttribution();
  applyAttribution(attribution);

  var submitting = false;
  form.addEventListener('submit', function (event) {
    if (event.defaultPrevented) return;
    applyAttribution(captureAttribution());
    var preparedLead = form.querySelector('input[name="lead_ref"]');
    if (!preparedLead || !UUID_V4_PATTERN.test(preparedLead.value || '')) {
      event.preventDefault();
      showPreparationError();
      return;
    }
    if (submitting) {
      event.preventDefault();
      return;
    }
    submitting = true;
    var submit = form.querySelector('[data-hb5-submit]');
    var status = form.querySelector('[data-hb5-status]');
    if (submit) submit.disabled = true;
    if (status) {
      status.textContent = 'กำลังส่งข้อมูล…';
      status.dataset.state = 'loading';
    }
  });

  var params = new URLSearchParams(window.location.search);
  var confirmation = confirmedLead();
  initDiagnosticEvents();
  if (!confirmation) initConversionForm();
  if (confirmation) {
    renderSuccessState();
    if (confirmation.conversionRef) {
      queueConfirmedConversion(confirmation.leadRef, confirmation.conversionRef);
    } else {
      // Preserve legacy signed success UX without reusing a UUID as Google's
      // transaction ID or reviving an already-completed conversion.
      window.hashboxGa4LeadSent = true;
      window.hashboxWebsiteAuditMetaLeadSent = true;
      cleanSuccessParams();
    }
  } else if (params.get('contact') === 'sent') {
    // An unsigned success URL must not trigger the legacy Google or Meta lead
    // handlers even if the visitor interacts and delayed scripts later load.
    window.hashboxGa4LeadSent = true;
    window.hashboxWebsiteAuditMetaLeadSent = true;
    cleanSuccessParams();
    prepareLead();
  } else {
    prepareLead();
  }
})();
