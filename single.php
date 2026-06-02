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
                    'decoding'      => 'async',
                    'sizes'         => '(max-width: 768px) 100vw, 960px',
                ) ); ?>
            </figure>
        <?php endif; ?>
    </header>

    <div class="hb-post__body">
        <div class="hb-container hb-container--md hb-post__layout">
            <aside class="hb-post__sidebar">
                <?php get_template_part( 'template-parts/post-toc' ); ?>
                <?php get_template_part( 'template-parts/post-share' ); ?>

                <div class="hb-post-service" style="margin-top:var(--hb-space-6);padding:var(--hb-space-5);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);border-left:3px solid var(--hb-accent-blue,#2563EB);">
                    <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">Featured Service</span>
                    <h3 style="margin-top:var(--hb-space-2);font-size:var(--hb-text-base);font-weight:600;">รับทำเว็บไซต์ SEO-Ready</h3>
                    <p style="margin-top:var(--hb-space-2);font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);">Build Gate 12 ข้อ · Lighthouse 100 · Schema ครบ · ติด Google ตั้งแต่ launch</p>
                    <a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>" style="display:inline-block;margin-top:var(--hb-space-3);font-size:var(--hb-text-sm);color:var(--hb-accent-blue,#2563EB);font-weight:600;">ดูบริการ →</a>
                </div>
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
                    <p class="hb-post__cta-text">ดู<a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>">บริการรับทำเว็บไซต์ SEO-Ready</a> ของ Hashbox — Build Gate 12 ข้อ, Lighthouse 100, Schema ครบ ติด Google ตั้งแต่วันเปิดตัว · หรือรับ Audit ฟรี 15-20 หน้า</p>
                    <div style="display:flex;gap:var(--hb-space-3);flex-wrap:wrap;">
                        <a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>" class="hb-btn hb-btn--gradient">ดูบริการ SEO-Ready &rarr;</a>
                        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--outline">รับ Audit ฟรี</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part( 'template-parts/post-related' ); ?>

</article>

<?php endwhile; ?>

<?php
get_footer();
