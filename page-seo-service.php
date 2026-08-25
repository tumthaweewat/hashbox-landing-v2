<?php
/**
 * Template Name: Service: รับทำ SEO
 *
 * Thai money page for the "รับทำ seo" query cluster. Assign this
 * template to a WP Page at /services/seo/ (parent: /services/).
 * Content converted from hashbox-seo-stack/content/p1-service-seo.md —
 * FAQ array below is the single source of truth for both the visible
 * accordion and the FAQPage JSON-LD.
 *
 * Rank Math: Title=รับทำ SEO สายเทคนิค วัดผลด้วยข้อมูลรายวัน | Hashbox,
 * Description=บริการรับทำ SEO แบบ technical-first เริ่มต้น 25,000 บาทต่อเดือน — Core Web Vitals, Schema, GEO/AI Overview พร้อมระบบ track อันดับรายวัน เริ่มจาก SEO Audit ฟรี
 * (Title/description ตัวจริงเขียนลง rank_math_* post meta โดย
 * hashbox_sync_new_service_pages_rankmath_meta() ใน functions.php —
 * บล็อกนี้เป็น reference ต้องแก้ให้ตรงกันทั้งสองที่)
 *
 * ราคา: จุดเริ่มต้นที่เผยแพร่ต่อสาธารณะคือ 25,000 บาทต่อเดือน (ตัวเลขเดียว
 * ที่ approve แล้ว) ปรากฏใน hero, answer box, ตารางเทียบ, section #pricing,
 * FAQ ข้อแรก และ Offer ใน Service JSON-LD — แก้ต้องแก้ให้ครบทุกจุด
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url     = get_permalink();
$services_url = home_url( '/services/' );
$desc         = 'บริการรับทำ SEO แบบ technical-first เริ่มต้น 25,000 บาทต่อเดือน — Core Web Vitals, Schema, GEO/AI Overview พร้อมระบบ track อันดับรายวัน เริ่มจาก SEO Audit ฟรี';

// จุดเริ่มต้นราคาที่เผยแพร่ (retainer รายเดือน) — ใช้ร่วมกันระหว่างข้อความบนหน้าและ Offer schema.
$price_from     = 25000;
$price_from_txt = number_format( $price_from ) . ' บาทต่อเดือน';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปีประสบการณ์ Technical SEO + Performance Engineering · ผ่านโปรเจกต์ SEO migration 50+ เคส · Cert: Google Analytics, Search Console, Cloudflare Performance Engineer';

$faqs = array(
    array( 'q' => 'รับทำ SEO ราคาเท่าไหร่?', 'a' => 'บริการรับทำ SEO ของ Hashbox เริ่มต้นที่ 25,000 บาทต่อเดือน สำหรับงาน SEO ต่อเนื่อง ครอบคลุมงานด้าน Technical SEO, Core Web Vitals, Schema Markup, Content/On-page และ GEO/AI Overview ตาม scope ที่ตกลงกันหลัง audit พร้อมข้อมูลอันดับและการถูกอ้างอิงใน AI Overview อัปเดตรายวัน ราคาไม่รวม VAT 7% · ราคาจริงขึ้นกับ scope ของแต่ละเว็บ — จำนวนหน้า สภาพ technical ปัจจุบัน ความยากของคีย์เวิร์ด และคู่แข่งในตลาด เราไม่ขายแพ็กเกจตายตัวเพราะเว็บแต่ละแบบต้องการงานไม่เท่ากัน วิธีที่แฟร์ที่สุดคือเริ่มจาก SEO Audit ฟรี แล้วเราเสนอราคาตามงานที่จำเป็นจริงๆ' ),
    array( 'q' => 'ทำ SEO ให้ติดหน้าแรก Google ใช้เวลากี่เดือน?', 'a' => 'โดยทั่วไปวงการนี้บอก 6 เดือนขึ้นไป แต่สำหรับเว็บที่โครงสร้าง technical ถูกต้อง — เร็ว, Schema ครบ, โครงสร้างเนื้อหาชัด — เราเห็น time-to-rank ลดเหลือ 1-2 เดือนในหลายอุตสาหกรรม นี่คือเหตุผลที่เราแก้ technical ก่อนเสมอ ส่วนคีย์เวิร์ดที่แข่งสูงมากยังต้องใช้เวลาสะสม authority ซึ่งเราจะบอกตรงๆ ตั้งแต่ audit' ),
    array( 'q' => 'รับประกันอันดับ 1 ได้ไหม?', 'a' => 'ไม่ได้ และใครรับประกันได้ควรระวัง เพราะไม่มีใครควบคุมอัลกอริทึมของ Google ได้ สิ่งที่เรารับประกันคือคุณภาพงานที่วัดได้และกระบวนการโปร่งใส: ทุกงาน technical มีเกณฑ์ผ่านชัดเจน และคุณเห็นข้อมูลอันดับรายวันเองว่าเคลื่อนไปทางไหน' ),
    array( 'q' => 'GEO / AI Overview optimization คืออะไร ทำไมต้องสนใจ?', 'a' => 'GEO (Generative Engine Optimization) คือการทำให้ content ของคุณถูก AI อ้างอิงเวลา AI ตอบคำถาม เช่นใน Google AI Overview ตอนนี้หลาย query ผู้ใช้ได้คำตอบจาก AI ก่อนเห็นเว็บ 10 อันดับ ถ้าแบรนด์คุณไม่ถูกอ้างอิง ก็หายไปจากคำตอบนั้นเลย เราทั้ง optimize ระดับ passage และมีระบบ track การถูกอ้างอิงรายวันเพื่อวัดผลจริง' ),
    array( 'q' => 'ต้องทำเว็บใหม่ไหมถึงจะทำ SEO ได้?', 'a' => 'ไม่จำเป็น ส่วนใหญ่เราแก้บนเว็บเดิมได้ — WordPress, Next.js หรือ stack อื่น ถ้า audit แล้วพบว่าโครงสร้างเดิมเป็นคอขวดจริงๆ (เช่นแก้ความเร็วยังไงก็ไม่ผ่านเกณฑ์) เราจะเสนอทางเลือกพร้อมเหตุผล ซึ่งทีมเรารับพัฒนาเว็บ SEO-Ready เองอยู่แล้ว ตัดสินใจจากข้อมูล ไม่ใช่จากการอยากขายงานเพิ่ม' ),
    array( 'q' => 'รายงานที่ได้เป็นแบบไหน?', 'a' => 'ข้อมูลอันดับคีย์เวิร์ดและการถูกอ้างอิงใน AI Overview อัปเดตรายวันจากระบบของเราเอง พร้อมสรุปสิ่งที่ทำและสิ่งที่จะทำต่อ คุณเห็นความเคลื่อนไหวได้ตลอด ไม่ต้องรอสรุปสิ้นเดือน และข้อมูลย้อนหลังเก็บไว้ทั้งหมดตั้งแต่วันแรกที่เริ่มงาน' ),
    array( 'q' => 'เว็บอยู่บน WordPress / Next.js / แพลตฟอร์มสำเร็จรูป ทำได้ไหม?', 'a' => 'ได้ เราทำงานกับ WordPress, Headless WordPress, Next.js และ Astro เป็นประจำ แพลตฟอร์มสำเร็จรูปบางตัวมีข้อจำกัดด้าน technical ที่แก้ไม่ได้ ซึ่งจะบอกตรงๆ ใน audit ว่าอะไรทำได้แค่ไหน' ),
    array( 'q' => 'เริ่มยังไง?', 'a' => 'เริ่มจากรับ SEO Audit ฟรี — ส่ง URL เว็บมาผ่านหน้า Contact เราตรวจ technical, content และโอกาสใน AI Overview แล้วนัดคุยผลแบบไม่มีข้อผูกมัด มีคำถามก่อนเริ่มก็ทักมาคุยได้เลย' ),
);

$pains = array(
    array( 't' => 'จ่ายไปหลายเดือน ไม่รู้ว่าได้อะไร', 'd' => 'รายงานมาเดือนละครั้ง เป็นกราฟสวยๆ แต่ถามลึกๆ ว่าทำอะไรไปบ้าง ตอบไม่ได้' ),
    array( 't' => 'ได้แต่บทความ', 'd' => 'เว็บโหลดช้า โครงสร้างพัง Schema ไม่มี แต่ agency ส่งบทความมาเรื่อยๆ เพราะเป็นสิ่งเดียวที่ deliver ง่าย' ),
    array( 't' => 'วัดผลด้วยเครื่องมือเช่า', 'd' => 'ข้อมูลอันดับอยู่ใน SaaS ที่ agency เช่า พอเลิกจ้าง ข้อมูลย้อนหลังหายหมด' ),
    array( 't' => 'ไม่มีใครพูดถึง AI Overview', 'd' => 'ทั้งที่ query จำนวนมากตอนนี้ Google ตอบเองด้วย AI ก่อนแสดงผลลัพธ์ 10 ลิงก์' ),
);

$audit_items = array(
    array( 't' => 'Technical checklist', 'd' => 'สถานะ crawlability, indexability, redirect, canonical, sitemap, robots.txt พร้อมระบุจุดที่เป็นปัญหา' ),
    array( 't' => 'ผล Core Web Vitals', 'd' => 'LCP, INP, CLS ของหน้าสำคัญ เทียบกับเกณฑ์ของ Google' ),
    array( 't' => 'สถานะ Schema', 'd' => 'ตอนนี้มี type อะไรแล้ว และขาด type ไหนตามประเภทธุรกิจของคุณ' ),
    array( 't' => 'ช่องว่างด้าน content', 'd' => 'หน้าที่ควรมีแต่ยังไม่มี เทียบกับ search intent จริงของตลาด' ),
    array( 't' => 'โอกาสใน AI Overview', 'd' => 'คีย์เวิร์ดกลุ่มไหนของธุรกิจคุณที่ Google แสดง AI Overview แล้ว และตอนนี้ใครถูกอ้างอิงอยู่' ),
);

$compare = array(
    array( 'จุดเริ่มต้น', 'รับ brief แล้วเริ่มเขียนบทความ', 'Technical audit — แก้โครงสร้างก่อน' ),
    array( 'Technical depth', 'ส่งต่อให้ "ทีม dev ของลูกค้า"', 'ทำเอง — การันตี Lighthouse 95+ สำหรับเว็บที่เราพัฒนาเอง' ),
    array( 'Schema', 'Organization + LocalBusiness แล้วจบ', 'ครบ 8+ types ตาม content แต่ละประเภท' ),
    array( 'AI Overview / GEO', 'ไม่ทำ หรือยังไม่มีวิธีวัด', 'Optimize ระดับ passage + track การถูกอ้างอิงรายวัน' ),
    array( 'เครื่องมือวัดผล', 'เช่า SaaS รายเดือน', 'ระบบ rank tracking + AI-citation ของเราเอง' ),
    array( 'รายงาน', 'PDF เดือนละครั้ง', 'ข้อมูลจริงรายวัน เก็บย้อนหลังทั้งหมด' ),
    array( 'ราคา', 'แพ็กเกจตายตัว', 'เริ่มต้น 25,000 บาทต่อเดือน · quote จริงหลัง audit ฟรี' ),
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
                    <li><a href="<?php echo esc_url( $services_url ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">รับทำ SEO</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">SEO Service · วัดผลด้วยข้อมูลจริง</span>
            <h1 class="hb-hero__title">รับทำ SEO<br><em>แบบ Technical-First</em><br>วัดผลด้วยข้อมูลจริงรายวัน</h1>
            <p class="hb-hero__sub">บริการรับทำ SEO ของ Hashbox ไม่ได้เริ่มจาก "เขียนบทความเดือนละ 4 ชิ้น" แต่เริ่มจากแก้โครงสร้างเว็บให้ Google อ่านได้เร็วและเข้าใจถูกต้องก่อน — Technical SEO, Core Web Vitals, Schema.org — แล้วต่อยอดด้วย content และ GEO เพื่อให้เว็บของคุณไม่ได้แค่ติดอันดับ แต่ถูก AI อ้างอิงด้วย · ค่าบริการเริ่มต้น 25,000 บาทต่อเดือน เริ่มจาก SEO Audit ฟรี</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงาน</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox รับทำ SEO แบบ technical-first เริ่มต้น <?php echo esc_html( $price_from_txt ); ?></strong> — แก้โครงสร้างเว็บ ความเร็ว และ Schema ให้ Google อ่านได้ถูกต้องก่อน แล้วค่อยต่อยอดด้วย content เรา optimize 2 สนามพร้อมกัน: อันดับบน Google และการถูกอ้างอิงใน AI Overview (GEO) ลูกค้าเห็นข้อมูลอันดับและ AI citation อัปเดตรายวันจากระบบ track ของเราเอง ไม่ใช่ PDF เดือนละครั้ง quote สุดท้ายออกตาม scope จริงหลัง SEO Audit ฟรี ไม่มีข้อผูกมัด
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ปัญหาที่เจอบ่อย</span>
            <h2 class="hb-h2">ทำไมการจ้างบริษัทรับทำ SEO ส่วนใหญ่ถึงน่าผิดหวัง</h2>
            <p class="hb-section__sub">ปัญหาหลักคือความไม่โปร่งใส: จ่ายรายเดือนแล้วได้รายงาน PDF หนึ่งฉบับ แต่ไม่รู้ว่า agency ทำอะไรไปบ้าง และตัวเลขมาจากไหน — ทั้งที่พฤติกรรมการค้นหาย้ายไปหา AI Overview มากขึ้นเรื่อยๆ</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $pains as $i => $p ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label">0<?php echo (int) ( $i + 1 ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $p['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $p['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="hb-lead" style="margin-top:var(--hb-space-6);text-align:center;">Hashbox ออกแบบบริการรับทำ SEO มาเพื่อแก้ทั้ง 4 ข้อนี้โดยตรง — ถ้ายังไม่แน่ใจว่า SEO ครอบคลุมอะไรบ้าง อ่านภาพรวมทั้งระบบก่อนที่ <a href="<?php echo esc_url( home_url( '/seo-thai-guide-2026/' ) ); ?>" style="color:var(--hb-accent-blue,#2563EB);">SEO คืออะไร? คู่มือฉบับ 2026</a></p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ขอบเขตบริการ</span>
            <h2 class="hb-h2">บริการรับทำ SEO ของเราครอบคลุมอะไรบ้าง</h2>
            <p class="hb-section__sub">ตั้งแต่ Technical SEO audit, Core Web Vitals, Schema markup, Content/On-page ไปจนถึง GEO/AI Overview optimization — ทั้งหมดวัดผลผ่านระบบข้อมูลรายวันของเราเอง เห็นความเคลื่อนไหวของทุกคีย์เวิร์ดทุกวัน</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">01</span>
                <h3 class="hb-h3">Technical SEO Audit</h3>
                <p class="hb-body">ตรวจโครงสร้างเว็บทั้งหมด: crawlability, indexability, internal linking, redirect chain, canonical, sitemap, robots.txt ถ้าโครงสร้างพัง content ดีแค่ไหนก็ไปไม่ถึงหน้าแรก แนวทางที่เราใช้จริงอยู่ใน <a href="<?php echo esc_url( home_url( '/technical-seo-guide/' ) ); ?>">Technical SEO Guide</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">02</span>
                <h3 class="hb-h3">Core Web Vitals</h3>
                <p class="hb-body">ความเร็วเว็บเป็น ranking factor และตัวตัดสิน conversion เป้าหมายคือ CWV เขียวทุกตัว (<a href="<?php echo esc_url( home_url( '/lcp-คืออะไร-วิธี-2026/' ) ); ?>">LCP</a>, INP, CLS) เว็บที่เราพัฒนาเองการันตี Lighthouse 95+ และ 100 เต็มในเคสที่ stack ของเราควบคุมได้ อ่านวิธีคิดได้ที่ <a href="<?php echo esc_url( home_url( '/core-web-vitals-thai-guide-2026/' ) ); ?>">คู่มือ Core Web Vitals</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">03</span>
                <h3 class="hb-h3">Schema Markup</h3>
                <p class="hb-body">Schema.org คือภาษาที่ Google และ AI ใช้เข้าใจว่าเว็บคุณคือใคร ขายอะไร อยู่ที่ไหน เราติดตั้งครบ 8+ types ตามประเภทธุรกิจ ไม่ใช่แปะ Organization ตัวเดียวแล้วจบ ดูรายละเอียดใน <a href="<?php echo esc_url( home_url( '/schema-markup-thai-guide-2026/' ) ); ?>">คู่มือ Schema Markup สำหรับเว็บไทย</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">04</span>
                <h3 class="hb-h3">Content &amp; On-page</h3>
                <p class="hb-body">วางโครงสร้าง content จาก search intent จริง: title, heading, internal link, answer-first structure ที่ทั้งคนอ่านรู้เรื่องและ AI ดึงไปตอบได้ เราไม่รับปั๊มบทความรายเดือนแบบไม่มีทิศทาง — ทุกหน้าต้องมีคีย์เวิร์ดเป้าหมายและเหตุผลว่าทำไมต้องมีหน้านั้น</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">05</span>
                <h3 class="hb-h3">GEO / AI Overview Optimization</h3>
                <p class="hb-body">จุดที่เราต่างจากบริษัทรับทำ SEO ทั่วไปมากที่สุด: เรา optimize ระดับ passage ให้ content ถูก AI Overview หยิบไปอ้างอิง และมีระบบ track ว่าโดเมนไหนถูกอ้างอิงในคีย์เวิร์ดเป้าหมาย อัปเดตรายวัน อ่านแนวคิดเต็มๆ ที่ <a href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>">GEO: AI Search Optimization 2026</a></p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">06</span>
                <h3 class="hb-h3">รายงานจากข้อมูลจริง รายวัน</h3>
                <p class="hb-body">ข้อมูลอันดับ + การถูกอ้างอิงใน AI Overview จากระบบ data pipeline ของเราเอง เก็บทุกวัน เก็บย้อนหลังทั้งหมด และเป็นของโปรเจกต์คุณ พออันดับตกหรือ AI เปลี่ยนแหล่งอ้างอิง เราเห็นภายในวันนั้น ไม่ใช่ปลายเดือน</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">เริ่มจากตรงนี้</span>
            <h2 class="hb-h2">อะไรอยู่ใน SEO Audit ฟรี</h2>
            <p class="hb-section__sub">ไม่ใช่รายงาน automated ที่กดปุ่มจากเครื่องมือแล้วส่งต่อ แต่เป็นการตรวจจริงแล้วสรุปเป็นเอกสารที่เอาไปใช้ต่อได้ทันที ไม่ว่าสุดท้ายจะจ้างเราหรือไม่ก็ตาม</p>
        </div>
        <ul style="list-style:none;margin:0;padding:var(--hb-space-6);border:1px solid var(--hb-border);border-radius:var(--hb-radius-md,8px);background:var(--hb-surface-1,#18181B);display:grid;gap:var(--hb-space-4);">
            <?php foreach ( $audit_items as $item ) : ?>
                <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;">
                    <span aria-hidden="true" style="color:var(--hb-accent-emerald,#10B981);font-weight:700;line-height:var(--hb-leading-normal);">&#10003;</span>
                    <p class="hb-body" style="margin:0;"><strong><?php echo esc_html( $item['t'] ); ?></strong> — <?php echo esc_html( $item['d'] ); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="hb-body" style="margin-top:var(--hb-space-4);color:var(--hb-text-muted);">ทั้งหมดเรียงตาม impact — คุณเห็นเองว่าอะไรควรแก้ก่อน และไม่มีข้อผูกมัดว่าต้องจ้างต่อ</p>
        <p style="margin-top:var(--hb-space-5);"><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient">รับ SEO Audit ฟรี &rarr;</a></p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ความต่าง</span>
            <h2 class="hb-h2">ทำไม Hashbox ต่างจาก SEO agency ทั่วไป</h2>
            <p class="hb-section__sub">สรุปได้ 3 ข้อ: เราเป็นสาย technical ที่สร้างเว็บ Lighthouse 95+ เองได้จริง · เราทำ GEO/AI Overview ควบคู่กับ SEO ปกติ · และเราวัดผลด้วยระบบข้อมูลของเราเองที่อัปเดตรายวัน</p>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:var(--hb-text-sm);min-width:560px;">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text-muted);font-weight:600;">หัวข้อ</th>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text-muted);font-weight:600;">Agency ทั่วไป</th>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-accent-blue,#2563EB);font-weight:600;">Hashbox</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $compare as $row ) : ?>
                        <tr>
                            <th scope="row" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);font-weight:600;color:var(--hb-text);"><?php echo esc_html( $row[0] ); ?></th>
                            <td style="padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text-muted);"><?php echo esc_html( $row[1] ); ?></td>
                            <td style="padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text);"><?php echo esc_html( $row[2] ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-5);color:var(--hb-text-muted);">จุดที่อยากขยายความคือเรื่องระบบวัดผล: agency ส่วนใหญ่เช่าเครื่องมือ SaaS แล้ว export รายงานให้ลูกค้า แต่ Hashbox สร้าง data pipeline ของตัวเอง เก็บอันดับคีย์เวิร์ดและการถูกอ้างอิงใน AI Overview ทุกวัน ข้อมูลดิบเก็บถาวร — เราจึงตอบได้เสมอว่า "อันดับขยับเพราะอะไร ตั้งแต่วันไหน" ด้วยหลักฐาน ไม่ใช่ความรู้สึก และทั้งหมดนี้ทำแบบสายขาวเท่านั้น — ลิสต์ 6 สิ่งที่เราไม่ทำต่อให้ลูกค้าขอ อยู่ที่หน้า<a href="<?php echo esc_url( home_url( '/services/seo/white-hat/' ) ); ?>" style="color:var(--hb-accent-blue,#2563EB);">รับทำ SEO สายขาว</a></p>
    </div>
</section>

<section class="hb-section" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา</span>
            <h2 class="hb-h2">ราคารับทำ SEO เริ่มต้น <?php echo esc_html( $price_from_txt ); ?></h2>
            <p class="hb-section__sub">งาน SEO ต่อเนื่องของ Hashbox เริ่มต้นที่ <?php echo esc_html( $price_from_txt ); ?> ครอบคลุมงานด้าน Technical SEO, Core Web Vitals, Schema, Content/On-page และ GEO/AI Overview · เราไม่ขายแพ็กเกจตายตัว — quote สุดท้ายออกหลัง SEO Audit ฟรี ตาม scope จริงของเว็บคุณ</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">ราคาเริ่มต้น</span>
                <span class="hb-tier__name">SEO ต่อเนื่อง</span>
                <div class="hb-tier__price"><?php echo esc_html( number_format( $price_from ) ); ?><span class="hb-tier__price-unit">บาทต่อเดือน</span></div>
                <p class="hb-caption">ครอบคลุมงานทั้ง 6 ด้านด้านบน ตาม scope ที่ตกลงกันหลัง audit</p>
                <ul class="hb-tier__features">
                    <li>Technical SEO — crawlability, indexability, redirect, canonical, sitemap</li>
                    <li>Core Web Vitals — LCP, INP, CLS ตามเกณฑ์ของ Google</li>
                    <li>Schema Markup ครบ 8+ types ตามประเภทธุรกิจ</li>
                    <li>Content &amp; On-page วางจาก search intent จริง</li>
                    <li>GEO / AI Overview optimization ระดับ passage</li>
                    <li>ข้อมูลอันดับ + การถูกอ้างอิงใน AI Overview อัปเดตรายวัน จากระบบของเราเอง</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">ขอใบเสนอราคา SEO</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">อะไรทำให้ราคาขยับจากจุดเริ่มต้น</h3>
                <p class="hb-body" style="margin:0;"><strong>จำนวนหน้าและขนาดเว็บ</strong> — เว็บเล็กกับเว็บที่มีหลายร้อยหน้าใช้แรงต่อเดือนไม่เท่ากัน</p>
                <p class="hb-body" style="margin:0;"><strong>สภาพ technical ปัจจุบัน</strong> — ถ้า Core Web Vitals ตกและ Schema ยังไม่มีเลย เดือนแรกๆ จะหนักไปทางแก้โครงสร้างก่อน</p>
                <p class="hb-body" style="margin:0;"><strong>ความยากของคีย์เวิร์ดและคู่แข่ง</strong> — คีย์เวิร์ดที่แข่งสูงมากต้องใช้เวลาสะสม authority ซึ่งเราบอกตรงๆ ตั้งแต่ audit</p>
                <p class="hb-body" style="margin:0;"><strong>ต้องรื้อฐานเว็บด้วยไหม</strong> — ส่วนใหญ่แก้บนเว็บเดิมได้ ถ้า audit พบว่าโครงสร้างเดิมเป็นคอขวดจริง เราจะเสนอทางเลือกพร้อมเหตุผล ซึ่งเป็นคนละงานกับ<a href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>">บริการทำเว็บไซต์</a></p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);color:var(--hb-text-muted);"><?php echo esc_html( $price_from_txt ); ?> คือจุดเริ่มต้น ไม่ใช่ราคาเหมาทุกเว็บ — เราเสนอราคาตามงานที่จำเป็นจริงหลัง SEO Audit ฟรี และคุณเห็นทั้งปัญหาและ scope ก่อนตัดสินใจว่าจะจ้างต่อหรือไม่ · ราคาไม่รวม VAT 7%</p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ผลลัพธ์</span>
            <h2 class="hb-h2">ผลลัพธ์ที่เกิดขึ้นจริง</h2>
            <p class="hb-section__sub">ลำดับของงานคือหัวใจ: แก้โครงสร้างและความเร็วก่อนเสมอ แล้วค่อยต่อยอดด้วย content — Google จึงไม่ต้องเสียเวลางมกับเว็บที่อ่านยาก</p>
        </div>
        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient">+540<span class="hb-stat__unit">%</span></span>
                <p class="hb-stat__label">Users</p>
                <p class="hb-stat__caption">เคส Nexus Corp</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient">+2,200<span class="hb-stat__unit">%</span></span>
                <p class="hb-stat__label">Impressions</p>
                <p class="hb-stat__caption">เคส Rank Project</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value">1&ndash;2<span class="hb-stat__unit">เดือน</span></span>
                <p class="hb-stat__label">Time-to-rank ในหลายอุตสาหกรรม</p>
                <p class="hb-stat__caption">ลดจาก ~6 เดือน เมื่อโครงสร้างถูกต้องตั้งแต่ต้น</p>
            </div>
        </div>
        <p style="margin-top:var(--hb-space-5);"><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline">ดูรายละเอียดแต่ละเคส — Nexus Corp, Rank Project, Benjanard Studio &rarr;</a></p>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div style="padding:var(--hb-space-6);border:1px solid var(--hb-border);border-radius:var(--hb-radius-md,8px);background:var(--hb-surface-2,#1E1E2A);">
            <span class="hb-eyebrow">ดูแลโดย</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);"><strong><?php echo esc_html( $author_name ); ?></strong> · <?php echo esc_html( $author_role ); ?></p>
            <p class="hb-body" style="color:var(--hb-text-muted);margin-top:var(--hb-space-2);"><?php echo esc_html( $author_bio ); ?></p>
            <p class="hb-body" style="margin-top:var(--hb-space-3);"><a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener" target="_blank">LinkedIn &rarr;</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อยเรื่องรับทำ SEO</h2>
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
        <h2 class="hb-h2">พร้อมเริ่มไหม?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่ง URL เว็บมา เราตรวจ technical, content และโอกาสใน AI Overview แล้วนัดคุยผลแบบไม่มีข้อผูกมัด</p>
        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
            <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงานที่ผ่านมา</a>
        </div>
    </div>
</section>

<?php
// Published entry price. Single tier on purpose — 25,000 บาทต่อเดือน is the only
// figure we publish; everything above it is quoted per scope after the audit.
$seo_offer = array(
    '@type'              => 'Offer',
    'name'               => 'บริการรับทำ SEO ต่อเนื่อง (รายเดือน)',
    'price'              => (string) $price_from,
    'priceCurrency'      => 'THB',
    'priceSpecification' => array(
        '@type'         => 'UnitPriceSpecification',
        // minPrice is what makes this an "from / เริ่มต้น" price rather than a
        // flat rate. schema.org Offer.price alone has no starting-from meaning,
        // and every visible string on this page says เริ่มต้น.
        'minPrice'      => (string) $price_from,
        'price'         => (string) $price_from,
        'priceCurrency' => 'THB',
        'unitCode'      => 'MON',
        'unitText'      => 'เดือน',
    ),
    'description'        => 'ราคาเริ่มต้นต่อเดือนสำหรับงาน SEO ต่อเนื่อง ครอบคลุมงานด้าน Technical SEO, Core Web Vitals, Schema Markup, Content/On-page และ GEO/AI Overview optimization พร้อมข้อมูลอันดับและการถูกอ้างอิงใน AI Overview รายวัน ขอบเขตงานจริงและราคาสุดท้ายกำหนดตาม scope หลัง SEO Audit ฟรี',
    // ไม่รวม VAT เหมือนทุกหน้าบริการ (page-ai-consulting.php:428, page-wordpress-website.php)
    'valueAddedTaxIncluded' => false,
    'availability'       => 'https://schema.org/InStock',
    'areaServed'         => 'TH',
    'url'                => $page_url . '#pricing',
);
hashbox_jsonld( array(
    '@context'         => 'https://schema.org',
    '@type'            => 'Service',
    '@id'              => $page_url . '#service',
    'name'             => 'บริการรับทำ SEO',
    'serviceType'      => 'Search Engine Optimization',
    'description'      => $desc,
    'url'              => $page_url,
    'inLanguage'       => 'th',
    'provider'         => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'       => array( '@type' => 'Country', 'name' => 'Thailand' ),
    'offers'           => $seo_offer,
    'hasOfferCatalog'  => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'ราคาบริการรับทำ SEO',
        'itemListElement' => array( $seo_offer ),
    ),
    'availableChannel' => array(
        '@type'             => 'ServiceChannel',
        'serviceUrl'        => home_url( '/#contact' ),
        'availableLanguage' => array( 'th', 'en' ),
    ),
) );
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $services_url ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำ SEO', 'item' => $page_url ),
    ),
) );
$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array( '@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ) );
}
hashbox_jsonld( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    '@id'        => $page_url . '#faq',
    'inLanguage' => 'th',
    'mainEntity' => $faq_entities,
) );

get_footer();
