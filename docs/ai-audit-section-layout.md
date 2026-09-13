# AI Workflow Audit — section layout refinement

Presentation-only follow-up to PR #17. Uses existing page-scoped Signal V3 tokens;
does not migrate other pages or change global navigation/footer.

Hallmark: Workbench in the locked `design.md` family, editorial/technical voice.
Existing cached preflight is historical; current typography authority remains
IBM Plex Sans Thai display and Noto Sans Thai body from the locked system.
No new palette, token export, dependency, imagery, motion or business logic.

| Section | Desktop | Mobile |
| --- | --- | --- |
| Hero | Existing asymmetric offer/proof split | Offer, then proof |
| AutoBot | Centered introduction, horizontal process, metric strip | Stacked process and metrics |
| Use cases | Full content-width comparison rows | Stacked rows |
| Screening | Centered introduction, image/signals diptych, outcomes across width | Image, signals, outcomes |
| Engagements | Full-width ledger, budget/time metadata rail | Metadata beneath each scope |
| Form | Centered 48rem maximum, lead/contact beneath | Single column; optional details preserved |
| FAQ | Centered 52rem maximum, left-aligned answers | Full available content width |

Full width means the 78rem content container, not edge-to-edge prose. Background
bands span the viewport. Removed the repeated side-by-side form/sidebar pattern
and the standalone oversized illustration row. Illustration caption remains
explicitly conceptual and separate from AutoBot proof.

## Verification

- Chrome fixture uses current public page shell, actual locally rendered PHP
  template, and local theme assets. External scripts and form requests blocked.
- 320, 375, 414, 768, 1280×800, 1920×800: no horizontal overflow; image loads.
- Text parity and form DOM parity against `babd16a` passed.
- Mobile CTA lands below navigation; LINE contact validation remains conditional.
- PHP syntax, typography, presentation, tracking, attribution and conversion-ref
  contracts checked. This is not a live submission/delivery test.
- Hallmark review: scoped layout, token reuse, no fabricated proof or chrome,
  no new animation. Shared navigation/footer retained intentionally.
