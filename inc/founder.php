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
