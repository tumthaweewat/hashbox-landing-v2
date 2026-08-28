# SEO Strategy — Service Restructure (28 ส.ค. 2026)

> คำถามหลัก: การยุบ Digital Marketing + CRO, เปลี่ยนหน้าแรกเป็น service list 5 รายการ, nav dropdown, ItemList schema และเพิ่มหน้า /services/ai-search/ — **กระทบ keyword และ AI search แค่ไหน หรือดีขึ้น?**
>
> คำตอบสั้น: **ดีขึ้นสุทธิ** ทุกด้าน — ถ้าทำตามกฎ 5 ข้อใน §4. ความเสี่ยงเดียวที่ "ลบ" คือการยุบหน้า DM ซึ่ง GSC ยืนยันว่าหน้านั้นไม่ rank query ใดเลย → ความเสี่ยง ≈ 0.

## 1. Baseline (ข้อมูลจริง)

| ข้อมูล | ค่า | แหล่ง |
|---|---|---|
| GSC 8 ก.ค.–5 ส.ค. 2026 | 0 clicks / ~950 impressions | OpenSEO baseline |
| External backlinks | 0 referring domains (GSC Links) | audit มิ.ย. 2026 |
| Best cluster | "ai consulting bangkok" pos ~19–23 บน `/services/ai-consulting/` | OpenSEO |
| ปัญหาหลัก | ranking ceiling จาก off-page (backlink 0) ไม่ใช่ on-page | audit มิ.ย. |
| Query non-brand ใหญ่สุด | "geo คือ" 156 impr (pos 77), cluster GEO รวม ~241 impr | keyword-research.md |
| Cluster commercial ใหญ่สุด | AI Consulting ~480 impr (EN 250 + TH 230) | keyword-research.md |
| `ปรึกษาทำระบบ ai solution สำหรับธุรกิจ` | 42 impr pos 77 (+ 26 impr variant) | keyword-research.md |
| `รับทำเว็บไซต์` | ยังไม่ปรากฏใน GSC top queries — หน้า `/services/website-development/` ถือ H1 อยู่ | — |
| CWV | mobile 93 / desktop 100 | PSI 7 ส.ค. |
| หน้า DM (`/services/digital-marketing-tools/`) | 371 คำ, **ไม่ rank query ใด**, inbound 9 จุดใน theme + post 70 | ตรวจ 28 ส.ค. |

## 2. ผลกระทบรายการเปลี่ยนแปลง

### 2.1 ยุบ `/services/digital-marketing-tools/` → 301 `/services/seo/#cro`
| มิติ | ผล | เหตุผล |
|---|---|---|
| Keyword ranking | **0** | หน้าไม่ rank อะไร; ไม่มี query "CRO" ใน GSC |
| Link equity | +เล็กน้อยให้ `/services/seo/` | 301 ส่ง equity เกือบเต็ม; inbound 9 จุดจะถูกชี้ตรงไป SEO page |
| Crawl budget / index | +เล็กน้อย | หน้าบางถูกตัด, sitemap สั้นลง |
| AI search | **+** | AI ชอบ entity ชัด: "Hashbox = เว็บ + SEO + AI" ดีกว่า 4 บริการเบลอ ๆ; ต้องอัปเดต `llms.txt` (ตอนนี้ยังลิสต์ DM + ลิงก์ CRO guide slug ผิด `cro-thai-websites-2026`) |
| ความเสี่ยง | post 70 (บทความ CRO) ลิงก์ `/digital-marketing-tools/` → แก้เป็น `/services/seo/#cro`; `hasOfferCatalog` + ItemList ใน `/services/` + form option ต้องลบรายการ | ทำในชุดเดียวกัน |

