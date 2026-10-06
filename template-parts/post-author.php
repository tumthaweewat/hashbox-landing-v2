<?php
/**
 * Template Part: author box under founder posts (2026-10-07).
 *
 * Photo, two-line name, one-line bio, links to /about/ and LinkedIn. /about/
 * is the page AI answers cite for the company (39 citations in 30 days) and
 * no post linked to it; the byline links to the author archive, which is
 * noindex.
 *
 * @package Hashbox_Studio_V2
 */

if ( 1 !== (int) get_the_author_meta( 'ID' ) ) {
    return;
}
$t = hashbox_article_strings();
?>
<aside class="hb-post-author" aria-label="<?php echo esc_attr( $t['author_kicker'] ); ?>">
    <img class="hb-post-author__photo" src="<?php echo esc_url( get_template_directory_uri() . hashbox_founder_avatar_path() ); ?>" alt="<?php echo esc_attr( hashbox_founder_name() . ' · ' . hashbox_founder_name_th() ); ?>" width="80" height="80" loading="lazy" decoding="async">
    <div class="hb-post-author__body">
        <span class="hb-post-author__kicker"><?php echo esc_html( $t['author_kicker'] ); ?></span>
        <p class="hb-post-author__name"><a href="<?php echo esc_url( get_author_posts_url( 1 ) ); ?>" rel="author"><?php echo esc_html( hashbox_founder_name() ); ?></a><span lang="th"><?php echo esc_html( hashbox_founder_name_th() ); ?></span></p>
        <p class="hb-post-author__bio"><?php echo esc_html( $t['author_bio'] . ' · ' . hashbox_founder_partner_networks() ); ?></p>
        <p class="hb-post-author__links">
            <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php echo esc_html( $t['author_about'] ); ?> &rarr;</a>
            <a href="<?php echo esc_url( hashbox_founder_linkedin() ); ?>" target="_blank" rel="me noopener noreferrer">LinkedIn &rarr;</a>
        </p>
    </div>
</aside>
