<?php
/**
 * Template Name: Work: Nexus Corp
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'nexus-corp',
    'name'      => 'Nexus Corp',
    'industry'  => 'Enterprise Software',
    'year'      => '2025',
    'timeline'  => '4 เดือน',
    'tag'       => 'Corporate Website',
    'headline'  => 'Headless WordPress + Next.js แทน Legacy Corporate Site',
    'lede'      => 'เปลี่ยน Corporate Site เดิมที่ PageSpeed 28/100 และ Index ไม่ได้ครึ่งหนึ่งของ URL เป็น Headless WordPress + Next.js ที่ Lighthouse 100, CWV เขียวทุก URL และ Index ครบใน Crawl แรก',

    'snapshot' => array(
        array( 'value' => '+540%', 'label' => 'Users (12 เดือน)' ),
        array( 'value' => '100',   'label' => 'Lighthouse Score' ),
        array( 'value' => '<1.5s', 'label' => 'LCP Mobile' ),
    ),

    'challenge' => 'Nexus Corp ใช้ WordPress พร้อม Theme Builder ตัวหนึ่งที่มาพร้อม JavaScript เกือบ 1.2 MB ต่อหน้า ทำให้ PageSpeed บน Mobile อยู่ที่ 28/100 และ LCP สูงถึง 5.8 วินาที ผลลัพธ์ที่เกิดขึ้นคือ Googlebot สามารถ Index ได้แค่ 47% ของ URL ทั้งหมด Organic Traffic ตก 18% เมื่อเทียบกับปีก่อน Branded Search ยังพอเหลือบ้าง แต่ Non-branded แทบจะหายไป ทีม Marketing เสนอแก้ปัญหาด้วยการจ้างเอเจนซี SEO เพิ่ม แต่จริง ๆ แล้วต้นเหตุของปัญหาอยู่ที่ Layer Theme ไม่ใช่ Content',

    'approach' => array(
        array( 'h' => 'Audit + Roadmap', 'p' => 'วัด Baseline ทุก URL ใน GSC + GA4 + PSI · ทำ Sitemap ที่ครอบ URL ทั้งหมด · พบ Theme Page Builder ทำให้ HTML 800KB+/page' ),
        array( 'h' => 'Stack Decision', 'p' => 'Headless WordPress = ทีม Marketing แก้ Content ได้เหมือนเดิม + Next.js Frontend = Performance ระดับ Static ตัดสินใจ Migrate ภายใน 4 เดือนพร้อม Parallel Run' ),
        array( 'h' => 'Build Gate Enforcement', 'p' => 'Lighthouse CI ใน GitHub Actions: Performance ต้อง 90+ ก่อน Merge · Schema Validator ผ่านทุก Page Type · CWV เขียวก่อน Deploy' ),
        array( 'h' => 'Migration + 301 Map', 'p' => 'Map URL เก่า 247 entries ไปยัง URL ใหม่ · ส่ง Sitemap ใหม่ + Request Indexing ผ่าน GSC URL Inspection API · Monitor Crawl Stats รายวัน 30 วันแรก' ),
        array( 'h' => 'Knowledge Transfer', 'p' => 'Train ทีม Marketing ใช้ Headless WP + Preview ใน Next.js · ส่ง Runbook สำหรับ Content Editor + Developer · Retainer ดูแล 90 วันแรก' ),
    ),

    'results' => array(
        array( 'value' => '+540%', 'label' => 'Unique Users (12 เดือน vs ก่อน)' ),
        array( 'value' => '+700%', 'label' => 'Organic Traffic (12 เดือน)' ),
        array( 'value' => '+2,200%', 'label' => 'Search Impressions (GSC)' ),
        array( 'value' => '100%',  'label' => 'Index Coverage (จาก 47%)' ),
        array( 'value' => '<1.5s', 'label' => 'LCP Mobile (จาก 5.8s)' ),
        array( 'value' => '100/100', 'label' => 'Lighthouse Score (Performance/SEO)' ),
    ),

    'stack' => array( 'Next.js 15', 'Headless WordPress', 'GraphQL (WPGraphQL)', 'Vercel', 'Cloudflare', 'GA4', 'Search Console', 'Lighthouse CI' ),

    'testimonial' => array(
        'quote'       => 'ที่ผ่านมาเคยจ้าง 2 เอเจนซีและไม่เคยขยับ Performance ได้ Hashbox เป็นทีมแรกที่เข้าใจทั้ง WordPress, Next.js และ SEO ผลลัพธ์เห็นภายใน 60 วันแรก',
        'attribution' => 'Head of Digital, Nexus Corp',
    ),
) );

get_footer();
