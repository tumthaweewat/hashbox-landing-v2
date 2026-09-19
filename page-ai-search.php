<?php
/**
 * Template Name: Service: รับทำ AI Search (GEO)
 *
 * Money page for the "รับทำ ai search / geo / ai seo" cluster. Assign to a
 * WP Page at /services/ai-search/ (parent: /services/). Once the page
 * exists, hashbox_service_catalog_live() shows the row on the homepage,
 * nav, footer, hub and llms.txt automatically.
 *
 * FAQ array = single source for the accordion and FAQPage JSON-LD.
 * Pricing: no standalone number approved yet — page states the two facts
 * that are true (GEO is inside the SEO retainer from 29,900/month; a
 * standalone scope is quoted after the free GEO audit). Brief:
 * content/briefs/ai-search.md
 *
 * @package Hashbox_Studio_V2
 */

get_header();

$page_url     = get_permalink();
$services_url = home_url( '/services/' );
$has_checker  = (bool) get_page_by_path( 'geo-checker', OBJECT, 'page' );
$checker_url  = $has_checker ? home_url( '/geo-checker/' ) : home_url( '/?service=ai-search#contact' );
$desc         = 'รับทำ AEO / GEO และ AI Search พร้อมแก้โครงสร้างเว็บไซต์ เนื้อหา และฟอร์มติดต่อ ประเมินขอบเขตงานก่อนเริ่ม วัดการค้นพบและ Lead แยกตามช่องทาง SEO retainer เริ่ม 29,900 บาท/เดือน';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปี Technical SEO + Performance Engineering · ดูแลงานวิเคราะห์และพัฒนาเว็บไซต์ พร้อมระบบติดตาม AI Overview / AI citation ของ Hashbox';

