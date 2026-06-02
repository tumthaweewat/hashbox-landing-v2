<?php
/**
 * Single post template — long-form editorial reading layout.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
$cats           = get_the_category();
$primary        = ! empty( $cats ) ? $cats[0] : null;
$reading_min    = hashbox_reading_time();
$content_html   = apply_filters( 'the_content', get_the_content() );
$content_html   = preg_replace( '/<h1\b[^>]*>.*?<\/h1>/is', '', $content_html, 1 );
$brief_items    = array(
    array( 'label' => 'หมวดหมู่', 'value' => $primary ? $primary->name : 'Insight' ),
    array( 'label' => 'เวลาอ่าน', 'value' => (int) $reading_min . ' min read' ),
    array( 'label' => 'อัปเดต', 'value' => get_the_modified_date( 'j M Y' ) ),
);
$brief_metrics  = array( 'อ่านง่าย', 'เช็กลิสต์', 'ลงมือทำ' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hb-post' ); ?>>

    <header class="hb-post__hero">
        <div class="hb-container hb-container--lg">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

            <div class="hb-post__hero-grid">
                <div class="hb-post__intro">
                    <?php if ( $primary ) : ?>
                        <a class="hb-post__cat" href="<?php echo esc_url( get_category_link( $primary->term_id ) ); ?>">
                            <?php echo esc_html( $primary->name ); ?>
                        </a>
                    <?php endif; ?>

                    <h1 class="hb-post__title"><?php the_title(); ?></h1>

                    <?php if ( has_excerpt() ) : ?>
                        <p class="hb-post__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <?php endif; ?>

                    <?php get_template_part( 'template-parts/post-meta' ); ?>

                    <div class="hb-post__hero-actions" aria-label="Article actions">
                        <a class="hb-btn hb-btn--gradient" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">ปรึกษาโปรเจกต์ฟรี</a>
                        <a class="hb-btn hb-btn--outline" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">ดูบริการทั้งหมด</a>
                    </div>
                </div>

                <aside class="hb-post-brief" aria-label="Article summary">
                    <span class="hb-post-brief__eyebrow">Quick Scan</span>
                    <h2 class="hb-post-brief__title">สรุปบทความ</h2>
                    <dl class="hb-post-brief__list">
                        <?php foreach ( $brief_items as $brief_item ) : ?>
                            <div>
                                <dt><?php echo esc_html( $brief_item['label'] ); ?></dt>
                                <dd><?php echo esc_html( $brief_item['value'] ); ?></dd>
                            </div>
                        <?php endforeach; ?>
                    </dl>
                    <div class="hb-post-brief__metrics" aria-label="Article focus areas">
                        <?php foreach ( $brief_metrics as $brief_metric ) : ?>
                            <span><?php echo esc_html( $brief_metric ); ?></span>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <figure class="hb-post__featured hb-container hb-container--lg">
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
        <div class="hb-container hb-container--lg hb-post__layout">
            <aside class="hb-post__sidebar">
                <?php get_template_part( 'template-parts/post-toc' ); ?>
                <?php get_template_part( 'template-parts/post-share' ); ?>

                <div class="hb-post-service">
                    <span class="hb-post-service__eyebrow">Work with Hashbox</span>
                    <h3 class="hb-post-service__title">Web, Marketing และ AI ในทีมเดียว</h3>
                    <p class="hb-post-service__text">ให้ทีมช่วย audit เว็บไซต์ จัดลำดับงานที่ควรทำก่อน และวาง roadmap ที่วัดผลได้จริง</p>
                    <a class="hb-post-service__link" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">ดูบริการ &rarr;</a>
                </div>
            </aside>

            <div class="hb-post__content hb-prose">
                <div class="hb-post-article-shell">
                    <?php echo $content_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </div>

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
                    <h2 class="hb-post__cta-title">อยากให้ทีมช่วยดูโจทย์นี้ต่อ?</h2>
                    <p class="hb-post__cta-text">ส่งเว็บไซต์หรือ brief ที่กำลังทำอยู่ให้ Hashbox ช่วย audit เบื้องต้น เราจะช่วยชี้จุดที่ควรแก้ก่อน ทั้งด้านเว็บไซต์ SEO, conversion, tracking และ AI workflow</p>
                    <div class="hb-post__cta-actions">
                        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient">รับคำแนะนำฟรี &rarr;</a>
                        <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="hb-btn hb-btn--outline">ดูบริการทั้งหมด</a>
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
