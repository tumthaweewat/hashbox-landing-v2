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
// The Thai AI-consulting listicle sat orphaned for 5 weeks (2026-10-07): only the category
// archive linked to it and GSC said "Google ไม่รู้จัก URL", while its EN twin is the site's
// most-cited page. It needs a link from the money page and an hreflang pair with the EN twin.
$svc = file_get_contents( __DIR__ . '/../page-ai-consulting.php' );
plumbing_expect( false !== strpos( $svc, "home_url( '/บริษัทที่ปรึกษา-ai-ไทย-2026/' )" ), '/services/ai-consulting/ must link the Thai listicle' );
$start = strpos( $fn, 'function hashbox_hreflang_pairs' );
$pairs = substr( $fn, $start, strpos( $fn, 'function hashbox_inject_hreflang' ) - $start );
plumbing_expect( false !== strpos( $pairs, "'th' => 'บริษัทที่ปรึกษา-ai-ไทย-2026'" ) && false !== strpos( $pairs, "'en' => 'en/ai-consulting-companies-thailand-2026'" ), 'TH/EN listicles must be an hreflang pair' );
$start  = strpos( $fn, 'function hashbox_inject_hreflang' );
$inject = substr( $fn, $start, 600 );
plumbing_expect( false !== strpos( $inject, 'rawurldecode' ), 'hreflang must decode the request path — Thai slugs arrive percent-encoded' );
// Thai slugs (2026-10-08): Google keeps Thai URLs in uppercase percent-encoding. URL
// Inspection of /%e0%b8...-2026/ (what Rank Math printed in the sitemap and canonical)
// says "unknown to Google" while /%E0%B8...-2026/ is indexed, and no Thai URL showed a
// sitemap reference — every Thai <loc> pointed at a URL Google never matched.
require __DIR__ . '/../inc/url-encoding.php';
plumbing_expect( 'https://hashbox.co.th/%E0%B8%88%E0%B8%B8%E0%B8%94-safety-stock-2026/' === hashbox_uppercase_percent_encoding( 'https://hashbox.co.th/%e0%b8%88%e0%b8%b8%e0%b8%94-safety-stock-2026/' ), 'Percent-encoding must be uppercased' );
plumbing_expect( 'https://hashbox.co.th/services/seo/' === hashbox_uppercase_percent_encoding( 'https://hashbox.co.th/services/seo/' ), 'ASCII URLs pass through unchanged' );
plumbing_expect( 'https://hashbox.co.th/a-b/?q=Abc%2Fd' === hashbox_uppercase_percent_encoding( 'https://hashbox.co.th/a-b/?q=Abc%2fd' ), 'Only the hex digits of %XX change, never the rest of the URL' );
plumbing_expect( false === hashbox_uppercase_percent_encoding( false ), 'Non-strings (excluded sitemap entries) pass through' );
foreach ( array( "'rank_math/sitemap/entry', 'hashbox_sitemap_entry_uppercase_encoding', 99", "'rank_math/frontend/canonical', 'hashbox_uppercase_percent_encoding', 99", "'rank_math/opengraph/url', 'hashbox_uppercase_percent_encoding', 99" ) as $hook ) {
    plumbing_expect( false !== strpos( $fn, "add_filter( $hook" ), "Missing late filter: $hook" );
}
echo "Sitemap/llms/meta: sitemap cache off, n8n llms line defined, no spliced descriptions, audit landing FAQ schema + titles, TH listicle linked + hreflang.\n";
