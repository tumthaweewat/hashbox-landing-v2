<?php
/**
 * Template Name: Portfolio Page
 *
 * Renders Benjanard portfolio projects server-side using V2 design system.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url   = get_permalink();
$portfolio  = function_exists( 'fetch_benjanard_portfolio' ) ? fetch_benjanard_portfolio() : array( 'projects' => array() );
$projects   = isset( $portfolio['projects'] ) ? $portfolio['projects'] : array();
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
                    <li aria-current="page">Portfolio</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Portfolio</span>
            <h1 class="hb-hero__title">Selected Work<br><em>จากทีม Hashbox</em></h1>
            <p class="hb-hero__sub">
                ผลงานที่วัดผลได้ ทุกเคสคัดมาจากงานจริงในอุตสาหกรรม Banking, Real Estate, Mobile App, E-commerce และ AI แต่ละโปรเจกต์มี Tech Stack, Responsibility และ Outcome ที่ชัดเจน
            </p>
            <div class="hb-rail">
                <button class="hb-badge hb-badge--blue" data-filter="all" type="button">All Projects</button>
                <button class="hb-badge" data-filter="web" type="button">Web Development</button>
                <button class="hb-badge" data-filter="ecommerce" type="button">E-commerce</button>
                <button class="hb-badge" data-filter="mobile" type="button">Mobile Apps</button>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <?php if ( empty( $projects ) ) : ?>
            <p class="hb-lead" style="text-align:center;">ยังไม่มีโปรเจกต์ในระบบ กรุณาติดต่อเราเพื่อขอดู Case Study เพิ่มเติม</p>
        <?php else : ?>
            <div id="projectsGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:var(--hb-space-5);">
                <?php foreach ( $projects as $p ) :
                    $title   = $p['title']       ?? '';
                    $sub     = $p['subtitle']    ?? '';
                    $desc    = $p['description'] ?? '';
                    $cat     = $p['category']    ?? '';
                    $img     = $p['image']       ?? '';
                    $alt     = $p['imageAlt']    ?? $title;
                    $year    = $p['year']        ?? '';
                    $client  = $p['client']      ?? '';
                    $url     = $p['websiteUrl']  ?? '';
                    $tags    = $p['tags']        ?? array();
                ?>
                    <article class="hb-card" data-category="<?php echo esc_attr( $cat ); ?>">
                        <?php if ( $img ) : ?>
                            <div style="margin: calc(var(--hb-space-6) * -1) calc(var(--hb-space-6) * -1) var(--hb-space-4); border-radius: var(--hb-radius-lg) var(--hb-radius-lg) 0 0; overflow:hidden;aspect-ratio:16/10;background:var(--hb-surface-2);">
                                <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;">
                            </div>
                        <?php endif; ?>
                        <header>
                            <div class="hb-rail" style="margin-bottom:var(--hb-space-2);">
                                <?php if ( $client ) : ?><span class="hb-badge"><?php echo esc_html( $client ); ?></span><?php endif; ?>
                                <?php if ( $year ) : ?><span class="hb-caption"><?php echo esc_html( $year ); ?></span><?php endif; ?>
                            </div>
                            <h2 class="hb-card__title"><?php echo esc_html( $title ); ?></h2>
                            <?php if ( $sub ) : ?><p class="hb-caption" style="margin-top:var(--hb-space-1);"><?php echo esc_html( $sub ); ?></p><?php endif; ?>
                        </header>
                        <?php if ( $desc ) : ?><p class="hb-card__body"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
                        <?php if ( ! empty( $tags ) ) : ?>
                            <div class="hb-rail">
                                <?php foreach ( array_slice( $tags, 0, 4 ) as $tag ) : ?>
                                    <span class="hb-badge hb-badge--sm"><?php echo esc_html( $tag ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $url ) : ?>
                            <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="hb-btn hb-btn--ghost hb-btn--sm" style="margin-top:auto;align-self:flex-start;">
                                Visit site →
                            </a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">พร้อมเริ่มโปรเจกต์ของคุณ?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ Audit ฟรีก่อนตัดสินใจเริ่มงาน</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">Start Your Project &rarr;</a>
    </div>
</section>

<script>
// Filter buttons
(function () {
    const buttons = document.querySelectorAll('[data-filter]');
    const cards = document.querySelectorAll('#projectsGrid article[data-category]');
    if (!buttons.length || !cards.length) return;
    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            buttons.forEach((b) => {
                b.classList.toggle('hb-badge--blue', b === btn);
            });
            cards.forEach((c) => {
                c.style.display = (filter === 'all' || c.dataset.category === filter) ? '' : 'none';
            });
        });
    });
})();
</script>

<?php
get_footer();
