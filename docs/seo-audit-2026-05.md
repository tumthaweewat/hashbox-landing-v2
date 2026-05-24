# SEO Technical Audit — Hashbox Studio V2

**วันที่:** 2026-05-23
**Theme:** `hashbox-studio-v2`
**โดเมน:** hashbox.co.th
**Scope:** ตรวจทุกหน้าใน theme เทียบกับเกณฑ์ Google Search ล่าสุด (March 2024 → March 2026 Core Updates, AI Overviews, INP, FAQ deprecation พ.ค. 2026)

---

## Remediation Log

อัปเดต **2026-05-23** หลังลงมือแก้ตาม Roadmap:

### ✅ ทำเสร็จแล้ว

| รายการ | ไฟล์ | สถานะ |
|---|---|---|
| Service+Breadcrumb+FAQ schema ครบทั้ง 3 หน้า service | `page-seo-ready-website.php:174-186`, `page-digital-marketing-tools.php:155-166`, `page-ai-consulting.php:176-186` | มีอยู่แล้วเดิม (audit อ่านพลาด) |
| Article `author` เป็น `Person` entity + `sameAs` | `functions.php` `hashbox_inject_post_schema()` + `hashbox_author_schema()` ใหม่ | ✓ |
| `<meta name="robots" content="noindex,follow">` บน search, 404, portfolio, paginated archives | `functions.php` `hashbox_seo_noindex_meta()` ใหม่ | ✓ |
| `404.php` พร้อม helpful nav + 4 service cards + search form | `404.php` ใหม่ | ✓ |
| `single.php` featured image: เพิ่ม `sizes`, `decoding="async"` | `single.php:40-46` | ✓ |
| Preload LCP image (featured image ของหน้า singular) | `functions.php` `hashbox_preload_critical_assets()` ใหม่ | ✓ |
| `LocalBusiness` dual-type (`["ProfessionalService","LocalBusiness"]`) + `openingHoursSpecification` + `geo` + `telephone` + `email` + `image` + `address` | `functions.php` `hashbox_rankmath_schema_service()` + `hashbox_inject_home_schema()` | ✓ |
| Organization schema เพิ่ม `address` (เดิมไม่มี) | `functions.php` `hashbox_rankmath_schema_organization()` | ✓ |
| Canonical fallback เมื่อ Rank Math inactive | `functions.php:716` ใน `hashbox_homepage_meta_description()` | ✓ |
| ลบ `og:locale:alternate en_US` (ไม่มีหน้า EN จริง) | `functions.php` | ✓ |
| `.htaccess` mod_expires + mod_deflate รองรับ AVIF/WebP/woff2/JSON-LD | `.htaccess` | ✓ |
| User profile fields: LinkedIn, X, GitHub, Job Title | `functions.php` `hashbox_user_contact_methods()` ใหม่ | ✓ |
| `author.php` template พร้อม bio, social links, ProfilePage+Person schema | `author.php` ใหม่ | ✓ |
| `footer.php` แก้ Terms/PDPA จาก URL ซ้ำ → anchor link บนหน้า privacy-policy | `footer.php:57-59` | ✓ |
| **รอบ 2 (commit ถัดไป)** | | |
| `Service` ItemList schema บน `/services/` hub พร้อม @id ref ไปยังหน้าย่อย | `page-services.php` ส่วน schema | ✓ |
| Blog featured image (`home.php`) เปลี่ยนเป็น `wp_get_attachment_image()` → ได้ `srcset` + `sizes` อัตโนมัติ จาก WordPress + `decoding="async"` | `home.php` featured section | ✓ |
| Post card image (`template-parts/post-card.php`) เปลี่ยนเป็น `wp_get_attachment_image()` → `srcset` + `sizes` อัตโนมัติ | `template-parts/post-card.php` | ✓ |
| ตรวจสอบยืนยัน — page-work.php มี CollectionPage + ItemList ครบแล้ว, page-about.php มี AboutPage schema ครบแล้ว | — | ตรวจแล้ว ✓ |
| **รอบ 3 (commit ถัดไป)** | | |
| `rel="me"` บนลิงก์ social ใน footer (LinkedIn/FB/IG/LINE) — identity verification + E-E-A-T | `footer.php:15-18` | ✓ |
| `og:image:width` + `og:image:height` ใน OG meta — แก้ social card placeholder LCP | `functions.php` `hashbox_homepage_meta_description()` + helpers ใหม่ `hashbox_default_og_image_dimensions()` / `hashbox_og_image_dimensions()` | ✓ |
| `Speakable` schema (SpeakableSpecification) บน FAQPage ทั้ง 4 ตำแหน่ง (home + 3 service pages) — voice search/AI Mode signal | `functions.php` `hashbox_inject_home_faq_schema()` + `page-{ai-consulting,seo-ready-website,digital-marketing-tools}.php` | ✓ |
| Breadcrumb สำหรับ search results เปลี่ยนเป็น Home → Search (เดิม Home → Blog → Search ซึ่งสมมติว่า search มาจาก blog scope) | `template-parts/breadcrumbs.php:27-29` | ✓ |
| **รอบ 4 (commit ถัดไป)** | | |
| Defer legacy `style.css` (43K) — V2 templates ใช้แต่ `.hb-*` จาก /design-system/, legacy V1 classes (.about-*, .hero-*) ไม่ถูก reference เลย → ใช้ `media="print" onload=...` trick + `<noscript>` fallback ตัด render-blocking CSS ~30% | `functions.php` `hashbox_defer_legacy_stylesheet()` | ✓ |
| **รอบ 5 (commit ถัดไป) — INP / TBT** | | |
| Sticky-nav scroll listener: rAF batch + cached `scrolled` state, ไม่ `classList.toggle` ทุก scroll tick (เดิม toggle ทุก event แม้สถานะไม่เปลี่ยน → style recalc loop) | `js/v2.js` ส่วน sticky nav | ✓ |
| Mobile sheet anchor closing: event delegation on `.hb-sheet` แทน addEventListener ทุก `<a>` (เดิม N listener × link count → init cost + memory) | `js/v2.js` ส่วน sheet | ✓ |
| Smooth scroll: event delegation บน document แทน N listeners ที่ทุก `a[href^="#"]` + try/catch กรณี href ไม่ใช่ valid selector (`#`, `#!`, etc.) | `js/v2.js` ส่วน smooth scroll | ✓ |

