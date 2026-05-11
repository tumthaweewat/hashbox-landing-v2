<?php
/**
 * Template Part: Portfolio / Selected Work Section
 *
 * @package Hashbox_Studio
 */

$hashbox_cases = [
    [
        'slug'        => 'nexus-corp',
        'name'        => 'Nexus Corp',
        'tag'         => 'Corporate Website',
        'tag_class'   => 'tag-blue',
        'metric'      => '+540% Users',
        'desc'        => 'Enterprise corporate website on Headless WordPress + Next.js with full SEO and analytics',
        'card_class'  => 'work-large',
        'card_bg'     => 'linear-gradient(135deg, #1D4ED8, #2563EB)',
    ],
    [
        'slug'        => 'flow-store',
        'name'        => 'Flow Store',
        'tag'         => 'E-commerce',
        'tag_class'   => 'tag-cyan',
        'metric'      => '3× Conversion',
        'desc'        => 'Full e-commerce build on Next.js + Stripe with TH payment gateway and CRO sprint',
        'card_class'  => '',
        'card_bg'     => 'linear-gradient(135deg, #0369A1, #06B6D4)',
    ],
    [
        'slug'        => 'rank-project',
        'name'        => 'Rank Project',
        'tag'         => 'SEO Recovery',
        'tag_class'   => 'tag-blue',
        'metric'      => '+2,200% Impressions',
        'desc'        => 'HR-Tech platform technical SEO audit + 12-month content programme. Real GSC data.',
        'card_class'  => '',
        'card_bg'     => 'linear-gradient(135deg, #1E3A5F, #2563EB)',
    ],
    [
        'slug'        => 'autobot-line',
        'name'        => 'AutoBot LINE',
        'tag'         => 'AI Workforce',
        'tag_class'   => 'tag-cyan',
        'metric'      => '−60% Support Cost',
        'desc'        => 'AI-powered LINE OA bot with CRM sync and OpenAI-driven Thai customer support',
        'card_class'  => 'work-large',
        'card_bg'     => 'linear-gradient(135deg, #064E3B, #059669)',
    ],
    [
        'slug'        => 'gold-brand',
        'name'        => 'Gold Brand',
        'tag'         => 'Brand + Web',
        'tag_class'   => 'tag-amber',
        'metric'      => '+180% Branded Search',
        'desc'        => 'Brand identity refresh paired with high-performance corporate site launch',
        'card_class'  => '',
        'card_bg'     => 'linear-gradient(135deg, #78350F, #F59E0B)',
    ],
    [
        'slug'        => 'pitch-deck',
        'name'        => 'Pitch Deck',
        'tag'         => 'Investor Web',
        'tag_class'   => 'tag-blue',
        'metric'      => 'Series A Closed',
        'desc'        => 'High-impact investor microsite with data viz; helped close Series A round',
        'card_class'  => '',
        'card_bg'     => 'linear-gradient(135deg, #312E81, #7C3AED)',
    ],
];
?>
<!-- ============ SECTION 5 — SELECTED WORK ============ -->
<section id="portfolio" class="section-padding" aria-labelledby="portfolio-h2">
    <div class="container">
        <div class="section-header">
            <span class="section-label">PORTFOLIO</span>
            <h2 id="portfolio-h2" class="section-title">Selected Work</h2>
            <p class="section-sub">ผลงานที่วัดผลได้ ทุกเคสมีตัวเลขจริงและ Tech Stack ที่ใช้</p>
        </div>

        <div class="work-grid">
            <?php foreach ( $hashbox_cases as $case ) :
                $href = '/work/' . $case['slug'] . '/';
                $card_classes = 'work-card' . ( $case['card_class'] ? ' ' . $case['card_class'] : '' );
            ?>
                <a href="<?php echo esc_url( $href ); ?>" class="<?php echo esc_attr( $card_classes ); ?>" style="--card-bg: <?php echo esc_attr( $case['card_bg'] ); ?>;" aria-label="<?php echo esc_attr( $case['name'] . ' case study' ); ?>">
                    <span class="work-tag <?php echo esc_attr( $case['tag_class'] ); ?>"><?php echo esc_html( $case['tag'] ); ?></span>
                    <div class="work-overlay">
                        <h3 class="work-name"><?php echo esc_html( $case['name'] ); ?></h3>
                        <p class="work-metric"><strong><?php echo esc_html( $case['metric'] ); ?></strong></p>
                        <p class="work-desc"><?php echo esc_html( $case['desc'] ); ?></p>
                        <span class="work-cta">อ่าน Case Study →</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="work-footer" style="text-align:center;margin-top:2.5rem;">
            <a href="/work/" class="btn btn-outline">ดูผลงานทั้งหมด →</a>
        </div>
    </div>
</section>
