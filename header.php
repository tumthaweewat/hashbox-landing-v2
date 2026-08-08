<?php
$hashbox_header_landing   = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
$hashbox_is_ai_audit      = is_array( $hashbox_header_landing ) && 'ai-workflow-audit' === $hashbox_header_landing['slug'];
$hashbox_is_website_audit = is_page( 'website-audit' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0<?php echo $hashbox_is_ai_audit ? ', viewport-fit=cover' : ''; ?>">

    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/favicon-32x32.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/favicons/site.webmanifest">

    <meta name="theme-color" content="<?php echo esc_attr( $hashbox_is_ai_audit ? '#07101f' : '#09090B' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <header class="hb-nav<?php echo $hashbox_is_ai_audit ? ' hb-nav--ai-audit' : ''; ?>" id="siteNav">
        <div class="hb-nav__inner">
            <?php if ( $hashbox_is_website_audit ) : ?>
                <span class="hb-nav__brand">
                    <span class="hb-nav__brand-mark">H</span>
                    <span>HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span></span>
                </span>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hb-nav__brand">
                    <span class="hb-nav__brand-mark">H</span>
                    <span>HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span></span>
                </a>
            <?php endif; ?>

            <?php if ( ! $hashbox_is_ai_audit && ! $hashbox_is_website_audit ) : ?>
                <ul class="hb-nav__menu">
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="hb-nav__link">Services</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-nav__link">Work</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="hb-nav__link">Blog</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="hb-nav__link">About</a></li>
                </ul>
            <?php endif; ?>

            <div class="hb-nav__actions">
                <?php if ( $hashbox_is_website_audit ) : ?>
                    <a href="#project-form" class="hb-btn hb-btn--outline hb-btn--sm">ขอประเมิน</a>
                <?php elseif ( $hashbox_is_ai_audit ) : ?>
                    <a href="#audit-form" class="hb-btn hb-btn--gradient hb-btn--sm hb-ai-button" data-track-event="ai_cta_click">ส่งโจทย์ AI</a>
                <?php else : ?>
                    <span class="hb-nav__status">All systems live</span>
                    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--sm">รับ Audit ฟรี</a>
                    <button class="hb-nav__burger" id="navBurger" aria-label="Open menu" aria-controls="navSheet" aria-expanded="false">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?php if ( ! $hashbox_is_ai_audit && ! $hashbox_is_website_audit ) : ?>
        <div class="hb-sheet-backdrop"></div>
        <div class="hb-sheet" id="navSheet" role="dialog" aria-modal="true" aria-labelledby="navSheetTitle" aria-hidden="true">
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
                    <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="hb-sheet__link">Blog</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="hb-sheet__link">About</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-sheet__link">Contact</a></li>
                </ul>
            </nav>
            <div class="hb-sheet__footer">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี</a>
                <a href="https://lin.ee/Xagx6i4" class="hb-btn hb-btn--outline" target="_blank" rel="noopener noreferrer">คุยทาง LINE</a>
            </div>
        </div>
    <?php endif; ?>

    <main id="content">
