/** English SEO form: native POST delivery, inline feedback and attributed confirmation. */
(function () {
  'use strict';
  var form = document.querySelector('form[data-en-seo-contact]');
  if (!form) return;

  var status = document.getElementById('en-seo-contact-status');
  var submit = form.querySelector('[data-en-seo-submit]');
  var submitLabel = submit.querySelector('span');
  var defaultLabel = submitLabel.textContent;
  var fields = ['name', 'email', 'website', 'message'];
  var attributionKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid'];
  var draftKey = 'hashbox_en_seo_contact_draft';
  var attributionKey = 'hashbox_en_seo_attribution';
  var pending = false;
  var ready = false;
  var touched = {};
  var validationNames = ['name', 'email', 'website', 'pdpa'];
  var state = form.dataset.status;
  form.noValidate = true;
  // Prepare the nonce before emitting a submit event. Collected-form services
  // see a single final native submission, not an intercepted event plus replay.
  submit.type = 'button';

  function storageRead(key) {
    try { return JSON.parse(window.sessionStorage.getItem(key) || 'null'); } catch (error) { return null; }
  }
  function storageWrite(key, value) {
    try { window.sessionStorage.setItem(key, JSON.stringify(value)); } catch (error) {}
  }
  function storageRemove(key) {
    try { window.sessionStorage.removeItem(key); } catch (error) {}
  }
  function showStatus(message, nextState) {
    form.dataset.status = nextState || 'error';
    status.textContent = message;
    status.hidden = false;
    status.focus({ preventScroll: true });
  }
  function setBusy(busy) {
    pending = busy;
    submit.disabled = busy;
    form.setAttribute('aria-busy', busy ? 'true' : 'false');
    submitLabel.textContent = busy ? 'Sending your request…' : defaultLabel;
  }
  function fieldError(field, message) {
    field.setAttribute('aria-invalid', message ? 'true' : 'false');
    var node = document.getElementById(field.id + '-error');
    if (node) node.textContent = message;
  }
  function websiteValue(value) {
    try {
      var raw = value.trim();
      if (!raw || /\s/.test(raw)) return '';
      var url = new URL(/^[a-z][a-z\d+.-]*:/i.test(raw) ? raw : 'https://' + raw);
      if (!/^https?:$/.test(url.protocol) || url.hostname.indexOf('.') === -1 || url.username || url.password || /(^|\.)(facebook\.com|fb\.com)$/i.test(url.hostname)) return '';
      return url.href;
    } catch (error) { return ''; }
  }
  function validate() {
    var first = null;
    validationNames.forEach(function (name) {
      var field = form.elements[name];
      touched[name] = true;
      if (!validateField(field) && !first) first = field;
    });
    if (first) {
      form.dataset.status = 'invalid';
      first.focus();
    }
    return !first;
  }
  function validateField(field) {
    var message = '';
    if (field.name === 'name' && !field.value.trim()) message = 'Please enter your name.';
    if (field.name === 'email' && (!field.value.trim() || !field.validity.valid)) message = 'Please enter a valid email address.';
    if (field.name === 'website' && !websiteValue(field.value)) message = 'Enter your website address, for example example.com.';
    if (field.name === 'pdpa' && !field.checked) message = 'Please confirm that we may contact you about this request.';
    fieldError(field, message);
    return !message;
  }
  function saveDraft() {
    var values = {};
    fields.forEach(function (name) { values[name] = form.elements[name].value; });
    storageWrite(draftKey, { savedAt: Date.now(), values: values });
  }
  function attribution() {
    var params = new URLSearchParams(window.location.search);
    var stored = storageRead(attributionKey);
    var values = stored && Date.now() - stored.savedAt < 30 * 60 * 1000 ? stored.values : {};
    var incoming = {};
    attributionKeys.forEach(function (key) { if (params.get(key)) incoming[key] = params.get(key).slice(0, 500); });
    if (Object.keys(incoming).length) values = incoming;
    attributionKeys.forEach(function (key) {
      var field = form.querySelector('input[name="' + key + '"]');
      if (!field) {
        field = document.createElement('input');
        field.type = 'hidden';
        field.name = key;
        form.appendChild(field);
      }
      field.value = values[key] || '';
    });
    storageWrite(attributionKey, { savedAt: Date.now(), values: values });
  }
  attribution();

  if (state === 'sent') {
    storageRemove(draftKey);
    var receipt = form.dataset.confirmedReceipt || '';
    if (/^[a-f0-9]{32}$/.test(receipt)) {
      var trackedKey = 'hashbox_en_seo_confirmed_' + receipt;
      window.dataLayer = window.dataLayer || [];
      if (!storageRead(trackedKey)) {
        var track = typeof window.gtag === 'function' ? window.gtag : function () { window.dataLayer.push(arguments); };
        // The receipt is only a same-tab deduplication key. No form values or
        // receipt IDs enter analytics, and SEO leads are not Website Ads leads.
        track('event', 'generate_lead', {
          // Match the current shared lead pipeline: GTM configures GA4 async.
          send_to: 'G-WQ4CG18QQT',
          form_id: 'en-seo-contact-form',
          form_name: 'Technical SEO audit (English)',
          lead_source: 'en_seo'
        });
        storageWrite(trackedKey, true);
      }
    }
  } else if (state === 'invalid' || state === 'error') {
    var draft = storageRead(draftKey);
    if (draft && Date.now() - draft.savedAt < 30 * 60 * 1000 && draft.values) {
      fields.forEach(function (name) {
        if (typeof draft.values[name] === 'string') form.elements[name].value = draft.values[name];
      });
    } else storageRemove(draftKey);
  }
  if (state) status.focus({ preventScroll: true });

  form.addEventListener('blur', function (event) {
    var field = event.target;
    if (validationNames.indexOf(field.name) === -1) return;
    touched[field.name] = true;
    validateField(field);
  }, true);
  form.addEventListener('input', function (event) {
    if (touched[event.target.name]) validateField(event.target);
  });
  form.addEventListener('change', function (event) {
    if (touched[event.target.name]) validateField(event.target);
  });
  function prepareSubmission() {
    if (pending) return;
    status.hidden = true;
    form.dataset.status = '';
    if (!validate()) return;
    form.elements.website.value = websiteValue(form.elements.website.value);
    saveDraft();
    attribution();
    setBusy(true);
    var data = new URLSearchParams({ action: 'hashbox_en_seo_contact_nonce' });
    var controller = new AbortController();
    var timeout = window.setTimeout(function () { controller.abort(); }, 12000);
    fetch(form.dataset.nonceUrl, {
      method: 'POST', credentials: 'same-origin', cache: 'no-store', body: data, signal: controller.signal
    }).then(function (response) {
      if (!response.ok) throw new Error('nonce');
      return response.json();
    }).then(function (result) {
      if (!result.success || !result.data || typeof result.data.nonce !== 'string') throw new Error('nonce');
      form.elements.hashbox_nonce.value = result.data.nonce;
      ready = true;
      // Exactly one submit event; click and Enter preparation emit none.
      form.requestSubmit();
    }).catch(function () {
      ready = false;
      setBusy(false);
      showStatus('We could not connect. Your details are still here. Please try again, or email business@hashbox.co.th.', 'error');
    }).finally(function () {
      window.clearTimeout(timeout);
    });
  }
  submit.addEventListener('click', prepareSubmission);
  form.addEventListener('keydown', function (event) {
    if (event.key === 'Enter' && !event.isComposing && event.target.tagName === 'INPUT'
        && event.target.type !== 'checkbox') {
      event.preventDefault();
      prepareSubmission();
    }
  });
  form.addEventListener('submit', function (event) {
    if (ready && validate()) return;
    event.preventDefault();
    if (ready) { ready = false; setBusy(false); }
    if (!pending) prepareSubmission();
  });
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) { ready = false; setBusy(false); }
  });
})();
