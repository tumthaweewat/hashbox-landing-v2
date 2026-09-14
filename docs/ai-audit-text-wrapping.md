# AI audit short-text layout — 2026-09-14

User-approved exception to the Signal V3 prose measure: short introductory,
commercial and list copy should not wrap unnecessarily on desktop. Font sizes,
copy and semantics are unchanged. No nowrap, clipping or truncation was added.

Removed 52ch vendor and 70–75ch note/intro limits. Screening now uses a centered
44rem illustration above the full-width signals list instead of a narrow diptych.
Updated responsive image sizes to match. This supersedes the earlier diptych
description in ai-audit-section-layout.md. Existing mobile form polish is retained.

## Regression guard

Import `auditTextLayout` from `tools/assert-ai-audit-text-layout.mjs` in the browser
test harness. After navigation and `await page.evaluate(() => document.fonts.ready)`,
run `await page.evaluate(auditTextLayout)` at 320, 375, 414, 768, 1280, 1440, 1920px.
It counts rendered text rectangles (including inline strong text), requires one
line for the five specified groups at >=1280px, and rejects text/page overflow.
Do not replace this browser check with a source-code regex check.

Chrome fixture verification passed all seven widths with local PHP and assets.
All seven individual targets (three signals plus four other paragraphs) render
on one line at 1280, 1440 and 1920px. Smaller screens wrap naturally. Copy/form
parity, CTA anchor, contact switching and keyboard checks also passed.
No form submissions or third-party analytics requests were sent.

Hallmark review: existing Signal V3 tokens/fonts and Workbench preserved;
user-approved full-width utility copy takes precedence over prose measure.
The longer desktop Screening section is an intentional tradeoff for one-line
signals. No global typography or palette migration was made.
