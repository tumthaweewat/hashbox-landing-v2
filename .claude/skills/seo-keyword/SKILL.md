---
name: seo-keyword
description: Thai SEO keyword research and article outlining for hashbox.co.th. Finds low-competition informational keywords with real search demand, validates intent against live SERPs, and turns them into paste-ready outlines (Meta Title, Answer Block, H2/H3, FAQ) in the seo-handoff format. Use when asked to หา keyword, ทำ keyword research, วางแผน content SEO, หาหัวข้อบทความ, สร้าง outline บทความ, ทำ content cluster, or plan a hub-and-spoke.
---

# SEO Keyword Research — hashbox.co.th

หา keyword + วาง outline ที่ **ติดอันดับได้จริงด้วย authority เท่าที่เรามีตอนนี้** ไม่ใช่ keyword ที่ volume สวยแต่สู้ไม่ได้

## ขอบเขต — ทำเพื่อ 3 สายบริการนี้เท่านั้น

ทุก keyword ต้องส่ง traffic เข้า 1 ใน 3 สายนี้ ถ้าโยงไม่ได้ = ตัดทิ้ง

| สาย | หน้าปลายทาง | คนที่เราอยากได้ |
|---|---|---|
| **AI Consulting** | `/services/ai-consulting/` · `/en/ai-consulting/` | ผู้บริหาร/เจ้าของธุรกิจที่อยากเอา AI มาใช้แต่ไม่รู้เริ่มตรงไหน |
| **รับทำ SEO** | `/services/seo/` | คนที่เว็บมีอยู่แล้วแต่ไม่มีคนเข้า / อันดับตก / เพิ่งรู้ว่ามี AI Overview |
| **WordPress / SEO-Ready Website** | `/services/website-development/wordpress/` · `/services/website-development/` | คนกำลังจะทำเว็บใหม่ หรือเว็บเดิมช้า/แก้เองไม่ได้ |

## เป้าหมายมี 2 ชั้น — ต้องทำทั้งคู่เสมอ

1. **อันดับบน Google** — ติดหน้า 1 ของ query ที่เลือก
2. **ถูกอ้างอิงใน AI Overview / ChatGPT / Perplexity** — สำคัญกว่าในระยะยาว เพราะ AI Overview กินพื้นที่ organic ไปเรื่อย ๆ และคนไทยเริ่มถามคำถามยาว ๆ กับ AI แทน Google

ชั้นที่ 2 เปลี่ยนวิธีเลือก keyword: **query ที่ยาวและเป็นคำถาม มีค่ามากกว่า head term สั้น ๆ**
`"ทำเว็บ wordpress ให้ติด ai overview ต้องทำยังไง"` มีค่ากว่า `"รับทำเว็บ"` สำหรับเรา —
volume ต่ำกว่ามาก แต่เราชนะได้ ถูก cite ได้ และคนที่ค้นแบบนั้นคือลูกค้าจริง

**ทุก outline ต้องออกแบบให้ถูก cite ได้:** answer block ตอบจบใน 60 คำ · definition ชัด · ตัวเลขมีแหล่งอ้างอิง · ตาราง/list · FAQ + schema
(รายละเอียดใน `seo-handoff/geo-content-cluster-plan.md` §4 — เราทำเรื่องนี้เป็นอยู่แล้ว ใช้กับทุกสายบริการ ไม่ใช่แค่ cluster GEO)

## กฎเหล็ก 3 ข้อ (ผิดข้อใดข้อหนึ่ง = งานใช้ไม่ได้)

1. **ห้ามแต่งตัวเลข** — volume / KD / position ใส่ได้เฉพาะที่มาจาก tool หรือ GSC export จริง
   ถ้าดึงไม่ได้ ให้เขียน `N/A (ไม่มี tool)` แล้วอธิบายว่าใช้อะไรตัดสินใจแทน
2. **ห้ามเสนอ keyword ที่จองแล้ว** — เช็ค **2 ไฟล์** ก่อนเสมอ
   `docs/seo-plan-2026-08-service-restructure/KEYWORD-DB.csv` (คำที่ทีมติดตามและ publish แล้ว ถือเป็นตัวจริง)
   และ `seo-handoff/_inventory.md` §4 (ดราฟต์ที่ยังไม่ขึ้น ยังไม่เข้า DB)
   ถ้าหัวข้อใหม่ใกล้ของเดิม ให้เสนอเป็น *"อัปเดตหน้าเดิม"* แทนการเขียนหน้าใหม่
3. **ทุก keyword ต้องมีหน้าปลายทาง** — ระบุ service page ที่จะส่ง traffic ไป ถ้าระบุไม่ได้ = ตัดทิ้ง
   (traffic ที่ไม่มีหน้าให้ลงจอด ไม่ใช่ผลงาน)

---

## STEP 0 — โหลด context (ทำก่อนเสมอ)

