# English SEO service-page pilot

Scope: `/en/seo/`, approved redesign, 20 September 2026. Deployment authorized by the user with connected-browser visual QA still outstanding.

## Design and delivery

- Signal V3 tokens, IBM Plex Sans Thai display and Noto Sans Thai body. The shared shell keeps its current layout; its destinations are adapted only on this template.
- Split hero with the existing Hashbox PageSpeed report; performance is explicitly labelled as lab evidence, not ranking or field data.
- Published case links, eight-service ledger, illustrative Pexels consultation photo, guarantee timeline, compact KPI list, pricing with minimum term/VAT, FAQ, and an English on-page audit form.
- Guarantee wording now follows `page-guarantee-terms.php`: 90 days **after** the technical pass; either growth criterion passes; free continuation only if neither passes; paid initial retainer, no retrospective refund.
- Image provenance and licensing: `assets/services/seo/README.md`. Pexels people are illustrative, not claimed to be Hashbox staff or clients.

## Form contract

`hashbox_contact` remains the delivery handler. Name, email, public website and privacy consent are required; goal is optional. Client/server validation, refreshed nonce, honeypot, same-page English feedback, temporary same-tab recovery on failure, and server-confirmed success receipt are included. No live test lead was submitted.

CRM attribution uses `service=seo`, `landing_slug=en-seo`. Confirmed success emits generic GA4 `generate_lead`; it deliberately does **not** fire the Website Ads conversion. Ads/GTM configuration was not changed. The pre-existing generic contact backend has no sitewide rate limit; this redesign does not introduce one.

## Dependencies to deploy together

`page-en-seo.php`, shared helper call changes in `header.php`/`footer.php`/`functions.php`, `inc/en-seo-{page,icons,contact}.php`, `template-parts/en-seo-contact.php`, `css/en-seo.css`, `js/en-seo-contact.js`, and `assets/services/seo/`.

The existing untracked Signal V3 export `design-system/v3/tokens.css` is now a page-scoped dependency. Include its canonical `tokens.source.json`, generated exports and `tools/build-design-system-v3.mjs` in the migration package when committing. No generated token file was modified by this task. Do not stage unrelated worktree changes.

## Verification

Passed locally: PHP syntax; `tools/test-en-seo-page.php`; `tools/test-en-seo-contact.php` (including the real shared handler with mail/CRM I/O mocked); `tools/test-en-seo-contact.mjs`; `tools/test-en-seo-design.mjs` (17 token contrast pairs); existing typography, HubSpot attribution, conversion-ref, website-audit and AI audit tracking contract tests.

Outstanding visual QA: connected-browser checks at 320, 375, 414, 768, 1280×800, 1440 and 1920px; keyboard navigation, form/FAQ states, direct `#seo-contact` alignment and reduced motion. The browser connector returned no available browser, so these are **not marked passed**. The user subsequently authorized deployment with that limitation disclosed. Existing case links and published claims were checked against live HTML; this task does not independently certify historical client outcomes.
