<?php
/**
 * Hashbox Studio Theme Functions
 *
 * @package Hashbox_Studio
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/inc/service-catalog.php';

// No RSS/comment feed links in <head> and no emoji detection script —
// both showed up as crawled-not-indexed URLs in GSC (2026-08-29).
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Theme setup
 */
function hashbox_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // HTML5 support for search form, comment form, etc.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'hashbox-studio' ),
    ) );
}
add_action( 'after_setup_theme', 'hashbox_theme_setup' );

/**
 * About-page meta description handled by hashbox_homepage_meta_description()
 * (singular handling). Legacy hashbox_about_meta_description() removed in V2
 * to avoid double <meta name="description"> emission.
 */

/**
 * SEO-optimized document titles.
 *
 * A per-post title set in the Rank Math editor must win over the theme's
 * generated map. Rank Math resolves that meta earlier in this same filter,
 * so when the meta exists we pass its result through untouched.
 */
function hashbox_has_custom_rankmath_title() {
    $obj_id = get_queried_object_id();
    return $obj_id && '' !== (string) get_post_meta( $obj_id, 'rank_math_title', true );
}

function hashbox_document_title( $title ) {
    if ( hashbox_has_custom_rankmath_title() ) {
        return $title;
    }
    return hashbox_get_seo_title( $title );
}
add_filter( 'pre_get_document_title', 'hashbox_document_title', 20 );

/**
 * Add favicon and app icons
 */
function hashbox_add_favicon() {
    // Remove default WordPress favicon
    remove_action('wp_head', 'wp_site_icon', 99);
}
add_action('init', 'hashbox_add_favicon');

/**
 * Enqueue styles and scripts
 */
