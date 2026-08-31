<?php
/**
 * Template Name: Service: รับทำ n8n Automation
 *
 * Thai money page for the "รับทำ n8n" query cluster. Assign this template to a
 * WP Page at /services/n8n-automation/ (parent: /services/).
 *
 * Rank Math: Title=รับทำ n8n Automation วางระบบให้จบเป็นโปรเจกต์ | Hashbox,
 * Description=รับทำ n8n automation เริ่มต้น 29,000 บาท — วางระบบอัตโนมัติให้จบเป็นโปรเจกต์ พร้อมส่งมอบ workflow ที่แก้เองต่อได้ ไม่ผูกขาดกับเรา
 * (ต้องเพิ่ม entry ใน hashbox_page_meta_map() และ hashbox_sync_new_service_pages_rankmath_meta()
 * ให้ตรงกันทั้งสามที่ — ดูคอมเมนต์ที่ functions.php:818)
 *
 * ราคา: จุดเริ่มต้นที่เผยแพร่คือ 29,000 บาท **ต่อโปรเจกต์ ไม่ใช่รายเดือน**
 * (ต่างจาก /services/seo/ ที่เป็น retainer รายเดือน — อย่าลอก unitCode MON มาใช้ที่นี่)
 * ปรากฏใน hero, answer box, ตารางเทียบ, section #pricing, FAQ ข้อแรก และ Offer
 * ใน Service JSON-LD — แก้ต้องแก้ให้ครบทุกจุด
 *
 * เหตุผลที่เปิดราคาทั้งที่คู่แข่งไม่เปิด: วัด SERP ไทยจริง 2026-08-24 แล้วพบว่า
 * ไม่มีเอเจนซี่ไทยเจ้าไหนใน top 10 เปิดราคา n8n เลย (manaosoftware / visionxbrain /
 * triple-t เขียน "ขึ้นอยู่กับความซับซ้อน" เหมือนกันหมด) ตัวเลขเดียวในตลาดคือ ฿300
 * ของ fastwork ซึ่งเป็นราคาฟรีแลนซ์ ไม่ใช่เอเจนซี่ · และมีหลักฐานแล้วว่า AI ตอบคำถาม
 * เชิงราคาด้วยตัวเลขแล้วอ้างเฉพาะหน้าที่มีตัวเลข
 * → hashbox-seo-stack/docs/N8N-PRICING-BENCHMARK-2026-08-24.md
 *
 * ห้ามเขียนว่า data pipeline ของ Hashbox รันบน n8n — มันรันบน PHP script เดียว
 * + GitHub Actions ตั้งแต่ย้ายออกจาก n8n (hashbox-seo-stack D9/D10) เรื่อง "เคยใช้
 * แล้วย้ายออก" คือเนื้อหาจริงบนหน้านี้ อย่าเปลี่ยนเป็น "เราใช้ n8n อยู่"
 *
 * บทความคู่: /n8n-thai-guide-2026/ (publish 2026-08-24) ลิงก์ไป-กลับกันแล้วทั้งสองทาง
 */

get_header();

$page_url     = get_permalink();
$services_url = home_url( '/services/' );
$desc         = 'รับทำ n8n automation เริ่มต้น 29,000 บาท — วางระบบอัตโนมัติให้จบเป็นโปรเจกต์ พร้อมส่งมอบ workflow ที่แก้เองต่อได้ ไม่ผูกขาดกับเรา';

// จุดเริ่มต้นราคาที่เผยแพร่ (ต่อโปรเจกต์ ครั้งเดียว) — ใช้ร่วมกันระหว่างข้อความบนหน้าและ Offer schema.
$price_from     = 29000;
$price_from_txt = number_format( $price_from ) . ' บาท';

