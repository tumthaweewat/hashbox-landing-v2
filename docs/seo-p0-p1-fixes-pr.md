# SEO P0/P1 fixes — PR description

## Changes

- Treat `/best-seo-agencies-bangkok-2026/` as English for the document language, Open Graph locale and schema language. No hreflang was added because there is no equivalent Thai version of this listicle.
- Align the Google AI Overview report's visible H1, title, description and `llms.txt` entry on the owner-approved 95-keyword, 30-day dataset. The latest result is 88 AI Overviews in 93 valid observations; two of the 95 tracked terms had no valid observation in that snapshot.
- Retitle `/website-audit/` around a free website scope estimate and preliminary quote, keeping its intent separate from the website development service page.
- Shorten the homepage, English AI consulting listicle and Thai AI consulting listicle descriptions. Shorten the requested title tags for `/เว็บไซต์รองรับ-ai-search-2026/`, `/services/`, `/seo-thai-guide-2026/` and `/aeo-คืออะไร-2026/`. Theme filters take precedence over stale Rank Math values on these URLs so the rendered metadata stays aligned.
- Add contextual links to Growth Audit, CRO Funnel Audit and clinic website development from the services hub and related service pages.
- Add sitewide LINE OA click instrumentation. Each `line_oa_click` dataLayer event includes `hb_schema_version`, a unique `hb_transaction_id`, the target URL, page path and CTA location.
- Keep partial SEO path overrides field-specific: a page with a title override retains its Rank Math/WordPress description, and a page with a description override retains its Rank Math/WordPress title. Regression checks cover the Bangkok SEO agencies and Thai AI consulting listicles.

## GTM follow-up for owner

In published container `GTM-5G2P48V2`, create a **Custom Event** trigger with event name `line_oa_click` (exact match). Attach a **GA4 Event** tag using the existing Google tag / measurement ID `G-WQ4CG18QQT`, with event name `line_oa_click`. Map `hb_schema_version`, `hb_transaction_id`, `hb_link_url`, `hb_page_path` and `hb_cta_location` as event parameters. Preview a LINE click and confirm one GA4 event before publishing the container. GTM was not changed in this PR.

## Out of scope

- Cloudflare HTTP-to-HTTPS 500 response.
- HTML edge cache behavior.
- Case-study evidence review.
