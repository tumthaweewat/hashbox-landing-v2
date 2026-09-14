import assert from 'node:assert/strict';
import vm from 'node:vm';
import { readFile } from 'node:fs/promises';

const read = name => readFile(new URL('../' + name, import.meta.url), 'utf8');
const template = await read('page-audit-landing.php');
const css = await read('css/ai-workflow-audit.css');
const tokens = await read('tokens.css');
const script = await read('js/audit-landing.js');
const examples = template.match(/<div class="hb-ai-business-examples">[\s\S]*?<\/details>\s*<\/div>/)?.[0];
assert.ok(examples, 'Business examples must remain in the existing use-cases section');
assert.ok(template.indexOf(examples) < template.indexOf('class="hb-ai-usecases__intro"'));
assert.match(examples, /ตัวอย่างงานที่พัฒนา/);
assert.match(examples, /แจ้งเตือนเมื่อสต็อกเหลือน้อย/);
assert.match(examples, /โดยไม่ต้องใช้ AI ทุกขั้นตอน/);
assert.match(examples, /แนวทางการใช้งาน ไม่ใช่เคสที่ยืนยันการส่งมอบหรือผลลัพธ์แล้ว/);
assert.match(examples, /ให้คนตรวจและอนุมัติก่อนส่ง/);
assert.match(examples, /<details class="hb-ai-example-options">/);
assert.doesNotMatch(examples, /Micro Precision|MPC|Smile Account|SQL|OCR|\d+%|ใช้งานจริงแล้ว/i,
  'Do not disclose client details or promote unconfirmed scope/results');
assert.match(css, /\.hb-ai-example-options > summary:focus-visible/);
const optional = template.match(/<details class="hb-ai-form__optional">[\s\S]*?<\/details>/)?.[0];
for (const field of ['service', 'timeline', 'website', 'budget', 'contact_preference', 'contact_detail']) {
  assert.ok(optional?.includes(`name="${field}"`), `${field} must remain available in optional details`);
}
assert.ok(template.indexOf('id="audit-problem"') < template.indexOf('<details class="hb-ai-form__optional">'));
const contactFn = script.slice(script.indexOf('  function initAiContactRequirement('), script.indexOf('  function initAiStickyCta('));
const handlers = {};
const attributes = {};
const preference = { value: '', addEventListener: (name, fn) => { handlers[name] = fn; } };
const detail = { value: 'preserve-me', setAttribute: (name, value) => { attributes[name] = value; }, removeAttribute: name => { delete attributes[name]; }, addEventListener() {} };
const mark = {};
const label = {};
const controls = { '[data-ai-contact-preference]': preference, '[data-ai-contact-detail]': detail, '[data-ai-contact-required]': mark, '[data-ai-contact-label]': label };
vm.runInNewContext(contactFn + '\ninitAiContactRequirement(form);', { form: { querySelector: selector => controls[selector] } });
for (const [value, type, autocomplete, text] of [['โทร', 'tel', 'tel', 'เบอร์โทรศัพท์'], ['LINE', 'text', 'off', 'LINE ID'], ['', 'text', 'off', 'เบอร์โทร / LINE ID']]) {
  preference.value = value;
  handlers.change();
  assert.equal(detail.type, type);
  assert.equal(attributes.autocomplete, autocomplete);
  assert.equal(detail.required, Boolean(value));
  assert.equal(mark.hidden, !value);
  assert.equal(label.textContent, text);
  assert.equal(detail.value, 'preserve-me', 'Changing contact preference must not erase input');
}
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
const figure = template.match(/<figure class="hb-ai-workflow-figure">[\s\S]*?<\/figure>/)?.[0];
assert.match(template, /class="hb-ai-screening__intro"/);
assert.match(template, /class="hb-ai-screening__visual"/);
const rhythm = css.slice(css.indexOf('/* Section rhythm:'));
assert.ok(rhythm.length > 0, 'Section-specific layout rules must be present');
assert.match(rhythm, /\.hb-ai-case__layout\s*\{[^}]*grid-template-columns: minmax\(0, 1fr\)/);
assert.match(rhythm, /\.hb-audit-form-layout\s*\{[^}]*max-width: 48rem;[^}]*margin-inline: auto/);
assert.match(rhythm, /\.hb-ai-screening__visual\s*\{[^}]*grid-template-columns: minmax\(0, 1fr\)/);
assert.match(rhythm, /\.hb-ai-screening__visual \.hb-ai-workflow-figure\s*\{[^}]*max-width: 44rem/);
assert.match(rhythm, /\.hb-container--md\s*\{[^}]*max-width: 52rem/);
assert.ok(figure, 'Concept illustration must remain separate from case-study proof');
assert.match(figure, /ภาพจำลองแนวทางการทำงาน ไม่ใช่หน้าจอระบบลูกค้าจริง/);
assert.match(figure, /width="1536" height="1024" loading="lazy" decoding="async"/);
assert.match(figure, /768w,[\s\S]*1536w/);
assert.ok(template.indexOf(figure) > template.indexOf('<section class="hb-ai-screening">'));
for (const size of [768, 1536]) {
  const asset = await readFile(new URL(`../assets/ai-workflow/workflow-concept-${size}.webp`, import.meta.url));
  assert.equal(asset.toString('ascii', 8, 12), 'WEBP');
  assert.ok(asset.length < 50000, 'Concept image should stay lightweight');
}
console.log('AI audit presentation contract passed');
