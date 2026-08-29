<?php
/**
 * Template Name: EN: Website Development Bangkok
 *
 * English counterpart of /services/website-development/ for
 * "website development bangkok", "web development company bangkok",
 * "seo-ready website thailand". Assign to a WP Page at
 * /en/website-development/ (parent /en/). Pair in hashbox_hreflang_pairs().
 * Prices mirror page-seo-ready-website.php $tiers — change there first.
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url = home_url( '/en/website-development/' );
$th_url   = home_url( '/services/website-development/' );
$desc     = 'Website development company in Bangkok building SEO-ready sites that rank and get cited by AI from launch day: Next.js or WordPress, Lighthouse 95+ guaranteed, green Core Web Vitals, full schema, Thai/English content, PDPA and LINE integration. Landing pages from THB 35,900, corporate sites from THB 80,000, e-commerce from THB 350,000 — source code handed over.';

$tiers = array(
    array( 'name' => 'Landing page', 'price' => 35900, 'pages' => '1–3 pages', 'time' => '2–3 weeks', 'fit' => 'Product launch, campaign, lead-gen' ),
    array( 'name' => 'Corporate site', 'price' => 80000, 'pages' => '5–15 pages', 'time' => '4–6 weeks', 'fit' => 'B2B, agencies, professional services' ),
    array( 'name' => 'E-commerce', 'price' => 350000, 'pages' => '20–100 pages', 'time' => '6–10 weeks', 'fit' => 'WooCommerce, Shopify headless, custom catalogue' ),
    array( 'name' => 'Enterprise', 'price' => 500000, 'pages' => '50+ pages · custom', 'time' => '8–14 weeks', 'fit' => 'Multi-language, headless, heavy integrations' ),
);

$included = array(
    array( 'Performance build gate', 'Every page must pass Lighthouse mobile 95+ and green Core Web Vitals before it is allowed to deploy — automated in CI, not checked once at the end.' ),
    array( 'Schema from one source', 'Organization, Service, FAQPage, BreadcrumbList, Article and Product/LocalBusiness where relevant — generated from the same data the page shows, so markup never drifts from content.' ),
    array( 'Indexable from day one', 'Clean URL structure, XML sitemaps, robots that admit Googlebot and AI crawlers, llms.txt, and a 301 map if you are migrating — Google reads the whole site in the first crawl.' ),
    array( 'Thai + English content structure', 'hreflang, per-language titles and schema, and copy written for the market you sell to — not machine-translated pages.' ),
    array( 'Thailand-ready integrations', 'LINE Official Account, Thai payment gateways, PDPA consent and privacy notice, Google Business Profile links.' ),
    array( 'Handover and 30-day monitoring', 'Full source code and admin access, a runbook for your team, and 30 days of Core Web Vitals, uptime and Search Console error monitoring after launch.' ),
);

$process = array(
    array( 'Discovery + audit', 'Business goals, keyword map, current site baseline (if any), stack decision.' ),
    array( 'Structure + content plan', 'Sitemap, one keyword per page, answer-first copy brief for every money page.' ),
    array( 'Design', 'Figma to a design system — one font, one type scale, real content, mobile checked at 390px first.' ),
    array( 'Build', 'Next.js (headless WordPress or Sanity) or a custom WordPress theme — chosen by how your team will edit content.' ),
    array( 'Build gate + QA', 'Lighthouse 95+, schema validation, accessibility, cross-browser, forms and tracking verified.' ),
    array( 'Launch + 30 days', 'DNS, redirects, sitemap submission, Search Console, monitoring — then a handover call and runbook.' ),
);

$faqs = array(
    array( 'q' => 'How much does website development cost in Bangkok?', 'a' => 'Our published prices: landing page from THB 35,900 (1–3 pages), corporate site from THB 80,000 (5–15 pages), e-commerce from THB 350,000, enterprise from THB 500,000. Excludes 7% VAT, no hidden fees; the final quote follows a free scope review. Bangkok agencies typically range from THB 30,000 for template sites to THB 500,000+ for custom builds — the difference is whether performance, schema and indexability are built in or bolted on later.' ),
    array( 'q' => 'What does "SEO-ready" actually mean?', 'a' => 'A site that passes the technical checks Google and AI engines apply before content can rank: green Core Web Vitals, Lighthouse mobile 95+, valid schema on every page type, a crawlable structure with one keyword per page, hreflang for Thai/English, and llms.txt plus robots that admit AI crawlers. It ships indexed and citable — SEO work afterwards starts from content, not repairs.' ),
    array( 'q' => 'Do you guarantee the Lighthouse score?', 'a' => 'Yes — Lighthouse mobile 95+ on every page we build is part of our written technical guarantee: if a page does not pass at launch, we fix it at no cost until it does. Our own site scores 98. We do not guarantee rankings; nobody controls Google.' ),
    array( 'q' => 'Next.js or WordPress?', 'a' => 'WordPress with a custom theme when your team edits content daily and wants the familiar admin; Next.js with headless WordPress or Sanity when performance, multi-language or integrations matter most. Both meet the same build gate. Page builders and heavy plugin stacks are the one thing we decline — they are why most Thai corporate sites score 30–50 on mobile.' ),
    array( 'q' => 'Can you migrate our existing WordPress site?', 'a' => 'Yes. We map every old URL to a new one (301), keep or improve rankings during the switch, and monitor crawl stats daily for 30 days after launch. Our Nexus Corp case moved a legacy WordPress site to headless WordPress + Next.js with 100% index coverage in the first crawl.' ),
    array( 'q' => 'Do you build in Thai and English?', 'a' => 'Yes — copy is written (not machine-translated) for each language, with per-language titles, schema and hreflang. Many clients run Thai for the local market and English for regional buyers on the same domain, which is how this site is built.' ),
    array( 'q' => 'What happens after launch?', 'a' => '30 days of monitoring (Core Web Vitals, uptime, Search Console errors) are included. After that, an optional Care Plan from THB 15,000 to 50,000 per month covers updates, security, performance checks and small changes — or your team takes over with the runbook and full source code.' ),
    array( 'q' => 'Do you work with companies outside Thailand?', 'a' => 'Yes. Meetings, documentation and reporting in English; remote by default, on-site in Bangkok when useful. Timezone overlap with Europe and Australia works well.' ),
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
                    <li aria-current="page">Website Development Bangkok</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Web development · Bangkok, Thailand</span>
            <h1 class="hb-hero__title">Website development in Bangkok<br><em>SEO-ready from launch day</em><br>Lighthouse 95+ guaranteed</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Get a free scope review</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">See our work</a>
            </div>
            <p class="hb-hero__sub" lang="th" style="margin-top:var(--hb-space-6);font-size:var(--hb-text-sm);">อ่านหน้านี้เป็นภาษาไทย: <a href="<?php echo esc_url( $th_url ); ?>">รับทำเว็บไซต์ SEO-Ready</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">In short</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox is a Bangkok web development company that builds websites to pass Google's technical bar before launch</strong> — Lighthouse mobile 95+ (guaranteed), green Core Web Vitals, complete schema, Thai/English structure, LINE and PDPA built in. Next.js or WordPress depending on how your team edits content. Published prices from THB 35,900; source code is yours.
            </p>
        </div>
    </div>
</section>

<section class="hb-section" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">Website development pricing in Bangkok — from THB 35,900</h2>
            <p class="hb-section__sub">Same build gate and deliverables on every tier; price follows scope, page count and integrations. Excludes 7% VAT. Final quote after a free scope review.</p>
        </div>
        <div class="hb-prose" style="overflow-x:auto;">
            <table class="hb-table">
                <thead><tr><th>Tier</th><th>From (THB)</th><th>Scope</th><th>Timeline</th><th>Best for</th></tr></thead>
                <tbody>
                <?php foreach ( $tiers as $t ) : ?>
                    <tr><td><strong><?php echo esc_html( $t['name'] ); ?></strong></td><td><?php echo esc_html( number_format( $t['price'] ) ); ?></td><td><?php echo esc_html( $t['pages'] ); ?></td><td><?php echo esc_html( $t['time'] ); ?></td><td><?php echo esc_html( $t['fit'] ); ?></td></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-4);color:var(--hb-text-muted);">Optional Care Plan after launch: THB 15,000–50,000 / month. Thai price guide with market ranges: <a href="<?php echo esc_url( home_url( '/รับทำเว็บไซต์-ราคา-2026/' ) ); ?>" lang="th">รับทำเว็บไซต์ ราคาเท่าไร 2026</a>.</p>
    </div>
</section>

<section class="hb-section hb-section--surface" id="included">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Included on every build</span>
            <h2 class="hb-h2">What an SEO-ready website from Hashbox includes</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $included as $i => $s ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2<?php echo 0 === $i ? ' hb-bento__cell--feature' : ''; ?>">
                <h3 class="hb-h3"><?php echo esc_html( $s[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $s[1] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section" id="process">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Process</span>
            <h2 class="hb-h2">How we build — six phases from discovery to 30 days after launch</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $process as $i => $p ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $p[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $p[1] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="proof">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Proof</span>
            <h2 class="hb-h2">Numbers you can check</h2>
        </div>
        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat"><span class="hb-stat__value">98</span><p class="hb-stat__label">Lighthouse mobile — this site</p><p class="hb-stat__caption">PageSpeed Insights, 29 Aug 2026</p></div>
            <div class="hb-stat"><span class="hb-stat__value">100%</span><p class="hb-stat__label">index coverage in first crawl</p><p class="hb-stat__caption"><a href="<?php echo esc_url( home_url( '/work/nexus-corp/#proof' ) ); ?>">Nexus Corp migration</a></p></div>
            <div class="hb-stat"><span class="hb-stat__value">95+</span><p class="hb-stat__label">Lighthouse guaranteed on every page we build</p><p class="hb-stat__caption"><a href="<?php echo esc_url( home_url( '/en/seo/#guarantee' ) ); ?>">technical guarantee terms</a></p></div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">Web development in Bangkok — questions buyers ask</h2>
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
        <h2 class="hb-h2">Start with a free scope review</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">Tell us what the site must do and who it sells to. You get a page map, stack recommendation and a fixed quote — no commitment. Related: <a href="<?php echo esc_url( home_url( '/en/seo/' ) ); ?>">SEO agency in Bangkok</a> · <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search (GEO)</a> · <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>">AI consulting</a>.</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Request a quote &rarr;</a>
    </div>
</section>

<?php
$offers = array();
foreach ( $tiers as $t ) {
    $offers[] = array( '@type' => 'Offer', 'name' => $t['name'], 'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => $t['price'], 'priceCurrency' => 'THB' ), 'url' => $page_url . '#pricing' );
}
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => $page_url . '#service',
    'name'        => 'Website Development Bangkok — SEO-Ready Websites',
    'description' => $desc,
    'url'         => $page_url,
    'inLanguage'  => 'en-US',
    'provider'    => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'  => array( array( '@type' => 'City', 'name' => 'Bangkok' ), array( '@type' => 'Country', 'name' => 'Thailand' ) ),
    'serviceType' => 'Web Development',
    'hasOfferCatalog' => array( '@type' => 'OfferCatalog', 'name' => 'Website development packages', 'itemListElement' => $offers ),
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'Website Development Bangkok', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'inLanguage' => 'en-US', 'mainEntity' => $faq_entities ) );

get_footer();
