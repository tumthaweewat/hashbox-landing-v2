<?php
/**
 * Category archive — topic hub for SEO.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$cat       = get_queried_object();
$cat_desc  = category_description();
$cat_count = (int) $cat->count;
?>

<section class="hb-blog-hero hb-blog-hero--archive">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <span class="hb-eyebrow">หมวดหมู่</span>
        <h1 class="hb-blog-hero__title"><?php single_cat_title(); ?></h1>
        <?php if ( ! empty( $cat_desc ) ) : ?>
            <div class="hb-blog-hero__lede"><?php echo wp_kses_post( $cat_desc ); ?></div>
        <?php else : ?>
            <p class="hb-blog-hero__lede">รวมบทความในหมวด <?php echo esc_html( $cat->name ); ?> — <?php echo $cat_count; ?> บทความ</p>
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
            <p class="hb-empty">ยังไม่มีบทความในหมวดนี้</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
