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
$checker_url  = $has_checker ? home_url( '/geo-checker/' ) : home_url( '/#contact' );
$desc         = 'รับทำ AI Search (GEO): ทำให้แบรนด์ถูกอ้างอิงใน Google AI Overview, ChatGPT, Perplexity และ Gemini — audit, entity/schema, answer-first content, citation จากแหล่งภายนอก วัดผลด้วย AI Visibility, Brand Mentions และ Citations จากระบบ track ของเราเอง';

$author_name     = 'Tum Thaweewat';
$author_role     = 'Head of Tech';
$author_linkedin = 'https://www.linkedin.com/in/tumthaweewat/';
$author_bio      = '17 ปี Technical SEO + Performance Engineering · สร้างระบบ track AI Overview / AI citation ของ Hashbox เอง · บทความของทีมถูก Google AI Overview อ้างอิงในคำที่แข่งขันจริง';

$faqs = array(
    array( 'q' => 'รับทำ AI Search คืออะไร ต่างจากรับทำ SEO อย่างไร?', 'a' => 'AI Search Optimization หรือ GEO (Generative Engine Optimization) คือการทำให้ AI เช่น Google AI Overview, ChatGPT, Perplexity และ Gemini หยิบแบรนด์และเนื้อหาของคุณไป "ตอบ" ผู้ใช้ ส่วน SEO คือการทำให้เว็บติดอันดับในผลค้นหา 10 ลิงก์ ทั้งสองใช้พื้นฐานเดียวกัน (เว็บเร็ว โครงสร้างถูก Schema ครบ) แต่ AI Search ต้องการเพิ่มอีก 3 อย่าง: ประโยคนิยามที่ AI ยกไปใช้ได้ทันที, entity ที่ชัดว่าแบรนด์คุณคือใครทำอะไร และการถูกพูดถึงจากแหล่งภายนอกที่ AI เชื่อ' ),
    array( 'q' => 'GEO, AEO และ AI SEO ต่างกันไหม?', 'a' => 'เป็นชื่อเรียกของงานเดียวกันจากคนละมุม — GEO (Generative Engine Optimization) เน้นให้ AI อ้างอิงเนื้อหา, AEO (Answer Engine Optimization) เน้นให้เนื้อหาเป็นคำตอบตรงคำถาม, AI SEO เป็นคำรวมที่เอเจนซีใช้ขาย ในทางปฏิบัติ Hashbox ทำทั้งชุดในบริการเดียว: audit → entity/schema → answer-first content → citation ภายนอก → วัดผล' ),
    array( 'q' => 'ทำ AI Search ใช้เวลานานแค่ไหนถึงเห็นผล?', 'a' => 'AI Overview ของ Google เปลี่ยนแหล่งอ้างอิงได้ภายในไม่กี่วันหลัง Google re-crawl หน้าที่แก้ — เราเห็นการเปลี่ยนแปลงในระบบ track รายวัน ส่วน ChatGPT และ Perplexity ดึงจากดัชนีค้นหาและแหล่งภายนอก จึงขยับช้ากว่า มักเห็นผลใน 4–8 สัปดาห์หลังเนื้อหาและ citation ครบ คีย์เวิร์ดที่แข่งสูงต้องสะสมการถูกพูดถึงจากภายนอกซึ่งเราจะบอกตรงๆ ตั้งแต่ audit' ),
    array( 'q' => 'Hashbox วัดผล AI Search อย่างไร?', 'a' => 'ด้วย 6 ตัวชี้วัดจากระบบ track ของเราเอง: AI Visibility (แบรนด์ปรากฏในคำตอบกี่ % ของ prompt ชุดเดียวกันทุกเดือน), Brand Mentions แยกตาม ChatGPT / Claude / Gemini / Perplexity, AI Overview Citations ของคีย์เวิร์ดเป้าหมายรายวัน, AI Share of Voice เทียบคู่แข่ง, แหล่งที่ AI อ้างอิงแทนเรา และ LLM traffic ใน GA4 (referrer chatgpt.com, perplexity.ai) — คุณเห็นข้อมูลชุดเดียวกับที่เราเห็น' ),
    array( 'q' => 'ต้องทำ SEO ก่อนไหมถึงจะทำ AI Search ได้?', 'a' => 'พื้นฐานต้องผ่านก่อน: เว็บต้อง crawl ได้ เร็วพอ และมี Schema ถูกต้อง เพราะ AI ดึงจากดัชนีเดียวกับ Google ถ้าเว็บยังไม่ผ่านตรงนี้ เราจะแก้ใน 2–4 สัปดาห์แรกก่อนเริ่มงาน AI Search ส่วนเว็บที่ SEO ดีอยู่แล้วเริ่มงาน GEO ได้ทันที' ),
    array( 'q' => 'รับทำ AI Search ราคาเท่าไหร่?', 'a' => 'GEO / AI Overview optimization รวมอยู่ในบริการรับทำ SEO ของ Hashbox ซึ่งเริ่มต้น 29,900 บาทต่อเดือน สำหรับลูกค้าที่ต้องการเฉพาะงาน AI Search แยกจาก SEO เราเสนอราคาตาม scope จริงหลัง GEO Audit ฟรี (จำนวนคีย์เวิร์ด/prompt ที่ต้อง track, จำนวนหน้าที่ต้องแก้ และ citation ภายนอกที่ต้องสร้าง) ราคาไม่รวม VAT 7%' ),
    array( 'q' => 'ChatGPT และ Perplexity ดึงข้อมูลแบรนด์จากไหน?', 'a' => 'จากข้อมูลที่เราเห็นในระบบ track ปี 2026 AI ดึงจากแหล่งที่มีข้อเท็จจริงและตัวเลขชัด: เว็บของแบรนด์เอง (ถ้ามีประโยคนิยาม ราคา และ FAQ), directory เช่น Clutch, marketplace, Facebook page, วิดีโอ YouTube และบทความเปรียบเทียบ — คำในกลุ่มบริการไทยหลายคำ AI อ้างอิง Facebook และ YouTube มากกว่าเว็บบริษัท จึงเป็นเหตุผลที่บริการนี้ทำ citation ภายนอกควบคู่กับเว็บ' ),
    array( 'q' => 'llms.txt คืออะไร จำเป็นไหม?', 'a' => 'llms.txt คือไฟล์ข้อความที่ root ของเว็บ สรุปว่าแบรนด์คือใคร ขายอะไร ราคาเท่าไร และหน้าสำคัญอยู่ที่ไหน ในรูปแบบที่ AI crawler อ่านง่าย (เหมือน robots.txt สำหรับ AI) ยังไม่ใช่มาตรฐานที่ทุก AI ใช้ แต่ต้นทุนต่ำและไม่มีข้อเสีย Hashbox ทำ llms.txt + llms-full.txt ให้ทุกเว็บที่ดูแล และทำให้เว็บตัวเองด้วย — ดูได้ที่ hashbox.co.th/llms.txt' ),
    array( 'q' => 'Hashbox ทำ AI Search ให้ตัวเองได้ผลจริงไหม?', 'a' => 'เราใช้ระบบเดียวกันกับเว็บตัวเอง: track 56 คีย์เวิร์ด, AI Overview 51 คำ และ 20 prompt × 4 AI ทุกเดือน บทความ "ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ" ของเราติดอันดับ 3 บน Google และถูก AI Overview อ้างอิงในคำที่มีเอเจนซีใหญ่แข่งอยู่ — เราเปิดตัวเลขทั้งที่ได้และยังไม่ได้ให้ดูตอนคุยกัน' ),
);

