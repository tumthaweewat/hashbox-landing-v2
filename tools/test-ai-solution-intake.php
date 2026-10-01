<?php
/** Offline service/intake contract. No email, analytics or CRM requests. */
define( 'ABSPATH', __DIR__ );
function expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
function add_action( ...$args ) {}
function sanitize_key( $value ) { return preg_replace( '/[^a-z0-9_-]/', '', strtolower( $value ) ); }
function sanitize_text_field( $value ) { return trim( strip_tags( $value ) ); }
function wp_unslash( $value ) { return stripslashes( $value ); }
function esc_html( $value ) { return htmlspecialchars( (string) $value, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $value ) { return esc_html( $value ); }
function esc_url( $value ) { return esc_html( $value ); }
function home_url( $path = '/' ) { return 'https://hashbox.example' . $path; }
function admin_url( $path ) { return home_url( '/wp-admin/' . $path ); }
function get_template_directory() { return dirname( __DIR__ ); }
function get_template_directory_uri() { return '/theme'; }
function get_template_part( $name ) { require get_template_directory() . '/' . $name . '.php'; }
function get_permalink() { return home_url( '/services/ai-consulting/' ); }
function date_i18n( $format ) { return 'October 2026'; }
function selected( $value, $selected ) { if ( $value === $selected ) { echo 'selected'; } }
function hashbox_jsonld( $value ) { $GLOBALS['schemas'][] = $value; }
function wp_nonce_field( $action, $name, $referer = true ) { echo '<input type="hidden" name="' . esc_attr( $name ) . '" value="offline-only">'; }
function hashbox_get_confirmed_ai_audit_lead_ref() { return ''; }
function hashbox_audit_landing_canonical_url( $landing ) { return home_url( '/' . $landing['slug'] . '/' ); }
function hashbox_audit_landing_asset_uri( $asset ) { return '/theme/assets/ads/' . $asset; }
function hashbox_get_audit_landing_for_path() { return hashbox_audit_landing_pages()['ai-workflow-audit']; }
function get_header() {
    $ai = 'audit' === ( $GLOBALS['render_target'] ?? '' );
    echo '<!doctype html><html lang="th"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    foreach ( array( 'design-system/bundle.min.css', 'design-system/fonts.css', 'tokens.css', 'style.css', 'css/heading-ci.css', 'css/audit-landing.css', 'css/ai-workflow-audit.css', 'css/ai-solution-examples.css' ) as $css ) {
        if ( ! $ai && in_array( $css, array( 'css/ai-workflow-audit.css', 'css/audit-landing.css' ), true ) ) { continue; }
        echo '<link rel="stylesheet" href="/theme/' . $css . '">';
    }
    echo '</head><body class="' . ( $ai ? 'hb-audit-landing hb-audit-landing--ai_workforce' : '' ) . '"><main>';
}
function get_footer() { echo '</main></body></html>'; }
require get_template_directory() . '/inc/ai-solution-use-cases.php';
require get_template_directory() . '/inc/ai-action-icons.php';
$source = file_get_contents( get_template_directory() . '/functions.php' );
$start = strpos( $source, 'function hashbox_audit_landing_pages()' );
$end = strpos( $source, 'function hashbox_get_audit_landing_for_path(', $start );
eval( substr( $source, $start, $end - $start ) );

expect( array() === hashbox_ai_solution_intake_details( array() ), 'Optional fields must stay optional.' );
expect( array() === hashbox_ai_solution_intake_details( array( 'workflow_type' => 'unknown', 'current_systems' => array( 'invalid' ), 'work_volume' => array() ) ), 'Reject unknown enum and array input safely.' );
$details = hashbox_ai_solution_intake_details( array( 'workflow_type' => 'sales-service', 'current_systems' => '<b>CRM</b>', 'work_volume' => str_repeat( 'ก', 180 ) ) );
expect( 'อีเมลขอราคา / งานขาย / บริการลูกค้า' === $details['Workflow type'], 'Known workflow label must survive.' );
expect( 'CRM' === $details['Current systems'], 'Strip markup.' );
expect( 160 === mb_strlen( $details['Work volume / baseline'] ), 'Bound free text by Unicode characters.' );
expect( false !== strpos( $source, '$ai_intake_details = $is_ai_form ? hashbox_ai_solution_intake_details( $_POST ) : array();' ), 'Private notification qualification must be AI-route scoped.' );

foreach ( array( 'service' => 'page-ai-consulting.php', 'audit' => 'page-audit-landing.php' ) as $target => $file ) {
    $GLOBALS['render_target'] = $target;
    ob_start(); require get_template_directory() . '/' . $file; $html = ob_get_clean();
    $dom = new DOMDocument();
    @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $html );
    $xpath = new DOMXPath( $dom );
    expect( 1 === $xpath->query( '//h1' )->length, 'One H1 per page.' );
    expect( 3 === $xpath->query( '//article[contains(@class,"hb-solution-example")]' )->length, 'Both pages render the same three anonymous examples.' );
    expect( false === strpos( $html, 'AutoBot' ), 'No unverified result attribution on acquisition pages.' );
    if ( 'audit' === $target ) {
        foreach ( array( 'workflow_type', 'current_systems', 'work_volume' ) as $name ) {
            $nodes = $xpath->query( '//*[@name="' . $name . '"]' );
            expect( 1 === $nodes->length && ! $nodes->item( 0 )->hasAttribute( 'required' ), 'Optional field rendered once.' );
        }
        foreach ( array( 'name', 'company', 'email', 'problem', 'pdpa' ) as $name ) {
            expect( 1 === $xpath->query( '//*[@name="' . $name . '" and @required]' )->length, 'Existing essential field remains required.' );
        }
        expect( false !== strpos( $html, 'hashbox_ai_nonce' ), 'Keep signed AI form nonce.' );
    }
    if ( isset( $argv[1] ) && '--render-' . $target === $argv[1] ) { $rendered = $html; }
}
if ( isset( $rendered ) ) { echo $rendered; } else { echo "AI Solution intake and rendered page contracts passed (offline).\n"; }
