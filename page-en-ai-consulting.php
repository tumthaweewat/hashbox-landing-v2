<?php
/**
 * Template Name: EN: AI Consulting Bangkok
 *
 * Standalone English page targeting the English query cluster that
 * Search Console shows hitting /services/ai-consulting/ with no
 * English page to receive it ("ai consulting bangkok", "ai
 * consulting companies bangkok", "ai services bangkok", "ai
 * consulting thailand"). Assign this template to a WP Page at
 * /en/ai-consulting/. hreflang reciprocity with the Thai page is
 * emitted centrally by hashbox_inject_hreflang().
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url = home_url( '/en/ai-consulting/' );
$th_url   = home_url( '/services/ai-consulting/' );
$desc     = 'AI consulting company in Bangkok, Thailand — we design and ship production AI: LINE chatbots, Sales GPT, RAG knowledge bases and workflow automation, with ROI calculated before we build.';

$faqs = array(
    array( 'q' => 'How much does AI consulting in Bangkok cost?', 'a' => 'Discovery + ROI Assessment starts at THB 60,000. A Proof of Concept runs THB 150,000–300,000, and a full production build THB 300,000–1,500,000 depending on data and integration scope. Monthly retainers start at THB 30,000. Every quote follows a free 30-minute assessment.' ),
    array( 'q' => 'How long does it take to ship to production?', 'a' => 'A simple LINE chatbot with an LLM takes 2–3 weeks. A RAG knowledge base takes 4–6 weeks. Sales GPT with CRM integration takes 6–10 weeks, and a custom AI agent with workflow automation 8–16 weeks, depending on data and integrations.' ),
    array( 'q' => 'Which AI models do you use?', 'a' => 'We pick per use case: OpenAI (GPT-5, GPT-4o) for general-purpose, Anthropic Claude for reasoning and long context, Google Gemini for multimodal, and open-source models (Llama, Mistral) for self-hosted or PDPA-sensitive workloads.' ),
    array( 'q' => 'How is this different from a typical AI agency?', 'a' => 'Most agencies sell consulting hours or training. We ship AI systems that actually run in production — with monitoring, cost guardrails, fallback logic and full source code. You own 100% of the code with no vendor lock-in.' ),
    array( 'q' => 'Do you handle PDPA and data privacy?', 'a' => 'Yes. We choose the AI provider by data sensitivity: public LLMs for non-sensitive data, Azure OpenAI or AWS Bedrock for enterprise privacy, and self-hosted models when data cannot leave your premises. Data masking and audit logging are included.' ),
    array( 'q' => 'Can you integrate with our existing systems?', 'a' => 'Yes — Salesforce, HubSpot, Zoho, SAP, LINE OA, Microsoft Teams, Slack, Notion, Airtable, Google Workspace, Make/n8n and Zapier. Legacy systems connect via REST API or webhook.' ),
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
                    <li aria-current="page">AI Consulting Bangkok</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">AI Consulting · Bangkok, Thailand</span>
            <h1 class="hb-hero__title">AI Consulting<br><em>in Bangkok</em><br>built for production</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Get a free ROI assessment</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">See AI case studies</a>
            </div>
            <p class="hb-hero__sub" lang="th" style="margin-top:var(--hb-space-6);font-size:var(--hb-text-sm);">อ่านหน้านี้เป็นภาษาไทย: <a href="<?php echo esc_url( $th_url ); ?>">ที่ปรึกษา AI สำหรับธุรกิจไทย</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-bg-elevated,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">In short</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox is an AI consulting company in Bangkok</strong> that designs and ships production-grade AI for Thai and regional businesses — LINE chatbots, Sales GPT, RAG knowledge bases, AI workforce agents and workflow automation. Every engagement starts with a free 30-minute ROI assessment. We use OpenAI, Claude, Gemini or open-source models per use case, stay PDPA-compliant, and hand over 100% of the source code with no vendor lock-in. Pricing starts at THB 60,000.
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Services</span>
            <h2 class="hb-h2">What we build</h2>
            <p class="hb-section__sub">Six core services covering the AI use cases Thai B2B and SMB teams ask for most.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">01</span>
                <h3 class="hb-h3">LINE Chatbot AI</h3>
                <p class="hb-body">AI chatbots on LINE OA — LLM plus a custom knowledge base, human handoff, and an analytics dashboard. Answers 24/7 in Thai and English.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">02</span>
                <h3 class="hb-h3">Sales GPT + RAG</h3>
                <p class="hb-body">An AI agent that knows your product and pricing, qualifies leads, and writes into your CRM.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">03</span>
                <h3 class="hb-h3">RAG Knowledge Base</h3>
                <p class="hb-body">Vector database, embeddings and retrieval reranking for document Q&amp;A, support, and internal wikis with citation tracking.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">04</span>
                <h3 class="hb-h3">AI Workforce Agent</h3>
                <p class="hb-body">Autonomous agents that run continuously — monitoring, content pipelines and data-analysis agents wired into your stack.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">05</span>
                <h3 class="hb-h3">Workflow Automation</h3>
                <p class="hb-body">AI plus Make / n8n / Zapier to automate repetitive work across systems.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">06</span>
                <h3 class="hb-h3">Custom AI Integration</h3>
                <p class="hb-body">Add AI to your existing app via OpenAI, Claude or Gemini APIs with cost guardrails and fallback logic.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">How we work</span>
            <h2 class="hb-h2">From assessment to production</h2>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Week 1</span>
                <h3 class="hb-h3">Discovery + ROI</h3>
                <p class="hb-body">We map your current workflow, pick the AI use case with the clearest ROI, and calculate hours saved versus cost — free.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Week 2–4</span>
                <h3 class="hb-h3">Proof of Concept</h3>
                <p class="hb-body">We build a minimal viable AI system, test it against real data, tune prompts, and validate the ROI before scaling.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Week 4–8</span>
                <h3 class="hb-h3">Production + Integration</h3>
                <p class="hb-body">We scale the architecture, integrate with CRM/LINE/ERP, add monitoring and alerts, and harden security.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Week 10+</span>
                <h3 class="hb-h3">Launch + Monitor</h3>
                <p class="hb-body">Full rollout with daily monitoring for the first 30 days and a monthly performance review.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">Frequently asked questions</h2>
        </div>
        <div class="hb-accordion">
            <?php foreach ( $faqs as $i => $f ) : ?>
                <details class="hb-accordion__item" <?php echo 0 === $i ? 'open' : ''; ?>>
                    <summary class="hb-accordion__trigger"><?php echo esc_html( $f['q'] ); ?></summary>
                    <div class="hb-accordion__content"><p><?php echo esc_html( $f['a'] ); ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">Start with a free ROI assessment</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">A 30-minute session to find the AI use case with the fastest payback — no commitment, no up-sell.</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Talk to us &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'     => 'https://schema.org',
    '@type'        => 'Service',
    '@id'          => $page_url . '#service',
    'name'         => 'AI Consulting Bangkok',
    'description'  => $desc,
    'url'          => $page_url,
    'inLanguage'   => 'en',
    'provider'     => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'   => array(
        array( '@type' => 'City', 'name' => 'Bangkok' ),
        array( '@type' => 'Country', 'name' => 'Thailand' ),
    ),
    'serviceType'  => 'AI Consulting',
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'AI Consulting Bangkok', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    '@id'        => $page_url . '#faq',
    'inLanguage' => 'en',
    'mainEntity' => $faq_entities,
) );

get_footer();
