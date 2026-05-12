# Hashbox V2 — Design Tokens Spec

**Date:** 2026-05-12
**Direction:** Modern Dev-Tools (Linear + Vercel + Resend reference)
**Style basis:** Bento Box Grid × Minimalism & Swiss × Developer Mono typography
**Target audience:** Thai SME founders evaluating tech vendors; secondary = developer audience reading insights
**Primary mode:** Dark (light mode supported via `[data-theme="light"]`)

---

## 1. Style Foundation (from ui-ux-pro-max)

| Source | Pick | Why |
|--------|------|-----|
| `style` domain | **Bento Box Grid** | Tailwind 10/10, WCAG AA, Excellent perf, Apple-style modular |
| Style overlay | **Minimalism & Swiss** | Grid discipline, geometric, no decoration tax |
| `typography` | **Developer Mono pair** + **Inter swap** | JetBrains Mono for stats; Inter+Noto Sans Thai for UI |
| `chart` recommendation | **Line Chart** | Trend-over-time for growth metrics — Recharts library |
| Pattern | **Hybrid (Bento home + Vertical detail pages)** | Bento for home/work hub; vertical for case-study/service detail |

### Anti-patterns to avoid
- Flat design without depth → use shadow + inset highlight stack
- Text-heavy pages → break with Bento blocks, charts, visual rhythm
- Emoji as icons → use Lucide / Heroicons / custom SVG
- Hover scale shifts (causes layout) → opacity + color + border-gradient only

---

## 2. Color System

### Surfaces (dark-first)

| Token | OKLCH | HEX | Use |
|-------|-------|-----|-----|
| `--hb-bg` | `oklch(14% 0.005 285)` | `#09090B` | Page background |
| `--hb-surface-1` | `oklch(17% 0.005 285)` | `#111114` | Card default |
| `--hb-surface-2` | `oklch(21% 0.006 285)` | `#18181B` | Elevated card |
| `--hb-surface-3` | `oklch(25% 0.007 285)` | `#1F1F23` | Hover surface |
| `--hb-border` | `oklch(28% 0.008 285)` | `#27272A` | Subtle 1px border |
| `--hb-border-strong` | `oklch(34% 0.010 285)` | `#3F3F46` | Emphasis border |
| `--hb-glass-1` | `60%` alpha layer | — | Sticky nav, modal |
| `--hb-glass-2` | `40%` alpha layer | — | Hero overlay |

### Text

| Token | OKLCH | HEX | Use | Min contrast on `--hb-bg` |
|-------|-------|-----|-----|--------------------------|
| `--hb-text-strong` | `oklch(98% 0 0)` | `#FAFAFA` | Headings | 18.8:1 ✅ AAA |
| `--hb-text` | `oklch(89% 0.005 285)` | `#E4E4E7` | Body | 14.2:1 ✅ AAA |
| `--hb-text-muted` | `oklch(64% 0.011 285)` | `#A1A1AA` | Secondary | 6.5:1 ✅ AA |
| `--hb-text-faint` | `oklch(47% 0.013 285)` | `#71717A` | Tertiary, captions | 4.6:1 ✅ AA |

### Brand accents

| Token | Hex | Purpose |
|-------|-----|---------|
| `--hb-accent-blue` | `#3B82F6` | Primary CTA, links |
| `--hb-accent-violet` | `#8B5CF6` | Gradient partner, AI accent |
| `--hb-accent-cyan` | `#06B6D4` | Tech / data accent |
| `--hb-accent-emerald` | `#10B981` | Success / positive metric |
| `--hb-accent-amber` | `#F59E0B` | Warning / highlight |
| `--hb-accent-rose` | `#F43F5E` | Destructive / negative |

### Signature gradients

```css
--hb-grad-primary: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 50%, #06B6D4 100%);
```

Used on: hero text accent, CTA hover ring, stat callout glow.

---

## 3. Typography

### Font stack

