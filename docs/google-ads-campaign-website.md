# Google Ads Campaign — รับทำเว็บไซต์ (งบ 200 บาท/วัน)

แผนแคมเปญสำหรับยิงแอดหน้า **รับทำเว็บไซต์ SEO-Ready** ด้วยงบจำกัด 200 บาท/วัน
(~6,000 บาท/เดือน) ออกแบบให้ "ยิงแคบ + ปิดให้ได้" เพราะทุกคลิกแพง

หน้า Landing สำหรับแอด: ใช้ template **`page-ads-website.php`**
สร้างหน้าใน WordPress (Pages → Add New) เลือก Template = *"Ads Landing: รับทำเว็บไซต์"*
แล้วชี้ Final URL ของทุกโฆษณามาที่ URL หน้านี้ (อย่าส่งไปหน้าแรกที่ต้องเลื่อนยาว)

---

## 1. ตั้งค่าแคมเปญ (Campaign settings)

| รายการ | ค่าที่ตั้ง | เหตุผล |
|---|---|---|
| Campaign type | **Search** เท่านั้น | งบน้อยต้องโฟกัสคน intent สูงสุด |
| Networks | **ปิด** Search Partners + ปิด Display Network | กัน traffic คุณภาพต่ำกินงบ |
| งบ/วัน | **200 บาท** | |
| Bidding | เริ่ม **Maximize Clicks + ตั้ง Max CPC cap ~30 บาท** จนได้ ~15-20 conversion แล้วค่อยสลับเป็น **Maximize Conversions / Target CPA** | งบน้อย Smart Bidding ยังไม่มี data พอตอนแรก |
| Locations | **กรุงเทพ + ปริมณฑล + หัวเมืองใหญ่** (เชียงใหม่ ภูเก็ต ชลบุรี) เลือก *"Presence: people in"* | เลี่ยงคนนอกพื้นที่/ต่างชาติคลิกฟรี |
| Languages | ไทย | |
| Ad rotation | Optimize | |
| Ad schedule | **จ–ศ 08:00–19:00** (ดูข้อ 5) | ยิงเฉพาะเวลาที่ตอบ lead ได้ทัน |

---

## 2. โครงสร้าง Ad Groups + Keywords

ใช้ **Phrase match** `"..."` และ **Exact match** `[...]` เท่านั้น
**ห้ามใช้ Broad match** เด็ดขาดกับงบเท่านี้ (จะโดนคำขยะกินงบหมดใน 2-3 วัน)

### Ad Group 1 — Core (intent สูงสุด)
```
"รับทำเว็บไซต์บริษัท"
[รับทำเว็บไซต์บริษัท]
"รับทำเว็บไซต์องค์กร"
"บริษัทรับทำเว็บไซต์"
"รับทำเว็บไซต์ ราคา"
```

### Ad Group 2 — SEO / Performance (ตรงจุดขาย)
```
"รับทำเว็บไซต์ seo"
"รับทำเว็บไซต์ติด google"
"ทำเว็บไซต์ติดหน้าแรก google"
"รับทำเว็บ seo"
```

### Ad Group 3 — Tech / Platform (CPC ถูกกว่า ปิดง่าย)
```
"รับทำเว็บไซต์ wordpress"
"รับทำเว็บ wordpress"
"รับทำเว็บไซต์ nextjs"
"รับทำเว็บ corporate"
```

### Ad Group 4 — E-commerce (ดีลใหญ่)
```
"รับทำเว็บไซต์ ขายของ"
"รับทำเว็บ ecommerce"
"รับทำเว็บไซต์ร้านค้าออนไลน์"
```

> เริ่มเปิดแค่ **Ad Group 1 + 2** ก่อน ดูว่า Group ไหนได้ lead แล้วค่อยขยาย
> งบ 200/วัน เปิด 4 กลุ่มพร้อมกันจะกระจายเกินไป data ไม่นิ่ง

---

## 3. Negative Keywords (สำคัญมาก — กันงบรั่ว)

ใส่ที่ระดับแคมเปญ:
```
ฟรี
ฟรีๆ
สอน
เรียน
คอร์ส
วิธีทำ
ทําเอง
ทำเอง
สมัครงาน
หางาน
เงินเดือน
รับสมัคร
นักศึกษา
ราคาถูก
เว็บฟรี
wix
blogger
โฮสติ้ง
hosting
จดโดเมน
แก้เว็บ
```
รัน **Search Terms Report ทุก 2-3 วันในสัปดาห์แรก** แล้วเพิ่ม negative จากคำที่ไม่เกี่ยว

---

## 4. Responsive Search Ad — Ad Copy (ภาษาไทย)

ใส่ Headlines ให้ครบ 12-15 อัน (Google สลับเอง) Descriptions 4 อัน
**Pin** headline ตัวที่มีคีย์เวิร์ดหลักไว้ตำแหน่ง 1

### Headlines (≤30 ตัวอักษร/อัน)
```
รับทำเว็บไซต์บริษัท SEO
เว็บใหม่ติด Google ใน 1-2 เดือน
การันตี Lighthouse 95+ คืนเงิน
Audit ฟรี 15-20 หน้า
ส่งมอบ Source Code 100%
ไม่ติด Vendor Lock-in
รับทำเว็บ WordPress + Next.js
Core Web Vitals เขียวทุกตัว
ทีม 17 ปี Technical SEO
เริ่ม 80,000 บาท
ขอใบเสนอราคาฟรี วันนี้
รับ Migrate ไม่เสีย Ranking
เว็บเร็ว ติดอันดับ ปิดการขาย
พร้อม AI Search Optimization
```

