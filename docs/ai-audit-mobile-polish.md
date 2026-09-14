# AI audit mobile polish — 2026-09-14

Hallmark / Signal V3 Workbench, scoped to AI Workflow Audit. The user permits
Signal V3 changes, but this pass reuses existing tokens; no global migration.

- Compact mobile proof spacing makes the AutoBot figure visible sooner.
- Compact section/ledger spacing; Screening uses the existing accent-text token.
- Keep all engagement copy and prices visible, without adding disclosures.
- Move service/timeline into existing optional details; preserve their defaults,
  names and submitted values. Name, company, email and problem remain required.
- Phone/LINE labels, input type, keyboard and autocomplete follow preference;
  preserve the entered value and the existing conditional requirement.

## Verification

Chrome fixture renders the actual PHP template inside the public page shell,
serving local assets. All external scripts and form submissions blocked.
Checked 320, 375, 414, 768, 1280 and 1920px: no overflowing elements; centered
form, expected desktop process/image grids, correct heading/body fonts.
At 375px: total height 9,529px (previous live review 10,399px); engagement
section 1,662px (1,885px); form section 1,426px (1,688px). These are layout
measurements, not conversion improvements or performance scores.

Published text parity and form name/type/required/default-value parity passed
against HEAD. Keyboard tab order: name, company, email, problem. CTA target
starts about 88px below viewport top. Phone/LINE/email switching preserves
input and conditional required status. PHP syntax, JS syntax, typography,
presentation, tracking, attribution and conversion-ref contracts passed.

No live lead submission, delivery test, Core Web Vitals or conversion experiment
was performed. Shared navigation/footer and all existing conversion hooks remain.
