# Keyword Plan 2026-08 — SEO + AI Overview สำหรับ 3 สายบริการ

> **เป้าหมาย 2 ชั้น:** ติดหน้า 1 Google **และ** ถูกอ้างอิงใน AI Overview / ChatGPT / Perplexity
> **ขอบเขต:** AI Consulting · รับทำ SEO · WordPress/SEO-Ready Website
> **วิธีทำ:** ตาม `.claude/skills/seo-keyword/SKILL.md`

## หมายเหตุเรื่องข้อมูล (อ่านก่อน)

รอบนี้ **ไม่มี Ahrefs MCP และไม่มี BEAM Google Search MCP ต่ออยู่** จึงไม่มีตัวเลข volume/KD
สิ่งที่ใช้แทน และเชื่อถือได้แค่ไหน:

| ใช้อะไร | ได้อะไร | ข้อจำกัด |
|---|---|---|
| SERP จริงผ่าน web search | ใครยึดหน้า 1 อยู่ / ยังว่างตรงไหน | เห็นผลลัพธ์ ไม่เห็น volume |
| GSC export (มี.ค.–มิ.ย. 2026) | impression จริงของเราเอง | เห็นเฉพาะคำที่เราเคยโชว์ |
| หน้าเว็บที่มีอยู่แล้ว (`_inventory.md`) | กัน cannibalization | — |

**ทุกช่อง volume ในเอกสารนี้เป็น N/A โดยตั้งใจ — ไม่มีตัวเลขไหนถูกเดาขึ้นมา**
ถ้าต่อ Ahrefs ได้เมื่อไหร่ ให้กลับมาเติมและจัดลำดับใหม่

---

## 1. สรุป 10 Hero Keyword

ทุกคำผ่าน filter 4 ข้อ (demand / winnable / business fit / unfair advantage) และ **ไม่ทับ** กับ keyword ที่จองไว้ใน `_inventory.md` §4

### สาย "รับทำ SEO" → `/services/seo/`

| # | Hero keyword | Cluster keywords | SERP หน้า 1 เป็นใคร | ทำไมเราชนะได้ |
|---|---|---|---|---|
| A1 | **ทำไม traffic ตก ตั้งแต่มี AI Overview** | ai overview ทำ traffic หาย · zero-click search คือ · ctr ตกทั้งที่อันดับเท่าเดิม · วัดว่า traffic หายไปไหน | เอเจนซี่ไทย 1 ราย + เว็บข่าว + บทความต่างประเทศ/แปล — **ยังไม่มีใครลงลึกภาษาไทย** | เรามี GSC ของตัวเองที่เห็นปรากฏการณ์นี้จริง (impression พุ่ง 25–43/วัน แต่ position ตก) → เล่าจากข้อมูลจริงได้ ไม่ใช่แปลฝรั่ง |
| A2 | **llms.txt ต้องทำไหม คุ้มไหม** | ใครอ่าน llms.txt จริงบ้าง · llms.txt vs robots.txt · llms-full.txt คือ · llms.txt ได้ผลไหม | head term `llms.txt คือ` **แน่นมาก** (anga, padvee, bizsoft, twndigital ฯลฯ) แต่มุม *"ต้องทำไหม/ได้ผลจริงไหม"* ยังว่าง | เรามี `/llms-full.txt` อยู่บนเว็บจริง + GEO checker วัดได้ → ตอบแบบมีหลักฐาน ไม่ใช่เชียร์ตามกระแส **ห้ามจับ head term ตรง ๆ** |
| A3 | **ทำไมเว็บเราไม่ติด AI Overview** | ai overview เลือกเว็บจากอะไร · เช็คว่าเว็บติด ai overview ไหม · เว็บไม่ถูก ai อ้างอิง · แก้ยังไงให้ ai หยิบไปตอบ | ส่วนใหญ่เป็นบทความ "วิธีทำให้ติด" แบบ generic — **ไม่มีใครทำมุม diagnostic (ทำไมถึงไม่ติด)** | `/tools/geo-checker/` ตรวจ 14 จุดพอดี = บทความนี้คือคู่มืออ่านผลของเครื่องมือเรา ผูก tool→บทความ→บริการได้ครบวง |
| A4 | **Google AI Mode คืออะไร กระทบ SEO ยังไง** | ai mode ต่างกับ ai overview ยังไง · query fan-out คือ · ai mode มีในไทยหรือยัง | ไทยยังบางมาก — เป็นคำที่ **คนจะเริ่มค้นเมื่อฟีเจอร์มาถึงไทยเต็มตัว** | ลงมือก่อนได้เปรียบ: เขียนตอนนี้ = เป็นเจ้าของคำตั้งแต่ volume ยังต่ำ ⚠️ ตรวจ SERP ซ้ำก่อนเขียน (ฟีเจอร์เปลี่ยนเร็ว) |

