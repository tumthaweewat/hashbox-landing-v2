# AI Search lead routing — 2026-09-09

## Changes prepared

- AI Search service CTAs and GEO Checker next step pass `service=ai-search` to the existing homepage form; no internal UTM parameters.
- Homepage service choices remain visible and enabled for Audit as well as Project enquiries. A known service is preselected once and remains editable. Website and goal fields use the existing form; goal remains optional.
- Audit help and submit copy reflect AI Search when selected. Existing project/phone/LINE validation remains intact.
- HubSpot scheduled attribution preserves the submitted service for non-Website enquiries. Website project labels and invalid-project rejection are retained.
- AI Search includes a clearly labelled report template, not invented customer results. Conflicting undated 56/61 keyword totals were removed; neither total is selected as authoritative. Other existing August 2026 statistics have not been independently validated in this change.
- llms.txt explanation now distinguishes optional content from robots.txt and Google's eligibility requirements. Source: https://developers.google.com/search/docs/appearance/ai-features

## Conversion audit boundaries

The existing AI Workflow and Website Audit scripts already use signed server confirmation and client deduplication for their conversion events. Their regression suites pass. This is code-level evidence, not proof of production delivery to GA4, Google Ads or HubSpot.

The homepage form posts through `hashbox_handle_contact_submit`, but its unsigned `contact=sent` redirect is not sufficient evidence for a new conversion. No homepage `generate_lead` emitter was found in the theme. GTM/plugin configuration must be inspected before choosing its sole event owner. Do not mark form-submit attempts or unsigned success URLs as lead conversions. No new conversion event or Google Ads destination was enabled here.

`wp_mail` acceptance is the current backend success criterion, not proof of HubSpot persistence. HubSpot attribution is scheduled two minutes later and depends on configured credentials, cron execution and the portal service property's accepted values. No contact was created and no live form was submitted in this work.

Homepage acquisition capture is not implemented by these routing changes. Inspect the active GTM/plugin capture before adding first-entry, service-page and submitted-page fields or UTM/GCLID persistence. `service` describes interest only and is not traffic attribution.

## Validation

Passed locally:
- `node tools/test-ai-search-routing.mjs`
- `node tools/test-audit-landing-tracking.mjs`
- `node tools/test-website-audit-tracking.mjs`
- `node tools/test-hubspot-attribution-contract.mjs`
- `node tools/test-conversion-ref-contract.mjs`
- `node tools/test-typography-contract.mjs`
- `node --check js/v2.js`
- `git diff --check`

PHP CLI is unavailable locally; PHP lint and rendered WordPress desktop/mobile QA remain required before deployment. No WordPress preview or live CRM/analytics end-to-end test was performed.

## Rollout

This repository documents main-branch deployment to the V2 theme. Review the branch/PR, run PHP lint on the changed templates and functions.php, verify V2 is the active theme, and preview the changed form and page on desktop/mobile. Merge only when ready to deploy. Roll back with a revert of this change if necessary.

Before spending or increasing ads budget: inspect GTM and Google Ads conversion goals, resolve homepage success tracking, and run an explicitly labelled test with notification/CRM automation understood. Match one confirmed submission to the CRM record and one intended lead event. Do not edit the Qualified Lead Ledger.
