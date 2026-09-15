# AI Workflow Audit — ads landing presentation

Scope: `/ai-workflow-audit/` only, Signal V3 values from `design.md`.

- Offer-first split hero with separately attributed AutoBot proof.
- Warm paper / indigo CI, dark utility masthead, no hero glow.
- Restored mobile masthead CTA, existing sticky CTA behavior retained.
- Form precedes project lead/contact links on mobile; desktop remains split.
- Published copy, prices, form fields, nonces, attribution and submit logic retained.
- No new assets, dependencies, animations, or third-party scripts in production.

Verification: typography, PHP lint, audit tracking, HubSpot attribution,
conversion-ref and AI presentation contract tests pass. Isolated browser fixture
renders the actual PHP template with WordPress helper stubs inside the public page
shell, using local CSS/fonts. Verified at 320, 375, 414, 768, 1280 and 1920px;
no horizontal overflow, one H1, correct font roles. Rendered copy and form markup
match the baseline, apart from presentation order. Contact preference requirement
and the form anchor were checked. No real leads were submitted.

This does not replace a WordPress staging smoke test or prove ad conversion uplift.
Before publishing a task branch, confirm Plesk deploys only `main` as documented in
`docs/github-workflow.md`; use PR and required checks, never bypass protection.
