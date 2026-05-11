<?php
/**
 * Main Template File
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * The front page is handled by front-page.php.
 *
 * @package Hashbox_Studio
 */

get_header();
?>

<div class="container section-padding">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <p><?php esc_html_e( 'No content found.', 'hashbox-studio' ); ?></p>
        <?php
    endif;
    ?>
</div>

<?php
get_footer();
