import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

// /website-audit/ had two H1s (audit 2026-10-06): page.php prints the title as
// an H1 and the page's own content (a custom HTML landing) has its own H1.
const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const page = await readFile(resolve(root, 'page.php'), 'utf8');
assert.match(page, /stripos\(\s*\(string\) get_post_field\( 'post_content'/, 'page.php must check the content for its own <h1>');
assert.ok(!/<h1 class="hb-h1"><\?php the_title\(\); \?><\/h1>/.test(page), 'page.php must not print the title as an unconditional H1');
console.log('page.php: title is an H1 only when the content has none.');