### สาย "WordPress / SEO-Ready Website" → `/services/website-development/wordpress/` · `/services/website-development/`

| # | Hero keyword | Cluster keywords | SERP หน้า 1 เป็นใคร | ทำไมเราชนะได้ |
|---|---|---|---|---|
| B1 | **ทำเว็บ WordPress ให้ติด AI Overview ต้องทำอะไรบ้าง** 🔥 | wordpress schema ai overview · rank math ai overview · ปลั๊กอิน schema wordpress ตัวไหนดี · wordpress answer block | **หน้า 1 เป็นหน้าปลั๊กอินภาษาอังกฤษล้วน — ไม่มีบทความไทยเลยแม้แต่ชิ้นเดียว** | ช่องว่างใหญ่สุดในแผนนี้ เราทำ WordPress + Rank Math + schema เป็นงานประจำ เขียนจาก setup จริงได้ทันที |
| B2 | **จะทำเว็บบริษัทใหม่ ต้องเตรียมอะไรบ้างให้ AI หาเจอ** | ทำเว็บบริษัท เตรียมอะไรบ้าง · brief ทำเว็บ · เว็บ seo-ready คือ · ทำเว็บใหม่ไม่ให้ seo ตก | บทความ "5 สิ่งต้องเตรียม" ระดับผิวเยอะ ยังไม่มีใครให้ **checklist ที่เอาไปคุยกับ vendor ได้จริง** | ทำเป็น linkable asset (checklist ดาวน์โหลด) ได้เลย + ผูกเข้า `/website-audit/` ตรง ๆ |
| B3 | **ทำเว็บใหม่แล้วอันดับหาย แก้ยังไง** | ย้ายเว็บ seo ตก · redirect 301 ทำเว็บใหม่ · migration checklist · เปลี่ยนธีมแล้ว traffic หาย | มีบทความไทยอยู่บ้างแต่เก่าและไม่พูดถึง AI Overview เลย | เป็น pain ที่ลูกค้าโทรหาเราด้วยคำนี้จริง → intent ตรงกับบริการที่สุดในกลุ่มนี้ |

### สาย "AI Consulting" → `/services/ai-consulting/`

| # | Hero keyword | Cluster keywords | SERP หน้า 1 เป็นใคร | ทำไมเราชนะได้ |
|---|---|---|---|---|
| C1 | **ทำไมโปรเจกต์ AI ในองค์กรถึงล้ม** 🔥 | พนักงานต่อต้าน ai · ai pilot ไม่ได้ไปต่อ · ai adoption องค์กรไทย · เริ่มใช้ ai ในองค์กร เริ่มตรงไหน | มหาวิทยาลัย + เว็บ HR + สื่อธุรกิจ (icehr, skooldio, hrnote, bangkokbanksme) — **ไม่มีคนที่ลงมือ implement จริงเขียนเลย** | เราคือฝั่งที่ทำระบบจริงและเคยเห็นโปรเจกต์ล้ม มุมมอง implementer ต่างจาก HR ชัดเจน = E-E-A-T ที่เลียนแบบยาก |
| C2 | **คำนวณ ROI ของ AI ยังไง ว่าคุ้มไม่คุ้ม** | ai roi คือ · ai คุ้มทุนกี่เดือน · งบทำระบบ ai เท่าไหร่ · เสนอบอร์ดเรื่อง ai | บทความ vendor ต่างชาติเป็นหลัก ไทยยังไม่มีสูตรคำนวณที่ใช้ได้จริง | เปิดราคาจริงอยู่แล้ว (25,000/เดือน สำหรับ SEO, 60,000–1.5 ล้าน สำหรับ AI Solution) + เคสลูกค้า → ใส่ตัวเลขจริงลงสูตรได้ ⚠️ ต้องลิงก์หากันกับ `/ai-solution-consulting-guide-2026/` และไม่เล่าเรื่องงบซ้ำ |
| C3 | **ให้พนักงานใช้ ChatGPT ข้อมูลบริษัทรั่วไหม** 🔥 | shadow ai คือ · pdpa กับ ai · นโยบายใช้ ai ในองค์กร · ห้ามพนักงานใช้ chatgpt ดีไหม | มีแต่ข่าว (Blognone) — **ไม่มีคู่มือปฏิบัติภาษาไทยสักชิ้น** ทั้งที่เป็นคำถามแรกที่ผู้บริหารถาม | intent สูงมาก คนค้นคำนี้คือคนที่กำลังจะตัดสินใจเรื่อง AI ในองค์กร = ลูกค้า AI Consulting โดยตรง |