| Role | Stack | Source |
|------|-------|--------|
| Display + UI | `Inter`, `Noto Sans Thai`, system-ui | Google Fonts |
| Body | same as display | Google Fonts |
| Mono | `JetBrains Mono`, ui-monospace | Google Fonts |
| Thai script support | Auto-fallback to `Noto Sans Thai` | Google Fonts |

**Future option:** Swap Inter → **Geist Sans** (Vercel) once we add a build step. For now use Inter for Google Fonts CDN simplicity.

### Type scale (fluid clamp)

| Token | Mobile (320px) | Desktop (1440px) | Use |
|-------|----------------|------------------|-----|
| `--hb-text-xs` | 12px | 13px | Caption, badge |
| `--hb-text-sm` | 14px | 15px | Small text |
| `--hb-text-base` | 16px | 17px | Body |
| `--hb-text-lg` | 18px | 20px | Lead paragraph |
| `--hb-text-xl` | 20px | 24px | Subheading |
| `--hb-text-2xl` | 24px | 32px | H4 / card title |
| `--hb-text-3xl` | 30px | 40px | H3 |
| `--hb-text-4xl` | 36px | 52px | H2 |
| `--hb-text-5xl` | 44px | 72px | H1 (page) |
| `--hb-text-6xl` | 56px | 96px | Hero |

### Weights
300 (Light) · 400 (Regular) · 500 (Medium) · 600 (Semibold) · 700 (Bold) · 800 (Black)

### Numerals
- **Tabular** (`tnum`) on all stat blocks, tables, prices
- **Lining** (`lnum`) for headers
- Mono font with `font-variant-numeric: tabular-nums lining-nums` → use `.hb-numeric` utility

---

## 4. Spacing

4-px baseline, exponential scale:

```
0, 4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 80, 96, 128
```

Section spacing fluid: `clamp(4rem, 3rem + 5vw, 8rem)` vertical.

Containers:
- `--hb-container-sm` 640px (prose pages)
- `--hb-container-lg` 1152px (default)
- `--hb-container-xl` 1280px (bento home)

---

## 5. Border / Radius

| Token | Value | Use |
|-------|-------|-----|
| `--hb-radius-xs` | 4px | Badges, pills |
| `--hb-radius-sm` | 8px | Inputs, buttons |
| `--hb-radius-md` | 12px | Compact cards |
| `--hb-radius-lg` | 16px | Default cards |
| `--hb-radius-xl` | 24px | Bento cards |
| `--hb-radius-2xl` | 32px | Feature panels |

Border default = 1px solid `--hb-border`. Hover/active = 1px `--hb-border-strong` or gradient via mask.

---

## 6. Shadows (Linear-style)

Stack: **ambient drop** + **inset top highlight** for depth illusion.

| Token | Use |
|-------|-----|
| `--hb-shadow-xs` | inset highlight only (default surfaces) |
| `--hb-shadow-sm` | hover state cards |
| `--hb-shadow-md` | elevated card |
| `--hb-shadow-lg` | modal, dropdown |
| `--hb-shadow-xl` | hero callout, sticky CTA |
| `--hb-glow-blue/violet/cyan/success` | gradient glow (selective) |

Focus ring: `0 0 0 2px var(--hb-bg), 0 0 0 4px var(--hb-accent-blue)` (double-ring a11y pattern).

---

## 7. Motion

### Duration

| Token | ms | Use |
|-------|----|----|
| `--hb-duration-instant` | 0 | No animation |
| `--hb-duration-fast` | 150 | Hover, focus |
| `--hb-duration-normal` | 250 | State change |
| `--hb-duration-slow` | 400 | Page transition |
| `--hb-duration-slower` | 700 | Hero reveal |

### Easing

| Token | Curve | Use |
|-------|-------|-----|
| `--hb-ease-out` | standard | Default |
| `--hb-ease-out-expo` | `cubic-bezier(0.16, 1, 0.3, 1)` | **Signature** (Linear-style) |
| `--hb-ease-out-back` | overshoot | Card hover-in |
| `--hb-ease-spring` | bouncy | Counter animation |

