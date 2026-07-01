<?php
/**
 * V4 ads artwork preview.
 *
 * Shows active paid-media assets only. Contact sheets and older artwork are
 * intentionally excluded from this page.
 *
 * @package Hashbox_Studio_V2
 */

$pages   = function_exists( 'hashbox_audit_landing_pages' ) ? hashbox_audit_landing_pages() : array();
$formats = function_exists( 'hashbox_ads_preview_formats' ) ? hashbox_ads_preview_formats() : array();

get_header();
?>

<article class="hb-audit hb-ads-preview">
    <header class="hb-ads-preview__hero">
        <div class="hb-audit-hero__grid"></div>
        <div class="hb-container hb-container--xl">
            <span class="hb-audit-kicker">
                <span class="hb-audit-kicker__mark">H</span>
                Hashbox Ads Kit V4
            </span>
            <h1 class="hb-ads-preview__title">V4 Artwork Preview</h1>
            <p class="hb-ads-preview__sub">Active ad artwork only. Files render from <code>/assets/ads/hashbox/</code>; <code>artwork_contact_sheet_v4.png</code> is preview-only and is not used here.</p>
        </div>
    </header>

    <section class="hb-audit-section">
        <div class="hb-container hb-container--xl">
            <?php foreach ( $pages as $landing ) : ?>
                <section class="hb-ads-preview__route" aria-labelledby="route-<?php echo esc_attr( $landing['creative_key'] ); ?>">
                    <div class="hb-ads-preview__route-head">
                        <div>
                            <span class="hb-eyebrow"><?php echo esc_html( $landing['creative_key'] ); ?></span>
                            <h2 id="route-<?php echo esc_attr( $landing['creative_key'] ); ?>"><?php echo esc_html( $landing['service_label'] ); ?></h2>
                            <p><?php echo esc_html( $landing['hero_headline'] ); ?></p>
                        </div>
                        <a class="hb-btn hb-btn--outline" href="<?php echo esc_url( hashbox_audit_landing_canonical_url( $landing ) ); ?>">Open landing</a>
                    </div>

                    <div class="hb-ads-preview__meta">
                        <span>UTM content: <strong><?php echo esc_html( $landing['utm_content'] ); ?></strong></span>
                        <span>CTA: <strong><?php echo esc_html( $landing['primary_cta'] ); ?></strong></span>
                    </div>

                    <div class="hb-ads-preview__grid">
                        <?php foreach ( $formats as $image_key => $format ) : ?>
                            <?php
                            $file_name = isset( $landing[ $image_key ] ) ? $landing[ $image_key ] : '';
                            if ( ! $file_name ) {
                                continue;
                            }

                            $asset_url = hashbox_audit_landing_asset_uri( $file_name );
                            ?>
                            <figure class="hb-ads-preview__card hb-ads-preview__card--<?php echo esc_attr( str_replace( '_image', '', $image_key ) ); ?>">
                                <a href="<?php echo esc_url( $asset_url ); ?>" target="_blank" rel="noopener noreferrer">
                                    <img src="<?php echo esc_url( $asset_url ); ?>" alt="<?php echo esc_attr( $landing['service_label'] . ' ' . $format['label'] . ' V4 artwork' ); ?>" loading="lazy">
                                </a>
                                <figcaption>
                                    <span><?php echo esc_html( $format['label'] ); ?></span>
                                    <strong><?php echo esc_html( $format['dimensions'] ); ?></strong>
                                    <code><?php echo esc_html( $file_name ); ?></code>
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    </section>
</article>

<?php
get_footer();