$process = array(
    array( 'AI-Specific Audit', 'ตรวจว่า AI crawler เข้าได้ไหม (robots, llms.txt), หน้าไหนมีประโยคที่ AI ยกไปใช้ได้, Schema และ entity ครบหรือยัง และคีย์เวิร์ดเป้าหมายไหน Google แสดง AI Overview อยู่ — พร้อมรายชื่อแหล่งที่ AI อ้างอิงแทนคุณตอนนี้' ),
    array( 'Entity + Technical', 'Organization / Service / Person schema ที่ระบุชัดว่าแบรนด์คือใคร ทำอะไร อยู่ที่ไหน ราคาเท่าไร · sameAs เชื่อมทุกโปรไฟล์ให้เป็น entity เดียว · llms.txt + llms-full.txt · robots เปิดรับ GPTBot, ClaudeBot, PerplexityBot, Google-Extended' ),
    array( 'Answer-First Content', 'ทุกหน้าเงินและบทความหลักมีประโยคนิยาม "X คือ…" ใน 2 บรรทัดแรก, ตารางเปรียบเทียบ, ขั้นตอน, ตัวเลข และ FAQ ที่ตอบตรงคำถามจริง — เขียนจากงานที่ทำจริง ไม่ใช่เนื้อหาทั่วไปที่ AI มีอยู่แล้ว' ),
    array( 'Citations ภายนอก', 'AI เชื่อสิ่งที่คนอื่นพูดถึงคุณมากกว่าที่คุณพูดเอง — Google Business Profile, directory (Clutch, GoodFirms), Facebook page, วิดีโอ YouTube พร้อม transcript และบทความเปรียบเทียบ ให้ข้อมูลตรงกันทุกแหล่ง' ),
    array( 'Track + Report', 'AI Overview ของคีย์เวิร์ดเป้าหมายรายวัน, prompt ชุดเดียวกันยิง ChatGPT / Claude / Gemini / Perplexity ทุกเดือน, แหล่งที่ AI อ้างอิง และ LLM traffic ใน GA4 — รายงานว่าอะไรขยับ อะไรยัง และทำอะไรต่อ' ),
);

