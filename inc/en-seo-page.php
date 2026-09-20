<?php
/**
 * Page-scoped Signal V3 assets and English navigation for /en/seo/.
 *
 * This service-page migration leaves all other templates on their current
 * assets and navigation. Font faces already ship in design-system/fonts.css
 * (or its production bundle): IBM Plex Sans Thai, Noto Sans Thai and Plex Mono.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Load the page's styles after the shared typography corrections.
 */
function hashbox_enqueue_en_seo_assets() {
    if ( ! is_page_template( 'page-en-seo.php' ) ) {
        return;
    }

    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $tokens    = $theme_dir . '/design-system/v3/tokens.css';
    $styles    = $theme_dir . '/css/en-seo.css';
    $script    = $theme_dir . '/js/en-seo-contact.js';

    if ( file_exists( $tokens ) && file_exists( $styles ) ) {
        wp_enqueue_style(
            'hashbox-en-seo-tokens',
            $theme_uri . '/design-system/v3/tokens.css',
            array( 'hashbox-heading-ci' ),
            filemtime( $tokens )
        );
        wp_enqueue_style(
            'hashbox-en-seo',
            $theme_uri . '/css/en-seo.css',
            array( 'hashbox-en-seo-tokens' ),
            filemtime( $styles )
        );
    }

    if ( file_exists( $script ) ) {
        wp_enqueue_script(
            'hashbox-en-seo-contact',
            $theme_uri . '/js/en-seo-contact.js',
            array( 'hashbox-v2-script' ),
            filemtime( $script ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_en_seo_assets', 110 );

/**
 * Keep shared navigation in the English journey on the migrated SEO page.
 *
 * Pass a site-relative path, including any fragment, just as with home_url().
 * Unmapped paths and all other templates retain the ordinary home_url result.
 * This helper deliberately does not filter WordPress URL generation globally.
 *
 * @param string $path Site-relative destination.
 * @return string Absolute destination URL, escaped by the rendering template.
 */
function hashbox_en_seo_nav_url( $path ) {
    if ( ! is_page_template( 'page-en-seo.php' ) ) {
        return home_url( $path );
    }

    static $routes = array(
        '/'                              => '/en/',
        '/services/'                     => '/en/',
        '/#contact'                      => '/en/seo/#seo-contact',
        '/seo-audit/'                     => '/en/seo/#seo-contact',
        '/services/website-development/' => '/en/website-development/',
        '/services/ai-consulting/'        => '/en/ai-consulting/',
        '/services/seo/'                  => '/en/seo/',
        '/services/ai-search/'            => '/en/ai-search/',
    );

    return home_url( isset( $routes[ $path ] ) ? $routes[ $path ] : $path );
}
