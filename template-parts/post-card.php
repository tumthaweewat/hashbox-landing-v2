<?php
/**
 * Template Part: Post card (3 variants: hero | standard | compact)
 *
 * @package Hashbox_Studio_V2
 */

$variant   = isset( $args['variant'] ) ? $args['variant'] : 'standard';
$cats      = get_the_category();
$cat       = ! empty( $cats ) ? $cats[0] : null;
$thumb_id  = get_post_thumbnail_id();
$thumb_alt = '';
if ( $thumb_id ) {
    $thumb_alt = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
    if ( '' === $thumb_alt ) {
        $thumb_alt = get_the_title();
    }
}
$read = hashbox_reading_time();
?>
<article class="hb-card hb-card--<?php echo esc_attr( $variant ); ?>">
    <a class="hb-card__link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php if ( $thumb_id ) : ?>
            <div class="hb-card__media">
                <?php echo wp_get_attachment_image( $thumb_id, 'large', false, array(
                    'alt'      => $thumb_alt,
                    'loading'  => 'lazy',
                    'decoding' => 'async',
                    'sizes'    => '(max-width: 768px) 100vw, (max-width: 1200px) 50vw, 400px',
                ) ); ?>
            </div>
        <?php endif; ?>
        <div class="hb-card__body">
            <?php if ( $cat ) : ?>
                <span class="hb-card__cat"><?php echo esc_html( $cat->name ); ?></span>
            <?php endif; ?>
            <h3 class="hb-card__title"><?php the_title(); ?></h3>
            <?php if ( 'compact' !== $variant ) : ?>
                <p class="hb-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 'hero' === $variant ? 32 : 22 ) ); ?></p>
            <?php endif; ?>
            <div class="hb-card__meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></time>
                <span class="hb-card__dot" aria-hidden="true">·</span>
                <span><?php echo (int) $read; ?> min read</span>
            </div>
        </div>
    </a>
</article>