$faqs = array(
    array( 'q' => 'รับทำ AEO / GEO คืออะไร ต่างจาก SEO อย่างไร?', 'a' => 'AEO เน้นจัดเนื้อหาให้ตอบคำถามได้ชัด ส่วน GEO เน้นเพิ่มโอกาสที่ระบบสร้างคำตอบด้วย AI จะค้นพบและอ้างอิงเนื้อหา ทั้งสองมีงานทับซ้อนกับ SEO เช่น การเข้าถึงเว็บไซต์ ข้อมูลที่ถูกต้อง และเนื้อหาที่ตอบโจทย์ Hashbox ประเมินและลงมือปรับตามปัญหาจริง โดยไม่รับประกันอันดับหรือการถูก AI แนะนำ' ),
    array( 'q' => 'รวมการแก้เว็บไซต์ให้ด้วยหรือไม่?', 'a' => 'รับทั้งประเมินและลงมือแก้เว็บไซต์ โดยระบุหน้าที่แก้ รายการงาน ผู้รับผิดชอบ และเกณฑ์ตรวจรับก่อนเริ่ม เช่น โครงสร้างหน้า การเข้าถึงเนื้อหา ข้อมูลธุรกิจ ฟอร์ม และ Tracking งานสร้างเว็บใหม่ ย้ายระบบ หรือพัฒนาฟังก์ชันขนาดใหญ่เสนอราคาแยก ไม่รวมโดยอัตโนมัติในค่าดูแลรายเดือน' ),
    array( 'q' => 'เหมาะกับธุรกิจแบบไหน?', 'a' => 'เหมาะกับธุรกิจที่มีเว็บไซต์แล้ว ต้องการให้ลูกค้าค้นพบผ่าน Google และ AI Search และมีบริการหรือสินค้าที่ต้องการสร้างการสอบถามชัดเจน หากมีทีม SEO หรือทีมพัฒนาอยู่แล้ว เราสามารถแบ่งขอบเขตงานและวิธีตรวจรับร่วมกัน' ),
    array( 'q' => 'ทำ AEO / GEO ใช้เวลานานแค่ไหน?', 'a' => 'แยกเวลาลงมือแก้เว็บไซต์ออกจากเวลาที่ระบบค้นหาประมวลผลและเลือกอ้างอิง เรากำหนดรอบงานหลังตรวจเว็บและยืนยันสิทธิ์เข้าถึง ผลการค้นพบขึ้นกับหลายปัจจัยและเปลี่ยนแปลงได้ จึงไม่กำหนดวันรับประกันการปรากฏในคำตอบ AI' ),
    array( 'q' => 'Hashbox วัดผลอย่างไร?', 'a' => 'กำหนดคำค้นและชุดคำถามเป้าหมายก่อนเริ่ม บันทึกวันที่ ประเทศ ภาษา แพลตฟอร์ม และ URL ที่ถูกอ้างอิง เปรียบเทียบภายใต้เงื่อนไขเดียวกัน ควบคู่กับ Traffic ฟอร์มที่ส่งสำเร็จ Lead ที่ผ่านการคัดกรอง และโอกาสขายใน CRM โดยแยกข้อมูลทดสอบและช่องทางโฆษณาออกจาก Referral' ),
    array( 'q' => 'บริการราคาเท่าไหร่?', 'a' => 'SEO retainer ที่รวมงาน GEO เริ่มต้น 29,900 บาทต่อเดือน ไม่รวม VAT 7% โดยตกลงจำนวนหน้า เนื้อหา และงานแก้ไขก่อนเริ่ม งาน AEO/GEO แบบโปรเจกต์เสนอราคาหลังประเมินเว็บไซต์ ส่วนการสร้างเว็บใหม่ ย้ายระบบ และฟังก์ชันเพิ่มเติมเสนอราคาแยก' ),
    array( 'q' => 'ต้องมี llms.txt หรือ Schema พิเศษหรือไม่?', 'a' => 'Google ไม่กำหนดไฟล์ AI หรือ Schema พิเศษสำหรับ AI Overviews / AI Mode เราตรวจการเข้าถึง การจัดทำดัชนี และความสอดคล้องของเนื้อหากับข้อมูลโครงสร้างตามความเหมาะสม llms.txt เป็นส่วนเสริมและไม่ได้รับประกันการถูกอ้างอิง' ),
    array( 'q' => 'ซื้อโฆษณาแล้ว AI จะแนะนำแบรนด์ในคำตอบด้วยหรือไม่?', 'a' => 'การซื้อพื้นที่โฆษณากับการถูกอ้างอิงในคำตอบเป็นคนละส่วน ChatGPT Ads ไม่ได้เปลี่ยนคำตอบของ ChatGPT บริการ AEO/GEO นี้เน้นปรับเว็บไซต์และเนื้อหา ไม่ใช่การซื้อสิทธิ์ให้ AI แนะนำแบรนด์' ),
    array( 'q' => 'ก่อนนัดประเมินต้องเตรียมอะไร?', 'a' => 'ส่งเว็บไซต์ บริการหรือสินค้าที่ต้องการขาย และปัญหาที่อยากแก้ หากมีงบประมาณ ช่วงเริ่มงาน หรือทีมที่ดูแลเว็บอยู่แล้ว สามารถแจ้งเพิ่มได้ เรายืนยันขอบเขตงานและราคาให้เห็นก่อนตัดสินใจว่าจ้าง' ),
);

