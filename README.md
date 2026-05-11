# Hashbox Studio V2 — WordPress Theme

A/B variant of the Hashbox Studio theme. Lives alongside the V1 theme on the same WordPress install; switch live by activating in Appearance → Themes.

## Relationship to V1

| | V1 | V2 (this repo) |
|---|---|---|
| Repo | `tumthaweewat/hashbox-landing` | `tumthaweewat/hashbox-landing-v2` |
| Theme dir | `wp-content/themes/hashbox-studio/` | `wp-content/themes/hashbox-studio-v2/` |
| Theme Name | `Hashbox Studio` | `Hashbox Studio V2` |
| Text Domain | `hashbox-studio` | `hashbox-studio-v2` |
| Status | Production baseline | Experimental A/B variant |

## 🎨 Design System
- **Base**: Signal Design System (Dark Zinc + Blue/Cyan/Amber)
- Diverges freely from V1 over time as experiments ship

## 🚀 Quick Start

```bash
git clone https://github.com/tumthaweewat/hashbox-landing-v2.git
cd hashbox-landing-v2
# Hand-author code edits — no build step
```

## 📦 Deployment

Push `main` → auto-deploys to `/httpdocs/wp-content/themes/hashbox-studio-v2/` on hashbox.co.th. Webhook setup required separately from V1 (see `DEPLOYMENT-GUIDE.md`).

To go live, activate **Hashbox Studio V2** in WordPress → Appearance → Themes. To roll back, re-activate **Hashbox Studio** (V1).

## 🔧 Tech

- WordPress 6.0+, PHP 7.4+
- Vanilla CSS (single `style.css`)
- Vanilla JS (single `js/script.js`)
- No bundler, no SCSS, no React
