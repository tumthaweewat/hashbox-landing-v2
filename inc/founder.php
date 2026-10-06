<?php
/**
 * Founder identity — one place for the name used in author boxes, schema and
 * llms.txt. Renamed 2026-10-06 (was "Tum Thaweewat"; two-line EN + Thai format the same day); alternateName keeps the
 * romanised and Thai forms together so Google and AI engines resolve one person.
 *
 * No WordPress calls here — the offline template tests require this file directly.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Display: line 1 = English name (also bylines and schema), line 2 = Thai name.
function hashbox_founder_name() {
    return 'Thanawat Sriaroonthip (Tum)';
}
function hashbox_founder_name_th() {
    return 'ธณวรรธณ์ ศรีอรุณทิพย์';
}
function hashbox_founder_alternate_names() {
    return array( 'ธณวรรธณ์ ศรีอรุณทิพย์', 'Thanawat Sriaroonthip', 'Tum Thanawat' );
}
function hashbox_founder_linkedin() {
    return 'https://www.linkedin.com/in/tumthaweewat/';
}
function hashbox_founder_photo_path() {
    return '/assets/team/tum-thaweewat.jpg';
}
function hashbox_founder_partner_networks() {
    return 'OpenAI Partner Network · Claude Partner Network';
}

/** 160px square head-and-shoulders crop for bylines (the portrait is 480×600). */
function hashbox_founder_avatar_path() {
    return '/assets/team/tum-thaweewat-avatar.jpg';
}

/**
 * pre_get_avatar_data: user 1 gets the founder photo instead of Gravatar's
 * default silhouette (post bylines, author archive, Rank Math author image).
 * Accepts every id form get_avatar() does.
 */
function hashbox_founder_avatar_data( $args, $id_or_email ) {
    $user_id = 0;
    if ( is_numeric( $id_or_email ) ) {
        $user_id = (int) $id_or_email;
    } elseif ( $id_or_email instanceof WP_User ) {
        $user_id = (int) $id_or_email->ID;
    } elseif ( $id_or_email instanceof WP_Post ) {
        $user_id = (int) $id_or_email->post_author;
    } elseif ( $id_or_email instanceof WP_Comment ) {
        $user_id = (int) $id_or_email->user_id;
    }
    if ( 1 !== $user_id ) {
        return $args;
    }
    $args['url']          = get_template_directory_uri() . hashbox_founder_avatar_path();
    $args['found_avatar'] = true;
    return $args;
}