### Always respect

```css
@media (prefers-reduced-motion: reduce) { /* baked into tokens.css */ }
```

---

## 8. Z-index scale

10 (raised) · 20 (overlay) · 30 (dropdown) · 40 (sticky nav) · 50 (modal) · 60 (toast) · 70 (tooltip)

---

## 9. Iconography

- Icon set: **Lucide** (default) or **Heroicons** (alt)
- Stroke width: `1.5px` everywhere
- Size scale: 14 / 16 / 20 / 24 / 32 / 48 / 64
- Container: SVG only, no `<i class="fa-*">`, never emoji

---

## 10. Charts (1 type pick)

**Line Chart** — primary chart type for V2 stats display.

| Field | Choice |
|-------|--------|
| Library | **Recharts** (React) or **Chart.js** (vanilla) |
| Primary line color | `--hb-accent-blue` `#3B82F6` |
| Fill | 20% opacity gradient to transparent |
| Multi-series | Use blue + violet + cyan, not similar hues |
| Pattern overlay | Add stripe pattern for colorblind users |
| Interactive | Hover tooltip + optional zoom on stat detail pages |

Where used:
- About page — "growth over time" stat trend
- Case study results — "before vs after" sparkline
- Insights post — embedded data viz

---

## 11. A11y baseline (CRITICAL)

| Check | Token / pattern |
|-------|-----------------|
| Color contrast | All text token ≥ 4.5:1 vs surface |
| Focus visible | `:focus-visible` → `--hb-focus-ring` |
| Touch target | min `44×44px` (use `--hb-space-12` minimum for tap area) |
| Reduced motion | Honored in tokens.css media query |
| Keyboard nav | Tab order matches visual; skip-link required |
| Form labels | Always paired `<label for="">`; never placeholder-as-label |

---

## 12. Implementation

### Drop tokens.css into theme/app

WordPress theme (V2 path):
```php
// functions.php
wp_enqueue_style( 'hashbox-tokens',
  get_template_directory_uri() . '/design-system/tokens.css',
  array(), '2.0.0'
);
```

Next.js app:
```ts
// app/layout.tsx
import '@/design-system/tokens.css'
```

### Tailwind extension (if using Tailwind)

Map CSS variables to Tailwind theme:

```js
// tailwind.config.ts
theme: {
  extend: {
    colors: {
      bg: 'var(--hb-bg)',
      surface: {
        1: 'var(--hb-surface-1)',
        2: 'var(--hb-surface-2)',
        3: 'var(--hb-surface-3)',
      },
      text: {
        strong: 'var(--hb-text-strong)',
        DEFAULT: 'var(--hb-text)',
        muted: 'var(--hb-text-muted)',
      },
      accent: {
        blue: 'var(--hb-accent-blue)',
        violet: 'var(--hb-accent-violet)',
        cyan: 'var(--hb-accent-cyan)',
        emerald: 'var(--hb-accent-emerald)',
      },
    },
    fontFamily: {
      sans: ['var(--hb-font-body)'],
      mono: ['var(--hb-font-mono)'],
    },
    borderRadius: {
      lg: 'var(--hb-radius-lg)',
      xl: 'var(--hb-radius-xl)',
      '2xl': 'var(--hb-radius-2xl)',
    },
  }
}
```

---

## 13. Inspirations + references

Study sources:

| Site | Take |
|------|------|
| linear.app | Sticky-glass nav, inset shadows, exact gradient hierarchy |
| vercel.com | Bold display type, gradient text, dark depth |
| resend.com | Warmth, illustration accents, bento home |
| cursor.com | Mono numerals, dev-tools tone |
| anga.co.th | Long-form Thai prose, named team, testimonial style |

Avoid copying directly. Use as **anchors** to validate decisions, not templates.
