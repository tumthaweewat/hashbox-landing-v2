<?php
// Isolated WP persistence doubles: no email, HTTP or CRM writes.
const MINUTE_IN_SECONDS = 60;
const HOUR_IN_SECONDS = 3600;
const DAY_IN_SECONDS = 86400;
$states = array(); $options = array(); $fail_write = false; $front = true; $race = null;
function add_action(...$args) {}
function wp_salt($scheme) { return 'test-only-not-a-production-secret'; }
function wp_unslash($value) { return $value; }
function sanitize_key($value) { return preg_replace('/[^a-z0-9_\-]/', '', strtolower($value)); }
function is_front_page() { global $front; return $front; }
function get_transient($key) { global $states; return $states[$key] ?? false; }
function set_transient($key, $value, $ttl) { global $states, $fail_write; if ($fail_write) return false; $states[$key] = $value; return true; }
function add_option($key, $value, ...$rest) { global $options, $race; if (isset($options[$key])) return false; $options[$key] = $value; if ($race) { $fn = $race; $race = null; $fn(); } return true; }
function delete_option($key) { global $options; unset($options[$key]); }
function wp_schedule_single_event(...$args) { return true; }
function hashbox_generate_conversion_ref($scope) { return 'HB-' . $scope . '-20260909-123456789'; }
$source = file_get_contents(__DIR__ . '/../functions.php');
// Exercise the actual validators shared with AI and Website Audit.
foreach (array('hashbox_is_uuid_v4', 'hashbox_is_conversion_ref', 'hashbox_lead_transient_status') as $name) {
    if (!preg_match('/function ' . $name . '\(.*?\n\}/s', $source, $match)) throw new Exception('Missing helper ' . $name);
    eval($match[0]);
}
require __DIR__ . '/../inc/homepage-leads.php';
function check($condition, $label) { if (!$condition) throw new Exception($label); echo "PASS: $label\n"; }
$ref = '11111111-1111-4111-8111-111111111111';
$key = hashbox_home_lead_key($ref);
check(hashbox_is_conversion_ref('HB-HOME-20260909-123456789', 'HOME'), 'HOME reference accepted');
check(!hashbox_is_conversion_ref('HB-WEB-20260909-123456789', 'HOME'), 'cross-scope reference rejected');
check(hashbox_claim_home_lead('forged', array('ai-search'), 'audit')['status'] === 'invalid', 'forged reference rejected');
check(hashbox_claim_home_lead($ref, array('ai-search'), 'audit')['status'] === 'invalid', 'unprepared reference rejected');
$states[$key] = array('status' => 'prepared');
$state = hashbox_claim_home_lead($ref, array('ai-search', 'seo'), 'audit');
check($state['status'] === 'claimed' && $state['services'] === array('ai-search', 'seo'), 'claim preserves selected services');
check(hashbox_claim_home_lead($ref, array('seo'), 'project')['status'] === 'processing', 'concurrent POST blocked');
$_GET = array('contact' => 'sent', 'lead_ref' => $ref, 'lead_sig' => hashbox_home_lead_signature($ref));
check(hashbox_get_confirmed_home_lead() === array(), 'claimed state cannot count a lead');
hashbox_finish_home_lead($ref, $state, true);
check(hashbox_get_confirmed_home_lead()['services'] === array('ai-search', 'seo'), 'signed accepted receipt verifies');
check(hashbox_claim_home_lead($ref, array('seo'), 'project')['status'] === 'sent', 'POST replay returns existing receipt');
$_GET['lead_sig'] = str_repeat('0', 64);
check(hashbox_get_confirmed_home_lead() === array(), 'forged signature rejected');
$_GET['lead_sig'] = hashbox_home_lead_signature($ref);
$front = false;
check(hashbox_get_confirmed_home_lead() === array(), 'wrong route rejected');
$front = true;
hashbox_finish_home_lead($ref, $state, false);
check(hashbox_get_confirmed_home_lead() === array(), 'failed email never counts');
unset($states[$key]);
check(hashbox_get_confirmed_home_lead() === array(), 'expired receipt rejected');
$states[$key] = array('status' => 'prepared');
$fail_write = true;
check(hashbox_claim_home_lead($ref, array('seo'), 'audit')['status'] === 'processing', 'failed claim persistence fails closed');
$fail_write = false;
check(isset($options[$key . '_claim']), 'failed persistence retains lock');
hashbox_cleanup_home_lead_claim($ref);
$states[$key] = array('status' => 'prepared');
$race = function() use ($key, $state) { global $states; $states[$key] = array_merge($state, array('status' => 'sent')); };
check(hashbox_claim_home_lead($ref, array('seo'), 'audit')['status'] === 'sent', 'completion between read and lock cannot resend');
echo "Homepage receipt tests passed.\n";
