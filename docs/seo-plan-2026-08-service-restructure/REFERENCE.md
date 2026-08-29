# REFERENCE — ข้อมูลอ้างอิงประกอบ PLAN.md

รวมจาก SEO-STRATEGY / SITE-STRUCTURE / COMPETITOR-ANALYSIS / WEBSITE-CHANGES (2026-08-28). ประวัติเต็มใน git.

---

# §1 Keyword ownership + live data (จาก SEO-STRATEGY §6–7)

## 6. Live data จาก Hashbox SEO stack (28 ส.ค. 2026) — สิ่งที่เปลี่ยนแผน

### 6.1 อันดับปัจจุบัน (top-20 = 8/56 keyword)
| Keyword | Pos | หน้าที่ติด | หมายเหตุ |
|---|---:|---|---|
| ปรึกษาทำระบบ ai solution | **3** | `/ai-solution-consulting-guide-2026/` (post 170) | ใหม่ — **บทความ**ถือ keyword ไม่ใช่ service page |
| ปรึกษาทำระบบ ai solution สำหรับธุรกิจ | **3** | post 170 | ใหม่ |
| บริการให้คำปรึกษา ai solution | 9 | post 170 | ใหม่ |
| hashbox | 5 (−3) | `/` | brand ยังไม่ #1 (Hashbox Monster ชนชื่อ) |
| ที่ปรึกษา ai ไทย | 14 (+5) | `/services/ai-consulting/` | service page |
| ai consulting bangkok / companies bangkok / consultant bangkok / companies thailand | 14–23 | `/en/ai-consulting/` | EN cannibalization แก้แล้ว — ไป /en/ หมด |
| n8n คือ | 46 | `/n8n-thai-guide-2026/` | ใหม่ |
| **รับทำเว็บไซต์ (ทุก variant), รับทำ seo, รับทำ n8n, geo คือ, ai overview, technical seo…** | — | ไม่ติด top 20 | ดู 6.3 |

### 6.2 Keyword ownership map (กติกา: 1 keyword = 1 หน้า — anchor บนหน้าแรก/nav ต้องชี้ตามนี้)
| Keyword | หน้าเจ้าของ | anchor ที่ใช้บนหน้าแรก/nav |
|---|---|---|
| ปรึกษาทำระบบ ai solution (สำหรับธุรกิจ) | **post 170** (pos 3 — อย่าย้าย) | bullet ในแถว AI: "ปรึกษาทำระบบ AI Solution → คู่มือ" ชี้ post 170 |
| ที่ปรึกษา ai (ไทย/สำหรับธุรกิจ), บริการให้คำปรึกษา ai | `/services/ai-consulting/` | **แถว 2 ของ service list = "ที่ปรึกษา AI สำหรับธุรกิจ — วางระบบ AI Solution ถึง production"** ชี้ service page (ไม่ใช้วลี "ปรึกษาทำระบบ ai solution" เป็น anchor ไปหน้า service เพื่อไม่แย่ง post 170) |
| ai consulting bangkok/thailand (EN) | `/en/ai-consulting/` | nav/footer EN link |
| รับทำเว็บไซต์ + variants | `/services/website-development/` | แถว 1 "รับทำเว็บไซต์ SEO-Ready" |
| รับทำเว็บไซต์ wordpress | `/services/website-development/wordpress/` | bullet |
| รับทำ seo (+สายขาว) | `/services/seo/` | แถว 3 "รับทำ SEO" |
| geo คือ / geo seo | post 66 | bullet ในแถว AI Search → post 66 |
| รับทำ ai search / ai seo / geo agency | `/services/ai-search/` (ใหม่) | แถว 4 |
| รับทำ n8n / รับวางระบบ n8n | `/services/n8n-automation/` | แถว 5 |
| n8n คือ / n8n ราคา | post 196 | bullet |
| รับทำ ai tool / prototype | post 224 | bullet ในแถว AI |
| ปรึกษา ai transformation | post 220 | bullet ในแถว AI |

