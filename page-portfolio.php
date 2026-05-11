<?php
/**
 * Template Name: Portfolio Page
 *
 * Custom page template rendering portfolio projects server-side.
 * Replaces prior AJAX loader (which produced broken "Oops" error state).
 *
 * @package Hashbox_Studio
 */

// Enqueue portfolio-specific styles
function hashbox_portfolio_styles() {
    wp_enqueue_style( 'portfolio-page-css', get_template_directory_uri() . '/css/portfolio-page.css', array(), '1.0.1' );
}
add_action( 'wp_enqueue_scripts', 'hashbox_portfolio_styles' );

get_header();

$portfolio = function_exists( 'fetch_benjanard_portfolio' ) ? fetch_benjanard_portfolio() : array( 'projects' => array() );
$projects  = isset( $portfolio['projects'] ) && is_array( $portfolio['projects'] ) ? $portfolio['projects'] : array();
?>

<div id="portfolioApp" class="portfolio-page-wrapper">

    <section class="portfolio-hero">
        <div class="portfolio-hero-content">
            <h1 class="portfolio-hero-title">
                Selected Work<span class="title-accent">.</span>
            </h1>
            <p class="portfolio-hero-desc">
                ผลงานที่วัดผลได้ ทุกเคสคัดมาจากงานจริงในอุตสาหกรรม Banking, Real Estate, Mobile App, E-commerce และ AI
                แต่ละโปรเจกต์มี Tech Stack, Responsibility และ Outcome ที่ชัดเจน
            </p>
        </div>
    </section>

    <main id="content" class="portfolio-content">
        <section class="projects-section">
            <div class="section-header-portfolio">
                <div class="section-intro">
                    <span class="section-label">OUR WORK</span>
                    <h2 class="section-title">Featured Projects</h2>
                    <p class="section-description">
                        งานที่เราภูมิใจและพร้อมให้ Reference ได้
                    </p>
                </div>
                <div class="section-filters" role="tablist" aria-label="Filter projects by category">
                    <button class="filter-btn active" data-filter="all" type="button">All Projects</button>
                    <button class="filter-btn" data-filter="web" type="button">Web Development</button>
                    <button class="filter-btn" data-filter="ecommerce" type="button">E-commerce</button>
                    <button class="filter-btn" data-filter="mobile" type="button">Mobile Apps</button>
                </div>
            </div>

            <?php if ( empty( $projects ) ) : ?>
                <p class="portfolio-empty">ยังไม่มีโปรเจกต์ในระบบ กรุณาติดต่อเราเพื่อขอดู Case Study เพิ่มเติม</p>
            <?php else : ?>
                <div id="projectsContainer" class="projects-grid">
                    <?php foreach ( $projects as $project ) :
                        $title       = isset( $project['title'] ) ? $project['title'] : '';
                        $subtitle    = isset( $project['subtitle'] ) ? $project['subtitle'] : '';
                        $description = isset( $project['description'] ) ? $project['description'] : '';
                        $category    = isset( $project['category'] ) ? $project['category'] : '';
                        $image       = isset( $project['image'] ) ? $project['image'] : '';
                        $image_alt   = isset( $project['imageAlt'] ) ? $project['imageAlt'] : $title;
                        $year        = isset( $project['year'] ) ? $project['year'] : '';
                        $client      = isset( $project['client'] ) ? $project['client'] : '';
                        $website_url = isset( $project['websiteUrl'] ) ? $project['websiteUrl'] : '';
                        $tags        = isset( $project['tags'] ) && is_array( $project['tags'] ) ? $project['tags'] : array();
                        $features    = isset( $project['features'] ) && is_array( $project['features'] ) ? $project['features'] : array();
                    ?>
                        <article class="project-card" data-category="<?php echo esc_attr( $category ); ?>">
                            <?php if ( $image ) : ?>
                                <div class="project-image">
                                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" loading="lazy" width="640" height="400" />
                                </div>
                            <?php endif; ?>
                            <div class="project-body">
                                <header class="project-header">
                                    <h3 class="project-title"><?php echo esc_html( $title ); ?></h3>
                                    <?php if ( $subtitle ) : ?>
                                        <p class="project-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                                    <?php endif; ?>
                                </header>
                                <?php if ( $description ) : ?>
                                    <p class="project-desc"><?php echo esc_html( $description ); ?></p>
                                <?php endif; ?>
                                <dl class="project-meta">
                                    <?php if ( $client ) : ?>
                                        <dt>Client</dt><dd><?php echo esc_html( $client ); ?></dd>
                                    <?php endif; ?>
                                    <?php if ( $year ) : ?>
                                        <dt>Year</dt><dd><?php echo esc_html( $year ); ?></dd>
                                    <?php endif; ?>
                                    <?php if ( ! empty( $features ) ) : ?>
                                        <dt>Highlights</dt>
                                        <dd>
                                            <ul class="project-features">
                                                <?php foreach ( $features as $feat ) : ?>
                                                    <li><?php echo esc_html( $feat ); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </dd>
                                    <?php endif; ?>
                                </dl>
                                <?php if ( ! empty( $tags ) ) : ?>
                                    <ul class="project-tags" aria-label="Project tags">
                                        <?php foreach ( $tags as $tag ) : ?>
                                            <li><?php echo esc_html( $tag ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php if ( $website_url ) : ?>
                                    <a class="project-link" href="<?php echo esc_url( $website_url ); ?>" target="_blank" rel="noopener noreferrer">
                                        Visit live site →
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="portfolio-cta">
            <div class="cta-content">
                <h2 class="cta-title">พร้อมเริ่มโปรเจกต์ของคุณแล้วหรือยัง?</h2>
                <p class="cta-description">
                    คุยกับเราเพื่อรับ SEO + Performance Audit ฟรี ก่อนตัดสินใจเริ่มงาน
                </p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-cta">
                        Start Your Project
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-outline">
                        Back to Home
                    </a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-orb orb-1"></div>
                <div class="cta-orb orb-2"></div>
                <div class="cta-orb orb-3"></div>
            </div>
        </section>
    </main>
</div>

<script>
// Progressive enhancement: client-side filter only.
// Page already fully rendered server-side; this just hides/shows cards.
(function () {
    const filterBtns = document.querySelectorAll('.filter-btn[data-filter]');
    const cards      = document.querySelectorAll('.project-card[data-category]');
    if (!filterBtns.length || !cards.length) return;

    filterBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            filterBtns.forEach((b) => b.classList.toggle('active', b === btn));
            cards.forEach((card) => {
                const matches = filter === 'all' || card.dataset.category === filter;
                card.style.display = matches ? '' : 'none';
            });
        });
    });
})();
</script>

<?php
get_footer();
?>
