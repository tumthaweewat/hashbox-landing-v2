<?php
/**
 * Template Name: Work: Rank Project
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'rank-project',
    'name'      => 'Rank Project — HR-Tech Platform',
    'industry'  => 'HR-Tech / SaaS',
    'year'      => '2024',
    'timeline'  => '12 เดือน',
    'tag'       => 'SEO Recovery',
    'headline'  => '+2,200% Search Impressions ภายใน 12 เดือนด้วย Technical SEO + Content Programme',
    'lede'      => 'HR-Tech Platform ที่มี Product ที่ดีแต่ Organic Discovery ใกล้ศูนย์ Search Impressions เฉลี่ย 800/วัน ติด Branded Search อย่างเดียว เราทำ Technical SEO Overhaul + 12-month Content Programme ผลคือ +2,200% Impressions, +700% Traffic',

    'snapshot' => array(
        array( 'value' => '+2,200%', 'label' => 'Search Impressions' ),
        array( 'value' => '+700%',   'label' => 'Organic Traffic' ),
        array( 'value' => '+540%',   'label' => 'Unique Users' ),
    ),

    'challenge' => 'Platform นี้เพิ่ง Launch มาได้ 18 เดือน Product-Market Fit ค่อนข้างดี แต่ Acquisition Channel พึ่ง Paid Ads ถึง 95% ส่วน Organic Search แทบไม่มีบทบาท Search Console แสดง Impressions แค่ 800 ครั้งต่อวัน และส่วนใหญ่มาจาก Branded Keyword ทั้งสิ้น Avg Position บน Non-branded อยู่ที่ 67 CTR ต่ำกว่า 0.3% และ Core Web Vitals ทุกหน้าบน Mobile อยู่ในโซนแดง ทีม Marketing ตั้งเป้าจะลด Paid Ads dependency ภายในปีหน้า แต่ไม่มั่นใจว่า Organic จะวิ่งทันหรือเปล่า',

    'approach' => array(
        array( 'h' => 'Technical Audit + Quick Wins', 'p' => 'พบ noindex บน 30% ของหน้า Job Listings · canonical ผิด 15% · sitemap.xml ขาด 60% URL · Schema = ไม่มี ส่ง Quick Win Patch ภายใน Week 1' ),
        array( 'h' => 'Core Web Vitals Overhaul', 'p' => 'ย้าย Frontend จาก React SPA เป็น Next.js SSR + ISR · Image CDN + Font Subsetting · LCP จาก 4.8s → 1.6s · CLS จาก 0.32 → 0.04' ),
        array( 'h' => 'Schema + Structured Data', 'p' => 'Implement JobPosting Schema ทุก Listing + Organization + WebSite + BreadcrumbList + FAQPage · ผลคือ Rich Snippet ใน SERP ทันที CTR เพิ่ม 2.4x' ),
        array( 'h' => 'Content Programme (12 เดือน)', 'p' => 'Topic Cluster 4 Pillars × 12 supporting posts each ตาม Keyword Research ที่ Aligned กับ Funnel Stage · Editorial Calendar 8 posts/เดือน · ทุกบทความผ่าน Build Gate ของเรา' ),
        array( 'h' => 'Internal Linking + Authority', 'p' => 'สร้าง Hub-and-Spoke Internal Linking · ขอ Backlink จาก HR Media TH 12 sources · Guest post 6 ครั้งใน HR/Recruitment Publications' ),
    ),

    'results' => array(
        array( 'value' => '+2,200%', 'label' => 'Search Impressions (12mo)' ),
        array( 'value' => '+700%',   'label' => 'Organic Traffic' ),
        array( 'value' => '+540%',   'label' => 'Unique Users' ),
        array( 'value' => '120+',    'label' => 'Top-10 Ranking Keywords (จาก 3)' ),
        array( 'value' => '−65%',    'label' => 'Paid Ads Dependency' ),
        array( 'value' => '3.2×',    'label' => 'Organic CTR (Schema Rich Snippet)' ),
    ),

    'stack' => array( 'Next.js 15 (SSR + ISR)', 'JobPosting Schema', 'Cloudflare', 'GSC URL Inspection API', 'Lighthouse CI', 'Surfer SEO', 'Ahrefs' ),

    'testimonial' => array(
        'quote'       => 'เป้าหมายลด Paid Ads 50% ในปีหน้า ผ่านจริงใน 12 เดือนด้วย Organic ที่เพิ่ม 7 เท่า ทีม Marketing วางแผน Quarter ได้จาก Data จริง ไม่ต้องเดา',
        'attribution' => 'Head of Growth, HR-Tech Platform',
    ),
) );

get_footer();
