<?php
/**
 * Service catalogue — single source of truth for every place the theme
 * lists what Hashbox sells: homepage service list, nav dropdown, mobile
 * sheet, footer, /services/ hub cards + ItemList schema, Organization
 * hasOfferCatalog, llms.txt, 404 cards and the contact form select.
 *
 * Naming rule (see docs/seo-plan-2026-08-service-restructure/REFERENCE.md §1):
 * `name` IS the anchor text used site-wide and must equal the keyword the
 * page owns. One keyword = one page. Do not put "ปรึกษาทำระบบ AI Solution"
 * on the AI service — that phrase belongs to /ai-solution-consulting-guide-2026/.
 *
 * `requires_page` entries are hidden until the WP Page exists so the theme
 * never links to a 404 (theme deploys before pages are created in wp-admin).
 *
 * @package Hashbox_Studio_V2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hashbox_service_catalog() {
    static $catalog = null;
    if ( null !== $catalog ) {
        return $catalog;
    }

    $catalog = array(
        'website' => array(
            'key'          => 'website',
            'name'         => 'รับทำเว็บไซต์ SEO-Ready',
            'short'        => 'รับทำเว็บไซต์',
            'en_name'      => 'SEO-Ready Website Development',
            'path'         => '/services/website-development/',
            'desc'         => 'เว็บไซต์ที่พร้อมติด Google และ AI Search ตั้งแต่วันเปิดตัว — Lighthouse 100, Core Web Vitals เขียว, Schema ครบ ส่งมอบพร้อม source code',
            'en_desc'      => 'Production-ready websites that pass Lighthouse 100, green Core Web Vitals, complete schema, and are indexable from launch.',
            'service_type' => 'Web Development',
            'stack'        => 'Next.js · Headless WordPress · Lighthouse 100',
            'price'        => 'เริ่ม 35,900 บาท',
            'price_llms'   => 'from 35,900 THB / project',
            'accent'       => 'blue',
            'featured'     => true,
            'form_value'   => 'seo-website',
            'bullets'      => array(
                array( 'label' => 'เว็บไซต์ WordPress', 'path' => '/services/website-development/wordpress/' ),
                array( 'label' => 'Headless WordPress + Next.js', 'path' => '/nextjs-vs-wordpress-2026/' ),
                array( 'label' => 'เว็บไซต์บริษัท · E-commerce · Landing Page' ),
                array( 'label' => 'Website Audit ฟรี', 'path' => '/website-audit/' ),
            ),
        ),
        'ai' => array(
            'key'          => 'ai',
            'name'         => 'ที่ปรึกษา AI สำหรับธุรกิจ',
            'short'        => 'ที่ปรึกษา AI',
            'en_name'      => 'AI Consulting',
            'path'         => '/services/ai-consulting/',
            'desc'         => 'วางระบบ AI Solution ให้ธุรกิจไทยถึง production — LINE Chatbot, RAG Knowledge Base, Sales GPT, AI Agent — ประเมิน ROI ก่อนลงมือ พร้อม knowledge transfer ให้ทีมคุณดูแลต่อเอง',
            'en_desc'      => 'LINE bot, sales GPT, RAG knowledge base, and custom AI agents that ship to production for Thai businesses.',
            'service_type' => 'AI Consulting',
            'stack'        => 'LINE Bot · RAG · Sales GPT · AI Agent',
            'price'        => 'เริ่ม 60,000 บาท',
            'price_llms'   => 'from 60,000 THB / project',
            'accent'       => 'violet',
            'featured'     => true,
            'form_value'   => 'ai-consulting',
            'bullets'      => array(
                array( 'label' => 'LINE Chatbot AI', 'path' => '/line-chatbot-ai-guide-2026/' ),
                array( 'label' => 'RAG / Knowledge Base', 'path' => '/ai-agent-rag-chatbot-thailand-2026/' ),
                array( 'label' => 'รับทำ AI Tool / Prototype', 'path' => '/รับทำ-ai-tool-prototype-2026/' ),
                array( 'label' => 'AI Transformation', 'path' => '/ai-transformation-คือ-2026/' ),
                array( 'label' => 'ปรึกษาทำระบบ AI Solution → คู่มือ', 'path' => '/ai-solution-consulting-guide-2026/' ),
                array( 'label' => 'AI Consulting Bangkok (English)', 'path' => '/en/ai-consulting/' ),
            ),
        ),
        'seo' => array(
            'key'          => 'seo',
            'name'         => 'รับทำ SEO',
            'short'        => 'รับทำ SEO',
            'en_name'      => 'SEO Services (technical-first)',
            'path'         => '/services/seo/',
            'desc'         => 'SEO สายเทคนิคสำหรับเว็บที่มีอยู่แล้ว — Technical Audit, Core Web Vitals, Schema, Local SEO, CRO และ GEO/AI Overview — ติดตามอันดับจากระบบของเราเองรายวัน',
            'en_desc'      => 'Technical-first SEO retainer: technical audit, Core Web Vitals, schema, local SEO, CRO tracking and GEO/AI Overview optimisation with daily rank tracking.',
            'service_type' => 'SEO',
            'stack'        => 'Technical Audit · Core Web Vitals · Local SEO · CRO',
            'price'        => 'เริ่มต้น 25,000 บาท/เดือน',
            'price_llms'   => 'from 25,000 THB / month',
            'accent'       => 'amber',
            'featured'     => false,
            'form_value'   => 'seo',
            'bullets'      => array(
                array( 'label' => 'Technical SEO Audit ฟรี', 'path' => '/seo-audit/' ),
                array( 'label' => 'Local SEO Bangkok', 'path' => '/local-seo-bangkok-b2b-2026/' ),
                array( 'label' => 'SEO Recovery', 'path' => '/seo-recovery-audit/' ),
                array( 'label' => 'Schema & Core Web Vitals', 'path' => '/technical-seo-guide/' ),
                array( 'label' => 'CRO + Tracking', 'path' => '/services/seo/#cro' ),
            ),
        ),
        'ai-search' => array(
            'key'           => 'ai-search',
            'name'          => 'รับทำ AI Search (GEO)',
            'short'         => 'รับทำ AI Search',
            'en_name'       => 'AI Search Optimization (GEO)',
            'path'          => '/services/ai-search/',
            'requires_page' => 'services/ai-search',
            'desc'          => 'ทำให้แบรนด์ถูกอ้างอิงใน Google AI Overview, ChatGPT, Perplexity และ Gemini — วัดผลด้วย AI Visibility, Brand Mentions และ Citations จากระบบ track ของเราเอง',
            'en_desc'       => 'Generative Engine Optimization: get cited by Google AI Overviews, ChatGPT, Perplexity and Gemini, measured by AI visibility, brand mentions and citations.',
            'service_type'  => 'Generative Engine Optimization',
            'stack'         => 'AI Overview · ChatGPT · Perplexity · Gemini · llms.txt',
            'price'         => '',
            'price_llms'    => '',
            'accent'        => 'cyan',
            'featured'      => false,
            'form_value'    => 'ai-search',
            'bullets'       => array(
                array( 'label' => 'AI Overview ในไทย', 'path' => '/google-ai-overview-thailand-2026/' ),
                array( 'label' => 'GEO คืออะไร', 'path' => '/geo-ai-search-optimization-2026/' ),
                array( 'label' => 'ChatGPT · Perplexity · Gemini' ),
                array( 'label' => 'llms.txt คืออะไร', 'path' => '/llms-txt-คืออะไร-2026/' ),
                array( 'label' => 'เว็บรองรับ AI Search checklist', 'path' => '/เว็บไซต์รองรับ-ai-search-2026/' ),
                array( 'label' => 'GEO Checker ฟรี', 'path' => '/geo-checker/' ),
            ),
        ),
        'n8n' => array(
            'key'           => 'n8n',
            'name'          => 'รับทำ Workflow Automation (n8n)',
            'short'         => 'รับทำ n8n',
            'en_name'       => 'n8n Workflow Automation',
            'path'          => '/services/n8n-automation/',
            'requires_page' => 'services/n8n-automation',
            'desc'          => 'วางระบบอัตโนมัติด้วย n8n แบบ self-host บนเซิร์ฟเวอร์ของคุณ เชื่อม LINE OA, CRM, Google Sheet, Notion — ส่งมอบพร้อม workflow และเอกสารให้แก้เองต่อได้',
            'en_desc'       => 'Self-hosted n8n automation connecting LINE OA, CRM, Google Sheets and Notion, delivered as a project with workflow files and documentation.',
            'service_type'  => 'Workflow Automation',
            'stack'         => 'Self-host · LINE OA · CRM sync · Sheet / Notion',
            'price'         => 'เริ่มต้น 29,000 บาท',
            'price_llms'    => 'from 29,000 THB / project',
            'accent'        => 'emerald',
            'featured'      => false,
            'form_value'    => 'n8n',
            'bullets'       => array(
                array( 'label' => 'n8n คืออะไร', 'path' => '/n8n-thai-guide-2026/' ),
                array( 'label' => 'LINE OA · CRM sync' ),
                array( 'label' => 'Google Sheet / Notion' ),
                array( 'label' => 'n8n ราคา', 'path' => '/services/n8n-automation/#pricing' ),
            ),
        ),
    );

    return $catalog;
}

/**
 * Catalogue entries whose landing page actually exists (or needs none).
 */
