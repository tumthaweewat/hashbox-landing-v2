import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';

const read = name => readFile(new URL('../' + name, import.meta.url), 'utf8');
const template = await read('page-audit-landing.php');
const css = await read('css/ai-workflow-audit.css');
const tokens = await read('tokens.css');
assert.match(tokens, /body\.hb-audit-landing--ai_workforce\s*\{/, 'CI palette must be page-scoped');
assert.match(css, /\.hb-ai-hero__availability\s*\{[^}]*font-family: var\(--font-body\)/, 'Thai offer label must not use data font');
assert.match(css, /\.hb-nav__actions > \.hb-btn\s*\{[^}]*display: inline-flex/, 'Campaign CTA must remain available on mobile');
assert.ok(template.indexOf('class="hb-ai-project-contact"') > template.indexOf('</form>'), 'Mobile form must precede project contact');
assert.match(template, /id="audit-form"/);
assert.match(template, /data-ai-sticky-cta aria-hidden="true" inert/);
for (const field of ['name','company','email','problem','pdpa','form_context','landing_slug','redirect_to']) {
  assert.ok(template.includes(`name="${field}"`), `Missing form field ${field}`);
}
for (const hook of ['data-audit-form','data-attribution-field','data-track-event="ai_cta_click"','hashbox_ai_nonce']) {
  assert.ok(template.includes(hook), `Missing conversion contract ${hook}`);
}
console.log('AI audit presentation contract passed');
