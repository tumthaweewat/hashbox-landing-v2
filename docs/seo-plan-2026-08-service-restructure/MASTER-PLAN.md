# Hashbox 90-Day Plan — 1 ก.ย. → 20 พ.ย. 2026

> รวมทุกงานจาก session 28 ส.ค. 2026: restructure service, หน้า AI Search, de-slop หน้าแรก, authority/AI citation, content, measurement. Owner: **C** = Claude ทำในโค้ด/WP, **T** = Tum (ต้องการสิทธิ์/ไฟล์/ตัดสินใจ), **C+T** = Claude ร่าง Tum รีวิว.

## เป้าหมาย (วัดวันที่ 20 พ.ย.)
| # | Goal | Baseline 28 ส.ค. | Target |
|---|---|---|---|
| G1 | Non-brand clicks / เดือน | ~1 (24 ก.ค.–ส.ค.) | 40+ |
| G2 | Impressions / เดือน | ~3,800 pace | 8,000 |
| G3 | AI cluster: `ปรึกษาทำระบบ ai solution สำหรับธุรกิจ` / `ที่ปรึกษา ai ไทย` / `ai consulting bangkok` | 3 / 14 / 14 | ≤10 ทั้ง 3 (avg GSC) |
| G4 | ใหม่: `รับทำ ai search` / `local seo bangkok` / `รับทำ seo audit` | — / 13 / 31–49 | ≤20 / ≤8 / ≤20 |
| G5 | Referring domains | 0 | 10 |
| G6 | AI เอ่ยถึงเรา (20 prompt) / AI Overview ที่ปรากฏ (51 kw) | 6 / 11 | 10 / 20 |
| G7 | หน้าแรกไม่ AI-slop: เคสชื่อจริง+รูปจริง 3, section 12→7, ไม่มี fake UI | 0 เคสจริง | ครบ |
| G8 | CWV mobile หลังใส่รูปจริง | 93 | ≥90 |

## W1 — Service Restructure (สัปดาห์ 1) · owner C
| # | งาน | ไฟล์/ช่องทาง | Guard |
|---|---|---|---|
| 1.1 | 301 `/services/digital-marketing-tools/` → `/services/seo/#cro` + ถอด sitemap | functions.php `template_redirect` | pattern `hashbox_redirect_legacy_*` |
| 1.2 | ย้าย CRO/Tracking เป็น H2 `#cro` ใน `/services/seo/` (+FAQ array) | page-seo-service.php | FAQ visible = schema |
| 1.3 | แก้ inbound 10 จุด (front-page ×2, page-services ×3, footer, 404, seo-ready, wordpress, ai-consulting schema) + `hasOfferCatalog` 5 รายการ + form `service_interest` + llms.txt (แก้ slug CRO guide) | หลายไฟล์ | grep ห้ามเหลือ URL เก่า |
| 1.4 | post 70 ลิงก์ → `/services/seo/#cro` | REST | — |
| 1.5 | หน้าแรก: การ์ด 3 ใบ → service list 5 แถว + sub-service bullets, anchor ตาม ownership map | front-page.php, composed.css | H1 คง, `/work/` `/blog/` `#contact` คง |
| 1.6 | Nav dropdown "บริการ" 5 รายการ + mobile sheet | header.php, navigation.css, v2.js | `<a href>` จริง, aria |
| 1.7 | `/services/` ItemList → Service (name/url/desc/offers) จาก array เดียวกับ hasOfferCatalog | functions.php | Rich Results Test |
| 1.8 | Rank Math title/desc หน้าแรก + `/services/` สะท้อน 5 บริการ | REST updateMeta | — |
| 1.9 | `/seo-audit/`, `/seo-recovery-audit/` เข้า sitemap + title/H1 "รับทำ SEO Audit / Technical SEO Audit ฟรี" + ลิงก์จาก SEO page | functions.php, page-audit-landing.php | ไม่ซ้ำ `รับทำ seo` |
| 1.10 | post 92 Local SEO: EN answer-first + CTA; `/services/seo/` scope + "Local SEO Bangkok" | REST, page-seo-service.php | — |
| 1.11 | ตรวจ: php -l, contract tests, curl 301, Rich Results, PSI mobile ≥90, GSC request index | — | — |

