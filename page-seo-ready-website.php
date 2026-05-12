<?php
/**
 * Template Name: Service: SEO-Ready Website
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
$desc = 'เราเชื่อว่าเว็บไซต์ที่ดีต้องพร้อมติด Google ตั้งแต่วันเปิดตัว ทุกโปรเจกต์ของทีมเราจึงผ่านมาตรฐาน Lighthouse 100, CWV เขียว, Schema ครบ พร้อม hreflang และ Sitemap auto-submit';

$faqs = array(
    array( 'q' => 'ทำไมต้องเลือก SEO-Ready Website แทนเว็บทั่วไป?', 'a' => 'เว็บทั่วไปต้องทำ Technical SEO Audit หลังเปิดตัว 2-3 รอบกว่าจะติด Google ของเราผ่าน Build Gate ตั้งแต่ก่อน Deploy: Lighthouse 100, CWV เขียว, Schema ครบ Googlebot Index ได้ตั้งแต่ Crawl แรก' ),
    array( 'q' => 'ใช้ Tech Stack อะไร เลือกได้มั้ย?', 'a' => 'เลือกได้ตามโจทย์ Next.js + Headless WordPress สำหรับ Performance สูงสุด · WordPress Custom Theme สำหรับทีมที่ต้องแก้ Content เอง · Astro/11ty สำหรับ Marketing Site เน้น Speed' ),
    array( 'q' => 'มาตรฐาน Lighthouse 100 ทำได้จริงทุกเคส?', 'a' => 'การันตี 95+ ทุกเคส และ 100/100/100/100 ในเคสที่ Stack ของเราควบคุมได้ (Next.js/Astro บน Vercel/Cloudflare) WordPress + Heavy Plugins อยู่ที่ 92-98 ขึ้นกับ Plugin Stack' ),
    array( 'q' => 'Schema Markup ที่ติดตั้งให้มีอะไรบ้าง?', 'a' => 'Organization, ProfessionalService, WebSite, BreadcrumbList ทุกหน้า · Article + Person บนบทความ · Service บนหน้าบริการ · FAQPage · LocalBusiness ถ้ามี Office · validate ผ่าน Schema.org' ),
    array( 'q' => 'ใช้เวลานานเท่าไหร่?', 'a' => 'Landing Page 2-3 สัปดาห์ · Corporate Site 4-6 สัปดาห์ · E-commerce 6-10 สัปดาห์ · ระบบซับซ้อน 8-14 สัปดาห์ Discovery + Audit ฟรีก่อนเริ่มเสมอ' ),
    array( 'q' => 'ราคาเริ่มต้น?', 'a' => 'Landing 80,000 บาท · Corporate 200,000 บาท · E-commerce 350,000 บาท · Enterprise 500,000+ บาท ทุก Quote ออกหลัง Audit ฟรี' ),
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
                    <li aria-current="page">SEO-Ready Website</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Service 01 / 03</span>
            <h1 class="hb-hero__title">รับทำเว็บไซต์<br><em>SEO-Ready</em><br>Lighthouse 100, CWV เขียว</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงานที่ผ่านมา</a>
            </div>
        </div>
    </div>
</section>

<!-- Build Gate -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Build Gate</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">"SEO-Ready" หมายถึงอะไรในมาตรฐานของเรา</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">เว็บที่ออกจาก Hashbox ทุกตัวต้องผ่าน Build Gate ก่อน Deploy ขึ้น Production เช็คลิสต์ 12 ข้อนี้บังคับใน CI Pipeline — ไม่ผ่าน = ไม่ Deploy</p>
        <div class="hb-bento" style="margin-top:var(--hb-space-8);">
            <?php
            $checks = array(
                'Lighthouse Performance 90+ (Mobile) / 95+ (Desktop)',
                'Lighthouse SEO 100/100',
                'Lighthouse Best Practices 95+',
                'Core Web Vitals เขียวทั้ง LCP / INP / CLS',
                'Schema.org Validator ผ่านทุก Type',
                'Robots.txt + Sitemap.xml auto-submit GSC + Bing',
                'Security Headers เกรด A+',
                'Canonical + OG + Twitter Card',
                'Hreflang สำหรับ Multilingual',
                'Mobile-First Responsive (320-1920px)',
                'Accessibility WCAG 2.1 AA',
                'PDPA Cookie Consent v2',
            );
            foreach ( $checks as $check ) : ?>
                <div class="hb-bento__cell" style="flex-direction:row;align-items:center;gap:var(--hb-space-3);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--hb-accent-emerald)" stroke-width="2" style="flex-shrink:0;"><polyline points="20 6 9 17 4 12"/></svg>
                    <span class="hb-body"><?php echo esc_html( $check ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Tech Stack -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Tech Stack</span>
            <h2 class="hb-h2">เลือก Stack ตามโจทย์</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">Frontend</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Next.js</strong> — Performance สูงสุด</li>
                    <li><strong>WordPress Custom</strong> — ทีมแก้เองได้</li>
                    <li><strong>Astro / 11ty</strong> — Docs/Marketing</li>
                </ul>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">CMS</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Headless WordPress</strong></li>
                    <li><strong>Sanity</strong></li>
                    <li><strong>Contentful</strong></li>
                    <li><strong>Strapi</strong></li>
                </ul>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">Hosting / Edge</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Vercel</strong> — Next.js + ISR</li>
                    <li><strong>Cloudflare Pages</strong></li>
                    <li><strong>WP Engine / Kinsta</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
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
        <h2 class="hb-h2">เริ่มด้วย Audit ฟรี</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ SEO + Performance Audit Report 15-20 หน้า ภายใน 3 วันทำการ</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'Service', '@id' => $page_url . '#service', 'name' => 'SEO-Ready Website Build', 'description' => $desc, 'url' => $page_url, 'provider' => array( '@id' => home_url( '/#organization' ) ), 'areaServed' => 'Thailand', 'serviceType' => 'Web Development' ) );
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => array(
    array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
    array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
    array( '@type' => 'ListItem', 'position' => 3, 'name' => 'SEO-Ready Website', 'item' => $page_url ),
) ) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'mainEntity' => $faq_entities ) );

get_footer();
