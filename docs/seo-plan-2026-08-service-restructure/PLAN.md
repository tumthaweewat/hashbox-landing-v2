# Hashbox — แผน 12 สัปดาห์ (1 ก.ย. – 20 พ.ย. 2026) · ฉบับเดียว

อัปเดต 2026-08-29. ไฟล์ประกอบ: `KEYWORD-DB.csv` (ข้อมูล 64 คำ + score) · `REFERENCE.md` (ownership map, โครงสร้างเป้าหมาย, คู่แข่ง, catalogue งาน A–F) · `content/briefs/TEMPLATE.md` (วิธีเขียนทุกชิ้น)

## หลักการ
1. **Ship ก่อน** — sprint 2 สัปดาห์, checkpoint สัปดาห์ 4, ไม่เพิ่ม docs จนกว่าจะมีผลวัด
2. **โฟกัส 3 คลัสเตอร์** พักที่เหลือ
3. **สองฝั่งเดินพร้อมกัน** — Claude ทำฝั่งเว็บทั้งหมด; Tum ทำ off-site (GBP / YouTube / เคส / directory) + Accuracy Gate. ฝั่งเว็บอย่างเดียวดัน long-tail ได้ แต่ head term ที่ Map Pack + YouTube ครองจะไม่ขยับ
4. ไม่มีเคส / ตัวเลข / รีวิวปลอม — ไม่มีดีกว่า fake

## เป้าหมาย 4 ข้อ
| | baseline 28 ส.ค. | สัปดาห์ 4 | สัปดาห์ 12 |
|---|---|---|---|
| G1 non-brand clicks / เดือน | ~1 | 15 | 40 |
| G2 keyword top-20 (จาก 64) | 8 | 14 | 20 |
| G2b คลัสเตอร์ D long-tail ติด top-30 | 0/6 | 2 | 4 |
| G3 AI เอ่ยถึง (20 prompt) | 6 | 8 | 10 |
| G4 referring domains (Tum) | 0 | 5 | 10 |

Guard: PSI mobile ≥ 90 · H1 หน้าแรกคง "รับทำเว็บไซต์ … SEO" · ไม่มี 404 ค้าง

## โฟกัส (สัปดาห์ 1–4) — 4 คลัสเตอร์
| | คลัสเตอร์ | ทำไม | หน้า |
|---|---|---|---|
| A | AI consulting TH + EN | ติดแล้ว ยกง่ายสุด — post 170 pos 3 แต่ 0 click; service page 14; EN 14–23 | post 170 · /services/ai-consulting/ · /en/ai-consulting/ |
| B | AI Search (GEO) | มี authority เนื้อหา (`geo คือ` = query non-brand ใหญ่สุด) แต่ไม่มีหน้าขาย | /services/ai-search/ ใหม่ + post 66/208 |
| C | SEO Audit + Local SEO | มี impr แล้ว: /seo-audit/ pos 31, post 92 pos 13 (27 impr/วัน) | /seo-audit/ · /services/seo/ · post 92 |
| D | รับทำเว็บไซต์ — long-tail | บริการหลัก (แถว 1 หน้าแรก). ไล่ long-tail ที่ organic ยังชนะได้: `รับทำเว็บไซต์ seo` · `เว็บไซต์ seo ready` · `รับทำเว็บไซต์ wordpress` · `รับทำเว็บไซต์ ราคา` · `รับทำเว็บไซต์ ติดหน้าแรก google` · `เว็บโหลดช้า` | /services/website-development/ · /wordpress/ · /website-audit/ · C5 ราคา |
| — | Foundation | ชื่อบริการ = keyword, footer/nav ส่ง link equity, ชั้น AI (llms/robots/entity) — ทุกคลัสเตอร์ได้ประโยชน์ | หน้าแรก, nav, footer, functions.php |

**Head term `รับทำเว็บไซต์` / `รับทำ seo` / `รับออกแบบเว็บไซต์`:** ไม่ใช่ตัด — SERP ถูก Map Pack ครอง 100% + คู่แข่ง 150,000 เว็บ/18 ปี. คันโยกจริงคือ **T1 GBP + รีวิว + G4 backlinks** ไม่ใช่โค้ด. หน้าเว็บเตรียมพร้อมใน Sprint 1 (B2) แล้วรอ off-site ดัน. ไม่สัญญา top-10 ใน 90 วัน.

