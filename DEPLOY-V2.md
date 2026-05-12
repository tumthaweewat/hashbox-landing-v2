# Hashbox Studio V2 — Deployment Guide

**Target:** hashbox.co.th
**Repo:** https://github.com/tumthaweewat/hashbox-landing-v2
**Local test:** http://hashbox-test.local (V2 active)

---

## Architecture

```
GitHub Repo                Hosting (hashbox.co.th)
─────────────              ────────────────────────
hashbox-landing           →  /httpdocs/wp-content/themes/hashbox-studio/        (V1)
hashbox-landing-v2  ←─────?  /httpdocs/wp-content/themes/hashbox-studio-v2/     (V2 — to set up)
```

V2 deploys to a SECOND theme directory alongside V1. Both themes coexist; WP Admin → Appearance → Themes lets you switch active.

---

## Two deploy paths

### Path A — Auto-deploy webhook (recommended)

Mirror V1's setup. Add second webhook on hosting panel:

| Field | Value |
|-------|-------|
| Source | GitHub `tumthaweewat/hashbox-landing-v2` |
| Branch | `main` |
| Target dir | `/httpdocs/wp-content/themes/hashbox-studio-v2/` |
| Trigger | Push to main |
| Exclude | `.git`, `*.md`, `design-system/preview.html`, `v2-screenshots/`, `DEPLOY-V2.md` |

Hosting providers that support this out of the box:
- **Plesk** — Git extension → "Add repository" → Configure
- **cPanel** — Git Version Control → "Create" → Set deployment branch
- **Cloudways** — Git deploy tool
- **WPMU** / **WP Engine** — Git push to staging branch

If hosting doesn't support GitHub webhooks natively, see Path B.

### Path B — Manual SFTP/SSH first deploy + git pull workflow

If no auto-deploy:

**Initial deploy:**
```bash
# Local
cd /Users/tumthaweewat/hashbox-landing-v2
git archive --format=zip --output=/tmp/hashbox-v2.zip HEAD

# Upload /tmp/hashbox-v2.zip to hosting via cPanel/SFTP
# Extract into /httpdocs/wp-content/themes/hashbox-studio-v2/
```

**Subsequent updates via SSH (if available):**
```bash
ssh user@hashbox.co.th
cd /httpdocs/wp-content/themes/hashbox-studio-v2
git pull origin main
```

If no Git on server, repeat zip/upload cycle.

---

## After theme is on hosting

### 1. Verify theme appears in WP Admin

WP Admin → Appearance → Themes
- Should see two: "Hashbox Studio" (active) + "Hashbox Studio V2" (inactive)
- Click "Live Preview" on V2 to test BEFORE activating — does not affect visitors

### 2. Configure WP Pages (if needed)

V2 uses the same WP page records as V1. Page-template assignments transfer automatically because filenames match.

Verify all 13 V1 pages exist in prod with templates assigned:

| Slug | Template (must match) |
|------|----------------------|
| `services` | `Service: Services Hub` |
| `seo-ready-website` | `Service: SEO-Ready Website` |
| `digital-marketing-tools` | `Service: Digital Marketing Tools + CRO` |
| `ai-consulting` | `Service: AI Expert Consulting` |
| `work` | `Work: Hub` |
| `nexus-corp` | `Work: Nexus Corp` |
| `flow-store` | `Work: Flow Store` |
| `rank-project` | `Work: Rank Project` |
| `autobot-line` | `Work: AutoBot LINE` |
| `gold-brand` | `Work: Gold Brand` |
| `pitch-deck` | `Work: Pitch Deck` |
| `about` | `About Page` |
| `portfolio` | `Portfolio Page` |

If not created yet on prod, replicate from local using WP-CLI on hosting SSH:
```bash
ssh user@hashbox.co.th
cd /httpdocs

# Services tree
SVC_ID=$(wp post create --post_type=page --post_status=publish --post_title='Services' --post_name=services --porcelain)
wp post meta update $SVC_ID _wp_page_template page-services.php

for slug in seo-ready-website digital-marketing-tools ai-consulting; do
  ID=$(wp post create --post_type=page --post_status=publish --post_title="$slug" --post_name="$slug" --post_parent=$SVC_ID --porcelain)
  wp post meta update $ID _wp_page_template "page-$slug.php"
done

# Work tree
WORK_ID=$(wp post create --post_type=page --post_status=publish --post_title='Work' --post_name=work --porcelain)
wp post meta update $WORK_ID _wp_page_template page-work.php

for slug in nexus-corp flow-store rank-project autobot-line gold-brand pitch-deck; do
  ID=$(wp post create --post_type=page --post_status=publish --post_title="$slug" --post_name="$slug" --post_parent=$WORK_ID --porcelain)
  wp post meta update $ID _wp_page_template "page-work-$slug.php"
done

wp rewrite flush --hard
```

### 3. A/B Switch options

