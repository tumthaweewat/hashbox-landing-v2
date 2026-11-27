<?php
/** English service directory for the top-level /en/ page. */
get_header();

$services = array(
    array( 'Build a new website', 'If your current site is slow or hard to update, explore WordPress and Next.js builds that account for page speed, content editing and search indexing.', '/en/website-development/', 'Website development in Bangkok' ),
    array( 'Answer recurring questions', 'If staff spend hours looking up the same answers, see how an AI assistant can use your internal documents or help answer customer questions on LINE.', '/en/ai-consulting/', 'AI consulting in Bangkok' ),
    array( 'Help buyers find your site', 'If buyers struggle to find your services on Google, start with a technical audit. The team checks how Google crawls your site and reviews the pages that bring in enquiries.', '/en/seo/', 'Technical SEO services in Bangkok' ),
    array( 'Check how AI describes your business', 'If AI answers overlook your services, the team reviews your pages and business information, then checks which sources appear for the questions your buyers ask.', '/en/ai-search/', 'AI search optimisation in Bangkok' ),
);
?>
<div class="en-seo en-directory" lang="en">
    <header class="en-seo-hero en-seo-wrap">
        <nav class="en-seo-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a> / <span aria-current="page">English directory</span></nav>
        <div class="en-seo-section__head">
            <h1>Hashbox Studio services</h1>
            <p class="en-seo-lead">Choose the problem you want to solve. Each service page explains the work involved. If you’re shortlisting providers, start with the buying guides below.</p>
        </div>
    </header>
    <section class="en-seo-section en-seo-section--tinted" aria-labelledby="directory-services">
        <div class="en-seo-wrap">
            <div class="en-seo-section__head"><h2 id="directory-services">Which service do you need?</h2></div>
            <div class="en-seo-results">
                <?php foreach ( $services as $service ) : ?>
                    <article class="en-seo-result">
                        <h3><?php echo esc_html( $service[0] ); ?></h3>
                        <p><?php echo esc_html( $service[1] ); ?></p>
                        <a class="en-seo-text-link" href="<?php echo esc_url( home_url( $service[2] ) ); ?>"><?php echo esc_html( $service[3] ); ?></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="en-seo-section en-seo-wrap" aria-labelledby="directory-guides">
        <div class="en-seo-section__head"><h2 id="directory-guides">Buying guides</h2></div>
        <ul>
            <li><a class="en-seo-text-link" href="<?php echo esc_url( home_url( '/en/ai-consulting-companies-thailand-2026/' ) ); ?>">Compare AI consulting companies in Thailand</a></li>
            <li><a class="en-seo-text-link" href="<?php echo esc_url( home_url( '/best-seo-agencies-bangkok-2026/' ) ); ?>">Compare SEO agencies in Bangkok</a></li>
        </ul>
    </section>
    <section class="en-seo-section en-seo-section--tinted" aria-labelledby="directory-contact">
        <div class="en-seo-wrap">
            <div class="en-seo-section__head">
                <h2 id="directory-contact">Contact Hashbox Studio</h2>
                <p>Planning a website, looking for AI consulting, or unsure where to start? Email us with the problem you’re trying to solve.</p>
                <a class="en-seo-button" href="mailto:business@hashbox.co.th">Email the team</a>
            </div>
            <p>For a search enquiry, choose the English form for your project.</p>
            <div class="en-seo-actions">
                <a class="en-seo-text-link" href="<?php echo esc_url( home_url( '/en/seo/#seo-contact' ) ); ?>">Request an SEO audit</a>
                <a class="en-seo-text-link" href="<?php echo esc_url( home_url( '/en/seo/?service=ai-search#seo-contact' ) ); ?>">Request an AI search audit</a>
            </div>
            <p>Looking to connect your business tools? <a class="en-seo-text-link" href="<?php echo esc_url( home_url( '/services/n8n-automation/' ) ); ?>">Workflow automation (Thai)</a></p>
        </div>
    </section>
</div>
<?php
if ( empty( $GLOBALS['hashbox_rm_has_breadcrumb'] ) ) {
    hashbox_jsonld( array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(
            array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
            array( '@type' => 'ListItem', 'position' => 2, 'name' => 'English directory', 'item' => home_url( '/en/' ) ),
        ),
    ) );
}

$items = array();
foreach ( $services as $i => $service ) {
    $items[] = array( '@type' => 'ListItem', 'position' => $i + 1, 'name' => $service[3], 'url' => home_url( $service[2] ) );
}
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'itemListElement' => $items,
) );
get_footer();
