<?php
/**
 * Template: Front Page
 *
 * The main landing page for Hashbox Studio.
 * Renders all 8 sections via template parts.
 *
 * @package Hashbox_Studio
 */

get_header();
?>

<?php get_template_part( 'template-parts/hero' ); ?>
<?php get_template_part( 'template-parts/services' ); ?>
<?php get_template_part( 'template-parts/why-hashbox' ); ?>
<?php get_template_part( 'template-parts/digital-workforce' ); ?>
<?php get_template_part( 'template-parts/portfolio' ); ?>
<?php get_template_part( 'template-parts/about' ); ?>
<?php get_template_part( 'template-parts/faq' ); ?>
<?php get_template_part( 'template-parts/insights' ); ?>
<?php get_template_part( 'template-parts/contact' ); ?>

<?php
get_footer();