$platforms = array(
    array( 'Google AI Overview / AI Mode', 'ดึงจากดัชนี Google โดยตรง — หน้าที่ติดอันดับและมีประโยคตอบตรงคำถามถูกยกไปอ้างอิง เปลี่ยนได้ภายในวันหลัง re-crawl' ),
    array( 'ChatGPT (Search)', 'ผสมความรู้ในโมเดลกับผลค้นหา Bing — entity ที่ชัดและการถูกพูดถึงในหลายแหล่งมีผลมากกว่าอันดับ' ),
    array( 'Perplexity', 'อ้างอิงแหล่งชัดเจนทุกคำตอบ — ชอบหน้าที่มีตัวเลข ตาราง และวันที่อัปเดต' ),
    array( 'Gemini', 'ใช้ดัชนี Google + Knowledge Graph — Organization schema, sameAs และ Google Business Profile สำคัญที่สุด' ),
    array( 'Claude', 'ค้นหาเว็บเมื่อถูกถาม — ประโยคนิยามและ FAQ ที่อ่านแล้วเข้าใจทันทีถูกยกไปตอบ' ),
);

$kpis = array(
    array( 'AI Visibility', 'แบรนด์ปรากฏในคำตอบกี่ % ของ prompt ชุดเดียวกัน แยกตาม AI' ),
    array( 'Brand Mentions', 'จำนวนครั้งที่ AI เอ่ยชื่อแบรนด์ — เอ่ยถึง / อ้างอิงลิงก์' ),
    array( 'AI Overview Citations', 'คีย์เวิร์ดเป้าหมายที่หน้าเว็บคุณถูก AI Overview อ้างอิง อัปเดตรายวัน' ),
    array( 'AI Share of Voice', 'สัดส่วนการถูกอ้างอิงของคุณเทียบคู่แข่งในคำเดียวกัน' ),
    array( 'แหล่งที่ AI อ้างอิง', 'โดเมนไหนถูก AI ใช้แทนคุณ — บอกว่าต้องไปอยู่ที่ไหน' ),
    array( 'LLM Traffic', 'session จาก chatgpt.com, perplexity.ai, gemini ใน GA4 และ lead ที่ตามมา' ),
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
            <h1 class="hb-hero__title">รับทำ AI Search (GEO)<br><em>ให้แบรนด์เป็นคำตอบของ AI</em><br>ใน Google AI Overview, ChatGPT, Perplexity</h1>
            <p class="hb-hero__sub">บริการรับทำ AI Search ของ Hashbox คือการทำให้ AI หยิบแบรนด์ของคุณไปตอบผู้ใช้ — ไม่ใช่แค่ติดอันดับในผลค้นหา 10 ลิงก์ เราตรวจว่า AI ดึงข้อมูลจากไหนตอนนี้ แก้ entity, Schema, llms.txt และเนื้อหาแบบ answer-first แล้วสร้างการถูกพูดถึงจากแหล่งภายนอกที่ AI เชื่อ วัดผลด้วยระบบ track AI Overview และ AI mention ของเราเอง · GEO รวมอยู่ใน SEO retainer เริ่มต้น 29,900 บาทต่อเดือน</p>
            <div class="hb-hero__actions">
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ขอ GEO Audit ฟรี</a>
                <?php if ( $has_checker ) : ?>
                <a href="<?php echo esc_url( $checker_url ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">เช็คเว็บด้วย GEO Checker</a>
                <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/geo-ai-search-optimization-2026/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">อ่าน GEO คืออะไร</a>
                <?php endif; ?>
            </div>
            <p class="hb-hero__sub" lang="en" style="margin-top:var(--hb-space-5);font-size:var(--hb-text-sm);">Read this page in English: <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search optimization (GEO) in Bangkok</a></p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="answer">
    <div class="hb-container hb-container--md">
        <div class="hb-answer-box" style="padding:var(--hb-space-6);border-left:4px solid var(--hb-accent-blue,#2563EB);background:var(--hb-surface-2,#1E1E2A);border-radius:var(--hb-radius-md,8px);">
            <span class="hb-eyebrow" style="color:var(--hb-accent-blue-soft,#818CF8);">สรุปสั้นๆ</span>
            <p class="hb-lead" style="margin-top:var(--hb-space-3);font-weight:500;">
                <strong>รับทำ AI Search (Generative Engine Optimization) คือ การทำให้ Google AI Overview, ChatGPT, Perplexity และ Gemini อ้างอิงแบรนด์ของคุณเวลาตอบคำถามลูกค้า</strong> — Hashbox ทำ 5 ขั้น: AI-specific audit → entity + Schema + llms.txt → answer-first content → citation จากแหล่งภายนอก → track รายวัน ด้วยระบบของเราเองที่ใช้กับเว็บตัวเองด้วย (บทความของเราถูก AI Overview อ้างอิงในคำที่เอเจนซีใหญ่แข่ง) · รวมใน SEO retainer เริ่มต้น 29,900 บาทต่อเดือน หรือ quote แยกหลัง GEO Audit ฟรี
            </p>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ทำไมต้องทำปี 2026</span>
            <h2 class="hb-h2">ทำไมแบรนด์ต้องทำ AI Search ตอนนี้ — ตัวเลขจากระบบ track ของเรา</h2>
            <p class="hb-section__sub">ไม่ใช่ตัวเลขจากรายงานต่างประเทศ — นี่คือสิ่งที่เราเห็นจากคีย์เวิร์ดบริการในไทยที่เรา track เอง เดือนสิงหาคม 2026</p>
        </div>
        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient">11<span class="hb-stat__unit">/ 51</span></span>
                <p class="hb-stat__label">คีย์เวิร์ดที่ Google แสดง AI Overview</p>
                <p class="hb-stat__caption">ผู้ใช้ได้คำตอบก่อนเห็น 10 ลิงก์</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient">25</span>
                <p class="hb-stat__label">แหล่งที่ AI Overview อ้างอิงในคำเดียว</p>
                <p class="hb-stat__caption">"ai consulting companies thailand" — ถ้าไม่อยู่ในนั้น ก็ไม่มีตัวตน</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value">4<span class="hb-stat__unit">AI</span></span>
                <p class="hb-stat__label">ChatGPT · Claude · Gemini · Perplexity</p>
                <p class="hb-stat__caption">แต่ละตัวดึงข้อมูลคนละแหล่ง — ต้องทำครบ</p>
            </div>
        </div>
        <p class="hb-body" style="margin-top:var(--hb-space-5);color:var(--hb-text-muted);">สิ่งที่เราเห็นชัดที่สุด: ในคำกลุ่มบริการไทย AI อ้างอิง marketplace, Facebook และ YouTube มากกว่าเว็บของบริษัทเอง — แปลว่าการทำเว็บอย่างเดียวไม่พอ ต้องพาแบรนด์ไปอยู่ในแหล่งที่ AI เชื่อด้วย อ่านข้อมูลเต็มใน <a href="<?php echo esc_url( home_url( '/google-ai-overview-thailand-2026/' ) ); ?>">AI Overview ในไทย: ข้อมูลจริงปี 2026</a></p>
    </div>
</section>

<section class="hb-section hb-section--surface" id="process">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">กระบวนการ</span>
            <h2 class="hb-h2">บริการรับทำ AI Search ของเราทำอะไรบ้าง — 5 ขั้นตอน</h2>
            <p class="hb-section__sub">เรียงตามลำดับที่ต้องทำจริง: AI ต้องเข้าถึงได้ → เข้าใจว่าคุณคือใคร → มีประโยคที่ยกไปตอบได้ → มีคนอื่นยืนยัน → วัดว่าได้ผล</p>
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
                <p class="hb-body">AI Search ยืนบนพื้นฐานเดียวกับ <a href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>">บริการรับทำ SEO</a> (เว็บเร็ว โครงสร้างถูก Schema ครบ) และเว็บที่เราสร้างใหม่ทุกเว็บ<a href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>">พร้อมสำหรับ AI Search ตั้งแต่วันเปิดตัว</a></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section" id="platforms">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ครอบคลุม</span>
            <h2 class="hb-h2">AI แต่ละตัวดึงข้อมูลไม่เหมือนกัน — เราทำให้ครบทั้ง 5</h2>
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
                <p class="hb-body"><?php if ( $has_checker ) : ?>ใส่ URL ใน <a href="<?php echo esc_url( $checker_url ); ?>">GEO Readiness Checker</a> ได้คะแนน 0–100 ว่าหน้านั้นพร้อมถูก AI อ้างอิงแค่ไหน ฟรี ไม่ต้องลงทะเบียน<?php else : ?>ส่ง URL มาที่ฟอร์มด้านล่าง เราตรวจให้ว่าหน้าไหนพร้อมถูก AI อ้างอิง และตอนนี้ AI ดึงใครแทนคุณ<?php endif; ?></p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface" id="measure">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">วิธีวัดผล</span>
            <h2 class="hb-h2">Hashbox วัดผล AI Search อย่างไร — 6 ตัวชี้วัด</h2>
            <p class="hb-section__sub">เอเจนซีส่วนใหญ่ขาย AI Search ได้แต่วัดไม่ได้ เราสร้างระบบ track เองก่อนขายบริการนี้ และใช้กับเว็บตัวเองทุกวัน</p>
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
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">พิสูจน์กับเว็บตัวเองก่อน</span>
            <h2 class="hb-h2">เราทำ AI Search ให้ hashbox.co.th ด้วยระบบเดียวกัน</h2>
        </div>
        <ul style="list-style:none;margin:0;padding:var(--hb-space-6);border:1px solid var(--hb-border);border-radius:var(--hb-radius-md,8px);background:var(--hb-surface-1,#18181B);display:grid;gap:var(--hb-space-4);">
            <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;"><span aria-hidden="true" style="color:var(--hb-accent-emerald,#10B981);font-weight:700;">&#10003;</span><p class="hb-body" style="margin:0;"><strong>Track ทุกวัน</strong> — 56 คีย์เวิร์ด, AI Overview 51 คำ, 20 prompt × ChatGPT / Claude / Gemini / Perplexity ทุกเดือน และรายชื่อแหล่งที่ AI อ้างอิงในแต่ละคำ</p></li>
            <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;"><span aria-hidden="true" style="color:var(--hb-accent-emerald,#10B981);font-weight:700;">&#10003;</span><p class="hb-body" style="margin:0;"><strong>ถูก AI Overview อ้างอิงจริง</strong> — บทความ <a href="<?php echo esc_url( home_url( '/ai-solution-consulting-guide-2026/' ) ); ?>">ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ</a> ติดอันดับ 3 และถูก Google AI Overview อ้างอิง ในคำที่มีเอเจนซีใหญ่แข่งอยู่</p></li>
            <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;"><span aria-hidden="true" style="color:var(--hb-accent-emerald,#10B981);font-weight:700;">&#10003;</span><p class="hb-body" style="margin:0;"><strong>เปิดโครงสร้างให้ดู</strong> — <a href="<?php echo esc_url( home_url( '/llms.txt' ) ); ?>">llms.txt</a>, robots.txt ที่เปิดรับ AI crawler, Organization schema ที่ระบุ entity ครบ ทั้งหมดอยู่บนเว็บนี้ ตรวจได้เอง</p></li>
            <li style="display:flex;gap:var(--hb-space-3);align-items:flex-start;"><span aria-hidden="true" style="color:var(--hb-accent-emerald,#10B981);font-weight:700;">&#10003;</span><p class="hb-body" style="margin:0;"><strong>บอกตรงๆ ว่ายังไม่ได้อะไร</strong> — คำที่เรายังไม่ถูกเอ่ยถึง เราแสดงในรายงานเดียวกัน เพราะตัวเลขที่ไม่ครบคือสิ่งที่บอกว่าต้องทำอะไรต่อ</p></li>
        </ul>
    </div>
</section>

<section class="hb-section hb-section--surface" id="pricing">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">ราคา</span>
            <h2 class="hb-h2">ราคารับทำ AI Search — รวมใน SEO retainer หรือ quote แยกหลัง audit</h2>
            <p class="hb-section__sub">เราไม่ขายแพ็กเกจ AI Search ตายตัว เพราะงานขึ้นกับว่า AI ดึงใครแทนคุณอยู่ตอนนี้ และต้องแก้กี่หน้า สร้าง citation กี่แหล่ง</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--hb-space-4);">
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">เริ่มตรงนี้</span>
                <span class="hb-tier__name">รวมใน SEO retainer</span>
                <div class="hb-tier__price">29,900<span class="hb-tier__price-unit">บาทต่อเดือน เริ่มต้น</span></div>
                <p class="hb-caption">GEO / AI Overview optimization เป็นส่วนหนึ่งของ<a href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>">บริการรับทำ SEO</a>อยู่แล้ว</p>
                <ul class="hb-tier__features">
                    <li>Technical SEO + Core Web Vitals + Schema (พื้นฐานที่ AI ต้องการ)</li>
                    <li>llms.txt + llms-full.txt + robots เปิดรับ AI crawler</li>
                    <li>Answer-first content และ FAQ บนหน้าเงิน</li>
                    <li>Track AI Overview ของคีย์เวิร์ดเป้าหมายรายวัน</li>
                    <li>รายงานอันดับ + AI citation ชุดเดียวกัน</li>
                </ul>
                <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient" style="margin-top:auto;">ขอ SEO + GEO Audit ฟรี</a>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">AI Search แยกเดี่ยว — quote หลัง GEO Audit ฟรี</h3>
                <p class="hb-body" style="margin:0;"><strong>เหมาะกับ</strong> — เว็บที่ SEO ดีอยู่แล้วหรือมีทีม SEO อยู่ แต่ยังไม่ถูก AI เอ่ยถึง</p>
                <p class="hb-body" style="margin:0;"><strong>ราคาขึ้นกับ</strong> — จำนวนคีย์เวิร์ด/prompt ที่ต้อง track · จำนวนหน้าที่ต้องปรับเป็น answer-first · จำนวน citation ภายนอกที่ต้องสร้าง (directory, วิดีโอ, บทความเปรียบเทียบ)</p>
                <p class="hb-body" style="margin:0;"><strong>สิ่งที่ได้ก่อนตัดสินใจ</strong> — GEO Audit ฟรี: คีย์เวิร์ดไหนมี AI Overview, ตอนนี้ AI อ้างอิงใคร, หน้าไหนของคุณพร้อม/ไม่พร้อม เอาไปทำเองก็ได้</p>
                <p class="hb-body" style="margin:0;color:var(--hb-text-muted);">ราคาไม่รวม VAT 7%</p>
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
        </ul>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">อยากรู้ว่าตอนนี้ AI ตอบชื่อใครแทนคุณ?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่งชื่อแบรนด์ + คีย์เวิร์ด 5 คำมา เราส่งผลกลับว่า AI Overview, ChatGPT และ Perplexity อ้างอิงใครอยู่ พร้อมสิ่งที่ต้องแก้ก่อน — ฟรี ไม่มีข้อผูกมัด</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">ขอ GEO Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'Service',
    '@id'         => $page_url . '#service',
    'name'        => 'รับทำ AI Search (GEO)',
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
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'AI-specific audit (llms.txt, robots, schema, AI Overview coverage)' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Entity + Schema + llms.txt implementation' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'Answer-first content optimisation' ) ),
            array( '@type' => 'Offer', 'itemOffered' => array( '@type' => 'Service', 'name' => 'External citation building' ) ),
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
