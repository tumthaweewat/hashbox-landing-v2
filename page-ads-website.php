<?php
/**
 * Template Name: Ads Landing: รับทำเว็บไซต์
 *
 * Dedicated paid-search landing page for the "รับทำเว็บไซต์" Google Ads
 * campaign. Streamlined nav, free-audit lead form above the fold, trust
 * proof, and built-in conversion tracking (GA4 dataLayer + optional Google
 * Ads gtag). Send all paid clicks here instead of the long one-pager.
 *
 * @package Hashbox_Studio_V2
 */

/* -------------------------------------------------------------------------
 * Conversion tracking configuration — replace the placeholders below.
 *   - $ga_ads_conversion_id : Google Ads conversion ID, e.g. 'AW-1234567890'
 *   - $ga_ads_lead_label    : the conversion *label* for the "Lead" action
 * Leave them as-is to skip gtag and rely on GTM/GA4 dataLayer events only.
 * A dataLayer 'generate_lead' event is always pushed regardless, so GTM
 * users only need a trigger on that event.
 * ---------------------------------------------------------------------- */
$ga_ads_conversion_id = 'AW-XXXXXXXXXX';
$ga_ads_lead_label    = 'XXXXXXXXXXXXXXXXXX';
$ads_use_gtag         = ( strpos( $ga_ads_conversion_id, 'X' ) === false && strpos( $ga_ads_lead_label, 'X' ) === false );

get_header();

$page_url       = get_permalink();
$contact_status = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
$line_url       = 'https://lin.ee/Xagx6i4';
$tel_raw        = '+66625169868';
$tel_display    = '062-516-9868';

/* Message-matched variants — pick by page slug so you can spin up one page
 * per ad group (sharper message match = higher Quality Score + conversion)
 * from this single template. Name the page slug with "corporate" or
 * "ecommerce"; anything else falls back to the general website build. */
$variants = array(
    'default' => array(
        'eyebrow' => 'รับทำเว็บไซต์ · SEO-Ready',
        'h1'      => 'รับทำเว็บไซต์บริษัท<br><em>ติด Google ตั้งแต่วันเปิดตัว</em>',
        'sub'     => 'เว็บใหม่ที่ผ่าน Technical SEO ตั้งแต่ก่อน deploy — Lighthouse 95+, Core Web Vitals เขียว, Schema ครบ พร้อมติด Google และ AI Search ลด time-to-rank จาก 6 เดือนเหลือ 1-2 เดือน',
        'service' => 'seo-website',
        'source'  => 'google-ads-website',
    ),
    'corporate' => array(
        'eyebrow' => 'รับทำเว็บไซต์องค์กร · B2B',
        'h1'      => 'รับทำเว็บไซต์องค์กร & B2B<br><em>ภาพลักษณ์โปร โหลดเร็ว ติด Google</em>',
        'sub'     => 'เว็บบริษัทที่ดูน่าเชื่อถือ โหลดไวระดับ Lighthouse 95+ พร้อม Schema และ Technical SEO ครบ ช่วยให้ลูกค้า B2B ค้นเจอและไว้ใจตั้งแต่คลิกแรก',
        'service' => 'seo-website',
        'source'  => 'google-ads-corporate',
    ),
    'ecommerce' => array(
        'eyebrow' => 'รับทำเว็บไซต์ขายของ · E-commerce',
        'h1'      => 'รับทำเว็บไซต์ขายของออนไลน์<br><em>เร็ว ติด Google ปิดการขาย</em>',
        'sub'     => 'ร้านค้าออนไลน์ที่โหลดไว Core Web Vitals เขียว รองรับ WooCommerce/Shopify พร้อม Schema สินค้า ช่วยให้ติดอันดับและเพิ่ม conversion จากทราฟฟิกเดิม',
        'service' => 'seo-website',
        'source'  => 'google-ads-ecommerce',
    ),
);
$lp_qid  = get_queried_object_id();
$lp_slug = $lp_qid ? (string) get_post_field( 'post_name', $lp_qid ) : '';
$variant = 'default';
if ( strpos( $lp_slug, 'corporate' ) !== false || strpos( $lp_slug, 'b2b' ) !== false ) {
    $variant = 'corporate';
} elseif ( strpos( $lp_slug, 'ecommerce' ) !== false || strpos( $lp_slug, 'shop' ) !== false || strpos( $lp_slug, 'store' ) !== false ) {
    $variant = 'ecommerce';
}
$v = $variants[ $variant ];

