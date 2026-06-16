# SEO Handoff — คู่มือการใช้งานสำหรับทีม Hashbox

ไฟล์ในโฟลเดอร์นี้คือ "เนื้อหา SEO พร้อมวาง" (paste-ready) สำหรับนำไปใส่ในโพสต์ WordPress ที่มีอยู่แล้วด้วยตนเอง — ไม่ใช่โค้ดธีม แต่ละไฟล์ตรงกับ 1 โพสต์ และจัดทำขึ้นเพื่อแก้ปัญหาที่พบใน Google Search Console (มี.ค.–มิ.ย. 2026): โพสต์ติดอันดับแต่ค้างหน้า 3-8 เพราะขาด answer block แบบตอบตรงที่ต้นบทความ และขาด FAQ ที่ลึกพอ

---

## ไฟล์ในโฟลเดอร์นี้

| ไฟล์ | โพสต์ / URL | คำค้นเป้าหมาย | สถานะ |
|------|-------------|---------------|--------|
| `technical-seo-guide.md` | /technical-seo-guide/ | "technical seo คือ" | pos 27 → ดันขึ้นหน้า 1 |
| `geo-ai-search-optimization.md` | /geo-ai-search-optimization-2026/ | "geo คือ" | pos 77, คำค้น non-brand ที่ใหญ่ที่สุด |
| `schema-markup-thai-guide.md` | /schema-markup-thai-guide-2026/ | "schema markup คือ" | pos 11, ใกล้หน้า 1 |
| `core-web-vitals-thai-guide.md` | /core-web-vitals-thai-guide-2026/ | "core web vitals คือ" | pos 55 |
| `nextjs-vs-wordpress.md` | /nextjs-vs-wordpress-2026/ | "next.js vs wordpress" | ติด ~pos 10 แต่ CTR = 0 (แก้ที่ title/desc) |

แต่ละไฟล์ (ยกเว้น Next.js) มีโครงสร้างเหมือนกัน:
`## Meta Title` → `## Meta Description` → `## คำตอบสั้น (Answer Block)` → `## FAQ`

ไฟล์ `nextjs-vs-wordpress.md` ต่างออกไป: เน้นให้ตัวเลือก meta title 3 แบบ และ meta description 3 แบบ เพื่อทดสอบเพิ่ม CTR (ปัญหาคือคนเห็นแต่ไม่คลิก ไม่ใช่อันดับ) พร้อม answer block สั้นและ FAQ น้อยกว่า

---

## วิธีนำไปใช้ในแต่ละโพสต์

### 1. Meta Title และ Meta Description
ใส่ในกล่อง Rank Math (Edit Snippet) ที่ท้ายหน้าแก้ไขโพสต์
- Meta Title — ช่อง "Title"
- Meta Description — ช่อง "Description"
- สำหรับ Next.js ให้เลือกมาอย่างละ 1 ตัวเลือกตามคำแนะนำในไฟล์ แล้วค่อยทดสอบสลับถ้า CTR ยังต่ำหลัง ~2 สัปดาห์

### 2. Answer Block (คำตอบสั้น)
**วางไว้บนสุดของโพสต์ — ทันทีหลัง H1 (หัวข้อบทความ) และก่อนย่อหน้าเกริ่นนำเดิม**
นี่คือจุดสำคัญที่สุด เพราะ answer block แบบตอบตรงคือสิ่งที่ช่วยคว้า featured snippet และทำให้ AI Overviews / ChatGPT / Perplexity หยิบไปอ้างอิง ห้ามวางกลางบทหรือท้ายบท
- คัดลอกเฉพาะเนื้อหาใต้หัวข้อ `## คำตอบสั้น (Answer Block)` (ไม่ต้องเอาหัวข้อ markdown มาด้วย ถ้าจะใส่หัวข้อให้ใช้ H2 เช่น "Technical SEO คืออะไร?")
- เก็บ bullet list และตัวหนาไว้ เพราะช่วยให้ Google และ AI parse ได้ง่าย

### 3. FAQ
นำคู่คำถาม-คำตอบไปใส่ใน **Rank Math FAQ Block** (ใน Gutenberg: เพิ่มบล็อก → ค้นหา "Rank Math FAQ")
- Rank Math FAQ block จะสร้าง FAQPage schema (JSON-LD) ให้อัตโนมัติ — ไม่ต้องเขียน schema เอง
- ใส่คำถามในช่อง title ของแต่ละรายการ และคำตอบในช่อง content
- วาง FAQ ไว้ใกล้ท้ายบทความ ก่อนส่วนสรุป/CTA

---

## หมายเหตุเรื่อง HowTo Schema (สำคัญ)

สำหรับ 2 โพสต์นี้ที่มีส่วน "ทำทีละขั้น" (step-by-step):
- `geo-ai-search-optimization.md` — มีขั้นตอนหลักการทำ GEO
- `technical-seo-guide.md` — หากบทมีส่วนขั้นตอนการ audit/ตั้งค่า

ให้เปิดใช้ **HowTo schema ใน Rank Math** สำหรับส่วนที่เป็นขั้นตอนเหล่านี้ด้วย (เพิ่มจาก FAQPage schema ที่มาจาก FAQ block) เพื่อเพิ่มโอกาสได้ rich result และให้ AI search เข้าใจลำดับขั้นตอน ตรวจสอบผลด้วย Google Rich Results Test หลังเผยแพร่ทุกครั้ง

---

## เช็กลิสต์หลังวางเนื้อหา

- [ ] Answer block อยู่บนสุดหลัง H1 แล้ว
- [ ] Meta title/description ใส่ใน Rank Math snippet แล้ว และ title ≤60 ตัวอักษร, description ≤155
- [ ] FAQ อยู่ใน Rank Math FAQ block (ไม่ใช่ list ธรรมดา)
- [ ] เปิด HowTo schema สำหรับ GEO และ Technical SEO ถ้ามีขั้นตอน
- [ ] ตรวจด้วย Rich Results Test แล้วไม่มี error
- [ ] ขอ re-index ผ่าน URL Inspection ใน Search Console
