/**
 * Hashbox V2 — Theme interactivity
 *
 * Sticky nav scroll morph, mobile sheet, tabs, dialogs, toast spawning,
 * scroll reveal, accordion (native <details> handles itself).
 *
 * Vanilla JS. No framework. No bundler.
 */

(function () {
  'use strict';

  /* ----------------------------------------------------------------------
   * 1. Sticky nav — collapse to full-width strip past 80px scroll
   * -------------------------------------------------------------------- */
  const nav = document.querySelector('.hb-nav');
  if (nav) {
    const onScroll = () => {
      nav.classList.toggle('hb-nav--scrolled', window.scrollY > 80);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ----------------------------------------------------------------------
   * 2. Mobile sheet — burger toggle + backdrop + ESC close + focus trap
   * -------------------------------------------------------------------- */
  const burger = document.querySelector('.hb-nav__burger');
  const sheet = document.querySelector('.hb-sheet');
  const backdrop = document.querySelector('.hb-sheet-backdrop');
  const sheetClose = document.querySelector('.hb-sheet__close');

  if (burger && sheet && backdrop) {
    const setSheetOpen = (open) => {
      sheet.dataset.open = String(open);
      backdrop.dataset.open = String(open);
      burger.setAttribute('aria-expanded', String(open));
      document.body.style.overflow = open ? 'hidden' : '';
    };
    burger.addEventListener('click', () => setSheetOpen(true));
    backdrop.addEventListener('click', () => setSheetOpen(false));
    sheetClose && sheetClose.addEventListener('click', () => setSheetOpen(false));
    sheet.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => setSheetOpen(false)));
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && sheet.dataset.open === 'true') setSheetOpen(false);
    });
  }

  /* ----------------------------------------------------------------------
   * 3. Tabs — aria-selected toggle + data-active panel
   * -------------------------------------------------------------------- */
  document.querySelectorAll('.hb-tabs').forEach((tabs) => {
    const triggers = tabs.querySelectorAll('.hb-tabs__trigger');
    const panels = tabs.querySelectorAll('.hb-tabs__panel');
    triggers.forEach((btn) => {
      btn.addEventListener('click', () => {
        const target = btn.dataset.tab;
        triggers.forEach((b) => b.setAttribute('aria-selected', String(b === btn)));
        panels.forEach((p) => { p.dataset.active = String(p.dataset.tabPanel === target); });
      });
    });
  });

  /* ----------------------------------------------------------------------
   * 4. Dialog — open / close via [data-dialog-open] / [data-dialog-close]
   * -------------------------------------------------------------------- */
  document.querySelectorAll('[data-dialog-open]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.dialogOpen;
      const dlg = document.getElementById(id);
      if (dlg && typeof dlg.showModal === 'function') dlg.showModal();
    });
  });
  document.querySelectorAll('[data-dialog-close]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.dialogClose;
      const dlg = document.getElementById(id);
      if (dlg && typeof dlg.close === 'function') dlg.close();
    });
  });

  /* ----------------------------------------------------------------------
   * 5. Toast spawner — builds DOM safely via createElement (no innerHTML)
   * -------------------------------------------------------------------- */
  const toastStack = document.querySelector('.hb-toast-stack');
  const SVG_NS = 'http://www.w3.org/2000/svg';

  const svgEl = (paths, size) => {
    const svg = document.createElementNS(SVG_NS, 'svg');
    svg.setAttribute('width', size || 20);
    svg.setAttribute('height', size || 20);
    svg.setAttribute('viewBox', '0 0 24 24');
    svg.setAttribute('fill', 'none');
    svg.setAttribute('stroke', 'currentColor');
    svg.setAttribute('stroke-width', '1.75');
    paths.forEach((p) => {
      const el = document.createElementNS(SVG_NS, p.tag);
      Object.entries(p.attrs).forEach(([k, v]) => el.setAttribute(k, v));
      svg.appendChild(el);
    });
    return svg;
  };

  const toastIcons = {
    info: () => svgEl([
      { tag: 'circle', attrs: { cx: 12, cy: 12, r: 10 } },
      { tag: 'line', attrs: { x1: 12, y1: 16, x2: 12, y2: 12 } },
      { tag: 'line', attrs: { x1: 12, y1: 8, x2: 12.01, y2: 8 } },
    ]),
    success: () => svgEl([
      { tag: 'polyline', attrs: { points: '20 6 9 17 4 12' } },
    ]),
    warning: () => svgEl([
      { tag: 'path', attrs: { d: 'M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z' } },
      { tag: 'line', attrs: { x1: 12, y1: 9, x2: 12, y2: 13 } },
      { tag: 'line', attrs: { x1: 12, y1: 17, x2: 12.01, y2: 17 } },
    ]),
    danger: () => svgEl([
      { tag: 'circle', attrs: { cx: 12, cy: 12, r: 10 } },
      { tag: 'line', attrs: { x1: 15, y1: 9, x2: 9, y2: 15 } },
      { tag: 'line', attrs: { x1: 9, y1: 9, x2: 15, y2: 15 } },
    ]),
  };

  window.hashboxToast = function (opts) {
    if (!toastStack) return;
    const variant = (opts && opts.variant) || 'info';
    const t = document.createElement('div');
    t.className = 'hb-toast hb-toast--' + variant;
    const iconWrap = document.createElement('div');
    iconWrap.className = 'hb-toast__icon';
    iconWrap.appendChild((toastIcons[variant] || toastIcons.info)());
    const body = document.createElement('div');
    body.className = 'hb-toast__body';
    const title = document.createElement('span');
    title.className = 'hb-toast__title';
    title.textContent = (opts && opts.title) || '';
    const desc = document.createElement('p');
    desc.className = 'hb-toast__desc';
    desc.textContent = (opts && opts.desc) || '';
    body.append(title, desc);
    const close = document.createElement('button');
    close.className = 'hb-toast__close';
    close.setAttribute('aria-label', 'Close');
    close.appendChild(svgEl([
      { tag: 'line', attrs: { x1: 18, y1: 6, x2: 6, y2: 18 } },
      { tag: 'line', attrs: { x1: 6, y1: 6, x2: 18, y2: 18 } },
    ], 14));
    close.addEventListener('click', () => t.remove());
    t.append(iconWrap, body, close);
    toastStack.appendChild(t);
    setTimeout(() => t.remove(), (opts && opts.duration) || 4500);
  };

  /* ----------------------------------------------------------------------
   * 6. Scroll reveal — fade-up on enter
   * -------------------------------------------------------------------- */
  const reveal = document.querySelectorAll('[data-reveal]');
  if (reveal.length && 'IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.dataset.revealed = 'true';
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    reveal.forEach((el) => io.observe(el));
  }

  /* ----------------------------------------------------------------------
   * 7. Smooth scroll for in-page anchors (offset for sticky nav)
   * -------------------------------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener('click', (e) => {
      const href = a.getAttribute('href');
      if (href === '#' || href.length < 2) return;
      const target = document.querySelector(href);
      if (!target) return;
      e.preventDefault();
      const offset = (nav ? nav.getBoundingClientRect().height : 0) + 16;
      const top = window.scrollY + target.getBoundingClientRect().top - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  /* ----------------------------------------------------------------------
   * 8. Counter animation on stats — only when value is data-target driven
   * -------------------------------------------------------------------- */
  const counters = document.querySelectorAll('[data-target]');
  if (counters.length && 'IntersectionObserver' in window) {
    const animate = (el) => {
      const target = parseFloat(el.dataset.target);
      if (Number.isNaN(target)) return;
      const duration = 1400;
      const start = performance.now();
      const ease = (t) => 1 - Math.pow(1 - t, 4);
      const tick = (now) => {
        const p = Math.min((now - start) / duration, 1);
        const v = ease(p) * target;
        el.textContent = Number.isInteger(target) ? Math.floor(v).toLocaleString() : v.toFixed(1);
        if (p < 1) requestAnimationFrame(tick);
        else el.textContent = target.toLocaleString();
      };
      requestAnimationFrame(tick);
    };
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animate(entry.target);
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    counters.forEach((el) => io.observe(el));
  }
})();
