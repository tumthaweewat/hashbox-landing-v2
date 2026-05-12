<?php
/**
 * Template Name: Service: Digital Marketing Tools + CRO
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
$desc = 'การมี Traffic เยอะแต่ Conversion ต่ำคือเสียโอกาส ทีมเราติดตั้งและดูแลเครื่องมือ Marketing ครบวงจร พร้อมรัน CRO Sprint รายเดือนเพื่อเพิ่ม Conversion ต่อเนื่อง วัดผลผ่าน Looker Studio Real-time';

$faqs = array(
    array( 'q' => 'CRO คืออะไร แตกต่างจาก SEO ยังไง?', 'a' => 'SEO ทำให้คนเข้าเว็บ · CRO ทำให้คนที่เข้ามาแปลงเป็นลูกค้า การมี Traffic เยอะแต่ Conversion ต่ำ = เสียโอกาส CRO เพิ่ม Output ต่อ Traffic เท่าเดิม' ),
    array( 'q' => 'เครื่องมือที่ติดตั้งให้มีอะไรบ้าง?', 'a' => 'GA4 + GSC, Microsoft Clarity / Hotjar, GrowthBook / VWO, Looker Studio, Server-side GTM, PDPA Consent Mode v2' ),
    array( 'q' => 'CRO Sprint ทำอะไรในแต่ละเดือน?', 'a' => 'Week 1: Hypothesize จาก Data · Week 2: Prioritize ICE + Build · Week 3: Run A/B Test · Week 4: Measure + Ship Winner ทำต่อเนื่องทุกเดือน' ),
    array( 'q' => 'ใช้ A/B Tool ไหน?', 'a' => 'GrowthBook (Open Source) เป็นหลัก · VWO สำหรับ GUI-driven · PostHog สำหรับ Product-led' ),
    array( 'q' => 'PDPA Compliant ทำยังไง?', 'a' => 'ติดตั้ง Cookie Consent Banner + Consent Mode v2 GA4/GTM อ่าน Consent State ก่อน Fire Pixel' ),
    array( 'q' => 'ราคาและรูปแบบ?', 'a' => 'Setup ครั้งเดียวเริ่ม 80,000 บาท · Retainer รายเดือน 50,000-150,000 บาท ตามขนาดทีมและ Sprint Frequency' ),
);
?>

<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <nav class="hb-breadcrumb">
                <ol class="hb-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">Marketing + CRO</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Service 02 / 03</span>
            <h1 class="hb-hero__title">Digital Marketing + CRO<br><em>เครื่องมือที่</em><br>เปลี่ยน Traffic เป็นลูกค้า</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูเคส CRO</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Stack</span>
            <h2 class="hb-h2">เครื่องมือที่เราติดตั้งและ Operate</h2>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h4">Analytics</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--blue">GA4</span>
                    <span class="hb-badge hb-badge--blue">Search Console</span>
                    <span class="hb-badge hb-badge--blue">Server-side GTM</span>
                    <span class="hb-badge hb-badge--blue">Looker Studio</span>
                </div>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h4">Behavior + UX</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--cyan">Microsoft Clarity</span>
                    <span class="hb-badge hb-badge--cyan">Hotjar</span>
                    <span class="hb-badge hb-badge--cyan">Fullstory</span>
                </div>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c4">
                <h3 class="hb-h4">Experimentation</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--violet">GrowthBook</span>
                    <span class="hb-badge hb-badge--violet">VWO</span>
                    <span class="hb-badge hb-badge--violet">PostHog</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">CRO Sprint</span>
            <h2 class="hb-h2">กระบวนการ 5 ขั้นตอนรายเดือน</h2>
        </div>
        <ol class="hb-steps">
            <li class="hb-step"><h3 class="hb-step__title">Hypothesize</h3><p class="hb-step__desc">ดู Data จาก Heatmap + GA4 หา Friction Point ตั้งสมมติฐาน</p></li>
            <li class="hb-step"><h3 class="hb-step__title">Prioritize (ICE)</h3><p class="hb-step__desc">คะแนน Impact × Confidence × Ease เลือก Top 1-2 Tests</p></li>
            <li class="hb-step"><h3 class="hb-step__title">Build</h3><p class="hb-step__desc">Code Variant + Setup Goal Tracking + Define Sample Size</p></li>
            <li class="hb-step"><h3 class="hb-step__title">Run + Measure</h3><p class="hb-step__desc">Reach Statistical Significance ไม่ Peek</p></li>
            <li class="hb-step"><h3 class="hb-step__title">Ship + Document</h3><p class="hb-step__desc">Ship Winner เข้า Production · Archive Loser + Why</p></li>
        </ol>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อย</h2>
        </div>
        <div class="hb-accordion">
            <?php foreach ( $faqs as $i => $f ) : ?>
                <details class="hb-accordion__item" <?php echo $i === 0 ? 'open' : ''; ?>>
                    <summary class="hb-accordion__trigger"><?php echo esc_html( $f['q'] ); ?></summary>
                    <div class="hb-accordion__content"><p><?php echo esc_html( $f['a'] ); ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">คุยกับเราเรื่อง CRO Retainer</h2>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg" style="margin-top:var(--hb-space-6);">รับ Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'Service', '@id' => $page_url . '#service', 'name' => 'Digital Marketing Tools + CRO', 'description' => $desc, 'url' => $page_url, 'provider' => array( '@id' => home_url( '/#organization' ) ), 'areaServed' => 'Thailand', 'serviceType' => 'Digital Marketing' ) );
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => array(
    array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
    array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
    array( '@type' => 'ListItem', 'position' => 3, 'name' => 'Marketing + CRO', 'item' => $page_url ),
) ) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'mainEntity' => $faq_entities ) );

get_footer();
