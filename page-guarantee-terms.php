<?php
/**
 * Template Name: Service: เงื่อนไขการันตี "ไม่โต ไม่จ่าย"
 *
 * Full, plain-language terms of the SEO guarantee summarised on
 * /services/seo/#guarantee. Assign to a WP Page at
 * /services/seo/guarantee-terms/ (parent: รับทำ SEO, id 179).
 *
 * Rule: every number here must equal the summary on the SEO page and
 * inc/service-catalog.php / llms.txt. Change all of them together.
 * Approved by Tum 2026-08-29 ("ปรับได้เลย").
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url = home_url( '/services/seo/guarantee-terms/' );
$seo_url  = home_url( '/services/seo/' );
$desc     = 'เงื่อนไขฉบับเต็มของการันตี "ไม่โต ไม่จ่าย" สำหรับบริการรับทำ SEO ของ Hashbox — ชั้นที่ 1 งานเทคนิคผ่านใน 30 วัน (ไม่ผ่านแก้ฟรี) ชั้นที่ 2 impressions +50% หรือ Top-20 +5 คำใน 90 วัน (ไม่ถึงทำต่อฟรีสูงสุด 3 เดือน) วัดจาก Search Console ของลูกค้า พร้อมนิยาม วิธีนับ ข้อยกเว้น และขั้นตอนเมื่อไม่ถึงเป้า';

$definitions = array(
    array( 'คำ', 'ความหมายในเอกสารนี้' ),
    array( 'วันเริ่ม', 'วันที่ลงนามใบสั่งจ้าง (retainer) และเราได้สิทธิ์เข้า Search Console + แก้เว็บ — นับวันหลังสุดของสองอย่างนี้' ),
    array( 'baseline', 'ข้อมูล Search Console 28 วันเต็มก่อนวันเริ่ม ของคีย์เวิร์ดชุดที่ตกลงกัน — บันทึกเป็น screenshot + export ในวันเริ่ม ทั้งสองฝ่ายเก็บสำเนา' ),
    array( 'คีย์เวิร์ดชุดที่ตกลง', '20–50 คำ non-brand ที่เลือกร่วมกันภายใน 14 วันหลัง audit ฟรี · ไม่มีชื่อแบรนด์/โดเมน/ชื่อผู้บริหาร · เปลี่ยนได้เฉพาะเมื่อทั้งสองฝ่ายเห็นชอบเป็นลายลักษณ์อักษร' ),
    array( 'URL ใน scope', 'หน้าที่ระบุในใบสั่งจ้างว่าเราดูแล — ปกติคือหน้าแรก หน้าบริการ และบทความที่เราสร้างหรือปรับ' ),
    array( 'impressions', 'จำนวน impressions รวมของคีย์เวิร์ดชุดที่ตกลง จากรายงาน Performance ประเภท "เว็บ" ใน Search Console ของลูกค้า (รวม AI Overview / AI Mode ตามที่ Google นับ)' ),
    array( 'Top-20', 'คีย์เวิร์ดในชุดที่มี "ตำแหน่งเฉลี่ย" ≤ 20.0 ในช่วง 28 วันที่ใช้วัด' ),
    array( 'วันวัดผลชั้น 2', 'วันที่ 90 หลังชั้นที่ 1 ผ่าน — ใช้ข้อมูล 28 วันล่าสุดที่ Search Console แสดง ณ วันนั้น เทียบกับ baseline' ),
);

$faqs = array(
    array( 'q' => 'การันตี "ไม่โต ไม่จ่าย" หมายความว่าถ้าไม่โตไม่ต้องจ่ายเลยใช่ไหม?', 'a' => 'หมายความว่าค่าบริการเดือนถัดไปเป็นศูนย์จนกว่าจะถึงเป้า สูงสุด 3 เดือน — ค่าบริการ 3 เดือนแรก (ขั้นต่ำของ retainer) ยังคงชำระตามปกติ เพราะเป็นช่วงที่งานเทคนิคและคอนเทนต์ถูกส่งมอบจริง ไม่มีการคืนเงินย้อนหลัง' ),
    array( 'q' => 'ถ้า impressions โต 40% และ Top-20 เพิ่ม 3 คำ ถือว่าผ่านไหม?', 'a' => 'ไม่ผ่าน — ต้องถึงอย่างใดอย่างหนึ่งเต็มจำนวน: impressions ≥ +50% หรือ Top-20 ≥ +5 คำ เราจึงทำเดือนถัดไปให้ฟรีและวัดใหม่ทุกสิ้นเดือนจนถึงเป้าหรือครบ 3 เดือนฟรี' ),
    array( 'q' => 'ทำไมไม่การันตีอันดับ 1?', 'a' => 'เพราะไม่มีใครควบคุมผลการจัดอันดับของ Google ได้ และ Google เองระบุว่าผู้ให้บริการที่รับประกันอันดับควรถูกมองด้วยความระมัดระวัง เราจึงการันตีสิ่งที่วัดได้จากบัญชีของคุณเอง: งานเทคนิคผ่านเกณฑ์ และ impressions/Top-20 ที่ Google รายงาน' ),
    array( 'q' => 'ถ้า Google อัปเดตอัลกอริทึมช่วงที่วัดผล?', 'a' => 'ยังนับตามปกติ — core update คือความเสี่ยงที่เรารับเอง ยกเว้นกรณีเว็บได้รับ manual action (การลงโทษที่ระบุชื่อใน Search Console) จากสิ่งที่ลูกค้าหรือผู้ให้บริการรายอื่นทำ' ),
    array( 'q' => 'เว็บเพิ่งเปิด ยังไม่มี impressions เลย ใช้การันตีได้ไหม?', 'a' => 'เว็บอายุต่ำกว่า 6 เดือนหรือ baseline ต่ำกว่า 200 impressions/28 วัน จะตกลง KPI รายเคสแทน (เช่น จำนวนหน้าใน index และคีย์เวิร์ดที่เริ่มมี impressions) เพราะ +50% ของตัวเลขใกล้ศูนย์ไม่มีความหมาย' ),
    array( 'q' => 'ใครเป็นคนตัดสินว่าผ่านหรือไม่ผ่าน?', 'a' => 'ข้อมูลใน Search Console ของลูกค้า ณ วันวัดผล — ทั้งสองฝ่ายเปิดดูพร้อมกันและบันทึก screenshot ถ้าตัวเลขต่างกันเพราะช่วงวันที่ ให้ใช้ช่วง 28 วันล่าสุดที่ Search Console แสดงในวันนั้น' ),
);
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
                    <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li><a href="<?php echo esc_url( $seo_url ); ?>">รับทำ SEO</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">เงื่อนไขการันตี</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">เงื่อนไขฉบับเต็ม · อัปเดต <?php echo esc_html( get_the_modified_date( 'j M Y' ) ); ?></span>
            <h1 class="hb-hero__title">เงื่อนไขการันตี<br><em>"ไม่โต ไม่จ่าย"</em><br>สำหรับบริการรับทำ SEO</h1>
            <p class="hb-hero__sub"><?php echo esc_html( $desc ); ?></p>
            <p class="hb-body" style="margin-top:var(--hb-space-5);color:var(--hb-text-muted);">สรุปสั้นอยู่ที่ <a href="<?php echo esc_url( $seo_url . '#guarantee' ); ?>">หน้าบริการรับทำ SEO</a> · เอกสารนี้คือฉบับที่แนบท้ายใบสั่งจ้าง</p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="summary">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">สรุปใน 4 บรรทัด</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>ชั้นที่ 1 (30 วัน):</strong> งานเทคนิคต้องผ่านเกณฑ์ ไม่ผ่านเราแก้ฟรีจนผ่าน<br>
                <strong>ชั้นที่ 2 (90 วันหลังชั้น 1):</strong> impressions ของคีย์เวิร์ดที่ตกลง ≥ +50% เทียบ baseline <em>หรือ</em> Top-20 ≥ +5 คำ<br>
                <strong>ไม่ถึง:</strong> เดือนถัดไปฟรี วัดใหม่ทุกสิ้นเดือน สูงสุด 3 เดือนฟรี<br>
                <strong>ตัวตัดสิน:</strong> Search Console ของคุณ ไม่ใช่รายงานของเรา
            </p>
        </div>
    </div>
</section>

<section class="hb-section" id="definitions">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">1</span>
            <h2 class="hb-h2">นิยาม — คำที่ใช้ในเอกสารนี้หมายถึงอะไร</h2>
        </div>
        <div class="hb-prose" style="overflow-x:auto;">
            <table class="hb-table">
                <thead><tr><th><?php echo esc_html( $definitions[0][0] ); ?></th><th><?php echo esc_html( $definitions[0][1] ); ?></th></tr></thead>
                <tbody>
                <?php foreach ( array_slice( $definitions, 1 ) as $d ) : ?>
                    <tr><td><strong><?php echo esc_html( $d[0] ); ?></strong></td><td><?php echo esc_html( $d[1] ); ?></td></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="tier1">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">2</span>
            <h2 class="hb-h2">ชั้นที่ 1 — งานเทคนิคผ่านใน 30 วัน คืออะไร</h2>
        </div>
        <div class="hb-prose">
            <p>ภายใน 30 วันนับจากวันเริ่ม URL ใน scope ทุกหน้าต้องผ่าน 4 ข้อนี้ ตรวจด้วยเครื่องมือสาธารณะของ Google ที่ลูกค้าเปิดดูเองได้:</p>
            <ol>
                <li><strong>Core Web Vitals เขียว</strong> — LCP, INP, CLS ผ่านเกณฑ์ "ดี" ใน PageSpeed Insights (ใช้ค่า lab ถ้ายังไม่มี field data)</li>
                <li><strong>Lighthouse mobile Performance ≥ 90</strong> (≥ 95 ถ้าเป็นเว็บที่ Hashbox สร้าง) — วัด 3 ครั้งใน PageSpeed Insights ใช้ค่ากลาง เพราะผล lab แกว่งได้ ±10</li>
                <li><strong>Schema ผ่าน Rich Results Test</strong> — ไม่มี error สำหรับ type ที่ใส่ (Organization, Service, FAQPage, BreadcrumbList, Article ตามหน้า)</li>
                <li><strong>หน้าเงินทุกหน้าอยู่ใน index</strong> — URL Inspection ใน Search Console แสดง "URL อยู่ใน Google"</li>
            </ol>
            <p><strong>ถ้าไม่ผ่านข้อใดข้อหนึ่ง:</strong> เราแก้ต่อโดยไม่คิดค่าใช้จ่ายเพิ่มจนผ่าน และวันเริ่มนับชั้นที่ 2 เลื่อนไปเป็นวันที่ผ่านครบ — ค่าบริการรายเดือนในช่วงนี้ยังเป็นไปตาม retainer เพราะงานคอนเทนต์และงานอื่นยังส่งมอบต่อเนื่อง</p>
            <p><strong>ข้อยกเว้นชั้นที่ 1:</strong> ปัญหาที่อยู่นอกเว็บ เช่น โฮสต์ตอบช้าเกิน 1.5 วินาที (TTFB) และลูกค้าไม่อนุมัติย้าย/อัปเกรด, ปลั๊กอินหรือสคริปต์ third-party ที่ลูกค้าต้องการเก็บไว้ทั้งที่ทำให้ไม่ผ่านเกณฑ์ — เราจะระบุเป็นลายลักษณ์อักษรก่อนวันที่ 30 พร้อมทางแก้และผลกระทบ</p>
        </div>
    </div>
</section>

<section class="hb-section" id="tier2">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">3</span>
            <h2 class="hb-h2">ชั้นที่ 2 — impressions +50% หรือ Top-20 +5 คำ ใน 90 วัน นับยังไง</h2>
        </div>
        <div class="hb-prose">
            <p>เริ่มนับ 90 วันในวันที่ชั้นที่ 1 ผ่านครบ ณ วันวัดผล เปิด Search Console → Performance → กรองเฉพาะคีย์เวิร์ดชุดที่ตกลง → ช่วง 28 วันล่าสุด แล้วเทียบกับ baseline ที่บันทึกไว้วันเริ่ม ผ่านเมื่อถึง <strong>อย่างใดอย่างหนึ่ง</strong>:</p>
            <ul>
                <li><strong>impressions รวม ≥ baseline × 1.5</strong> (เช่น baseline 2,000 → ต้อง ≥ 3,000)</li>
                <li><strong>จำนวนคำใน Top-20 ≥ baseline + 5</strong> (เช่น baseline 3 คำ → ต้อง ≥ 8 คำ)</li>
            </ul>
            <p><strong>ถ้าไม่ถึงทั้งสองข้อ:</strong> ค่าบริการเดือนถัดไป = 0 บาท เราทำงานตาม scope เดิมต่อ และวัดใหม่ทุกสิ้นเดือน จนกว่าจะถึงเป้าหรือครบ 3 เดือนฟรี หลังจากนั้นลูกค้าเลือกได้ว่าจะไปต่อในราคาปกติหรือยุติ โดยได้รับข้อมูล track ทั้งหมดและงานที่ส่งมอบแล้วไปทั้งหมด</p>
            <p><strong>เมื่อถึงเป้าระหว่างเดือนฟรี:</strong> เดือนถัดจากเดือนที่ถึงเป้ากลับมาคิดค่าบริการตามปกติ ไม่มีการเรียกเก็บย้อนหลังสำหรับเดือนที่ให้ฟรีไปแล้ว</p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="conditions">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">4</span>
            <h2 class="hb-h2">เงื่อนไขและข้อยกเว้น — การันตีไม่มีผลเมื่อไร</h2>
        </div>
        <div class="hb-prose">
            <ol>
                <li><strong>retainer ขั้นต่ำ 3 เดือน</strong> ชำระตามกำหนด — การันตีผูกกับสัญญาที่ยังมีผล</li>
                <li><strong>สิทธิ์เข้าถึง:</strong> Search Console (Full), Google Analytics, และสิทธิ์แก้ไขเว็บ (หรือทีมลูกค้าแก้ตามที่เราส่งภายใน 10 วันทำการ) — ถ้าล่าช้าเกินนี้ วันที่นับเลื่อนตามจำนวนวันที่ล่าช้า</li>
                <li><strong>ไม่มี manual action</strong> ใน Search Console ตลอดช่วงวัดผล ที่เกิดจากการกระทำของลูกค้าหรือผู้ให้บริการรายอื่น</li>
                <li><strong>ไม่เปลี่ยนโดเมน ไม่ย้ายโฮสต์โดยไม่แจ้ง ไม่ลบหรือ noindex หน้าใน scope</strong> ระหว่างช่วงวัดผล</li>
                <li><strong>ไม่ทำ SEO สายเทา/ดำคู่ขนาน</strong> (ซื้อลิงก์ PBN, cloaking, เนื้อหาปั่นจำนวนมาก) จากผู้ให้บริการรายอื่นบนโดเมนเดียวกัน</li>
                <li><strong>เว็บอายุต่ำกว่า 6 เดือน</strong> หรือ baseline ต่ำกว่า 200 impressions/28 วัน หรือ <strong>สูงกว่า 100,000 impressions/28 วัน</strong> → ตกลง KPI รายเคสเป็นลายลักษณ์อักษรแทนตัวเลขมาตรฐาน</li>
                <li>ยกเว้นเหตุสุดวิสัย: Google ระงับการแสดงผลทั้งประเทศ/ทั้งหมวด, เว็บล่มจากฝั่งโฮสต์เกิน 72 ชั่วโมงสะสมในช่วงวัด, หรือเว็บถูกแฮ็ก — ช่วงเวลานั้นไม่นับ และเลื่อนวันวัดผลออกไปเท่ากัน</li>
            </ol>
        </div>
    </div>
</section>

<section class="hb-section" id="claim">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">5</span>
            <h2 class="hb-h2">ขั้นตอนเมื่อไม่ถึงเป้า — ลูกค้าต้องทำอะไร</h2>
        </div>
        <div class="hb-prose">
            <ol>
                <li>ไม่ต้องยื่นเรื่อง — ในวันวัดผลเราส่งสรุปตัวเลขจาก Search Console พร้อม screenshot ให้ทางอีเมล/LINE ภายใน 2 วันทำการ</li>
                <li>ถ้าไม่ถึงเป้า ใบแจ้งหนี้เดือนถัดไปออกเป็น 0 บาท พร้อมแผนงานเดือนนั้นว่าจะแก้อะไร</li>
                <li>ลูกค้าเปิด Search Console ตรวจสอบตัวเลขเองได้ทุกเมื่อ ถ้าตัวเลขไม่ตรงกันให้ใช้ค่าที่ Search Console แสดง ณ วันวัดผล</li>
                <li>ข้อโต้แย้งอื่นแก้ด้วยการเปิดหน้าจอพร้อมกัน (screen share) ก่อนใช้ช่องทางอื่น</li>
            </ol>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามเกี่ยวกับการันตี</h2>
        </div>
        <div class="hb-accordion">
            <?php foreach ( $faqs as $i => $f ) : ?>
                <details class="hb-accordion__item" <?php echo 0 === $i ? 'open' : ''; ?>>
                    <summary class="hb-accordion__trigger"><?php echo esc_html( $f['q'] ); ?></summary>
                    <div class="hb-accordion__content"><p><?php echo esc_html( $f['a'] ); ?></p></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มจาก SEO Audit ฟรี — คีย์เวิร์ดชุดที่ตกลงและ baseline ออกจากตรงนี้</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่ง URL มา เราตรวจโครงสร้าง ความเร็ว Schema และช่องว่างคีย์เวิร์ด แล้วเสนอชุดคีย์เวิร์ด 20–50 คำที่จะใช้วัดการันตี — ไม่มีข้อผูกมัด</p>
        <a href="<?php echo esc_url( home_url( '/seo-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ขอ SEO Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'      => 'https://schema.org',
    '@type'         => 'WebPage',
    '@id'           => $page_url . '#webpage',
    'name'          => 'เงื่อนไขการันตี "ไม่โต ไม่จ่าย" — บริการรับทำ SEO Hashbox',
    'description'   => $desc,
    'url'           => $page_url,
    'inLanguage'    => 'th-TH',
    'dateModified'  => get_the_modified_date( 'c' ),
    'isPartOf'      => array( '@id' => home_url( '/#website' ) ),
    'about'         => array( '@id' => $seo_url . '#service' ),
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => home_url( '/services/' ) ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำ SEO', 'item' => $seo_url ),
        array( '@type' => 'ListItem', 'position' => 4, 'name' => 'เงื่อนไขการันตี', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array( '@context' => 'https://schema.org', '@type' => 'FAQPage', '@id' => $page_url . '#faq', 'inLanguage' => 'th-TH', 'mainEntity' => $faq_entities ) );

get_footer();
