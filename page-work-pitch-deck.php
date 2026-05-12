<?php
/**
 * Template Name: Work: Pitch Deck
 *
 * @package Hashbox_Studio
 */

get_header();

hashbox_render_case_study( array(
    'slug'      => 'pitch-deck',
    'name'      => 'Pitch Deck Microsite',
    'industry'  => 'SaaS Startup',
    'year'      => '2025',
    'timeline'  => '3 สัปดาห์',
    'tag'       => 'Investor Web',
    'headline'  => 'Investor Microsite + Data Viz ที่ช่วยปิด Series A',
    'lede'      => 'SaaS Startup กำลังระดมทุน Series A ใช้ PDF Pitch Deck ไม่ทันใจ Investor ที่อยากเห็น Real-time Metrics เราสร้าง Investor Microsite ที่มี Live Metrics Dashboard + Data Viz ใน 3 สัปดาห์ ผลคือปิด Round ที่ Valuation เพิ่ม 1.4x',

    'snapshot' => array(
        array( 'value' => 'Series A', 'label' => 'Closed (3 เดือน)' ),
        array( 'value' => '1.4×',    'label' => 'Valuation Uplift' ),
        array( 'value' => '3 wk',    'label' => 'Time to Ship' ),
    ),

    'challenge' => 'SaaS B2B รายนี้กำลัง Pitch Series A ในช่วงที่ Traction ค่อนข้างดี โดย MRR เติบโต 18% ต่อเดือน แต่ Pitch Deck ที่ใช้เป็น PDF Static ทำให้ Investor หลายคนขอให้ Update ทุกเดือน Founder ต้องเสียเวลากับการ Manual Update บ่อยมาก นอกจากนั้นยังมี Investor บางรายที่ขอเข้าถึง Live Dashboard เพื่อ Track Progress ระหว่างพิจารณา ผลคือระยะเวลาในการปิด Round ช้าลง และ Negotiation ก็อ่อนแอเพราะข้อมูลไม่ Real-time',

    'approach' => array(
        array( 'h' => 'Microsite Architecture', 'p' => 'Next.js + Edge Auth (Cloudflare Access) · Investor-only Routes · Public + Gated Sections · Server-side render เพื่อให้ Share Link Preview สวย' ),
        array( 'h' => 'Live Metrics Layer', 'p' => 'API ดึงจาก Stripe (MRR/ARR/Churn) + Mixpanel (Active Users) + Database (Cohort Retention) · Refresh ทุก 5 นาที · Cache บน Edge' ),
        array( 'h' => 'Data Visualization', 'p' => 'D3.js + Recharts สำหรับ Cohort Chart + Funnel + Retention Curve · Mobile-responsive · Print-friendly สำหรับ Investor ที่ต้อง Forward ทีมอื่น' ),
        array( 'h' => 'Access + Analytics', 'p' => 'Tracking ว่า Investor คนไหนเปิด Page ไหนกี่นาที (ผ่าน Magic Link + Hash) · Founder เห็น Real-time Signal ของ Investor Interest' ),
        array( 'h' => 'Iteration ระหว่าง Pitch', 'p' => 'อัพเดท Numbers รายสัปดาห์ · เพิ่ม Section ตามที่ Investor ถาม · Founder บอกว่าระยะเวลาปิด Round เร็วขึ้น 40%' ),
    ),

    'results' => array(
        array( 'value' => 'Series A', 'label' => 'ปิด Round ในเดือนที่ 3' ),
        array( 'value' => '1.4×',    'label' => 'Valuation vs Initial Term Sheet' ),
        array( 'value' => '40%',     'label' => 'เร็วกว่า Original Timeline' ),
        array( 'value' => '11/14',   'label' => 'Investor Meetings ถูกขอ Follow-up' ),
        array( 'value' => '3 weeks', 'label' => 'Time to Ship Initial' ),
        array( 'value' => '0',       'label' => 'Manual Update หลัง Ship' ),
    ),

    'stack' => array( 'Next.js 15', 'Cloudflare Access', 'Stripe API', 'Mixpanel API', 'D3.js + Recharts', 'PostgreSQL', 'Vercel Edge' ),

    'testimonial' => array(
        'quote'       => 'Microsite ช่วยให้เราเล่าเรื่องด้วย Live Data ไม่ใช่ Pitch Slide เก่า ๆ Investor เข้าถึงทุกอย่างเมื่อพร้อม Round เลย Close เร็วและ Term ดีกว่าที่คิด',
        'attribution' => 'Co-founder & CEO, SaaS Startup',
    ),
) );

get_footer();
