#!/usr/bin/env node
/**
 * Generate WebP variants for the v4 ad artwork used on the landing pages.
 *
 * The source PNGs stay in git as the canonical ad-platform uploads; the
 * WebP files are what the site itself serves. Re-run after regenerating
 * artwork with generate-v4-artwork.mjs.
 *
 * Usage:
 *   node tools/optimize-ad-images.mjs
 *   (needs `sharp` installed nearby, or point SHARP_BASE at a directory
 *   whose node_modules contains it)
 */
import { readdirSync, mkdirSync } from 'node:fs';
import { join, basename } from 'node:path';
import { fileURLToPath } from 'node:url';
import { createRequire } from 'node:module';

const require = createRequire(
  process.env.SHARP_BASE ? join(process.env.SHARP_BASE, 'noop.js') : import.meta.url
);
const sharp = require('sharp');

const ROOT = join(fileURLToPath(new URL('.', import.meta.url)), '..');
const SRC_DIR = join(ROOT, 'assets/ads/hashbox');
const OUT_DIR = join(SRC_DIR, 'webp');

// Widths per aspect family — small size covers 1x layout width,
// large covers retina / wide layouts.
const VARIANTS = {
  linkedin_wide: [640, 1200],
  meta_square: [540, 1080],
  meta_portrait: [540, 1080],
};

const QUALITY = 78;

mkdirSync(OUT_DIR, { recursive: true });

const files = readdirSync(SRC_DIR).filter((f) => f.endsWith('_v4.png'));

for (const file of files) {
  const prefix = Object.keys(VARIANTS).find((p) => file.startsWith(p));
  if (!prefix) continue;
  const stem = basename(file, '.png');
  for (const width of VARIANTS[prefix]) {
    const out = join(OUT_DIR, `${stem}-${width}w.webp`);
    const info = await sharp(join(SRC_DIR, file))
      .resize({ width, withoutEnlargement: true })
      .webp({ quality: QUALITY })
      .toFile(out);
    console.log(`${basename(out)}  ${Math.round(info.size / 1024)} KiB`);
  }
}
