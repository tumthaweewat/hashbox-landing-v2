<?php
/**
 * Template Name: Work: AutoBot LINE
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'autobot-line',
    'name'      => 'AutoBot LINE',
    'industry'  => 'On-demand Services',
    'year'      => '2025',
    'timeline'  => '8 สัปดาห์',
    'tag'       => 'AI Workforce',
    'headline'  => 'LINE Bot + OpenAI ตอบลูกค้า 24/7 ลด Support Cost 60%',
    'lede'      => 'บริการ On-demand ที่มี Inquiry เข้ามา 1,200/วัน ผ่าน LINE OA ทีม Support 8 คนตอบไม่ทัน Avg Response Time 2h+ ลูกค้าหายระหว่างรอ เราสร้าง LINE Bot ที่ใช้ OpenAI + RAG ตอบ FAQ 80% และ Route ไป Human เฉพาะที่ซับซ้อน',

    'snapshot' => array(
        array( 'value' => '−60%', 'label' => 'Support Operating Cost' ),
        array( 'value' => '2 min', 'label' => 'Avg Response Time (จาก 2h)' ),
        array( 'value' => '84%',  'label' => 'AI-handled Resolution' ),
    ),

    'challenge' => 'ลูกค้าของบริการนี้ทักผ่าน LINE OA เฉลี่ย 1,200 ข้อความต่อวัน ทีม Support 8 คนต้องทำงาน 24/7 เพื่อตอบทั้งหมด ปัญหาคือคำถามส่วนใหญ่เป็น FAQ ซ้ำ ๆ เรื่อง Pricing, Service Area, สถานะการจอง — ทีมเริ่มเบื่อ และในช่วง Peak Hours ลูกค้าต้องรอกว่า 2 ชั่วโมงก่อนได้คำตอบ ทำให้ Conversion จาก Inquiry ตกลง 22% แต่การจ้าง Support เพิ่มก็ไม่คุ้มกับ Headcount Cost ที่จะเพิ่มขึ้น',

    'approach' => array(
        array( 'h' => 'AI ROI Discovery (1 สัปดาห์)', 'p' => 'วิเคราะห์ Message Log 30 วัน · จัด Category พบ FAQ 80% มาจาก 12 Intent หลัก · ROI Model: ลด FTE 4 คน ภายใน 6 เดือน Payback ภายใน 4 เดือน' ),
        array( 'h' => 'RAG Knowledge Base', 'p' => 'Embed FAQ + Service Catalog + Pricing + SOP ผ่าน OpenAI text-embedding-3-large เก็บใน Qdrant ปรับ Chunking + Re-rank' ),
        array( 'h' => 'LINE Bot Integration', 'p' => 'LINE Messaging API + Flex Message + Quick Reply · ตอบภาษาไทย 100% · เชื่อม CRM เพื่อดึง Booking History · Audit Log ทุก Conversation' ),
        array( 'h' => 'Human Handoff Logic', 'p' => 'AI ตอบเอง 80% · Sentiment Negative/Complex Intent → Route ไป Human Queue พร้อม Context Summary · ทีม Support เห็น Conversation History ทั้งหมด' ),
        array( 'h' => 'Train + Monitor', 'p' => 'Train Support Team ใช้ Dashboard · Monitor Cost ต่อวัน + Quality Score รายสัปดาห์ · Iterate Prompt ตาม Failure Cases เก็บมาทุก 2 สัปดาห์' ),
    ),

    'results' => array(
        array( 'value' => '−60%', 'label' => 'Support Operating Cost' ),
        array( 'value' => '2 min', 'label' => 'Avg Response Time (จาก 2h)' ),
        array( 'value' => '84%',  'label' => 'AI-handled Resolution' ),
        array( 'value' => '+18%', 'label' => 'Inquiry → Booking Conversion' ),
        array( 'value' => '4.7/5', 'label' => 'Customer CSAT Score' ),
        array( 'value' => '~3,200', 'label' => 'Conversations/วัน (จาก 1,200)' ),
    ),

    'stack' => array( 'OpenAI GPT-4.1', 'LangChain', 'Qdrant (Vector DB)', 'LINE Messaging API', 'n8n (Orchestration)', 'Node.js', 'PostgreSQL', 'Looker Studio' ),

    'testimonial' => array(
        'quote'       => 'เราพยายามทำ Chatbot มา 2 ปีไม่เคยเวิร์ก ทีม Hashbox ใช้เวลา 8 สัปดาห์ส่งมอบของที่ใช้ได้จริง ทีม Support สบายขึ้น ลูกค้าได้คำตอบเร็วขึ้น ROI ชัด',
        'attribution' => 'Founder, On-demand Service Startup',
    ),
) );

get_footer();
