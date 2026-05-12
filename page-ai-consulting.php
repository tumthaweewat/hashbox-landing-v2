<?php
/**
 * Template Name: Service: AI Expert Consulting
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
$desc = 'ทีมเราเป็นที่ปรึกษา AI ที่ลงมือเขียนโค้ดและส่งมอบของจริงให้ลูกค้าใช้งานใน Production ไม่ใช่จบที่ Slide ทุกโปรเจกต์เริ่มต้นด้วยการคำนวณ AI ROI ก่อน';

$faqs = array(
    array( 'q' => 'AI Consulting ต่างจาก AI Consultancy ทั่วไปยังไง?', 'a' => 'AI Consultancy ทั่วไปจบที่ Slide ลูกค้าต้องไปจ้าง Dev อีกบริษัทมา Implement เราทำทั้ง 2 = ออกแบบ + ลงมือเขียน Code + Deploy + Train ทีม' ),
    array( 'q' => 'AI Workforce 4 ประเภทที่ทำให้ มีอะไรบ้าง?', 'a' => '1) Customer Support AI · 2) Sales GPT + RAG · 3) Internal Workflow Automation · 4) Content Operations AI' ),
    array( 'q' => 'AI ROI Framework ทำงานยังไง?', 'a' => 'ก่อนเริ่มเราคำนวณ Hours saved/week × Avg Hourly Rate × Team − Cost ของ AI/month เคสที่ ROI < 3x ใน 6 เดือนเราแนะนำให้ไม่ทำ' ),
    array( 'q' => 'ใช้ Model ไหน?', 'a' => 'OpenAI GPT-4.1 สำหรับ General · Claude Sonnet/Opus สำหรับ Long Context · Llama/Qwen (Local) สำหรับ PDPA-strict เลือกตาม Trade-off Cost/Latency/Privacy' ),
    array( 'q' => 'LINE Bot + OpenAI ทำได้อะไรบ้าง?', 'a' => 'ได้ทั้ง Reply + Push + Rich Menu + Flex Message + Quick Reply + LINE Login + Authenticated Conversation' ),
    array( 'q' => 'ราคาและ Engagement?', 'a' => 'AI ROI Discovery 30,000 บาท · Build 150,000-500,000+ บาท · Retainer เริ่ม 50,000 บาท/เดือน' ),
);
?>

<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <nav class="hb-breadcrumb">
                <ol class="hb-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">AI Consulting</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Service 03 / 03</span>
            <h1 class="hb-hero__title">AI Expert Consulting<br><em>AI Workforce ที่</em><br>ทำงานได้จริงใน Production</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ AI ROI Discovery</a>
                <a href="<?php echo esc_url( home_url( '/work/autobot-line/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูเคส AI</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">AI Workforce</span>
            <h2 class="hb-h2">4 ประเภทที่ทีมเราส่งมอบ</h2>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">01</span>
                <h3 class="hb-h3">Customer Support AI</h3>
                <p class="hb-body">LINE / Web Chat / Email Auto-Reply ตอบ 24/7 TH/EN เชื่อม Knowledge Base พร้อม Sentiment + Alert</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">02</span>
                <h3 class="hb-h3">Sales GPT + RAG</h3>
                <p class="hb-body">AI ที่รู้ Product + Pricing + Lead Qualification + CRM Integration</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">03</span>
                <h3 class="hb-h3">Workflow Automation</h3>
                <p class="hb-body">n8n / Make เชื่อม Tools ภายในองค์กร · OCR + AI Document Processing</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">04</span>
                <h3 class="hb-h3">Content Operations AI</h3>
                <p class="hb-body">SEO Content Draft + Optimize · Schema Auto-generate · Social Repurposing</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Stack</span>
            <h2 class="hb-h2">LLM Models + RAG + Channels</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">LLM Models</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--violet">OpenAI GPT-4.1</span>
                    <span class="hb-badge hb-badge--violet">Claude Sonnet</span>
                    <span class="hb-badge hb-badge--violet">Claude Opus</span>
                    <span class="hb-badge hb-badge--violet">Gemini</span>
                    <span class="hb-badge hb-badge--violet">Llama 3.3</span>
                </div>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">RAG + Orchestration</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--cyan">LangChain</span>
                    <span class="hb-badge hb-badge--cyan">LlamaIndex</span>
                    <span class="hb-badge hb-badge--cyan">Flowise</span>
                    <span class="hb-badge hb-badge--cyan">Pinecone</span>
                    <span class="hb-badge hb-badge--cyan">Qdrant</span>
                </div>
            </div>
            <div class="hb-card hb-card--elevated">
                <h3 class="hb-card__title">Channels</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--emerald">LINE Messaging API</span>
                    <span class="hb-badge hb-badge--emerald">FB Messenger</span>
                    <span class="hb-badge hb-badge--emerald">n8n</span>
                    <span class="hb-badge hb-badge--emerald">Slack / Teams</span>
                </div>
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
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มด้วย AI ROI Discovery</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">1 สัปดาห์ 30,000 บาท ได้ Model ROI + Architecture + Roadmap ก่อนลงทุน Build</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">คุยเรื่อง AI Discovery &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'Service', '@id' => $page_url . '#service', 'name' => 'AI Expert Consulting', 'description' => $desc, 'url' => $page_url, 'provider' => array( '@id' => home_url( '/#organization' ) ), 'areaServed' => 'Thailand', 'serviceType' => 'AI Consulting' ) );
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => array(
    array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
    array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
    array( '@type' => 'ListItem', 'position' => 3, 'name' => 'AI Consulting', 'item' => $page_url ),
) ) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'mainEntity' => $faq_entities ) );

get_footer();
