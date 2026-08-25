import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';

const functionsSource = await readFile(new URL('../functions.php', import.meta.url), 'utf8');

function phpFunction(name, nextName) {
  const start = functionsSource.indexOf(`function ${name}(`);
  const end = nextName
    ? functionsSource.indexOf(`function ${nextName}(`, start)
    : functionsSource.length;
  assert.ok(start >= 0 && end > start, `missing PHP function ${name}`);
  return functionsSource.slice(start, end);
}

const submitHandler = phpFunction('hashbox_handle_contact_submit', 'hashbox_get_hubspot_private_app_token');
assert.match(submitHandler, /\$hubspot_attribution\s*=\s*array_merge\(\s*\$utm/s);
for (const key of ['lead_ref', 'conversion_ref', 'landing_slug']) {
  assert.match(
    submitHandler,
    new RegExp(`'${key}'\\s*=>\\s*\\$${key}`),
    `${key} must be added from the trusted server-side variable to the cron payload`
  );
}
assert.match(
  submitHandler,
  /\$hubspot_sync_args\s*=\s*array\(\s*\$email,\s*\$hubspot_attribution\s*\)/,
  'the scheduled HubSpot job must receive the extended payload'
);
assert.match(
  submitHandler,
  /\$hubspot_schedule\s*=\s*wp_schedule_single_event\([\s\S]*?\$hubspot_sync_args,\s*true\s*\);/,
  'initial scheduling must request WP_Error details instead of failing silently'
);
assert.match(
  submitHandler,
  /wp_next_scheduled\( 'hashbox_sync_lead_attribution_to_hubspot', \$hubspot_sync_args \)/,
  'initial scheduling must check for an equivalent existing event before logging an error'
);
assert.match(submitHandler, /'already_scheduled', 'initial_schedule'/);
assert.match(submitHandler, /'schedule_failed', 'initial_schedule'/);
assert.match(
  submitHandler,
  /'_hashbox_hubspot_sync_attempt'\s*=>\s*1/,
  'new jobs must start at attempt 1'
);

const retryPolicy = phpFunction(
  'hashbox_hubspot_sync_max_attempts',
  'hashbox_prepare_hubspot_contact_properties'
);
assert.match(retryPolicy, /function hashbox_hubspot_sync_max_attempts\(\)\s*{\s*return 4;/s);
assert.match(retryPolicy, /'_hashbox_hubspot_sync_attempt'/);
assert.match(retryPolicy, /in_array\( \$status_code, array\( 423, 429, 477 \), true \)/);
assert.match(retryPolicy, /\$status_code >= 500 && \$status_code < 600/);
assert.match(retryPolicy, /'contact_create' === \$context && 409 === \$status_code/);
assert.match(retryPolicy, /wp_remote_retrieve_header\( \$response, 'retry-after' \)/);
assert.match(retryPolicy, /return max\( 60, min\( 3600,/);
assert.match(retryPolicy, /if \( \$attempt >= \$max_attempts \)/);
assert.match(retryPolicy, /'retry_exhausted'/);
assert.match(
  retryPolicy,
  /\$retry_attribution\['_hashbox_hubspot_sync_attempt'\] = \$attempt \+ 1;/
);
assert.match(retryPolicy, /\$args = array\( \$email, \$retry_attribution \);/);
assert.match(retryPolicy, /'hashbox_sync_lead_attribution_to_hubspot',\s*\$args/s);

const safeLogger = phpFunction(
  'hashbox_log_hubspot_sync_event',
  'hashbox_hubspot_retry_delay'
);
assert.match(safeLogger, /correlation_id=/);
assert.match(safeLogger, /get_error_code\(\)/);
assert.doesNotMatch(safeLogger, /get_error_message\(\)/);
assert.doesNotMatch(safeLogger, /wp_remote_retrieve_body/);

const prepareProperties = phpFunction(
  'hashbox_prepare_hubspot_contact_properties',
  'hashbox_patch_hubspot_contact_properties'
);
assert.match(prepareProperties, /hashbox_is_uuid_v4\(\s*\$property_value\s*\)/);
assert.match(prepareProperties, /hashbox_is_conversion_ref\(\s*\$property_value,\s*'AI'\s*\)/);
assert.match(prepareProperties, /hashbox_is_conversion_ref\(\s*\$property_value,\s*'WEB'\s*\)/);
assert.match(prepareProperties, /sanitize_key\(\s*\$property_value\s*\)/);
assert.match(prepareProperties, /mb_substr\(\s*\$property_value,\s*0,\s*250\s*\)/);

const optionalSync = phpFunction(
  'hashbox_sync_optional_hubspot_contact_properties',
  'hashbox_sync_lead_attribution_to_hubspot'
);
assert.match(
  optionalSync,
  /\$batch_response = hashbox_patch_hubspot_contact_properties\( \$contact_id, \$properties, \$headers \);/,
  'optional properties must use one batch PATCH on the happy path'
);
assert.match(optionalSync, /hashbox_hubspot_response_is_transient\( \$batch_response, 'optional_batch' \)/);
assert.match(optionalSync, /hashbox_requeue_hubspot_attribution_sync\([\s\S]*?'optional_batch'[\s\S]*?\);/);
assert.match(optionalSync, /hashbox_hubspot_response_is_schema_failure\( \$batch_response \)/);
assert.match(optionalSync, /foreach \( \$properties as \$hubspot_property => \$property_value \)/);
assert.match(optionalSync, /array\( \$hubspot_property => \$property_value \)/);
assert.match(optionalSync, /hashbox_hubspot_response_is_transient\( \$response, 'optional_property' \)/);
assert.match(
  optionalSync,
  /hashbox_requeue_hubspot_attribution_sync\([\s\S]*?\$hubspot_property[\s\S]*?\);\s*return false;/,
  'a transient per-property failure must stop the loop and requeue'
);
assert.match(optionalSync, /'optional_unavailable'/);
assert.doesNotMatch(
  optionalSync,
  /wp_remote_retrieve_body/,
  'optional-property failures must not log a response body that could contain lead data'
);

const hubspotSync = phpFunction('hashbox_sync_lead_attribution_to_hubspot', 'hashbox_render_case_study');
const exactPropertyMappings = {
  wbraid: 'hashbox_wbraid',
  gbraid: 'hashbox_gbraid',
  lead_ref: 'hashbox_lead_ref',
  conversion_ref: 'hashbox_conversion_ref',
  landing_slug: 'hashbox_landing_slug'
};
for (const [sourceKey, propertyName] of Object.entries(exactPropertyMappings)) {
  assert.match(
    hubspotSync,
    new RegExp(`'${sourceKey}'\\s*=>\\s*'${propertyName}'`),
    `missing HubSpot custom property mapping ${sourceKey} => ${propertyName}`
  );
}
assert.match(hubspotSync, /\$core_properties\s*=\s*hashbox_prepare_hubspot_contact_properties/);
assert.match(hubspotSync, /\$optional_properties\s*=\s*hashbox_prepare_hubspot_contact_properties/);
assert.match(
  hubspotSync,
  /hashbox_patch_hubspot_contact_properties\( \$contact_id, \$core_properties, \$headers \)/,
  'known UTM/GCLID fields must be persisted separately from optional custom fields'
);
assert.match(
  hubspotSync,
  /hashbox_sync_optional_hubspot_contact_properties\([\s\S]*?\$contact_id,[\s\S]*?\$optional_properties,[\s\S]*?\$attempt[\s\S]*?\);/
);
for (const context of ['contact_search', 'core_patch', 'contact_create', 'contact_id_missing']) {
  assert.match(hubspotSync, new RegExp(`'${context}'`), `missing retry/log context ${context}`);
}
assert.match(
  functionsSource,
  /add_action\( 'hashbox_sync_lead_attribution_to_hubspot', 'hashbox_sync_lead_attribution_to_hubspot', 10, 2 \)/,
  'older two-argument scheduled events must remain compatible'
);

const hubspotBlock = functionsSource.slice(
  functionsSource.indexOf('function hashbox_get_hubspot_private_app_token('),
  functionsSource.indexOf('function hashbox_render_case_study(')
);
assert.doesNotMatch(
  hubspotBlock,
  /error_log\([\s\S]{0,400}(?:wp_remote_retrieve_body|get_error_message)/,
  'HubSpot logs must never include a response body or transport error message'
);

console.log('HubSpot attribution contract tests passed');
