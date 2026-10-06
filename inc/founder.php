<?php
/**
 * Founder identity — one place for the name used in author boxes, schema and
 * llms.txt. Renamed 2026-10-06 (was "Tum Thaweewat"); alternateName keeps the
 * romanised and Thai forms together so Google and AI engines resolve one person.
 *
 * No WordPress calls here — the offline template tests require this file directly.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hashbox_founder_name() {
    return 'Tum Thanawat ธณวรรธณ์ ศรีอรุณทิพย์';
}
function hashbox_founder_alternate_names() {
    return array( 'Thanawat Sriaroonthip', 'ธณวรรธณ์ ศรีอรุณทิพย์', 'Tum Thanawat' );
}
function hashbox_founder_partner_networks() {
    return 'OpenAI Partner Network · Claude Partner Network';
}
