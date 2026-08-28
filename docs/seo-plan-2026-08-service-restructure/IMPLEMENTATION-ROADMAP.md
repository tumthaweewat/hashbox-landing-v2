# Implementation Roadmap

## Phase 1 — Restructure (สัปดาห์ 1) — ทำได้ทันทีในโค้ด
| # | งาน | ไฟล์ | SEO guard |
|---|---|---|---|
| 1 | 301 `/services/digital-marketing-tools/` → `/services/seo/#cro` | functions.php (`template_redirect`) | ถอดจาก sitemap, page meta map |
| 2 | ย้ายเนื้อหา CRO/Tracking เป็น H2 `#cro` ใน `/services/seo/` | page-seo-service.php | FAQ array อัปเดตพร้อม schema |
| 3 | แก้ inbound 10 จุด (front-page ×2, page-services ×3, footer, 404, seo-ready, wordpress, ai-consulting schema) + `hasOfferCatalog` เหลือ 5 + form `service_interest` + llms.txt (แก้ slug CRO guide ด้วย) | หลายไฟล์ | ห้ามเหลือลิงก์ไป URL เก่า |
| 4 | post 70 ลิงก์ → `/services/seo/#cro` | REST | — |
| 5 | หน้าแรก: การ์ด 3 ใบ → service list 5 แถว anchor keyword (+ sub bullets) | front-page.php, composed.css | คง H1, `/work/`, `/blog/`, `#contact` |
| 6 | Nav dropdown + mobile sheet 5 รายการ | header.php, navigation.css, v2.js | `<a href>` จริง, aria |
| 7 | `/services/` ItemList/Service schema จาก array เดียวกับ `hasOfferCatalog` | functions.php | validate ด้วย Rich Results Test |
| 8 | Rank Math title/desc หน้าแรก + /services/ ปรับให้มี 5 บริการ | REST updateMeta | — |
| 9 | ตรวจ: php -l, contract tests, curl 301, Rich Results, PSI mobile ≥90 | — | — |

## Phase 2 — AI Search page + intent split (สัปดาห์ 2–3)
| # | งาน |
|---|---|
| 1 | ร่าง `/services/ai-search/` ~1,200 คำ: answer-first (รับทำ AI Search คือ), ทำไมต้องทำปี 2026 (AI Overview TH data จาก post 208), กระบวนการ 5 ขั้น, วัดผล (AI visibility / brand mention / citation / SoV), ราคา (แนะนำ: รวมใน SEO retainer 25,000 หรือแยก add-on), เคส, FAQ 6–8 ข้อ → **ส่งให้ Tum รีวิว copy/ราคา ก่อน publish** |
| 2 | post 66 (GEO คืออะไร) + post 208 เพิ่ม CTA/anchor → `/services/ai-search/`; hub GEO cluster plan อัปเดต |
| 3 | เพิ่ม `/services/ai-search/` ใน nav, home list, llms.txt, hasOfferCatalog, ItemList |
| 4 | publish `page-geo-checker.php` เป็น `/geo-checker/` (tool ฟรี = lead magnet + linkable asset) ลิงก์จากหน้า AI Search |
| 5 | GSC: request indexing 2 URL; ตั้ง OpenSEO track keyword ชุดใหม่ (รับทำ ai search, ai seo, geo agency, บริการ geo) |

## Phase 3 — Authority (เดือน 2–3) — ตัวปลดเพดานจริง
| # | งาน |
|---|---|
| 1 | เคสลูกค้าชื่อจริง 3 เคส + screenshot GSC/GA4 (ต้องการ permission/รูปจาก Tum) |
| 2 | Directory/citation ที่ค้างจาก CITATION-KIT (Clutch/GoodFirms ส่งแล้ว; เหลือ ~18) |
| 3 | Guest article GEO (ร่างมีแล้ว GUEST-ARTICLE-GEO.md) → 3 สื่อ/community ไทย |
| 4 | Footer credit dofollow บนเว็บลูกค้าใหม่ทุกโปรเจกต์ |
| 5 | Brand mention prompts: ทดสอบ 20 prompt ใน Perplexity/ChatGPT ทุกเดือน บันทึกใน OpenSEO |

## Phase 4 — Compound (เดือน 4–12)
- Spoke content เดือนละ 2 โพสต์ตาม CONTENT-CALENDAR
- Industry pages (คลินิก / อสังหา / SaaS) เมื่อมีเคสจริงพอ
- รีวิว ItemList/Service schema + pricing ทุกไตรมาส
- วัด KPI ตาม SEO-STRATEGY §5

## Dependencies / Risks
- Phase 2 หน้า AI Search ต้องการ copy sign-off + ราคา
- Phase 3 ข้อ 1 ต้องการรูป/permission — ไม่มีสิ่งนี้ trust จะยังแพ้ Metier
- Auto-mode classifier บล็อกการเขียน content ใหญ่ผ่าน JS — ใช้ path: Code editor `form_input` + REST PATCH เล็ก