**พักไว้ก่อน** (จนสัปดาห์ 5 หรือมี evidence): industry page · listicle · use-case page · de-slop หน้าแรก (ต้องมีเคสจริง)

## Sprint 1 — สัปดาห์ 1–2 · Claude — **ส่งแล้ว 2026-08-29** (commits 13de293 → e507803)

สถานะ: S1.1 ✅ (Rank Math title/desc post 170) · S1.2 ✅ · S1.3 ✅ (sameAs ยังไม่มี GBP/YouTube/GoodFirms — รอ T1/T2) · S1.4 ✅ (landing-sitemap.xml เข้า index, post 92 EN summary + CTA, ลบ H1 ซ้ำ) · S1.5 ✅ · S1.6 ✅ (ราคาเริ่มต้น 60,000 มีอยู่แล้ว) · S1.7 ✅ · S1.8 ✅ · S1.9 ✅ php -l / contract tests / 301 / JSON-LD parse / Lighthouse mobile SEO 100, a11y 96 — PSI performance ยังไม่ได้วัด (API quota) · DM page id 45 → draft · Rank Math meta ตั้งใหม่: pages 179, 43, 101 + post 92
รอ Tum: GSC request index (/, /services/, /services/seo/, /services/website-development/, /en/ai-consulting/, post 170, post 92, landing-sitemap.xml) · T1–T6
| # | งาน | ref |
|---|---|---|
| S1.1 | post 170: title ใส่ปี/งบ/checklist, meta answer-first, CTA → /services/ai-consulting/ (แก้ 0 click) | F1 |
| S1.2 | Restructure: home 5 แถว H3=keyword + sub-bullet · nav "บริการ" dropdown · **footer เพิ่ม seo / n8n / ai-search** · DM 301 → /services/seo/#cro + ลบ 13 ref · `hashbox_service_catalog()` array กลาง → ItemList 5 / hasOfferCatalog / llms.txt / 404 / form · Rank Math meta home + /services/ | A1–A5, A8 |
| S1.3 | ชั้น AI: llms.txt เขียนใหม่ + llms-full.txt (entity, ก่อตั้ง, ราคา, FAQ, เคส) · robots.txt Allow AI bots · Organization `alternateName` / `foundingDate` / `founder` / sameAs + GBP·YouTube·Clutch·GoodFirms·F6S | D1–D3 |
| S1.4 | /seo-audit/ + /seo-recovery-audit/ เข้า sitemap, title "รับทำ SEO Audit / Technical SEO Audit" · post 92 EN answer-first + CTA | A7 |
| S1.5 | /services/seo/ template: H1 มี outcome, นิยาม 2 บรรทัดแรก, H2 variants (บริษัทรับทำ / สายขาว / Local SEO Bangkok / ราคา), H2 "วิธีวัดผล", section `#cro`, FAQ +3 | B1 |
| S1.6 | /services/ai-consulting/ template + H2 variants (บริการให้คำปรึกษา AI / ผู้ให้บริการโซลูชัน AI / บริการ RAG / AI Tool) + ราคาเริ่มต้น (รอ T4) + ลิงก์ post 170/220/224/69 | B3 |
| S1.7 | /en/ai-consulting/ answer-first list "AI consulting companies in Thailand" + H2 variants (AIO 25 แหล่ง ไม่มีเรา) | B5 |
| S1.8 | /services/website-development/ template: H1 "รับทำเว็บไซต์ SEO-Ready … รองรับ AI Search", นิยาม, H2 variants (บริษัท / ราคา / SEO Ready / WordPress / ติดหน้าแรก Google / เว็บโหลดช้า), FAQ "ค่าใช้จ่ายเริ่มต้น → 35,900" ใน FAQPage, PSI proof จริง, ลิงก์ /website-audit/ | B2 |
| S1.9 | Verify: `php -l`, contract tests, curl 301, `grep digital-marketing-tools` = 0, Rich Results, PSI mobile, GSC request index (T) | — |

## Sprint 2 — สัปดาห์ 3–4 · Claude — **ส่งแล้ว 2026-08-29** (commits 796c353 → 8688fdc)

