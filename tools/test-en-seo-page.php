<?php
/** Offline render/route/schema contract; no WordPress writes or real submissions. */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
$seo_template = true;
$seo_schemas = array();
$seo_enqueues = array();
function home_url( $path = '/' ) { return 'https://hashbox.example' . $path; }
function admin_url( $path = '' ) { return home_url( '/wp-admin/' . $path ); }
function esc_html( $value ) { return htmlspecialchars( (string) $value, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $value ) { return esc_html( $value ); }
function esc_url( $value ) { return esc_html( $value ); }
function get_template_directory() { return dirname( __DIR__ ); }
function get_template_directory_uri() { return '/wp-content/themes/hashbox-studio-v2'; }
function is_page_template( $template ) { return $GLOBALS['seo_template'] && 'page-en-seo.php' === $template; }
function add_action( ...$args ) {}
function wp_enqueue_style( ...$args ) { $GLOBALS['seo_enqueues'][] = $args; }
function wp_enqueue_script( ...$args ) { $GLOBALS['seo_enqueues'][] = $args; }
function hashbox_en_seo_contact_result() { return array( 'status' => '' ); }
function hashbox_en_seo_contact_url() { return home_url( '/en/seo/#seo-contact' ); }
function wp_nonce_field( ...$args ) { echo '<input type="hidden" name="hashbox_nonce" value="offline-test-only">'; }
function get_header() { echo '<!doctype html><html lang="en"><head><meta charset="utf-8"></head><body><main>'; }
function get_footer() { echo '</main></body></html>'; }
function get_template_part( $name ) { require get_template_directory() . '/' . $name . '.php'; }
function hashbox_jsonld( $value ) { $GLOBALS['seo_schemas'][] = $value; }
function seo_expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
require get_template_directory() . '/inc/en-seo-icons.php';
require get_template_directory() . '/inc/en-seo-page.php';
ob_start();
require get_template_directory() . '/page-en-seo.php';
$html = ob_get_clean();
libxml_use_internal_errors( true );
$doc = new DOMDocument();
$doc->loadHTML( $html );
$xpath = new DOMXPath( $doc );
seo_expect( 1 === $xpath->query( '//h1' )->length, 'Exactly one h1.' );
seo_expect( 8 === $xpath->query( '//*[contains(@class,"en-seo-scope__item")]' )->length, 'All eight scope items retained.' );
seo_expect( 8 === $xpath->query( '//*[contains(@class,"en-seo-measures")]/li' )->length, 'All eight KPIs retained.' );
seo_expect( 1 === $xpath->query( '//form[@id="en-seo-contact-form"]' )->length, 'English contact form included.' );
$audit_ctas = $xpath->query( '//a[@href="#seo-contact" and contains(concat(" ", normalize-space(@class), " "), " en-seo-button ")]' );
seo_expect( 2 === $audit_ctas->length, 'Hero and pricing retain their primary audit CTAs.' );
foreach ( $audit_ctas as $cta ) {
    seo_expect( 'Get a free SEO audit' === trim( $cta->textContent ), 'Primary CTA copy must match the audit form, not promise a quote.' );
}
$submit_label = $xpath->query( '//form[@id="en-seo-contact-form"]//button[@data-en-seo-submit]/span' );
seo_expect( 1 === $submit_label->length && 'Get a free SEO audit' === trim( $submit_label->item( 0 )->textContent ), 'Submit label keeps the same free SEO audit promise.' );
$ids = array();
foreach ( $xpath->query( '//*[@id]' ) as $element ) {
    $id = $element->getAttribute( 'id' );
    seo_expect( ! isset( $ids[ $id ] ), 'Duplicate ID: ' . $id );
    $ids[ $id ] = true;
}
foreach ( $xpath->query( '//a[@href]' ) as $link ) {
    $href = $link->getAttribute( 'href' );
    if ( 0 === strpos( $href, '#' ) ) seo_expect( isset( $ids[ substr( $href, 1 ) ] ), 'Missing anchor: ' . $href );
    seo_expect( ! preg_match( '~/(seo-audit/|#contact)$~', $href ), 'CTA must not return to Thai intake.' );
}
foreach ( $xpath->query( '//img' ) as $image ) {
    seo_expect( '' !== $image->getAttribute( 'alt' ), 'Meaningful image alt.' );
    $file = str_replace( get_template_directory_uri(), get_template_directory(), $image->getAttribute( 'src' ) );
    $size = getimagesize( $file );
    $ratio = (int) $image->getAttribute( 'width' ) / (int) $image->getAttribute( 'height' );
    seo_expect( abs( $ratio - $size[0] / $size[1] ) < .01, 'Image aspect ratio must match source.' );
}
foreach ( $xpath->query( '//input[@required]|//textarea[@required]' ) as $input ) {
    seo_expect( 1 === $xpath->query( '//label[@for="' . $input->getAttribute( 'id' ) . '"]' )->length, 'Required field needs a visible label.' );
}
foreach ( $xpath->query( '//svg' ) as $svg ) seo_expect( 'true' === $svg->getAttribute( 'aria-hidden' ), 'Decorative SVGs hidden from assistive technology.' );
seo_expect( 3 === count( $seo_schemas ), 'Service, breadcrumb and FAQ schemas retained.' );
seo_expect( home_url( '/en/' ) === $seo_schemas[1]['itemListElement'][0]['item'], 'Breadcrumb schema matches English visible routing.' );
seo_expect( 2 === count( $seo_schemas[1]['itemListElement'] ), 'Visible and structured breadcrumbs have the same two levels.' );
seo_expect( 29900 === $seo_schemas[0]['offers']['priceSpecification']['minPrice'], 'Published price unchanged.' );
$questions = $xpath->query( '//*[contains(@class,"en-seo-faq__item")]/summary/span' );
$answers = $xpath->query( '//*[contains(@class,"en-seo-faq__item")]/div/p' );
seo_expect( count( $seo_schemas[2]['mainEntity'] ) === $questions->length, 'Visible and structured FAQ counts match.' );
foreach ( $seo_schemas[2]['mainEntity'] as $index => $faq ) {
    seo_expect( $faq['name'] === $questions->item( $index )->textContent, 'FAQ question parity.' );
    seo_expect( $faq['acceptedAnswer']['text'] === $answers->item( $index )->textContent, 'FAQ answer parity.' );
}
seo_expect( home_url( '/en/seo/#seo-contact' ) === hashbox_en_seo_nav_url( '/#contact' ), 'English contact routing.' );
seo_expect( home_url( '/en/ai-search/' ) === hashbox_en_seo_nav_url( '/services/ai-search/' ), 'English service routing.' );
hashbox_enqueue_en_seo_assets();
seo_expect( 3 === count( $seo_enqueues ), 'Page CSS, tokens and contact JS loaded.' );
seo_expect( array( 'hashbox-heading-ci' ) === $seo_enqueues[0][2], 'V3 styles after shared heading fixes.' );
$seo_template = false;
$seo_enqueues = array();
hashbox_enqueue_en_seo_assets();
seo_expect( array() === $seo_enqueues, 'No assets loaded on unrelated pages.' );
seo_expect( home_url( '/#contact' ) === hashbox_en_seo_nav_url( '/#contact' ), 'Other page navigation unchanged.' );
echo "EN SEO page: rendered content, anchors, labels, images, schema and page isolation passed.\n";
