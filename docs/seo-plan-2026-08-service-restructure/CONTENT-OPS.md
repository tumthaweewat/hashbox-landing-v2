# Content Operating System — Hashbox (ปรับจากข้อเสนอ Perplexity 2026-08-28)

ข้อเสนอ "Content OS" ถูกทางเรื่อง **หน้าเงินก่อน → guide → use case → evidence → informational** และ loop วัดผลรายสัปดาห์. แต่ 4 จุดขัดกับข้อมูลจริง (ownership map §6.2 ใน SEO-STRATEGY.md) — ถ้าทำตามตรง ๆ จะสร้างหน้าซ้ำ keyword ที่ติดแล้ว.

## 1. แก้ก่อนใช้ (ขัดข้อมูลจริง)

| ข้อเสนอ | ปัญหา | ทำแทน |
|---|---|---|
| P1 "หน้า รับทำ AI Solution สำหรับธุรกิจ — ดันอันดับจาก 3" | อันดับ 3 คือ **post 170** (guide) ไม่ใช่หน้าบริการ. สร้าง money page คำเดียวกัน = cannibalize หน้าที่ติดแล้ว | post 170 คง keyword; แก้ CTR (title/meta/CTA) + เพิ่ม proof. หน้าบริการถือ "ที่ปรึกษา AI สำหรับธุรกิจ" |
| P1 "หน้า รับทำ AI Automation / AI Workflow" ใหม่ | `/services/n8n-automation/` ถือ `รับทำ n8n` อยู่แล้ว — หน้าใหม่แย่ง intent | ขยาย H2 ของหน้า n8n ให้คลุม "รับทำ AI Automation / AI Workflow" (B4) |
| สัปดาห์ 3 "Publish หน้า service รับทำเว็บไซต์ SEO-Ready" | มีแล้ว `/services/website-development/` 1,542 คำ H1 "รับทำเว็บไซต์" | refresh ตาม template B2 ไม่สร้างใหม่ |
| P2 "AI Solution ราคาเท่าไร" + "เลือกบริษัทรับทำ AI อย่างไร" 2 บทความใหม่ | post 170 มี budget/timeline/vendor checklist อยู่แล้ว | เสริม 2 section นั้นใน post 170 + FAQ; ไม่แตกบทความ |
| Export Ahrefs ทุกจันทร์ | ไม่มี Ahrefs (OpenSEO credit 0) | ใช้ **Hashbox Signal + GSC** → `KEYWORD-DB.csv` ในไฟล์นี้ |
| ทีม Claude + ChatGPT + Gemini แยกหน้าที่ | คนเดียว, มี Claude Code + pipeline (md2wp.py, FAQ block, REST) อยู่แล้ว | Claude Code ทำ brief → draft → schema → publish; **Tum = Accuracy Gate** เท่านั้น |

## 2. รับมาใช้ (เพิ่มเข้า MASTER-PLAN)

