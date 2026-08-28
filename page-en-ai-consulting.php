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
    array( 'q' => 'How much does AI consulting in Bangkok cost?', 'a' => 'Our pricing is public: an ROI Assessment is THB 60,000 (~$1,700), a Proof of Concept from THB 150,000–300,000, and a full production build from THB 300,000–1,500,000 depending on data and integration scope. Monthly retainers start at THB 30,000. Public pricing is rare among AI consulting companies in Bangkok — quotes here typically come only after a discovery call. We publish the numbers so you can budget before you talk to us.' ),
    array( 'q' => 'Do you work in English?', 'a' => 'Yes. Meetings, documentation, architecture diagrams and handover materials are delivered in business English. The systems we build serve customers in Thai, English, or both — which matters, because your team may work in English while your customers write in Thai.' ),
    array( 'q' => 'How long does it take to ship to production?', 'a' => 'A simple LINE chatbot with an LLM takes 2–3 weeks. A RAG knowledge base takes 4–6 weeks. Sales GPT with CRM integration takes 6–10 weeks, and a custom AI agent with workflow automation 8–16 weeks, depending on data and integrations.' ),
    array( 'q' => 'Which AI models do you use?', 'a' => 'We pick per use case: OpenAI (GPT-5, GPT-4o) for general-purpose, Anthropic Claude for reasoning and long context, Google Gemini for multimodal, and open-source models (Llama, Mistral) for self-hosted or PDPA-sensitive workloads.' ),
    array( 'q' => 'How is this different from a typical AI agency?', 'a' => 'Most agencies sell consulting hours or training. We ship AI systems that actually run in production — with monitoring, cost guardrails, fallback logic and full source code. You own 100% of the code with no vendor lock-in.' ),
    array( 'q' => 'Do you handle PDPA and data privacy?', 'a' => 'Yes. We choose the AI provider by data sensitivity: public LLMs for non-sensitive data, Azure OpenAI or AWS Bedrock for enterprise privacy, and self-hosted models when data cannot leave your premises. Data masking and audit logging are included.' ),
    array( 'q' => 'Can you integrate with our existing systems?', 'a' => 'Yes — Salesforce, HubSpot, Zoho, SAP, LINE OA, Microsoft Teams, Slack, Notion, Airtable, Google Workspace, Make/n8n and Zapier. Legacy systems connect via REST API or webhook.' ),
    array( 'q' => 'What happens if the ROI case does not hold up?', 'a' => 'You stop at the assessment stage with a clear written report — THB 60,000 spent instead of a six-figure build. We calculate ROI with your numbers before any build begins, and "do not build this yet" is a real possible outcome. That policy costs us some projects and wins us the right ones.' ),
    array( 'q' => 'Which AI consulting companies in Bangkok are the right fit for an SME?', 'a' => 'Bangkok has three tiers. Global consultancies run transformation programs priced from roughly THB 500,000 to several million and are built for enterprises. Freelancers are cheap but you carry the delivery risk. Boutique studios like Hashbox sit in between: production systems for SMEs and mid-market companies from THB 60,000, with the ROI math done first. If you have one concrete process to automate and a budget under THB 1.5M, a studio is usually the right fit.' ),
    array( 'q' => 'Do you work with companies outside Bangkok?', 'a' => 'Yes. Most of the work — discovery, architecture, builds, reviews — happens remotely in Thai or English, so companies anywhere in Thailand or Southeast Asia can work with us. We meet on-site in Bangkok when a project needs it, for example during launch or team training.' ),
    array( 'q' => 'Can you work alongside our in-house IT team?', 'a' => 'Yes, and it usually goes better that way. Your team knows the systems; we bring the AI architecture, evaluation and guardrails. We build on your stack, document every decision, hand over the repository and train your team to run and extend the system — the goal is that you do not need us for day-to-day operation.' ),
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

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Local context</span>
            <h2 class="hb-h2">Why AI consulting in Bangkok needs Thai context</h2>
            <p class="hb-section__sub">Generic AI consulting fails in Thailand for three specific reasons: your customers live on LINE, your data falls under PDPA, and your users write in Thai.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">LINE</span>
                <h3 class="hb-h3">LINE is where your customers are</h3>
                <p class="hb-body">Thai consumers talk to businesses on LINE — not email. Chatbots must run natively on the LINE Messaging API with rich menus, flex messages, and human handoff that routes into how your Thai team actually works. Our flagship AI case study is a LINE deployment.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">PDPA</span>
                <h3 class="hb-h3">PDPA is not optional</h3>
                <p class="hb-body">Chat logs, uploaded documents and CRM records in a vector database are all in scope of Thailand&rsquo;s PDPA. We design data flows, minimization and consent-aware ingestion in the architecture phase — with documentation your DPO or legal counsel can review. We are engineers, not a law firm; we work alongside your legal advisors.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">ไทย</span>
                <h3 class="hb-h3">Thai-language AI has sharp edges</h3>
                <p class="hb-body">Thai script has no spaces between words, which changes tokenization and retrieval — and real customers mix Thai and English in one message. We test against real Thai and code-switched inputs before anything goes live.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">How much does AI consulting cost in Bangkok?</h2>
            <p class="hb-section__sub">Our pricing is public — rare among AI consulting companies in Thailand, where quotes typically come only after a discovery call. Billed in THB; USD shown for reference at ~35 THB/USD.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">From THB 60,000 · ~$1,700</span>
                <h3 class="hb-h3">ROI Assessment</h3>
                <p class="hb-body">1&ndash;2 weeks. Use-case audit, ROI model in your numbers, go/no-go recommendation you can defend to your board.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">THB 150,000&ndash;300,000</span>
                <h3 class="hb-h3">Proof of Concept</h3>
                <p class="hb-body">3&ndash;5 weeks. A working prototype against your real data — something you can click, test and criticize before scaling.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">THB 300,000&ndash;1,500,000</span>
                <h3 class="hb-h3">Production Build</h3>
                <p class="hb-body">6&ndash;12 weeks. Hardened production system with integrations, monitoring, pilot, launch and a 30-day monitoring period.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Retainers from THB 30,000/mo</span>
                <h3 class="hb-h3">Ongoing + Enterprise</h3>
                <p class="hb-body">Monthly retainers for monitoring and iteration. Multi-system enterprise scope is quoted after assessment.</p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);">Included at every tier: full source code ownership, no vendor lock-in, PDPA-aware design, and English-language delivery. The ROI Assessment is deliberately a low-risk entry point — and if the recommendation is &ldquo;don&rsquo;t build this,&rdquo; that&rsquo;s what the report will say.</p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Choosing a partner</span>
            <h2 class="hb-h2">How to choose an AI consulting company in Bangkok — 7 questions to ask</h2>
            <p class="hb-section__sub">Most AI consulting companies in Bangkok and Thailand pitch the same slide deck. These seven questions separate the ones that ship from the ones that present — and we answer each for ourselves so you can compare directly.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">01</span>
                <h3 class="hb-h3">Will they show the ROI math before you pay for a build?</h3>
                <p class="hb-body">Ask for the numbers behind the promise. Ours: a free 30-minute screening, then a written ROI assessment (THB 60,000) where &ldquo;do not build this yet&rdquo; is a real possible answer.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">02</span>
                <h3 class="hb-h3">Do they ship to production, or hand over a deck?</h3>
                <p class="hb-body">Ask for something you can test today &mdash; a live LINE OA, a working agent. Our flagship case runs in production and cut a two-hour manual process to two minutes.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">03</span>
                <h3 class="hb-h3">Who owns the code, prompts and data pipelines?</h3>
                <p class="hb-body">If the answer is &ldquo;our platform&rdquo;, you are renting. Everything we build is handed over as a Git repository you own &mdash; models, prompts, evaluation sets and integrations included.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">04</span>
                <h3 class="hb-h3">Where does your data actually go?</h3>
                <p class="hb-body">Chat logs and uploaded documents fall under PDPA. Ask which provider, which region, and what is masked. We choose the model host by data sensitivity &mdash; public LLM, Azure OpenAI / AWS Bedrock, or self-hosted &mdash; and document the data flow for your legal team.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">05</span>
                <h3 class="hb-h3">Do they test in Thai and in mixed Thai&ndash;English?</h3>
                <p class="hb-body">Thai has no spaces between words and real customers code-switch mid-sentence. Ask to see a test set built from real messages, not English demos. Ours are built from your actual conversations before launch.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">06</span>
                <h3 class="hb-h3">What happens when the model is wrong?</h3>
                <p class="hb-body">Every LLM is wrong sometimes. Ask about fallbacks, human handoff and cost guardrails. Our systems ship with a hallucination guard, a handoff path into how your team already works, and hard limits on API spend.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">07</span>
                <h3 class="hb-h3">What does month two look like?</h3>
                <p class="hb-body">Launch is the start. Ask who watches quality, cost and drift afterwards. We include 30 days of monitoring in every build and offer a retainer from THB 30,000 a month for prompt updates, cost monitoring and a monthly review.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">TL;DR</span>
                <h3 class="hb-h3">Compare the answers, not the logos</h3>
                <p class="hb-body">Any AI consulting company in Bangkok can say &ldquo;production-ready&rdquo;. Seven concrete answers &mdash; in writing, before you sign &mdash; are the fastest way to tell who means it. Ours are on this page and in the <a href="#faq">FAQ</a> below.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Case study</span>
            <h2 class="hb-h2">AutoBot LINE: from 2 hours to 2 minutes</h2>
            <p class="hb-section__sub">An LLM-powered chatbot on LINE Official Account — knowledge base plus human handoff for cases the AI shouldn&rsquo;t handle alone.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Response time</span>
                <h3 class="hb-h3">2 hours &rarr; 2 minutes</h3>
                <p class="hb-body">Customers get a useful first answer in minutes instead of hours.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Support cost</span>
                <h3 class="hb-h3">Down 60%</h3>
                <p class="hb-body">The team handles exceptions instead of every routine inquiry.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Inquiry &rarr; booking</span>
                <h3 class="hb-h3">Up 18%</h3>
                <p class="hb-body">Faster answers convert — customers book while intent is still hot.</p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);">The architecture is the pattern we deploy for most consumer-facing Thai businesses: LINE as the front door, an LLM with a curated knowledge base behind it, and a clean escalation path to humans. More projects on our <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">work page</a>.</p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Compare</span>
            <h2 class="hb-h2">Hashbox vs. big consulting vs. freelancers</h2>
            <p class="hb-section__sub">Each option fits a different situation. The honest comparison for a business in Bangkok that needs a working AI system, not a transformation roadmap.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Hashbox</span>
                <h3 class="hb-h3">Production system + code</h3>
                <p class="hb-body">English + Thai delivery, public THB pricing, LINE/PDPA/Thai context built in, 100% source code, 6-phase process with 30-day post-launch monitoring.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Big consulting firm</span>
                <h3 class="hb-h3">Strategy-heavy</h3>
                <p class="hb-body">Right for global multi-year transformation programs with board-level change management. Builds are frequently subcontracted; rarely localized to Thailand; opaque pricing.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Freelancer</span>
                <h3 class="hb-h3">Low cost, high variance</h3>
                <p class="hb-body">Fine for a genuinely tiny, throwaway experiment. Quality depends entirely on the individual — single point of failure, scope creep is common.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">In-house DIY</span>
                <h3 class="hb-h3">Full control, slow ramp</h3>
                <p class="hb-body">Fully yours, but you carry salaries, opportunity cost and key-person risk — and you research LINE, PDPA and Thai-language AI yourself.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head" id="faq">
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

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">AI consulting in Bangkok — start with a free ROI assessment</h2>
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
    // Literal rather than hashbox_page_in_language(): this template is English
    // by definition. Kept identical to what that helper returns so the page
    // carries one language token across every node, not two spellings of it.
    'inLanguage'   => 'en-US',
    'provider'     => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'   => array(
        array( '@type' => 'City', 'name' => 'Bangkok' ),
        array( '@type' => 'Country', 'name' => 'Thailand' ),
    ),
    'serviceType'  => 'AI Consulting',
    'hasOfferCatalog' => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'AI Consulting Engagements',
        'itemListElement' => array(
            array( '@type' => 'Offer', 'name' => 'ROI Assessment', 'price' => '60000', 'priceCurrency' => 'THB', 'description' => 'Use-case audit, ROI model, go/no-go recommendation. 1-2 weeks.' ),
            array( '@type' => 'Offer', 'name' => 'Proof of Concept', 'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => 150000, 'maxPrice' => 300000, 'priceCurrency' => 'THB' ), 'description' => 'Working prototype on your real data. 3-5 weeks.' ),
            array( '@type' => 'Offer', 'name' => 'Production Build', 'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => 300000, 'maxPrice' => 1500000, 'priceCurrency' => 'THB' ), 'description' => 'Production system with pilot, launch and 30-day monitoring. 6-12 weeks.' ),
            array( '@type' => 'Offer', 'name' => 'Monthly Retainer', 'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => 30000, 'priceCurrency' => 'THB', 'unitText' => 'MONTH' ), 'description' => 'Ongoing monitoring and iteration after launch.' ),
        ),
    ),
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
    'inLanguage' => 'en-US',
    'mainEntity' => $faq_entities,
) );

get_footer();