$faqs = array(
    array(
        'q' => 'รับทำ n8n ราคาเท่าไหร่?',
        'a' => 'บริการวางระบบ n8n ของ Hashbox เริ่มต้นที่ 29,000 บาทต่อโปรเจกต์ (ไม่ใช่รายเดือน) ครอบคลุมการคุย process จริงของคุณ ออกแบบ workflow ติดตั้งบนเซิร์ฟเวอร์ของคุณเอง ทดสอบกับข้อมูลจริง และส่งมอบพร้อมเอกสารที่ทีมคุณแก้เองต่อได้ ราคาไม่รวม VAT 7% · ราคาจริงขึ้นกับจำนวน workflow จำนวนระบบที่ต้องเชื่อม และความยากของการเชื่อมต่อ — ระบบที่มี API เอกสารดีใช้เวลาต่างจากระบบที่ต้องดึงข้อมูลจากไฟล์ Excel ที่คนกรอกมือ วิธีที่แฟร์ที่สุดคือคุยดู process ก่อนแล้วเสนอราคาตามงานจริง',
    ),
    array(
        'q' => 'n8n ต่างจาก Zapier หรือ Make ยังไง?',
        'a' => 'ต่างกันที่ค่าใช้จ่ายระยะยาวและความเป็นเจ้าของ Zapier กับ Make คิดเงินตามจำนวนงานที่รัน พอปริมาณโตค่าใช้จ่ายโตตาม ส่วน n8n ติดตั้งบนเซิร์ฟเวอร์ของคุณเองได้ จ่ายแค่ค่าเซิร์ฟเวอร์ไม่ว่าจะรันกี่ครั้ง และข้อมูลไม่ออกจากระบบคุณ ข้อแลกเปลี่ยนคือคุณต้องดูแลเซิร์ฟเวอร์เอง (อัปเดต สำรองข้อมูล กู้คืนตอนล่ม) ถ้าปริมาณงานยังน้อยและไม่มีคนดูแลเซิร์ฟเวอร์ Zapier อาจถูกกว่าจริง เราบอกตรงๆ ตั้งแต่คุยครั้งแรกถ้าเคสของคุณเป็นแบบนั้น',
    ),
    array(
        'q' => 'ต้องจ่ายค่า n8n รายเดือนเพิ่มไหม?',
        'a' => 'ถ้าใช้แบบ self-host บนเซิร์ฟเวอร์ของคุณเอง ตัว n8n เองไม่มีค่าไลเซนส์รายเดือน คุณจ่ายแค่ค่าเซิร์ฟเวอร์ ซึ่งเริ่มต้นหลักร้อยบาทต่อเดือนสำหรับงานขนาดเล็ก แต่ฟีเจอร์ระดับองค์กรบางตัวเป็นของแพ็กเกจเสียเงินเท่านั้น — SSO, Projects, Environments (แยก dev/prod), log streaming และการผูกกับ Git ถ้าองค์กรคุณจำเป็นต้องใช้ฟีเจอร์เหล่านี้ เราจะบอกตั้งแต่ตอนคุย scope ไม่ปล่อยให้ไปเจอเองตอนใช้จริง',
    ),
    array(
        'q' => 'ส่งมอบแล้วเราแก้เองต่อได้ไหม หรือต้องจ้างต่อ?',
        'a' => 'แก้เองได้ และเราออกแบบมาให้แก้เองได้ตั้งแต่ต้น workflow ทั้งหมดอยู่บนเซิร์ฟเวอร์ของคุณ ส่งมอบพร้อมไฟล์ JSON ของทุก workflow และเอกสารอธิบายว่าแต่ละ node ทำอะไรและทำไมถึงต่อแบบนั้น n8n เป็น visual editor ทีมที่ไม่ใช่โปรแกรมเมอร์ปรับเงื่อนไขง่ายๆ เองได้ ถ้าอยากให้เราดูแลต่อก็มีค่าดูแลรายเดือนแยก แต่เป็นทางเลือก ไม่ใช่เงื่อนไข',
    ),
    array(
        'q' => 'Hashbox ใช้ n8n เองไหม?',
        'a' => 'เคยใช้ และเลือกย้ายออกในที่สุด — เราวาง n8n workflow สำหรับ data pipeline ด้าน SEO ของตัวเองจนใช้งานได้จริง แล้วพบว่าสำหรับงานที่เป็นตารางเวลาล้วนๆ ไม่มีคนกดปุ่ม การรันสคริปต์ตัวเดียวบน scheduler ธรรมดาถูกกว่าและล้มน้อยกว่าการดูแล n8n ทั้งตัว เราจึงย้ายออก นี่คือเหตุผลที่เราจะบอกตรงๆ ถ้าเคสของคุณไม่ควรใช้ n8n — เราผ่านการตัดสินใจนี้กับระบบของตัวเองมาแล้ว ไม่ได้พูดจากทฤษฎี เขียนเหตุผลเต็มไว้ที่บทความ n8n คืออะไร เหมาะกับงานแบบไหน',
    ),
    array(
        'q' => 'ใช้เวลานานแค่ไหน?',
        'a' => 'โปรเจกต์ขนาดเริ่มต้น (2-3 workflow เชื่อม 2-4 ระบบที่มี API พร้อมใช้) ปกติ 2-4 สัปดาห์นับจากได้สิทธิ์เข้าถึงระบบครบ ตัวแปรที่ทำให้ยืดออกมักไม่ใช่เรื่องเทคนิค แต่เป็นการรอสิทธิ์เข้าถึง API หรือการที่ process จริงยังไม่ชัดว่าใครทำอะไรตอนไหน เราจึงเริ่มจากคุย process ก่อนเสมอ',
    ),
    array(
        'q' => 'เชื่อมกับระบบอะไรได้บ้าง?',
        'a' => 'n8n มี integration สำเร็จรูปหลายร้อยตัว ครอบคลุมของที่ธุรกิจไทยใช้จริงเป็นส่วนใหญ่ — Google Sheets, Gmail, LINE, Slack, HubSpot, Shopify, WooCommerce, ฐานข้อมูล SQL และอื่นๆ ส่วนระบบที่ไม่มี integration สำเร็จรูปก็ยังเชื่อมได้ถ้ามี API ผ่าน HTTP node และเขียน JavaScript แทรกได้เมื่อจำเป็น ระบบที่เชื่อมไม่ได้จริงๆ คือระบบที่ไม่มี API เลย ซึ่งเราจะตรวจให้ตั้งแต่ตอนคุย scope',
    ),
    array(
        'q' => 'ข้อมูลบริษัทปลอดภัยไหม?',
        'a' => 'ปลอดภัยกว่าเครื่องมือ cloud ทั่วไปในแง่ที่ข้อมูลไม่ออกจากเซิร์ฟเวอร์ของคุณ เพราะ n8n ติดตั้งบนเครื่องของคุณเอง เราไม่เก็บสำเนาข้อมูลลูกค้าของคุณไว้ที่ไหน สิทธิ์เข้าถึงระบบต่างๆ ที่ใช้ตอนพัฒนา คุณเพิกถอนได้ทันทีหลังส่งมอบ และเราแนะนำให้ทำแบบนั้น',
    ),
    array(
        'q' => 'เริ่มยังไง?',
        'a' => 'ทักมาคุยผ่านหน้า Contact เล่าให้ฟังว่างานอะไรที่ทีมทำซ้ำทุกวันหรือทุกสัปดาห์ เราคุยกันก่อนว่างานนั้นควรทำเป็นระบบอัตโนมัติจริงไหม บางงานทำแล้วไม่คุ้มเพราะรันเดือนละครั้ง บางงานควรแก้ที่ process ก่อนไม่ใช่เอาเครื่องมือมาครอบ ถ้าคุยแล้วเห็นตรงกันว่าคุ้ม เราถึงเสนอ scope และราคา',
    ),
    array(
        'q' => 'รับทำ AI Automation / AI Workflow ที่ไม่ใช่ n8n ด้วยไหม?',
        'a' => 'รับ — n8n เป็นเครื่องมือหลักเพราะ self-host ได้และทีมลูกค้าแก้เองต่อได้ แต่ถ้าโจทย์ต้องการ LLM เป็นแกน (RAG, agent ที่ตัดสินใจหลายขั้น) หรือต้องเขียนโค้ดเชื่อมระบบเฉพาะ เราทำเป็นโปรเจกต์ AI ภายใต้บริการที่ปรึกษา AI สำหรับธุรกิจ โดยใช้ n8n เป็นตัวเชื่อมเมื่อเหมาะ ราคาเริ่มต้น 60,000 บาทสำหรับ ROI Assessment',
    ),
);

