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

        <header style="margin-bottom: var(--hb-space-8);">
            <h1 class="hb-h1"><?php the_title(); ?></h1>
        </header>

        <div class="hb-prose">
            <?php the_content(); ?>
        </div>

    </div>
</article>

<?php endwhile; ?>

<?php
get_footer();
