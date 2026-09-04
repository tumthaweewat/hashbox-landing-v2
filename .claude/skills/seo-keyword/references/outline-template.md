# Outline Template — ใช้กับทุกบทความ

ฟอร์แมตนี้ตรงกับ workflow ใน `seo-handoff/_README.md` — ได้ outline มาแล้ววางลง WordPress + Rank Math ได้ทันที

---

## [ชื่อบทความ]

**Primary keyword:** `...`
**Cluster keywords:** `...`, `...`, `...` (ใช้เป็น H2/H3 และ FAQ)
**Intent:** informational / how-to / comparison — พร้อมหลักฐานจาก SERP
**Hub:** เป็น hub เอง / spoke ของ `...`
**URL:** `/...-2026/`
**Word count:** 1,400–2,200
**Service page ปลายทาง:** `/services/.../`
**Unfair advantage:** first-party asset ที่จะใช้ + จะใส่ตรงไหนของบทความ

### Meta Title
`...` (≤60 ตัวอักษร — ต้องมี primary keyword และตัวเลข/ปี ถ้าใส่ได้)

### Meta Description
`...` (≤155 ตัวอักษร — ตอบ + บอกว่าจะได้อะไร ไม่ใช่แค่เกริ่น)

### Answer Block
2–4 ประโยค ตอบ primary keyword ให้จบใน 50–60 คำ
**วางใต้ H1 ทันที ก่อนย่อหน้าเกริ่นนำ** — นี่คือส่วนที่คว้า featured snippet และถูก AI หยิบไป cite

### Outline
1. **H2:** ... (เขียนเป็นคำถามที่คนค้นจริง ไม่ใช่หัวข้อสวย ๆ)
   - H3: ...
2. **H2:** ...
3. **H2:** ... ← จุดที่ใส่ตาราง/ตัวเลข
...
N. **H2:** FAQ

> ต้องมีอย่างน้อย: definition แบบ "X คือ ..." 1 จุด · ตัวเลข+แหล่งอ้างอิง 2 จุด · ตารางหรือ list 1 อัน

### FAQ (4–6 ข้อ → Rank Math FAQ block)
มาจาก PAA จริง + cluster keyword ที่เหลือ แต่ละข้อตอบสั้น ๆ จบในตัว

**Q:** ...
**A:** ...

### Schema
Article + Person (Tum Thaweewat) + FAQPage — เพิ่ม HowTo ถ้ามีส่วน step-by-step

### Internal links
- **OUT →** hub, spoke ข้างเคียง, service page ปลายทาง (anchor text = keyword จริง ห้าม "คลิกที่นี่")
- **IN ←** ระบุหน้าที่ต้องกลับไปแก้ให้ลิงก์มาหาบทความนี้

### เช็กลิสต์ก่อน publish
- [ ] Answer block อยู่ใต้ H1 แล้ว
- [ ] Meta title ≤60 / description ≤155 ใส่ใน Rank Math snippet แล้ว
- [ ] FAQ อยู่ใน Rank Math FAQ block (ไม่ใช่ list ธรรมดา)
- [ ] ตรวจด้วย Rich Results Test ไม่มี error
- [ ] internal link ออก ≥3 · แก้หน้าที่ต้องลิงก์เข้ามาแล้ว
- [ ] ขอ re-index ผ่าน URL Inspection ใน Search Console
- [ ] อัปเดต `seo-handoff/_inventory.md`
