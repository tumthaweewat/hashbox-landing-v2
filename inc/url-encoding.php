<?php
/**
 * Uppercase percent-encoding for URLs we hand to search engines (2026-10-08).
 *
 * WordPress/Rank Math print Thai slugs as lowercase triplets (%e0%b8...). Google keeps
 * Thai URLs in uppercase form (%E0%B8...): URL Inspection reports the lowercase string
 * as "unknown to Google" while the uppercase one is indexed, and no Thai URL showed a
 * sitemap reference. RFC 3986 §2.1 names uppercase as the normal form, so the sitemap,
 * canonical and og:url all use it. Only the two hex digits of each %XX change.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hashbox_uppercase_percent_encoding( $url ) {
    if ( ! is_string( $url ) || false === strpos( $url, '%' ) ) {
        return $url;
    }
    return preg_replace_callback(
        '/%[0-9a-fA-F]{2}/',
        function ( $m ) {
            return strtoupper( $m[0] );
        },
        $url
    );
}

function hashbox_sitemap_entry_uppercase_encoding( $url ) {
    if ( is_array( $url ) && isset( $url['loc'] ) ) {
        $url['loc'] = hashbox_uppercase_percent_encoding( $url['loc'] );
    }
    return $url;
}