### 2.2 หน้าแรก: การ์ด 3 ใบ → service list 5 แถว, anchor = keyword
| มิติ | ผล |
|---|---|
| Internal anchor text | **+++** — ปัจจุบัน "ดูบริการเว็บไซต์ →" ไม่มี keyword; ใหม่ = "รับทำเว็บไซต์ SEO-Ready", "ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ", "รับทำ SEO", "รับทำ AI Search" — anchor จากหน้า authority สูงสุดของโดเมน |
| Topical coverage บนหน้าแรก | **++** — H3 ตรง query + sub-service bullets = long-tail (LINE Chatbot AI, RAG, Headless Next.js, Local SEO, AI Overview) ที่ตอนนี้ไม่มีบนหน้าแรกเลย |
| หน้าที่เคยไม่มีลิงก์จากหน้าแรก | `/services/seo/`, `/services/n8n-automation/`, `/services/website-development/wordpress/` ได้ลิงก์จากหน้าแรกครั้งแรก |
| H1 | คง "รับทำเว็บไซต์ SEO-Ready…" — **ห้ามเปลี่ยน keyword ต้น H1** |
| ความเสี่ยง | ถ้าตัด section ที่มีลิงก์ (services / portfolio / insights) ต้องย้ายลิงก์ไป list ใหม่ — ดู §4 |

### 2.3 Nav dropdown "บริการ" 5 รายการ
| มิติ | ผล |
|---|---|
| Site-wide internal links | **++** — ทุกหน้า (รวม blog 18 โพสต์) ลิงก์ไป 5 service pages ด้วย anchor keyword → PageRank ไหลเข้าหน้าเงินจากทุกโพสต์ |
| Sitelinks ใน SERP brand | + — Google ใช้ nav ในการเลือก sitelinks |
| ความเสี่ยง | mobile sheet ต้องมีลิสต์เดียวกัน; อย่าใช้ JS-only menu ที่ไม่มี `<a href>` ใน DOM |

### 2.4 ItemList + Service schema บน `/services/`
| มิติ | ผล |
|---|---|
| Rich result | ไม่มี rich result โดยตรงสำหรับ ItemList ของ Service | — |
| Entity graph / AI | **++** — Metier ทำแล้ว; ให้ AI/Knowledge graph เข้าใจว่า Hashbox มี 5 Service ชื่ออะไร URL ไหน ราคาเท่าไร (`Offer` + `priceSpecification`) |
| ความเสี่ยง | ต้อง sync กับ `hasOfferCatalog` ใน Organization (P6 เพิ่งรวม builder เป็น single source แล้ว — ใช้ array เดียวกันสร้างทั้งสอง) |

### 2.5 หน้าใหม่ `/services/ai-search/` (รับทำ AI Search / GEO)
| มิติ | ผล |
|---|---|
| Keyword | **+++** — cluster GEO ~241 impr เป็น **informational** ทั้งหมด (geo คือ / geo seo) ไปลง blog post 66 (pos 65–77) — ไม่มีหน้า commercial รับ "รับทำ ai search", "geo agency", "ai seo", "บริการ geo" เลย |
| Cannibalization | **ระวัง** — ต้องแยก intent ชัด: post 66 = "GEO คืออะไร" (info), หน้าใหม่ = "รับทำ AI Search" (commercial). H1/Title ห้ามซ้ำคำ "GEO คืออะไร"; post 66 ลิงก์ไปหน้าใหม่ด้วย anchor "บริการรับทำ AI Search" |
| AI search visibility | **+++** — เป็นหน้าที่ตอบ "ใครรับทำ AI Search ในไทย" ตรง ๆ; ใส่ answer-first + FAQ + pricing + methodology ให้ AI cite ได้ |
| คู่แข่ง | Metier มี `/service/ai-search` แล้ว (810 คำ, FAQ) — เราต้องลึกกว่า: มี measurement จริง (post 208 Google AI Overview Thailand), เคส, เครื่องมือ GEO checker (มี template `page-geo-checker.php` แต่ยังไม่ publish) |

