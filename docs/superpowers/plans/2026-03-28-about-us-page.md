# About Us Page Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Create a standalone `/about` WordPress page template with 7 sections following the Signal design system.

**Architecture:** WordPress page template (`page-about.php`) with dedicated CSS (`css/about-page.css`) and JS (`js/about.js`). Enqueued conditionally via `functions.php`. Reuses existing header/footer and design system CSS variables. All content hardcoded in Thai (no dynamic WordPress content).

**Tech Stack:** PHP (WordPress template), CSS (custom properties from Signal design system), Vanilla JS (IntersectionObserver for counters/reveal)

**Spec:** `docs/superpowers/specs/2026-03-28-about-us-page-design.md`

---

### Task 1: Create `page-about.php` — Hero + Why Hashbox sections

**Files:**
- Create: `page-about.php`

- [ ] **Step 1: Create page template with Hero section**

Create `page-about.php` with the WordPress template header comment, SEO meta tags, schema markup, and the first two sections:

```php
<?php
/**
 * Template Name: About Page
 *
 * Standalone About Us page for Hashbox Studio.
 *
 * @package Hashbox_Studio
 */

get_header();
?>

<!-- SEO Meta -->
<?php
// Set custom meta for this page
function hashbox_about_meta() {
    if ( is_page_template( 'page-about.php' ) ) {
        echo '<meta name="description" content="Hashbox Studio คือ agency ที่รวม Web Development ระดับ technical กับ AI Workflow Consulting ไว้ด้วยกัน นำทีมโดย Fullstack Developer 19 ปี อดีต Tech Evangelist จาก agency ระดับ award-winning">' . "\n";
    }
}
?>

<!-- ============ SECTION 1 — HERO ============ -->
<section class="about-hero">
    <div class="about-hero-orb about-hero-orb-blue"></div>
    <div class="about-hero-orb about-hero-orb-cyan"></div>
    <div class="about-hero-dot-grid"></div>

    <div class="container about-hero-container">
        <span class="section-label">ABOUT US</span>
        <h1 class="about-hero-headline">เราทำเว็บที่ perform<br>และสร้าง AI workforce ที่วัดผลได้</h1>
        <p class="about-hero-body">Hashbox Studio คือ Website Craft Agency + Digital Workforce Studio ที่รวม web expertise ระดับ technical กับ AI workflow consulting ไว้ในทีมเดียว</p>
        <div class="about-hero-actions">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-cta btn-lg">นัดปรึกษาฟรี</a>
            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-outline btn-lg">ดูผลงาน</a>
        </div>
    </div>
</section>

<!-- ============ SECTION 2 — ทำไมต้อง HASHBOX ============ -->
<section class="about-section about-surface">
    <div class="container">
        <div class="section-header">
            <span class="section-label">ทำไมต้อง HASHBOX</span>
        </div>
        <div class="about-why-grid">
            <div class="about-why-card about-why-problem">
                <h3 class="about-why-card-title about-why-problem-title">ปัญหาที่เจอซ้ำๆ</h3>
                <ul class="about-why-list">
                    <li class="about-why-item about-why-item-bad">
                        <span class="about-why-icon about-why-icon-bad">✕</span>
                        <span>จ้างบริษัททำเว็บ — สวยแต่ช้า</span>
                    </li>
                    <li class="about-why-item about-why-item-bad">
                        <span class="about-why-icon about-why-icon-bad">✕</span>
                        <span>จ้างบริษัททำ SEO — แนะนำได้แต่แก้ code ไม่เป็น</span>
                    </li>
                    <li class="about-why-item about-why-item-bad">
                        <span class="about-why-icon about-why-icon-bad">✕</span>
                        <span>จ้างบริษัททำ AI — ขายฝันแต่ implement ไม่ได้</span>
                    </li>
                </ul>
                <p class="about-why-footer">3 ทีมที่ไม่คุยกัน = ผลลัพธ์ที่ไม่ต่อกัน</p>
            </div>
            <div class="about-why-card about-why-solution">
                <h3 class="about-why-card-title about-why-solution-title">Hashbox แก้ปัญหานี้</h3>
                <ul class="about-why-list">
                    <li class="about-why-item about-why-item-good">
                        <span class="about-why-icon about-why-icon-good">✓</span>
                        <span>Web + SEO + AI ในทีมเดียว</span>
                    </li>
                    <li class="about-why-item about-why-item-good">
                        <span class="about-why-icon about-why-icon-good">✓</span>
                        <span>Developer ที่เข้าใจ SEO เขียน code ได้เลย</span>
                    </li>
                    <li class="about-why-item about-why-item-good">
                        <span class="about-why-icon about-why-icon-good">✓</span>
                        <span>AI ที่ implement ได้จริง วัด ROI ได้</span>
                    </li>
                </ul>
                <p class="about-why-footer">Website Craft Agency + Digital Workforce Studio</p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
```