$pains = array(
    array( 't' => 'งานเดิมซ้ำทุกวัน แต่ไม่มีใครมีเวลาทำระบบ', 'd' => 'คัดลอกข้อมูลจากอีเมลไปลงชีต ส่งต่อไลน์ แจ้งทีมบัญชี — วันละ 30 นาที เดือนละ 10 ชั่วโมง แต่ไม่เคยได้คิวขึ้นมาแก้' ),
    array( 't' => 'จ่าย Zapier แพงขึ้นทุกเดือน', 'd' => 'ค่าใช้จ่ายผูกกับจำนวนครั้งที่รัน พอธุรกิจโตค่าเครื่องมือโตตาม ทั้งที่งานยังเป็นงานเดิม' ),
    array( 't' => 'จ้างวางระบบแล้วแก้เองไม่ได้', 'd' => 'ระบบทำงานได้จริง แต่ไม่มีเอกสาร ไม่รู้ว่าอะไรต่อกับอะไร อยากเปลี่ยนเงื่อนไขนิดเดียวก็ต้องจ้างเจ้าเดิมกลับมา' ),
    array( 't' => 'ข้อมูลลูกค้าต้องส่งออกไปเครื่องมือนอก', 'd' => 'ฝ่าย IT หรือฝ่ายกฎหมายไม่สบายใจที่ข้อมูลวิ่งผ่านบริการ cloud ที่ควบคุมไม่ได้' ),
);

