# AI audit action clarity

Date: 2026-09-14. Scope: AI Workflow Audit buttons, links and disclosures.

## Copy and UI

- Hero: ปรึกษาโจทย์ AI ฟรี. Navigation/mobile: ปรึกษา AI ฟรี.
- Submit: ส่งข้อมูลขอคำปรึกษา. This describes submission rather than promising
  an immediate strategy deliverable. Existing free 30-minute Screening scope stays.
- Decorative, fixed inline SVG icons distinguish consultation, proof, submission,
  phone, email, external links and disclosure. No icon dependency or remote asset.
- Visible text remains the accessible name; SVGs are aria-hidden and unfocusable.
- Primary hero and submit controls are 56px tall at default text size. The mobile
  sticky CTA spans the available width. Navigation remains a compact 44px control.
- Native summary disclosure has a clear chevron with open/closed orientation.
- Signal V3 tokens, fonts and surrounding page structure retained (Hallmark
  component scope). No redesign of other page families.

## Verification

- PHP syntax: functions.php, header.php, page-audit-landing.php and icon helper.
- Presentation, typography, tracking, conversion-ref and HubSpot contracts pass.
- Local PHP-rendered fixture with local theme assets, not deployed WordPress.
- Chrome tested at 320/375/414/768/1280/1440/1920px. No horizontal overflow.
- Primary controls carry decorative icons, have no inner overflow, and meet their
  target heights. Native disclosure keyboard open/close passes.
- Existing text/layout guards and form field parity pass. Copy parity excludes
  only the approved CTA/optional-summary wording and replacement arrow glyphs.
- Button/summary text contrast checked against computed surfaces (minimum 4.5:1).
- No real form submission. Existing server-rendered submission feedback, required
  fields, contact-preference handling, attribution and conversion hooks unchanged.
- Local harness: /private/tmp/hashbox-design-test/actions-test.mjs
- Local screenshots: /private/tmp/hashbox-design-test/actions-screens/

Reference: https://www.w3.org/WAI/ARIA/apg/patterns/button/ — retain an accessible
label; icons supplement rather than replace the visible action wording.

Not deployed; post-deployment verification remains pending authorization.
