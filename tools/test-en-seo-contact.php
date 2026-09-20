<?php
/** Run with php tools/test-en-seo-contact.php. Never contacts WordPress or sends mail. */
define( 'ABSPATH', __DIR__ );
define( 'HOUR_IN_SECONDS', 3600 );
define( 'MINUTE_IN_SECONDS', 60 );
$test_transients = array();
$test_hooks = array();
$test_store_ok = true;

function expect( $condition, $message ) {
    if ( ! $condition ) {
        throw new RuntimeException( $message );
    }
}
function home_url( $path ) { return 'https://hashbox.example' . $path; }
function wp_parse_url( $url, $component = -1 ) { return parse_url( $url, $component ); }
function esc_url_raw( $url, $protocols = null ) { return $url; }
function sanitize_text_field( $value ) { return trim( strip_tags( $value ) ); }
function sanitize_textarea_field( $value ) { return trim( strip_tags( $value ) ); }
function sanitize_key( $value ) { return preg_replace( '/[^a-z0-9_\-]/', '', strtolower( $value ) ); }
function sanitize_email( $value ) { return trim( $value ); }
function is_email( $value ) { return filter_var( $value, FILTER_VALIDATE_EMAIL ); }
function wp_unslash( $value ) { return stripslashes( $value ); }
function wp_slash( $value ) { return addslashes( $value ); }
function wp_verify_nonce( $nonce, $action ) { return 'valid' === $nonce && 'hashbox_contact' === $action; }
function wp_generate_uuid4() { return '11111111-1111-4111-8111-111111111111'; }
function add_action( $hook, $callback, $priority = 10 ) { $GLOBALS['test_hooks'][] = compact( 'hook', 'callback', 'priority' ); }
function add_filter( $hook, $callback, $priority = 10, $args = 1 ) {
    $GLOBALS['test_hooks'][] = compact( 'hook', 'callback', 'priority' );
    if ( 'wp_redirect' === $hook ) { $GLOBALS['test_redirect_filter'] = $callback; }
}
function remove_filter( $hook, $callback, $priority = 10 ) {
    if ( 'wp_redirect' === $hook ) { $GLOBALS['test_redirect_filter'] = null; }
}
function get_transient( $key ) { return $GLOBALS['test_transients'][ $key ] ?? false; }
function set_transient( $key, $value, $duration ) {
    if ( ! $GLOBALS['test_store_ok'] ) { return false; }
    $GLOBALS['test_transients'][ $key ] = $value;
    return true;
}
function add_query_arg( $key, $value, $url ) {
    $parts = explode( '#', $url, 2 );
    return $parts[0] . ( false === strpos( $parts[0], '?' ) ? '?' : '&' ) . rawurlencode( $key ) . '=' . rawurlencode( $value ) . ( isset( $parts[1] ) ? '#' . $parts[1] : '' );
}
class RedirectResult extends RuntimeException {}
function wp_safe_redirect( $url ) {
    if ( ! empty( $GLOBALS['test_apply_redirect_filter'] ) && ! empty( $GLOBALS['test_redirect_filter'] ) ) {
        $url = call_user_func( $GLOBALS['test_redirect_filter'], $url, 302 );
    }
    throw new RedirectResult( $url );
}
require __DIR__ . '/../inc/en-seo-contact.php';

expect( 'https://example.com' === hashbox_en_seo_contact_website( ' example.com ' ), 'Domain-only input must work.' );
expect( 'http://example.com/path' === hashbox_en_seo_contact_website( 'http://example.com/path' ), 'Valid HTTP URLs remain valid.' );
foreach ( array( '', ' ', 'localhost', 'javascript:alert(1)', 'ftp://example.com', 'https://user:secret@example.com', 'facebook.com/page', 'https://m.facebook.com/page', 'example .com', array( 'example.com' ) ) as $invalid ) {
    expect( '' === hashbox_en_seo_contact_website( $invalid ), 'Invalid website rejected: ' . json_encode( $invalid ) );
}
$_POST = array( 'contact_context' => 'homepage', 'name' => 'Unaffected' );
$before = $_POST;
hashbox_en_seo_contact_prepare();
expect( $before === $_POST, 'Other contact forms must remain untouched.' );

