<?php
/**
 * Template Part: Breadcrumbs (visible nav)
 *
 * JSON-LD is emitted separately in functions.php.
 *
 * @package Hashbox_Studio_V2
 */

$crumbs = array( array( 'name' => 'Home', 'url' => home_url( '/' ) ) );

if ( hashbox_is_article_view() ) {
    // Posts point at the service page they support (inc/post-service-hub.php) — silo
    // instead of /category/ URLs. Article-layout pages and unmapped posts keep Blog / category.
    $hub = hashbox_post_service_hub();
    if ( $hub ) {
        $crumbs[] = array( 'name' => $hub['name'], 'url' => $hub['url'] );
    } else {
        $crumbs[] = array( 'name' => hashbox_article_strings()['crumb_blog'], 'url' => home_url( '/blog/' ) );
        $cats = get_the_category();
        if ( ! empty( $cats ) ) {
            $crumbs[] = array( 'name' => $cats[0]->name, 'url' => get_category_link( $cats[0]->term_id ) );
        }
    }
    $crumbs[] = array( 'name' => get_the_title(), 'url' => '' );
} elseif ( is_category() ) {
    $crumbs[] = array( 'name' => 'Blog', 'url' => home_url( '/blog/' ) );
    $crumbs[] = array( 'name' => single_cat_title( '', false ), 'url' => '' );
} elseif ( is_tag() ) {
    $crumbs[] = array( 'name' => 'Blog', 'url' => home_url( '/blog/' ) );
    $crumbs[] = array( 'name' => '#' . single_tag_title( '', false ), 'url' => '' );
} elseif ( is_home() ) {
    $crumbs[] = array( 'name' => 'Blog', 'url' => '' );
} elseif ( is_search() ) {
    $crumbs[] = array( 'name' => 'Search: ' . esc_html( get_search_query() ), 'url' => '' );
} elseif ( is_author() ) {
    // Not get_the_archive_title(): it wraps the name in <span class="vcard">,
    // which esc_html below prints as text.
    $author_id = (int) get_queried_object_id();
    $crumbs[]  = array( 'name' => 'Blog', 'url' => home_url( '/blog/' ) );
    $crumbs[]  = array( 'name' => 1 === $author_id ? hashbox_founder_name() : get_the_author_meta( 'display_name', $author_id ), 'url' => '' );
} elseif ( is_archive() ) {
    $crumbs[] = array( 'name' => get_the_archive_title(), 'url' => '' );
}
?>
<nav class="hb-breadcrumb" aria-label="Breadcrumb">
    <ol class="hb-breadcrumb__list">
        <?php foreach ( $crumbs as $i => $c ) : ?>
            <li>
                <?php if ( ! empty( $c['url'] ) && $i < count( $crumbs ) - 1 ) : ?>
                    <a href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['name'] ); ?></a>
                <?php else : ?>
                    <span aria-current="page"><?php echo esc_html( $c['name'] ); ?></span>
                <?php endif; ?>
            </li>
            <?php if ( $i < count( $crumbs ) - 1 ) : ?>
                <li aria-hidden="true"><span class="hb-breadcrumb__sep">/</span></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
