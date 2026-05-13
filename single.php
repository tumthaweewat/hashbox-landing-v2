<?php
/**
 * Single post template — long-form editorial reading layout.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hb-post' ); ?>>

    <header class="hb-post__hero">
        <div class="hb-container hb-container--md">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

            <?php
            $cats = get_the_category();
            if ( ! empty( $cats ) ) :
                $primary = $cats[0];
            ?>
                <a class="hb-post__cat" href="<?php echo esc_url( get_category_link( $primary->term_id ) ); ?>">
                    <?php echo esc_html( $primary->name ); ?>
                </a>
            <?php endif; ?>

            <h1 class="hb-post__title"><?php the_title(); ?></h1>

            <?php if ( has_excerpt() ) : ?>
                <p class="hb-post__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>

            <?php get_template_part( 'template-parts/post-meta' ); ?>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="hb-post__featured">
                <?php the_post_thumbnail( 'full', array(
                    'class'         => 'hb-post__featured-img',
                    'loading'       => 'eager',
                    'fetchpriority' => 'high',
                ) ); ?>
            </figure>
        <?php endif; ?>
    </header>

    <div class="hb-post__body">
        <div class="hb-container hb-container--md hb-post__layout">
            <aside class="hb-post__sidebar">
                <?php get_template_part( 'template-parts/post-toc' ); ?>
                <?php get_template_part( 'template-parts/post-share' ); ?>
            </aside>

            <div class="hb-post__content hb-prose">
                <?php the_content(); ?>

                <?php
                $tags = get_the_tags();
                if ( $tags ) : ?>
                    <div class="hb-post__tags" aria-label="Tags">
                        <?php foreach ( $tags as $tag ) : ?>
                            <a class="hb-post__tag" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="hb-post__cta">
                    <h2 class="hb-post__cta-title">พร้อมยกระดับเว็บไซต์คุณ?</h2>
                    <p class="hb-post__cta-text">รับ Audit ฟรีจากทีม Hashbox — เราจะหา 5 จุดที่ปรับได้ทันทีเพื่อ Speed, SEO และ Conversion</p>
                    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient">รับ Audit ฟรี &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part( 'template-parts/post-related' ); ?>

</article>

<?php endwhile; ?>

<?php
get_footer();
