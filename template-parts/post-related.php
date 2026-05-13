<?php
/**
 * Template Part: Related posts
 *
 * @package Hashbox_Studio_V2
 */

$related = hashbox_related_posts( get_the_ID(), 3 );
if ( ! $related->have_posts() ) {
    return;
}
?>
<section class="hb-post-related" aria-labelledby="hb-related-title">
    <div class="hb-container hb-container--md">
        <header class="hb-post-related__header">
            <span class="hb-eyebrow">อ่านต่อ</span>
            <h2 id="hb-related-title" class="hb-post-related__title">บทความที่เกี่ยวข้อง</h2>
        </header>
        <div class="hb-post-related__grid">
            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                <?php get_template_part( 'template-parts/post-card', null, array( 'variant' => 'compact' ) ); ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); ?>