### Descriptions (≤90 ตัวอักษร/อัน)
```
เว็บผ่าน Technical SEO ตั้งแต่ก่อน deploy ติด Google ตั้งแต่วันเปิดตัว รับ Audit ฟรี
การันตี Lighthouse 95+ ไม่ถึงคืนเงิน ส่งมอบ source code ครบ เป็นเจ้าของ 100%
ทีมเดียวจบ Web + SEO + Performance ผลงานจริง Users +540% ขอใบเสนอราคาฟรี
รับทำเว็บบริษัท องค์กร E-commerce เริ่ม 80,000 บาท คุยฟรีทาง LINE ตอบใน 1 วัน
```

### Assets เสริม (เพิ่ม CTR ฟรี)
- **Sitelinks:** ผลงาน (/work/) · ราคาแพ็กเกจ · บริการ SEO · About
- **Callouts:** การันตีคืนเงิน · Source Code 100% · Audit ฟรี · ตอบใน 1 วัน · ไม่ Lock-in
- **Structured snippet** (Services): Landing Page, Corporate, E-commerce, Enterprise
- **Call asset:** 062-516-9868 (เปิดเฉพาะเวลาทำการ)
- **Lead form asset:** ถ้าเปิดได้ ใช้เป็นช่องสำรอง

---

## 5. Ad Schedule — ยิงเฉพาะเวลาที่ตอบได้

งบ 200/วัน lead ทุกตัวมีค่า ตอบช้า = เสีย lead ที่จ่ายเงินซื้อ
ตั้งให้แอดวิ่งเฉพาะ **จ–ศ 08:00–19:00** (ปิดเสาร์-อาทิตย์ช่วงทดสอบ)
เมื่อมี data ค่อยดูว่าช่วงเวลาไหน conversion ดีแล้ว bid adjustment เพิ่ม

---

## 6. Conversion Tracking — ต้องตั้งก่อนยิง

หน้า `page-ads-website.php` ยิง event ให้อัตโนมัติแล้ว เหลือแค่เชื่อมปลายทาง:

**ถ้าใช้ Google Ads gtag ตรง:**
1. Google Ads → Goals → Conversions → สร้าง action ชนิด **"Submit lead form"**
2. เอา **Conversion ID** (`AW-XXXXXXXXXX`) กับ **Label** ไปใส่ในหัวไฟล์ `page-ads-website.php`
   ที่ตัวแปร `$ga_ads_conversion_id` และ `$ga_ads_lead_label`
3. หน้าจะยิง conversion เมื่อฟอร์มส่งสำเร็จ (กลับมาที่ `?contact=sent`)

**ถ้าใช้ Google Tag Manager (แนะนำ):**
- หน้ายิง `dataLayer` event เหล่านี้อยู่แล้ว ไม่ต้องแก้โค้ด:
  - `generate_lead` — ส่งฟอร์ม Audit สำเร็จ (conversion หลัก)
  - `lead_contact` (method: `line` / `tel`) — คลิก LINE OA หรือกดโทร (micro-conversion)
- ใน GTM สร้าง trigger จาก Custom Event เหล่านี้ → ผูกกับ Google Ads Conversion tag

> นับ `generate_lead` เป็น conversion หลัก, ตั้ง `lead_contact` เป็น secondary
> เพื่อให้ Smart Bidding เรียนรู้จาก lead จริง

---

## 7. ประมาณการผล (งบ 6,000/เดือน)

| ตัวชี้วัด | ช่วงที่คาด |
|---|---|
| CPC เฉลี่ย | 20–28 บาท |
| คลิก/เดือน | 220–300 |
| Conversion rate (มี Audit ฟรีช่วย) | 4–6% |
| **Leads/เดือน** | **10–18** |
| Qualified (~40%) | 4–7 |
| ปิดได้ (~20%) | **2–3 ดีล** |
| รายได้ (ดีลเฉลี่ย 150K) | **300,000–450,000 บาท** |

ตัวแปรชี้เป็นชี้ตายไม่ใช่ขนาดงบ แต่คือ **(1) conversion rate ของหน้า + (2) ความเร็วตอบ lead**

---

## 8. Checklist ก่อนกด Publish

- [ ] สร้างหน้าใน WP ด้วย template "Ads Landing: รับทำเว็บไซต์" + จด URL
- [ ] ตั้ง Conversion action ใน Google Ads / GTM และทดสอบยิงจริง 1 ครั้ง
- [ ] ปิด Search Partners + Display
- [ ] ใส่ Negative keywords ครบ
- [ ] Match type เป็น Phrase/Exact เท่านั้น
- [ ] ตั้ง Ad schedule จ–ศ 08:00–19:00
- [ ] ตั้ง Max CPC cap ~30 บาท
- [ ] เชื่อมฟอร์ม + LINE OA เข้า notify ทีม (ตอบใน <1 ชม.)

## 9. รูทีนสัปดาห์แรก (optimize)
- **ทุกวัน:** เช็ก Search Terms Report → เพิ่ม negative keyword คำที่ไม่เกี่ยว
- **วันที่ 3-4:** ตัดคีย์เวิร์ดที่ได้คลิกแต่ไม่มี conversion และ CPC แพง
- **วันที่ 7:** เทงบไป Ad Group / คีย์เวิร์ดที่ได้ lead จริง
- **เมื่อครบ ~15-20 conversion:** สลับ bidding เป็น Maximize Conversions / Target CPA
