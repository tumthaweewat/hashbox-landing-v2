<?php
/** English SEO enquiries: scoped validation and verified same-page feedback. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hashbox_en_seo_contact_url() {
    return home_url( '/en/seo/#seo-contact' );
}

/** Accept a domain without a scheme, as the visible field promises. No URL is fetched. */
function hashbox_en_seo_contact_website( $value ) {
    if ( ! is_string( $value ) ) {
        return '';
    }
    $value = trim( $value );
    if ( '' === $value || strlen( $value ) > 2048 || preg_match( '/\s/', $value ) ) {
        return '';
    }
    if ( ! preg_match( '/^[a-z][a-z\d+.-]*:/i', $value ) ) {
        $value = 'https://' . $value;
    }
    $parts = wp_parse_url( $value );
    if ( ! is_array( $parts ) || empty( $parts['host'] ) || empty( $parts['scheme'] )
        || ! in_array( strtolower( $parts['scheme'] ), array( 'http', 'https' ), true )
        || false === strpos( $parts['host'], '.' ) || isset( $parts['user'] ) || isset( $parts['pass'] )
        || preg_match( '/(^|\.)(facebook\.com|fb\.com)$/i', $parts['host'] ) ) {
        return '';
    }
    return esc_url_raw( $value, array( 'http', 'https' ) );
}

/** Fresh nonces prevent a cached landing page from stranding a valid enquiry. */
function hashbox_en_seo_contact_nonce() {
    nocache_headers();
    wp_send_json_success( array( 'nonce' => wp_create_nonce( 'hashbox_contact' ) ) );
}
add_action( 'wp_ajax_nopriv_hashbox_en_seo_contact_nonce', 'hashbox_en_seo_contact_nonce' );
add_action( 'wp_ajax_hashbox_en_seo_contact_nonce', 'hashbox_en_seo_contact_nonce' );

/** Run before the existing handler; leave every other contact form untouched. */
function hashbox_en_seo_contact_prepare() {
    if ( ! isset( $_POST['contact_context'] ) || 'en-seo' !== $_POST['contact_context'] ) {
        return;
    }

    $invalid = false;
    foreach ( array( 'hashbox_nonce', 'name', 'company', 'email', 'phone', 'website', 'service', 'project_type', 'message', 'problem', 'budget', 'timeline', 'contact_preference', 'contact_detail', 'pdpa', 'redirect_to', 'landing_slug', 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid', 'company_fax' ) as $key ) {
        if ( isset( $_POST[ $key ] ) && ! is_string( $_POST[ $key ] ) ) {
            $invalid = true;
        }
    }
    if ( $invalid || ! isset( $_POST['hashbox_nonce'] )
        || ! wp_verify_nonce( wp_unslash( $_POST['hashbox_nonce'] ), 'hashbox_contact' ) ) {
        wp_safe_redirect( add_query_arg( 'seo_contact', 'invalid', hashbox_en_seo_contact_url() ) );
        exit;
    }

    $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $website = isset( $_POST['website'] ) ? hashbox_en_seo_contact_website( wp_unslash( $_POST['website'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
    $spam = isset( $_POST['company_fax'] ) && '' !== trim( wp_unslash( $_POST['company_fax'] ) );
    if ( '' === trim( $name ) || strlen( $name ) > 300 || ! is_email( $email ) || '' === $website
        || strlen( $message ) > 6000 || ! isset( $_POST['pdpa'] ) || '1' !== $_POST['pdpa'] || $spam ) {
        wp_safe_redirect( add_query_arg( 'seo_contact', 'invalid', hashbox_en_seo_contact_url() ) );
        exit;
    }

    // Keep the shared email, consent and CRM pipeline. Only this form's routing
    // and service classification are fixed; hidden fields cannot change them.
    $_POST['name'] = wp_slash( $name );
    $_POST['email'] = wp_slash( $email );
    $_POST['website'] = wp_slash( $website );
    $_POST['message'] = wp_slash( $message );
    $_POST['problem'] = '';
    $_POST['service'] = 'seo';
    $_POST['project_type'] = 'Technical SEO audit (English)';
    $_POST['contact_preference'] = 'email';
    $_POST['redirect_to'] = wp_slash( hashbox_en_seo_contact_url() );
    $_POST['landing_slug'] = '';

    // The existing handler creates its redirect only after wp_mail returns.
    // Mint a receipt there, never from a visitor-supplied success query string.
    add_filter( 'wp_redirect', 'hashbox_en_seo_contact_receipt', 10, 2 );
}
add_action( 'admin_post_nopriv_hashbox_contact', 'hashbox_en_seo_contact_prepare', 5 );
add_action( 'admin_post_hashbox_contact', 'hashbox_en_seo_contact_prepare', 5 );

function hashbox_en_seo_contact_receipt( $location, $status ) {
    $parts = wp_parse_url( $location );
    $expected = wp_parse_url( hashbox_en_seo_contact_url() );
    if ( ! is_array( $parts ) || ( $parts['host'] ?? '' ) !== ( $expected['host'] ?? '' )
        || ( $parts['path'] ?? '' ) !== ( $expected['path'] ?? '' ) ) {
        return $location;
    }
    $query = array();
    parse_str( $parts['query'] ?? '', $query );
    $result = isset( $query['contact'] ) && is_string( $query['contact'] ) ? $query['contact'] : '';
    if ( ! in_array( $result, array( 'sent', 'error', 'invalid' ), true ) ) {
        return $location;
    }
    remove_filter( 'wp_redirect', 'hashbox_en_seo_contact_receipt', 10 );
    if ( 'sent' !== $result ) {
        return add_query_arg( 'seo_contact', $result, hashbox_en_seo_contact_url() );
    }
    $receipt = str_replace( '-', '', wp_generate_uuid4() );
    $record = array( 'status' => 'sent' );
    if ( ! set_transient( 'hb_en_seo_' . $receipt, $record, HOUR_IN_SECONDS ) ) {
        // Submission succeeded, but do not invent a verifiable receipt.
        return add_query_arg( 'seo_contact', 'unconfirmed', hashbox_en_seo_contact_url() );
    }
    return add_query_arg( 'seo_receipt', $receipt, hashbox_en_seo_contact_url() );
}

function hashbox_en_seo_contact_result() {
    $receipt = isset( $_GET['seo_receipt'] ) && is_string( $_GET['seo_receipt'] ) ? wp_unslash( $_GET['seo_receipt'] ) : '';
    if ( preg_match( '/^[a-f0-9]{32}$/', $receipt ) ) {
        $record = get_transient( 'hb_en_seo_' . $receipt );
        if ( is_array( $record ) && 'sent' === ( $record['status'] ?? '' ) ) {
            $record['receipt'] = $receipt;
            return $record;
        }
    }
    $status = isset( $_GET['seo_contact'] ) && is_string( $_GET['seo_contact'] ) ? sanitize_key( wp_unslash( $_GET['seo_contact'] ) ) : '';
    if ( in_array( $status, array( 'invalid', 'error', 'unconfirmed' ), true ) ) {
        return array( 'status' => $status );
    }
    return array( 'status' => '' === $receipt ? '' : 'expired' );
}

function hashbox_en_seo_contact_nocache() {
    if ( is_page_template( 'page-en-seo.php' ) && ( isset( $_GET['seo_receipt'] ) || isset( $_GET['seo_contact'] ) ) ) {
        if ( ! defined( 'DONOTCACHEPAGE' ) ) {
            define( 'DONOTCACHEPAGE', true );
        }
        nocache_headers();
    }
}
add_action( 'template_redirect', 'hashbox_en_seo_contact_nocache', 0 );
