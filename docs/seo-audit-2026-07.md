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

## 2. Recommended Follow-ups — ยังไม่ได้แก้ (เรียงตามความสำคัญ)

รายการเหล่านี้ **ไม่ได้แก้ใน PR นี้** เพราะต้องใช้ decision, external validation (Rich Results Test บน live) หรือ pipeline เพิ่ม จึงแยกไว้ให้ทีมตัดสินใจ

### 🔴 High-impact

- **P1 — แปลง Ad PNG เป็น WebP/AVIF** (`assets/ads/hashbox/`, รวม **26 MB**, ไม่มี modern format เลย) hero 756 KB, meta_square 1.2 MB/รูป, meta_story 2 MB/รูป หน้าแรกดึงมา ~2.4 MB `.htaccess` ตั้ง cache สำหรับ webp/avif ไว้แล้ว → generate variant + เสิร์ฟผ่าน `<picture>` ลดได้ **70–90%** → LCP/bandwidth ดีขึ้นมากบน mobile
- **P2 — ยืนยัน GA4/Analytics ทำงานจริง** ธีม**ไม่มี**โค้ด tracking เลย (ไม่มี GA4/GTM/Clarity/Pixel) — ตั้งใจให้ผ่าน plugin (Site Kit) ตาม `BLOG-SETUP.md` แต่ถ้ายังไม่ติดตั้ง = ไม่มี behavioral/conversion data ให้ยืนยันบน live (ดู §7)

### 🟡 Medium

- **P3 — Case-study schema ไม่ guard Rank Math** (`functions.php` ~2698–2723) emit `Article` + `BreadcrumbList` แบบ unconditional → ตอน Rank Math active อาจได้ `BreadcrumbList` ซ้ำ + Article ทับ WebPage แนะนำ wrap ด้วย `if ( ! hashbox_rank_math_is_active() )` หรือปิด breadcrumb module ของ Rank Math บนหน้านี้ *(ต้อง validate ด้วย Rich Results Test บน live ก่อน)*
- **P4 — Case-study `Article` ขาด `image` + วันที่สังเคราะห์** `datePublished = {year}-01-01`, ไม่มี `dateModified`, ไม่มี `image` (Google Article rich result บังคับ `image`) พิจารณาเปลี่ยน type เป็น `CreativeWork`/case-study มากกว่า `Article`
- **P5 — Live Service schema ขาด `hasOfferCatalog`** path fallback มี 3-item offer catalog แต่ `hashbox_rankmath_schema_service()` (ตัวที่ใช้จริงตอน Rank Math active) ไม่มี → ก็อป array มาใส่
- **P6 — รวม builder ของ Organization schema** สอง path (`hashbox_rankmath_schema_organization` vs `hashbox_inject_home_schema`) `sameAs`/`knowsAbout` ไม่ตรงกัน (5 vs 3 profile) → ดึงเป็น builder เดียวกันกัน drift
- **P7 — CSS render-blocking ~114 KB, 6 ไฟล์** ใน `<head>` ไม่มี critical CSS inline (`functions.php` ~90–104) → inline above-the-fold + concat/defer layer ที่เหลือ (`style.css` เดิม defer ถูกต้องแล้ว ใช้เป็นแบบได้)
- **P8 — Google Fonts หนัก 4 family × ~20 weight** (`functions.php` ~83) Thai subset ใหญ่ → ตัด weight ที่ไม่ใช้ หรือ self-host woff2 เพื่อ preload ได้ (ตอนนี้ preload ไม่ได้เพราะ URL ของ Google มี hash)

### 🟢 Low / polish

- **P9** — Brotli: `.htaccess` มีแค่ gzip เพิ่ม `mod_brotli` block (ลด text อีก 15–25%, ขึ้นกับ host)
- **P10** — เพิ่ม `og:image:alt` (`functions.php` ~932)
- **P11** — Decorative inline SVG หลายจุดไม่มี `aria-hidden="true"` (front-page, page-seo-ready-website, ฯลฯ)
- **P12** — Taxonomy templates (`category/tag/archive/author/search`) ข้าม H1→H3 เพิ่ม `<h2>` section เหมือน `home.php:104`
- **P13** — `index.php:22` ใช้ `<h2>` เป็น title (0 H1) — route ที่ตกมา fallback จะไม่มี H1
- **P14** — Desktop primary nav ไม่อยู่ใน `<nav>` landmark (`header.php:27`); breadcrumb 5 หน้าไม่มี `aria-label="Breadcrumb"`
- **P15** — Title `website-development` ไม่มี suffix `| Hashbox Studio`; `geo-checker` ไม่มี title/desc mapping
- **P16** — เพิ่ม `twitter:site` handle; ตั้ง Organization `logo` เป็นโลโก้สี่เหลี่ยมจริง (ตอนนี้ใช้ OG banner 1200×630)
- **P17** — Fallback canonical ทิ้ง pagination (page 2+ ชี้ page 1) เฉพาะ path ที่ไม่มี Rank Math (`functions.php` ~888)
- **P18** — Case-study 6 หน้ายังไม่มีรูป (screenshot/ก่อน-หลัง/กราฟผล) = พลาด image-search + visual proof บนหน้าเงิน

---

## 3. Findings — Technical Head & Schema

**ทำได้ดี:** `add_theme_support('title-tag')` ไม่มี `<title>` hard-code; title/description เขียนมือครบทุกหน้าหลัก + 6 case study + EN; Rank Math per-post ชนะ map เสมอ; canonical remap `/services/*`→`/work/*` ตรงกับ sitemap entry; hreflang th/en/x-default reciprocal + guard ไม่ให้ยิงเมื่อหน้า EN ไม่มี; OG 1200×630 พร้อม width/height, `twitter:card=summary_large_image`; entity graph `@id`-linked (Organization/LocalBusiness + PostalAddress + Geo + OpeningHours + ContactPoint + sameAs); post `Article`+`BreadcrumbList` guard Rank Math ถูกต้อง; **ไม่มี fake `aggregateRating`/`Review`**

**ประเด็น:** ดู F1, F3, F8, F9 (แก้แล้ว) และ P3–P6, P10, P15–P17 (follow-up)

---

## 4. Findings — On-Page Structure

**ทำได้ดี:** ทุก template มี **H1 เดียว** และเป็นหัวข้อหน้า (logo เป็น `<a>` เฉย ๆ); `single.php` strip H1 แรกใน content กัน double-H1; หน้าแรก 1×H1 → 11×H2 → H3 ไม่ข้ามลำดับ; **alt ครบ 100%** ทุก `<img>` มี alt เชิงความหมาย (มี title fallback ตอน WP alt ว่าง); semantic ครบ (`<main>` เดียว, `<article>/<figure>/<time>/<dl>/<details>`); `target="_blank"` มี `rel="noopener"` ทุกจุด; ไม่มี "click here"/"อ่านต่อ" เป็น anchor เชิง scale; 6 case study เป็น content เฉพาะจริง ไม่ใช่ near-duplicate

**ประเด็น:** F4, F7 (แก้แล้ว) และ P12–P14, P18 (follow-up)

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
