# SEO Technical Audit — Hashbox Studio V2 (กรกฎาคม 2026)

> **วันที่:** 2026-07-22
> **ขอบเขต:** Full-site technical + on-page + performance + crawlability audit ของธีม `hashbox-studio-v2`
> **Baseline:** ต่อยอดจาก [`docs/seo-audit-2026-05.md`](./seo-audit-2026-05.md) — โฟกัสที่ของใหม่/ที่ยังค้าง
> **วิธีตรวจ:** static analysis ของโค้ดธีม (ตัวกำหนด HTML ที่เสิร์ฟจริง) cross-reference กับ GSC data ใน [`seo-handoff/keyword-research.md`](../seo-handoff/keyword-research.md)
> **หมายเหตุ:** environment ตรวจนี้เข้าถึง `hashbox.co.th` โดยตรงไม่ได้ (network policy บล็อก) รายการที่ต้องยืนยันบน live server อยู่ใน [§7 Live Verification](#7-live-verification-checklist)

---

## 0. บทสรุปผู้บริหาร (Executive Summary)

ธีม V2 มีพื้นฐาน SEO **แข็งแรงผิดคาดสำหรับธีมที่เขียนมือ** — title/description ต่อหน้าไม่ซ้ำ, canonical + hreflang + JSON-LD entity graph ครบ, robots/sitemap/404 ทำถูกต้อง, H1 เดียวต่อหน้า, alt ครบ 100%, semantic HTML ดี ปัญหาจริงกระจุกอยู่ไม่กี่จุดและ **แก้ได้เร็ว** ส่วนใหญ่เป็น (ก) asset ที่พังจริง (favicon เป็นไฟล์ text), (ข) การส่งสัญญาณภาษาผิดในหน้า EN, (ค) น้ำหนักรูป/ฟอนต์ที่ฉุด Core Web Vitals และ (ง) ลิงก์ภายในที่แตก/ชี้ผิด

บริบทธุรกิจจาก GSC (มี.ค.–มิ.ย. 2026): **24 clicks/3 เดือน, ~99% เป็น branded, non-brand ค้างหน้า 3–8** โจทย์คือดัน non-brand ขึ้นหน้า 1 → การแก้ทุกข้อในรายงานนี้เน้น "ลด friction ที่ขวางการ index/rank ของหน้าที่ตั้งเป้า cluster เชิงพาณิชย์ (AI Consulting) และ informational (GEO / Technical SEO)"

**ระดับความรุนแรงโดยรวม:** 🟢 ไม่มี structural failure — เป็นงาน optimization ไม่ใช่งานกู้

---

## 1. Remediation Log — แก้แล้วใน PR นี้

| # | ปัญหา | ไฟล์ | ผลกระทบ |
|---|-------|------|---------|
| ✅ F1 | **Favicon/App-icon เป็นไฟล์ text placeholder** ไม่ใช่รูป — `<head>` เสิร์ฟ text เป็น PNG, iOS home-screen icon พัง, schema logo fallback ชี้ไฟล์ text | สร้าง PNG จริงจาก `favicon.svg`: `assets/favicons/favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png` (180×180) | Favicon/brand icon ทำงานทุก browser + iOS; schema logo fallback valid |
| ✅ F2 | **Google Fonts โหลดซ้ำ 2 ครั้ง** — `@import` ใน CSS ทำ render-blocking waterfall ทับกับ `wp_enqueue_style` | ลบ `@import` ที่ `design-system/tokens.css:8` | ตัด render-blocking chained request → FCP/LCP เร็วขึ้น (โดยเฉพาะ mobile) |
| ✅ F3 | **หน้า `/en/ai-consulting/` ประกาศเป็นภาษาไทย** — `lang="th-TH"` + `og:locale=th_TH` ทั้งที่ content เป็นอังกฤษ ตั้งเป้า query อังกฤษ (~250 impr, cluster commercial ใหญ่สุด) | เพิ่ม helper `hashbox_is_english_page()`; หน้า `/en/` ได้ `lang="en-US"` + `og:locale=en_US` (`functions.php`) | สัญญาณภาษาตรงกับ content ในหน้าที่สำคัญที่สุดต่อ conversion |
| ✅ F4 | **URL หน้า service หลักแตกเป็น 2** — 9 ลิงก์ในบล็อกชี้ `/services/seo-ready-website/` (404) แทน `/services/website-development/` (หน้าจริง) | repoint 9 ลิงก์ใน `content/blog/04–08` | เลิก 404, รวม link equity กลับหน้าเงินหลัก |
| ✅ F5 | **CLS จากรูปไม่มี width/height** — hero + 3 showcase ใน front-page | เพิ่ม `width`/`height` ตาม intrinsic (1200×627 / 1080×1080) `front-page.php` | ลด Cumulative Layout Shift |
| ✅ F6 | **Hero LCP ไม่ถูก preload** — `hashbox_preload_critical_assets()` ข้าม front-page | เพิ่ม branch `is_front_page()` + `fetchpriority="high"` บน hero img | LCP เร็วขึ้น (เลิก late-discovery หลัง CSS+fonts) |
| ✅ F7 | **Anchor `#contact` ใน 3 โพสต์ EN ชี้ไปที่ว่าง** (section อยู่หน้าแรกเท่านั้น) | `#contact` → `/#contact` ใน `content/blog/01–03` | ลิงก์ CTA ในโพสต์ใช้งานได้จริง |
| ✅ F8 | **Meta description EN ยาว 191 ตัว** ถูกตัดใน SERP | ย่อเหลือ 158 ตัว คง keyword หน้า + ราคา (`functions.php`) | description ไม่ถูกตัด, CTA/ราคาอยู่ครบ |
| ✅ F9 | **หน้า portfolio (password-gated) index ได้เมื่อ Rank Math active** — `hashbox_seo_noindex_meta` return early ตอน Rank Math ทำงาน | เพิ่ม filter `rank_math/frontend/robots` บังคับ `noindex` บน portfolio/search/paged | ปิดช่องหน้า thin/gated หลุดเข้า index |

> ทุกไฟล์ PHP ผ่าน `php -l` แล้ว · favicon ที่สร้าง render เป็นโลโก้ H ถูกต้อง

---

## 2. Remediation Log — Round 2 (follow-ups ที่แก้เพิ่มแล้ว)

หลังส่งมอบ round 1 ได้ลงมือทำ follow-up ต่อจนเกือบครบ:

| # | ปัญหา (เดิม P#) | ไฟล์ | ผลกระทบ |
|---|-----------------|------|---------|
| ✅ F10 | **P1 — Ad PNG 26 MB ไม่มี modern format** | สร้าง WebP ครบ 20 ไฟล์ (**25.8 MB → 0.8 MB, −97%**); front-page + audit-landing เสิร์ฟผ่าน `<picture>` + PNG fallback; hero preload ชี้ WebP + `type="image/webp"` | LCP/bandwidth ลดฮวบ โดยเฉพาะ mobile (hero 756 KB → 36 KB) |
| ✅ F11 | **P5 — Live Service schema ขาด `hasOfferCatalog`** | เพิ่ม 3-item offer catalog ใน `hashbox_rankmath_schema_service()` | service offers ครบใน schema ตอน Rank Math active |
| ✅ F12 | **P3 — Case-study BreadcrumbList ซ้ำ** | strip BreadcrumbList ของ Rank Math บนหน้า case-study (`hashbox_rankmath_json_ld`) — คง Article + Breadcrumb ของเราเป็นแหล่งเดียว | เหลือ BreadcrumbList เดียว ไม่เสีย Article schema |
| ✅ F13 | **P4 — Case-study `Article` ขาด `image`** | เพิ่ม `image` + `dateModified` (จริง) | ผ่านเกณฑ์ Article rich result |
| ✅ F14 | **P16 — logo schema เป็น OG banner ไม่ใช่โลโก้** | สร้าง `icon-512.png` (สี่เหลี่ยมจริง) + helper `hashbox_logo_image_url()`; `Organization.logo` เป็น `ImageObject` 512×512 | ตรงเกณฑ์ logo ของ Google |
| ✅ F15 | **P8 — DM Sans weight 800 ไม่ถูกใช้** | ตัด `;800` ออกจาก Google Fonts URL (weight สูงสุดที่ใช้จริง = 700) | โหลดฟอนต์เบาลง |
| ✅ F16 | **P9 — ไม่มี Brotli** | เพิ่ม `mod_brotli` block ใน `.htaccess` (gzip เป็น fallback) | text/CSS/JS เล็กลง 15–25% บน host ที่รองรับ |
| ✅ F17 | **P10 — ไม่มี `og:image:alt`** | เพิ่มใน fallback meta | social card a11y |
| ✅ F18 | **P11 — Decorative SVG ไม่มี `aria-hidden`** | เพิ่ม `aria-hidden="true"` ให้ 32 SVG (header, front-page, services, ai-consulting, seo-ready) | screen reader ไม่อ่าน icon ว่าง |
| ✅ F19 | **P12 — Taxonomy ข้าม H1→H3** + **`.screen-reader-text` ไม่ถูก define** (label ใน `search.php` เลยโชว์) | เพิ่ม utility class ใน `primitives.css` + `<h2 class="screen-reader-text">` ใน 5 taxonomy templates | heading hierarchy ครบ + fix label ที่โผล่ |
| ✅ F20 | **P13 — `index.php` ใช้ `<h2>` เป็น title (0 H1)** | เปลี่ยนเป็น `<h1>` | fallback route มี H1 |
| ✅ F21 | **P14 — nav landmark + breadcrumb aria-label** | wrap desktop nav ใน `<nav aria-label="Primary">`; เพิ่ม `aria-label="Breadcrumb"` 5 หน้า | landmark ครบ |
| ✅ F22 | **P15 — `geo-checker` ไม่มี title/desc** | เพิ่ม mapping ใน `$page_meta` | tool page มี meta เฉพาะ |
| ✅ F23 | **P17 — Fallback canonical ทิ้ง pagination** | ใช้ `get_pagenum_link()` เมื่อ `is_paged()` (category/tag) | canonical ของ page 2+ ถูกต้อง |
| ✅ L1 | Dead MIME `image/jpg` ใน `.htaccess` | ลบทิ้ง | config สะอาด |

> Round 2: PHP 30+ ไฟล์ผ่าน `php -l` · WebP hero ตรวจ render แล้วคมชัดไม่มี artifact · ไม่มี double-attribute

### ยังเหลือ (ต้องใช้ input / visual testing)

- **P2 — ยืนยัน GA4/Analytics** — ทำแทนไม่ได้: ต้องใช้ **Measurement ID ของคุณ** + เข้า live ธีมไม่มี tracking โดยตั้งใจ (ผ่าน Site Kit ตาม `BLOG-SETUP.md`) → ถ้ายังไม่ติดตั้ง = ไม่มี behavioral/conversion data (ดู §7)
- **P6 — รวม builder ของ Organization schema** (rankmath vs fallback `sameAs` 5 vs 3) — refactor ที่ควรทำพร้อม review, ไม่เร่ง
- **P7 — Inline critical CSS / concat 6 layer** (~114 KB render-blocking) — **ต้องทำพร้อม visual testing** เพราะ tokens/primitives/surface เป็น above-the-fold การ defer ผิดจะเกิด FOUC → เว้นไว้ทำแบบมีการทดสอบ
- **P18** — Case-study 6 หน้ายังไม่มีรูป (screenshot/ก่อน-หลัง/กราฟผล) — งาน content/design
- **P15 (title suffix)** — จงใจ**ไม่ทำ**: title `website-development` ยาว ~56 ตัวอยู่แล้ว การเติม `| Hashbox Studio` เสี่ยงโดนตัด + ต้อง re-sync `rank_math_title` (การละไว้ดูตั้งใจ)
- **P16 (`twitter:site`)** — ข้าม: แบรนด์ไม่มีบัญชี X/Twitter (social มีแค่ LinkedIn/FB/IG/LINE)

---

## 3. Findings — Technical Head & Schema

**ทำได้ดี:** `add_theme_support('title-tag')` ไม่มี `<title>` hard-code; title/description เขียนมือครบทุกหน้าหลัก + 6 case study + EN; Rank Math per-post ชนะ map เสมอ; canonical remap `/services/*`→`/work/*` ตรงกับ sitemap entry; hreflang th/en/x-default reciprocal + guard ไม่ให้ยิงเมื่อหน้า EN ไม่มี; OG 1200×630 พร้อม width/height, `twitter:card=summary_large_image`; entity graph `@id`-linked (Organization/LocalBusiness + PostalAddress + Geo + OpeningHours + ContactPoint + sameAs); post `Article`+`BreadcrumbList` guard Rank Math ถูกต้อง; **ไม่มี fake `aggregateRating`/`Review`**

**ประเด็น:** F1, F3, F8, F9 (round 1) + F11–F14, F17, F22, F23 (round 2) แก้แล้ว · เหลือ **P6** (รวม Organization builder) ที่ยังไม่ทำ

---

## 4. Findings — On-Page Structure

**ทำได้ดี:** ทุก template มี **H1 เดียว** และเป็นหัวข้อหน้า (logo เป็น `<a>` เฉย ๆ); `single.php` strip H1 แรกใน content กัน double-H1; หน้าแรก 1×H1 → 11×H2 → H3 ไม่ข้ามลำดับ; **alt ครบ 100%** ทุก `<img>` มี alt เชิงความหมาย (มี title fallback ตอน WP alt ว่าง); semantic ครบ (`<main>` เดียว, `<article>/<figure>/<time>/<dl>/<details>`); `target="_blank"` มี `rel="noopener"` ทุกจุด; ไม่มี "click here"/"อ่านต่อ" เป็น anchor เชิง scale; 6 case study เป็น content เฉพาะจริง ไม่ใช่ near-duplicate

**ประเด็น:** F4, F7 (round 1) + F18–F21 (round 2 — heading/nav/a11y) แก้แล้ว · เหลือ **P18** (เพิ่มรูปใน case study — งาน content)

> **หมายเหตุ false-positive:** ลิงก์บล็อกไป `/technical-seo-guide/`, `/nextjs-vs-wordpress-2026/`, `/geo-ai-search-optimization-2026/` **ไม่ใช่ลิงก์เสีย** — โพสต์เหล่านี้ published จริงบน WP (มี GSC position ใน keyword-research.md: technical-seo pos 27, geo pos 77, nextjs pos 10) เพียงแต่ไม่ได้อยู่เป็นไฟล์ .md ใน repo → **ไม่ต้องแก้** แค่ยืนยันว่า resolve บน live

---

## 5. Findings — Performance / Core Web Vitals

**ทำได้ดี:** Caching เยี่ยม — `.htaccess` ตั้ง 1-year Expires ครอบ webp/avif/woff2 ด้วย; HTTPS + www→non-www ใน 1 hop + HSTS preload; security headers ครบ (nosniff/X-Frame/Referrer/Permissions); JS `in_footer` ทั้งหมด **ไม่มี jQuery** (vanilla); `style.css` เดิม defer ด้วย `media="print"` swap + `<noscript>`; preconnect fonts.googleapis/gstatic; RUM Web-Vitals inline ท้าย footer แบบ non-blocking

**ประเด็น:** F2, F5, F6 (แก้แล้ว) และ P1, P7, P8, P9 (follow-up) — โดย **P1 (WebP) เป็น win ใหญ่สุดที่เหลือ**

---

## 6. Findings — Crawlability / Indexation / International

**ทำได้ดี:** `robots.txt` virtual สะอาด (block เฉพาะ `/wp-admin/`, allow `admin-ajax.php`, ประกาศ sitemap, เคารพ "discourage search engines"); Rank Math sitemap มี `.htaccess` rewrite + `add_rewrite_rule` fallback + flush guard, case-study entry rewrite เป็น `/work/<slug>/`; `404.php` คืน status 404 จริง + helpful (breadcrumb/CTA/search/popular); noindex fallback ครอบ search/404/paged/portfolio; `llms.txt`/`llms-full.txt` ส่ง `X-Robots-Tag: noindex`; pretty permalink สะอาดทั้งเว็บ; `redirect_canonical` scoped กัน loop

**ประเด็น:** F3, F9 (แก้แล้ว) และ P2, P17 (follow-up)

**International note:** เว็บใช้ระบบ bilingual **แบบ manual** (ไม่มี Polylang จริง — มี `hashbox_hreflang_pairs()` + forced lang + hardcoded locale เป็น workaround) ทุกหน้า EN ใหม่ต้องเพิ่ม entry ใน `hashbox_hreflang_pairs()` เอง มิฉะนั้น hreflang จะไม่ยิงเงียบ ๆ (F3 แก้ให้ lang/locale ตามหน้า EN แล้ว)

---

## 7. Live Verification Checklist

รายการที่ต้องรันบน `hashbox.co.th` เอง (ตรวจจาก code ล้วนไม่ได้):

- [ ] **Favicon** — เปิดเว็บ ดู tab icon + `https://hashbox.co.th/wp-content/themes/hashbox-studio-v2/assets/favicons/apple-touch-icon.png` แสดงรูปจริง (หลัง deploy)
- [ ] **Rich Results Test** — home, 1 case study (`/work/...`), 1 blog post → ไม่มี error, ไม่มี BreadcrumbList/Article ซ้ำ (เกี่ยวกับ P3)
- [ ] **PageSpeed Insights (mobile)** — home + `/en/ai-consulting/` → เทียบ LCP/CLS ก่อน-หลัง F2/F5/F6 (คาดว่า LCP ดีขึ้นชัดหลังทำ P1 WebP)
- [ ] **GSC URL Inspection** — `/services/website-development/` และ `/en/ai-consulting/` index ปกติ; ยืนยัน `/en/` แสดง `lang="en-US"` แล้ว
- [ ] **Sitemap** — `https://hashbox.co.th/sitemap_index.xml` โหลดได้ + มีทุก page/post/case study
- [ ] **GA4** — ยืนยัน tracking ยิง (Realtime) — ถ้าไม่มี ให้ติดตั้ง Site Kit (P2)
- [ ] **hreflang** — validate reciprocity `/services/ai-consulting/` ↔ `/en/ai-consulting/`

---

## 8. Strategic Alignment (จาก GSC clusters)

| Cluster | สถานะ GSC | สิ่งที่ audit นี้ช่วย |
|---------|-----------|----------------------|
| **AI Consulting** (commercial, ใหญ่สุด ~480 impr) | EN pos ~50–80 | F3 (สัญญาณภาษา EN), F8 (desc EN ไม่ถูกตัด) ปลด friction หน้า `/en/ai-consulting/` |
| **GEO** (informational, จุดแข็ง ~241 impr) | pos 65–77 | F4/F7 (internal link จากบล็อกไม่แตก) ส่ง equity เข้า cluster |
| **Technical SEO** (pos 27, ใกล้หน้า 1) | รอ answer-block | F1/F2/F5/F6 (CWV + technical health โดยรวม) |

> การแก้ technical/performance ไม่แทนงาน content (answer-block + FAQ ใน `seo-handoff/`) แต่ **ลดตัวถ่วง** ที่ทำให้หน้าที่มี content ดีอยู่แล้วไต่อันดับช้า — โดยเฉพาะ P1 (WebP) สำหรับ mobile CWV และ F3 สำหรับ cluster commercial ที่ทำเงิน

---

*จบรายงาน — สร้างจาก static audit ของธีม V2, กรกฎาคม 2026*
