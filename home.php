<?php
/**
 * Blog index template — editorial grid.
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$featured_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

$categories = get_categories( array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 6,
) );
?>

<section class="hb-blog-hero">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <span class="hb-eyebrow">BLOG</span>
        <h1 class="hb-blog-hero__title">Insights ที่นำไปใช้ได้จริง</h1>
        <p class="hb-blog-hero__lede">บทความเทคนิคจากทีมที่ Code, Run Ads และ Implement AI เอง — เน้นกรณีศึกษาและขั้นตอนที่ลงมือทำได้</p>

        <?php if ( ! empty( $categories ) ) : ?>
            <nav class="hb-blog-cats" aria-label="Categories">
                <a class="hb-blog-cats__pill<?php echo is_home() ? ' is-active' : ''; ?>" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">ทั้งหมด</a>
                <?php foreach ( $categories as $cat ) : ?>
                    <a class="hb-blog-cats__pill" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                        <span class="hb-blog-cats__count"><?php echo (int) $cat->count; ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
    </div>
</section>

<?php if ( $featured_query->have_posts() ) : ?>
<section class="hb-blog-featured" aria-label="Featured post">
    <div class="hb-container hb-container--md">
        <?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
            $thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            $cats  = get_the_category();
            $cat   = ! empty( $cats ) ? $cats[0] : null;
            $read  = hashbox_reading_time();
        ?>
        <article class="hb-blog-featured__card">
            <a class="hb-blog-featured__link" href="<?php the_permalink(); ?>">
                <?php if ( $thumb ) : ?>
                    <div class="hb-blog-featured__media">
                        <img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="eager" fetchpriority="high" width="1200" height="675">
                    </div>
                <?php endif; ?>
                <div class="hb-blog-featured__body">
                    <span class="hb-eyebrow">FEATURED</span>
                    <?php if ( $cat ) : ?>
                        <span class="hb-blog-featured__cat"><?php echo esc_html( $cat->name ); ?></span>
                    <?php endif; ?>
                    <h2 class="hb-blog-featured__title"><?php the_title(); ?></h2>
                    <p class="hb-blog-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32 ) ); ?></p>
                    <div class="hb-blog-featured__meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></time>
                        <span aria-hidden="true">·</span>
                        <span><?php echo (int) $read; ?> min read</span>
                    </div>
                </div>
            </a>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>

<section class="hb-blog-grid-section">
    <div class="hb-container hb-container--md">
        <header class="hb-blog-grid-section__header">
            <h2 class="hb-h2">บทความล่าสุด</h2>
        </header>

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $offset = 1 === $paged ? 1 : 0; // Skip featured on page 1.
        $list_query = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 9,
            'paged'          => $paged,
            'offset'         => $offset + ( ( $paged - 1 ) * 9 ),
        ) );

        if ( $list_query->have_posts() ) : ?>
            <div class="hb-blog-grid">
                <?php while ( $list_query->have_posts() ) : $list_query->the_post(); ?>
                    <?php get_template_part( 'template-parts/post-card', null, array( 'variant' => 'standard' ) ); ?>
                <?php endwhile; ?>
            </div>

            <?php
            $GLOBALS['wp_query'] = $list_query;
            hashbox_pagination();
            wp_reset_postdata();
            ?>
        <?php else : ?>
            <p class="hb-empty">ยังไม่มีบทความ — กลับมาเร็ว ๆ นี้</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
