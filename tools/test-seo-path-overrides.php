<?php
/** Regression check for partial URL metadata overrides. */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
require __DIR__ . '/../inc/seo-path-overrides.php';

function seo_override_expect( $condition, $message ) {
    if ( ! $condition ) {
        throw new RuntimeException( $message );
    }
}

$best_seo = 'best-seo-agencies-bangkok-2026';
seo_override_expect( hashbox_seo_override_has_field( $best_seo, 'title' ), 'Best SEO agencies page must override its title.' );
seo_override_expect( ! hashbox_seo_override_has_field( $best_seo, 'description' ), 'Best SEO agencies page must keep its WordPress/Rank Math description.' );

$thai_ai_listicle = 'บริษัทที่ปรึกษา-ai-ไทย-2026';
seo_override_expect( hashbox_seo_override_has_field( $thai_ai_listicle, 'description' ), 'Thai AI consulting listicle must override its description.' );
seo_override_expect( ! hashbox_seo_override_has_field( $thai_ai_listicle, 'title' ), 'Thai AI consulting listicle must keep its WordPress/Rank Math title.' );

$title_only_pages = array(
    $best_seo,
    'เว็บไซต์รองรับ-ai-search-2026',
    'seo-thai-guide-2026',
    'aeo-คืออะไร-2026',
);
foreach ( $title_only_pages as $path ) {
    seo_override_expect( hashbox_seo_override_has_field( $path, 'title' ), $path . ' must have its explicit title override.' );
    seo_override_expect( ! hashbox_seo_override_has_field( $path, 'description' ), $path . ' must retain its Rank Math description.' );
    $override = hashbox_seo_path_overrides()[ $path ];
    seo_override_expect( ! array_key_exists( 'description', $override ), $path . ' must not fill its missing description with a site-wide default.' );
}

seo_override_expect(
    'Rank Math description' === hashbox_resolve_meta_description( '', 'Rank Math description', 'WordPress excerpt' ),
    'Rank Math description must be used before the WordPress excerpt.'
);
seo_override_expect(
    'Explicit description' === hashbox_resolve_meta_description( 'Explicit description', 'Rank Math description', 'WordPress excerpt' ),
    'An explicit path description must keep precedence over Rank Math.'
);
seo_override_expect(
    'WordPress excerpt' === hashbox_resolve_meta_description( '', '', 'WordPress excerpt' ),
    'WordPress excerpt must remain the fallback when Rank Math has no description.'
);

echo "SEO path overrides: partial title/description fields fall through independently.\n";