---

## 2. รายการที่ตัดทิ้ง + เหตุผล

เก็บไว้เพื่อไม่ให้เสนอซ้ำรอบหน้า

| คำที่คิดไว้ | ทำไมตัด |
|---|---|
| `llms.txt คือ` (head term) | หน้า 1 เต็มไปด้วยเอเจนซี่ไทยที่ authority สูงกว่าเรามาก — ไปจับมุม "ต้องทำไหม" แทน (A2) |
| `ai overview คืออะไร` | head term แน่นมาก (Cotactic, ANGA, minimice, SMEjump, Padvee) สู้ไม่ได้ด้วย DR ปัจจุบัน |
| `seo ยังจำเป็นไหม` / `seo ตายแล้วจริงไหม` | **ทับกับ spoke 1** (`/geo-vs-seo-thai/`) ที่จองคำนี้เป็น secondary ไว้แล้ว |
| `วิธีทำให้เว็บถูก cite ใน ChatGPT` | **ทับกับ spoke 2** (`/how-to-get-cited-ai-chatgpt-perplexity/`) |
| `วัดผลว่า AI อ้างอิงเราไหม` | **ทับกับ spoke 4** (`/measuring-geo-ai-citations/`) |
| `wordpress ช้า แก้ยังไง` | ทับกับ `/lcp-คืออะไร-วิธี-2026/` + `/lighthouse-100-ทำยังไง-2026/` |
| `ai agent กับ chatbot ต่างกันอย่างไร` | **ไม่ตัด แต่ไม่เขียนใหม่** → ดู §3 |

## 3. งานที่เป็น "อัปเดตหน้าเดิม" ไม่ใช่เขียนใหม่

**`ai agent กับ chatbot ต่างกันอย่างไร`** — SERP หน้า 1 เป็น vendor ต่างชาติ/เว็บอังกฤษล้วน (thaiger.ai, mvminfotech, empirra, chiangraitimes) **ไม่มีบทความไทยที่มีน้ำหนัก** = ช่องว่างจริง

แต่เรามี `/ai-agent-rag-chatbot-thailand-2026/` อยู่แล้ว → เขียนใหม่จะแย่งกันเอง
**ให้ทำแทน:** เพิ่มหัวข้อ H2 เปรียบเทียบ AI Agent vs Chatbot (พร้อมตาราง + answer block) เข้าไปในหน้าเดิม แล้วอัปเดต focus keyword ใน `_inventory.md`
งาน ~2 ชั่วโมง เทียบกับเขียนใหม่ 1 บทความ และได้ผลเร็วกว่าเพราะหน้าเดิม index แล้ว

---

## 4. ลำดับการเขียนที่แนะนำ

**Cadence: 1 บทความ / 2 สัปดาห์** (ครบ 10 หัวข้อใน ~20 สัปดาห์ — อย่าสัญญาเร็วกว่านี้ถ้าทีมเท่าเดิม)

