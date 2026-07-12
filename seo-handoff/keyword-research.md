# Keyword Research & Ranking Analysis — hashbox.co.th

> **แหล่งข้อมูล:** Google Search Console export, 10 มี.ค. – 14 มิ.ย. 2026 (snapshot ก่อน deploy งาน SEO รอบล่าสุด 16 มิ.ย.)
> **หมายเหตุ:** ตัวเลขนี้คือ baseline ก่อนการเปลี่ยนแปลง — ใช้เทียบ before/after เมื่อ export GSC รอบใหม่ (แนะนำ export อีกครั้งช่วงต้น ก.ค. เป็นต้นไป)

---

## 1. สรุปภาพรวม (Ranking & Traffic)

| Metric | ค่า (3 เดือน) |
|---|---|
| Clicks | 24 |
| Impressions | ~1,200 |
| Branded clicks ("hashbox" + "hash box") | 17–18 (≈75% ของ clicks, ~99% เมื่อรวม impression พฤติกรรม) |
| Non-brand clicks | ~6–7 |
| Avg position (ปลายช่วง) | 60–70 |

**บทสรุป:** organic discovery แบบ non-brand แทบยังไม่ทำงาน ทุก click เกือบทั้งหมดมาจากคนที่รู้จักแบรนด์อยู่แล้ว → โจทย์คือสร้าง **ranking ของ non-brand query** ให้ขึ้นมาถึงหน้า 1

### เส้น impression 2 เฟส (สำคัญต่อการตีความ)
- **ถึง 15 พ.ค.:** impressions 0–10/วัน, position ดี (4–8) แต่ volume น้อยมาก
- **16 พ.ค. เป็นต้นมา:** impressions พุ่งเป็น 25–43/วัน แต่ position ตกไป 40–80

**สาเหตุ:** blog/guide posts ใหม่ถูก index รอบ ~16 พ.ค. → Google เริ่มโชว์ในผลค้นหา (impr เพิ่ม) แต่หน้าใหม่ยังไม่มี authority → ติดหน้า 5–8 **นี่เป็นพฤติกรรมปกติของ content ใหม่** ไม่ใช่การ "ตก" ต้องใช้เวลา 3–6 เดือนกว่าจะไต่ขึ้น (เร็วขึ้นได้ด้วย internal linking + content depth ที่เราทำ)

---

## 2. Keyword Clusters (38 queries → 5 กลุ่ม)

### Cluster A — AI Consulting (Commercial intent) 🔥 ใหญ่สุด
รวม ~480 impressions · best position ~49

| Query | Impr | Pos | ภาษา |
|---|---:|---:|---|
| ai consultant bangkok | 81 | 54 | EN |
| ai consulting bangkok | 70 | 50 | EN |
| ai consulting companies bangkok | 57 | 55 | EN |
| บริการให้คำปรึกษา ai solution | 54 | 68 | TH |
| ai consulting companies thailand | 48 | 81 | EN |
| ai services bangkok | 44 | 71 | EN |
| ปรึกษาทำระบบ ai solution สำหรับธุรกิจ | 42 | 77 | TH |
| ปรึกษาทำระบบ ai solution | 26 | 79 | TH |
| ให้คำปรึกษา ai | 20 | 65 | TH |
| ai consulting thailand | 15 | 78 | EN |
| wordpress ai integration agency bangkok | 7 | 83 | EN |
| ปรึกษา ai transformation | 6 | 72 | TH |
| ที่ปรึกษา ai สำหรับธุรกิจ | 4 | 50 | TH |
| รับทำ ai tool | 3 | 53 | TH |
| รับทำ ai prototype | 3 | 67 | TH |
| ai solutions bangkok | 3 | 85 | EN |

**Action:**
- EN sub-cluster (~250 impr) → รับด้วย `/en/ai-consulting/` (สร้างแล้ว)
- TH commercial long-tail (`ปรึกษาทำระบบ ai solution`, `ai transformation`, `รับทำ ai tool/prototype`) → **ยังไม่มีบทความเจาะ** = โอกาสเขียนเพิ่ม (ดู §4)

### Cluster B — GEO (Informational) 🔥 จุดแข็งแบรนด์
รวม ~241 impressions · best position ~65

| Query | Impr | Pos |
|---|---:|---:|
| geo คือ | 156 | 77 |
| geo คืออะไร | 37 | 72 |
| geo | 24 | 65 |
| geo seo | 24 | 79 |