$scope_items = array(
    array( 't' => 'คุย process จริงก่อนเขียนอะไร', 'd' => 'ไล่ดูว่าตอนนี้ใครทำอะไรตอนไหน ข้อมูลเดินทางยังไง จุดไหนคอขวดจริง — ก่อนตัดสินใจว่าจะทำ automation หรือควรแก้ process ก่อน' ),
    array( 't' => 'ออกแบบ workflow และจุดเชื่อมต่อ', 'd' => 'ระบุว่าจะเชื่อมระบบไหนบ้าง ข้อมูลไหลทางไหน และเมื่อเกิดข้อผิดพลาดจะให้เกิดอะไรขึ้น' ),
    array( 't' => 'ติดตั้งบนเซิร์ฟเวอร์ของคุณเอง', 'd' => 'n8n รันบนเครื่องของคุณ ข้อมูลไม่ออกนอกระบบ พร้อมตั้งค่าสำรองข้อมูลและการกู้คืน' ),
    array( 't' => 'ทดสอบกับข้อมูลจริง', 'd' => 'ไม่ใช่แค่ "กดแล้วเขียว" แต่ลองกับเคสที่ผิดปกติด้วย — ข้อมูลไม่ครบ ระบบปลายทางล่ม ยิงซ้ำสองรอบ' ),
    array( 't' => 'ส่งมอบพร้อมเอกสารและไฟล์ workflow', 'd' => 'ไฟล์ JSON ของทุก workflow + เอกสารอธิบายว่าแต่ละส่วนทำอะไรและทำไม เพื่อให้ทีมคุณแก้เองต่อได้' ),
    array( 't' => 'สอนทีมให้ดูแลต่อได้', 'd' => 'พาทีมคุณเดินผ่านระบบจริง สอนวิธีดูว่างานไหนรันสำเร็จ งานไหนพัง และแก้เบื้องต้นยังไง' ),
);