| ลำดับ | หัวข้อ | เหตุผลที่ทำก่อน |
|---|---|---|
| 1 | **B1** WordPress + AI Overview | คู่แข่งไทย = ศูนย์ และเป็นความรู้ที่เราทำอยู่ทุกวัน → เขียนเร็วที่สุด ชนะง่ายที่สุด |
| 2 | **C3** ChatGPT กับข้อมูลบริษัทรั่ว | intent สูงสุดในแผน คนค้นคือผู้บริหารที่กำลังตัดสินใจ |
| 3 | **A3** ทำไมเว็บไม่ติด AI Overview | ผูกกับ `/tools/geo-checker/` ที่มีอยู่แล้ว → ได้ทั้งบทความและทาง traffic เข้า tool |
| 4 | อัปเดต `/ai-agent-rag-chatbot-thailand-2026/` (§3) | งานเล็ก ผลเร็ว แทรกได้ระหว่างรอบ |
| 5 | **A1** traffic ตกเพราะ AI Overview | ต้องรอ export GSC รอบใหม่มาทำกราฟ before/after ก่อน |
| 6 | **C1** ทำไมโปรเจกต์ AI ล้ม | ต้องเก็บเคสจริงให้ครบก่อนเขียน |
| 7–10 | B2 · B3 · C2 · A4 | A4 ตรวจ SERP ซ้ำก่อนเริ่มเสมอ |

---

## 5. Outline เต็ม — 3 หัวข้อแรก

ใช้ฟอร์แมตตาม `.claude/skills/seo-keyword/references/outline-template.md`
(หัวข้อที่ 4–10 ทำ outline ตอนถึงคิว เพื่อให้ SERP ยังสด)

### ① ทำเว็บ WordPress ให้ติด AI Overview ต้องทำอะไรบ้าง

**Primary:** `ทำเว็บ wordpress ให้ติด ai overview`
**Cluster:** wordpress schema ai overview · rank math ai overview · ปลั๊กอิน schema wordpress ตัวไหนดี · wordpress answer block
**Intent:** How-to — เจ้าของเว็บ/มาร์เก็ตติ้งที่ใช้ WordPress อยู่แล้ว อยากรู้ว่าต้องแก้อะไรบ้าง
**Hub:** spoke ของ GEO hub · **URL:** `/wordpress-ai-overview-2026/` · **Words:** 1,800–2,200
**ปลายทาง:** `/services/website-development/wordpress/`
**Unfair advantage:** setup Rank Math + schema ที่เราใช้กับลูกค้าจริง → screenshot ของจริงได้ทุกขั้น

**Meta Title:** `ทำเว็บ WordPress ให้ติด AI Overview: 8 ขั้นตอนที่ต้องทำ (2026)`
**Meta Description:** `คู่มือปรับ WordPress ให้ Google AI Overview หยิบไปตอบ — ตั้งค่า Rank Math, schema, answer block ทีละขั้น พร้อมภาพจริงจากเว็บที่เราทำ`

**Answer Block:** WordPress ติด AI Overview ได้ต้องมี 3 อย่าง — เนื้อหาที่ตอบคำถามจบใน 60 คำแรก, structured data ที่เชื่อมกันเป็น @graph (ไม่ใช่ schema กระจัดกระจาย), และหัวข้อ H2/H3 ที่เขียนเป็นคำถามจริง ปลั๊กอินช่วยได้แค่ส่วน schema ที่เหลือต้องแก้ที่โครงเนื้อหา

**Outline:**
1. H2: AI Overview เลือกเว็บจากอะไร (อธิบายสั้น 200 คำ + ลิงก์ hub)
2. H2: ขั้นที่ 1 — วาง answer block ใต้ H1 ทุกหน้า
3. H2: ขั้นที่ 2 — ตั้ง Rank Math ให้ออก schema ที่เชื่อมกัน *(screenshot ของจริง)*
4. H2: ขั้นที่ 3 — FAQ block แทน list ธรรมดา *(ทำไมถึงต่างกัน)*
5. H2: ขั้นที่ 4–6 — H2 เป็นคำถาม / ตัวเลขมีแหล่งอ้าง / ตาราง
6. H2: ขั้นที่ 7 — author + วันที่อัปเดต (Person schema)
7. H2: ขั้นที่ 8 — เช็คผลด้วย Rich Results Test + GEO Checker
8. H2: **ปลั๊กอิน schema ตัวไหนคุ้ม ตัวไหนไม่ต้อง** ← ตารางเปรียบเทียบ, คนค้นหาข้อนี้เยอะแต่ไม่มีใครตอบตรง
9. H2: FAQ