## W2 — AI Search Service Page (สัปดาห์ 2–3) · owner C+T
| # | งาน | Owner |
|---|---|---|
| 2.1 | ร่าง `/services/ai-search/` ~1,200 คำ: answer-first, ทำไม 2026 (data post 208), กระบวนการ 5 ขั้น, วัดผล 4 metric, ราคา, เคส, FAQ 6–8 | C ร่าง → **T รีวิว copy + ราคา** |
| 2.2 | Publish (Code editor path) + Rank Math meta + hreflang ถ้ามี EN section | C |
| 2.3 | post 66 + 208 เพิ่ม CTA/anchor "บริการรับทำ AI Search" ขึ้นหน้าใหม่ | C |
| 2.4 | เพิ่มหน้าใน nav/home list/llms.txt/hasOfferCatalog/ItemList | C |
| 2.5 | Publish `/geo-checker/` (template มีแล้ว) เป็น lead magnet ลิงก์จากหน้า AI Search | C (T ทดสอบ tool) |
| 2.6 | `/en/ai-consulting/` เพิ่ม answer-first list "AI consulting companies in Thailand" (AI Overview 25 แหล่ง ไม่มีเรา) | C |
| 2.7 | GSC request index + tracker เพิ่ม keyword กลุ่ม AI Search | C / T (GSC) |

## W3 — หน้าแรก De-slop (สัปดาห์ 2–4) · owner C (รูป/ชื่อ = T)
| # | งาน | Owner | ต้องการ |
|---|---|---|---|
| 3.1 | ตัด Showcase (15/4/1), Why+stats, testimonial ไม่มีชื่อ, "All systems live" pill | C | — |
| 3.2 | Hero: ย่อหน้ายาว → 1–2 ประโยค; H1 คง keyword; visual → PSI report จริง/GSC graph จริง | C | — |
| 3.3 | เคส 6 → 3 เคสเด่นพร้อม **screenshot จริง + ชื่อจริง** (1 เคสเต็มความกว้าง) | C | **T: permission + screenshot/GSC/GA4 3 เคส** |
| 3.4 | Process การ์ด 5 ใบ → timeline; Pricing "Most Popular" ต่างจริง | C | — |
| 3.5 | ลด eyebrow/mono/icon; ตัด icon ในกล่องม่วง | C | — |
| 3.6 | Service list (จาก W1.5) เป็นแถว + เส้นคั่น ไม่ใช่การ์ด | C | — |
| 3.7 | Testimonial ใหม่ชื่อ-นามสกุล-บริษัทจริง หรือไม่มี | T | quote + permission |
| 3.8 | หลังใส่รูป: webp ≤150 KB, preload hero 1 รูป, วัด PSI mobile | C | — |

## W4 — Authority & AI Citation (สัปดาห์ 1–12 ต่อเนื่อง) · owner T (C เตรียมของ)
| # | งาน | Owner | ทำไม |
|---|---|---|---|
| 4.1 | GBP: โพสต์ 2 ครั้ง/สัปดาห์, ขอรีวิว 5 รายจากลูกค้าเก่า, ครบทุก field/บริการ | T (C ร่าง post) | `รับทำเว็บไซต์*` SERP = Local Pack 100% |
| 4.2 | Directory ที่เหลือ ~18 จาก CITATION-KIT (Clutch/GoodFirms/F6S เสร็จ) | T | referring domains + AI cite directory |
| 4.3 | Guest article GEO (ร่างมี) → 3 สื่อ/community ไทย; Techsauce pitch (template มี) | T ส่ง / C ปรับร่าง | backlink ที่ AI ดึง |
| 4.4 | Facebook page: โพสต์บริการ/เคส 1 ครั้ง/สัปดาห์ (AI cite facebook.com 85 ครั้ง) | T (C ร่างจาก share pack) | AI source |
| 4.5 | YouTube: 2 วิดีโอสั้น "รับทำเว็บไซต์ SEO-Ready คืออะไร" / "AI Search คืออะไร" | T (C เขียน script) | AI cite youtube 77 ครั้ง; SERP วิดีโอ |
| 4.6 | Footer credit dofollow บนเว็บลูกค้าใหม่ทุกโปรเจกต์ | T | +1 domain/โปรเจกต์ |
| 4.7 | พิจารณา profile fastwork.co (AI cite 174 ครั้ง — มากสุด) | T ตัดสินใจ | AI source #1 |