$compare = array(
    array( 'ค่าใช้จ่ายเมื่อปริมาณโต', 'Zapier / Make คิดตามจำนวนครั้งที่รัน', 'n8n self-host จ่ายค่าเซิร์ฟเวอร์เท่าเดิม' ),
    array( 'ข้อมูลอยู่ที่ไหน', 'วิ่งผ่านเซิร์ฟเวอร์ของผู้ให้บริการ', 'อยู่บนเซิร์ฟเวอร์ของคุณเอง' ),
    array( 'ส่งมอบอะไร', 'ระบบที่รันได้ แต่ไม่มีเอกสาร', 'ไฟล์ workflow ทุกตัว + เอกสารอธิบายทุก node' ),
    array( 'แก้เองต่อ', 'ต้องจ้างเจ้าเดิมกลับมา', 'ทีมคุณแก้เองได้ผ่าน visual editor' ),
    array( 'ถ้าเคสไม่ควรใช้ n8n', 'ก็ขายอยู่ดี', 'บอกตรงๆ ว่าไม่ควรทำ — เราเคยย้ายระบบตัวเองออกจาก n8n มาแล้ว' ),
    array( 'ราคา', 'ประเมินหลังคุย ไม่เปิดตัวเลข', 'เริ่มต้น 29,000 บาทต่อโปรเจกต์ · quote จริงหลังคุย process' ),
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
                    <li aria-current="page">รับทำ n8n Automation</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">n8n Automation · วางระบบให้จบเป็นโปรเจกต์</span>
            <h1 class="hb-hero__title">รับทำ n8n Automation<br><em>วางระบบให้จบ</em><br>แล้วส่งมอบให้คุณดูแลต่อเอง</h1>
            <p class="hb-hero__sub">เปลี่ยนงานที่ทีมทำซ้ำทุกวันให้เป็นระบบอัตโนมัติที่รันบนเซิร์ฟเวอร์ของคุณเอง ข้อมูลไม่ออกนอกระบบ ไม่มีค่าเครื่องมือที่โตตามปริมาณงาน และส่งมอบพร้อมเอกสารที่ทีมคุณแก้เองต่อได้ — ไม่ใช่ระบบที่ต้องจ้างเรากลับมาทุกครั้งที่อยากเปลี่ยนเงื่อนไข · เริ่มต้น <?php echo esc_html( $price_from_txt ); ?> ต่อโปรเจกต์</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">คุย process ฟรี</a>
                <a href="#pricing" class="hb-btn hb-btn--outline hb-btn--lg">ดูราคา</a>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>Hashbox รับวางระบบ n8n automation เริ่มต้น <?php echo esc_html( $price_from_txt ); ?> ต่อโปรเจกต์</strong> (ไม่ใช่รายเดือน) — คุย process จริงก่อน ออกแบบ workflow ติดตั้งบนเซิร์ฟเวอร์ของคุณเอง ทดสอบกับข้อมูลจริงรวมถึงเคสที่ผิดปกติ แล้วส่งมอบพร้อมไฟล์ workflow ทุกตัวและเอกสารอธิบายทุก node เพื่อให้ทีมคุณแก้เองต่อได้ ถ้าคุยแล้วพบว่าเคสของคุณไม่ควรใช้ n8n เราบอกตรงๆ — เราเคยวาง n8n สำหรับระบบของตัวเองแล้วเลือกย้ายออกมาแล้ว ราคาไม่รวม VAT 7%
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ปัญหาที่เจอบ่อย</span>
            <h2 class="hb-h2">ทำไมงานซ้ำๆ ถึงไม่เคยได้กลายเป็นระบบสักที</h2>
            <p class="hb-section__sub">ไม่ใช่เพราะไม่มีเครื่องมือ — เครื่องมือมีเยอะมาก ปัญหาคือไม่มีใครมีเวลานั่งไล่ว่า process จริงเป็นยังไง และคนที่วางระบบให้มักส่งมอบสิ่งที่แก้เองต่อไม่ได้</p>
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
        <p class="hb-lead" style="margin-top:var(--hb-space-6);text-align:center;">เราออกแบบบริการนี้มาเพื่อแก้ทั้ง 4 ข้อนี้โดยตรง</p>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ขอบเขตบริการ</span>
            <h2 class="hb-h2">บริการรับทำ n8n ของเราครอบคลุมอะไรบ้าง</h2>
            <p class="hb-section__sub">ตั้งแต่คุย process จริง ออกแบบ workflow ติดตั้งบนเซิร์ฟเวอร์ของคุณ ทดสอบกับข้อมูลจริง ไปจนถึงส่งมอบพร้อมเอกสารและสอนทีมให้ดูแลต่อได้เอง</p>
        </div>
        <div class="hb-bento">
            <?php foreach ( $scope_items as $i => $s ) : ?>
                <div class="hb-bento__cell hb-bento__cell--c2<?php echo 0 === $i ? ' hb-bento__cell--feature' : ''; ?>">
                    <span class="hb-bento__label">0<?php echo (int) ( $i + 1 ); ?></span>
                    <h3 class="hb-h3"><?php echo esc_html( $s['t'] ); ?></h3>
                    <p class="hb-body"><?php echo esc_html( $s['d'] ); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="hb-section" id="ai-automation">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">รับวางระบบ n8n + AI Automation</span>
            <h2 class="hb-h2">รับวางระบบ n8n และ AI Automation — เชื่อม LINE OA, CRM, Google Sheet, Notion และ LLM</h2>
            <p class="hb-section__sub">งานที่ลูกค้าให้เราวางระบบบ่อยที่สุด 4 แบบ — ทุกแบบรันบนเซิร์ฟเวอร์ของคุณ ส่งมอบพร้อมไฟล์ workflow และเอกสาร</p>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">LINE OA</span>
                <h3 class="hb-h3">รับข้อความ LINE → คัดกรอง → เข้า CRM / แจ้งทีม</h3>
                <p class="hb-body">ข้อความจากลูกค้าเข้า n8n, ให้ LLM สรุปและติด tag ตามประเภท, สร้าง lead ใน CRM แล้วแจ้งทีมขายใน LINE/Slack — ต่อยอดเป็น <a href="<?php echo esc_url( home_url( '/line-chatbot-ai-guide-2026/' ) ); ?>">LINE Chatbot AI</a> ได้เมื่อพร้อม</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">CRM sync</span>
                <h3 class="hb-h3">ฟอร์มเว็บ · โฆษณา · อีเมล → CRM เดียว</h3>
                <p class="hb-body">Lead จากทุกช่องทางเข้า HubSpot / Pipedrive / Google Sheet ที่เดียว ไม่ต้องคัดลอกมือ พร้อม dedupe และ assign ตามกติกาที่ตกลง</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">Sheet / Notion</span>
                <h3 class="hb-h3">รายงานอัตโนมัติจาก Sheet, Notion, GA4, Search Console</h3>
                <p class="hb-body">ดึงตัวเลขทุกเช้า สรุปเป็นข้อความหรือ dashboard ส่งเข้า LINE/อีเมล — ทีมไม่ต้องเปิด 5 ระบบเพื่อรู้ว่าเมื่อวานเป็นยังไง</p>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">AI Automation</span>
                <h3 class="hb-h3">ใส่ LLM ใน workflow: สรุป จัดหมวด ร่างตอบ</h3>
                <p class="hb-body">OpenAI / Claude / Gemini ใน n8n node — อ่านอีเมลหรือเอกสารแล้วสรุป, จัดหมวดคำร้อง, ร่างคำตอบให้คนตรวจก่อนส่ง ถ้าโจทย์ใหญ่กว่า workflow ดู<a href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>">บริการที่ปรึกษา AI สำหรับธุรกิจ</a></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ความต่าง</span>
            <h2 class="hb-h2">เราเคยใช้ n8n เอง แล้วเลือกย้ายออก</h2>
            <p class="hb-section__sub">Hashbox วาง n8n workflow สำหรับ data pipeline ด้าน SEO ของตัวเองจนใช้งานได้จริง แล้วพบว่าสำหรับงานที่เป็นตารางเวลาล้วนๆ ไม่มีคนกดปุ่ม การรันสคริปต์ตัวเดียวบน scheduler ธรรมดาถูกกว่าและล้มน้อยกว่าการดูแล n8n ทั้งตัว เราจึงย้ายออก</p>
        </div>
        <p class="hb-body">เราเล่าเรื่องนี้เพราะมันเป็นเหตุผลที่คุณควรเชื่อเวลาเราบอกว่า <strong>"เคสนี้ไม่ควรใช้ n8n"</strong> — เราไม่ได้พูดจากทฤษฎี แต่เคยตัดสินใจแบบนั้นกับระบบของตัวเองมาแล้ว และยอมทิ้งงานที่ทำไปแล้ว</p>
        <p class="hb-body">เหตุผลเต็มๆ ว่าตัดสินใจยังไงและอะไรคือตัวชี้ขาด เขียนไว้ที่ <a href="<?php echo esc_url( home_url( '/n8n-thai-guide-2026/' ) ); ?>">n8n คืออะไร? เหมาะกับงานแบบไหน</a> — บทความเดียวกันนี้บอกด้วยว่า n8n ฟรีแค่ไหนจริงๆ และต้องใช้เครื่องแบบไหนถึงจะรันได้</p>
        <p class="hb-body">n8n เหมาะมากกับงานที่มีคนเกี่ยวข้อง มีเงื่อนไขแตกแขนง ต้องต่อหลายระบบ และคนที่ไม่ใช่โปรแกรมเมอร์ต้องเข้าไปปรับเองได้ ส่วนงานที่รันตามเวลาล้วนๆ ตรรกะตรงไปตรงมา และมีคนเขียนโค้ดดูแลอยู่แล้ว การเขียนสคริปต์ตรงๆ มักจบกว่า <strong>ความต่างของสองแบบนี้คือสิ่งที่เราคุยกับคุณก่อนเสนอราคา</strong></p>
        <div style="overflow-x:auto;margin-top:var(--hb-space-6);">
            <table style="width:100%;border-collapse:collapse;font-size:var(--hb-text-sm);min-width:560px;">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text-muted);font-weight:600;">หัวข้อ</th>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-text-muted);font-weight:600;">แบบที่เจอทั่วไป</th>
                        <th scope="col" style="text-align:left;padding:var(--hb-space-3) var(--hb-space-4);border-bottom:1px solid var(--hb-border);color:var(--hb-accent-blue-soft,#818CF8);font-weight:600;">Hashbox</th>
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
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา</span>
            <h2 class="hb-h2">ราคารับทำ n8n เริ่มต้น <?php echo esc_html( $price_from_txt ); ?> ต่อโปรเจกต์</h2>
            <p class="hb-section__sub">คิดเป็นโปรเจกต์ ไม่ใช่รายเดือน — วางระบบให้จบแล้วส่งมอบ ถ้าอยากให้ดูแลต่อค่อยคุยกันเป็นค่าดูแลแยก ซึ่งเป็นทางเลือก ไม่ใช่เงื่อนไข</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">ราคาเริ่มต้น</span>
                <span class="hb-tier__name">วางระบบ n8n</span>
                <div class="hb-tier__price"><?php echo esc_html( number_format( $price_from ) ); ?><span class="hb-tier__price-unit">บาทต่อโปรเจกต์</span></div>
                <p class="hb-caption">ครอบคลุมงานทั้ง 6 ขั้นด้านบน ตาม scope ที่ตกลงกันหลังคุย process</p>
                <ul class="hb-tier__features">
                    <li>คุย process จริงและประเมินว่าควรทำ automation ไหม</li>
                    <li>ออกแบบ workflow พร้อมกำหนดพฤติกรรมตอนเกิดข้อผิดพลาด</li>
                    <li>ติดตั้ง n8n บนเซิร์ฟเวอร์ของคุณเอง ข้อมูลไม่ออกนอกระบบ</li>
                    <li>ทดสอบกับข้อมูลจริง รวมถึงเคสที่ผิดปกติ</li>
                    <li>ส่งมอบไฟล์ workflow ทุกตัว + เอกสารอธิบายทุก node</li>
                    <li>สอนทีมให้ดูแลและแก้เองต่อได้</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">ขอใบเสนอราคา n8n</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">อะไรทำให้ราคาขยับจากจุดเริ่มต้น</h3>
                <p class="hb-body" style="margin:0;"><strong>จำนวน workflow และระบบที่ต้องเชื่อม</strong> — เชื่อม 2 ระบบกับเชื่อม 8 ระบบใช้แรงต่างกันมาก</p>
                <p class="hb-body" style="margin:0;"><strong>ระบบปลายทางมี API หรือเปล่า</strong> — ระบบที่มี API เอกสารดีเชื่อมง่าย ส่วนระบบที่ต้องดึงจากไฟล์ที่คนกรอกมือใช้เวลาต่างกันคนละเรื่อง</p>
                <p class="hb-body" style="margin:0;"><strong>process ชัดแค่ไหนตั้งแต่ต้น</strong> — ถ้ายังไม่ชัดว่าใครทำอะไรตอนไหน เวลาส่วนใหญ่จะหมดไปกับการทำให้ชัดก่อน ซึ่งเป็นงานที่คุ้มค่าแต่ต้องนับเข้าไปด้วย</p>
                <p class="hb-body" style="margin:0;"><strong>ต้องใช้ฟีเจอร์ระดับองค์กรไหม</strong> — SSO, Projects, Environments, log streaming และการผูกกับ Git เป็นของแพ็กเกจเสียเงินของ n8n เราจะบอกตั้งแต่ตอนคุย scope ไม่ปล่อยให้ไปเจอเองตอนใช้จริง</p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-6);color:var(--hb-text-muted);"><?php echo esc_html( $price_from_txt ); ?> คือจุดเริ่มต้น ไม่ใช่ราคาเหมาทุกงาน — เราเสนอราคาตาม scope จริงหลังคุย process และถ้าคุยแล้วเห็นว่างานของคุณยังไม่คุ้มที่จะทำเป็นระบบอัตโนมัติ เราจะบอกตรงๆ ก่อนที่คุณจะจ่ายอะไร · ราคาไม่รวม VAT 7%</p>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อยเรื่องรับทำ n8n</h2>
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
        <h2 class="hb-h2">พร้อมเริ่มไหม?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">เล่าให้ฟังว่างานอะไรที่ทีมทำซ้ำทุกวัน เราคุยกันก่อนว่าควรทำเป็นระบบไหม แล้วค่อยเสนอ scope และราคา</p>
        <div class="hb-hero__actions" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">คุย process ฟรี</a>
            <a href="<?php echo esc_url( $services_url ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูบริการอื่น</a>
        </div>
    </div>
