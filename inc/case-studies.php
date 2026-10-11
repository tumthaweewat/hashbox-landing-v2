<?php
/**
 * Named case studies (/work/paolo-auto-car/, /work/banktabien/ · 2026-10-11).
 *
 * The older /work/* pages use hashbox_render_case_study() in functions.php (stat grids, unnamed
 * clients, organisation as author). These pages are built for E-E-A-T and AI answers instead:
 * answer-first summary, a facts table, a named author with real dates, every number with its
 * source, what is live vs still being delivered, lessons learned, and FAQ = FAQPage.
 *
 * Content lives in inc/case-studies/<slug>.php (one array per client). Publishing rules per
 * client are enforced by tools/test-case-studies.php.
 *
 * Publication gate: a page goes live only when its WP page under /work/ is published. Do not add
 * these slugs to hashbox_case_study_slugs() — its 404 fallback would serve the template without a page.
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/** slug => case array, in hub order. */
function hashbox_case_studies() {
    static $cases = null;
    if ( null === $cases ) {
        $cases = array();
        foreach ( array( 'paolo-auto-car', 'banktabien' ) as $slug ) {
            $cases[ $slug ] = require get_template_directory() . '/inc/case-studies/' . $slug . '.php';
        }
    }
    return $cases;
}

function hashbox_case_study( $slug ) {
    $cases = hashbox_case_studies();
    return isset( $cases[ $slug ] ) ? $cases[ $slug ] : null;
}

/** Cases whose WP page is published — the only ones the /work/ hub may link to. */
function hashbox_published_case_studies() {
    $out = array();
    foreach ( hashbox_case_studies() as $slug => $case ) {
        $page = get_page_by_path( 'work/' . $slug, OBJECT, 'page' );
        if ( $page && 'publish' === $page->post_status ) {
            $out[ $slug ] = $case;
        }
    }
    return $out;
}

function hashbox_case_study_templates() {
    return array( 'page-work-paolo-auto-car.php', 'page-work-banktabien.php' );
}

function hashbox_enqueue_case_studies() {
    foreach ( hashbox_case_study_templates() as $template ) {
        if ( is_page_template( $template ) ) {
            $file = get_template_directory() . '/css/case-study.css';
            wp_enqueue_style( 'hashbox-case-study', get_template_directory_uri() . '/css/case-study.css', array( 'hashbox-style' ), filemtime( $file ) );
            return;
        }
    }
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_case_studies', 25 );

/** 2026-10-11 → 11 ต.ค. 2026 (same day-month-year order as the blog bylines). */
function hashbox_case_study_date( $ymd ) {
    $months = array( '', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.' );
    list( $y, $m, $d ) = array_map( 'intval', explode( '-', $ymd ) );
    return $d . ' ' . $months[ $m ] . ' ' . $y;
}

/** JSON-LD nodes for one case: Article (author = founder), Person, BreadcrumbList, FAQPage. */
function hashbox_case_study_schema( array $case ) {
    $url     = home_url( '/work/' . $case['slug'] . '/' );
    $founder = home_url( '/#founder' );
    $about   = array( '@type' => 'Organization', 'name' => $case['client']['name'], 'description' => $case['client']['description'] );
    if ( ! empty( $case['client']['url'] ) ) {
        $about['url'] = $case['client']['url'];
    }
    $article = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        '@id'              => $url . '#article',
        'headline'         => $case['title'],
        'description'      => $case['summary'],
        'url'              => $url,
        'mainEntityOfPage' => $url,
        'datePublished'    => $case['published'],
        'dateModified'     => $case['modified'],
        'inLanguage'       => 'th-TH',
        'author'           => array( '@id' => $founder ),
        'publisher'        => array( '@id' => home_url( '/#organization' ) ),
        'about'            => $about,
        'articleSection'   => 'Case Studies',
        'keywords'         => implode( ', ', $case['keywords'] ),
    );
    if ( ! empty( $case['image']['path'] ) ) {
        $article['image'] = get_template_directory_uri() . $case['image']['path'];
    }
    $person = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'Person',
        '@id'           => $founder,
        'name'          => hashbox_founder_name(),
        'alternateName' => hashbox_founder_alternate_names(),
        'jobTitle'      => 'Founder',
        'url'           => home_url( '/about/' ),
        'image'         => get_template_directory_uri() . hashbox_founder_photo_path(),
        'worksFor'      => array( '@id' => home_url( '/#organization' ) ),
        'sameAs'        => array( hashbox_founder_linkedin() ),
    );
    $crumbs = array(
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => array(
            array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
            array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Work', 'item' => home_url( '/work/' ) ),
            array( '@type' => 'ListItem', 'position' => 3, 'name' => $case['client']['name'], 'item' => $url ),
        ),
    );
    $faq = array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        '@id'        => $url . '#faq',
        'inLanguage' => 'th',
        'mainEntity' => array_map( function ( $f ) {
            return array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
        }, $case['faq'] ),
    );
    return array( $article, $person, $crumbs, $faq );
}

