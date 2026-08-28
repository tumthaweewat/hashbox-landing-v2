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
| G3 AI เอ่ยถึง (20 prompt) | 6 | 8 | 10 |
| G4 referring domains (Tum) | 0 | 5 | 10 |

Guard: PSI mobile ≥ 90 · H1 หน้าแรกคง "รับทำเว็บไซต์ … SEO" · ไม่มี 404 ค้าง

## โฟกัส (สัปดาห์ 1–4)
| | คลัสเตอร์ | ทำไม | หน้า |
|---|---|---|---|
| A | AI consulting TH + EN | ติดแล้ว ยกง่ายสุด — post 170 pos 3 แต่ 0 click; service page 14; EN 14–23 | post 170 · /services/ai-consulting/ · /en/ai-consulting/ |
| B | AI Search (GEO) | มี authority เนื้อหา (`geo คือ` = query non-brand ใหญ่สุด) แต่ไม่มีหน้าขาย | /services/ai-search/ ใหม่ + post 66/208 |
| C | SEO Audit + Local SEO | มี impr แล้ว: /seo-audit/ pos 31, post 92 pos 13 (27 impr/วัน) | /seo-audit/ · /services/seo/ · post 92 |
| — | Foundation | ชื่อบริการ = keyword, footer/nav ส่ง link equity, ชั้น AI (llms/robots/entity) — ทุกคลัสเตอร์ได้ประโยชน์ | หน้าแรก, nav, footer, functions.php |

**พักไว้ก่อน** (จนสัปดาห์ 5 หรือมี evidence): `รับทำเว็บไซต์*` head term (Map Pack 100%) · industry page · listicle · use-case page · de-slop หน้าแรก (ต้องมีเคสจริง)

## Sprint 1 — สัปดาห์ 1–2 · Claude
| # | งาน | ref |
|---|---|---|
| S1.1 | post 170: title ใส่ปี/งบ/checklist, meta answer-first, CTA → /services/ai-consulting/ (แก้ 0 click) | F1 |
| S1.2 | Restructure: home 5 แถว H3=keyword + sub-bullet · nav "บริการ" dropdown · **footer เพิ่ม seo / n8n / ai-search** · DM 301 → /services/seo/#cro + ลบ 13 ref · `hashbox_service_catalog()` array กลาง → ItemList 5 / hasOfferCatalog / llms.txt / 404 / form · Rank Math meta home + /services/ | A1–A5, A8 |
| S1.3 | ชั้น AI: llms.txt เขียนใหม่ + llms-full.txt (entity, ก่อตั้ง, ราคา, FAQ, เคส) · robots.txt Allow AI bots · Organization `alternateName` / `foundingDate` / `founder` / sameAs + GBP·YouTube·Clutch·GoodFirms·F6S | D1–D3 |
| S1.4 | /seo-audit/ + /seo-recovery-audit/ เข้า sitemap, title "รับทำ SEO Audit / Technical SEO Audit" · post 92 EN answer-first + CTA | A7 |
| S1.5 | /services/seo/ template: H1 มี outcome, นิยาม 2 บรรทัดแรก, H2 variants (บริษัทรับทำ / สายขาว / Local SEO Bangkok / ราคา), H2 "วิธีวัดผล", section `#cro`, FAQ +3 | B1 |
| S1.6 | /services/ai-consulting/ template + H2 variants (บริการให้คำปรึกษา AI / ผู้ให้บริการโซลูชัน AI / บริการ RAG / AI Tool) + ราคาเริ่มต้น (รอ T4) + ลิงก์ post 170/220/224/69 | B3 |
| S1.7 | /en/ai-consulting/ answer-first list "AI consulting companies in Thailand" + H2 variants (AIO 25 แหล่ง ไม่มีเรา) | B5 |
| S1.8 | Verify: `php -l`, contract tests, curl 301, `grep digital-marketing-tools` = 0, Rich Results, PSI mobile, GSC request index (T) | — |

## Sprint 2 — สัปดาห์ 3–4 · Claude
| # | งาน | ref |
|---|---|---|
| S2.1 | `/services/ai-search/`: brief จาก TEMPLATE → draft 3 รอบ → publish. Anatomy: นิยาม → ทำไม 2026 → กระบวนการ 5 ขั้น → platform grid → KPI (AI Visibility / Mentions / Citations / SoV) → package + ราคา (T4) → **proof = Signal dashboard ของเราเอง** → FAQ 8 → /geo-checker/ | C1 |
| S2.2 | post 66 / 208 answer-first + CTA → ai-search · CTA จาก 19 โพสต์ "X คือ" → หน้าบริการเจ้าของ keyword (REST) | A6 |
| S2.3 | /services/website-development/ + /services/n8n-automation/ template (H1 outcome, นิยาม, variants: บริษัท / ราคา / WordPress · รับวางระบบ n8n / n8n ราคา / AI Automation) | B2, B4 |
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
C2 listicle TH "10 บริษัทรับทำ SEO ไทย 2026" · C3 listicle EN "AI consulting companies in Thailand" · C4 synonym posts (AEO / AI Mode / llms.txt คือ / เว็บไซต์รองรับ AI Search คืออะไร) · C5 "รับทำเว็บไซต์ ราคา 2026" · C6 case pages ×3 (T3) · C8 use-case ×3 (lead-qualify agent+CRM / RAG / LINE support — ต้องมี flow จริง) · W3 de-slop หน้าแรก (T3) · C7 industry page (เฉพาะมีเคส) · W7 hygiene (overflow-x, grid 768)

## กติกา
1. Ownership map (REFERENCE §1): 1 keyword = 1 หน้า · post 170 ถือ "ปรึกษาทำระบบ ai solution" ห้ามย้าย · anchor ไปหน้าบริการ AI = "ที่ปรึกษา AI สำหรับธุรกิจ"
2. ยุบหน้า = 301 + ถอด sitemap + แก้ inbound + llms.txt ในคอมมิตเดียว
3. FAQ visible = FAQPage schema จาก array เดียว
4. ทุกชิ้นผ่าน `content/briefs/TEMPLATE.md`: evidence ≥2 · CTA เดียว · Accuracy Gate (Tum) ก่อน publish
5. Friday loop 30 นาที: impr↑ CTR↓ → title/meta · rank 11–30 → proof+FAQ+links · rank 1–10 lead↓ → CTA/offer · AIO ไม่ mention → direct answer+evidence · 0 impr 6–8 สัปดาห์ → index/cannibal/intent
6. Publish ผ่าน Code editor + REST เล็ก (classifier บล็อก JS injection ใหญ่) · date + date_gmt ย้อนหลังกัน status `future`

## Stack
Claude Code + Hashbox Signal + GSC + Tum. ไม่ซื้อเครื่องมือเพิ่ม (ไม่ต้อง Ahrefs / Surfer / ChatGPT / Notion).
