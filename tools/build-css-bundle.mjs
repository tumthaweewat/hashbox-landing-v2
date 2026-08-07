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
