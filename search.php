<?php
/**
 * Search results.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<section class="hb-blog-hero hb-blog-hero--archive">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <span class="hb-eyebrow">ค้นหา</span>
        <h1 class="hb-blog-hero__title">ผลลัพธ์: "<?php echo esc_html( get_search_query() ); ?>"</h1>
        <p class="hb-blog-hero__lede"><?php echo (int) $GLOBALS['wp_query']->found_posts; ?> รายการ</p>

        <form role="search" method="get" class="hb-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label for="hb-search-input" class="screen-reader-text">ค้นหา</label>
            <input id="hb-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="ค้นหาบทความ..." required>
            <button type="submit" class="hb-btn hb-btn--gradient">ค้นหา</button>
        </form>
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
            <p class="hb-empty">ไม่พบบทความที่ตรงกัน — ลองคำค้นอื่น</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
