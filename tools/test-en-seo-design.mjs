import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
const root = new URL('../', import.meta.url);
const tokens = JSON.parse(await readFile(new URL('design-system/v3/tokens.source.json', root), 'utf8'));
const css = await readFile(new URL('css/en-seo.css', root), 'utf8');
// Token-level WCAG checks, not a substitute for computed browser styles.
function luminance(name) {
  const [L, C, H] = tokens.color[name].$value.match(/[\d.]+/g).map(Number);
  const angle = H * Math.PI / 180, a = C * Math.cos(angle), b = C * Math.sin(angle), l = L / 100;
  const l3 = (l + .3963377774 * a + .2158037573 * b) ** 3;
  const m3 = (l - .1055613458 * a - .0638541728 * b) ** 3;
  const s3 = (l - .0894841775 * a - 1.291485548 * b) ** 3;
  const rgb = [4.0767416621*l3 - 3.3077115913*m3 + .2309699292*s3,
    -1.2684380046*l3 + 2.6097574011*m3 - .3413193965*s3,
    -.0041960863*l3 - .7034186147*m3 + 1.707614701*s3].map(v => Math.max(0, Math.min(1, v)));
  return .2126*rgb[0] + .7152*rgb[1] + .0722*rgb[2];
}
const pairs = [
  ['ink', 'paper', 4.5], ['ink', 'paper-2', 4.5], ['muted', 'paper', 4.5],
  ['muted', 'paper-2', 4.5], ['muted', 'paper-3', 4.5], ['neutral', 'paper', 4.5],
  ['accent-strong', 'paper', 4.5], ['accent-strong', 'paper-2', 4.5],
  ['accent-ink', 'accent', 4.5], ['accent-ink', 'accent-strong', 4.5],
  ['error', 'error-soft', 4.5], ['success', 'success-soft', 4.5],
  ['focus', 'paper', 3], ['focus', 'paper-2', 3], ['ink', 'accent', 3],
  ['neutral', 'paper', 3], ['neutral', 'paper-2', 3]
];
for (const [fg, bg, min] of pairs) {
  const [light, dark] = [luminance(fg), luminance(bg)].sort((a,b) => b-a);
  const ratio = (light + .05)/(dark + .05);
  assert.ok(ratio >= min, `${fg}/${bg}: ${ratio.toFixed(2)} < ${min}`);
}
assert.match(css, /font-family: var\(--font-display\)/);
assert.match(css, /var\(--font-body\)/);
assert.match(css, /overflow-x: clip/);
assert.match(css, /minmax\(0, 1fr\)/);
assert.match(css, /min-width: 40rem/);
assert.match(css, /min-width: 60rem/);
assert.match(css, /prefers-reduced-motion: reduce/);
assert.match(css, /:focus-visible/);
assert.match(css, /\[aria-invalid=true\]/);
assert.doesNotMatch(css, /transition:\s*all|linear-gradient|radial-gradient|min-height:\s*100vh/);
assert.doesNotMatch(css, /#[a-f\d]{3,8}\b|rgba?\(|hsla?\(|oklch\(/i, 'Page CSS must consume canonical colour tokens.');
console.log(`EN SEO design: ${pairs.length} token contrast pairs and responsive/style safeguards passed (browser review still required).`);