| รับมา | ใส่ที่ | รายละเอียด |
|---|---|---|
| Keyword DB + Defend/Win/Build + priority score | `KEYWORD-DB.csv` (64 คำ seed แล้ว) | score = BV×4 + RankOpp×3 + AIgap×2 + Readiness (1–5 แต่ละช่อง). อัปเดตทุกศุกร์จาก Signal + GSC. เลือก 3–5 งาน/สัปดาห์จากคะแนนสูงสุด |
| Keyword Card ก่อนเขียน | `content/briefs/<slug>.md` | primary/variants, intent, top-10 SERP + ชนิด, PAA/AIO questions, คำถามจาก lead จริง, **หลักฐาน Hashbox ≥2 จุด (ไม่มี = ไม่เขียน)**, internal links + anchor, CTA เดียว |
| Publish Package 5 ชิ้น/7 วัน | W5 กติกา | หน้าเว็บ · FB/LinkedIn quote card · วิดีโอสั้น 1 คำถาม + transcript · GBP post · internal link จากหน้าเก่า 3–5 หน้า |
| Review Gate 3 ชั้น | ก่อน publish ทุกหน้า | Accuracy (Tum: claim/ราคา/process/case) → SEO (Claude: intent, links, title/meta/slug/schema, indexable) → Conversion (CTA เดียว, form/tracking ทำงาน) |
| Friday loop 4 decision | W6 | impr↑ CTR↓ → title/meta · rank 11–30 → proof+FAQ+links+refresh · rank 1–10 lead↓ → CTA/offer · AIO มีแต่ไม่ mention → direct answer+evidence+external validation · 0 impr หลัง 6–8 สัปดาห์ → index/cannibal/links/intent |
| Use-case pages | W5 (ใหม่ C8) | 3 หน้าใต้ ai-consulting เฉพาะที่มี flow จริง: AI Agent คัดกรอง lead + CRM · RAG knowledge base · LINE support bot (post 69 เป็นฐาน). ต้องมี diagram/screenshot จริง |
| Guide "เว็บไซต์รองรับ AI Search คืออะไร" | W5 (ใหม่ C4) | ป้อน link เข้า `/services/ai-search/` + `/services/website-development/` |
| AI Search package checklist | D4 | direct answer ต้นหน้า · นิยามชัด · ตาราง/ขั้นตอน/เกณฑ์/FAQ · NAP/ชื่อบริการตรงทุก platform · first-party evidence · date/author/reviewer · ลิงก์แหล่งภายนอก · schema ตรงเนื้อหา |
| KPI รายสัปดาห์ | W6.6 | Top3/10/30 count · impr/click/CTR · organic lead / qualified / booked · AI mention share ต่อ engine · หน้าใหม่ index / refresh / links เพิ่ม |

## 3. Cadence 30 วันแรก (รวมกับ W1–W2 ที่มีอยู่)

| สัปดาห์ | งาน |
|---|---|
| 1 | W1 restructure ทั้งชุด (A1–A7) + D1–D3 + F1–F2 + B1. ตั้ง KEYWORD-DB ✅ (ไฟล์นี้). ตรวจ CTA/form/tracking ทุกหน้าบริการ |
| 2 | B2 B3 B4 B6 template + D4–D6. post 170 เสริม section ราคา/เลือก vendor. Keyword Card สำหรับ C1 |
| 3 | C1 `/services/ai-search/` + guide "เว็บไซต์รองรับ AI Search คืออะไร" + use-case แรก (LINE support จาก post 69). Publish Package ครบ 5 ชิ้น |
| 4 | Refresh Win group (8 คำ อันดับ 11–30: EN cluster 4, ที่ปรึกษา ai ไทย, local seo ×2, technical seo คือ). ตรวจ cannibal TH/EN. Friday loop ครั้งแรกเทียบ baseline. เลือก 5 action เดือนถัดไป |

## 4. Keyword DB (snapshot 2026-08-28 — เรียงตาม score)

Defend 4 · Win 8 · Build 52. ไฟล์จริง: `KEYWORD-DB.csv`

