<?php
/**
 * Template Name: Service: รับทำเว็บไซต์ WordPress
 *
 * Child service page of /services/website-development/ targeting the
 * "รับทำเว็บไซต์ wordpress" query cluster. Assign this template to a WP
 * Page at /services/website-development/wordpress/ (parent: SEO-Ready
 * Website). Two delivery modes: WordPress Custom Theme and Headless
 * WordPress (WP CMS + Next.js front end).
 *
 * Rank Math: Title=รับทำเว็บไซต์ WordPress ที่ Lighthouse 95+ | Hashbox
 * Rank Math: Description=รับทำเว็บไซต์ WordPress แบบ Custom Theme และ Headless (WP + Next.js) การันตี Lighthouse 95+ เมื่อไม่มี heavy plugin, AI Search Ready เริ่มจาก SEO Audit ฟรี
 * (Title/meta ตั้งใน WP admin — บล็อกนี้เป็น reference เท่านั้น)
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url   = get_permalink();
$parent_url = home_url( '/services/website-development/' );
$desc       = 'รับทำเว็บไซต์ WordPress 2 รูปแบบ — Custom Theme เขียนเองไม่พึ่ง page builder หนัก และ Headless WordPress (WP + Next.js) ทุกโปรเจกต์ผ่าน Build Gate กว่า 12 ขั้นตอน Core Web Vitals เขียว Schema ครบ 8+ types และโครงสร้าง AI Search Ready';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปีประสบการณ์ Technical SEO + Performance Engineering · ผ่านโปรเจกต์ SEO migration 50+ เคส · Cert: Google Analytics, Search Console, Cloudflare Performance Engineer';

// FAQ array = single source of truth: drives visible accordion + FAQPage JSON-LD.
// Answers are plain text (feed esc_html AND schema).
$faqs = array(
    array(
        'q' => 'รับทำเว็บไซต์ WordPress ราคาเท่าไหร่?',
        'a' => 'ใช้แพ็กเกจเดียวกับบริการเว็บไซต์ SEO-Ready ของเรา: Landing Page เริ่ม 35,900 บาท · Corporate Site เริ่ม 80,000 บาท · E-commerce 350,000 บาท · Enterprise 500,000+ บาท ราคาสุดท้ายขึ้นกับ scope จริง — จำนวนหน้า ระบบที่ต้องมี การย้ายข้อมูล และรูปแบบ (Custom หรือ Headless) ทุก quote ออกหลังประเมิน Scope ฟรี',
    ),
    array(
        'q' => 'ใช้ Elementor หรือ page builder ไหม?',
        'a' => 'ไม่ใช้ page builder หนักอย่าง Elementor ในงาน production เพราะเป็นสาเหตุอันดับต้นของเว็บช้าและขัดกับการันตี Lighthouse 95+ ของเรา งาน WordPress Custom เราเขียน theme เองและใช้ block editor มาตรฐานของ WordPress ให้ทีมคุณแก้เนื้อหาได้สะดวก ส่วน Headless หน้าบ้านเป็น Next.js ไม่มี page builder เกี่ยวข้องเลย',
    ),
    array(
        'q' => 'มีเว็บ WordPress อยู่แล้ว ย้ายมาได้ไหม?',
        'a' => 'ได้ — เรารับ migration จาก WordPress, Wix, Webflow, Shopify และ Magento โดยรักษา URL structure เดิมและทำ 301 redirect map ครบทุก URL เพื่อไม่ให้อันดับ SEO ที่สะสมมาหายระหว่างย้าย ก่อนเริ่มเรา audit เว็บเดิมก่อนว่าอะไรควรเก็บ อะไรคือตัวถ่วงที่ควรทิ้ง',
    ),
    array(
        'q' => 'ส่งมอบแล้วดูแลต่อยังไง?',
        'a' => 'ทุกโปรเจกต์รวม monitoring 30 วันแรก (CWV alerts, Search Console errors, uptime) เว็บโฮสต์บน WP Engine หรือ Kinsta ซึ่งจัดการ backup และ security ระดับ infrastructure ให้อยู่แล้ว ดูแลต่อเนื่องมี Care Plan รายเดือน 15,000-50,000 บาท ครอบคลุม updates, monitoring, content updates และ ranking reports ส่งมอบ source code + Git repository 100% ไม่ผูกกับระบบปิดของ agency',
    ),
    array(
        'q' => 'Headless WordPress คืออะไร ต่างจาก WordPress ปกติยังไง?',
        'a' => 'Headless WordPress คือการใช้ WordPress เป็นระบบจัดการเนื้อหาหลังบ้าน ส่วนหน้าเว็บที่ผู้ใช้เห็น build ด้วย Next.js แล้ว deploy บน Vercel หรือ Cloudflare Pages ข้อดีคือเร็วกว่า WordPress ปกติชัดเจน — ทำ Lighthouse 95-100 ได้ เพราะหน้าบ้านไม่ได้รัน PHP หรือ plugin เลย และปลอดภัยกว่า ข้อแลกคือการเปลี่ยนโครงหน้าเว็บต้องใช้ developer เหมาะกับธุรกิจที่มองเว็บเป็นสินทรัพย์ระยะยาว',
    ),
    array(
        'q' => 'รับทำเว็บไซต์บริษัท (corporate website) ไหม?',
        'a' => 'รับ — เว็บบริษัทที่ดีต้องทำหน้าที่มากกว่าโบรชัวร์ออนไลน์ คือต้องถูกค้นเจอ โหลดเร็วบนมือถือ และมีโครงสร้างที่ Google กับ AI search อ่านออก แพ็กเกจ Corporate Site เริ่ม 80,000 บาท (5-15 หน้า) ใช้เวลา 4-6 สัปดาห์ เหมาะกับธุรกิจ B2B, agency และ professional service',
    ),
    array(
        'q' => 'ทำเว็บแล้วได้ SEO ด้วยเลยไหม?',
        'a' => 'โครงสร้าง SEO ระดับ technical ติดมากับเว็บทุกโปรเจกต์โดยไม่ต้องซื้อเพิ่ม — semantic HTML, Schema 8+ types, Core Web Vitals เขียว, AI Search Ready ทั้งหมดอยู่ใน Build Gate มาตรฐาน ส่วนงาน SEO ต่อเนื่อง (คอนเทนต์ คีย์เวิร์ด และการวัดผลด้วยระบบ track อันดับรายวันของเราเอง) เป็นบริการแยกที่ต่อยอดได้ทันที เพราะฐานเว็บพร้อมตั้งแต่วันแรก',
    ),
);

// Comparison: Template สำเร็จรูป vs WordPress Custom vs Headless WordPress.
$compare_head = array( 'เกณฑ์', 'Template สำเร็จรูป', 'WordPress Custom (Hashbox)', 'Headless WordPress (Hashbox)' );
$compare_rows = array(
    array( 'Lighthouse Mobile', 'แล้วแต่ theme/plugin — ไม่มีใครการันตี', 'การันตี 95+ (ไม่มี heavy plugin)', '95-100 (หน้าบ้าน Next.js)' ),
    array( 'Core Web Vitals', 'วัดดวงตาม theme/plugin', 'เขียวทุกตัว ตรวจก่อนส่งมอบ', 'เขียวทุกตัว ตรวจก่อนส่งมอบ' ),
    array( 'Page builder', 'Elementor/Divi + ปลั๊กอินหลายสิบตัว', 'ไม่ใช้ page builder หนัก', 'ไม่มี — หน้าบ้านเป็น Next.js' ),
    array( 'โครงสร้าง SEO', 'Heading มั่ว Schema ไม่ครบ', 'Semantic HTML + Schema 8+ types', 'Semantic HTML + Schema 8+ types' ),
    array( 'AI Search Ready', 'ไม่ได้ออกแบบมาเพื่อสิ่งนี้', 'Optimize ระดับ passage', 'Optimize ระดับ passage' ),
    array( 'ทีมแก้เนื้อหาเอง', 'ได้ แต่พังง่าย', 'ได้ ผ่านหลังบ้าน WP ปกติ', 'ได้ (เนื้อหา) · โครงหน้าต้องใช้ dev' ),
    array( 'Hosting', 'Shared hosting ราคาถูก', 'WP Engine / Kinsta', 'WP Engine / Kinsta + Vercel หรือ Cloudflare Pages' ),
    array( 'เหมาะกับ', 'งบจำกัดมากและยอมรับข้อจำกัด', 'เว็บบริษัท เว็บบริการ เว็บคอนเทนต์', 'เว็บ traffic สูง ต้องการ performance สูงสุด' ),
);

// Published pricing of the parent SEO-Ready Website service (WordPress uses the same tiers).
$pricing = array(
    array( 'tier' => 'Landing Page', 'price' => 35900, 'label' => 'เริ่ม 35,900 บาท', 'pages' => '1-3 หน้า', 'time' => '2-3 สัปดาห์', 'fit' => 'Product launch, campaign, lead-gen' ),
    array( 'tier' => 'Corporate Site', 'price' => 80000, 'label' => 'เริ่ม 80,000 บาท', 'pages' => '5-15 หน้า', 'time' => '4-6 สัปดาห์', 'fit' => 'B2B, agency, professional service' ),
    array( 'tier' => 'E-commerce', 'price' => 350000, 'label' => '350,000 บาท', 'pages' => '20-100 หน้า', 'time' => '6-10 สัปดาห์', 'fit' => 'WooCommerce, custom catalog' ),
    array( 'tier' => 'Enterprise', 'price' => 500000, 'label' => '500,000+ บาท', 'pages' => '50+ หน้า · custom', 'time' => '8-14 สัปดาห์', 'fit' => 'Multi-language, headless, integration หนัก' ),
);

// Build Gate criteria (ตัวอย่างเกณฑ์ก่อนส่งมอบ).
$gate = array(
    array( 'name' => 'Performance', 'detail' => 'Lighthouse Mobile 95+ ทุกหน้าหลัก — Custom ที่ไม่มี heavy plugin และ Headless ต้องผ่านเกณฑ์นี้ก่อนขึ้น production' ),
    array( 'name' => 'Core Web Vitals', 'detail' => 'LCP, INP, CLS ผ่านเกณฑ์เขียวทั้งหมด ตรวจก่อนส่งมอบ ไม่ใช่ "เดี๋ยวไปปรับให้ทีหลัง"' ),
    array( 'name' => 'Schema validation', 'detail' => 'Schema.org ครบ 8+ types ฝังในระดับ theme และ validate ผ่านทุกตัว' ),
    array( 'name' => 'Semantic structure', 'detail' => 'Heading hierarchy เดียว ไม่มี H1 ซ้ำ · landmark และ alt text ถูกต้องทุกหน้า' ),
    array( 'name' => 'AI Search Ready', 'detail' => 'โครงสร้างเนื้อหา optimize ระดับ passage ให้ AI Overview และ AI search ดึงไปอ้างอิงได้' ),
    array( 'name' => 'Index readiness', 'detail' => 'Sitemap, robots, canonical และ redirect map ครบก่อนวัน launch' ),
);

$table_cell = 'padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border,#27272A);text-align:left;vertical-align:top;';
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
                    <li><a href="<?php echo esc_url( $parent_url ); ?>">รับทำเว็บไซต์ SEO-Ready</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">รับทำเว็บไซต์ WordPress</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">WordPress · Custom Theme + Headless</span>
            <h1 class="hb-hero__title">รับทำเว็บไซต์ WordPress<br><em>ที่วัดผลด้วย Lighthouse จริง</em><br>ไม่ใช่แค่ "เว็บสวย"</h1>
            <p class="hb-hero__sub">ตลาดรับทำเว็บไซต์ WordPress ในไทยเต็มไปด้วยเว็บ template ที่หน้าตาเหมือนกันหมด โหลดช้า และโครงสร้าง SEO พังตั้งแต่วันแรก เราทำต่างออกไป: เขียน theme เองหรือแยกหน้าบ้านเป็น Next.js ผ่าน Build Gate กว่า 12 ขั้นตอนก่อนขึ้น production — ทั้งหมดเป็นส่วนหนึ่งของบริการ<a href="<?php echo esc_url( $parent_url ); ?>" style="color:inherit;text-decoration:underline;text-decoration-color:var(--hb-accent-blue,#2563EB);text-underline-offset:0.18em;">รับทำเว็บไซต์ SEO-Ready</a>ของเรา</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/website-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ประเมินโปรเจกต์ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงาน</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-1,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox รับทำเว็บไซต์ WordPress 2 รูปแบบ</strong> — <strong>WordPress Custom</strong> (เขียน theme เอง ไม่พึ่ง page builder หนัก) และ <strong>Headless WordPress</strong> (WP เป็น CMS หลังบ้าน หน้าบ้าน Next.js บน Vercel/Cloudflare Pages) ทุกโปรเจกต์ผ่าน Build Gate กว่า 12 ขั้นตอนก่อนขึ้น production เรื่อง Lighthouse เราพูดตรงๆ: Custom ที่ไม่มี heavy plugin การันตี 95+ · Headless ทำได้ 95-100 · ส่วน WordPress ที่ลาก heavy plugin ตามจริงอยู่ที่ 92-98 ขึ้นกับ plugin stack — เราบอกก่อนเริ่มงาน ไม่ใช่หลังส่งมอบ แพ็กเกจเว็บไซต์เริ่ม 35,900 บาท เริ่มจากการประเมิน Scope ฟรี
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ปัญหาที่เจอบ่อย</span>
            <h2 class="hb-h2">ทำไมเว็บ WordPress ส่วนใหญ่ถึงช้า และทำไมมันทำร้าย SEO</h2>
            <p class="hb-section__sub">เว็บ WordPress ส่วนใหญ่ช้าเพราะ 3 สาเหตุ ผลคือ Core Web Vitals แดง ซึ่ง Google ใช้เป็นสัญญาณจัดอันดับโดยตรง เว็บช้าจึงไม่ใช่แค่ "ประสบการณ์ไม่ดี" แต่คือเสียอันดับให้คู่แข่งที่เร็วกว่า</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">01</span>
                <h3 class="hb-h3">Page builder ฉีดโค้ดเกินจำเป็น</h3>
                <p class="hb-body">Page builder ช่วยให้ "ใครก็ทำเว็บได้" จริง แต่หน้าเดียวอาจลาก JavaScript หลายร้อย KB ทั้งที่เนื้อหาจริงเป็นแค่ข้อความกับรูปไม่กี่รูป ค่า LCP จึงทะลุเกณฑ์ 2.5 วินาทีไปไกล — อ่านกลไกและวิธีแก้ได้ใน<a href="<?php echo esc_url( home_url( '/lcp-คืออะไร-วิธี-2026/' ) ); ?>">บทความ LCP คืออะไร</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">02</span>
                <h3 class="hb-h3">ปลั๊กอินซ้อนกันหลายสิบตัว</h3>
                <p class="hb-body">Slider, popup, form, animation — แต่ละตัวเพิ่ม CSS/JS ที่ browser ต้องโหลดและประมวลผล พอไม่มีใครตอบได้ว่าปลั๊กอินแต่ละตัวมีไว้ทำไม เว็บก็ช้าลงเรื่อยๆ โดยไม่มีใครกล้าแตะ</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">03</span>
                <h3 class="hb-h3">โครงสร้าง SEO พังระดับ theme</h3>
                <p class="hb-body">Theme สำเร็จรูปจำนวนมากใช้ heading มั่ว (H1 ซ้ำ ข้าม level) ไม่มี semantic HTML และ Schema ผิดๆ จาก plugin ที่ generate อัตโนมัติ Google กับ AI search อ่านโครงสร้างไม่ออก ต่อให้เนื้อหาดีก็เสียเปรียบ — รายละเอียดใน<a href="<?php echo esc_url( home_url( '/technical-seo-guide/' ) ); ?>">Technical SEO Guide</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">Checklist</span>
                <h3 class="hb-h3">เช็กลิสต์อาการ "เว็บ WordPress ป่วย"</h3>
                <p class="hb-body">1. หน้าแรกบนมือถือโหลดเกิน 3 วินาที · 2. Lighthouse Mobile ต่ำกว่า 60 · 3. Core Web Vitals ใน Search Console ขึ้น "ต้องปรับปรุง" (<a href="<?php echo esc_url( home_url( '/core-web-vitals-thai-guide-2026/' ) ); ?>">วิธีอ่านค่า</a>) · 4. ปลั๊กอิน active เกิน 25 ตัว · 5. แก้อะไรนิดเดียวก็กลัวเว็บพัง — ถ้าตรงเกิน 2 ข้อ ปัญหาไม่ใช่ "ทำ content เพิ่ม" แต่คือฐานรากของเว็บ</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">2 รูปแบบ</span>
            <h2 class="hb-h2">รับทำเว็บไซต์ WordPress: Custom Theme และ Headless</h2>
            <p class="hb-section__sub">เรารับทำแค่ 2 รูปแบบ และไม่แนะนำ template สำเร็จรูป เพราะขัดกับมาตรฐานที่เราตรวจก่อนส่งมอบ</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">แบบที่ 1</span>
                <h3 class="hb-h3">WordPress Custom</h3>
                <p class="hb-body">Theme เขียนเองตั้งแต่ศูนย์ โหลดเฉพาะโค้ดที่หน้านั้นใช้จริง ทีม marketing ยังแก้เนื้อหา เพิ่มบทความ อัปเดตรูปได้เองผ่านหลังบ้าน WordPress ที่คุ้นเคย</p>
                <p class="hb-body" style="margin-top:var(--hb-space-3);">Semantic HTML ถูกต้องทุกหน้า · Schema 8+ types ฝังระดับ theme (<a href="<?php echo esc_url( home_url( '/schema-markup-thai-guide-2026/' ) ); ?>">แนวทางเดียวกับคู่มือ Schema ของเรา</a>) · CSS/JS ผ่าน performance budget · Hosting บน WP Engine หรือ Kinsta</p>
                <p class="hb-body" style="margin-top:var(--hb-space-3);color:var(--hb-text-muted,#A1A1AA);">เหมาะกับเว็บบริษัท เว็บบริการ และทีมที่อัปเดตเนื้อหาบ่อยโดยไม่ต้องเรียก developer</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">แบบที่ 2</span>
                <h3 class="hb-h3">Headless WordPress (WP + Next.js)</h3>
                <p class="hb-body">แยกหลังบ้านกับหน้าบ้าน: ทีมคอนเทนต์ยังเขียนใน WordPress เหมือนเดิม แต่หน้าเว็บที่ผู้ใช้เห็น build ด้วย Next.js แล้ว deploy บน Vercel หรือ Cloudflare Pages ได้ความเร็วระดับ static site พร้อมความสะดวกของ WordPress CMS</p>
                <p class="hb-body" style="margin-top:var(--hb-space-3);">เหมาะกับเว็บ traffic สูง เว็บที่ความเร็วคือแต้มต่อทางธุรกิจ หรือองค์กรที่วางแผนต่อยอดหลายภาษา แลกกับ workflow ที่ต้องพึ่ง developer มากขึ้นเมื่อเปลี่ยนโครงหน้าเว็บ — เราช่วยประเมินก่อนเริ่มเสมอว่า scope คุ้มกับความซับซ้อนที่เพิ่มหรือไม่</p>
            </div>
        </div>
        <div style="overflow-x:auto;margin-top:var(--hb-space-8);">
            <table style="width:100%;min-width:720px;border-collapse:collapse;font-size:var(--hb-text-sm,0.875rem);">
                <caption class="hb-body" style="caption-side:top;text-align:left;margin-bottom:var(--hb-space-3);color:var(--hb-text-muted,#A1A1AA);">ตารางเทียบ: Template สำเร็จรูป vs WordPress Custom vs Headless WordPress</caption>
                <thead>
                    <tr>
                        <?php foreach ( $compare_head as $h ) : ?>
                            <th scope="col" style="<?php echo esc_attr( $table_cell ); ?>font-weight:var(--hb-weight-semibold,600);color:var(--hb-text-strong,#FAFAFA);"><?php echo esc_html( $h ); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $compare_rows as $row ) : ?>
                        <tr>
                            <th scope="row" style="<?php echo esc_attr( $table_cell ); ?>font-weight:var(--hb-weight-medium,500);color:var(--hb-text-strong,#FAFAFA);"><?php echo esc_html( $row[0] ); ?></th>
                            <td style="<?php echo esc_attr( $table_cell ); ?>color:var(--hb-text-muted,#A1A1AA);"><?php echo esc_html( $row[1] ); ?></td>
                            <td style="<?php echo esc_attr( $table_cell ); ?>"><?php echo esc_html( $row[2] ); ?></td>
                            <td style="<?php echo esc_attr( $table_cell ); ?>"><?php echo esc_html( $row[3] ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">เลือกยังไง</span>
            <h2 class="hb-h2">เมื่อไหร่ควรใช้ WordPress เมื่อไหร่ควรไป Next.js เต็มตัว</h2>
            <p class="hb-section__sub">หลักคิดสั้นๆ ที่เราใช้ตอนให้คำปรึกษา — เราไม่มีแรงจูงใจต้องดันเทคโนโลยีไหนเป็นพิเศษ เพราะเรารับทำทั้งสองแบบ</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">→ WordPress Custom</span>
                <p class="hb-body">ทีม marketing อัปเดตเนื้อหาเองทุกสัปดาห์ ไม่มี developer ประจำ และอยากได้ ecosystem ที่ทีมคุ้นเคย</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">→ Headless WordPress</span>
                <p class="hb-body">เว็บคอนเทนต์หนัก ต้องการความเร็วระดับ top และมีงบดูแลระยะยาว — ทางสายกลางที่เอาจุดแข็งของทั้งคู่มารวมกัน</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">→ Next.js เต็มตัว</span>
                <p class="hb-body">Web app ระบบสมาชิก feature เฉพาะทาง หรือเนื้อหาไม่ได้เปลี่ยนบ่อย — ไม่ต้องมี WordPress เลย</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">อ่านต่อ</span>
                <p class="hb-body">เราเขียนเทียบสองฝั่งไว้ละเอียดพร้อมเกณฑ์ตัดสินใจใน<a href="<?php echo esc_url( home_url( '/nextjs-vs-wordpress-2026/' ) ); ?>">บทความ Next.js vs WordPress</a> ถ้าอ่านแล้วยังไม่ชัวร์ <a href="<?php echo esc_url( home_url( '/website-audit/' ) ); ?>">นัดคุยกันก่อนได้ ไม่มีค่าใช้จ่าย</a></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา + Timeline</span>
            <h2 class="hb-h2">แพ็กเกจเว็บไซต์ (ใช้ร่วมกับบริการ SEO-Ready Website)</h2>
            <p class="hb-section__sub">งาน WordPress ทั้ง Custom และ Headless ตีราคาตามแพ็กเกจเดียวกับ<a href="<?php echo esc_url( $parent_url ); ?>">บริการรับทำเว็บไซต์ SEO-Ready</a> — quote สุดท้ายออกหลัง SEO Audit ฟรี ตาม scope จริง</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $pricing as $p ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label"><?php echo esc_html( $p['tier'] ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $p['label'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $p['pages'] . ' · ' . $p['time'] ); ?></p>
                    <p class="hb-body" style="margin-top:var(--hb-space-2);color:var(--hb-text-muted,#A1A1AA);"><?php echo esc_html( $p['fit'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);color:var(--hb-text-muted,#A1A1AA);">ดูแลต่อเนื่องหลังส่งมอบมี Care Plan รายเดือน 15,000-50,000 บาท · ทุกโปรเจกต์รวม monitoring 30 วันแรก และส่งมอบ source code + Git repository 100%</p>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">กระบวนการ</span>
            <h2 class="hb-h2">Build Gate กว่า 12 ขั้นตอนก่อนขึ้น Production</h2>
            <p class="hb-section__sub">ชุดตรวจสอบอัตโนมัติและ manual review ที่บล็อกไม่ให้เว็บขึ้น production จนกว่าจะผ่านเกณฑ์ทุกข้อ — ตัวอย่างเกณฑ์หลัก 6 ข้อ</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $gate as $i => $g ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $g['name'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $g['detail'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="hb-answer-box" style="margin-top:var(--hb-space-8);padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-emerald,#10B981);background:var(--hb-surface-1,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-emerald,#10B981);">การันตีเป็นลายลักษณ์อักษร</span>
            <p class="hb-body" style="margin-top:var(--hb-space-3);">ถ้าไม่ถึงเป้า Lighthouse ภายใน 14 วันหลัง launch เราคืน 100% ของ Performance Engineering fee (ราว 20-30% ของโปรเจกต์) เงื่อนไข: ใช้ stack ที่เราแนะนำ และไม่ติดตั้ง heavy 3rd-party plugin เพิ่มหลังส่งมอบ — วิธีที่เราไล่เก็บคะแนนอยู่ในบทความ <a href="<?php echo esc_url( home_url( '/lighthouse-100-ทำยังไง-2026/' ) ); ?>">ทำ Lighthouse 100 ยังไง</a></p>
            <p class="hb-body" style="margin-top:var(--hb-space-3);">เว็บที่โครงสร้างถูกตั้งแต่วันแรกช่วยลด time-to-rank จาก 6 เดือนเหลือ 1-2 เดือนในหลายอุตสาหกรรม — ดูตัวเลขจากเคสจริง เช่น +540% Users และ +2,200% Impressions ได้ที่<a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">หน้าผลงานของเรา</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">สิ่งที่เจ้าอื่นไม่มี</span>
            <h2 class="hb-h2">ระบบ track อันดับของเราเอง อัปเดตรายวัน</h2>
            <p class="hb-section__sub">ลูกค้า SEO ของ Hashbox ได้ข้อมูลอันดับคีย์เวิร์ดและการถูกอ้างอิงใน Google AI Overview จากระบบของเราเอง อัปเดตรายวัน — ไม่ใช่ dashboard SaaS ที่เช่ารายเดือนแล้วข้อมูลหายเมื่อเลิกจ่าย ข้อมูลย้อนหลังทั้งหมดเป็นของโปรเจกต์คุณ</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">รายวัน</span>
                <p class="hb-body">เห็นอันดับขยับทุกวัน ไม่ต้องรอรายงานรายเดือน</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">AI Overview</span>
                <p class="hb-body">เห็นว่าหน้าไหนของคุณ (หรือของคู่แข่ง) ถูก AI Overview หยิบไปอ้างอิง — แนวทางอยู่ใน<a href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>">คู่มือ GEO / AI Search</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">ตลาดไทย</span>
                <p class="hb-body">ตัดสินใจจากข้อมูลจริงของตลาดไทย ไม่ใช่ตัวเลขประมาณการจาก tool ต่างประเทศ — ต่อขยายจากบริการ <a href="<?php echo esc_url( home_url( '/services/seo/#cro' ) ); ?>">รับทำ SEO + CRO</a></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Author / Team</span>
            <h2 class="hb-h2">ทีมที่รับผิดชอบโปรเจกต์</h2>
        </div>
        <div class="hb-card" style="padding:var(--hb-space-6);">
            <h3 class="hb-h3" style="margin:0;"><?php echo esc_html( $author_name ); ?></h3>
            <p class="hb-body" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $author_role ); ?></p>
            <p class="hb-body" style="margin-top:var(--hb-space-3);"><?php echo esc_html( $author_bio ); ?></p>
            <a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener author" target="_blank" style="display:inline-block;margin-top:var(--hb-space-3);color:var(--hb-accent-blue,#2563EB);">LinkedIn →</a>
        </div>
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
                <details class="hb-accordion__item" <?php echo 0 === $i ? 'open' : ''; ?>>
                    <summary class="hb-accordion__trigger"><?php echo esc_html( $f['q'] ); ?></summary>
                    <div class="hb-accordion__content"><p><?php echo esc_html( $f['a'] ); ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มจากตรวจเว็บปัจจุบันของคุณ — ฟรี</h2>
        <p class="hb-lead" style="margin:var(--hb-space-4) auto var(--hb-space-6);">ไม่ต้องเดาว่าเว็บ WordPress ของคุณมีปัญหาตรงไหน ส่ง URL มาแล้วเราตรวจให้: ความเร็ว, Core Web Vitals, โครงสร้าง SEO และความพร้อมสำหรับ AI Search พร้อมข้อเสนอ scope ที่ชัดเจนถ้าอยากไปต่อ</p>
        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/website-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ประเมินโปรเจกต์ฟรี</a>
            <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงานที่ผ่านมา</a>
        </div>
    </div>
</section>

<?php
// ---------- Schemas ----------

// Service + OfferCatalog (published tiers of the parent SEO-Ready Website service).
$offer_catalog = array();
foreach ( $pricing as $p ) {
    $offer_catalog[] = array(
        '@type'              => 'Offer',
        'name'               => $p['tier'],
        'price'              => (string) $p['price'],
        'priceCurrency'      => 'THB',
        'priceSpecification' => array(
            '@type'                 => 'PriceSpecification',
            'price'                 => (string) $p['price'],
            'priceCurrency'         => 'THB',
            'valueAddedTaxIncluded' => false,
        ),
        'description'        => $p['fit'] . ' · ' . $p['pages'] . ' · ' . $p['time'],
        'availability'       => 'https://schema.org/InStock',
        'areaServed'         => 'TH',
    );
}
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'Service',
    '@id'             => $page_url . '#service',
    'name'            => 'รับทำเว็บไซต์ WordPress',
    'description'     => $desc,
    'url'             => $page_url,
    'inLanguage'      => 'th',
    'provider'        => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'      => array(
        '@type' => 'Country',
        'name'  => 'Thailand',
    ),
    'serviceType'     => 'WordPress Website Development',
    'category'        => 'Web Development',
    'hasOfferCatalog' => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'แพ็กเกจเว็บไซต์ (SEO-Ready Website)',
        'itemListElement' => $offer_catalog,
    ),
    'offers'          => $offer_catalog,
    'potentialAction' => array(
        '@type'  => 'ContactAction',
        'name'   => 'Request Free SEO Audit',
        'target' => home_url( '/website-audit/' ),
    ),
    'isRelatedTo'     => array(
        array( '@type' => 'Service', 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'url' => $parent_url ),
    ),
) );

// Breadcrumb: Home > Services > SEO-Ready Website > WordPress.
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'item' => $parent_url ),
        array( '@type' => 'ListItem', 'position' => 4, 'name' => 'รับทำเว็บไซต์ WordPress', 'item' => $page_url ),
    ),
) );

// FAQPage + Speakable — mirrors the visible accordion 1:1.
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array(
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
    );
}
hashbox_jsonld( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    '@id'        => $page_url . '#faq',
    'inLanguage' => 'th',
    'speakable'  => array(
        '@type'       => 'SpeakableSpecification',
        'cssSelector' => array( '.hb-accordion__trigger', '.hb-accordion__content', '#answer .hb-answer-box' ),
    ),
    'mainEntity' => $faq_entities,
) );

// Person (Author / E-E-A-T).
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Person',
    '@id'         => home_url( '/#founder' ),
    'name'        => $author_name,
    'jobTitle'    => $author_role,
    'description' => $author_bio,
    'url'         => $page_url,
    'worksFor'    => array( '@id' => home_url( '/#organization' ) ),
    'sameAs'      => array( $author_linkedin ),
    'knowsAbout'  => array( 'WordPress', 'Headless WordPress', 'Next.js', 'Technical SEO', 'Core Web Vitals', 'Schema.org', 'Performance Engineering' ),
) );

get_footer();
