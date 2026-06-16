<?php
/**
 * One-off generator for the default Open Graph image (1200x630).
 * Brand "Signal" palette from design-system/tokens.css. Latin text
 * only — no Thai webfont is installed on the build box and GD would
 * render tofu. Run: php tools/gen-og-image.php
 */

$W = 1200;
$H = 630;
$im = imagecreatetruecolor( $W, $H );
imageantialias( $im, true );

// --- palette ---------------------------------------------------------
$c = function ( $im, $hex ) {
    return imagecolorallocate(
        $im,
        hexdec( substr( $hex, 0, 2 ) ),
        hexdec( substr( $hex, 2, 2 ) ),
        hexdec( substr( $hex, 4, 2 ) )
    );
};
$bg_top    = array( 0x0B, 0x0B, 0x12 ); // near --hb-bg
$bg_bot    = array( 0x15, 0x15, 0x1E ); // --hb-surface-1
$indigo    = $c( $im, '4F46E5' );       // --hb-accent-blue
$indigo_so = $c( $im, '818CF8' );       // --hb-accent-blue-soft
$white     = $c( $im, 'F4F4F5' );
$muted     = $c( $im, 'A1A1AA' );
$faint     = $c( $im, '52525B' );

// --- vertical gradient background -----------------------------------
for ( $y = 0; $y < $H; $y++ ) {
    $t = $y / ( $H - 1 );
    $r = (int) round( $bg_top[0] + ( $bg_bot[0] - $bg_top[0] ) * $t );
    $g = (int) round( $bg_top[1] + ( $bg_bot[1] - $bg_top[1] ) * $t );
    $b = (int) round( $bg_top[2] + ( $bg_bot[2] - $bg_top[2] ) * $t );
    $line = imagecolorallocate( $im, $r, $g, $b );
    imageline( $im, 0, $y, $W, $y, $line );
}

// --- soft indigo glow, top-left (layered translucent ellipses) ------
for ( $i = 18; $i > 0; $i-- ) {
    $alpha = 118 - $i * 6; // fade out toward the edge
    if ( $alpha < 0 ) {
        $alpha = 0;
    }
    $glow = imagecolorallocatealpha( $im, 0x4F, 0x46, 0xE5, 127 - (int) ( ( 127 - $alpha ) * 0.18 ) );
    $rad  = $i * 46;
    imagefilledellipse( $im, 150, 90, $rad, $rad, $glow );
}

// --- accent rule -----------------------------------------------------
imagefilledrectangle( $im, 90, 250, 90 + 64, 250 + 6, $indigo );

// --- type ------------------------------------------------------------
$bold = '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf';
$reg  = '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf';

// eyebrow
imagettftext( $im, 20, 0, 92, 232, $indigo_so, $bold, 'HASHBOX.CO.TH' );

// headline (two lines)
imagettftext( $im, 64, 0, 88, 360, $white, $bold, 'Hashbox Studio' );
imagettftext( $im, 34, 0, 90, 430, $muted, $reg, 'Web  ·  SEO  ·  AI  for Thai Business' );

// supporting line
imagettftext( $im, 24, 0, 90, 510, $muted, $reg, 'Production-grade websites, technical SEO & AI workforce.' );

// footer tag
imagettftext( $im, 18, 0, 90, 575, $faint, $reg, 'Bangkok, Thailand' );

// --- save ------------------------------------------------------------
$out = dirname( __DIR__ ) . '/assets/og-default.jpg';
imagejpeg( $im, $out, 90 );
imagedestroy( $im );

echo 'wrote ' . $out . ' (' . filesize( $out ) . " bytes)\n";
$info = getimagesize( $out );
echo 'dimensions ' . $info[0] . 'x' . $info[1] . "\n";
