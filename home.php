<?php
/**
 * Blog index template — editorial grid.
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$total_posts    = (int) wp_count_posts( 'post' )->publish;
$paged          = ( get_query_var( 'paged' ) ) ? (int) get_query_var( 'paged' ) : 1;
$show_featured  = $total_posts > 1 && 1 === $paged; // Only carve out featured on the first archive page.
$featured_query = $show_featured ? new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC',
) ) : null;

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
        <h1 class="hb-blog-hero__title">Blog SEO, Web Performance และ AI Automation</h1>
        <p class="hb-blog-hero__lede">บทความ SEO, Core Web Vitals, Digital Marketing + CRO และ AI จากทีมที่ Code, Run Ads และ Implement ระบบจริง — เน้นกรณีศึกษาและขั้นตอนที่ลงมือทำได้</p>

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

<?php if ( $show_featured && $featured_query && $featured_query->have_posts() ) : ?>
<section class="hb-blog-featured" aria-label="Featured post">
    <div class="hb-container hb-container--md">
        <?php while ( $featured_query->have_posts() ) : $featured_query->the_post();
            $thumb_id = get_post_thumbnail_id();
            $cats     = get_the_category();
            $cat      = ! empty( $cats ) ? $cats[0] : null;
            $read     = hashbox_reading_time();
            $featured_classes = array(
                'hb-blog-featured__card',
                $thumb_id ? 'hb-blog-featured__card--with-media' : 'hb-blog-featured__card--text-only',
            );
        ?>
        <article class="<?php echo esc_attr( implode( ' ', $featured_classes ) ); ?>">
            <a class="hb-blog-featured__link" href="<?php the_permalink(); ?>">
                <?php if ( $thumb_id ) : ?>
                    <div class="hb-blog-featured__media">
                        <?php
                        $thumb_alt = trim( (string) get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
                        if ( '' === $thumb_alt ) {
                            $thumb_alt = get_the_title();
                        }
                        echo wp_get_attachment_image( $thumb_id, 'full', false, array(
                            'alt'           => $thumb_alt,
                            'loading'       => 'eager',
                            'fetchpriority' => 'high',
                            'decoding'      => 'async',
                            'sizes'         => '(max-width: 768px) 100vw, 960px',
                        ) );
                        ?>
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
        $skip_first = $show_featured && 1 === $paged;
        $rendered   = 0;

        if ( have_posts() ) : ?>
            <div class="hb-blog-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    if ( $skip_first ) {
                        $skip_first = false;
                        continue;
                    }
                    $rendered++;
                ?>
                    <?php get_template_part( 'template-parts/post-card', null, array( 'variant' => 'standard' ) ); ?>
                <?php endwhile; ?>
            </div>

            <?php
            if ( $rendered > 0 ) {
                hashbox_pagination();
            } else {
                echo '<p class="hb-empty">ยังไม่มีบทความ — กลับมาเร็ว ๆ นี้</p>';
            }
            ?>
        <?php else : ?>
            <p class="hb-empty">ยังไม่มีบทความ — กลับมาเร็ว ๆ นี้</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
