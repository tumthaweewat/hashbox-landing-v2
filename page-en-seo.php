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
    array( 'q' => 'What does "no growth, no pay" mean?', 'a' => 'Two layers, both measured in your Search Console. First, the technical pass within 30 days: green Core Web Vitals on every in-scope URL, Lighthouse mobile 90+, schema passing Rich Results Test, money pages indexed — if not, we fix it free. Then a 90-day window starts after the technical pass. We compare the latest 28 days in your Search Console with the 28-day pre-start baseline for the agreed 20–50 non-brand keywords. If neither impressions grow by at least 50% nor the number of top-20 keywords grows by at least 5, we continue month by month without a service fee, up to 3 months. The initial retainer remains payable; this is not a refund. Conditions: 3-month minimum, Search Console access, no manual penalty, no domain change mid-term.' ),
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

<div class="en-seo" lang="en">
    <section class="en-seo-hero en-seo-wrap" aria-labelledby="seo-title">
        <nav class="en-seo-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url( home_url( '/en/' ) ); ?>">English services</a>
            <span aria-hidden="true">/</span><span aria-current="page">SEO</span>
        </nav>
        <div class="en-seo-hero__grid">
            <div class="en-seo-hero__copy">
                <p class="en-seo-eyebrow">SEO · Bangkok, Thailand</p>
                <h1 id="seo-title">Technical-first SEO agency in Bangkok</h1>
                <p class="en-seo-lead">Fix the foundation. Grow your visibility. Measure the results in your own Search Console.</p>
                <p>Core Web Vitals, content, local SEO and AI Search — with daily reporting and a written “no growth, no pay” guarantee.</p>
                <div class="en-seo-actions">
                    <a href="#seo-contact" class="en-seo-button">Get a free SEO audit <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
                    <a href="#results" class="en-seo-text-link">See the evidence <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
                </div>
                <p class="en-seo-hero__terms">From <strong>THB 29,900 / month</strong> · 3-month minimum · Excludes 7% VAT</p>
                <a href="#guarantee" class="en-seo-small-link">How the guarantee works</a>
            </div>
            <figure class="en-seo-proof">
                <div class="en-seo-proof__heading">
                    <span>Our technical foundation</span>
                    <?php echo hashbox_en_seo_icon( 'gauge' ); ?>
                </div>
                <a href="<?php echo esc_url( get_template_directory_uri() . '/assets/proof/psi-report-2026-08-1600w.webp' ); ?>" class="en-seo-proof__image" aria-label="Open the full-size PageSpeed Insights screenshot">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/proof/psi-report-2026-08-800w.webp' ); ?>"
                        srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/proof/psi-report-2026-08-800w.webp' ); ?> 800w, <?php echo esc_url( get_template_directory_uri() . '/assets/proof/psi-report-2026-08-1600w.webp' ); ?> 1600w"
                        sizes="(min-width: 960px) 42vw, 92vw" width="1600" height="541" fetchpriority="high"
                        alt="Hashbox PageSpeed Insights report: mobile performance 98 and desktop performance 100, dated 7 August 2026">
                </a>
                <figcaption>Hashbox website · 7 August 2026<br>Lab performance snapshot, not a ranking or field Core Web Vitals result.</figcaption>
            </figure>
        </div>
    </section>

    <nav class="en-seo-contents" aria-label="On this page">
        <div class="en-seo-wrap en-seo-contents__inner">
            <span>On this page</span>
            <a href="#scope">Scope</a><a href="#results">Results</a><a href="#guarantee">Guarantee</a><a href="#measure">Reporting</a><a href="#pricing">Pricing</a><a href="#faq">FAQ</a>
            <a href="<?php echo esc_url( $th_url ); ?>" lang="th" class="en-seo-contents__language">ภาษาไทย</a>
        </div>
    </nav>

    <section class="en-seo-section en-seo-wrap" id="results" aria-labelledby="seo-results-title">
        <div class="en-seo-section__head">
            <p class="en-seo-eyebrow">Evidence, before promises</p>
            <h2 id="seo-results-title">See the work behind the numbers</h2>
            <p>Published projects you can inspect. Different sites, different starting points — these outcomes are not a forecast for your business.</p>
        </div>
        <div class="en-seo-results">
            <article class="en-seo-result">
                <p class="en-seo-result__metric">20+ <span>keywords on page one</span></p>
                <h3>Rank Project</h3>
                <p>Within 90 days. See the project’s scope and published evidence.</p>
                <a href="<?php echo esc_url( home_url( '/work/rank-project/#proof' ) ); ?>" class="en-seo-text-link">View ranking case <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
            </article>
            <article class="en-seo-result">
                <p class="en-seo-result__metric">90+ <span>Lighthouse score</span></p>
                <h3>Nexus Corp</h3>
                <p>On every URL. A technical-delivery case, distinct from search-growth results.</p>
                <a href="<?php echo esc_url( home_url( '/work/nexus-corp/#proof' ) ); ?>" class="en-seo-text-link">View technical case <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
            </article>
        </div>
    </section>

    <section class="en-seo-section en-seo-section--tinted" id="scope" aria-labelledby="seo-scope-title">
        <div class="en-seo-wrap">
            <div class="en-seo-section__head">
                <p class="en-seo-eyebrow">Scope of work</p>
                <h2 id="seo-scope-title">One connected SEO programme</h2>
                <p>Technical foundation first, then content, local and AI search — every item measured by the same daily data.</p>
            </div>
            <div class="en-seo-scope">
                <?php $scope_icons = array( 'search-check', 'gauge', 'code-xml', 'file-text', 'map-pin', 'bot', 'mouse-pointer-click', 'chart-no-axes-combined' ); ?>
                <?php foreach ( $scope as $i => $s ) : ?>
                <article class="en-seo-scope__item">
                    <?php echo hashbox_en_seo_icon( $scope_icons[ $i ] ); ?>
                    <div><h3><?php echo esc_html( $s[0] ); ?></h3><p><?php echo esc_html( $s[1] ); ?></p></div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="en-seo-section en-seo-wrap" id="approach" aria-labelledby="seo-approach-title">
        <div class="en-seo-approach">
            <figure class="en-seo-photo">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/services/seo/seo-consultation-pexels-kindel-media-1200w.webp' ); ?>"
                    srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/services/seo/seo-consultation-pexels-kindel-media-640w.webp' ); ?> 640w, <?php echo esc_url( get_template_directory_uri() . '/assets/services/seo/seo-consultation-pexels-kindel-media-1200w.webp' ); ?> 1200w"
                    sizes="(min-width: 960px) 42vw, 92vw" width="1200" height="900" loading="lazy" decoding="async"
                    alt="People reviewing charts and reports together at a table with laptops">
                <figcaption>Illustrative photo · <a href="https://www.pexels.com/photo/business-people-working-together-in-front-of-their-laptops-7651734/" target="_blank" rel="noopener noreferrer">Kindel Media / Pexels</a></figcaption>
            </figure>
            <div class="en-seo-approach__copy">
                <p class="en-seo-eyebrow">How we work</p>
                <h2 id="seo-approach-title">Start with your site, not an article quota</h2>
                <p>We fix how Google reads your site — Core Web Vitals, schema, structure — before adding content, then optimise for both the 10 blue links and AI answers.</p>
                <ol class="en-seo-steps">
                    <li><h3>Audit the foundation</h3><p>Check crawlability, speed, schema and content gaps before agreeing a scope.</p></li>
                    <li><h3>Agree the priorities</h3><p>Set the keyword group and baseline in your Search Console. Quote the work your site needs.</p></li>
                    <li><h3>Implement and measure</h3><p>Fix the technical blockers, build visibility and review the daily data. The history stays yours.</p></li>
                </ol>
                <p class="en-seo-caption">English reporting, meetings and documentation on request. Remote by default; on-site in Bangkok when useful.</p>
            </div>
        </div>
    </section>

    <section class="en-seo-section en-seo-section--tinted" id="guarantee" aria-labelledby="seo-guarantee-title">
        <div class="en-seo-wrap">
            <div class="en-seo-section__head">
                <p class="en-seo-eyebrow">A written commitment</p>
                <h2 id="seo-guarantee-title">“No growth, no pay.” Here is how it works.</h2>
                <p>We do not guarantee rankings; nobody controls Google. We commit to technical delivery and agreed growth criteria, with a clearly defined measurement window.</p>
            </div>
            <ol class="en-seo-timeline">
                <li>
                    <p class="en-seo-timeline__label">First 30 days</p>
                    <h3>Technical pass</h3>
                    <p>Core Web Vitals, Lighthouse mobile 90+ (95+ on sites we build), valid schema and indexed money pages. If the agreed technical criteria are not met, we fix them at no extra charge.</p>
                </li>
                <li>
                    <p class="en-seo-timeline__label">90 days after the technical pass</p>
                    <h3>Measure search growth</h3>
                    <p>For the agreed 20–50 non-brand keywords: impressions grow <strong>at least 50%</strong> <em>or</em> the number of top-20 keywords grows by <strong>at least 5</strong>, against the baseline.</p>
                </li>
                <li>
                    <p class="en-seo-timeline__label">If neither growth target is met</p>
                    <h3>Up to 3 months free</h3>
                    <p>We continue the agreed scope without a monthly service fee, review each month and stop the free extension when a target is met or the 3-month limit is reached.</p>
                </li>
            </ol>
            <details class="en-seo-terms">
                <summary>Measurement, eligibility and payment terms <?php echo hashbox_en_seo_icon( 'plus' ); ?></summary>
                <div>
                    <p><strong>Baseline:</strong> the 28 complete days before the agreed start. The growth review uses the latest 28 days available in your Search Console, 90 days after the technical pass. Top-20 means an average position of 20 or better.</p>
                    <p><strong>Payment:</strong> a 3-month minimum retainer, paid normally. This is a future service-fee waiver, not a refund. Monthly retainer fees continue during technical remediation; corrective work carries no additional fee.</p>
                    <p><strong>Eligibility:</strong> agreed keywords, Search Console and Analytics access, and permission to implement changes. Manual actions, domain changes, deletion of in-scope pages and other exclusions are subject to the full terms. Sites under 6 months old, or with fewer than 200 or more than 100,000 impressions per 28 days, receive a case-specific KPI.</p>
                    <p><a href="<?php echo esc_url( home_url( '/services/seo/guarantee-terms/' ) ); ?>">Read the full terms (Thai)</a>. Those terms define the technical tests, exceptions and claim process.</p>
                </div>
            </details>
        </div>
    </section>

    <section class="en-seo-section en-seo-wrap" id="measure" aria-labelledby="seo-measure-title">
        <div class="en-seo-section__head">
            <p class="en-seo-eyebrow">Measurement</p>
            <h2 id="seo-measure-title">Eight numbers. A clearer view of progress.</h2>
            <p>Daily rank and AI-citation tracking alongside Google’s data. Reporting history belongs to you, including if we part ways.</p>
        </div>
        <ol class="en-seo-measures">
            <?php foreach ( $kpis as $k ) : ?><li><?php echo esc_html( $k ); ?></li><?php endforeach; ?>
        </ol>
    </section>

    <section class="en-seo-section en-seo-section--tinted" id="pricing" aria-labelledby="seo-pricing-title">
        <div class="en-seo-wrap en-seo-pricing">
            <div class="en-seo-pricing__offer">
                <p class="en-seo-eyebrow">Published pricing</p>
                <h2 id="seo-pricing-title">SEO retainer</h2>
                <p class="en-seo-price"><span>From</span> THB 29,900 <span>/ month</span></p>
                <p class="en-seo-pricing__terms"><strong>3-month minimum</strong> · Excludes 7% VAT</p>
                <p>All 8 scope items above, sized to your site after the free audit.</p>
                <ul class="en-seo-checklist">
                    <li><?php echo hashbox_en_seo_icon( 'check' ); ?> Technical audit and fixes first</li>
                    <li><?php echo hashbox_en_seo_icon( 'check' ); ?> Core Web Vitals, schema, local SEO, CRO tracking</li>
                    <li><?php echo hashbox_en_seo_icon( 'check' ); ?> AI Search / GEO included</li>
                    <li><?php echo hashbox_en_seo_icon( 'check' ); ?> Daily rank + AI-citation data, yours to keep</li>
                    <li><?php echo hashbox_en_seo_icon( 'check' ); ?> Written “no growth, no pay” guarantee</li>
                </ul>
                <a href="#seo-contact" class="en-seo-button">Get a free SEO audit <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
            </div>
            <div class="en-seo-pricing__scope">
                <h3>What moves the price</h3>
                <dl>
                    <div><dt>Site size</dt><dd>15 pages and 500 pages are different monthly workloads.</dd></div>
                    <div><dt>Technical state at the start</dt><dd>A site with failing Core Web Vitals and no schema spends the first months on foundation.</dd></div>
                    <div><dt>Keyword difficulty</dt><dd>Head terms against large agencies need authority. We will tell you honestly how long that takes.</dd></div>
                    <div><dt>Rebuild needed?</dt><dd>Usually not. If structure is the bottleneck, that is a separate <a href="<?php echo esc_url( home_url( '/en/website-development/' ) ); ?>">website build</a>.</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <section class="en-seo-section en-seo-wrap en-seo-faq" id="faq" aria-labelledby="seo-faq-title">
        <div class="en-seo-section__head">
            <p class="en-seo-eyebrow">Before we start</p>
            <h2 id="seo-faq-title">Your SEO questions, answered</h2>
        </div>
        <?php foreach ( $faqs as $i => $f ) : ?>
        <details class="en-seo-faq__item"<?php echo 0 === $i ? ' open' : ''; ?>>
            <summary><span><?php echo esc_html( $f['q'] ); ?></span><?php echo hashbox_en_seo_icon( 'plus' ); ?></summary>
            <div><p><?php echo esc_html( $f['a'] ); ?></p></div>
        </details>
        <?php endforeach; ?>
    </section>

    <?php get_template_part( 'template-parts/en-seo-contact' ); ?>

    <nav class="en-seo-related en-seo-wrap" aria-label="Related English services">
        <span>Related services</span>
        <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>">AI consulting <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
        <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search (GEO) <?php echo hashbox_en_seo_icon( 'arrow-right' ); ?></a>
    </nav>
</div>

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
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'English services', 'item' => home_url( '/en/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'SEO', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'inLanguage' => 'en-US', 'mainEntity' => $faq_entities ) );

get_footer();
