<?php
/**
 * Template Name: Tool: GEO Readiness Checker
 *
 * Free linkable tool — enter a URL, get a 0-100 score for how well
 * the page is set up to be cited by generative engines (ChatGPT,
 * Perplexity, Google AI Overviews). Logic + AJAX live in
 * functions.php (hashbox_geo_check_handler). Assign this template to
 * a WP Page, e.g. /tools/geo-checker/.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
?>

<section class="hb-geo">
    <div class="hb-container hb-container--md">
        <header class="hb-geo__head">
            <span class="hb-eyebrow">Free tool</span>
            <h1 class="hb-geo__title">GEO Readiness Checker</h1>
            <p class="hb-geo__lede">ใส่ URL หน้าเว็บของคุณ แล้วดูว่าพร้อมแค่ไหนที่จะถูก <strong>AI search อย่าง ChatGPT, Perplexity และ Google AI Overviews อ้างอิง</strong> — ตรวจ 14 จุดที่ generative engine ใช้ตัดสินใจ พร้อมคำแนะนำที่ลงมือทำได้ทันที</p>
        </header>

        <form class="hb-geo__form" id="hb-geo-form" novalidate>
            <label class="hb-geo__field">
                <span class="hb-geo__label">URL หน้าเว็บที่ต้องการตรวจ</span>
                <input type="url" id="hb-geo-url" name="url" placeholder="https://example.com/blog/my-article" autocomplete="off" required>
            </label>
            <button type="submit" class="hb-btn hb-btn--gradient hb-btn--lg" id="hb-geo-submit">ตรวจ GEO Readiness</button>
        </form>

        <p class="hb-geo__hint">ตรวจหน้าสาธารณะที่เข้าถึงได้เท่านั้น · ใช้เวลา ~5–10 วินาที</p>

        <div class="hb-geo__result" id="hb-geo-result" hidden aria-live="polite"></div>

        <div class="hb-geo__cta" id="hb-geo-cta" hidden>
            <h2 class="hb-geo__cta-title">อยากให้คะแนนขึ้นเป็น 90+?</h2>
            <p class="hb-geo__cta-text">ทีม Hashbox ช่วยทำ GEO + technical SEO ให้หน้าเว็บคุณถูกอ้างใน AI search — เริ่มด้วย audit ฟรี</p>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient">รับ GEO Audit ฟรี &rarr;</a>
        </div>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'WebApplication',
    '@id'             => $page_url . '#app',
    'name'            => 'GEO Readiness Checker',
    'applicationCategory' => 'SEOApplication',
    'operatingSystem' => 'Web',
    'url'             => $page_url,
    'offers'          => array( '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'THB' ),
    'provider'        => array( '@id' => home_url( '/#organization' ) ),
) );
get_footer();
