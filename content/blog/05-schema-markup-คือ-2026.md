---
title: "Schema Markup คือ? คู่มือ JSON-LD สำหรับ AI Search + Rich Results 2026"
slug: "schema-markup-thai-guide-2026"
category: "Technical SEO"
tag_color: "blue"
read_time: "9 min read"
date: "2026-06-02"
featured: true
excerpt: "Schema Markup คือมาตรฐานข้อมูลโครงสร้างที่ทำให้ Google และ AI (ChatGPT, Perplexity, AI Overviews) เข้าใจเนื้อหาเว็บ บทความอธิบาย JSON-LD, schema types สำคัญ, agentic web schema และวิธี implement"
author: "Tum Thaweewat"
---

# Schema Markup คือ? คู่มือ JSON-LD สำหรับ AI Search + Rich Results 2026

> **คำตอบสั้น:** Schema Markup คือมาตรฐานข้อมูลโครงสร้าง (structured data) ตาม schema.org ที่ช่วยให้ Google และเครื่องมือค้นหาเข้าใจเนื้อหาเว็บ ใช้รูปแบบ JSON-LD ฝังใน `<script type="application/ld+json">` Schema ทำให้เว็บมีโอกาสได้ rich results เช่น star rating, FAQ, breadcrumb, sitelinks และทำให้ AI Search (ChatGPT, Perplexity, Google AI Overviews) cite เนื้อหาได้ตรงและถูกต้อง

ในปี 2026 schema markup เปลี่ยนจาก "nice-to-have" เป็น "ต้องมี" เพราะ AI Search กำลังกินส่วนแบ่ง traffic จาก Google เดิม และ AI ต้องการ structured data เพื่อ parse, cite, และส่งผ่านข้อมูลของคุณไปยังผู้ใช้ บทความนี้อธิบาย schema ครบทุกระดับ พร้อม implementation จริง

## สารบัญ

