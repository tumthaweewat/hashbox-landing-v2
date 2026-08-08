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

$process_icons = array(
    '<path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>',
    '<path d="M3 7h18"/><path d="M7 7v14"/><path d="M17 7v14"/><path d="M5 21h14"/><path d="M8 3h8l2 4H6l2-4Z"/>',
    '<rect width="18" height="14" x="3" y="5" rx="2"/><path d="M7 9h10"/><path d="M7 13h6"/>',
    '<path d="m13 2-2 9h7l-8 11 2-9H5l8-11Z"/>',
    '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/>',
    '<path d="M3 12h4l3 8 4-16 3 8h4"/>',
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

$case_bars = array(
    array( 28, 42, 66, 92 ),
    array( 18, 36, 72, 100 ),
    array( 24, 34, 62, 86 ),
);

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
?>

<style>
    .hb-srw-page {
        --srw-bg: var(--hb-bg, #09090b);
        --srw-surface: var(--hb-bg-elevated, #18181b);
        --srw-line: rgba(255, 255, 255, .1);
        --srw-muted: var(--hb-text-muted, #a1a1aa);
        --srw-soft: var(--hb-text-soft, #d4d4d8);
        --srw-text: var(--hb-text, #f4f4f5);
        --srw-blue: var(--hb-accent-blue, #5452ff);
        --srw-cyan: var(--hb-accent-cyan, #06b6d4);
        --srw-green: var(--hb-accent-emerald, #10b981);
        --srw-amber: var(--hb-accent-amber, #f59e0b);
        --srw-radius: var(--hb-radius-md, 8px);
        background:
            linear-gradient(rgba(255, 255, 255, .025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .025) 1px, transparent 1px),
            var(--srw-bg);
        background-size: 72px 72px;
        color: var(--srw-text);
    }

    .hb-srw-section {
        padding: clamp(72px, 8vw, 112px) 0;
        border-top: 1px solid rgba(255, 255, 255, .06);
    }

    .hb-srw-section--surface {
        background: linear-gradient(180deg, rgba(255, 255, 255, .035), rgba(255, 255, 255, .012));
    }

    .hb-srw-head {
        max-width: 920px;
        margin-bottom: var(--hb-space-8, 3rem);
    }

    .hb-srw-head .hb-lead {
        margin-top: var(--hb-space-4, 1rem);
    }

    .hb-srw-hero {
        position: relative;
        min-height: 840px;
        display: grid;
        align-items: center;
        padding: clamp(80px, 10vw, 132px) 0 clamp(76px, 9vw, 120px);
        border-top: 0;
        overflow: hidden;
    }

    .hb-srw-hero:before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(9, 9, 11, .98) 0%, rgba(9, 9, 11, .91) 46%, rgba(9, 9, 11, .6) 100%),
            linear-gradient(135deg, rgba(84, 82, 255, .24), transparent 38%),
            linear-gradient(315deg, rgba(6, 182, 212, .14), transparent 34%);
        pointer-events: none;
    }

    .hb-srw-hero__inner {
        position: relative;
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(390px, .72fr);
        gap: clamp(36px, 5vw, 64px);
        align-items: center;
    }

    .hb-srw-hero .hb-breadcrumb {
        margin-bottom: var(--hb-space-6, 2rem);
    }

    .hb-srw-hero__sub {
        max-width: 820px;
        margin-top: var(--hb-space-6, 2rem);
    }

    .hb-srw-hero__actions,
    .hb-srw-trustbar {
        display: flex;
        flex-wrap: wrap;
        gap: var(--hb-space-3, .75rem);
        margin-top: var(--hb-space-6, 2rem);
    }

    .hb-srw-trustbar {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: var(--hb-space-3, .75rem);
        margin-top: var(--hb-space-7, 2.5rem);
    }

    .hb-srw-chip,
    .hb-srw-mini-card,
    .hb-srw-card {
        border: 1px solid var(--srw-line);
        border-radius: var(--srw-radius);
        background: rgba(255, 255, 255, .04);
    }

    .hb-srw-chip {
        min-height: 48px;
        display: flex;
        align-items: center;
        gap: var(--hb-space-2, .5rem);
        padding: var(--hb-space-2, .5rem) var(--hb-space-3, .75rem);
        color: var(--srw-soft);
        font-size: var(--hb-text-sm, .875rem);
    }

    .hb-srw-icon {
        width: 22px;
        height: 22px;
        flex: 0 0 auto;
        color: var(--srw-blue);
    }

    .hb-srw-dashboard {
        position: relative;
        padding: clamp(16px, 2vw, 22px);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 14px;
        background: rgba(18, 18, 23, .72);
        box-shadow: 0 28px 90px rgba(0, 0, 0, .36);
        backdrop-filter: blur(18px);
    }

    .hb-srw-dashboard__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--hb-space-3, .75rem);
        padding-bottom: var(--hb-space-4, 1rem);
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .hb-srw-dots {
        display: flex;
        gap: 7px;
    }

    .hb-srw-dots span {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: #3f3f46;
    }

    .hb-srw-status {
        color: var(--srw-green);
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 12px;
        font-weight: 700;
    }

    .hb-srw-score {
        display: grid;
        grid-template-columns: 150px 1fr;
        gap: var(--hb-space-4, 1rem);
        align-items: center;
        padding: var(--hb-space-5, 1.5rem) 0 var(--hb-space-4, 1rem);
    }

    .hb-srw-ring {
        width: 150px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background:
            radial-gradient(circle at center, var(--srw-surface) 0 54%, transparent 55%),
            conic-gradient(var(--srw-green) 0 96%, rgba(255, 255, 255, .1) 96% 100%);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08);
        text-align: center;
    }

    .hb-srw-ring strong {
        display: block;
        font-size: 2.5rem;
        line-height: 1;
    }

    .hb-srw-ring span,
    .hb-srw-metric span,
    .hb-srw-flow span {
        color: var(--srw-muted);
        font-size: var(--hb-text-xs, .75rem);
    }

    .hb-srw-metric-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: var(--hb-space-2, .5rem);
    }

    .hb-srw-metric {
        min-height: 82px;
        padding: var(--hb-space-3, .75rem);
        border: 1px solid rgba(255, 255, 255, .09);
        border-radius: var(--srw-radius);
        background: rgba(255, 255, 255, .035);
    }

    .hb-srw-metric b {
        display: block;
        font-size: 1.35rem;
        line-height: 1.1;
    }

    .hb-srw-flow {
        display: grid;
        gap: var(--hb-space-2, .5rem);
    }

    .hb-srw-flow__row {
        display: grid;
        grid-template-columns: 24px 1fr auto;
        gap: var(--hb-space-3, .75rem);
        align-items: center;
        padding: var(--hb-space-3, .75rem);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: var(--srw-radius);
        background: rgba(9, 9, 11, .52);
    }

    .hb-srw-flow strong {
        color: var(--srw-soft);
        font-size: var(--hb-text-sm, .875rem);
    }

    .hb-srw-case-grid,
    .hb-srw-problem-grid,
    .hb-srw-stack-grid,
    .hb-srw-price-grid,
    .hb-srw-related-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: var(--hb-space-4, 1rem);
    }

    .hb-srw-card {
        padding: clamp(22px, 2.5vw, 32px);
        box-shadow: 0 18px 70px rgba(0, 0, 0, .22);
    }

    .hb-srw-case {
        position: relative;
        min-height: 320px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        overflow: hidden;
    }

    .hb-srw-case:before {
        content: "";
        position: absolute;
        inset: 0;
        border-top: 3px solid var(--srw-green);
        opacity: .8;
        pointer-events: none;
    }

    .hb-srw-case .hb-card__title {
        margin-top: var(--hb-space-4, 1rem);
    }

    .hb-srw-chart {
        display: flex;
        align-items: end;
        gap: 8px;
        height: 74px;
        margin-top: var(--hb-space-6, 2rem);
    }

    .hb-srw-bar {
        width: 100%;
        border-radius: 5px 5px 0 0;
        background: linear-gradient(180deg, var(--srw-green), rgba(16, 185, 129, .2));
    }

    .hb-srw-metrics {
        display: grid;
        gap: var(--hb-space-2, .5rem);
        margin-top: var(--hb-space-5, 1.5rem);
        color: var(--srw-green);
        font-size: var(--hb-text-sm, .875rem);
        font-weight: 700;
    }

    .hb-srw-answer-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: var(--hb-space-5, 1.5rem);
        align-items: stretch;
    }

    .hb-srw-answer-box {
        border-left: 4px solid var(--srw-blue);
    }

    .hb-srw-quote {
        display: grid;
        align-content: center;
        text-align: center;
        background: linear-gradient(180deg, rgba(84, 82, 255, .14), rgba(255, 255, 255, .03));
    }

    .hb-srw-quote__mark {
        color: var(--srw-blue);
        font-size: 3.4rem;
        line-height: 1;
    }

    .hb-srw-quote p {
        color: var(--srw-soft);
        font-size: clamp(1.05rem, 2vw, 1.25rem);
        font-style: italic;
        font-weight: 700;
        line-height: 1.75;
    }

    .hb-srw-gate-layout {
        display: grid;
        grid-template-columns: 310px minmax(0, 1fr);
        gap: var(--hb-space-5, 1.5rem);
        align-items: start;
    }

    .hb-srw-gate-summary {
        position: sticky;
        top: 96px;
    }

    .hb-srw-gate-number {
        width: 180px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        margin: var(--hb-space-5, 1.5rem) auto;
        border-radius: 999px;
        background:
            radial-gradient(circle at center, var(--srw-surface) 0 55%, transparent 56%),
            conic-gradient(var(--srw-blue) 0 100%);
        box-shadow: 0 20px 70px rgba(84, 82, 255, .28);
        text-align: center;
    }

    .hb-srw-gate-number strong {
        display: block;
        font-size: 3rem;
        line-height: 1;
    }

    .hb-srw-check-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: var(--hb-space-3, .75rem);
    }

    .hb-srw-check {
        min-height: 144px;
        display: flex;
        flex-direction: column;
        gap: var(--hb-space-4, 1rem);
    }

    .hb-srw-check .hb-srw-icon,
    .hb-srw-problem .hb-srw-icon {
        color: var(--srw-green);
    }

    .hb-srw-problem-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .hb-srw-problem {
        min-height: 410px;
        border-color: rgba(245, 158, 11, .2);
    }

    .hb-srw-problem .hb-srw-icon {
        color: var(--srw-amber);
    }

    .hb-srw-problem .hb-card__title {
        margin-top: var(--hb-space-5, 1.5rem);
    }

    .hb-srw-deliverables {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: var(--hb-space-3, .75rem);
        padding: 0;
        margin: var(--hb-space-7, 2.5rem) 0 0;
        list-style: none;
    }

    .hb-srw-deliverables li {
        display: flex;
        gap: var(--hb-space-3, .75rem);
        align-items: flex-start;
        min-height: 64px;
        padding: var(--hb-space-4, 1rem);
        border: 1px solid var(--srw-line);
        border-radius: var(--srw-radius);
        background: rgba(255, 255, 255, .035);
    }

    .hb-srw-stack-card ul {
        display: grid;
        gap: var(--hb-space-3, .75rem);
        margin: var(--hb-space-5, 1.5rem) 0 0;
        padding-left: var(--hb-space-5, 1.5rem);
        color: var(--srw-muted);
    }

    .hb-srw-stack-title {
        display: flex;
        align-items: center;
        gap: var(--hb-space-3, .75rem);
    }

    .hb-srw-stack-icon {
        width: 52px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        border-radius: var(--srw-radius);
        background: rgba(84, 82, 255, .14);
    }

    .hb-srw-timeline {
        position: relative;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: var(--hb-space-5, 1.5rem);
        list-style: none;
        padding: 0;
        margin: var(--hb-space-7, 2.5rem) 0 0;
    }

    .hb-srw-step {
        position: relative;
        min-height: 260px;
        display: flex;
        flex-direction: column;
        gap: var(--hb-space-4, 1rem);
        overflow: visible;
    }

    .hb-srw-step:after {
        content: "";
        position: absolute;
        top: 50px;
        right: -24px;
        width: 24px;
        height: 1px;
        background: linear-gradient(90deg, rgba(84, 82, 255, .55), rgba(84, 82, 255, 0));
        pointer-events: none;
    }

    .hb-srw-step:nth-child(3n):after,
    .hb-srw-step:last-child:after {
        display: none;
    }

    .hb-srw-step__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--hb-space-3, .75rem);
    }

    .hb-srw-step__number {
        width: 38px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background: var(--srw-blue);
        color: #fff;
        font-weight: 800;
        box-shadow: 0 14px 42px rgba(84, 82, 255, .26);
    }

    .hb-srw-step__meta {
        display: flex;
        align-items: center;
        gap: var(--hb-space-3, .75rem);
    }

    .hb-srw-step__icon {
        width: 46px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        border: 1px solid rgba(129, 140, 248, .24);
        border-radius: var(--srw-radius);
        background: rgba(84, 82, 255, .12);
        color: var(--srw-blue);
    }

    .hb-srw-step__icon .hb-srw-icon {
        width: 20px;
        height: 20px;
    }

    .hb-srw-step .hb-card__title {
        margin: 0;
        max-width: 16rem;
        font-size: clamp(1.35rem, 2vw, 1.9rem);
        line-height: 1.28;
    }

    .hb-srw-step .hb-body {
        margin-top: 0;
    }

    .hb-srw-table-wrap {
        margin-top: var(--hb-space-7, 2.5rem);
        overflow-x: auto;
        border: 1px solid var(--srw-line);
        border-radius: var(--srw-radius);
        background: rgba(255, 255, 255, .035);
    }

    .hb-srw-table {
        width: 100%;
        min-width: 720px;
        border-collapse: collapse;
        font-size: var(--hb-text-sm, .875rem);
    }

    .hb-srw-table th,
    .hb-srw-table td {
        padding: var(--hb-space-4, 1rem);
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .hb-srw-table th {
        text-align: left;
        color: var(--srw-text);
        background: rgba(9, 9, 11, .45);
    }

    .hb-srw-table td:not(:first-child),
    .hb-srw-table th:not(:first-child) {
        text-align: center;
    }

    .hb-srw-price-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .hb-srw-price {
        display: flex;
        flex-direction: column;
        gap: var(--hb-space-4, 1rem);
    }

    .hb-srw-price__amount {
        color: var(--srw-blue);
        font-size: clamp(1.3rem, 2vw, 1.7rem);
        font-weight: 800;
        line-height: 1.3;
    }

    .hb-srw-best-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: var(--hb-space-4, 1rem);
    }

    .hb-srw-author {
        display: grid;
        grid-template-columns: 96px minmax(0, 1fr);
        gap: var(--hb-space-5, 1.5rem);
        align-items: center;
    }

    .hb-srw-avatar {
        width: 96px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--srw-blue), var(--srw-cyan));
        color: #fff;
        font-size: 2.4rem;
        font-weight: 800;
    }

    .hb-srw-related-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .hb-srw-cta {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: var(--hb-space-6, 2rem);
        align-items: center;
        border-color: rgba(84, 82, 255, .35);
        background: linear-gradient(135deg, rgba(84, 82, 255, .2), rgba(18, 18, 23, .88));
    }

    .hb-srw-hero__copy,
    .hb-srw-dashboard {
        animation: hbSrwFadeUp .72s cubic-bezier(.2, .8, .2, 1) both;
    }

    .hb-srw-dashboard {
        animation-delay: .12s;
    }

    .hb-srw-ring {
        animation: hbSrwScorePulse 3.8s ease-in-out infinite;
    }

    .hb-srw-bar {
        transform-origin: bottom;
    }

    .hb-srw-page.is-motion-ready .hb-srw-bar {
        opacity: .36;
        transform: scaleY(.08);
    }

    .hb-srw-page.is-motion-ready .hb-srw-case.is-visible .hb-srw-bar {
        animation: hbSrwBarGrow .92s cubic-bezier(.2, .8, .2, 1) both;
    }

    .hb-srw-case.is-visible .hb-srw-bar:nth-child(2) {
        animation-delay: .08s;
    }

    .hb-srw-case.is-visible .hb-srw-bar:nth-child(3) {
        animation-delay: .16s;
    }

    .hb-srw-case.is-visible .hb-srw-bar:nth-child(4) {
        animation-delay: .24s;
    }

    .hb-srw-card,
    .hb-srw-dashboard,
    .hb-srw-chip {
        transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
    }

    .hb-srw-page.is-motion-ready .hb-srw-reveal {
        opacity: 0;
        transform: translateY(18px);
        transition:
            opacity .56s cubic-bezier(.2, .8, .2, 1),
            transform .56s cubic-bezier(.2, .8, .2, 1),
            border-color .22s ease,
            background .22s ease,
            box-shadow .22s ease;
    }

    .hb-srw-page.is-motion-ready .hb-srw-reveal.is-visible {
        opacity: 1;
        transform: translateY(0);
        transition-delay: var(--srw-reveal-delay, 0ms);
    }

    .hb-srw-page.is-motion-ready .hb-srw-check .hb-srw-icon path {
        stroke-dasharray: 32;
        stroke-dashoffset: 32;
    }

    .hb-srw-page.is-motion-ready .hb-srw-check.is-visible .hb-srw-icon path {
        animation: hbSrwCheckDraw .48s ease forwards;
        animation-delay: calc(var(--srw-reveal-delay, 0ms) + 120ms);
    }

    .hb-srw-cta .hb-btn--gradient {
        animation: hbSrwCtaGlow 3.6s ease-in-out infinite;
    }

    @media (hover: hover) and (pointer: fine) {
        .hb-srw-card:hover,
        .hb-srw-chip:hover {
            transform: translateY(-4px);
            border-color: rgba(129, 140, 248, .38);
            background: rgba(255, 255, 255, .055);
        }

        .hb-srw-dashboard:hover {
            transform: translateY(-6px);
            border-color: rgba(129, 140, 248, .32);
        }
    }

    @keyframes hbSrwFadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes hbSrwScorePulse {
        0%,
        100% {
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08), 0 0 0 rgba(16, 185, 129, 0);
        }
        50% {
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08), 0 0 42px rgba(16, 185, 129, .18);
        }
    }

    @keyframes hbSrwBarGrow {
        from {
            transform: scaleY(.08);
            opacity: .36;
        }
        to {
            transform: scaleY(1);
            opacity: 1;
        }
    }

    @keyframes hbSrwCheckDraw {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes hbSrwCtaGlow {
        0%,
        100% {
            box-shadow: 0 18px 48px rgba(84, 82, 255, .24);
        }
        50% {
            box-shadow: 0 22px 64px rgba(84, 82, 255, .42);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .hb-srw-page *,
        .hb-srw-page *:before,
        .hb-srw-page *:after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }

    @media (max-width: 1180px) {
        .hb-srw-hero__inner,
        .hb-srw-answer-layout,
        .hb-srw-gate-layout,
        .hb-srw-cta {
            grid-template-columns: 1fr;
        }

        .hb-srw-gate-summary {
            position: static;
        }

        .hb-srw-case-grid,
        .hb-srw-problem-grid,
        .hb-srw-stack-grid,
        .hb-srw-price-grid,
        .hb-srw-related-grid,
        .hb-srw-check-grid,
        .hb-srw-trustbar {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .hb-srw-timeline {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .hb-srw-step:nth-child(3n):after {
            display: block;
        }

        .hb-srw-step:nth-child(2n):after,
        .hb-srw-step:last-child:after {
            display: none;
        }
    }

    @media (max-width: 720px) {
        .hb-srw-hero {
            min-height: auto;
            padding-top: var(--hb-space-10, 5rem);
        }

        .hb-srw-trustbar,
        .hb-srw-metric-grid,
        .hb-srw-score,
        .hb-srw-case-grid,
        .hb-srw-problem-grid,
        .hb-srw-stack-grid,
        .hb-srw-price-grid,
        .hb-srw-related-grid,
        .hb-srw-check-grid,
        .hb-srw-timeline,
        .hb-srw-best-grid,
        .hb-srw-deliverables,
        .hb-srw-author {
            grid-template-columns: 1fr;
        }

        .hb-srw-step:after {
            display: none;
        }

        .hb-srw-score {
            justify-items: center;
        }

        .hb-srw-flow__row {
            grid-template-columns: 24px 1fr;
        }

        .hb-srw-flow strong {
            grid-column: 2;
        }

        .hb-srw-hero__actions .hb-btn,
        .hb-srw-cta .hb-btn {
            width: 100%;
        }
    }
</style>

<div class="hb-srw-page">
    <section class="hb-srw-hero">
        <div class="hb-container hb-srw-hero__inner">
            <div class="hb-srw-hero__copy">
                <nav class="hb-breadcrumb" aria-label="Breadcrumb">
                    <ol class="hb-breadcrumb__list">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><span class="hb-breadcrumb__sep">/</span></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                        <li><span class="hb-breadcrumb__sep">/</span></li>
                        <li aria-current="page">SEO-Ready Website</li>
                    </ol>
                </nav>
                <h1 class="hb-hero__title">รับทำเว็บไซต์<br><em>SEO-Ready</em><br>พัฒนาเว็บให้พร้อมติด Google</h1>
                <p class="hb-hero__sub hb-srw-hero__sub"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:inherit;text-decoration:underline;text-decoration-color:var(--hb-accent-blue,#2563EB);text-underline-offset:0.18em;">Hashbox</a> รับทำเว็บไซต์ธุรกิจด้วยโครงสร้างที่รองรับการติดอันดับบน Google และติด AI Search ดูแลตั้งแต่ Website Performance, Technical SEO ไปจนถึง User Experience ทุกเว็บต้องผ่านมาตรฐาน Lighthouse 100 พร้อม Core Web Vitals ระดับสีเขียว และมีระบบ Sitemap Auto-Submit เพื่อให้ Google เข้าถึงและจัดอันดับเว็บไซต์ได้เร็วขึ้น เพราะการวางรากฐานเว็บไซต์ที่แข็งแรงและถูกต้องตั้งแต่ต้น คือปัจจัยสำคัญที่ช่วยให้การติด Google และ AI Search เป็นเรื่องง่ายและยั่งยืนกว่า</p>
                <div class="hb-hero__actions hb-srw-hero__actions">
                    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
                    <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงานที่ผ่านมา</a>
                </div>
                <div class="hb-srw-trustbar">
                    <span class="hb-srw-chip">Lighthouse 95+ การันตี</span>
                    <span class="hb-srw-chip">Core Web Vitals เขียว</span>
                    <span class="hb-srw-chip">Sitemap Auto-Submit</span>
                    <span class="hb-srw-chip">AI Search Ready</span>
                    <span class="hb-srw-chip">WCAG 2.1 AA</span>
                    <span class="hb-srw-chip">ส่งมอบ source code</span>
                </div>
            </div>

            <figure class="hb-srw-dashboard" aria-hidden="true">
                <div class="hb-srw-dashboard__top">
                    <div class="hb-srw-dots"><span></span><span></span><span></span></div>
                    <div class="hb-srw-status">READY_FOR_DEPLOY</div>
                </div>
                <div class="hb-srw-score">
                    <div class="hb-srw-ring">
                        <div>
                            <strong data-srw-count="100">100</strong>
                            <span>Lighthouse</span>
                        </div>
                    </div>
                    <div class="hb-srw-metric-grid">
                        <div class="hb-srw-metric"><b data-srw-count="100">100</b><span>SEO score</span></div>
                        <div class="hb-srw-metric"><b data-srw-count="0.02" data-srw-decimals="2">0.02</b><span>CLS target</span></div>
                        <div class="hb-srw-metric"><b data-srw-count="1.1" data-srw-decimals="1" data-srw-suffix="s">1.1s</b><span>LCP field target</span></div>
                        <div class="hb-srw-metric"><b data-srw-count="12" data-srw-suffix="/12">12/12</b><span>Build Gate passed</span></div>
                    </div>
                </div>
                <div class="hb-srw-flow">
                    <div class="hb-srw-flow__row">
                        <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                        <span>Schema.org Validator</span>
                        <strong>ผ่านทุก Type</strong>
                    </div>
                    <div class="hb-srw-flow__row">
                        <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/><path d="M12 15V3"/></svg>
                        <span>robots.txt + Sitemap.xml</span>
                        <strong>auto-submit GSC + Bing</strong>
                    </div>
                    <div class="hb-srw-flow__row">
                        <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                        <span>Security Headers</span>
                        <strong>เกรด A+</strong>
                    </div>
                </div>
            </figure>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface">
        <div class="hb-container">
            <div class="hb-srw-head">
                <h2 class="hb-h2">รับทำเว็บไซต์ธุรกิจทุกประเภท รองรับทุกการใช้งาน</h2>
                <p class="hb-lead">3 เคสจาก 50+ โปรเจกต์ วัดผลจริงด้วย GSC, GA4, CrUX field data</p>
            </div>
            <div class="hb-srw-case-grid">
                <?php foreach ( $cases as $i => $c ) : ?>
                    <a class="hb-srw-card hb-srw-case" href="<?php echo esc_url( home_url( $c['url'] ) ); ?>">
                        <div>
                            <span class="hb-eyebrow"><?php echo esc_html( $c['tag'] ); ?></span>
                            <h3 class="hb-card__title"><?php echo esc_html( $c['name'] ); ?></h3>
                        </div>
                        <div>
                            <div class="hb-srw-chart" aria-hidden="true">
                                <?php foreach ( $case_bars[ $i ] as $height ) : ?>
                                    <span class="hb-srw-bar" style="height:<?php echo esc_attr( $height ); ?>%;"></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="hb-srw-metrics">
                                <span>▲ <?php echo esc_html( $c['metric1'] ); ?></span>
                                <span>▲ <?php echo esc_html( $c['metric2'] ); ?></span>
                                <span>▲ <?php echo esc_html( $c['metric3'] ); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface" id="answer">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-answer-layout">
                <div class="hb-srw-card hb-srw-answer-box hb-answer-box">
                    <h2 class="hb-h2">SEO-Ready Website คืออะไร?</h2>
                    <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                        <strong>คือ เว็บไซต์ที่ผ่าน Build Gate กว่า 12 ขั้นตอนก่อน Deploy ขึ้น Production</strong> ครอบคลุมทั้ง Lighthouse Score 100, Core Web Vitals ระดับสีเขียวทุกค่า รวมถึงการติดตั้ง Schema.org Markup เพื่อช่วยให้ Search Engine เข้าใจเนื้อหาและธุรกิจได้ถูกต้องและแม่นยำ นอกจากนี้ยังมีการตั้งค่า Canonical, Robots.txt และ Sitemap พร้อม Auto Submit ไปยัง Google และ Bing รวมถึงรองรับ AI Crawlers จากแพลตฟอร์มที่กลุ่มเป้าหมายของทุกธุรกิจนิยมใช้อย่าง ChatGPT, Claude, Gemini, Google AI Overviews และ AI Mode
                    </p>
                </div>
                <blockquote class="hb-srw-card hb-srw-quote">
                    <div class="hb-srw-quote__mark" aria-hidden="true">&ldquo;</div>
                    <p>&ldquo;ทุกเว็บไซต์ที่มาจาก Hashbox จะถูก Index และเริ่มแข่งขันบน Search Engine ได้ตั้งแต่การ Crawl ครั้งแรก ช่วยลดระยะเวลาในการทำอันดับจากเดิมประมาณ 6 เดือน เหลือเพียง 1-2 เดือนในหลายอุตสาหกรรม&rdquo;</p>
                </blockquote>
            </div>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Build Gate</span>
                <h3 class="hb-h2" style="margin-top:var(--hb-space-3);">รับทำเว็บไซต์ พร้อมผ่าน Build Gate กว่า 12 ขั้นตอน</h3>
                <p class="hb-lead">บริการรับทำเว็บไซต์ที่มาจาก Hashbox ต้องผ่าน Build Gate ก่อน Deploy ขึ้น Production ตามเช็คลิสต์ 12 ข้อนี้ที่บังคับใน CI Pipeline — ไม่ผ่าน = ไม่ Deploy</p>
            </div>
            <div class="hb-srw-gate-layout">
                <aside class="hb-srw-card hb-srw-gate-summary" aria-hidden="true">
                    <span class="hb-eyebrow">CI Pipeline</span>
                    <div class="hb-srw-gate-number">
                        <div>
                            <strong data-srw-count="12" data-srw-suffix="/12">12/12</strong>
                            <span>checks passed</span>
                        </div>
                    </div>
                    <p class="hb-body">ทุกข้อถูกจัดเป็น Build Gate ก่อนขึ้น Production เพื่อให้ SEO, performance, security และ UX อยู่ในมาตรฐานเดียวกันตั้งแต่วันแรก</p>
                </aside>
                <div class="hb-srw-check-grid">
                    <?php foreach ( $checks as $check ) : ?>
                        <div class="hb-srw-card hb-srw-check">
                            <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                            <p class="hb-body"><?php echo esc_html( $check ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">ปัญหา</span>
                <h3 class="hb-h2" style="margin-top:var(--hb-space-3);">ทำไมเว็บส่วนใหญ่ไม่ติด Google ใน 6 เดือนแรก</h3>
                <p class="hb-lead">จากประสบการณ์ดูแลเว็บไซต์ธุรกิจกว่า 50+ โปรเจกต์ เราพบว่าเว็บไซต์จำนวนมากมักถูกพัฒนาโดยข้ามขั้นตอน Technical SEO ตั้งแต่ต้น ส่งผลให้ต้องเสียเวลาและงบประมาณกลับมาแก้ไขหลัง Launch และเป็นสาเหตุสำคัญที่ทำให้เว็บไซต์ยังไม่ติดอันดับบน Google หรือ AI Search</p>
            </div>
            <div class="hb-srw-problem-grid">
                <div class="hb-srw-card hb-srw-problem">
                    <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h10"/></svg>
                    <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Indexation</span>
                    <h3 class="hb-card__title">Google Index หน้าเว็บได้ไม่ครบ</h3>
                    <p class="hb-card__body">robots.txt ผิด, ไม่ส่ง Sitemap หรือใช้ JS-rendered content โครงสร้างที่ Google อ่านยากทำให้หน้าเว็บ Index ได้แค่ 30-50%</p>
                </div>
                <div class="hb-srw-card hb-srw-problem">
                    <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m13 2-2 9h7l-8 11 2-9H5l8-11Z"/></svg>
                    <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Core Web Vitals</span>
                    <h3 class="hb-card__title">เว็บโหลดช้า กระทบอันดับ SEO</h3>
                    <p class="hb-card__body">ใช้ Plugin หนัก โหลดไฟล์ CSS/JS มากเกิน หรือไม่มี Image Preload ทำให้ Core Web Vitals ไม่ผ่านเกณฑ์ LCP เกิน 2.5s และ INP เกิน 200ms</p>
                </div>
                <div class="hb-srw-card hb-srw-problem">
                    <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m10 13-2 2 2 2"/><path d="m14 17 2-2-2-2"/><path d="m13 7-2 10"/><rect width="18" height="18" x="3" y="3" rx="2"/></svg>
                    <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Schema</span>
                    <h3 class="hb-card__title">Schema ไม่มี / ผิด Validation</h3>
                    <p class="hb-card__body">ไม่มี Schema สำคัญ เช่น Organization, Service, FAQ หรือ Breadcrumb ทำให้ Google ไม่แสดง Rich Snippets จนเสีย CTR 30-40%</p>
                </div>
                <div class="hb-srw-card hb-srw-problem">
                    <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/></svg>
                    <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">AI Search</span>
                    <h3 class="hb-card__title">เว็บไซต์ไม่รองรับ AI Search</h3>
                    <p class="hb-card__body">ไม่มีการตั้งค่ารองรับ AI Crawlers, ไม่มี llms.txt และ Schema ไม่ครบ Passage-level Citation ทำให้พลาดทราฟฟิกจาก AI Search ที่กำลังโตเร็ว</p>
                </div>
            </div>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Deliverables</span>
                <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">สิ่งที่จะได้รับจากบริการรับทำเว็บไซต์ SEO-Ready</h2>
                <p class="hb-lead">บริการรับทำเว็บไซต์พร้อมรายการ Deliverables ครบทุก Tier (ปริมาณแตกต่างตาม Scope งาน) โดยทุกอย่างเป็นมาตรฐานเดียวกันในทุกโปรเจกต์ ไม่มี Hidden Charge</p>
            </div>
            <ul class="hb-srw-deliverables">
                <?php foreach ( $deliverables as $d ) : ?>
                    <li>
                        <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                        <span><?php echo esc_html( $d ); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Tech Stack</span>
                <h3 class="hb-h2">เลือก Stack ตามโจทย์</h3>
            </div>
            <div class="hb-srw-stack-grid">
                <div class="hb-srw-card hb-srw-stack-card">
                    <div class="hb-srw-stack-title">
                        <span class="hb-srw-stack-icon"><svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10Z"/></svg></span>
                        <h3 class="hb-card__title">Frontend</h3>
                    </div>
                    <ul>
                        <li><strong>Next.js</strong> — Performance สูงสุด, SSR/ISR, Vercel edge</li>
                        <li><strong>WordPress Custom</strong> — ทีม non-tech แก้ content เองได้</li>
                        <li><strong>Astro / 11ty</strong> — Marketing/Docs site เน้น speed</li>
                    </ul>
                </div>
                <div class="hb-srw-card hb-srw-stack-card">
                    <div class="hb-srw-stack-title">
                        <span class="hb-srw-stack-icon"><svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h10"/></svg></span>
                        <h3 class="hb-card__title">CMS</h3>
                    </div>
                    <ul>
                        <li><strong>Headless WordPress</strong> — มี ecosystem, plugin มาก</li>
                        <li><strong>Sanity</strong> — structured content, multi-channel</li>
                        <li><strong>Contentful</strong> — enterprise, multi-language</li>
                        <li><strong>Strapi</strong> — self-host, open source</li>
                    </ul>
                </div>
                <div class="hb-srw-card hb-srw-stack-card">
                    <div class="hb-srw-stack-title">
                        <span class="hb-srw-stack-icon"><svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20"/><path d="m17 5-5-3-5 3"/><path d="m17 19-5 3-5-3"/></svg></span>
                        <h3 class="hb-card__title">Hosting / Edge</h3>
                    </div>
                    <ul>
                        <li><strong>Vercel</strong> — Next.js + ISR, edge runtime</li>
                        <li><strong>Cloudflare Pages</strong> — Astro/static, free tier ดี</li>
                        <li><strong>WP Engine / Kinsta</strong> — managed WordPress</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Process</span>
                <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">Process 6 Phase: Discovery → Launch</h2>
                <p class="hb-lead">บริการรับทำเว็บไซต์แบบ Phased Delivery วางแผนการทำงานเป็นขั้นตอน มี Milestone ชัดเจน อัปเดตความคืบหน้ารายสัปดาห์ และมีการ Sign-off ทุก Phase ก่อนเริ่มขั้นตอนถัดไป</p>
            </div>
            <ol class="hb-srw-timeline" itemscope itemtype="https://schema.org/HowTo">
                <?php foreach ( $process as $i => $p ) : ?>
                    <li class="hb-srw-card hb-srw-step" itemprop="step" itemscope itemtype="https://schema.org/HowToStep">
                        <div class="hb-srw-step__top">
                            <div class="hb-srw-step__meta">
                                <span class="hb-srw-step__number"><?php echo (int) ( $i + 1 ); ?></span>
                                <span class="hb-srw-step__icon" aria-hidden="true">
                                    <svg aria-hidden="true" class="hb-srw-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><?php echo $process_icons[ $i ]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></svg>
                                </span>
                            </div>
                            <span class="hb-eyebrow" style="color:var(--hb-accent-cyan,#06B6D4);"><?php echo esc_html( $p['time'] ); ?></span>
                        </div>
                        <h3 class="hb-card__title" itemprop="name"><?php echo esc_html( $p['name'] ); ?></h3>
                        <p class="hb-body" itemprop="text"><?php echo esc_html( $p['detail'] ); ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Comparison</span>
                <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทำเว็บไซต์กับ Hashbox vs ทางเลือกอื่น</h2>
                <p class="hb-lead">เปรียบเทียบบริการรับทำเว็บไซต์ของ Hashbox ทั้งด้าน Deliverables และผลลัพธ์ด้าน SEO/AI Search เทียบกับทางเลือกอื่นที่หลายธุรกิจกำลังพิจารณา</p>
            </div>
            <div class="hb-srw-table-wrap">
                <table class="hb-srw-table">
                    <thead>
                        <tr>
                            <th>รายการ</th>
                            <th style="color:var(--hb-accent-blue,#2563EB);">Hashbox</th>
                            <th>Agency ทั่วไป</th>
                            <th>Freelance</th>
                            <th>Template สำเร็จรูป</th>
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
                        <tr>
                            <td><?php echo esc_html( $r[0] ); ?></td>
                            <td style="color:var(--hb-accent-emerald,#10B981);font-weight:700;"><?php echo esc_html( $r[1] ); ?></td>
                            <td><?php echo esc_html( $r[2] ); ?></td>
                            <td><?php echo esc_html( $r[3] ); ?></td>
                            <td><?php echo esc_html( $r[4] ); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface" id="pricing">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Pricing</span>
                <h2 class="hb-h2">ราคาบริการรับทำเว็บไซต์ SEO-Ready</h2>
                <p class="hb-lead">ราคาบริการรับทำเว็บไซต์ทุก Tier มาพร้อม Build Gate 12 ขั้นตอน และ Deliverables 20 รายการ มาตรฐานเดียวกันทุกโปรเจกต์ โดยราคาจะต่างกันตาม Scope งาน จำนวนหน้าเว็บไซต์ และระดับความซับซ้อนของระบบ</p>
            </div>
            <div class="hb-srw-price-grid">
                <?php foreach ( $pricing as $p ) : ?>
                    <div class="hb-srw-card hb-srw-price">
                        <h3 class="hb-card__title"><?php echo esc_html( $p['tier'] ); ?></h3>
                        <div class="hb-srw-price__amount">เริ่มต้น <?php echo esc_html( number_format( $p['price'] ) ); ?> บาท</div>
                        <div class="hb-body">
                            <div><?php echo esc_html( $p['pages'] ); ?></div>
                            <div><?php echo esc_html( $p['time'] ); ?></div>
                        </div>
                        <p class="hb-card__body"><strong>เหมาะกับ:</strong> <?php echo esc_html( $p['fit'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="hb-body" style="margin-top:var(--hb-space-5);text-align:center;">ราคาไม่รวม VAT 7% · ไม่มี hidden fee · quote ปิดหลัง Audit ฟรี</p>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Best fit</span>
                <h2 class="hb-h2">บริการรับทำเว็บไซต์ SEO-Ready เหมาะกับใคร</h2>
                <p class="hb-lead">เหมาะสำหรับธุรกิจที่ไม่อยากเสียเวลาและงบประมาณมาแก้ปัญหา Technical SEO หลังเว็บไซต์เปิดใช้งาน รองรับทั้งการทำ SEO, Performance Marketing, CRO (Conversion Rate Optimization) และ AI Search โดยเฉพาะธุรกิจที่ต้องการใช้เว็บไซต์เป็นช่องทางสร้างยอดขาย สร้าง Lead และแข่งขันบน Google อย่างจริงจัง</p>
            </div>
            <div class="hb-srw-best-grid">
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/work/nexus-corp/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Corporate SEO</span>
                    <h3 class="hb-card__title">Corporate site ที่ช้าและ index ไม่ครบ</h3>
                    <p class="hb-card__body">ดู Nexus Corp case study ที่ย้ายจาก legacy WordPress เป็น Headless WordPress + Next.js จน users เพิ่ม +540%</p>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/work/rank-project/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">SEO Recovery</span>
                    <h3 class="hb-card__title">เว็บมีสินค้า/บริการดี แต่ organic search ไม่โต</h3>
                    <p class="hb-card__body">ดู Rank Project case study ที่ technical SEO + content programme เพิ่ม impressions +2,200%</p>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Next step</span>
                    <h3 class="hb-card__title">หลังเว็บพร้อม SEO แล้ว ควรวัด Conversion ต่อ</h3>
                    <p class="hb-card__body">ต่อยอดด้วย Digital Marketing + CRO เพื่อติดตาม funnel, heatmap และทดสอบ landing page รายเดือน</p>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Full funnel</span>
                    <h3 class="hb-card__title">ต้องการทีมเดียวดูทั้ง Web, Marketing และ AI</h3>
                    <p class="hb-card__body">ดูภาพรวมบริการทั้งหมดของ Hashbox Studio เพื่อวาง roadmap 90/180/365 วัน</p>
                </a>
            </div>
        </div>
    </section>

    <section class="hb-srw-section hb-srw-section--surface">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Author / Team</span>
                <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทีมที่รับผิดชอบโปรเจกต์</h2>
            </div>
            <div class="hb-srw-card hb-srw-author" itemscope itemtype="https://schema.org/Person">
                <div class="hb-srw-avatar">T</div>
                <div>
                    <h3 class="hb-card__title" itemprop="name" style="margin:0;"><?php echo esc_html( $author_name ); ?></h3>
                    <p class="hb-body" itemprop="jobTitle" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $author_role ); ?></p>
                    <p class="hb-body" itemprop="description" style="margin-top:var(--hb-space-3);"><?php echo esc_html( $author_bio ); ?></p>
                    <a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener author" target="_blank" itemprop="sameAs" style="display:inline-block;margin-top:var(--hb-space-3);color:var(--hb-accent-blue,#2563EB);">LinkedIn →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-head">
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

    <section class="hb-srw-section hb-srw-section--surface">
        <div class="hb-container hb-container--md">
            <div class="hb-srw-head">
                <span class="hb-eyebrow">Related</span>
                <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">บทความที่เกี่ยวข้อง</h2>
            </div>
            <div class="hb-srw-related-grid">
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/technical-seo-guide/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Guide</span>
                    <h3 class="hb-card__title">Technical SEO คือ? คู่มือ 2026</h3>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">GEO</span>
                    <h3 class="hb-card__title">GEO คืออะไร? AI Search Optimization</h3>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/nextjs-vs-wordpress-2026/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Compare</span>
                    <h3 class="hb-card__title">Next.js vs WordPress 2026</h3>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/schema-markup-thai-guide-2026/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Guide</span>
                    <h3 class="hb-card__title">Schema Markup คือ? คู่มือ 2026</h3>
                </a>
                <a class="hb-srw-card" href="<?php echo esc_url( home_url( '/core-web-vitals-thai-guide-2026/' ) ); ?>" style="text-decoration:none;">
                    <span class="hb-eyebrow">Performance</span>
                    <h3 class="hb-card__title">Core Web Vitals คู่มือ 2026</h3>
                </a>
            </div>
        </div>
    </section>

    <section class="hb-srw-section">
        <div class="hb-container">
            <div class="hb-srw-card hb-srw-cta">
                <div>
                    <h2 class="hb-h2">เริ่มด้วย Audit ฟรี</h2>
                    <p class="hb-lead" style="margin-top:var(--hb-space-4);">รับ SEO + Performance Audit Report 15-20 หน้า ภายใน 3 วันทำการ · ไม่มี commitment · ไม่มี up-sell</p>
                </div>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
            </div>
        </div>
    </section>
</div>

<script>
(() => {
    const root = document.querySelector('.hb-srw-page');
    if (!root) {
        return;
    }

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealSelectors = [
        '.hb-srw-head',
        '.hb-srw-card',
        '.hb-srw-chip',
        '.hb-srw-dashboard',
        '.hb-srw-flow__row',
        '.hb-srw-deliverables li',
        '.hb-accordion__item'
    ];
    const revealTargets = Array.from(new Set(root.querySelectorAll(revealSelectors.join(','))));

    revealTargets.forEach((element) => {
        element.classList.add('hb-srw-reveal');
    });

    const staggerGroups = root.querySelectorAll([
        '.hb-srw-trustbar',
        '.hb-srw-flow',
        '.hb-srw-case-grid',
        '.hb-srw-check-grid',
        '.hb-srw-problem-grid',
        '.hb-srw-deliverables',
        '.hb-srw-stack-grid',
        '.hb-srw-timeline',
        '.hb-srw-price-grid',
        '.hb-srw-best-grid',
        '.hb-srw-related-grid',
        '.hb-accordion'
    ].join(','));

    staggerGroups.forEach((group) => {
        Array.from(group.children).forEach((element, index) => {
            if (element.classList.contains('hb-srw-reveal')) {
                element.style.setProperty('--srw-reveal-delay', `${Math.min(index * 70, 560)}ms`);
            }
        });
    });

    const countElements = Array.from(root.querySelectorAll('[data-srw-count]'));
    const setFinalCount = (element) => {
        const target = Number(element.dataset.srwCount || 0);
        const decimals = Number(element.dataset.srwDecimals || 0);
        const suffix = element.dataset.srwSuffix || '';
        element.textContent = `${target.toFixed(decimals)}${suffix}`;
    };

    const animateCount = (element) => {
        if (element.dataset.srwCountDone === 'true') {
            return;
        }

        element.dataset.srwCountDone = 'true';
        const target = Number(element.dataset.srwCount || 0);
        const decimals = Number(element.dataset.srwDecimals || 0);
        const suffix = element.dataset.srwSuffix || '';
        const duration = 980;
        const start = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = target * eased;
            element.textContent = `${value.toFixed(decimals)}${suffix}`;

            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                setFinalCount(element);
            }
        };

        element.textContent = `${(0).toFixed(decimals)}${suffix}`;
        requestAnimationFrame(tick);
    };

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealTargets.forEach((element) => element.classList.add('is-visible'));
        countElements.forEach(setFinalCount);
        return;
    }

    root.classList.add('is-motion-ready');

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            const element = entry.target;
            element.classList.add('is-visible');
            const delay = parseInt(element.style.getPropertyValue('--srw-reveal-delay'), 10) || 0;
            window.setTimeout(() => {
                element.style.setProperty('--srw-reveal-delay', '0ms');
            }, delay + 700);
            observer.unobserve(element);
        });
    }, { rootMargin: '0px 0px -12% 0px', threshold: 0.12 });

    revealTargets.forEach((element) => revealObserver.observe(element));

    const countObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            animateCount(entry.target);
            observer.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -18% 0px', threshold: 0.4 });

    countElements.forEach((element) => countObserver.observe(element));
})();
</script>

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