> ผลของ restructure ต่อ post 170: **บวก** — หน้าแรก/nav ส่ง link เข้า post 170 ด้วย anchor ตรง keyword จากทุกหน้า (ตอนนี้ post 170 ได้ link จากหน้าแรกเฉพาะตอนอยู่ใน "บทความล่าสุด"). ห้ามใส่ H2/anchor "ปรึกษาทำระบบ ai solution" บนหน้า service เพิ่มอีก (ตอนนี้มี H2 "บริการปรึกษาและทำระบบ AI Solution" 1 จุด — พอ).

### 6.3 ทำไม "รับทำเว็บไซต์*" ยังไม่ติด แม้ service page ทำครบ
- ผู้ครอง SERP/AI Overview ของกลุ่มนี้: **google.com (Local Pack/แผนที่) 100%, YouTube (วิดีโอ), fastwork.co, makewebeasy** → เป็น query ที่ Google ตอบด้วย **local + marketplace + วิดีโอ** ไม่ใช่หน้า service ของเอเจนซีเดี่ยว
- นัย: restructure ช่วย on-page แต่ **ไม่พอ** — ต้อง (1) GBP ครบ + รีวิว (Local Pack), (2) วิดีโอ YouTube สั้น "รับทำเว็บไซต์ SEO-Ready คืออะไร" (3) backlink/citation. ใส่ใน Roadmap Phase 3 แล้ว
- ตั้งความคาดหวัง: `รับทำเว็บไซต์` head term = 12 เดือน; long-tail (`รับทำเว็บไซต์ seo`, `เว็บไซต์ seo ready`, `รับทำเว็บไซต์ บริษัท`) = 3–6 เดือน หลังมี 5–10 referring domains

### 6.4 AI Search visibility ตอนนี้
- AI Overview ที่เราปรากฏ: **11/51 keyword** (+4 ใน 7 วัน) — ดีขึ้น
- AI (ChatGPT/Claude/Gemini/Perplexity) เอ่ยถึงเรา: **6/20 prompt** — เฉพาะ brand + "ที่ปรึกษา ai ไทย"; `รับทำ seo`, `รับทำ n8n`, `รับทำเว็บไซต์ บริษัท` = 0
- แหล่งที่ AI cite มากสุด: fastwork.co (174), facebook (85), makewebeasy (85), youtube (77), datawow.io (72), anga.co.th (69) → **AI ดึงจาก marketplace/social/วิดีโอ/เอเจนซีใหญ่** — เราต้องอยู่ในแหล่งพวกนั้น: Facebook page เนื้อหาบริการ, YouTube, profile บน fastwork? (พิจารณา), Clutch/GoodFirms (ทำแล้ว)
- "ai consulting companies thailand / ai solutions bangkok / ai solution provider" → AI Overview มี 14–25 แหล่ง ไม่มีเรา → หน้า `/en/ai-consulting/` ต้องมี answer-first list "AI consulting companies in Thailand" + ถูก cite จาก directory
- หน้า `/services/ai-search/` จะเพิ่ม prompt coverage กลุ่ม "รับทำ ai search / geo" ที่ตอนนี้ 0

### 6.5 สรุปผลกระทบสุทธิ (อัปเดต)
- Restructure = **บวก**ต่อ keyword ที่ติดแล้ว (ส่ง link เข้า post 170 / service pages มากขึ้น, ไม่มีการย้าย keyword ออกจากหน้าที่ติด)
- ศูนย์ต่อ keyword ที่ยังไม่ติด (ต้องการ authority)
- บวกต่อ AI search ผ่าน entity/schema/llms.txt แต่ตัวเลข "AI เอ่ยถึง" จะขยับจริงเมื่อมี citation ภายนอก (Phase 3)

---

## 7. GSC export 28 ส.ค. 2026 (Last 24 hours — 127 impr / 1 click / desktop 88 : mobile 20)

> Sample 24 ชม. เล็ก — ใช้เป็น signal ไม่ใช่ baseline. ขอ export 28 วัน + 3 เดือนเพื่อเทียบ. แต่ pace 127 impr/วัน ≈ 3,800/เดือน = **4× ของ baseline ก.ค.–ส.ค. (950/เดือน)** → impressions กำลังขึ้นชัด clicks ยังไม่ตาม (CTR ต่ำเพราะ pos 10–30)