$trust = array(
    array( 'k' => 'Lighthouse 95+', 'v' => 'การันตี ไม่ถึงคืนเงิน' ),
    array( 'k' => 'ติด Google', 'v' => 'ใน 1-2 เดือน หลายอุตสาหกรรม' ),
    array( 'k' => 'Source Code', 'v' => 'เป็นเจ้าของ 100% ไม่ lock-in' ),
    array( 'k' => '17 ปี', 'v' => 'ประสบการณ์ Technical SEO' ),
);

$cases = array(
    array( 'name' => 'Nexus Corp',     'm' => 'Users +540%',          'd' => 'Lighthouse 42 → 100' ),
    array( 'name' => 'Rank Project',   'm' => 'Impressions +2,200%',  'd' => 'page 8 → page 1' ),
    array( 'name' => 'Benjanard',      'm' => 'TTFB 1.8s → 220ms',    'd' => 'Indexed 3 → 47 หน้า' ),
);

$pricing = array(
    array( 't' => 'Landing Page',  'p' => '80,000',  'f' => 'แคมเปญ / lead-gen · 2-3 สัปดาห์' ),
    array( 't' => 'Corporate Site','p' => '200,000', 'f' => 'B2B / องค์กร · 4-6 สัปดาห์' ),
    array( 't' => 'E-commerce',    'p' => '350,000', 'f' => 'ร้านค้าออนไลน์ · 6-10 สัปดาห์' ),
    array( 't' => 'Enterprise',    'p' => '500,000+','f' => 'ระบบซับซ้อน · 8-14 สัปดาห์' ),
);

$gets = array(
    'Technical SEO Audit 15-20 หน้า (ฟรีก่อนเริ่ม)',
    'Lighthouse 95+ Mobile / 100 Desktop',
    'Core Web Vitals เขียวทั้ง LCP / INP / CLS',
    'Schema.org ครบ 8+ types',
    'AI Search opt-in (ChatGPT / Claude / Perplexity)',
    'GA4 + Search Console + Tag Manager setup',
    'ส่งมอบ source code + เอกสารครบ',
    '30 วัน monitoring หลังเปิดตัว',
);

$faqs = array(
    array( 'q' => 'ราคาเริ่มต้นเท่าไหร่?', 'a' => 'Landing Page เริ่ม 80,000 บาท · Corporate Site 200,000 บาท · E-commerce 350,000 บาท ทุกใบเสนอราคาออกหลัง Audit ฟรี' ),
    array( 'q' => 'ใช้เวลานานแค่ไหน?', 'a' => 'Landing Page 2-3 สัปดาห์ · Corporate Site 4-6 สัปดาห์ · E-commerce 6-10 สัปดาห์ เริ่มด้วย Discovery + Audit ฟรีเสมอ' ),
    array( 'q' => 'การันตี Lighthouse จริงไหม?', 'a' => 'การันตี 95+ Mobile / 100 Desktop ถ้าไม่ถึงเป้าใน 14 วันหลัง launch คืนเงิน Performance fee 100%' ),
    array( 'q' => 'ย้ายจากเว็บเดิมได้ไหม?', 'a' => 'รับ migrate จาก WordPress, Wix, Webflow, Shopify รักษา URL เดิม + 301 redirect ครบ ไม่เสีย ranking' ),
);
?>

