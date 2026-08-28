# Keyword Card + Content Brief — <slug>

> คัดลอกไฟล์นี้เป็น `content/briefs/<slug>.md` ก่อนเขียนทุกชิ้น. ไม่มี Evidence ≥2 จุด = ไม่เขียน.
> Pipeline: brief นี้ → Claude Code draft (3 รอบ) → `content/blog/NN-<slug>.md` → `md2wp.py` → WP Code editor → REST meta → Publish Package.

## 1. Keyword Card
| ฟิลด์ | ค่า |
|---|---|
| Primary keyword | |
| Variants TH/EN | |
| Cluster / ownership (§6.2) | ai-consulting · website · seo · ai-search · n8n — หน้าเจ้าของ keyword: `/...` (ห้ามซ้ำ) |
| Intent | transactional / commercial / informational |
| Funnel | BOFU / MOFU / TOFU |
| KEYWORD-DB score | (จาก KEYWORD-DB.csv) |
| SERP owner | map / video / organic (จาก Signal "ใครครองพื้นที่") |
| Top-5 SERP URLs + ชนิด | 1. … (service page / listicle / video / marketplace) |
| PAA / AIO questions | |
| คำถามจาก lead จริง | (form / LINE / call) |
| URL เป้าหมาย | สร้างใหม่ `/…/` หรือ refresh post NN |
| CTA เดียว | เช่น "ขอ SEO Audit ฟรี" → /seo-audit/ |

## 2. Evidence ของ Hashbox (≥2 — ห้ามแต่ง)
- [ ] process จริง: 
- [ ] stack / tool จริง: 
- [ ] ราคา/ขอบเขตจริง: 
- [ ] เคส/ตัวเลข (มี permission): 
- [ ] ข้อจำกัด / เกณฑ์รับงาน: 

## 3. Internal links (ต้องใส่)
| ปลายทาง | anchor |
|---|---|
| หน้าบริการเจ้าของ keyword | (keyword phrase) |
| hub / pillar | |
| post ที่เกี่ยว 2–3 | |
**หน้าเก่าที่ต้องเพิ่ม link มาหาชิ้นนี้ (3–5):** 

## 4. Draft — 3 รอบ (Claude Code)
- **รอบ 1** โครง: H1 · opening answer 60–90 คำตอบ intent ตรง · outline H2/H3 · ตารางตัดสินใจ 1 ตาราง · ตำแหน่ง proof / link / CTA
- **รอบ 2** เขียนทีละ H2 300–450 คำ: ตอบใน 1–2 ประโยคแรก · มุมคนลงมือทำ · `[NEEDS EVIDENCE]` ตรงที่ต้องเติมข้อมูลจริง · ห้ามสร้างเคส/ตัวเลข
- **รอบ 3** ตรวจ: ประโยค AI-sounding · claim ไร้หลักฐาน · intent ยังไม่ครบ · จุดเพิ่ม insight/link/CTA · keyword ซ้ำเกิน → เขียนใหม่เฉพาะย่อหน้าที่ต้องแก้
- กติกา: ภาษาไทย B2B ธรรมชาติ · ไม่แปลตรงจากอังกฤษ · ไม่สัญญาอันดับ · นิยาม "X คือ…" ใน 2 บรรทัดแรก · dateModified จริง

## 5. SEO deliverables (Claude Code ทำต่อจาก draft)
- Title ≤60 ตัวอักษร ×3 (มี keyword + ตัวเลข/ปี) · Meta ≤155 ×2 · slug EN สั้น · excerpt 50 คำ
- Featured-snippet answer 45–60 คำ · FAQ 4–6 (Rank Math FAQ block — schema ตรงเนื้อหา)
- Schema: Article/BlogPosting + FAQPage (post) · Service + FAQPage + Offer (service page) — ห้ามใส่ชนิดที่ไม่ตรงหน้า
- Facebook post 1 · LinkedIn post 1 · script วิดีโอ 60–90 วิ 1 · GBP post 1

## 6. Review Gate (ผ่านครบก่อน publish)
- [ ] **Accuracy (Tum):** claim / ราคา / process / tool / เคส ยืนยันแล้ว
- [ ] **SEO (Claude):** intent ครบ · internal links ครบ · title/meta/slug/schema · indexable · ไม่ cannibal (§6.2) · Rich Results Test ผ่าน
- [ ] **Conversion:** CTA เดียว · form/LINE ทำงาน · tracking ยิง

## 7. Publish Package (ภายใน 7 วัน)
- [ ] หน้าเว็บ publish + GSC request index
- [ ] internal link จากหน้าเก่า 3–5 หน้า (REST)
- [ ] Facebook / LinkedIn post (Tum)
- [ ] วิดีโอสั้น + transcript บน YouTube → embed + VideoObject (Tum ถ่าย)
- [ ] GBP post (Tum)
- [ ] เพิ่มแถวใน KEYWORD-DB.csv: status=published, landing_page

## 8. Friday loop (หลัง publish)
impr↑ CTR↓ → title/meta · rank 11–30 → proof+FAQ+links · rank 1–10 lead↓ → CTA/offer · AIO ไม่ mention → direct answer+evidence · 0 impr 6–8 สัปดาห์ → index/cannibal/intent
