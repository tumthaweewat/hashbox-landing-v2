<?php
/**
 * Article → service page map (silo · 2026-10-06).
 *
 * Every post passes weight to ONE service page: the breadcrumb (visible and
 * JSON-LD), the hero button and the sidebar box all link to it with the
 * keyword that page owns as the anchor. This is what ANGA's /seo/<article>/
 * structure buys — we keep /<slug>/ URLs (no permalink change: 43 posts, two
 * weeks after the 17 Sep drop, with AI already citing the current URLs) and
 * carry the same signal through links instead. See
 * hashbox-seo-stack/docs/research/2026-10-06-site-audit.md.
 *
 * Slug overrides come first: the WordPress category is too coarse — AI Search
 * articles sit in "SEO", n8n articles in "AI Consulting".
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Service hubs. `name` is the breadcrumb label and anchor — the keyword the
 * target page owns. Facts in `text` must match the service page itself.
 */
function hashbox_service_hubs() {
    return array(
        'seo'           => array(
            'path'   => '/services/seo/',
            'name'   => 'รับทำ SEO',
            'text'   => 'SEO สายเทคนิค เริ่ม 29,900 บาท/เดือน · ตรวจ Technical SEO ฟรีก่อนเซ็นสัญญา · การันตี "ไม่โต ไม่จ่าย"',
            'button' => 'ดูบริการรับทำ SEO',
        ),
        'seo-white-hat' => array(
            'path'   => '/services/seo/white-hat/',
            'name'   => 'รับทำ SEO สายขาว',
            'text'   => 'SEO ตามแนวทางของ Google ไม่ซื้อ backlink ไม่การันตีอันดับ · เริ่ม 29,900 บาท/เดือน',
            'button' => 'ดูบริการ SEO สายขาว',
        ),
        'ai-search'     => array(
            'path'   => '/services/ai-search/',
            'name'   => 'รับทำ AI Search (GEO/AEO)',
            'text'   => 'ปรับเว็บให้ ChatGPT, Gemini และ Google AI Overview อ้างถึง · รวมอยู่ในค่า SEO รายเดือนเริ่ม 29,900 บาท · วัดผลแยกรายแพลตฟอร์ม',
            'button' => 'ดูบริการรับทำ AI Search',
        ),
        'ai-consulting' => array(
            'path'   => '/services/ai-consulting/',
            'name'   => 'ที่ปรึกษา AI สำหรับธุรกิจ',
            'text'   => 'คุยประเมินโอกาสฟรี 30 นาที · ROI Assessment เริ่ม 60,000 บาท · วางระบบ AI, LINE Chatbot และ RAG',
            'button' => 'ดูบริการที่ปรึกษา AI',
        ),
        'n8n'           => array(
            'path'   => '/services/n8n-automation/',
            'name'   => 'รับทำ n8n Automation',
            'text'   => 'วางระบบอัตโนมัติเป็นโปรเจกต์ เริ่ม 29,000 บาท · ส่งมอบ workflow พร้อมเอกสารให้ทีมคุณแก้ต่อได้',
            'button' => 'ดูบริการรับทำ n8n',
        ),
        'website'       => array(
            'path'   => '/services/website-development/',
            'name'   => 'รับทำเว็บไซต์',
            'text'   => 'เว็บ SEO-Ready โหลดเร็ว การันตี Lighthouse มือถือ 95+ · Landing Page เริ่ม 35,900 บาท',
            'button' => 'ดูบริการรับทำเว็บไซต์',
        ),
        'cro'           => array(
            'path'   => '/cro-funnel-audit/',
            'name'   => 'CRO Funnel Audit ฟรี',
            'text'   => 'ตรวจเส้นทางจากหน้าเว็บถึงการติดต่อ หาจุดที่ลูกค้าหลุดก่อนกดส่งฟอร์ม',
            'button' => 'ขอ CRO Funnel Audit ฟรี',
        ),
        'seo-en'        => array(
            'path'   => '/en/seo/',
            'name'   => 'SEO services in Bangkok',
            'text'   => 'Technical-first SEO from THB 29,900/month · free technical audit before you sign · no ranking guarantees, a conditional KPI guarantee instead',
            'button' => 'See our SEO services',
        ),
    );
}

/**
 * Hub key for a post. Accepts the slug decoded or percent-encoded (WordPress
 * stores Thai post_name percent-encoded). '' = no hub → the caller keeps the
 * old Blog / category breadcrumb.
 */
function hashbox_post_service_hub_key( $slug, $category_slug ) {
    $slug = rawurldecode( (string) $slug );

    $overrides = array(
        'ai-search'     => array(
            'จ้างทำ-ai-search-ราคา-2026',
            'เว็บไซต์รองรับ-ai-search-2026',
            'aeo-คืออะไร-2026',
            'ai-search-metrics-thailand-2026',
            'geo-ai-search-optimization-2026',
            'google-ai-mode-คืออะไร-2026',
            'google-ai-overview-thailand-2026',
            'llms-txt-คืออะไร-2026',
            'perplexity-ai-คืออะไร-2026',
        ),
        'n8n'           => array( 'n8n-ราคา-2026', 'n8n-thai-guide-2026', 'ตัวอย่าง-n8n-workflow-2026' ),
        'seo-white-hat' => array( 'seo-สายเทา-vs-สายขาว-2026' ),
        'website'       => array( 'lighthouse-100-ทำยังไง-2026', 'lcp-คือ-วิธีแก้-2026', 'core-web-vitals-thai-guide-2026' ),
        'seo-en'        => array( 'best-seo-agencies-bangkok-2026' ),
    );
    foreach ( $overrides as $key => $slugs ) {
        if ( in_array( $slug, $slugs, true ) ) {
            return $key;
        }
    }

    $by_category = array(
        'seo'             => 'seo',
        'ai-consulting'   => 'ai-consulting',
        'web-development' => 'website',
        'marketing'       => 'cro',
    );
    return isset( $by_category[ $category_slug ] ) ? $by_category[ $category_slug ] : '';
}

/**
 * Hub for a post, with an absolute `url`. null for pages on the article
 * layout and posts outside the mapped categories.
 */
function hashbox_post_service_hub( $post_id = 0 ) {
    $post_id = $post_id ? (int) $post_id : (int) get_the_ID();
    if ( ! $post_id || 'post' !== get_post_type( $post_id ) ) {
        return null;
    }
    $cats = get_the_category( $post_id );
    $key  = hashbox_post_service_hub_key( get_post_field( 'post_name', $post_id ), empty( $cats ) ? '' : $cats[0]->slug );
    $hubs = hashbox_service_hubs();
    if ( '' === $key || ! isset( $hubs[ $key ] ) ) {
        return null;
    }
    $hub        = $hubs[ $key ];
    $hub['key'] = $key;
    $hub['url'] = home_url( $hub['path'] );
    return $hub;
}