$process = array(
    array( 'ประเมินและจัดลำดับงาน', 'ตรวจการเข้าถึงเว็บ การจัดทำดัชนี หน้าให้บริการ และชุดคำถามของลูกค้า พร้อมบันทึก Baseline และสิ่งที่ควรแก้ก่อน' ),
    array( 'แก้โครงสร้างเว็บไซต์', 'ลงมือปรับตามขอบเขตที่ตกลง เช่น robots / noindex / canonical, internal links, การแสดงเนื้อหา และ Schema ที่ตรงกับข้อมูลบนหน้า' ),
    array( 'ปรับเนื้อหาที่ช่วยตัดสินใจ', 'ทำหน้าบริการ ราคา ขอบเขตงาน คำถามที่พบบ่อย และหลักฐานจากงานจริงให้ชัดเจน โดยใช้ข้อมูลที่ธุรกิจยืนยันได้' ),
    array( 'ตรวจข้อมูลธุรกิจภายนอก', 'ตรวจความสอดคล้องของชื่อธุรกิจ บริการ และข้อมูลติดต่อในช่องทางที่เกี่ยวข้อง วางแผนแหล่งเผยแพร่ตามความเหมาะสม ไม่รับประกันว่าจะถูก AI เลือกอ้างอิง' ),
    array( 'ตรวจรับและวัดผล', 'ทดสอบหน้าที่แก้ ฟอร์ม และเหตุการณ์ส่งสำเร็จ ติดตามการค้นพบ แหล่งอ้างอิง และการสอบถาม แยกผล Referral กับโฆษณาในรายงาน' ),
);

$platforms = array(
    array( 'Google AI Overviews / AI Mode', 'ตรวจพื้นฐาน SEO การจัดทำดัชนี และสิทธิ์แสดง snippet พร้อมดูแหล่งอ้างอิงของคำค้นเป้าหมาย ไม่มีไฟล์หรือ Schema พิเศษที่รับประกันการปรากฏ' ),
    array( 'ChatGPT Search', 'ตรวจการเข้าถึงเนื้อหาเพื่อการค้นหาและแหล่งอ้างอิงที่พบจากชุดคำถามทดสอบ แยกการอนุญาตเพื่อค้นหาออกจากการฝึกโมเดล' ),
    array( 'Perplexity', 'ตรวจคำตอบและลิงก์อ้างอิงในรอบทดสอบ เทียบกับหน้าให้บริการและข้อมูลที่ลูกค้าต้องใช้ตัดสินใจ' ),
    array( 'Gemini', 'บันทึกว่าคำตอบในรอบทดสอบกล่าวถึงแบรนด์หรือมีลิงก์อ้างอิงหรือไม่ โดยไม่ถือว่าผลเหมือนกับ Google AI Overviews' ),
    array( 'Claude', 'ตรวจในเงื่อนไขที่มีการค้นเว็บและบันทึกแหล่งอ้างอิง ผลแต่ละรอบอาจต่างกันและไม่ใช่การรับประกันการค้นพบของผู้ใช้ทุกคน' ),
);

