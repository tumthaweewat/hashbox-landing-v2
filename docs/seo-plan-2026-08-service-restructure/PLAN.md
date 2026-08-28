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
| # | งาน | ปลดล็อก |
|---|---|---|
| T1 | GBP ครบทุก field/บริการ + โพสต์ 2/สัปดาห์ (Claude ร่าง) + ขอรีวิว 5 จากลูกค้าเก่า | Map Pack — SERP ของ `รับทำ seo / รับทำเว็บไซต์ / ai consulting bangkok` |
| T2 | เปิดช่อง YouTube → ส่ง URL (ใส่ sameAs ได้ทันที) · ถ่าย 2 คลิป: "AI Search คืออะไร" / "เว็บ SEO-Ready คืออะไร" (script จาก Claude) → embed + VideoObject | video SERP ของ `n8n / ai / geo / rag` |
| T3 | permission + screenshot GSC/GA4 ลูกค้า 3 ราย | case pages, de-slop, trust strip |
| T4 | ราคาเริ่มต้น AI consulting + AI Search · ตัวเลข trust strip (โปรเจกต์ / ปี / PSI เฉลี่ย) | S1.6, S2.1, S2.4 |
| T5 | GSC export 28 วัน + 3 เดือน (Pages + Queries) | baseline จริงแทน 24 ชม. |
| T6 | directory ที่เหลือจาก CITATION-KIT · Facebook page โพสต์บริการ 1/สัปดาห์ | G4, AI cite facebook |

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
- **พรุ่งนี้ (30 ส.ค.) ขอ index ตามลำดับ:** post 66 → post 208 → /services/n8n-automation/ → post 92 → /services/ai-consulting/ → post 224, 220 (เช็คสถานะก่อน) → /website-audit/
- Friday loop: ตรวจ "หน้า" report ใน GSC หา Crawled/Discovered-not-indexed ทั้งหมด — ถ้าเยอะ = สัญญาณคุณภาพ/internal link ต้องแก้ก่อน content ใหม่