function hashbox_enqueue_assets() {
    $theme_uri = get_template_directory_uri();
    $version   = wp_get_theme()->get( 'Version' );

    // V2 stack — fonts are self-hosted (design-system/fonts.css inside the
    // bundle) so nothing render-blocking leaves the origin. The design
    // system ships as one bundled sheet built by tools/build-css-bundle.mjs;
    // the layered files remain the editable source and the fallback.
    $bundle = get_template_directory() . '/design-system/bundle.min.css';
    if ( file_exists( $bundle ) ) {
        // Keep the 'hashbox-ds-composed' handle — dependent enqueues
        // (blog, geo-checker, audit landing) reference it.
        wp_enqueue_style( 'hashbox-ds-composed', $theme_uri . '/design-system/bundle.min.css', array(), filemtime( $bundle ) );
        $prev = 'hashbox-ds-composed';
    } else {
        $layers = array(
            'fonts'       => 'fonts.css',
            'tokens'      => 'tokens.css',
            'primitives'  => 'primitives.css',
            'surface'     => 'surface.css',
            'navigation'  => 'navigation.css',
            'interactive' => 'interactive.css',
            'composed'    => 'composed.css',
        );
        $prev = '';
        foreach ( $layers as $key => $file ) {
            $handle = 'hashbox-ds-' . $key;
            wp_enqueue_style( $handle, $theme_uri . '/design-system/' . $file, $prev ? array( $prev ) : array(), $version );
            $prev = $handle;
        }
    }

    // Legacy theme stylesheet (loads last — kept so WP recognizes theme)
    wp_enqueue_style( 'hashbox-style', get_stylesheet_uri(), array( $prev ), $version );

    // V2 script — use the file mtime so long-lived browser/CDN caches pick up
    // interaction fixes without requiring a theme-version bump.
    $v2_script = get_template_directory() . '/js/v2.js';
    $v2_script_version = file_exists( $v2_script ) ? filemtime( $v2_script ) : $version;
    wp_enqueue_script(
        'hashbox-v2-script',
        $theme_uri . '/js/v2.js',
        array(),
        $v2_script_version,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    $audit_landing    = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    $is_audit_landing = (bool) $audit_landing;
    $is_ai_audit      = is_array( $audit_landing ) && 'ai-workflow-audit' === $audit_landing['slug'];
    $is_ads_preview   = function_exists( 'hashbox_is_ads_preview_request' ) && hashbox_is_ads_preview_request();

    if ( $is_audit_landing || $is_ads_preview ) {
        // Inter / Noto Sans Thai exist only for the ad-artwork preview page,
        // whose PNG generator renders with that stack. Public audit landing
        // pages use the brand CI font (IBM Plex Sans Thai, single family) that the
        // design-system bundle already self-hosts, so they must not pull the
        // extra 30 @font-face declarations.
        $audit_deps = array( 'hashbox-ds-composed' );
        if ( $is_ads_preview ) {
            $audit_fonts = get_template_directory() . '/css/audit-fonts.css';
            wp_enqueue_style(
                'hashbox-audit-v4-fonts',
                $theme_uri . '/css/audit-fonts.css',
                array(),
                file_exists( $audit_fonts ) ? filemtime( $audit_fonts ) : $version
            );
            $audit_deps[] = 'hashbox-audit-v4-fonts';
        }

        $audit_css = get_template_directory() . '/css/audit-landing.css';
        if ( file_exists( $audit_css ) ) {
            wp_enqueue_style(
                'hashbox-audit-landing',
                $theme_uri . '/css/audit-landing.css',
                $audit_deps,
                filemtime( $audit_css )
            );
        }
    }

    if ( $is_ai_audit ) {
        $ai_tokens = get_template_directory() . '/tokens.css';
        wp_enqueue_style(
            'hashbox-ai-audit-tokens',
            $theme_uri . '/tokens.css',
            array( 'hashbox-audit-landing' ),
            file_exists( $ai_tokens ) ? filemtime( $ai_tokens ) : $version
        );

        $ai_css = get_template_directory() . '/css/ai-workflow-audit.css';
        wp_enqueue_style(
            'hashbox-ai-workflow-audit',
            $theme_uri . '/css/ai-workflow-audit.css',
            array( 'hashbox-ai-audit-tokens' ),
            file_exists( $ai_css ) ? filemtime( $ai_css ) : $version
        );
    }

    if ( $is_audit_landing ) {
        $audit_js = get_template_directory() . '/js/audit-landing.js';
        if ( file_exists( $audit_js ) ) {
            wp_enqueue_script(
                'hashbox-audit-landing',
                $theme_uri . '/js/audit-landing.js',
                array( 'hashbox-v2-script' ),
                filemtime( $audit_js ),
                true
            );
        }
    }

    if ( is_page( 'website-audit' ) ) {
        $website_audit_js = get_template_directory() . '/js/website-audit-tracking.js';
        if ( file_exists( $website_audit_js ) ) {
            wp_enqueue_script(
                'hashbox-website-audit-tracking',
                $theme_uri . '/js/website-audit-tracking.js',
                array( 'hashbox-v2-script' ),
                filemtime( $website_audit_js ),
                true
            );
            wp_localize_script(
                'hashbox-website-audit-tracking',
                'hashboxWebsiteAuditTracking',
                array(
                    'prepareUrl'            => admin_url( 'admin-ajax.php' ),
                    'prepareAction'         => 'hashbox_prepare_website_audit_lead',
                    'conversionDestination' => 'AW-18190672421/zT9ACPe6ttocEKXE_uFD',
                )
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_assets' );

/**
 * Async-load the legacy V1 stylesheet so it stops blocking first paint.
 *
 * V2 templates use only .hb-* classes served by /design-system/*.css —
 * the 43KB style.css carries V1-only selectors (.about-*, .hero-*, etc.)
 * that no V2 template references, but WordPress still requires it
 * because get_stylesheet_uri() resolves to it and the theme header lives
 * there. Swapping it to media="print" keeps the request happening while
 * removing it from the critical render path. The noscript fallback
 * covers JS-disabled clients and search-engine renderers that ignore
 * the onload swap.
 */
function hashbox_defer_legacy_stylesheet( $html, $handle, $href, $media ) {
    if ( 'hashbox-style' !== $handle ) {
        return $html;
    }
    $async    = sprintf(
        '<link rel="stylesheet" id="%s-css" href="%s" media="print" onload="this.media=\'%s\';this.onload=null">' . "\n",
        esc_attr( $handle ),
        esc_url( $href ),
        esc_attr( $media )
    );
    $noscript = sprintf(
        '<noscript><link rel="stylesheet" href="%s" media="%s"></noscript>' . "\n",
        esc_url( $href ),
        esc_attr( $media )
    );
    return $async . $noscript;
}
add_filter( 'style_loader_tag', 'hashbox_defer_legacy_stylesheet', 10, 4 );

/**
 * Preload the critical self-hosted woff2 files so text renders in the
 * final face on first paint. Thai body/heading faces cover the hero;
 * everything else loads on demand via unicode-range.
 */
function hashbox_preload_critical_fonts() {
    $theme_uri = get_template_directory_uri();
    $landing   = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    $is_audit  = (bool) $landing;
    $is_ai     = is_array( $landing ) && 'ai-workflow-audit' === $landing['slug'];
    $is_ads    = function_exists( 'hashbox_is_ads_preview_request' ) && hashbox_is_ads_preview_request();

    // Only the ad-artwork preview still renders with Inter / Noto Sans Thai;
    // every public page (audit landings included) uses the brand CI stack.
    if ( $is_ads ) {
        $fonts = array(
            'noto-sans-thai-thai-400.woff2',
            'noto-sans-thai-thai-800.woff2',
            'inter-latin-400.woff2',
            'inter-latin-700.woff2',
        );
    } elseif ( $is_ai ) {
        $fonts = array(
            'ibm-plex-sans-thai-thai-400.woff2',
            'ibm-plex-sans-thai-thai-700.woff2',
            'ibm-plex-sans-thai-latin-400.woff2',
        );
    } else {
        $fonts = array(
            'ibm-plex-sans-thai-thai-400.woff2',
            'ibm-plex-sans-thai-thai-700.woff2',
            'ibm-plex-sans-thai-latin-400.woff2',
            'ibm-plex-sans-thai-latin-700.woff2',
        );
    }
    unset( $is_audit );

    foreach ( $fonts as $file ) {
        if ( file_exists( get_template_directory() . '/assets/fonts/' . $file ) ) {
            echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="' . esc_url( $theme_uri . '/assets/fonts/' . $file ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'hashbox_preload_critical_fonts', 2 );

/**
 * Fallback menu callback — renders static nav links when no WP menu is assigned
 */
function hashbox_fallback_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="nav-link">Services</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#why' ) ); ?>" class="nav-link">Digital Workforce</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="nav-link">Work</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="nav-link">Blog</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-link">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="nav-link">Contact</a></li>
    </ul>
    <?php
}

/**
 * Fallback mobile menu callback
 */
function hashbox_fallback_mobile_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="mobile-link">Services</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#why' ) ); ?>" class="mobile-link">Digital Workforce</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#portfolio' ) ); ?>" class="mobile-link">Work</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="mobile-link">Blog</a></li>
        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="mobile-link">About</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="mobile-link">Contact</a></li>
    </ul>
    <?php
}

/**
 * Portfolio Page Functionality
 */

// Enqueue portfolio assets on portfolio page
function hashbox_enqueue_portfolio_assets() {
    if (is_page_template('page-portfolio.php')) {
        wp_enqueue_script(
            'hashbox-portfolio',
            get_template_directory_uri() . '/js/portfolio.js',
            array(),
            '1.0.0',
            true
        );
        
        // Localize script for AJAX
        wp_localize_script('hashbox-portfolio', 'portfolioAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('portfolio_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'hashbox_enqueue_portfolio_assets');

// Enqueue about page assets
function hashbox_enqueue_about_assets() {
    if (is_page_template('page-about.php')) {
        wp_enqueue_style(
            'hashbox-about-css',
            get_template_directory_uri() . '/css/about-page.css',
            array('hashbox-style'),
            '1.0.0'
        );

        wp_enqueue_script(
            'hashbox-about-js',
            get_template_directory_uri() . '/js/about.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'hashbox_enqueue_about_assets');

// Portfolio authentication AJAX handler
function handle_portfolio_auth() {
    check_ajax_referer('portfolio_nonce', 'nonce');
    
    $password = sanitize_text_field($_POST['password']);
    $correct_password = get_option('portfolio_password', 'hashbox2026');
    
    if ($password === $correct_password) {
        wp_send_json_success();
    } else {
        wp_send_json_error('รหัสผ่านไม่ถูกต้อง');
    }
}
add_action('wp_ajax_portfolio_auth', 'handle_portfolio_auth');
add_action('wp_ajax_nopriv_portfolio_auth', 'handle_portfolio_auth');

// Get portfolio data AJAX handler
function get_portfolio_data() {
    check_ajax_referer('portfolio_nonce', 'nonce');
    
    $refresh = isset($_POST['refresh']) && $_POST['refresh'] === '1';
    
    // Check for cached data
    $cache_key = 'benjanard_portfolio_data';
    $cached_data = get_transient($cache_key);
    
    if (!$refresh && $cached_data) {
        wp_send_json_success($cached_data);
        return;
    }
    
    // Try to get fresh data from external API or use mock data
    $portfolio_data = fetch_benjanard_portfolio();
    
    if ($portfolio_data) {
        // Cache for 5 minutes
        set_transient($cache_key, $portfolio_data, 5 * MINUTE_IN_SECONDS);
        wp_send_json_success($portfolio_data);
    } else {
        wp_send_json_error('Failed to load portfolio data');
    }
}
add_action('wp_ajax_get_portfolio_data', 'get_portfolio_data');
add_action('wp_ajax_nopriv_get_portfolio_data', 'get_portfolio_data');

// Fetch portfolio data (Benjanard's real projects)
function fetch_benjanard_portfolio() {
    // Real project data from Benjanard's portfolio
    return array(
        'projects' => array(
            array(
                'title' => 'Robinhood Super App 4.0',
                'subtitle' => 'App Revamp - Thailand\'s First Super App',
                'description' => 'Thailand\'s first Super App for food-delivery, ride-hailing, shopping, express and travel with 6 Million base users. Mobile app revamp focused on improving interface efficiency, enhancing convenience and accessibility, making user journey simpler.',
                'websiteUrl' => '',
                'category' => 'mobile',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/robinhood-app.jpg',
                'imageAlt' => 'Robinhood Super App 4.0 mobile interface design',
                'responsibilities' => array('UX/UI Design', 'Visual Design', 'Design System', 'UX Writing', 'Competitor Analysis', 'Graphic Design'),
                'features' => array('Payment Shortcut', 'Search Landing', 'Save Address', 'Onboarding Improvement', 'Filter & Sort', 'Suggest Items'),
                'tags' => array('Super App', 'Mobile Design', 'UX/UI', 'Food Delivery', 'Payment System'),
                'year' => '2024',
                'client' => 'Robinhood',
                'status' => 'featured'
            ),
            array(
                'title' => 'Krungthai Bank',
                'subtitle' => 'Web Application Revamp',
                'description' => 'Complete website revamp focusing on user-friendly interface and visually appealing design to enhance customer experience. Emphasis on modern banking digital experience.',
                'websiteUrl' => '',
                'category' => 'web',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/krungthai-bank.jpg',
                'imageAlt' => 'Krungthai Bank web application interface design',
                'responsibilities' => array('Style Guide', 'Design Concepts', 'Visual Design', 'Key Visual', 'User Interface', 'CI Website Guidelines'),
                'features' => array('Modern Interface', 'User Experience', 'Visual Design', 'Brand Guidelines'),
                'tags' => array('Banking', 'Web Design', 'Financial Services', 'Corporate'),
                'year' => '2024',
                'client' => 'Krungthai Bank',
                'status' => 'featured'
            ),
            array(
                'title' => 'Singha Estate Corporate',
                'subtitle' => 'Website Redesign',
                'description' => 'International real estate developer website redesign with improved information architecture and user interface. Visual storytelling format showcasing grand and luxurious brand image with focus on sustainability.',
                'websiteUrl' => '',
                'category' => 'web',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/singha-estate.jpg',
                'imageAlt' => 'Singha Estate corporate website design',
                'responsibilities' => array('Style Guide', 'Design Concepts', 'Story Telling', 'Design System', 'User Interface', 'Prototype'),
                'features' => array('Visual Storytelling', 'Luxury Design', 'Sustainability Focus', 'Information Architecture'),
                'tags' => array('Real Estate', 'Corporate', 'Luxury Brand', 'Storytelling'),
                'year' => '2024',
                'client' => 'Singha Estate',
                'status' => 'featured'
            ),
            array(
                'title' => 'Electrolux Thailand',
                'subtitle' => 'Virtual Shop Campaign',
                'description' => 'Shop-in-shop concept microsite to boost kitchen appliance sales. User journey with filtering steps for food preferences and product categories, including sustainability information leading to e-commerce purchases.',
                'websiteUrl' => '',
                'category' => 'ecommerce',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/electrolux-shop.jpg',
                'imageAlt' => 'Electrolux virtual shop campaign interface',
                'responsibilities' => array('Creative Ideas', 'User Flow', 'User Interface', 'Prototype', 'Visual Design', 'Retouch', 'Story Telling'),
                'features' => array('Shop-in-Shop', 'User Journey', 'Product Filtering', 'Sustainability Info'),
                'tags' => array('E-commerce', 'Campaign', 'Kitchen Appliances', 'Microsite'),
                'year' => '2024',
                'client' => 'Electrolux Thailand',
                'status' => 'regular'
            ),
            array(
                'title' => 'THE WISDOM - KBank',
                'subtitle' => '24-hour Personal Assistant via LINE',
                'description' => '24-hour personal assistant service integrated with LINE messaging platform for Kasikorn Bank customers. Focus on user interface and information architecture for seamless banking assistance.',
                'websiteUrl' => '',
                'category' => 'mobile',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/wisdom-kbank.jpg',
                'imageAlt' => 'THE WISDOM KBank LINE assistant interface',
                'responsibilities' => array('User Interface', 'Information Architecture', 'Prototype', 'Visualization'),
                'features' => array('24/7 Service', 'LINE Integration', 'Banking Assistant', 'Chat Interface'),
                'tags' => array('Banking', 'Chatbot', 'LINE', 'Customer Service'),
                'year' => '2023',
                'client' => 'Kasikorn Bank',
                'status' => 'regular'
            ),
            array(
                'title' => 'KTC Mobile App',
                'subtitle' => 'App Store Preview Design',
                'description' => 'KTC (Krungthai Card) mobile app preview design for App Store. Concept focused on "easy, complete, and comprehensive for every moment" user experience.',
                'websiteUrl' => '',
                'category' => 'mobile',
                'image' => get_template_directory_uri() . '/assets/portfolio-images/ktc-mobile.jpg',
                'imageAlt' => 'KTC Mobile app preview design',
                'responsibilities' => array('Creative Ideas', 'Visual Design', 'Graphic Design'),
                'features' => array('App Store Preview', 'Mobile Banking', 'Card Management', 'User Experience'),
                'tags' => array('Mobile App', 'Banking', 'Credit Card', 'App Store'),
                'year' => '2023',
                'client' => 'KTC (Krungthai Card)',
                'status' => 'regular'
            ),
            array(
                'title' => 'Block Trade - Yuanta Securities',
                'subtitle' => 'Single Stock Futures Website',
                'description' => 'Created webpage for "Single stock futures block trade" under Yuanta Securities website. Focus on financial trading interface and user experience for securities trading.',
                'websiteUrl' => 'https://www.yuanta.co.th',
                'category' => 'web',
                'responsibilities' => array('User Interface', 'Visual Design', 'Illustration'),
                'features' => array('Trading Interface', 'Financial Data', 'Securities Trading', 'Block Trade'),
                'tags' => array('Finance', 'Trading', 'Securities', 'Web Design'),
                'year' => '2023',
                'client' => 'Yuanta Securities',
                'status' => 'regular'
            ),
            array(
                'title' => 'D Health Plus - KBank',
                'subtitle' => 'Health Insurance Website',
                'description' => 'Health insurance landing page responsive website design under Kasikorn Bank. Focus on health insurance products and user-friendly insurance application process.',
                'websiteUrl' => 'https://www.kasikornbank.com',
                'category' => 'web',
                'responsibilities' => array('User Interface', 'Illustration'),
                'features' => array('Health Insurance', 'Responsive Design', 'Insurance Application', 'Landing Page'),
                'tags' => array('Insurance', 'Healthcare', 'Banking', 'Landing Page'),
                'year' => '2023',
                'client' => 'Kasikorn Bank',
                'status' => 'regular'
            ),
            array(
                'title' => 'Isuzu Thailand Website',
                'subtitle' => 'Website Revamp',
                'description' => 'Isuzu Thailand website revamp project demonstrating enhanced design and structure. Utilized Di-cut techniques to create striking visuals that stand out from frame cards.',
                'websiteUrl' => '',
                'category' => 'web',
                'responsibilities' => array('Web Design', 'Visual Design', 'Creative Direction'),
                'features' => array('Di-cut Techniques', 'Visual Enhancement', 'Automotive Design', 'Brand Identity'),
                'tags' => array('Automotive', 'Corporate', 'Website Revamp', 'Visual Design'),
                'year' => '2023',
                'client' => 'Isuzu Thailand',
                'status' => 'showcase'
            ),
            array(
                'title' => 'Peppermint Field',
                'subtitle' => 'Product Website',
                'description' => 'Product website showcasing product functions with animated videos and images. Focus on making the product presentation more interesting and appealing to potential customers.',
                'websiteUrl' => '',
                'category' => 'web',
                'responsibilities' => array('Web Design', 'Animation', 'Product Presentation'),
                'features' => array('Animated Videos', 'Product Showcase', 'Interactive Elements', 'Visual Appeal'),
                'tags' => array('Product Design', 'Animation', 'E-commerce', 'Interactive'),
                'year' => '2023',
                'client' => 'Peppermint Field',
                'status' => 'showcase'
            )
        ),
        'scrapedAt' => current_time('mysql'),
        'totalProjects' => 10,
        'designer' => array(
            'name' => 'Benjanard',
            'title' => 'UX/UI Designer',
            'description' => 'Experienced UX/UI designer with a strong background in creating visually appealing and user-friendly interfaces for web and mobile applications.',
            'contact' => array(
                'email' => 'benjanard@example.com',
                'phone' => '095-4799860',
                'linkedin' => 'https://linkedin.com/in/benjanard'
            )
        )
    );
}

// Add portfolio password option to admin
function add_portfolio_admin_menu() {
    add_options_page(
        'Portfolio Settings',
        'Portfolio',
        'manage_options',
        'portfolio-settings',
        'portfolio_settings_page'
    );
}
add_action('admin_menu', 'add_portfolio_admin_menu');

function portfolio_settings_page() {
    if (isset($_POST['submit'])) {
        update_option('portfolio_password', sanitize_text_field($_POST['portfolio_password']));
        echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
    }
    
    $current_password = get_option('portfolio_password', 'hashbox2026');
    ?>
    <div class="wrap">
        <h1>Portfolio Settings</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Portfolio Password</th>
                    <td>
                        <input type="text" name="portfolio_password" value="<?php echo esc_attr($current_password); ?>" />
                        <p class="description">Password required to access the portfolio page.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/* =========================================================================
 * SEO + Schema (added 2026-05-10) — Sprint 1 of CONTENT-REWRITE-SPEC.md
 * ========================================================================= */

/**
 * Is the page currently being rendered one of the English pages?
 *
 * Reads hashbox_hreflang_pairs() so the EN page list is declared exactly once.
 * Add a pair there and every language signal below follows automatically —
 * there is no second list that can silently drift out of sync.
 */
function hashbox_page_is_english() {
    $path = hashbox_current_request_path();

    foreach ( hashbox_hreflang_pairs() as $pair ) {
        if ( $path === $pair['en'] ) {
            return true;
        }
    }

    return false;
}

/**
 * The three language signals for the page being rendered: html lang,
 * og:locale, and schema inLanguage.
 *
 * The site is Thai-primary, so Thai is the default and the /en/ pages are the
 * deliberate exception. Until 2026-08 the lang attribute was hardcoded th-TH
 * site-wide, which told Google that /en/ai-consulting/ was a Thai page: it
 * then competed with the Thai pages on Thai queries instead of the English
 * cluster it was written for. The signal has to follow the page, not the site
 * default — and all three have to agree, or we just move the contradiction.
 */
function hashbox_page_lang_attribute() {
    return hashbox_page_is_english() ? 'en' : 'th-TH';
}

function hashbox_page_og_locale() {
    return hashbox_page_is_english() ? 'en_US' : 'th_TH';
}

function hashbox_page_in_language() {
    return hashbox_page_is_english() ? 'en-US' : 'th-TH';
}

/**
 * Set the HTML lang attribute from the page, not from the WP locale.
 *
 * WP Settings → General is en-US on this install, which mis-signalled every
 * Thai page; this filter is what makes the declared language independent of
 * it. Polylang/WPML own this filter when installed, so we stand down for them.
 */
function hashbox_language_attribute( $output ) {
    if ( function_exists( 'pll_current_language' ) || defined( 'ICL_SITEPRESS_VERSION' ) ) {
        return $output;
    }
    return 'lang="' . esc_attr( hashbox_page_lang_attribute() ) . '"';
}
add_filter( 'language_attributes', 'hashbox_language_attribute' );

/**
 * Detect Rank Math so the theme can stay a fallback instead of duplicating SEO output.
 */
function hashbox_rank_math_is_active() {
    return defined( 'RANK_MATH_VERSION' )
        || class_exists( 'RankMath' )
        || class_exists( 'RankMath\\Frontend\\Frontend' )
        || class_exists( 'RankMath\\Schema\\JsonLD' );
}

/**
 * SEO metadata source of truth for title tags, descriptions, OG/Twitter, and schema fallbacks.
 */
function hashbox_get_seo_metadata() {
    $fallback = array(
        'title'       => 'Hashbox Studio | รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI, รับทำ SEO และ AI Search',
        'description' => 'Hashbox Studio ช่วยธุรกิจไทยสร้างเว็บไซต์ SEO-Ready, ทำ SEO และ AI Search และวางระบบ AI ที่ใช้งานจริง วัดผลผ่าน KPI เดียวกัน',
    );

    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing ) {
        return array(
            'title'       => $audit_landing['meta_title'],
            'description' => $audit_landing['meta_description'],
        );
    }

    if ( function_exists( 'hashbox_is_ads_preview_request' ) && hashbox_is_ads_preview_request() ) {
        return array(
            'title'       => 'Hashbox Ads Kit V4 Preview | Hashbox Studio',
            'description' => 'Internal preview for Hashbox Ads Kit V4 artwork and landing page creative mappings.',
        );
    }

    if ( is_front_page() ) {
        return array(
            'title'       => 'รับทำเว็บไซต์ SEO-Ready · ที่ปรึกษา AI · รับทำ SEO | Hashbox Studio',
            'description' => 'Hashbox Studio รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI สำหรับธุรกิจ, รับทำ SEO สายเทคนิค, AI Search (GEO) และ n8n Automation สำหรับธุรกิจไทย — ราคาเปิดเผย Lighthouse 100, Core Web Vitals เขียว วัดผลจากข้อมูลจริงรายวัน',
        );
    }

    if ( is_home() ) {
        return array(
            'title'       => 'Blog SEO, Web Performance และ AI | Hashbox Studio',
            'description' => 'บทความ SEO, web performance, digital marketing, CRO และ AI automation จากทีม Hashbox Studio พร้อมแนวทางลงมือทำจริงสำหรับธุรกิจไทย',
        );
    }

    $case_slug = hashbox_current_case_study_slug();
    if ( $case_slug ) {
        $case_meta = array(
            'nexus-corp' => array(
                'title'       => 'Nexus Corp Case Study: Headless WordPress SEO | Hashbox',
                'description' => 'Case study การเปลี่ยน corporate site เป็น Headless WordPress + Next.js ทำ Lighthouse 100, Core Web Vitals เขียว และเพิ่ม users +540% ใน 12 เดือน',
            ),
            'flow-store' => array(
                'title'       => 'Flow Store Case Study: CRO เพิ่ม Conversion 3x | Hashbox',
                'description' => 'Case study e-commerce storefront บน Next.js พร้อม CRO Sprint ต่อเนื่อง ช่วย Flow Store เพิ่ม conversion จาก 1.2% เป็น 3.8% ภายใน 6 เดือน',
            ),
            'rank-project' => array(
                'title'       => 'Rank Project Case Study: Technical SEO +2,200% | Hashbox',
                'description' => 'Case study HR-Tech platform ที่ทำ Technical SEO, Core Web Vitals และ content programme 12 เดือน จน search impressions เพิ่ม +2,200% และ organic traffic +700%',
            ),
            'autobot-line' => array(
                'title'       => 'AutoBot LINE Case Study: AI ลด Support Cost 60% | Hashbox',
                'description' => 'Case study LINE Bot + OpenAI + RAG สำหรับบริการ on-demand ตอบลูกค้า 24/7 ลด response time และลด support cost 60% พร้อม route งานซับซ้อนไปหา human',
            ),
            'gold-brand' => array(
                'title'       => 'Gold Brand Case Study: Brand Refresh +180% | Hashbox',
                'description' => 'Case study luxury retail ที่ทำ brand refresh และ performance website ใหม่บน Next.js ช่วยเพิ่ม branded search +180% และยกระดับ premium perception',
            ),
            'pitch-deck' => array(
                'title'       => 'Pitch Deck Case Study: Investor Microsite | Hashbox',
                'description' => 'Case study investor microsite สำหรับ SaaS startup ใช้ live metrics dashboard และ data visualization ช่วยปิด Series A ด้วย valuation เพิ่มขึ้น 1.4x',
            ),
        );
        return isset( $case_meta[ $case_slug ] ) ? $case_meta[ $case_slug ] : $fallback;
    }

    // English pages live under /en/ and share a post_name with their
    // Thai counterpart (e.g. both are slug "ai-consulting"), so key
    // their meta off the request PATH, not the slug, to avoid the
    // collision returning the Thai metadata.
    $en_path = hashbox_current_request_path();
    $en_meta = array(
        'en/seo' => array(
            'title'       => 'SEO Agency Bangkok — Technical-first SEO, from THB 29,900 | Hashbox',
            'description' => 'Technical-first SEO agency in Bangkok: Core Web Vitals, schema, local SEO and AI Search (GEO) with daily rank and AI-citation tracking. From THB 29,900/month with a written "no growth, no pay" guarantee.',
        ),
        'en/ai-search' => array(
            'title'       => 'AI Search Optimization (GEO) Agency in Bangkok | Hashbox',
            'description' => 'Get cited by Google AI Overviews, ChatGPT, Perplexity and Gemini: AI-specific audit, entity schema + llms.txt, answer-first content, external citations, measured daily with our own AI-visibility tracker. Bangkok, Thailand.',
        ),
        'en/ai-consulting' => array(
            'title'       => 'AI Consulting Company in Bangkok, Thailand | Hashbox',
            'description' => 'AI consulting in Bangkok for Thai and regional businesses: LINE chatbots, Sales GPT, RAG knowledge bases and workflow automation shipped to production. Public pricing from THB 60,000, ROI assessed first, 100% source code handover.',
        ),
    );
    if ( isset( $en_meta[ $en_path ] ) ) {
        return $en_meta[ $en_path ];
    }

    if ( is_page() ) {
        $post = get_queried_object();
        $slug = $post instanceof WP_Post ? $post->post_name : '';
        $page_meta = array(
            'services' => array(
                'title'       => 'บริการรับทำเว็บไซต์ SEO-Ready, รับทำ SEO, AI Search และที่ปรึกษา AI | Hashbox Studio',
                'description' => 'รวม 5 บริการในทีมเดียว: รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI สำหรับธุรกิจ, รับทำ SEO, รับทำ AI Search (GEO) และ Workflow Automation n8n — ราคาโปร่งใส วัดผลจากข้อมูลจริงรายวัน',
            ),
            'seo-ready-website' => array(
                'title'       => 'รับทำเว็บไซต์ SEO-Ready ติด Google และ AI Search | Hashbox',
                'description' => 'รับทำเว็บไซต์บริษัท E-commerce และ Landing Page แบบ SEO-Ready — Lighthouse 100, Core Web Vitals เขียว, Schema ครบ, รองรับ AI Search ส่งมอบพร้อม source code ราคาเริ่ม 35,900 บาท ประเมินโปรเจกต์ฟรี',
            ),
            'website-development' => array(
                'title'       => 'รับทำเว็บไซต์ SEO-Ready ติด Google และ AI Search | Hashbox',
                'description' => 'รับทำเว็บไซต์บริษัท E-commerce และ Landing Page แบบ SEO-Ready — Lighthouse 100, Core Web Vitals เขียว, Schema ครบ, รองรับ AI Search ส่งมอบพร้อม source code ราคาเริ่ม 35,900 บาท ประเมินโปรเจกต์ฟรี',
            ),
            // Commercial intent only. This page used to lead with "ปรึกษาทำระบบ
            // AI Solution" — the exact phrase /ai-solution-consulting-guide-2026/
            // ranks 3rd for and is cited in the AI Overview. With both pages
            // saying it, Google kept picking the guide and left this one around
            // position 67 on the same Thai queries. The guide answers "how does
            // this work"; this page answers "who do I hire", and the title has
            // to say so. Keep ที่ปรึกษา AI — that is the term buyers search.
            'ai-search' => array(
                'title'       => 'รับทำ AI Search (GEO) ให้แบรนด์ถูก AI อ้างอิง | Hashbox',
                'description' => 'รับทำ AI Search / GEO: audit, entity + Schema + llms.txt, answer-first content, citation ภายนอก วัดผลด้วย AI Visibility, Brand Mentions และ AI Overview citations จากระบบ track ของเราเอง — รวมใน SEO retainer เริ่ม 29,900 บาท/เดือน',
            ),
            'ai-consulting' => array(
                'title'       => 'ที่ปรึกษา AI สำหรับธุรกิจ · บริการให้คำปรึกษา AI Solution | Hashbox',
                'description' => 'บริการให้คำปรึกษา AI Solution สำหรับธุรกิจไทย — ที่ปรึกษา AI ที่ส่งงานถึง production: LINE Chatbot, RAG Knowledge Base, AI Agent, Workflow Automation · คุยประเมินโอกาสฟรี 30 นาที · โปรเจกต์เริ่ม 60,000 บาท',
            ),
            'work' => array(
                'title'       => 'Case Studies SEO, CRO, AI ที่วัดผลได้ | Hashbox',
                'description' => 'รวม case study งาน SEO, CRO, เว็บไซต์และ AI ของ Hashbox Studio พร้อมตัวเลขจาก GA4 และ Search Console เช่น +2,200% impressions, 3x conversion และลด cost 60%',
            ),
            'about' => array(
                'title'       => 'Hashbox Studio: ทีม Web + SEO + AI สำหรับธุรกิจไทย',
                'description' => 'รู้จักทีม Hashbox Studio — รวม web development, technical SEO, CRO และ AI consulting ไว้ในทีมเดียว ส่งมอบงานที่ run production จริงและวัดผลได้ ไม่ใช่แค่ slide',
            ),
            'portfolio' => array(
                'title'       => 'Portfolio งาน Web, Mobile และ Digital | Hashbox Studio',
                'description' => 'รวมผลงาน web design, mobile app, e-commerce และ digital product จากทีม Hashbox Studio ครอบคลุม Banking, Real Estate, E-commerce และ AI',
            ),
            'geo-checker' => array(
                'title'       => 'GEO Readiness Checker — เว็บพร้อมถูก AI อ้างอิงไหม | Hashbox',
                'description' => 'เครื่องมือฟรี ใส่ URL แล้วรู้คะแนน 0-100 ว่าหน้าเว็บพร้อมถูก ChatGPT, Perplexity และ Google AI Overviews อ้างอิงแค่ไหน พร้อมคำแนะนำที่ลงมือทำได้ทันที',
            ),
        );

        if ( isset( $page_meta[ $slug ] ) ) {
            return $page_meta[ $slug ];
        }
    }

    if ( 'services/website-development' === hashbox_current_request_path() ) {
        return array(
            'title'       => 'รับทำเว็บไซต์ ออกแบบเว็บไซต์ธุรกิจทุกประเภท พร้อมใช้งานทันที',
            'description' => 'รับทำเว็บไซต์ครบวงจร ทั้งเว็บไซต์บริษัท เว็บแอปพลิเคชัน และระบบเชื่อมต่อฐานข้อมูล พร้อมวางโครงสร้างเว็บไซต์ให้พร้อมติด Google และ AI Search ตั้งแต่วันแรก',
        );
    }

    /*
     * /services/seo/ — keyed by PATH, not by the "seo" post_name, so it cannot
     * collide with another page that happens to use that slug.
     *
     * A rank_math_* row exists for this page (written by
     * hashbox_sync_new_service_pages_rankmath_meta), and that row owns <title>
     * and <meta name="description">. This entry is NOT redundant with it: the
     * og/twitter description filter and WebPage.description have no row check
     * and read this map, and it is also the only source when Rank Math is off.
     * Keep the strings byte-identical to the row and to $desc in
     * page-seo-service.php — the published entry price lives in all three.
     */
    if ( 'services/seo' === hashbox_current_request_path() ) {
        return array(
            'title'       => 'รับทำ SEO สายเทคนิค ติดหน้าแรก Google และ AI Search | Hashbox',
            'description' => 'บริการรับทำ SEO แบบ technical-first เริ่มต้น 29,900 บาทต่อเดือน — Core Web Vitals, Schema, GEO/AI Overview พร้อมระบบ track อันดับรายวัน เริ่มจาก SEO Audit ฟรี',
        );
    }

    /*
     * /services/n8n-automation/ — same three-place rule as /services/seo/ above:
     * this map feeds og/twitter description and WebPage.description, which have
     * no rank_math row check. Keep byte-identical to $desc in
     * page-n8n-automation.php and to the sync target below.
     *
     * ราคาที่นี่เป็น **ต่อโปรเจกต์** ไม่ใช่รายเดือนเหมือน /services/seo/
     */
    if ( 'services/n8n-automation' === hashbox_current_request_path() ) {
        return array(
            'title'       => 'รับทำ n8n Automation วางระบบให้จบเป็นโปรเจกต์ | Hashbox',
            'description' => 'รับทำ n8n automation เริ่มต้น 29,000 บาท — วางระบบอัตโนมัติให้จบเป็นโปรเจกต์ พร้อมส่งมอบ workflow ที่แก้เองต่อได้ ไม่ผูกขาดกับเรา',
        );
    }

    if ( is_singular() ) {
        $post_obj = get_queried_object();
        $title    = $post_obj instanceof WP_Post ? get_the_title( $post_obj ) . ' | Hashbox Studio' : $fallback['title'];
        if ( $post_obj && ! empty( $post_obj->post_excerpt ) ) {
            return array(
                'title'       => $title,
                'description' => wp_trim_words( wp_strip_all_tags( $post_obj->post_excerpt ), 28, '…' ),
            );
        }
        if ( $post_obj && ! empty( $post_obj->post_content ) ) {
            return array(
                'title'       => $title,
                'description' => wp_trim_words( wp_strip_all_tags( $post_obj->post_content ), 28, '…' ),
            );
        }
    }

    if ( is_category() ) {
        $name      = single_cat_title( '', false );
        $term_desc = term_description();
        return array(
            'title'       => $name . ' | Blog Hashbox Studio',
            'description' => ! empty( $term_desc )
                ? wp_trim_words( wp_strip_all_tags( $term_desc ), 28, '…' )
                : 'รวมบทความหมวด ' . $name . ' จาก Hashbox Studio ครอบคลุม SEO, web performance, digital marketing, CRO และ AI automation สำหรับธุรกิจไทย',
        );
    }

    if ( is_tag() ) {
        $name      = single_tag_title( '', false );
        $term_desc = term_description();
        return array(
            'title'       => '#' . $name . ' | Blog Hashbox Studio',
            'description' => ! empty( $term_desc )
                ? wp_trim_words( wp_strip_all_tags( $term_desc ), 28, '…' )
                : 'รวมบทความเกี่ยวกับ ' . $name . ' จากทีม Hashbox Studio พร้อมแนวทางลงมือทำจริงสำหรับ SEO, marketing, web และ AI',
        );
    }

    if ( is_tax() ) {
        $name      = single_term_title( '', false );
        $term_desc = term_description();
        return array(
            'title'       => $name . ' | Hashbox Studio',
            'description' => ! empty( $term_desc ) ? wp_trim_words( wp_strip_all_tags( $term_desc ), 28, '…' ) : $fallback['description'],
        );
    }

    if ( is_search() ) {
        $query = get_search_query();
        return array(
            'title'       => 'ผลการค้นหา "' . $query . '" | Hashbox Studio',
            'description' => 'ผลการค้นหา "' . $query . '" จาก Hashbox Studio รวมบทความและบริการด้าน SEO, web performance, digital marketing, CRO และ AI consulting',
        );
    }

    if ( is_404() ) {
        return array(
            'title'       => 'ไม่พบหน้าที่ต้องการ | Hashbox Studio',
            'description' => 'หน้าที่คุณเปิดอาจถูกย้ายหรือลบแล้ว กลับไปที่ Hashbox Studio เพื่อดูบริการรับทำเว็บไซต์ SEO-Ready, รับทำ SEO, AI Search และที่ปรึกษา AI',
        );
    }

    return $fallback;
}

function hashbox_get_seo_title( $fallback = '' ) {
    $meta = hashbox_get_seo_metadata();
    if ( ! empty( $meta['title'] ) ) {
        return $meta['title'];
    }
    return $fallback;
}

/**
 * Return a context-aware meta description used by both theme fallback and Rank Math.
 */
function hashbox_get_meta_description() {
    $meta = hashbox_get_seo_metadata();
    return ! empty( $meta['description'] ) ? $meta['description'] : '';
}

function hashbox_sync_website_development_rankmath_meta() {
    $sync_key = '20260608_website_development_rankmath_meta_v2';
    if ( $sync_key === get_option( 'hashbox_website_development_rankmath_meta_version' ) ) {
        return;
    }

    $page = get_page_by_path( 'services/website-development', OBJECT, 'page' );
    if ( ! $page ) {
        $page = get_page_by_path( 'website-development', OBJECT, 'page' );
    }
    if ( ! $page ) {
        return;
    }

    update_post_meta( $page->ID, 'rank_math_title', 'รับทำเว็บไซต์ ออกแบบเว็บไซต์ธุรกิจทุกประเภท พร้อมใช้งานทันที' );
    update_post_meta( $page->ID, 'rank_math_description', 'รับทำเว็บไซต์ครบวงจร ทั้งเว็บไซต์บริษัท เว็บแอปพลิเคชัน และระบบเชื่อมต่อฐานข้อมูล พร้อมวางโครงสร้างเว็บไซต์ให้พร้อมติด Google และ AI Search ตั้งแต่วันแรก' );
    clean_post_cache( $page->ID );
    update_option( 'hashbox_website_development_rankmath_meta_version', $sync_key, false );
}
add_action( 'wp', 'hashbox_sync_website_development_rankmath_meta', 1 );

/**
 * One-shot Rank Math meta sync for pages/posts shipped 2026-08-16
 * (SEO service, WordPress service, GEO article refresh) — same pattern as
 * hashbox_sync_website_development_rankmath_meta() above.
 */
function hashbox_sync_new_service_pages_rankmath_meta() {
    // v2 (2026-08-18): /services/seo/ description now carries the published
    // entry price. Bumping this key is what makes a description change reach
    // production, because hashbox_rankmath_description() bails once a
    // rank_math_description row exists.
    //
    // NOTE: only the <meta name="description"> filter bails on the row. The
    // social filter hashbox_rankmath_social_description() has NO row check, so
    // og/twitter descriptions — and WebPage.description via
    // hashbox_rankmath_json_ld() — still resolve through
    // hashbox_get_seo_metadata(). That is why /services/seo/ ALSO needs an
    // entry in that map; the row alone does not reach those surfaces.
    $sync_key = '20260818_seo_wp_geo_rankmath_meta_v3';
    if ( $sync_key === get_option( 'hashbox_new_service_pages_rankmath_meta_version' ) ) {
        return;
    }

    $targets = array(
        array(
            'path'  => 'services/seo',
            'title' => 'รับทำ SEO สายเทคนิค วัดผลด้วยข้อมูลรายวัน | Hashbox',
            // Keep in sync with $desc in page-seo-service.php.
            'desc'  => 'บริการรับทำ SEO แบบ technical-first เริ่มต้น 29,900 บาทต่อเดือน — Core Web Vitals, Schema, GEO/AI Overview พร้อมระบบ track อันดับรายวัน เริ่มจาก SEO Audit ฟรี',
        ),
        array(
            'path'  => 'services/website-development/wordpress',
            'title' => 'รับทำเว็บไซต์ WordPress ที่ Lighthouse 95+ | Hashbox',
            'desc'  => 'รับทำเว็บไซต์ WordPress แบบ Custom Theme และ Headless (WP + Next.js) การันตี Lighthouse 95+ เมื่อไม่มี heavy plugin, AI Search Ready เริ่มจาก SEO Audit ฟรี',
        ),
    );

    $done = true;
    foreach ( $targets as $t ) {
        $page = get_page_by_path( $t['path'], OBJECT, 'page' );
        if ( ! $page ) {
            $done = false;
            continue;
        }
        update_post_meta( $page->ID, 'rank_math_title', $t['title'] );
        update_post_meta( $page->ID, 'rank_math_description', $t['desc'] );
        clean_post_cache( $page->ID );
    }

    $geo = get_page_by_path( 'geo-ai-search-optimization-2026', OBJECT, 'post' );
    if ( $geo ) {
        update_post_meta( $geo->ID, 'rank_math_title', 'GEO คืออะไร? Generative Engine Optimization ฉบับ 2026' );
        update_post_meta( $geo->ID, 'rank_math_description', 'GEO คือการทำคอนเทนต์ให้ AI อย่าง Google AI Overview หยิบไปอ้างอิง สรุปต่างจาก SEO ตรงไหน 5 เทคนิค วิธีวัดผล จากทีมที่ track AI Overview รายวันเอง' );
        clean_post_cache( $geo->ID );
    } else {
        $done = false;
    }

    if ( $done ) {
        update_option( 'hashbox_new_service_pages_rankmath_meta_version', $sync_key, false );
    }
}
add_action( 'wp', 'hashbox_sync_new_service_pages_rankmath_meta', 1 );

/**
 * Rank Math meta sync for /services/n8n-automation/ (2026-08-24).
 *
 * แยกจาก hashbox_sync_new_service_pages_rankmath_meta() โดยเจตนา ไม่ใช่เพิ่ม
 * เข้า $targets ของตัวนั้น: ฟังก์ชันนั้นเก็บ option ก็ต่อเมื่อ **ทุก** target
 * มีอยู่จริง ถ้าเอาหน้าที่ยังไม่ได้สร้างใน WP ไปใส่ $done จะเป็น false ตลอด
 * แล้ว update_post_meta() ของอีกสามหน้าจะถูกยิงซ้ำทุก request จนกว่าจะมีคน
 * สร้างหน้า — เขียน DB ฟรีๆ บนเว็บ production
 *
 * ตัวนี้แตะหน้าเดียว: ก่อนหน้าจะถูกสร้าง มันเสีย get_page_by_path() หนึ่งครั้ง
 * ต่อ request และ **ไม่เขียนอะไรเลย** พอสร้างหน้าแล้วมันซิงก์ให้เองรอบถัดไป
 */
function hashbox_sync_n8n_service_rankmath_meta() {
    $sync_key = '20260824_n8n_automation_rankmath_meta_v1';
    if ( $sync_key === get_option( 'hashbox_n8n_service_rankmath_meta_version' ) ) {
        return;
    }

    $page = get_page_by_path( 'services/n8n-automation', OBJECT, 'page' );
    if ( ! $page ) {
        return; // ยังไม่ได้สร้างหน้าใน WP — ไม่ใช่ error รอบหน้าค่อยลองใหม่
    }

    // Keep in sync with $desc in page-n8n-automation.php and the meta map entry.
    update_post_meta( $page->ID, 'rank_math_title', 'รับทำ n8n Automation วางระบบให้จบเป็นโปรเจกต์ | Hashbox' );
    update_post_meta( $page->ID, 'rank_math_description', 'รับทำ n8n automation เริ่มต้น 29,000 บาท — วางระบบอัตโนมัติให้จบเป็นโปรเจกต์ พร้อมส่งมอบ workflow ที่แก้เองต่อได้ ไม่ผูกขาดกับเรา' );
    clean_post_cache( $page->ID );

    update_option( 'hashbox_n8n_service_rankmath_meta_version', $sync_key, false );
}
add_action( 'wp', 'hashbox_sync_n8n_service_rankmath_meta', 1 );

/*
 * No sync for /services/ai-consulting/ on purpose (2026-08-17).
 *
 * The two syncs above exist because a rank_math_title row beats the theme map
 * — both title filters bail the moment one is present. This page has no such
 * row: its live <title> is byte-for-byte the page_meta string, which can only
 * reach the browser through the fallback branch. (Compare /services/seo/,
 * which renders a title that appears nowhere in page_meta — that one IS a row.)
 * So editing the map is enough here, and writing a row would only retire the
 * map for this page and leave the title in two places that can drift apart.
 */

/**
 * Default Open Graph image with an existing asset fallback.
 */
function hashbox_default_og_image_url() {
    if ( file_exists( get_template_directory() . '/assets/og-default.jpg' ) ) {
        return get_template_directory_uri() . '/assets/og-default.jpg';
    }
    if ( file_exists( get_template_directory() . '/screenshot.jpg' ) ) {
        return get_template_directory_uri() . '/screenshot.jpg';
    }
    return get_template_directory_uri() . '/assets/favicons/apple-touch-icon.png';
}

/**
 * Real square brand logo for schema Organization.logo (Google logo
 * guidance prefers a near-square logo, not the 1200x630 OG banner).
 * Falls back to the OG image only if the logo asset is missing.
 */
function hashbox_logo_image_url() {
    if ( file_exists( get_template_directory() . '/assets/favicons/icon-512.png' ) ) {
        return get_template_directory_uri() . '/assets/favicons/icon-512.png';
    }
    return hashbox_default_og_image_url();
}

/**
 * Return [width, height] of the default OG image so OpenGraph tags
 * include og:image:width/height. Social previews render with a
 * placeholder until both are present, so emitting them improves
 * Facebook/LinkedIn/Slack card LCP. Cached for the request.
 */
function hashbox_default_og_image_dimensions() {
    static $dims = null;
    if ( null !== $dims ) {
        return $dims;
    }

    $candidates = array(
        get_template_directory() . '/assets/og-default.jpg',
        get_template_directory() . '/screenshot.jpg',
        get_template_directory() . '/assets/favicons/apple-touch-icon.png',
    );
    foreach ( $candidates as $path ) {
        if ( file_exists( $path ) ) {
            $info = @getimagesize( $path );
            if ( $info && isset( $info[0], $info[1] ) ) {
                $dims = array( (int) $info[0], (int) $info[1] );
                return $dims;
            }
        }
    }
    $dims = array( 0, 0 );
    return $dims;
}

/**
 * Resolve width/height for an arbitrary OG image URL (featured image
 * on a post falls back to attachment metadata so we avoid a disk
 * read; default OG falls back to hashbox_default_og_image_dimensions).
 */
function hashbox_og_image_dimensions( $image_url ) {
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing && function_exists( 'hashbox_audit_landing_og_image_url' ) && hashbox_audit_landing_og_image_url( $audit_landing ) === $image_url ) {
        $path = hashbox_audit_landing_asset_path( $audit_landing['og_image'] );
        if ( file_exists( $path ) ) {
            $info = @getimagesize( $path );
            if ( $info && isset( $info[0], $info[1] ) ) {
                return array( (int) $info[0], (int) $info[1] );
            }
        }
    }

    if ( is_singular() ) {
        $thumb_id = get_post_thumbnail_id( get_queried_object_id() );
        if ( $thumb_id ) {
            $src = wp_get_attachment_image_src( $thumb_id, 'full' );
            if ( $src && isset( $src[1], $src[2] ) ) {
                return array( (int) $src[1], (int) $src[2] );
            }
        }
    }
    return hashbox_default_og_image_dimensions();
}

/**
 * Canonical-like URL for social metadata.
 */
function hashbox_current_public_url() {
    if ( is_front_page() ) {
        return home_url( '/' );
    }
    if ( is_home() ) {
        return home_url( '/blog/' );
    }
    $case_slug = hashbox_current_case_study_slug();
    if ( $case_slug ) {
        return hashbox_case_study_canonical_url( $case_slug );
    }
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing && function_exists( 'hashbox_audit_landing_canonical_url' ) ) {
        return hashbox_audit_landing_canonical_url( $audit_landing );
    }
    if ( function_exists( 'hashbox_is_ads_preview_request' ) && hashbox_is_ads_preview_request() ) {
        return home_url( '/ads-preview/' );
    }
    if ( is_singular() ) {
        return get_permalink();
    }
    if ( is_category() ) {
        return is_paged() ? get_pagenum_link( get_query_var( 'paged' ) ) : get_category_link( get_queried_object_id() );
    }
    if ( is_tag() ) {
        return is_paged() ? get_pagenum_link( get_query_var( 'paged' ) ) : get_tag_link( get_queried_object_id() );
    }
    if ( is_search() ) {
        return get_search_link();
    }
    return get_pagenum_link();
}

/**
 * Fallback meta description + Open Graph/Twitter tags.
 *
 * Rank Math owns these tags when active. The theme emits them only as a
 * no-plugin fallback to avoid duplicate metadata.
 */
function hashbox_homepage_meta_description() {
    if ( hashbox_rank_math_is_active() ) {
        return;
    }

    $desc = hashbox_get_meta_description();
    if ( empty( $desc ) ) {
        return;
    }

    $title = wp_get_document_title();
    $url   = hashbox_current_public_url();
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    $image = $audit_landing && function_exists( 'hashbox_audit_landing_og_image_url' )
        ? hashbox_audit_landing_og_image_url( $audit_landing )
        : ( is_singular() ? hashbox_og_image_url( get_queried_object_id() ) : hashbox_default_og_image_url() );
    $type  = is_singular( 'post' ) ? 'article' : 'website';

    echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:locale" content="' . esc_attr( hashbox_page_og_locale() ) . '">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
    echo '<meta property="og:image:alt" content="' . esc_attr( $title ) . '">' . "\n";
    list( $img_w, $img_h ) = hashbox_og_image_dimensions( $image );
    if ( $img_w > 0 && $img_h > 0 ) {
        echo '<meta property="og:image:width" content="' . (int) $img_w . '">' . "\n";
        echo '<meta property="og:image:height" content="' . (int) $img_h . '">' . "\n";
    }
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
}
add_action( 'wp_head', 'hashbox_homepage_meta_description', 1 );

/**
 * Emit <meta name="robots" content="noindex,follow"> on pages that
 * shouldn't enter Google's index: internal search results, the 404
 * page, paginated archives beyond page 1, and the password-gated
 * portfolio page. Rank Math handles this when active, so we skip.
 */
function hashbox_seo_noindex_meta() {
    if ( hashbox_rank_math_is_active() ) {
        return;
    }

    $should_noindex = is_search()
        || is_404()
        || is_page_template( 'page-portfolio.php' )
        || ( is_paged() && ( is_category() || is_tag() || is_author() || is_date() ) );

    if ( $should_noindex ) {
        echo '<meta name="robots" content="noindex,follow">' . "\n";
    }
}
add_action( 'wp_head', 'hashbox_seo_noindex_meta', 1 );

/**
 * Rank Math delegates noindex to per-page settings, which are easy to forget.
 * Force noindex on the password-gated portfolio template (and, defensively, on
 * internal search + paginated archives) so a thin/gated page can't slip into
 * the index when Rank Math is active. This filter only fires while Rank Math is
 * active, complementing hashbox_seo_noindex_meta() which runs when it is not —
 * so exactly one robots directive is emitted, never a duplicate.
 */
function hashbox_rankmath_force_noindex( $robots ) {
    $should_noindex = is_search()
        || is_page_template( 'page-portfolio.php' )
        || ( is_paged() && ( is_category() || is_tag() || is_author() || is_date() ) );

    if ( $should_noindex ) {
        $robots['index']  = 'noindex';
        $robots['follow'] = 'follow';
    }
    return $robots;
}
add_filter( 'rank_math/frontend/robots', 'hashbox_rankmath_force_noindex' );

/**
 * Preload the LCP image so it starts downloading during HTML parse
 * instead of after CSS. Landing pages preload their WebP hero art;
 * singular posts preload the featured image.
 */
function hashbox_preload_critical_assets() {
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing && function_exists( 'hashbox_audit_landing_asset_uri' ) ) {
        if ( 'ai-workflow-audit' === $audit_landing['slug'] ) {
            return;
        }
        echo '<link rel="preload" as="image" fetchpriority="high" media="(max-width: 720px)" imagesrcset="' . esc_attr( hashbox_ad_webp_srcset( $audit_landing['portrait_image'], array( 540, 1080 ) ) ) . '" imagesizes="100vw">' . "\n";
        echo '<link rel="preload" as="image" fetchpriority="high" media="(min-width: 721px)" href="' . esc_url( hashbox_ad_webp_uri( $audit_landing['wide_image'], 1200 ) ) . '" imagesrcset="' . esc_attr( hashbox_ad_webp_srcset( $audit_landing['wide_image'], array( 640, 1200 ) ) ) . '" imagesizes="(min-width: 900px) 640px, 100vw">' . "\n";
        return;
    }

    if ( is_front_page() ) {
        echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( hashbox_ad_webp_uri( 'linkedin_wide_seo_ready_v4.png', 1200 ) ) . '" imagesrcset="' . esc_attr( hashbox_ad_webp_srcset( 'linkedin_wide_seo_ready_v4.png', array( 640, 1200 ) ) ) . '" imagesizes="(min-width: 900px) 640px, 100vw">' . "\n";
        return;
    }

    if ( is_singular() && has_post_thumbnail() ) {
        $img = wp_get_attachment_image_url( get_post_thumbnail_id(), 'full' );
        if ( $img ) {
            echo '<link rel="preload" as="image" fetchpriority="high" href="' . esc_url( $img ) . '">' . "\n";
        }
    }
}
add_action( 'wp_head', 'hashbox_preload_critical_assets', 2 );

/**
 * Bilingual URL pairs for hreflang.
 *
 * Each pair maps the canonical Thai page path to its English
 * counterpart. EN pages live under /en/ as standalone WP pages
 * assigned the matching "EN:" template. Keep this list small and
 * explicit — the site is TH-first, EN pages exist only for the
 * high-value English query clusters surfaced in Search Console
 * (currently AI consulting: "ai consulting bangkok" et al.).
 */
function hashbox_hreflang_pairs() {
    return array(
        array(
            'th' => 'services/ai-consulting',
            'en' => 'en/ai-consulting',
        ),
        array(
            'th' => 'services/seo',
            'en' => 'en/seo',
        ),
        array(
            'th' => 'services/ai-search',
            'en' => 'en/ai-search',
        ),
    );
}

/**
 * Emit reciprocal hreflang alternates on any page that has a
 * bilingual counterpart. TH is x-default (the site's primary
 * language). Guarded so nothing is emitted until BOTH pages exist
 * — pointing hreflang at a 404 is worse than omitting it, so a
 * pair only activates once its EN page has been created in WP.
 */
function hashbox_inject_hreflang() {
    $path = hashbox_current_request_path();

    foreach ( hashbox_hreflang_pairs() as $pair ) {
        if ( $path !== $pair['th'] && $path !== $pair['en'] ) {
            continue;
        }

        // Only emit when the EN page actually exists.
        if ( ! get_page_by_path( $pair['en'], OBJECT, 'page' ) ) {
            return;
        }

        $th_url = home_url( '/' . $pair['th'] . '/' );
        $en_url = home_url( '/' . $pair['en'] . '/' );

        printf( '<link rel="alternate" hreflang="th" href="%s">' . "\n", esc_url( $th_url ) );
        printf( '<link rel="alternate" hreflang="en" href="%s">' . "\n", esc_url( $en_url ) );
        printf( '<link rel="alternate" hreflang="x-default" href="%s">' . "\n", esc_url( $th_url ) );
        return;
    }
}
add_action( 'wp_head', 'hashbox_inject_hreflang', 3 );

/**
 * Build Person schema for an author. Pulls bio/social from user meta
 * (LinkedIn, Twitter, GitHub) exposed via hashbox_user_contact_methods().
 * Falls back to publisher Organization when author identity is thin so
 * Article schema validates either way.
 */
function hashbox_author_schema( $user_id ) {
    $user_id = (int) $user_id;
    if ( ! $user_id ) {
        return array( '@id' => home_url( '/#organization' ) );
    }

    $display = get_the_author_meta( 'display_name', $user_id );
    if ( empty( $display ) ) {
        return array( '@id' => home_url( '/#organization' ) );
    }

    $same_as = array();
    foreach ( array( 'linkedin', 'twitter', 'github' ) as $key ) {
        $url = get_the_author_meta( $key, $user_id );
        if ( ! empty( $url ) ) {
            $same_as[] = esc_url_raw( $url );
        }
    }

    $person = array(
        '@type' => 'Person',
        '@id'   => get_author_posts_url( $user_id ) . '#author',
        'name'  => $display,
        'url'   => get_author_posts_url( $user_id ),
    );

    $bio = get_the_author_meta( 'description', $user_id );
    if ( ! empty( $bio ) ) {
        $person['description'] = wp_strip_all_tags( $bio );
    }

    $job = get_the_author_meta( 'job_title', $user_id );
    if ( ! empty( $job ) ) {
        $person['jobTitle'] = $job;
    }

    if ( ! empty( $same_as ) ) {
        $person['sameAs'] = $same_as;
    }

    $person['worksFor'] = array( '@id' => home_url( '/#organization' ) );

    return $person;
}

/**
 * Surface LinkedIn / X (Twitter) / GitHub fields on the user profile
 * screen so editors can fill them in. Powers Person schema sameAs.
 */
function hashbox_user_contact_methods( $methods ) {
    $methods['linkedin'] = 'LinkedIn URL';
    $methods['twitter']  = 'X (Twitter) URL';
    $methods['github']   = 'GitHub URL';
    $methods['job_title'] = 'Job title';
    return $methods;
}
add_filter( 'user_contactmethods', 'hashbox_user_contact_methods' );

/**
 * Feed optimized SEO metadata into Rank Math.
 */
function hashbox_rankmath_title( $title ) {
    // Honor a per-post custom title set in the Rank Math editor. The
    // theme's titles are a FALLBACK for pages driven by page_meta
    // (services, about, EN pages); they must not clobber a title an
    // editor deliberately set on an individual post/page.
    $obj_id = get_queried_object_id();
    if ( $obj_id && '' !== (string) get_post_meta( $obj_id, 'rank_math_title', true ) ) {
        return $title;
    }
    return hashbox_get_seo_title( $title );
}
add_filter( 'rank_math/frontend/title', 'hashbox_rankmath_title', 999 );

function hashbox_rankmath_description( $description ) {
    // Same precedence rule as the title: a custom per-post Rank Math
    // description wins over the theme's generated fallback.
    $obj_id = get_queried_object_id();
    if ( $obj_id && '' !== (string) get_post_meta( $obj_id, 'rank_math_description', true ) ) {
        return $description;
    }
    $seo_description = hashbox_get_meta_description();
    return ! empty( $seo_description ) ? $seo_description : $description;
}
add_filter( 'rank_math/frontend/description', 'hashbox_rankmath_description', 999 );

function hashbox_rankmath_social_title( $content ) {
    // Same precedence rule as the document title: a custom per-post
    // Rank Math title wins over the theme's generated fallback.
    if ( hashbox_has_custom_rankmath_title() ) {
        return $content;
    }
    return hashbox_get_seo_title( $content );
}
add_filter( 'rank_math/opengraph/facebook/og_title', 'hashbox_rankmath_social_title', 999 );
add_filter( 'rank_math/opengraph/twitter/twitter_title', 'hashbox_rankmath_social_title', 999 );

function hashbox_rankmath_social_description( $content ) {
    $seo_description = hashbox_get_meta_description();
    return ! empty( $seo_description ) ? $seo_description : $content;
}
add_filter( 'rank_math/opengraph/facebook/og_description', 'hashbox_rankmath_social_description', 999 );
add_filter( 'rank_math/opengraph/twitter/twitter_description', 'hashbox_rankmath_social_description', 999 );

/**
 * Rank Math sitemap pretty URLs can 404 on hosts where the root .htaccess is
 * not managed by this theme. Keep the public /sitemap_index.xml style URLs
 * mapped to Rank Math's working query endpoints.
 */
function hashbox_rankmath_sitemap_query_from_path( $path ) {
    $path = trim( (string) $path, '/' );

    if ( 'sitemap_index.xml' === $path ) {
        return array( 'sitemap' => '1' );
    }

    if ( preg_match( '#^([a-z0-9_-]+)-sitemap([0-9]+)?\.xml$#i', $path, $matches ) ) {
        $query = array( 'sitemap' => sanitize_key( $matches[1] ) );
        if ( ! empty( $matches[2] ) ) {
            $query['sitemap_n'] = absint( $matches[2] );
        }
        return $query;
    }

    if ( preg_match( '#^([a-z]+)?-?sitemap\.xsl$#i', $path, $matches ) ) {
        return array( 'xsl' => ! empty( $matches[1] ) ? sanitize_key( $matches[1] ) : '' );
    }

    return array();
}

function hashbox_register_rankmath_sitemap_rewrites() {
    if ( ! hashbox_rank_math_is_active() ) {
        return;
    }

    add_rewrite_rule( '^sitemap_index\.xml$', 'index.php?sitemap=1', 'top' );
    add_rewrite_rule( '^([^/]+?)-sitemap([0-9]+)?\.xml$', 'index.php?sitemap=$matches[1]&sitemap_n=$matches[2]', 'top' );
    add_rewrite_rule( '^([a-z]+)?-?sitemap\.xsl$', 'index.php?xsl=$matches[1]', 'top' );
}
add_action( 'init', 'hashbox_register_rankmath_sitemap_rewrites', 1 );

function hashbox_prime_rankmath_sitemap_request() {
    if ( ! hashbox_rank_math_is_active() || is_admin() || wp_doing_ajax() ) {
        return;
    }

    $path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : '';
    $query = hashbox_rankmath_sitemap_query_from_path( $path );
    if ( empty( $query ) ) {
        return;
    }

    foreach ( $query as $key => $value ) {
        $_GET[ $key ]     = $value;
        $_REQUEST[ $key ] = $value;
    }
}
add_action( 'init', 'hashbox_prime_rankmath_sitemap_request', -100 );

function hashbox_flush_rankmath_sitemap_rewrites_once() {
    if ( ! hashbox_rank_math_is_active() ) {
        return;
    }

    $rewrite_key = '20260608_rankmath_sitemap_rewrites_v1';
    if ( $rewrite_key === get_option( 'hashbox_rankmath_sitemap_rewrite_version' ) ) {
        return;
    }

    flush_rewrite_rules( false );
    update_option( 'hashbox_rankmath_sitemap_rewrite_version', $rewrite_key, false );
}
add_action( 'init', 'hashbox_flush_rankmath_sitemap_rewrites_once', 30 );

/**
 * Case-study pages live in WP under /services/* on production, but the public
 * SEO URL should be /work/* to match the IA and internal links.
 */
function hashbox_case_study_slugs() {
    return array(
        'nexus-corp',
        'flow-store',
        'rank-project',
        'autobot-line',
        'gold-brand',
        'pitch-deck',
    );
}

function hashbox_is_case_study_slug( $slug ) {
    return in_array( sanitize_title( $slug ), hashbox_case_study_slugs(), true );
}

function hashbox_case_study_canonical_url( $slug ) {
    return home_url( '/work/' . sanitize_title( $slug ) . '/' );
}

function hashbox_current_request_path() {
    $uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
    $path = $uri ? wp_parse_url( $uri, PHP_URL_PATH ) : '';
    return trim( (string) $path, '/' );
}

/* =========================================================================
 * Paid Audit Landing Pages — Google/Meta/LinkedIn campaign entry points.
 * ========================================================================= */

function hashbox_audit_landing_pages() {
    static $pages = null;
    if ( null !== $pages ) {
        return $pages;
    }

    $pages = array(
        'ai-workflow-audit' => array(
            'slug'             => 'ai-workflow-audit',
            'service_label'    => 'AI Workforce',
            'service_interest' => 'AI Tool / LINE Bot',
            'meta_title'       => 'AI Opportunity Screening ฟรี 30 นาที | Hashbox Studio',
            'meta_description' => 'คุยกับทีม AI 30 นาทีเพื่อประเมินโอกาสลดงานซ้ำด้วย LINE Bot, RAG Knowledge Base และ Workflow Automation พร้อมแนวทางเริ่มต้นที่เหมาะกับธุรกิจ',
            'hero_headline'    => 'ลดงานซ้ำด้วย AI ที่วัด ROI ได้',
            'hero_subcopy'     => 'LINE Bot, RAG Knowledge Base และ Workflow Automation สำหรับทีมขายและซัพพอร์ตที่ต้องการตอบเร็วขึ้นโดยไม่เพิ่ม headcount',
            'hero_vendor'      => 'AI Consulting + Production Implementation ในกรุงเทพฯ สำหรับธุรกิจไทย',
            'primary_cta'      => 'ส่งโจทย์ให้ทีม AI',
            'proof_line'       => '-60% Support Cost จาก AI Bot + RAG ภายใน 8 สัปดาห์',
            'creative_key'     => 'ai_workforce',
            'utm_content'      => 'ai_workforce_v4',
            'wide_image'       => 'linkedin_wide_ai_workforce_v4.png',
            'portrait_image'   => 'meta_portrait_ai_workforce_v4.png',
            'square_image'     => 'meta_square_ai_workforce_v4.png',
            'story_image'      => 'meta_story_ai_workforce_v4.png',
            'og_image'         => 'linkedin_wide_ai_workforce_v4.png',
            'pain_points'      => array(
                'ทีมขายและซัพพอร์ตตอบคำถามซ้ำหลายรอบต่อวัน แต่ยังไม่มี knowledge base ที่ AI ใช้ได้จริง',
                'อยากใช้ AI แต่ยังไม่ชัดว่า use case ไหนคืนทุนและควรเริ่มจาก workflow ใดก่อน',
                'ข้อมูลกระจายอยู่ใน LINE, sheet, PDF และ CRM ทำให้ลูกค้ารอคำตอบนานกว่าที่ควร',
            ),
            'use_cases'        => array(
                array(
                    'title' => 'AI / LINE Chatbot',
                    'body'  => 'ตอบ FAQ, สถานะงาน และคำถามก่อนขายตลอด 24 ชั่วโมง พร้อมส่งต่อเคสซับซ้อนให้ทีมงาน',
                    'fit'   => 'ทีมตอบคำถามเดิมซ้ำ ๆ และลูกค้ารอคำตอบนอกเวลาทำการ',
                ),
                array(
                    'title' => 'Workflow Automation',
                    'body'  => 'เชื่อม LINE, CRM, Sheet, Email และระบบหลังบ้าน เพื่อลดการคัดลอกข้อมูลและงานส่งต่อแบบ manual',
                    'fit'   => 'ข้อมูลเดียวกันต้องถูกกรอกหลายระบบ หรือมีงานตกหล่นระหว่างทีม',
                ),
                array(
                    'title' => 'RAG Knowledge Assistant',
                    'body'  => 'ค้นและตอบจากเอกสารภายใน เช่น policy, product spec, SOP และคู่มือ โดยอ้างอิงแหล่งข้อมูลที่ตรวจสอบได้',
                    'fit'   => 'ความรู้อยู่กระจายใน PDF, Drive หรือ Notion และคนหาไม่ทันเวลาที่ต้องใช้',
                ),
            ),
            'audit_includes'   => array(
                array( 'title' => 'โจทย์ที่ควรเริ่มก่อน', 'body' => 'คัด use case ที่น่าทดลองจากปริมาณงานซ้ำ ผลกระทบ และความพร้อมของทีม' ),
                array( 'title' => 'แผนผัง Workflow แบบเร็ว', 'body' => 'มองภาพ flow ของ LINE Bot, RAG, CRM handoff และจุดที่ควรให้มนุษย์รับต่อ' ),
                array( 'title' => 'ขั้นตอนถัดไปที่แนะนำ', 'body' => 'สรุปว่าควรจัดข้อมูล ทดลอง PoC หรือทำ ROI Assessment แบบลงรายละเอียดต่อหรือไม่' ),
            ),
            'proof'            => array(
                'metric' => '-60%',
                'title'  => 'ลด support cost ด้วย LINE Bot + RAG',
                'body'   => 'ทีม Hashbox เคยทำ AI Bot สำหรับ on-demand service ให้ตอบลูกค้า 24/7, ลด response time และ route งานซับซ้อนไปหา human โดยยังวัดผลผ่าน dashboard เดียว',
                'href'   => '/work/autobot-line/',
            ),
            'case_metrics'     => array(
                array( 'metric' => '2 นาที', 'label' => 'Avg Response Time', 'detail' => 'ลดลงจาก 2 ชั่วโมง' ),
                array( 'metric' => '84%', 'label' => 'AI-handled Resolution', 'detail' => 'AI จัดการเคสได้โดยไม่ต้องส่งต่อ' ),
                array( 'metric' => '8 สัปดาห์', 'label' => 'Time to Production', 'detail' => 'จาก discovery ถึงระบบที่ใช้งานจริง' ),
            ),
            'engagements'      => array(
                array(
                    'title'    => 'AI Opportunity Screening',
                    'price'    => 'ฟรี',
                    'timeline' => '30 นาที',
                    'body'     => 'คุยโจทย์ ความพร้อมของข้อมูล และขั้นตอนถัดไปที่เหมาะกับธุรกิจ',
                    'decision' => 'กรอบ use case และ next step เบื้องต้น เพื่อนำไปตัดสินใจต่อโดยไม่ผูกมัด',
                ),
                array(
                    'title'    => 'ROI Assessment',
                    'price'    => 'เริ่ม 60,000 บาท',
                    'timeline' => '1–2 สัปดาห์',
                    'body'     => 'Discovery และวิเคราะห์ 1 use case เพื่อจัดลำดับ workflow และประเมิน ROI',
                    'decision' => 'ROI Assessment Report ของ 1 use case เพื่อเลือกทำ PoC ปรับ scope หรือหยุด',
                ),
                array(
                    'title'    => 'PoC + Validation',
                    'price'    => 'เริ่ม 200,000 บาท',
                    'timeline' => '3–5 สัปดาห์',
                    'body'     => 'ทดสอบ 1 AI use case แบบ end-to-end กับข้อมูลจริงก่อนลงทุนระบบเต็ม',
                    'decision' => 'ผลทดสอบ end-to-end กับข้อมูลจริง เพื่อเลือกขึ้น Production ปรับ scope หรือหยุด',
                ),
                array(
                    'title'    => 'Production Build',
                    'price'    => 'เริ่ม 500,000 บาท',
                    'timeline' => '6–12 สัปดาห์',
                    'body'     => '1–2 AI systems พร้อม integration, source code, monitoring และซัพพอร์ตหลังเปิดใช้ 30 วัน',
                    'decision' => 'Source code และระบบ Production พร้อม monitoring เพื่อให้ทีมรับช่วงต่อได้โดยไม่ผูก vendor',
                ),
            ),
            'engagement_note'  => 'ราคาเริ่มต้นตามขอบเขตที่ระบุ ไม่รวม VAT 7% และค่า API · ทีมจะสรุป scope และใบเสนอราคาหลัง Screening',
            'project_lead'     => array(
                'name'       => 'Tum Thaweewat',
                'role'       => 'Head of Tech',
                'experience' => '17 ปีในงาน Software Engineering',
                'linkedin'   => 'https://www.linkedin.com/in/tumthaweewat/',
            ),
            'process'          => array(
                array( 'title' => 'วัด baseline งานซ้ำ', 'body' => 'เก็บคำถามซ้ำ, SLA, ticket volume และต้นทุนเวลาของทีม' ),
                array( 'title' => 'เลือก use case ที่คืนทุน', 'body' => 'จัด priority ด้วย ROI, integration effort และ risk ของข้อมูล' ),
                array( 'title' => 'สรุปแนวทางเริ่มต้น', 'body' => 'แนะนำ next step, ช่วงเวลา และระดับงบประมาณเบื้องต้นที่เหมาะกับทีมคุณ' ),
            ),
            'faqs'             => array(
                array( 'q' => 'Screening นี้เหมาะกับธุรกิจแบบไหน?', 'a' => 'เหมาะกับทีมที่มีแชทลูกค้าเยอะ มี FAQ หรือ policy ซ้ำ ๆ และอยากเริ่มใช้ AI แบบวัดผลได้ ไม่ใช่ทำ demo แล้วจบ' ),
                array( 'q' => 'Screening ฟรีต่างจาก ROI Assessment อย่างไร?', 'a' => 'Screening 30 นาทีใช้เพื่อดูโจทย์ ความพร้อม และ next step เบื้องต้น ส่วน ROI Assessment เป็นงานแบบเสียค่าใช้จ่ายที่ map workflow และเปรียบเทียบชั่วโมงที่ลดได้กับค่าพัฒนาและ API' ),
                array( 'q' => 'ราคาเริ่มต้นและใช้เวลาเท่าไหร่?', 'a' => 'ROI Assessment เริ่ม 60,000 บาท ใช้เวลา 1–2 สัปดาห์ · PoC + Validation เริ่ม 200,000 บาท ใช้เวลา 3–5 สัปดาห์ · Production Build เริ่ม 500,000 บาท ใช้เวลา 6–12 สัปดาห์ ขึ้นกับข้อมูลและ integration scope' ),
                array( 'q' => 'ต้องมีข้อมูลพร้อมแค่ไหนก่อนเริ่ม?', 'a' => 'ไม่จำเป็นต้องพร้อมทั้งหมดครับ Screening จะช่วยบอกว่าข้อมูลส่วนไหนใช้ได้ทันที ส่วนไหนควรจัดโครงสร้างก่อนนำเข้า RAG หรือ Bot' ),
                array( 'q' => 'ข้อมูลลูกค้าและ PDPA ดูแลอย่างไร?', 'a' => 'ทีมเลือก AI provider ตามความไวของข้อมูล รองรับทั้ง enterprise provider และ self-host พร้อมวาง data masking และ audit log ตามขอบเขตโปรเจกต์' ),
                array( 'q' => 'ลูกค้าได้รับ source code และถูกผูกกับ vendor หรือไม่?', 'a' => 'ลูกค้าเป็นเจ้าของ source code 100% ตามขอบเขตที่ตกลง ไม่ผูก vendor และระบบ production มี monitoring, cost guardrails และ fallback logic' ),
                array( 'q' => 'มีดูแลระบบหลังเปิดใช้หรือไม่?', 'a' => 'มี Care Plan รายเดือนเริ่ม 30,000 บาท ครอบคลุม API cost monitoring, performance tracking, prompt update, hallucination guard, security patch และ monthly performance review' ),
                array( 'q' => 'หลัง Screening ต้องจ้างทำต่อไหม?', 'a' => 'ไม่บังคับครับ คุณจะได้แนวทางเบื้องต้นกลับไปตัดสินใจ ถ้าต้องการ business case แบบลงรายละเอียดค่อยเริ่ม ROI Assessment Report หรือ PoC ต่อ' ),
            ),
        ),
        'seo-audit' => array(
            'slug'             => 'seo-audit',
            'service_label'    => 'SEO-Ready Website',
            'service_interest' => 'SEO-Ready Website',
            'meta_title'       => 'รับทำ SEO Audit ฟรี — Technical SEO Audit สำหรับเว็บใหม่ | Hashbox',
            'meta_description' => 'รับทำ SEO Audit ฟรี: ตรวจแผนทำเว็บใหม่ให้พร้อมติด Google และ AI Search ตั้งแต่วันแรก ครอบคลุม Technical SEO, Core Web Vitals, Schema, GA4 และ GSC รายงาน 15–20 หน้าใน 3 วันทำการ',
            'hero_headline'    => 'รับทำ SEO Audit ฟรี — ทำเว็บใหม่ให้พร้อมติด Google',
            'hero_subcopy'     => 'วาง Technical SEO, Core Web Vitals, Schema และ GA4/GSC ตั้งแต่วันแรก เพื่อให้เว็บใหม่ไม่เสียโอกาส organic traffic หลัง deploy',
            'primary_cta'      => 'ขอ SEO Audit ฟรี',
            'proof_line'       => '100 Lighthouse Score และ Core Web Vitals เขียวทุก URL ก่อน Deploy',
            'creative_key'     => 'seo_ready',
            'utm_content'      => 'seo_ready_v4',
            'wide_image'       => 'linkedin_wide_seo_ready_v4.png',
            'portrait_image'   => 'meta_portrait_seo_ready_v4.png',
            'square_image'     => 'meta_square_seo_ready_v4.png',
            'story_image'      => 'meta_story_seo_ready_v4.png',
            'og_image'         => 'linkedin_wide_seo_ready_v4.png',
            'pain_points'      => array(
                'กำลังทำเว็บใหม่แต่ยังไม่มี SEO checklist ที่ทีม dev, content และ owner ใช้ร่วมกัน',
                'กลัวเว็บสวยแต่โหลดช้า ไม่มี schema, sitemap, canonical หรือ GA4/GSC ตั้งแต่วันแรก',
                'ต้องการ migrate หรือเปิดตัวเว็บใหม่โดยไม่ให้ ranking และ indexed pages หายไป',
            ),
            'audit_includes'   => array(
                array( 'title' => 'SEO Build Gate', 'body' => 'Checklist สำหรับ Lighthouse, CWV, schema, sitemap, canonical และ redirect plan' ),
                array( 'title' => 'Information Architecture', 'body' => 'ตรวจโครงสร้างหน้า, service taxonomy และ internal link ให้รองรับ keyword intent' ),
                array( 'title' => 'Launch Tracking Plan', 'body' => 'กำหนด GA4, GSC, conversion events และ dashboard ที่ต้องติดก่อนเปิดเว็บ' ),
            ),
            'proof'            => array(
                'metric' => '100',
                'title'  => 'Lighthouse 100 เป็น build gate ไม่ใช่คำสัญญาหลังบ้าน',
                'body'   => 'เว็บที่ทีม Hashbox ส่งมอบต้องผ่าน performance, accessibility, best practices และ SEO gate ก่อน deploy พร้อมตรวจ CWV และ schema validator ทุก URL สำคัญ',
                'href'   => '/services/website-development/',
            ),
            'process'          => array(
                array( 'title' => 'ตรวจเว็บหรือ wireframe ปัจจุบัน', 'body' => 'ดู sitemap, page intent, content gap และ technical risk ก่อนเริ่ม build' ),
                array( 'title' => 'วาง launch checklist', 'body' => 'ระบุสิ่งที่ต้องมีใน sprint แรก เช่น schema, redirect, tracking และ CWV budget' ),
                array( 'title' => 'ส่ง roadmap 30/60/90 วัน', 'body' => 'ทำให้ทีมเห็นว่าเปิดเว็บแล้วต้อง optimize อะไรต่อเพื่อให้ Google เก็บสัญญาณได้เร็ว' ),
            ),
            'faqs'             => array(
                array( 'q' => 'ถ้ายังไม่มีเว็บเดิม ขอ Audit ได้ไหม?', 'a' => 'ได้ครับ เราจะตรวจจาก brief, wireframe, sitemap หรือคู่แข่งแทน เพื่อวาง SEO-ready requirements ก่อนเริ่มออกแบบและพัฒนา' ),
                array( 'q' => 'Audit ครอบคลุม migration จากเว็บเก่าหรือไม่?', 'a' => 'ครอบคลุมครับ โดยเฉพาะ redirect map, URL inventory, canonical และ priority pages ที่ห้ามเสีย ranking ตอนย้ายเว็บ' ),
                array( 'q' => 'ใช้กับ WordPress ได้ไหม?', 'a' => 'ได้ครับ ทีมเราทำได้ทั้ง WordPress custom theme และ Next.js/headless โดยเลือก stack จาก requirement ของทีมคุณ' ),
            ),
        ),
        'seo-recovery-audit' => array(
            'slug'             => 'seo-recovery-audit',
            'service_label'    => 'Technical SEO',
            'service_interest' => 'SEO-Ready Website',
            'meta_title'       => 'รับทำ Technical SEO Audit ฟรี — SEO Recovery สำหรับเว็บที่ Traffic ตก | Hashbox',
            'meta_description' => 'รับทำ Technical SEO Audit ฟรี: Traffic ตกหรือ organic ไม่โต ให้ทีมตรวจ Core Web Vitals, indexation, schema, backlinks และ competitor gap พร้อม recovery roadmap ที่บอกว่าควรแก้อะไรก่อน',
            'hero_headline'    => 'Technical SEO Audit ฟรี — Traffic ตก? ให้ทีมตรวจระบบ SEO',
            'hero_subcopy'     => 'เช็ก CWV, Indexation, Schema, Backlinks และ Competitor Gap พร้อม roadmap ที่บอกว่าควรแก้ technical หรือ content ก่อน',
            'primary_cta'      => 'รับ Audit ฟรี',
            'proof_line'       => '+2,200% Impressions จาก Technical SEO + Content Recovery',
            'creative_key'     => 'seo_recovery',
            'utm_content'      => 'seo_recovery_v4',
            'wide_image'       => 'linkedin_wide_seo_recovery_v4.png',
            'portrait_image'   => 'meta_portrait_seo_recovery_v4.png',
            'square_image'     => 'meta_square_seo_recovery_v4.png',
            'story_image'      => 'meta_story_seo_recovery_v4.png',
            'og_image'         => 'linkedin_wide_seo_recovery_v4.png',
            'pain_points'      => array(
                'Organic traffic ลดลงแต่ยังไม่รู้ว่าเกิดจาก technical, content, indexation หรือคู่แข่ง',
                'แก้ SEO เป็นรายจุดมาหลายครั้งแต่ ranking ยังไม่กลับ เพราะไม่มี baseline และ priority ที่ชัด',
                'GSC มี impressions หรือ indexed pages ผิดปกติ แต่ทีมยังไม่มี roadmap ที่ dev ลงมือทำได้ทันที',
            ),
            'audit_includes'   => array(
                array( 'title' => 'Technical Crawl', 'body' => 'ตรวจ indexation, canonical, sitemap, status code, schema และ internal link health' ),
                array( 'title' => 'Search Console Diagnosis', 'body' => 'อ่าน query/page trends เพื่อแยกสาเหตุ traffic drop และหา quick wins' ),
                array( 'title' => 'Recovery Roadmap', 'body' => 'จัดลำดับ dev fixes, content refresh และ competitor gap ตาม impact ต่อ organic growth' ),
            ),
            'proof'            => array(
                'metric' => '+2,200%',
                'title'  => 'SEO Recovery ที่วัดผลจาก GSC จริง',
                'body'   => 'Rank Project ใช้ Technical SEO overhaul และ content programme ต่อเนื่อง จน search impressions เพิ่ม 22 เท่า และ organic traffic เพิ่ม 700%',
                'href'   => '/work/rank-project/',
            ),
            'process'          => array(
                array( 'title' => 'อ่านสัญญาณจาก GSC/GA4', 'body' => 'แยก traffic drop ตาม query, page type, device และ date range สำคัญ' ),
                array( 'title' => 'ตรวจ technical blockers', 'body' => 'หา crawl waste, duplicate, CWV, schema และ indexation issue ที่ขวางการเติบโต' ),
                array( 'title' => 'ส่ง recovery backlog', 'body' => 'แบ่งงานเป็น quick wins, dev sprint และ content sprint พร้อม impact estimate' ),
            ),
            'faqs'             => array(
                array( 'q' => 'ต้องให้ access GSC/GA4 ไหม?', 'a' => 'ถ้าให้ได้จะวิเคราะห์แม่นขึ้นมากครับ แต่ถ้ายังไม่พร้อม เราเริ่มจาก public crawl และข้อมูลที่คุณ export มาให้ก่อนได้' ),
                array( 'q' => 'Audit ใช้เวลากี่วัน?', 'a' => 'โดยปกติ 3 วันทำการสำหรับเว็บ SME หรือ landing site ถ้าเป็นเว็บใหญ่หลายพัน URL จะประเมิน timeline เพิ่มหลังดู scope' ),
                array( 'q' => 'แก้แล้วเห็นผลทันทีไหม?', 'a' => 'บาง technical issue เห็นสัญญาณเร็วใน 2-4 สัปดาห์ แต่ ranking recovery ปกติควรวัดเป็นรอบ 60-90 วันตามการ crawl และ competitive landscape' ),
            ),
        ),
        'cro-funnel-audit' => array(
            'slug'             => 'cro-funnel-audit',
            'service_label'    => 'CRO Sprint',
            'service_interest' => 'รับทำ SEO + CRO',
            'meta_title'       => 'CRO Funnel Audit ฟรี | Hashbox Studio',
            'meta_description' => 'มี traffic แต่ lead ไม่มา ตรวจ funnel ด้วย GA4, GSC, heatmap และ A/B test plan เพื่อเพิ่ม conversion จาก traffic เดิม',
            'hero_headline'    => 'มี Traffic แต่ Lead ไม่มา?',
            'hero_subcopy'     => 'วัด funnel ด้วย GA4, GSC, heatmap และ A/B test เพื่อหา friction ที่ทำให้คนไม่กรอกฟอร์มหรือไม่ทัก LINE',
            'primary_cta'      => 'ตรวจ Funnel ฟรี',
            'proof_line'       => '3x Conversion Rate จาก CRO Sprint + Heatmap + A/B Test',
            'creative_key'     => 'cro_sprint',
            'utm_content'      => 'cro_sprint_v4',
            'wide_image'       => 'linkedin_wide_cro_sprint_v4.png',
            'portrait_image'   => 'meta_portrait_cro_sprint_v4.png',
            'square_image'     => 'meta_square_cro_sprint_v4.png',
            'story_image'      => 'meta_story_cro_sprint_v4.png',
            'og_image'         => 'linkedin_wide_cro_sprint_v4.png',
            'pain_points'      => array(
                'ยิงแอดหรือทำ SEO แล้วมี traffic แต่ form submit, LINE click หรือ qualified lead ต่ำ',
                'ติด GA4 แล้วแต่ event ไม่ครบ ทำให้ไม่รู้ว่าคนหลุดที่ hero, offer, pricing หรือ form',
                'เปลี่ยน copy/design ตามความรู้สึกมากกว่าทดสอบ hypothesis จากข้อมูลจริง',
            ),
            'audit_includes'   => array(
                array( 'title' => 'Conversion Event Check', 'body' => 'ตรวจ GA4 key events, Pixel, LinkedIn tag และ form/LINE/phone click tracking' ),
                array( 'title' => 'Funnel Friction Review', 'body' => 'อ่าน landing page, offer, CTA, form length และ trust proof เพื่อหา friction' ),
                array( 'title' => 'A/B Test Backlog', 'body' => 'เสนอ hypothesis ที่ควรทดสอบก่อน พร้อม metric และ sample size ที่ต้องใช้' ),
            ),
            'proof'            => array(
                'metric' => '3x',
                'title'  => 'เพิ่ม conversion จาก traffic เดิม',
                'body'   => 'Flow Store ใช้ storefront ใหม่และ CRO Sprint ต่อเนื่อง ทำให้ conversion rate เพิ่มจาก 1.2% เป็น 3.8% ภายใน 6 เดือน',
                'href'   => '/work/flow-store/',
            ),
            'process'          => array(
                array( 'title' => 'ตรวจ tracking ก่อน', 'body' => 'เช็กว่า lead events ถูกยิงจาก form, LINE, phone และ email อย่างถูกต้อง' ),
                array( 'title' => 'หา friction จากหน้าและ data', 'body' => 'อ่าน journey ตั้งแต่ ad intent ถึง form submit เพื่อจับจุดหลุดหลัก' ),
                array( 'title' => 'ส่ง test plan', 'body' => 'จัดลำดับ copy, layout, offer และ form tests ที่ควรทำใน sprint แรก' ),
            ),
            'faqs'             => array(
                array( 'q' => 'ต้องมี traffic เท่าไหร่ถึงทำ CRO ได้?', 'a' => 'ถ้า traffic ยังน้อย เราจะเน้น heuristic review และ tracking readiness ก่อน ส่วน A/B test จริงต้องมี volume พอให้ผลไม่แกว่ง' ),
                array( 'q' => 'Audit รวมติดตั้ง tracking ให้เลยไหม?', 'a' => 'Audit จะบอกสิ่งที่ขาดและ priority ให้ ส่วนการติดตั้งจริงทำต่อเป็น implementation sprint ได้หลังตกลง scope' ),
                array( 'q' => 'ดูได้ทั้ง lead form และ LINE OA ไหม?', 'a' => 'ได้ครับ เราดูทั้ง form submit, LINE click, phone click, email click และ quality ของ lead หลัง submit' ),
            ),
        ),
        'growth-audit' => array(
            'slug'             => 'growth-audit',
            'service_label'    => 'Web + Marketing + AI',
            'service_interest' => 'Bundle Web + SEO + AI',
            'meta_title'       => 'Growth Audit ฟรี | Hashbox Studio',
            'meta_description' => 'ทีมเดียวดูครบ Web, Ads, SEO และ AI ลดปัญหาแยกหลายเอเจนซี พร้อม audit funnel ทั้ง customer journey',
            'hero_headline'    => 'ทีมเดียวดูครบ Web, Ads, SEO และ AI',
            'hero_subcopy'     => 'ลดปัญหาแยกเอเจนซีหลายทีม แล้ววัด KPI เดียวตลอด customer journey ตั้งแต่ traffic, conversion จนถึง workflow หลังบ้าน',
            'primary_cta'      => 'เริ่มด้วย Audit ฟรี',
            'proof_line'       => '17 ปี Experience และ 300+ แบรนด์ที่ผ่านมือทีม',
            'creative_key'     => 'growth_bundle',
            'utm_content'      => 'growth_bundle_v4',
            'wide_image'       => 'linkedin_wide_growth_bundle_v4.png',
            'portrait_image'   => 'meta_portrait_growth_bundle_v4.png',
            'square_image'     => 'meta_square_growth_bundle_v4.png',
            'story_image'      => 'meta_story_growth_bundle_v4.png',
            'og_image'         => 'linkedin_wide_growth_bundle_v4.png',
            'pain_points'      => array(
                'เว็บ, แอด, SEO และ AI อยู่คนละทีม ทำให้ insight ไม่ต่อกันและไม่มีใครรับผิดชอบผลรวม',
                'มี dashboard หลายชุดแต่ยังตอบไม่ได้ว่า traffic คุณภาพแค่ไหนและ lead ติดตรงไหน',
                'อยาก scale growth แต่ติดทั้ง performance, conversion และ manual operation หลังบ้าน',
            ),
            'audit_includes'   => array(
                array( 'title' => 'Journey Audit', 'body' => 'ดูตั้งแต่ ad/search intent, landing page, tracking, lead quality และ follow-up workflow' ),
                array( 'title' => 'KPI Map', 'body' => 'รวม metric เว็บ, SEO, ads, CRO และ AI ให้เป็น operating dashboard ชุดเดียว' ),
                array( 'title' => '90-Day Growth Roadmap', 'body' => 'จัดลำดับ sprint ที่ควรทำก่อนระหว่าง web fix, tracking, CRO, SEO และ AI automation' ),
            ),
            'proof'            => array(
                'metric' => '300+',
                'title'  => 'ประสบการณ์ข้าม Web, Marketing และ AI',
                'body'   => 'Hashbox รวม web development, technical SEO, CRO และ AI consulting ไว้ในทีมเดียว เพื่อให้ funnel และ operational workflow ถูกออกแบบด้วย KPI เดียวกัน',
                'href'   => '/work/',
            ),
            'process'          => array(
                array( 'title' => 'รวมภาพ funnel ปัจจุบัน', 'body' => 'อ่าน channel, landing page, conversion, CRM handoff และ manual workload' ),
                array( 'title' => 'ระบุ bottleneck ที่กระทบ revenue', 'body' => 'แยกปัญหาที่ควรแก้ด้วย web, ads, SEO, CRO หรือ AI automation' ),
                array( 'title' => 'ส่ง sprint roadmap', 'body' => 'จัดลำดับงาน 90 วันแรกพร้อมเจ้าของ metric และ expected impact' ),
            ),
            'faqs'             => array(
                array( 'q' => 'Growth Audit ต่างจาก SEO Audit อย่างไร?', 'a' => 'SEO Audit โฟกัส organic visibility ส่วน Growth Audit มองทั้ง funnel ตั้งแต่ traffic, conversion, lead quality และ workflow หลังบ้าน' ),
                array( 'q' => 'เหมาะกับทีมที่มีเอเจนซีอยู่แล้วไหม?', 'a' => 'เหมาะครับ เราช่วยตรวจภาพรวมและช่องว่างระหว่างทีมได้ โดยไม่จำเป็นต้องเปลี่ยน vendor ทั้งหมดทันที' ),
                array( 'q' => 'ต้องเตรียมข้อมูลอะไรบ้าง?', 'a' => 'URL เว็บ, channel ที่ใช้อยู่, dashboard ถ้ามี, ปัญหาหลักที่อยากแก้ และเป้าหมาย lead/revenue ที่ต้องการวัด' ),
            ),
        ),
    );

    return $pages;
}

function hashbox_get_audit_landing_for_path( $path = null ) {
    $slug  = null === $path ? hashbox_current_request_path() : trim( (string) $path, '/' );
    $pages = hashbox_audit_landing_pages();
    return isset( $pages[ $slug ] ) ? $pages[ $slug ] : null;
}

function hashbox_is_ads_preview_request( $path = null ) {
    $slug = null === $path ? hashbox_current_request_path() : trim( (string) $path, '/' );
    return 'ads-preview' === $slug;
}

function hashbox_ads_preview_formats() {
    return array(
        'square_image'   => array(
            'label'      => 'Meta Square',
            'dimensions' => '1080x1080',
        ),
        'portrait_image' => array(
            'label'      => 'Meta Portrait',
            'dimensions' => '1080x1350',
        ),
        'story_image'    => array(
            'label'      => 'Meta Story',
            'dimensions' => '1080x1920',
        ),
        'wide_image'     => array(
            'label'      => 'LinkedIn Wide',
            'dimensions' => '1200x627',
        ),
    );
}

function hashbox_audit_landing_asset_uri( $file ) {
    return get_template_directory_uri() . '/assets/ads/hashbox/' . ltrim( (string) $file, '/' );
}

function hashbox_audit_landing_asset_path( $file ) {
    return get_template_directory() . '/assets/ads/hashbox/' . ltrim( (string) $file, '/' );
}

/**
 * URI of a WebP variant generated by tools/optimize-ad-images.mjs
 * (assets/ads/hashbox/webp/<stem>-<width>w.webp). Falls back to the
 * source PNG when the variant is missing so a stale deploy never 404s.
 */
function hashbox_ad_webp_uri( $file, $width ) {
    $stem = pathinfo( (string) $file, PATHINFO_FILENAME );
    $rel  = 'webp/' . $stem . '-' . (int) $width . 'w.webp';
    if ( file_exists( hashbox_audit_landing_asset_path( $rel ) ) ) {
        return hashbox_audit_landing_asset_uri( $rel );
    }
    return hashbox_audit_landing_asset_uri( $file );
}

/**
 * "small 640w, large 1200w"-style srcset for an ad creative.
 */
function hashbox_ad_webp_srcset( $file, $widths ) {
    $parts = array();
    foreach ( $widths as $width ) {
        $parts[] = hashbox_ad_webp_uri( $file, $width ) . ' ' . (int) $width . 'w';
    }
    return implode( ', ', $parts );
}

function hashbox_audit_landing_og_image_url( $landing = null ) {
    $landing = $landing ?: hashbox_get_audit_landing_for_path();
    return $landing ? hashbox_audit_landing_asset_uri( $landing['og_image'] ) : hashbox_default_og_image_url();
}

function hashbox_audit_landing_canonical_url( $landing = null ) {
    $landing = $landing ?: hashbox_get_audit_landing_for_path();
    return $landing ? home_url( '/' . $landing['slug'] . '/' ) : home_url( '/' );
}

/**
 * Mark virtual audit landing routes as valid before WordPress exits on HEAD.
 */
function hashbox_audit_landing_pre_handle_404( $preempt, $wp_query ) {
    if ( is_admin() || wp_doing_ajax() || ! hashbox_get_audit_landing_for_path() ) {
        return $preempt;
    }

    status_header( 200 );
    $wp_query->is_404      = false;
    $wp_query->is_page     = true;
    $wp_query->is_singular = true;

    return true;
}
add_filter( 'pre_handle_404', 'hashbox_audit_landing_pre_handle_404', 10, 2 );

function hashbox_audit_landing_template_fallback( $template ) {
    if ( is_admin() || wp_doing_ajax() ) {
        return $template;
    }

    $landing = hashbox_get_audit_landing_for_path();
    if ( ! $landing ) {
        return $template;
    }

    $audit_template = get_template_directory() . '/page-audit-landing.php';
    if ( ! file_exists( $audit_template ) ) {
        return $template;
    }

    global $wp_query;
    status_header( 200 );
    $wp_query->is_404      = false;
    $wp_query->is_page     = true;
    $wp_query->is_singular = true;

    return $audit_template;
}
add_filter( 'template_include', 'hashbox_audit_landing_template_fallback', 80 );

function hashbox_audit_landing_redirect_canonical( $redirect_url, $requested_url ) {
    $requested_path = trim( (string) wp_parse_url( $requested_url, PHP_URL_PATH ), '/' );
    if ( hashbox_get_audit_landing_for_path( $requested_path ) ) {
        return false;
    }
    return $redirect_url;
}
add_filter( 'redirect_canonical', 'hashbox_audit_landing_redirect_canonical', 9, 2 );

function hashbox_audit_landing_body_class( $classes ) {
    $landing = hashbox_get_audit_landing_for_path();
    if ( $landing ) {
        $classes[] = 'hb-audit-landing';
        $classes[] = 'hb-audit-landing--' . sanitize_html_class( $landing['creative_key'] );
    }
    return $classes;
}
add_filter( 'body_class', 'hashbox_audit_landing_body_class' );

function hashbox_ads_preview_template_fallback( $template ) {
    if ( is_admin() || wp_doing_ajax() || ! hashbox_is_ads_preview_request() ) {
        return $template;
    }

    $preview_template = get_template_directory() . '/page-ads-preview.php';
    if ( ! file_exists( $preview_template ) ) {
        return $template;
    }

    global $wp_query;
    status_header( 200 );
    $wp_query->is_404      = false;
    $wp_query->is_page     = true;
    $wp_query->is_singular = true;

    return $preview_template;
}
add_filter( 'template_include', 'hashbox_ads_preview_template_fallback', 81 );

function hashbox_ads_preview_redirect_canonical( $redirect_url, $requested_url ) {
    $requested_path = trim( (string) wp_parse_url( $requested_url, PHP_URL_PATH ), '/' );
    if ( hashbox_is_ads_preview_request( $requested_path ) ) {
        return false;
    }
    return $redirect_url;
}
add_filter( 'redirect_canonical', 'hashbox_ads_preview_redirect_canonical', 9, 2 );

function hashbox_ads_preview_body_class( $classes ) {
    if ( hashbox_is_ads_preview_request() ) {
        $classes[] = 'hb-audit-landing';
        $classes[] = 'hb-ads-preview-page';
    }
    return $classes;
}
add_filter( 'body_class', 'hashbox_ads_preview_body_class' );

function hashbox_ads_preview_robots_meta() {
    if ( hashbox_is_ads_preview_request() ) {
        echo '<meta name="robots" content="noindex,nofollow">' . "\n";
    }
}
add_action( 'wp_head', 'hashbox_ads_preview_robots_meta', 1 );

function hashbox_case_study_slug_from_path( $path = null ) {
    $path = null === $path ? hashbox_current_request_path() : trim( (string) $path, '/' );
    if ( ! preg_match( '#^(?:work|services)/([^/]+)/?$#', $path, $matches ) ) {
        return '';
    }

    $slug = sanitize_title( $matches[1] );
    return hashbox_is_case_study_slug( $slug ) ? $slug : '';
}

function hashbox_is_case_study_page( $post_id ) {
    $post = get_post( $post_id );
    if ( ! $post || 'page' !== $post->post_type || ! hashbox_is_case_study_slug( $post->post_name ) ) {
        return false;
    }

    $template = (string) get_page_template_slug( $post_id );
    return 0 === strpos( $template, 'page-work-' );
}

function hashbox_current_case_study_slug() {
    $slug = hashbox_case_study_slug_from_path();
    if ( $slug ) {
        return $slug;
    }

    if ( ! is_page() ) {
        return '';
    }

    $post = get_queried_object();
    if ( $post instanceof WP_Post && hashbox_is_case_study_page( $post->ID ) ) {
        return $post->post_name;
    }

    return '';
}

function hashbox_route_work_case_studies( $query_vars ) {
    if ( empty( $query_vars['pagename'] ) ) {
        return $query_vars;
    }

    $path = trim( (string) $query_vars['pagename'], '/' );
    if ( 0 !== strpos( $path, 'work/' ) ) {
        return $query_vars;
    }

    $slug = hashbox_case_study_slug_from_path( $path );
    if ( ! $slug || get_page_by_path( $path, OBJECT, 'page' ) ) {
        return $query_vars;
    }

    $legacy_page = get_page_by_path( 'services/' . $slug, OBJECT, 'page' );
    if ( $legacy_page ) {
        $query_vars['pagename'] = 'services/' . $slug;
    }

    return $query_vars;
}
add_filter( 'request', 'hashbox_route_work_case_studies' );

function hashbox_parse_work_case_studies( $wp ) {
    $path = hashbox_current_request_path();
    if ( 0 !== strpos( $path, 'work/' ) ) {
        return;
    }

    $slug = hashbox_case_study_slug_from_path( $path );
    if ( ! $slug ) {
        return;
    }

    $legacy_page = get_page_by_path( 'services/' . $slug, OBJECT, 'page' );
    if ( ! $legacy_page ) {
        return;
    }

    $wp->query_vars['page_id']  = $legacy_page->ID;
    $wp->query_vars['pagename'] = 'services/' . $slug;
    unset( $wp->query_vars['error'], $wp->query_vars['name'], $wp->query_vars['attachment'] );
}
add_action( 'parse_request', 'hashbox_parse_work_case_studies', 1 );

function hashbox_work_case_study_template_fallback( $template ) {
    if ( ! is_404() ) {
        return $template;
    }

    $path = hashbox_current_request_path();
    if ( 0 !== strpos( $path, 'work/' ) ) {
        return $template;
    }

    $slug = hashbox_case_study_slug_from_path( $path );
    if ( ! $slug ) {
        return $template;
    }

    $case_template = get_template_directory() . '/page-work-' . $slug . '.php';
    if ( ! file_exists( $case_template ) ) {
        return $template;
    }

    global $wp_query;
    status_header( 200 );
    $wp_query->is_404      = false;
    $wp_query->is_page     = true;
    $wp_query->is_singular = true;

    return $case_template;
}
add_filter( 'template_include', 'hashbox_work_case_study_template_fallback', 99 );

function hashbox_redirect_legacy_services_case_studies() {
    if ( is_admin() || wp_doing_ajax() || is_preview() ) {
        return;
    }

    $path = hashbox_current_request_path();
    if ( 0 !== strpos( $path, 'services/' ) ) {
        return;
    }

    $slug = hashbox_case_study_slug_from_path( $path );
    if ( ! $slug ) {
        return;
    }

    wp_safe_redirect( hashbox_case_study_canonical_url( $slug ), 301 );
    exit;
}
add_action( 'template_redirect', 'hashbox_redirect_legacy_services_case_studies', 1 );

/**
 * Keep previously published AI guide URLs working after their slug changes.
 */
function hashbox_redirect_legacy_ai_guides() {
    if ( is_admin() || wp_doing_ajax() || is_preview() ) {
        return;
    }

    $redirects = array(
        'line-chatbot-ai-thailand' => '/line-chatbot-ai-guide-2026/',
        'ai-workforce-thai-sme'    => '/ai-workforce-sme-thailand-2026/',
    );
    $path      = hashbox_current_request_path();

    if ( ! isset( $redirects[ $path ] ) ) {
        return;
    }

    wp_safe_redirect( home_url( $redirects[ $path ] ), 301 );
    exit;
}
add_action( 'template_redirect', 'hashbox_redirect_legacy_ai_guides', 2 );

/**
 * Digital Marketing + CRO was folded into the SEO service (2026-08-28).
 * 301 the old page to the CRO section of /services/seo/ and keep it out of
 * the sitemap even if the WP Page is still published.
 */
function hashbox_redirect_legacy_digital_marketing() {
    if ( is_admin() || wp_doing_ajax() || is_preview() ) {
        return;
    }
    $path = hashbox_current_request_path();
    if ( 'services/digital-marketing-tools' !== $path && 0 !== strpos( $path, 'services/digital-marketing-tools/' ) ) {
        return;
    }
    wp_safe_redirect( home_url( '/services/seo/#cro' ), 301 );
    exit;
}
add_action( 'template_redirect', 'hashbox_redirect_legacy_digital_marketing', 2 );

function hashbox_rankmath_sitemap_exclude_legacy( $url, $type, $object ) {
    if ( 'post' === $type && isset( $object->post_name ) && 'digital-marketing-tools' === $object->post_name ) {
        return false;
    }
    return $url;
}
add_filter( 'rank_math/sitemap/entry', 'hashbox_rankmath_sitemap_exclude_legacy', 10, 3 );

/**
 * The audit landings (/seo-audit/, /seo-recovery-audit/, …) are virtual
 * routes, not WP Pages, so Rank Math never lists them. Add a small
 * `landing-sitemap.xml` to the index for every landing that is public.
 */
function hashbox_landing_sitemap_entries() {
    if ( ! function_exists( 'hashbox_audit_landing_pages' ) ) {
        return array();
    }
    $entries = array();
    $lastmod = gmdate( 'c', (int) filemtime( get_template_directory() . '/page-audit-landing.php' ) );
    $skip    = array( 'ads-preview' );
    foreach ( hashbox_audit_landing_pages() as $slug => $landing ) {
        if ( empty( $slug ) || in_array( $slug, $skip, true ) || ! empty( $landing['noindex'] ) ) {
            continue;
        }
        $entries[] = array( 'loc' => home_url( '/' . $slug . '/' ), 'lastmod' => $lastmod );
    }
    return $entries;
}

function hashbox_rankmath_sitemap_index_landing( $xml ) {
    $entries = hashbox_landing_sitemap_entries();
    if ( empty( $entries ) ) {
        return $xml;
    }
    $xml .= '<sitemap><loc>' . esc_url( home_url( '/landing-sitemap.xml' ) ) . '</loc><lastmod>' . esc_html( $entries[0]['lastmod'] ) . '</lastmod></sitemap>';
    return $xml;
}
add_filter( 'rank_math/sitemap/index', 'hashbox_rankmath_sitemap_index_landing' );

function hashbox_rankmath_sitemap_landing_content() {
    $out = '';
    foreach ( hashbox_landing_sitemap_entries() as $e ) {
        $out .= '<url><loc>' . esc_url( $e['loc'] ) . '</loc><lastmod>' . esc_html( $e['lastmod'] ) . '</lastmod></url>';
    }
    return $out;
}
add_filter( 'rank_math/sitemap/landing_content', 'hashbox_rankmath_sitemap_landing_content' );

function hashbox_case_study_redirect_canonical( $redirect_url, $requested_url ) {
    $requested_path = trim( (string) wp_parse_url( $requested_url, PHP_URL_PATH ), '/' );
    $slug           = hashbox_case_study_slug_from_path( $requested_path );
    if ( ! $slug ) {
        return $redirect_url;
    }

    if ( 0 === strpos( $requested_path, 'work/' ) ) {
        $redirect_path = trim( (string) wp_parse_url( $redirect_url, PHP_URL_PATH ), '/' );
        if ( 'services/' . $slug === $redirect_path ) {
            return false;
        }
    }

    if ( 0 === strpos( $requested_path, 'services/' ) ) {
        return hashbox_case_study_canonical_url( $slug );
    }

    return $redirect_url;
}
add_filter( 'redirect_canonical', 'hashbox_case_study_redirect_canonical', 10, 2 );

function hashbox_case_study_page_link( $link, $post_id, $sample ) {
    if ( hashbox_is_case_study_page( $post_id ) ) {
        $post = get_post( $post_id );
        return hashbox_case_study_canonical_url( $post->post_name );
    }
    return $link;
}
add_filter( 'page_link', 'hashbox_case_study_page_link', 10, 3 );

function hashbox_migrate_case_study_parent_pages() {
    $migration_key = '20260522_work_parent_v1';
    if ( $migration_key === get_option( 'hashbox_case_study_parent_migration' ) ) {
        return;
    }

    $work_page = get_page_by_path( 'work', OBJECT, 'page' );
    if ( ! $work_page ) {
        return;
    }

    $updated = false;
    foreach ( hashbox_case_study_slugs() as $slug ) {
        $page = get_page_by_path( 'work/' . $slug, OBJECT, 'page' );
        if ( ! $page ) {
            $page = get_page_by_path( 'services/' . $slug, OBJECT, 'page' );
        }
        if ( ! $page ) {
            $page = get_page_by_path( $slug, OBJECT, 'page' );
        }
        if ( ! $page || (int) $page->post_parent === (int) $work_page->ID ) {
            continue;
        }

        $result = wp_update_post( array(
            'ID'          => $page->ID,
            'post_parent' => $work_page->ID,
        ), true );

        if ( ! is_wp_error( $result ) ) {
            $updated = true;
        }
    }

    if ( $updated ) {
        flush_rewrite_rules( false );
    }
    update_option( 'hashbox_case_study_parent_migration', $migration_key, false );
}
add_action( 'init', 'hashbox_migrate_case_study_parent_pages', 30 );

/**
 * Security headers as a WordPress fallback when Apache/Nginx headers are not
 * applied by the host or Cloudflare origin configuration.
 */
function hashbox_send_security_headers() {
    if ( headers_sent() ) {
        return;
    }

    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: DENY' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
    if ( is_ssl() ) {
        header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
    }
}
add_action( 'send_headers', 'hashbox_send_security_headers' );

function hashbox_schema_entity_has_type( $entity, $needle_types ) {
    if ( ! is_array( $entity ) || empty( $entity['@type'] ) ) {
        return false;
    }

    $entity_types = is_array( $entity['@type'] ) ? $entity['@type'] : array( $entity['@type'] );
    $entity_types = array_map( 'strtolower', array_map( 'strval', $entity_types ) );
    foreach ( (array) $needle_types as $needle_type ) {
        if ( in_array( strtolower( (string) $needle_type ), $entity_types, true ) ) {
            return true;
        }
    }
    return false;
}

/**
 * แพ็กภาพคำแบรนด์ — ทำไมต้องมี (วัดจริง 2026-08-25 จากระบบติดตามอันดับของเราเอง)
 *
 * Google Images ของคำค้น "hashbox" เป็นของคนอื่นทั้งหมด: us.hashbox.monster 45% ·
 * amazon.de 23% · play.google.com 17% — เราถือ 0% ทั้งที่ติดอันดับ 1 organic
 * เดิม Organization schema ประกาศ logo เป็น URL เปล่าและไม่มี image เลย Google จึงไม่มี
 * ภาพที่ผูกกับ entity ของเราให้หยิบ ตอนนี้ logo/image เป็น ImageObject พร้อม caption
 * ที่มีคำว่า Hashbox ทุกภาพ (ที่มา: hashbox-seo-stack docs/NEXT.md ข้อ 7 · v_media_owners)
 */
function hashbox_brand_image_object( $url, $width, $height, $caption ) {
    return array(
        '@type'      => 'ImageObject',
        'url'        => $url,
        'contentUrl' => $url,
        'width'      => (int) $width,
        'height'     => (int) $height,
        'caption'    => $caption,
        'name'       => $caption,
    );
}

function hashbox_brand_logo_object() {
    // Google's logo guidance prefers a near-square image; use the real
    // 512x512 mark when shipped and fall back to the OG banner otherwise.
    // Shared by the Rank Math path and the no-Rank-Math fallback graph.
    $logo_path = get_template_directory() . '/assets/favicons/icon-512.png';
    if ( file_exists( $logo_path ) ) {
        $size = @getimagesize( $logo_path );
        $w    = ( $size && isset( $size[0] ) ) ? (int) $size[0] : 512;
        $h    = ( $size && isset( $size[1] ) ) ? (int) $size[1] : 512;
        return hashbox_brand_image_object( hashbox_logo_image_url(), $w, $h, 'โลโก้ Hashbox Studio' );
    }
    list( $w, $h ) = hashbox_default_og_image_dimensions();
    return hashbox_brand_image_object( hashbox_default_og_image_url(), $w, $h, 'โลโก้ Hashbox Studio' );
}

function hashbox_brand_images() {
    list( $w, $h ) = hashbox_default_og_image_dimensions();
    $images = array(
        hashbox_brand_image_object(
            hashbox_default_og_image_url(), $w, $h,
            'Hashbox Studio — รับทำเว็บไซต์ SEO-Ready และที่ปรึกษา AI สำหรับธุรกิจไทย'
        ),
    );
    // ครีเอทีฟชุดเดียวกับที่หน้าแรกแสดงอยู่แล้ว (alt มีคำว่า Hashbox) — ไม่เพิ่มไฟล์ใหม่
    foreach ( array(
        array( 'linkedin_wide_seo_ready_v4.png',   1200, 1200, 627,  'Hashbox SEO-Ready Website — บริการรับทำเว็บไซต์ของ Hashbox Studio' ),
        array( 'meta_square_ai_workforce_v4.png',  1080, 1080, 1080, 'Hashbox AI Workforce Audit — บริการที่ปรึกษา AI ของ Hashbox Studio' ),
    ) as $ad ) {
        $images[] = hashbox_brand_image_object( hashbox_ad_webp_uri( $ad[0], $ad[1] ), $ad[2], $ad[3], $ad[4] );
    }
    return $images;
}

/**
 * Every public profile of the same entity. Add new directory/social URLs
 * here only once they resolve — a dead sameAs hurts entity consolidation.
 */
function hashbox_organization_same_as() {
    return array(
        'https://www.linkedin.com/company/hashbox-studio',
        'https://www.facebook.com/profile.php?id=61590390615650',
        'https://www.instagram.com/hashbox.studio/',
        'https://github.com/tumthaweewat',
        'https://lin.ee/Xagx6i4',
        'https://clutch.co/profile/hashbox-studio',
        'https://www.f6s.com/hashbox-studio',
        // Google Business Profile (Maps place, KG /g/11z8h8p_m7) — 2026-08-29
        'https://www.google.com/maps?cid=18343802282355714646',
    );
}

function hashbox_rankmath_schema_organization() {
    $home = home_url( '/' );
    return array(
        '@type' => 'Organization',
        '@id'   => $home . '#organization',
        'name'  => 'Hashbox Studio',
        'alternateName' => array( 'Hashbox', 'แฮชบ็อกซ์ สตูดิโอ', 'Hashbox Studio Bangkok' ),
        'legalName' => 'Hashbox Studio',
        'url'   => $home,
        'logo'  => hashbox_brand_logo_object(),
        'image' => hashbox_brand_images(),
        'foundingDate' => '2024',
        'foundingLocation' => array( '@type' => 'Place', 'name' => 'Bangkok, Thailand' ),
        'founder' => array(
            '@type'  => 'Person',
            'name'   => 'Thaweewat (Tum)',
            'url'    => home_url( '/about/' ),
            'sameAs' => array( 'https://www.linkedin.com/in/tumthaweewat/', 'https://github.com/tumthaweewat' ),
        ),
        'slogan' => 'เว็บไซต์ SEO-Ready และระบบ AI ที่ใช้งานจริงใน production',
        'sameAs' => hashbox_organization_same_as(),
        'contactPoint' => array(
            '@type'             => 'ContactPoint',
            'telephone'         => '+66-62-516-9868',
            'email'             => 'business@hashbox.co.th',
            'contactType'       => 'sales',
            'areaServed'        => 'TH',
            'availableLanguage' => array( 'th', 'en' ),
        ),
        'address' => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '139 Pan Rd, Si Lom',
            'addressLocality' => 'Bang Rak',
            'addressRegion'   => 'Bangkok',
            'postalCode'      => '10500',
            'addressCountry'  => 'TH',
        ),
        'knowsAbout' => array(
            'SEO',
            'Technical SEO',
            'Core Web Vitals',
            'Schema.org',
            'Generative Engine Optimization',
            'Next.js',
            'WordPress',
            'AI Consulting',
            'LINE Chatbot',
            'Retrieval-Augmented Generation',
            'n8n Workflow Automation',
            'Local SEO',
            'CRO',
        ),
        'potentialAction' => array(
            array(
                '@type'  => 'ContactAction',
                'name'   => 'Request Free SEO Audit',
                'target' => $home . '#contact',
            ),
            array(
                '@type'  => 'ViewAction',
                'name'   => 'View Services',
                'target' => $home . 'services/',
            ),
        ),
    );
}

function hashbox_rankmath_schema_website() {
    $home = home_url( '/' );
    return array(
        '@type'      => 'WebSite',
        '@id'        => $home . '#website',
        'url'        => $home,
        'name'       => 'Hashbox Studio',
        // Site node, not page node: the same @id is emitted on every URL
        // including /en/, so this must not vary per request. The site is Thai.
        'inLanguage' => 'th-TH',
        'publisher'  => array( '@id' => $home . '#organization' ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => array(
                '@type'       => 'EntryPoint',
                'urlTemplate' => $home . '?s={search_term_string}',
            ),
            'query-input' => 'required name=search_term_string',
        ),
    );
}

function hashbox_rankmath_schema_service() {
    $home = home_url( '/' );
    return array(
        '@type'              => array( 'ProfessionalService', 'LocalBusiness' ),
        '@id'                => $home . '#service',
        'name'               => 'Hashbox Studio',
        'description'        => 'SEO-ready website development, technical-first SEO, AI Search (GEO) optimisation, AI consulting and n8n workflow automation for Thai businesses.',
        'sameAs'             => hashbox_organization_same_as(),
        'url'                => $home,
        'image'              => hashbox_brand_logo_object(),
        'telephone'          => '+66-62-516-9868',
        'email'              => 'business@hashbox.co.th',
        'priceRange'         => '฿฿฿',
        'areaServed'         => 'Thailand',
        'parentOrganization' => array( '@id' => $home . '#organization' ),
        'address' => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '139 Pan Rd, Si Lom',
            'addressLocality' => 'Bang Rak',
            'addressRegion'   => 'Bangkok',
            'postalCode'      => '10500',
            'addressCountry'  => 'TH',
        ),
        'geo' => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => 13.7263,
            'longitude' => 100.5270,
        ),
        'hasMap'             => 'https://www.google.com/maps?cid=18343802282355714646',
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
            'opens'     => '09:00',
            'closes'    => '18:00',
        ),
        'hasOfferCatalog' => hashbox_service_offer_catalog(),
    );
}

function hashbox_rankmath_json_ld( $data, $jsonld = null ) {
    if ( ! is_array( $data ) ) {
        return $data;
    }

    $home        = home_url( '/' );
    $current_url = hashbox_current_public_url();
    $description = hashbox_get_meta_description();
    $has_org       = false;
    $has_website   = false;
    $has_service   = false;
    $is_case_study = (bool) hashbox_current_case_study_slug();

    foreach ( $data as $key => $entity ) {
        if ( ! is_array( $entity ) ) {
            continue;
        }

        // Case-study pages emit their own Article + BreadcrumbList (see
        // hashbox_render_case_study), so drop Rank Math's BreadcrumbList to
        // avoid two BreadcrumbList graphs describing the same page.
        if ( hashbox_schema_entity_has_type( $entity, 'BreadcrumbList' ) ) {
            $GLOBALS['hashbox_rm_has_breadcrumb'] = true;
        }

        if ( $is_case_study && hashbox_schema_entity_has_type( $entity, 'BreadcrumbList' ) ) {
            unset( $data[ $key ] );
            continue;
        }

        if ( ! is_singular( 'post' ) && hashbox_schema_entity_has_type( $entity, array( 'Article', 'BlogPosting', 'NewsArticle' ) ) ) {
            unset( $data[ $key ] );
            continue;
        }

        if ( hashbox_schema_entity_has_type( $entity, 'Organization' ) ) {
            $data[ $key ] = array_merge( $entity, hashbox_rankmath_schema_organization() );
            $has_org      = true;
            continue;
        }

        if ( hashbox_schema_entity_has_type( $entity, 'WebSite' ) ) {
            $data[ $key ] = array_merge( $entity, hashbox_rankmath_schema_website() );
            $has_website  = true;
            continue;
        }

        if ( hashbox_schema_entity_has_type( $entity, 'ProfessionalService' ) || hashbox_schema_entity_has_type( $entity, 'LocalBusiness' ) ) {
            $data[ $key ] = array_merge( $entity, hashbox_rankmath_schema_service() );
            $has_service  = true;
            continue;
        }

        if ( hashbox_schema_entity_has_type( $entity, array( 'WebPage', 'CollectionPage', 'SearchResultsPage' ) ) ) {
            $data[ $key ]['url']         = $current_url;
            $data[ $key ]['inLanguage']  = hashbox_page_in_language();
            $data[ $key ]['description'] = $description;
            $data[ $key ]['isPartOf']    = array( '@id' => $home . '#website' );
            $data[ $key ]['publisher']   = array( '@id' => $home . '#organization' );
        }

        // KNOWN GAP, verified on production 2026-08-17: this branch does not
        // reach Rank Math's own #richSnippet Article node. Live posts render
        // WebPage inLanguage th-TH (set above) but BlogPosting inLanguage
        // en-US — the WP locale — on the same page, so something adds that
        // node after this filter has run. Pre-existing, not caused by the
        // helper below; do not assume this line controls the Article node
        // until you have re-checked the live JSON-LD.
        if ( is_singular( 'post' ) && hashbox_schema_entity_has_type( $entity, array( 'Article', 'BlogPosting', 'NewsArticle' ) ) ) {
            $data[ $key ]['inLanguage'] = hashbox_page_in_language();
            $data[ $key ]['publisher']  = array( '@id' => $home . '#organization' );
        }
    }

    if ( ! $has_org ) {
        $data['HashboxOrganization'] = hashbox_rankmath_schema_organization();
    }
    if ( ! $has_website ) {
        $data['HashboxWebSite'] = hashbox_rankmath_schema_website();
    }
    if ( ! $has_service ) {
        $data['HashboxProfessionalService'] = hashbox_rankmath_schema_service();
    }

    return $data;
}
add_filter( 'rank_math/json_ld', 'hashbox_rankmath_json_ld', 99, 2 );

function hashbox_rankmath_canonical( $canonical ) {
    $case_slug = hashbox_current_case_study_slug();
    if ( $case_slug ) {
        return hashbox_case_study_canonical_url( $case_slug );
    }
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing ) {
        return hashbox_audit_landing_canonical_url( $audit_landing );
    }
    if ( function_exists( 'hashbox_is_ads_preview_request' ) && hashbox_is_ads_preview_request() ) {
        return home_url( '/ads-preview/' );
    }
    return $canonical;
}
add_filter( 'rank_math/frontend/canonical', 'hashbox_rankmath_canonical' );

function hashbox_rankmath_og_type( $type ) {
    return is_singular( 'post' ) ? 'article' : 'website';
}
add_filter( 'rank_math/opengraph/type', 'hashbox_rankmath_og_type' );

function hashbox_rankmath_og_url( $url ) {
    return hashbox_current_public_url();
}
add_filter( 'rank_math/opengraph/url', 'hashbox_rankmath_og_url' );

function hashbox_rankmath_og_image( $image ) {
    $audit_landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( $audit_landing ) {
        return hashbox_audit_landing_og_image_url( $audit_landing );
    }
    if ( ! empty( $image ) ) {
        return $image;
    }
    return is_singular() ? hashbox_og_image_url( get_queried_object_id() ) : hashbox_default_og_image_url();
}
add_filter( 'rank_math/opengraph/facebook/image', 'hashbox_rankmath_og_image' );
add_filter( 'rank_math/opengraph/twitter/image', 'hashbox_rankmath_og_image' );

function hashbox_rankmath_og_locale( $locale ) {
    return hashbox_page_og_locale();
}
add_filter( 'rank_math/opengraph/facebook/og_locale', 'hashbox_rankmath_og_locale' );
add_filter( 'rank_math/opengraph/facebook/locale', 'hashbox_rankmath_og_locale' );

function hashbox_rankmath_case_study_sitemap_entry( $url, $type, $object ) {
    if ( in_array( $type, array( 'page', 'post' ), true ) && $object instanceof WP_Post && hashbox_is_case_study_page( $object->ID ) ) {
        $url['loc'] = hashbox_case_study_canonical_url( $object->post_name );
    }
    return $url;
}
add_filter( 'rank_math/sitemap/entry', 'hashbox_rankmath_case_study_sitemap_entry', 10, 3 );

/**
 * Output a JSON-LD <script> tag for structured data.
 *
 * @param array $data Schema graph or single object as associative array.
 */
function hashbox_jsonld( array $data ) {
    $json = wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    if ( false === $json ) {
        return;
    }
    echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}

/**
 * Inject fallback Organization + ProfessionalService + WebSite schema.
 *
 * Tied together via @id refs so AI engines can resolve the entity graph from
 * any landing page when Rank Math is not handling schema output.
 */
function hashbox_inject_home_schema() {
    if ( hashbox_rank_math_is_active() ) {
        return;
    }

    // Single source of truth: the same Organization / ProfessionalService /
    // WebSite builders that feed the Rank Math graph. Keeping one builder
    // per entity means sameAs, logo, offers, etc. can no longer drift between
    // the Rank Math path (production) and this fallback.
    hashbox_jsonld( array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            hashbox_rankmath_schema_organization(),
            hashbox_rankmath_schema_service(),
            hashbox_rankmath_schema_website(),
        ),
    ) );
}
add_action( 'wp_head', 'hashbox_inject_home_schema', 20 );

/**
 * Generate the canonical robots.txt response.
 */
function hashbox_robots_txt( $output, $public ) {
    // Site set to "Discourage search engines" — let core emit its
    // blanket Disallow: / response instead of our custom rules.
    if ( '0' === (string) $public ) {
        return $output;
    }

    $output  = "User-agent: *\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    // GSC (2026-08-29): 26 of 28 "crawled – not indexed" URLs were RSS feeds,
    // the search feed and wp-emoji.js — crawl budget spent on nothing.
    $output .= "Disallow: /feed/\n";
    $output .= "Disallow: /*/feed/\n";
    $output .= "Disallow: /*/feed/rss2/\n";
    $output .= "Disallow: /search/\n";
    $output .= "Disallow: /?s=\n";
    $output .= "Disallow: /wp-includes/js/wp-emoji-release.min.js\n\n";
    // AI search crawlers are welcome — GEO depends on it. Listed explicitly
    // so the policy is unambiguous to each vendor.
    foreach ( array( 'GPTBot', 'OAI-SearchBot', 'ChatGPT-User', 'ClaudeBot', 'Claude-SearchBot', 'anthropic-ai', 'PerplexityBot', 'Perplexity-User', 'Google-Extended', 'Bingbot', 'Applebot-Extended', 'CCBot' ) as $bot ) {
        $output .= "User-agent: {$bot}\n";
        $output .= "Allow: /\n\n";
    }
    $output .= "Sitemap: " . home_url( '/sitemap_index.xml' ) . "\n";
    $output .= "Sitemap: " . home_url( '/landing-sitemap.xml' ) . "\n";
    $output .= "# llms: " . home_url( '/llms.txt' ) . "\n";

    return $output;
}
add_filter( 'robots_txt', 'hashbox_robots_txt', 10, 2 );

/**
 * Serve /llms.txt and /llms-full.txt for AI Search / GEO discovery.
 * Spec: https://llmstxt.org
 *
 * /llms.txt          — concise index of canonical URLs + summaries
 * /llms-full.txt     — concatenated body content of pillar pages
 *
 * Hooked on `init` so WordPress rewrite rules do not interfere.
 */
function hashbox_serve_llms_txt() {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) : '';
    $request_uri = is_string( $request_uri ) ? rtrim( $request_uri, '/' ) : '';

    if ( '/llms.txt' === $request_uri ) {
        header( 'Content-Type: text/plain; charset=utf-8' );
        header( 'X-Robots-Tag: noindex' );
        header( 'Cache-Control: public, max-age=3600' );
        echo hashbox_llms_txt_content();
        exit;
    }

    if ( '/landing-sitemap.xml' === $request_uri && function_exists( 'hashbox_landing_sitemap_entries' ) ) {
        header( 'Content-Type: application/xml; charset=utf-8' );
        header( 'X-Robots-Tag: noindex' );
        header( 'Cache-Control: public, max-age=3600' );
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . hashbox_rankmath_sitemap_landing_content() . '</urlset>';
        exit;
    }

    if ( '/llms-full.txt' === $request_uri ) {
        header( 'Content-Type: text/plain; charset=utf-8' );
        header( 'X-Robots-Tag: noindex' );
        header( 'Cache-Control: public, max-age=3600' );
        echo hashbox_llms_full_txt_content();
        exit;
    }
}
add_action( 'init', 'hashbox_serve_llms_txt', 1 );

