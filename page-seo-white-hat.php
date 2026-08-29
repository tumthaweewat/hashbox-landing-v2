<?php
/**
 * Template Name: Service: รับทำ SEO สายขาว
 *
 * Child service page of /services/seo/ targeting "รับทำ seo สายขาว" (390/เดือน · KD 0
 * ตามคลัง DataForSEO Labs 2026-08-25 — หน้าเดียวที่ครองอยู่คือ nerdoptimize.com #1).
 * Assign this template to a WP Page at /services/seo/white-hat/ (parent: รับทำ SEO).
 *
 * ราคา: ใช้จุดเริ่มต้นเดียวกับหน้าแม่ (29,900 บาทต่อเดือน) ห้ามตั้งราคาใหม่ที่นี่ —
 * ปรากฏใน hero, answer box, #pricing, FAQ ข้อแรก และ Offer ใน Service JSON-LD
 *
 * ทุกข้อกล่าวอ้างในหน้านี้ต้องตรวจย้อนได้จากระบบของเราเอง (hashbox-seo-stack):
 * ตัวเลข "ผลรวมระดับหน้าพองกว่ายอดจริง" มาจาก docs/DECISIONS.md D14
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url     = get_permalink();
$parent_url   = home_url( '/services/seo/' );
$services_url = home_url( '/services/' );
$desc         = 'รับทำ SEO สายขาวตามแนวทางของ Google — ไม่ซื้อลิงก์ ไม่ปั่นบทความ ไม่ cloaking · แก้ technical ก่อน ต่อด้วยคอนเทนต์ที่ตอบเจตนาและ GEO · ทุกงานตรวจย้อนได้ด้วยข้อมูลอันดับรายวันจากระบบของเราเอง · เริ่มต้น 29,900 บาทต่อเดือน เริ่มจาก SEO Audit ฟรี';

$price_from     = 29900;
$price_from_txt = number_format( $price_from ) . ' บาทต่อเดือน';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปีประสบการณ์ Technical SEO + Performance Engineering · ผ่านโปรเจกต์ SEO migration 50+ เคส · Cert: Google Analytics, Search Console, Cloudflare Performance Engineer';

// FAQ array = single source of truth: drives visible accordion + FAQPage JSON-LD.
$faqs = array(
    array(
        'q' => 'รับทำ SEO สายขาว ราคาเท่าไหร่?',
        'a' => 'ราคาเดียวกับบริการรับทำ SEO ของเรา คือเริ่มต้น 29,900 บาทต่อเดือน (ไม่รวม VAT 7%) เพราะ "สายขาว" ไม่ใช่แพ็กเกจพิเศษ แต่คือวิธีเดียวที่เรารับทำ ราคาจริงขึ้นกับ scope หลัง SEO Audit ฟรี — จำนวนหน้า สภาพ technical ปัจจุบัน ความยากของคีย์เวิร์ด และคู่แข่งในตลาด',
    ),
    array(
        'q' => 'SEO สายขาวใช้เวลานานกว่าสายเทาไหม?',
        'a' => 'ช่วงแรกอาจช้ากว่า เพราะสายเทาซื้อสัญญาณปลอมมาเร่งได้ แต่สายขาวสะสมของจริง — โครงสร้างเว็บที่ Google อ่านได้ คอนเทนต์ที่ตอบคำถาม และลิงก์ที่ได้มาเพราะมีคุณค่า สิ่งเหล่านี้ไม่หายตอน Google อัปเดตอัลกอริทึม ส่วนเว็บที่ technical ถูกต้องตั้งแต่ต้น เราเห็น time-to-rank ในคีย์เวิร์ดความยากต่ำอยู่ที่ 1-2 เดือน คีย์เวิร์ดที่แข่งสูงต้องใช้เวลาสะสม authority ซึ่งเราบอกตรงๆ ตั้งแต่ audit',
    ),
    array(
        'q' => 'เคยจ้างทำ SEO สายเทามาก่อน ย้ายมาสายขาวได้ไหม?',
        'a' => 'ได้ และควรเริ่มจาก audit ลิงก์และคอนเทนต์เดิมก่อน เราตรวจว่ามีลิงก์จาก PBN หรือลิงก์ซื้อที่ควรถอดหรือ disavow ไหม มีหน้าปั่นที่ควรรวมหรือลบไหม และเว็บมี manual action ใน Search Console หรือเปล่า จากนั้นค่อยวางแผนสายขาวบนฐานที่สะอาด การย้ายอาจทำให้อันดับที่มาจากสัญญาณปลอมตกลงก่อน — เราจะบอกให้เห็นภาพนี้ล่วงหน้า',
    ),
    array(
        'q' => 'สายขาวการันตีอันดับ 1 ได้ไหม?',
        'a' => 'ไม่ได้ และไม่มีใครการันตีได้โดยไม่โกหก เพราะไม่มีใครควบคุมอัลกอริทึมของ Google สิ่งที่เรารับประกันคือสองอย่างที่ควบคุมได้: งานทุกชิ้นทำตามแนวทางของ Google และคุณเห็นข้อมูลอันดับรายวันด้วยตัวเองว่าเคลื่อนไปทางไหน',
    ),
    array(
        'q' => 'agency ไหนก็บอกว่าตัวเองสายขาว จะรู้ได้ยังไงว่าจริง?',
        'a' => 'ดูจากสิ่งที่ตรวจย้อนได้ ไม่ใช่คำพูด: ขอรายการงานที่ทำในแต่ละเดือนแบบระบุหน้าและสิ่งที่แก้ ขอดูลิงก์ทุกลิงก์ที่ได้มาพร้อมที่มา และขอข้อมูลอันดับที่คุณเข้าถึงได้เองไม่ใช่ PDF เดือนละครั้ง ของเราคือระบบ track อันดับรายวันที่เก็บข้อมูลดิบทั้งหมดไว้ และรายงานคลิกจากตัวเลขระดับเว็บของ Search Console ซึ่งเป็นตัวเลขเดียวที่ตรงกับที่ Google แสดง',
    ),
    array(
        'q' => 'เริ่มยังไง?',
        'a' => 'เริ่มจากรับ SEO Audit ฟรี — ส่ง URL เว็บมา เราตรวจ technical, คอนเทนต์, ลิงก์เดิม และโอกาสใน AI Overview แล้วนัดคุยผลแบบไม่มีข้อผูกมัด ถ้าตัดสินใจไปต่อ quote จะออกตาม scope จริงของเว็บคุณ',
    ),
);

$hats = array(
    array( 'label' => 'สายขาว', 'title' => 'ทำตามแนวทางของ Google', 'body' => 'แก้ให้เว็บอ่านง่ายและเร็ว เขียนสิ่งที่คนค้นหาต้องการจริง ได้ลิงก์เพราะมีคุณค่า ผลมาช้ากว่าแต่สะสม และไม่หายตอนอัลกอริทึมอัปเดต — วิธีเดียวที่เรารับทำ' ),
    array( 'label' => 'สายเทา', 'title' => 'เร่งด้วยสัญญาณที่ Google ไม่ต้องการ', 'body' => 'ซื้อลิงก์ ใช้ PBN ปั่นบทความจำนวนมาก สลับเนื้อหาหลังติดอันดับ ได้ผลเร็วในช่วงแรก แต่ทุกอัปเดตของ Google คือวันลุ้น และลูกค้ามักรู้ตัวเมื่ออันดับหายทั้งเว็บ' ),
    array( 'label' => 'สายดำ', 'title' => 'หลอกทั้ง Google และผู้ใช้', 'body' => 'cloaking, doorway page, ซ่อนข้อความ, แฮกเว็บคนอื่นเพื่อวางลิงก์ เสี่ยง manual action จนถึงถูกถอดออกจากดัชนีทั้งโดเมน ซึ่งกู้คืนยากกว่าสร้างเว็บใหม่' ),
);

$never = array(
    array( 't' => 'ไม่ซื้อลิงก์ ไม่ใช้ PBN', 'd' => 'ลิงก์ทุกลิงก์ที่ได้มาต้องมีที่มาที่อธิบายได้ — directory ที่เกี่ยวข้อง สื่อ พาร์ทเนอร์ หรือคนอ้างอิงข้อมูลของเราเอง' ),
    array( 't' => 'ไม่ปั่นบทความ AI จำนวนมากโดยไม่ตรวจ', 'd' => 'ใช้ AI ช่วยร่างได้ แต่ทุกบทความต้องมีข้อมูลหรือประสบการณ์จริงที่คนอ่านได้ประโยชน์ และผ่านคนตรวจก่อนเผยแพร่' ),
    array( 't' => 'ไม่ cloaking ไม่ซ่อนข้อความ', 'd' => 'Google กับผู้ใช้ต้องเห็นหน้าเดียวกัน ไม่มีข้อความสีเดียวกับพื้นหลัง ไม่มีเนื้อหาที่โชว์เฉพาะ bot' ),
    array( 't' => 'ไม่ทำ doorway page', 'd' => 'ไม่สร้างหน้า "รับทำเว็บไซต์ + ชื่อจังหวัด" 77 หน้าที่เนื้อหาเหมือนกันหมด ถ้าทำหน้าพื้นที่ ต้องมีข้อมูลเฉพาะพื้นที่นั้นจริง' ),
    array( 't' => 'ไม่ยัดคีย์เวิร์ด', 'd' => 'คีย์เวิร์ดอยู่ในที่ที่มันควรอยู่ — title, หัวข้อ, ย่อหน้าแรก — ที่เหลือคือเขียนให้คนอ่าน' ),
    array( 't' => 'ไม่การันตีอันดับ 1', 'd' => 'ใครการันตีได้ แปลว่ากำลังจะทำสิ่งที่อยู่ในสองแถวข้างบน หรือกำลังโกหก' ),
);

$does = array(
    array( 't' => '1. แก้ technical ก่อนเสมอ', 'd' => 'Core Web Vitals, crawl/index, canonical, redirect, Schema — ถ้า Google อ่านเว็บไม่ออก คอนเทนต์ดีแค่ไหนก็ไม่ถูกนับ นี่คือส่วนที่เห็นผลเร็วที่สุดและ agency ส่วนใหญ่ข้าม' ),
    array( 't' => '2. คอนเทนต์ที่ตอบเจตนาของคำค้น', 'd' => 'ดูก่อนว่าคนค้นคำนี้ต้องการอะไร (ซื้อ เทียบ หรือหาความรู้) แล้วเขียนให้ตรง มี answer block ที่ต้นหน้า และ FAQ ที่ตอบคำถามจริงจากคลังคำค้น ไม่ใช่บทความ 4 ชิ้น/เดือนตามโควตา' ),
    array( 't' => '3. โครงสร้างลิงก์ภายใน', 'd' => 'บทความที่ติดอันดับส่งพลังไปหน้าบริการ หน้าบริการลิงก์กลับไปคำตอบที่ลึกกว่า — ของฟรีที่ทำให้ทั้งเว็บแข็งขึ้นโดยไม่ต้องขอใคร' ),
    array( 't' => '4. GEO / AI Overview', 'd' => 'ทำให้เนื้อหาถูก AI อ้างอิงเวลา Google ตอบเองด้วย AI Overview — เรามีระบบวัดการถูกอ้างอิงรายวันของตัวเอง จึงรู้ว่าอะไรได้ผลกับภาษาไทยจริง' ),
    array( 't' => '5. ลิงก์ที่ได้มาเพราะมีคุณค่า', 'd' => 'ข้อมูล original ที่คนอยากอ้างอิง directory ที่เกี่ยวข้องกับธุรกิจ และการอ้างอิงจากพาร์ทเนอร์ — ช้ากว่าซื้อ แต่ไม่ต้องลุ้นทุกครั้งที่ Google อัปเดต' ),
);

$measure = array(
    array( 't' => 'อันดับรายวันจากระบบของเราเอง', 'd' => 'ไม่ใช่เครื่องมือเช่า ข้อมูลดิบทุกวันเก็บไว้ทั้งหมดและเป็นของคุณ เลิกจ้างแล้วข้อมูลไม่หาย' ),
    array( 't' => 'คลิกจริงจาก Search Console ระดับเว็บ', 'd' => 'เรารายงานตัวเลขที่ Google แสดงจริง ไม่ใช่ผลรวมระดับหน้าที่เราวัดเองแล้วพบว่าพองกว่ายอดจริงได้ถึง 70% ในบางวัน — ตัวเลขสวยแต่ผิดคือสิ่งที่เราไม่ส่งให้ลูกค้า' ),
    array( 't' => 'การถูกอ้างอิงใน AI Overview', 'd' => 'นับเป็นรายคีย์เวิร์ดทุกวัน พร้อมธงบอกว่าวันไหนผู้ให้บริการส่งข้อมูลมาไม่ครบ เพื่อไม่ให้รายงานว่า "ตก" ในวันที่ข้อมูลหาย' ),
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
                    <li><a href="<?php echo esc_url( $parent_url ); ?>">รับทำ SEO</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">รับทำ SEO สายขาว</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">SEO Service · White-hat</span>
            <h1 class="hb-hero__title">รับทำ SEO สายขาว<br><em>ติดจริง อยู่ยาว</em><br>ตรวจย้อนได้ทุกขั้นตอน</h1>
            <p class="hb-hero__sub">SEO สายขาวคือการทำให้เว็บติดอันดับด้วยวิธีที่ Google ต้องการ — ไม่ซื้อลิงก์ ไม่ปั่นบทความ ไม่หลอก bot — ซึ่งเป็นวิธีเดียวที่<a href="<?php echo esc_url( $parent_url ); ?>" style="color:inherit;text-decoration:underline;text-decoration-color:var(--hb-accent-blue,#2563EB);text-underline-offset:0.18em;">บริการรับทำ SEO</a>ของ Hashbox รับทำ เพราะอันดับที่ได้มาจากสัญญาณปลอมหายได้ในอัปเดตเดียว · เริ่มต้น <?php echo esc_html( $price_from_txt ); ?> เริ่มจาก SEO Audit ฟรี</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
                <a href="<?php echo esc_url( $parent_url ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูบริการรับทำ SEO ทั้งหมด</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-1,#18181B);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue,#2563EB);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>รับทำ SEO สายขาว คือบริการทำ SEO ตามแนวทางของ Google ทั้งหมด</strong> — Hashbox แก้โครงสร้าง technical ให้ Google อ่านเว็บได้ถูกต้องก่อน แล้วต่อด้วยคอนเทนต์ที่ตอบเจตนาของคำค้น ลิงก์ภายใน และ GEO เพื่อให้ถูก AI Overview อ้างอิง เราไม่ซื้อลิงก์ ไม่ใช้ PBN ไม่ปั่นบทความ ไม่ cloaking และไม่การันตีอันดับ 1 สิ่งที่คุณได้แทนคือทุกงานตรวจย้อนได้จากข้อมูลอันดับรายวันของระบบเราเอง ราคาเดียวกับบริการรับทำ SEO ปกติ เริ่มต้น <?php echo esc_html( $price_from_txt ); ?> เริ่มจาก SEO Audit ฟรี
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ขาว · เทา · ดำ</span>
            <h2 class="hb-h2">SEO สายขาว สายเทา สายดำ ต่างกันตรงไหน — และใครแบกความเสี่ยง</h2>
            <p class="hb-section__sub">คำว่า "สาย" ในวงการ SEO ไทยคือระดับที่ยอมฝืนแนวทางของ Google ยิ่งเข้มยิ่งเร็ว และยิ่งเข้มยิ่งเป็นเว็บของลูกค้าที่รับผลตอนถูกลงโทษ ไม่ใช่ agency</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $hats as $h ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label"><?php echo esc_html( $h['label'] ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $h['title'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $h['body'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">สิ่งที่เราไม่ทำ</span>
            <h2 class="hb-h2">6 สิ่งที่บริการรับทำ SEO สายขาวของเราไม่ทำ — ต่อให้ลูกค้าขอ</h2>
            <p class="hb-section__sub">ลิสต์นี้คือเส้นแบ่งที่ทำให้คำว่า "สายขาว" มีความหมาย ถ้า agency ที่คุณคุยอยู่ทำข้อใดข้อหนึ่ง เขาไม่ใช่สายขาว ไม่ว่าหน้าเว็บจะเขียนว่าอะไร</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $never as $i => $n ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <span class="hb-bento__label">0<?php echo (int) ( $i + 1 ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $n['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $n['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">แล้วทำอะไร</span>
            <h2 class="hb-h2">SEO สายขาวทำอะไรถึงติดอันดับ — 5 งานที่เราทำจริงทุกเดือน</h2>
            <p class="hb-section__sub">สายขาวไม่ได้แปลว่า "รอเฉยๆ ให้ Google รัก" มันคืองาน technical และคอนเทนต์ที่ทำซ้ำได้ วัดได้ และตรวจย้อนได้ทุกชิ้น — ทั้ง 5 งานคือ 4 เสาของ SEO ที่อธิบายไว้ใน <a href="<?php echo esc_url( home_url( '/seo-thai-guide-2026/' ) ); ?>" style="color:var(--hb-accent-blue,#2563EB);">SEO คืออะไร? คู่มือฉบับ 2026</a></p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $does as $d ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <h3 class="hb-h3"><?php echo esc_html( $d['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $d['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">วัดผล</span>
            <h2 class="hb-h2">เราวัดผลยังไง — ตัวเลขที่ตรวจย้อนได้ ไม่ใช่กราฟสวย</h2>
            <p class="hb-section__sub">ความโปร่งใสคือสิ่งเดียวที่แยกสายขาวจริงออกจากสายขาวในคำโฆษณา เราจึงสร้างระบบวัดผลของตัวเองแทนการเช่าเครื่องมือ และเก็บข้อมูลดิบทั้งหมดไว้ให้ลูกค้า</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $measure as $m ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2">
                    <h3 class="hb-h3"><?php echo esc_html( $m['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $m['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section" id="pricing">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <span class="hb-eyebrow">ราคา</span>
        <h2 class="hb-h2">ราคาเดียวกับบริการรับทำ SEO — เริ่มต้น <?php echo esc_html( $price_from_txt ); ?></h2>
        <p class="hb-lead" style="margin:var(--hb-space-4) auto var(--hb-space-6);">สายขาวไม่ใช่แพ็กเกจพิเศษ แต่คือวิธีเดียวที่เรารับทำ ราคาไม่รวม VAT 7% · quote สุดท้ายออกตาม scope จริงหลัง SEO Audit ฟรี · รายละเอียดขอบเขตงานและสิ่งที่อยู่ใน audit อยู่ที่หน้า<a href="<?php echo esc_url( $parent_url ); ?>" style="color:var(--hb-accent-blue,#2563EB);">บริการรับทำ SEO</a></p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
    </div>
</section>

<section class="hb-section hb-section--surface">
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

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อยเรื่องรับทำ SEO สายขาว</h2>
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

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มจาก SEO Audit ฟรี — รวมตรวจลิงก์และคอนเทนต์เดิม</h2>
        <p class="hb-lead" style="margin:var(--hb-space-4) auto var(--hb-space-6);">ส่ง URL มา เราตรวจว่าเว็บมีสัญญาณเสี่ยงจากงานสายเทาเดิมไหม technical ติดตรงไหน และคีย์เวิร์ดไหนที่สายขาวจะไปถึงได้ในกี่เดือน แล้วนัดคุยผลแบบไม่มีข้อผูกมัด</p>
        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี</a>
            <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูผลงาน</a>
        </div>
    </div>
</section>

<?php
// ---------- Schemas ----------
$offer = array(
    '@type'              => 'Offer',
    'name'               => 'รับทำ SEO สายขาว (retainer รายเดือน)',
    'priceCurrency'      => 'THB',
    'priceSpecification' => array(
        '@type'                 => 'UnitPriceSpecification',
        'minPrice'              => $price_from,
        'priceCurrency'         => 'THB',
        'unitText'              => 'MONTH',
        'valueAddedTaxIncluded' => false,
    ),
    'description'        => 'เริ่มต้น ' . $price_from_txt . ' ไม่รวม VAT · quote ตาม scope จริงหลัง SEO Audit ฟรี',
    'availability'       => 'https://schema.org/InStock',
    'areaServed'         => 'TH',
);

hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'Service',
    '@id'             => $page_url . '#service',
    'name'            => 'รับทำ SEO สายขาว',
    'description'     => $desc,
    'url'             => $page_url,
    'inLanguage'      => 'th',
    'provider'        => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'      => array( '@type' => 'Country', 'name' => 'Thailand' ),
    'serviceType'     => 'White-hat SEO',
    'category'        => 'SEO',
    'offers'          => $offer,
    'potentialAction' => array(
        '@type'  => 'ContactAction',
        'name'   => 'Request Free SEO Audit',
        'target' => home_url( '/#contact' ),
    ),
    'isRelatedTo'     => array(
        array( '@type' => 'Service', 'name' => 'รับทำ SEO', 'url' => $parent_url ),
    ),
) );

hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $services_url ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำ SEO', 'item' => $parent_url ),
        array( '@type' => 'ListItem', 'position' => 4, 'name' => 'รับทำ SEO สายขาว', 'item' => $page_url ),
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
    'knowsAbout'  => array( 'SEO', 'Technical SEO', 'Core Web Vitals', 'Schema.org', 'Generative Engine Optimization' ),
) );

get_footer();
