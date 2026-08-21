# TOM Gaming TH YouTube Research Workflow

เอกสารนี้แปลงแผนจาก `TOM_Gaming_TH_plan.md` ให้เป็น workflow ที่รันได้จริงสำหรับช่อง TOM Gaming TH โดยโฟกัสการหาไอเดียจาก metadata เท่านั้น ไม่ scrape และไม่ดาวน์โหลดวิดีโอคนอื่น

## วิเคราะห์สั้น ๆ

ช่องยังอยู่ช่วงเริ่มต้น จึงควรวัด “การค้นพบผู้ชมใหม่” ก่อนรายได้ RPM ตัวเลขที่ควรดูตอนนี้คือวิว 24-48 ชั่วโมงแรก, CTR, retention, จำนวนซับต่อคลิป และคอมเมนต์ ไม่ใช่รายได้ต่อพันวิว

แนวที่ปลอดภัยที่สุดคือถ่าย gameplay เอง แล้วใช้ข้อมูลจาก YouTube เป็นตัวบอกว่า title angle, เกม, update, challenge หรือ Shorts format ไหนกำลังมีแรงในไทย เครื่องมือที่เพิ่มไว้จะช่วยดึงชื่อคลิป วิว ไลก์ คอมเมนต์ แท็ก license และ URL ผ่าน YouTube Data API v3 อย่างเป็นทางการ

## ไฟล์ที่เพิ่ม

- `tools/tom_gaming_idea_finder.py` - สคริปต์ค้นหาคลิป Roblox/Gaming ยอดนิยมในไทยจาก YouTube Data API v3
- `docs/tom-gaming-th-youtube-research.md` - คู่มือและแผนปฏิบัติการฉบับนี้

## สิ่งที่สคริปต์ทำ

- ค้นหาตาม keyword เช่น `Roblox ไทย`, `Dandy's World ไทย`, `Roblox Shorts ไทย`
- ตั้งค่า `regionCode=TH` และ `relevanceLanguage=th`
- กรองช่วงเวลาย้อนหลัง เช่น 7, 14, 30 วัน
- เลือกกรองเฉพาะ Creative Commons ได้ด้วย `--creative-commons`
- ดึง metadata เพิ่มด้วย `videos.list` ได้แก่ วิว ไลก์ คอมเมนต์ tag, duration และ license
- คำนวณ `engagement_rate_pct`, `views_per_day` และ `opportunity_score`
- export CSV ด้วย pandas ถ้ามีติดตั้ง ถ้าไม่มีจะใช้ CSV writer มาตรฐานของ Python

## สิ่งที่สคริปต์ไม่ทำ

- ไม่ดาวน์โหลดไฟล์วิดีโอ
- ไม่ scrape หน้าเว็บ YouTube
- ไม่ช่วยก็อปหรือตัดต่อคอนเทนต์ของช่องอื่น
- ไม่รับประกันว่า Creative Commons ทุกคลิป “ควรใช้ซ้ำ” โดยไม่ตรวจเงื่อนไขเพิ่ม

## วิธีตั้งค่า

1. ไปที่ Google Cloud Console
2. เปิดใช้ YouTube Data API v3
3. สร้าง API key
4. ตั้งค่า key ในเครื่อง:

```bash
export YOUTUBE_API_KEY="YOUR_YOUTUBE_DATA_API_KEY"
```

## ตัวอย่างการรัน

ค้นหาไอเดีย Roblox/Dandy's World ในไทยย้อนหลัง 30 วัน:

```bash
python3 tools/tom_gaming_idea_finder.py \
  --keywords "Roblox ไทย" "Dandy's World ไทย" "Roblox Dandy's World" \
  --days 30 \
  --max-results 25 \
  --output tom-gaming-output/ideas-30d.csv
```

หาเฉพาะคลิปใหม่มากใน 7 วัน เพื่อจับกระแสเร็ว:

```bash
python3 tools/tom_gaming_idea_finder.py \
  --keywords "Roblox ไทย" "Dandy's World ไทย" \
  --days 7 \
  --sort views_per_day \
  --output tom-gaming-output/ideas-7d.csv
```

หาเฉพาะ Creative Commons เพื่อดูตัวอย่างฟุตเทจที่อาจอนุญาตให้ reuse:

```bash
python3 tools/tom_gaming_idea_finder.py \
  --keywords "Roblox gameplay ไทย" \
  --creative-commons \
  --days 90 \
  --output tom-gaming-output/creative-commons.csv
```

## วิธีอ่าน CSV

- `views` - คลิปใหญ่แค่ไหนโดยรวม
- `views_per_day` - คลิปใหม่ที่แรงจริง มักเหมาะกับการรีบทำเวอร์ชันของเรา
- `engagement_rate_pct` - สัญญาณว่าคนดูมีปฏิสัมพันธ์มากแค่ไหน
- `title_signals` - pattern คร่าว ๆ เช่น update, tutorial, challenge, secret, shorts
- `matched_keywords` - keyword ที่ทำให้เจอคลิปนั้น
- `tags` - ใช้หา cluster ของคำ ไม่ใช่เอาไปยัดทั้งหมด
- `license` - `creativeCommon` หรือ `youtube`

## แผนลงมือทำ 14 วัน

วันละ 20-30 นาที:

1. รันสคริปต์ด้วย keyword หลัก 3-5 คำ
2. เปิด CSV แล้วเลือก 5 คลิปที่ `views_per_day` สูงสุด
3. จด pattern ของชื่อคลิป เช่น update, challenge, secret, ranking, funny moment
4. แตกเป็นไอเดียที่ถ่ายเอง 3 ไอเดีย ห้ามใช้ footage คนอื่น
5. ผลิต Shorts 1-3 คลิปต่อวันจาก gameplay ของตัวเอง
6. เก็บผลหลังโพสต์ 48 ชั่วโมง: views, retention, CTR, subs gained
7. เอา top performer ไปทำคลิปยาว 3-8 นาที หรือทำ Shorts ภาคต่อ

## ตัวอย่าง title angle ที่ปลอดภัย

- “ลองเล่น Dandy's World อัปเดตใหม่ครั้งแรก”
- “ทริคเอาตัวรอดใน Roblox สำหรับมือใหม่”
- “สุ่ม challenge ใน Dandy's World แล้วเกิดเรื่อง”
- “5 จุดที่ผู้เล่นใหม่ Roblox มักพลาด”
- “คลิปสั้นจังหวะพีคจาก gameplay ของเราเอง”

## กติกาลิขสิทธิ์

ใช้สคริปต์นี้เพื่อหา insight เท่านั้น ถ้าจะใช้วิดีโอของคนอื่นจริง ๆ ต้องเช็ก license, attribution, เงื่อนไขของเจ้าของผลงาน และความเสี่ยงด้าน Content ID เพิ่มเสมอ ทางที่แข็งแรงที่สุดสำหรับช่องคือ gameplay, เสียง, reaction, edit และ thumbnail ที่ผลิตเอง

## อ้างอิง API

- YouTube Data API `search.list`: https://developers.google.com/youtube/v3/docs/search/list
- YouTube Data API `videos.list`: https://developers.google.com/youtube/v3/docs/videos/list