### 7.1 Query ที่ tool ยังไม่ track แต่ GSC โชว์ (เพิ่มเข้า tracker)
| Query | Impr (24h) | Pos | หน้า | Action |
|---|---:|---:|---|---|
| **local seo bangkok** | 27 (มากสุดของวัน) | 13.4 | post 92 (Thai guide) | query EN → หน้าไทย. เพิ่ม EN answer-first block + H2 "Local SEO Bangkok services" ใน post 92; ใส่ "Local SEO" เป็น sub-service ใน `/services/seo/` + bullet บนหน้าแรก; พิจารณา section EN บน `/en/ai-consulting/` หรือหน้า `/en/local-seo-bangkok/` ภายหลังถ้า impr ยืน |
| local seo bkk | 3 | 30 | post 92 | รวมกับข้างบน |
| **รับทำ seo technical audit** / รับทำ seo audit | 4 + 1 | 31 / 49 | `/services/seo/` | intent "audit" — `/seo-audit/` LP index ได้แต่**ไม่อยู่ใน sitemap** และ title "SEO Audit ฟรีสำหรับเว็บใหม่" ไม่มีคำ "รับทำ/technical" → ใส่ใน sitemap + title "รับทำ SEO Audit / Technical SEO Audit ฟรี" + ลิงก์จาก `/services/seo/` H2 "อะไรอยู่ใน SEO Audit ฟรี" |
| ai optimization services bangkok | 2 | 80 | — | รองรับด้วย `/services/ai-search/` (EN section) |
| techonseo | 2 | 27 | — | brand คู่แข่ง — ไม่ทำ |
| บริการ rag | 1 | 21 | post 129 | ok |

