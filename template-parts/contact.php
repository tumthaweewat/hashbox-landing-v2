<?php
/**
 * Template Part: Contact Section
 *
 * @package Hashbox_Studio
 */
?>
<!-- ============ SECTION 9 — CONTACT ============ -->
<section id="contact" class="section-padding section-surface" aria-labelledby="contact-h2">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-left">
                <span class="section-label">GET IN TOUCH</span>
                <h2 id="contact-h2" class="section-title contact-title">เริ่มต้นด้วย SEO + Performance Audit ฟรี</h2>
                <p class="contact-sub">กรอกแบบฟอร์ม รับรายงาน Audit 15-20 หน้าภายใน 3 วันทำการ — ก่อนตัดสินใจเริ่มงานกับเรา</p>

                <div class="contact-items">
                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,4 12,13 2,4"/></svg>
                        <a href="mailto:hello@hashbox.co.th">hello@hashbox.co.th</a>
                    </div>
                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:+6622666222">02 266 6222</a>
                    </div>
                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500</span>
                    </div>
                    <div class="contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <span>จันทร์-ศุกร์ 9:00-18:00</span>
                    </div>
                </div>

                <a href="https://lin.ee/Xagx6i4" class="btn btn-line-oa" target="_blank" rel="noopener noreferrer">คุยทาง LINE OA: @hashboxstudio</a>

                <div class="social-links">
                    <a href="https://www.instagram.com/hashboxstudio" class="social-pill" aria-label="Instagram" target="_blank" rel="noopener noreferrer">IG</a>
                    <a href="https://www.facebook.com/hashboxstudio" class="social-pill" aria-label="Facebook" target="_blank" rel="noopener noreferrer">FB</a>
                    <a href="https://www.linkedin.com/company/hashbox-studio" class="social-pill" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">LI</a>
                    <a href="https://lin.ee/Xagx6i4" class="social-pill" aria-label="LINE" target="_blank" rel="noopener noreferrer">LINE</a>
                </div>
            </div>

            <div class="contact-right">
                <form id="contactForm" class="contact-form" novalidate>
                    <div class="form-group">
                        <label for="name">ชื่อ <span class="required" aria-hidden="true">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="ชื่อ-นามสกุล">
                    </div>
                    <div class="form-group">
                        <label for="email">อีเมล <span class="required" aria-hidden="true">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="you@company.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">เบอร์โทรศัพท์</label>
                        <input type="tel" id="phone" name="phone" placeholder="08x-xxx-xxxx">
                    </div>
                    <div class="form-group">
                        <label for="website">เว็บไซต์ปัจจุบัน <span class="optional">(ถ้ามี)</span></label>
                        <input type="url" id="website" name="website" placeholder="https://yoursite.com">
                    </div>
                    <div class="form-group">
                        <label for="service">สนใจบริการ</label>
                        <select id="service" name="service">
                            <option value="">เลือกบริการ</option>
                            <option value="seo-website">SEO-Ready Website Build</option>
                            <option value="marketing-cro">Digital Marketing Tools + CRO</option>
                            <option value="ai-consulting">AI Expert Consulting</option>
                            <option value="all">ทั้ง 3 บริการ</option>
                            <option value="audit-only">SEO Audit ฟรี ก่อนตัดสินใจ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">เล่าโจทย์สั้น ๆ</label>
                        <textarea id="message" name="message" rows="4" placeholder="ปัญหาที่อยากแก้ / เป้าหมายของโปรเจกต์..."></textarea>
                    </div>
                    <div class="form-group form-consent">
                        <label for="pdpa" class="consent-label">
                            <input type="checkbox" id="pdpa" name="pdpa" required>
                            <span>ฉันยินยอมให้ Hashbox เก็บและใช้ข้อมูลตาม <a href="/privacy-policy/">นโยบายความเป็นส่วนตัว</a> (PDPA)</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-cta btn-submit">ส่งและรับ Audit ฟรี &rarr;</button>
                </form>
            </div>
        </div>
    </div>
</section>
