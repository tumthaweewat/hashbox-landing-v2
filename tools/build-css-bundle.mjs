#!/usr/bin/env node
/**
 * Concatenate + lightly minify the design-system layers into
 * design-system/bundle.min.css — one render-blocking request instead
 * of seven. Re-run after editing any design-system/*.css file.
 *
 * Usage: node tools/build-css-bundle.mjs
 */
import { readFileSync, writeFileSync } from 'node:fs';
import { join } from 'node:path';
import { fileURLToPath } from 'node:url';

const ROOT = join(fileURLToPath(new URL('.', import.meta.url)), '..');
const DS = join(ROOT, 'design-system');

const LAYERS = [
  'fonts.css',
  'tokens.css',
  'primitives.css',
  'surface.css',
  'navigation.css',
  'interactive.css',
  'composed.css',
];

const minify = (css) =>
  css
    .replace(/\/\*[\s\S]*?\*\//g, '')
    .replace(/\s+/g, ' ')
    .replace(/\s*([{}:;,>])\s*/g, '$1')
    .replace(/;}/g, '}')
    .trim();

const out = LAYERS.map((f) => minify(readFileSync(join(DS, f), 'utf8'))).join('\n');
const dest = join(DS, 'bundle.min.css');
writeFileSync(dest, out);
console.log(`bundle.min.css  ${Math.round(out.length / 1024)} KiB raw`);

// The homepage needs the legacy resets on first paint, before the rest of style.css arrives.
const legacy = readFileSync(join(ROOT, 'style.css'), 'utf8');
const baseEnd = legacy.indexOf('/* End of homepage base rules. */');
if (baseEnd === -1) throw new Error('Missing homepage base boundary in style.css');
writeFileSync(join(ROOT, 'css/home-base.min.css'), minify(legacy.slice(0, baseEnd)) + '\n');

// These two blog card rules also match front-page.php when WordPress uses the latest-posts setting.
const blog = readFileSync(join(DS, 'blog.css'), 'utf8');
const homeCards = ['body', 'title'].map(part => {
  const rule = blog.match(new RegExp('^\\.hb-card__' + part + '\\s*\\{[^}]+\\}', 'm'));
  if (!rule) throw new Error('Missing shared blog card rule: ' + part);
  return minify(rule[0]);
});
writeFileSync(join(ROOT, 'css/home-blog-cards.min.css'), homeCards.join('\n') + '\n');