function hashbox_llms_txt_content() {
    $home = home_url( '/' );
    $lines = array();
    $lines[] = '# Hashbox Studio';
    $lines[] = '';
    $lines[] = '> Hashbox Studio (แฮชบ็อกซ์ สตูดิโอ) คือสตูดิโอในกรุงเทพฯ ก่อตั้งปี 2024 โดย Tum Thaweewat ให้บริการ รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI สำหรับธุรกิจ, รับทำ SEO สายเทคนิค, รับทำ AI Search (GEO) และ Workflow Automation ด้วย n8n สำหรับธุรกิจไทย ทุกเว็บไซต์ส่งมอบพร้อม Lighthouse 100, Core Web Vitals เขียว, Schema.org ครบ และ optimise สำหรับ AI Search ตั้งแต่วันเปิดตัว';
    $lines[] = '';
    $lines[] = '> Hashbox Studio is a Bangkok-based studio founded in 2024 by Tum Thaweewat. Services: SEO-Ready website development, AI consulting for Thai businesses, technical-first SEO, AI Search (GEO) optimisation and n8n workflow automation. Every website ships with Lighthouse 100, green Core Web Vitals, complete Schema.org markup and AI-search optimisation from launch. Prices are public (THB, excl. VAT).';
    $lines[] = '';
    $lines[] = '## About';
    $lines[] = '';
    $lines[] = '- [About Hashbox Studio](' . home_url( '/about/' ) . '): Team, mission, methodology';
    $lines[] = '- [Work / Case Studies](' . home_url( '/work/' ) . '): Portfolio of SEO + web projects';
    $lines[] = '- [Contact](' . home_url( '/#contact' ) . '): Free SEO audit + project enquiry';
    $lines[] = '';
    $lines[] = '## Services';
    $lines[] = '';
    /*
     * ลงใน llms.txt ก็ต่อเมื่อหน้ามีจริง — ไฟล์นี้อ่านโดย AI crawler โดยเฉพาะ
     * การชี้ไปหน้า 404 แย่กว่าการไม่ลิสต์ — hashbox_service_catalog_live()
     * ซ่อนรายการที่ WP Page ยังไม่ถูกสร้าง
     */
    foreach ( hashbox_service_catalog_live() as $svc ) {
        $price = $svc['price'] ? ' · ' . $svc['price'] : '';
        $lines[] = '- [' . $svc['name'] . '](' . hashbox_service_url( $svc ) . '): ' . $svc['desc'] . $price;
    }
    $lines[] = '';
    $lines[] = '## Pillar Guides';
    $lines[] = '';
    // The guide, not the service page, is what answers "ปรึกษาทำระบบ AI
    // Solution" — it ranks 3rd for it and is the AI Overview citation. It was
    // missing from this list entirely, so llms.txt pointed that phrase at the
    // service page and never named the page that actually owns it.
    $lines[] = '- [ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ](' . home_url( '/ai-solution-consulting-guide-2026/' ) . '): AI consulting budgets, timelines and vendor checklist for Thai businesses';
    $lines[] = '- [Technical SEO คือ? คู่มือ 2026](' . home_url( '/technical-seo-guide/' ) . '): Technical SEO definition, audit checklist, common fixes';
    $lines[] = '- [GEO คืออะไร? Generative Engine Optimization](' . home_url( '/geo-ai-search-optimization-2026/' ) . '): GEO definition + optimization for ChatGPT, Perplexity, Google AI Overviews';
    $lines[] = '- [Next.js vs WordPress 2026](' . home_url( '/nextjs-vs-wordpress-2026/' ) . '): Stack comparison for SEO performance';
    $lines[] = '- [AI Workforce Guide for Thai SMEs](' . home_url( '/ai-workforce-sme-thailand-2026/' ) . '): AI adoption playbook for Thai businesses';
    $lines[] = '- [LINE Chatbot AI Guide 2026](' . home_url( '/line-chatbot-ai-guide-2026/' ) . '): Conversational AI for LINE platform';
    $lines[] = '- [CRO Guide for Thai Websites](' . home_url( '/cro-thai-websites-2026/' ) . '): Conversion rate optimization for Thai market';
    $lines[] = '';
    $lines[] = '## Pricing (THB, excl. VAT)';
    $lines[] = '';
    $lines[] = '- SEO-Ready Landing Page: from 35,900 THB / 2-3 weeks';
    $lines[] = '- SEO-Ready Corporate Site: from 80,000 THB / 4-6 weeks';
    $lines[] = '- SEO-Ready E-commerce: from 350,000 THB / 6-10 weeks';
    $lines[] = '- SEO-Ready Enterprise: from 500,000 THB / 8-14 weeks';
    // One-off build fees above; this one is a monthly retainer, hence the unit.
    $lines[] = '- SEO retainer (technical-first, incl. GEO): from 29,900 THB / month — guarantee: technical pass in 30 days; if impressions do not grow 50% in 90 days we keep working free (max 3 months)';
    if ( $hb_has_n8n_page ) {
        $lines[] = '- n8n automation build (self-hosted, handover included): from 29,000 THB / project';
    }
    $lines[] = '';
    $lines[] = '## Contact';
    $lines[] = '';
    $lines[] = '- Email: business@hashbox.co.th';
    $lines[] = '- Phone: +66-62-516-9868';
    $lines[] = '- Address: 139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500, Thailand';
    $lines[] = '- LINE: https://lin.ee/Xagx6i4';
    $lines[] = '- LinkedIn: https://www.linkedin.com/company/hashbox-studio';
    $lines[] = '- Facebook: https://www.facebook.com/profile.php?id=61590390615650';
    $lines[] = '- Clutch: https://clutch.co/profile/hashbox-studio';
    $lines[] = '- Founder: Tum Thaweewat — https://www.linkedin.com/in/tumthaweewat/';
    $lines[] = '';
    $lines[] = '## Optional';
    $lines[] = '';
    $lines[] = '- [Sitemap XML](' . home_url( '/sitemap_index.xml' ) . ')';
    $lines[] = '- [robots.txt](' . home_url( '/robots.txt' ) . ')';
    $lines[] = '- [llms-full.txt](' . home_url( '/llms-full.txt' ) . '): Full body content of pillar pages';
    $lines[] = '';
    return implode( "\n", $lines );
}