### 2.6 ผลรวมต่อ AI Search (AI Overviews / ChatGPT / Perplexity)
- AI ดึงจาก: entity ชัด + หน้า service ที่ตอบคำถามตรง + llms.txt + schema + citation จากที่อื่น
- โครงใหม่ทำให้ 3 อย่างแรก**ดีขึ้น**; อย่างที่ 4 (citation/backlink) ยังเป็นเพดาน — โครงสร้างไม่แก้เรื่องนี้ ต้องทำ outreach ต่อ (ดู IMPLEMENTATION-ROADMAP Phase 3)
- ข้อควรระวัง: robots.txt ไม่ได้ block AI bots (ดี) แต่ก็ไม่ได้ประกาศ policy; พิจารณาเพิ่ม `User-agent: GPTBot/PerplexityBot/ClaudeBot Allow: /` ชัด ๆ + `Content-Signal` ถ้าต้องการ

## 3. คะแนนสุทธิ

| การเปลี่ยนแปลง | Keyword | AI Search | Risk | Verdict |
|---|:-:|:-:|:-:|---|
| ยุบ DM → SEO#cro | 0 | + | ต่ำ (ถ้า 301 + แก้ 10 จุด) | ทำ |
| Home service list (anchor keyword) | ++ | ++ | ต่ำ | ทำ |
| Nav dropdown | ++ | + | ต่ำ | ทำ |
| ItemList/Service schema | + | ++ | ต่ำ | ทำ |
| หน้า `/services/ai-search/` | +++ | +++ | กลาง (cannibal กับ post 66 ถ้า intent ซ้ำ) | ทำ — แยก intent |
| เคสลูกค้าชื่อจริง (จาก design review) | + | ++ | ต้อง permission | ทำเมื่อได้รูป/permission |

## 4. กฎ 5 ข้อระหว่าง implement
1. **H1 หน้าแรกคงคำ "รับทำเว็บไซต์ … SEO"** — sync Rank Math title/OG
2. ทุกลิงก์ไปหน้าเงินที่เคยอยู่บนหน้าแรก (3 service + `/work/` + `/blog/` + `#contact`) ต้องยังอยู่ — ย้ายได้ ลบไม่ได้
3. 301 แบบ `template_redirect` (pattern เดิม `hashbox_redirect_legacy_*`) + ถอดจาก sitemap + แก้ inbound 10 จุด + llms.txt + form option ในคอมมิตเดียว
4. FAQ visible = FAQPage schema เสมอ (source array เดียว); `#contact` id คงไว้ (30 inbound)
5. หน้าใหม่ AI Search: Title/H1 ใช้ "รับทำ AI Search" ไม่ใช่ "GEO คืออะไร"; post 66 → ลิงก์ขึ้นหน้าใหม่

## 5. KPI

| Metric | Baseline (ส.ค.) | 3 เดือน | 6 เดือน | 12 เดือน |
|---|---|---|---|---|
| Non-brand clicks/เดือน | 0 | 10–20 | 40–80 | 150+ |
| Impressions/เดือน | ~950 | 2,000 | 5,000 | 12,000 |
| `ปรึกษาทำระบบ ai solution สำหรับธุรกิจ` | pos 77 | ≤40 | ≤20 | top 10 |
| `รับทำ ai search` / `geo agency` | ไม่มี | index + pos ≤50 | ≤20 | top 10 |
| `ai consulting bangkok` | ~20 | ≤15 | ≤10 | top 5 |
| Referring domains | 0 | 5 | 15 | 30 |
| AI citations (Perplexity/ChatGPT brand mention ต่อ 20 prompt ทดสอบ) | 0–1 | 3 | 6 | 10 |
| CWV mobile | 93 | ≥90 (หลังใส่รูปจริง) | ≥90 | ≥90 |

> เตือน: ตัวเลข 3–12 เดือนสมมติว่า Phase 3 (backlink/citation) ถูกทำจริง — โครงสร้างอย่างเดียวขยับ impressions ได้ แต่ clicks ต้องการ authority.