### 7.2 ยืนยัน ownership map (§6.2)
- `ปรึกษาทำระบบ ai solution สำหรับธุรกิจ` 11 impr pos 14 (avg) / `บริการให้คำปรึกษา ai solution` 8 impr pos 19 → **post 170** (หน้า impr 23, pos 4.2) — ตรงกับ tool (#3 ณ จุดเช็ค)
- `ai consulting bangkok` / `companies bangkok` pos 10 → `/en/ai-consulting/` (17 impr, pos 25 avg) — EN ไป /en/ ทั้งหมด ไม่มี cannibalization กับ `/services/ai-consulting/` (14 impr, ไทย)
- click เดียวของวัน: `/services/website-development/` pos 3 (query ซ่อน) — หน้า service เว็บติดหน้า 1 ได้เมื่อ query long-tail

### 7.3 สิ่งที่เพิ่มเข้า Roadmap Phase 1–2
1. `/seo-audit/` + `/seo-recovery-audit/` → เข้า sitemap, title/H1 ใส่ "รับทำ SEO Audit / Technical SEO Audit", ลิงก์จาก `/services/seo/`
2. post 92: EN answer-first + Local SEO service CTA; `/services/seo/` เพิ่ม "Local SEO Bangkok" ใน scope list; หน้าแรกแถว SEO bullet "Local SEO"
3. Tracker: เพิ่ม `local seo bangkok`, `local seo bkk`, `รับทำ seo audit`, `รับทำ seo technical audit`, `ai optimization services bangkok`
4. Desktop 81% ของ impr → B2B เวลางาน; mobile LCP ยังต้องดูแต่ไม่ใช่ตัวกด CTR หลัก — CTR ต่ำเพราะตำแหน่ง ไม่ใช่ device

---

# §2 โครงสร้างเป้าหมาย (จาก SITE-STRUCTURE)

# Site Structure — หลัง restructure

```
/                                   H1: รับทำเว็บไซต์ SEO-Ready พร้อม Marketing + AI ไว้ในทีมเดียว
├── /services/                      hub · ItemList(Service ×5) + BreadcrumbList
│   ├── /services/website-development/          รับทำเว็บไซต์ SEO-Ready (H1 คงเดิม)      ← "รับทำเว็บไซต์", "ออกแบบเว็บไซต์ธุรกิจ"
│   │   └── /services/website-development/wordpress/   รับทำเว็บไซต์ WordPress
│   ├── /services/ai-consulting/                ที่ปรึกษา AI สำหรับธุรกิจไทย              ← "ปรึกษาทำระบบ ai solution", "ที่ปรึกษา ai"
│   │   (EN twin) /en/ai-consulting/            ← "ai consulting bangkok" (hreflang pair)
│   ├── /services/seo/                          รับทำ SEO Technical-first                ← "รับทำ seo", "บริษัทรับทำ seo"
│   │   └── #cro  (ย้ายจาก DM: GA4/GSC/Heatmap/A-B/CRO Sprint)
│   ├── /services/ai-search/  ★ใหม่             รับทำ AI Search (GEO)                    ← "รับทำ ai search", "ai seo", "geo agency", "บริการ geo"
│   └── /services/n8n-automation/               รับทำ n8n Automation                     ← "รับทำ n8n", "workflow automation"
│   ✂ /services/digital-marketing-tools/  →  301 → /services/seo/#cro
├── /work/  + 6 case studies (→ ชื่อจริง 3 เคสแรก)
├── /about/  (+ Person schema Tum Thaweewat — มีแล้ว)
├── /blog/  18 โพสต์ — hub-and-spoke:
│     AI Consulting hub ← 170, 220, 224, 69, 129, 196, 68
│     GEO hub (post 66) ← 208 + spoke อื่น  → ลิงก์ขึ้น /services/ai-search/
│     SEO hub (post 210) ← 17, 81, 80, 89, 91, 92 → ลิงก์ขึ้น /services/seo/
├── /website-audit/  (lead LP, page 136) · /ai-workflow-audit/ · /seo-audit/ ฯลฯ (noindex? ตรวจ)
└── /#contact  (คง id)
```

## Nav (desktop dropdown + mobile sheet — ต้องเป็น `<a href>` จริงใน DOM)
1. รับทำเว็บไซต์ SEO-Ready → /services/website-development/
2. ปรึกษาทำระบบ AI Solution → /services/ai-consulting/
3. รับทำ SEO → /services/seo/
4. รับทำ AI Search (GEO) → /services/ai-search/
5. Workflow Automation (n8n) → /services/n8n-automation/
+ ผลงาน / บทความ / เกี่ยวกับเรา / รับ Audit ฟรี

## หน้าแรก — section "บริการของเรา" (แทนการ์ด 3 ใบ)
| # | H3 / anchor | sub-service bullets (long-tail) |
|---|---|---|
| 1 | รับทำเว็บไซต์ SEO-Ready | WordPress · Headless Next.js · E-commerce · Landing Page · Website Audit ฟรี |
| 2 | ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ | LINE Chatbot AI · RAG / Knowledge Base · Sales GPT · AI Tool / Prototype · AI Transformation |
| 3 | รับทำ SEO | Technical SEO · Content · Local SEO · SEO Recovery · Tracking + CRO |
| 4 | รับทำ AI Search (GEO) | AI Overview · ChatGPT · Perplexity · Gemini · llms.txt · Citation tracking |
| 5 | รับทำ Workflow Automation (n8n) | n8n · LINE OA · CRM sync · Sheets/Notion |

## Schema ต่อหน้า
| หน้า | Schema |
|---|---|
| Home | Organization (+hasOfferCatalog 5 Service), ProfessionalService/LocalBusiness, WebSite, FAQPage, WebPage |
| /services/ | ItemList → ListItem → Service {name, url, description, provider @id, offers{priceSpecification}} + BreadcrumbList |
| Service page | Service (+Offer), FAQPage, BreadcrumbList, Speakable |
| Case study | Article + BreadcrumbList (มีแล้ว) |
| Blog | BlogPosting + FAQPage (Rank Math) |

## URL rules
- ไม่สร้างหน้าใหม่ที่ซ้ำ keyword หน้าเดิม (เช่น "รับทำเว็บไซต์" หน้าที่ 2)
- slug ใหม่ = `/services/ai-search/` (EN slug, ตรงกับ Metier pattern, สั้น) — Title/H1 ภาษาไทย
- ทุก 301 ทำใน theme (`template_redirect`) ไม่ใช้ plugin

---

# §3 ข้อมูลก่อนแก้ + เทียบคู่แข่ง (จาก WEBSITE-CHANGES §0–1)


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


# §4 Catalogue งาน A–F (จาก WEBSITE-CHANGES §2 — ใช้อ้าง ref ใน PLAN)

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

---

# §5 Metier — สิ่งที่ลอก/ไม่ลอก (จาก COMPETITOR-ANALYSIS)

# Competitor — metierthailand.com (28 ส.ค. 2026)

| มิติ | Metier | Hashbox | ใครนำ |
|---|---|---|---|
| ขนาด | 33 URL (7 service, 18 blog, 2 project) | 19 page + 18 post | ≈ |
| หน้าแรก | 452 คำ; H2 "บริการของเรา" + **H3 keyword ตรง 7 รายการ** + sub-service bullets 5–8/รายการ | H1 keyword ดี แต่ service ใช้ชื่อแบรนด์ ("SEO-Ready Website / AI Expert Consulting") | **Metier** (การตั้งชื่อ) |
| Hub /service | 70 คำ, Service + ItemList schema | 800+ คำ, ไม่มี ItemList | Metier (schema) / Hashbox (เนื้อหา) |
| Service page ลึก | 690–810 คำ, H2 วน keyword variant, FAQ, เคสชื่อจริง (Siriraj Bumrungvej, TTC Motor) | 1,000–1,540 คำ, FAQPage schema 6–12, Breadcrumb, ราคา, เคส**ชื่อสมมติ** | Hashbox (ลึก) / Metier (trust) |
| AI Search service | มี `/service/ai-search` (AI Overview/AI Mode/Gemini/ChatGPT/Perplexity + วัดผล 4 metric + FAQ) | **ไม่มีหน้าขาย** — มีแต่บทความ GEO (post 66, 208) | **Metier** |
| Anchor text ภายใน | "More Details" (อ่อน) | "ดูบริการเว็บไซต์ →" (อ่อน) | เสมอ (แพ้ทั้งคู่) |
| Schema หน้าแรก | WebSite + ContactPoint | Organization/Service/Offer/FAQ/WebPage | Hashbox |
| Technical | robots `Crawl-delay: 10`, no sitemap index | CWV 93/100, self-host fonts, llms.txt | Hashbox |
| E-E-A-T | เคสจริง, ใบรับรอง section, ทีม | Person schema founder, เคสสมมติ | Metier |
| Blog | 18 โพสต์ (ไม่เห็นใน sitemap TH = อาจ index น้อย) | 18 โพสต์ index ครบ, FAQ block | Hashbox |

## สิ่งที่ควรลอก
1. H3 = keyword ตรงบนหน้าแรก + sub-service bullets
2. ItemList/Service schema ที่ hub
3. หน้าขาย AI Search แยกจากบทความ GEO
4. เคสชื่อจริง + logo ลูกค้า

## สิ่งที่ไม่ควรลอก
- Anchor "More Details"
- Hub 70 คำ (ของเราลึกกว่า เก็บไว้)
- Crawl-delay

## Gap ที่เราได้เปรียบและควรกด
- เนื้อหา GEO/Technical SEO ลึกกว่า (post 66/208/17/81) → ใช้เป็น spoke ป้อนหน้า `/services/ai-search/` และ `/services/seo/`
- CWV + schema ครบ = หลักฐาน "SEO-Ready" ของจริง (PSI report บนหน้าแรก)
- AI consulting cluster ~480 impr ที่ Metier ไม่มีบริการนี้เลย

---

# §6 GSC baseline 28 วัน (30 ก.ค. – 26 ส.ค. 2026, อ่าน 29 ส.ค. 14:20)

**รวม: clicks 26 · impressions 2,070 · CTR 1.3% · avg position 30.4** (60 query; brand 'hashbox' = 1 click เดียวที่มี CTR)

อ่านค่า: ทุก non-brand query = 0 click ทั้งเดือน → ปัญหาคือ CTR/อันดับ ไม่ใช่ impressions (2k/เดือน มีแล้ว) · คลัสเตอร์ AI consulting กิน 70% ของ impressions · `ปรึกษาทำระบบ ai solution สำหรับธุรกิจ` 291 impr แต่ pos เฉลี่ย 29 (ไม่ใช่ 3 — อันดับ 3 คือวันที่ดีที่สุด) · EN cluster pos 10–13

| query | clicks | impr | CTR | pos |
|---|---|---|---|---|
| hashbox | 1 | 17 | 5.9% | 3.3 |
| ปรึกษาทำระบบ ai solution สำหรับธุรกิจ | 0 | 291 | 0% | 29.4 |
| บริการให้คำปรึกษา ai solution | 0 | 254 | 0% | 35.3 |
| ai consultant bangkok | 0 | 101 | 0% | 13.4 |
| ai consulting bangkok | 0 | 95 | 0% | 9.8 |
| ที่ปรึกษา ai สำหรับธุรกิจ | 0 | 93 | 0% | 27.2 |
| ai consulting companies bangkok | 0 | 86 | 0% | 13.0 |
| ปรึกษาทำระบบ ai solution | 0 | 85 | 0% | 25.7 |
| ai services bangkok | 0 | 61 | 0% | 41.6 |
| technical seo | 0 | 53 | 0% | 60.7 |
| ai consulting companies thailand | 0 | 52 | 0% | 44.5 |
| ai solutions bangkok | 0 | 49 | 0% | 54.9 |
| techonseo | 0 | 35 | 0% | 23.6 |
| technical seo คือ | 0 | 35 | 0% | 38.6 |
| บริการ rag | 0 | 31 | 0% | 27.4 |
| รับทำ ai tool | 0 | 31 | 0% | 44.5 |
| ปรึกษา ai transformation | 0 | 29 | 0% | 63.7 |
| ai consultant | 0 | 28 | 0% | 76.4 |
| local seo bangkok | 0 | 26 | 0% | 49.3 |
| ที่ปรึกษา erp dynamics d365 ai consultant | 0 | 26 | 0% | 63.2 |
| รับทำ seo technical audit | 0 | 14 | 0% | 36.5 |
| technical seo thailand | 0 | 13 | 0% | 56.8 |
| ที่ปรึกษา ai ไทย | 0 | 12 | 0% | 15.2 |
| local seo bkk | 0 | 12 | 0% | 41.0 |
| ai consulting company | 0 | 12 | 0% | 55.4 |
| ai consulting thailand | 0 | 10 | 0% | 4.3 |
| ให้คำปรึกษา ai | 0 | 10 | 0% | 45.9 |
| ai consult | 0 | 7 | 0% | 47.1 |
| ai optimization services bangkok | 0 | 7 | 0% | 79.7 |
| ai knowledge base thailand | 0 | 5 | 0% | 21.6 |
| brand case | 0 | 4 | 0% | 9.2 |
| รับทำ technical seo | 0 | 4 | 0% | 27.2 |
| ai consulting | 0 | 4 | 0% | 30.0 |
| google business profile consultant bangkok | 0 | 4 | 0% | 37.5 |
| n8n คือ | 0 | 4 | 0% | 40.2 |
| รับทำ seo audit | 0 | 4 | 0% | 53.8 |
| รับทำ custom website | 0 | 4 | 0% | 63.2 |
| ai knowledge base ไทย | 0 | 2 | 0% | 18.0 |
| javascript seo คือ | 0 | 2 | 0% | 52.0 |
| schema markup ธุรกิจไทย | 0 | 2 | 0% | 88.5 |
| รับทำ ai | 0 | 1 | 0% | 37.0 |
| รับทำเว็บไซต์ wordpress cms | 0 | 1 | 0% | 47.0 |