</section>

<?php
// Published entry price. Single tier on purpose — 29,000 บาทต่อโปรเจกต์ is the only
// figure we publish; everything above it is quoted per scope after the process call.
//
// **ต่างจาก /services/seo/ ตรงนี้: ไม่มี UnitPriceSpecification/unitCode MON**
// เพราะนี่เป็นราคาต่อโปรเจกต์ครั้งเดียว ไม่ใช่ retainer รายเดือน การใส่ unitCode MON
// จะบอก Google ว่าเป็นราคาต่อเดือน ซึ่งผิดและอาจโชว์ผิดใน rich result
// ใช้ PriceSpecification ธรรมดา + minPrice เพื่อสื่อว่า "เริ่มต้น" ไม่ใช่ราคาตายตัว
$n8n_offer = array(
    '@type'                 => 'Offer',
    'name'                  => 'บริการวางระบบ n8n Automation (ต่อโปรเจกต์)',
    'price'                 => (string) $price_from,
    'priceCurrency'         => 'THB',
    'priceSpecification'    => array(
        '@type'         => 'PriceSpecification',
        // minPrice คือสิ่งที่ทำให้เป็นราคา "เริ่มต้น" ไม่ใช่ราคาเหมา —
        // Offer.price เฉยๆ ไม่มีความหมายว่า from และทุกข้อความบนหน้าเขียนว่าเริ่มต้น
        'minPrice'      => (string) $price_from,
        'price'         => (string) $price_from,
        'priceCurrency' => 'THB',
    ),
    'description'           => 'ราคาเริ่มต้นต่อโปรเจกต์สำหรับงานวางระบบ n8n automation ครอบคลุมการวิเคราะห์ process ออกแบบ workflow ติดตั้งบนเซิร์ฟเวอร์ของลูกค้า ทดสอบกับข้อมูลจริง ส่งมอบไฟล์ workflow พร้อมเอกสาร และการสอนทีมให้ดูแลต่อได้เอง ขอบเขตงานจริงและราคาสุดท้ายกำหนดตาม scope หลังคุย process',
    // ไม่รวม VAT เหมือนทุกหน้าบริการ (page-seo-service.php, page-ai-consulting.php:428)
    'valueAddedTaxIncluded'  => false,
    'availability'          => 'https://schema.org/InStock',
    'areaServed'            => 'TH',
    'url'                   => $page_url . '#pricing',
);
hashbox_jsonld( array(
    '@context'         => 'https://schema.org',
    '@type'            => 'Service',
    '@id'              => $page_url . '#service',
    'name'             => 'บริการรับทำ n8n Automation',
    'serviceType'      => 'Workflow Automation Development',
    'description'      => $desc,
    'url'              => $page_url,
    'inLanguage'       => 'th',
    'provider'         => array( '@id' => home_url( '/#organization' ) ),
    'areaServed'       => array( '@type' => 'Country', 'name' => 'Thailand' ),
    'offers'           => $n8n_offer,
    'hasOfferCatalog'  => array(
        '@type'           => 'OfferCatalog',
        'name'            => 'ราคาบริการรับทำ n8n Automation',
        'itemListElement' => array( $n8n_offer ),
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
        array( '@type' => 'ListItem', 'position' => 3, 'name' => 'รับทำ n8n Automation', 'item' => $page_url ),
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