function hashbox_service_catalog_live() {
    static $live = null;
    if ( null !== $live ) {
        return $live;
    }

    $live = array();
    foreach ( hashbox_service_catalog() as $key => $item ) {
        if ( ! empty( $item['requires_page'] ) && ! get_page_by_path( $item['requires_page'], OBJECT, 'page' ) ) {
            continue;
        }
        $live[ $key ] = $item;
    }
    return $live;
}

function hashbox_service_url( $item ) {
    return home_url( $item['path'] );
}

/**
 * Offer entries for Organization/ProfessionalService hasOfferCatalog.
 */
function hashbox_service_offer_catalog() {
    $offers = array();
    foreach ( hashbox_service_catalog_live() as $item ) {
        $offers[] = array(
            '@type'       => 'Offer',
            'url'         => hashbox_service_url( $item ),
            'itemOffered' => array(
                '@type'       => 'Service',
                '@id'         => hashbox_service_url( $item ) . '#service',
                'name'        => $item['name'],
                'alternateName' => $item['en_name'],
                'url'         => hashbox_service_url( $item ),
                'description' => $item['en_desc'],
                'serviceType' => $item['service_type'],
            ),
        );
    }
    return array(
        '@type'           => 'OfferCatalog',
        'name'            => 'Hashbox Studio Services',
        'itemListElement' => $offers,
    );
}

/**
 * Sub-service bullets as HTML list. Bullets with a path become links.
 */
function hashbox_service_bullets_html( $item, $class = 'hb-svc__subs' ) {
    if ( empty( $item['bullets'] ) ) {
        return '';
    }
    $out = '<ul class="' . esc_attr( $class ) . '">';
    foreach ( $item['bullets'] as $b ) {
        $label = esc_html( $b['label'] );
        if ( ! empty( $b['path'] ) ) {
            $out .= '<li><a href="' . esc_url( home_url( $b['path'] ) ) . '">' . $label . '</a></li>';
        } else {
            $out .= '<li>' . $label . '</li>';
        }
    }
    return $out . '</ul>';
}
