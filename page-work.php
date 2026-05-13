<?php
/**
 * Template Name: Work: Hub
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();

$cases = array(
    array( 'slug' => 'nexus-corp',   'name' => 'Nexus Corp',           'industry' => 'Enterprise', 'metric' => '+540% Users',   'tag' => 'Corporate',   'tag_color' => 'blue',    'bg' => 'linear-gradient(135deg, #4338CA, #4F46E5)',  'desc' => 'Headless WordPress + Next.js corporate site SEO recovery 12 เดือน' ),
    array( 'slug' => 'flow-store',   'name' => 'Flow Store',           'industry' => 'E-commerce', 'metric' => '3× Conversion', 'tag' => 'CRO',         'tag_color' => 'cyan',    'bg' => 'linear-gradient(135deg, #3730A3, #6366F1)',  'desc' => 'Next.js storefront + CRO Sprint 4 เดือน Conversion 3 เท่า' ),
    array( 'slug' => 'rank-project', 'name' => 'Rank Project',         'industry' => 'HR-Tech',    'metric' => '+2,200%',       'tag' => 'SEO Recovery','tag_color' => 'blue',    'bg' => 'linear-gradient(135deg, #312E81, #4F46E5)',  'desc' => 'Technical SEO + 12-month content programme Impressions +22×' ),
    array( 'slug' => 'autobot-line', 'name' => 'AutoBot LINE',         'industry' => 'On-demand',  'metric' => '−60% Cost',     'tag' => 'AI Workforce','tag_color' => 'emerald', 'bg' => 'linear-gradient(135deg, #064E3B, #059669)',  'desc' => 'LINE Bot + OpenAI ตอบลูกค้าไทย 24/7 ลด Support Cost 60%' ),
    array( 'slug' => 'gold-brand',   'name' => 'Gold Brand',           'industry' => 'Luxury',     'metric' => '+180% Search',  'tag' => 'Brand + Web', 'tag_color' => 'amber',   'bg' => 'linear-gradient(135deg, #7C2D12, #C2410C)',  'desc' => 'Brand refresh + Performance site บน Next.js' ),
    array( 'slug' => 'pitch-deck',   'name' => 'Pitch Deck Microsite', 'industry' => 'SaaS',       'metric' => 'Series A',      'tag' => 'Investor Web','tag_color' => 'violet',  'bg' => 'linear-gradient(135deg, #312E81, #7C3AED)',  'desc' => 'Investor Microsite + Live Metrics Dashboard ปิด Series A' ),
);
?>

<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <nav class="hb-breadcrumb" aria-label="Breadcrumb">
                <ol class="hb-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">Work</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Selected Work</span>
            <h1 class="hb-hero__title">งานจริงที่<br><em>ผลลัพธ์วัดได้ทุกตัวเลข</em></h1>
            <p class="hb-hero__sub">
                6 เคสคัดจากงานจริงใน 4 อุตสาหกรรมหลัก HR-Tech, E-commerce, On-demand Service และ SaaS ผลลัพธ์ทั้งหมดมาจาก Google Analytics 4 และ Search Console จริง ไม่ใช่ตัวเลขประมาณ ทีม Lead ทุกเคสคือ Senior Engineer และ Designer โดยตรง
            </p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <?php foreach ( $cases as $c ) : ?>
                <a href="<?php echo esc_url( home_url( '/work/' . $c['slug'] . '/' ) ); ?>" class="hb-case" style="--case-bg: <?php echo esc_attr( $c['bg'] ); ?>;">
                    <div class="hb-case__head">
                        <span class="hb-case__industry"><?php echo esc_html( $c['industry'] ); ?></span>
                        <span class="hb-badge hb-badge--<?php echo esc_attr( $c['tag_color'] ); ?>"><?php echo esc_html( $c['tag'] ); ?></span>
                    </div>
                    <h2 class="hb-case__name"><?php echo esc_html( $c['name'] ); ?></h2>
                    <p class="hb-case__metric"><?php echo esc_html( $c['metric'] ); ?></p>
                    <p class="hb-case__desc"><?php echo esc_html( $c['desc'] ); ?></p>
                    <div class="hb-case__cta">
                        <span>อ่าน Case Study</span>
                        <span class="hb-case__cta-arrow">→</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เคสของคุณคือเคสถัดไป</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ SEO + Performance Audit ฟรี ก่อนตัดสินใจเริ่มงาน</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">เริ่มต้นกับเรา &rarr;</a>
    </div>
</section>

<?php
$item_list = array();
foreach ( $cases as $i => $c ) {
    $item_list[] = array( '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'url' => home_url( '/work/' . $c['slug'] . '/' ) );
}
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'CollectionPage',
    '@id'      => $page_url . '#collection',
    'url'      => $page_url,
    'name'     => 'Hashbox Studio — Case Studies',
    'hasPart'  => array( '@type' => 'ItemList', 'itemListElement' => $item_list ),
) );
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Work', 'item' => $page_url ),
    ),
) );

get_footer();
