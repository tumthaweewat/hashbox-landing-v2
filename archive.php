<?php
/**
 * Generic archive (author, date, etc.).
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<section class="hb-blog-hero hb-blog-hero--archive">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <h1 class="hb-blog-hero__title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
        <?php
        $desc = get_the_archive_description();
        if ( $desc ) : ?>
            <div class="hb-blog-hero__lede"><?php echo wp_kses_post( $desc ); ?></div>
        <?php endif; ?>
    </div>
</section>

<section class="hb-blog-grid-section">
    <div class="hb-container hb-container--md">
        <?php if ( have_posts() ) : ?>
            <div class="hb-blog-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post-card', null, array( 'variant' => 'standard' ) ); ?>
                <?php endwhile; ?>
            </div>
            <?php hashbox_pagination(); ?>
        <?php else : ?>
            <p class="hb-empty">ไม่มีบทความ</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
