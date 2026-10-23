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
// Same gap on the website side (2026-10-08): the web-company listicle is indexed and cited by AI,
// but its only inbound link was the price article — the service page never linked it.
$web = file_get_contents( __DIR__ . '/../page-seo-ready-website.php' );
plumbing_expect( false !== strpos( $web, "home_url( '/บริษัทรับทำเว็บไซต์-2026/' )" ), '/services/website-development/ must link the web-company listicle' );
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

// AI-visibility audit (2026-10-21).
// 1. robots.txt: a crawler that matches its own User-agent group ignores the * group
//    (RFC 9309), so every named bot group must repeat the * Disallow rules — "Allow: /"
//    alone re-opened /feed/, /search/ and /wp-admin/ to GPTBot, ClaudeBot, PerplexityBot…
$start  = strpos( $fn, 'function hashbox_robots_txt' );
$robots = substr( $fn, $start, strpos( $fn, 'function hashbox_serve_llms_txt' ) - $start );
$loop   = strpos( $robots, "foreach ( array( 'GPTBot'" );
plumbing_expect( false !== $loop && false !== strpos( substr( $robots, $loop ), '$output .= $disallow' ), 'Named bot groups in robots.txt must repeat the * Disallow rules' );
plumbing_expect( false !== strpos( $robots, "'Claude-User'" ) && false !== strpos( $robots, "'Claude-SearchBot'" ) && false !== strpos( $robots, "'OAI-SearchBot'" ), 'Search/retrieval bots are named explicitly' );
// 2. llms-full.txt: the four service pillars are template-rendered (empty post_content)
//    and shipped as a stale title with no body — the generator must fall back to the catalogue.
$start = strpos( $fn, 'function hashbox_llms_full_txt_content' );
$full  = substr( $fn, $start, strpos( $fn, 'function hashbox_llms_service_body' ) - $start );
plumbing_expect( false !== strpos( $full, 'hashbox_llms_service_body( $svc )' ) && false !== strpos( $full, "\$svc ? \$svc['name'] : \$page->post_title" ), 'llms-full.txt must build service pillars from the catalogue (title + body)' );
// 3. llms.txt lists the keyword owners from REFERENCE.md §6.2 that were missing.
foreach ( array( '/services/website-development/wordpress/', '/รับทำ-ai-tool-prototype-2026/', '/ai-transformation-คือ-2026/', '/geo-checker/', "'/services/'" ) as $needle ) {
    plumbing_expect( false !== strpos( $body, $needle ), 'llms.txt must list ' . $needle );
}
// 4. One founder entity: every Person node goes through hashbox_founder_person_schema()
//    (inc/founder.php) with one @id — no page builds its own Person array any more.
plumbing_expect( false !== strpos( $fn, "'founder' => hashbox_founder_person_schema()" ), 'Organization.founder must be the shared founder node' );
foreach ( array_merge( glob( __DIR__ . '/../page-*.php' ), glob( __DIR__ . '/../inc/*.php' ), array( __DIR__ . '/../functions.php', __DIR__ . '/../author.php' ) ) as $file ) {
    $src = file_get_contents( $file );
    plumbing_expect( false === strpos( $src, '#tum-thaweewat' ), basename( $file ) . ' still references the old founder @id' );
    if ( 'functions.php' !== basename( $file ) && 'founder.php' !== basename( $file ) ) {
        plumbing_expect( 0 === preg_match( "/'@type'\s*=>\s*'Person'/", $src ), basename( $file ) . ' builds its own Person node — use hashbox_founder_person_schema()' );
    }
}
echo "AI visibility: robots named groups inherit Disallow, llms-full service fallback, owner pages listed, one founder node.\n";
