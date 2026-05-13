<?php
/**
 * Tag archive.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$tag = get_queried_object();
?>

<section class="hb-blog-hero hb-blog-hero--archive">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <span class="hb-eyebrow">แท็ก</span>
        <h1 class="hb-blog-hero__title">#<?php single_tag_title(); ?></h1>
        <?php if ( tag_description() ) : ?>
            <div class="hb-blog-hero__lede"><?php echo wp_kses_post( tag_description() ); ?></div>
        <?php else : ?>
            <p class="hb-blog-hero__lede">บทความที่แท็กด้วย <?php echo esc_html( $tag->name ); ?></p>
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
