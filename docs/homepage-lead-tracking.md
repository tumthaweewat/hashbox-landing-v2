# Homepage enquiry receipt and GTM contract

The AI Search CTA uses `/?service=ai-search#contact`. The homepage now prepares an unguessable reference, atomically claims it before notification, and records a signed receipt only when WordPress accepts the notification (`wp_mail` returns true). This measures an accepted enquiry, not email delivery, HubSpot contact creation, qualification, or revenue.

## Event contract

GTM owns Google tagging. The theme queues exactly one event per receipt in normal browser use:

| Field | Value |
|---|---|
| event | `hb_home_lead_v1` |
| hb_schema_version | integer `1` |
| hb_transaction_id | server-generated `HB-HOME-YYYYMMDD-<9–40 digits>` |
| hb_form_id | `homepage-contact` |
| hb_services | comma-separated, server-allowlisted selected service codes |
| hb_request_intent | `audit` or `project` |
| hb_lead_source | `homepage` |

No name, email, phone, website, message, signed capability, UUID or advertising click identifier is pushed into this event. No placeholder conversion value is supplied.

A GTM custom-event trigger must require the event above, schema 1, form ID `homepage-contact`, and transaction regex `^HB-HOME-[0-9]{8}-[0-9]{9,40}$`.

1. GA4 event tag: `generate_lead`, measurement ID from the existing Google tag; pass transaction_id, form_id, service and request_intent.
2. Google Ads conversion tag: a dedicated homepage enquiry conversion action; map transaction ID and set Count = One. Do not reuse the Website Audit label. Use this specific goal in the AI Search campaign and retain the dedicated AI Audit goal for AI Consulting.
3. Do not add click, submit-attempt or `contact=sent` URL triggers. Do not attach a second direct gtag sender to this event. Keep existing Website Audit / AI Workflow ownership unchanged.

## Behavior and limitations

- The preparation endpoint returns a fresh contact nonce; only AJAX-upgraded submissions opt into the receipt protocol. Cached old forms and no-JS forms can still submit, without a measured receipt.
- Replaying the same prepared reference returns the same accepted receipt. Concurrent or uncertain claimed submissions fail closed. Failed submission / missing or expired state / forged signature cannot generate the event.
- The receipt lasts six hours. Client localStorage and URL cleanup prevent normal refresh/back repetition. This is best-effort queue deduplication, not a guarantee of exactly-once delivery across browsers, cleared storage, consent settings or network blockers. Google Ads also receives the same transaction ID for deduplication.
- Attribution is captured on entry, retained per tab with 30-minute inactivity expiry, and a new campaign replaces all earlier campaign fields. Internal CTA links never receive added UTMs. Hidden form values carry the campaign to the existing server and HubSpot sync.
- Entry path, last service path and submission path are separate path-only notification fields. They are not added as new HubSpot properties automatically. Existing optional HubSpot reference properties accept HOME scope; custom fields still require the existing opt-in mapping. Contact creation and cron completion must be verified separately.
- Normal signup/submission behavior can be affected by JavaScript/network failure; preparation errors show a retry message without submitting or counting a lead.

## Verification and rollout

Automated behavior tests cover invalid/forged/expired/wrong-route receipts, atomic claims, replay, persistence failure, queue deduplication, campaign replacement, validation cancellation, double submit and preparation failure. No live email or CRM test record is sent by these tests.

Before spending: deploy this change, ensure confirmation query requests bypass CDN/page caches, configure the two GTM tags in a separate workspace, inspect Preview, then verify an explicitly authorized test submission against the notification, GA4/Ads diagnostics and HubSpot. Publish only this workspace's reviewed changes. Existing unrelated funnel diagnostics must not be bundled.

Rollback: revert this PR and remove/pause the dedicated homepage tags. Existing audit routes are unaffected.
