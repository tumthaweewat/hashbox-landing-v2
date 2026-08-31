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
    let scrolled = false;
    let ticking = false;
    const applyScrollState = () => {
      const next = window.scrollY > 80;
      if (next !== scrolled) {
        scrolled = next;
        nav.classList.toggle('hb-nav--scrolled', scrolled);
      }
      ticking = false;
    };
    const onScroll = () => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(applyScrollState);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    applyScrollState();
  }

  /* ----------------------------------------------------------------------
   * 2. Mobile sheet — burger toggle + backdrop + ESC close + focus trap
   * -------------------------------------------------------------------- */
  const burger = document.querySelector('.hb-nav__burger');
  const navBrand = document.querySelector('.hb-nav__brand[href]');
  const sheet = document.querySelector('.hb-sheet');
  const backdrop = document.querySelector('.hb-sheet-backdrop');
  const sheetClose = document.querySelector('.hb-sheet__close');

  if (burger && sheet && backdrop) {
    const focusableSelector = [
      'a[href]',
      'button:not([disabled])',
      'input:not([disabled])',
      'select:not([disabled])',
      'textarea:not([disabled])',
      '[tabindex]:not([tabindex="-1"])',
    ].join(',');
    const mobileNavQuery = window.matchMedia('(max-width: 48rem)');
    let sheetIsOpen = false;
    let previousActiveElement = null;
    let previousBodyOverflow = '';
    let backgroundInertState = [];

    const getFocusableElements = () => Array.from(sheet.querySelectorAll(focusableSelector))
      .filter((element) => element.getClientRects().length > 0);

    const setBackgroundInert = (inert) => {
      if (inert) {
        backgroundInertState = Array.from(document.body.children)
          .filter((element) => (
            element !== sheet
            && element !== backdrop
            && !element.contains(sheet)
            && !element.contains(backdrop)
            && !['SCRIPT', 'STYLE', 'LINK'].includes(element.tagName)
          ))
          .map((element) => [element, element.hasAttribute('inert')]);

        backgroundInertState.forEach(([element]) => element.setAttribute('inert', ''));
        return;
      }

      backgroundInertState.forEach(([element, wasInert]) => {
        if (!wasInert) element.removeAttribute('inert');
      });
      backgroundInertState = [];
    };

    const setSheetOpen = (open) => {
      if (open === sheetIsOpen) return;
      sheetIsOpen = open;

      if (open) {
        previousActiveElement = document.activeElement instanceof HTMLElement
          ? document.activeElement
          : burger;
        previousBodyOverflow = document.body.style.overflow;
        sheet.removeAttribute('inert');
        setBackgroundInert(true);
      }

      if (open) {
        sheet.dataset.open = 'true';
        backdrop.dataset.open = 'true';
        sheet.setAttribute('aria-hidden', 'false');
        burger.setAttribute('aria-expanded', 'true');
        burger.setAttribute('aria-label', 'Close menu');
        document.body.style.overflow = 'hidden';

        window.requestAnimationFrame(() => {
          if (!sheetIsOpen) return;
          const firstMenuLink = sheet.querySelector('.hb-sheet__link');
          (firstMenuLink || sheetClose || sheet).focus({ preventScroll: true });
        });
        return;
      }

      sheet.dataset.open = 'false';
      backdrop.dataset.open = 'false';
      burger.setAttribute('aria-expanded', 'false');
      burger.setAttribute('aria-label', 'Open menu');
      document.body.style.overflow = previousBodyOverflow;
      setBackgroundInert(false);

      const focusTarget = [previousActiveElement, burger, navBrand]
        .find((element) => (
          element
          && element.isConnected
          && element.getClientRects().length > 0
          && typeof element.focus === 'function'
        ));
      if (focusTarget) {
        focusTarget.focus({ preventScroll: true });
      } else if (document.activeElement instanceof HTMLElement) {
        document.activeElement.blur();
      }

      sheet.setAttribute('aria-hidden', 'true');
      sheet.setAttribute('inert', '');
      previousActiveElement = null;
    };

    sheet.setAttribute('inert', '');
    burger.addEventListener('click', () => setSheetOpen(!sheetIsOpen));
    backdrop.addEventListener('click', () => setSheetOpen(false));
    sheetClose && sheetClose.addEventListener('click', () => setSheetOpen(false));
    sheet.addEventListener('click', (e) => {
      if (e.target instanceof Element && e.target.closest('a')) setSheetOpen(false);
    });
    document.addEventListener('keydown', (e) => {
      if (!sheetIsOpen) return;

      if (e.key === 'Escape') {
        e.preventDefault();
        setSheetOpen(false);
        return;
      }

      if (e.key !== 'Tab') return;
      const focusableElements = getFocusableElements();
      if (!focusableElements.length) {
        e.preventDefault();
        sheet.focus({ preventScroll: true });
        return;
      }

      const firstFocusable = focusableElements[0];
      const lastFocusable = focusableElements[focusableElements.length - 1];
      const focusIsOutside = !sheet.contains(document.activeElement);

      if (e.shiftKey && (document.activeElement === firstFocusable || focusIsOutside)) {
        e.preventDefault();
        lastFocusable.focus();
      } else if (!e.shiftKey && (document.activeElement === lastFocusable || focusIsOutside)) {
        e.preventDefault();
        firstFocusable.focus();
      }
    });

    document.addEventListener('focusin', (e) => {
      if (!sheetIsOpen || sheet.contains(e.target)) return;
      const firstFocusable = getFocusableElements()[0] || sheet;
      firstFocusable.focus({ preventScroll: true });
    });

    const closeSheetAtDesktop = (event) => {
      if (!event.matches && sheetIsOpen) setSheetOpen(false);
    };
    if (typeof mobileNavQuery.addEventListener === 'function') {
      mobileNavQuery.addEventListener('change', closeSheetAtDesktop);
    } else {
      mobileNavQuery.addListener(closeSheetAtDesktop);
    }
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
  document.addEventListener('click', (e) => {
    const a = e.target.closest('a[href^="#"]');
    if (!a) return;
    const href = a.getAttribute('href');
    if (!href || href === '#' || href.length < 2) return;
    let target;
    try { target = document.querySelector(href); } catch (_) { return; }
    if (!target) return;
    e.preventDefault();
    const offset = (nav ? nav.getBoundingClientRect().height : 0) + 16;
    const top = window.scrollY + target.getBoundingClientRect().top - offset;
    const reduceMotion = typeof window.matchMedia === 'function'
      && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    window.scrollTo({ top, behavior: reduceMotion ? 'auto' : 'smooth' });
  });

  /* ----------------------------------------------------------------------
   * 8. Counter animation on stats — only when value is data-target driven
   * -------------------------------------------------------------------- */
  const counters = document.querySelectorAll('[data-target]');
  if (counters.length && 'IntersectionObserver' in window) {
    const animate = (el) => {
      const target = parseFloat(el.dataset.target);
      if (Number.isNaN(target)) return;
      // Markup ships the final value, so freezing the measured width
      // before counting up keeps neighbours from shifting (CLS).
      el.style.minWidth = el.getBoundingClientRect().width + 'px';
      el.style.display = 'inline-block';
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
  /* ----------------------------------------------------------------------
   * 9. Services dropdown — hover/focus handled in CSS; JS adds touch toggle
   *    (first tap opens, second tap follows the link), ArrowDown/Escape and
   *    keeps aria-expanded honest.
   * -------------------------------------------------------------------- */
  const subItem = document.querySelector('.hb-nav__item--has-sub');
  if (subItem) {
    const trigger = subItem.querySelector('.hb-nav__link--sub');
    const setOpen = (open) => {
      subItem.dataset.open = open ? 'true' : 'false';
      if (trigger) trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
    };
    const isCoarse = window.matchMedia && window.matchMedia('(hover: none)').matches;
    if (trigger) {
      trigger.addEventListener('click', (e) => {
        if (isCoarse && subItem.dataset.open !== 'true') {
          e.preventDefault();
          setOpen(true);
        }
      });
      trigger.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          setOpen(true);
          const first = subItem.querySelector('.hb-nav__sub-link');
          if (first) first.focus();
        }
      });
    }
    subItem.addEventListener('mouseenter', () => setOpen(true));
    subItem.addEventListener('mouseleave', () => setOpen(false));
    subItem.addEventListener('focusout', (e) => {
      if (!subItem.contains(e.relatedTarget)) setOpen(false);
    });
    subItem.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        setOpen(false);
        if (trigger) trigger.focus();
      }
    });
    document.addEventListener('click', (e) => {
      if (!subItem.contains(e.target)) setOpen(false);
    });
  }
})();