### ⏸ ยังไม่ได้ทำ — ต้องใช้ decision/external infrastructure

| รายการ | เหตุผล | ผู้รับผิดชอบ |
|---|---|---|
| Hreflang Thai/English | ยังไม่มีหน้า English จริง — ถ้าจะทำต้องสร้าง subdirectory `/en/` ทั้งระบบ | Product decision |
| WebP/AVIF image generation | ต้องติดตั้ง WordPress plugin (Imagify / Modern Image Formats) หรือ image CDN | DevOps |
| CSS bundling (7 → 1 file) | CLAUDE.md ระบุ "no build step" — ต้องเปลี่ยน policy ก่อน | Product/Eng decision |
| ขยาย About page ด้วย team members + credentials | ต้องเก็บข้อมูล + รูปสมาชิกทีม + ใบ certification | Marketing |
| สร้างหน้า Terms / PDPA แยก | ต้องร่างกฎหมายโดยทนาย — ตอนนี้ใช้ anchor บนหน้า privacy-policy | Legal |
| Portfolio images จริง | `assets/portfolio-images/` ยังว่าง (audit พบ) — ต้องเพิ่มไฟล์รูป | Design |
| Direct-answer pattern + `<ol>` semantic บนหน้า home process | ต้องแก้ content + template-parts/* — ขอบเขตใหญ่ ขอแยก PR | Future sprint |

ดูรายละเอียดเดิมด้านล่างเพื่อ context ของแต่ละการแก้

---

## 0. Executive Summary

ภาพรวม theme มีพื้นฐาน Technical SEO ที่ **แข็งแรงระดับสูงกว่ามาตรฐาน** — มี schema graph ครบ (Organization + WebSite + ProfessionalService + FAQ + Article + BreadcrumbList), title/description แบบ context-aware ทุกประเภทหน้า, semantic HTML สะอาด, HTTPS + HSTS + security headers ครบ, JS deferred ทั้งหมด, Google Fonts ใช้ `display=swap` + preconnect

**คะแนนสรุปต่อหมวด** (เทียบเกณฑ์ Google 2025-2026)

| หมวด | คะแนน | สถานะ |
|---|---|---|
| Core Web Vitals (LCP / INP / CLS) | 6/10 | มี CLS risk จากรูป (ไม่มี width/height หลายจุด), ไม่มี preload LCP image |
| E-E-A-T / Helpful Content | 5/10 | Author schema ผูกกับ Organization ทุก post — ขาด Person entity + sameAs |
| AI Overviews / Passage Indexing | 7/10 | Semantic HTML ดี, FAQ ครบ — แต่ขาด direct-answer pattern ในบาง section |
| Structured Data | 8/10 | ครอบคลุมเกือบทั้งเว็บ — ขาด Service schema บนหน้า service ย่อย, Author เป็น Person |
| March 2024 + Dec 2025 + March 2026 Core Updates | 8/10 | ไม่มี scaled content / parasite SEO — โครงสร้างปลอดภัย |
| Crawl / Index | 7/10 | ขาด hreflang, ไม่มี noindex บน search.php, ไม่มี 404.php |
| JavaScript Rendering | 9/10 | SSR ผ่าน WordPress, JS deferred ทั้งหมด, ไม่มี hash routing |
| Image SEO | 4/10 | ไม่มี WebP/AVIF, ไม่มี srcset/sizes, รูปบางส่วนขาด width/height |
| HTTPS / Security | 10/10 | ครบทุก header ที่ควรมี + HSTS preload |
| International / Thai Local SEO | 6/10 | `lang="th-TH"` ✓, NAP ครบ — แต่ไม่มี hreflang, ไม่ใช้ LocalBusiness, ไม่มี openingHoursSpecification |

**Priority Fix List** (สรุปก่อนลงรายละเอียด):

1. **P0 — High Risk** เพิ่ม `loading="lazy"` กับ `width`/`height` กับรูปทุกจุดใน `front-page.php` (CLS), เพิ่ม `<link rel="preload">` สำหรับ LCP image และ Thai font woff2
2. **P0** เพิ่ม Service schema บน 3 หน้า service ย่อย (`page-seo-ready-website.php`, `page-digital-marketing-tools.php` — `page-ai-consulting.php` มีแล้ว)
3. **P0** เปลี่ยน Article `author` จาก Organization → `Person` entity + `sameAs`
4. **P1** เพิ่ม `<meta name="robots" content="noindex,follow">` บน `search.php`
5. **P1** เพิ่ม `LocalBusiness` schema (subclass ของ ProfessionalService) พร้อม `openingHoursSpecification`, `geo`
6. **P1** สร้าง `404.php` พร้อม helpful redirect navigation
7. **P2** แปลงรูปเป็น WebP/AVIF + `srcset` หลายขนาด
8. **P2** เพิ่ม hreflang ถ้ามีแผนทำเวอร์ชัน English
9. **P2** แยก Privacy / Terms / PDPA เป็น 3 หน้า (ตอนนี้ลิงก์ไป URL เดียวกันใน `footer.php:57-59`)

---

## 1. Core Web Vitals

### เกณฑ์ Google (พ.ค. 2026)

| Metric | Good | Needs Improvement | Poor |
|---|---|---|---|
| **LCP** | ≤ 2.5s | ≤ 4.0s | > 4.0s |
| **INP** | ≤ 200ms | ≤ 500ms | > 500ms |
| **CLS** | ≤ 0.1 | ≤ 0.25 | > 0.25 |

INP แทน FID ตั้งแต่ มี.ค. 2024 — ปัจจุบันยังเป็น metric ที่ fail สูงสุด (~43% ของเว็บ)

### ผลตรวจสอบ

**✓ ทำได้ดี**
- Google Fonts ใช้ `display=swap` ลด FOIT (`functions.php:71`)
- Preconnect ไปยัง `fonts.googleapis.com` + `fonts.gstatic.com` ครบ (`functions.php:111-123`)
- JS ทั้งหมด enqueue ที่ footer (`$in_footer=true`) — `functions.php:103, 169, 196`
- รูป featured ในบล็อก ใช้ `fetchpriority="high"` + `width="1200" height="675"` (`home.php:68`)
- รูป card บล็อก ใช้ `loading="lazy" decoding="async" width="800" height="450"` (`template-parts/post-card.php:25`)

**⚠ ต้องแก้ — High Severity**

| ปัญหา | ที่ | ผลกระทบ |
|---|---|---|
| รูป Featured ใน `single.php:40-44` (`the_post_thumbnail('full', ...)`) ไม่มี `width`/`height` explicit | `single.php:40-44` | **CLS risk** — รูปขนาดใหญ่จะ reflow layout |
| รูป portfolio ใน `front-page.php` (อ้างผ่าน `assets/portfolio-images/`) ไม่มี `width/height`, ไม่มี `loading`, ไม่มี `fetchpriority` | `front-page.php` (section portfolio) | CLS + LCP degradation บนมือถือ |
| **ไม่มี `<link rel="preload">`** สำหรับ LCP element (hero text/image) หรือ Thai font woff2 | `header.php` | LCP ช้าขึ้น ~300-800ms บนมือถือ |
| CSS โหลด 7 ไฟล์แยก (tokens → primitives → surface → navigation → interactive → composed → style.css) | `functions.php:79-91` | Render-blocking — รวมเป็นไฟล์เดียวด้วย build step จะลด LCP |
| ไม่มี critical CSS inlined ใน `<head>` | `header.php` | LCP จะรอ external CSS โหลดเสร็จก่อน paint |

**Action items**

1. แก้ `single.php:40-44`:
   ```php
   the_post_thumbnail('full', array(
       'loading' => 'eager',
       'fetchpriority' => 'high',
       'width' => 1200,
       'height' => 675,  // หรือ aspect ratio ที่ตรงกับ image size ที่ใช้
   ));
   ```
2. ใน `header.php` เพิ่ม preload Thai font หลัก:
   ```html
   <link rel="preload" as="font" type="font/woff2"
         href="https://fonts.gstatic.com/s/ibmplexsansthai/v.../...woff2" crossorigin>
   ```
3. ตรวจ hero ใน `template-parts/hero.php` (ถ้ามี image ให้ใส่ `fetchpriority="high"` + ไม่ใส่ `loading="lazy"`)
4. เปิด build step (Vite/esbuild) เพื่อ bundle CSS — ลด HTTP requests จาก 7 → 1

---

## 2. E-E-A-T / Helpful Content

### เกณฑ์ Google (Dec 2025 + March 2026 Core Updates)

- March 2026 Core Update ลด traffic ของหน้า scaled/AI-paraphrased ~71%
- Google เพิ่มหมวด **"Authors"** ใน Search Central docs (1 ก.พ. 2026) — โปร่งใสเรื่องผู้เขียนเป็น quality consideration อย่างเป็นทางการ
- หน้าที่มี **Author entity verification** (Person schema + sameAs) ถูก cite ใน AI Overviews มากกว่า 2.3 เท่า (Wellows 2026)

### ผลตรวจสอบ

**✓ ทำได้ดี**
- About page (`page-about.php`) มี team background, 17 ปีประสบการณ์รวม, 300+ brands
- Author byline บน blog post: ชื่อ + Gravatar + วันที่ + reading time (`template-parts/post-meta.php:8-31`)
- Modified date แสดงเมื่อต่างจาก published >24 ชม. (`template-parts/post-meta.php:27-29`)
- NAP (Name/Address/Phone) ใน footer ตรงกับ Organization schema (`footer.php:45-49` vs `functions.php:1244-1250`)

**⚠ ต้องแก้ — High Severity**

| ปัญหา | ที่ | เกณฑ์ Google |
|---|---|---|
| `author` ใน Article schema ผูกกับ `@id => '#organization'` — ไม่ใช่ `Person` | `functions.php:1807` | Google รองรับทั้งคู่ แต่ `Person` + `sameAs` ส่งสัญญาณ E-E-A-T แรงกว่ามาก |
| ไม่มีหน้า author archive แบบ custom — author bio + credentials | (ไม่มี `author.php`) | March 2026 update เน้น authorship transparency |
| ไม่มี `mentions` หรือ `citation` ในบทความ — Google ใช้ outbound citations เพื่อยืนยัน authority | `single.php` template | Helpful Content signal |
| About page ขาด individual team member photos + credentials | `page-about.php` | E-A-T สำหรับ agency เน้น individual expertise |

**Action items**

1. แก้ `functions.php:1797-1815` `hashbox_inject_post_schema()` — เปลี่ยน author:
   ```php
   'author' => array(
       '@type' => 'Person',
       'name'  => get_the_author_meta('display_name', $post_obj->post_author),
       'url'   => get_author_posts_url($post_obj->post_author),
       'sameAs' => array(  // ดึงจาก user meta
           get_the_author_meta('linkedin', $post_obj->post_author),
           get_the_author_meta('twitter', $post_obj->post_author),
       ),
   ),
   ```
2. เพิ่ม custom field LinkedIn / Twitter ใน user profile (ใช้ `show_user_profile` hook ใน `functions.php`)
3. สร้าง `author.php` template แสดง bio + posts ของ author
4. ขยาย `page-about.php` ให้มี section ทีม + ใบรับรอง (ถ้ามี เช่น Google Analytics IQ, HubSpot certs)

---

## 3. AI Overviews / AI Mode / Passage Indexing

### เกณฑ์ Google (พ.ค. 2026)

- AI Overviews ปรากฏใน **48% ของ query** (Feb 2026)
- หน้าที่มี schema ถูก cite ใน AI Overviews **3 เท่า** ของหน้าที่ไม่มี
- AI Mode มี **citation overlap แค่ 14%** กับ top-10 ranking ปกติ — ต้อง optimize ต่างหาก
- Pattern ที่ AI ชอบ cite: H2 = คำถาม → คำตอบสั้น 1-3 ประโยค → ขยายความ (134-167 คำต่อ passage)

### ผลตรวจสอบ

**✓ ทำได้ดี**
- Semantic HTML แข็งแกร่ง — ทุก section มี `<section>` + heading ตรงตามลำดับ (`front-page.php`)
- FAQ schema บน homepage 7 Q&A พร้อม visible accordion (`functions.php:1373-1405` + `hashbox_get_home_faqs()` 1335-1366)
- FAQ schema บนหน้า service ย่อย (`page-ai-consulting.php:186`)
- ใช้ `<table>`, `<ul>`, `<dl>` แทน CSS grid (ตรวจ template ส่วนใหญ่)

**ℹ Note สำคัญ — FAQ Rich Results**

Google ลบ FAQ rich snippets ออกจาก SERP ตั้งแต่ **7 พ.ค. 2026** (ก่อนหน้านี้จำกัดเฉพาะ gov/health ตั้งแต่ ส.ค. 2023) — **แต่ FAQPage schema ยังควรเก็บไว้** เพราะ AI Overviews / AI Mode ใช้ schema นี้เป็น input โดยตรง

**⚠ ต้องปรับ — Medium Severity**

| ปัญหา | ที่ | แก้อย่างไร |
|---|---|---|
| Section "ทีมเดียวที่รับผิดชอบทั้ง Traffic..." (`front-page.php:133`) ไม่มี direct-answer pattern | `template-parts/why-hashbox.php` | เริ่มด้วยคำตอบ 1-2 ประโยค ก่อน bullet points |
| Section "From Audit to AI — กระบวนการ" (`front-page.php:167`) ใช้ ordered list แต่ไม่มี `<ol>` semantic | `template-parts/digital-workforce.php` (?) | เปลี่ยนเป็น `<ol>` พร้อม `<li>` ตรงๆ |
| Hero H1 ยาวมาก ("รับทำเว็บไซต์ SEO-Ready พร้อม Marketing + AI ไว้ในทีมเดียว เพื่อผลลัพธ์ที่วัดได้จริง") | `front-page.php:24` | OK — ตามเกณฑ์ AI passage แต่ควรมี subtitle ที่เป็นคำตอบโดยตรง |
| Image alt ใน case study เป็น background CSS — ไม่มี alt text เลย | `front-page.php` portfolio section | AI Multi-modal: รูปที่มี alt + caption ใกล้ๆ ถูก select 156% บ่อยกว่า |

**Action items**

1. เพิ่มย่อหน้านำใน FAQ ทุก answer ให้เป็น 1-3 ประโยคแรกที่ตอบคำถามตรงๆ ก่อนขยายความ
2. แปลง process step (`front-page.php:174-194`) จาก H3 cards เป็น `<ol>` semantic
3. แทนที่ portfolio CSS background image ด้วย `<img>` tag จริงพร้อม alt + figcaption

---

## 4. Structured Data (JSON-LD)

### เกณฑ์ Google (พ.ค. 2026)

| @type | Required fields | สถานะ Rich Result |
|---|---|---|
| `Organization` | `name` + (`logo` OR `image`) | ใช้สร้าง Knowledge Panel |
| `LocalBusiness` | `name`, `address`, `telephone`, `openingHoursSpecification` | ใช้ใน Local Pack |
| `Article` / `BlogPosting` | (ไม่ enforce) แนะนำ `headline`, `image` (1:1/4:3/16:9), `author.url`, `datePublished`, `dateModified` | Top Stories carousel |
| `BreadcrumbList` | ≥ 2 `itemListElement` แต่ละตัวมี `position`, `name`, `item` | Breadcrumb ใน SERP |
| `WebSite` + `SearchAction` | `url`, `potentialAction.target` | Sitelinks Searchbox (เฉพาะถ้ามี internal search ใช้งานได้) |
| `Service` | `name`, `provider`, `areaServed` | ไม่ใช่ rich result โดยตรง แต่ AI Mode ใช้ |
| `FAQPage` | `mainEntity` Question/Answer | **ไม่มี rich result แล้ว (พ.ค. 2026)** แต่ AI ใช้ |

### ผลตรวจสอบ

**✓ ครอบคลุมเกินมาตรฐานทั่วไป**

Schema ที่ emit ผ่าน `hashbox_jsonld()` (`functions.php:1200-1206`):

| Page | @type ที่มี | ที่ |
|---|---|---|
| Homepage | Organization, WebSite, ProfessionalService, FAQPage | `functions.php:1214-1405` |
| Blog post (single.php) | Article, BreadcrumbList | `functions.php:1797-1826` |
| Case study (`/work/*`) | Article, BreadcrumbList | `functions.php:1598-1623` |
| Service page AI | Service, BreadcrumbList, FAQPage | `page-ai-consulting.php:176-186` |
| Blog index/category/tag | CollectionPage, BreadcrumbList | `functions.php:1851-1872` |

Organization schema (`functions.php:1226-1251`) ครบทุก field ที่ Google แนะนำ: `name`, `url`, `logo`, `sameAs[]` (LinkedIn/Facebook/Instagram), `contactPoint` (phone, email, areaServed, availableLanguage), `address` (street/locality/region/postal/country)

**⚠ ต้องแก้ — High Severity**

| ปัญหา | ที่ | แก้อย่างไร |
|---|---|---|
| **`page-seo-ready-website.php` ไม่มี Service schema** | (ไม่พบ `hashbox_jsonld()` call) | คัดลอกจาก `page-ai-consulting.php:176-186` แล้วปรับเนื้อหา |
| **`page-digital-marketing-tools.php` ไม่มี Service schema** | (ไม่พบ `hashbox_jsonld()` call) | เช่นเดียวกัน |
| `page-services.php` ไม่มี `ItemList` schema สำหรับ service hub | `page-services.php` | เพิ่ม `ItemList` รวม 3 services |
| `Article` schema ใน case study ใช้ `datePublished` เป็น "{year}-01-01" — ไม่ใช่วันจริง | `functions.php:1598-1613` | ถ้ามีข้อมูลให้ใช้วันจริง; ถ้าไม่มีเก็บที่ year-01-01 แต่ระวัง Search Console warning |
| ใช้ `ProfessionalService` แทน `LocalBusiness` — พลาด local pack signal | `functions.php:1071-1083` | `ProfessionalService` เป็น subclass ของ `LocalBusiness` อยู่แล้ว — เพิ่ม `@type: ["ProfessionalService", "LocalBusiness"]` พร้อม `openingHoursSpecification` |
| ไม่มี `openingHoursSpecification` | Organization schema | เพิ่ม Mon-Fri 09:00-18:00 (ตามที่ footer ระบุ `footer.php:48`) |
| ไม่มี `geo` (lat/lng) | Organization | เพิ่ม `geo: { @type: GeoCoordinates, latitude: 13.726, longitude: 100.527 }` (Si Lom) |
| FAQ rich result deprecated 5/2026 — ตรวจว่ายังเก็บ schema ไว้ (ถูกต้อง) | `functions.php:1373-1405`, `page-ai-consulting.php:186` | คงไว้ — AI Mode ใช้ |

**Action items**

1. เพิ่ม schema 3 บล็อก (Service + BreadcrumbList + FAQPage) ใน `page-seo-ready-website.php` ก่อน `get_footer()` (รูปแบบเดียวกับ `page-ai-consulting.php:176-186`)
2. เพิ่ม schema เดียวกันใน `page-digital-marketing-tools.php`
3. แก้ `functions.php:1071-1083` (`hashbox_rankmath_schema_service()`):
   ```php
   '@type' => array('ProfessionalService', 'LocalBusiness'),
   'openingHoursSpecification' => array(
       '@type' => 'OpeningHoursSpecification',
       'dayOfWeek' => array('Monday','Tuesday','Wednesday','Thursday','Friday'),
       'opens' => '09:00',
       'closes' => '18:00',
   ),
   'geo' => array(
       '@type' => 'GeoCoordinates',
       'latitude' => 13.7263,
       'longitude' => 100.5270,
   ),
   ```
4. หลังแก้ → ทดสอบทุกหน้าด้วย https://validator.schema.org/ และ Search Console "Rich results test"

---

## 5. Recent Core / Spam Updates (Mar 2024 → Mar 2026)

### สรุปการเปลี่ยนแปลง

- **March 2024 Core + Spam Policies**: Scaled content abuse, expired domain abuse, site reputation/parasite SEO (enforcement 5/5/2024)
- **December 2025 Core Update**: 66.8% Top-3 movement; E-E-A-T ขยายจาก YMYL → ทุก competitive query
- **March 2026 Core Update** (27/3 - 8/4/2026): AI-paraphrased content ลด traffic -71%; templated roundup pages ถูก demote

### ผลตรวจสอบ

**✓ ปลอดภัย — ไม่มีรูปแบบที่ถูก target**

- ไม่มี programmatically-generated thin pages
- ไม่มี subdomain/subfolder ที่ host third-party content (parasite SEO)
- บทความใน `content/blog/` เขียนเอง (ไม่ใช่ AI mass production)
- Case study pages มี original metrics + screenshots (ไม่ใช่ template ซ้ำๆ)
- ทุก page มี Organization @id ref → editorial accountability ชัดเจน

**ℹ ข้อสังเกต**

- หน้า case study 6 อัน (`page-work-*.php`) มีโครงสร้างคล้ายกัน (challenge/approach/results) — ถ้าเนื้อหา data จริง = ปลอดภัย แต่ถ้าเป็น template ซ้ำๆ ใน future ระวังถูกมองเป็น templated content

**Action items**

1. ก่อนเพิ่ม case study ใหม่ ตรวจให้แน่ใจว่ามี actual client data, screenshot, ผลลัพธ์ที่ verify ได้
2. ถ้าใช้ AI ช่วยร่างเนื้อหา — review หนัก, เพิ่ม firsthand experience, อย่า publish raw

---

## 6. Crawl / Index / robots / sitemap

### เกณฑ์ Google

- `robots.txt` ห้าม block CSS/JS/images (Googlebot ต้อง render เต็มหน้า)
- XML sitemap submit ใน Search Console; เฉพาะ URL canonical + indexable
- Canonical `<link>` self-referencing ทุกหน้า
- `noindex` บนหน้า thin (tag archive, search results)
- Mobile-first: เนื้อหา + schema + link ตรงกันระหว่าง mobile/desktop render
- hreflang reciprocal pairs + `x-default`

### ผลตรวจสอบ

**✓ ทำได้ดี**

| รายการ | ที่ |
|---|---|
| `.htaccess` HTTPS + canonical host (no-www) redirect 301 | `.htaccess:6-9` |
| Robots.txt dynamic + Sitemap directive | `functions.php:1317-1328` |
| Sitemap จาก Rank Math (`/sitemap_index.xml`) หรือ core (`/wp-sitemap.xml`) | `functions.php:1322` |
| Case study URL canonical override (`/work/{slug}/`) + 301 legacy redirect | `functions.php:825-941` |
| `<html lang="th-TH">` forced site-wide | `functions.php:459-465` |

**⚠ ต้องแก้**

| ปัญหา | ที่ | Severity | แก้อย่างไร |
|---|---|---|---|
| **ไม่มี `<meta name="robots" content="noindex,follow">` บน `search.php`** | `search.php` | **High** | search result page ทั่วไปไม่ควร indexable |
| ไม่มี `404.php` custom template | (ไม่มีไฟล์) | High | สร้างหน้า 404 พร้อม helpful nav + ใส่ noindex |
| ไม่มี hreflang สำหรับ Thai/English | `header.php` | Medium (ถ้ามีแผน EN) | ถ้ายังไม่มีหน้า EN ไม่ต้องทำ; ถ้ามี ต้องใส่ทุกหน้า reciprocal |
| ไม่มี explicit canonical fallback เมื่อ Rank Math inactive | (ไม่พบ) | Medium | เพิ่ม `<link rel="canonical">` ใน `hashbox_homepage_meta_description()` |
| Pagination ไม่ emit `<link rel="prev/next">` (WP เลิก require แต่บางคน SEO tool ยังใช้) | `functions.php:1763-1778` | Low | optional |
| `/portfolio/` password-protected — ไม่มี robots directive | `page-portfolio.php` | Low | เพิ่ม `<meta name="robots" content="noindex">` |

**Action items**

1. แก้ `search.php` เพิ่มที่ต้นไฟล์ก่อน `get_header()`:
   ```php
   add_action('wp_head', function() {
       echo '<meta name="robots" content="noindex,follow">' . "\n";
   });
   ```
2. สร้าง `404.php` (template) พร้อม:
   - `<meta name="robots" content="noindex">`
   - H1 ที่อธิบายชัดเจน
   - ลิงก์ไป homepage + services + blog + contact
3. เพิ่ม canonical fallback ใน `hashbox_homepage_meta_description()` (`functions.php:715`):
   ```php
   echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
   ```
4. เพิ่ม noindex ใน `page-portfolio.php` head section

---

## 7. JavaScript / Rendering

### เกณฑ์ Google

- Critical SEO elements (title, meta, canonical, hreflang, main content) ต้องอยู่ใน HTML response แรก
- Lazy load ใช้ IntersectionObserver (Googlebot's viewport จะ trigger ให้)
- ไม่ใช้ hash routing (`/#/page`)
- Third-party scripts ใช้ `defer` (preserve order) หรือ `async`

### ผลตรวจสอบ

**✓ เกือบสมบูรณ์ — เป็นจุดแข็งของ WordPress + theme นี้**

- SSR ทุกหน้า (WordPress PHP) — title, meta, canonical, schema, content อยู่ใน HTML แรกหมด
- JS หลัก `js/v2.js` enqueue ที่ footer (deferred ตามค่า WordPress default) `functions.php:103`
- Portfolio JS conditional load เฉพาะ template `functions.php:164-170`
- About JS conditional `functions.php:191-197`
- Scroll-reveal ใช้ IntersectionObserver (ตามที่ระบุใน CLAUDE.md)
- ไม่มี hash routing
- ไม่มี inline blocking script ใน header.php

**⚠ ต้องตรวจเพิ่ม**

| ปัญหา | ที่ | แก้อย่างไร |
|---|---|---|
| `wp_nonce_field()` ใน form contact emit inline `<input>` (ไม่ใช่ script) — ปลอดภัย | `front-page.php:451` | OK |
| ถ้ามี Google Tag Manager / GA4 — ตรวจว่าไม่ได้ load synchronous ใน `<head>` | (น่าจะอยู่ใน Rank Math/plugin) | ใช้ `defer` + post-interaction load |

ไม่พบปัญหา rendering ที่กระทบ SEO

---

## 8. Image SEO

### เกณฑ์ Google (พ.ค. 2026)

- **AVIF** (browser support >90%) + WebP fallback ผ่าน `<picture>`
- Responsive: `srcset` + `sizes` ทุกรูป content
- `loading="lazy"` เฉพาะรูป **ใต้ fold** — รูป hero/LCP ต้อง eager + `fetchpriority="high"`
- Alt text เพื่อ accessibility (ไม่ keyword stuff); decorative images ใช้ `alt=""`
- `width` + `height` ทุก `<img>` ป้องกัน CLS

### ผลตรวจสอบ

**✓ บางจุดทำดี**

- Blog featured image (LCP): `width="1200" height="675"` + `fetchpriority="high"` + `loading="eager"` (`home.php:68`)
- Blog card: `loading="lazy"` + `decoding="async"` + `width="800" height="450"` (`template-parts/post-card.php:25`)
- Alt text derived from `_wp_attachment_image_alt` meta + fallback to post title (`template-parts/post-card.php:14-17`)

**⚠ จุดอ่อนของ theme — Severity High**

| ปัญหา | ที่ | ผลกระทบ |
|---|---|---|
| **ใช้แค่ JPG ทั้งเว็บ** — ไม่มี WebP/AVIF | `assets/portfolio-images/`, blog images | Bandwidth 30-50% มากเกินจำเป็น, LCP ช้า |
| **ไม่มี `srcset`/`sizes`** ทุกรูป | ทุก `<img>` ใน theme | Mobile โหลดรูปขนาดเต็ม → wasted bandwidth |
| Portfolio ใน front-page ใช้ CSS background image | `front-page.php` portfolio section | ไม่มี alt → ไม่ index ใน Google Images, ไม่มี AI multi-modal signal |
| `single.php:40-44` ไม่ส่ง `width`/`height` ให้ `the_post_thumbnail()` | `single.php:40-44` | CLS risk |
| Hero ใน `template-parts/hero.php` (ต้องตรวจ) | ตรวจเพิ่ม | ถ้ามี image และไม่ preload → LCP สูง |

**Action items**

1. เพิ่ม WebP generation:
   - ติดตั้ง plugin "Modern Image Formats" หรือ "Imagify" บน WordPress production
   - หรือเขียน filter `wp_get_attachment_image_attributes` ให้ใช้ `<picture>` พร้อม srcset multi-format
2. แก้ `single.php:40-44`:
   ```php
   the_post_thumbnail('full', array(
       'loading' => 'eager',
       'fetchpriority' => 'high',
       'sizes' => '(max-width: 768px) 100vw, 1200px',
   ));
   ```
3. แปลง portfolio ใน `front-page.php` จาก CSS background → `<img>` + `srcset` พร้อม alt text ที่อธิบายโปรเจกต์
4. WordPress >5.5 จะ auto-generate `srcset` ให้ `the_post_thumbnail()` — confirm ว่า image sizes ใน `functions.php` (`add_image_size()`) ครอบคลุม breakpoints

---

## 9. HTTPS / Security Headers

### เกณฑ์ Google

- HTTPS = ranking signal (เบาแต่จริง)
- HSTS header ส่งสัญญาณความมั่นคง (Googlebot ignore แต่ user trust)
- ไม่มี mixed content
- CSP, X-Content-Type-Options, Referrer-Policy ฯลฯ ไม่ใช่ ranking factor แต่เป็น quality signal

### ผลตรวจสอบ

**✓ ครบสมบูรณ์ 10/10**

`.htaccess` มี:

| Header | ค่า | ที่ |
|---|---|---|
| `Strict-Transport-Security` | `max-age=31536000; includeSubDomains; preload` | `.htaccess:31` |
| `X-Content-Type-Options` | `nosniff` | `.htaccess:26` |
| `X-Frame-Options` | `DENY` | `.htaccess:27` |
| `X-XSS-Protection` | `1; mode=block` | `.htaccess:28` |
| `Referrer-Policy` | `strict-origin-when-cross-origin` | `.htaccess:29` |
| `Permissions-Policy` | `geolocation=(), microphone=(), camera=()` | `.htaccess:30` |
| HTTPS redirect 301 | `https://hashbox.co.th` canonical | `.htaccess:6-9` |

**ℹ Optional แต่ดี**

- ไม่มี `Content-Security-Policy` — เป็น header ที่ adoption ต่ำสุด/impact สูงสุดตามงาน research 2026 — แต่ implementation ยาก ต้อง test เยอะ
- ไม่ครอบคลุม font/woff2 ใน mod_expires (`/.htaccess:70-79`)
- ไม่ครอบคลุม image/avif, image/webp ใน mod_expires
- ไม่ครอบคลุม application/ld+json ใน mod_deflate

**Action items (low priority)**

แก้ `.htaccess` mod_expires (`70-79`) เพิ่ม:
```
ExpiresByType image/webp "access plus 1 year"
ExpiresByType image/avif "access plus 1 year"
ExpiresByType font/woff2 "access plus 1 year"
ExpiresByType font/woff "access plus 1 year"
```
และ mod_deflate (`57-67`) เพิ่ม:
```
AddOutputFilterByType DEFLATE application/json
AddOutputFilterByType DEFLATE application/ld+json
```

---

## 10. International / Thai Local SEO

### เกณฑ์ Google

- `<html lang="th">` หรือ `lang="th-TH"` บนทุกหน้า Thai
- hreflang cluster reciprocal + `x-default`
- `LocalBusiness` schema with Thai address, `addressCountry: "TH"`, `geo`, `openingHoursSpecification` (24h format), `telephone` E.164 (`+66...`)
- Google Business Profile NAP ต้องตรงกับ schema เป๊ะ
- IBM Plex Sans Thai (หรือ font Thai) ใช้ `font-display: swap`
- ราคา: `Offer.priceCurrency: "THB"`

### ผลตรวจสอบ

**✓ ทำได้ดี**

- `<html lang="th-TH">` forced ทุกหน้า (`functions.php:459-465`)
- IBM Plex Sans Thai ใช้ `display=swap` (`functions.php:71`)
- Phone format E.164: `+66-2-266-6222` ใน Organization schema (`functions.php:1238`)
- `addressCountry: "TH"` (`functions.php:1249`)
- `availableLanguage: ["th", "en"]` (`functions.php:1242`)
- `areaServed: "TH"` / `"Thailand"` (`functions.php:1241, 1075`)

**⚠ ต้องแก้**

| ปัญหา | ที่ | แก้อย่างไร |
|---|---|---|
| `og:locale:alternate content="en_US"` แต่ไม่มี hreflang หรือหน้า EN จริง | `functions.php:717` | ถ้าไม่มี EN ลบ alternate; ถ้ามีต้องเพิ่ม hreflang ทุกหน้า + `x-default` |
| ไม่มี `openingHoursSpecification` ใน Organization | `functions.php:1226-1251` | ดู Section 4 |
| ไม่มี `geo` coordinates | เช่นเดียวกัน | ดู Section 4 |
| ไม่ได้ใช้ `LocalBusiness` ตรงๆ — ใช้ `ProfessionalService` | `functions.php:1071-1083` | เพิ่มเป็น dual type (ดู Section 4) |
| `priceRange: "฿฿฿"` (`functions.php:1078`) — Google รองรับ แต่ format ไม่มี enum standard | OK | คงไว้ |
| ไม่มี `Offer.priceCurrency: "THB"` ใน hasOfferCatalog | `functions.php:1257-1289` | ถ้ามีราคา service ให้ใส่ `priceSpecification` |

**Action items**

1. ตัดสินใจเรื่อง EN version:
   - **ถ้ายังไม่ทำ**: ลบ `og:locale:alternate` ที่ `functions.php:717` (ลด confusion)
   - **ถ้าจะทำ**: สร้าง subdirectory `/en/` + hreflang `<link>` ทุกหน้า + sitemap แยก
2. ยืนยัน NAP ใน Google Business Profile = `139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500` + `+66 2 266 6222` (ต้องตรงเป๊ะ — ดูใน `footer.php:49`)
3. เพิ่ม `openingHoursSpecification` (Mon-Fri 09:00-18:00 ตามที่บอกใน `footer.php:48`)

---

## Appendix A — Pages → URL → Schema Mapping

| Template | URL | Schema ปัจจุบัน | ที่ขาด |
|---|---|---|---|
| `front-page.php` | / | Organization + WebSite + ProfessionalService + FAQPage | LocalBusiness merge, openingHours, geo |
| `page-services.php` | /services/ | (ไม่มี explicit) | ItemList |
| `page-seo-ready-website.php` | /services/seo-ready-website/ | (ไม่มี) | **Service + BreadcrumbList + FAQPage** |
| `page-digital-marketing-tools.php` | /services/digital-marketing-tools/ | (ไม่มี) | **Service + BreadcrumbList + FAQPage** |
| `page-ai-consulting.php` | /services/ai-consulting/ | Service + BreadcrumbList + FAQPage ✓ | — |
| `page-work.php` | /work/ | (ไม่มี explicit) | ItemList ของ case studies |
| `page-work-*.php` (6 files) | /work/{slug}/ | Article + BreadcrumbList ✓ | Person author |
| `page-about.php` | /about/ | (จาก Rank Math/none) | AboutPage |
| `page-portfolio.php` | /portfolio/ | (none) | noindex |
| `home.php` | /blog/ | CollectionPage + BreadcrumbList ✓ | — |
| `single.php` | /blog/{slug}/ | Article + BreadcrumbList ✓ | Person author + sameAs |
| `category.php` | /blog/category/{slug}/ | CollectionPage + BreadcrumbList ✓ | — |
| `tag.php` | /blog/tag/{slug}/ | CollectionPage + BreadcrumbList ✓ | — |
| `search.php` | /?s={q} | (none) | **noindex** |
| (none) | /404 | (none) | **404.php + noindex** |

## Appendix B — Recommended Remediation Order

**Sprint 1 (1-2 วัน) — P0 wins**

1. เพิ่ม Service + BreadcrumbList + FAQPage schema ใน `page-seo-ready-website.php` และ `page-digital-marketing-tools.php` (copy pattern จาก `page-ai-consulting.php:176-186`)
2. แก้ Article `author` ใน `functions.php:1797-1815` จาก Organization → Person + sameAs
3. เพิ่ม `noindex,follow` บน `search.php`
4. สร้าง `404.php` พร้อม noindex + helpful nav
5. เพิ่ม `width`/`height` ใน `single.php:40-44` `the_post_thumbnail()`
6. เพิ่ม preload Thai font + LCP image ใน `header.php`

**Sprint 2 (2-3 วัน) — Local SEO + CWV**

7. เพิ่ม `LocalBusiness` dual-type + `openingHoursSpecification` + `geo` ใน `functions.php:1071-1083`
8. แปลง CSS background portfolio → `<img>` + alt + srcset ใน `front-page.php`
9. ติดตั้ง WebP/AVIF generation (plugin หรือ filter)
10. เพิ่ม font/woff2, image/avif/webp ใน `.htaccess` mod_expires + mod_deflate

**Sprint 3 (3-5 วัน) — E-E-A-T + i18n**

11. ตัดสินใจเรื่อง EN — ถ้าทำ ให้สร้าง /en/ + hreflang reciprocal
12. สร้าง `author.php` + custom user fields (LinkedIn, Twitter)
13. ขยาย `page-about.php` ด้วย team members + credentials
14. แยก Privacy / Terms / PDPA pages (`footer.php:57-59`)
15. Bundle CSS เป็นไฟล์เดียว (ลด 7 requests → 1 — ต้องมี build step)

---

## Appendix C — Validation Checklist

หลังแก้ทุก sprint ให้ทดสอบด้วย:

- [ ] https://pagespeed.web.dev/ (PageSpeed Insights) — LCP/INP/CLS ทุก page type
- [ ] https://search.google.com/test/rich-results (Rich Results Test) — homepage, /blog/{post}, /work/{slug}, /services/{slug}
- [ ] https://validator.schema.org/ — paste JSON-LD แต่ละ block
- [ ] Search Console → Coverage (ไม่มี error), Enhancements (Article/Breadcrumb/FAQ ผ่าน), Core Web Vitals report
- [ ] Search Console → URL Inspection → Test Live URL → ดู rendered HTML ตรงกับ static source
- [ ] Manual: `curl -s https://hashbox.co.th/ | grep -E '(meta name="description"|link rel="canonical"|application/ld\+json)'`
- [ ] Lighthouse CI ตั้ง budget LCP <2.5s INP <200ms CLS <0.1

---

**Audit completed: 2026-05-23**
Audit basis: Google Search Central docs (มี.ค. 2024 → พ.ค. 2026) + Dec 2025 + March 2026 core update reports + Schema.org v15.0
