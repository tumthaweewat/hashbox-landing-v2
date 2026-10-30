<?php
/**
 * Per-URL metadata overrides. Missing fields deliberately stay missing so
 * Rank Math or the WordPress title/excerpt can provide their normal value.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hashbox_seo_path_overrides() {
    return array(
        'google-ai-overview-thailand-2026' => array(
            'title'       => 'AI Overview ในไทย: ข้อมูลจริง 95 คำค้น ปี 2026',
            'description' => 'ผลติดตาม AI Overview ไทย 30 วัน จาก 95 คำค้น: พบ AI Overview 88 จาก 93 คำที่มีข้อมูลครบ พร้อมรายชื่อเว็บที่ถูกอ้างอิง',
        ),
        'best-seo-agencies-bangkok-2026' => array(
            'title' => 'Best SEO Agencies in Bangkok 2026: 13 Compared | Hashbox',
        ),
        'en/ai-consulting-companies-thailand-2026' => array(
            'title'       => 'AI Consulting Companies in Thailand 2026 | Hashbox',
            'description' => 'Compare 9 AI consulting companies in Thailand on pricing, ROI assessment, production delivery and source-code handover.',
        ),
        'บริษัทที่ปรึกษา-ai-ไทย-2026' => array(
            'description' => 'เปรียบเทียบบริษัทที่ปรึกษา AI ในไทย 9 แห่ง ด้วย 7 เกณฑ์ตรวจสอบได้ ทั้งราคา ROI การส่งมอบ production และ source code',
        ),
        'website-audit' => array(
            'title'       => 'ขอประเมินเว็บไซต์และใบเสนอราคาเบื้องต้น | Hashbox',
            'description' => 'ส่งโจทย์เว็บไซต์ให้ทีมประเมิน scope และงบเบื้องต้นฟรี ครอบคลุม UX/UI, SEO, Performance และ Conversion Tracking',
        ),
        'เว็บไซต์รองรับ-ai-search-2026' => array(
            'title' => 'เว็บไซต์รองรับ AI Search: Checklist 12 ข้อ | Hashbox',
        ),
        'services' => array(
            'title'       => 'บริการเว็บไซต์ SEO และ AI Search | Hashbox Studio',
            'description' => 'รวมบริการเว็บไซต์ SEO, AI Search และ AI Consulting พร้อมราคาโปร่งใส ขอบเขตงานชัดเจน และผลลัพธ์ที่วัดจากข้อมูลจริง',
        ),
        'seo-thai-guide-2026' => array(
            'title' => 'SEO คืออะไร? คู่มือฉบับ 2026 | Hashbox',
        ),
        'aeo-คืออะไร-2026' => array(
            'title' => 'AEO คืออะไร? ต่างจาก SEO และ GEO อย่างไร (2026)',
        ),
    );
}

function hashbox_seo_override_has_field( $path, $field ) {
    $overrides = hashbox_seo_path_overrides();
    return isset( $overrides[ $path ] ) && array_key_exists( $field, $overrides[ $path ] );
}

function hashbox_resolve_meta_description( $override_description, $rank_math_description, $wordpress_description ) {
    foreach ( array( $override_description, $rank_math_description, $wordpress_description ) as $description ) {
        if ( is_string( $description ) && '' !== trim( $description ) ) {
            return $description;
        }
    }
    return '';
}