- [Schema Markup คืออะไร?](#what)
- [JSON-LD vs Microdata vs RDFa](#format)
- [Schema สำคัญที่ควรมีในทุกเว็บ](#essential)
- [Schema สำหรับ AI Search (GEO)](#geo)
- [Schema สำหรับ Agentic Web](#agentic)
- [วิธี Implement Schema](#implement)
- [วิธี Validate Schema](#validate)
- [Anti-patterns ที่ Google เตือน](#avoid)
- [คำถามที่พบบ่อย](#faq)

## Schema Markup คืออะไร? {#what}

Schema Markup คือ vocabulary มาตรฐานที่กำหนดโดย [schema.org](https://schema.org) (โครงการร่วมของ Google, Microsoft, Yahoo, Yandex) สำหรับการอธิบาย entities (สิ่งของ, คน, สถานที่, เหตุการณ์) บนเว็บในรูปแบบที่เครื่องอ่านได้

เปรียบเทียบให้เห็นภาพ:
- **HTML ปกติ:** บอก Google ว่า "นี่คือข้อความ"
- **Schema:** บอก Google ว่า "นี่คือชื่อร้านอาหาร · address นี้ · เปิด 10:00-22:00 · rating 4.5 · ราคา ฿฿"

ผลลัพธ์: Google แสดง rich result แทน blue link ธรรมดา = CTR เพิ่ม 20-40%

## JSON-LD vs Microdata vs RDFa {#format}

มี 3 format แต่ **Google แนะนำ JSON-LD** ตั้งแต่ปี 2015 และยังคงเป็น standard:

| Format | ข้อดี | ข้อเสีย |
|---|---|---|
| **JSON-LD** | แยกจาก HTML, ดูแลง่าย, Google แนะนำ | ต้อง render ตอน build/server |
| Microdata | ฝังใน HTML | ปนกับ markup, แก้ยาก |
| RDFa | semantic เต็ม | verbose, ไม่ค่อยใช้แล้ว |

**ตัวอย่าง JSON-LD:**

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Hashbox Studio",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "139 Pan Rd",
    "addressLocality": "Bangkok",
    "postalCode": "10500",
    "addressCountry": "TH"
  },
  "telephone": "+66-62-516-9868"
}
</script>
```

## Schema สำคัญที่ควรมีในทุกเว็บ {#essential}

ขั้นต่ำที่เว็บธุรกิจในไทยควรมี — แต่ละ type มีประโยชน์ต่าง:

### 1. Organization / LocalBusiness
ระบุตัวตนธุรกิจ + ที่อยู่ + contact ส่ง entity signal เข้า Google Knowledge Graph

### 2. WebSite + SearchAction
เปิด sitelinks search box ใน SERP

### 3. BreadcrumbList
แสดง breadcrumb ใน SERP แทน URL ยาว ๆ

### 4. Article / BlogPosting
สำหรับ blog post พร้อม `author` (Person), `datePublished`, `dateModified`

### 5. Service
สำหรับหน้าบริการ + `offers` (PriceSpecification) + `areaServed`

### 6. FAQPage + Speakable
สำคัญมากใน 2026: ทำให้ section คำถาม-คำตอบถูก cite ใน AI answer

### 7. Product (สำหรับ e-commerce)
ราคา, stock, review, rating

### 8. HowTo
สำหรับ guide แบบ step-by-step

## Schema สำหรับ AI Search (GEO) {#geo}

ในปี 2026 AI Search (ChatGPT, Claude, Perplexity, Google AI Overviews) ใช้ schema เพื่อ:

1. **Parse content** เร็วและตรง
2. **Cite source** เมื่อตอบคำถาม (เพิ่ม "Highly Cited" badge)
3. **Disambiguate entity** (ระบุว่า "Hashbox" คือบริษัทไหน ไม่ใช่อย่างอื่น)
4. **Rank as "Preferred Source"** ใน AI Overviews

### Speakable Schema (สำคัญสำหรับ Voice + AI)

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "speakable": {
    "@type": "SpeakableSpecification",
    "cssSelector": [".faq-question", ".faq-answer"]
  },
  "mainEntity": [...]
}
```

Speakable บอก AI ว่าส่วนไหนของหน้า "เหมาะให้อ่าน" (citation-ready) AI Overviews + voice assistant ใช้ตรงนี้

### Entity-First SEO + sameAs

เชื่อม entity ของคุณกับ Knowledge Graph ผ่าน `sameAs`:

```json
{
  "@type": "Organization",
  "name": "Hashbox Studio",
  "sameAs": [
    "https://www.linkedin.com/company/hashbox-studio",
    "https://www.facebook.com/hashboxstudio",
    "https://www.wikidata.org/wiki/Q123456789",
    "https://www.crunchbase.com/organization/hashbox-studio"
  ]
}
```

ยิ่ง `sameAs` ครอบคลุม + ลิงก์ไปแหล่ง authoritative มาก → AI มั่นใจในตัวตน entity มากขึ้น → cite บ่อยขึ้น

## Schema สำหรับ Agentic Web {#agentic}

trend ใหม่ปี 2026: **AI agents กำลังจะ execute action บนเว็บแทนผู้ใช้** (จองโรงแรม, ซื้อของ, ติดต่อบริการ) Schema ต้อง support agent ด้วย:

### potentialAction

```json
{
  "@type": "Service",
  "name": "SEO-Ready Website Build",
  "potentialAction": {
    "@type": "ContactAction",
    "target": "https://hashbox.co.th/#contact",
    "name": "Request Free SEO Audit"
  }
}
```

### Offer + PriceSpecification

ทำให้ agent compare ราคาได้ตรง:

```json
{
  "@type": "Offer",
  "price": "80000",
  "priceCurrency": "THB",
  "priceSpecification": {
    "@type": "PriceSpecification",
    "price": "80000",
    "priceCurrency": "THB",
    "valueAddedTaxIncluded": false
  },
  "availability": "https://schema.org/InStock",
  "areaServed": "TH"
}
```

### Reservation / Booking schema (สำหรับ booking flow)

ทำให้ agent จองได้โดยตรงผ่าน schema endpoint ในอนาคต

## วิธี Implement Schema {#implement}

### ทาง 1: เขียน JSON-LD เอง

ใส่ใน `<head>` หรือ `<body>`:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Schema Markup คือ?",
  "author": {
    "@type": "Person",
    "name": "Tum Thaweewat",
    "url": "https://hashbox.co.th/about/"
  },
  "datePublished": "2026-06-02",
  "publisher": {
    "@type": "Organization",
    "name": "Hashbox Studio"
  }
}
</script>
```

### ทาง 2: ใช้ WordPress Plugin

- **Rank Math** (แนะนำ) — schema auto-detect ตาม post type
- **Yoast SEO** — schema graph สมบูรณ์
- **Schema Pro** — custom schema builder

### ทาง 3: ใช้ Helper Function ใน Theme

WordPress theme สามารถ register helper function:

```php
function my_jsonld( $data ) {
    echo '<script type="application/ld+json">' .
         wp_json_encode( $data, JSON_UNESCAPED_UNICODE ) .
         '</script>';
}
```

แล้วเรียกใช้ตามหน้า:

```php
my_jsonld( array(
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => 'SEO Service',
) );
```

### ทาง 4: Headless / Next.js

ใช้ `next/script` หรือฝัง JSON-LD ใน `<Head>` ผ่าน Next.js Script component ตาม Next.js documentation เพื่อให้ schema render server-side

## วิธี Validate Schema {#validate}

ก่อน deploy ต้องผ่านทั้ง 2 ตัว:

### 1. Schema.org Validator
[validator.schema.org](https://validator.schema.org) — ตรวจ syntax + structure ของ schema.org

### 2. Google Rich Results Test
[search.google.com/test/rich-results](https://search.google.com/test/rich-results) — ตรวจว่า Google ใช้ schema ของคุณได้จริงไหม + eligible สำหรับ rich result ตัวไหน

### 3. Search Console > Enhancements
หลัง deploy 2-4 สัปดาห์ Google จะรายงาน rich result performance + warnings ใน GSC

## Anti-patterns ที่ Google เตือน {#avoid}

จาก [Google Structured Data Guidelines](https://developers.google.com/search/docs/appearance/structured-data/sd-policies):

1. **Schema ที่ไม่ตรงกับเนื้อหาบนหน้า** = manual penalty (เช่น มี Review schema แต่ไม่มี review แสดงให้ user เห็น)
2. **Fake review / aggregateRating ปลอม** = ban
3. **Schema ใน hidden div ที่ user เห็นไม่ได้** = ไม่นับ
4. **Markup สำหรับเนื้อหาที่ไม่ใช่ของคุณ** (เช่น scrape product reviews ของคนอื่น)
5. **Misleading content** เช่น Event schema สำหรับสิ่งที่ไม่ใช่ event
6. **Spam @type** ใส่หลาย type เพื่อ gaming

## Schema กับ Ranking — ความเข้าใจที่ถูกต้อง

Schema **ไม่ใช่ ranking factor โดยตรง** ตาม Google เอง [(SEO Starter Guide)](https://developers.google.com/search/docs/fundamentals/seo-starter-guide?hl=th) แต่ส่งผลทางอ้อม:

- **เพิ่ม CTR** จาก rich result ใน SERP
- **ทำให้ Google เข้าใจเนื้อหาได้ตรง** → match query ดีขึ้น
- **เปิดโอกาส AI citation** ใน ChatGPT, Perplexity, AI Overviews
- **ช่วย entity disambiguation** ผ่าน Knowledge Graph

ดังนั้น schema ดี ≠ rank ดีอัตโนมัติ แต่ schema แย่ = พลาดโอกาส visibility ใหญ่

## ทำเว็บใหม่พร้อม Schema ครบจาก Build แรก

การ retrofit schema ลงเว็บที่มีอยู่แล้วใช้เวลานานและบางครั้งต้องแก้ HTML structure ทางที่ดีคือ build เว็บใหม่ที่มี schema graph ครบตั้งแต่ deploy ครั้งแรก ครอบคลุม:

- Organization + LocalBusiness + WebSite (sitewide)
- BreadcrumbList (ทุกหน้า)
- Service + Offer (หน้าบริการ)
- Article + Person (blog post)
- FAQPage + Speakable (FAQ section)
- HowTo (guide)
- Product + Review (e-commerce)

ที่ Hashbox เราใช้ [บริการรับทำเว็บไซต์ SEO-Ready](/services/seo-ready-website/) ที่ install schema 8+ types ครบในทุกโปรเจกต์ validate ผ่าน Schema.org + Google Rich Results Test เป็นส่วนหนึ่งของ Build Gate ก่อน deploy

ดูเพิ่ม:
- [Technical SEO คือ? คู่มือ 2026](/technical-seo-guide/)
- [Core Web Vitals คือ? LCP, INP, CLS Guide](/core-web-vitals-thai-guide-2026/)
- [GEO คืออะไร? Generative Engine Optimization](/geo-ai-search-optimization-2026/)

## คำถามที่พบบ่อย {#faq}

### Schema Markup ทำให้ rank ขึ้นไหม?
ไม่ใช่ ranking factor โดยตรง แต่ส่งผลทางอ้อมผ่าน rich result (CTR เพิ่ม), AI citation, และ entity understanding เว็บที่มี schema มักได้ traffic มากกว่าเว็บที่ไม่มี ในระดับ keyword เดียวกัน

### JSON-LD vs Microdata ใช้ตัวไหนดี?
Google แนะนำ **JSON-LD** ตั้งแต่ปี 2015 เพราะแยกจาก HTML ดูแลง่ายและไม่ต้องแก้ template ใช้ JSON-LD ทุกเคส ยกเว้นเคสที่ legacy system ไม่ support

### มี schema กี่ types ที่ควรใส่?
ขั้นต่ำ: Organization + WebSite + BreadcrumbList (3 ตัว) ขั้นมาตรฐาน: + Service + Article + FAQPage (6 ตัว) ขั้น advanced: + HowTo + Product + Review + Speakable + Person + LocalBusiness + Offer (12+ ตัว)

### Schema ทำให้เว็บโหลดช้าลงไหม?
JSON-LD อยู่ใน `<script>` ที่ browser parse แยก ไม่ block rendering ขนาดเฉลี่ย 500-3000 bytes/หน้า ไม่กระทบ Core Web Vitals

### AI Search (ChatGPT, Perplexity) ดู schema เหมือน Google ไหม?
ใช้ schema เหมือนกันแต่ระดับการใช้ต่าง Perplexity + Bing Copilot ใช้ schema เต็มที่ ChatGPT browsing + Google AI Mode ใช้ผสม schema + semantic understanding Speakable schema สำคัญมากสำหรับ voice + AI answer

### Schema generator ใช้ตัวไหนดี?
- [Merkle Schema Markup Generator](https://technicalseo.com/tools/schema-markup-generator/) — visual builder
- [Schema App](https://www.schemaapp.com/) — enterprise
- Plugin Rank Math / Yoast (WordPress)
- หรือเขียนเอง (แนะนำสำหรับ developer)

### ทำ schema เองได้ไหม หรือต้องจ้างมือโปร?
เขียนเองได้ ใช้ schema generator + validate ผ่าน Google Rich Results Test แต่สำหรับ schema graph ขนาดใหญ่ (10+ types, cross-reference @id) + agentic web schema แนะนำให้ทีม technical SEO ทำ

### ราคาทำ Schema เท่าไหร่?
- DIY: 0 บาท
- Plugin: 1,000-5,000 บาท/ปี
- จ้าง freelance ติดตั้ง: 5,000-20,000 บาท/เว็บ
- รวมในบริการ [SEO-Ready Website](/services/seo-ready-website/) — เริ่ม 80,000 บาท (schema 8+ types ครบ)

---

**สรุป:** Schema Markup คือ structured data ตาม schema.org รูปแบบ JSON-LD ที่ทำให้ Google + AI Search เข้าใจเนื้อหาเว็บได้ตรง ในปี 2026 schema ไม่ใช่ ranking factor โดยตรงแต่จำเป็นต่อ rich results, AI citation, และ entity authority schema สำคัญที่ทุกเว็บควรมี: Organization, BreadcrumbList, FAQPage + Speakable, Service + Offer, Article + Person สำหรับ trend ปี 2026 ต้องรวม Agentic Web schema (potentialAction, Offer) เพื่อรองรับ AI agents ที่จะ execute action บนเว็บแทนผู้ใช้
