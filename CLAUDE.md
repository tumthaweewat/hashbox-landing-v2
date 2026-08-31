# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress theme for **Hashbox Studio V2** — an A/B variant deployed alongside the main `hashbox-studio` theme on hashbox.co.th. This is a classic WordPress theme (not a block theme), deployed via Git to a shared hosting environment.

- **Production**: https://hashbox.co.th (live theme depends on which is active in WP Appearance)
- **Sibling repo**: `hashbox-landing` (the V1 theme deployed to `/themes/hashbox-studio/`)
- **Deploy path (V2)**: `/httpdocs/wp-content/themes/hashbox-studio-v2/`
- **Deploy method**: Push to `main` branch (auto-deploy webhook required — see DEPLOYMENT-GUIDE.md)
- **No build step** — all CSS/JS is hand-authored, no bundler or preprocessor

### V1 vs V2
Both themes live on the same WordPress install. Switch between them via Appearance → Themes. Each ships independently from its own Git repo and deploys to a separate `themes/<slug>/` directory.

## Architecture

### Theme Structure

The site is a **one-page landing** driven by `front-page.php`, which assembles 9 sections via `get_template_part()`:

1. `template-parts/hero.php`
2. `template-parts/services.php`
3. `template-parts/why-hashbox.php`
4. `template-parts/digital-workforce.php`
5. `template-parts/portfolio.php`
6. `template-parts/about.php`
7. `template-parts/faq.php`
8. `template-parts/insights.php`
9. `template-parts/contact.php`

`header.php` contains the sticky nav + mobile menu. `footer.php` contains the site footer. `index.php` is the generic fallback template.

### Separate Portfolio Page

`page-portfolio.php` is a password-protected standalone page (not part of the one-page flow). It uses AJAX for authentication and loads portfolio project data from `functions.php` (`fetch_benjanard_portfolio()`). Has its own CSS (`css/portfolio-page.css`) and JS (`js/portfolio.js`).

### Design System ("Signal")

CSS custom properties defined in `:root` of `style.css`:
- **Background**: Dark zinc (`#09090B`, `#18181B`, `#27272A`)
- **Accents**: Blue (`#2563EB`), Cyan (`#06B6D4`), Amber (`#F59E0B`)
- **Fonts**: single family `IBM Plex Sans Thai` for everything (display, body, eyebrows, stats) — decided 2026-08-29; `--hb-font-display/--hb-font-mono` tokens still exist but resolve to the same stack. Do not introduce DM Sans / Plex Mono again.
- **All styling is in `style.css`** (single file, ~39K lines) — no Tailwind, no SCSS

### JavaScript

`js/script.js` handles: sticky nav, active nav highlight on scroll, mobile hamburger menu, scroll-reveal animations (IntersectionObserver), counter animations, smooth scroll, form submission, and orb parallax effects.

## Key Files

| File | Purpose |
|------|---------|
| `style.css` | All theme styles + WordPress theme metadata header |
| `functions.php` | Theme setup, asset enqueuing, nav menus, portfolio AJAX handlers, admin settings |
| `front-page.php` | Landing page — assembles all sections |
| `js/script.js` | All frontend interactions |
| `.htaccess` | HTTPS redirect, security headers, compression, caching |
| `deploy-config.json` | Deployment target/path configuration |

## Content

- `content/blog/` — blog content data used by the insights section
- `assets/favicons/` — favicon and app icon files
- `assets/portfolio-images/` — portfolio project images

## Development Notes

- WordPress 6.0+ and PHP 7.4+ required
- Navigation uses `primary` registered menu location with static fallback links in `functions.php`
- The theme text domain is `hashbox-studio-v2`
- Content is bilingual (Thai + English) — some strings are in Thai

## Diverging from V1

This theme starts as a near-copy of V1 (state at 2026-05-11). Free to diverge:
- Try new stacks (e.g. swap to Tailwind, add a build step)
- Test new layouts, copy, or design directions
- Compare conversion / SEO performance against V1

Keep `style.css` Theme Name unique (currently `Hashbox Studio V2`) so WordPress lists both themes separately in Appearance → Themes. PHP function names are shared with V1; only one theme is active at a time, so collisions don't occur in WP runtime, but rename if you ever need both loaded.

## Current plan (2026-09 → 2026-11)

`docs/seo-plan-2026-08-service-restructure/PLAN.md` is the single source of truth for SEO/AI-search work (sprints, owners, rules). `KEYWORD-DB.csv` holds keyword scores; `REFERENCE.md` holds the keyword ownership map — check it before creating any page (1 keyword = 1 page). Every content piece starts from `content/briefs/TEMPLATE.md`.

## Design rules (mandatory — set by Tum 2026-08-29)

Apply to **every new page, post, template, section or component**, no exceptions:

1. **One font family only**: `IBM Plex Sans Thai` for headings, body, eyebrows, stats, badges, code. Never add DM Sans, Plex Mono, Inter, Noto, Anuphan or any Google Fonts link. Use the tokens (`--hb-font-display/body/mono` all resolve to the same stack) — never hardcode a `font-family`.
2. **One type scale**: use `--hb-text-*` tokens only (base 16px; hero H1 ≈ 28px mobile / 46–52px desktop; section H2 `--hb-text-4xl` ≈ 26–36px; H3 `--hb-text-3xl` ≈ 22–28px). No inline `font-size` in px/rem, no sizes above `--hb-text-6xl`. Reference: anga.co.th (body 16, headings small and dense).
3. **UX/UI, not AI slop**: no gradient blobs, no fake stats, no unnamed testimonials, no decorative icons in every card, no mono/uppercase eyebrows on everything, no "All systems live"-style pills. Real numbers with a source, real names or none, one CTA per section, rows/tables over card grids where content is comparative, sticky first column on wide tables, mobile checked at 390px before publish.
4. Content pages: answer-first paragraph, H2 = question or keyword phrase, FAQ = FAQPage schema from the same array, BreadcrumbList, dateModified real.

Checklist lives in `content/briefs/TEMPLATE.md` §6 — run it before every publish.