- [ ] **Step 2: Commit**

```bash
git add page-about.php
git commit -m "feat: add page-about.php with hero and why-hashbox sections"
```

---

### Task 2: Add remaining sections to `page-about.php`

**Files:**
- Modify: `page-about.php`

- [ ] **Step 1: Add sections 3-7 before `get_footer()`**

Insert the following before `get_footer();` in `page-about.php` (replacing the closing `get_footer` call):

```php
<!-- ============ SECTION 3 — สิ่งที่เราทำ ============ -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">สิ่งที่เราทำ</span>
        </div>
        <div class="about-services-grid">
            <div class="about-service-card" data-accent="blue">
                <div class="about-service-accent accent-blue"></div>
                <h3 class="about-service-title">Website Development</h3>
                <p class="about-service-desc">สร้างเว็บไซต์ Corporate, Brand, E-commerce ด้วย tech stack ที่เหมาะสม — Next.js, WordPress, หรือ WordPress Headless โดยทุกโปรเจคมี Performance &amp; SEO built-in ตั้งแต่โครงสร้าง</p>
                <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="about-service-link">ดูบริการ &rarr;</a>
            </div>
            <div class="about-service-card" data-accent="cyan">
                <div class="about-service-accent accent-cyan"></div>
                <h3 class="about-service-title">Technical SEO &amp; Performance</h3>
                <p class="about-service-desc">บริการ SEO audit, Core Web Vitals optimization, Schema Markup และ site architecture จากทีมที่เป็นทั้ง developer และ SEO specialist</p>
                <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="about-service-link">ดูบริการ &rarr;</a>
            </div>
            <div class="about-service-card" data-accent="amber">
                <div class="about-service-accent accent-amber"></div>
                <h3 class="about-service-title">Digital Workforce Studio</h3>
                <p class="about-service-desc">ออกแบบ AI assistant, workflow automation และ chatbot สำหรับธุรกิจ ลดงาน manual ลดค่าใช้จ่าย วัด ROI ได้จริง</p>
                <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="about-service-link">ดูบริการ &rarr;</a>
            </div>
            <div class="about-service-card" data-accent="blue">
                <div class="about-service-accent accent-blue"></div>
                <h3 class="about-service-title">E-commerce</h3>
                <p class="about-service-desc">เว็บขายของออนไลน์ที่ออกแบบเพื่อ conversion พร้อม payment gateway ไทยและ SEO สำหรับ e-commerce โดยเฉพาะ</p>
                <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="about-service-link">ดูบริการ &rarr;</a>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 4 — TECH STACK + AI TOOLS ============ -->
<section class="about-section about-surface">
    <div class="container">
        <div class="about-tech-grid">
            <div class="about-tech-col">
                <span class="section-label">TECH STACK</span>
                <div class="about-tech-tags">
                    <span class="about-tech-tag about-tech-tag-blue">Next.js</span>
                    <span class="about-tech-tag about-tech-tag-blue">React</span>
                    <span class="about-tech-tag about-tech-tag-blue">Tailwind CSS</span>
                    <span class="about-tech-tag about-tech-tag-cyan">WordPress</span>
                    <span class="about-tech-tag about-tech-tag-cyan">WordPress Headless</span>
                    <span class="about-tech-tag about-tech-tag-amber">Node.js</span>
                    <span class="about-tech-tag about-tech-tag-amber">Python</span>
                </div>
            </div>
            <div class="about-tech-col">
                <span class="section-label">AI TOOLS ที่สร้างเอง</span>
                <ul class="about-tools-list">
                    <li class="about-tool-item">
                        <span class="about-tool-dot about-tool-dot-amber"></span>
                        <span>Paid Media Alert Tool</span>
                    </li>
                    <li class="about-tool-item">
                        <span class="about-tool-dot about-tool-dot-blue"></span>
                        <span>SEO Tracker</span>
                    </li>
                    <li class="about-tool-item">
                        <span class="about-tool-dot about-tool-dot-cyan"></span>
                        <span>Asearchlab</span>
                    </li>
                    <li class="about-tool-item">
                        <span class="about-tool-dot about-tool-dot-amber"></span>
                        <span>peec.AI</span>
                    </li>
                    <li class="about-tool-item">
                        <span class="about-tool-dot about-tool-dot-blue"></span>
                        <span>Query Fan-out</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 5 — สิ่งที่เราเชื่อ + ตัวเลข ============ -->
<section class="about-section">
    <div class="container">
        <div class="section-header">
            <span class="section-label">สิ่งที่เราเชื่อ</span>
        </div>
        <div class="about-values-grid">
            <div class="about-value-card about-value-blue">
                <h3 class="about-value-title">Technical Excellence</h3>
                <p class="about-value-desc">เราไม่ตัดมุม ทุกโปรเจคต้องผ่านมาตรฐาน Core Web Vitals ต้องมี SEO built-in และต้อง test อย่างครบถ้วนก่อน launch</p>
            </div>
            <div class="about-value-card about-value-cyan">
                <h3 class="about-value-title">Measurable Results</h3>
                <p class="about-value-desc">เราไม่ขายความรู้สึก ทุกสิ่งที่ทำต้องวัดผลได้ ไม่ว่าจะเป็น PageSpeed score, organic traffic, หรือ cost reduction จาก AI</p>
            </div>
            <div class="about-value-card about-value-amber">
                <h3 class="about-value-title">Transparency</h3>
                <p class="about-value-desc">ราคาชัดเจน ไม่มีค่าใช้จ่ายซ่อนเร้น timeline ที่ realistic ไม่สัญญาในสิ่งที่ทำไม่ได้</p>
            </div>
        </div>
        <div class="about-stats-bar">
            <div class="about-stat about-stat-blue">
                <span class="about-stat-num" data-target="19">0</span>
                <span class="about-stat-suffix"> ปี</span>
                <p class="about-stat-label">ประสบการณ์ด้าน development</p>
            </div>
            <div class="about-stat about-stat-cyan">
                <span class="about-stat-num" data-target="300">0</span>
                <span class="about-stat-suffix">+</span>
                <p class="about-stat-label">แบรนด์ที่เคยดูแล</p>
            </div>
            <div class="about-stat about-stat-amber">
                <span class="about-stat-num" data-target="90">0</span>
                <span class="about-stat-suffix">+</span>
                <p class="about-stat-label">คะแนน Core Web Vitals Desktop</p>
            </div>
            <div class="about-stat about-stat-blue">
                <span class="about-stat-num" data-target="6">0</span>
                <span class="about-stat-suffix"></span>
                <p class="about-stat-label">AI tools ที่สร้างขึ้นมาเอง</p>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 6 — ประสบการณ์ ============ -->
<section class="about-section about-surface">
    <div class="container">
        <div class="section-header">
            <span class="section-label">ประสบการณ์ที่หล่อหลอมเรา</span>
            <p class="section-sub">ผลงาน SEO ที่ Tum มีส่วนร่วมในช่วงที่เป็น Tech Evangelist ที่ award-winning SEO agency ดูแลมากกว่า 300 แบรนด์</p>
        </div>
        <div class="about-cases-grid">
            <div class="about-case-card about-case-blue">
                <h3 class="about-case-title">โปรเจค HR Tech Platform</h3>
                <p class="about-case-desc">Full technical SEO overhaul — optimize Core Web Vitals, แก้ crawlability issues, ใส่ Schema Markup ครบ, restructure site architecture ภายใน 12 เดือน</p>
                <div class="about-case-metrics">
                    <span class="about-metric about-metric-blue">+2,200% impressions</span>
                    <span class="about-metric about-metric-cyan">+700% organic traffic</span>
                    <span class="about-metric about-metric-amber">+540% users</span>
                </div>
            </div>
            <div class="about-case-card about-case-cyan">
                <h3 class="about-case-title">โปรเจค Home Service App</h3>
                <p class="about-case-desc">Technical SEO + Core Web Vitals optimization + SEO content strategy ที่ผสานกับ site structure ภายใน 6 เดือน</p>
                <div class="about-case-metrics">
                    <span class="about-metric about-metric-amber">50x impressions</span>
                    <span class="about-metric about-metric-blue">+300% clicks</span>
                    <span class="about-metric about-metric-cyan">+200% target audience</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SECTION 7 — CTA + CONTACT ============ -->
<section class="about-section about-cta-section">
    <div class="container about-cta-container">
        <h2 class="about-cta-title">พร้อมคุยกับเรา?</h2>
        <p class="about-cta-sub">นัดหมายปรึกษาฟรี 30 นาที</p>
        <div class="about-cta-info">
            <span>Email: project@hashbox.co.th</span>
            <span class="about-cta-divider">&middot;</span>
            <span>โทร: 02 266 6222</span>
            <span class="about-cta-divider">&middot;</span>
            <span>LINE: @hashboxstudio</span>
        </div>
        <p class="about-cta-address">139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500 · จันทร์ - ศุกร์ 9:00 - 18:00</p>
        <div class="about-cta-actions">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-cta btn-lg">นัดปรึกษาฟรี &rarr;</a>
            <a href="https://lin.ee/Xagx6i4" class="btn btn-outline-cyan btn-lg" target="_blank" rel="noopener noreferrer">LINE OA</a>
        </div>
    </div>
</section>

<!-- Schema Markup -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "Organization",
            "@id": "https://hashbox.co.th/#organization",
            "name": "Hashbox Studio",
            "alternateName": "Hashbox Co., Ltd.",
            "url": "https://hashbox.co.th",
            "logo": "https://hashbox.co.th/logo.png",
            "description": "Website Craft Agency + Digital Workforce Studio",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "139 Pan Rd, Si Lom, Bang Rak",
                "addressLocality": "Bangkok",
                "postalCode": "10500",
                "addressCountry": "TH"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+66-2-266-6222",
                "email": "project@hashbox.co.th",
                "contactType": "customer service"
            },
            "founder": {
                "@type": "Person",
                "name": "Thaweewat Sriaroonthip",
                "jobTitle": "Co-founder & Head of Technology"
            },
            "sameAs": [
                "https://lin.ee/Xagx6i4"
            ]
        },
        {
            "@type": "AboutPage",
            "name": "About Hashbox Studio",
            "url": "https://hashbox.co.th/about",
            "mainEntity": { "@id": "https://hashbox.co.th/#organization" }
        }
    ]
}
</script>

<?php
get_footer();
```

