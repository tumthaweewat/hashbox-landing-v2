<?php
/**
 * Offline contract for the article → service page map (silo, 2026-10-06).
 * The map drives the breadcrumb (visible + JSON-LD), the hero button and the
 * sidebar box on every post, so a wrong key sends link weight to the wrong page.
 */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
function hub_expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
require __DIR__ . '/../inc/post-service-hub.php';

$cases = array(
    // slug override beats category: AI Search articles live in the SEO category
    array( 'ai-search-metrics-thailand-2026', 'seo', 'ai-search' ),
    array( 'จ้างทำ-ai-search-ราคา-2026', 'seo', 'ai-search' ),
    array( 'aeo-คืออะไร-2026', 'seo', 'ai-search' ),
    array( 'n8n-ราคา-2026', 'ai-consulting', 'n8n' ),
    array( 'ตัวอย่าง-n8n-workflow-2026', 'ai-consulting', 'n8n' ),
    array( 'seo-สายเทา-vs-สายขาว-2026', 'seo', 'seo-white-hat' ),
    array( 'lighthouse-100-ทำยังไง-2026', 'seo', 'website' ),
    // Core Web Vitals sits with LCP/Lighthouse — performance is sold as part of the website build (content map 2026-10-07)
    array( 'core-web-vitals-thai-guide-2026', 'seo', 'website' ),
    array( 'best-seo-agencies-bangkok-2026', 'seo', 'seo-en' ),
    // category defaults
    array( 'technical-seo-guide', 'seo', 'seo' ),
    array( 'rank-tracker-เชื่อได้ไหม-2026', 'seo', 'seo' ),
    array( 'ai-solution-consulting-guide-2026', 'ai-consulting', 'ai-consulting' ),
    array( 'wordpress-คืออะไร-2026', 'web-development', 'website' ),
    array( 'cro-conversion-rate-optimization-thai-2026', 'marketing', 'cro' ),
    // unknown category = no hub (breadcrumb falls back to Blog / category)
    array( 'something-new', 'case-studies', '' ),
    array( 'something-new', '', '' ),
);
foreach ( $cases as $c ) {
    $got = hashbox_post_service_hub_key( $c[0], $c[1] );
    hub_expect( $got === $c[2], sprintf( 'hub key for %s (%s): expected "%s", got "%s"', $c[0], $c[1], $c[2], $got ) );
}

// WordPress stores Thai post_name percent-encoded (lowercase hex) — must still match
hub_expect( 'ai-search' === hashbox_post_service_hub_key( rawurlencode( 'จ้างทำ-ai-search-ราคา-2026' ), 'seo' ), 'percent-encoded Thai slug must match its override' );
hub_expect( 'ai-search' === hashbox_post_service_hub_key( strtolower( rawurlencode( 'aeo-คืออะไร-2026' ) ), 'seo' ), 'lowercase percent-encoding must match too' );

// every hub is complete and points at a site-relative path
foreach ( hashbox_service_hubs() as $key => $hub ) {
    foreach ( array( 'name', 'path', 'text', 'button' ) as $field ) {
        hub_expect( isset( $hub[ $field ] ) && '' !== trim( $hub[ $field ] ), "hub $key is missing $field" );
    }
    hub_expect( 0 === strpos( $hub['path'], '/' ) && '/' === substr( $hub['path'], -1 ), "hub $key path must be /…/" );
}
// every key the map can return exists as a hub
foreach ( $cases as $c ) {
    if ( '' !== $c[2] ) {
        hub_expect( array_key_exists( $c[2], hashbox_service_hubs() ), "map returns unknown hub {$c[2]}" );
    }
}
echo "Post service hub: slug overrides, category defaults, encoded slugs and hub completeness passed.\n";