$kpis = array(
    array( 'AI Visibility', 'แบรนด์ปรากฏในคำตอบกี่ % ของ prompt ชุดเดียวกัน แยกตาม AI' ),
    array( 'Brand Mentions', 'จำนวนครั้งที่ AI เอ่ยชื่อแบรนด์ — เอ่ยถึง / อ้างอิงลิงก์' ),
    array( 'AI Overview Citations', 'คีย์เวิร์ดเป้าหมายที่หน้าเว็บคุณถูก AI Overview อ้างอิง อัปเดตรายวัน' ),
    array( 'AI Share of Voice', 'สัดส่วนการถูกอ้างอิงของคุณเทียบคู่แข่งในคำเดียวกัน' ),
    array( 'แหล่งที่ AI อ้างอิง', 'โดเมนไหนถูก AI ใช้แทนคุณ — บอกว่าต้องไปอยู่ที่ไหน' ),
    array( 'Traffic → Lead', 'แยก Referral กับโฆษณา ตัดข้อมูลทดสอบ และติดตามฟอร์มสำเร็จ นัดหมาย และโอกาสขายใน CRM' ),
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
                    <li aria-current="page">รับทำ AI Search</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">AI Search · GEO · AEO</span>
            <h1 class="hb-hero__title">รับทำ AEO / GEO<br><em>พร้อมปรับเว็บไซต์</em><br>ให้ค้นพบผ่าน Google และ AI Search</h1>
            <p class="hb-hero__sub">Hashbox ช่วยธุรกิจที่มีเว็บไซต์แล้ว ประเมินช่องว่าง SEO + AI Search และลงมือแก้โครงสร้างเว็บ เนื้อหา และทางติดต่อ ตามขอบเขตที่ตกลง พร้อมวัดการค้นพบและการสอบถามที่เกิดขึ้นจริง</p>
            <p class="hb-body">เหมาะกับเจ้าของธุรกิจและทีมการตลาดที่ต้องการทีมวิเคราะห์และพัฒนาเว็บไซต์ร่วมกัน</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/?service=ai-search#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">นัดประเมิน SEO + AI Search</a>
                <?php if ( $has_checker ) : ?>
                <a href="<?php echo esc_url( $checker_url ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">เช็คเว็บด้วย GEO Checker</a>
                <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">อ่าน GEO คืออะไร</a>
                <?php endif; ?>
            </div>
            <p class="hb-body" style="margin-top:var(--hb-space-5);">SEO retainer เริ่ม 29,900 บาท/เดือน ไม่รวม VAT 7% · งานสร้างเว็บใหม่หรือพัฒนาระบบเสนอราคาแยก</p>
            <p class="hb-hero__sub" lang="en" style="margin-top:var(--hb-space-5);font-size:var(--hb-text-sm);">Read this page in English: <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search optimization (GEO) in Bangkok</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>AEO/GEO คือการปรับเว็บไซต์และข้อมูลธุรกิจให้ระบบค้นหาเข้าถึงและเข้าใจได้ชัด เพิ่มโอกาสถูกนำไปอ้างอิงในคำตอบ</strong> — เราเริ่มจากประเมิน ลงมือแก้ตามขอบเขต แล้ววัดผลต่อถึงการติดต่อ การปรากฏในคำตอบ AI เปลี่ยนได้และไม่สามารถรับประกันผล
            </p>
        </div>
    </div>
</section>

<section class="hb-section" id="implementation">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ขอบเขตงานที่จับต้องได้</span>
            <h2 class="hb-h2">ประเมิน พร้อมลงมือแก้เว็บไซต์</h2>
            <p class="hb-body">เลือกจุดเริ่มต้นตามสภาพเว็บและทีมที่คุณมี</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h3">มีเว็บ แต่ยังค้นพบยาก</h3>
                <p class="hb-body">ตรวจหน้าบริการและปัญหาทางเทคนิค พร้อมรายการแก้ไขที่จัดลำดับตามเป้าหมายธุรกิจ</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h3">มีรายงาน แต่ขาดทีมแก้เว็บ</h3>
                <p class="hb-body">ทีมพัฒนาช่วยลงมือแก้โครงสร้าง เนื้อหา และฟอร์ม พร้อมทดสอบและตรวจรับงานที่ตกลงกัน</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h3">อยากรู้ว่าคนเข้าแล้วติดต่อไหม</h3>
                <p class="hb-body">เชื่อมข้อมูลช่องทางเข้าเว็บกับฟอร์มที่ส่งสำเร็จ และติดตามคุณภาพ Lead ใน CRM ตามระบบที่ใช้</p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-5);">ก่อนเริ่มงาน คุณจะเห็นหน้าที่แก้ รายการส่งมอบ และเกณฑ์ตรวจรับในข้อเสนอ</p>
    </div>
</section>

