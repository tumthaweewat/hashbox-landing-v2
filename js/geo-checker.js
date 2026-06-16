/**
 * GEO Readiness Checker — front end.
 * Posts a URL to the hb_geo_check AJAX action and renders the scored
 * checklist. No dependencies. Enqueued only on the tool template.
 */
(function () {
  'use strict';

  var form = document.getElementById('hb-geo-form');
  if (!form || typeof hbGeo === 'undefined') {
    return;
  }

  var input = document.getElementById('hb-geo-url');
  var submit = document.getElementById('hb-geo-submit');
  var result = document.getElementById('hb-geo-result');
  var cta = document.getElementById('hb-geo-cta');

  function esc(s) {
    return String(s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }

  function grade(score) {
    if (score >= 85) return { label: 'พร้อมมาก', cls: 'is-great' };
    if (score >= 65) return { label: 'พอใช้ ปรับได้อีก', cls: 'is-ok' };
    if (score >= 40) return { label: 'ต้องปรับปรุง', cls: 'is-warn' };
    return { label: 'ยังไม่พร้อม', cls: 'is-bad' };
  }

  function render(data) {
    var g = grade(data.score);
    var html = '';

    html += '<div class="hb-geo-score ' + g.cls + '">';
    html += '<div class="hb-geo-score__num">' + data.score + '<span>/100</span></div>';
    html += '<div class="hb-geo-score__meta"><strong>' + esc(g.label) + '</strong>';
    if (data.title) {
      html += '<span class="hb-geo-score__page">' + esc(data.title) + '</span>';
    }
    html += '</div></div>';

    var passed = data.checks.filter(function (c) { return c.pass; });
    var failed = data.checks.filter(function (c) { return !c.pass; });

    if (failed.length) {
      html += '<h3 class="hb-geo-grp">สิ่งที่ควรแก้ (' + failed.length + ')</h3><ul class="hb-geo-list">';
      failed.forEach(function (c) {
        html += '<li class="hb-geo-item is-fail"><span class="hb-geo-item__icon" aria-hidden="true">✕</span>';
        html += '<div><span class="hb-geo-item__label">' + esc(c.label) + '</span>';
        html += '<span class="hb-geo-item__hint">' + esc(c.hint) + '</span></div></li>';
      });
      html += '</ul>';
    }

    if (passed.length) {
      html += '<h3 class="hb-geo-grp">ผ่านแล้ว (' + passed.length + ')</h3><ul class="hb-geo-list">';
      passed.forEach(function (c) {
        html += '<li class="hb-geo-item is-pass"><span class="hb-geo-item__icon" aria-hidden="true">✓</span>';
        html += '<span class="hb-geo-item__label">' + esc(c.label) + '</span></li>';
      });
      html += '</ul>';
    }

    result.innerHTML = html;
    result.hidden = false;
    cta.hidden = false;
    result.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  function setLoading(on) {
    submit.disabled = on;
    submit.textContent = on ? 'กำลังตรวจ…' : 'ตรวจ GEO Readiness';
  }

  function showError(msg) {
    result.innerHTML = '<div class="hb-geo-error">' + esc(msg) + '</div>';
    result.hidden = false;
    cta.hidden = true;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var url = (input.value || '').trim();
    if (!url) {
      input.focus();
      return;
    }
    setLoading(true);
    result.hidden = true;
    cta.hidden = true;

    var body = new URLSearchParams();
    body.set('action', 'hb_geo_check');
    body.set('nonce', hbGeo.nonce);
    body.set('url', url);

    fetch(hbGeo.ajaxurl, { method: 'POST', body: body, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .then(function (json) {
        setLoading(false);
        if (json && json.success) {
          render(json.data);
        } else {
          showError((json && json.data && json.data.message) || 'ตรวจไม่สำเร็จ ลองใหม่อีกครั้ง');
        }
      })
      .catch(function () {
        setLoading(false);
        showError('เกิดข้อผิดพลาดในการเชื่อมต่อ ลองใหม่อีกครั้ง');
      });
  });
})();