**Action:** "geo คือ" = query non-brand ที่ใหญ่ที่สุดของเว็บ → GEO content cluster 5 บทความ (กำลังเขียน) + ปรับ hub เป็น answer-first

### Cluster C — Technical SEO
รวม ~120 · best position **27** (ใกล้หน้า 1 สุด)

| Query | Impr | Pos |
|---|---:|---:|
| technical seo | 67 | 58 |
| technical seo คือ | 50 | 27 |
| tech seo | 2 | 43 |
| technical-seo | 1 | 46 |

**Action:** paste answer block + FAQ (เตรียมไว้แล้ว) + internal links → ดัน pos 27 → หน้า 1

### Cluster D — Core Web Vitals
`core web vitals คือ` 19 impr, pos 57 → paste answer block (เตรียมแล้ว)

### Cluster E — Schema
`schema markup คือ` pos **11** (authority source) → ใช้ลิงก์ส่ง equity เข้า GEO cluster (spoke 5)

### Long-tail เดี่ยว ๆ (สังเกตไว้)
`mobile app development` (pos 12), `web designer` (pos 2), `บริการรับทำโมเดลวิเคราะห์ข้อมูล` (pos 55), `เรียน website tracking` (pos 82) — volume ต่ำ ยังไม่ต้อง prioritize

---

## 3. Priority Matrix (impact × ความเร็ว)

| หน้า/หัวข้อ | สถานะปัจจุบัน | Action | ความเร็วเห็นผล |
|---|---|---|---|
| technical-seo-guide | pos 27 | paste content + links | ⚡ เร็ว (1–3 สัปดาห์) |
| schema-markup | pos 11 | paste content | ⚡ เร็ว |
| GEO hub + cluster | pos 65–77 | 5 บทความ + hub answer-first | 🕐 กลาง (1–3 เดือน) |
| /services/ai-consulting/ | pos 65 | EN targeting (ทำแล้ว) | 🕐 กลาง |
| /en/ai-consulting/ | ใหม่ | index + authority | 🕐 กลาง |
| TH AI commercial long-tail | ไม่มี content | เขียนบทความใหม่ (§4) | 🕐 กลาง |

---

## 4. Content Gap — บทความที่ควรเขียนเพิ่ม (นอกเหนือ GEO cluster)

Keyword ที่มี demand แต่**ยังไม่มีหน้าเจาะ**:

| หัวข้อบทความที่แนะนำ | Target keyword | รวม impr โดยประมาณ | Intent |
|---|---|---:|---|
| "ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ เริ่มต้นอย่างไร" | ปรึกษาทำระบบ ai solution (+สำหรับธุรกิจ) | ~122 | Commercial |
| "AI Transformation คืออะไร เริ่มต้นในองค์กรไทยยังไง" | ปรึกษา ai transformation, ai transformation | ~10+ (กำลังโต) | Commercial/Info |
| "รับทำ AI Tool / AI Prototype ต้องเตรียมอะไรบ้าง" | รับทำ ai tool, รับทำ ai prototype | ~6 | Commercial |
| "LINE Chatbot AI สำหรับธุรกิจไทย" | line chatbot ai (มี link จาก service page แล้ว) | — | Commercial |

> **ลำดับแนะนำ:** ทำ GEO cluster ให้ครบก่อน (จุดแข็ง + query ใหญ่สุด) แล้วค่อยเสริม AI commercial long-tail เพราะ commercial page มีอยู่แล้ว (service page) ที่รับ intent เบื้องต้นได้

---

## 5. วิธี track ผล (ทำเป็นประจำ)

1. **GSC → Performance** ทุกวันจันทร์: filter เฉพาะ 6 หน้าที่ optimize เทียบ week-over-week (clicks, impressions, position)
2. **GSC → Search results → Queries**: ดูว่า non-brand impressions โตขึ้นไหม (เป้า: สัดส่วน branded ลดจาก 99%)
3. **Export ใหม่ทุกเดือน** เก็บเป็น snapshot เทียบ trend
4. **หน้าที่ต้องจับตา:** technical-seo-guide (pos 27→?), schema-markup (11→?), /en/ai-consulting/ (ใหม่→?), geo hub

**เกณฑ์ตัดสินใจรอบหน้า:** ถ้า 4 สัปดาห์แล้ว technical-seo-guide + schema-markup ยังไม่ขยับเข้าหน้า 1 → ทบทวน on-page depth เพิ่ม ถ้าขยับ → scale content cluster ต่อ