## W5 — Content (สัปดาห์ 2–12, 2 ชิ้น/เดือน) · owner C ร่าง, T รีวิว
| สัปดาห์ | ชิ้น | Hub |
|---|---|---|
| 2 | ปรับ post 66 GEO คืออะไร: answer-first + "จ้างทำ GEO ต้องดูอะไร" + CTA | ai-search |
| 3 | ปรับ post 208 AI Overview ไทย + CTA | ai-search |
| 4 | ใหม่: llms.txt คืออะไร ทำยังไง | ai-search |
| 5 | ใหม่: รับทำเว็บไซต์ ราคาเท่าไร 2026 | website-development |
| 6 | ใหม่: Headless WordPress + Next.js สำหรับธุรกิจไทย | website-development |
| 8 | ใหม่: Sales GPT + CRM เคสจริง | ai-consulting |
| 9 | ปรับ post 70 CRO → ชี้ `/services/seo/#cro` | seo |
| 10 | ใหม่: n8n vs Make vs Zapier สำหรับ SME ไทย | n8n |
| 11–12 | เคสลูกค้าชื่อจริง 1–2 (Article + GSC screenshot) | work |
กติกา: answer-first 60 คำ, FAQ block 4–6, anchor ขึ้น hub, dateModified จริง, publish ผ่าน Code editor + REST เล็ก

## W6 — Measurement (ทุกเดือน) · owner C+T
| # | งาน | Owner |
|---|---|---|
| 6.1 | Tracker เพิ่ม: local seo bangkok, local seo bkk, รับทำ seo audit, รับทำ seo technical audit, ai optimization services bangkok, รับทำ ai search, ai seo, geo agency | C (ถ้า tool มี API) / T |
| 6.2 | GSC export 28 วัน + 3 เดือน ทุกต้นเดือน (ไม่ใช่ 24 ชม.) | T |
| 6.3 | AI prompt test 20 prompt/เดือน (ChatGPT/Claude/Gemini/Perplexity) บันทึกใน tool | tool อัตโนมัติ / T ตรวจ |
| 6.4 | PSI mobile+desktop หลัง W3 | C |
| 6.5 | OpenSEO: เชื่อม GA4 (ยังไม่เชื่อม) | T |
| 6.6 | รายงานเดือนละครั้ง เทียบ G1–G8 | C |

## W7 — ค้างเก่า / hygiene
| # | งาน | Owner |
|---|---|---|
| 7.1 | design-audit เปิดค้าง: html overflow-x leak, grid 768px 2+1 | C |
| 7.2 | P7 inline critical CSS — **ข้าม** (CWV 93/100 แล้ว) | — |
| 7.3 | llms.txt ลิงก์ CRO guide slug ผิด (`cro-thai-websites-2026`) — รวมใน 1.3 | C |
| 7.4 | robots.txt ประกาศ AI bots (GPTBot/PerplexityBot/ClaudeBot Allow) ชัดเจน | C |

## ต้องการจาก Tum (blocking)
1. Permission + screenshot/GSC/GA4 ของลูกค้าจริง 3 เคส (W3.3, W5 11–12)
2. รีวิว copy + ราคา หน้า AI Search (W2.1)
3. GSC export 28 วัน + 3 เดือน (W6.2)
4. GBP/รีวิว/directory/FB/YouTube ลงมือเอง (W4)
5. ตัดสินใจ fastwork profile (W4.7)

## Timeline
| สัปดาห์ | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 12 |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| W1 Restructure | ■ | | | | | | | | | | | |
| W2 AI Search page | | ■ | ■ | | | | | | | | | |
| W3 Home de-slop | | ■ | ■ | ■ | | | | | | | | |
| W4 Authority | ■ | ■ | ■ | ■ | ■ | ■ | ■ | ■ | ■ | ■ | ■ | ■ |
| W5 Content | | ■ | ■ | ■ | ■ | ■ | | ■ | ■ | ■ | ■ | ■ |
| W6 Measure | ■ | | | | ■ | | | | ■ | | | ■ |
| Checkpoint | | | | ◆ | | | | ◆ | | | | ◆ |

---
## Addendum 2026-08-28 (late)
- `WEBSITE-CHANGES.md` — รายการแก้ไขเว็บ 36 ข้อจาก GSC + Signal + teardown metier/anga/makewebeasy (A–F)
- `CONTENT-OPS.md` + `KEYWORD-DB.csv` — Content OS: keyword scoring (64 คำ), Keyword Card, Publish Package, Review Gate, Friday loop; W5 เพิ่ม C8 use-case pages ×3 และ guide "เว็บไซต์รองรับ AI Search คืออะไร"
