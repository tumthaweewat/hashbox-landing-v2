<?php
/**
 * Offline contract for what crawlers read besides the pages themselves
 * (content map 2026-10-07): the XML sitemap, llms.txt and the meta map.
 */
error_reporting( E_ALL );
if ( ! defined( 'ABSPATH' ) ) { define( 'ABSPATH', __DIR__ . '/../' ); } // inc/*.php exit silently without it
function plumbing_expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
$fn = file_get_contents( __DIR__ . '/../functions.php' );

// Rank Math's sitemap cache was never invalidated on this host: post-sitemap.xml stayed
// at 2026-10-06 while three posts went live on 10-07 and edited posts kept old lastmod —
// clearing Rank Math transients did not help. The site has ~80 URLs, so building the
// sitemap per request is cheap; a stale one hides new posts from Google.
plumbing_expect(
    1 === preg_match( "/add_filter\(\s*'rank_math\/sitemap\/enable_caching'\s*,\s*'__return_false'\s*\)/", $fn ),
    'Rank Math sitemap caching must be disabled'
);

// llms.txt priced the n8n service behind $hb_has_n8n_page, but the catalogue refactor
// dropped the assignment — the variable was undefined, so the line never rendered.
$start = strpos( $fn, 'function hashbox_llms_txt_content' );
$body  = substr( $fn, $start, strpos( $fn, 'function hashbox_llms_full_txt_content' ) - $start );
$use   = strpos( $body, 'if ( $hb_has_n8n_page )' );
$set   = strpos( $body, '$hb_has_n8n_page =' );
plumbing_expect( false === $use || ( false !== $set && $set < $use ), '$hb_has_n8n_page must be assigned before llms.txt uses it' );

// A description spliced from two drafts ("…code handover.roduction, …") went live as
// og:description. A word glued to the next one by a period is that splice.
$start = strpos( $fn, 'function hashbox_get_seo_metadata' );
$meta  = substr( $fn, $start, strpos( $fn, 'function hashbox_get_seo_title' ) - $start );
preg_match_all( "/'description'\s*=>\s*'((?:[^'\\\\]|\\\\.)*)'/", $meta, $m );
plumbing_expect( count( $m[1] ) > 20, 'Meta map descriptions not found — parser out of date' );
foreach ( $m[1] as $desc ) {
    plumbing_expect( 0 === preg_match( '/[a-z]{3,}\.[a-z]{3,}/', $desc ), 'Spliced description: ' . $desc );
}
// Audit landings (content map 2026-10-07): the FAQ is visible but had no FAQPage JSON-LD,
// and /seo-recovery-audit/ repeated /seo-audit/'s "Technical SEO Audit" in a 79-char title.
$tpl = file_get_contents( __DIR__ . '/../page-audit-landing.php' );
plumbing_expect( false !== strpos( $tpl, "'FAQPage'" ) && false !== strpos( $tpl, "\$landing['faqs']" ), 'Audit landing must emit FAQPage JSON-LD from its visible FAQ' );
require __DIR__ . '/../inc/meta-excerpt.php';
$start = strpos( $fn, "'seo-audit' => array(" );
preg_match_all( "/'meta_title'\s*=>\s*'((?:[^'\\\\]|\\\\.)*)'/", substr( $fn, $start, strpos( $fn, "'growth-audit' => array(" ) - $start ), $t );
plumbing_expect( count( $t[1] ) >= 3, 'Audit landing titles not found — parser out of date' );
plumbing_expect( 1 === count( array_filter( $t[1], function ( $x ) { return false !== stripos( $x, 'Technical SEO Audit' ); } ) ), '"Technical SEO Audit" belongs to /seo-audit/ only' );
foreach ( $t[1] as $title ) {
    plumbing_expect( hashbox_visible_length( $title ) <= 65, 'Audit landing title over 65 visible chars: ' . $title );
}
echo "Sitemap/llms/meta: sitemap cache off, n8n llms line defined, no spliced descriptions, audit landing FAQ schema + titles.\n";
