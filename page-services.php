<?php
/**
 * Template Name: Service: Services Hub
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
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
                    <li aria-current="page">Services</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Services</span>
            <h1 class="hb-hero__title">3 บริการที่<br><em>ออกแบบมาให้ทำงานร่วมกัน</em></h1>
            <p class="hb-hero__sub">
                ทุกบริการของเราสามารถจ้างแยกได้ แต่จะให้ผลลัพธ์สูงสุดเมื่อทำงานร่วมกันใต้ทีมเดียว เริ่มจากเว็บที่พร้อม SEO ตั้งแต่วันแรก ติดตั้งเครื่องมือ Marketing เพื่อเพิ่ม Conversion และวาง AI Workforce ที่ลด Manual Work ให้ทีมลูกค้า ทุกอย่างใช้ KPI ชุดเดียวกันและรายงานผ่าน Dashboard Real-time
            </p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-bento">
            <a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c2" data-accent="blue" style="text-decoration:none;">
                <span class="hb-service__num">01</span>
                <span class="hb-service__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><polyline points="7 8 10 11 7 14"/><line x1="13" y1="14" x2="17" y2="14"/></svg></span>
                <h2 class="hb-service__title">SEO-Ready Website</h2>
                <p class="hb-service__desc">เว็บไซต์ที่ผ่าน Build Gate มาตรฐานสูงสุด ส่งมอบให้ลูกค้าพร้อม Index ตั้งแต่วันเปิดตัว Ranking ขยับใน 60-90 วัน</p>
                <div class="hb-service__stack">Next.js · WordPress Headless · Lighthouse 100</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>

            <a href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c2" data-accent="cyan" style="text-decoration:none;">
                <span class="hb-service__num">02</span>
                <span class="hb-service__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M7 14l4-4 4 4 5-5"/><circle cx="20" cy="9" r="1.5"/></svg></span>
                <h2 class="hb-service__title">Digital Marketing + CRO</h2>
                <p class="hb-service__desc">ติดตั้งเครื่องมือ Marketing ครบวงจร พร้อม CRO Sprint รายเดือนเพื่อเพิ่ม Conversion วัดผลผ่าน Looker Studio Real-time</p>
                <div class="hb-service__stack">GA4 · GSC · A/B Testing · CRO Sprint</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>

            <a href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c4" data-accent="violet" style="text-decoration:none;">
                <span class="hb-service__num">03</span>
                <span class="hb-service__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><circle cx="5" cy="6" r="2"/><circle cx="19" cy="6" r="2"/><circle cx="5" cy="18" r="2"/><circle cx="19" cy="18" r="2"/></svg></span>
                <h2 class="hb-service__title">AI Expert Consulting</h2>
                <p class="hb-service__desc">ที่ปรึกษา AI ที่ลงมือ Implement จริง ออกแบบและส่งมอบ AI Workforce ที่ลด Manual Work 40%+ พร้อม ROI Framework + Knowledge Transfer</p>
                <div class="hb-service__stack">LINE Bot · Sales GPT + RAG · n8n Workflow Automation</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>
        </div>
    </div>
</section>

<!-- Bundle -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">Why bundle?</span>
            <h2 class="hb-h2">ทำไมต้องใช้ทั้ง 3 บริการรวมกัน</h2>
            <p class="hb-section__sub">Web · Marketing · AI แยกกัน = 3 KPI ที่ไม่คุยกัน รวมกัน = ทีมเดียวที่รับผิดชอบผลรวมและ Optimize ข้ามฟังก์ชันได้</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <div class="hb-card">
                <h3 class="hb-card__title">1 + 1 + 1 = 5</h3>
                <p class="hb-card__body">SEO ทำให้ Traffic เข้ามา · CRO ทำให้ Convert · AI ทำให้ Scale หลังแปลงเป็นลูกค้า ผลลัพธ์ทบต้นกว่าทำแยก</p>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">Data ต่อเนื่อง</h3>
                <p class="hb-card__body">GA4 + GSC + AI Chat Log อยู่ใน Dashboard เดียว ทำให้เห็น Pattern ที่ทีมแยกไม่มีวันเห็น</p>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">ราคา Bundle</h3>
                <p class="hb-card__body">เลือก Retainer 3 บริการรวมกัน ประหยัดกว่าจ้าง 3 บริษัทแยก ~30% และคุยกับทีมเดียว</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มด้วย Audit ฟรี</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่งรายงาน 15-20 หน้าให้ภายใน 3 วันทำการ ก่อนตัดสินใจเริ่มงาน</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $page_url ),
    ),
) );

get_footer();