- [ ] **Step 2: Commit**

```bash
git add page-about.php
git commit -m "feat: add sections 3-7 to about page (services, tech, values, cases, CTA)"
```

---

### Task 3: Create `css/about-page.css` — Hero + Why Hashbox + Services styles

**Files:**
- Create: `css/about-page.css`

- [ ] **Step 1: Create the CSS file with hero, why-hashbox, and services styles**

```css
/* =============================================
   ABOUT PAGE — Hashbox Studio
   Uses Signal Design System CSS variables from style.css
   ============================================= */

/* =============================================
   LAYOUT
   ============================================= */
.about-section {
    padding: 100px 0;
}

.about-surface {
    background: rgba(24, 24, 27, 0.5);
}

/* =============================================
   SECTION 1 — HERO
   ============================================= */
.about-hero {
    position: relative;
    padding: calc(var(--header-height) + 80px) 0 80px;
    overflow: hidden;
    background: var(--color-bg);
}

.about-hero-dot-grid {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(250, 250, 250, 0.04) 1px, transparent 1px);
    background-size: 32px 32px;
    z-index: 0;
}

.about-hero-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    z-index: 0;
}

.about-hero-orb-blue {
    width: 400px;
    height: 400px;
    background: rgba(37, 99, 235, 0.12);
    top: -100px;
    right: 10%;
}

.about-hero-orb-cyan {
    width: 300px;
    height: 300px;
    background: rgba(6, 182, 212, 0.08);
    bottom: -50px;
    left: 5%;
}

.about-hero-container {
    position: relative;
    z-index: 1;
    max-width: 720px;
}

.about-hero .section-label {
    margin-bottom: 20px;
}

.about-hero-headline {
    font-size: clamp(32px, 5vw, 52px);
    font-family: var(--font-display);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    color: var(--color-text);
    margin-bottom: 20px;
}

.about-hero-body {
    font-size: 1.1rem;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin-bottom: 32px;
    max-width: 600px;
}

.about-hero-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

/* =============================================
   SECTION 2 — WHY HASHBOX
   ============================================= */
.about-why-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.about-why-card {
    background: var(--color-surface);
    border-radius: var(--radius-lg);
    padding: 32px;
}

.about-why-problem {
    border: 1px solid rgba(239, 68, 68, 0.25);
}

.about-why-solution {
    border: 1px solid rgba(6, 182, 212, 0.25);
}

.about-why-card-title {
    font-size: 1.1rem;
    font-family: var(--font-display);
    font-weight: 600;
    margin-bottom: 20px;
}

.about-why-problem-title {
    color: #ef4444;
}

.about-why-solution-title {
    color: var(--color-secondary);
}

.about-why-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
    margin-bottom: 20px;
}

.about-why-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: var(--color-text-muted);
    font-size: 0.95rem;
    line-height: 1.5;
}

.about-why-icon {
    flex-shrink: 0;
    font-weight: 700;
    font-size: 1rem;
    width: 20px;
    text-align: center;
}

.about-why-icon-bad {
    color: #ef4444;
}

.about-why-icon-good {
    color: var(--color-secondary);
}

.about-why-footer {
    color: var(--color-text-dim);
    font-size: 0.85rem;
    padding-top: 16px;
    border-top: 1px solid var(--color-border);
}

/* =============================================
   SECTION 3 — SERVICES
   ============================================= */
.about-services-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.about-service-card {
    background: var(--color-surface);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-lg);
    padding: 28px;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-service-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.about-service-accent {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
}

.about-service-accent.accent-blue {
    background: var(--color-accent);
}

.about-service-accent.accent-cyan {
    background: var(--color-secondary);
}

.about-service-accent.accent-amber {
    background: var(--color-highlight);
}

.about-service-title {
    font-size: 1.15rem;
    font-family: var(--font-display);
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 10px;
}

.about-service-desc {
    color: var(--color-text-muted);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 16px;
}

.about-service-link {
    color: var(--color-accent-light);
    font-size: 0.9rem;
    font-weight: 600;
    transition: color 0.3s ease;
}

.about-service-link:hover {
    color: var(--color-text);
}
```