function hashbox_llms_full_txt_content() {
    $out = hashbox_llms_txt_content();
    $out .= "\n\n# Full Content\n\n";

    $pillar_slugs = array(
        'services/website-development',
        'services/ai-consulting',
        'services/seo',
        'services/n8n-automation',
        'ai-solution-consulting-guide-2026',
        'technical-seo-guide',
        'geo-ai-search-optimization-2026',
        'nextjs-vs-wordpress-2026',
    );

    foreach ( $pillar_slugs as $slug ) {
        $page = get_page_by_path( $slug );
        if ( ! $page ) {
            $page = get_page_by_path( $slug, OBJECT, 'post' );
        }
        if ( ! $page ) {
            continue;
        }
        $out .= "\n---\n\n";
        $out .= '# ' . $page->post_title . "\n\n";
        $out .= 'URL: ' . get_permalink( $page ) . "\n\n";
        $content = apply_filters( 'the_content', $page->post_content );
        $content = wp_strip_all_tags( $content );
        $content = preg_replace( '/\n{3,}/', "\n\n", $content );
        $out .= trim( (string) $content ) . "\n";
    }

    return $out;
}

/**
 * Source-of-truth FAQ data. Used both for visible accordion AND FAQPage
 * schema. Defined here (not in faq.php) so it loads before wp_head fires.
 */