**FAQ:** ต้องซื้อปลั๊กอินไหม · Rank Math ฟรีพอไหม · ใช้เวลานานแค่ไหนกว่าจะติด · ธีมมีผลไหม · ทำแล้วจะติดแน่ไหม
**Schema:** Article + Person + FAQPage + **HowTo** (มี 8 ขั้น)
**Links OUT:** GEO hub · `/schema-markup-thai-guide-2026/` · `/tools/geo-checker/` · `/services/website-development/wordpress/`
**Links IN (ต้องกลับไปแก้):** `/schema-markup-thai-guide-2026/` (pos 11 — ส่ง equity) · GEO hub · `/lighthouse-100-ทำยังไง-2026/`

---

### ② ให้พนักงานใช้ ChatGPT ข้อมูลบริษัทรั่วไหม

**Primary:** `พนักงานใช้ chatgpt ข้อมูลบริษัทรั่วไหม`
**Cluster:** shadow ai คือ · pdpa กับ ai · นโยบายใช้ ai ในองค์กร · ห้ามพนักงานใช้ chatgpt ดีไหม
**Intent:** Informational นำไป decision — ผู้บริหาร/IT ที่ต้องตอบคำถามนี้ให้บอร์ด
**Hub:** hub ใหม่ "AI Governance" · **URL:** `/chatgpt-company-data-security-2026/` · **Words:** 1,600–2,000
**ปลายทาง:** `/services/ai-consulting/`
**Unfair advantage:** เราวางระบบ AI ให้องค์กรจริง → ตอบได้ว่าในทางปฏิบัติองค์กรไทยตั้งค่ากันยังไง ไม่ใช่แค่อ้าง TOS

**Meta Title:** `พนักงานใช้ ChatGPT ข้อมูลบริษัทรั่วไหม? คำตอบ + นโยบายที่ใช้ได้จริง`
**Meta Description:** `ข้อมูลที่พิมพ์ลง ChatGPT ไปไหนต่อ ต่างกันยังไงระหว่างบัญชีฟรีกับ Business และองค์กรไทยควรวางนโยบายแบบไหน — พร้อมเทมเพลตนโยบายเอาไปใช้ได้เลย`

**Answer Block:** ขึ้นอยู่กับว่าใช้บัญชีแบบไหน — บัญชีฟรี/ส่วนตัวมีความเสี่ยงจริงเพราะข้อมูลอาจถูกใช้เทรนโมเดล ส่วนบัญชีระดับ Business/Enterprise ไม่นำข้อมูลไปเทรนตามสัญญา ความเสี่ยงที่ใหญ่กว่าคือ "shadow AI" — พนักงานแอบใช้บัญชีส่วนตัวเพราะบริษัทไม่มีทางเลือกให้

**Outline:**
1. H2: ข้อมูลที่พิมพ์ลง ChatGPT ไปไหนต่อ
2. H2: บัญชีฟรี vs Plus vs Business/Enterprise ต่างกันตรงไหน ← **ตารางเปรียบเทียบ**
3. H2: PDPA เกี่ยวข้องยังไง (ข้อมูลลูกค้า, ข้อมูลพนักงาน)
4. H2: ทำไม "สั่งห้าม" ถึงไม่ได้ผล — shadow AI *(อ้างสถิติ)*
5. H2: 6 ข้อที่ควรอยู่ในนโยบายใช้ AI ขององค์กร
6. H2: **เทมเพลตนโยบาย (คัดลอกไปใช้ได้)** ← linkable asset
7. H2: จัดระดับข้อมูล — อะไรพิมพ์ได้ อะไรห้าม
8. H2: FAQ

**FAQ:** ใช้บัญชีบริษัทปลอดภัยจริงไหม · ลบประวัติแล้วหายจริงไหม · Copilot/Gemini ต่างกันไหม · ต้องแจ้ง PDPA ไหม · ควรบล็อกที่ไฟร์วอลล์ไหม
**Schema:** Article + Person + FAQPage
**Links OUT:** `/services/ai-consulting/` · `/ai-solution-consulting-guide-2026/` · C1 (เมื่อ publish)
**Links IN:** `/services/ai-consulting/` · `/ai-solution-consulting-guide-2026/` · `/en/ai-consulting/`

