# รายการแก้ไขเว็บ hashbox.co.th เพื่อชนะ keyword + AI Search

อัปเดต 2026-08-28 · แหล่งข้อมูล: GSC 24h export (7 ไฟล์), Hashbox Signal (56 keyword / 20 prompt / 51 AIO), teardown metierthailand.com · anga.co.th · makewebeasy.com

---

## 0. ความจริงจากข้อมูลก่อนแก้

| สัญญาณ | ค่า | ความหมาย |
|---|---|---|
| ติด top-20 | 8/56 keyword | ทั้ง 8 อยู่ในคลัสเตอร์ AI consulting (post 170, /services/ai-consulting/, /en/ai-consulting/) + brand |
| กลุ่ม `รับทำเว็บไซต์*` (8 คำ) | ไม่ติด top-20 ทั้งหมด | SERP ถูก Map Pack (google.com) ครอง 100% → ต้องมี GBP ถึงจะขึ้นเหนือ organic |
| กลุ่ม `รับทำ seo`, `seo agency`, `ai consulting bangkok` | ไม่ติด / pos 10–16 | Map Pack ครอง 100% เช่นกัน |
| กลุ่ม `รับทำ n8n`, `บริการ rag`, `รับทำ ai tool`, `geo seo`, `ที่ปรึกษา ai สำหรับธุรกิจ` | ไม่ติด | SERP ถูก **วิดีโอ YouTube** ครอง 67–100% — เราไม่มีวิดีโอเลย |
| post 170 `ปรึกษาทำระบบ ai solution` | pos 3–4, 23 impr/วัน, **0 click** | ติดแล้วแต่ CTR ศูนย์ → title/snippet ไม่ดึงคลิก |
| `local seo bangkok` | 27 impr pos 13 (post 92) | query non-brand ใหญ่สุดของวัน ไม่มีหน้าขาย |
| `รับทำ seo technical audit` / `รับทำ seo audit` | 4+1 impr pos 31/49 | มีหน้า /seo-audit/ แต่ไม่อยู่ใน sitemap, title ไม่ตรง |
| Desktop : Mobile | 88 : 20 | B2B query — desktop-first OK แต่ mobile CTR 0% |
| AI เอ่ยถึงเรา | 6/20 prompt (brand + "ที่ปรึกษา ai ไทย" เท่านั้น) | `รับทำ seo / n8n / เว็บไซต์ บริษัท` = 0 |
| แหล่งที่ AI cite | fastwork 174 · facebook 85 · makewebeasy 85 · youtube 77 · datawow 72 · anga 69 | AI ดึงจาก marketplace / social / วิดีโอ / เอเจนซีที่มี llms.txt + ตัวเลขเยอะ |
| Internal link เข้า `/services/seo/` | 4 บทความ, ไม่มีใน footer | หน้า pos 30 ได้ link equity น้อยสุดในหน้าเงินทั้งหมด |
| Internal link เข้า `/services/n8n-automation/` | 1 บทความ | เหมือนกัน |
| sameAs | LinkedIn/FB/IG/GitHub/LINE | **ไม่มี** GBP, YouTube, Clutch, GoodFirms, F6S ที่เพิ่งสร้าง |
| robots.txt | ไม่ประกาศ AI bot | default allow แต่ไม่มี signal |

**เพดานที่ต้องยอมรับ:** anga = 606 URL, 425 บทความ, 28 case, 72 หน้าทีม, รางวัล Google Premier Partner; makewebeasy = 1,262 บทความ, 150,000 เว็บ, 18 ปี. ชนะ head term `รับทำ seo` / `รับทำเว็บไซต์` ใน 90 วันไม่ได้. **ชนะได้:** long-tail + AI consulting + GEO/AI Search + Local SEO Bangkok + n8n + technical audit — และ AI citation ที่ต้องการ "ข้อเท็จจริง+ตัวเลข" มากกว่า authority

---