- [ ] **Step 2: Commit**

```bash
git add css/about-page.css
git commit -m "feat: add about-page.css with hero, why-hashbox, services styles"
```

---

### Task 4: Add remaining CSS to `css/about-page.css`

**Files:**
- Modify: `css/about-page.css`

- [ ] **Step 1: Append tech stack, values, cases, CTA, and responsive styles**

Append to the end of `css/about-page.css`:

```css

/* =============================================
   SECTION 4 — TECH STACK + AI TOOLS
   ============================================= */
.about-tech-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
}

.about-tech-col .section-label {
    margin-bottom: 20px;
}

.about-tech-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.about-tech-tag {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
}

.about-tech-tag-blue {
    background: rgba(37, 99, 235, 0.1);
    border: 1px solid rgba(37, 99, 235, 0.25);
    color: var(--color-accent-light);
}

.about-tech-tag-cyan {
    background: rgba(6, 182, 212, 0.1);
    border: 1px solid rgba(6, 182, 212, 0.25);
    color: var(--color-secondary);
}

.about-tech-tag-amber {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.25);
    color: var(--color-highlight);
}

.about-tools-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.about-tool-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--color-text-muted);
    font-size: 0.95rem;
}

.about-tool-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.about-tool-dot-blue {
    background: var(--color-accent-light);
}

.about-tool-dot-cyan {
    background: var(--color-secondary);
}

.about-tool-dot-amber {
    background: var(--color-highlight);
}

/* =============================================
   SECTION 5 — VALUES + STATS
   ============================================= */
.about-values-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 40px;
}

.about-value-card {
    background: var(--color-surface);
    border-radius: var(--radius-lg);
    padding: 28px;
    text-align: center;
}

.about-value-blue {
    border: 1px solid rgba(37, 99, 235, 0.2);
}

.about-value-cyan {
    border: 1px solid rgba(6, 182, 212, 0.2);
}

.about-value-amber {
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.about-value-title {
    font-size: 1.05rem;
    font-family: var(--font-display);
    font-weight: 700;
    margin-bottom: 10px;
}

.about-value-blue .about-value-title {
    color: var(--color-accent-light);
}

.about-value-cyan .about-value-title {
    color: var(--color-secondary);
}

.about-value-amber .about-value-title {
    color: var(--color-highlight);
}

.about-value-desc {
    color: var(--color-text-muted);
    font-size: 0.9rem;
    line-height: 1.6;
}

.about-stats-bar {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding-top: 40px;
    border-top: 1px solid var(--color-border);
    text-align: center;
}

.about-stat-num {
    font-family: var(--font-display);
    font-size: clamp(28px, 4vw, 40px);
    font-weight: 700;
    line-height: 1;
}

.about-stat-suffix {
    font-family: var(--font-display);
    font-size: clamp(18px, 2.5vw, 24px);
    font-weight: 600;
}

.about-stat-blue .about-stat-num,
.about-stat-blue .about-stat-suffix {
    color: var(--color-accent-light);
}

.about-stat-cyan .about-stat-num,
.about-stat-cyan .about-stat-suffix {
    color: var(--color-secondary);
}

.about-stat-amber .about-stat-num,
.about-stat-amber .about-stat-suffix {
    color: var(--color-highlight);
}

.about-stat-label {
    color: var(--color-text-dim);
    font-size: 0.8rem;
    margin-top: 6px;
}

/* =============================================
   SECTION 6 — CASE STUDIES
   ============================================= */
.about-cases-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.about-case-card {
    background: var(--color-surface);
    border-radius: var(--radius-lg);
    padding: 28px;
}

.about-case-blue {
    border: 1px solid rgba(37, 99, 235, 0.25);
}

.about-case-cyan {
    border: 1px solid rgba(6, 182, 212, 0.25);
}

.about-case-title {
    font-size: 1.1rem;
    font-family: var(--font-display);
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 10px;
}

.about-case-desc {
    color: var(--color-text-muted);
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 16px;
}

.about-case-metrics {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.about-metric {
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 600;
}

.about-metric-blue {
    background: rgba(37, 99, 235, 0.12);
    color: var(--color-accent-light);
}

.about-metric-cyan {
    background: rgba(6, 182, 212, 0.12);
    color: var(--color-secondary);
}

.about-metric-amber {
    background: rgba(245, 158, 11, 0.12);
    color: var(--color-highlight);
}

/* =============================================
   SECTION 7 — CTA + CONTACT
   ============================================= */
.about-cta-section {
    background: linear-gradient(135deg, rgba(17, 17, 40, 0.8), var(--color-bg));
    text-align: center;
}

.about-cta-container {
    max-width: 640px;
}

.about-cta-title {
    font-size: clamp(28px, 4vw, 44px);
    font-family: var(--font-display);
    font-weight: 700;
    color: var(--color-text);
    margin-bottom: 12px;
}

.about-cta-sub {
    color: var(--color-text-muted);
    font-size: 1.1rem;
    margin-bottom: 20px;
}

.about-cta-info {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    color: var(--color-text-dim);
    font-size: 0.9rem;
    margin-bottom: 8px;
}

.about-cta-divider {
    color: var(--color-border);
}

.about-cta-address {
    color: var(--color-text-dim);
    font-size: 0.85rem;
    margin-bottom: 28px;
}

.about-cta-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

/* =============================================
   SCROLL REVEAL (reuse from main theme)
   ============================================= */
.about-section .reveal {
    opacity: 0;
    transform: translateY(32px);
    transition: opacity 0.7s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

.about-section .reveal.visible {
    opacity: 1;
    transform: translateY(0);
}

/* =============================================
   RESPONSIVE — TABLET (768px)
   ============================================= */
@media (max-width: 768px) {
    .about-section {
        padding: 72px 0;
    }

    .about-hero {
        padding: calc(var(--header-height) + 48px) 0 56px;
    }

    .about-hero-headline {
        font-size: clamp(26px, 7vw, 36px);
    }

    .about-why-grid,
    .about-services-grid,
    .about-tech-grid,
    .about-cases-grid {
        grid-template-columns: 1fr;
    }

    .about-values-grid {
        grid-template-columns: 1fr;
    }

    .about-stats-bar {
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .about-cta-info {
        flex-direction: column;
        gap: 4px;
    }

    .about-cta-divider {
        display: none;
    }
}

/* =============================================
   RESPONSIVE — MOBILE (480px)
   ============================================= */
@media (max-width: 480px) {
    .about-hero-headline {
        font-size: 24px;
    }

    .about-hero-actions {
        flex-direction: column;
    }

    .about-hero-actions .btn {
        width: 100%;
    }

    .about-stats-bar {
        grid-template-columns: 1fr 1fr;
    }

    .about-cta-actions {
        flex-direction: column;
    }

    .about-cta-actions .btn {
        width: 100%;
    }
}
```