อ่าน 3 ไฟล์นี้ก่อนเริ่มคิด keyword:
- `docs/seo-plan-2026-08-service-restructure/KEYWORD-DB.csv` — ทะเบียนตัวจริง: คำที่ track อยู่ หน้าปลายทาง สถานะ publish และ impr/pos ล่าสุด
- `seo-handoff/_inventory.md` — ดราฟต์ใน `seo-handoff/` ที่ยังไม่เข้า DB + first-party asset ที่ใช้อ้างได้
- `seo-handoff/keyword-research.md` — cluster analysis + content gap ที่ระบุไว้แล้ว

**สรุปกลับมาให้ user เห็น 3 บรรทัด** ก่อนไป step ถัดไป: baseline ปัจจุบัน / keyword ที่จองแล้วกี่คำ / gap ที่เอกสารเดิมชี้ไว้

## STEP 1 — หา keyword

**เรียงลำดับแหล่งข้อมูลตามความน่าเชื่อถือ:**

| ลำดับ | แหล่ง | ได้อะไร |
|---|---|---|
| 1 | **DataForSEO** — `node tools/dataforseo.mjs` | volume · trend · competition · SERP จริง · **ตรวจว่า query นั้นมี AI Overview หรือไม่** |
| 2 | **GSC export ของเราเอง** | impression จริง = หลักฐานว่ามีคนค้นและ Google เคยโชว์เรา |
| 3 | Google autocomplete + PAA + related searches (WebSearch/WebFetch) | คำที่คนค้นจริงแต่ tool ยังไม่มี volume |
| 4 | Pantip / YouTube / กลุ่ม Facebook สายการตลาด | คำที่กำลังจะมา ยังไม่มีใครเขียน |

**คำสั่งที่ใช้บ่อย:**
```bash
node tools/dataforseo.mjs check                 # เช็ค credential + ยอดเงินคงเหลือ
node tools/dataforseo.mjs ideas "ai overview"   # หา keyword ใหม่จาก seed
node tools/dataforseo.mjs volume "kw1" "kw2"    # volume + trend
node tools/dataforseo.mjs serp "kw"             # ใครยึดหน้า 1 + มี AI Overview ไหม
node tools/dataforseo.mjs plan seo-handoff/keyword-plan-2026-08.md   # เติมตัวเลขทั้งแผนรวดเดียว
```
ต้องมี `DATAFORSEO_LOGIN` / `DATAFORSEO_PASSWORD` ใน environment (ห้าม commit)

> **ระวังเรื่อง volume ภาษาไทย:** tool ทุกตัวรายงาน volume ต่ำเกินจริงสำหรับคำไทย และ **แสดง 0 สำหรับ emerging keyword แทบทั้งหมด**
> ถ้าโจทย์คือ "คำที่คนจะเริ่มเสิร์ชในอนาคต" **ห้ามใช้ volume เป็นเกณฑ์ตัด** — ให้ดู `trend` (คอลัมน์เทียบ 3 เดือนล่าสุดกับ 3 เดือนก่อนหน้า) และแหล่ง 3–4 แทน
> volume 0 ที่ trend เป็น `new` คือสัญญาณที่เราต้องการ ไม่ใช่สัญญาณให้ตัดทิ้ง

**สิ่งที่ต้องบันทึกทุกครั้งจาก `serp`:** query นั้นมี AI Overview แล้วหรือยัง และ AI Overview อ้างอิงเว็บไหนอยู่
ถ้ามี AI Overview แล้วและอ้างเว็บที่เราแข่งได้ → นั่นคือช่องที่เราจะแทรก ถ้ายังไม่มี → เขียนไว้ก่อนเพื่อเป็นแหล่งแรกที่ถูกหยิบตอนฟีเจอร์มาถึง

**โครงผลลัพธ์:** hero keyword (หัวข้อที่จะเป็น 1 บทความ) + cluster keyword 3–6 คำต่อ hero (คำที่บทความเดียวกันควรติดด้วย → ใช้เป็น H2/H3 และ FAQ)

## STEP 2 — ตรวจ intent จาก SERP จริง

ยิง SERP ทุก hero keyword (BEAM Google Search MCP ถ้าต่อไว้ / ไม่มีก็ WebSearch) แล้วบันทึก:

- **Intent จริงจากผลหน้า 1** — ถ้าหน้า 1 เป็น service page ทั้งหน้า แปลว่า commercial ไม่ใช่ informational → ตัดทิ้ง (หรือย้ายไปทำเป็น service page แทนบทความ)
- **SERP feature ที่มี** — AI Overview / Featured snippet / PAA = ช่องที่เราจะแย่งด้วย answer block
- **ประเภทคู่แข่งหน้า 1** → ตัวชี้วัดว่า "คนยังไม่ค่อยทำ" ที่ตรวจสอบได้จริง:

| เจอบนหน้า 1 | แปลว่า |
|---|---|
| Pantip / YouTube / บล็อกร้าง / เนื้อหาแปลหยาบ ๆ | ✅ **โอกาส** — ไม่มีใครทำ content ดีจริง |
| เอเจนซี่ไทยรายใหญ่ + seranking/rankmath/ahrefs ฉบับแปล ทั้งหน้า | ❌ ตัดทิ้ง — สู้ไม่ไหวด้วย authority ปัจจุบัน |
| ผลลัพธ์ผสม มีช่องว่างชัดเจน (ไม่มีใครตอบครบ) | ✅ ทำได้ ระบุด้วยว่าเราจะตอบส่วนที่ขาดยังไง |

