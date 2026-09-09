/** Homepage attribution and server-confirmed lead event. GTM owns Google tags. */
(function () {
  'use strict';
  var config = window.hashboxHomeLeads || {};
  var keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid'];
  var storeKey = 'hb_home_attribution_v1';
  var params = new URLSearchParams(window.location.search);
  var record = {};
  try { record = JSON.parse(window.sessionStorage.getItem(storeKey) || '{}'); } catch (e) { /* Storage is optional. */ }
  if (!record || typeof record !== 'object' || !record.time || Date.now() - record.time > 30 * 60 * 1000) record = {};
  record.entry_path = record.entry_path || window.location.pathname;
  if (/^\/(?:en\/)?services\//.test(window.location.pathname)) record.service_path = window.location.pathname;
  // Replace the campaign as a unit: never attach an earlier ad's click ID to a new campaign.
  if (keys.some(function (key) { return params.has(key) && params.get(key); })) {
    record.campaign = {};
    keys.forEach(function (key) { record.campaign[key] = (params.get(key) || '').slice(0, 512); });
  }
  record.time = Date.now();
  try { window.sessionStorage.setItem(storeKey, JSON.stringify(record)); } catch (e) { /* Keep current-page attribution. */ }

  var form = document.getElementById('homepage-contact');
  if (!form) return;
  function hidden(name, value) {
    var input = form.querySelector('input[name="' + name + '"]');
    if (!input) {
      input = document.createElement('input');
      input.type = 'hidden'; input.name = name; form.appendChild(input);
    }
    input.value = value || '';
  }
  keys.forEach(function (key) { hidden(key, (record.campaign || {})[key]); });
  hidden('entry_path', record.entry_path);
  hidden('service_path', record.service_path);
  hidden('submission_path', window.location.pathname);

  var receipt = config.receipt || {};
  var ref = receipt.conversion_ref;
  if (receipt.status === 'sent' && /^HB-HOME-[0-9]{8}-[0-9]{9,40}$/.test(ref || '')) {
    var dedupKey = 'hb_home_queued_' + ref;
    var queued = false;
    try { queued = !!window.localStorage.getItem(dedupKey); } catch (e) { /* URL cleanup still protects refresh. */ }
    if (!queued) {
      // This records queueing, not delivery. Consent / blockers can prevent Google delivery.
      try { window.localStorage.setItem(dedupKey, String(Date.now())); } catch (e) { /* Best effort. */ }
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({
        event: 'hb_home_lead_v1',
        hb_schema_version: 1,
        hb_transaction_id: ref,
        hb_form_id: 'homepage-contact',
        hb_services: Array.isArray(receipt.services) ? receipt.services.join(',') : '',
        hb_request_intent: receipt.intent,
        hb_lead_source: 'homepage'
      });
    }
    // Keep the visible success message, but remove the receipt capability from the URL.
    var clean = new URL(window.location.href);
    ['lead_ref', 'lead_sig', 'contact'].forEach(function (key) { clean.searchParams.delete(key); });
    window.history.replaceState(window.history.state, '', clean.pathname + clean.search + clean.hash);
  }

  var preparing = false;
  var prepared = false;
  var submitting = false;
  var submit = form.querySelector('[type="submit"]');
  var status = document.createElement('p');
  status.setAttribute('role', 'status');
  status.setAttribute('aria-live', 'polite');
  form.appendChild(status);
  form.addEventListener('submit', function (event) {
    // v2.js validation runs first (this script depends on it).
    if (event.defaultPrevented) return;
    if (submitting || preparing) { event.preventDefault(); return; }
    if (prepared) {
      submitting = true;
      submit.disabled = true;
      status.textContent = 'กำลังส่งข้อมูล…';
      return;
    }
    event.preventDefault();
    preparing = true;
    submit.disabled = true;
    status.textContent = 'กำลังเตรียมส่งข้อมูล…';
    var controller = new AbortController();
    var timeout = window.setTimeout(function () { controller.abort(); }, 15000);
    fetch(config.ajaxUrl, {
      method: 'POST', credentials: 'same-origin', signal: controller.signal,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'action=hashbox_prepare_home_lead'
    }).then(function (response) {
      if (!response.ok) throw new Error('prepare');
      return response.json();
    }).then(function (result) {
      if (!result.success || !result.data || !/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i.test(result.data.lead_ref) || !result.data.nonce) throw new Error('prepare');
      hidden('lead_ref', result.data.lead_ref);
      hidden('hashbox_nonce', result.data.nonce);
      hidden('home_tracking_version', '1');
      prepared = true; preparing = false; submit.disabled = false;
      form.requestSubmit(submit);
    }).catch(function () {
      preparing = false; submit.disabled = false;
      status.textContent = 'ยังส่งข้อมูลไม่ได้ กรุณาลองอีกครั้ง หรือคุยกับทีมทาง LINE OA';
    }).finally(function () { window.clearTimeout(timeout); });
  });
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      // Reuse the ref after Back: the server recognizes a replay of an accepted POST.
      submitting = false; preparing = false; submit.disabled = false; status.textContent = '';
    }
  });
})();