---

### ③ ทำไมเว็บเราไม่ติด AI Overview

**Primary:** `ทำไมเว็บไม่ติด ai overview`
**Cluster:** ai overview เลือกเว็บจากอะไร · เช็คว่าเว็บติด ai overview ไหม · เว็บไม่ถูก ai อ้างอิง
**Intent:** Diagnostic — คนที่ทำ SEO มาแล้วแต่ AI ไม่หยิบ
**Hub:** spoke ของ GEO hub · **URL:** `/why-not-in-ai-overview-2026/` · **Words:** 1,600–2,000
**ปลายทาง:** `/services/seo/`
**Unfair advantage:** `/tools/geo-checker/` ตรวจ 14 จุด → บทความนี้คือ "คู่มืออ่านผล" ของเครื่องมือเรา + ใส่สถิติรวมจากหน้าที่เคยสแกนได้

**Meta Title:** `ทำไมเว็บไม่ติด AI Overview? 9 สาเหตุที่เจอบ่อยที่สุด (2026)`
**Meta Description:** `อันดับดีแต่ AI ไม่หยิบไปตอบ — ไล่เช็ค 9 สาเหตุที่พบบ่อยในเว็บไทย พร้อมวิธีตรวจหน้าเว็บของคุณเองฟรี`

**Answer Block:** สาเหตุที่พบบ่อยที่สุดคือเนื้อหาไม่ได้ตอบคำถามในย่อหน้าแรก — AI Overview ดึงคำตอบจากส่วนที่ตอบตรงและสั้น ถ้าบทความเกริ่นยาว 3 ย่อหน้าก่อนเข้าเรื่อง AI จะข้ามไปหยิบเว็บอื่น รองลงมาคือไม่มี structured data และหัวข้อ H2 ที่ไม่ได้เขียนเป็นคำถาม

**Outline:**
1. H2: AI Overview ต่างจากอันดับ Google ยังไง (ทำไมอันดับดีแล้วยังไม่ติด)
2. H2: สาเหตุ 1–3 — ระดับเนื้อหา (ไม่ answer-first / ไม่มี definition / ไม่มีตัวเลข)
3. H2: สาเหตุ 4–6 — ระดับโครงสร้าง (schema, H2 ไม่ใช่คำถาม, ไม่มี FAQ)
4. H2: สาเหตุ 7–9 — ระดับความน่าเชื่อถือ (ไม่มีชื่อผู้เขียน, ไม่อัปเดต, ไม่มีแหล่งอ้าง)
5. H2: วิธีตรวจหน้าเว็บตัวเอง ← **ฝัง `/tools/geo-checker/`**
6. H2: แก้แล้วใช้เวลานานแค่ไหนถึงเห็นผล *(ตอบตามจริง ไม่โม้)*
7. H2: FAQ

**Schema:** Article + Person + FAQPage
**Links OUT:** `/tools/geo-checker/` · GEO hub · `/geo-checklist-thai-website/` · `/services/seo/`
**Links IN:** GEO hub · `/technical-seo-guide/` (pos 27) · `/geo-checklist-thai-website/`

---

## 6. ทำอะไรต่อ

1. ตรวจ SERP ซ้ำก่อนเขียนทุกหัวข้อ — โดยเฉพาะ A4 (Google AI Mode) ที่เปลี่ยนเร็ว
2. Export GSC รอบใหม่ (ส.ค. 2026) มาทับ baseline ใน `_inventory.md` §5 และปลดล็อก A1
3. อัปเดต `_inventory.md` **ทุกครั้ง** ที่ publish ไม่งั้นรอบหน้าจะเสนอคำซ้ำ
4. รีวิวสัปดาห์ที่ 4 / 8 / 12 — content ใหม่ใช้เวลา 3–6 เดือนกว่าจะไต่อันดับ **อันดับตกช่วงแรกหลัง index เป็นปกติ ห้ามตีความว่าล้มเหลว**