<style>
/* Streamline the global nav for a focused paid-search landing experience. */
.hb-nav__menu, .hb-nav__status { display: none !important; }
.hb-adlp__hero { padding-top: var(--hb-space-12); }
.hb-adlp__grid { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: var(--hb-space-12); align-items: start; }
.hb-adlp__points { list-style: none; padding: 0; margin: var(--hb-space-6) 0 0; display: flex; flex-direction: column; gap: var(--hb-space-3); }
.hb-adlp__points li { display: flex; align-items: flex-start; gap: var(--hb-space-3); color: var(--hb-text); }
.hb-adlp__points svg { flex: none; margin-top: 2px; color: var(--hb-accent-cyan, #06B6D4); }
.hb-adlp__formcard { background: var(--hb-surface, #18181B); border: 1px solid var(--hb-border, #27272A); border-radius: 16px; padding: var(--hb-space-8); position: sticky; top: 96px; }
.hb-adlp__trust { display: grid; grid-template-columns: repeat(4,1fr); gap: var(--hb-space-4); }
.hb-adlp__trust div { text-align: center; }
.hb-adlp__trust b { display: block; font-size: 1.05rem; color: var(--hb-text); }
.hb-adlp__trust span { font-size: 0.85rem; color: var(--hb-text-muted, #A1A1AA); }
.hb-adlp__cases { display: grid; grid-template-columns: repeat(3,1fr); gap: var(--hb-space-4); }
.hb-adlp__price { display: grid; grid-template-columns: repeat(4,1fr); gap: var(--hb-space-4); }
.hb-adlp__price-card { background: var(--hb-surface, #18181B); border: 1px solid var(--hb-border, #27272A); border-radius: 14px; padding: var(--hb-space-6); }
.hb-adlp__price-card b { font-size: 1.5rem; color: var(--hb-text); display: block; margin: var(--hb-space-2) 0; }
.hb-adlp__gets { list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr 1fr; gap: var(--hb-space-3); }
.hb-adlp__gets li { display: flex; align-items: flex-start; gap: var(--hb-space-3); color: var(--hb-text); }
.hb-adlp__gets svg { flex: none; margin-top: 3px; color: var(--hb-accent-emerald, #10B981); }
.hb-adlp__faq { max-width: 48rem; margin: 0 auto; display: flex; flex-direction: column; gap: var(--hb-space-3); }
.hb-adlp__faq details { background: var(--hb-surface, #18181B); border: 1px solid var(--hb-border, #27272A); border-radius: 12px; padding: var(--hb-space-4) var(--hb-space-6); }
.hb-adlp__faq summary { cursor: pointer; font-weight: 600; color: var(--hb-text); }
.hb-adlp__faq p { margin: var(--hb-space-3) 0 0; color: var(--hb-text-muted, #A1A1AA); }
/* Sticky mobile call bar */
.hb-adlp__bar { display: none; }
@media (max-width: 900px) {
    .hb-adlp__grid, .hb-adlp__trust, .hb-adlp__cases, .hb-adlp__price, .hb-adlp__gets { grid-template-columns: 1fr; }
    .hb-adlp__formcard { position: static; }
    .hb-adlp__bar {
        display: grid; grid-template-columns: 1fr 1fr; gap: 8px;
        position: fixed; left: 0; right: 0; bottom: 0; z-index: 200;
        padding: 10px 12px calc(10px + env(safe-area-inset-bottom));
        background: rgba(9,9,11,0.92); backdrop-filter: blur(8px);
        border-top: 1px solid var(--hb-border, #27272A);
    }
    .hb-adlp__bar a { text-align: center; }
    body { padding-bottom: 76px; }
}
</style>

<!-- HERO + FORM -->
<section class="hb-section hb-adlp__hero">
    <div class="hb-container">
        <div class="hb-adlp__grid">
            <div>
                <span class="hb-eyebrow"><?php echo esc_html( $v['eyebrow'] ); ?></span>
                <h1 class="hb-hero__title" style="margin-top:var(--hb-space-4);"><?php echo wp_kses_post( $v['h1'] ); ?></h1>
                <p class="hb-hero__sub" style="margin-top:var(--hb-space-4);">
                    <?php echo esc_html( $v['sub'] ); ?>
                </p>
                <ul class="hb-adlp__points">
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg><span><b>การันตี Lighthouse 95+</b> ไม่ถึงเป้าคืนเงิน Performance fee 100%</span></li>
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg><span>ส่งมอบ <b>source code ครบ เป็นเจ้าของ 100%</b> ย้าย hosting อิสระ ไม่มี vendor lock-in</span></li>
                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg><span><b>Audit ฟรี รายงาน 15-20 หน้า</b> ส่งให้ภายใน 3 วันทำการ ก่อนตัดสินใจ ไม่มีข้อผูกมัด</span></li>
                </ul>
            </div>

            <div class="hb-adlp__formcard" id="lead">
                <?php if ( $contact_status === 'sent' ) : ?>
                    <div class="hb-badge hb-badge--emerald hb-badge--lg" style="margin-bottom:var(--hb-space-5);">&#10003; ส่งสำเร็จแล้ว</div>
                    <h2 class="hb-h3" style="margin:0 0 var(--hb-space-2);">อยากได้ Audit เร็วขึ้น? ทักทาง LINE เลย</h2>
                    <p style="color:var(--hb-text-muted,#A1A1AA);margin:0 0 var(--hb-space-5);font-size:0.95rem;">ทีมเราติดต่อกลับใน 1 วันทำการ แต่ถ้าแอดไลน์มาคุยตอนนี้ จะเริ่ม Audit ให้ได้เร็วกว่า</p>
                    <a href="<?php echo esc_url( $line_url ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg" target="_blank" rel="noopener noreferrer" data-lp-track="line" style="width:100%;justify-content:center;">เพิ่มเพื่อนใน LINE OA &rarr;</a>
                    <a href="tel:<?php echo esc_attr( $tel_raw ); ?>" class="hb-btn hb-btn--outline hb-btn--lg" data-lp-track="tel" style="width:100%;justify-content:center;margin-top:var(--hb-space-3);">โทร <?php echo esc_html( $tel_display ); ?></a>
                <?php else : ?>
                <h2 class="hb-h3" style="margin:0 0 var(--hb-space-2);">รับ SEO Audit ฟรี</h2>
                <p style="color:var(--hb-text-muted,#A1A1AA);margin:0 0 var(--hb-space-5);font-size:0.95rem;">กรอกสั้น ๆ ทีมเราติดต่อกลับใน 1 วันทำการ</p>

                <?php if ( $contact_status === 'invalid' ) : ?>
                    <div class="hb-badge hb-badge--rose hb-badge--lg" style="margin-bottom:var(--hb-space-4);">กรุณากรอกชื่อ อีเมล และยินยอม PDPA</div>
                <?php elseif ( $contact_status === 'error' ) : ?>
                    <div class="hb-badge hb-badge--rose hb-badge--lg" style="margin-bottom:var(--hb-space-4);">ส่งไม่สำเร็จ ลองอีกครั้งหรือทักผ่าน LINE</div>
                <?php endif; ?>

                <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" style="display:flex;flex-direction:column;gap:var(--hb-space-4);">
                    <input type="hidden" name="action" value="hashbox_contact">
                    <input type="hidden" name="service" value="<?php echo esc_attr( $v['service'] ); ?>">
                    <input type="hidden" name="source" value="<?php echo esc_attr( $v['source'] ); ?>">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $page_url . '#lead' ); ?>">
                    <?php wp_nonce_field( 'hashbox_contact', 'hashbox_nonce' ); ?>

                    <div class="hb-field">
                        <label class="hb-label" for="lp-name">ชื่อ <span class="hb-label__required">*</span></label>
                        <input id="lp-name" class="hb-input" type="text" name="name" required placeholder="ชื่อ-นามสกุล">
                    </div>
                    <div class="hb-field">
                        <label class="hb-label" for="lp-phone">เบอร์โทร / LINE <span class="hb-label__required">*</span></label>
                        <input id="lp-phone" class="hb-input" type="tel" name="phone" required placeholder="08x-xxx-xxxx">
                    </div>
                    <div class="hb-field">
                        <label class="hb-label" for="lp-email">อีเมล <span class="hb-label__required">*</span></label>
                        <input id="lp-email" class="hb-input" type="email" name="email" required placeholder="you@company.com">
                    </div>
                    <div class="hb-field">
                        <label class="hb-label" for="lp-website">เว็บไซต์ปัจจุบัน (ถ้ามี)</label>
                        <input id="lp-website" class="hb-input" type="text" name="website" placeholder="example.com">
                    </div>
                    <label class="hb-checkbox-wrap">
                        <input type="checkbox" class="hb-checkbox" name="pdpa" required>
                        <span class="hb-checkbox-wrap__label">ยินยอมให้ Hashbox เก็บข้อมูลตาม <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color:var(--hb-accent-blue-soft);text-decoration:underline;">นโยบาย PDPA</a></span>
                    </label>
                    <button type="submit" class="hb-btn hb-btn--gradient hb-btn--lg">ส่งและรับ Audit ฟรี &rarr;</button>
                    <p style="text-align:center;margin:0;font-size:0.85rem;color:var(--hb-text-muted,#A1A1AA);">หรือทักด่วนทาง <a href="<?php echo esc_url( $line_url ); ?>" target="_blank" rel="noopener noreferrer" data-lp-track="line" style="color:var(--hb-accent-emerald,#10B981);">LINE OA</a> · โทร <a href="tel:<?php echo esc_attr( $tel_raw ); ?>" data-lp-track="tel" style="color:inherit;"><?php echo esc_html( $tel_display ); ?></a></p>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- TRUST STRIP -->
<section class="hb-section hb-section--surface" style="padding-top:var(--hb-space-8);padding-bottom:var(--hb-space-8);">
    <div class="hb-container">
        <div class="hb-adlp__trust">
            <?php foreach ( $trust as $t ) : ?>
                <div><b><?php echo esc_html( $t['k'] ); ?></b><span><?php echo esc_html( $t['v'] ); ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PROOF -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">ผลงานจริง วัดผลได้</span>
            <h2 class="hb-h2">ตัวเลขจากเว็บที่เราทำให้ลูกค้า</h2>
        </div>
        <div class="hb-adlp__cases">
            <?php foreach ( $cases as $c ) : ?>
                <div class="hb-card">
                    <span class="hb-eyebrow"><?php echo esc_html( $c['name'] ); ?></span>
                    <h3 class="hb-card__title" style="color:var(--hb-accent-cyan,#06B6D4);"><?php echo esc_html( $c['m'] ); ?></h3>
                    <p class="hb-card__body"><?php echo esc_html( $c['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- WHAT YOU GET -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">ได้อะไรบ้าง</span>
            <h2 class="hb-h2">ทุกโปรเจกต์ส่งมอบครบ</h2>
        </div>
        <ul class="hb-adlp__gets">
            <?php foreach ( $gets as $g ) : ?>
                <li><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg><span><?php echo esc_html( $g ); ?></span></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<!-- PRICING -->
<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">ราคาเริ่มต้น</span>
            <h2 class="hb-h2">เลือกแพ็กเกจตามขนาดเว็บ</h2>
            <p class="hb-section__sub">ทุกใบเสนอราคาออกหลัง Audit ฟรี ไม่มีค่าใช้จ่ายแอบแฝง</p>
        </div>
        <div class="hb-adlp__price">
            <?php foreach ( $pricing as $p ) : ?>
                <div class="hb-adlp__price-card">
                    <span class="hb-eyebrow"><?php echo esc_html( $p['t'] ); ?></span>
                    <b>฿<?php echo esc_html( $p['p'] ); ?></b>
                    <p class="hb-card__body" style="margin:0;"><?php echo esc_html( $p['f'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center;margin-top:var(--hb-space-8);">
            <a href="#lead" class="hb-btn hb-btn--gradient hb-btn--lg">ขอใบเสนอราคา + Audit ฟรี &rarr;</a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">คำถามที่พบบ่อย</span>
            <h2 class="hb-h2">ก่อนตัดสินใจ</h2>
        </div>
        <div class="hb-adlp__faq">
            <?php foreach ( $faqs as $f ) : ?>
                <details>
                    <summary><?php echo esc_html( $f['q'] ); ?></summary>
                    <p><?php echo esc_html( $f['a'] ); ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FINAL CTA -->
<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">พร้อมเริ่มเว็บใหม่ที่ติด Google?</h2>
        <p class="hb-lead" style="margin:var(--hb-space-4) auto var(--hb-space-6);">รับ Audit ฟรี 15-20 หน้า ภายใน 3 วันทำการ ก่อนตัดสินใจเริ่มงาน</p>
        <div style="display:flex;gap:var(--hb-space-4);justify-content:center;flex-wrap:wrap;">
            <a href="#lead" class="hb-btn hb-btn--gradient hb-btn--lg">กรอกฟอร์มรับ Audit ฟรี</a>
            <a href="<?php echo esc_url( $line_url ); ?>" class="hb-btn hb-btn--outline hb-btn--lg" target="_blank" rel="noopener noreferrer" data-lp-track="line">คุยทาง LINE OA</a>
        </div>
    </div>
</section>

<!-- Sticky mobile call bar -->
<div class="hb-adlp__bar">
    <a href="<?php echo esc_url( $line_url ); ?>" class="hb-btn hb-btn--gradient" target="_blank" rel="noopener noreferrer" data-lp-track="line">LINE OA</a>
    <a href="tel:<?php echo esc_attr( $tel_raw ); ?>" class="hb-btn hb-btn--outline" data-lp-track="tel">โทรเลย</a>
</div>

<?php if ( $ads_use_gtag ) : ?>
<!-- Google Ads gtag (loaded only because a real conversion ID is configured) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_ads_conversion_id ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo esc_js( $ga_ads_conversion_id ); ?>');
</script>
<?php endif; ?>

<script>
(function () {
  window.dataLayer = window.dataLayer || [];

  // 1) Lead conversion — fires when the form returns ?contact=sent.
  var status = new URLSearchParams(window.location.search).get('contact');
  if (status === 'sent') {
    dataLayer.push({ event: 'generate_lead', lead_source: '<?php echo esc_js( $v['source'] ); ?>', form: 'seo-audit' });
    <?php if ( $ads_use_gtag ) : ?>
    if (typeof gtag === 'function') {
      gtag('event', 'conversion', {
        send_to: '<?php echo esc_js( $ga_ads_conversion_id . '/' . $ga_ads_lead_label ); ?>'
      });
    }
    <?php endif; ?>
    var card = document.getElementById('lead');
    if (card) { card.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
  }

  // 2) Micro-conversions — LINE OA clicks and phone clicks.
  document.querySelectorAll('[data-lp-track]').forEach(function (el) {
    el.addEventListener('click', function () {
      dataLayer.push({ event: 'lead_contact', method: el.getAttribute('data-lp-track'), lead_source: '<?php echo esc_js( $v['source'] ); ?>' });
    });
  });
})();
</script>

<?php
// Service + FAQ schema so the landing page itself is rich-result eligible.
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array(
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
    );
}
if ( function_exists( 'hashbox_jsonld' ) ) {
    hashbox_jsonld( array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        '@id'         => $page_url . '#service',
        'name'        => 'รับทำเว็บไซต์ SEO-Ready',
        'serviceType' => 'Web Development',
        'url'         => $page_url,
        'areaServed'  => 'Thailand',
        'provider'    => array( '@id' => home_url( '/#organization' ) ),
        'description' => 'รับทำเว็บไซต์บริษัทแบบ SEO-Ready พร้อมติด Google ตั้งแต่วันเปิดตัว Lighthouse 95+, Core Web Vitals เขียว, Schema ครบ ส่งมอบ source code 100%',
    ) );
    hashbox_jsonld( array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $faq_entities,
    ) );
}

get_footer();
