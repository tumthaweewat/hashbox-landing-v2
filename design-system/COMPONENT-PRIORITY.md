# Hashbox V2 — Component Priority Order

**Build order optimized for:** maximum reuse, atomic-first, page assembly readiness.

---

## Phase 1 — Foundation (Day 1)

Critical primitives. Block everything downstream.

| # | Component | Spec | Est. time |
|---|-----------|------|-----------|
| 1 | **Design Tokens** | `tokens.css` drop-in, verify in `<head>` | 30 min |
| 2 | **Typography styles** | h1-h6, body, caption, lead utility classes | 30 min |
| 3 | **Button** | Primary, Outline, Ghost, Link · size sm/md/lg · loading + disabled state | 1 hr |
| 4 | **Badge / Pill** | Tag, status (success/warn/danger), size sm/md | 30 min |
| 5 | **Input + Textarea** | Default, error, disabled · with label + helper | 1 hr |
| 6 | **Checkbox + Radio** | Tokens-aligned, focus visible | 30 min |
| 7 | **Select** | Native styled OR Radix Select primitive | 1 hr |

---

## Phase 2 — Surface (Day 2)

Containers and structural elements.

| # | Component | Spec | Est. time |
|---|-----------|------|-----------|
| 8 | **Card (base)** | Surface-1 bg, radius-lg, hover state, slot for header/body/footer | 1 hr |
| 9 | **Card (glass)** | Backdrop blur + glass-1 bg | 30 min |
| 10 | **Card (gradient border)** | Mask-image gradient ring on hover | 1 hr |
| 11 | **Container** | Centered max-width responsive | 15 min |
| 12 | **Section wrapper** | Vertical padding scale + optional eyebrow | 30 min |
| 13 | **Bento Grid** | CSS Grid 4-col → 2-col → 1-col, span utilities | 1.5 hr |
| 14 | **Stat Block** | Mono numeral display + label + optional caption | 30 min |

---

## Phase 3 — Navigation (Day 2-3)

| # | Component | Spec | Est. time |
|---|-----------|------|-----------|
| 15 | **Sticky Nav** | Glass bg on scroll, logo + nav links + CTA | 1.5 hr |
| 16 | **Mobile Nav (Sheet)** | Slide-in drawer, focus trap | 1 hr |
| 17 | **Breadcrumb** | Schema-aware (BreadcrumbList JSON-LD ready) | 30 min |
| 18 | **Footer** | 4-column, NAP, social, legal links | 1.5 hr |

---

## Phase 4 — Interactive (Day 3)

| # | Component | Spec | Est. time |
|---|-----------|------|-----------|
| 19 | **Accordion (FAQ)** | Radix Accordion primitive, FAQPage schema emit | 1 hr |
| 20 | **Tabs** | For service comparison tables | 1 hr |
| 21 | **Tooltip** | Radix Tooltip primitive | 30 min |
| 22 | **Dialog / Modal** | Radix Dialog, focus trap, ESC handler | 1 hr |
| 23 | **Toast** | Sonner or Radix Toast | 30 min |

---

## Phase 5 — Composed (Day 4-5)

Application-level patterns.

| # | Component | Spec | Est. time |
|---|-----------|------|-----------|
| 24 | **Hero (home)** | H1 with gradient text, sub, dual CTA, animated cursor | 2-3 hr |
| 25 | **Service Card** | Icon + title + tag pills + description + CTA | 1 hr |
| 26 | **Case Study Card** | Image + metric overlay + tag + hover reveal | 1.5 hr |
| 27 | **Process Step List** | Numbered, connected, vertical or horizontal | 1 hr |
| 28 | **Testimonial Card** | Quote + attribution + optional photo + logo | 1 hr |
| 29 | **Contact Form** | Multi-field with PDPA consent, server-side handler | 1.5 hr |
| 30 | **Insights Card (post preview)** | Featured image + title + excerpt + meta | 1 hr |
| 31 | **Chart (Line, Recharts)** | Wrap Recharts LineChart with tokens | 1 hr |
| 32 | **Logo Wall** | Client logos grid (grayscale → color on hover) | 30 min |

---

## Phase 6 — Pages (Day 6-10)

Assemble components into pages. Mirror V1 sitemap.

