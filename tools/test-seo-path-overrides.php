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

foreach ( array( $best_seo, $thai_ai_listicle ) as $path ) {
    $override = hashbox_seo_path_overrides()[ $path ];
    seo_override_expect( ! array_key_exists( 'title', $override ) || ! array_key_exists( 'description', $override ) || ( '' !== $override['title'] && '' !== $override['description'] ), $path . ' must not fill absent fields with site-wide defaults.' );
}

echo "SEO path overrides: partial title/description fields fall through independently.\n";