| # | score | group | keyword | rank | landing | SERP owner | action | ws |
|---|---|---|---|---|---|---|---|---|
| 1 | 49 | Win | ai consulting bangkok | 14 | `/en/ai-consulting/` | map 100% | B5 answer-first list + GBP | B5 |
| 2 | 49 | Win | ai consulting companies bangkok | 16 | `/en/ai-consulting/` | map 100% | B5 + C3 listicle | C3 |
| 3 | 49 | Win | ai consultant bangkok | 18 | `/en/ai-consulting/` | map 100% | B5 + GBP | B5 |
| 4 | 49 | Win | ai consulting companies thailand | 23 | `/en/ai-consulting/` | map 100% | C3 listicle (AIO 25 sources, none us) | C3 |
| 5 | 45 | Defend | บริการให้คำปรึกษา ai solution | 9 | `/ai-solution-consulting-guide-2026/` | organic | H2 variant on post 170 + link from service page | B3 |
| 6 | 45 | Win | ที่ปรึกษา ai ไทย | 14 | `/services/ai-consulting/` | organic | refresh service page template (B3) + footer/nav links | B3 |
| 7 | 44 | Build | รับทำ seo technical audit | 31 | `/seo-audit/` | - | sitemap + title 'รับทำ Technical SEO Audit' | A7 |
| 8 | 43 | Build | รับทำ n8n | - | `/services/n8n-automation/` | - | B4 + footer + A6 links from post 196 | B4 |
| 9 | 43 | Build | ai consulting thailand | - | `/en/ai-consulting/` | map 33% | B5 H2 exact + C3 | B5 |
| 10 | 43 | Build | ai solutions bangkok | - | `/en/ai-consulting/` | map 50% | B5 + C3 (AIO 17 sources) | C3 |
| 11 | 42 | Defend | ปรึกษาทำระบบ ai solution | 3 | `/ai-solution-consulting-guide-2026/` | video 67% | CTR fix title/meta + proof + CTA | F1 |
| 12 | 42 | Defend | ปรึกษาทำระบบ ai solution สำหรับธุรกิจ | 3 | `/ai-solution-consulting-guide-2026/` | video 67% | CTR fix (same page) | F1 |
| 13 | 41 | Win | local seo bangkok | 13 | `/local-seo-bangkok-b2b-2026/` | - | post 92 answer-first + Local SEO section on /services/seo/ | A7 |
| 14 | 41 | Build | รับทำ seo audit | 49 | `/seo-audit/` | - | same as above | A7 |
| 15 | 41 | Build | รับทำ ai search | - | `/services/ai-search/ (new)` | - | C1 new money page | C1 |
| 16 | 41 | Build | ที่ปรึกษา ai สำหรับธุรกิจ | - | `/services/ai-consulting/` | video 75% | B3 H1 exact + video | B3 |
| 17 | 41 | Build | รับทำเว็บไซต์ seo | - | `/services/website-development/` | - | B2 H1 'รับทำเว็บไซต์ SEO-Ready…' | B2 |
| 18 | 39 | Build | รับทำเว็บไซต์ ราคา | - | `C5 post (new)` | - | C5 pricing guide + FAQ '35,900' in FAQPage | C5 |
| 19 | 39 | Build | line chatbot ราคา | - | `post 69` | - | post 69 has 60,000 price — add FAQ 'ราคา' + title | F2 |
| 20 | 38 | Build | รับทำเว็บไซต์ บริษัท | - | `/services/website-development/` | - | B2 H2 variant + GBP | B2 |
| 21 | 37 | Build | ai seo | - | `/services/ai-search/ (new)` | - | C1 | C1 |
| 22 | 37 | Build | geo agency | - | `/services/ai-search/ (new)` | - | C1 | C1 |
| 23 | 37 | Build | บริการ n8n | - | `/services/n8n-automation/` | video 100% | B4 H2 variant + footer link + video | B4 |
| 24 | 37 | Build | ปรึกษา ai transformation | - | `post 220` | video 67% | post 220 CTA + B3 bullet | A6 |
| 25 | 37 | Build | ผู้ให้บริการโซลูชัน ai | - | `/services/ai-consulting/` | - | B3 H2 variant | B3 |
| 26 | 37 | Build | รับทำ ai prototype | - | `post 224` | video 67% | post 224 CTA + B3 bullet + video | A6 |
| 27 | 37 | Build | รับทำ ai tool | - | `post 224` | video 100% | same + video | E2 |
| 28 | 37 | Build | รับทำ seo | - | `/services/seo/` | map 100% | B1 template + footer + GBP; head term | B1 |
| 29 | 37 | Build | รับวางระบบ n8n | - | `/services/n8n-automation/` | video 100% | B4 H2 + video | B4 |
| 30 | 37 | Build | ให้คำปรึกษา ai | - | `/services/ai-consulting/` | video 100% | B3 H2 variant + video | B3 |
| 31 | 37 | Build | ai services bangkok | - | `/en/ai-consulting/` | - | B5 H2 variant | B5 |
| 32 | 37 | Build | geo คือ | - | `/geo-ai-search-optimization-2026/` | - | post 66 answer-first + CTA → C1 (156 impr/mo biggest non-brand) | A6 |
| 33 | 37 | Build | geo คืออะไร | - | `/geo-ai-search-optimization-2026/` | - | same | A6 |
| 34 | 37 | Build | geo seo | - | `/services/ai-search/ (new)` | video 75% | C1 + video | C1 |
| 35 | 36 | Build | บริการ rag | - | `/ai-agent-rag-chatbot-thailand-2026/` | video 100% | use-case page RAG + link from ai-consulting | C8 |
| 36 | 36 | Build | ai solution provider | - | `/en/ai-consulting/` | - | B5 + C3 (AIO 16 sources) | C3 |
| 37 | 35 | Build | ai optimization services bangkok | 80 | `/en/ai-consulting/` | - | /services/ai-search/ EN section or /en/ai-search/ | C1 |
| 38 | 35 | Build | รับทำเว็บไซต์ | - | `/services/website-development/` | map 100% | B2 template + GBP; head term — no top-10 promise | B2 |
| 39 | 35 | Build | รับทำเว็บไซต์ ติดหน้าแรก google | - | `/services/website-development/` | - | B2 H2 variant | B2 |
| 40 | 35 | Build | รับทำเว็บไซต์ wordpress | - | `/services/website-development/wordpress/` | - | bullet from home + footer link | A1 |
| 41 | 35 | Build | รับทำ seo สายขาว | - | `/services/seo/` | - | B1 H2 'รับทำ SEO สายขาว' | B1 |
| 42 | 35 | Build | เว็บไซต์ seo ready | - | `/services/website-development/` | video 100% | B2 + video 'SEO-Ready คืออะไร' | E2 |
| 43 | 35 | Build | n8n ราคา | - | `/services/n8n-automation/` | - | B4 H2 'n8n ราคา' 29,000 + FAQ | B4 |
| 44 | 35 | Build | n8n automation ราคา | - | `/services/n8n-automation/` | - | same | B4 |
| 45 | 35 | Win | technical seo คือ | 30 | `/technical-seo-guide/` | - | same | A6 |
| 46 | 34 | Build | n8n คือ | 46 | `/n8n-thai-guide-2026/` | video 100% | refresh + video embed + link to n8n service | E2 |
| 47 | 34 | Win | local seo bkk | 30 | `/local-seo-bangkok-b2b-2026/` | - | same as above | A7 |
| 48 | 34 | Build | รับทำ ai | - | `/services/ai-consulting/` | - | B3 H2 variant | B3 |
| 49 | 32 | Build | technical seo | 49 | `/technical-seo-guide/` | - | refresh + CTA → /seo-audit/ | A6 |
| 50 | 31 | Build | n8n workflow | - | `/n8n-thai-guide-2026/` | video 100% | post 196 + video | E2 |
| 51 | 31 | Build | website development bangkok | - | `(none EN page)` | map 100% | needs /en/website-development/ — Phase 3 | P3 |
| 52 | 30 | Build | ai consulting company | - | `/en/ai-consulting/` | video 100% | B5 + C3 | C3 |
| 53 | 29 | Build | รับทำเว็บไซต์ คลินิก | - | `(none)` | - | C7 industry page ONLY if real clinic case | C7 |
| 54 | 29 | Build | รับออกแบบเว็บไซต์ | - | `/services/website-development/` | map 100% | B2 H2 variant; head term | B2 |
| 55 | 29 | Build | เว็บโหลดช้า | - | `/core-web-vitals-thai-guide-2026/` | fb 33% | post CTA → /website-audit/ | A6 |
| 56 | 28 | Build | ai consultant | - | `/en/ai-consulting/` | video 100% | B5; global term low chance | B5 |
| 57 | 27 | Build | seo agency | - | `/services/seo/` | map 100% | B1 H2 'SEO Agency' + C2 listicle | C2 |
| 58 | 26 | Build | core web vitals คือ | - | `/core-web-vitals-thai-guide-2026/` | - | refresh + CTA | A6 |
| 59 | 25 | Defend | hashbox | 5 | `/` | play.google 17% | Organization alternateName/sameAs | D3 |
| 60 | 25 | Build | seo คือ | - | `post 210 hub` | - | hub exists; CTA → /services/seo/ | A6 |
| 61 | 24 | Build | ai overview | - | `post 208` | - | post 208 CTA → ai-search | A6 |
| 62 | 24 | Build | schema markup คือ | - | `(none)` | - | C4 post 'Schema Markup คือ + ธุรกิจไทย' → /services/seo/ | C4 |
| 63 | 24 | Build | schema markup ธุรกิจไทย | - | `(none)` | - | same post | C4 |
| 64 | 19 | Build | javascript seo คือ | - | `(none)` | - | C4 candidate low priority | C4 |