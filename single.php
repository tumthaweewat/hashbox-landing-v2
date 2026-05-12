<?php
/**
 * Single post template (Insights / blog posts).
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<?php while ( have_posts() ) : the_post();
    $cats = get_the_category();
    $cat  = ! empty( $cats ) ? $cats[0]->name : 'Insight';
?>

<article class="hb-section">
    <div class="hb-container hb-container--md">

        <nav class="hb-breadcrumb" aria-label="Breadcrumb" style="margin-bottom: var(--hb-space-6);">
            <ol class="hb-breadcrumb__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li><a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>">Insights</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li aria-current="page"><?php the_title(); ?></li>
            </ol>
        </nav>

        <header style="margin-bottom: var(--hb-space-8);">
            <div class="hb-rail" style="margin-bottom: var(--hb-space-4);">
                <span class="hb-badge hb-badge--blue"><?php echo esc_html( $cat ); ?></span>
                <span class="hb-caption">เผยแพร่เมื่อ <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd F Y' ) ); ?></time></span>
            </div>
            <h1 class="hb-h1"><?php the_title(); ?></h1>
            <p class="hb-caption" style="margin-top: var(--hb-space-4);">โดย <strong style="color:var(--hb-text-strong);">Hashbox Studio</strong></p>
        </header>

        <div class="hb-prose">
            <?php the_content(); ?>
        </div>

        <footer style="margin-top: var(--hb-space-12); padding-top: var(--hb-space-8); border-top: 1px solid var(--hb-border);">
            <a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>" class="hb-btn hb-btn--outline">← บทความทั้งหมด</a>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-left:var(--hb-space-3);">รับ Audit ฟรี &rarr;</a>
        </footer>

    </div>
</article>

<?php endwhile; ?>

<?php
get_footer();
