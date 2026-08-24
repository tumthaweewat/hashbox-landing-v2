import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';

const functionsSource = await readFile(new URL('../functions.php', import.meta.url), 'utf8');
const pageSource = await readFile(new URL('../page-audit-landing.php', import.meta.url), 'utf8');
const aiSource = await readFile(new URL('../js/audit-landing.js', import.meta.url), 'utf8');
const websiteSource = await readFile(new URL('../js/website-audit-tracking.js', import.meta.url), 'utf8');

function phpFunction(name, nextName) {
  const start = functionsSource.indexOf(`function ${name}(`);
  const end = nextName
    ? functionsSource.indexOf(`function ${nextName}(`, start)
    : functionsSource.length;
  assert.ok(start >= 0 && end > start, `missing PHP function ${name}`);
  return functionsSource.slice(start, end);
}

const generator = phpFunction('hashbox_generate_conversion_ref', 'hashbox_lead_transient_status');
assert.match(generator, /LAST_INSERT_ID\(CAST\(option_value AS UNSIGNED\) \+ 1\)/);
assert.match(generator, /option_value REGEXP '\^\[0-9\]\{1,15\}\$'/);
assert.match(generator, /wp_cache_delete\( \$option_name, 'options' \)/);
assert.match(generator, /microtime\( true \)/, 'reference must include a server clock component');
assert.match(generator, /random_int\( 0, 999999999 \)/, 'counter failure must use a numeric server fallback');
assert.doesNotMatch(generator, /wp_generate_uuid4/, 'Google conversion ref must never fall back to UUID');

assert.doesNotMatch(
  functionsSource,
  /\$_(?:GET|POST)\s*\[\s*['"]conversion_ref['"]\s*\]/,
  'conversion_ref must never be accepted from the client'
);
const aiMetaPrinter = phpFunction(
  'hashbox_print_ai_audit_confirmation_meta',
  'hashbox_disable_cache_for_confirmed_ai_audit_lead'
);
assert.match(aiMetaPrinter, /data-conversion-ref=/);
assert.match(aiMetaPrinter, /meta name="hashbox-confirmed-ai-lead"/);
const websiteMetaPrinter = phpFunction(
  'hashbox_print_website_audit_confirmation_meta',
  'hashbox_disable_cache_for_confirmed_website_audit_lead'
);
assert.match(websiteMetaPrinter, /data-conversion-ref=/);
assert.match(websiteMetaPrinter, /meta name="hashbox-confirmed-website-lead"/);
assert.match(
  pageSource,
  /hashbox_get_confirmed_ai_audit_lead_ref\(\)/,
  'AI success UI must use the authoritative signed verifier'
);
assert.doesNotMatch(pageSource, /\$lead_ref_param/, 'AI success UI must not trust a raw lead_ref query');

for (const [label, source] of [['AI', aiSource], ['Website', websiteSource]]) {
  assert.match(source, /transaction_id: conversionRef/, `${label} Google events must use conversion_ref`);
  assert.doesNotMatch(source, /transaction_id: leadRef/, `${label} must never send UUID as Google transaction_id`);
  assert.match(source, /eventID: leadRef/, `${label} Meta dedupe must retain UUID lead_ref`);
}

assert.match(
  functionsSource,
  /add_action\( 'hashbox_send_ai_confirmation_email', 'hashbox_send_ai_confirmation_email', 10, 4 \)/,
  'AI confirmation cron must accept conversion_ref as its fourth argument'
);
assert.doesNotMatch(
  functionsSource,
  /hashbox_conversion_ref['"]\s*=>/,
  'unverified HubSpot custom properties must not be written yet'
);

console.log('conversion-ref contract tests passed');
