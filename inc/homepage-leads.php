<?php
/** Homepage receipt: a server-accepted enquiry, not a qualified CRM lead. */
function hashbox_home_lead_key( $ref ) {
    return 'hb_home_lead_' . md5( (string) $ref );
}

function hashbox_home_lead_signature( $ref ) {
    return hash_hmac( 'sha256', 'homepage|' . (string) $ref, wp_salt( 'auth' ) );
}

function hashbox_prepare_home_lead() {
    $ip = isset( $_SERVER['REMOTE_ADDR'] ) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
    $rate_key = 'hb_home_prepare_' . md5( $ip );
    $hits = (int) get_transient( $rate_key );
    if ( $hits >= 60 ) {
        wp_send_json_error( array( 'message' => 'Too many requests.' ), 429 );
    }
    set_transient( $rate_key, $hits + 1, 30 * MINUTE_IN_SECONDS );
    $ref = wp_generate_uuid4();
    if ( ! set_transient( hashbox_home_lead_key( $ref ), array( 'status' => 'prepared' ), 6 * HOUR_IN_SECONDS ) ) {
        wp_send_json_error( array( 'message' => 'Unable to prepare form.' ), 503 );
    }
    wp_send_json_success( array( 'lead_ref' => $ref, 'nonce' => wp_create_nonce( 'hashbox_contact' ) ) );
}
add_action( 'wp_ajax_hashbox_prepare_home_lead', 'hashbox_prepare_home_lead' );
add_action( 'wp_ajax_nopriv_hashbox_prepare_home_lead', 'hashbox_prepare_home_lead' );

/** Atomic claim; repeated POSTs never send a second notification for this ref. */
function hashbox_claim_home_lead( $ref, $services, $intent ) {
    if ( ! hashbox_is_uuid_v4( $ref ) ) {
        return array( 'status' => 'invalid' );
    }
    $key = hashbox_home_lead_key( $ref );
    $state = get_transient( $key );
    $status = hashbox_lead_transient_status( $state );
    if ( 'sent' === $status ) {
        return $state;
    }
    if ( 'prepared' !== $status ) {
        return array( 'status' => 'claimed' === $status ? 'processing' : 'invalid' );
    }
    $lock = $key . '_claim';
    if ( ! add_option( $lock, time(), '', false ) ) {
        return array( 'status' => 'processing' );
    }
    // Another request may have completed between our first read and the lock.
    $current = get_transient( $key );
    if ( 'prepared' !== hashbox_lead_transient_status( $current ) ) {
        delete_option( $lock );
        return 'sent' === hashbox_lead_transient_status( $current ) ? $current : array( 'status' => 'processing' );
    }
    // Expire orphan locks after the receipt TTL. Missing state still fails closed.
    wp_schedule_single_event( time() + DAY_IN_SECONDS, 'hashbox_cleanup_home_lead_claim', array( $ref ) );
    $state = array(
        'status' => 'claimed',
        'conversion_ref' => hashbox_generate_conversion_ref( 'HOME' ),
        'services' => array_values( $services ),
        'intent' => $intent,
    );
    if ( ! set_transient( $key, $state, 6 * HOUR_IN_SECONDS ) ) {
        return array( 'status' => 'processing' );
    }
    return $state;
}

function hashbox_cleanup_home_lead_claim( $ref ) {
    if ( hashbox_is_uuid_v4( $ref ) ) {
        delete_option( hashbox_home_lead_key( $ref ) . '_claim' );
    }
}
add_action( 'hashbox_cleanup_home_lead_claim', 'hashbox_cleanup_home_lead_claim' );

function hashbox_finish_home_lead( $ref, $state, $sent ) {
    $state['status'] = $sent ? 'sent' : 'failed';
    if ( set_transient( hashbox_home_lead_key( $ref ), $state, 6 * HOUR_IN_SECONDS ) ) {
        hashbox_cleanup_home_lead_claim( $ref );
    } else {
        error_log( '[hashbox] Homepage receipt not persisted; tracking fails closed, claim retained.' );
    }
}

function hashbox_home_lead_return_url( $ref, $status = 'sent' ) {
    $args = array( 'contact' => $status );
    if ( 'sent' === $status ) {
        $args['lead_ref'] = $ref;
        $args['lead_sig'] = hashbox_home_lead_signature( $ref );
    }
    return add_query_arg( $args, home_url( '/#contact' ) );
}

function hashbox_get_confirmed_home_lead() {
    if ( ! is_front_page() ) {
        return array();
    }
    $contact = isset( $_GET['contact'] ) && is_string( $_GET['contact'] ) ? wp_unslash( $_GET['contact'] ) : '';
    $ref = isset( $_GET['lead_ref'] ) && is_string( $_GET['lead_ref'] ) ? wp_unslash( $_GET['lead_ref'] ) : '';
    $sig = isset( $_GET['lead_sig'] ) && is_string( $_GET['lead_sig'] ) ? wp_unslash( $_GET['lead_sig'] ) : '';
    if ( 'sent' !== $contact || ! hashbox_is_uuid_v4( $ref ) || ! hash_equals( hashbox_home_lead_signature( $ref ), $sig ) ) {
        return array();
    }
    $state = get_transient( hashbox_home_lead_key( $ref ) );
    if ( 'sent' !== hashbox_lead_transient_status( $state ) || ! hashbox_is_conversion_ref( $state['conversion_ref'] ?? '', 'HOME' ) ) {
        return array();
    }
    return $state;
}

function hashbox_home_lead_no_cache() {
    if ( ! is_front_page() || ! isset( $_GET['contact'] ) ) {
        return;
    }
    if ( ! defined( 'DONOTCACHEPAGE' ) ) {
        define( 'DONOTCACHEPAGE', true );
    }
    nocache_headers();
}
add_action( 'template_redirect', 'hashbox_home_lead_no_cache', 0 );

function hashbox_home_lead_assets() {
    // Capture attribution on entry pages, before the visitor follows an internal CTA.
    wp_enqueue_script( 'hashbox-home-leads', get_template_directory_uri() . '/js/homepage-leads.js', array( 'hashbox-v2-script' ), filemtime( get_template_directory() . '/js/homepage-leads.js' ), true );
    wp_localize_script( 'hashbox-home-leads', 'hashboxHomeLeads', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'receipt' => hashbox_get_confirmed_home_lead(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'hashbox_home_lead_assets', 20 );
