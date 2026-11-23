<?php
/** Run with wp eval-file on a local WordPress + Rank Math fixture with /services/ai-search/. */
if ( ! defined( 'WP_CLI' ) || ! defined( 'RANK_MATH_VERSION' ) ) {
    throw new RuntimeException( 'Requires WP-CLI and Rank Math.' );
}
$_SERVER['REQUEST_URI'] = '/services/ai-search/';
global $wp_query;
$wp_query = new WP_Query( array( 'pagename' => 'services/ai-search' ) );
$id = get_queried_object_id();
if ( ! $id || ! is_page( 'ai-search' ) ) {
    throw new RuntimeException( 'Missing AI Search page fixture.' );
}
$expected = hashbox_seo_path_overrides()['services/ai-search']['description'];
foreach ( array( '', 'Old Rank Math description' ) as $stored ) {
    $fixture = static function ( $value, $post_id, $key ) use ( $stored, $id ) {
        return $id === $post_id && 'rank_math_description' === $key ? array( $stored ) : $value;
    };
    add_filter( 'get_post_metadata', $fixture, 10, 3 );
    foreach ( array( 'rank_math/frontend/description', 'rank_math/opengraph/facebook/og_description', 'rank_math/opengraph/twitter/twitter_description' ) as $hook ) {
        if ( $expected !== apply_filters( $hook, $stored ) ) {
            throw new RuntimeException( 'Wrong description for ' . $hook );
        }
    }
    remove_filter( 'get_post_metadata', $fixture, 10 );
}
if ( hashbox_has_forced_seo_override( 'title' ) || hashbox_seo_override_has_field( 'en/ai-search', 'description' ) ) {
    throw new RuntimeException( 'Override must apply only to the Thai description.' );
}
echo "Thai AI Search description passed with and without prior Rank Math metadata.\n";
