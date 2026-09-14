# AI Workflow Audit — business examples

Date: 2026-09-14
Base: main 806c7a1
Scope: additive content in the existing use-cases section only.

## Editorial boundaries

- The owner confirmed development of low-stock alerts. The stock example says
  “ตัวอย่างงานที่พัฒนา”, not a verified production rollout or measured outcome.
- No delivery channel, integration, forecasting, purchasing automation, customer
  identity, commercial terms, or performance metric is asserted.
- Stock alerts can be rules-based automation; the copy does not mislabel every
  automated task as AI.
- Email sorting, quote preparation, and document tracking are explicitly labelled
  illustrative approaches, not completed customer case studies.
- Quote preparation requires human review and approval before sending.
- Source proposals remain outside the repository; no customer documents are
  published or linked.

## Presentation

Hallmark component-scope review; existing Signal V3 tokens and page structure
retained. A ruled problem / system / human-decision ledger precedes technical
service choices. Additional examples use a native details/summary disclosure,
collapsed initially to limit page length. No new images, scripts, fonts, token
definitions, analytics hooks, or form fields.

Disclosure states: closed/open, pointer hover/active, immediate keyboard focus.
Loading/error/success/disabled are not applicable to this static native disclosure.

## Verification

- PHP syntax and git diff whitespace checks passed.
- Presentation, typography, audit tracking, conversion reference, and HubSpot
  attribution contract scripts passed.
- Headless Chrome fixture rendered local PHP/CSS/JS inside the public page shell;
  third-party scripts and requests were blocked. This is not a deployed-page test.
- Widths: 320, 375, 414, 768, 1280, 1440, and 1920 CSS pixels.
- No horizontal overflow, including expanded examples; existing desktop short-copy
  line-count guard passed with fonts loaded.
- Screenshots of the new content reviewed at all seven widths.
- Enter opens and Space closes the native disclosure at all tested widths.
- Existing copy parity passed after removing the additive example block; form
  name/type/required/value parity passed without exclusions.
- Existing form alignment, contact preference state, value retention and essential
  field tab order passed. CTA anchor landed approximately 88px below viewport top.
- No real form submission was made.

Local browser harness: /private/tmp/hashbox-design-test/examples-test.mjs
Local screenshots: /private/tmp/hashbox-design-test/examples-screens/

Pending: deployment authorization and post-deployment verification. Further stock
capabilities or outcome claims require owner confirmation and measurement.
