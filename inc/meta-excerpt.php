<?php
/**
 * Generated meta descriptions (2026-10-07).
 *
 * wp_trim_words() counts space-separated words. Thai has no spaces between
 * words, so 28 "words" came out at 250–410 characters and Google cut them
 * mid-sentence (audit 2026-10-06: 40 pages over 170 characters). This trims
 * by visible width instead: Thai above/below vowels and tone marks take no
 * horizontal space, so they do not count toward the budget.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/** Thai combining marks (U+0E31, U+0E34–0E3A, U+0E47–0E4E). */
function hashbox_is_thai_mark( $char ) {
    return 1 === preg_match( '/^[\x{0E31}\x{0E34}-\x{0E3A}\x{0E47}-\x{0E4E}]$/u', $char );
}

/** Characters that take horizontal space. */
function hashbox_visible_length( $text ) {
    return mb_strlen( (string) preg_replace( '/[\x{0E31}\x{0E34}-\x{0E3A}\x{0E47}-\x{0E4E}]/u', '', (string) $text ) );
}

/**
 * Plain-text description of at most $max_visible visible characters. Block
 * boundaries become spaces (term descriptions are two <p>s that strip_tags
 * used to glue together). Cuts back to the last space when one is close, so
 * a Thai phrase is not split mid-word, and ends with "…".
 */
function hashbox_meta_excerpt( $html, $max_visible = 150 ) {
    $text = preg_replace( '#<(script|style)\b[^>]*>.*?</\1>#is', ' ', (string) $html );
    $text = preg_replace( '#</(p|div|li|h[1-6]|td|th|blockquote)>|<br\s*/?>#i', ' ', $text );
    $text = html_entity_decode( strip_tags( $text ), ENT_QUOTES, 'UTF-8' );
    // Decoding turns &lt;script&gt; (code shown in a post) into a live tag, and the
    // result also lands in og:description and JSON-LD. Plain text has no use for
    // angle brackets, so strip again and drop any that remain.
    $text = str_replace( array( '<', '>' ), '', strip_tags( $text ) );
    $text = trim( (string) preg_replace( '/\s+/u', ' ', $text ) );
    if ( hashbox_visible_length( $text ) <= $max_visible ) {
        return $text;
    }

    $out     = '';
    $visible = 0;
    foreach ( preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY ) as $char ) {
        if ( ! hashbox_is_thai_mark( $char ) ) {
            if ( $visible >= $max_visible - 1 ) {
                break; // keep one visible slot for the ellipsis
            }
            $visible++;
        }
        $out .= $char; // marks follow their base character, so they are never stranded
    }
    $space = mb_strrpos( $out, ' ' );
    if ( false !== $space && $space > mb_strlen( $out ) * 0.6 ) {
        $out = mb_substr( $out, 0, $space );
    }
    return rtrim( $out, " ,;:|·—–-" ) . '…';
}

/**
 * Generated <title> for posts and pages without a Rank Math title: the brand
 * suffix is added only when the result fits ~60 visible characters (Google
 * cuts around there, and cutting the suffix is better than cutting the
 * title), and never when the title already names the brand —
 * /privacy-policy/ rendered "| Hashbox Studio | Hashbox Studio".
 */
function hashbox_meta_title( $title, $suffix = ' | Hashbox Studio', $max_visible = 60 ) {
    $title = trim( (string) $title );
    if ( false !== stripos( $title, 'hashbox' ) ) {
        return $title;
    }
    if ( hashbox_visible_length( html_entity_decode( $title . $suffix, ENT_QUOTES, 'UTF-8' ) ) > $max_visible ) {
        return $title;
    }
    return $title . $suffix;
}
