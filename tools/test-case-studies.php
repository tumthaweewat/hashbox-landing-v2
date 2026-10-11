<?php
/**
 * Offline contract for the named case studies (/work/paolo-auto-car/, /work/banktabien/ · 2026-10-11).
 *
 * These are the first case pages with real client names, so the test guards three things:
 * 1. E-E-A-T structure — answer-first summary, facts table, a named author (the founder node),
 *    real dates, every number carries its source, FAQ = FAQPage from the same array.
 * 2. The owner's publishing rules per client (Paolo: no location, legal name, prices or document
 *    numbers; Phase 2 is "being delivered", never live — see ~/hashbox-ai-stock/docs/phase2-delivery-status.md).
 * 3. The publication gate — merging the theme must not put these pages live. They appear only when
 *    the WP page under /work/ is published, so they must stay out of hashbox_case_study_slugs()
 *    (that list has a 404 → template fallback that would serve them without a page).
 *
 * Set CASE_PREVIEW_DIR to also write the rendered HTML (for screenshots at 1280 and 390 px).
 */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
define( 'OBJECT', 'OBJECT' );
function expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
function add_action( ...$args ) {}
function esc_html( $value ) { return htmlspecialchars( (string) $value, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $value ) { return esc_html( $value ); }
function esc_url( $value ) { return esc_html( $value ); }
function home_url( $path = '/' ) { return 'https://hashbox.example' . $path; }
function get_template_directory() { return dirname( __DIR__ ); }
function get_template_directory_uri() { return '/theme'; }
function get_permalink() { return home_url( '/work/' . $GLOBALS['render_slug'] . '/' ); }
function is_page_template( $t = '' ) { return false; }
function hashbox_jsonld( $value ) { $GLOBALS['schemas'][] = $value; }
function get_page_by_path( $path, $output = null, $type = 'page' ) { return $GLOBALS['wp_pages'][ $path ] ?? null; }
function get_header() {
    echo '<!doctype html><html lang="th"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    foreach ( array( 'design-system/bundle.min.css', 'design-system/fonts.css', 'style.css', 'css/heading-ci.css', 'css/case-study.css' ) as $css ) {
        echo '<link rel="stylesheet" href="' . ( getenv( 'CASE_PREVIEW_DIR' ) ? 'file://' . get_template_directory() . '/' : '/theme/' ) . $css . '">';
    }
    echo '</head><body><main>';
}
function get_footer() { echo '</main></body></html>'; }

require get_template_directory() . '/inc/founder.php';
require get_template_directory() . '/inc/case-studies.php';

function render_template( $file ) {
    $GLOBALS['schemas'] = array();
    ob_start();
    require get_template_directory() . '/' . $file;
    return ob_get_clean();
}
function schema_of_type( $type ) {
    foreach ( $GLOBALS['schemas'] as $s ) {
        if ( isset( $s['@type'] ) && $type === $s['@type'] ) { return $s; }
        foreach ( $s['@graph'] ?? array() as $node ) {
            if ( isset( $node['@type'] ) && $type === $node['@type'] ) { return $node; }
        }
    }
    return null;
}

$founder_id = home_url( '/#founder' );
$cases      = hashbox_case_studies();
expect( array( 'paolo-auto-car', 'banktabien' ) === array_keys( $cases ), 'Two named case studies, Paolo first.' );

