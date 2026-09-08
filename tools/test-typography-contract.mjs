import assert from 'node:assert/strict';
import { readFile, access, readdir } from 'node:fs/promises';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const read = path => readFile(resolve(root, path), 'utf8');
const fonts = await read('design-system/fonts.css');
for (const [role, family] of Object.entries({display:'IBM Plex Sans Thai', body:'Noto Sans Thai', data:'IBM Plex Mono'})) {
  assert.ok(fonts.includes(`--ci-font-${role}: '${family}'`), `Missing canonical ${role} font`);
}
const roles = /--(?:hb-|hb5-|faq-)?font-(?:display|body|mono|outlier)\s*:\s*([^;]+);/g;
const files = ['style.css', 'design-system/tokens.css', ...(await readdir(resolve(root, 'css'))).filter(f=>f.endsWith('.css')).map(f=>'css/'+f)];
for (const path of files) {
  const source = await read(path);
  for (const match of source.matchAll(roles)) {
    assert.match(match[1], /^var\(--/, `${path}: font role must reference shared tokens, not a literal family`);
  }
}
for (const face of fonts.matchAll(/@font-face\s*\{([^}]+)\}/g)) {
  const source = face[1];
  const url = source.match(/url\(['"]([^'"]+)/)?.[1];
  if (url) await access(resolve(root, 'design-system', url));
  if (/font-weight:\s*(600|700);/.test(source) && source.includes("'IBM Plex Sans Thai'")) {
    assert.match(source, /font-display:\s*swap/, 'Display fonts must not remain on fallback when late');
  }
}
const php = await read('functions.php');
assert.match(php, /add_action\( 'wp_enqueue_scripts', 'hashbox_enqueue_heading_ci', 100 \)/, 'Shared typography must be enqueued for all public templates');
const layers = ['fonts','tokens','primitives','surface','navigation','interactive','composed'];
const minify = css => css.replace(/\/\*[\s\S]*?\*\//g,'').replace(/\s+/g,' ').replace(/\s*([{}:;,>])\s*/g,'$1').replace(/;}/g,'}').trim();
const expected = (await Promise.all(layers.map(name=>read(`design-system/${name}.css`)))).map(minify).join('\n');
assert.equal(await read('design-system/bundle.min.css'), expected, 'CSS bundle is stale: run node tools/build-css-bundle.mjs');
console.log(`Typography contract passed: canonical roles, ${files.length} stylesheets, font assets, global enqueue, CSS bundle.`);
