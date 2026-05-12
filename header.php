<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">

    <meta name="theme-color" content="#09090B">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="hb-nav" id="siteNav">
        <div class="hb-nav__inner">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hb-nav__brand">
                <span class="hb-nav__brand-mark">H</span>
                <span>HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span></span>
            </a>

            <ul class="hb-nav__menu" role="menubar">
                <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="hb-nav__link">Services</a></li>
                <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-nav__link">Work</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>" class="hb-nav__link">Insights</a></li>
                <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="hb-nav__link">About</a></li>
            </ul>

            <div class="hb-nav__actions">
                <span class="hb-nav__status">All systems live</span>
                <a href="#contact" class="hb-btn hb-btn--gradient hb-btn--sm">รับ Audit ฟรี</a>
                <button class="hb-nav__burger" id="navBurger" aria-label="Open menu" aria-controls="navSheet" aria-expanded="false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
        </div>
    </header>

    <div class="hb-sheet-backdrop"></div>
    <aside class="hb-sheet" id="navSheet" role="dialog" aria-modal="true" aria-labelledby="navSheetTitle">
        <div class="hb-sheet__head">
            <span id="navSheetTitle" class="hb-eyebrow">Menu</span>
            <button class="hb-sheet__close" aria-label="Close menu">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <nav>
            <ul class="hb-sheet__menu">
                <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="hb-sheet__link">Services</a></li>
                <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-sheet__link">Work</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>" class="hb-sheet__link">Insights</a></li>
                <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="hb-sheet__link">About</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-sheet__link">Contact</a></li>
            </ul>
        </nav>
        <div class="hb-sheet__footer">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี</a>
            <a href="https://lin.ee/Xagx6i4" class="hb-btn hb-btn--outline" target="_blank" rel="noopener noreferrer">คุยทาง LINE</a>
        </div>
    </aside>

    <main id="content">