if ( ! function_exists( 'hashbox_get_home_faqs' ) ) {
    function hashbox_get_home_faqs() {
        return array(
            array(
                'q' => 'เว็บที่คุณทำพร้อม SEO จริงไหม ใช้เวลานานแค่ไหนถึงเห็นผล?',
                'a' => 'ใช่ครับ ทุกเว็บที่ออกจากทีมเราต้องผ่าน Build Gate ซึ่งบังคับให้ Lighthouse 100, Core Web Vitals เขียว และ Schema Validator ผ่านทุกหน้า ก่อนจะ Deploy ขึ้น Production ลูกค้าส่วนใหญ่จะเริ่มเห็น Impressions เพิ่มภายใน 30-60 วัน และ Ranking ขยับใน 60-90 วัน ทั้งนี้ก็ขึ้นกับ Niche และ Domain Authority เดิมของแต่ละเว็บด้วย',
            ),
            array(
                'q' => 'Tech Stack ที่ใช้คืออะไร?',
                'a' => 'ขึ้นอยู่กับโจทย์ของแต่ละโปรเจกต์ ถ้าต้องการ Performance สูงสุด เราใช้ Next.js เชื่อมกับ Headless CMS แต่ถ้าทีมลูกค้าต้องการแก้เนื้อหาเองคล่อง ๆ เราเลือก WordPress พร้อม Custom Theme ส่วนระบบ Hosting จะวางบน Cloudflare หรือ Vercel ส่วน Analytics ใช้ GA4 ผูกกับ Search Console และ Looker Studio ทุกครั้งครับ',
            ),
            array(
                'q' => 'บริการรับทำ SEO และ AI Search (GEO) ของ Hashbox ทำอะไรบ้าง?',
                'a' => 'รับทำ SEO สายเทคนิค: แก้โครงสร้างเว็บ Core Web Vitals และ Schema ก่อน แล้วต่อยอดด้วย content, Local SEO และ CRO + tracking ให้ traffic กลายเป็น lead ส่วน AI Search (GEO) คือการทำให้แบรนด์ถูกอ้างอิงใน Google AI Overview, ChatGPT, Perplexity และ Gemini — ทั้งสองวัดผลจากระบบ track อันดับและ AI citation ของเราเอง อัปเดตรายวัน เริ่มต้น 29,900 บาทต่อเดือน พร้อมการันตี "ไม่โต ไม่จ่าย" — impressions ไม่โต 50% ใน 90 วัน เราทำต่อฟรี เริ่มจาก SEO Audit ฟรีครับ',
            ),
            array(
                'q' => 'AI Consulting ครอบคลุมอะไรบ้าง?',
                'a' => 'เราเริ่มจากการประเมิน AI ROI ของแต่ละ Use Case ก่อนเสมอ ถ้าผ่านเกณฑ์จึงค่อยออกแบบ Workflow และลงมือ Implement ตัวอย่างงานที่ทีมเราเคยส่งมอบ มีตั้งแต่ LINE Bot ที่ตอบลูกค้า 24/7, Sales GPT ที่เชื่อมกับ CRM ของลูกค้า, RAG Knowledge Base ภายในองค์กร ไปจนถึง Workflow Automation ผ่าน n8n ที่ลดงาน Manual ของทีมได้ 40% ขึ้นไปครับ',
            ),
            array(
                'q' => 'โปรเจกต์ใช้เวลานานเท่าไหร่?',
                'a' => 'Timeline จะแตกต่างกันตามขนาดและ Scope ของโปรเจกต์ Landing Page ปกติใช้เวลา 2-3 สัปดาห์ ส่วน Corporate Site อยู่ที่ 4-6 สัปดาห์ E-commerce ที่ต้องเชื่อม Payment + Stock จะใช้เวลา 6-10 สัปดาห์ และ AI Bot อยู่ที่ 3-5 สัปดาห์ ขึ้นกับจำนวน Integration ที่ต้องเชื่อมต่อกับระบบเดิมของลูกค้าครับ',
            ),
            array(
                'q' => 'ราคาเริ่มต้นเท่าไหร่?',
                'a' => 'Landing Page เริ่มที่ 35,900 บาท Corporate Site เริ่มที่ 80,000 บาท E-commerce เริ่มที่ 350,000 บาท ส่วน AI Consulting Retainer เริ่มที่ 50,000 บาทต่อเดือน ทุกใบเสนอราคาจะออกหลังการประเมิน Scope ฟรี เพื่อให้ลูกค้าเห็นภาพชัดก่อนตัดสินใจครับ',
            ),
            array(
                'q' => 'มี Support หลังส่งมอบไหม?',
                'a' => 'มีครับ ลูกค้าเลือกได้ระหว่างแพ็กเกจ One-time Maintenance สำหรับงานปรับปรุงรายครั้ง Monthly Retainer ที่ดูแล Performance, CRO และ Content ต่อเนื่อง หรือ AI Workforce Retainer ที่ทีมเราดูแล AI Bot และ Optimize ให้ตลอด ทุกแพ็กเกจมี SLA ตอบกลับชัดเจน และมี Dashboard ที่ลูกค้าดูผลได้แบบ Real-time',
            ),
        );
    }
}

/**
 * Inject FAQPage schema on the homepage using the same FAQ source as the
 * visible accordion. Keeps content + schema in sync.
 */
function hashbox_inject_home_faq_schema() {
    if ( ! is_front_page() ) {
        return;
    }
    if ( ! function_exists( 'hashbox_get_home_faqs' ) ) {
        return;
    }

    $faqs = hashbox_get_home_faqs();
    if ( empty( $faqs ) ) {
        return;
    }

    $main_entity = array();
    foreach ( $faqs as $faq ) {
        $main_entity[] = array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }

    hashbox_jsonld( array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        '@id'        => home_url( '/#faq' ),
        'speakable'  => array(
            '@type'       => 'SpeakableSpecification',
            'cssSelector' => array( '.hb-accordion__trigger', '.hb-accordion__content' ),
        ),
        'mainEntity' => $main_entity,
    ) );
}
add_action( 'wp_head', 'hashbox_inject_home_faq_schema', 21 );

/**
 * Contact form submission handler (admin-post.php endpoint).
 */
function hashbox_is_uuid_v4( $value ) {
    return is_string( $value )
        && 1 === preg_match( '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i', $value );
}

/**
 * Validate the non-PII, order-like reference sent to Google as transaction_id.
 */
function hashbox_is_conversion_ref( $value, $scope = '' ) {
    if ( ! is_string( $value ) || strlen( $value ) > 64 ) {
        return false;
    }

    $scope = strtoupper( (string) $scope );
    if ( ! in_array( $scope, array( '', 'AI', 'WEB' ), true ) ) {
        return false;
    }

    $pattern = '' === $scope
        ? '/^HB-(?:AI|WEB)-[0-9]{8}-[0-9]{9,40}$/'
        : '/^HB-' . preg_quote( $scope, '/' ) . '-[0-9]{8}-[0-9]{9,40}$/';

    return 1 === preg_match( $pattern, $value );
}

/**
 * Mint an order-like conversion reference from one global atomic sequence.
 * LAST_INSERT_ID(expr) is connection-scoped, so concurrent requests cannot
 * receive the same numeric value.
 */
function hashbox_generate_conversion_ref( $scope ) {
    global $wpdb;

    $scope = strtoupper( (string) $scope );
    if ( ! in_array( $scope, array( 'AI', 'WEB' ), true ) ) {
        return '';
    }

    $option_name = 'hashbox_conversion_sequence';
    add_option( $option_name, '0', '', false );

    $updated = $wpdb->query(
        $wpdb->prepare(
            "UPDATE {$wpdb->options} SET option_value = LAST_INSERT_ID(CAST(option_value AS UNSIGNED) + 1) WHERE option_name = %s AND option_value REGEXP '^[0-9]{1,15}$'",
            $option_name
        )
    );
    $sequence = 1 === $updated ? (int) $wpdb->get_var( 'SELECT LAST_INSERT_ID()' ) : 0;
    wp_cache_delete( $option_name, 'options' );
    if ( $sequence < 1 ) {
        // Keep collecting genuine enquiries if the counter is unavailable.
        // Server time + a CSPRNG numeric suffix remains order-like, non-PII
        // and collision-resistant without falling back to a UUID/hash value.
        error_log( '[hashbox] Conversion sequence unavailable; using numeric fallback.' );
        try {
            $sequence = random_int( 0, 999999999 );
        } catch ( Exception $exception ) {
            $sequence = wp_rand( 0, 999999999 );
        }
    }

    $now              = microtime( true );
    $timestamp        = wp_date( 'YmdHis', (int) $now );
    $microseconds     = sprintf( '%06d', (int) ( ( $now - floor( $now ) ) * 1000000 ) );
    $conversion_ref   = sprintf(
        'HB-%s-%s-%s%s%09d',
        $scope,
        substr( $timestamp, 0, 8 ),
        substr( $timestamp, 8, 6 ),
        $microseconds,
        $sequence
    );
    return hashbox_is_conversion_ref( $conversion_ref, $scope ) ? $conversion_ref : '';
}

function hashbox_lead_transient_status( $state ) {
    if ( is_string( $state ) ) {
        return sanitize_key( $state );
    }

    return is_array( $state ) && isset( $state['status'] ) && is_string( $state['status'] )
        ? sanitize_key( $state['status'] )
        : '';
}

function hashbox_lead_transient_conversion_ref( $state, $scope ) {
    $conversion_ref = is_array( $state ) && isset( $state['conversion_ref'] ) && is_string( $state['conversion_ref'] )
        ? $state['conversion_ref']
        : '';

    return hashbox_is_conversion_ref( $conversion_ref, $scope ) ? $conversion_ref : '';
}

function hashbox_lead_transient_state( $status, $conversion_ref = '' ) {
    return array(
        'status'         => sanitize_key( $status ),
        'conversion_ref' => is_string( $conversion_ref ) ? $conversion_ref : '',
    );
}

function hashbox_website_audit_lead_transient_key( $lead_ref ) {
    return 'hb_website_lead_' . md5( (string) $lead_ref );
}

function hashbox_website_audit_lead_claim_key( $lead_ref ) {
    return 'hb_website_lead_claim_' . md5( (string) $lead_ref );
}

function hashbox_website_audit_lead_signature( $lead_ref ) {
    return hash_hmac( 'sha256', 'website-audit|' . (string) $lead_ref, wp_salt( 'auth' ) );
}

/**
 * Prepare an unguessable correlation ID and contact nonce before the Website
 * Audit form is submitted. The UUID remains the capability, replay key and
 * Meta event ID; Google receives a separate server-generated conversion ref.
 */