<section class="hb-section hb-section--surface" id="process">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">กระบวนการ</span>
            <h2 class="hb-h2">บริการรับทำ AI Search ของเราทำอะไรบ้าง — 5 ขั้นตอน</h2>
            <p class="hb-section__sub">กำหนด Baseline และขอบเขตงานก่อนเริ่ม แล้วตรวจผลหลังแก้เว็บไซต์</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $process as $i => $p ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2<?php echo 0 === $i ? ' hb-bento__cell--feature' : ''; ?>">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $p[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $p[1] ); ?></p>
            </div>
            <?php endforeach; ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">+</span>
                <h3 class="hb-h3">ทำร่วมกับ SEO และเว็บ</h3>
                <p class="hb-body">งานนี้ทำร่วมกับ <a href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>">บริการรับทำ SEO</a> และ <a href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>">บริการพัฒนาเว็บไซต์</a></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section" id="platforms">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ครอบคลุม</span>
            <h2 class="hb-h2">เลือกแพลตฟอร์มและชุดคำถามให้ตรงกับลูกค้าของคุณ</h2>
        </div>
        <div class="hb-bento">
            <?php foreach ( $platforms as $p ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h3"><?php echo esc_html( $p[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $p[1] ); ?></p>
            </div>
            <?php endforeach; ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <h3 class="hb-h3">เริ่มจากเช็คเว็บของคุณ</h3>
                <p class="hb-body"><?php if ( $has_checker ) : ?>ใส่ URL ใน <a href="<?php echo esc_url( $checker_url ); ?>">GEO Readiness Checker</a> เพื่อดูรายการตรวจความพร้อมทางเทคนิคเบื้องต้น ฟรี ไม่ต้องลงทะเบียน คะแนนไม่ใช่โอกาสถูก AI อ้างอิง<?php else : ?>ส่ง URL มาที่ฟอร์มด้านล่าง เราตรวจให้ว่าหน้าไหนพร้อมถูก AI อ้างอิง และตอนนี้ AI ดึงใครแทนคุณ<?php endif; ?></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="measure">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">วิธีวัดผล</span>
            <h2 class="hb-h2">Hashbox วัดผล AI Search อย่างไร — 6 ตัวชี้วัด</h2>
            <p class="hb-section__sub">ดูการกล่าวถึงและลิงก์อ้างอิงควบคู่กับการสอบถามและโอกาสขาย ไม่ใช้คะแนนความพร้อมแทนผลลัพธ์ธุรกิจ</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $kpis as $i => $k ) : ?>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h3 class="hb-h3"><?php echo esc_html( $k[0] ); ?></h3>
                <p class="hb-body"><?php echo esc_html( $k[1] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section" id="proof">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">หลักฐานที่ตรวจย้อนหลังได้</span>
            <h2 class="hb-h2">ใช้ข้อมูลพร้อมวันที่ และแยกผลแต่ละช่องทาง</h2>
        </div>
        <ul class="hb-body">
            <li>แยกการเอ่ยชื่อแบรนด์ การมีลิงก์อ้างอิง และการคลิกเข้าเว็บออกจากกัน</li>
            <li>บันทึกชุดคำถาม เงื่อนไขทดสอบ และ URL ต้นทาง เพื่อเทียบผลแต่ละรอบ</li>
            <li>แยก Lead จาก Referral และโฆษณา พร้อมตัดข้อมูลทดสอบก่อนประเมินความคุ้มค่า</li>
        </ul>
        <p class="hb-body">การซื้อโฆษณาไม่ได้ซื้อสิทธิ์ให้ AI แนะนำแบรนด์ในคำตอบ ดู <a href="https://help.openai.com/en/articles/20001047-ads-in-chatgpt">คำอธิบายเรื่องโฆษณาของ OpenAI</a></p>
    </div>
</section>

<section class="hb-section hb-section--surface" id="sample-report">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ตัวอย่างรูปแบบรายงาน</span>
            <h2 class="hb-h2">ดูหลักฐานและสิ่งที่ควรแก้ในรายงานเดียวกัน</h2>
            <p class="hb-section__sub">โครงสร้างตัวอย่างด้านล่างยังไม่ใช่ผลตรวจจริงของลูกค้า ข้อมูลจริงจะระบุชุดคำค้น วันที่ตรวจ และแหล่งอ้างอิงเพื่อย้อนตรวจได้</p>
        </div>
        <dl class="hb-body">
            <dt><strong>คำค้น / Prompt</strong></dt><dd>[คำถามที่ลูกค้าใช้ค้นหาบริการของธุรกิจ]</dd>
            <dt><strong>วันที่และเงื่อนไขตรวจ</strong></dt><dd>[วัน เวลา เขตเวลา ประเทศ ภาษา และแพลตฟอร์ม]</dd>
            <dt><strong>ผลที่พบและแหล่งอ้างอิง</strong></dt><dd>[พบแบรนด์ / ไม่พบ / ไม่แสดงคำตอบ AI] พร้อม [URL ต้นทางและหลักฐานของรอบตรวจ]</dd>
            <dt><strong>สิ่งที่ควรปรับปรุง</strong></dt><dd>[หน้าที่เกี่ยวข้อง ประเด็นที่ขาด และงานที่ควรทำก่อน พร้อมเหตุผล]</dd>
            <dt><strong>การตรวจรอบถัดไป</strong></dt><dd>[ใช้คำถามและเงื่อนไขเดิม เปรียบเทียบผล พร้อมดูการสอบถามที่เกิดขึ้นจริง]</dd>
        </dl>
        <p class="hb-body">การปรากฏในคำตอบ AI เปลี่ยนได้และไม่สามารถรับประกันผลได้ ดู <a href="https://developers.google.com/search/docs/appearance/ai-features">แนวทาง Google Search Central</a></p>
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา</span>
            <h2 class="hb-h2">เลือกดูแลต่อเนื่อง หรือแก้เว็บเป็นโปรเจกต์</h2>
            <p class="hb-section__sub">ประเมินเว็บไซต์ก่อนเสนอราคา เพื่อกำหนดจำนวนหน้า งานเนื้อหา และงานพัฒนาที่เหมาะกับธุรกิจ</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,280px),1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">เริ่มตรงนี้</span>
                <span class="hb-tier__name">รวมใน SEO retainer</span>
                <div class="hb-tier__price">29,900<span class="hb-tier__price-unit">บาทต่อเดือน เริ่มต้น</span></div>
                <p class="hb-caption">GEO / AI Overview optimization เป็นส่วนหนึ่งของ<a href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>">บริการรับทำ SEO</a>อยู่แล้ว</p>
                <ul class="hb-tier__features">
                    <li>Technical SEO และงานแก้เว็บไซต์ตามขอบเขตที่ตกลง</li>
                    <li>ตรวจการเข้าถึงของ crawler ตามการใช้งาน · llms.txt เป็นส่วนเสริม</li>
                    <li>Answer-first content และ FAQ บนหน้าเงิน</li>
                    <li>Track AI Overview ของคีย์เวิร์ดเป้าหมายรายวัน</li>
                    <li>รายงานอันดับ + AI citation ชุดเดียวกัน</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/?service=ai-search#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">นัดประเมิน SEO + AI Search</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">AEO/GEO + ปรับเว็บเป็นโปรเจกต์</h3>
                <p class="hb-body" style="margin:0;"><strong>เหมาะกับ</strong> — ธุรกิจที่ต้องการแก้เว็บเดิมเป็นชุดงาน หรือมีทีม SEO อยู่แล้วและต้องการทีมพัฒนาร่วมงาน</p>
                <p class="hb-body" style="margin:0;"><strong>ราคาขึ้นกับ</strong> — จำนวนหน้า ความซับซ้อนของระบบ งานเนื้อหา และสิทธิ์เข้าถึงที่จำเป็นในการแก้ไข</p>
                <p class="hb-body" style="margin:0;"><strong>สิ่งที่ได้ก่อนตัดสินใจ</strong> — แนวทางแก้ปัญหา รายการส่งมอบ ระยะเวลาดำเนินงาน และราคาสำหรับขอบเขตที่ตกลง</p>
                <p class="hb-body" style="margin:0;color:var(--hb-text-muted);">งานสร้างเว็บใหม่ ย้ายระบบ หรือเพิ่มฟังก์ชันขนาดใหญ่เสนอราคาแยก ค่าดูแลรายเดือนไม่รวมงานพัฒนาไม่จำกัด ราคาไม่รวม VAT 7%</p>
            </div>
        </div>
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
            <h2 class="hb-h2">คำถามที่พบบ่อยเรื่องรับทำ AI Search</h2>
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
    <div class="hb-container hb-container--md">
        <span class="hb-eyebrow">อ่านต่อ</span>
        <h2 class="hb-h2" style="margin-top:var(--hb-space-3);">คู่มือ AI Search จากทีมเรา</h2>
        <ul style="margin-top:var(--hb-space-4);display:grid;gap:var(--hb-space-3);list-style:none;padding:0;">
            <li><a href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>">GEO คืออะไร? Generative Engine Optimization ฉบับ 2026</a> — นิยาม, ต่างจาก SEO ตรงไหน, 5 เทคนิค</li>
            <li><a href="<?php echo esc_url( home_url( '/google-ai-overview-thailand-2026/' ) ); ?>">AI Overview ในไทย: ข้อมูลจริงปี 2026</a> — คำไหนมี AI Overview, ใครถูกอ้างอิง</li>
            <li><a href="<?php echo esc_url( home_url( '/llms-txt-คืออะไร-2026/' ) ); ?>">llms.txt คืออะไร ทำยังไง</a> — ตัวอย่างไฟล์จริงของเรา + สิ่งที่ยังไม่แน่นอน</li>
            <li><a href="<?php echo esc_url( home_url( '/เว็บไซต์รองรับ-ai-search-2026/' ) ); ?>">เว็บไซต์รองรับ AI Search คืออะไร — checklist 12 ข้อ</a> — ตรวจเว็บตัวเองใน 5 นาที</li>
            <li><a href="<?php echo esc_url( home_url( '/schema-markup-thai-guide-2026/' ) ); ?>">Schema Markup สำหรับเว็บไทย</a> — พื้นฐาน entity ที่ AI ต้องการ</li>
            <li><a href="<?php echo esc_url( home_url( '/google-ai-mode-คืออะไร-2026/' ) ); ?>">Google AI Mode คืออะไร ต่างจาก AI Overview ยังไง</a> — timeline ภาษาไทย, query fan-out, วัดผล</li>
            <li><a href="<?php echo esc_url( home_url( '/aeo-คืออะไร-2026/' ) ); ?>">AEO คืออะไร? ต่างจาก SEO และ GEO ตรงไหน</a> — ตารางเทียบ 3 แนวทาง + 7 รูปแบบที่ AI ยกไปตอบ</li>
        </ul>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">ให้ทีมประเมิน AEO/GEO พร้อมงานปรับเว็บไซต์</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่งเว็บไซต์ บริการที่ต้องการขาย และเป้าหมายของคุณ ทีมจะประเมินช่องว่างและขอบเขตงานก่อนเสนอราคา หากมีงบประมาณหรือช่วงเริ่มงาน แจ้งเพิ่มได้</p>
        <a href="<?php echo esc_url( home_url( '/?service=ai-search#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">นัดประเมิน SEO + AI Search &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => $page_url . '#service',
    'name'        => 'รับทำ AEO / GEO พร้อมปรับเว็บไซต์',
    'alternateName' => array( 'AI Search Optimization', 'Generative Engine Optimization', 'AEO' ),
    'serviceType' => 'Generative Engine Optimization',
    'description' => $desc,
    'url'         => $page_url,
    'inLanguage'  => 'th',
    'provider'    => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'  => 'Thailand',
    'audience'    => array( '@type' => 'BusinessAudience', 'audienceType' => 'Thai SMEs and B2B companies' ),
    'hasOfferCatalog' => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'AI Search deliverables',
        'itemListElement' => array(
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'SEO and AI Search assessment' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Scoped website and structured data implementation' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Answer-first content optimisation' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Business information and external source review' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'AI visibility tracking and reporting' ) ),
        ),
    ),
    'isRelatedTo' => array(
        array( '@type' => 'Service', 'name' => 'รับทำ SEO', 'url' => home_url( '/services/seo/' ) ),
        array( '@type' => 'Service', 'name' => 'รับทำเว็บไซต์ SEO-Ready', 'url' => home_url( '/services/website-development/' ) ),
    ),
) );

hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $services_url ),
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำ AI Search (GEO)', 'item' => $page_url ),
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