- [ ] **Step 2: Commit**

```bash
git add css/about-page.css
git commit -m "feat: add tech, values, cases, CTA, responsive styles to about-page.css"
```

---

### Task 5: Create `js/about.js` — Counter animation + scroll reveal

**Files:**
- Create: `js/about.js`

- [ ] **Step 1: Create JS file with counter animation and scroll reveal**

```javascript
// HASHBOX STUDIO — About Page JS
// Counter animation + scroll reveal for /about page

document.addEventListener('DOMContentLoaded', () => {

    // =============================================
    // 1. COUNTER ANIMATION
    // =============================================
    const counterElements = document.querySelectorAll('.about-stat-num[data-target]');

    const animateCounter = (el) => {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const duration = 1800;
        const startTime = performance.now();

        const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);

        const update = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            const current = Math.round(easedProgress * target);
            el.textContent = current;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        };

        requestAnimationFrame(update);
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counterElements.forEach(el => counterObserver.observe(el));

    // =============================================
    // 2. SCROLL REVEAL
    // =============================================
    const revealElements = document.querySelectorAll(
        '.about-why-card, .about-service-card, .about-tech-col, ' +
        '.about-value-card, .about-stat, .about-case-card, ' +
        '.section-header, .about-cta-container'
    );

    revealElements.forEach(el => el.classList.add('reveal'));

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const parent = entry.target.parentElement;
                const siblings = parent ? Array.from(parent.children).filter(c => c.classList.contains('reveal')) : [];
                const siblingIndex = siblings.indexOf(entry.target);
                const delay = siblingIndex >= 0 ? siblingIndex * 80 : 0;

                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay);

                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

});
```

