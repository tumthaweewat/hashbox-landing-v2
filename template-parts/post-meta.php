<?php
/**
 * Template Part: Post meta (author, date, reading time)
 *
 * @package Hashbox_Studio_V2
 */

$author_id   = get_the_author_meta( 'ID' );
$author_name = get_the_author();
$author_url  = get_author_posts_url( $author_id );
$reading_min = hashbox_reading_time();
?>
<div class="hb-post-meta">
    <a class="hb-post-meta__author" href="<?php echo esc_url( $author_url ); ?>" rel="author">
        <?php echo get_avatar( $author_id, 40, '', $author_name, array( 'class' => 'hb-post-meta__avatar' ) ); ?>
        <span>
            <span class="hb-post-meta__label">โดย</span>
            <strong><?php echo esc_html( $author_name ); ?></strong>
        </span>
    </a>
    <span class="hb-post-meta__sep" aria-hidden="true">·</span>
    <time class="hb-post-meta__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
        <?php echo esc_html( get_the_date( 'd M Y' ) ); ?>
    </time>
    <span class="hb-post-meta__sep" aria-hidden="true">·</span>
    <span class="hb-post-meta__reading"><?php echo (int) $reading_min; ?> min read</span>
    <?php if ( get_the_modified_date( 'U' ) - get_the_date( 'U' ) > 86400 ) : ?>
        <span class="hb-post-meta__sep" aria-hidden="true">·</span>
        <span class="hb-post-meta__updated">อัปเดต <?php echo esc_html( get_the_modified_date( 'd M Y' ) ); ?></span>
    <?php endif; ?>
</div>