สถานะ: S2.1 ✅ `/services/ai-search/` (page 239, template page-ai-search.php, 9 FAQ, Service/FAQPage/Breadcrumb schema, proof = ข้อมูล Signal, ราคา = ข้อเท็จจริง "รวมใน SEO retainer 25,000 / quote แยกหลัง audit" — รอ T4 ถ้าจะใส่ตัวเลขแยก) + `/geo-checker/` publish (page 240) · S2.2 ✅ CTA post 66/208 → ai-search; CTA เพิ่มใน post 17/68/70/81/89/91 ที่ไม่มีลิงก์หน้าบริการเลย · S2.3 ✅ n8n section "รับวางระบบ n8n + AI Automation" + FAQ (website-dev ทำใน S1.8 แล้ว) · S2.4 ✅ theme มี author + วันที่อัปเดตอยู่แล้ว; FAQ ฝังแบรนด์ทำในทุกหน้าบริการ · S2.5 ⏳ Friday loop ครั้งแรก = ศุกร์ 4 ก.ย. (รอ GSC สะสม)
รอ Tum: GSC request index `/services/ai-search/`, `/geo-checker/`, post 66, 208 + รายการจาก Sprint 1 · T1–T6 · **C5 "รับทำเว็บไซต์ ราคา" ยังไม่ได้ทำ (ต้องการตัวเลขราคาจริงต่อ tier จากคุณยืนยันก่อน) → Sprint 3**
| # | งาน | ref |
|---|---|---|
| S2.1 | `/services/ai-search/`: brief จาก TEMPLATE → draft 3 รอบ → publish. Anatomy: นิยาม → ทำไม 2026 → กระบวนการ 5 ขั้น → platform grid → KPI (AI Visibility / Mentions / Citations / SoV) → package + ราคา (T4) → **proof = Signal dashboard ของเราเอง** → FAQ 8 → /geo-checker/ | C1 |
| S2.2 | post 66 / 208 answer-first + CTA → ai-search · CTA จาก 19 โพสต์ "X คือ" → หน้าบริการเจ้าของ keyword (REST) | A6 |
| S2.3 | /services/n8n-automation/ template (variants: รับวางระบบ n8n / n8n ราคา / AI Automation) · C5 "รับทำเว็บไซต์ ราคาเท่าไร 2026" (คลัสเตอร์ D) | B4, C5 |
| S2.4 | ทุกหน้า: author box + credential, dateModified จริง, FAQ ฝังแบรนด์, trust strip ตัวเลขจริง (T4) | D4–D6 |
| S2.5 | Friday loop ครั้งแรก · อัปเดต KEYWORD-DB · รายงานสัปดาห์ 4 เทียบ G1–G4 | — |

## Tum — สัปดาห์ 1–4 ขนาน (Claude ทำแทนไม่ได้)
- **T7 (ใหม่ 2026-08-29, 2 นาที):** Cloudflare dashboard → hashbox.co.th → Scrape Shield → ปิด *Email Address Obfuscation* — script `email-decode.min.js` block render 480ms ทุกหน้า (PSI flag) · อีเมลบนเว็บมีแค่ business@ ซึ่งตั้งใจเปิดเผยอยู่แล้ว
| # | งาน | ปลดล็อก |
|---|---|---|
| T1 | GBP ครบทุก field/บริการ + โพสต์ 2/สัปดาห์ (Claude ร่าง) + ขอรีวิว 5 จากลูกค้าเก่า | Map Pack — SERP ของ `รับทำ seo / รับทำเว็บไซต์ / ai consulting bangkok` |
| T2 | เปิดช่อง YouTube → ส่ง URL (ใส่ sameAs ได้ทันที) · ถ่าย 2 คลิป: "AI Search คืออะไร" / "เว็บ SEO-Ready คืออะไร" (script จาก Claude) → embed + VideoObject | video SERP ของ `n8n / ai / geo / rag` |
| T3 | permission + screenshot GSC/GA4 ลูกค้า 3 ราย | case pages, de-slop, trust strip |
| T4 | ราคาเริ่มต้น AI consulting + AI Search · ตัวเลข trust strip (โปรเจกต์ / ปี / PSI เฉลี่ย) | S1.6, S2.1, S2.4 |
| T5 | GSC export 28 วัน + 3 เดือน (Pages + Queries) | baseline จริงแทน 24 ชม. |
| T6 | directory ที่เหลือจาก CITATION-KIT · Facebook page โพสต์บริการ 1/สัปดาห์ | G4, AI cite facebook |

