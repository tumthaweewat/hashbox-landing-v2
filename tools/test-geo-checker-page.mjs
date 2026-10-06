import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import { resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

// /geo-checker/ had 55 words (audit 2026-10-06). The page now explains the 14
// checks — from hashbox_geo_checker_criteria(), which must match what the
// handler actually scores, check for check and weight for weight.
const root = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const fn = await readFile(resolve(root, 'functions.php'), 'utf8');
const page = await readFile(resolve(root, 'page-geo-checker.php'), 'utf8');

const scored = [...fn.matchAll(/\$add\( \$checks, '([a-z0-9]+)', '[^']*', [^;]*?, (\d+), '/g)].map(m => [m[1], Number(m[2])]);
assert.equal(scored.length, 14, 'Handler scores 14 checks');
const body = fn.slice(fn.indexOf('function hashbox_geo_checker_criteria'), fn.indexOf('function hashbox_geo_checker_criteria') + 4000);
assert.ok(body.length > 100, 'hashbox_geo_checker_criteria() must exist');
const listed = [...body.matchAll(/'id' => '([a-z0-9]+)',\s*'weight' => (\d+)/g)].map(m => [m[1], Number(m[2])]);
assert.deepEqual(listed, scored, 'Criteria on the page must match the scored checks and weights, in order');
assert.equal(scored.reduce((s, [, w]) => s + w, 0), 100, 'Weights sum to 100');
assert.match(page, /hashbox_geo_checker_criteria\(\)/, 'Page renders the criteria');
assert.match(page, /'@type'\s*=>\s*'FAQPage'/, 'Visible FAQ has FAQPage schema');
console.log('GEO checker page: 14 criteria match the handler (weights sum to 100), FAQ + schema.');
