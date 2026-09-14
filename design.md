# Hashbox Website Design System — Signal V3 · Original Indigo

**Status:** Candidate source of truth for the redesign  
**Production:** Not connected  
**Version:** 3.1.0-candidate  
**Last updated:** 2026-09-03

Signal V3 is the design authority for all new Hashbox website design work. The older blue/orange kinetic-brutalist document, the dark dev-tools token notes, and the currently loaded dark-indigo token file remain historical references only. They must not be mixed into new layouts.

The WordPress production theme continues to use its existing CSS until Signal V3 is approved and migrated page by page.

## Design position

Hashbox should feel like a technical consultancy that can carry a business from diagnosis to production: measured, legible, and evidence-led. The design should make complex SEO and AI work understandable to Thai owners, executives, and operating teams without looking like a generic agency or an AI product template.

The visual hierarchy follows this order:

1. The business outcome and service promise
2. Verifiable proof from the client's or Hashbox's real measurement systems
3. Scope, process, price, and responsibility
4. A clear assessment, audit, or consultation action

### Reference synthesis

Signal V3 uses the following sites as directional references, not templates to copy:

| Reference | What Signal V3 adopts | What Signal V3 rejects |
| --- | --- | --- |
| [AGR Studio](https://agr.studio/) | Senior B2B confidence, generous whitespace, project-led proof, capability ledgers | Repeated section numbering, unverified counts, effect-heavy motion |
| [Creative Marketing](https://creativemarketing.peachweb.io/) | Large statement pacing and clear feature storytelling | AI-template gradients, fabricated metrics/testimonials, equal pricing-card grids |
| [Linea Prompt](https://lineaprompt.com/) | Promise → action → evidence hierarchy, precise product-panel treatment, subtle rule-grid structure | Fake app or browser chrome and ornamental product UI |
| [Nex Studio](https://nexstudio.tech/) | Bold type scale, dark/light contrast, editorial project sequence | Loading screens, scroll spectacle, decorative numbering |
| [Riangle](https://riangle.com/) | Studio × technology voice, project ledger, capability index, dense metadata | Dark-everywhere styling and repeated numbered navigation |

The common design DNA is large studio typography, rhythmic whitespace, editorial project lists, precise proof surfaces, and restrained purposeful motion. Hashbox applies that DNA with its existing indigo, Thai-first typography, real PageSpeed evidence, published case metrics, and existing content.

## Content lock

The redesign must preserve the current website content. This includes:

- headings, paragraphs, service names, published prices, guarantees, metrics, dates, and proof captions;
- page URLs, internal links, contact details, forms, schema, and SEO metadata;
- analytics and conversion attributes, including GTM event hooks;
- image meaning and factual captions.

Line breaks, grouping, typographic emphasis, and information order may change when needed for responsive hierarchy. Copy may not be shortened, rewritten, or embellished unless a separate content change is approved.

## Visual foundations

### Colour

- Primary surface: the current Hashbox warm off-white (`#FAFAF9` family), never pure white.
- Primary text: the current Hashbox tinted near-black (`#0B0B12` family), never pure black.
- Primary brand accent: Hashbox Indigo `#4F46E5`, with `#4338CA` for pressed and strong states. Use it for primary actions, data emphasis, and focus rings.
- Secondary brand highlight: Hashbox Burnt Orange `#C2410C`. Reserve it for small pricing, badge, or editorial emphasis only; never use it as a competing CTA colour.
- Combined brand-colour footprint: target no more than 3–5% of any viewport.
- No gradients, glow, glass surfaces, decorative colour effects, or indigo-to-orange blends.
- Semantic success, warning, and error colours are reserved for state feedback; they are not brand accents.

Canonical values live in [`design-system/v3/tokens.source.json`](design-system/v3/tokens.source.json). Generated CSS lives in [`design-system/v3/tokens.css`](design-system/v3/tokens.css).

### Typography

- Display: **IBM Plex Sans Thai**, weights 600 and 700.
- Body: **Noto Sans Thai**, weights 400, 500, and 700.
- Data outlier: **IBM Plex Mono**, weight 500, used in no more than two semantic slots per page.
- Headings are always roman. Do not italicise a heading or a single word inside a heading.
- Use the major-third scale from the tokens. Body text defaults to a 1.7 line-height for Thai readability.
- Long-form prose measure remains between 45ch and 75ch. Short introductions, notes and list items may use the full content width; see Desktop short-text wrapping.

All fonts are self-hosted from `assets/fonts/`; production must not depend on Google Fonts.

### Layout and space

- Base grid: 4px.
- Content container: 78rem maximum with responsive side padding.
- Use rules, surface shifts, or meaningful density changes to separate sections; do not rely on equal whitespace alone.
- Cards are a last resort. Prefer ledgers, specification rows, sequences, proof figures, and ruled sections.
- Never nest one card inside another card.
- Any grid containing an image must use `minmax(0, 1fr)` tracks.
- `html` and `body` must keep `overflow-x: clip`.

## Page-family architecture

| Page family | Macrostructure | Primary patterns | Conversion role |
| --- | --- | --- | --- |
| Homepage and marketing landing pages | Workbench | Split proof hero, tabular service sheet, stat strip, editorial project ledger, step sequence | Audit or assessment |
| Service and long-form content pages | Long Document | Sticky-safe contents, prose chapters, spec sheet, inline proof | Consultation |
| Work / portfolio hub | Portfolio Grid | Filterable case index, project facts, outcome labels | Case-study exploration |
| Case-study detail | Split Studio | Situation / intervention split, real evidence, measured outcome | Trust building |
| Audit and checker tools | Compact Workbench | Input panel, diagnostic states, result ledger | Tool completion and lead |

Do not force every page into the same section sequence. The common system is tokens, typography, states, and proof behaviour—not one repeated layout.

## Component contracts

### Navigation

Use the N11 mega-menu pattern: a dark utility masthead with a deliberate menu trigger and an expandable route panel. Avoid the default logo-left / five-links / button-right white navigation fingerprint.

Navigation requirements:

- sticky top-level navigation uses `--z-sticky-nav`;
- secondary sticky elements start below `--size-nav` and use `--z-sticky`;
- nav, tab, footer, and CTA labels never wrap;
- mobile collapses to wordmark + menu trigger;
- the trigger exposes `aria-expanded` and `aria-controls`.

### Footer

Use the Ft5 statement footer: one strong company statement followed by a compact contact and legal strip. Do not reproduce the generic four-column sitemap footer.

### Buttons and links

Primary buttons use Hashbox Indigo with `--color-accent-ink`. Secondary buttons are paper with an ink border. Quiet buttons use no visible fill until interaction. Burnt Orange is a highlight token, not a second primary-button colour.

Every interactive component must cover:

1. default
2. hover, inside `(hover: hover) and (pointer: fine)`
3. focus-visible with an immediate 2px outline
4. active
5. disabled with native/ARIA semantics, reduced opacity, and a not-allowed cursor
6. loading
7. error
8. success

Transitions may animate only transform, opacity, colour, background-colour, and border-colour. Do not use `transition-all`, overshoot easing, or routine scale effects.

### Forms

- Input and adjacent button heights share `--size-control` with a 44px floor.
- Border width stays 1px in every state.
- Focus uses an outline rather than a wider border.
- Helper text reserves at least `1lh`, even when empty.
- Error and success use colour plus text; never colour alone.

### Proof

Use real screenshots, real case-study images, or existing measurement output. Never redraw browser, terminal, dashboard, or device chrome. Never invent a metric to fill a layout.

### Motion

Workbench pages may use no more than three motion primitives:

1. menu panel and scrim entrance;
2. one-shot reveal for the selected-work ledger only;
3. a small arrow translation on a project link hover or keyboard focus.

Body copy and ordinary sections do not animate on scroll. Loading screens, parallax, cursor followers, glow, bouncing easing, animated gradients, and universal card lifts are prohibited. `prefers-reduced-motion: reduce` removes spatial motion and reveals all content immediately.

## Responsive contract

Every migrated page must be visually checked at 320px, 375px, 414px, 768px, 1280×800, and a wide desktop viewport.

- Display headings use `overflow-wrap: anywhere` and `min-width: 0`.
- Section headers containing a kicker and heading are always a single vertical column.
- Clickable labels stay on one line; parents reflow instead.
- Hero top/bottom padding is intentionally asymmetric, with at least 1.3× more space below than above.
- Hero promise, lede, primary CTA, and visual focal point must fit at 1280×800.
- Reduced-motion mode removes nonessential transform animation and restores automatic scrolling.

## Governance and migration

1. Edit `design-system/v3/tokens.source.json` for token changes.
2. Run `node tools/build-design-system-v3.mjs`.
3. Never hand-edit generated `tokens.css` or `tokens.json`.
4. Review `design-system/v3/preview.html` at all required viewports.
5. Migrate one page family at a time without deleting the current production system.
6. Switch production imports only after the affected templates pass content parity, accessibility, visual, and analytics checks.
7. Archive the legacy design-system files only after the full production migration is stable; do not delete them during exploration.

## Exports

### CSS custom properties

The complete canonical CSS export is [`design-system/v3/tokens.css`](design-system/v3/tokens.css). Its core contract is:

```css
:root {
  --color-paper: oklch(98.48% 0.0013 106.42);
  --color-paper-2: oklch(96.06% 0.0027 106.45);
  --color-paper-3: oklch(93.04% 0.0027 106.45);
  --color-ink: oklch(15.33% 0.0149 284.51);
  --color-ink-2: oklch(24.23% 0.0133 285.37);
  --color-muted: oklch(38.89% 0.0100 285.92);
  --color-rule: oklch(90.61% 0.0027 106.45);
  --color-rule-2: oklch(82.88% 0.0041 106.49);
  --color-accent: oklch(51.06% 0.2301 276.97);
  --color-accent-strong: oklch(45.68% 0.2146 277.02);
  --color-accent-soft: oklch(93% 0.035 277);
  --color-accent-ink: oklch(98.48% 0.0013 106.42);
  --color-highlight: oklch(55.34% 0.1739 38.40);
  --color-highlight-soft: oklch(96% 0.020 38.40);
  --color-focus: oklch(45.68% 0.2146 277.02);
  --font-display: "IBM Plex Sans Thai", ui-sans-serif, sans-serif;
  --font-body: "Noto Sans Thai", ui-sans-serif, sans-serif;
  --font-outlier: "IBM Plex Mono", ui-monospace, monospace;
  --space-3xs: 0.25rem;
  --space-2xs: 0.5rem;
  --space-xs: 0.75rem;
  --space-sm: 1rem;
  --space-md: 1.5rem;
  --space-lg: 2rem;
  --space-xl: 3rem;
  --space-2xl: 4.5rem;
  --space-3xl: 7rem;
  --space-4xl: 11rem;
  --space-5xl: 14rem;
  --text-xs: 0.75rem;
  --text-sm: 0.875rem;
  --text-base: 1rem;
  --text-md: 1.25rem;
  --text-lg: 1.5625rem;
  --text-xl: 1.953125rem;
  --text-2xl: 2.44140625rem;
  --text-display-sm: clamp(2.25rem, 4vw + 1rem, 3.75rem);
  --text-display: clamp(2.625rem, 4.5vw + 0.75rem, 4.75rem);
  --radius-card: 0.75rem;
  --radius-input: 0.5rem;
  --radius-pill: 999px;
  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in: cubic-bezier(0.7, 0, 0.84, 0);
  --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
  --dur-micro: 120ms;
  --dur-short: 180ms;
  --dur-long: 420ms;
}
```

## Desktop short-text wrapping

- Keep short introductions, commercial notes and short list items on one line at desktop widths when the full content container has room.
- Remove accidental ch-based max-width limits and adjust columns before changing font size. A side-by-side image may move above a full-width list.
- Preserve copy, font size and accessibility. Never force all paragraphs with nowrap, clip text, use ellipsis, or add horizontal scrolling to achieve this.
- Long-form prose retains its 45–75ch measure. Short utility copy is exempt from that limit.
- At small viewports and browser zoom, wrapping is expected. Test 320, 375, 414, 768, 1280, 1440 and 1920px with fonts loaded; assert rendered line counts for designated desktop text and no overflow on mobile.
- For AI Workflow Audit, guard vendor intro, Dashboard note, Screening signals, engagement intro and pricing note. Do not fix a regression by silently shortening copy.

### Tailwind CSS v4 `@theme`

```css
@theme {
  --color-paper: oklch(98.48% 0.0013 106.42);
  --color-paper-2: oklch(96.06% 0.0027 106.45);
  --color-paper-3: oklch(93.04% 0.0027 106.45);
  --color-ink: oklch(15.33% 0.0149 284.51);
  --color-ink-2: oklch(24.23% 0.0133 285.37);
  --color-muted: oklch(38.89% 0.0100 285.92);
  --color-rule: oklch(90.61% 0.0027 106.45);
  --color-rule-2: oklch(82.88% 0.0041 106.49);
  --color-accent: oklch(51.06% 0.2301 276.97);
  --color-accent-ink: oklch(98.48% 0.0013 106.42);
  --color-highlight: oklch(55.34% 0.1739 38.40);
  --color-highlight-soft: oklch(96% 0.020 38.40);
  --color-focus: oklch(45.68% 0.2146 277.02);
  --font-display: "IBM Plex Sans Thai", ui-sans-serif, sans-serif;
  --font-body: "Noto Sans Thai", ui-sans-serif, sans-serif;
  --font-outlier: "IBM Plex Mono", ui-monospace, monospace;
  --spacing-3xs: 0.25rem;
  --spacing-2xs: 0.5rem;
  --spacing-xs: 0.75rem;
  --spacing-sm: 1rem;
  --spacing-md: 1.5rem;
  --spacing-lg: 2rem;
  --spacing-xl: 3rem;
  --spacing-2xl: 4.5rem;
  --spacing-3xl: 7rem;
  --text-xs: 0.75rem;
  --text-sm: 0.875rem;
  --text-base: 1rem;
  --text-md: 1.25rem;
  --text-lg: 1.5625rem;
  --text-xl: 1.953125rem;
  --text-2xl: 2.44140625rem;
  --radius-card: 0.75rem;
  --radius-input: 0.5rem;
  --radius-pill: 999px;
  --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
  --ease-in: cubic-bezier(0.7, 0, 0.84, 0);
  --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
}
```

### DTCG `tokens.json`

The complete generated export is [`design-system/v3/tokens.json`](design-system/v3/tokens.json). The portable core is:

```json
{
  "$schema": "https://design-tokens.github.io/community-group/format/",
  "color": {
    "paper": { "$value": "oklch(98.48% 0.0013 106.42)", "$type": "color" },
    "paper-2": { "$value": "oklch(96.06% 0.0027 106.45)", "$type": "color" },
    "paper-3": { "$value": "oklch(93.04% 0.0027 106.45)", "$type": "color" },
    "ink": { "$value": "oklch(15.33% 0.0149 284.51)", "$type": "color" },
    "ink-2": { "$value": "oklch(24.23% 0.0133 285.37)", "$type": "color" },
    "muted": { "$value": "oklch(38.89% 0.0100 285.92)", "$type": "color" },
    "rule": { "$value": "oklch(90.61% 0.0027 106.45)", "$type": "color" },
    "rule-2": { "$value": "oklch(82.88% 0.0041 106.49)", "$type": "color" },
    "accent": { "$value": "oklch(51.06% 0.2301 276.97)", "$type": "color" },
    "accent-ink": { "$value": "oklch(98.48% 0.0013 106.42)", "$type": "color" },
    "highlight": { "$value": "oklch(55.34% 0.1739 38.40)", "$type": "color" },
    "highlight-soft": { "$value": "oklch(96% 0.020 38.40)", "$type": "color" },
    "focus": { "$value": "oklch(45.68% 0.2146 277.02)", "$type": "color" }
  },
  "font": {
    "display": { "$value": "IBM Plex Sans Thai, ui-sans-serif, sans-serif", "$type": "fontFamily" },
    "body": { "$value": "Noto Sans Thai, ui-sans-serif, sans-serif", "$type": "fontFamily" },
    "outlier": { "$value": "IBM Plex Mono, ui-monospace, monospace", "$type": "fontFamily" }
  },
  "space": {
    "3xs": { "$value": "0.25rem", "$type": "dimension" },
    "2xs": { "$value": "0.5rem", "$type": "dimension" },
    "xs": { "$value": "0.75rem", "$type": "dimension" },
    "sm": { "$value": "1rem", "$type": "dimension" },
    "md": { "$value": "1.5rem", "$type": "dimension" },
    "lg": { "$value": "2rem", "$type": "dimension" },
    "xl": { "$value": "3rem", "$type": "dimension" },
    "2xl": { "$value": "4.5rem", "$type": "dimension" },
    "3xl": { "$value": "7rem", "$type": "dimension" }
  },
  "duration": {
    "micro": { "$value": "120ms", "$type": "duration" },
    "short": { "$value": "180ms", "$type": "duration" },
    "long": { "$value": "420ms", "$type": "duration" }
  }
}
```

### shadcn/ui variables

```css
:root {
  --background: 98.48% 0.0013 106.42;
  --foreground: 15.33% 0.0149 284.51;
  --card: 96.06% 0.0027 106.45;
  --card-foreground: 15.33% 0.0149 284.51;
  --popover: 98.48% 0.0013 106.42;
  --popover-foreground: 15.33% 0.0149 284.51;
  --primary: 51.06% 0.2301 276.97;
  --primary-foreground: 98.48% 0.0013 106.42;
  --secondary: 93.04% 0.0027 106.45;
  --secondary-foreground: 24.23% 0.0133 285.37;
  --muted: 93.04% 0.0027 106.45;
  --muted-foreground: 38.89% 0.0100 285.92;
  --accent: 93% 0.035 277;
  --accent-foreground: 45.68% 0.2146 277.02;
  --hashbox-highlight: 55.34% 0.1739 38.40;
  --hashbox-highlight-soft: 96% 0.020 38.40;
  --destructive: 44% 0.150 25;
  --destructive-foreground: 98.48% 0.0013 106.42;
  --border: 90.61% 0.0027 106.45;
  --input: 82.88% 0.0041 106.49;
  --ring: 45.68% 0.2146 277.02;
  --radius: 0.75rem;
}
```
