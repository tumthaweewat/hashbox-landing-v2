<?php
/**
 * Template Name: Work: Gold Brand
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'gold-brand',
    'name'      => 'Gold Brand',
    'industry'  => 'Luxury Retail',
    'year'      => '2024',
    'timeline'  => '5 เดือน',
    'tag'       => 'Brand + Web',
    'headline'  => 'Brand Refresh + Performance Site ส่งผลให้ Branded Search +180%',
    'lede'      => 'แบรนด์ Luxury Retail ที่มี Heritage 30 ปีแต่ Digital Touchpoint เก่า เว็บไซต์ตัวเดิม Aesthetic ไม่ถึง คนค้นชื่อแบรนด์แล้วเจอเว็บที่ดูถูก เราทำ Brand Refresh + Build Corporate Site ใหม่บน Next.js ผล: Branded Search +180% + Premium Perception เพิ่ม',

    'snapshot' => array(
        array( 'value' => '+180%', 'label' => 'Branded Search Volume' ),
        array( 'value' => '100',   'label' => 'Lighthouse Score' ),
        array( 'value' => '+42%',  'label' => 'Avg Session Duration' ),
    ),

    'challenge' => 'แบรนด์ Luxury Retail นี้อยู่ในตลาดมา 30 ปี Brand Equity ในฝั่ง Offline แข็งแรงมาก แต่ Digital Touchpoint กลับตามไม่ทัน เว็บไซต์เก่าใช้ WordPress พร้อม Theme Generic ทำให้ดูเหมือนร้านทั่วไป Branded Search ตก 12% เมื่อเทียบกับปีก่อน และลูกค้าใหม่หา Reference Online ไม่เจอภาพที่สมกับ Premium ของแบรนด์ ทีม Marketing เคยบอกเราว่า "เห็นเว็บแล้วลูกค้าไม่กล้าโทรเข้ามาเพราะคิดว่าราคาแพง" ซึ่งเป็นโจทย์ที่ตรงข้ามกับที่แบรนด์อยากสื่อ',

    'approach' => array(
        array( 'h' => 'Brand Audit + Refresh', 'p' => 'Audit Brand Touchpoint Online ทั้งหมด · ทำงานร่วม Brand Strategist 4 สัปดาห์ · Refresh Logo Variants + Color System + Typography Pairing + Photography Direction' ),
        array( 'h' => 'Editorial Design System', 'p' => 'สร้าง Design System เน้น Editorial / Magazine Layout · Custom Typography (Fraunces + Inter) · Animation Tokens ที่ Subtle (300ms easeOutExpo)' ),
        array( 'h' => 'Performance-first Build', 'p' => 'Next.js + Headless CMS · Image CDN + AVIF · Font Subsetting ทั้ง Latin + Thai · LCP 1.1s บน Mobile · Lighthouse 100/100/100/100' ),
        array( 'h' => 'SEO + Schema Premium', 'p' => 'Organization + LocalBusiness + Product + AggregateRating + Review · BreadcrumbList ครบ · hreflang TH/EN · Sitemap submit + GBP optimization' ),
        array( 'h' => 'Soft Launch + PR Push', 'p' => 'Soft launch กับ Influencer 8 คน + ส่ง Media Kit ไป Brand/Lifestyle Press 12 outlets · Result: Backlink 18 sources ในเดือนแรก' ),
    ),

    'results' => array(
        array( 'value' => '+180%', 'label' => 'Branded Search Volume' ),
        array( 'value' => '+42%',  'label' => 'Avg Session Duration' ),
        array( 'value' => '+28%',  'label' => 'Lead Form Submission' ),
        array( 'value' => '+18',   'label' => 'Backlinks ใน 30 วันแรก' ),
        array( 'value' => '100/100', 'label' => 'Lighthouse (4 หมวด)' ),
        array( 'value' => '−38%',  'label' => 'Bounce Rate' ),
    ),

    'stack' => array( 'Next.js 15', 'Sanity (Headless CMS)', 'Vercel', 'Fraunces + Inter (Fonts)', 'AVIF Image Pipeline', 'GA4', 'GSC', 'GBP API' ),

    'testimonial' => array(
        'quote'       => 'เว็บใหม่ทำให้แบรนด์เราดูสมกับ Heritage 30 ปีที่สร้างมา ตอนนี้ลูกค้าใหม่กล้าโทรหาเรามากขึ้น Conversation ดีขึ้นตั้งแต่จุดแรกของ Touchpoint',
        'attribution' => 'Marketing Director, Gold Brand',
    ),
) );

get_footer();
