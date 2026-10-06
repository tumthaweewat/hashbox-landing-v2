<?php
/**
 * Generic page template (fallback for any WP page without specific template).
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<article class="hb-section">
    <div class="hb-container hb-container--md">

        <nav class="hb-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: var(--hb-space-6);">
            <ol class="hb-breadcrumb__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <?php
        // One H1 per page: landing pages built in the editor carry their own
        // (e.g. /website-audit/), so the title steps down to a styled <p>.
        $hb_title_tag = false !== stripos( (string) get_post_field( 'post_content', get_the_ID() ), '<h1' ) ? 'p' : 'h1';
        ?>
        <header style="margin-bottom: var(--hb-space-8);">
            <<?php echo $hb_title_tag; ?> class="hb-h1"><?php the_title(); ?></<?php echo $hb_title_tag; ?>>
        </header>

        <div class="hb-prose">
            <?php the_content(); ?>
        </div>

    </div>
</article>

<?php endwhile; ?>

<?php
get_footer();
