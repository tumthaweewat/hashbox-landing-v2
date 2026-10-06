<?php
/**
 * Offline contract for the founder avatar (2026-10-07). Post bylines called
 * get_avatar() for user 1 and got Gravatar's default silhouette on every post.
 */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
function get_template_directory_uri() { return 'https://example.test/wp-content/themes/hashbox'; }
function avatar_expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
class WP_User { public $ID; public function __construct( $id ) { $this->ID = $id; } }
class WP_Post { public $post_author; public function __construct( $author ) { $this->post_author = $author; } }
class WP_Comment { public $user_id; public function __construct( $user ) { $this->user_id = $user; } }
require __DIR__ . '/../inc/founder.php';

$photo = 'https://example.test/wp-content/themes/hashbox' . hashbox_founder_avatar_path();
foreach ( array( 1, '1', new WP_User( 1 ), new WP_Post( '1' ), new WP_Comment( '1' ) ) as $who ) {
    $data = hashbox_founder_avatar_data( array( 'size' => 40, 'url' => 'gravatar' ), $who );
    avatar_expect( $photo === $data['url'], 'Founder avatar must be the theme photo for ' . gettype( $who ) );
    avatar_expect( true === $data['found_avatar'], 'Founder avatar must count as found' );
    avatar_expect( 40 === $data['size'], 'Other avatar args must pass through' );
}
foreach ( array( 2, 'someone@example.com', new WP_User( 2 ), new WP_Post( 3 ), null ) as $who ) {
    $data = hashbox_founder_avatar_data( array( 'url' => 'gravatar' ), $who );
    avatar_expect( 'gravatar' === $data['url'], 'Other users keep Gravatar' );
}
$file = __DIR__ . '/..' . hashbox_founder_avatar_path();
avatar_expect( is_file( $file ), 'Avatar file missing' );
$size = getimagesize( $file );
avatar_expect( $size[0] === $size[1] && $size[0] >= 80 && $size[0] <= 240, 'Avatar must be a small square (80–240px)' );
avatar_expect( filesize( $file ) < 20000, 'Avatar must stay under 20 KB' );
$functions = file_get_contents( __DIR__ . '/../functions.php' );
avatar_expect( false !== strpos( $functions, "add_filter( 'pre_get_avatar_data', 'hashbox_founder_avatar_data', 10, 2 );" ), 'Filter must be registered' );
echo "Founder avatar: theme photo for user 1 in every id form, Gravatar for others, small square file, filter registered.\n";

// LinkedIn (2026-10-07: profile moved to /in/tumthanawat/). One source only —
// twelve hardcoded copies drifted when the vanity URL changed.
avatar_expect( 'https://www.linkedin.com/in/tumthanawat/' === hashbox_founder_linkedin(), 'Founder LinkedIn URL' );
$root = realpath( __DIR__ . '/..' );
foreach ( explode( "\n", trim( shell_exec( 'git -C ' . escapeshellarg( $root ) . ' ls-files "*.php"' ) ) ) as $file ) {
    if ( 'inc/founder.php' === $file || 0 === strpos( $file, 'tools/' ) ) {
        continue;
    }
    avatar_expect( false === strpos( file_get_contents( $root . '/' . $file ), 'linkedin.com/in/tum' ), "$file hardcodes the founder's LinkedIn URL — use hashbox_founder_linkedin()" );
}
echo "Founder LinkedIn: single source in inc/founder.php.\n";