$valid = array( 'contact_context' => 'en-seo', 'hashbox_nonce' => 'valid', 'name' => 'Test Visitor', 'email' => 'visitor@example.com', 'website' => 'example.com', 'pdpa' => '1', 'redirect_to' => 'https://evil.example/', 'service' => 'ai-consulting', 'message' => 'Technical audit, please.' );
$_POST = $valid;
hashbox_en_seo_contact_prepare();
expect( 'seo' === $_POST['service'], 'SEO service cannot be overridden.' );
expect( hashbox_en_seo_contact_url() === $_POST['redirect_to'], 'Return stays on the English SEO page.' );
expect( 'https://example.com' === $_POST['website'], 'Website normalises before shared handler.' );
expect( 'Technical SEO audit (English)' === $_POST['project_type'], 'Notification identifies the English SEO request.' );

foreach ( array( array( 'hashbox_nonce', 'invalid' ), array( 'name', '  ' ), array( 'email', 'invalid' ), array( 'website', 'facebook.com' ), array( 'pdpa', '0' ), array( 'company_fax', 'bot' ), array( 'message', array( 'invalid' ) ) ) as $mutation ) {
    $_POST = $valid;
    $_POST[ $mutation[0] ] = $mutation[1];
    try {
        hashbox_en_seo_contact_prepare();
        throw new RuntimeException( 'Accepted invalid field: ' . $mutation[0] );
    } catch ( RedirectResult $result ) {
        expect( false !== strpos( $result->getMessage(), 'seo_contact=invalid#seo-contact' ), 'Validation errors must return to the English form.' );
    }
}

$receipt_url = hashbox_en_seo_contact_receipt( 'https://hashbox.example/en/seo/?contact=sent#seo-contact', 302 );
expect( false !== strpos( $receipt_url, 'seo_receipt=' ), 'Only actual handler success gets a receipt.' );
parse_str( parse_url( $receipt_url, PHP_URL_QUERY ), $_GET );
expect( 'sent' === hashbox_en_seo_contact_result()['status'], 'Valid stored receipt displays success.' );
$_GET = array( 'contact' => 'sent', 'seo_contact' => 'sent' );
expect( '' === hashbox_en_seo_contact_result()['status'], 'Unsigned success parameters cannot display success.' );
$_GET = array( 'seo_receipt' => str_repeat( 'a', 32 ) );
expect( 'expired' === hashbox_en_seo_contact_result()['status'], 'A guessed receipt cannot display success.' );
$_GET = array( 'seo_receipt' => array( 'invalid' ), 'seo_contact' => array( 'sent' ) );
expect( '' === hashbox_en_seo_contact_result()['status'], 'Malformed parameters remain safe.' );
$other = 'https://hashbox.example/website-audit/?contact=sent#audit-form';
expect( $other === hashbox_en_seo_contact_receipt( $other, 302 ), 'No other page redirect changes.' );
$error = hashbox_en_seo_contact_receipt( 'https://hashbox.example/en/seo/?contact=error#seo-contact', 302 );
expect( false !== strpos( $error, 'seo_contact=error' ), 'Mail failure cannot become success.' );
$test_store_ok = false;
$unconfirmed = hashbox_en_seo_contact_receipt( 'https://hashbox.example/en/seo/?contact=sent#seo-contact', 302 );
expect( false !== strpos( $unconfirmed, 'seo_contact=unconfirmed' ), 'Failed receipt storage cannot produce confirmed success.' );
echo "EN SEO contact: validation, isolation, routing and verified-feedback checks passed.\n";

