# Landing Editor Spec — /website-audit/ Funnel V2 (ห้ามแก้ production จนผ่าน T+48h gate)

แก้ใน WP Editor (เนื้อหาหน้าอยู่ใน editor ไม่ใช่ repo). โค้ด (validation/JS) อยู่ใน PR feat/funnel-v2 — ต้อง deploy คู่กัน

## 1. Hero
- Positioning ใหม่ (แทน hero copy เดิม):
  - H1: "เว็บไซต์ธุรกิจพร้อมสร้าง Lead และวัดผล"
  - Sub: "เริ่มจาก Scope, Conversion Path และงบประมาณที่ชัดเจนก่อนลงทุน"
- ห้ามใช้คำ "รับประกัน Lead" — ใช้ "ลดความเสี่ยงก่อนเริ่ม" / "พร้อมวัดผล"

## 2. ลำดับ CTA (hero + sticky mobile)
1. Primary: "คุยทาง LINE เพื่อรับ Scope เบื้องต้น" → https://lin.ee/Xagx6i4 (ลิงก์ตรง ไม่มี redirect)
2. Secondary: "กรอกข้อมูลให้ทีมประเมิน" → #project-form
3. เบอร์โทรแสดงเป็นช่องทางเร่งด่วน: ลิงก์ tel: (คลาสปุ่มใดก็ได้ — JS นับ event ให้อัตโนมัติ)

## 3. Section "ราคานี้รวมอะไร" — วางก่อนฟอร์ม
ราคา: Landing Page เริ่ม ฿35,900 · Corporate/Redesign เริ่ม ฿80,000 · ประเมิน Scope ฟรี 30 นาที
รายการรวม (พูดเฉพาะของเรา ห้ามเทียบว่าคู่แข่ง "ไม่มี"):
- UX/UI และ Conversion Path
- Technical SEO
- Performance
- GA4 และ Conversion Tracking
- Scope/Timeline ที่ตกลงก่อนเริ่ม

## 4. ฟอร์ม (โครง HTML ใน editor)
- ลบ `required` ออกจาก: project_type, budget, timeline (JS+server ฝั่ง PR จัดการ enforcement ใหม่)
- คงลำดับ field เดิมได้ — JS จะจัด layout ขั้นเดียว + <details> "เพิ่มข้อมูลโปรเจกต์ (ไม่บังคับ)" เอง