- [ ] **Step 2: Commit**

```bash
git add js/about.js
git commit -m "feat: add about.js with counter animation and scroll reveal"
```

---

### Task 6: Update `functions.php` — Enqueue about page assets

**Files:**
- Modify: `functions.php`

- [ ] **Step 1: Add enqueue function after the existing `hashbox_enqueue_portfolio_assets` function**

Find the line `add_action('wp_enqueue_scripts', 'hashbox_enqueue_portfolio_assets');` (line 150 in `functions.php`) and add the following block after it:

```php

// Enqueue about page assets
function hashbox_enqueue_about_assets() {
    if (is_page_template('page-about.php')) {
        wp_enqueue_style(
            'hashbox-about-css',
            get_template_directory_uri() . '/css/about-page.css',
            array('hashbox-style'),
            '1.0.0'
        );

        wp_enqueue_script(
            'hashbox-about-js',
            get_template_directory_uri() . '/js/about.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'hashbox_enqueue_about_assets');
```

- [ ] **Step 2: Add meta description hook**

Find the line `add_action('after_setup_theme', 'hashbox_theme_setup');` (line 36 in `functions.php`) and add after it:

```php

/**
 * Add meta description for About page
 */
function hashbox_about_meta_description() {
    if ( is_page_template( 'page-about.php' ) ) {
        echo '<meta name="description" content="Hashbox Studio คือ agency ที่รวม Web Development ระดับ technical กับ AI Workflow Consulting ไว้ด้วยกัน นำทีมโดย Fullstack Developer 19 ปี อดีต Tech Evangelist จาก agency ระดับ award-winning">' . "\n";
    }
}
add_action( 'wp_head', 'hashbox_about_meta_description', 1 );
```