## 1. สิ่งที่ทั้ง 3 คู่แข่งทำเหมือนกัน (= มาตรฐานขั้นต่ำที่เรายังขาด)

| Pattern | Metier | anga | MWE | Hashbox ตอนนี้ |
|---|---|---|---|---|
| ชื่อบริการ = keyword เป๊ะ = URL เดียว | ✅ 7 | ✅ 30 | ✅ 19 | ❌ การ์ดชื่อแบรนด์ 3 ใบ |
| H1 = keyword + ผลลัพธ์ | "รับทำ SEO เว็บไซต์" | "รับทำ SEO ติดหน้าแรก Google ทุกคำค้นหาสำคัญของธุรกิจ" | "รับทำเว็บไซต์ สร้างเว็บไซต์สำหรับธุรกิจ รองรับ AI Search…" | "รับทำ SEO" / "ที่ปรึกษา AI" / "AI Consulting" — สั้นเกิน ไม่มี modifier |
| H2 หมุน keyword variant | ติดหน้าแรก / สายขาว / บริษัทรับทำ | 13 H2 มี "รับทำ SEO" 9 ครั้ง + ราคา + เฉพาะอุตสาหกรรม | ประสบการณ์ / process / ราคา / ผลงาน / FAQ | H2 เป็นประโยคขาย ไม่มี variant |
| ประโยคนิยาม "X คือ…" 2 บรรทัดแรก | ✅ | ✅ | ✅ (+ "MakeWebEasy คือ…") | ❌ |
| ราคาบนหน้า + FAQ "เริ่มต้นเท่าไหร่" | ❌ | ✅ /seo/ 39,000 | ✅ ทุกหน้า | ✅ seo/web/n8n — ❌ ai-consulting |
| เคสชื่อจริง + % + ระยะเวลา บนหน้าบริการ | ✅ 3 เคส | ✅ 28 เคส | ✅ 24 โลโก้ | ❌ ชื่อสมมติ |
| Trust strip ตัวเลข ซ้ำทุกหน้า | 200+ ลูกค้า/10 ปี | 400 เว็บ/84%/96% retention | 150,000 เว็บ/18 ปี/100 staff | ❌ ไม่มี (ห้ามปลอม — ใช้ตัวเลขจริงเล็ก ๆ) |
| "วิธีวัดผล" H2 ชื่อ KPI | AI Visibility / Mentions / Citations / SoV | 10 KPI + LLM Traffic | — | ❌ |
| Listicle "10 เอเจนซี่รับทำ SEO 2026" ใส่ตัวเองใน list | ✅ | ✅ | ✅ | ❌ |
| llms.txt | ❌ | ❌ | ✅ + llms-full.txt 4,500 คำ | ✅ แต่บาง + มี DM |
| Author จริง มีหน้า/credential | ❌ | ❌ (Marketing Team) | ❌ (username) | ✅ Tum — **จุดชนะ** |
| dateModified จริงบนหน้าบริการ | ❌ | ❌ | ❌ | ❌ → ทำแล้วชนะทุกคน |
| Schema Service+FAQ ต่อหน้าบริการ | ✅ hub | ✅ /seo/ (ไม่มีบนหน้าเว็บ) | ❌ หน้า design ไม่มี | ✅ — **จุดชนะ** |

---

## 2. รายการแก้ไข (เรียงตาม impact ÷ effort) — C = Claude ทำในโค้ด/WP · T = ต้องการจาก Tum

