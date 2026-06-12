<?php
/**
 * 404 error template — helpful nav to keep visitors on-site.
 *
 * @package Hashbox_Studio_V2
 */

status_header( 404 );
nocache_headers();

get_header();
?>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <nav class="hb-breadcrumb" aria-label="Breadcrumb">
            <ol class="hb-breadcrumb__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li><span class="hb-breadcrumb__sep">/</span></li>
                <li aria-current="page">404</li>
            </ol>
        </nav>

        <span class="hb-eyebrow">Error 404</span>
        <h1 class="hb-hero__title" style="margin-top:var(--hb-space-3);">ไม่พบหน้าที่คุณกำลังหา</h1>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-8); max-width: 560px;">
            URL ที่คุณเปิดอาจถูกย้าย ลบ หรือพิมพ์ผิด ลองเริ่มจากลิงก์ด้านล่าง หรือใช้ช่องค้นหาเพื่อหาบทความที่ต้องการ
        </p>

        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">กลับหน้าหลัก</a>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">รับ Audit ฟรี</a>
        </div>

        <form role="search" method="get" class="hb-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-top:var(--hb-space-8);">
            <label for="hb-404-search" class="screen-reader-text">ค้นหา</label>
            <input id="hb-404-search" type="search" name="s" placeholder="ค้นหาบทความหรือบริการ..." required>
            <button type="submit" class="hb-btn hb-btn--gradient">ค้นหา</button>
        </form>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ลองดูสิ่งเหล่านี้</span>
            <h2 class="hb-h2">เส้นทางยอดนิยม</h2>
        </div>
        <div class="hb-bento">
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Service</span>
                <h3 class="hb-card__title">SEO-Ready Website</h3>
                <p class="hb-card__body">เว็บที่ผ่าน Lighthouse 100, Core Web Vitals เขียว และ schema ครบตั้งแต่วันเปิดตัว</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Service</span>
                <h3 class="hb-card__title">Digital Marketing + CRO</h3>
                <p class="hb-card__body">GA4, GSC, heatmap และ A/B testing พร้อม CRO Sprint รายเดือน</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Service</span>
                <h3 class="hb-card__title">AI Expert Consulting</h3>
                <p class="hb-card__body">LINE Bot, Sales GPT, RAG และ workflow automation ที่ใช้งานจริงใน production</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Insights</span>
                <h3 class="hb-card__title">Blog</h3>
                <p class="hb-card__body">บทความเรื่อง SEO, web performance, digital marketing, CRO และ AI</p>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