foreach ( $cases as $slug => $case ) {
    $GLOBALS['render_slug'] = $slug;
    $html = render_template( 'page-work-' . $slug . '.php' );
    if ( getenv( 'CASE_PREVIEW_DIR' ) ) {
        file_put_contents( rtrim( getenv( 'CASE_PREVIEW_DIR' ), '/' ) . '/' . $slug . '.html', $html );
    }
    $dom = new DOMDocument();
    @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $html );
    $x    = new DOMXPath( $dom );
    $text = $dom->textContent;

    // 1. structure
    expect( 1 === $x->query( '//h1' )->length, "$slug: one H1." );
    expect( false !== strpos( $x->query( '//h1' )->item( 0 )->textContent, $case['client']['name'] ), "$slug: H1 names the client." );
    $answer = $x->query( '//*[contains(@class,"hb-case2__answer")]' );
    expect( 1 === $answer->length, "$slug: one answer-first summary." );
    $answer_len = mb_strlen( trim( $answer->item( 0 )->textContent ) );
    expect( $answer_len >= 150 && $answer_len <= 650, "$slug: summary is 150–650 characters (got $answer_len)." );
    $fact_rows = $x->query( '//table[contains(@class,"hb-case2__facts")]//tr[th[@scope="row"]]' );
    expect( $fact_rows->length >= 6, "$slug: facts table has at least 6 labelled rows." );
    expect( $x->query( '//h2' )->length >= 5, "$slug: at least five H2 sections." );

    // byline: a person, not "the team"
    $byline = $x->query( '//*[contains(@class,"hb-case2__byline")]' );
    expect( 1 === $byline->length, "$slug: one byline." );
    expect( false !== strpos( $byline->item( 0 )->textContent, hashbox_founder_name() ), "$slug: byline names the founder." );
    expect( 1 === $x->query( '//*[contains(@class,"hb-case2__byline")]//a[@href="' . home_url( '/about/' ) . '"]' )->length, "$slug: byline links to /about/." );
    expect( 2 === $x->query( '//*[contains(@class,"hb-case2__byline")]//time[@datetime]' )->length, "$slug: published and updated dates are <time>." );

    // every number has a source
    $result_rows = $x->query( '//table[contains(@class,"hb-case2__results")]/tbody/tr' );
    expect( $result_rows->length >= 3, "$slug: at least three results." );
    foreach ( $result_rows as $i => $row ) {
        $cells = $x->query( './th|./td', $row );
        expect( 3 === $cells->length && '' !== trim( $cells->item( 2 )->textContent ), "$slug: result $i has a source." );
    }
    foreach ( $case['results'] as $r ) {
        expect( ! empty( $r['source'] ) && ! empty( $r['value'] ) && ! empty( $r['label'] ), "$slug: result data is complete." );
    }

    // experience: lessons, and the status table says plainly what is live
    expect( count( $case['lessons'] ) >= 3, "$slug: at least three lessons learned." );
    foreach ( $case['status'] as $row ) {
        expect( in_array( $row['kind'], array( 'live', 'delivery', 'done' ), true ), "$slug: status kind {$row['kind']} is known." );
    }

    // FAQ = FAQPage, same text
    $faq = $x->query( '//details[contains(@class,"hb-case2__faq-item")]' );
    expect( $faq->length >= 4 && $faq->length <= 6, "$slug: 4–6 FAQ items." );
    $faq_schema = schema_of_type( 'FAQPage' );
    expect( null !== $faq_schema && count( $faq_schema['mainEntity'] ) === $faq->length, "$slug: FAQPage mirrors the visible FAQ." );
    foreach ( $case['faq'] as $i => $f ) {
        expect( $faq_schema['mainEntity'][ $i ]['name'] === $f['q'] && $faq_schema['mainEntity'][ $i ]['acceptedAnswer']['text'] === $f['a'], "$slug: FAQ $i text matches schema." );
        expect( false !== strpos( $faq->item( $i )->textContent, $f['q'] ), "$slug: FAQ $i is visible." );
    }

    // Article: a named author, real dates, the client as subject
    $article = schema_of_type( 'Article' );
    expect( null !== $article, "$slug: Article schema." );
    expect( $founder_id === $article['author']['@id'], "$slug: Article author is the founder node." );
    expect( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $article['datePublished'] ) && '-01-01' !== substr( $article['datePublished'], -6 ), "$slug: datePublished is a real day." );
    expect( $article['dateModified'] >= $article['datePublished'], "$slug: dateModified is not before datePublished." );
    expect( 'th-TH' === $article['inLanguage'], "$slug: Thai." );
    expect( 'Organization' === $article['about']['@type'] && $case['client']['name'] === $article['about']['name'], "$slug: Article is about the client." );
    expect( home_url( '/work/' . $slug . '/' ) === $article['url'], "$slug: Article url is the /work/ URL." );
    $person = schema_of_type( 'Person' );
    expect( null !== $person && $founder_id === $person['@id'] && hashbox_founder_name() === $person['name'], "$slug: Person node for the founder." );
    expect( in_array( hashbox_founder_linkedin(), $person['sameAs'], true ), "$slug: Person sameAs LinkedIn." );
    $crumbs = schema_of_type( 'BreadcrumbList' );
    expect( 3 === count( $crumbs['itemListElement'] ) && home_url( '/work/' . $slug . '/' ) === $crumbs['itemListElement'][2]['item'], "$slug: breadcrumb Home › Work › case." );

    // design rules (2026-08-29): no inline type, no unnamed testimonial
    expect( false === stripos( $html, 'font-size' ) && false === stripos( $html, 'font-family' ), "$slug: no inline font styles." );
    expect( 0 === $x->query( '//*[contains(@class,"hb-quote")]' )->length, "$slug: no testimonial block — the client has not written one." );
    // one primary CTA
    expect( 1 === $x->query( '//a[contains(@class,"hb-btn")]' )->length, "$slug: one button CTA." );
}

