(function () {
  'use strict';

  function isLineUrl(value) {
    try {
      var url = new URL(value, window.location.href);
      return /(^|\.)line\.me$/i.test(url.hostname) || /(^|\.)lin\.ee$/i.test(url.hostname);
    } catch (error) {
      return false;
    }
  }

  function transactionId() {
    if (window.crypto && typeof window.crypto.randomUUID === 'function') {
      return 'HB-LINE-' + window.crypto.randomUUID();
    }
    return 'HB-LINE-' + Date.now() + '-' + Math.random().toString(36).slice(2, 12);
  }

  document.addEventListener('click', function (event) {
    var link = event.target && event.target.closest ? event.target.closest('a[href]') : null;
    if (!link || !isLineUrl(link.href)) return;

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      event: 'line_oa_click',
      hb_schema_version: 1,
      hb_transaction_id: transactionId(),
      hb_link_url: link.href,
      hb_page_path: window.location.pathname,
      hb_cta_location: link.closest('header') ? 'header' : (link.closest('footer') ? 'footer' : 'page')
    });
  }, true);
})();