### A. โครงสร้าง + link equity (W1 — 1 วัน)
| # | แก้อะไร | ที่ไหน | ทำไม |
|---|---|---|---|
| A1 | หน้าแรก: 3 การ์ด → 5 แถว H3 = keyword + sub-bullet long-tail (ตาม ownership map §6.2) | front-page.php | ทั้ง 3 คู่แข่งทำ; เราซ่อน service หลังชื่อแบรนด์ |
| A2 | Nav "Services" → "บริการ" dropdown 5 รายการ | header.php | anchor keyword site-wide |
| A3 | **Footer เพิ่ม /services/seo/, /n8n-automation/, /ai-search/** | footer.php | seo ได้ link แค่ 4, n8n แค่ 1 — footer = +19 หน้าทันที |
| A4 | DM 301 → /services/seo/#cro + ลบ 13 ref | functions.php + 8 ไฟล์ | ยุบหน้าอ่อน |
| A5 | ItemList 3 → 5 + hasOfferCatalog 5 + llms.txt 5 จาก array กลาง `hashbox_service_catalog()` | functions.php, page-services.php | แก้ที่เดียวตรงทุกที่ |
| A6 | บทความ "X คือ" ทุกโพสต์ → CTA/anchor ไปหน้าบริการที่ถือ keyword | REST 19 posts | metier/MWE บทความไม่ลิงก์หน้าบริการ — เราทำแล้วชนะ |
| A7 | /seo-audit/, /seo-recovery-audit/ เข้า sitemap + title "รับทำ SEO Audit / Technical SEO Audit" | functions.php | มี impr อยู่แล้ว pos 31/49 |

### B. Template หน้าบริการ 4 หน้า (W1–W2) — ใช้ skeleton anga + MWE
ลำดับ section ใหม่ทุกหน้า: **H1 keyword+ผลลัพธ์ → ประโยคนิยาม "บริการ X ของ Hashbox คือ…" → trust strip (ตัวเลขจริง) → ครอบคลุมอะไร (H3 = sub-service keyword) → กระบวนการ 5–6 ขั้น → วิธีวัดผล (KPI ชื่อจริง) → ราคา (H2 มีตัวเลข) → เคส (ชื่อจริง+%) → FAQ 6–8 (มีคำถามฝังแบรนด์ "Hashbox วัดผล…ยังไง") → บริการที่เกี่ยวข้อง (tail เดียวกันทุกหน้า)**

| # | หน้า | H1 ใหม่ (ตัวอย่าง) | H2 variant เพิ่ม | อื่น ๆ |
|---|---|---|---|---|
| B1 | /services/seo/ | "รับทำ SEO สายเทคนิค ติดหน้าแรก Google และ AI Search วัดผลรายวัน" | บริษัทรับทำ SEO · รับทำ SEO สายขาว · Local SEO Bangkok · Technical SEO Audit · ราคารับทำ SEO · CRO (#cro) | เพิ่ม "วิธีวัดผล" 8 KPI; FAQ +3; ลิงก์ /seo-audit/ |
| B2 | /services/website-development/ | "รับทำเว็บไซต์ SEO-Ready ติด Google ตั้งแต่วันเปิด รองรับ AI Search" | รับทำเว็บไซต์ บริษัท · รับทำเว็บไซต์ ราคา · เว็บไซต์ SEO Ready · รับทำเว็บไซต์ WordPress (→ /wordpress/) · เว็บโหลดช้า | FAQ "ค่าใช้จ่ายเริ่มต้นเท่าไหร่ → 35,900" ใน FAQPage; PSI proof จริง |
| B3 | /services/ai-consulting/ | "ที่ปรึกษา AI สำหรับธุรกิจไทย วางระบบ AI Solution ถึง Production" | บริการให้คำปรึกษา AI · ผู้ให้บริการโซลูชัน AI · บริการ RAG · รับทำ AI Tool / Prototype · ปรึกษา AI Transformation (ลิงก์ post 170/220/224) | **เพิ่มราคาเริ่มต้น** (ตอนนี้ไม่มี — คู่แข่งมี); Offer schema |
| B4 | /services/n8n-automation/ | "รับทำ n8n Automation วางระบบ Workflow ให้ธุรกิจไทย จบเป็นโปรเจกต์" | รับวางระบบ n8n · n8n ราคา · n8n workflow · บริการ n8n | ลิงก์ post 196; embed วิดีโอเมื่อมี |
| B5 | /en/ai-consulting/ | "AI Consulting Bangkok — Production AI Systems for Thai Business" | AI consulting companies in Thailand (answer-first list) · AI consultant Bangkok · AI solutions Bangkok | AIO มี 25 แหล่ง ไม่มีเรา |
| B6 | ทุกหน้า | — | — | `dateModified` แสดงจริง + ใน schema; Audience schema; sameAs ครบ |

### C. หน้าใหม่ (W2–W5)
| # | หน้า | แบบจาก | หมายเหตุ |
|---|---|---|---|
| C1 | **/services/ai-search/** "รับทำ AI Search (GEO/AEO)" | anatomy metier + KPI anga: นิยาม → ทำไมต้องทำปี 2026 (ตัวเลข) → กระบวนการ 5 ขั้น → platform grid (AI Overview / AI Mode / Gemini / ChatGPT / Perplexity) → วัดผล (AI Visibility / Brand Mentions / Citations / SoV / LLM Traffic) → package ตัวเลข + ราคา → เคส (ใช้ dashboard Hashbox Signal จริงเป็น proof) → FAQ 8 → /geo-checker/ CTA | คู่แข่งไม่มีราคา, ไม่มีเคส, บทความไม่ลิงก์ → เราทำครบชนะ |
| C2 | Listicle TH "10 บริษัทรับทำ SEO ในไทย 2026 (เทียบราคา/แนวทาง)" ใส่ Hashbox อย่างซื่อสัตย์ + FAQ "SEO vs GEO vs AEO" | anga/MWE/metier ทำทั้ง 3 | ranking + AI citation สำหรับ prompt "แนะนำบริษัท…" |
| C3 | Listicle EN "AI consulting companies in Thailand 2026" (หรือ section ใน /en/ai-consulting/) | AIO 25 แหล่ง | prompt EN ที่เราหาย |
| C4 | โพสต์ synonym cluster ลิงก์เข้า C1: AEO คือ · AI Mode คือ · ASEO · query fan-out · llms.txt คือ · AI Share of Voice | anga 20 โพสต์ /ai/ | ทุก phrasing ของ prompt ต้องมีหน้า |
| C5 | "รับทำเว็บไซต์ ราคาเท่าไร 2026" คำนวณจริง + ตาราง | MWE มี 2 หน้าราคาขัดกัน | ตอบตรงกว่า |
| C6 | Case study ชื่อจริง 3 หน้า /work/ (ชื่อ + % + ระยะเวลา + screenshot GSC) | anga 28 | **T** permission |
| C7 | Industry landing (เช่น รับทำเว็บไซต์ คลินิก) — **เฉพาะที่มีเคสจริง** ไม่เกิน 2–3 หน้า | MWE ไม่มี | quality gate: ห้าม thin |

### D. ชั้น AI-citability (W1–W2, C ทำได้ทันที)
| # | แก้อะไร |
|---|---|
| D1 | **llms.txt เขียนใหม่ + llms-full.txt** (แบบ MWE): ประโยค entity "Hashbox Studio คือ…", ก่อตั้ง 2024, ผู้ก่อตั้ง, 5 บริการ + ราคา, กระบวนการ, KPI, FAQ ตอบครบ, เคส, ช่องทาง — ลบ DM |
| D2 | robots.txt ประกาศ `GPTBot / ClaudeBot / PerplexityBot / OAI-SearchBot / Google-Extended / Bingbot` Allow ชัด |
| D3 | Organization: `alternateName` ["Hashbox", "Hashbox Studio", "แฮชบ็อกซ์"], `foundingDate`, `founder` → Person Tum (sameAs LinkedIn/GitHub), `sameAs` + **GBP, YouTube, Clutch, GoodFirms, F6S**, `knowsAbout` |
| D4 | ประโยคนิยาม + ตัวเลข ใน 2 บรรทัดแรกทุกหน้าบริการ/บทความ; FAQ ฝังชื่อแบรนด์ (LLM จำ brand+claim คู่กัน) |
| D5 | Trust strip ตัวเลขจริงเดียวกันทุกหน้า (จำนวนโปรเจกต์, ปี, PSI เฉลี่ย, เวลาตอบ) — ห้ามต่างกันระหว่างหน้า (MWE พลาด 100k vs 150k) |
| D6 | Author box + credential + dateModified ทุกโพสต์ (คู่แข่งทั้ง 3 ไม่มี — จุดที่เราชนะขาดได้) |

### E. SERP feature ที่ครองอยู่ (ต้อง T — โค้ดรองรับได้)
| # | แก้อะไร | ใคร |
|---|---|---|
| E1 | GBP ครบ + โพสต์ + รีวิว 5 → ใส่ URL ใน sameAs + LocalBusiness ที่มีอยู่ | T (C ใส่ schema) |
| E2 | YouTube 2–4 คลิป (รับทำเว็บไซต์ SEO-Ready คืออะไร / AI Search คือ / n8n demo / LINE AI demo) → embed บนหน้าบริการ + `VideoObject` schema + transcript เป็นข้อความ | T ถ่าย, C script+embed+schema |
| E3 | Facebook page โพสต์บริการ/เคส 1/สัปดาห์ (AI cite facebook 85) | T, C ร่าง |

### F. CTR fix (W1, C)
| # | แก้อะไร |
|---|---|
| F1 | post 170 pos 4 / 0 click: title ใส่ปี+ราคา+ตัวเลข ("…งบ ระยะเวลา checklist 2026"), meta desc answer-first; ทดสอบ 2 สัปดาห์ |
| F2 | Rank Math title/desc ทุกหน้าเงิน: keyword หน้า + ตัวเลข + "AI Search" modifier (MWE pattern) |
| F3 | Mobile 20 impr 0 click: ตรวจ SERP snippet mobile + hero above-fold มี H1/ราคา/CTA ใน 1 จอ |

---

## 3. ลำดับทำ (ต่อจาก MASTER-PLAN — เพิ่ม/ย้ายรายการ)

| สัปดาห์ | ทำ | ใหม่จาก teardown |
|---|---|---|
| 1 | A1–A7, D1–D3, F1–F2, B1 (SEO page + #cro) | A3 footer, A6 CTA 19 โพสต์, D1 llms-full, D3 alternateName/founder, F1 |
| 2 | B2, B3, B4, B6 (template ทุกหน้า), D4–D6 | B3 ราคา AI, D6 author box |
| 2–3 | C1 /services/ai-search/ + C4 โพสต์แรก 2 ชิ้น | KPI section, platform grid, Signal dashboard เป็น proof |
| 3–4 | C2 listicle TH, C3 EN, B5 | ใหม่ทั้งหมด |
| 4+ | C5, C6 (รอ T), C7 (ถ้ามีเคส), E1–E3 embed เมื่อมีของ | — |

**ที่ต้องมาจาก Tum ก่อน:** ตัวเลขจริงสำหรับ trust strip (จำนวนโปรเจกต์/ปี/PSI เฉลี่ย) · ราคาเริ่มต้น AI consulting + AI Search · permission 3 เคส · GBP URL · ช่อง YouTube (สร้างแล้วส่ง URL ก็พอ ใส่ sameAs ได้เลย)

## 4. ตัวเลขคาดหวัง (90 วัน)
- keyword ติด top-20: 8 → 20+/56 (เพิ่มจาก long-tail รอบ AI consulting, GEO, local seo, audit, n8n)
- AI เอ่ยถึง: 6 → 10+/20 prompt (จาก llms-full + entity + listicle + ai-search page)
- click non-brand: ~1 → 40+/เดือน (CTR fix post 170 อย่างเดียวก็ควรได้ 10–20/เดือนที่ pos 4)
- head term `รับทำ seo` / `รับทำเว็บไซต์`: เข้า top-30 ได้ ถ้าไม่มี GBP+backlink จะไม่ถึง top-10 — ไม่สัญญา
