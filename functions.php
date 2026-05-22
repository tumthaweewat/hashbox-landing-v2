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
 */
function hashbox_document_title( $title ) {
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

    // V2 stack — DM Sans for display headings, IBM Plex Sans Thai for body/Thai fallback.
    wp_enqueue_style(
        'hashbox-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&family=IBM+Plex+Sans+Thai:wght@300;400;500;600;700&family=IBM+Plex+Sans:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    add_filter( 'wp_resource_hints', 'hashbox_resource_hints', 10, 2 );

    // V2 design system — load in dependency order (tokens first)
    $layers = array(
        'tokens'      => 'tokens.css',
        'primitives'  => 'primitives.css',
        'surface'     => 'surface.css',
        'navigation'  => 'navigation.css',
        'interactive' => 'interactive.css',
        'composed'    => 'composed.css',
    );
    $prev = 'hashbox-google-fonts';
    foreach ( $layers as $key => $file ) {
        $handle = 'hashbox-ds-' . $key;
        wp_enqueue_style( $handle, $theme_uri . '/design-system/' . $file, array( $prev ), $version );
        $prev = $handle;
    }

    // Legacy theme stylesheet (loads last — kept so WP recognizes theme)
    wp_enqueue_style( 'hashbox-style', get_stylesheet_uri(), array( $prev ), $version );

    // V2 script
    wp_enqueue_script(
        'hashbox-v2-script',
        $theme_uri . '/js/v2.js',
        array(),
        $version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_assets' );

/**
 * Add preconnect resource hints for Google Fonts
 */
function hashbox_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => false,
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}

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
 * Force HTML lang="th" site-wide so crawlers classify the site as Thai.
 *
 * The visible content is Thai-primary; the WP locale was previously en-US which
 * mis-signalled language to Google. Override at the language_attributes filter
 * level so this works regardless of WP Settings → General locale.
 */
function hashbox_force_thai_lang_attribute( $output ) {
    if ( function_exists( 'pll_current_language' ) || defined( 'ICL_SITEPRESS_VERSION' ) ) {
        return $output;
    }
    return 'lang="th-TH"';
}
add_filter( 'language_attributes', 'hashbox_force_thai_lang_attribute' );

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
        'title'       => 'Hashbox Studio | Website, Marketing และ AI Consulting',
        'description' => 'Hashbox Studio ช่วยธุรกิจไทยสร้างเว็บไซต์ SEO-Ready, วาง Digital Marketing + CRO และพัฒนา AI Workforce ที่ใช้งานจริง วัดผลผ่าน KPI เดียวกัน',
    );

    if ( is_front_page() ) {
        return array(
            'title'       => 'รับทำเว็บไซต์ SEO + AI Consulting | Hashbox Studio',
            'description' => 'Hashbox Studio รับทำเว็บไซต์ SEO-Ready ติดตั้ง Digital Marketing + CRO และที่ปรึกษา AI สำหรับ SME ไทย พร้อม Lighthouse 100, Core Web Vitals เขียว และผลลัพธ์ใน 60-90 วัน',
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

    if ( is_page() ) {
        $post = get_queried_object();
        $slug = $post instanceof WP_Post ? $post->post_name : '';
        $page_meta = array(
            'services' => array(
                'title'       => 'บริการทำเว็บไซต์ SEO, CRO และ AI | Hashbox Studio',
                'description' => 'รวมบริการทำเว็บไซต์ SEO-Ready, Digital Marketing + CRO และ AI Consulting ในทีมเดียว วาง KPI เดียวกัน ตั้งแต่เว็บพร้อมติด Google ไปจนถึงระบบ AI ลดงาน Manual',
            ),
            'seo-ready-website' => array(
                'title'       => 'รับทำเว็บไซต์ SEO-Ready Lighthouse 100 | Hashbox',
                'description' => 'บริการรับทำเว็บไซต์ SEO-Ready สำหรับธุรกิจไทย วางโครงสร้าง technical SEO, schema, sitemap, Core Web Vitals และ Lighthouse 100 ก่อน deploy ขึ้น production',
            ),
            'digital-marketing-tools' => array(
                'title'       => 'Digital Marketing Tools + CRO เพิ่ม Conversion | Hashbox',
                'description' => 'ติดตั้ง GA4, GSC, Server-side GTM, Looker Studio, heatmap และ A/B testing พร้อมรัน CRO Sprint รายเดือนเพื่อเพิ่ม conversion จาก traffic เดิม',
            ),
            'ai-consulting' => array(
                'title'       => 'ที่ปรึกษา AI และ AI Workforce | Hashbox Studio',
                'description' => 'ที่ปรึกษา AI ที่ออกแบบและพัฒนา AI Workforce ใช้งานจริงใน production เช่น LINE Bot, Sales GPT, RAG และ workflow automation พร้อมคำนวณ ROI ก่อนเริ่ม',
            ),
            'work' => array(
                'title'       => 'Case Studies SEO, CRO, AI ที่วัดผลได้ | Hashbox',
                'description' => 'รวม case study งาน SEO, CRO, เว็บไซต์และ AI ของ Hashbox Studio พร้อมตัวเลขจาก GA4 และ Search Console เช่น +2,200% impressions, 3x conversion และลด cost 60%',
            ),
            'about' => array(
                'title'       => 'เกี่ยวกับ Hashbox Studio | Web, Marketing และ AI',
                'description' => 'รู้จัก Hashbox Studio ทีมที่รวม web development, digital marketing, CRO และ AI consulting ไว้ด้วยกัน เพื่อช่วย SME ไทยสร้างระบบที่วัดผลได้จริง',
            ),
            'portfolio' => array(
                'title'       => 'Portfolio งาน Web, Mobile และ Digital | Hashbox Studio',
                'description' => 'รวมผลงาน web design, mobile app, e-commerce และ digital product จากทีม Hashbox Studio ครอบคลุม Banking, Real Estate, E-commerce และ AI',
            ),
        );

        if ( isset( $page_meta[ $slug ] ) ) {
            return $page_meta[ $slug ];
        }
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
            'description' => 'หน้าที่คุณเปิดอาจถูกย้ายหรือลบแล้ว กลับไปที่ Hashbox Studio เพื่อดูบริการรับทำเว็บไซต์ SEO, Digital Marketing + CRO และ AI Consulting',
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
    if ( is_singular() ) {
        return get_permalink();
    }
    if ( is_category() ) {
        return get_category_link( get_queried_object_id() );
    }
    if ( is_tag() ) {
        return get_tag_link( get_queried_object_id() );
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
    $image = is_singular() ? hashbox_og_image_url( get_queried_object_id() ) : hashbox_default_og_image_url();
    $type  = is_singular( 'post' ) ? 'article' : 'website';

    echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta property="og:locale" content="th_TH">' . "\n";
    echo '<meta property="og:locale:alternate" content="en_US">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr( $type ) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url( $image ) . '">' . "\n";
}
add_action( 'wp_head', 'hashbox_homepage_meta_description', 1 );

/**
 * Feed optimized SEO metadata into Rank Math.
 */
function hashbox_rankmath_title( $title ) {
    return hashbox_get_seo_title( $title );
}
add_filter( 'rank_math/frontend/title', 'hashbox_rankmath_title', 20 );

function hashbox_rankmath_description( $description ) {
    $seo_description = hashbox_get_meta_description();
    return ! empty( $seo_description ) ? $seo_description : $description;
}
add_filter( 'rank_math/frontend/description', 'hashbox_rankmath_description', 20 );

function hashbox_rankmath_social_title( $content ) {
    return hashbox_get_seo_title( $content );
}
add_filter( 'rank_math/opengraph/facebook/og_title', 'hashbox_rankmath_social_title', 20 );
add_filter( 'rank_math/opengraph/twitter/twitter_title', 'hashbox_rankmath_social_title', 20 );

function hashbox_rankmath_social_description( $content ) {
    $seo_description = hashbox_get_meta_description();
    return ! empty( $seo_description ) ? $seo_description : $content;
}
add_filter( 'rank_math/opengraph/facebook/og_description', 'hashbox_rankmath_social_description', 20 );
add_filter( 'rank_math/opengraph/twitter/twitter_description', 'hashbox_rankmath_social_description', 20 );

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

function hashbox_rankmath_schema_organization() {
    $home = home_url( '/' );
    return array(
        '@type' => 'Organization',
        '@id'   => $home . '#organization',
        'name'  => 'Hashbox Studio',
        'url'   => $home,
        'logo'  => hashbox_default_og_image_url(),
        'sameAs' => array(
            'https://www.linkedin.com/company/hashbox-studio',
            'https://www.facebook.com/hashboxstudio',
            'https://www.instagram.com/hashboxstudio',
        ),
        'contactPoint' => array(
            '@type'             => 'ContactPoint',
            'telephone'         => '+66-2-266-6222',
            'email'             => 'business@hashbox.co.th',
            'contactType'       => 'sales',
            'areaServed'        => 'TH',
            'availableLanguage' => array( 'th', 'en' ),
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
        '@type'              => 'ProfessionalService',
        '@id'                => $home . '#service',
        'name'               => 'Hashbox Studio',
        'description'        => 'SEO-ready website builds, digital marketing tools, CRO, and AI consulting for Thai SMEs.',
        'url'                => $home,
        'priceRange'         => '฿฿฿',
        'areaServed'         => 'Thailand',
        'parentOrganization' => array( '@id' => $home . '#organization' ),
    );
}

function hashbox_rankmath_json_ld( $data, $jsonld = null ) {
    if ( ! is_array( $data ) ) {
        return $data;
    }

    $home        = home_url( '/' );
    $current_url = hashbox_current_public_url();
    $description = hashbox_get_meta_description();
    $has_org     = false;
    $has_website = false;
    $has_service = false;

    foreach ( $data as $key => $entity ) {
        if ( ! is_array( $entity ) ) {
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
            $data[ $key ]['inLanguage']  = 'th-TH';
            $data[ $key ]['description'] = $description;
            $data[ $key ]['isPartOf']    = array( '@id' => $home . '#website' );
            $data[ $key ]['publisher']   = array( '@id' => $home . '#organization' );
        }

        if ( is_singular( 'post' ) && hashbox_schema_entity_has_type( $entity, array( 'Article', 'BlogPosting', 'NewsArticle' ) ) ) {
            $data[ $key ]['inLanguage'] = 'th-TH';
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
    if ( ! empty( $image ) ) {
        return $image;
    }
    return is_singular() ? hashbox_og_image_url( get_queried_object_id() ) : hashbox_default_og_image_url();
}
add_filter( 'rank_math/opengraph/facebook/image', 'hashbox_rankmath_og_image' );
add_filter( 'rank_math/opengraph/twitter/image', 'hashbox_rankmath_og_image' );

function hashbox_rankmath_og_locale( $locale ) {
    return 'th_TH';
}
add_filter( 'rank_math/opengraph/facebook/og_locale', 'hashbox_rankmath_og_locale' );
add_filter( 'rank_math/opengraph/facebook/locale', 'hashbox_rankmath_og_locale' );

function hashbox_rankmath_case_study_sitemap_entry( $url, $type, $object ) {
    if ( 'post' === $type && $object instanceof WP_Post && hashbox_is_case_study_page( $object->ID ) ) {
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

    $home   = home_url( '/' );
    $logo   = get_template_directory_uri() . '/assets/favicons/apple-touch-icon.png';

    hashbox_jsonld( array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            array(
                '@type' => 'Organization',
                '@id'   => $home . '#organization',
                'name'  => 'Hashbox Studio',
                'url'   => $home,
                'logo'  => $logo,
                'sameAs' => array(
                    'https://www.linkedin.com/company/hashbox-studio',
                    'https://www.facebook.com/hashboxstudio',
                    'https://www.instagram.com/hashboxstudio',
                ),
                'contactPoint' => array(
                    '@type'             => 'ContactPoint',
                    'telephone'         => '+66-2-266-6222',
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
            ),
            array(
                '@type'              => 'ProfessionalService',
                '@id'                => $home . '#service',
                'name'               => 'Hashbox Studio',
                'description'        => 'SEO-ready website builds, digital marketing tools, CRO, and AI consulting for Thai SMEs.',
                'url'                => $home,
                'priceRange'         => '฿฿฿',
                'areaServed'         => 'Thailand',
                'parentOrganization' => array( '@id' => $home . '#organization' ),
                'hasOfferCatalog'    => array(
                    '@type' => 'OfferCatalog',
                    'name'  => 'Services',
                    'itemListElement' => array(
                        array(
                            '@type'       => 'Offer',
                            'itemOffered' => array(
                                '@type'       => 'Service',
                                'name'        => 'SEO-Ready Website Build',
                                'description' => 'Production-ready websites that pass Lighthouse 100, green Core Web Vitals, complete schema, and rank within 60-90 days.',
                            ),
                        ),
                        array(
                            '@type'       => 'Offer',
                            'itemOffered' => array(
                                '@type'       => 'Service',
                                'name'        => 'Digital Marketing Tools + CRO',
                                'description' => 'GA4, GSC, Looker Studio, heatmaps, A/B testing, and monthly CRO sprints to compound conversion.',
                            ),
                        ),
                        array(
                            '@type'       => 'Offer',
                            'itemOffered' => array(
                                '@type'       => 'Service',
                                'name'        => 'AI Expert Consulting',
                                'description' => 'LINE bot, sales GPT, RAG knowledge base, and workflow automation that ships to production.',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                '@type'      => 'WebSite',
                '@id'        => $home . '#website',
                'url'        => $home,
                'name'       => 'Hashbox Studio',
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
            ),
        ),
    ) );
}
add_action( 'wp_head', 'hashbox_inject_home_schema', 20 );

/**
 * Add sitemap hints to the runtime robots.txt output.
 */
function hashbox_robots_txt( $output, $public ) {
    if ( '0' === (string) $public ) {
        return $output;
    }

    $sitemap = hashbox_rank_math_is_active() ? home_url( '/sitemap_index.xml' ) : home_url( '/wp-sitemap.xml' );
    if ( false === strpos( $output, 'Sitemap:' ) ) {
        $output = rtrim( $output ) . "\n\nSitemap: " . $sitemap . "\n";
    }
    return $output;
}
add_filter( 'robots_txt', 'hashbox_robots_txt', 10, 2 );

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
                'q' => 'Digital Marketing Tools และ CRO ทำอะไรบ้าง?',
                'a' => 'นอกจากจะติดตั้งและ Config เครื่องมือ Tracking ครบวงจรให้แล้ว ทีมเรายังรัน CRO Sprint รายเดือนต่อเนื่อง เริ่มจากการตั้งสมมติฐานจาก Data จริง รัน A/B Test แล้ววัดผล ส่ง Report พร้อมคำแนะนำที่นำไป Ship ได้ทันที ลูกค้าจึงได้ทั้งเครื่องมือและ Insight ไม่ใช่แค่ติดตั้งทิ้งไว้แล้วจบครับ',
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
                'a' => 'Landing Page เริ่มที่ 80,000 บาท Corporate Site เริ่มที่ 200,000 บาท E-commerce เริ่มที่ 350,000 บาท ส่วน AI Consulting Retainer เริ่มที่ 50,000 บาทต่อเดือน ทุกใบเสนอราคาจะออกหลังการ Audit ฟรีเสมอ เพื่อให้ลูกค้าเห็นภาพชัดก่อนตัดสินใจครับ',
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
        'mainEntity' => $main_entity,
    ) );
}
add_action( 'wp_head', 'hashbox_inject_home_faq_schema', 21 );

/**
 * Contact form submission handler (admin-post.php endpoint).
 */
function hashbox_handle_contact_submit() {
    if ( ! isset( $_POST['hashbox_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['hashbox_nonce'] ), 'hashbox_contact' ) ) {
        wp_die( 'Invalid request token.', 'Forbidden', array( 'response' => 403 ) );
    }
    $name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
    $email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )       : '';
    $phone   = isset( $_POST['phone'] )   ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )   : '';
    $website = isset( $_POST['website'] ) ? esc_url_raw( wp_unslash( $_POST['website'] ) )         : '';
    $service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
    $pdpa    = isset( $_POST['pdpa'] );

    if ( $name === '' || $email === '' || ! is_email( $email ) || ! $pdpa ) {
        wp_safe_redirect( add_query_arg( 'contact', 'invalid', home_url( '/#contact' ) ) );
        exit;
    }

    $to      = 'business@hashbox.co.th';
    $subject = sprintf( '[Hashbox V2] New enquiry from %s — %s', $name, $service ?: 'unspecified' );
    $body    = sprintf( "Name: %s\nEmail: %s\nPhone: %s\nWebsite: %s\nService: %s\n\nMessage:\n%s", $name, $email, $phone, $website, $service, $message );
    $headers = array( 'Content-Type: text/plain; charset=UTF-8', sprintf( 'Reply-To: %s <%s>', $name, $email ) );

    $sent = wp_mail( $to, $subject, $body, $headers );
    wp_safe_redirect( add_query_arg( 'contact', $sent ? 'sent' : 'error', home_url( '/#contact' ) ) );
    exit;
}
add_action( 'admin_post_nopriv_hashbox_contact', 'hashbox_handle_contact_submit' );
add_action( 'admin_post_hashbox_contact',        'hashbox_handle_contact_submit' );

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
                <h1 class="hb-h1" style="margin-top: var(--hb-space-4);"><?php echo esc_html( $case['name'] ); ?></h1>
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

        <?php if ( ! empty( $case['testimonial']['quote'] ) ) : ?>
        <section class="hb-section">
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

        <section class="hb-section hb-section--surface">
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
        'datePublished'  => $case['year'] . '-01-01',
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
 * OG image URL with fallback chain: featured → site default.
 */
function hashbox_og_image_url( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    if ( $post_id && has_post_thumbnail( $post_id ) ) {
        $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        if ( $src ) {
            return $src[0];
        }
    }
    return hashbox_default_og_image_url();
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
    // Defer to Rank Math if its schema module is active.
    if ( hashbox_rank_math_is_active() ) {
        return;
    }
    $post_id  = get_the_ID();
    $cats     = get_the_category( $post_id );
    $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Insights';
    $cat_url  = ! empty( $cats ) ? get_category_link( $cats[0]->term_id ) : home_url( '/blog/' );

    hashbox_jsonld( array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Article',
        '@id'           => get_permalink( $post_id ) . '#article',
        'headline'      => get_the_title( $post_id ),
        'description'   => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
        'image'         => hashbox_og_image_url( $post_id ),
        'datePublished' => get_the_date( 'c', $post_id ),
        'dateModified'  => get_the_modified_date( 'c', $post_id ),
        'inLanguage'    => 'th-TH',
        'author'        => array( '@id' => home_url( '/#organization' ) ),
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
        'inLanguage' => 'th-TH',
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
 */
function hashbox_enqueue_blog_assets() {
    if ( is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_archive() || is_search() ) {
        $blog_css = get_template_directory() . '/css/blog.css';
        if ( file_exists( $blog_css ) ) {
            wp_enqueue_style(
                'hashbox-blog',
                get_template_directory_uri() . '/css/blog.css',
                array( 'hashbox-style' ),
                filemtime( $blog_css )
            );
        }
    }
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