// 2. per-client publishing rules
$paolo = render_template( 'page-work-paolo-auto-car.php' );
foreach ( array( 'สุราษฎร์', 'Surat', 'เปาโลยานยนต์', 'บริษัท เปาโล', 'QT-', '฿', 'บาท', 'PL2026', 'PL2025' ) as $banned ) {
    expect( false === strpos( $paolo, $banned ), "paolo: must not contain \"$banned\" (owner rule: name only, no location, legal name, price or document numbers)." );
}
foreach ( $cases['paolo-auto-car']['status'] as $row ) {
    if ( 0 === strpos( $row['module'], 'Phase 2' ) ) {
        expect( 'delivery' === $row['kind'], "paolo: {$row['module']} is not live yet (phase2-delivery-status.md)." );
        expect( false === strpos( $row['state'], 'ใช้งานจริง' ), "paolo: {$row['module']} must not say ใช้งานจริง." );
    }
}
expect( false !== strpos( $paolo, 'ยังไม่เปิดใช้กับข้อมูลจริง' ), 'paolo: Phase 2 wording from the owner rule.' );

$bank = render_template( 'page-work-banktabien.php' );
foreach ( array( '฿', 'บาท' ) as $banned ) {
    expect( false === strpos( $bank, $banned ), "banktabien: must not contain \"$banned\" (no project prices)." );
}
expect( false !== strpos( $bank, 'href="https://banktabien.com/"' ), 'banktabien: links to the live client site.' );
$owner_stat = array_values( array_filter( $cases['banktabien']['results'], function ( $r ) { return false !== strpos( $r['value'], '80%' ); } ) );
expect( 1 === count( $owner_stat ) && false !== strpos( $owner_stat[0]['source'], 'เจ้าของ' ), 'banktabien: the 80% figure is attributed to the owner, not measured by us.' );

// 3. publication gate
$functions = file_get_contents( get_template_directory() . '/functions.php' );
$start     = strpos( $functions, 'function hashbox_case_study_slugs()' );
$slug_list = substr( $functions, $start, strpos( $functions, '}', $start ) - $start );
foreach ( array_keys( $cases ) as $slug ) {
    expect( false === strpos( $slug_list, "'$slug'" ), "$slug must not be in hashbox_case_study_slugs() — its 404 fallback would publish the page without a WP page." );
}

$GLOBALS['render_slug'] = '';
function work_hub_card_slugs() {
    $html = render_template( 'page-work.php' );
    preg_match_all( '#href="https://hashbox\.example/work/([a-z0-9-]+)/" class="hb-case#', $html, $m );
    return $m[1];
}
$GLOBALS['wp_pages'] = array();
expect( 6 === count( work_hub_card_slugs() ), 'Work hub: no new cards while the WP pages do not exist.' );
$GLOBALS['wp_pages'] = array( 'work/paolo-auto-car' => (object) array( 'post_status' => 'draft' ) );
expect( 6 === count( work_hub_card_slugs() ), 'Work hub: a draft page does not get a card.' );
$GLOBALS['wp_pages'] = array(
    'work/paolo-auto-car' => (object) array( 'post_status' => 'publish' ),
    'work/banktabien'     => (object) array( 'post_status' => 'publish' ),
);
$cards = work_hub_card_slugs();
expect( array( 'paolo-auto-car', 'banktabien' ) === array_slice( $cards, 0, 2 ) && 8 === count( $cards ), 'Work hub: published named cases come first.' );

// llms.txt follows the same gate
$GLOBALS['wp_pages'] = array();
expect( array() === hashbox_case_study_llms_lines(), 'llms.txt: no case lines while the pages are unpublished.' );
$GLOBALS['wp_pages'] = array( 'work/banktabien' => (object) array( 'post_status' => 'publish' ) );
$llms = hashbox_case_study_llms_lines();
expect( 1 === count( $llms ) && false !== strpos( $llms[0], home_url( '/work/banktabien/' ) ), 'llms.txt: one line per published case, pointing at /work/<slug>/.' );
$fn = file_get_contents( get_template_directory() . '/functions.php' );
expect( false !== strpos( substr( $fn, strpos( $fn, 'function hashbox_llms_txt_content' ), 4000 ), 'hashbox_case_study_llms_lines()' ), 'llms.txt content includes the case lines.' );
expect( false !== strpos( file_get_contents( get_template_directory() . '/page-wordpress-website.php' ), "hashbox_published_case_studies()['banktabien']" ), 'WordPress service page links the case only once it is published.' );

echo "Case studies: E-E-A-T structure, schema, per-client rules and the publication gate passed.\n";
