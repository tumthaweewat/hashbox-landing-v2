<?php
/**
 * Template Name: EN: SEO Agency Bangkok
 *
 * English counterpart of /services/seo/ for the English query cluster
 * Search Console shows ("technical seo thailand", "seo agency",
 * "seo agency bangkok", "local seo bangkok"). Assign to a WP Page at
 * /en/seo/ (parent /en/). hreflang pair declared in hashbox_hreflang_pairs().
 * Prices and guarantee terms are the same facts as the Thai page —
 * change them there first ($price_from) and mirror here.
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url = home_url( '/en/seo/' );
$th_url   = home_url( '/services/seo/' );
$desc     = 'Technical-first SEO agency in Bangkok: Core Web Vitals, schema, local SEO and AI Search (GEO) with daily rank and AI-citation tracking. From THB 29,900/month, with a written "no growth, no pay" guarantee measured in your own Search Console.';

$faqs = array(
    array( 'q' => 'How much does SEO cost in Thailand?', 'a' => 'Published prices in 2026 range from roughly THB 22,000 to 39,000 per month for an ongoing retainer; most agencies do not publish at all and quote THB 40,000–80,000 after a call. Hashbox starts at THB 29,900 per month (about USD 850), excluding 7% VAT, with the final scope quoted after a free technical audit. Project-based AI-SEO packages elsewhere run THB 165,000–320,000.' ),
    array( 'q' => 'What does "no growth, no pay" mean?', 'a' => 'Two layers, both measured in your Search Console. First, the technical pass within 30 days: green Core Web Vitals on every in-scope URL, Lighthouse mobile 90+, schema passing Rich Results Test, money pages indexed — if not, we fix it free. Then a 90-day window: if impressions on the agreed keyword set (20–50 non-brand terms) do not grow 50% versus the 28 days before we started, or the number of terms in the top 20 does not grow by 5, we keep working month by month for free, up to 3 months. Conditions: 3-month minimum, Search Console access, no manual penalty, no domain change mid-term.' ),
    array( 'q' => 'Do you guarantee first-page rankings?', 'a' => 'No — nobody controls Google, and we recommend you treat any agency that guarantees rankings as a red flag. We guarantee the work and a KPI Google itself reports (impressions), not a position.' ),
    array( 'q' => 'Is technical SEO different from what most Bangkok SEO agencies sell?', 'a' => 'Most retainers are article quotas — 6 to 18 blog posts a month — with technical fixes handed to "your dev team". We start with the technical audit and fix crawlability, Core Web Vitals, schema and internal linking first, because content cannot rank on a site Google reads badly. Content and local SEO come after the foundation passes.' ),
    array( 'q' => 'Do you do local SEO for Bangkok?', 'a' => 'Yes. Google Business Profile completion and posting, LocalBusiness schema, NAP consistency across directories, review strategy and location-intent service pages are part of the retainer scope — most useful for B2B firms whose buyers search "… Bangkok" or "… near me".' ),
    array( 'q' => 'Does the retainer include AI Search / GEO?', 'a' => 'Yes. Optimising pages to be cited by Google AI Overviews, ChatGPT, Perplexity and Gemini — entity schema, llms.txt, answer-first content — is inside the SEO retainer. We track AI Overview citations for your keywords daily. If you only want AI Search without SEO, see the standalone AI Search service.' ),
    array( 'q' => 'What do I see in reporting?', 'a' => 'Eight numbers, daily, from our own tracking plus Google\'s data: keywords in the top 3/10/30, impressions, clicks and CTR, AI Overview citations, AI mentions across ChatGPT, Claude, Gemini and Perplexity, Core Web Vitals pass rate, indexed pages, organic leads and referring domains. The historical data is yours if we part ways.' ),
    array( 'q' => 'Which SEO agency in Thailand is the best?', 'a' => 'There is no single best — pick by verifiable criteria, not size: does the agency publish prices, refuse to guarantee rankings, start from a technical audit, offer AI Search, run its own measurement, publish named cases with numbers, and leave the data with you when you part ways? We scored 10 Thai agencies (including ourselves, honestly) against those 7 criteria in a public comparison; agencies that publish prices run THB 22,000-39,000 per month.' ),
    array( 'q' => 'Do you work in English with teams outside Thailand?', 'a' => 'Yes. Reporting, meetings and documentation are in English on request; the content itself is written in Thai, English or both depending on who your customers are. Remote work is the default; on-site in Bangkok when useful.' ),
);

$scope = array(
    array( 'Technical SEO audit', 'Crawlability, indexability, redirects, canonicals, sitemaps, robots — the structural issues that block everything else. Delivered free before any contract.' ),
    array( 'Core Web Vitals', 'LCP, INP and CLS green on field data, not just lab scores. Our own site: Lighthouse mobile 98.' ),
    array( 'Schema markup', 'Organization, Service, FAQPage, BreadcrumbList, Article and the types your business needs — from a single source so what is shown equals what is marked up.' ),
    array( 'Content & on-page', 'Pages built from real search intent: one keyword per page, answer-first paragraphs, FAQ, internal links that route authority to money pages.' ),
    array( 'Local SEO Bangkok', 'Google Business Profile, NAP consistency, reviews, LocalBusiness schema and location-intent pages for B2B buyers who search with "Bangkok".' ),
    array( 'AI Search (GEO)', 'Entity schema, llms.txt, citation-ready passages and external mentions so Google AI Overviews, ChatGPT and Perplexity cite you — tracked daily.' ),
    array( 'CRO + tracking', 'GA4, Search Console and lead events wired correctly, heatmaps on money pages, A/B tests once traffic allows — traffic that does not convert is not a result.' ),
    array( 'Daily reporting', 'Rank, citation and traffic data from our own pipeline, updated every day, kept forever, owned by you.' ),
);

$kpis = array( 'Keywords in top 3 / 10 / 30', 'Impressions, clicks, CTR (Search Console)', 'AI Overview citations', 'AI mentions — ChatGPT, Claude, Gemini, Perplexity', 'Core Web Vitals pass rate', 'Indexed money pages', 'Organic leads (form, LINE, phone)', 'Referring domains' );
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
                    <li aria-current="page">SEO Agency Bangkok</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">SEO · Bangkok, Thailand</span>
            <h1 class="hb-hero__title">Technical-first SEO agency<br><em>in Bangkok</em><br>measured in your Search Console</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/seo-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Get a free technical SEO audit</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">See results</a>
            </div>
            <p class="hb-body" style="margin-top:var(--hb-space-5);color:var(--hb-text-muted);"><a href="#guarantee" style="color:var(--hb-accent-emerald,#10B981);font-weight:600;text-decoration:none;">&#10003; "No growth, no pay"</a> — if impressions do not grow 50% in 90 days, we keep working for free.</p>
            <p class="hb-hero__sub" lang="th" style="margin-top:var(--hb-space-6);font-size:var(--hb-text-sm);">อ่านหน้านี้เป็นภาษาไทย: <a href="<?php echo esc_url( $th_url ); ?>">รับทำ SEO สายเทคนิค</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">In short</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox is a technical-first SEO agency in Bangkok.</strong> We fix how Google reads your site — Core Web Vitals, schema, structure — before adding content, then optimise for both the 10 blue links and AI answers (Google AI Overviews, ChatGPT, Perplexity). Retainers start at THB 29,900/month with a written "no growth, no pay" guarantee; you see rank and AI-citation data daily, and the data stays yours.
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Scope</span>
            <h2 class="hb-h2">What our SEO services in Bangkok cover</h2>
            <p class="hb-section__sub">Technical foundation first, then content, local and AI search — every item measured by the same daily data.</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $scope as $i => $s ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2<?php echo 0 === $i ? ' hb-bento__cell--feature' : ''; ?>">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $s[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $s[1] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="guarantee">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Guarantee</span>
            <h2 class="hb-h2">"No growth, no pay" — if impressions do not grow 50% in 90 days, we keep working for free</h2>
            <p class="hb-section__sub">Cases delivered to these criteria: <a href="<?php echo esc_url( home_url( '/work/rank-project/#proof' ) ); ?>">Rank Project</a> (20+ keywords on page one within 90 days) · <a href="<?php echo esc_url( home_url( '/work/nexus-corp/#proof' ) ); ?>">Nexus Corp</a> (Lighthouse 90+ on every URL). We do not guarantee rankings; nobody controls Google. We guarantee two things you can verify yourself in Search Console.</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">Layer 1 · 30 days</span>
                <h3 class="hb-h3">Technical pass — or we fix it free</h3>
                <p class="hb-body">Green Core Web Vitals on every in-scope URL · Lighthouse mobile 90+ (95+ on sites we build) · schema passing Rich Results Test · every money page indexed.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">Layer 2 · 90 days</span>
                <h3 class="hb-h3">Impressions +50% — or the next months are free</h3>
                <p class="hb-body">Counted from the day layer 1 passes: impressions on the agreed 20–50 non-brand keywords grow ≥ 50% versus the 28 days before we started, <strong>or</strong> the number of keywords in the top 20 grows by ≥ 5. If neither happens, we work month by month for free, up to 3 months.</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Why it holds</span>
                <p class="hb-body">&#10003; Measured in your Search Console, not our report<br>&#10003; Daily progress in our tracker, not a month-end PDF<br>&#10003; A miss costs us work, not you an apology</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Conditions</span>
                <p class="hb-body" style="font-size:var(--hb-text-sm);">3-month minimum · Search Console access and permission to change the site (or let us) · keyword set agreed after the audit · excludes manual penalties, domain changes or deletion of in-scope pages · sites under 6 months old or above 100,000 impressions/month get a case-by-case KPI · the judge is your Search Console data on day 90. <a href="<?php echo esc_url( home_url( '/services/seo/guarantee-terms/' ) ); ?>" lang="th">Full terms (Thai)</a>.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section" id="measure">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Measurement</span>
            <h2 class="hb-h2">How we measure SEO — 8 numbers you see daily</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $kpis as $i => $k ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $k ); ?></h3>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">SEO pricing in Bangkok — from THB 29,900 per month</h2>
            <p class="hb-section__sub">Published prices in Thailand run THB 22,000–39,000/month; most agencies quote only after a call. We publish ours and quote the final scope after a free audit.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">Starting point</span>
                <span class="hb-tier__name">SEO retainer</span>
                <div class="hb-tier__price">29,900<span class="hb-tier__price-unit">THB / month (≈ USD 850)</span></div>
                <p class="hb-caption">All 8 scope items above, sized to your site after the audit. Excludes 7% VAT.</p>
                <ul class="hb-tier__features">
                    <li>Technical audit and fixes first</li>
                    <li>Core Web Vitals, schema, local SEO, CRO tracking</li>
                    <li>AI Search / GEO included</li>
                    <li>Daily rank + AI-citation data, yours to keep</li>
                    <li>"No growth, no pay" guarantee</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">Request a quote</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">What moves the price</h3>
                <p class="hb-body" style="margin:0;"><strong>Site size</strong> — 15 pages and 500 pages are different monthly workloads.</p>
                <p class="hb-body" style="margin:0;"><strong>Technical state at the start</strong> — a site with failing Core Web Vitals and no schema spends the first months on foundation.</p>
                <p class="hb-body" style="margin:0;"><strong>Keyword difficulty</strong> — head terms against large agencies need authority we will tell you honestly how long takes.</p>
                <p class="hb-body" style="margin:0;"><strong>Rebuild needed?</strong> — usually not; if the audit says the structure is the bottleneck, that is a separate <a href="<?php echo esc_url( home_url( '/en/website-development/' ) ); ?>">website build</a>.</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">SEO agency in Bangkok — questions we get asked</h2>
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
        <h2 class="hb-h2">Start with a free technical SEO audit</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">Send your URL. We check crawlability, Core Web Vitals, schema, content gaps and AI Overview opportunities, and walk you through it — no commitment. Related: <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>">AI consulting in Bangkok</a> · <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search (GEO) services</a>.</p>
        <a href="<?php echo esc_url( home_url( '/seo-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Request the audit &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => $page_url . '#service',
    'name'        => 'SEO Agency Bangkok — Technical-first SEO',
    'description' => $desc,
    'url'         => $page_url,
    'inLanguage'  => 'en-US',
    'provider'    => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'  => array( array( '@type' => 'City', 'name' => 'Bangkok' ), array( '@type' => 'Country', 'name' => 'Thailand' ) ),
    'serviceType' => 'SEO',
    'offers'      => array( '@type' => 'Offer', 'name' => 'SEO retainer', 'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => 29900, 'priceCurrency' => 'THB', 'unitText' => 'MONTH' ), 'url' => $page_url . '#pricing' ),
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'SEO Agency Bangkok', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'inLanguage' => 'en-US', 'mainEntity' => $faq_entities ) );

get_footer();