/** Paragraphs may carry inline links as [anchor](/path/) — the only markup content files use. */
function hashbox_case_study_inline( $text ) {
    $out  = '';
    $rest = (string) $text;
    while ( preg_match( '/\[([^\]]+)\]\(([^)\s]+)\)/u', $rest, $m, PREG_OFFSET_CAPTURE ) ) {
        $out  .= esc_html( substr( $rest, 0, $m[0][1] ) );
        $href  = 0 === strpos( $m[2][0], '/' ) ? home_url( $m[2][0] ) : $m[2][0];
        $out  .= '<a href="' . esc_url( $href ) . '">' . esc_html( $m[1][0] ) . '</a>';
        $rest  = substr( $rest, $m[0][1] + strlen( $m[0][0] ) );
    }
    return $out . esc_html( $rest );
}

function hashbox_render_case_study_v2( array $case ) {
    $url = home_url( '/work/' . $case['slug'] . '/' );
    ?>
    <article class="hb-case2">
        <nav class="hb-container hb-breadcrumb" aria-label="Breadcrumb">
            <ol class="hb-breadcrumb__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Work</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li aria-current="page"><?php echo esc_html( $case['client']['name'] ); ?></li>
            </ol>
        </nav>

        <header class="hb-section hb-case2__head">
            <div class="hb-container hb-container--md">
                <p class="hb-eyebrow"><?php echo esc_html( 'Case study · ' . $case['eyebrow'] ); ?></p>
                <h1 class="hb-h1 hb-case2__title"><?php echo esc_html( $case['title'] ); ?></h1>
                <p class="hb-case2__byline">
                    <img class="hb-case2__avatar" src="<?php echo esc_url( get_template_directory_uri() . hashbox_founder_avatar_path() ); ?>" alt="<?php echo esc_attr( hashbox_founder_name() ); ?>" width="40" height="40" loading="lazy">
                    <span>เขียนโดย <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php echo esc_html( hashbox_founder_name() ); ?></a> · <?php echo esc_html( $case['author_role'] ); ?></span>
                    <span class="hb-case2__dates">เผยแพร่ <time datetime="<?php echo esc_attr( $case['published'] ); ?>"><?php echo esc_html( hashbox_case_study_date( $case['published'] ) ); ?></time> · อัปเดต <time datetime="<?php echo esc_attr( $case['modified'] ); ?>"><?php echo esc_html( hashbox_case_study_date( $case['modified'] ) ); ?></time></span>
                </p>
                <div class="hb-case2__answer">
                    <p><?php echo hashbox_case_study_inline( $case['summary'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper ?></p>
                </div>
            </div>
        </header>

        <?php if ( ! empty( $case['image']['path'] ) ) : ?>
        <figure class="hb-container hb-container--md hb-case2__figure">
            <img src="<?php echo esc_url( get_template_directory_uri() . $case['image']['path'] ); ?>" alt="<?php echo esc_attr( $case['image']['alt'] ); ?>" width="<?php echo (int) $case['image']['width']; ?>" height="<?php echo (int) $case['image']['height']; ?>" loading="lazy">
            <figcaption><?php echo esc_html( $case['image']['caption'] ); ?></figcaption>
        </figure>
        <?php endif; ?>

        <section class="hb-section hb-case2__section" aria-labelledby="facts">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2" id="facts">ข้อมูลโปรเจกต์</h2>
                <div class="hb-case2__table-wrap">
                    <table class="hb-case2__table hb-case2__facts">
                        <tbody>
                        <?php foreach ( $case['facts'] as $f ) : ?>
                            <tr><th scope="row"><?php echo esc_html( $f[0] ); ?></th><td><?php echo hashbox_case_study_inline( $f[1] ); // phpcs:ignore ?></td></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <?php foreach ( $case['sections'] as $s ) : ?>
        <section class="hb-section hb-case2__section" aria-labelledby="<?php echo esc_attr( $s['id'] ); ?>">
            <div class="hb-container hb-container--md hb-case2__prose">
                <h2 class="hb-h2" id="<?php echo esc_attr( $s['id'] ); ?>"><?php echo esc_html( $s['h2'] ); ?></h2>
                <?php foreach ( $s['body'] as $p ) : ?>
                    <p><?php echo hashbox_case_study_inline( $p ); // phpcs:ignore ?></p>
                <?php endforeach; ?>
                <?php if ( ! empty( $s['list'] ) ) : ?>
                    <ul><?php foreach ( $s['list'] as $li ) : ?><li><?php echo hashbox_case_study_inline( $li ); // phpcs:ignore ?></li><?php endforeach; ?></ul>
                <?php endif; ?>
                <?php if ( ! empty( $s['steps'] ) ) : ?>
                    <ol class="hb-case2__steps">
                    <?php foreach ( $s['steps'] as $step ) : ?>
                        <li><h3 class="hb-case2__step-title"><?php echo esc_html( $step['h'] ); ?></h3><p><?php echo hashbox_case_study_inline( $step['p'] ); // phpcs:ignore ?></p></li>
                    <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </div>
        </section>
            <?php if ( 'approach' === $s['id'] && ! empty( $case['status'] ) ) : ?>
        <section class="hb-section hb-case2__section" aria-labelledby="status">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2" id="status"><?php echo esc_html( $case['status_heading'] ); ?></h2>
                <?php if ( ! empty( $case['status_note'] ) ) : ?><p class="hb-case2__note"><?php echo hashbox_case_study_inline( $case['status_note'] ); // phpcs:ignore ?></p><?php endif; ?>
                <div class="hb-case2__table-wrap">
                    <table class="hb-case2__table hb-case2__status">
                        <thead><tr><th scope="col">ส่วนของงาน</th><th scope="col">ทำอะไร</th><th scope="col">สถานะ</th></tr></thead>
                        <tbody>
                        <?php foreach ( $case['status'] as $row ) : ?>
                            <tr><th scope="row"><?php echo esc_html( $row['module'] ); ?></th><td><?php echo esc_html( $row['what'] ); ?></td><td><span class="hb-case2__state hb-case2__state--<?php echo esc_attr( $row['kind'] ); ?>"><?php echo esc_html( $row['state'] ); ?></span></td></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
            <?php endif; ?>
        <?php endforeach; ?>

        <section class="hb-section hb-case2__section" aria-labelledby="results">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2" id="results"><?php echo esc_html( $case['results_heading'] ); ?></h2>
                <?php if ( ! empty( $case['results_note'] ) ) : ?><p class="hb-case2__note"><?php echo hashbox_case_study_inline( $case['results_note'] ); // phpcs:ignore ?></p><?php endif; ?>
                <div class="hb-case2__table-wrap">
                    <table class="hb-case2__table hb-case2__results">
                        <thead><tr><th scope="col">ตัวเลข</th><th scope="col">หมายถึง</th><th scope="col">ที่มา</th></tr></thead>
                        <tbody>
                        <?php foreach ( $case['results'] as $r ) : ?>
                            <tr><th scope="row"><?php echo esc_html( $r['value'] ); ?></th><td><?php echo esc_html( $r['label'] ); ?></td><td class="hb-case2__source"><?php echo esc_html( $r['source'] ); ?></td></tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="hb-section hb-case2__section" aria-labelledby="lessons">
            <div class="hb-container hb-container--md hb-case2__prose">
                <h2 class="hb-h2" id="lessons"><?php echo esc_html( $case['lessons_heading'] ); ?></h2>
                <ol class="hb-case2__lessons">
                <?php foreach ( $case['lessons'] as $l ) : ?>
                    <li><strong><?php echo esc_html( $l['h'] ); ?></strong> <?php echo hashbox_case_study_inline( $l['p'] ); // phpcs:ignore ?></li>
                <?php endforeach; ?>
                </ol>
            </div>
        </section>

        <section class="hb-section hb-case2__section" aria-labelledby="faq">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2" id="faq">คำถามที่พบบ่อย</h2>
                <?php foreach ( $case['faq'] as $f ) : ?>
                <details class="hb-case2__faq-item">
                    <summary><?php echo esc_html( $f['q'] ); ?></summary>
                    <p><?php echo esc_html( $f['a'] ); ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="hb-section hb-case2__section" aria-labelledby="related">
            <div class="hb-container hb-container--md hb-case2__prose">
                <h2 class="hb-h2" id="related">อ่านต่อ</h2>
                <ul class="hb-case2__related">
                <?php foreach ( $case['related'] as $r ) : ?>
                    <li><a href="<?php echo esc_url( home_url( $r['path'] ) ); ?>"><?php echo esc_html( $r['label'] ); ?></a><?php echo $r['note'] ? ' — ' . esc_html( $r['note'] ) : ''; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <section class="hb-section hb-case2__cta">
            <div class="hb-container hb-container--md">
                <h2 class="hb-h2"><?php echo esc_html( $case['cta']['h2'] ); ?></h2>
                <p><?php echo esc_html( $case['cta']['text'] ); ?></p>
                <a class="hb-btn hb-btn--gradient hb-btn--lg" href="<?php echo esc_url( home_url( $case['cta']['path'] ) ); ?>"><?php echo esc_html( $case['cta']['label'] ); ?></a>
            </div>
        </section>
    </article>
    <?php
    foreach ( hashbox_case_study_schema( $case ) as $node ) {
        hashbox_jsonld( $node );
    }
}
