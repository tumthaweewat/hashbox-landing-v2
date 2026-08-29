<?php
/**
 * Template Name: EN: AI Search (GEO) Bangkok
 *
 * English counterpart of /services/ai-search/ for "ai optimization
 * services bangkok", "geo agency", "ai seo agency thailand",
 * "generative engine optimization bangkok". Assign to a WP Page at
 * /en/ai-search/ (parent /en/). Pair declared in hashbox_hreflang_pairs().
 * Pricing facts mirror the Thai page (GEO inside the SEO retainer from
 * THB 29,900/month; standalone scope quoted after a free GEO audit).
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url = home_url( '/en/ai-search/' );
$th_url   = home_url( '/services/ai-search/' );
$desc     = 'AI Search / Generative Engine Optimization (GEO) agency in Bangkok: get your brand cited by Google AI Overviews, ChatGPT, Perplexity and Gemini — AI-specific audit, entity schema and llms.txt, answer-first content, external citations, measured daily with our own AI-visibility tracker.';

$faqs = array(
    array( 'q' => 'What is AI Search optimization (GEO) and how is it different from SEO?', 'a' => 'Generative Engine Optimization is the work of getting AI answer engines — Google AI Overviews and AI Mode, ChatGPT, Perplexity, Gemini — to cite your brand when they answer a buyer\'s question. SEO gets you into the ten blue links; GEO gets you into the answer above them. Both need the same foundation (fast site, clean structure, schema), but GEO adds three things: a definition sentence an AI can quote, an unambiguous entity (who you are, where, what you sell, at what price) and mentions from third-party sources the models trust.' ),
    array( 'q' => 'How do you measure AI Search results?', 'a' => 'Six metrics from our own tracker: AI Visibility (share of a fixed monthly prompt set where your brand appears, per engine), Brand Mentions, AI Overview Citations for your target keywords (daily), AI Share of Voice against named competitors, the sources AI cites instead of you, and LLM referral traffic in GA4 (chatgpt.com, perplexity.ai). You see the same dashboard we do.' ),
    array( 'q' => 'How long until AI engines cite us?', 'a' => 'Google AI Overviews can change their sources within days of a re-crawl — we watch it daily. ChatGPT and Perplexity lean on search indexes and third-party mentions, so 4–8 weeks after content and citations are in place is typical. Competitive head terms take longer because they need external mentions to accumulate; we say so in the audit.' ),
    array( 'q' => 'How much does AI Search optimization cost in Thailand?', 'a' => 'GEO is included in our SEO retainer from THB 29,900 per month. For a standalone AI Search engagement — sites that already have SEO covered — we quote after a free GEO audit, based on how many keywords and prompts to track, how many pages need answer-first rewrites and how many external citations must be built. Excludes 7% VAT.' ),
    array( 'q' => 'Where do ChatGPT and Perplexity get information about Thai businesses?', 'a' => 'From what we see in our tracker in 2026: your own site if it states facts plainly (definition, prices, FAQ), directories such as Clutch, marketplaces, Facebook pages, YouTube videos and comparison articles. For Thai service queries the engines often cite Facebook and YouTube over company websites — which is why this service builds external citations alongside the site.' ),
    array( 'q' => 'What is llms.txt and do we need it?', 'a' => 'A plain-text file at your domain root that summarises who you are, what you sell, prices and key pages in a format AI crawlers read easily. It is not yet an official standard for the major engines, but it costs nothing, has no downside and forces the brand facts into one verifiable place. We ship llms.txt and llms-full.txt on every site we manage — ours is at hashbox.co.th/llms.txt.' ),
    array( 'q' => 'Do we need SEO first?', 'a' => 'The foundation must pass: crawlable, fast enough, correct schema — AI engines draw on the same index as Google. If it does not, we fix that in the first 2–4 weeks. Sites with solid SEO can start GEO work immediately.' ),
    array( 'q' => 'Does Hashbox do this for its own site?', 'a' => 'Yes — same tracker, same method: 56 keywords, 51 AI Overview checks and 20 prompts across ChatGPT, Claude, Gemini and Perplexity every month. Our guide to AI solution consulting ranks in the top 5 on Google and is cited by Google\'s AI Overview in a query contested by large agencies. We show the numbers we have not hit yet as openly as the ones we have.' ),
);

$process = array(
    array( 'AI-specific audit', 'Can AI crawlers get in (robots, llms.txt)? Which pages contain a quotable answer? Is the entity complete? Which of your keywords already trigger an AI Overview — and who is being cited instead of you.' ),
    array( 'Entity + technical', 'Organization / Service / Person schema stating who, what, where and at what price · sameAs linking every profile into one entity · llms.txt + llms-full.txt · robots opening GPTBot, ClaudeBot, PerplexityBot, Google-Extended.' ),
    array( 'Answer-first content', 'Every money page and pillar article opens with a definition sentence, then comparison tables, numbered steps, numbers and FAQ — written from real delivery, not generic copy the models already have.' ),
    array( 'External citations', 'AI engines trust what others say about you: Google Business Profile, directories (Clutch, GoodFirms), Facebook, YouTube with transcripts, comparison articles — with identical facts everywhere.' ),
    array( 'Track + report', 'AI Overview citations daily, the same prompt set against four engines monthly, the sources cited instead of you, and LLM referrals in GA4 — with a plain report of what moved, what did not, and what is next.' ),
);

$platforms = array(
    array( 'Google AI Overview / AI Mode', 'Draws on Google\'s index — ranking pages with a direct answer get cited; changes within days of a re-crawl.' ),
    array( 'ChatGPT (search)', 'Blends model knowledge with Bing results — entity clarity and mentions across several sources matter more than rank.' ),
    array( 'Perplexity', 'Cites sources on every answer — favours pages with numbers, tables and a visible updated date.' ),
    array( 'Gemini', 'Google index + Knowledge Graph — Organization schema, sameAs and Google Business Profile carry the most weight.' ),
    array( 'Claude', 'Searches the web on request — definition sentences and FAQ that read cleanly get quoted.' ),
);

$kpis = array(
    array( 'AI Visibility', 'Share of the monthly prompt set where your brand appears, per engine.' ),
    array( 'Brand Mentions', 'How often engines name you — mentioned vs. linked.' ),
    array( 'AI Overview Citations', 'Target keywords where your page is a cited source, daily.' ),
    array( 'AI Share of Voice', 'Your citations versus named competitors on the same queries.' ),
    array( 'Sources cited instead of you', 'Which domains the engines use — tells you where to be present.' ),
    array( 'LLM traffic', 'Sessions from chatgpt.com, perplexity.ai and Gemini in GA4, and the leads behind them.' ),
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
                    <li aria-current="page">AI Search (GEO)</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">AI Search · GEO · AEO · Bangkok</span>
            <h1 class="hb-hero__title">AI Search optimization<br><em>(GEO) in Bangkok</em><br>be the answer AI gives</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Get a free GEO audit</a>
                <a href="<?php echo esc_url( home_url( '/geo-checker/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">Check a page with the GEO checker</a>
            </div>
            <p class="hb-hero__sub" lang="th" style="margin-top:var(--hb-space-6);font-size:var(--hb-text-sm);">อ่านหน้านี้เป็นภาษาไทย: <a href="<?php echo esc_url( $th_url ); ?>">รับทำ AI Search (GEO)</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">In short</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>AI Search optimization (Generative Engine Optimization) is the work of getting Google AI Overviews, ChatGPT, Perplexity and Gemini to cite your brand when they answer a buyer.</strong> Hashbox does it in five steps — AI-specific audit → entity, schema and llms.txt → answer-first content → external citations → daily tracking — with a tracker we built and run on our own site. Included in the SEO retainer from THB 29,900/month, or quoted standalone after a free GEO audit.
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Why now</span>
            <h2 class="hb-h2">Why brands in Thailand need AI Search in 2026 — numbers from our own tracker</h2>
            <p class="hb-section__sub">Not a global report — what we measure on Thai service keywords, August 2026.</p>
        </div>
        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat"><span class="hb-stat__value hb-stat__value--gradient">11<span class="hb-stat__unit">/ 51</span></span><p class="hb-stat__label">tracked keywords where Google shows an AI Overview</p><p class="hb-stat__caption">users get the answer before the ten links</p></div>
            <div class="hb-stat"><span class="hb-stat__value hb-stat__value--gradient">25</span><p class="hb-stat__label">sources cited in one AI Overview</p><p class="hb-stat__caption">"ai consulting companies thailand" — absent means invisible</p></div>
            <div class="hb-stat"><span class="hb-stat__value">4<span class="hb-stat__unit">engines</span></span><p class="hb-stat__label">ChatGPT · Claude · Gemini · Perplexity</p><p class="hb-stat__caption">each pulls from different sources — all four must be covered</p></div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="process">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Process</span>
            <h2 class="hb-h2">What our AI Search service does — five steps</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $process as $i => $p ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2<?php echo 0 === $i ? ' hb-bento__cell--feature' : ''; ?>">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $p[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $p[1] ); ?></p>
            </div>
            <?php endforeach; ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">+</span>
                <h3 class="hb-h3">Built on SEO and the site</h3>
                <p class="hb-body">GEO stands on the same foundation as our <a href="<?php echo esc_url( home_url( '/en/seo/' ) ); ?>">technical SEO service</a>, and every site we build is <a href="<?php echo esc_url( home_url( '/en/website-development/' ) ); ?>">AI-search ready from launch</a>.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section" id="platforms">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Coverage</span>
            <h2 class="hb-h2">Each engine sources differently — we cover all five</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $platforms as $p ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2"><h3 class="hb-h3"><?php echo esc_html( $p[0] ); ?></h3><p class="hb-body"><?php echo esc_html( $p[1] ); ?></p></div>
            <?php endforeach; ?>
            <div class="hb-bento__cell hb-bento__cell--c2"><h3 class="hb-h3">Start by checking a page</h3><p class="hb-body">Paste a URL into the <a href="<?php echo esc_url( home_url( '/geo-checker/' ) ); ?>">GEO Readiness Checker</a> for a 0–100 score on how citable it is — free, no sign-up.</p></div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="measure">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Measurement</span>
            <h2 class="hb-h2">How we measure AI Search — six metrics</h2>
            <p class="hb-section__sub">Most agencies sell AI Search and cannot measure it. We built the tracker first and run it on our own site every day.</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $kpis as $i => $k ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2"><span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3 class="hb-h3"><?php echo esc_html( $k[0] ); ?></h3><p class="hb-body"><?php echo esc_html( $k[1] ); ?></p></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">AI Search pricing — inside the SEO retainer, or quoted after a free audit</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">Start here</span>
                <span class="hb-tier__name">Inside the SEO retainer</span>
                <div class="hb-tier__price">29,900<span class="hb-tier__price-unit">THB / month from (≈ USD 850)</span></div>
                <p class="hb-caption">GEO / AI Overview optimisation is already part of the <a href="<?php echo esc_url( home_url( '/en/seo/' ) ); ?>">SEO service</a>.</p>
                <ul class="hb-tier__features">
                    <li>Technical SEO + Core Web Vitals + schema (the foundation AI needs)</li>
                    <li>llms.txt + llms-full.txt + robots open to AI crawlers</li>
                    <li>Answer-first content and FAQ on money pages</li>
                    <li>Daily AI Overview tracking on target keywords</li>
                    <li>One report for rank and AI citations</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">Get the free audit</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">Standalone AI Search — quoted after a free GEO audit</h3>
                <p class="hb-body" style="margin:0;"><strong>For</strong> — sites with SEO already handled (in-house or elsewhere) but not yet cited by AI.</p>
                <p class="hb-body" style="margin:0;"><strong>Price depends on</strong> — keywords and prompts to track · pages to rewrite answer-first · external citations to build.</p>
                <p class="hb-body" style="margin:0;"><strong>You get first</strong> — the audit: which keywords trigger AI Overviews, who is cited today, which of your pages are ready. Use it yourself if you like.</p>
                <p class="hb-body" style="margin:0;color:var(--hb-text-muted);">Excludes 7% VAT.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">AI Search / GEO — frequently asked</h2>
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
        <h2 class="hb-h2">Want to know who AI names instead of you?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">Send your brand and five keywords. We reply with who Google AI Overviews, ChatGPT and Perplexity cite today and what to fix first — free, no commitment. Related: <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>">AI consulting in Bangkok</a> · <a href="<?php echo esc_url( home_url( '/ai-consulting-companies-thailand-2026/' ) ); ?>">AI consulting companies in Thailand compared</a>.</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Get the free GEO audit &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => $page_url . '#service',
    'name'        => 'AI Search Optimization (GEO) Bangkok',
    'alternateName' => array( 'Generative Engine Optimization', 'AI SEO', 'AEO' ),
    'description' => $desc,
    'url'         => $page_url,
    'inLanguage'  => 'en-US',
    'provider'    => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'  => array( array( '@type' => 'City', 'name' => 'Bangkok' ), array( '@type' => 'Country', 'name' => 'Thailand' ) ),
    'serviceType' => 'Generative Engine Optimization',
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'AI Search (GEO) Bangkok', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'inLanguage' => 'en-US', 'mainEntity' => $faq_entities ) );

get_footer();
