import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const read = path => readFile(resolve(root, path), 'utf8');

// Breadcrumb: get_the_archive_title() returns "Author: <span class=vcard>…</span>",
// and the crumb is escaped — the tag showed up as text on /author/… (2026-10-07).
const crumbs = await read('template-parts/breadcrumbs.php');
const authorBranch = crumbs.indexOf('is_author()');
assert.ok(authorBranch > 0, 'Author archives need their own breadcrumb branch');
assert.ok(authorBranch < crumbs.indexOf('is_archive()'), 'The author branch must run before the generic archive branch');
assert.match(crumbs.slice(authorBranch, crumbs.indexOf('is_archive()')), /hashbox_founder_name\(\)/, 'Founder crumb uses the canonical name');

// Thai font: IBM Plex Sans Thai 400/500 are font-display: optional, so a
// weight-500 Thai line renders in the system (looped) Thai face on a first
// visit. Headings use 600/700, which swap in.
const author = await read('author.php');
const fonts = await read('design-system/fonts.css');
const about = await read('page-about.php');
for (const [path, source] of [['author.php', author], ['page-about.php', about]]) {
  const thaiSpan = source.match(/<span lang="th"[^>]*>/)?.[0];
  assert.ok(thaiSpan, `${path}: founder Thai name line must exist`);
  const weight = thaiSpan.match(/font-weight:\s*(\d+)/)?.[1] ?? '700';
  const face = [...fonts.matchAll(/@font-face\s*\{([^}]+)\}/g)].map(m => m[1])
    .find(f => f.includes("'IBM Plex Sans Thai'") && f.includes(`font-weight: ${weight};`) && f.includes('-thai-'));
  assert.ok(face, `${path}: no IBM Plex Sans Thai ${weight} Thai face`);
  assert.match(face, /font-display:\s*swap/, `${path}: Thai name weight ${weight} is not a swap face — first visits fall back to a non-CI font`);
}

// Layout: align with the header (.hb-nav__inner = 1280px), not the 896px prose width.
const containers = [...author.matchAll(/class="hb-container([^"]*)"/g)].map(m => m[1].trim());
assert.ok(containers.length >= 2, 'Hero and grid containers expected');
for (const c of containers) assert.equal(c, 'hb-container--xl', `Author page container "${c}" should be hb-container--xl`);



// 2026-10-07 owner feedback: name on one line, bio uses the full section width.
const blogCss = await read('design-system/blog.css');
assert.match(author, /<h1 class="hb-blog-hero__title hb-author-hero__name"/, 'Author H1 needs the hb-author-hero__name hook');
const nameRule = blogCss.match(/\.hb-author-hero__name\s*\{([^}]+)\}/)?.[1] ?? '';
assert.match(nameRule, /max-width:\s*none/, 'Author name must not inherit the 22ch title cap');
assert.match(blogCss, /@media \(min-width: 64rem\)\s*\{\s*\.hb-author-hero__name\s*\{[^}]*white-space:\s*nowrap/, 'Author name stays on one line from 1024px');
assert.ok(!/max-width:\s*640px/.test(author), 'Author bio must use the full section width');
const bioRule = blogCss.match(/\.hb-author-hero__bio\s*\{([^}]+)\}/)?.[1] ?? '';
assert.match(bioRule, /max-width:\s*none/, 'Author bio must override the 60ch lede cap');
assert.match(author, /class="hb-blog-hero__lede hb-author-hero__bio"/, 'Bio paragraph needs the hb-author-hero__bio hook');

// <title> on author archives fell through to the homepage title.
const fn = await read('functions.php');
const meta = fn.slice(fn.indexOf('function hashbox_get_seo_metadata'), fn.indexOf('function hashbox_get_seo_title'));
assert.match(meta, /if \( is_author\(\) \)/, 'hashbox_get_seo_metadata needs an author-archive branch');
console.log('Author page: breadcrumb, CI Thai font, full width, one-line name, full-width bio, archive title passed.');
