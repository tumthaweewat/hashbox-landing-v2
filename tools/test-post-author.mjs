import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

// Author box under founder posts (2026-10-07). /about/ is the page AI answers
// cite for the company (39 citations in 30 days) and no post linked to it.
const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const read = path => readFile(resolve(root, path), 'utf8');
const single = await read('single.php');
const part = await read('template-parts/post-author.php');
const fn = await read('functions.php');
const css = await read('design-system/blog.css');

const tags = single.indexOf('get_the_tags()'), box = single.indexOf("get_template_part( 'template-parts/post-author' )"), cta = single.indexOf('hb-post__cta"');
assert.ok(box > tags && box < cta, 'Author box renders after the tags and before the CTA');
assert.match(part, /if \( 1 !== \(int\) get_the_author_meta\( 'ID' \) \)\s*\{\s*return;/, 'Only founder posts get the box');
assert.match(part, /home_url\( '\/about\/' \)/, 'Links to /about/');
assert.match(part, /hashbox_founder_linkedin\(\)/, 'LinkedIn from the single source');
assert.match(part, /hashbox_founder_avatar_path\(\)/, 'Uses the small avatar, not the 480×600 portrait');
for (const key of ['author_kicker', 'author_bio', 'author_about']) {
  assert.equal(fn.match(new RegExp(`'${key}'\\s*=>`, 'g'))?.length, 2, `${key} needs an English and a Thai string`);
}
assert.match(css, /\.hb-post-author\s*\{/, 'Author box styles');
console.log('Post author box: founder only, links /about/ + LinkedIn, TH/EN strings, styled.');
