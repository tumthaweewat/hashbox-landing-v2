<?php
/**
 * Template Part: FAQ Section
 *
 * @package Hashbox_Studio
 */

/**
 * Source-of-truth FAQ data. Used both for visible markup AND FAQPage schema
 * injected via hashbox_inject_home_faq_schema() in functions.php.
 */
if ( ! function_exists( 'hashbox_get_home_faqs' ) ) {
    function hashbox_get_home_faqs() {
        return array(
            array(
                'q' => 'เว็บที่คุณทำพร้อม SEO จริงไหม ใช้เวลานานแค่ไหนถึงเห็นผล?',
                'a' => 'ใช่ ทุกเว็บผ่าน Build Gate: Lighthouse 100, Core Web Vitals เขียว, Schema Validator ผ่าน ลูกค้าส่วนใหญ่เห็น Impressions เพิ่มภายใน 30-60 วัน และ Ranking ขยับใน 60-90 วัน ทั้งนี้ขึ้นกับ Niche และ Domain Authority ปัจจุบัน',
            ),
            array(
                'q' => 'Tech Stack ที่ใช้คืออะไร?',
                'a' => 'ขึ้นกับโจทย์ — Next.js + Headless CMS สำหรับเว็บที่ต้องการ Performance สูงสุด, WordPress + Custom Theme สำหรับเว็บที่ทีมต้องแก้เนื้อหาเองได้, Cloudflare/Vercel สำหรับ CDN + Edge, GA4/GSC/Looker Studio สำหรับ Analytics',
            ),
            array(
                'q' => 'Digital Marketing Tools และ CRO ทำอะไรบ้าง?',
                'a' => 'ติดตั้งและ Configure เครื่องมือ Tracking ครบวงจร พร้อมรัน CRO Sprint รายเดือน เริ่มจาก Hypothesis → A/B Test → Measure ส่ง Report พร้อม Recommendation ลูกค้าได้ทั้งเครื่องมือและ Insight ไม่ใช่แค่ติดตั้งแล้วจบ',
            ),
            array(
                'q' => 'AI Consulting ครอบคลุมอะไรบ้าง?',
                'a' => 'เริ่มจากการประเมิน AI ROI → ออกแบบ Workflow → Implement → Train ทีม ตัวอย่างงาน: LINE Bot ตอบลูกค้า 24/7, Sales GPT ใน CRM, RAG Knowledge Base ภายใน, Workflow Automation ผ่าน n8n ลดงาน Manual ของทีม 40%+',
            ),
            array(
                'q' => 'โปรเจกต์ใช้เวลานานเท่าไหร่?',
                'a' => 'Landing Page: 2-3 สัปดาห์ · Corporate Site: 4-6 สัปดาห์ · E-commerce: 6-10 สัปดาห์ · AI Bot: 3-5 สัปดาห์ ขึ้นกับ Scope และ Integration ที่ต้องเชื่อมต่อ',
            ),
            array(
                'q' => 'ราคาเริ่มต้นเท่าไหร่?',
                'a' => 'Landing Page เริ่ม 80,000 บาท · Corporate Site เริ่ม 200,000 บาท · E-commerce เริ่ม 350,000 บาท · AI Consulting Retainer เริ่ม 50,000 บาท/เดือน — ทุก Quote เริ่มหลังการ Audit ฟรี',
            ),
            array(
                'q' => 'มี Support หลังส่งมอบไหม?',
                'a' => 'มี — เลือกได้ระหว่าง One-time Maintenance, Monthly Retainer (Performance + CRO + Content) หรือ AI Workforce Retainer ทุกแพ็กเกจมี SLA ตอบกลับและ Dashboard ให้ลูกค้าดูผลแบบ Real-time',
            ),
        );
    }
}

$hashbox_faqs = hashbox_get_home_faqs();
?>
<!-- ============ SECTION 7 — FAQ ============ -->
<section id="faq" class="section-padding" aria-labelledby="faq-h2">
    <div class="container">
        <div class="section-header">
            <span class="section-label">FAQ</span>
            <h2 id="faq-h2" class="section-title">คำถามที่พบบ่อย</h2>
            <p class="section-sub">ทุกอย่างที่ลูกค้ามักถามก่อนเริ่มงานกับเรา</p>
        </div>

        <div class="faq-container">
            <?php foreach ( $hashbox_faqs as $i => $faq ) : ?>
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false" aria-controls="faq-a-<?php echo (int) $i; ?>" id="faq-q-<?php echo (int) $i; ?>" type="button">
                        <span><?php echo esc_html( $faq['q'] ); ?></span>
                        <svg class="faq-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                    <div class="faq-answer" id="faq-a-<?php echo (int) $i; ?>" role="region" aria-labelledby="faq-q-<?php echo (int) $i; ?>">
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
