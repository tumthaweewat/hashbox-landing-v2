<?php
/**
 * Author archive — bio + posts. Backs the Person schema sameAs URL
 * used in Article structured data.
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$author_id = get_queried_object_id();
if ( ! $author_id && get_query_var( 'author' ) ) {
    $author_id = (int) get_query_var( 'author' );
}
$display = get_the_author_meta( 'display_name', $author_id );
$bio     = get_the_author_meta( 'description', $author_id );
$job     = get_the_author_meta( 'job_title', $author_id );
$linkedin = get_the_author_meta( 'linkedin', $author_id );
$twitter  = get_the_author_meta( 'twitter', $author_id );
$github   = get_the_author_meta( 'github', $author_id );
?>

<section class="hb-blog-hero hb-blog-hero--archive">
    <div class="hb-container hb-container--md">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>

        <div style="display:flex;gap:var(--hb-space-5);align-items:center;flex-wrap:wrap;">
            <?php echo get_avatar( $author_id, 96, '', $display, array( 'class' => 'hb-post-meta__avatar', 'style' => 'border-radius:50%;' ) ); ?>
            <div>
                <span class="hb-eyebrow">ผู้เขียน</span>
                <h1 class="hb-blog-hero__title" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $display ); ?></h1>
                <?php if ( ! empty( $job ) ) : ?>
                    <p class="hb-blog-hero__lede" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $job ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php if ( ! empty( $bio ) ) : ?>
            <p class="hb-blog-hero__lede" style="margin-top:var(--hb-space-6);max-width:640px;"><?php echo esc_html( $bio ); ?></p>
        <?php endif; ?>

        <?php if ( $linkedin || $twitter || $github ) : ?>
            <div class="hb-rail" style="margin-top:var(--hb-space-5);">
                <?php if ( $linkedin ) : ?>
                    <a class="hb-btn hb-btn--outline hb-btn--sm" href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="me noopener noreferrer">LinkedIn</a>
                <?php endif; ?>
                <?php if ( $twitter ) : ?>
                    <a class="hb-btn hb-btn--outline hb-btn--sm" href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="me noopener noreferrer">X</a>
                <?php endif; ?>
                <?php if ( $github ) : ?>
                    <a class="hb-btn hb-btn--outline hb-btn--sm" href="<?php echo esc_url( $github ); ?>" target="_blank" rel="me noopener noreferrer">GitHub</a>
                <?php endif; ?>
            </div>
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
            <p class="hb-empty">ยังไม่มีบทความจากผู้เขียนนี้</p>
        <?php endif; ?>
    </div>
</section>

<?php
// Person + ProfilePage schema so the author's URL is a verifiable entity
// that Article schema can sameAs to. Skip when Rank Math handles schema.
if ( ! hashbox_rank_math_is_active() ) {
    $person = hashbox_author_schema( $author_id );
    hashbox_jsonld( array(
        '@context'  => 'https://schema.org',
        '@type'     => 'ProfilePage',
        '@id'       => get_author_posts_url( $author_id ),
        'mainEntity' => $person,
    ) );
}

get_footer();
