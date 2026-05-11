<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon and App Icons -->
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-16x16.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">
    
    <!-- Theme Color for Mobile Browsers -->
    <meta name="theme-color" content="#2563EB">
    <meta name="msapplication-TileColor" content="#09090B">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- ============ NAVIGATION ============ -->
    <header class="site-header" id="siteHeader">
        <div class="container header-container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <span class="logo-icon"></span>
                <span class="logo-text">HASHBOX<span class="logo-accent">.STUDIO</span></span>
            </a>

            <nav class="main-nav" id="mainNav">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '<ul>%3$s</ul>',
                        'link_before'    => '',
                        'link_after'     => '',
                    ) );
                } else {
                    hashbox_fallback_menu();
                }
                ?>
            </nav>

            <div class="header-actions">
                <a href="#contact" class="btn btn-cta btn-nav-cta">Free Consultation</a>
                <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-controls="mobileMenu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="mobile-menu" id="mobileMenu">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '<ul>%3$s</ul>',
                ) );
            } else {
                hashbox_fallback_mobile_menu();
            }
            ?>
            <a href="#contact" class="btn btn-cta mobile-cta">Free Consultation</a>
        </div>
    </header>

    <main>
