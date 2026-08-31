# SOP — บันทึก LINE / โทร Lead เข้า HubSpot (Funnel V2)

เหตุผล: LINE/โทร ไม่ผูก GCLID ได้ → ถ้าไม่บันทึก แหล่ง Lead จะวัดไม่ได้และเกณฑ์ 30-click ตัดสินผิด

## ทุกครั้งที่มี Lead ทัก LINE หรือโทร
1. สร้าง/อัปเดต Contact ใน HubSpot ทันทีในวันเดียวกัน (ชื่อ + ช่องทางติดต่อ)
2. กรอก: Lead channel = LINE หรือ Phone (⚠️ property ต้องตรวจ quota HubSpot Free ก่อนสร้าง — ยังไม่สร้างจนกว่าจะเช็ค; ระหว่างนี้ใช้ Note แทน)
3. ถามและบันทึก: "เห็นเราจากช่องทางไหน" (Google / เพื่อนแนะนำ / อื่นๆ) ลงใน Note แรก
4. ใส่วันที่+เวลาแรกที่ทัก เพื่อ reconcile กับ hb_web_line_click_v1 / hb_web_phone_click_v1 ใน GA4
5. ห้าม copy บทสนทนา LINE ทั้งดุ้นลง CRM — สรุปเฉพาะโจทย์/งบ/timeline

## Reconcile รายสัปดาห์ (ใช้ในเกณฑ์ Codex)
- LINE/Phone leads (จาก CRM) ÷ outbound clicks (GA4) = conversion ของช่องทาง
- ถ้า clicks สูงแต่ lead ต่ำ → ปุ่มถูกกดแต่คนไม่ทักจริง → ทบทวนข้อความ CTA

## Phase แยก (ยังไม่ทำ): LINE OA webhook / referral mapping สำหรับ attribution ระดับบทสนทนา
