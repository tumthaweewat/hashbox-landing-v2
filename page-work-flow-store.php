<?php
/**
 * Template Name: Work: Flow Store
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'flow-store',
    'name'      => 'Flow Store',
    'industry'  => 'E-commerce / Lifestyle',
    'year'      => '2025',
    'timeline'  => '6 เดือน (Build 2 + CRO 4)',
    'tag'       => 'E-commerce + CRO',
    'headline'  => 'Storefront ใหม่ + CRO Sprint = 3× Conversion ใน 6 เดือน',
    'lede'      => 'Storefront เดิมบน Shopify Theme ออกแบบเน้น Visual แต่ Conversion ตก 1.2% เราย้าย Frontend เป็น Next.js ผูก Backend Shopify เดิมไว้ + รัน CRO Sprint 4 เดือนต่อเนื่อง ผลคือ Conversion 3.8%',

    'snapshot' => array(
        array( 'value' => '3×',   'label' => 'Conversion Rate' ),
        array( 'value' => '<1.2s', 'label' => 'LCP Mobile' ),
        array( 'value' => '12',   'label' => 'A/B Experiments Shipped' ),
    ),

    'challenge' => 'Flow Store มี Branding และ Visual Design ที่สวยระดับ Magazine แต่ Conversion Rate กลับอยู่แค่ 1.2% ซึ่งต่ำกว่า Benchmark ของอุตสาหกรรม Lifestyle ที่ราว 2.8% Cart Abandonment สูงถึง 78% และในขั้นตอน Checkout มีฟิลด์ให้กรอกถึง 11 ฟิลด์ ซึ่งสร้าง Friction ที่หนักมาก จุดสำคัญคือลูกค้า 82% เข้ามาจาก Instagram และ TikTok ผ่านมือถือ แต่ Theme เดิมมี LCP 4.2 วินาที และ Bounce Rate บน Mobile สูง 71% — สรุปคือลูกค้าออกจากเว็บก่อนเห็นสินค้าด้วยซ้ำ',

    'approach' => array(
        array( 'h' => 'Performance First', 'p' => 'แทนที่ Theme เดิมด้วย Next.js + Shopify Hydrogen pattern Image CDN + Edge Cache LCP ลงจาก 4.2s → 1.2s ใน Sprint แรก' ),
        array( 'h' => 'Checkout Friction Removal', 'p' => 'ลด Checkout Field จาก 11 → 5 + Guest Checkout + Auto-fill Address จากเบอร์ Thai Phone API' ),
        array( 'h' => 'CRO Sprint Rolling', 'p' => 'ICE-prioritized A/B Test 2 ต่อเดือน Heatmap + Session Recording บน Mobile · Funnel Drop-off Analysis ผ่าน GA4 Funnel Report' ),
        array( 'h' => 'Top Wins (จาก 12 Experiments)', 'p' => 'Hero CTA "ดูสินค้าทั้งหมด" → "ส่งฟรีวันนี้" +23% CR · Product Page Sticky Add-to-Cart +18% · Free Shipping Threshold Banner +14% AOV · Trust Badge Above-fold −15% Bounce' ),
        array( 'h' => 'Retainer + Iterate', 'p' => 'CRO Sprint รายเดือนต่อเนื่อง · Dashboard Real-time ใน Looker Studio · Monthly Review Call' ),
    ),

    'results' => array(
        array( 'value' => '3.8%', 'label' => 'Conversion Rate (จาก 1.2%)' ),
        array( 'value' => '−42%', 'label' => 'Cart Abandonment' ),
        array( 'value' => '−71%', 'label' => 'LCP Mobile (4.2s → 1.2s)' ),
        array( 'value' => '+38%', 'label' => 'AOV (Average Order Value)' ),
        array( 'value' => '+220%', 'label' => 'Revenue 6 เดือน' ),
        array( 'value' => '12',   'label' => 'A/B Experiments Shipped' ),
    ),

    'stack' => array( 'Next.js 15', 'Shopify Headless', 'Vercel', 'Microsoft Clarity', 'GrowthBook', 'GA4', 'Looker Studio', 'GTM Server-side' ),

    'testimonial' => array(
        'quote'       => 'CRO Sprint ทำให้เราเห็นชัดว่าควรเปลี่ยนอะไรก่อน-หลัง ไม่ใช่เดาเหมือนเอเจนซีอื่น Revenue 6 เดือนเพิ่มเท่าตัว ที่สำคัญทีมเรารู้สาเหตุของทุก Win',
        'attribution' => 'CMO, Flow Store',
    ),
) );

get_footer();