**Soft launch — Live Preview only**
1. WP Admin → Appearance → Themes
2. Click "Live Preview" on Hashbox Studio V2
3. Browse internally — visitors still see V1
4. Get feedback from team

**Full switch — risk visitor impact**
1. WP Admin → Appearance → Themes
2. Click "Activate" on Hashbox Studio V2
3. Verify on production URLs immediately
4. To roll back: click Activate on Hashbox Studio (V1)

**Recommended: 24-hour A/B**
1. Soft-launch via Live Preview to internal team for 1-2 days
2. If green-lit, schedule Activate during low-traffic window (TH 02:00-05:00)
3. Monitor GSC + GA4 + form submissions 7-14 days post-switch
4. If metrics drop, revert by activating V1

---

## Health checks after switch

### Within 1 hour
- [ ] Hard-refresh https://hashbox.co.th — see V2 hero + bento services
- [ ] Click each nav link → no 404s
- [ ] Submit test contact form → email arrives
- [ ] Mobile (iOS Safari + Android Chrome) — bottom sheet works
- [ ] Cloudflare cache purge (Cloudflare → Caching → Purge Everything)

### Within 24 hours
- [ ] GSC → Coverage report — no new indexation errors
- [ ] Lighthouse on prod (CrUX field data needs 28 days)
- [ ] Schema validator pass: https://validator.schema.org/?url=https://hashbox.co.th
- [ ] Rich Results test: https://search.google.com/test/rich-results?url=https://hashbox.co.th

### Within 7 days
- [ ] GSC clicks/impressions trend vs week before — should not drop sharply
- [ ] GA4 bounce rate + engagement — V2 should be neutral or better
- [ ] Contact form submission rate — should be ≥ V1

---

## Rollback plan

If V2 breaks something critical:

1. WP Admin → Appearance → Themes → Activate "Hashbox Studio" (V1)
2. Or via WP-CLI on hosting: `wp theme activate hashbox-studio`
3. Cloudflare → Purge cache
4. Confirm V1 live at https://hashbox.co.th

V2 stays installed but inactive. Fix issues in V2 repo, push, re-attempt.

---

## Cloudflare hardening (recommended before V2 launch)

5 security headers via Cloudflare → Rules → Transform Rules → Modify Response Header:

```
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: camera=(), microphone=(), geolocation=()
```

Match: `Hostname equals hashbox.co.th`

Lifts Lighthouse Best Practices from 78 → 95+

---

## Optional V2-only domain (sandbox before swap)

To test V2 on a separate URL without affecting prod:

1. Add Cloudflare subdomain: `v2.hashbox.co.th` (CNAME → prod)
2. Hosting → Add domain alias for v2.hashbox.co.th → same WP install
3. Configure subdomain to load V2 theme via:
   ```php
   // mu-plugins/v2-subdomain-theme.php
   add_filter('template', function($t) {
     return $_SERVER['HTTP_HOST'] === 'v2.hashbox.co.th' ? 'hashbox-studio-v2' : $t;
   });
   add_filter('stylesheet', function($s) {
     return $_SERVER['HTTP_HOST'] === 'v2.hashbox.co.th' ? 'hashbox-studio-v2' : $s;
   });
   ```
4. v2.hashbox.co.th serves V2 + main domain stays V1

Cleanest for true A/B without commitment.

---

## Status as of 2026-05-12

- ✅ V2 code complete (10 commits, 31 components, 17 templates)
- ✅ Pushed to https://github.com/tumthaweewat/hashbox-landing-v2
- ✅ Local verified — 14 URLs HTTP 200, Lighthouse A11y 96-100, SEO 100
- ⏳ Hosting webhook NOT yet configured for V2 repo
- ⏳ Prod theme directory `/themes/hashbox-studio-v2/` NOT yet created

To go live: do steps 1-2 from "Path A" or "Path B" above.

---

## Maintenance pattern post-launch

```bash
# Local edit
cd /Users/tumthaweewat/hashbox-landing-v2
# ... edit files ...
git add -A
git commit -m "feat: ..."
git push origin main
# Auto-deploys to /themes/hashbox-studio-v2/ if webhook set up
```

Local test before push:
```bash
# Switch to V2 locally
WP_PHP="/Users/tumthaweewat/Library/Application Support/Local/lightning-services/php-8.2.29+0/bin/darwin-arm64/bin/php"
WP_CLI="/Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/wp-cli.phar"
SITE="/Users/tumthaweewat/Local Sites/hashbox-test/app/public"
PHP_INI="/Users/tumthaweewat/Library/Application Support/Local/run/td4OAEY7Z/conf/php/php.ini"
"$WP_PHP" -c "$PHP_INI" "$WP_CLI" --path="$SITE" theme activate hashbox-studio-v2
# Test at http://hashbox-test.local
```

Switch back to V1 same way (replace last arg with `hashbox-studio`).