- [ ] **Step 3: Remove the inline meta function from `page-about.php`**

In `page-about.php`, remove the unused inline `hashbox_about_meta()` function definition (the block between `<!-- SEO Meta -->` and `<!-- ============ SECTION 1`). The meta is now handled via the `wp_head` hook in `functions.php`.

- [ ] **Step 4: Commit**

```bash
git add functions.php page-about.php
git commit -m "feat: enqueue about page CSS/JS and add meta description hook"
```

---

### Task 7: WordPress setup + final verification

**Files:**
- No file changes — WordPress admin setup + visual check

- [ ] **Step 1: Create the WordPress page**

In WordPress admin:
1. Go to Pages → Add New
2. Title: "เกี่ยวกับเรา"
3. Slug: `about`
4. In Page Attributes → Template: select "About Page"
5. Publish

- [ ] **Step 2: Verify the page loads**

Visit `https://hashbox.co.th/about` (or local dev URL) and verify:
- Header and footer render correctly
- All 7 sections display
- Counter animation triggers on scroll
- Scroll reveal animations work
- CTA buttons link correctly (to landing page #contact and /portfolio)
- LINE OA button opens in new tab
- Mobile responsive: check at 768px and 480px breakpoints
- Schema markup appears in page source (search for `application/ld+json`)

- [ ] **Step 3: Commit any fixes if needed and push**

```bash
git push origin main
```
