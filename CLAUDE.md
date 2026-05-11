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
- **Fonts**: `Space Grotesk` (display), `DM Sans` (body) — loaded from Google Fonts
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