function hashbox_prepare_website_audit_lead() {
    $ip       = isset( $_SERVER['REMOTE_ADDR'] ) ? preg_replace( '/[^0-9a-f:.]/i', '', wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
    $rate_key = 'hb_website_prepare_rl_' . md5( $ip );
    $hits     = (int) get_transient( $rate_key );
    if ( $hits >= 60 ) {
        wp_send_json_error( array( 'message' => 'Too many preparation requests.' ), 429 );
    }
    set_transient( $rate_key, $hits + 1, 30 * MINUTE_IN_SECONDS );

    $lead_ref = wp_generate_uuid4();
    $prepared_stored = set_transient(
        hashbox_website_audit_lead_transient_key( $lead_ref ),
        hashbox_lead_transient_state( 'prepared' ),
        6 * HOUR_IN_SECONDS
    );
    if ( ! $prepared_stored ) {
        error_log( '[hashbox] Could not persist Website lead preparation state.' );
        wp_send_json_error( array( 'message' => 'Unable to prepare the form.' ), 500 );
    }

    wp_send_json_success( array(
        'lead_ref' => $lead_ref,
        'nonce'    => wp_create_nonce( 'hashbox_contact' ),
    ) );
}
add_action( 'wp_ajax_nopriv_hashbox_prepare_website_audit_lead', 'hashbox_prepare_website_audit_lead' );
add_action( 'wp_ajax_hashbox_prepare_website_audit_lead', 'hashbox_prepare_website_audit_lead' );

/**
 * Return the verified Website Audit lead record for a success page.
 */
function hashbox_get_confirmed_website_audit_lead() {
    if ( ! is_page( 'website-audit' ) ) {
        return array();
    }

    $contact  = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
    $lead_ref = isset( $_GET['lead_ref'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_ref'] ) ) : '';
    $lead_sig = isset( $_GET['lead_sig'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_sig'] ) ) : '';

    if ( 'sent' !== $contact || ! hashbox_is_uuid_v4( $lead_ref ) || ! preg_match( '/^[a-f0-9]{64}$/i', $lead_sig ) ) {
        return array();
    }

    $state = get_transient( hashbox_website_audit_lead_transient_key( $lead_ref ) );
    if ( 'sent' !== hashbox_lead_transient_status( $state ) ) {
        return array();
    }

    $expected = hashbox_website_audit_lead_signature( $lead_ref );
    if ( ! hash_equals( $expected, strtolower( $lead_sig ) ) ) {
        return array();
    }

    return array(
        'lead_ref'       => $lead_ref,
        'conversion_ref' => hashbox_lead_transient_conversion_ref( $state, 'WEB' ),
    );
}

function hashbox_get_confirmed_website_audit_lead_ref() {
    $lead = hashbox_get_confirmed_website_audit_lead();
    return isset( $lead['lead_ref'] ) ? $lead['lead_ref'] : '';
}

function hashbox_print_website_audit_confirmation_meta() {
    $lead = hashbox_get_confirmed_website_audit_lead();
    if ( empty( $lead['lead_ref'] ) ) {
        return;
    }

    $conversion_attr = empty( $lead['conversion_ref'] )
        ? ''
        : ' data-conversion-ref="' . esc_attr( $lead['conversion_ref'] ) . '"';
    echo '<meta name="hashbox-confirmed-website-lead" content="' . esc_attr( $lead['lead_ref'] ) . '"' . $conversion_attr . '>' . "\n";
}
add_action( 'wp_head', 'hashbox_print_website_audit_confirmation_meta', 2 );

function hashbox_disable_cache_for_confirmed_website_audit_lead() {
    if ( '' === hashbox_get_confirmed_website_audit_lead_ref() ) {
        return;
    }
    if ( ! defined( 'DONOTCACHEPAGE' ) ) {
        define( 'DONOTCACHEPAGE', true );
    }
    nocache_headers();
}
add_action( 'template_redirect', 'hashbox_disable_cache_for_confirmed_website_audit_lead', 0 );

/**
 * AI Workflow Audit signed-lead helpers — mirror of the Website Audit flow.
 *
 * The AI success redirect used to expose contact=ai_sent&lead_ref=<uuid>
 * without any server-side proof, so a crafted URL could fire the Google Ads
 * conversion in audit-landing.js. These helpers sign the reference with an
 * HMAC and record it in a transient at submit time; the confirmation meta tag
 * below is the only trigger the tracking runtime trusts.
 */
function hashbox_ai_audit_lead_transient_key( $lead_ref ) {
    return 'hb_ai_lead_' . md5( (string) $lead_ref );
}

function hashbox_ai_audit_lead_signature( $lead_ref ) {
    return hash_hmac( 'sha256', 'ai-workflow-audit|' . (string) $lead_ref, wp_salt( 'auth' ) );
}

function hashbox_get_confirmed_ai_audit_lead() {
    $landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    if ( ! is_array( $landing ) || ! isset( $landing['slug'] ) || 'ai-workflow-audit' !== $landing['slug'] ) {
        return array();
    }

    $contact  = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
    $lead_ref = isset( $_GET['lead_ref'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_ref'] ) ) : '';
    $lead_sig = isset( $_GET['lead_sig'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_sig'] ) ) : '';

    if ( 'ai_sent' !== $contact || ! hashbox_is_uuid_v4( $lead_ref ) || ! preg_match( '/^[a-f0-9]{64}$/i', $lead_sig ) ) {
        return array();
    }

    $state = get_transient( hashbox_ai_audit_lead_transient_key( $lead_ref ) );
    if ( 'sent' !== hashbox_lead_transient_status( $state ) ) {
        return array();
    }

    $expected = hashbox_ai_audit_lead_signature( $lead_ref );
    if ( ! hash_equals( $expected, strtolower( $lead_sig ) ) ) {
        return array();
    }

    return array(
        'lead_ref'       => $lead_ref,
        'conversion_ref' => hashbox_lead_transient_conversion_ref( $state, 'AI' ),
    );
}

function hashbox_get_confirmed_ai_audit_lead_ref() {
    $lead = hashbox_get_confirmed_ai_audit_lead();
    return isset( $lead['lead_ref'] ) ? $lead['lead_ref'] : '';
}

function hashbox_print_ai_audit_confirmation_meta() {
    $lead = hashbox_get_confirmed_ai_audit_lead();
    if ( empty( $lead['lead_ref'] ) ) {
        return;
    }

    $conversion_attr = empty( $lead['conversion_ref'] )
        ? ''
        : ' data-conversion-ref="' . esc_attr( $lead['conversion_ref'] ) . '"';
    echo '<meta name="hashbox-confirmed-ai-lead" content="' . esc_attr( $lead['lead_ref'] ) . '"' . $conversion_attr . '>' . "\n";
}
add_action( 'wp_head', 'hashbox_print_ai_audit_confirmation_meta', 2 );

function hashbox_disable_cache_for_confirmed_ai_audit_lead() {
    if ( '' === hashbox_get_confirmed_ai_audit_lead_ref() ) {
        return;
    }
    if ( ! defined( 'DONOTCACHEPAGE' ) ) {
        define( 'DONOTCACHEPAGE', true );
    }
    nocache_headers();
}
add_action( 'template_redirect', 'hashbox_disable_cache_for_confirmed_ai_audit_lead', 0 );

function hashbox_get_audit_landing_for_return_url( $url ) {
    $path      = trim( (string) wp_parse_url( $url, PHP_URL_PATH ), '/' );
    $home_path = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );

    if ( '' !== $home_path ) {
        if ( $path === $home_path ) {
            $path = '';
        } elseif ( 0 === strpos( $path, $home_path . '/' ) ) {
            $path = substr( $path, strlen( $home_path ) + 1 );
        } else {
            return null;
        }
    }

    return function_exists( 'hashbox_get_audit_landing_for_path' )
        ? hashbox_get_audit_landing_for_path( $path )
        : null;
}

/**
 * Send the AI lead acknowledgement outside the conversion-critical redirect.
 */
function hashbox_send_ai_confirmation_email( $email, $name, $lead_ref, $conversion_ref = '' ) {
    $email          = sanitize_email( $email );
    $name           = sanitize_text_field( $name );
    $lead_ref       = sanitize_text_field( $lead_ref );
    $conversion_ref = sanitize_text_field( $conversion_ref );

    if ( ! is_email( $email ) || ! preg_match( '/^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i', $lead_ref ) ) {
        return;
    }

    $confirmation_subject = '[Hashbox] รับโจทย์ AI ของคุณแล้ว';
    $confirmation_body    = implode( "\n", array(
        'สวัสดีคุณ ' . $name . ',',
        '',
        'ทีม Hashbox ได้รับโจทย์ AI Opportunity Screening ของคุณแล้ว และจะติดต่อกลับภายใน 1–3 วันทำการ',
        '',
        'สิ่งที่เตรียมไว้ก่อนคุยจะช่วยให้ประเมินได้เร็วขึ้น:',
        '• Workflow หรือปัญหาปัจจุบันที่อยากลดงานซ้ำ',
        '• แหล่งข้อมูลที่เกี่ยวข้อง เช่น LINE, CRM, Sheet, PDF หรือ Notion',
        '• Baseline ที่มี เช่น จำนวนเคส เวลาตอบ หรือชั่วโมงที่ใช้ต่อสัปดาห์',
        '• Stakeholder ที่ดูแล workflow และระบบเดิม',
        '',
        'ถ้าต้องการส่งข้อมูลเพิ่มเติม คุยกับทีมทาง LINE: https://lin.ee/Xagx6i4',
        '',
        'เลขอ้างอิง: ' . ( hashbox_is_conversion_ref( $conversion_ref, 'AI' ) ? $conversion_ref : $lead_ref ),
        '',
        'Hashbox Studio',
    ) );

    wp_mail(
        $email,
        $confirmation_subject,
        $confirmation_body,
        array(
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: Hashbox Studio <business@hashbox.co.th>',
        )
    );
}
add_action( 'hashbox_send_ai_confirmation_email', 'hashbox_send_ai_confirmation_email', 10, 4 );

function hashbox_handle_contact_submit() {
    if ( ! isset( $_POST['hashbox_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['hashbox_nonce'] ), 'hashbox_contact' ) ) {
        wp_die( 'Invalid request token.', 'Forbidden', array( 'response' => 403 ) );
    }

    $name               = isset( $_POST['name'] )               ? sanitize_text_field( wp_unslash( $_POST['name'] ) )               : '';
    $company            = isset( $_POST['company'] )            ? sanitize_text_field( wp_unslash( $_POST['company'] ) )            : '';
    $email              = isset( $_POST['email'] )              ? sanitize_email( wp_unslash( $_POST['email'] ) )                   : '';
    $phone              = isset( $_POST['phone'] )              ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )              : '';
    $website            = isset( $_POST['website'] )            ? esc_url_raw( wp_unslash( $_POST['website'] ) )                    : '';
    $service            = isset( $_POST['service'] )            ? sanitize_text_field( wp_unslash( $_POST['service'] ) )            : '';
    $project_type       = isset( $_POST['project_type'] )       ? sanitize_text_field( wp_unslash( $_POST['project_type'] ) )       : '';
    $message            = isset( $_POST['message'] )            ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) )        : '';
    $problem            = isset( $_POST['problem'] )            ? sanitize_textarea_field( wp_unslash( $_POST['problem'] ) )        : '';
    $budget             = isset( $_POST['budget'] )             ? sanitize_text_field( wp_unslash( $_POST['budget'] ) )             : '';
    $timeline           = isset( $_POST['timeline'] )           ? sanitize_text_field( wp_unslash( $_POST['timeline'] ) )           : '';
    $contact_preference = isset( $_POST['contact_preference'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_preference'] ) ) : '';
    $contact_detail     = isset( $_POST['contact_detail'] )     ? sanitize_text_field( wp_unslash( $_POST['contact_detail'] ) )     : '';
    $pdpa               = isset( $_POST['pdpa'] );
    $message            = $problem ?: $message;

    $redirect_to = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : home_url( '/#contact' );
    $redirect_to = wp_validate_redirect( $redirect_to, home_url( '/#contact' ) );
    $landing      = hashbox_get_audit_landing_for_return_url( $redirect_to );
    $posted_landing_slug = isset( $_POST['landing_slug'] ) ? sanitize_key( wp_unslash( $_POST['landing_slug'] ) ) : '';
    $redirect_path       = trim( (string) wp_parse_url( $redirect_to, PHP_URL_PATH ), '/' );
    $website_audit_path  = trim( (string) wp_parse_url( home_url( '/website-audit/' ), PHP_URL_PATH ), '/' );
    $is_website_audit_form = 'website-audit' === $posted_landing_slug && $redirect_path === $website_audit_path;
    $landing_slug = is_array( $landing ) && isset( $landing['slug'] )
        ? $landing['slug']
        : ( $is_website_audit_form ? 'website-audit' : '' );
    $is_ai_route  = 'ai-workflow-audit' === $landing_slug;
    $ai_nonce_ok  = isset( $_POST['hashbox_ai_nonce'] )
        && wp_verify_nonce( wp_unslash( $_POST['hashbox_ai_nonce'] ), 'hashbox_ai_contact' );
    $is_ai_form    = $is_ai_route && $ai_nonce_ok;
    $is_audit_form = is_array( $landing );
    $website_project_type_labels = array(
        'landing-page'      => 'Landing Page',
        'corporate-website' => 'Corporate Website',
        'website-redesign'  => 'Website Redesign',
        'needs-assessment'  => 'ยังไม่แน่ใจ ต้องการให้ช่วยประเมิน',
    );
    $website_project_type_label = $is_website_audit_form && isset( $website_project_type_labels[ $project_type ] )
        ? $website_project_type_labels[ $project_type ]
        : '';
    $invalid_website_project_type = $is_website_audit_form && '' === $website_project_type_label;
    $needs_contact_detail = $is_ai_form && in_array( $contact_preference, array( 'LINE', 'โทร' ), true );
    $invalid_ai_contact_preference = $is_ai_form && ! in_array( $contact_preference, array( '', 'LINE', 'โทร' ), true );

    $invalid = ( $is_ai_route && ! $ai_nonce_ok ) || ( $is_ai_form
        ? ( $name === '' || $company === '' || $email === '' || ! is_email( $email ) || $message === '' || $invalid_ai_contact_preference || ( $needs_contact_detail && $contact_detail === '' ) || ! $pdpa )
        : ( $is_website_audit_form
            ? ( $name === '' || $email === '' || ! is_email( $email ) || 'seo-website' !== $service || $invalid_website_project_type || $budget === '' || $timeline === '' || 'phone-or-line' !== $contact_preference || $contact_detail === '' || ! $pdpa )
            : ( $is_audit_form
                ? ( $name === '' || $website === '' || $service === '' || $budget === '' || $timeline === '' || $contact_preference === '' || $contact_detail === '' || $message === '' || ! $pdpa )
                : ( $name === '' || $email === '' || ! is_email( $email ) || ! $pdpa ) ) ) );

    if ( $email !== '' && ! is_email( $email ) ) {
        $invalid = true;
    }

    if ( $invalid ) {
        wp_safe_redirect( add_query_arg( 'contact', 'invalid', $redirect_to ) );
        exit;
    }

    $utm = array();
    foreach ( array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid' ) as $utm_key ) {
        $utm[ $utm_key ] = isset( $_POST[ $utm_key ] ) ? sanitize_text_field( wp_unslash( $_POST[ $utm_key ] ) ) : '';
    }

    $reply_email = is_email( $email ) ? $email : ( is_email( $contact_detail ) ? $contact_detail : '' );
    $to          = 'business@hashbox.co.th';
    $request_type = $is_ai_form
        ? 'AI consultation request'
        : ( $is_website_audit_form ? 'Website project evaluation' : ( $is_audit_form ? 'Audit request' : 'New enquiry' ) );
    $subject      = sprintf( '[Hashbox V2] %s from %s — %s', $request_type, $name, $service ?: 'unspecified' );
    $lead_ref     = $is_ai_form ? wp_generate_uuid4() : '';
    $conversion_ref = $is_ai_form ? hashbox_generate_conversion_ref( 'AI' ) : '';
    $prepared_website_lead = false;
    $prepared_lead_claim_key = '';

    if ( $is_website_audit_form ) {
        $prepared_lead_ref = isset( $_POST['lead_ref'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_ref'] ) ) : '';
        $prepared_lead_key = hashbox_is_uuid_v4( $prepared_lead_ref )
            ? hashbox_website_audit_lead_transient_key( $prepared_lead_ref )
            : '';
        $prepared_lead_state = $prepared_lead_key ? get_transient( $prepared_lead_key ) : false;
        $prepared_lead_claim_key = hashbox_is_uuid_v4( $prepared_lead_ref )
            ? hashbox_website_audit_lead_claim_key( $prepared_lead_ref )
            : '';

        $prepared_lead_status = hashbox_lead_transient_status( $prepared_lead_state );
        if ( 'sent' === $prepared_lead_status ) {
            wp_safe_redirect( add_query_arg( array(
                'contact'  => 'sent',
                'lead_ref' => $prepared_lead_ref,
                'lead_sig' => hashbox_website_audit_lead_signature( $prepared_lead_ref ),
            ), $redirect_to ) );
            exit;
        }

        if ( 'claimed' === $prepared_lead_status ) {
            // Fail closed after the state has been claimed. A process may have
            // sent the email before crashing, so replaying it could duplicate
            // the lead even when the claim lock itself looks stale.
            wp_safe_redirect( add_query_arg( 'contact', 'processing', $redirect_to ) );
            exit;
        }

        if ( 'prepared' !== $prepared_lead_status ) {
            wp_safe_redirect( add_query_arg( 'contact', 'invalid', $redirect_to ) );
            exit;
        }

        $lead_ref = $prepared_lead_ref;
        $conversion_ref = hashbox_lead_transient_conversion_ref( $prepared_lead_state, 'WEB' );
        $claim_acquired = add_option( $prepared_lead_claim_key, time(), '', false );
        if ( ! $claim_acquired ) {
            $claimed_at = (int) get_option( $prepared_lead_claim_key, 0 );
            if ( $claimed_at > 0 && $claimed_at < time() - ( 10 * MINUTE_IN_SECONDS ) ) {
                delete_option( $prepared_lead_claim_key );
                $claim_acquired = add_option( $prepared_lead_claim_key, time(), '', false );
            }
        }
        if ( ! $claim_acquired ) {
            wp_safe_redirect( add_query_arg( 'contact', 'processing', $redirect_to ) );
            exit;
        }

        if ( '' === $conversion_ref ) {
            $conversion_ref = hashbox_generate_conversion_ref( 'WEB' );
        }

        $prepared_website_lead = true;
        // Claim before sending email so the same prepared reference cannot
        // mint another conversion through a replayed form submission.
        $claimed_state_stored = set_transient(
            $prepared_lead_key,
            hashbox_lead_transient_state( 'claimed', $conversion_ref ),
            6 * HOUR_IN_SECONDS
        );
        if ( ! $claimed_state_stored ) {
            error_log( '[hashbox] Could not persist Website lead claim state.' );
            wp_safe_redirect( add_query_arg( 'contact', 'processing', $redirect_to ) );
            exit;
        }
    }

    if ( ( $is_ai_form || $is_website_audit_form ) && '' === $conversion_ref ) {
        error_log( '[hashbox] Could not mint Google conversion reference for ' . ( $is_ai_form ? 'AI' : 'Website' ) . ' lead.' );
    }

    $body_lines = $is_ai_form
        ? array( 'Name: ' . $name, 'Company: ' . $company, 'Lead reference: ' . $lead_ref )
        : ( $is_website_audit_form
            ? array( 'Name: ' . $name, 'Company: ' . $company, 'Lead reference: ' . $lead_ref )
            : array( 'Name / Company: ' . $name ) );
    if ( ( $is_ai_form || $is_website_audit_form ) && '' !== $conversion_ref ) {
        $body_lines[] = 'Conversion reference: ' . $conversion_ref;
    }
    $body_lines   = array_merge( $body_lines, array(
        'Email: ' . $email,
        'Phone: ' . $phone,
        'Website: ' . $website,
        'Service: ' . $service,
        'Project type: ' . $project_type,
        'Budget: ' . $budget,
        'Timeline: ' . $timeline,
        'Preferred contact: ' . $contact_preference,
        'Contact detail: ' . $contact_detail,
        'Landing page: ' . $landing_slug,
        '',
        'Problem / Message:',
        $message,
        '',
        'UTM:',
        'utm_source: ' . $utm['utm_source'],
        'utm_medium: ' . $utm['utm_medium'],
        'utm_campaign: ' . $utm['utm_campaign'],
        'utm_content: ' . $utm['utm_content'],
        'utm_term: ' . $utm['utm_term'],
        'gclid: ' . $utm['gclid'],
        'wbraid: ' . $utm['wbraid'],
        'gbraid: ' . $utm['gbraid'],
    ) );
    $body        = implode( "\n", $body_lines );
    $headers     = array( 'Content-Type: text/plain; charset=UTF-8' );
    if ( $reply_email ) {
        $headers[] = sprintf( 'Reply-To: %s <%s>', $name, $reply_email );
    }

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent && is_email( $email ) ) {
        $hubspot_attribution = array_merge( $utm, array(
            'service'                      => $website_project_type_label,
            'lead_ref'                     => $lead_ref,
            'conversion_ref'               => $conversion_ref,
            'landing_slug'                 => $landing_slug,
            '_hashbox_hubspot_sync_attempt' => 1,
        ) );

        // HubSpot's collected-forms runtime drops hidden inputs, so campaign
        // attribution and server-minted lead references are written through
        // the CRM API two minutes later (gives the collected-forms contact time
        // to land first).
        $hubspot_sync_args = array( $email, $hubspot_attribution );
        $hubspot_schedule  = wp_schedule_single_event(
            time() + 2 * MINUTE_IN_SECONDS,
            'hashbox_sync_lead_attribution_to_hubspot',
            $hubspot_sync_args,
            true
        );

        if ( true !== $hubspot_schedule ) {
            if ( wp_next_scheduled( 'hashbox_sync_lead_attribution_to_hubspot', $hubspot_sync_args ) ) {
                hashbox_log_hubspot_sync_event( 'already_scheduled', 'initial_schedule', $hubspot_schedule, 1 );
            } else {
                hashbox_log_hubspot_sync_event( 'schedule_failed', 'initial_schedule', $hubspot_schedule, 1 );
            }
        }
    }

    if ( $sent && $is_ai_form ) {
        $ai_state_stored = set_transient(
            hashbox_ai_audit_lead_transient_key( $lead_ref ),
            hashbox_lead_transient_state( 'sent', $conversion_ref ),
            6 * HOUR_IN_SECONDS
        );
        if ( ! $ai_state_stored ) {
            error_log( '[hashbox] Could not persist AI lead sent state; conversion tracking will fail closed.' );
        }
        $confirmation_queued = wp_schedule_single_event(
            time(),
            'hashbox_send_ai_confirmation_email',
            array( $email, $name, $lead_ref, $conversion_ref )
        );
        wp_safe_redirect( add_query_arg( array(
            'contact'      => 'ai_sent',
            'lead_ref'     => $lead_ref,
            'lead_sig'     => hashbox_ai_audit_lead_signature( $lead_ref ),
            'confirmation' => $confirmation_queued ? 'queued' : 'unavailable',
        ), $redirect_to ) );
        exit;
    }

    if ( $sent && $is_website_audit_form ) {
        if ( $prepared_website_lead ) {
            $website_state_stored = set_transient(
                hashbox_website_audit_lead_transient_key( $lead_ref ),
                hashbox_lead_transient_state( 'sent', $conversion_ref ),
                6 * HOUR_IN_SECONDS
            );
            if ( $website_state_stored ) {
                delete_option( $prepared_lead_claim_key );
            } else {
                error_log( '[hashbox] Could not persist Website lead sent state; claim retained to prevent replay.' );
            }
        }
        wp_safe_redirect( add_query_arg( array(
            'contact'  => 'sent',
            'lead_ref' => $lead_ref,
            'lead_sig' => hashbox_website_audit_lead_signature( $lead_ref ),
        ), $redirect_to ) );
        exit;
    }

    if ( ! $sent && $prepared_website_lead ) {
        $failed_state_stored = set_transient(
            hashbox_website_audit_lead_transient_key( $lead_ref ),
            hashbox_lead_transient_state( 'failed', $conversion_ref ),
            10 * MINUTE_IN_SECONDS
        );
        if ( $failed_state_stored ) {
            delete_option( $prepared_lead_claim_key );
        } else {
            error_log( '[hashbox] Could not persist Website lead failure state; claim retained.' );
        }
    }

    wp_safe_redirect( add_query_arg( 'contact', $sent ? 'sent' : 'error', $redirect_to ) );
    exit;
}
add_action( 'admin_post_nopriv_hashbox_contact', 'hashbox_handle_contact_submit' );
add_action( 'admin_post_hashbox_contact',        'hashbox_handle_contact_submit' );

/**
 * Server-side HubSpot attribution sync.
 *
 * HubSpot's collected-forms runtime captures the visible fields of the audit
 * forms but ignores hidden inputs, so UTM/click IDs and server references do
 * not reliably reach the contact record. This scheduled handler writes them
 * through the CRM API using a private-app token.
 *
 * The established UTM fields and hs_google_click_id are always eligible for
 * sync. Extended attribution is disabled by default because it requires five
 * additional HubSpot contact properties. After those properties exist, opt in
 * with `define( 'HASHBOX_HUBSPOT_EXTENDED_ATTRIBUTION', true );`.
 *
 * Expected extended-property internal names: hashbox_wbraid, hashbox_gbraid,
 * hashbox_lead_ref, hashbox_conversion_ref and hashbox_landing_slug. When the
 * feature is enabled, missing custom properties are logged and skipped
 * independently after the established UTM/GCLID write.
 *
 * Configure the token by defining HASHBOX_HUBSPOT_TOKEN in wp-config.php
 * (preferred) or storing the hashbox_hubspot_token option; when no token is
 * configured the sync is skipped silently.
 */
function hashbox_get_hubspot_private_app_token() {
    if ( defined( 'HASHBOX_HUBSPOT_TOKEN' ) && HASHBOX_HUBSPOT_TOKEN ) {
        return trim( (string) HASHBOX_HUBSPOT_TOKEN );
    }

    $token = get_option( 'hashbox_hubspot_token', '' );
    return is_string( $token ) ? trim( $token ) : '';
}

/**
 * Extended custom-property writes require an explicit boolean opt-in.
 *
 * Keeping this false when the constant is undefined (or set to a non-boolean
 * value) prevents unnecessary HubSpot PATCH requests on portals without the
 * five custom contact properties.
 */
function hashbox_hubspot_extended_attribution_enabled() {
    return defined( 'HASHBOX_HUBSPOT_EXTENDED_ATTRIBUTION' )
        && true === HASHBOX_HUBSPOT_EXTENDED_ATTRIBUTION;
}

/**
 * The initial run plus at most three delayed retries.
 */
function hashbox_hubspot_sync_max_attempts() {
    return 4;
}

function hashbox_hubspot_sync_attempt( $attribution ) {
    $attempt = isset( $attribution['_hashbox_hubspot_sync_attempt'] )
        ? (int) $attribution['_hashbox_hubspot_sync_attempt']
        : 1;

    return max( 1, min( hashbox_hubspot_sync_max_attempts(), $attempt ) );
}

function hashbox_hubspot_response_status_code( $response ) {
    return is_wp_error( $response ) || ! is_array( $response )
        ? 0
        : (int) wp_remote_retrieve_response_code( $response );
}

function hashbox_hubspot_response_is_success( $response ) {
    $status_code = hashbox_hubspot_response_status_code( $response );
    return ! is_wp_error( $response ) && $status_code >= 200 && $status_code < 300;
}

function hashbox_hubspot_response_is_transient( $response, $context = '' ) {
    if ( is_wp_error( $response ) ) {
        return true;
    }

    $status_code = hashbox_hubspot_response_status_code( $response );
    return 0 === $status_code
        || in_array( $status_code, array( 423, 429, 477 ), true )
        || ( $status_code >= 500 && $status_code < 600 )
        || ( 'contact_create' === $context && 409 === $status_code );
}

function hashbox_hubspot_response_is_schema_failure( $response ) {
    if ( is_wp_error( $response ) ) {
        return false;
    }

    return in_array( hashbox_hubspot_response_status_code( $response ), array( 400, 422 ), true );
}

function hashbox_hubspot_response_correlation_id( $response ) {
    if ( is_wp_error( $response ) || ! is_array( $response ) ) {
        return '';
    }

    foreach ( array( 'x-hubspot-correlation-id', 'x-hubspot-request-id', 'x-request-id', 'correlation-id' ) as $header_name ) {
        $header_value = wp_remote_retrieve_header( $response, $header_name );
        if ( is_array( $header_value ) ) {
            $header_value = reset( $header_value );
        }

        $header_value = sanitize_text_field( (string) $header_value );
        if ( '' !== $header_value ) {
            return mb_substr( $header_value, 0, 100 );
        }
    }

    return '';
}

/**
 * Log operational metadata only. Never include request/response bodies, email,
 * attribution values or transport error messages because they may contain PII.
 */
function hashbox_log_hubspot_sync_event( $outcome, $context, $response, $attempt, $property = '', $delay = 0 ) {
    $status_code    = hashbox_hubspot_response_status_code( $response );
    $correlation_id = hashbox_hubspot_response_correlation_id( $response );
    $parts          = array(
        '[hashbox] HubSpot sync',
        'outcome=' . sanitize_key( $outcome ),
        'context=' . sanitize_key( $context ),
        'attempt=' . max( 1, (int) $attempt ),
        'status=' . $status_code,
    );

    if ( is_wp_error( $response ) ) {
        $error_code = sanitize_key( (string) $response->get_error_code() );
        if ( '' !== $error_code ) {
            $parts[] = 'error_code=' . $error_code;
        }
    }

    if ( '' !== $correlation_id ) {
        $parts[] = 'correlation_id=' . $correlation_id;
    }

    if ( '' !== $property ) {
        $parts[] = 'property=' . sanitize_key( $property );
    }

    if ( $delay > 0 ) {
        $parts[] = 'retry_after=' . (int) $delay;
    }

    error_log( implode( ' ', $parts ) . '.' );
}

/**
 * Respect HubSpot Retry-After when present, with a bounded exponential fallback.
 */
function hashbox_hubspot_retry_delay( $response, $attempt ) {
    $attempt        = max( 1, (int) $attempt );
    $fallback_delay = (int) min( 3600, 60 * pow( 2, $attempt - 1 ) );
    $retry_delay    = null;

    if ( ! is_wp_error( $response ) ) {
        $retry_after = wp_remote_retrieve_header( $response, 'retry-after' );
        if ( is_array( $retry_after ) ) {
            $retry_after = reset( $retry_after );
        }
        $retry_after = trim( (string) $retry_after );
        if ( '' !== $retry_after ) {
            if ( is_numeric( $retry_after ) ) {
                $retry_delay = (int) ceil( (float) $retry_after );
            } else {
                $retry_at = strtotime( $retry_after );
                if ( false !== $retry_at ) {
                    $retry_delay = max( 0, $retry_at - time() );
                }
            }
        }
    }

    if ( null === $retry_delay ) {
        $retry_delay = $fallback_delay;
    }

    return max( 60, min( 3600, (int) $retry_delay ) );
}

/**
 * Requeue the same two-argument cron payload without allowing an infinite loop.
 */
function hashbox_requeue_hubspot_attribution_sync( $email, $attribution, $attempt, $response, $context, $property = '' ) {
    $max_attempts = hashbox_hubspot_sync_max_attempts();
    if ( $attempt >= $max_attempts ) {
        hashbox_log_hubspot_sync_event( 'retry_exhausted', $context, $response, $attempt, $property );
        return false;
    }

    $delay = hashbox_hubspot_retry_delay( $response, $attempt );
    $retry_attribution = $attribution;
    $retry_attribution['_hashbox_hubspot_sync_attempt'] = $attempt + 1;
    $args = array( $email, $retry_attribution );
    $scheduled = wp_schedule_single_event(
        time() + $delay,
        'hashbox_sync_lead_attribution_to_hubspot',
        $args
    );

    if ( false === $scheduled || is_wp_error( $scheduled ) ) {
        if ( false === $scheduled && wp_next_scheduled( 'hashbox_sync_lead_attribution_to_hubspot', $args ) ) {
            hashbox_log_hubspot_sync_event( 'retry_already_scheduled', $context, $response, $attempt + 1, $property, $delay );
            return true;
        }

        hashbox_log_hubspot_sync_event( 'retry_schedule_failed', $context, $response, $attempt + 1, $property, $delay );
        return false;
    }

    hashbox_log_hubspot_sync_event( 'retry_scheduled', $context, $response, $attempt + 1, $property, $delay );
    return true;
}

/**
 * Build a HubSpot property payload from trusted attribution keys.
 *
 * Older cron events contain only the UTM array, so every additional key stays
 * optional. Server references are validated again at execution time because a
 * scheduled event may outlive the request that created it.
 */
function hashbox_prepare_hubspot_contact_properties( $attribution, $property_map ) {
    $properties = array();

    foreach ( $property_map as $attribution_key => $hubspot_property ) {
        if ( ! isset( $attribution[ $attribution_key ] ) || ! is_string( $attribution[ $attribution_key ] ) ) {
            continue;
        }

        $property_value = sanitize_text_field( $attribution[ $attribution_key ] );
        if ( '' === $property_value ) {
            continue;
        }

        if ( 'lead_ref' === $attribution_key && ! hashbox_is_uuid_v4( $property_value ) ) {
            continue;
        }

        if (
            'conversion_ref' === $attribution_key
            && ! hashbox_is_conversion_ref( $property_value, 'AI' )
            && ! hashbox_is_conversion_ref( $property_value, 'WEB' )
        ) {
            continue;
        }

        if ( 'landing_slug' === $attribution_key ) {
            $property_value = sanitize_key( $property_value );
            if ( '' === $property_value ) {
                continue;
            }
        }

        $properties[ $hubspot_property ] = mb_substr( $property_value, 0, 250 );
    }

    return $properties;
}

function hashbox_patch_hubspot_contact_properties( $contact_id, $properties, $headers ) {
    return wp_remote_request(
        'https://api.hubapi.com/crm/v3/objects/contacts/' . rawurlencode( $contact_id ),
        array(
            'method'  => 'PATCH',
            'headers' => $headers,
            'timeout' => 8,
            'body'    => wp_json_encode( array( 'properties' => $properties ) ),
        )
    );
}

/**
 * Sync isolated non-core properties independently from the established UTM map.
 *
 * A HubSpot PATCH fails atomically when one property does not exist. Batch the
 * happy path, then isolate fields only after a non-transient schema response so
 * the known UTM/GCLID write stays intact. The existing `service` property is
 * always eligible; extended Hashbox properties remain behind their feature flag.
 */
function hashbox_sync_optional_hubspot_contact_properties( $contact_id, $properties, $headers, $email, $attribution, $attempt ) {
    if ( empty( $properties ) ) {
        return true;
    }

    // Happy path: one atomic PATCH for every available optional field.
    $batch_response = hashbox_patch_hubspot_contact_properties( $contact_id, $properties, $headers );
    if ( hashbox_hubspot_response_is_success( $batch_response ) ) {
        return true;
    }

    if ( hashbox_hubspot_response_is_transient( $batch_response, 'optional_batch' ) ) {
        hashbox_requeue_hubspot_attribution_sync( $email, $attribution, $attempt, $batch_response, 'optional_batch' );
        return false;
    }

    if ( ! hashbox_hubspot_response_is_schema_failure( $batch_response ) ) {
        hashbox_log_hubspot_sync_event( 'failed', 'optional_batch', $batch_response, $attempt );
        return false;
    }

    // A one-field batch is already the narrowest schema test available.
    if ( 1 === count( $properties ) ) {
        $property = (string) key( $properties );
        hashbox_log_hubspot_sync_event( 'optional_unavailable', 'optional_property', $batch_response, $attempt, $property );
        return true;
    }

    hashbox_log_hubspot_sync_event( 'schema_fallback', 'optional_batch', $batch_response, $attempt );

    // A schema-level 400/422 may name one missing custom property. Retry each
    // independently so valid fields survive, but stop immediately on a
    // transient error to avoid hammering HubSpot.
    foreach ( $properties as $hubspot_property => $property_value ) {
        $response = hashbox_patch_hubspot_contact_properties(
            $contact_id,
            array( $hubspot_property => $property_value ),
            $headers
        );

        if ( hashbox_hubspot_response_is_success( $response ) ) {
            continue;
        }

        if ( hashbox_hubspot_response_is_transient( $response, 'optional_property' ) ) {
            hashbox_requeue_hubspot_attribution_sync(
                $email,
                $attribution,
                $attempt,
                $response,
                'optional_property',
                $hubspot_property
            );
            return false;
        }

        if ( hashbox_hubspot_response_is_schema_failure( $response ) ) {
            hashbox_log_hubspot_sync_event( 'optional_unavailable', 'optional_property', $response, $attempt, $hubspot_property );
            continue;
        }

        hashbox_log_hubspot_sync_event( 'failed', 'optional_property', $response, $attempt, $hubspot_property );
        return false;
    }

    return true;
}

function hashbox_sync_lead_attribution_to_hubspot( $email, $attribution ) {
    $token = hashbox_get_hubspot_private_app_token();
    if ( '' === $token || ! is_email( $email ) || ! is_array( $attribution ) ) {
        return;
    }

    $attempt = hashbox_hubspot_sync_attempt( $attribution );

    $core_property_map = array(
        'utm_source'   => 'utm_source',
        'utm_medium'   => 'utm_medium',
        'utm_campaign' => 'utm_campaign',
        'utm_content'  => 'utm_content',
        'utm_term'     => 'utm_term',
        'gclid'        => 'hs_google_click_id',
    );
    $core_properties = hashbox_prepare_hubspot_contact_properties( $attribution, $core_property_map );
    $optional_property_map = array(
        'service' => 'service',
    );

    // Custom fields are deliberately isolated and strictly opt-in so a portal
    // at its property quota makes no extended-property API requests.
    if ( hashbox_hubspot_extended_attribution_enabled() ) {
        $optional_property_map = array_merge( $optional_property_map, array(
            'wbraid'         => 'hashbox_wbraid',
            'gbraid'         => 'hashbox_gbraid',
            'lead_ref'       => 'hashbox_lead_ref',
            'conversion_ref' => 'hashbox_conversion_ref',
            'landing_slug'   => 'hashbox_landing_slug',
        ) );
    }

    $optional_properties = hashbox_prepare_hubspot_contact_properties( $attribution, $optional_property_map );

    if ( empty( $core_properties ) && empty( $optional_properties ) ) {
        return;
    }

    $headers = array(
        'Authorization' => 'Bearer ' . $token,
        'Content-Type'  => 'application/json',
    );

    $search = wp_remote_post(
        'https://api.hubapi.com/crm/v3/objects/contacts/search',
        array(
            'headers' => $headers,
            'timeout' => 8,
            'body'    => wp_json_encode( array(
                'filterGroups' => array(
                    array(
                        'filters' => array(
                            array(
                                'propertyName' => 'email',
                                'operator'     => 'EQ',
                                'value'        => $email,
                            ),
                        ),
                    ),
                ),
                'limit'      => 1,
                'properties' => array( 'email' ),
            ) ),
        )
    );

    if ( ! hashbox_hubspot_response_is_success( $search ) ) {
        if ( hashbox_hubspot_response_is_transient( $search, 'contact_search' ) ) {
            hashbox_requeue_hubspot_attribution_sync( $email, $attribution, $attempt, $search, 'contact_search' );
        } else {
            hashbox_log_hubspot_sync_event( 'failed', 'contact_search', $search, $attempt );
        }
        return;
    }

    $search_body = json_decode( (string) wp_remote_retrieve_body( $search ), true );
    $contact_id  = isset( $search_body['results'][0]['id'] ) ? (string) $search_body['results'][0]['id'] : '';
    $response         = null;
    $response_context = '';

    if ( '' !== $contact_id ) {
        if ( ! empty( $core_properties ) ) {
            $response         = hashbox_patch_hubspot_contact_properties( $contact_id, $core_properties, $headers );
            $response_context = 'core_patch';
        }
    } else {
        $create_properties          = $core_properties;
        $create_properties['email'] = $email;
        $response                   = wp_remote_post(
            'https://api.hubapi.com/crm/v3/objects/contacts',
            array(
                'headers' => $headers,
                'timeout' => 8,
                'body'    => wp_json_encode( array( 'properties' => $create_properties ) ),
            )
        );
        $response_context = 'contact_create';
    }

    if ( null !== $response ) {
        if ( ! hashbox_hubspot_response_is_success( $response ) ) {
            if ( hashbox_hubspot_response_is_transient( $response, $response_context ) ) {
                hashbox_requeue_hubspot_attribution_sync(
                    $email,
                    $attribution,
                    $attempt,
                    $response,
                    $response_context
                );
            } else {
                hashbox_log_hubspot_sync_event( 'failed', $response_context, $response, $attempt );
            }
            return;
        }

        if ( '' === $contact_id ) {
            $response_body = json_decode( (string) wp_remote_retrieve_body( $response ), true );
            $contact_id    = isset( $response_body['id'] ) ? (string) $response_body['id'] : '';
        }
    }

    if ( '' === $contact_id ) {
        hashbox_requeue_hubspot_attribution_sync( $email, $attribution, $attempt, $response, 'contact_id_missing' );
        return;
    }

    if ( ! empty( $optional_properties ) ) {
        hashbox_sync_optional_hubspot_contact_properties(
            $contact_id,
            $optional_properties,
            $headers,
            $email,
            $attribution,
            $attempt
        );
    }
}
add_action( 'hashbox_sync_lead_attribution_to_hubspot', 'hashbox_sync_lead_attribution_to_hubspot', 10, 2 );

/**
 * V2 case-study renderer. Each /work/<slug>/ page template builds a $case
 * array and calls this helper. Outputs V2 design-system markup (hb-* classes).
 */
function hashbox_render_case_study( array $case ) {
    $page_url = get_permalink();
    $work_url = home_url( '/work/' . $case['slug'] . '/' );
    ?>

    <article class="hb-case-page">

        <nav class="hb-container hb-breadcrumb" aria-label="Breadcrumb">
            <ol class="hb-breadcrumb__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li aria-current="page"><?php echo esc_html( $case['name'] ); ?></li>
            </ol>
        </nav>

        <header class="hb-section" style="padding-top: var(--hb-space-12);">
            <div class="hb-container hb-container--md">
                <span class="hb-eyebrow"><?php echo esc_html( $case['tag'] . ' · ' . $case['industry'] . ' · ' . $case['year'] ); ?></span>
                <h1 class="hb-h1" style="margin-top: var(--hb-space-4);"><?php echo esc_html( $case['name'] ); ?> Case Study</h1>
                <p class="hb-lead" style="margin-top: var(--hb-space-4);"><?php echo esc_html( $case['headline'] ); ?></p>
                <p class="hb-body" style="margin-top: var(--hb-space-4); color: var(--hb-text-muted);"><?php echo esc_html( $case['lede'] ); ?></p>
            </div>
        </header>

        <section class="hb-section hb-section--surface" style="padding-block: var(--hb-space-12);">
            <div class="hb-container">
                <span class="hb-eyebrow">Snapshot</span>
                <div class="hb-stats__grid hb-stats__grid--divided" style="margin-top: var(--hb-space-6);">
                    <?php foreach ( $case['snapshot'] as $stat ) : ?>
                        <div class="hb-stat">
                            <span class="hb-stat__value"><?php echo esc_html( $stat['value'] ); ?></span>
                            <p class="hb-stat__label"><?php echo esc_html( $stat['label'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="hb-caption" style="margin-top: var(--hb-space-5);">
                    Industry: <?php echo esc_html( $case['industry'] ); ?> · Project duration: <?php echo esc_html( $case['timeline'] ); ?>
                </p>
            </div>
        </section>

        <?php if ( ! empty( $case['proof'] ) ) : ?>
        <section class="hb-section" id="proof" style="padding-block: var(--hb-space-10);">
            <div class="hb-container hb-container--md">
                <span class="hb-eyebrow">ตัวเลขที่ยืนยันได้</span>
                <h2 class="hb-h2" style="margin-top: var(--hb-space-3);">เกณฑ์เดียวกับที่เราการันตีให้ลูกค้าทุกราย</h2>
                <p class="hb-section__sub">ตัวเลขชุดนี้คือสิ่งที่ลูกค้าอนุญาตให้เปิดเผยและตรวจย้อนได้จาก Search Console / Lighthouse ของโปรเจกต์ — เป็นเกณฑ์เดียวกับ <a href="<?php echo esc_url( home_url( '/services/seo/#guarantee' ) ); ?>">การันตี "ไม่โต ไม่จ่าย"</a> ของเรา</p>
                <div class="hb-stats__grid hb-stats__grid--divided" style="margin-top: var(--hb-space-6);">
                    <?php foreach ( $case['proof'] as $p ) : ?>
                    <div class="hb-stat">
                        <span class="hb-stat__value"><?php echo esc_html( $p['value'] ); ?></span>
                        <p class="hb-stat__label"><?php echo esc_html( $p['label'] ); ?></p>
                        <?php if ( ! empty( $p['note'] ) ) : ?><p class="hb-stat__caption"><?php echo esc_html( $p['note'] ); ?></p><?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="hb-section">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2">โจทย์ที่ลูกค้าเข้ามา</h2>
                <p class="hb-lead" style="margin-top: var(--hb-space-5);"><?php echo esc_html( $case['challenge'] ); ?></p>
            </div>
        </section>

        <section class="hb-section hb-section--surface">
            <div class="hb-container">
                <h2 class="hb-h2" style="margin-bottom: var(--hb-space-8);">วิธีที่เราแก้</h2>
                <ol class="hb-steps">
                    <?php foreach ( $case['approach'] as $step ) : ?>
                        <li class="hb-step">
                            <h3 class="hb-step__title"><?php echo esc_html( $step['h'] ); ?></h3>
                            <p class="hb-step__desc"><?php echo esc_html( $step['p'] ); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>

        <section class="hb-section">
            <div class="hb-container">
                <h2 class="hb-h2" style="margin-bottom: var(--hb-space-8);">ผลลัพธ์</h2>
                <div class="hb-bento">
                    <?php foreach ( $case['results'] as $r ) : ?>
                        <div class="hb-bento__cell">
                            <span class="hb-stat__value hb-stat__value--gradient" style="font-size: var(--hb-text-4xl);"><?php echo esc_html( $r['value'] ); ?></span>
                            <p class="hb-stat__label" style="margin-top: var(--hb-space-3);"><?php echo esc_html( $r['label'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="hb-section hb-section--surface">
            <div class="hb-container">
                <h2 class="hb-h2" style="margin-bottom: var(--hb-space-5);">Tech Stack ที่ใช้</h2>
                <div class="hb-rail">
                    <?php foreach ( $case['stack'] as $tech ) : ?>
                        <span class="hb-badge hb-badge--blue"><?php echo esc_html( $tech ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="hb-section">
            <div class="hb-container">
                <div class="hb-section__head">
                    <span class="hb-eyebrow">Related services</span>
                    <h2 class="hb-h2">ถ้าโจทย์ของคุณใกล้เคียงกับ <?php echo esc_html( $case['name'] ); ?></h2>
                    <p class="hb-section__sub">เลือกบริการที่ตรงกับ pain point หลัก หรือเริ่มจาก audit ฟรีเพื่อให้ทีมเราจัดลำดับ technical SEO, CRO และ AI automation ตามผลกระทบจริง</p>
                </div>
                <div class="hb-bento">
                    <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>" style="text-decoration:none;">
                        <span class="hb-eyebrow">Technical SEO</span>
                        <h3 class="hb-card__title">รับทำเว็บไซต์ SEO-Ready</h3>
                        <p class="hb-card__body">เหมาะกับเว็บที่ต้องการ Core Web Vitals เขียว, schema ครบ, sitemap ถูกต้อง และพร้อม index ตั้งแต่วันเปิดตัว.</p>
                    </a>
                    <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>" style="text-decoration:none;">
                        <span class="hb-eyebrow">SEO + CRO</span>
                        <h3 class="hb-card__title">รับทำ SEO</h3>
                        <p class="hb-card__body">เหมาะกับเว็บที่มีอยู่แล้ว ต้องการ traffic จาก Google และ AI Search เพิ่ม พร้อม CRO + tracking ให้ traffic กลายเป็น lead.</p>
                    </a>
                    <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>" style="text-decoration:none;">
                        <span class="hb-eyebrow">Automation</span>
                        <h3 class="hb-card__title">AI Consulting + AI Workforce</h3>
                        <p class="hb-card__body">เหมาะกับทีมที่ต้องการลดงานซ้ำ ตอบลูกค้าเร็วขึ้น หรือสร้าง RAG/LINE Bot ที่ใช้งานจริงใน production.</p>
                    </a>
                    <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" style="text-decoration:none;">
                        <span class="hb-eyebrow">Free audit</span>
                        <h3 class="hb-card__title">รับ SEO + Performance Audit ฟรี</h3>
                        <p class="hb-card__body">ส่งเว็บไซต์ปัจจุบันให้ทีมเราวัด baseline และแนะนำ roadmap 90 วันก่อนเริ่มโปรเจกต์.</p>
                    </a>
                </div>
            </div>
        </section>

        <?php if ( ! empty( $case['testimonial']['quote'] ) ) : ?>
        <section class="hb-section hb-section--surface">
            <div class="hb-container hb-container--md">
                <div class="hb-quote">
                    <span class="hb-quote__mark">"</span>
                    <p class="hb-quote__body"><?php echo esc_html( $case['testimonial']['quote'] ); ?></p>
                    <div class="hb-quote__attrib">
                        <span class="hb-quote__avatar"><?php echo esc_html( mb_substr( $case['name'], 0, 1 ) ); ?></span>
                        <div>
                            <p class="hb-quote__name"><?php echo esc_html( $case['testimonial']['attribution'] ); ?></p>
                            <p class="hb-quote__role"><?php echo esc_html( $case['name'] ); ?> · <?php echo esc_html( $case['industry'] ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <section class="hb-section">
            <div class="hb-container hb-container--md" style="text-align:center;">
                <h2 class="hb-h2">เคสของคุณคือเคสถัดไป</h2>
                <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ Audit ฟรี · เห็น Friction Point ของเว็บคุณก่อนตัดสินใจ</p>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
            </div>
        </section>

    </article>

    <?php
    // Schemas
    $results_strings = array();
    foreach ( $case['results'] as $r ) {
        $results_strings[] = $r['value'] . ' — ' . $r['label'];
    }
    hashbox_jsonld( array(
        '@context'       => 'https://schema.org',
        '@type'          => 'Article',
        '@id'            => $work_url . '#article',
        'headline'       => $case['name'] . ' — ' . $case['headline'],
        'description'    => $case['lede'],
        'url'            => $work_url,
        'image'          => hashbox_default_og_image_url(),
        'datePublished'  => $case['year'] . '-01-01',
        'dateModified'   => get_post_modified_time( 'c', true, get_queried_object_id() ) ?: ( $case['year'] . '-01-01' ),
        // Case studies are Thai-only copy rendered by this function; there is
        // no /en/ counterpart to follow, so this stays a literal.
        'inLanguage'     => 'th-TH',
        'author'         => array( '@id' => home_url( '/#organization' ) ),
        'publisher'      => array( '@id' => home_url( '/#organization' ) ),
        'about'          => $case['industry'],
        'keywords'       => implode( ', ', $case['stack'] ),
        'articleSection' => 'Case Studies',
        'articleBody'    => $case['challenge'] . ' ' . implode( ' ', array_map( function( $a ) { return $a['h'] . ': ' . $a['p']; }, $case['approach'] ) ) . ' Results: ' . implode( '; ', $results_strings ) . '.',
    ) );

    hashbox_jsonld( array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => array(
            array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
            array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Work', 'item' => home_url( '/work/' ) ),
            array( '@type' => 'ListItem', 'position' => 3, 'name' => $case['name'], 'item' => $work_url ),
        ),
    ) );
}

/* ============================================================
 * BLOG / INSIGHTS — helpers
 * ============================================================ */

/**
 * Reading time in minutes (200 wpm).
 */
function hashbox_reading_time( $post_id = null ) {
    $post = get_post( $post_id );
    if ( ! $post ) {
        return 1;
    }
    $word_count = str_word_count( wp_strip_all_tags( $post->post_content ) );
    return max( 1, (int) ceil( $word_count / 200 ) );
}

/**
 * Add IDs to H2/H3 headings in content and return modified content + TOC array.
 *
 * @param string $content Raw post content.
 * @return array{content:string,toc:array<int,array{level:int,text:string,id:string}>}
 */
function hashbox_process_content_toc( $content ) {
    $toc = array();
    $content = preg_replace_callback(
        '/<(h[23])([^>]*)>(.*?)<\/\1>/i',
        function ( $matches ) use ( &$toc ) {
            $level   = (int) substr( $matches[1], 1 );
            $attrs   = $matches[2];
            $text    = trim( wp_strip_all_tags( $matches[3] ) );
            $slug    = sanitize_title( $text );
            if ( '' === $slug ) {
                return $matches[0];
            }
            $id_attr = 'id="' . esc_attr( $slug ) . '"';
            if ( false === stripos( $attrs, 'id=' ) ) {
                $attrs = ' ' . $id_attr . $attrs;
            }
            $toc[] = array(
                'level' => $level,
                'text'  => $text,
                'id'    => $slug,
            );
            return '<' . $matches[1] . $attrs . '>' . $matches[3] . '</' . $matches[1] . '>';
        },
        $content
    );
    return array( 'content' => $content, 'toc' => $toc );
}

/**
 * Get TOC array for current post (cached per request).
 */
function hashbox_get_toc( $post_id = null ) {
    static $cache = array();
    $post_id = $post_id ?: get_the_ID();
    if ( isset( $cache[ $post_id ] ) ) {
        return $cache[ $post_id ];
    }
    $post = get_post( $post_id );
    if ( ! $post ) {
        return array();
    }
    $processed = hashbox_process_content_toc( apply_filters( 'the_content', $post->post_content ) );
    $cache[ $post_id ] = $processed['toc'];
    return $processed['toc'];
}

/**
 * Filter the_content to inject heading IDs for in-page anchors.
 */
function hashbox_inject_heading_ids( $content ) {
    if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }
    $processed = hashbox_process_content_toc( $content );
    return $processed['content'];
}
add_filter( 'the_content', 'hashbox_inject_heading_ids', 20 );

/*
 * No theme-injected link from the AI Solution guide to the service page
 * (considered and dropped 2026-08-17).
 *
 * The guide's body already links to /services/ai-consulting/ three times, and
 * the first of those uses the exact anchor text a new link would want —
 * "บริการที่ปรึกษา AI สำหรับธุรกิจ". Google attributes one anchor per target
 * URL per page, so a fourth link adds no signal and would put a second copy of
 * the same sentence at the end of the page that ranks 3rd and is cited in the
 * AI Overview. The handoff already exists; leave the guide alone.
 */

/**
 * Related posts — same primary category, exclude current.
 */
function hashbox_related_posts( $post_id = null, $count = 3 ) {
    $post_id = $post_id ?: get_the_ID();
    $cats = wp_get_post_categories( $post_id );
    if ( empty( $cats ) ) {
        return new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => $count,
            'post__not_in'        => array( $post_id ),
            'orderby'             => 'date',
            'order'               => 'DESC',
            'ignore_sticky_posts' => true,
        ) );
    }
    return new WP_Query( array(
        'post_type'           => 'post',
        'posts_per_page'      => $count,
        'post__not_in'        => array( $post_id ),
        'category__in'        => $cats,
        'orderby'             => 'date',
        'order'               => 'DESC',
        'ignore_sticky_posts' => true,
    ) );
}

/**
 * OG image URL with fallback chain: featured → dynamic generated → site default.
 */
function hashbox_og_image_url( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( $post_id && has_post_thumbnail( $post_id ) ) {
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        if ( $src ) {
            return $src[0];
        }
    }
    if ( $post_id && function_exists( 'imagecreatetruecolor' ) ) {
        $generated = hashbox_dynamic_og_image_url( $post_id );
        if ( $generated ) {
            return $generated;
        }
    }
    return hashbox_default_og_image_url();
}

/**
 * Generate (or return cached) dynamic OG image URL for a post.
 * 1200x630 PNG composed via GD. Cache in uploads/og-cache/{id}-{slug}.png.
 * Regenerated when post is updated (cache key includes modified time).
 */
function hashbox_dynamic_og_image_url( $post_id ) {
    if ( ! function_exists( 'imagecreatetruecolor' ) ) {
        return '';
    }
    $post = get_post( $post_id );
    if ( ! $post ) {
        return '';
    }
    $upload = wp_upload_dir();
    if ( empty( $upload['basedir'] ) || ! empty( $upload['error'] ) ) {
        return '';
    }
    $dir = trailingslashit( $upload['basedir'] ) . 'og-cache';
    $url = trailingslashit( $upload['baseurl'] ) . 'og-cache';
    if ( ! is_dir( $dir ) ) {
        wp_mkdir_p( $dir );
    }
    $mtime = strtotime( $post->post_modified_gmt );
    $key   = $post_id . '-' . $mtime;
    $file  = $dir . '/' . $key . '.png';
    if ( file_exists( $file ) ) {
        return $url . '/' . $key . '.png';
    }
    $title  = wp_strip_all_tags( get_the_title( $post_id ) );
    $eyebrow = '';
    if ( 'post' === $post->post_type ) {
        $cats = get_the_category( $post_id );
        $eyebrow = ! empty( $cats ) ? strtoupper( $cats[0]->name ) : 'HASHBOX BLOG';
    } else {
        $eyebrow = 'HASHBOX STUDIO';
    }
    $ok = hashbox_render_og_png( $file, $title, $eyebrow );
    return $ok ? ( $url . '/' . $key . '.png' ) : '';
}

/**
 * Render a 1200x630 OG card to $path. Returns true on success.
 */
function hashbox_render_og_png( $path, $title, $eyebrow ) {
    $w  = 1200;
    $h  = 630;
    $im = imagecreatetruecolor( $w, $h );
    if ( ! $im ) {
        return false;
    }
    $bg     = imagecolorallocate( $im, 9, 9, 11 );
    $panel  = imagecolorallocate( $im, 24, 24, 27 );
    $accent = imagecolorallocate( $im, 37, 99, 235 );
    $cyan   = imagecolorallocate( $im, 6, 182, 212 );
    $text   = imagecolorallocate( $im, 250, 250, 250 );
    $muted  = imagecolorallocate( $im, 161, 161, 170 );
    imagefilledrectangle( $im, 0, 0, $w, $h, $bg );
    imagefilledrectangle( $im, 0, 0, 16, $h, $accent );
    imagefilledrectangle( $im, 16, 0, 28, $h, $cyan );
    imagefilledrectangle( $im, 60, 530, 1140, 540, $panel );
    imagefilledrectangle( $im, 60, 530, 200, 540, $accent );
    $font_dir = get_template_directory() . '/assets/fonts';
    $title_font = $font_dir . '/og-title.ttf';
    $body_font  = $font_dir . '/og-body.ttf';
    if ( file_exists( $title_font ) && function_exists( 'imagettftext' ) ) {
        imagettftext( $im, 22, 0, 60, 100, $muted, $title_font, $eyebrow );
        $wrapped = hashbox_og_wrap_text( $title_font, 60, $title, 1000 );
        $y = 200;
        foreach ( $wrapped as $line ) {
            imagettftext( $im, 60, 0, 60, $y, $text, $title_font, $line );
            $y += 80;
            if ( $y > 460 ) break;
        }
        if ( file_exists( $body_font ) ) {
            imagettftext( $im, 22, 0, 60, 580, $muted, $body_font, 'hashbox.co.th' );
        } else {
            imagestring( $im, 5, 60, 570, 'hashbox.co.th', $muted );
        }
    } else {
        imagestring( $im, 4, 60, 90, $eyebrow, $muted );
        $lines = str_split( $title, 36 );
        $y = 200;
        foreach ( $lines as $line ) {
            imagestring( $im, 5, 60, $y, $line, $text );
            $y += 36;
            if ( $y > 460 ) break;
        }
        imagestring( $im, 5, 60, 570, 'hashbox.co.th', $muted );
    }
    $ok = imagepng( $im, $path );
    imagedestroy( $im );
    return (bool) $ok;
}

function hashbox_og_wrap_text( $font, $size, $text, $max_width ) {
    $words = preg_split( '/\s+/u', $text );
    $lines = array();
    $current = '';
    foreach ( $words as $word ) {
        $try = '' === $current ? $word : ( $current . ' ' . $word );
        $box = imagettfbbox( $size, 0, $font, $try );
        if ( $box ) {
            $width = abs( $box[2] - $box[0] );
            if ( $width > $max_width && '' !== $current ) {
                $lines[] = $current;
                $current = $word;
                continue;
            }
        }
        $current = $try;
    }
    if ( '' !== $current ) {
        $lines[] = $current;
    }
    return array_slice( $lines, 0, 4 );
}

/**
 * Blog excerpt length and read-more replacement.
 */
function hashbox_blog_excerpt_length( $length ) {
    return is_admin() ? $length : 28;
}
add_filter( 'excerpt_length', 'hashbox_blog_excerpt_length', 999 );

function hashbox_blog_excerpt_more( $more ) {
    return is_admin() ? $more : '…';
}
add_filter( 'excerpt_more', 'hashbox_blog_excerpt_more' );

/**
 * Numbered pagination output.
 */
function hashbox_pagination() {
    $links = paginate_links( array(
        'type'      => 'array',
        'mid_size'  => 2,
        'prev_text' => '&larr; Prev',
        'next_text' => 'Next &rarr;',
    ) );
    if ( empty( $links ) ) {
        return;
    }
    echo '<nav class="hb-pagination" aria-label="Pagination"><ul class="hb-pagination__list">';
    foreach ( $links as $link ) {
        echo '<li>' . $link . '</li>';
    }
    echo '</ul></nav>';
}

/**
 * Inject Article + BreadcrumbList JSON-LD on single posts.
 * Lets Rank Math win if active (skip when Rank Math schema present).
 */
function hashbox_inject_post_schema() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    $post_id  = get_the_ID();
    $cats     = get_the_category( $post_id );
    $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Insights';
    $cat_url  = ! empty( $cats ) ? get_category_link( $cats[0]->term_id ) : home_url( '/blog/' );

    // Defer the Article node to Rank Math when active, but Rank Math only
    // emits BreadcrumbList when its breadcrumb module is on (it is not here),
    // so still emit ours unless Rank Math's graph already carried one
    // (flag set in hashbox_rankmath_json_ld, which runs earlier in wp_head).
    if ( hashbox_rank_math_is_active() ) {
        if ( empty( $GLOBALS['hashbox_rm_has_breadcrumb'] ) ) {
            hashbox_jsonld( array(
                '@context'        => 'https://schema.org',
                '@type'           => 'BreadcrumbList',
                '@id'             => get_permalink( $post_id ) . '#breadcrumb',
                'itemListElement' => array(
                    array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
                    array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => home_url( '/blog/' ) ),
                    array( '@type' => 'ListItem', 'position' => 3, 'name' => $cat_name, 'item' => $cat_url ),
                    array( '@type' => 'ListItem', 'position' => 4, 'name' => get_the_title( $post_id ), 'item' => get_permalink( $post_id ) ),
                ),
            ) );
        }
        return;
    }

    hashbox_jsonld( array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        '@id'           => get_permalink( $post_id ) . '#article',
        'headline'      => get_the_title( $post_id ),
        'description'   => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
        'image'         => hashbox_og_image_url( $post_id ),
        'datePublished' => get_the_date( 'c', $post_id ),
        'dateModified'  => get_the_modified_date( 'c', $post_id ),
        'inLanguage'    => hashbox_page_in_language(),
        'author'        => hashbox_author_schema( get_post_field( 'post_author', $post_id ) ),
        'publisher'     => array( '@id' => home_url( '/#organization' ) ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id'   => get_permalink( $post_id ),
        ),
        'articleSection' => $cat_name,
        'wordCount'      => str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) ),
    ) );

    hashbox_jsonld( array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => array(
            array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
            array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => home_url( '/blog/' ) ),
            array( '@type' => 'ListItem', 'position' => 3, 'name' => $cat_name, 'item' => $cat_url ),
            array( '@type' => 'ListItem', 'position' => 4, 'name' => get_the_title( $post_id ), 'item' => get_permalink( $post_id ) ),
        ),
    ) );
}
add_action( 'wp_head', 'hashbox_inject_post_schema', 22 );

/**
 * CollectionPage + BreadcrumbList for category/tag/blog index.
 */
function hashbox_inject_archive_schema() {
    if ( hashbox_rank_math_is_active() ) {
        return;
    }
    if ( ! ( is_home() || is_category() || is_tag() ) ) {
        return;
    }
    if ( is_home() ) {
        $name = 'Blog';
        $url  = home_url( '/blog/' );
    } elseif ( is_category() ) {
        $name = single_cat_title( '', false );
        $url  = get_category_link( get_queried_object_id() );
    } else {
        $name = single_tag_title( '', false );
        $url  = get_tag_link( get_queried_object_id() );
    }

    hashbox_jsonld( array(
        '@context' => 'https://schema.org',
        '@type'    => 'CollectionPage',
        '@id'      => $url . '#collection',
        'name'     => $name,
        'url'      => $url,
        'inLanguage' => hashbox_page_in_language(),
        'isPartOf' => array( '@id' => home_url( '/#website' ) ),
    ) );

    $crumbs = array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => home_url( '/blog/' ) ),
    );
    if ( ! is_home() ) {
        $crumbs[] = array( '@type' => 'ListItem', 'position' => 3, 'name' => $name, 'item' => $url );
    }
    hashbox_jsonld( array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $crumbs,
    ) );
}
add_action( 'wp_head', 'hashbox_inject_archive_schema', 23 );

/**
 * Enqueue blog CSS conditionally.
 *
 * Loads the dedicated /design-system/blog.css layer only on URLs
 * that actually use blog selectors (post index, single posts, all
 * archive flavors, search results). Landing and service pages
 * don't reference any .hb-blog-* / .hb-post-* / .hb-card--standard
 * selectors, so they avoid the ~14KB cost.
 *
 * Depends on the last design-system layer (composed) rather than
 * the legacy hashbox-style handle so blog styles cascade after the
 * design-system but aren't delayed by the deferred legacy sheet.
 */
function hashbox_enqueue_blog_assets() {
    if ( ! ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_archive() || is_search() ) ) {
        return;
    }
    $blog_css = get_template_directory() . '/design-system/blog.css';
    if ( ! file_exists( $blog_css ) ) {
        return;
    }
    wp_enqueue_style(
        'hashbox-blog',
        get_template_directory_uri() . '/design-system/blog.css',
        array( 'hashbox-ds-composed' ),
        filemtime( $blog_css )
    );
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_blog_assets', 20 );

/**
 * Allow "blog" as a reserved page slug pointing to the posts index.
 * No-op if user already configured Settings → Reading.
 */
function hashbox_blog_body_class( $classes ) {
    if ( is_home() ) {
        $classes[] = 'hb-blog-index';
    } elseif ( is_singular( 'post' ) ) {
        $classes[] = 'hb-blog-single';
    } elseif ( is_category() || is_tag() || is_archive() ) {
        $classes[] = 'hb-blog-archive';
    }
    return $classes;
}
add_filter( 'body_class', 'hashbox_blog_body_class' );

/**
 * Web Vitals RUM monitoring — inline tiny script + REST endpoint.
 * Skipped for logged-in admins, headless browsers.
 */
function hashbox_inject_cwv_rum() {
    if ( is_admin() || current_user_can( 'manage_options' ) ) {
        return;
    }
    $endpoint = esc_url_raw( rest_url( 'hashbox/v1/cwv' ) );
    ?>
<script id="hb-cwv-rum">
(function () {
  if (!('PerformanceObserver' in window) || navigator.webdriver) return;
  var data = { lcp: 0, inp: 0, cls: 0, ttfb: 0, url: location.pathname, w: innerWidth };
  try {
    var nav = performance.getEntriesByType('navigation')[0];
    if (nav) data.ttfb = Math.round(nav.responseStart);
  } catch (e) {}
  try {
    new PerformanceObserver(function (l) {
      var entries = l.getEntries();
      var last = entries[entries.length - 1];
      if (last) data.lcp = Math.round(last.startTime);
    }).observe({ type: 'largest-contentful-paint', buffered: true });
  } catch (e) {}
  try {
    var clsValue = 0;
    new PerformanceObserver(function (l) {
      l.getEntries().forEach(function (e) {
        if (!e.hadRecentInput) clsValue += e.value;
      });
      data.cls = Math.round(clsValue * 1000) / 1000;
    }).observe({ type: 'layout-shift', buffered: true });
  } catch (e) {}
  try {
    var maxInp = 0;
    new PerformanceObserver(function (l) {
      l.getEntries().forEach(function (e) {
        if (e.duration > maxInp) maxInp = e.duration;
      });
      data.inp = Math.round(maxInp);
    }).observe({ type: 'event', buffered: true, durationThreshold: 40 });
  } catch (e) {}
  var sent = false;
  function send() {
    if (sent) return;
    sent = true;
    try {
      var blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
      if (navigator.sendBeacon) navigator.sendBeacon('<?php echo esc_js( $endpoint ); ?>', blob);
    } catch (e) {}
  }
  addEventListener('visibilitychange', function () { if (document.visibilityState === 'hidden') send(); });
  addEventListener('pagehide', send);
})();
</script>
    <?php
}
add_action( 'wp_footer', 'hashbox_inject_cwv_rum', 99 );

function hashbox_register_cwv_endpoint() {
    register_rest_route( 'hashbox/v1', '/cwv', array(
        'methods'             => 'POST',
        'callback'            => 'hashbox_receive_cwv',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'hashbox_register_cwv_endpoint' );

function hashbox_receive_cwv( WP_REST_Request $req ) {
    $body = $req->get_json_params();
    if ( ! is_array( $body ) ) {
        return new WP_REST_Response( array( 'ok' => false ), 400 );
    }
    $entry = array(
        't'    => time(),
        'url'  => isset( $body['url'] ) ? substr( wp_strip_all_tags( (string) $body['url'] ), 0, 200 ) : '',
        'lcp'  => isset( $body['lcp'] ) ? (int) $body['lcp'] : 0,
        'inp'  => isset( $body['inp'] ) ? (int) $body['inp'] : 0,
        'cls'  => isset( $body['cls'] ) ? round( (float) $body['cls'], 3 ) : 0,
        'ttfb' => isset( $body['ttfb'] ) ? (int) $body['ttfb'] : 0,
        'w'    => isset( $body['w'] ) ? (int) $body['w'] : 0,
    );
    $log = get_option( 'hashbox_cwv_log', array() );
    if ( ! is_array( $log ) ) {
        $log = array();
    }
    $log[] = $entry;
    if ( count( $log ) > 200 ) {
        $log = array_slice( $log, -200 );
    }
    update_option( 'hashbox_cwv_log', $log, false );
    return new WP_REST_Response( array( 'ok' => true ), 200 );
}

function hashbox_cwv_admin_menu() {
    add_management_page( 'Web Vitals', 'Web Vitals', 'manage_options', 'hashbox-cwv', 'hashbox_cwv_admin_page' );
}
add_action( 'admin_menu', 'hashbox_cwv_admin_menu' );

function hashbox_cwv_admin_page() {
    if ( ! empty( $_POST['hashbox_cwv_clear'] ) && check_admin_referer( 'hashbox_cwv_clear' ) ) {
        delete_option( 'hashbox_cwv_log' );
        echo '<div class="notice notice-success"><p>Cleared.</p></div>';
    }
    $log = get_option( 'hashbox_cwv_log', array() );
    if ( ! is_array( $log ) ) {
        $log = array();
    }
    $count = count( $log );
    $by_url = array();
    foreach ( $log as $e ) {
        $u = $e['url'] ?: '/';
        if ( ! isset( $by_url[ $u ] ) ) {
            $by_url[ $u ] = array( 'lcp' => array(), 'inp' => array(), 'cls' => array(), 'ttfb' => array() );
        }
        foreach ( array( 'lcp', 'inp', 'cls', 'ttfb' ) as $m ) {
            if ( ! empty( $e[ $m ] ) ) {
                $by_url[ $u ][ $m ][] = (float) $e[ $m ];
            }
        }
    }
    $p75 = function ( $a ) {
        if ( empty( $a ) ) return '-';
        sort( $a );
        $idx = (int) floor( count( $a ) * 0.75 );
        return $a[ min( $idx, count( $a ) - 1 ) ];
    };
    echo '<div class="wrap"><h1>Web Vitals RUM</h1>';
    echo '<p>Captured ' . (int) $count . ' real-user sessions. p75 metrics per URL (excludes logged-in admins):</p>';
    echo '<table class="wp-list-table widefat striped"><thead><tr><th>URL</th><th>Samples</th><th>LCP p75 (ms)</th><th>INP p75 (ms)</th><th>CLS p75</th><th>TTFB p75 (ms)</th></tr></thead><tbody>';
    foreach ( $by_url as $u => $m ) {
        $n = count( $m['lcp'] );
        echo '<tr><td>' . esc_html( $u ) . '</td><td>' . (int) $n . '</td><td>' . esc_html( (string) $p75( $m['lcp'] ) ) . '</td><td>' . esc_html( (string) $p75( $m['inp'] ) ) . '</td><td>' . esc_html( (string) $p75( $m['cls'] ) ) . '</td><td>' . esc_html( (string) $p75( $m['ttfb'] ) ) . '</td></tr>';
    }
    echo '</tbody></table>';
    echo '<form method="post" style="margin-top:20px;">';
    wp_nonce_field( 'hashbox_cwv_clear' );
    echo '<button type="submit" name="hashbox_cwv_clear" value="1" class="button">Clear log</button>';
    echo '</form></div>';
}

/* =====================================================================
 * GEO Readiness Checker — free linkable tool
 *
 * A standalone tool page (template page-geo-checker.php) that fetches
 * a user-supplied URL and scores how well it is set up to be CITED by
 * generative engines (ChatGPT, Perplexity, Google AI Overviews) — the
 * studio's specialty. Built as a no-budget linkable asset: useful on
 * its own, captures leads, and earns organic links.
 *
 * Security: the fetch is the sensitive part. We use wp_safe_remote_get
 * (WP blocks private/reserved IP ranges by default), force http/https,
 * cap redirects + body size, short timeout, and rate-limit per IP.
 * Nothing here runs unless a page is created with the template.
 * =================================================================== */

/**
 * Enqueue the checker's JS/CSS only on its template, and hand the
 * front end an ajax url + nonce.
 */
function hashbox_enqueue_geo_checker_assets() {
    if ( ! is_page_template( 'page-geo-checker.php' ) ) {
        return;
    }
    $css = get_template_directory() . '/css/geo-checker.css';
    if ( file_exists( $css ) ) {
        wp_enqueue_style( 'hashbox-geo-checker', get_template_directory_uri() . '/css/geo-checker.css', array( 'hashbox-ds-composed' ), filemtime( $css ) );
    }
    $js = get_template_directory() . '/js/geo-checker.js';
    if ( file_exists( $js ) ) {
        wp_enqueue_script( 'hashbox-geo-checker', get_template_directory_uri() . '/js/geo-checker.js', array(), filemtime( $js ), true );
        wp_localize_script( 'hashbox-geo-checker', 'hbGeo', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'hb_geo_check' ),
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_geo_checker_assets' );

/**
 * Reject URLs that point at private / reserved / loopback hosts so the
 * checker can't be turned into an SSRF probe. wp_safe_remote_get also
 * guards this, but we fail fast with a clear message.
 */
function hashbox_geo_url_is_public( $url ) {
    $parts = wp_parse_url( $url );
    if ( empty( $parts['scheme'] ) || ! in_array( strtolower( $parts['scheme'] ), array( 'http', 'https' ), true ) ) {
        return false;
    }
    if ( empty( $parts['host'] ) ) {
        return false;
    }
    $host = $parts['host'];
    // Block obvious internal hostnames.
    if ( in_array( strtolower( $host ), array( 'localhost', 'localhost.localdomain' ), true ) ) {
        return false;
    }
    // If the host is an IP, ensure it is a public one.
    if ( filter_var( $host, FILTER_VALIDATE_IP ) ) {
        return (bool) filter_var( $host, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE );
    }
    // Resolve the hostname and reject if it maps to a private range.
    $ip = gethostbyname( $host );
    if ( $ip && filter_var( $ip, FILTER_VALIDATE_IP ) ) {
        return (bool) filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE );
    }
    return true; // Unresolvable here; wp_safe_remote_get still guards the actual request.
}

/**
 * Run the heuristic GEO checks against fetched HTML. Returns a list of
 * checks (id, label, pass, weight, hint) plus a 0-100 score.
 */
function hashbox_geo_run_checks( $html, $llms_txt_found ) {
    $checks = array();

    $title = '';
    if ( preg_match( '/<title[^>]*>(.*?)<\/title>/is', $html, $m ) ) {
        $title = trim( wp_strip_all_tags( $m[1] ) );
    }
    $title_len = mb_strlen( $title );

    $has_meta_desc = (bool) preg_match( '/<meta[^>]+name=["\']description["\'][^>]+content=["\'][^"\']{50,}/is', $html );

    $h1_count = preg_match_all( '/<h1[\s>]/i', $html );
    $h2_count = preg_match_all( '/<h2[\s>]/i', $html );

    // JSON-LD blocks.
    $jsonld = '';
    if ( preg_match_all( '/<script[^>]+application\/ld\+json[^>]*>(.*?)<\/script>/is', $html, $mm ) ) {
        $jsonld = implode( ' ', $mm[1] );
    }
    $has_faq      = false !== stripos( $jsonld, 'FAQPage' ) || false !== stripos( $jsonld, '"Question"' );
    $has_article  = (bool) preg_match( '/"@type"\s*:\s*"(Article|BlogPosting|NewsArticle|TechArticle)"/i', $jsonld );
    $has_org      = (bool) preg_match( '/"@type"\s*:\s*"(Organization|LocalBusiness)"/i', $jsonld );
    $has_author   = (bool) preg_match( '/"@type"\s*:\s*"Person"/i', $jsonld ) || (bool) preg_match( '/<meta[^>]+name=["\']author["\']/i', $html );
    $has_breadcrumb = false !== stripos( $jsonld, 'BreadcrumbList' );

    $has_og = (bool) preg_match( '/<meta[^>]+property=["\']og:title["\']/i', $html )
        && preg_match( '/<meta[^>]+property=["\']og:image["\']/i', $html );

    // Structured, citable content signals.
    $list_count = preg_match_all( '/<(ul|ol|table)[\b>]/i', $html );

    // Plain-text body for depth + answer-style heuristic.
    $text  = wp_strip_all_tags( preg_replace( '/<(script|style)[^>]*>.*?<\/\1>/is', ' ', $html ) );
    $words = str_word_count( $text ) + (int) ( mb_strlen( preg_replace( '/[\x00-\x7F]/', '', $text ) ) / 3 ); // rough TH allowance

    // Question-style heading (good for AI Q&A extraction).
    $has_question_heading = (bool) preg_match( '/<h[23][^>]*>[^<]*(\?|คือ|อะไร|how|what|why|วิธี)[^<]*<\/h[23]>/iu', $html );

    $add = function ( &$checks, $id, $label, $pass, $weight, $hint ) {
        $checks[] = array( 'id' => $id, 'label' => $label, 'pass' => (bool) $pass, 'weight' => $weight, 'hint' => $hint );
    };

    $add( $checks, 'title', 'มี <title> ความยาวเหมาะสม (15–65 ตัว)', $title_len >= 15 && $title_len <= 70, 8, 'ตั้ง title ที่ชัดและมี keyword หลัก' );
    $add( $checks, 'meta', 'มี meta description (≥50 ตัว)', $has_meta_desc, 6, 'เขียน meta description สรุปหน้าแบบดึงคลิก' );
    $add( $checks, 'h1', 'มี H1 เดียว', 1 === $h1_count, 8, 'ใช้ H1 หนึ่งอันต่อหน้าเป็นหัวข้อหลัก' );
    $add( $checks, 'h2', 'มีโครงหัวข้อย่อย (H2 ≥ 2)', $h2_count >= 2, 6, 'แบ่งเนื้อหาด้วย H2/H3 ให้ AI ดึงเป็นส่วนๆ ได้' );
    $add( $checks, 'answer', 'มีหัวข้อแบบคำถาม (คือ/อะไร/วิธี/?)', $has_question_heading, 10, 'ตั้งหัวข้อเป็นคำถามที่คนถาม AI แล้วตอบทันทีใต้หัวข้อ' );
    $add( $checks, 'faq', 'มี FAQPage schema', $has_faq, 14, 'เพิ่ม FAQ + FAQPage schema — รูปแบบที่ AI ชอบอ้างมากที่สุด' );
    $add( $checks, 'article', 'มี Article/BlogPosting schema', $has_article, 8, 'ใส่ Article schema ระบุ author + datePublished' );
    $add( $checks, 'org', 'มี Organization schema', $has_org, 8, 'ประกาศตัวตนแบรนด์ด้วย Organization schema + sameAs' );
    $add( $checks, 'author', 'มีสัญญาณ author / E-E-A-T', $has_author, 8, 'ระบุผู้เขียน (Person schema หรือ meta author) เพิ่มความน่าเชื่อถือ' );
    $add( $checks, 'breadcrumb', 'มี BreadcrumbList schema', $has_breadcrumb, 4, 'เพิ่ม breadcrumb ช่วย engine เข้าใจโครงสร้างเว็บ' );
    $add( $checks, 'og', 'มี Open Graph (title + image)', $has_og, 4, 'ใส่ og:title + og:image ให้แชร์/อ้างอิงแล้วแสดงผลดี' );
    $add( $checks, 'lists', 'มี list/table (เนื้อหาแบบ structured)', $list_count >= 1, 6, 'ใช้ bullet/ตาราง — AI ดึงไปตอบง่ายกว่าย่อหน้ายาว' );
    $add( $checks, 'depth', 'เนื้อหามีความลึก (~800+ คำ)', $words >= 800, 6, 'เพิ่มความลึกของเนื้อหาให้ครอบคลุมหัวข้อจริง' );
    $add( $checks, 'llms', 'มีไฟล์ /llms.txt', $llms_txt_found, 4, 'เพิ่ม /llms.txt ชี้ทางให้ AI crawler หาเนื้อหาสำคัญ' );

    $max = 0;
    $got = 0;
    foreach ( $checks as $ch ) {
        $max += $ch['weight'];
        if ( $ch['pass'] ) {
            $got += $ch['weight'];
        }
    }
    $score = $max > 0 ? (int) round( $got / $max * 100 ) : 0;

    return array( 'checks' => $checks, 'score' => $score, 'title' => $title );
}

/**
 * AJAX endpoint for the checker.
 */
function hashbox_geo_check_handler() {
    check_ajax_referer( 'hb_geo_check', 'nonce' );

    $url = isset( $_POST['url'] ) ? esc_url_raw( wp_unslash( $_POST['url'] ) ) : '';
    if ( '' === $url ) {
        wp_send_json_error( array( 'message' => 'กรุณาใส่ URL' ) );
    }
    if ( ! preg_match( '#^https?://#i', $url ) ) {
        $url = 'https://' . ltrim( $url, '/' );
    }
    if ( ! hashbox_geo_url_is_public( $url ) ) {
        wp_send_json_error( array( 'message' => 'URL ไม่ถูกต้องหรือชี้ไปยังที่อยู่ภายใน' ) );
    }

    // Rate limit: 12 checks / 10 min per IP.
    $ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? preg_replace( '/[^0-9a-f:.]/i', '', wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'x';
    $key = 'hb_geo_rl_' . md5( $ip );
    $hits = (int) get_transient( $key );
    if ( $hits >= 12 ) {
        wp_send_json_error( array( 'message' => 'ตรวจบ่อยเกินไป ลองใหม่ในอีกสักครู่' ) );
    }
    set_transient( $key, $hits + 1, 10 * MINUTE_IN_SECONDS );

    $args = array(
        'timeout'     => 10,
        'redirection' => 3,
        'user-agent'  => 'HashboxGEOChecker/1.0 (+https://hashbox.co.th)',
        'headers'     => array( 'Accept' => 'text/html' ),
    );
    $res = wp_safe_remote_get( $url, $args );
    if ( is_wp_error( $res ) ) {
        wp_send_json_error( array( 'message' => 'ดึงหน้าเว็บไม่สำเร็จ: ' . $res->get_error_message() ) );
    }
    $code = wp_remote_retrieve_response_code( $res );
    if ( $code < 200 || $code >= 400 ) {
        wp_send_json_error( array( 'message' => 'หน้าเว็บตอบกลับ HTTP ' . (int) $code ) );
    }
    $html = (string) wp_remote_retrieve_body( $res );
    if ( '' === $html ) {
        wp_send_json_error( array( 'message' => 'หน้าเว็บไม่มีเนื้อหา HTML' ) );
    }
    $html = substr( $html, 0, 2 * 1024 * 1024 ); // cap at 2MB

    // Probe /llms.txt at the same origin.
    $origin   = wp_parse_url( $url );
    $llms_ok  = false;
    if ( ! empty( $origin['scheme'] ) && ! empty( $origin['host'] ) ) {
        $llms_url = $origin['scheme'] . '://' . $origin['host'] . '/llms.txt';
        $llms_res = wp_safe_remote_get( $llms_url, array( 'timeout' => 5, 'redirection' => 1 ) );
        $llms_ok  = ! is_wp_error( $llms_res ) && 200 === (int) wp_remote_retrieve_response_code( $llms_res );
    }

    $result = hashbox_geo_run_checks( $html, $llms_ok );
    $result['url'] = $url;
    wp_send_json_success( $result );
}
add_action( 'wp_ajax_hb_geo_check', 'hashbox_geo_check_handler' );
add_action( 'wp_ajax_nopriv_hb_geo_check', 'hashbox_geo_check_handler' );

/* -------------------------------------------------------------------------
 * THIRD-PARTY SCRIPT DELAY
 * gtag, HubSpot and the Meta pixel together cost ~1.5s of mobile
 * main-thread time yet do nothing useful before the visitor interacts.
 * Buffer the page, neutralise their <script> tags to type="text/plain",
 * and re-activate them (in order) on the first interaction. Our own
 * code guards every gtag()/fbq() call with typeof checks, and the
 * inline gtag bootstrap keeps queueing into dataLayer meanwhile.
 * ---------------------------------------------------------------------- */

function hashbox_delay_third_party_scripts( $html ) {
    $hosts = 'googletagmanager\.com|connect\.facebook\.net|hs-scripts\.com|hs-analytics\.net|hscollectedforms\.net|hs-banner\.com|hsadspixel\.net';

    // External scripts from the ad/analytics hosts.
    $html = preg_replace(
        '#<script(\s[^>]*src=["\'][^"\']*(?:' . $hosts . ')[^"\']*["\'][^>]*)>#i',
        '<script type="text/plain" data-hb-delay$1>',
        $html
    );

    // Inline bootstraps that self-inject their libraries: the Meta-pixel
    // stub (fbevents.js) and the GTM container snippet (gtm.js). The plain
    // gtag config snippet stays live — it only queues into dataLayer.
    $html = preg_replace_callback(
        '#<script(?![^>]*\ssrc=)([^>]*)>(.*?)</script>#is',
        function ( $m ) {
            if ( false !== strpos( $m[0], 'data-hb-delay' ) || ! preg_match( '#fbq\s*\(|googletagmanager\.com/gtm\.js#', $m[2] ) ) {
                return $m[0];
            }
            return '<script type="text/plain" data-hb-delay' . $m[1] . '>' . $m[2] . '</script>';
        },
        $html
    );

    return $html;
}

function hashbox_start_third_party_delay_buffer() {
    if ( is_admin() || is_feed() || is_user_logged_in() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
        return;
    }
    ob_start( 'hashbox_delay_third_party_scripts' );
}
add_action( 'template_redirect', 'hashbox_start_third_party_delay_buffer', 1 );

function hashbox_print_third_party_delay_loader() {
    if ( is_admin() || is_user_logged_in() ) {
        return;
    }
    ?>
    <script id="hb-delay-loader">
    (function () {
      'use strict';
      var fired = false;
      var events = ['pointerdown', 'keydown', 'touchstart', 'wheel', 'scroll', 'mousemove'];
      function activate() {
        if (fired) { return; }
        fired = true;
        events.forEach(function (ev) { window.removeEventListener(ev, activate, { passive: true }); });
        var pending = Array.prototype.slice.call(document.querySelectorAll('script[data-hb-delay]'));
        (function next() {
          var old = pending.shift();
          if (!old) {
            window.dispatchEvent(new CustomEvent('hashbox:third-party-ready'));
            return;
          }
          // The signed Website Audit flow now owns its success UI and Meta
          // event. Skipping the editor-era runtime prevents it from removing
          // the retryable Google conversion URL before delivery is confirmed.
          if (isConfirmedWebsiteLead && !old.src && /trackConfirmedMetaLead/.test(old.textContent || '')) {
            old.remove();
            next();
            return;
          }
          var s = document.createElement('script');
          for (var i = 0; i < old.attributes.length; i++) {
            var a = old.attributes[i];
            if (a.name === 'type' || a.name === 'data-hb-delay') { continue; }
            s.setAttribute(a.name, a.value);
          }
          if (old.src) {
            s.addEventListener('load', next);
            s.addEventListener('error', next);
            old.replaceWith(s);
          } else {
            s.text = old.text;
            old.replaceWith(s);
            next();
          }
        })();
      }
      events.forEach(function (ev) { window.addEventListener(ev, activate, { passive: true }); });
      var successUuidPattern = /^[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}$/i;
      var aiConversionRefPattern = /^HB-AI-[0-9]{8}-[0-9]{9,40}$/;
      var websiteConversionRefPattern = /^HB-WEB-[0-9]{8}-[0-9]{9,40}$/;
      var confirmedAiLeadMeta = document.querySelector('meta[name="hashbox-confirmed-ai-lead"]');
      var confirmedAiLeadRef = confirmedAiLeadMeta ? confirmedAiLeadMeta.getAttribute('content') || '' : '';
      var confirmedAiConversionRef = confirmedAiLeadMeta ? confirmedAiLeadMeta.getAttribute('data-conversion-ref') || '' : '';
      // audit-landing.js can clean the signed query before this footer loader
      // runs. The meta tag is emitted only after the server validates the AI
      // path, sent transient and HMAC, so it remains the stable confirmation.
      var isConfirmedAiLead = document.querySelector('.hb-audit[data-audit-slug="ai-workflow-audit"]')
        && successUuidPattern.test(confirmedAiLeadRef)
        && aiConversionRefPattern.test(confirmedAiConversionRef)
        && confirmedAiConversionRef.length <= 64;
      var confirmedWebsiteLeadMeta = document.querySelector('meta[name="hashbox-confirmed-website-lead"]');
      var confirmedWebsiteLeadRef = confirmedWebsiteLeadMeta ? confirmedWebsiteLeadMeta.getAttribute('content') || '' : '';
      var confirmedWebsiteConversionRef = confirmedWebsiteLeadMeta ? confirmedWebsiteLeadMeta.getAttribute('data-conversion-ref') || '' : '';
      var isConfirmedWebsiteLead = successUuidPattern.test(confirmedWebsiteLeadRef)
        && websiteConversionRefPattern.test(confirmedWebsiteConversionRef)
        && confirmedWebsiteConversionRef.length <= 64;
      if (isConfirmedWebsiteLead) { window.hashboxConfirmedWebsiteLeadRef = confirmedWebsiteLeadRef; }
      if (isConfirmedAiLead || isConfirmedWebsiteLead) { window.setTimeout(activate, 0); }
    })();
    </script>
    <?php
}
// Run after enqueued footer scripts so success-page guards and transaction IDs
// are installed before any delayed legacy tracker is reactivated.
add_action( 'wp_footer', 'hashbox_print_third_party_delay_loader', 25 );
