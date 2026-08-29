<?php
/**
 * Template Name: Service: รับทำเว็บไซต์ คลินิก
 *
 * Child service page of /services/website-development/ targeting "รับทำเว็บไซต์ คลินิก"
 * (260/เดือน · KD 0 — keyword_suggestions ของ DataForSEO Labs 2026-08-25 ไม่มีหน้าเฉพาะทาง
 * จากเอเจนซี่รายใหญ่ครองอยู่). Assign to a WP Page at /services/website-development/clinic/
 * (parent: SEO-Ready Website).
 *
 * ราคา: ใช้แพ็กเกจของหน้าแม่ (Landing 35,900 · Corporate 80,000 · E-commerce 350,000
 * · Care Plan 15,000-50,000/เดือน) ห้ามตั้งราคาใหม่ · **ไม่มีเคสคลินิกจริงให้อ้าง** —
 * ห้ามแต่งเคส ถ้ามีเคสจริงค่อยเพิ่ม section ผลงาน
 *
 * เรื่องกฎการโฆษณาสถานพยาบาล: หน้านี้บอกแค่ว่ามีกฎและเราจัดโครงสร้างให้ตรวจง่าย
 * ไม่ตีความกฎหมาย (เราไม่ใช่ที่ปรึกษากฎหมาย)
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url     = get_permalink();
$parent_url   = home_url( '/services/website-development/' );
$services_url = home_url( '/services/' );
$seo_url      = home_url( '/services/seo/' );
$desc         = 'รับทำเว็บไซต์คลินิกที่คนไข้ค้นเจอบนมือถือและจองได้ทันที — หน้าบริการต่อหัตถการ โปรไฟล์แพทย์ ระบบนัดผ่าน LINE OA แผนที่และ Google Business Profile โครงสร้าง PDPA และ Schema สำหรับสถานพยาบาล · Lighthouse 95+ · เริ่มต้น 35,900 บาท ประเมิน scope ฟรี';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปีประสบการณ์ Technical SEO + Performance Engineering · ผ่านโปรเจกต์ SEO migration 50+ เคส · Cert: Google Analytics, Search Console, Cloudflare Performance Engineer';

$faqs = array(
    array(
        'q' => 'รับทำเว็บไซต์คลินิก ราคาเท่าไหร่?',
        'a' => 'ใช้แพ็กเกจเดียวกับบริการเว็บไซต์ SEO-Ready ของเรา: เว็บคลินิกหน้าเดียวสำหรับเปิดตัวหรือยิงโฆษณา (Landing Page) เริ่ม 35,900 บาท · เว็บคลินิกเต็มรูปแบบที่มีหน้าบริการ โปรไฟล์แพทย์ ระบบนัด และบทความ (Corporate Site) เริ่ม 80,000 บาท · คลินิกที่ขายคอร์สหรือสินค้าออนไลน์ด้วย (E-commerce) 350,000 บาท ราคาไม่รวม VAT 7% quote สุดท้ายออกตาม scope จริงหลังประเมินฟรี',
    ),
    array(
        'q' => 'ใช้เวลาทำกี่สัปดาห์?',
        'a' => 'เว็บคลินิกเต็มรูปแบบ (5-15 หน้า) ใช้เวลา 4-6 สัปดาห์ รวมการเก็บข้อมูลบริการ ถ่ายทอดโครงสร้าง เขียนเนื้อหา ตรวจ Build Gate กว่า 12 ขั้นตอน และ monitoring 30 วันแรกหลังเปิด ส่วน Landing Page หน้าเดียวเร็วกว่านั้น สิ่งที่มักทำให้ช้าคือรอรูปและข้อมูลแพทย์จากฝั่งคลินิก — เราจะส่งเช็กลิสต์ให้ตั้งแต่วันแรก',
    ),
    array(
        'q' => 'คนไข้จองคิวผ่านเว็บได้ไหม?',
        'a' => 'ได้ ทางที่ใช้จริงในไทยมากที่สุดคือปุ่มไป LINE OA ของคลินิกพร้อมข้อความเริ่มต้นที่ระบุบริการ ควบคู่กับฟอร์มนัดและปุ่มโทรบนมือถือ ถ้าคลินิกใช้ระบบจัดการคิวหรือ HIS อยู่แล้ว เราเชื่อมผ่าน API หรือ webhook ได้ และถ้าอยากตอบคำถามเบื้องต้นอัตโนมัติบน LINE ทีมเรามีบริการ AI chatbot ต่อยอดได้',
    ),
    array(
        'q' => 'เว็บคลินิกต้องระวังเรื่องกฎอะไรบ้าง?',
        'a' => 'สองเรื่องหลัก: ข้อมูลส่วนบุคคลของคนไข้ (PDPA) — ฟอร์มนัดและแชทต้องมี consent และเก็บเท่าที่จำเป็น — และการโฆษณาสถานพยาบาล ซึ่งมีกฎเฉพาะเรื่องข้อความชวนเชื่อ การรับรองผล ราคา และภาพก่อน-หลัง เราจัดโครงสร้างเนื้อหาให้ส่วนที่ต้องตรวจแยกออกมาชัดเจนและทำงานร่วมกับผู้รับผิดชอบด้านกฎหมายของคลินิก เราเป็นทีมสร้างเว็บ ไม่ใช่ที่ปรึกษากฎหมาย จึงไม่ตีความกฎแทนคลินิก',
    ),
    array(
        'q' => 'มีเว็บคลินิกอยู่แล้ว ย้ายหรือปรับปรุงได้ไหม?',
        'a' => 'ได้ เราตรวจเว็บเดิมก่อนว่าอะไรควรเก็บ (URL ที่ติดอันดับ เนื้อหาที่ดี) และอะไรคือตัวถ่วง (โหลดช้า โครงสร้างพัง ไม่มี Schema) ถ้าย้ายเรารักษา URL เดิมและทำ 301 redirect ครบทุกหน้า เพื่อไม่ให้อันดับที่สะสมมาหาย',
    ),
    array(
        'q' => 'ทำเว็บแล้วทำ SEO ต่อได้ไหม?',
        'a' => 'โครงสร้าง SEO ระดับ technical ติดมากับเว็บทุกโปรเจกต์ — semantic HTML, Schema, Core Web Vitals เขียว, sitemap และ Google Business Profile ที่เชื่อมกับเว็บ ส่วนงาน SEO ต่อเนื่อง (คีย์เวิร์ดตามบริการและพื้นที่ บทความให้ความรู้ และการวัดผลรายวันด้วยระบบของเราเอง) เป็นบริการรับทำ SEO แยกเริ่มต้น 29,900 บาทต่อเดือน ต่อยอดได้ทันทีเพราะฐานเว็บพร้อมตั้งแต่วันแรก',
    ),
);

$diffs = array(
    array( 'label' => 'ค้นบนมือถือ', 'title' => 'คนไข้ค้น "บริการ + ย่าน" แล้วเลือกจากแผนที่', 'body' => 'การค้นหาคลินิกส่วนใหญ่เกิดบนมือถือและ Google มักโชว์แพ็กแผนที่ก่อนผลปกติ เว็บคลินิกจึงต้องเชื่อมกับ Google Business Profile ให้ชื่อ ที่อยู่ เบอร์ และเวลาทำการตรงกันทุกที่ และโหลดเร็วบนมือถือจริง ไม่ใช่แค่บนคอมของทีมทำเว็บ' ),
    array( 'label' => 'PDPA', 'title' => 'ข้อมูลคนไข้คือข้อมูลอ่อนไหว', 'body' => 'ฟอร์มนัด แชท และประวัติที่ส่งผ่านเว็บอยู่ในขอบเขต PDPA เราออกแบบให้เก็บเท่าที่จำเป็น มี consent ที่ตรวจได้ และเลือกที่เก็บข้อมูลที่อธิบายได้ว่าอยู่ที่ไหน' ),
    array( 'label' => 'กฎโฆษณา', 'title' => 'สถานพยาบาลมีกฎการโฆษณาเฉพาะ', 'body' => 'ข้อความรับรองผล ราคา โปรโมชัน และภาพก่อน-หลัง มีข้อกำหนดที่ต้องผ่านการตรวจ เราแยกโครงสร้างเนื้อหาส่วนที่ต้องขออนุญาตออกจากส่วนให้ความรู้ เพื่อให้คลินิกและผู้รับผิดชอบด้านกฎหมายตรวจง่ายและแก้ได้โดยไม่ต้องรื้อทั้งเว็บ' ),
    array( 'label' => 'ความน่าเชื่อถือ', 'title' => 'คนไข้ตัดสินใจจากแพทย์ ไม่ใช่จากเทมเพลต', 'body' => 'โปรไฟล์แพทย์พร้อมคุณวุฒิ เลขใบอนุญาต บริการที่ดูแล และเวลาออกตรวจ คือหน้าที่คนไข้เปิดบ่อยที่สุด เราทำเป็นหน้าเฉพาะพร้อม Schema แบบ Physician ให้ Google และ AI เข้าใจว่าใครเป็นใคร' ),
);

$includes = array(
    array( 't' => 'หน้าบริการต่อหัตถการ', 'd' => 'บริการละหน้า ไม่ใช่ลิสต์รวม — เพื่อให้ติดคำค้นเฉพาะและตอบคำถามที่คนไข้มีก่อนจอง' ),
    array( 't' => 'โปรไฟล์แพทย์', 'd' => 'คุณวุฒิ ใบอนุญาต ความเชี่ยวชาญ ตารางออกตรวจ พร้อม Schema Physician' ),
    array( 't' => 'ระบบนัดที่คนไข้ใช้จริง', 'd' => 'ปุ่มไป LINE OA พร้อมข้อความเริ่มต้น ฟอร์มนัด และปุ่มโทรบนมือถือ เชื่อมระบบคิวเดิมได้' ),
    array( 't' => 'แผนที่ + Google Business Profile', 'd' => 'ชื่อ ที่อยู่ เบอร์ เวลาทำการตรงกันทั้งเว็บและ GBP เพื่อขึ้นแพ็กแผนที่' ),
    array( 't' => 'Schema สำหรับสถานพยาบาล', 'd' => 'MedicalClinic / LocalBusiness, Physician, FAQPage และ Service ครบตามหน้า' ),
    array( 't' => 'บทความให้ความรู้', 'd' => 'โครงสร้างบล็อกที่ตอบคำถามก่อนตัดสินใจ และลิงก์ภายในส่งคนไข้ไปหน้าบริการ' ),
    array( 't' => 'PDPA consent + cookie', 'd' => 'ฟอร์มและแชทมี consent ที่ตรวจได้ นโยบายความเป็นส่วนตัวที่อ่านออก' ),
    array( 't' => 'Lighthouse 95+ บนมือถือ', 'd' => 'Build Gate กว่า 12 ขั้นตอนเหมือนทุกโปรเจกต์ SEO-Ready — เร็วจริงในเครือข่ายมือถือ ไม่ใช่แค่บน Wi-Fi ออฟฟิศ' ),
);

$local = array(
    array( 't' => 'GBP คือหน้าแรกจริงของคลินิก', 'd' => 'คนไข้จำนวนมากไม่เคยเข้าเว็บ — เขาเห็นแผนที่ รีวิว เบอร์โทร แล้วโทรเลย เว็บมีหน้าที่ทำให้ GBP น่าเชื่อถือขึ้นและรับคนที่อยากรู้มากกว่านั้น' ),
    array( 't' => 'หน้าเดียวต่อบริการ ต่อพื้นที่ที่มีจริง', 'd' => 'ถ้ามีสาขาจริงในหลายเขต ทำหน้าละสาขาพร้อมข้อมูลเฉพาะสาขา — แต่ไม่ทำหน้าพื้นที่ปลอม 50 หน้าที่เนื้อหาเหมือนกัน เพราะ Google จัดเป็น doorway page' ),
    array( 't' => 'รีวิวและการตอบรีวิว', 'd' => 'รีวิวบน GBP คือสัญญาณอันดับและสัญญาณความเชื่อใจพร้อมกัน เว็บช่วยได้ด้วยการลิงก์ไปเขียนรีวิวและโชว์รีวิวที่ตอบแล้วอย่างสุภาพตามกฎ' ),
);

$pricing = array(
    array( 'tier' => 'Landing Page', 'price' => 35900, 'fit' => 'เปิดตัวคลินิก / บริการเดียว / ยิงโฆษณา', 'pages' => '1 หน้า', 'time' => '2-3 สัปดาห์' ),
    array( 'tier' => 'Corporate Site', 'price' => 80000, 'fit' => 'เว็บคลินิกเต็มรูปแบบ หลายบริการ หลายแพทย์', 'pages' => '5-15 หน้า', 'time' => '4-6 สัปดาห์' ),
    array( 'tier' => 'E-commerce', 'price' => 350000, 'fit' => 'คลินิกที่ขายคอร์ส/สินค้าออนไลน์', 'pages' => 'ตาม scope', 'time' => '8-12 สัปดาห์' ),
);
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
                    <li><a href="<?php echo esc_url( $services_url ); ?>">Services</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li><a href="<?php echo esc_url( $parent_url ); ?>">รับทำเว็บไซต์ SEO-Ready</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">รับทำเว็บไซต์ คลินิก</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Clinic Website · SEO-Ready</span>
            <h1 class="hb-hero__title">รับทำเว็บไซต์คลินิก<br><em>ที่คนไข้ค้นเจอบนมือถือ</em><br>และจองได้ทันที</h1>
            <p class="hb-hero__sub">เว็บคลินิกไม่ใช่เว็บบริษัทที่เปลี่ยนสี — คนไข้ค้นจากมือถือ เลือกจากแผนที่ ตัดสินใจจากแพทย์ และข้อมูลที่กรอกคือข้อมูลอ่อนไหว เราสร้างเว็บคลินิกบนมาตรฐาน<a href="<?php echo esc_url( $parent_url ); ?>" style="color:inherit;text-decoration:underline;text-decoration-color:var(--hb-accent-blue,#2563EB);text-underline-offset:0.18em;">รับทำเว็บไซต์ SEO-Ready</a>เดียวกับทุกโปรเจกต์ เพิ่มสิ่งที่คลินิกต้องมีโดยเฉพาะ · เริ่มต้น 35,900 บาท ประเมิน scope ฟรี</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/website-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ประเมินโปรเจกต์ฟรี</a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงาน</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-1,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox รับทำเว็บไซต์คลินิกแบบ SEO-Ready</strong> — หน้าบริการต่อหัตถการ โปรไฟล์แพทย์พร้อม Schema ระบบนัดผ่าน LINE OA/ฟอร์ม/โทร แผนที่ที่เชื่อมกับ Google Business Profile โครงสร้าง PDPA สำหรับข้อมูลคนไข้ และเนื้อหาที่แยกส่วนที่ต้องผ่านกฎการโฆษณาสถานพยาบาลไว้ชัดเจน ทุกโปรเจกต์ผ่าน Build Gate กว่า 12 ขั้นตอนและ Lighthouse 95+ บนมือถือ แพ็กเกจเริ่ม 35,900 บาท (หน้าเดียว) และ 80,000 บาท (เว็บคลินิกเต็มรูปแบบ) เริ่มจากประเมิน scope ฟรี
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ต่างตรงไหน</span>
            <h2 class="hb-h2">เว็บไซต์คลินิกต่างจากเว็บทั่วไป 4 ข้อ — และทำไมเทมเพลตสำเร็จรูปถึงไม่พอ</h2>
            <p class="hb-section__sub">เทมเพลต "เว็บคลินิก" ส่วนใหญ่คือเว็บบริษัทที่เปลี่ยนรูปเป็นหมอ สิ่งที่ขาดคือ 4 เรื่องที่ตัดสินว่าคนไข้จะเจอ จะเชื่อ และจะจองหรือเปล่า</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $diffs as $d ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label"><?php echo esc_html( $d['label'] ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $d['title'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $d['body'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">สิ่งที่อยู่ในเว็บ</span>
            <h2 class="hb-h2">สิ่งที่อยู่ในเว็บไซต์คลินิกของเราทุกโปรเจกต์</h2>
            <p class="hb-section__sub">ทั้งหมดนี้คือมาตรฐาน ไม่ใช่ add-on — เพราะเว็บคลินิกที่ขาดข้อใดข้อหนึ่งคือเว็บที่คนไข้เจอแล้วไปจองที่อื่น</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $includes as $i => $it ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label">0<?php echo (int) ( $i + 1 ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $it['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $it['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Local SEO</span>
            <h2 class="hb-h2">Local SEO ของคลินิก: ให้ Google พาคนไข้ในย่านมาหาคุณ</h2>
            <p class="hb-section__sub">คำค้นของคนไข้มีพื้นที่ติดมาเสมอ — "คลินิก + ย่าน" หรือ "บริการ + ใกล้ฉัน" — เว็บกับ Google Business Profile ต้องทำงานเป็นชุดเดียวกัน</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $local as $l ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <h3 class="hb-h3"><?php echo esc_html( $l['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $l['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา</span>
            <h2 class="hb-h2">แพ็กเกจเว็บไซต์คลินิก (ใช้ร่วมกับบริการ SEO-Ready Website)</h2>
            <p class="hb-section__sub">ราคาไม่รวม VAT 7% · quote สุดท้ายออกตาม scope จริง — จำนวนบริการ จำนวนแพทย์ ระบบนัดที่ต้องเชื่อม และการย้ายข้อมูล</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $pricing as $p ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label"><?php echo esc_html( $p['pages'] ); ?> · <?php echo esc_html( $p['time'] ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $p['tier'] ); ?></h3>
                    <p class="hb-lead" style="margin-top:var(--hb-space-2);">เริ่มต้น <?php echo esc_html( number_format( $p['price'] ) ); ?> บาท</p>
                    <p class="hb-body" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $p['fit'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);text-align:center;">ดูแลต่อเนื่องหลังเปิด: Care Plan รายเดือน 15,000-50,000 บาท (updates, monitoring, แก้เนื้อหา, รายงาน) · งาน SEO ต่อเนื่องดูที่<a href="<?php echo esc_url( $seo_url ); ?>" style="color:var(--hb-accent-blue,#2563EB);">บริการรับทำ SEO</a></p>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Author / Team</span>
            <h2 class="hb-h2">ทีมที่รับผิดชอบโปรเจกต์</h2>
        </div>
        <div class="hb-card" style="padding:var(--hb-space-6);">
            <h3 class="hb-h3" style="margin:0;"><?php echo esc_html( $author_name ); ?></h3>
            <p class="hb-body" style="margin-top:var(--hb-space-2);"><?php echo esc_html( $author_role ); ?></p>
            <p class="hb-body" style="margin-top:var(--hb-space-3);"><?php echo esc_html( $author_bio ); ?></p>
            <a href="<?php echo esc_url( $author_linkedin ); ?>" rel="noopener author" target="_blank" style="display:inline-block;margin-top:var(--hb-space-3);color:var(--hb-accent-blue,#2563EB);">LinkedIn →</a>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อยเรื่องรับทำเว็บไซต์คลินิก</h2>
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
        <h2 class="hb-h2">เริ่มจากประเมิน scope ฟรี — หรือส่งเว็บคลินิกเดิมมาให้ตรวจ</h2>
        <p class="hb-lead" style="margin:var(--hb-space-4) auto var(--hb-space-6);">บอกเราว่าคลินิกมีบริการอะไร แพทย์กี่ท่าน อยากให้คนไข้จองทางไหน แล้วเราตีขอบเขตกับราคาให้ชัดก่อนเริ่ม ถ้ามีเว็บอยู่แล้วส่ง URL มา เราตรวจความเร็ว โครงสร้าง SEO และความพร้อมสำหรับแผนที่ให้ฟรี</p>
        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/website-audit/' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ประเมินโปรเจกต์ฟรี</a>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">คุยกับทีม</a>
        </div>
    </div>
</section>

<?php
// ---------- Schemas ----------
$offer_catalog = array();
foreach ( $pricing as $p ) {
    $offer_catalog[] = array(
        '@type'              => 'Offer',
        'name'               => $p['tier'],
        'price'              => (string) $p['price'],
        'priceCurrency'      => 'THB',
        'priceSpecification' => array(
            '@type'                 => 'PriceSpecification',
            'price'                 => (string) $p['price'],
            'priceCurrency'         => 'THB',
            'valueAddedTaxIncluded' => false,
        ),
        'description'        => $p['fit'] . ' · ' . $p['pages'] . ' · ' . $p['time'],
        'availability'       => 'https://schema.org/InStock',
        'areaServed'         => 'TH',
    );
}
hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'Service',
    '@id'             => $page_url . '#service',
    'name'            => 'รับทำเว็บไซต์คลินิก',
    'description'     => $desc,
    'url'             => $page_url,
    'inLanguage'      => 'th',
    'provider'        => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'      => array( '@type' => 'Country', 'name' => 'Thailand' ),
    'serviceType'     => 'Clinic Website Development',
    'category'        => 'Web Development',
    'audience'        => array( '@type' => 'BusinessAudience', 'audienceType' => 'คลินิกและสถานพยาบาล' ),
    'hasOfferCatalog' => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'แพ็กเกจเว็บไซต์คลินิก (SEO-Ready Website)',
        'itemListElement' => $offer_catalog,
    ),
    'offers'          => $offer_catalog,
    'potentialAction' => array(
        '@type'  => 'ContactAction',
        'name'   => 'Request Free Project Assessment',
        'target' => home_url( '/website-audit/' ),
    ),
    'isRelatedTo'     => array(
        array( '@type' => 'Service', 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'url' => $parent_url ),
        array( '@type' => 'Service', 'name' => 'รับทำ SEO', 'url' => $seo_url ),
    ),
) );

hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $services_url ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'item' => $parent_url ),
        array( '@type' => 'ListItem', 'position' => 4, 'name' => 'รับทำเว็บไซต์ คลินิก', 'item' => $page_url ),
    ),
) );

$faq_entities = array();
foreach ( $faqs as $f ) {
    $faq_entities[] = array(
        '@type'          => 'Question',
        'name'           => $f['q'],
        'acceptedAnswer' => array( '@type' => 'Answer', 'text' => $f['a'] ),
    );
}
hashbox_jsonld( array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    '@id'        => $page_url . '#faq',
    'inLanguage' => 'th',
    'speakable'  => array(
        '@type'       => 'SpeakableSpecification',
        'cssSelector' => array( '.hb-accordion__trigger', '.hb-accordion__content', '#answer .hb-answer-box' ),
    ),
    'mainEntity' => $faq_entities,
) );

hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Person',
    '@id'         => home_url( '/#founder' ),
    'name'        => $author_name,
    'jobTitle'    => $author_role,
    'description' => $author_bio,
    'url'         => $page_url,
    'worksFor'    => array( '@id' => home_url( '/#organization' ) ),
    'sameAs'      => array( $author_linkedin ),
    'knowsAbout'  => array( 'WordPress', 'Next.js', 'Technical SEO', 'Local SEO', 'Core Web Vitals', 'Schema.org', 'PDPA' ),
) );

get_footer();