// Exercise the actual handler and route classification from functions.php.
// Only WordPress I/O is mocked: no mail, CRM request or live form is submitted.
$theme_functions = file_get_contents( __DIR__ . '/../functions.php' );
foreach ( array( 'hashbox_audit_landing_pages', 'hashbox_get_audit_landing_for_path', 'hashbox_get_audit_landing_for_return_url', 'hashbox_handle_contact_submit' ) as $function_name ) {
    $start = strpos( $theme_functions, 'function ' . $function_name . '(' );
    $end = strpos( $theme_functions, "\n}", $start ) + 2;
    expect( false !== $start && $end > $start, 'Locate production function ' . $function_name );
    eval( substr( $theme_functions, $start, $end - $start ) );
}
function wp_validate_redirect( $url, $fallback ) {
    return parse_url( $url, PHP_URL_HOST ) === 'hashbox.example' ? $url : $fallback;
}
function wp_mail( $to, $subject, $body, $headers ) {
    $GLOBALS['test_mails'][] = compact( 'to', 'subject', 'body', 'headers' );
    return $GLOBALS['test_mail_success'];
}
function wp_schedule_single_event( $time, $hook, $args, $wp_error = false ) {
    $GLOBALS['test_scheduled'][] = compact( 'hook', 'args' );
    return true;
}
function run_real_handler( $post, $mail_success = true ) {
    $_POST = $post;
    $GLOBALS['test_store_ok'] = true;
    $GLOBALS['test_apply_redirect_filter'] = true;
    $GLOBALS['test_redirect_filter'] = null;
    $GLOBALS['test_mail_success'] = $mail_success;
    $GLOBALS['test_mails'] = array();
    $GLOBALS['test_scheduled'] = array();
    try {
        hashbox_en_seo_contact_prepare();
        hashbox_handle_contact_submit();
        throw new RuntimeException( 'Expected a redirect.' );
    } catch ( RedirectResult $result ) {
        return array( 'url' => $result->getMessage(), 'mails' => $GLOBALS['test_mails'], 'scheduled' => $GLOBALS['test_scheduled'] );
    }
}
$request = $valid;
unset( $request['message'] );
$request['utm_source'] = 'integration-test';
$success = run_real_handler( $request );
expect( 1 === count( $success['mails'] ), 'A real SEO enquiry sends exactly one email without phone, goal, budget or timeline.' );
expect( false !== strpos( $success['mails'][0]['body'], 'Service: seo' ), 'Shared handler preserves SEO classification.' );
expect( false !== strpos( $success['mails'][0]['body'], 'Technical SEO audit (English)' ), 'Notification preserves English request context.' );
expect( false !== strpos( $success['mails'][0]['subject'], 'Technical SEO audit (English)' ), 'Notification subject explicitly classifies the English SEO request.' );
expect( false !== strpos( $success['mails'][0]['body'], 'Landing page: en-seo' ), 'Notification retains the English SEO landing source.' );
expect( false !== strpos( $success['url'], '/en/seo/?seo_receipt=' ), 'Real success returns an English verified receipt.' );
expect( 1 === count( $success['scheduled'] ) && 'hashbox_sync_lead_attribution_to_hubspot' === $success['scheduled'][0]['hook'], 'Existing CRM attribution scheduling remains intact.' );
expect( 'integration-test' === $success['scheduled'][0]['args'][1]['utm_source'], 'Campaign attribution survives the real handler.' );
expect( 'seo' === $success['scheduled'][0]['args'][1]['service'], 'CRM attribution explicitly classifies the SEO service.' );
expect( 'en-seo' === $success['scheduled'][0]['args'][1]['landing_slug'], 'CRM attribution retains the English SEO landing source.' );
expect( '' === $success['scheduled'][0]['args'][1]['conversion_ref'], 'An SEO request does not mint an AI/Website Ads reference.' );
$failure = run_real_handler( $request, false );
expect( false !== strpos( $failure['url'], 'seo_contact=error' ) && empty( $failure['scheduled'] ), 'Delivery failure emits no success receipt or CRM delivery event.' );
$bot = $request;
$bot['company_fax'] = 'filled';
$blocked = run_real_handler( $bot );
expect( empty( $blocked['mails'] ) && false !== strpos( $blocked['url'], 'seo_contact=invalid' ), 'Honeypot blocks before the real mail handler.' );
$bypass = $request;
unset( $bypass['contact_context'] );
$generic = run_real_handler( $bypass );
expect( false === strpos( $generic['url'], 'seo_receipt=' ), 'Removing the scoped context cannot create an SEO success receipt.' );
expect( $bypass['service'] === $generic['scheduled'][0]['args'][1]['service'] && '' === $generic['scheduled'][0]['args'][1]['landing_slug'], 'Generic forms retain their existing service classification without becoming English SEO leads.' );
echo "EN SEO contact: actual shared handler delivery, route classification, CRM attribution and failure-path checks passed.\n";
