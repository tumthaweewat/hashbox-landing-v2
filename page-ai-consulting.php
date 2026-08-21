<?php
/**
 * Template Name: Service: AI Expert Consulting
 *
 * The H1 targets hiring intent, not the informational phrase "ปรึกษาทำระบบ AI
 * Solution" — that belongs to /ai-solution-consulting-guide-2026/, which ranks
 * 3rd for it and is cited in Google's AI Overview. While this page repeated the
 * phrase the two competed, Google picked the guide, and this page sat around
 * position 67 on the same Thai queries. The <title> is kept in step in the
 * $page_meta['ai-consulting'] entry inside hashbox_get_seo_metadata(); change
 * both together or the page contradicts itself.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
// Feeds the Service schema description below. Same edit as the <title>: the
// commercial lead ("บริการให้คำปรึกษา AI Solution", a query this page should
// win) stays, the guide's head phrase goes — otherwise the machine-readable
// description contradicts the title we just rewrote.
$desc = 'บริการให้คำปรึกษา AI Solution สำหรับธุรกิจไทย · รับวางระบบ AI, LINE Chatbot, RAG Knowledge Base, Workflow Automation และ Custom AI Integration · คุยประเมินโอกาสเบื้องต้นฟรี 30 นาที · โปรเจกต์เริ่ม 60,000 บาท';

$author_name      = 'Tum Thaweewat';
$author_role      = 'Head of Tech';
$author_linkedin  = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio       = '17 ปีประสบการณ์ Software Engineering และการเชื่อมระบบธุรกิจ · ดูแลตั้งแต่การเลือก use case, architecture และ integration ไปจนถึง production monitoring';

$faqs = array(
    array( 'q' => 'บริการที่ปรึกษา AI ราคาเริ่มต้นเท่าไหร่?', 'a' => 'คุย AI Opportunity Screening เบื้องต้น 30 นาทีฟรี · ROI Assessment Report แบบลงรายละเอียดเริ่ม 60,000 บาท · PoC (Proof of Concept) 150,000-300,000 บาท · Production Build 300,000-1,500,000 บาท · ที่ปรึกษารายเดือน 30,000-150,000 บาท/เดือน' ),
    array( 'q' => 'ใช้เวลานานเท่าไหร่ตั้งแต่เริ่มถึง production?', 'a' => 'Simple chatbot (LINE OA + LLM): 2-3 สัปดาห์ · RAG Knowledge Base: 4-6 สัปดาห์ · Sales GPT + CRM integration: 6-10 สัปดาห์ · Custom AI agent + workflow: 8-16 สัปดาห์ ขึ้นกับ data + integration scope' ),
    array( 'q' => 'Hashbox ใช้ AI model อะไรบ้าง?', 'a' => 'เลือกตามโจทย์ · OpenAI (GPT-5, GPT-4o) สำหรับ general-purpose · Anthropic Claude (Opus 4.7, Sonnet 4.6, Haiku 4.5) สำหรับ reasoning + long context · Google Gemini สำหรับ multimodal · open-source (Llama, Mistral) สำหรับ self-host/PDPA-sensitive · OpenAI Embedding หรือ Cohere สำหรับ RAG' ),
    array( 'q' => 'ที่ปรึกษา AI ไทย ต่างจาก agency ทั่วไปอย่างไร?', 'a' => 'Agency ทั่วไปขายชั่วโมง consulting หรือ training course · Hashbox ส่งมอบ AI system ที่ run production ได้จริง พร้อม monitoring, cost guardrails, fallback logic, และ source code · ลูกค้าเป็นเจ้าของ 100% · ไม่ผูก vendor' ),
    array( 'q' => 'รับทำ LINE Chatbot AI ไหม?', 'a' => 'รับ · เป็นบริการที่นิยมที่สุด ครอบคลุม LINE OA integration + LLM + custom knowledge base + handoff ไป human agent + analytics dashboard ดูบทความ LINE Chatbot AI Guide สำหรับรายละเอียด' ),
    array( 'q' => 'รับทำ RAG (Retrieval-Augmented Generation) ไหม?', 'a' => 'รับ · ทำ vector database (Pinecone, Qdrant, Weaviate), embedding model selection, chunking strategy, retrieval reranking, citation tracking ใช้กับ knowledge base ภายในบริษัท, customer support, sales enablement, document Q&A' ),
    array( 'q' => 'AI Workforce / Custom Agent คืออะไร?', 'a' => 'AI agent ที่ทำงานต่อเนื่องในบริษัท เช่น lead qualification bot, content generation pipeline, data analysis agent, monitoring + alert agent ระบบนี้ใช้ LLM + tool use + scheduled triggers + integration กับระบบเดิม (Salesforce, HubSpot, Notion, Slack, LINE)' ),
    array( 'q' => 'คำนวณ AI ROI ทำอย่างไร?', 'a' => 'เริ่มด้วย AI Opportunity Screening 30 นาทีฟรีเพื่อดูโจทย์และความพร้อมเบื้องต้น หากต้องวิเคราะห์เชิงลึกจะเป็น ROI Assessment Report แบบเสียค่าใช้จ่าย: map workflow, ระบุ task ที่ automate ได้ และเทียบ hours saved กับ implementation + ongoing API cost' ),
    array( 'q' => 'PDPA + Data Privacy ดูแลอย่างไร?', 'a' => 'เลือก AI provider ตาม data sensitivity · public LLM (OpenAI, Anthropic) สำหรับ non-sensitive · Azure OpenAI หรือ AWS Bedrock สำหรับ enterprise privacy · self-host (Llama, Mistral) สำหรับ data ห้ามออกจาก premise · มี data masking + audit log ทุกโปรเจกต์' ),
    array( 'q' => 'มี ongoing maintenance + monitoring ไหม?', 'a' => 'มี Care Plan รายเดือนเริ่ม 30,000 บาท ครอบคลุม API cost monitoring, performance tracking, prompt engineering updates, hallucination guard, security patches, monthly performance review' ),
    array( 'q' => 'รับ integration กับระบบเดิมไหม? (CRM, ERP, LINE)', 'a' => 'รับ integration กับ Salesforce, HubSpot, Zoho, Pipedrive, SAP, LINE OA, Microsoft Teams, Slack, Notion, Airtable, Google Workspace, Make/n8n, Zapier เว็บ legacy ใช้ REST API หรือ webhook' ),
    array( 'q' => 'ทำในไทย vs จ้าง offshore (อินเดีย, ฟิลิปปินส์) ต่างกันยังไง?', 'a' => 'Offshore ราคาถูกกว่า 40-60% แต่เจอ problem ใหญ่: ไม่เข้าใจ business context ไทย, ไม่รู้ LINE ecosystem, sync time zone ยาก, PDPA compliance ไม่ชัด · Hashbox in-house ไทยทำให้ deploy เร็วและ relevant กับ Thai market' ),
);

$services_offered = array(
    array( 'name' => 'LINE Chatbot AI', 'desc' => 'AI chatbot บน LINE OA — LLM + knowledge base + human handoff' ),
    array( 'name' => 'Sales GPT', 'desc' => 'AI agent สำหรับ lead qualification, follow-up, proposal generation' ),
    array( 'name' => 'RAG Knowledge Base', 'desc' => 'Vector DB + retrieval สำหรับ document Q&A, customer support, internal wiki' ),
    array( 'name' => 'AI Workforce Agent', 'desc' => 'Autonomous agent ที่ทำงานต่อเนื่อง — monitoring, content, data analysis' ),
    array( 'name' => 'Workflow Automation', 'desc' => 'AI + Make/n8n/Zapier — automate repetitive tasks ข้ามระบบ' ),
    array( 'name' => 'Custom AI Integration', 'desc' => 'AI ใน existing app — OpenAI/Claude/Gemini API integration' ),
);

$deliverables = array(
    'ROI Assessment Report 10-15 หน้า',
    'PoC ที่ run ได้จริง (ก่อน production)',
    'Production AI system + source code',
    'API cost monitoring dashboard',
    'Prompt engineering documentation',
    'Hallucination guard + fallback logic',
    'PDPA compliance review',
    'Integration กับระบบเดิม (CRM, LINE, etc.)',
    'Admin dashboard',
    'Analytics + conversation tracking',
    'Performance benchmarks',
    'Cost guardrails (max spend per day/month)',
    'Source code + Git repository',
    'Documentation 20-30 หน้า',
    'Training session 4 ชั่วโมง',
    '30-day post-launch support',
    'Monthly performance report template',
    'Backup + disaster recovery plan',
);

$process = array(
    array( 'name' => 'Discovery + ROI Assessment', 'time' => 'Week 1', 'detail' => 'สัมภาษณ์ stakeholder, map workflow ปัจจุบัน, ระบุ AI use case และคำนวณ ROI ตาม scope ที่ตกลง' ),
    array( 'name' => 'Architecture + Model Selection', 'time' => 'Week 1-2', 'detail' => 'เลือก LLM, vector DB, integration approach, security model, cost projection' ),
    array( 'name' => 'PoC Build', 'time' => 'Week 2-4', 'detail' => 'Build minimal viable AI system, test กับ real data, iterate prompts, validate ROI' ),
    array( 'name' => 'Production Build + Integration', 'time' => 'Week 4-8', 'detail' => 'Scale up architecture, integrate กับ CRM/LINE/ERP, monitoring + alerts, security hardening' ),
    array( 'name' => 'Pilot + UAT', 'time' => 'Week 8-10', 'detail' => 'Pilot กับทีมเล็ก, gather feedback, prompt tuning, fallback testing' ),
    array( 'name' => 'Production Launch + Monitor', 'time' => 'Week 10+', 'detail' => 'Full rollout, daily monitoring 30 วันแรก, monthly performance review' ),
);

$pricing = array(
    array( 'tier' => 'ROI Assessment', 'price' => 60000, 'scope' => 'Discovery + 1 use case', 'time' => '1-2 สัปดาห์', 'fit' => 'ทีมที่ยังไม่แน่ใจว่า AI ทำอะไรได้' ),
    array( 'tier' => 'PoC + Validation', 'price' => 200000, 'scope' => '1 AI use case end-to-end', 'time' => '3-5 สัปดาห์', 'fit' => 'อยากเห็น proof ก่อนลงทุนเต็ม' ),
    array( 'tier' => 'Production Build', 'price' => 500000, 'scope' => '1-2 AI systems + integration', 'time' => '6-12 สัปดาห์', 'fit' => 'พร้อม deploy ใน production' ),
    array( 'tier' => 'AI Workforce Enterprise', 'price' => 1200000, 'scope' => 'Multi-agent + multi-integration', 'time' => '12-20 สัปดาห์', 'fit' => 'Transformation ระดับองค์กร' ),
);

$cases = array(
    array( 'name' => 'AutoBot LINE (On-demand Service)', 'tag' => 'LINE OA + OpenAI + RAG', 'metric1' => 'Response time 2 ชั่วโมง → 2 นาที', 'metric2' => 'Support operating cost -60%', 'metric3' => 'Inquiry → Booking +18%', 'url' => '/work/autobot-line/' ),
);
?>

<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <nav class="hb-breadcrumb" aria-label="Breadcrumb">
                <ol class="hb-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">AI Consulting Bangkok</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Service 03 / 03 · Updated <?php echo esc_html( date_i18n( 'F Y' ) ); ?></span>
            <h1 class="hb-hero__title">ที่ปรึกษา AI<br><em>สำหรับธุรกิจไทย</em><br>รับวางระบบ AI ถึง Production</h1>
            <p class="hb-hero__sub">บริการให้คำปรึกษา AI Solution สำหรับธุรกิจไทยที่ต้องการ deploy AI ใน production จริง — LINE Chatbot, RAG Knowledge Base, Workflow Automation และ Custom AI Integration · เริ่มจากโจทย์ธุรกิจและข้อมูลที่มี · โปรเจกต์เริ่ม 60,000 บาท</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/ai-workflow-audit/#audit-form' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">นัดคุย AI ฟรี 30 นาที</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดู AI Case Studies</a>
            </div>
            <div class="hb-trustbar" style="margin-top:var(--hb-space-8);display:flex;flex-wrap:wrap;gap:var(--hb-space-5);align-items:center;color:var(--hb-text-muted,#a1a1aa);font-size:var(--hb-text-sm);">
                <span>✓ ROI calculation ก่อนเริ่ม</span>
                <span>✓ เริ่มจาก Use Case + ROI</span>
                <span>✓ PDPA + Data Privacy</span>
                <span>✓ Source code 100%</span>
                <span>✓ No vendor lock-in</span>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">คำตอบสั้น</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox ให้บริการที่ปรึกษา AI — รับปรึกษาและทำระบบ AI Solution สำหรับธุรกิจไทย</strong> ครอบคลุม LINE Chatbot, RAG Knowledge Base, AI Workforce Agent และ Workflow Automation · เริ่มด้วย AI Opportunity Screening ฟรี 30 นาที ส่วน ROI Assessment Report แบบลงรายละเอียดเริ่ม 60,000 บาท · เลือก model ตามโจทย์และความไวของข้อมูล · ส่งมอบ source code ตามขอบเขตที่ตกลง
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">ปัญหา</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทำไมหลายโปรเจกต์ AI ไปไม่ถึง Production</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">โปรเจกต์ที่เริ่มจากเทคโนโลยีแทนโจทย์ธุรกิจมักติดอยู่ที่ demo สาเหตุที่พบบ่อยมี 4 ข้อ:</p>
        <div class="hb-bento" style="margin-top:var(--hb-space-6);">
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">No ROI Plan</span>
                <h3 class="hb-card__title">เริ่มจาก "อยากใช้ AI" ไม่ใช่ "มี problem"</h3>
                <p class="hb-card__body">PoC ดูดีบน demo แต่ไม่ได้คำนวณ hours saved × cost ทำให้ไม่มี business case ใน production</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">No Integration</span>
                <h3 class="hb-card__title">AI ไม่เชื่อมกับ CRM/ERP/LINE เดิม</h3>
                <p class="hb-card__body">Chatbot ตอบเก่งแต่ไม่ update CRM, ไม่ trigger workflow ทำให้ไม่มีคุณค่าจริงต่อทีม</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Cost Runaway</span>
                <h3 class="hb-card__title">API cost บานออกไม่มี guardrail</h3>
                <p class="hb-card__body">ไม่มี rate limit, cache, model fallback ทำให้ bill เดือนแรก ฿20,000 → เดือน 6 ฿200,000</p>
            </div>
            <div class="hb-bento__cell">
                <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);">Hallucination</span>
                <h3 class="hb-card__title">AI ตอบผิดในเรื่องสำคัญ</h3>
                <p class="hb-card__body">ไม่มี citation, ไม่มี fact-check, ไม่มี fallback ทำให้ลูกค้าได้ข้อมูลผิด · brand เสียหาย</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Services</span>
            <h2 class="hb-h2">บริการปรึกษาและทำระบบ AI Solution</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">6 บริการหลัก ครอบคลุม use case ที่พบบ่อยที่สุดใน Thai B2B + SMB</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <?php foreach ( $services_offered as $s ) : ?>
                <div class="hb-card hb-card--elevated">
                    <h3 class="hb-card__title"><?php echo esc_html( $s['name'] ); ?></h3>
                    <p class="hb-card__body" style="font-size:var(--hb-text-sm);"><?php echo esc_html( $s['desc'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Deliverables</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">สิ่งที่คุณได้รับใน AI Consulting Package</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">เลือก deliverables ตาม tier และ scope ที่ตกลงก่อนเริ่มงาน จึงเห็นขอบเขต ค่าใช้จ่าย และสิ่งส่งมอบชัดเจน</p>
        <ul style="margin-top:var(--hb-space-6);display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-3);list-style:none;padding:0;">
            <?php foreach ( $deliverables as $d ) : ?>
                <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;font-size:var(--hb-text-sm);">
                    <svg aria-hidden="true" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--hb-accent-emerald)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
                    <span><?php echo esc_html( $d ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Process</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">Process 6 Phase: Assessment → Production</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">ระบบทำงานแบบ phased delivery เริ่มจาก ROI ก่อน build เพื่อลดความเสี่ยง</p>
        <ol style="margin-top:var(--hb-space-6);list-style:none;padding:0;display:flex;flex-direction:column;gap:var(--hb-space-4);">
            <?php foreach ( $process as $i => $p ) : ?>
                <li style="display:flex;gap:var(--hb-space-4);padding:var(--hb-space-5);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);border-left:3px solid var(--hb-accent-cyan,#06B6D4);">
                    <div style="flex-shrink:0;width:48px;height:48px;border-radius:50%;background:var(--hb-accent-cyan,#06B6D4);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:var(--hb-text-lg);"><?php echo (int) ( $i + 1 ); ?></div>
                    <div>
                        <div style="display:flex;gap:var(--hb-space-3);align-items:baseline;flex-wrap:wrap;">
                            <h3 class="hb-card__title" style="margin:0;"><?php echo esc_html( $p['name'] ); ?></h3>
                            <span class="hb-eyebrow" style="color:var(--hb-accent-amber,#F59E0B);"><?php echo esc_html( $p['time'] ); ?></span>
                        </div>
                        <p class="hb-body" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $p['detail'] ); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Case Studies</span>
            <h2 class="hb-h2">ผลงาน AI ที่ run production จริง</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">ตัวอย่างระบบที่ใช้งานจริง พร้อมตัวเลขผลลัพธ์จากหน้า Case Study</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:var(--hb-space-4);">
            <?php foreach ( $cases as $c ) : ?>
                <a class="hb-card hb-card--elevated" href="<?php echo esc_url( home_url( $c['url'] ) ); ?>" style="text-decoration:none;display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <span class="hb-eyebrow"><?php echo esc_html( $c['tag'] ); ?></span>
                    <h3 class="hb-card__title"><?php echo esc_html( $c['name'] ); ?></h3>
                    <div style="display:flex;flex-direction:column;gap:var(--hb-space-2);margin-top:var(--hb-space-3);">
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric1'] ); ?></div>
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric2'] ); ?></div>
                        <div style="font-size:var(--hb-text-sm);color:var(--hb-accent-emerald,#10B981);font-weight:600;">▲ <?php echo esc_html( $c['metric3'] ); ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Comparison</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">Hashbox AI Consulting vs ทางเลือกอื่น</h2>
        <p class="hb-lead" style="margin-top:var(--hb-space-4);">เทียบ deliverable + ผลลัพธ์ vs ทางเลือกที่บริษัทไทยพิจารณาบ่อย</p>
        <div style="margin-top:var(--hb-space-6);overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:var(--hb-text-sm);min-width:680px;">
                <thead>
                    <tr style="border-bottom:2px solid var(--hb-border,#27272A);">
                        <th style="text-align:left;padding:var(--hb-space-3);">รายการ</th>
                        <th style="text-align:center;padding:var(--hb-space-3);color:var(--hb-accent-blue,#2563EB);">Hashbox</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">Big Consulting</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">Freelance / Offshore</th>
                        <th style="text-align:center;padding:var(--hb-space-3);">DIY (ChatGPT Team)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = array(
                        array( 'ROI assessment ก่อนเริ่ม', '✓', 'เพิ่ม fee', '✗', 'ทำเอง' ),
                        array( 'Production-grade build', '✓', '✓', 'บางเคส', '✗' ),
                        array( 'CRM/LINE/ERP integration', '✓', '✓', 'จำกัด', '✗' ),
                        array( 'Cost guardrails + monitoring', '✓', 'บางเคส', '✗', '✗' ),
                        array( 'PDPA compliance', '✓', '✓', 'บางเคส', '✗' ),
                        array( 'Source code 100%', '✓', 'บางเคส', '✓', 'N/A' ),
                        array( 'Thai market context', '✓', 'จำกัด', 'มัก ✗', 'N/A' ),
                        array( 'LINE OA expertise', '✓', 'จำกัด', 'จำกัด', '✗' ),
                        array( 'ราคาเริ่ม', '60k บาท', '500k-5M', '50k-300k', '$50/mo' ),
                        array( 'Time-to-production', '4-12 สัปดาห์', '6-18 เดือน', 'unpredictable', 'instant แต่จำกัด' ),
                    );
                    foreach ( $rows as $r ) :
                    ?>
                    <tr style="border-bottom:1px solid var(--hb-border,#27272A);">
                        <td style="padding:var(--hb-space-3);"><?php echo esc_html( $r[0] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-accent-emerald,#10B981);font-weight:600;"><?php echo esc_html( $r[1] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[2] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[3] ); ?></td>
                        <td style="padding:var(--hb-space-3);text-align:center;color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $r[4] ); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="hb-section" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">ราคาบริการที่ปรึกษา AI</h2>
            <p class="hb-lead" style="margin-top:var(--hb-space-4);">แต่ละ tier มีขอบเขตต่างกัน เลือกเริ่มจาก Assessment, PoC หรือ Production ตามความพร้อม</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:var(--hb-space-4);">
            <?php foreach ( $pricing as $p ) : ?>
                <div class="hb-card hb-card--elevated" style="display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <h3 class="hb-card__title"><?php echo esc_html( $p['tier'] ); ?></h3>
                    <div style="font-size:var(--hb-text-xl,1.5rem);font-weight:700;color:var(--hb-accent-cyan,#06B6D4);">
                        เริ่มต้น <?php echo esc_html( number_format( $p['price'] ) ); ?> บาท
                    </div>
                    <div style="font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);">
                        <div>📐 <?php echo esc_html( $p['scope'] ); ?></div>
                        <div>⏱ <?php echo esc_html( $p['time'] ); ?></div>
                    </div>
                    <p class="hb-card__body" style="font-size:var(--hb-text-sm);"><strong>เหมาะกับ:</strong> <?php echo esc_html( $p['fit'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p style="margin-top:var(--hb-space-5);text-align:center;font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);">ราคาไม่รวม VAT 7% และ API cost · นัดคุยประเมินโอกาสเบื้องต้นฟรี 30 นาที ก่อนออก scope และใบเสนอราคา</p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Best fit</span>
            <h2 class="hb-h2">บริการ AI Consulting เหมาะกับใคร</h2>
        </div>
        <div class="hb-bento">
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/line-chatbot-ai-guide-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">E-commerce / Service</span>
                <h3 class="hb-card__title">ทีม customer support overload กับคำถามซ้ำ ๆ</h3>
                <p class="hb-card__body">ดู LINE Chatbot AI Guide — automate 70% ของคำถามได้ ไม่ลดคุณภาพการบริการ</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/ai-workforce-sme-thailand-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">B2B Sales</span>
                <h3 class="hb-card__title">Sales team เสียเวลา 50% กับ admin + lead qualification</h3>
                <p class="hb-card__body">ดู AI Workforce Guide — automate research, qualification, follow-up</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Foundation first</span>
                <h3 class="hb-card__title">เว็บยังไม่ติด Google ก่อนทำ AI</h3>
                <p class="hb-card__body">เริ่มจากบริการรับทำเว็บไซต์ SEO-Ready — ฐานต้องแน่นก่อน AI จะ scale ได้</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Full funnel</span>
                <h3 class="hb-card__title">ทีมเดียวดูทั้ง Web, Marketing และ AI</h3>
                <p class="hb-card__body">ดูภาพรวมบริการทั้งหมดของ Hashbox</p>
            </a>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Author / Team</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">ทีมที่รับผิดชอบโปรเจกต์</h2>
        <div style="margin-top:var(--hb-space-6);display:flex;gap:var(--hb-space-5);padding:var(--hb-space-5);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);flex-wrap:wrap;">
            <div style="flex-shrink:0;width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--hb-accent-cyan,#06B6D4),var(--hb-accent-blue,#2563EB));display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;font-weight:700;">T</div>
            <div style="flex:1;min-width:240px;">
                <h3 class="hb-card__title" style="margin:0;"><?php echo esc_html( $author_name ); ?></h3>
                <p style="margin-top:var(--hb-space-2);font-size:var(--hb-text-sm);color:var(--hb-text-muted,#a1a1aa);"><?php echo esc_html( $author_role ); ?></p>
                <p class="hb-body" style="margin-top:var(--hb-space-3);"><?php echo esc_html( $author_bio ); ?></p>
                <a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener author" target="_blank" style="display:inline-block;margin-top:var(--hb-space-3);font-size:var(--hb-text-sm);color:var(--hb-accent-cyan,#06B6D4);">LinkedIn →</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
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

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">Related</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">บทความที่เกี่ยวข้อง</h2>
        <div style="margin-top:var(--hb-space-6);display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:var(--hb-space-3);">
            <a class="hb-card" href="<?php echo esc_url( home_url( '/line-chatbot-ai-guide-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Guide</span>
                <h3 class="hb-card__title">LINE Chatbot AI Guide 2026</h3>
            </a>
            <a class="hb-card" href="<?php echo esc_url( home_url( '/ai-workforce-sme-thailand-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Guide</span>
                <h3 class="hb-card__title">AI Workforce Guide for Thai SMEs</h3>
            </a>
            <a class="hb-card" href="<?php echo esc_url( home_url( '/ai-agent-rag-chatbot-thailand-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Guide</span>
                <h3 class="hb-card__title">บริการ RAG &amp; AI Agent Chatbot</h3>
            </a>
            <a class="hb-card" href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">GEO</span>
                <h3 class="hb-card__title">GEO + AI Search Optimization</h3>
            </a>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มด้วย AI Opportunity Screening ฟรี</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">คุย 30 นาทีเพื่อประเมิน Use Case, Data Readiness และแนวทางเริ่มต้น · ROI Assessment Report แบบลงรายละเอียดเริ่ม 60,000 บาท</p>
        <a href="<?php echo esc_url( home_url( '/ai-workflow-audit/#audit-form' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">นัดคุย AI ฟรี 30 นาที &rarr;</a>
    </div>
</section>

<?php
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
        'description' => $p['fit'] . ' · ' . $p['scope'] . ' · ' . $p['time'],
        'availability' => 'https://schema.org/InStock',
        'areaServed' => 'TH',
    );
}

hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    '@id' => $page_url . '#service',
    'name' => 'ที่ปรึกษา AI สำหรับธุรกิจ (AI Consulting)',
    'description' => $desc,
    'url' => $page_url,
    'provider' => array( '@id' => home_url( '/#organization' ) ),
    'areaServed' => array(
        '@type' => 'Country',
        'name' => 'Thailand',
    ),
    'serviceType' => 'AI Consulting',
    'category' => 'Artificial Intelligence Consulting',
    'audience' => array(
        '@type' => 'BusinessAudience',
        'audienceType' => 'B2B, SMB, Enterprise',
    ),
    'hasOfferCatalog' => array(
        '@type' => 'OfferCatalog',
        'name' => 'AI Consulting Pricing Tiers',
        'itemListElement' => $offer_catalog,
    ),
    'offers' => $offer_catalog,
    'potentialAction' => array(
        array(
            '@type'  => 'ContactAction',
            'name'   => 'Request Free AI Opportunity Screening',
            'target' => home_url( '/ai-workflow-audit/#audit-form' ),
        ),
        array(
            '@type'  => 'ReserveAction',
            'name'   => 'Book Discovery Call',
            'target' => home_url( '/ai-workflow-audit/#audit-form' ),
        ),
    ),
    'termsOfService' => home_url( '/privacy-policy/#terms' ),
    'isRelatedTo' => array(
        array( '@type' => 'Service', 'name' => 'SEO-Ready Website', 'url' => home_url( '/services/website-development/' ) ),
        array( '@type' => 'Service', 'name' => 'Digital Marketing Tools', 'url' => home_url( '/services/digital-marketing-tools/' ) ),
    ),
) );

hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'ที่ปรึกษา AI สำหรับธุรกิจ', 'item' => $page_url ),
    ),
) );

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
    'name' => 'How to Engage AI Consulting',
    'description' => 'ขั้นตอน AI Consulting 6 phase ตั้งแต่ ROI Assessment ถึง Production Launch',
    'totalTime' => 'P10W',
    'step' => $howto_steps,
) );

get_footer();
