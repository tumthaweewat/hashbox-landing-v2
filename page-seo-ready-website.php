<?php
/**
 * Template Name: Service: SEO-Ready Website
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
$desc = 'รับทำเว็บไซต์ครบวงจร ทั้งเว็บไซต์บริษัท เว็บแอปพลิเคชัน และระบบเชื่อมต่อฐานข้อมูล พร้อมวางโครงสร้างเว็บไซต์ให้พร้อมติด Google และ AI Search ตั้งแต่วันแรก';

$author_name      = 'Tum Thaweewat';
$author_role      = 'Head of Tech';
$author_linkedin  = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio       = '17 ปีประสบการณ์ Technical SEO + Performance Engineering · ผ่านโปรเจกต์ SEO migration 50+ เคส · Cert: Google Analytics, Search Console, Cloudflare Performance Engineer';

$faqs = array(
    array( 'q' => 'รับทำเว็บไซต์ SEO-Ready ราคาเริ่มต้นเท่าไหร่?', 'a' => 'Landing Page เริ่ม 80,000 บาท · Corporate Site 200,000 บาท · E-commerce 350,000 บาท · Enterprise 500,000+ บาท ทุก quote ออกหลัง Audit ฟรี' ),
    array( 'q' => 'ใช้เวลาทำเว็บไซต์ SEO-Ready นานเท่าไหร่?', 'a' => 'Landing Page 2-3 สัปดาห์ · Corporate Site 4-6 สัปดาห์ · E-commerce 6-10 สัปดาห์ · ระบบซับซ้อน 8-14 สัปดาห์ Discovery + Audit ฟรีก่อนเริ่มเสมอ' ),
    array( 'q' => 'ทำไมต้องเลือก SEO-Ready Website แทนเว็บทั่วไป?', 'a' => 'เว็บทั่วไปต้องทำ Technical SEO Audit หลังเปิดตัว 2-3 รอบกว่าจะติด Google ของเราผ่าน Build Gate ตั้งแต่ก่อน Deploy: Lighthouse 100, CWV เขียว, Schema ครบ Googlebot Index ได้ตั้งแต่ Crawl แรก ลด time-to-rank จาก 6 เดือนเหลือ 1-2 เดือนในหลายอุตสาหกรรม' ),
    array( 'q' => 'มาตรฐาน Lighthouse 100 ทำได้จริงทุกเคส?', 'a' => 'การันตี 95+ ทุกเคส และ 100/100/100/100 ในเคสที่ Stack ของเราควบคุมได้ (Next.js/Astro บน Vercel/Cloudflare) WordPress + Heavy Plugins อยู่ที่ 92-98 ขึ้นกับ Plugin Stack' ),
    array( 'q' => 'ใช้ Tech Stack อะไร เลือกได้ไหม?', 'a' => 'เลือกได้ตามโจทย์ Next.js + Headless WordPress สำหรับ Performance สูงสุด · WordPress Custom Theme สำหรับทีมที่ต้องแก้ Content เอง · Astro/11ty สำหรับ Marketing Site เน้น Speed' ),
    array( 'q' => 'Schema Markup ที่ติดตั้งให้มีอะไรบ้าง?', 'a' => 'Organization, ProfessionalService, WebSite, BreadcrumbList ทุกหน้า · Article + Person บนบทความ · Service บนหน้าบริการ · FAQPage + Speakable · LocalBusiness ถ้ามี Office · HowTo + Product ตามเคส validate ผ่าน Schema.org Validator + Google Rich Results Test' ),
    array( 'q' => 'รวม AI Search Optimization (GEO) ด้วยหรือไม่?', 'a' => 'รวมในทุก package ครอบคลุม robots.txt opt-in ChatGPT/Claude/Perplexity/Google AI Overviews · llms.txt + llms-full.txt · Speakable schema · passage-level citation optimization · entity disambiguation ผ่าน sameAs + Wikidata' ),
    array( 'q' => 'รับ migrate จากเว็บ WordPress เดิมไหม?', 'a' => 'รับ migration จาก WordPress, Wix, Webflow, Shopify, Magento รักษา URL structure เดิม + 301 redirect map ครบ · ไม่เสีย ranking · ตรวจ canonical, hreflang, schema ก่อน launch' ),
    array( 'q' => 'Hashbox ต่างจาก SEO Agency ทั่วไปอย่างไร?', 'a' => 'SEO Agency รับ optimize เว็บที่มีอยู่แล้ว · Hashbox build เว็บใหม่ที่ผ่าน technical SEO ตั้งแต่ deploy ครั้งแรก หมายความว่าไม่ต้องเสียเวลาแก้ schema, fix CWV, ทำ technical audit หลังเปิดตัว ประหยัด 3-6 เดือน' ),
    array( 'q' => 'Maintenance + monitoring หลังเปิดตัวรวมหรือไม่?', 'a' => 'รวม monitoring 30 วันแรก (CWV alerts, Search Console errors, uptime) · มี Care Plan รายเดือนเสริม 15,000-50,000 บาท/เดือน ครอบคลุม updates, monitoring, content updates, ranking reports' ),
    array( 'q' => 'รับประกัน Lighthouse 100 จริงหรือ ถ้าไม่ถึงคืนเงินหรือไม่?', 'a' => 'การันตี Lighthouse 95+ Mobile / 100 Desktop ถ้าไม่ถึงเป้าใน 14 วันหลัง launch refund 100% ของ Performance Engineering fee (~20-30% ของโปรเจกต์) เงื่อนไข: ใช้ Stack ที่เราแนะนำ + ไม่ติดตั้ง heavy 3rd-party plugin เพิ่ม' ),
    array( 'q' => 'ส่งมอบ source code ครบไหม สามารถย้ายเซิร์ฟเวอร์ได้ไหม?', 'a' => 'ส่งมอบ source code + Git repository + documentation ครบ · เป็นเจ้าของ 100% · ย้าย hosting ได้อิสระ · ไม่มี vendor lock-in · ไม่มี proprietary platform fee' ),
);

$deliverables = array(
    'Technical SEO Audit Report 15-20 หน้า',
    'Lighthouse 95+ Mobile / 100 Desktop',
    'Core Web Vitals เขียว (LCP <2.5s, INP <200ms, CLS <0.1)',
    'Schema.org markup ครบ 8+ types',
    'robots.txt + sitemap.xml auto-submit',
    'Canonical + OG + Twitter Card ทุกหน้า',
    'Hreflang สำหรับ multilingual',
    'Mobile-First Responsive 320-1920px',
    'WCAG 2.1 AA Accessibility',
    'Security Headers เกรด A+',
    'PDPA Cookie Consent v2',
    'GA4 + GSC + Tag Manager setup',
    'llms.txt + llms-full.txt สำหรับ AI Search',
    'AI Crawler opt-in (ChatGPT, Claude, Perplexity, Google AI)',
    '301 redirect map (สำหรับ migration)',
    'CI/CD Pipeline + automated SEO tests',
    'Source code + Git repository',
    'Documentation 20-30 หน้า',
    'Training session 2 ชั่วโมง',
    '30-day post-launch monitoring',
);

$process = array(
    array( 'name' => 'Discovery + SEO Audit', 'time' => 'Week 1', 'detail' => 'สัมภาษณ์ทีม, วิเคราะห์ competitor, keyword research, technical audit ของเว็บเดิม (ถ้ามี)' ),
    array( 'name' => 'Architecture + Schema Design', 'time' => 'Week 1-2', 'detail' => 'ออกแบบ URL structure, schema graph, content hierarchy, internal linking map' ),
    array( 'name' => 'UI/UX Design', 'time' => 'Week 2-3', 'detail' => 'Figma wireframes + high-fidelity mockups, design system, mobile-first layouts' ),
    array( 'name' => 'Build + CI Gate', 'time' => 'Week 3-5', 'detail' => 'Develop frontend + CMS · CI pipeline บังคับผ่าน Build Gate 12 ข้อก่อน merge · daily Lighthouse runs' ),
    array( 'name' => 'Launch + GSC Submission', 'time' => 'Week 5-6', 'detail' => 'Production deploy, DNS migration, GSC + Bing Webmaster submit, request indexing ทุกหน้า' ),
    array( 'name' => '30-day Monitoring', 'time' => 'Week 6-10', 'detail' => 'CWV alerts, crawl error monitoring, ranking tracking, optimization rounds' ),
);

$pricing = array(
    array( 'tier' => 'Landing Page', 'price' => 80000, 'pages' => '1-3 หน้า', 'time' => '2-3 สัปดาห์', 'fit' => 'Product launch, campaign, lead-gen' ),
    array( 'tier' => 'Corporate Site', 'price' => 200000, 'pages' => '5-15 หน้า', 'time' => '4-6 สัปดาห์', 'fit' => 'B2B, agency, professional service' ),
    array( 'tier' => 'E-commerce', 'price' => 350000, 'pages' => '20-100 หน้า', 'time' => '6-10 สัปดาห์', 'fit' => 'WooCommerce, Shopify, custom catalog' ),
    array( 'tier' => 'Enterprise', 'price' => 500000, 'pages' => '50+ หน้า · custom', 'time' => '8-14 สัปดาห์', 'fit' => 'Multi-language, headless, integration หนัก' ),
);

$cases = array(
    array(
        'name'    => 'Nexus Corp',
        'tag'     => 'Headless WordPress + Next.js Migration',
        'metric1' => 'Users +540%',
        'metric2' => 'LCP 4.2s → 1.1s',
        'metric3' => 'Lighthouse 42 → 100',
        'url'     => '/work/nexus-corp/',
    ),
    array(
        'name'    => 'Rank Project',
        'tag'     => 'Technical SEO + Content Programme',
        'metric1' => 'Impressions +2,200%',
        'metric2' => 'Ranking page 8 → page 1',
        'metric3' => 'Clicks +1,800%',
        'url'     => '/work/rank-project/',
    ),
    array(
        'name'    => 'Benjanard Studio',
        'tag'     => 'Portfolio + Brand Site Rebuild',
        'metric1' => 'Lighthouse 98/100/100/100',
        'metric2' => 'TTFB 1.8s → 220ms',
        'metric3' => 'Indexed pages 3 → 47',
        'url'     => '/work/',
    ),
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
            <span class="hb-eyebrow">Service 01 / 03 · Updated <?php echo esc_html( date_i18n( 'F Y' ) ); ?></span>
            <h1 class="hb-hero__title">รับทำเว็บไซต์<br><em>SEO-Ready</em><br>พัฒนาเว็บให้พร้อมติด Google</h1>
            <p class="hb-hero__sub"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:inherit;text-decoration:underline;text-decoration-color:var(--hb-accent-blue,#2563EB);text-underline-offset:0.18em;">Hashbox</a> รับทำเว็บไซต์ธุรกิจด้วยโครงสร้างที่รองรับการติดอันดับบน Google และติด AI Search ดูแลตั้งแต่ Website Performance, Technical SEO ไปจนถึง User Experience ทุกเว็บต้องผ่านมาตรฐาน Lighthouse 100 พร้อม Core Web Vitals ระดับสีเขียว และมีระบบ Sitemap Auto-Submit เพื่อให้ Google เข้าถึงและจัดอันดับเว็บไซต์ได้เร็วขึ้น เพราะการวางรากฐานเว็บไซต์ที่แข็งแรงและถูกต้องตั้งแต่ต้น คือปัจจัยสำคัญที่ช่วยให้การติด Google และ AI Search เป็นเรื่องง่ายและยั่งยืนกว่า</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงานที่ผ่านมา</a>
            </div>
            <div class="hb-trustbar" style="margin-top:var(--hb-space-8);display:flex;flex-wrap:wrap;gap:var(--hb-space-5);align-items:center;color:var(--hb-text-muted,#a1a1aa);font-size:var(--hb-text-sm);">
                <span>✓ Lighthouse 95+ การันตี</span>
                <span>✓ Core Web Vitals เขียว</span>
                <span>✓ Sitemap Auto-Submit</span>
                <span>✓ AI Search Ready</span>
                <span>✓ WCAG 2.1 AA</span>
                <span>✓ ส่งมอบ source code</span>
            </div>
        </div>
    </div>
</section>

<!-- Website Types -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Website Development</span>
            <h2 class="hb-h2">รับทำเว็บไซต์ธุรกิจทุกประเภท รองรับทุกการใช้งาน</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">บริการรับทำเว็บไซต์ครบวงจรสำหรับธุรกิจที่ต้องการเว็บพร้อมใช้งานจริง ตั้งแต่เว็บไซต์บริษัท เว็บแอปพลิเคชัน ไปจนถึงระบบเชื่อมต่อฐานข้อมูล โดยวางโครงสร้างให้พร้อมสำหรับ Google และ AI Search ตั้งแต่วันแรก</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:var(--hb-space-4);">
            <div class="hb-card hb-card--elevated">
                <span class="hb-eyebrow">Corporate Website</span>
                <h3 class="hb-card__title">เว็บไซต์บริษัทและบริการ</h3>
                <p class="hb-card__body">ออกแบบโครงสร้างหน้าเว็บให้สื่อสารบริการชัดเจน รองรับ SEO, lead generation, analytics และการดูแล content ต่อในระยะยาว</p>
            </div>
            <div class="hb-card hb-card--elevated">
                <span class="hb-eyebrow">Web Application</span>
                <h3 class="hb-card__title">เว็บแอปพลิเคชันสำหรับธุรกิจ</h3>
                <p class="hb-card__body">พัฒนา frontend, backend และระบบสมาชิกหรือ workflow เฉพาะทาง โดยคุม performance, security และ user experience ตั้งแต่วันแรก</p>
            </div>
            <div class="hb-card hb-card--elevated">
                <span class="hb-eyebrow">Data Integration</span>
                <h3 class="hb-card__title">ระบบเชื่อมต่อฐานข้อมูล</h3>
                <p class="hb-card__body">เชื่อมต่อ CRM, ERP, API, dashboard หรือระบบหลังบ้าน เพื่อให้เว็บไซต์เป็นฐานข้อมูลและช่องทางขายที่วัดผลได้จริง</p>
            </div>
        </div>
    </div>
</section>

<!-- ANSWER BLOCK (GEO citation passage) -->
<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">คำตอบสั้น</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>SEO-Ready Website คือเว็บไซต์ที่ผ่าน Build Gate กว่า 12 ขั้นตอนก่อน Deploy ขึ้น Production</strong> ครอบคลุมทั้ง Lighthouse Score 100, Core Web Vitals ระดับสีเขียวทุกค่า รวมถึงการติดตั้ง Schema.org Markup เพื่อช่วยให้ Search Engine เข้าใจเนื้อหาและธุรกิจได้ถูกต้องและแม่นยำ นอกจากนี้ยังมีการตั้งค่า Canonical, Robots.txt และ Sitemap พร้อม Auto Submit ไปยัง Google และ Bing รวมถึงรองรับ AI Crawlers จากแพลตฟอร์มที่กลุ่มเป้าหมายของทุกธุรกิจนิยมใช้อย่าง ChatGPT, Claude, Gemini, Google AI Overviews และ AI Mode
            </p>
        </div>
        <blockquote style="margin-top:var(--hb-space-5);padding:var(--hb-space-5);border-left:4px solid var(--hb-accent-cyan,#06B6D4);background:var(--hb-bg,#09090B);border-radius:var(--hb-radius-md,8px);">
            <p class="hb-lead">ทุกเว็บไซต์ที่มาจาก Hashbox จะถูก Index และเริ่มแข่งขันบน Search Engine ได้ตั้งแต่การ Crawl ครั้งแรก ช่วยลดระยะเวลาในการทำอันดับจากเดิมประมาณ 6 เดือน เหลือเพียง 1-2 เดือนในหลายอุตสาหกรรม</p>
        </blockquote>
    </div>
</section>

<!-- PROBLEM -->
<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">ปัญหา</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทำไมเว็บส่วนใหญ่ไม่ติด Google ใน 6 เดือนแรก</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">จากประสบการณ์ดูแลเว็บไซต์ธุรกิจกว่า 50+ โปรเจกต์ เราพบว่าเว็บไซต์จำนวนมากมักถูกพัฒนาโดยข้ามขั้นตอน Technical SEO ตั้งแต่ต้น ส่งผลให้ต้องเสียเวลาและงบประมาณกลับมาแก้ไขหลัง Launch และเป็นสาเหตุสำคัญที่ทำให้เว็บไซต์ยังไม่ติดอันดับบน Google หรือ AI Search</p>
        <div class="hb-bento" style="margin-top:var(--hb-space-6);">
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Indexation</span>
                <h3 class="hb-card__title">Google Index หน้าเว็บได้ไม่ครบ</h3>
                <p class="hb-card__body">robots.txt ผิด, ไม่ส่ง Sitemap หรือใช้ JS-rendered content โครงสร้างที่ Google อ่านยากทำให้หน้าเว็บ Index ได้แค่ 30-50%</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Core Web Vitals</span>
                <h3 class="hb-card__title">เว็บโหลดช้า กระทบอันดับ SEO</h3>
                <p class="hb-card__body">ใช้ Plugin หนัก โหลดไฟล์ CSS/JS มากเกิน หรือไม่มี Image Preload ทำให้ Core Web Vitals ไม่ผ่านเกณฑ์ LCP เกิน 2.5s และ INP เกิน 200ms</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Schema</span>
                <h3 class="hb-card__title">Schema ไม่มี / ผิด Validation</h3>
                <p class="hb-card__body">ไม่มี Schema สำคัญ เช่น Organization, Service, FAQ หรือ Breadcrumb ทำให้ Google ไม่แสดง Rich Snippets จนเสีย CTR 30-40%</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">AI Search</span>
                <h3 class="hb-card__title">เว็บไซต์ไม่รองรับ AI Search</h3>
                <p class="hb-card__body">ไม่มีการตั้งค่ารองรับ AI Crawlers, ไม่มี llms.txt และ Schema ไม่ครบ Passage-level Citation ทำให้พลาดทราฟฟิกจาก AI Search ที่กำลังโตเร็ว</p>
            </div>
        </div>
    </div>
</section>

<!-- Build Gate -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Build Gate</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">รับทำเว็บไซต์ พร้อมผ่าน Build Gate กว่า 12 ขั้นตอน</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">บริการรับทำเว็บไซต์ที่มาจาก Hashbox ต้องผ่าน Build Gate ก่อน Deploy ขึ้น Production ตามเช็คลิสต์ 12 ข้อนี้ที่บังคับใน CI Pipeline — ไม่ผ่าน = ไม่ Deploy</p>
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

<!-- DELIVERABLES -->
<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Deliverables</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">สิ่งที่จะได้รับจากบริการรับทำเว็บไซต์ SEO-Ready</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">บริการรับทำเว็บไซต์พร้อมรายการ Deliverables ครบทุก Tier (ปริมาณแตกต่างตาม Scope งาน) โดยทุกอย่างเป็นมาตรฐานเดียวกันในทุกโปรเจกต์ ไม่มี Hidden Charge</p>
        <ul style="margin-top:var(--hb-space-6);display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-3);list-style:none;padding:0;">
            <?php foreach ( $deliverables as $d ) : ?>
                <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;font-size:var(--hb-text-sm);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--hb-accent-emerald)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
                    <span><?php echo esc_html( $d ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- Tech Stack -->
<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Tech Stack</span>
            <h2 class="hb-h2">เลือก Stack ตามโจทย์</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">Frontend</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Next.js</strong> — Performance สูงสุด, SSR/ISR, Vercel edge</li>
                    <li><strong>WordPress Custom</strong> — ทีม non-tech แก้ content เองได้</li>
                    <li><strong>Astro / 11ty</strong> — Marketing/Docs site เน้น speed</li>
                </ul>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">CMS</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Headless WordPress</strong> — มี ecosystem, plugin มาก</li>
                    <li><strong>Sanity</strong> — structured content, multi-channel</li>
                    <li><strong>Contentful</strong> — enterprise, multi-language</li>
                    <li><strong>Strapi</strong> — self-host, open source</li>
                </ul>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">Hosting / Edge</h3>
                <ul class="hb-prose" style="padding-left:var(--hb-space-5);font-size:var(--hb-text-sm);">
                    <li><strong>Vercel</strong> — Next.js + ISR, edge runtime</li>
                    <li><strong>Cloudflare Pages</strong> — Astro/static, free tier ดี</li>
                    <li><strong>WP Engine / Kinsta</strong> — managed WordPress</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- PROCESS TIMELINE (HowTo) -->
<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Process</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">Process 6 Phase: Discovery → Launch</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">บริการรับทำเว็บไซต์แบบ Phased Delivery วางแผนการทำงานเป็นขั้นตอน มี Milestone ชัดเจน อัปเดตความคืบหน้ารายสัปดาห์ และมีการ Sign-off ทุก Phase ก่อนเริ่มขั้นตอนถัดไป</p>
        <ol style="margin-top:var(--hb-space-6);list-style:none;padding:0;display:flex;flex-direction:column;gap:var(--hb-space-4);" itemscope itemtype="https://schema.org/HowTo">
            <?php foreach ( $process as $i => $p ) : ?>
                <li style="display:flex;gap:var(--hb-space-4);padding:var(--hb-space-5);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);border-left:3px solid var(--hb-accent-blue,#2563EB);" itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
                    <div style="flex-shrink:0;width:48px;height:48px;border-radius:50%;background:var(--hb-accent-blue,#2563EB);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:var(--hb-text-lg);"><?php echo (int) ( $i + 1 ); ?></div>
                    <div>
                        <div style="display:flex;gap:var(--hb-space-3);align-items:baseline;flex-wrap:wrap;">
                            <h3 class="hb-card__title" itemprop="name" style="margin:0;"><?php echo esc_html( $p['name'] ); ?></h3>
                            <span class="hb-eyebrow" style="color:var(--hb-accent-cyan,#06B6D4);"><?php echo esc_html( $p['time'] ); ?></span>
                        </div>
                        <p class="hb-body" itemprop="text" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $p['detail'] ); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- CASE STUDIES -->
<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Case Studies</span>
            <h2 class="hb-h2">ผลงาน SEO-Ready Website</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">3 เคสจาก 50+ โปรเจกต์ วัดผลจริงด้วย GSC, GA4, CrUX field data</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:var(--hb-space-4);">
            <?php foreach ( $cases as $c ) : ?>
                <a class="hb-card hb-card--elevated" href="<?php echo esc_url( home_url( $c['url'] ) ); ?>" style="text-decoration:none;display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <span class="hb-eyebrow"><?php echo esc_html( $c['tag'] ); ?></span>
                    <h3 class="hb-card__title"><?php echo esc_html( $c['name'] ); ?></h3>
                    <div style="display:flex;flex-direction:column;gap:var(--hb-space-2);margin-top:var(--hb-space-3);">
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric1'] ); ?></div>
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric2'] ); ?></div>
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric3'] ); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- COMPARISON TABLE -->
<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Comparison</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทำเว็บไซต์กับ Hashbox vs ทางเลือกอื่น</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">เปรียบเทียบบริการรับทำเว็บไซต์ของ Hashbox ทั้งด้าน Deliverables และผลลัพธ์ด้าน SEO/AI Search เทียบกับทางเลือกอื่นที่หลายธุรกิจกำลังพิจารณา</p>
        <div style="margin-top:var(--hb-space-6);overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:var(--hb-text-sm);min-width:680px;">
                <thead>
                    <tr style="border-bottom:2px solid var(--hb-border,#27272A);">
                        <th style="text-align:left;padding:var(--hb-space-3);">รายการ</th>
                        <th style="text-align:center;padding:var(--hb-space-3);color:var(--hb-accent-blue,#2563EB);">Hashbox</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">Agency ทั่วไป</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">Freelance</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">Template สำเร็จรูป</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = array(
                        array( 'Lighthouse 95+ การันตี', '✓', '✗', '✗', '✗' ),
                        array( 'Core Web Vitals เขียวก่อน launch', '✓', 'บางเคส', '✗', '✗' ),
                        array( 'Schema 8+ types', '✓', '2-3 types', '1-2 types', '0-1 types' ),
                        array( 'AI Search / GEO ready', '✓', '✗', '✗', '✗' ),
                        array( 'WCAG 2.1 AA', '✓', 'บางเคส', '✗', '✗' ),
                        array( 'ส่งมอบ source code', '✓', 'บางเคส', '✓', '✗ (locked)' ),
                        array( '301 Redirect Map (migration)', '✓', 'เพิ่ม fee', '✗', '✗' ),
                        array( 'Care plan + monitoring', '✓ (optional)', '✓ (mandatory)', '✗', '✗' ),
                        array( 'ราคาเริ่มต้น', '80k บาท', '150k-500k', '30k-100k', '5k-20k' ),
                        array( 'Time-to-rank (เฉลี่ย)', '4-8 สัปดาห์', '4-6 เดือน', '6-12 เดือน', 'ไม่การันตี' ),
                    );
                    foreach ( $rows as $r ) :
                    ?>
                    <tr style="border-bottom:1px solid var(--hb-border,#27272A);">
                        <td style="padding:var(--hb-space-3);"><?php echo esc_html( $r[0] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-accent-emerald,#10B981);font-weight:600;"><?php echo esc_html( $r[1] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[2] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[3] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[4] ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- PRICING TIERS -->
<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">ราคาบริการรับทำเว็บไซต์ SEO-Ready</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">ราคาบริการรับทำเว็บไซต์ทุก Tier มาพร้อม Build Gate 12 ขั้นตอน และ Deliverables 20 รายการ มาตรฐานเดียวกันทุกโปรเจกต์ โดยราคาจะต่างกันตาม Scope งาน จำนวนหน้าเว็บไซต์ และระดับความซับซ้อนของระบบ</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:var(--hb-space-4);">
            <?php foreach ( $pricing as $p ) : ?>
                <div class="hb-card hb-card--elevated" style="display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <h3 class="hb-card__title"><?php echo esc_html( $p['tier'] ); ?></h3>
                    <div style="font-size:var(--hb-text-xl,1.5rem);font-weight:700;color:var(--hb-accent-blue,#2563EB);">
                        เริ่มต้น <?php echo esc_html( number_format( $p['price'] ) ); ?> บาท
                    </div>
                    <div style="font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);">
                        <div>📄 <?php echo esc_html( $p['pages'] ); ?></div>
                        <div>⏱ <?php echo esc_html( $p['time'] ); ?></div>
                    </div>
                    <p class="hb-card__body" style="font-size:var(--hb-text-sm);"><strong>เหมาะกับ:</strong> <?php echo esc_html( $p['fit'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:var(--hb-space-5);text-align:center;font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);">ราคาไม่รวม VAT 7% · ไม่มี hidden fee · quote ปิดหลัง Audit ฟรี</p>
    </div>
</section>

<!-- BEST FIT -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Best fit</span>
            <h2 class="hb-h2">บริการรับทำเว็บไซต์ SEO-Ready เหมาะกับใคร</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">เหมาะสำหรับธุรกิจที่ไม่อยากเสียเวลาและงบประมาณมาแก้ปัญหา Technical SEO หลังเว็บไซต์เปิดใช้งาน รองรับทั้งการทำ SEO, Performance Marketing, CRO (Conversion Rate Optimization) และ AI Search โดยเฉพาะธุรกิจที่ต้องการใช้เว็บไซต์เป็นช่องทางสร้างยอดขาย สร้าง Lead และแข่งขันบน Google อย่างจริงจัง</p>
        </div>
        <div class="hb-bento">
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/work/nexus-corp/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Corporate SEO</span>
                <h3 class="hb-card__title">Corporate site ที่ช้าและ index ไม่ครบ</h3>
                <p class="hb-card__body">ดู Nexus Corp case study ที่ย้ายจาก legacy WordPress เป็น Headless WordPress + Next.js จน users เพิ่ม +540%</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/work/rank-project/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">SEO Recovery</span>
                <h3 class="hb-card__title">เว็บมีสินค้า/บริการดี แต่ organic search ไม่โต</h3>
                <p class="hb-card__body">ดู Rank Project case study ที่ technical SEO + content programme เพิ่ม impressions +2,200%</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Next step</span>
                <h3 class="hb-card__title">หลังเว็บพร้อม SEO แล้ว ควรวัด Conversion ต่อ</h3>
                <p class="hb-card__body">ต่อยอดด้วย Digital Marketing + CRO เพื่อติดตาม funnel, heatmap และทดสอบ landing page รายเดือน</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Full funnel</span>
                <h3 class="hb-card__title">ต้องการทีมเดียวดูทั้ง Web, Marketing และ AI</h3>
                <p class="hb-card__body">ดูภาพรวมบริการทั้งหมดของ Hashbox Studio เพื่อวาง roadmap 90/180/365 วัน</p>
            </a>
        </div>
    </div>
</section>

<!-- TEAM / AUTHOR -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Author / Team</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทีมที่รับผิดชอบโปรเจกต์</h2>
        <div style="margin-top:var(--hb-space-6);display:flex;gap:var(--hb-space-5);padding:var(--hb-space-5);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);flex-wrap:wrap;" itemscope itemtype="https://schema.org/Person">
            <div style="flex-shrink:0;width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--hb-accent-blue,#2563EB),var(--hb-accent-cyan,#06B6D4));display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;font-weight:700;">T</div>
            <div style="flex:1;min-width:240px;">
                <h3 class="hb-card__title" itemprop="name" style="margin:0;"><?php echo esc_html( $author_name ); ?></h3>
                <p style="margin-top:var(--hb-space-2);font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);" itemprop="jobTitle"><?php echo esc_html( $author_role ); ?></p>
                <p class="hb-body" style="margin-top:var(--hb-space-3);" itemprop="description"><?php echo esc_html( $author_bio ); ?></p>
                <a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener author" target="_blank" style="display:inline-block;margin-top:var(--hb-space-3);font-size:var(--hb-text-sm);color:var(--hb-accent-blue,#2563EB);" itemprop="sameAs">LinkedIn →</a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="hb-section">
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

<!-- RELATED -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Related</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">บทความที่เกี่ยวข้อง</h2>
        <div style="margin-top:var(--hb-space-6);display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:var(--hb-space-3);">
            <a class="hb-card" href="<?php echo esc_url( home_url( '/technical-seo-guide/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Guide</span>
                <h3 class="hb-card__title">Technical SEO คือ? คู่มือ 2026</h3>
            </a>
            <a class="hb-card" href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">GEO</span>
                <h3 class="hb-card__title">GEO คืออะไร? AI Search Optimization</h3>
            </a>
            <a class="hb-card" href="<?php echo esc_url( home_url( '/nextjs-vs-wordpress-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Compare</span>
                <h3 class="hb-card__title">Next.js vs WordPress 2026</h3>
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มด้วย Audit ฟรี</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ SEO + Performance Audit Report 15-20 หน้า ภายใน 3 วันทำการ · ไม่มี commitment · ไม่มี up-sell</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
// ---------- Schemas ----------

// Service + offers
$offer_catalog = array();
foreach ( $pricing as $p ) {
    $offer_catalog[] = array(
        '@type' => 'Offer',
        'name'  => $p['tier'],
        'price' => (string) $p['price'],
        'priceCurrency' => 'THB',
        'priceSpecification' => array(
            '@type' => 'PriceSpecification',
            'price' => (string) $p['price'],
            'priceCurrency' => 'THB',
            'valueAddedTaxIncluded' => false,
        ),
        'description' => $p['fit'] . ' · ' . $p['pages'] . ' · ' . $p['time'],
        'availability' => 'https://schema.org/InStock',
        'areaServed' => 'TH',
    );
}

hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    '@id' => $page_url . '#service',
    'name' => 'รับทำเว็บไซต์ SEO-Ready',
    'description' => $desc,
    'url' => $page_url,
    'provider' => array( '@id' => home_url( '/#organization' ) ),
    'areaServed' => array(
        '@type' => 'Country',
        'name' => 'Thailand',
    ),
    'serviceType' => 'SEO Website Development',
    'category' => 'Web Development',
    'audience' => array(
        '@type' => 'BusinessAudience',
        'audienceType' => 'B2B, SMB, Enterprise',
    ),
    'hasOfferCatalog' => array(
        '@type' => 'OfferCatalog',
        'name' => 'SEO-Ready Website Pricing Tiers',
        'itemListElement' => $offer_catalog,
    ),
    'offers' => $offer_catalog,
    'potentialAction' => array(
        array(
            '@type'  => 'ContactAction',
            'name'   => 'Request Free SEO Audit',
            'target' => home_url( '/#contact' ),
        ),
        array(
            '@type'  => 'ReserveAction',
            'name'   => 'Book Discovery Call',
            'target' => home_url( '/#contact' ),
        ),
    ),
    'termsOfService' => home_url( '/privacy-policy/#terms' ),
    'isRelatedTo' => array(
        array( '@type' => 'Service', 'name' => 'Technical SEO Audit', 'url' => home_url( '/technical-seo-guide/' ) ),
        array( '@type' => 'Service', 'name' => 'AI Consulting', 'url' => home_url( '/services/ai-consulting/' ) ),
    ),
) );

// Breadcrumb
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'item' => $page_url ),
    ),
) );

// FAQPage + Speakable (expanded selectors)
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array(
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
    );
}
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    '@id' => $page_url . '#faq',
    'speakable' => array(
        '@type' => 'SpeakableSpecification',
        'cssSelector' => array( '.hb-accordion__trigger', '.hb-accordion__content', '.hb-answer-box', '.hb-hero__sub' ),
    ),
    'mainEntity' => $faq_entities,
) );

// HowTo (Process)
$howto_steps = array();
foreach ( $process as $i => $p ) {
    $howto_steps[] = array(
        '@type' => 'HowToStep',
        'position' => $i + 1,
        'name' => $p['name'],
        'text' => $p['detail'],
        'timeRequired' => $p['time'],
    );
}
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'HowTo',
    '@id' => $page_url . '#process',
    'name' => 'Process 6 Phase: Discovery to Launch',
    'description' => 'ขั้นตอนบริการรับทำเว็บไซต์ SEO-Ready แบบ phased delivery ตั้งแต่ Discovery ถึง Launch และ Monitoring',
    'totalTime' => 'P6W',
    'step' => $howto_steps,
) );

// Person (Author / E-E-A-T)
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    '@id' => home_url( '/#founder' ),
    'name' => $author_name,
    'jobTitle' => $author_role,
    'description' => $author_bio,
    'url' => $page_url,
    'worksFor' => array( '@id' => home_url( '/#organization' ) ),
    'sameAs' => array( $author_linkedin ),
    'knowsAbout' => array( 'Technical SEO', 'Core Web Vitals', 'Schema.org', 'Generative Engine Optimization', 'Next.js', 'WordPress', 'Performance Engineering' ),
) );

get_footer();