## STEP 3 — Filter (ตัดก่อนเขียน outline)

เก็บเฉพาะ hero keyword ที่ผ่าน **ครบทั้ง 4 ข้อ**:

- [ ] **Demand** — มีหลักฐานว่ามีคนค้นจริง (GSC impression / autocomplete / PAA / forum thread)
- [ ] **Winnable** — SERP หน้า 1 ไม่ได้ถูกยึดโดย authority ที่เราสู้ไม่ได้
- [ ] **Business fit** — ระบุ service page ปลายทางได้ 1 หน้า
- [ ] **Unfair advantage** — เราตอบได้ดีกว่าคนอื่นเพราะมี first-party asset (`_inventory.md` §3) ระบุมาว่าชิ้นไหน

**ข้อสุดท้ายสำคัญที่สุด** ถ้าตอบไม่ได้ว่า "ทำไมต้องเป็นเรา" บทความนั้นจะเป็นแค่ content ซ้ำในตลาด → ตัดทิ้ง

## STEP 4 — Outline

ใช้ฟอร์แมตใน `references/outline-template.md` (ตรงกับที่ทีมวางลง WordPress/Rank Math อยู่แล้ว — ได้มาแล้ววางต่อได้เลย ไม่ต้องแปลง)

โครงบทความยึดตาม **"Template โครงสร้างเพื่อให้ AI Citation"** ใน `seo-handoff/geo-content-cluster-plan.md` §4

## STEP 5 — ผูกเข้า cluster

หัวข้อลอย ๆ ไม่ช่วยอะไร ทุกหัวข้อใหม่ต้องระบุ:
- เป็น **hub** ใหม่ หรือ **spoke** ของ hub เดิม (GEO / Technical SEO / AI Automation / CRO)
- **Links IN** — หน้าไหนบ้างที่ต้องกลับไปแก้เพื่อลิงก์มาหาบทความนี้
  (โดยเฉพาะหน้าที่มี authority แล้ว: `/schema-markup-thai-guide-2026/` pos 11, `/technical-seo-guide/` pos 27 — ใช้ส่ง link equity)
- **Links OUT** — hub + spoke ข้างเคียง + service page ปลายทาง

---

## STEP 6 — เขียนบทความ

อ่าน `references/house-style.md` ก่อนเขียนทุกครั้ง สรุปกฎที่พลาดบ่อยที่สุด:

- เขียนในฐานะ **สื่อที่เป็นกลาง** ไม่ใช่เอเจนซี่ที่ขายของ CTA อยู่ท้ายบทเท่านั้น
- **ห้ามใช้เครื่องหมายคำพูดครอบคำเพื่อเน้น** ใช้ตัวหนาแทน
- **ห้ามใช้ขีดคั่นกลางประโยค** (hyphen ในคำเทคนิคอังกฤษอย่าง `answer-first` ใช้ได้ เพราะเป็นส่วนหนึ่งของคำ)
- **ห้ามใช้คำเปรียบเปรย** อธิบายสิ่งที่มันเป็นตรง ๆ
- แปลศัพท์เฉพาะทางทุกคำตอนปรากฏครั้งแรก
- แทรกความเห็นจากประสบการณ์จริงอย่างน้อย 2 จุด

ตรวจก่อนส่งเสมอ:
```bash
node tools/check-house-style.mjs seo-handoff/articles/<ไฟล์>.md
```

บันทึกดราฟต์ที่ `seo-handoff/articles/<slug>.md` ตามฟอร์แมตเดิม (Meta Title → Meta Description → Slug → บทความ → Internal links → Schema)

## Output ที่ต้องส่งมอบ

1. ตารางสรุป hero keyword ทั้งหมด: keyword / demand evidence / SERP verdict / service page ปลายทาง / unfair advantage
2. **รายการที่ตัดทิ้ง + เหตุผล** (สำคัญพอ ๆ กับรายการที่เก็บ — กันเสนอซ้ำรอบหน้า)
3. Outline เต็มตาม template ของ hero ที่ผ่าน filter
4. **ลำดับการเขียนที่แนะนำ** + เหตุผล (เขียนง่ายสุด/impact สูงสุดก่อน)
5. เขียนผลลัพธ์ลง `seo-handoff/keyword-plan-<YYYY-MM>.md` แล้วอัปเดต `_inventory.md` เมื่อ publish จริง

## หลังจากนั้น

Cadence ที่ทีมขนาดนี้ทำไหว = **1 บทความ / 2 สัปดาห์** (อ้างอิง `geo-content-cluster-plan.md` §3)
รีวิวผลที่สัปดาห์ 4 / 8 / 12 ด้วย GSC — content ใหม่ใช้เวลา 3–6 เดือนกว่าจะไต่อันดับ **อันดับตกช่วงแรกหลัง index เป็นเรื่องปกติ ห้ามตีความว่าล้มเหลว**