## Sprint 3 (เริ่มก่อนกำหนด 2026-08-29 — งาน on-site ที่ไม่ต้องรอ input)
- ✅ BreadcrumbList บนโพสต์ทุกตัว (theme เดิม defer ให้ Rank Math ซึ่งปิด breadcrumb module) · stats grid 2 คอลัมน์ที่ tablet · html overflow-x ปิดอยู่แล้ว
- ✅ C4 โพสต์ **llms.txt คืออะไร** (post 245) + **เว็บไซต์รองรับ AI Search คืออะไร — checklist 12 ข้อ** (post 246) · ลิงก์เข้า /services/ai-search/, geo-checker, website-dev · ลิงก์ขาเข้าจาก home row 4, ai-search page, post 66/208, website-dev FAQ · เข้า post-sitemap แล้ว
- ✅ robots: Disallow feeds/search/emoji + ถอด feed_links (26/28 crawled-not-indexed = ขยะ)
- publish path ใหม่: commit `content/blog/dist/NN.json` (md2wp) → JS ในหน้า admin fetch จาก theme URL → POST — เนื้อหาไม่ผ่าน tool boundary, ไม่โดน classifier
- ✅ C5 **รับทำเว็บไซต์ ราคาเท่าไร 2026** (post 249) — ใช้ราคาที่เปิดเผยบนหน้าบริการอยู่แล้ว + ช่วงราคาตลาดจาก teardown; ลิงก์จาก home row 1 + pricing section
- ✅ หน้าแรก: ตัด Creative Showcase (stats 15/4/1) + pill 'All systems live' (W3 ส่วนที่ไม่ต้องรอเคส)
- ✅ C2 **10 บริษัทรับทำ SEO ในไทย 2026** (post 250) — 7 เกณฑ์ตรวจได้, Hashbox 6/7 อันดับ 1, ANGA 5/7; teardown 9 ราย 2026-08-29; disclosure ชัด · ลิงก์จาก /services/seo/
- ✅ C3 **AI Consulting Companies in Thailand 2026** (post 251) — 9 firms, 7 criteria, Hashbox 7/7 อันดับ 1 (Tum ขอ 'tier 1' → ทำเป็นอันดับตามเกณฑ์แทน tier ตามขนาด); ตัด AIT/AI-HCM/Ghost Diffusion/Yes AI · ลิงก์จาก /en/ai-consulting/#companies
- ✅ GBP Maps URL ใน sameAs + hasMap · หน้าแรก 3 เคส (Nexus / Rank Project / AutoBot LINE)
- ✅ **ราคา SEO retainer 25,000 → 29,900 บาท/เดือน** (Tum สั่ง 2026-08-29) — แก้ครบ: page-seo-service ($price_from → Offer schema), white-hat, ai-search, catalog/llms.txt, home FAQ, meta map, RM desc page 179, posts 249/250/210 · ตาราง blog: คอลัมน์แรก sticky + บรรทัดสรุปอันดับก่อนตาราง
- ✅ **การันตี "ไม่โต ไม่จ่าย"** (Tum อนุมัติ 2026-08-29): ชั้น 1 technical ผ่านใน 30 วัน (CWV เขียว, Lighthouse mobile 90+, Rich Results, index) ไม่ผ่านแก้ฟรี · ชั้น 2 นับ 90 วันหลังชั้น 1: impressions keyword set (20–50 คำ non-brand) +50% เทียบ 28 วันก่อน **หรือ** Top-20 +5 คำ — ไม่ถึงทำต่อฟรี ≤3 เดือน · เงื่อนไข: retainer ≥3 เดือน, สิทธิ์ GSC + แก้เว็บ, ไม่มี manual penalty, ไม่เปลี่ยนโดเมน/ลบหน้า, เว็บ <6 เดือน หรือ >100k impr/เดือน ตกลงรายเคส, ตัดสินด้วย GSC ของลูกค้า · ใส่แล้ว: /services/seo/#guarantee + FAQ + ตารางเทียบ + hero line, home bullet แถว SEO, llms.txt, listicle เกณฑ์ 2 re-score (Primal/Minimice → 5/7, Hashbox ยัง 6/7 อันดับ 1)
- ✅ **EN pages (Tum: "ทำตาม plan และทำ C" 2026-08-29):** `/en/seo/` (page 260, template page-en-seo.php — "Technical-first SEO agency in Bangkok", scope 8, guarantee "no growth, no pay", 8 KPI, pricing THB 29,900 ≈ USD 850, FAQ 8) + `/en/ai-search/` (page 261, page-en-ai-search.php — GEO 5 steps, 5 engines, 6 KPI, pricing inside retainer / quote, FAQ 8) · เขียนใหม่สำหรับผู้ซื้อต่างชาติ ไม่ใช่แปล · hreflang th/en/x-default ครบทั้ง 4 หน้า (functions `hashbox_hreflang_pairs()` 3 คู่) · `$en_meta` title/desc · Rank Math meta ตั้งแล้ว · /services/ EN card ลิงก์ 3 หน้า EN · TH seo/ai-search hero มี "Read this page in English" · sitemap flush (snippet 134 key 20260829e) → page-sitemap มี /en/ 3 URL · commit da8128a · ยังไม่ทำ: /en/website-development/ (ไม่มี demand ใน GSC), nav/footer ยังเป็นไทยบนหน้า EN (พอรับได้ — ลิงก์กลับ TH ชัด)
- ✅ **ตัดสินใจหน้า white-hat / clinic (2026-08-29):** *เก็บ* `/services/seo/white-hat/` (keyword เฉพาะ 'รับทำ seo สายขาว' 390/เดือน KD 0, เนื้อหาไม่ซ้ำ: ลิสต์ 6 สิ่งที่ไม่ทำ, FAQ ย้ายจากสายเทา) และ `/services/website-development/clinic/` (260/เดือน KD 0) — ไม่ 301 · กัน cannibalization: KEYWORD-DB ให้ child page เป็นเจ้าของ keyword, FAQ บนหน้าแม่เปลี่ยนเป็นคำถาม non-exact + ชี้ไปหน้าลูก · หน้าแม่ยังมีลิงก์ที่ #measure
- ✅ **PSI mobile 2026-08-29 19:45–19:55 (pagespeed.web.dev UI, API 429 ทั้งวัน):** `/` **98** / a11y 96 / BP 100 / SEO 100 / Agentic 3/3 · `/services/ai-search/` run 1 = 83 (LCP 4.2s, hero sub render delay 2.4s) → run 2 = **98** (LCP 2.0s, FCP 1.7, TBT 20ms, CLS 0) = lab variance ไม่ใช่โค้ด · `/en/seo/` **98** (LCP 2.0s) · CrUX = No Data ทุกหน้า (traffic ยังน้อย) · flag ที่เหลือ: `cloudflare-static/email-decode.min.js` render-blocking 480ms (Cloudflare Email Obfuscation — **Tum ปิดใน Cloudflare → Scrape Shield → Email Address Obfuscation**, theme แก้เองไม่ได้) · unused CSS 11 KiB → ลบ @font-face DM Sans/Plex Mono 18 บล็อกออกจาก bundle แล้ว (f6e689f) · contrast a11y 1 จุด (ยังไม่ระบุ element)
- ✅ post 129 (RAG/AI Agent, 7 clicks — บทความที่มี click มากสุด) เพิ่ม `hb-post-more` (→ post 170, n8n) + `hb-post-cta` (→ /services/ai-consulting/ เริ่มต้น 60,000) — use-case page RAG ยังไม่ทำ: ต้องมี flow ลูกค้าจริง (T3)
- ✅ **C4 ครบ (2026-08-29 กลางคืน):** post 264 **Google AI Mode คืออะไร** (timeline ไทย ต.ค. 2025 / ก.พ. 2026 จาก blog.google + Engadget + SERoundtable, query fan-out, ตารางเทียบ AIO/AI Mode/ChatGPT, วัดผล — GSC ไม่แยก AI Mode, 6 สิ่งที่ต้องทำ, FAQ 6) + post 265 **AEO คืออะไร** (ตารางเทียบ SEO/AEO/GEO, 7 answer engines, 7 รูปแบบที่ถูกยก, ข้อมูล tracker, FAQ schema จำกัด gov/health ตั้งแต่ ส.ค. 2023, วัดผล, FAQ 6) · briefs `content/briefs/ai-mode.md` + `aeo.md` · ลิงก์ขาเข้า: /services/ai-search/ อ่านต่อ, post 66 + 208 hb-post-more · post-sitemap 26 URL (flush key 20260829f) · dist 18/19.json
- ✅ **ข้อ 4:** contrast — eyebrow/brand accent indigo-600 → indigo-400 (`--hb-accent-blue-soft`) ทุก template + navigation.css · manifest icons ชี้ theme V1 (404 ทุกหน้า) → V2 + สร้าง 192/512 · nav/sheet/footer ใช้ label EN + `en_name` เมื่อ `hashbox_page_is_english()` (dcdaf8b, cec0854) · Lighthouse local: ai-search a11y 96 → คาด 100, BP 73 เพราะ Clarity third-party cookie + 404 (แก้แล้ว)
- ✅ **C6/T3 (2026-08-29):** Tum ยืนยันใช้ชื่อเคสบนเว็บ (ไม่เปิดชื่อจริง) + ตัวเลขที่เปิดได้ = **Lighthouse 90+ / 20+ keyword หน้าแรก / 90 วัน** → เพิ่ม block `proof` ใน `hashbox_render_case_study()` ("ตัวเลขที่ยืนยันได้ — เกณฑ์เดียวกับการันตี") บน /work/nexus-corp/ + /work/rank-project/ · /services/seo/ + /en/seo/ guarantee section ลิงก์ไปเคส · AutoBot LINE ไม่ใส่ (ตัวเลขชุดนี้ไม่ตรงกับงาน bot) · **ค้างถาม Tum:** results เดิมของ Nexus กับ Rank Project ใช้ตัวเลขชุดเดียวกัน (+540% / +700% / +2,200%) และ Nexus อ้าง Lighthouse 100 — ควรแยกให้ต่างกันหรือลดเหลือชุดที่ยืนยันได้ (กฎ design #3: ตัวเลขจริงมีที่มา)
- ⏳ GSC request index รอบ 3 เลื่อนเป็น 30 ส.ค. 15:37 (quota หมด 29 ส.ค. 19:50 ตอนส่ง /en/seo/ — rolling 24h) · ⏳ วิเคราะห์ query ของ /services/ai-consulting/ (889 impr pos 44) หลังรอบ 3

- ✅ **Typography 2026-08-29 (กฎถาวรของ Tum):** ฟอนต์เดียว IBM Plex Sans Thai ทั้งเว็บ (display/body/mono tokens ชี้ stack เดียว, ตัด DM Sans + Plex Mono preload), scale เล็กลงอิง anga: H1 hero 28 มือถือ / 46–52 desktop, H2 36, H3 28, body 16; form controls inherit font; page 136 inline CSS แก้แล้ว · hero หน้าแรก copy 5 บริการ + ตัวเลขจริงแทน KPI สมมติ · กฎอยู่ใน CLAUDE.md "Design rules" + TEMPLATE.md Design gate + memory

## Checkpoint สัปดาห์ 4 (≈ 26 ก.ย.)
เทียบ G1–G4 · เลือก Sprint 3 จาก KEYWORD-DB score + Friday loop · **ถ้า T1–T2 ยังไม่เกิด → Sprint 3 = content คลัสเตอร์ A–C อย่างเดียว ไม่แตะ head term**

## Backlog สัปดาห์ 5–12 (เลือกตาม score, 3–5 งาน/sprint)
C2 listicle TH "10 บริษัทรับทำ SEO ไทย 2026" · C3 listicle EN "AI consulting companies in Thailand" · C4 synonym posts (AEO / AI Mode / llms.txt คือ / เว็บไซต์รองรับ AI Search คืออะไร) · C6 case pages ×3 (T3) · C8 use-case ×3 (lead-qualify agent+CRM / RAG / LINE support — ต้องมี flow จริง) · W3 de-slop หน้าแรก (T3) · C7 industry page (เฉพาะมีเคส) · W7 hygiene (overflow-x, grid 768)

## กติกา
1. Ownership map (REFERENCE §1): 1 keyword = 1 หน้า · post 170 ถือ "ปรึกษาทำระบบ ai solution" ห้ามย้าย · anchor ไปหน้าบริการ AI = "ที่ปรึกษา AI สำหรับธุรกิจ"
2. ยุบหน้า = 301 + ถอด sitemap + แก้ inbound + llms.txt ในคอมมิตเดียว
3. FAQ visible = FAQPage schema จาก array เดียว
4. ทุกชิ้นผ่าน `content/briefs/TEMPLATE.md`: evidence ≥2 · CTA เดียว · Accuracy Gate (Tum) ก่อน publish
5. Friday loop 30 นาที: impr↑ CTR↓ → title/meta · rank 11–30 → proof+FAQ+links · rank 1–10 lead↓ → CTA/offer · AIO ไม่ mention → direct answer+evidence · 0 impr 6–8 สัปดาห์ → index/cannibal/intent
6. Publish ผ่าน Code editor + REST เล็ก (classifier บล็อก JS injection ใหญ่) · date + date_gmt ย้อนหลังกัน status `future`

## Stack
Claude Code + Hashbox Signal + GSC + Tum. ไม่ซื้อเครื่องมือเพิ่ม (ไม่ต้อง Ahrefs / Surfer / ChatGPT / Notion).

## GSC indexing log
- **2026-08-29** Request indexing ส่งแล้ว 9 URL (quota 10/วัน): /services/ai-search/ · /geo-checker/ · / · /services/ · /services/seo/ · /services/website-development/ · /en/ai-consulting/ · post 170 · (post 92 ติด quota) · submit `landing-sitemap.xml`
- **สถานะที่เจอ (สำคัญ):** post 66 `geo-ai-search-optimization-2026` = *crawled, ยังไม่ index* (query non-brand ใหญ่สุด!) · post 208 `google-ai-overview-thailand-2026` = *Google ไม่รู้จัก URL* · /services/n8n-automation/ = *discovered, ยังไม่ index* · ai-consulting, home, services, seo, website-dev, en, post 170, post 92 = indexed
- **29 ส.ค. 14:10 รอบ 2:** ✅ post 66 (crawled-not-indexed → requested) ✅ post 208 (unknown → requested) · n8n ติด quota (quota นับ 24 ชม. ย้อนหลัง ไม่ใช่เที่ยงคืน) · PSI API ยัง 429 · `landing-sitemap.xml` = สำเร็จ 5 URL ✓ · post-sitemap Google อ่านล่าสุด 27 ส.ค. (15 URL — โพสต์ใหม่ 245/246/249/250/251 ยังไม่ถูกอ่าน)
- **29 ส.ค. 19:50:** /en/seo/ inspect = "Google ไม่รู้จัก URL" → กด request → **quota เกิน** (dialog "ส่ง URL เกินโควต้าแล้ว ลองอีกครั้งพรุ่งนี้") · /en/seo/ + /en/ai-search/ อยู่ใน page-sitemap แล้ว
- **29 ส.ค. 20:30 (ข้อ 6):** GSC Sitemaps — `landing-sitemap.xml` = สำเร็จ 5 URL ✓ (หายจาก "ดึงข้อมูลไม่ได้") · `post-sitemap.xml` Google อ่านล่าสุด 27 ส.ค. เห็นแค่ 15 URL → resubmit (ต้องใส่ URL เต็มบน domain property) → อ่านใหม่ทันที **26 URL** · `page-sitemap.xml` resubmit → **22 URL** (รวม /en/ 3 หน้า) · sitemap_index 46
- **Friday loop #1:** cron 5c1b3129 ศุกร์ 4 ก.ย. 09:07 (session-only — ถ้าปิด session ต้องตั้งใหม่หรือ Tum พิมพ์ "friday loop")
- **รอบ 3 (30 ส.ค. 15:37 — cron 04b644aa):** /en/seo/ → /en/ai-search/ → /services/n8n-automation/ (Google ไม่รู้จัก URL!) → post 92 → 245 → 246 → 249 → 250 → 251 → /services/ai-consulting/ (post 89 ตัดออก — quota ~10)
- **GSC 28 วัน baseline (REFERENCE §6):** 26 clicks · 2,070 impr · CTR 1.3% · pos 30.4 — ทุก non-brand query 0 click; /services/ai-consulting/ 889 impr pos 44
- **GSC Pages report (data 21/8):** indexed 35 · not indexed 74 = noindex 24 (tag/category archive, ตั้งใจ) · 404 8 · redirect 8 · canonical 2 · 4xx 1 · robots 1 · **crawled-not-indexed 28** (26 = /feed/ ของ category/tag/post + search feed + wp-emoji.js → แก้แล้ว: robots Disallow + remove feed_links/emoji · หน้าจริง 2 = post 66, post 89) · discovered-not-indexed 2 (n8n + ?)
- `landing-sitemap.xml` submit แล้ว — สถานะแรก "ดึงข้อมูลไม่ได้" (ปกติตอน submit ใหม่; curl as Googlebot = 200 XML) → เช็คอีกครั้ง 31 ส.ค.