| Page | Components used | Schema |
|------|-----------------|--------|
| Home | Hero, Bento Grid, Service Card×3, Case Study Card×6, Stat Block×4, Process Step List, Testimonial×2, Accordion (FAQ×7), Logo Wall, Contact Form | Organization, ProfessionalService, WebSite, FAQPage |
| Services hub | Service Card×3, CTA section | BreadcrumbList |
| Service detail × 3 | Hero (compact), Bento info grid, Process Step List, Accordion (FAQ), Testimonial, Stat Block, Contact CTA | Service, FAQPage, BreadcrumbList |
| Work hub | Case Study Card×6 in Bento, CTA section | CollectionPage, ItemList, BreadcrumbList |
| Case study × 6 | Hero (case), Snapshot Stat Block, Process Step List, Chart (results), Testimonial, Tech Stack tags, Contact CTA | Article (CaseStudy), BreadcrumbList |
| About | Hero, Team background panel, Tech Stack tags, In-house tools list, Values cards, Case studies preview, Contact | AboutPage, BreadcrumbList |
| Insights (blog) | Hero, Insights Card grid, sidebar | CollectionPage, ItemList |
| Insights post | Hero, Article body, Author byline, Related posts | Article, BreadcrumbList |
| Contact | Contact Form, NAP, social, map (optional) | ContactPage, LocalBusiness |

---

## Phase 7 — Polish (Day 11-12)

- Lighthouse pass on every page (Performance 90+, SEO 100, A11y 95+, Best Practices 95+)
- Visual regression vs V1 (Playwright)
- WCAG 2.2 AA audit
- Cross-browser (Chrome, Firefox, Safari)
- Cross-device (375px, 768px, 1024px, 1440px, 1920px)
- Schema validator pass (all 10 schema types)

---

## Component vs. Page allocation

```
Atomic primitives (Phase 1-2):    15 components
Navigation (Phase 3):              4 components
Interactive (Phase 4):             5 components
Composed (Phase 5):                9 components
──────────────────────────────────────────────
Total components:                 33 components
Pages assembled (Phase 6):        ~13 pages
```

---

## Build environment options

### Option A — WP Theme (V2 WP) + Tailwind CDN
- Drop tokens.css + Tailwind CDN in `<head>`
- Build PHP templates that consume utility classes
- No build pipeline
- Fastest start, no toolchain pain

### Option B — WP Theme + Vite/Bun build
- `npm init` in theme dir
- Vite builds CSS/JS bundle
- Tailwind via PostCSS
- Modern DX, still WP-deployable

### Option C — Headless WP + Next.js App Router
- WP at hashbox-test.local (V1) as data backend via WPGraphQL
- Next.js consumes via codegen
- shadcn/ui CLI for primitives
- Vercel deploy
- Maximum design freedom but new deploy infra

### Recommended: **Option A first**, migrate to C later if scale demands
Why: V2 dir already inside WP themes/. Faster ship. Tokens are framework-agnostic so migrating to C later doesn't break design work.

---

## Naming conventions

- File: `kebab-case.tsx` / `.php`
- Component: `PascalCase` (React) or `hashbox-*` BEM block (CSS)
- CSS class: `.hb-*` prefix to avoid collision with Tailwind utilities or V1 styles
- Token: `--hb-*`

Example BEM (vanilla CSS path):
```html
<article class="hb-card hb-card--bento hb-card--glass">
  <h3 class="hb-card__title">SEO-Ready Website</h3>
  <ul class="hb-card__tags">
    <li class="hb-tag hb-tag--blue">Next.js</li>
  </ul>
</article>
```

Example React (shadcn path):
```tsx
import { Card, CardHeader, CardTitle } from '@/components/ui/card'

<Card variant="bento" surface="glass">
  <CardHeader>
    <CardTitle>SEO-Ready Website</CardTitle>
  </CardHeader>
  ...
</Card>
```

---

## Acceptance gate per component

Each component complete when:
- [ ] Renders all variants (default, hover, focus, disabled, error)
- [ ] Tab/keyboard accessible
- [ ] `:focus-visible` ring shows
- [ ] Color contrast verified (4.5:1 min)
- [ ] Reduced-motion variant exists
- [ ] Responsive 320px → 1920px
- [ ] Storybook story (if using Storybook) or component preview HTML
- [ ] Documented in `design-system/components/<name>.md`

---

## Next step

1. Confirm Option A / B / C (build environment)
2. Drop tokens.css + Tailwind into V2 theme
3. Build component #1-7 (Foundation)
4. Push initial scaffold to V2 repo
5. Iterate
