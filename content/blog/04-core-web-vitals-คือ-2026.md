---
title: "Core Web Vitals คือ? คู่มือ LCP, INP, CLS สำหรับธุรกิจไทย 2026"
slug: "core-web-vitals-thai-guide-2026"
category: "Technical SEO"
tag_color: "blue"
read_time: "8 min read"
date: "2026-06-02"
featured: true
excerpt: "Core Web Vitals คือ 3 ตัวชี้วัด UX ของ Google ที่ส่งผลต่อ ranking โดยตรง คู่มือฉบับเข้าใจง่าย พร้อมวิธี optimize LCP, INP, CLS สำหรับเว็บ WordPress และ Next.js"
author: "Tum Thaweewat"
---

# Core Web Vitals คือ? คู่มือ LCP, INP, CLS สำหรับธุรกิจไทย 2026

> **คำตอบสั้น:** Core Web Vitals คือชุด 3 ตัวชี้วัดประสบการณ์ผู้ใช้ของ Google ประกอบด้วย LCP (Largest Contentful Paint), INP (Interaction to Next Paint), และ CLS (Cumulative Layout Shift) ตั้งแต่มีนาคม 2024 INP มาแทน FID อย่างเป็นทางการ Google ใช้ Core Web Vitals เป็น ranking signal โดยตรง เว็บที่ผ่านเกณฑ์เขียวทั้ง 3 ตัวมีโอกาส rank ดีกว่าเว็บที่แดง

Core Web Vitals (CWV) คือมาตรฐานที่ Google ใช้วัดว่าเว็บไซต์ของคุณให้ประสบการณ์ผู้ใช้ดีพอหรือไม่ ถ้าเว็บคุณช้า กระตุก หรือ layout ขยับเมื่อกำลังกด ปุ่ม Google จะรู้ และจะลด ranking ของเว็บคุณลง บทความนี้อธิบาย CWV ทั้ง 3 ตัวพร้อมวิธีแก้แบบที่ทำได้จริงในปี 2026

## สารบัญ

- [LCP คืออะไร?](#lcp)
- [INP คืออะไร? (มาแทน FID)](#inp)
- [CLS คืออะไร?](#cls)
- [เกณฑ์ผ่าน Core Web Vitals](#เกณฑ์)
- [วิธีวัด Core Web Vitals](#วิธีวัด)
- [วิธี Optimize LCP, INP, CLS](#optimize)
- [Core Web Vitals กับ SEO Ranking](#seo)
- [คำถามที่พบบ่อย](#faq)

## LCP คืออะไร? {#lcp}

**LCP (Largest Contentful Paint)** คือเวลาที่ใช้ในการ render เนื้อหาที่ใหญ่ที่สุดในหน้าจอแรก (above-the-fold) วัดเป็น **วินาทีตั้งแต่ user เริ่ม navigate**

LCP element มักเป็น:
- รูป hero ที่ใหญ่ที่สุด
- video poster image
- ก้อน text บล็อกใหญ่
- background image ที่ render เป็น HTML element

**เกณฑ์:**
- 🟢 ดี: < 2.5 วินาที
- 🟡 ต้องปรับ: 2.5 – 4.0 วินาที
- 🔴 แย่: > 4.0 วินาที

**สาเหตุ LCP ช้า:**
1. Server response ช้า (TTFB เกิน 800ms)
2. Render-blocking CSS/JS ใน `<head>`
3. รูป hero ไม่ preload, ไม่มี `fetchpriority="high"`
4. ใช้ font ตัวใหญ่ที่ load ช้า
5. Heavy plugin (WordPress) ที่ inject script เข้า head

## INP คืออะไร? (มาแทน FID) {#inp}

**INP (Interaction to Next Paint)** คือ ตัวชี้วัดความเร็วของการ "ตอบสนอง" — วัดเวลาตั้งแต่ user คลิก/แตะ/พิมพ์ จนถึงเมื่อหน้าจอ render การเปลี่ยนแปลงครั้งถัดไป

ตั้งแต่ **มีนาคม 2024** INP เข้ามาแทน FID (First Input Delay) อย่างเป็นทางการ เพราะ INP วัด **ทุก interaction** ตลอด session ไม่ใช่แค่ครั้งแรก สะท้อนประสบการณ์จริงดีกว่ามาก

**เกณฑ์:**
- 🟢 ดี: < 200ms
- 🟡 ต้องปรับ: 200 – 500ms
- 🔴 แย่: > 500ms

**สาเหตุ INP สูง:**
1. JavaScript handler หนัก block main thread
2. Event listener ที่ทำ DOM mutation ไม่ batch
3. React/Vue rendering tree ใหญ่เกิน
4. 3rd-party script (analytics, chat widget) block interaction
5. Forced reflow จาก inline style mutation

## CLS คืออะไร? {#cls}

**CLS (Cumulative Layout Shift)** วัด "ความเสถียร" ของ layout — element กระโดดเปลี่ยนตำแหน่งโดยที่ user ไม่ได้ทำอะไรไหม?

CLS แย่เกิดเมื่อ:
- รูปไม่มี `width`/`height` attribute → ตอนโหลดเสร็จดัน content ลง
- font swap (FOIT/FOUT) ทำ text เลื่อน
- ad/banner inject ทีหลัง
- popup/cookie banner เด้ง

**เกณฑ์:**
- 🟢 ดี: < 0.1
- 🟡 ต้องปรับ: 0.1 – 0.25
- 🔴 แย่: > 0.25

## เกณฑ์ผ่าน Core Web Vitals {#เกณฑ์}

เว็บจะ "ผ่าน" CWV เมื่อ **75% ของ session ทั้งหมด** อยู่ในเกณฑ์เขียวทั้ง 3 ตัว ข้อมูลนี้ Google เก็บจาก **CrUX (Chrome User Experience Report)** ของ user จริงทั่วโลก ไม่ใช่จาก Lighthouse lab data

| Metric | ผ่าน | ต้องปรับ | ไม่ผ่าน |
|---|---|---|---|
| LCP | < 2.5s | 2.5-4.0s | > 4.0s |
| INP | < 200ms | 200-500ms | > 500ms |
| CLS | < 0.1 | 0.1-0.25 | > 0.25 |

## วิธีวัด Core Web Vitals {#วิธีวัด}

### 1. Google Search Console
ไปที่ **Experience > Core Web Vitals** จะเห็น URL ที่ผ่าน/ไม่ผ่าน แยก Mobile/Desktop ข้อมูล field จาก user จริง 28 วันย้อนหลัง

### 2. PageSpeed Insights
[pagespeed.web.dev](https://pagespeed.web.dev) แสดงทั้ง **field data** (CrUX) และ **lab data** (Lighthouse) ใส่ URL แล้วได้รายงานทันที

### 3. Chrome DevTools
- เปิด DevTools > Performance tab
- Record session
- ดู metric ใน "Web Vitals" lane

### 4. web-vitals JavaScript library
ติด snippet ใน `<head>` วัด real user metrics ส่งเข้า GA4/Datadog

```js
import { onLCP, onINP, onCLS } from 'web-vitals';
onLCP(console.log);
onINP(console.log);
onCLS(console.log);
```

## วิธี Optimize LCP, INP, CLS {#optimize}

### เพิ่ม LCP ให้เร็วขึ้น

**1. Preload LCP image**
```html
<link rel="preload" as="image" href="/hero.jpg" fetchpriority="high">
```

**2. ลด TTFB**
- เปิด Cloudflare APO (สำหรับ WordPress)
- ใช้ Cloudflare Cache Rules
- เปลี่ยน hosting จาก shared → managed (Kinsta, WP Engine, Vercel)

**3. Defer non-critical CSS/JS**
```html
<link rel="stylesheet" href="non-critical.css" media="print" onload="this.media='all'">
<script src="analytics.js" defer></script>
```

**4. Inline critical CSS**
ดึง CSS ที่ใช้ใน above-the-fold มา inline ใน `<style>` ใน head

### ลด INP ให้ต่ำกว่า 200ms

**1. Batch DOM mutation**
```js
requestAnimationFrame(() => {
  // batch read/write
});
```

**2. Use Event Delegation**
แทนที่จะใส่ listener ทุก button ใช้ delegation บน parent

**3. Web Worker สำหรับงานหนัก**
move JSON.parse ขนาดใหญ่, image processing, calculation ไป Worker

**4. Lazy-load 3rd-party scripts**
GTM, Facebook Pixel, chat widget — load หลัง interaction

### เพิ่ม CLS stability

**1. ใส่ width/height ทุก img/video**
```html
<img src="..." width="800" height="600" alt="...">
```

**2. ใช้ font-display: swap + preload font**
```html
<link rel="preload" as="font" href="/font.woff2" crossorigin>
```

**3. Reserve space สำหรับ ad/embed**
```css
.ad-slot { min-height: 250px; }
```

**4. Avoid inserting content above existing content**
toast/notification ควรอยู่ใน fixed position ไม่ดันเนื้อหา

## Core Web Vitals กับ SEO Ranking {#seo}

Google ยืนยันตั้งแต่ **มิถุนายน 2021** ว่า CWV เป็น **Page Experience Signal** ที่ใช้ในการ rank โดยตรง ในปี 2026 น้ำหนักของ CWV ยังคงเป็น **tiebreaker** สำคัญ — ถ้าเว็บ 2 เว็บมีเนื้อหาคล้ายกัน เว็บที่ CWV เขียวจะ rank ดีกว่า

นอกจาก ranking signal โดยตรง CWV ยังส่งผลทางอ้อม:
- **Bounce rate ลด** เมื่อเว็บโหลดเร็ว
- **Time on page เพิ่ม** เมื่อ INP ดี
- **Conversion rate สูง** เมื่อ CLS = 0

จากงาน Google [Page Experience Update](https://developers.google.com/search/docs/appearance/page-experience):
> "เว็บที่ผ่าน CWV เขียวมี crawl rate สูงกว่าเฉลี่ย 24% และ index rate ดีกว่า 18%"

## หากจะแก้ Core Web Vitals ทั้งระบบ?

ปกติแก้ CWV แบบ piecemeal (แก้ทีละ symptom) จะได้ผลแค่ 30-50% ของศักยภาพ ทางที่ดีที่สุดคือ build เว็บใหม่บน stack ที่ออกแบบมาให้ CWV เขียวตั้งแต่ต้น เช่น Next.js + Vercel หรือ Astro + Cloudflare

ที่ Hashbox เราใช้ [บริการรับทำเว็บไซต์ SEO-Ready](/services/seo-ready-website/) ที่บังคับ Core Web Vitals เขียวเป็น **Build Gate** ใน CI pipeline — ไม่ผ่านเกณฑ์ = ไม่ deploy การันตี Lighthouse 95+ Mobile / 100 Desktop ทุกโปรเจกต์

ดูเพิ่มเติม:
- [Technical SEO คือ? คู่มือ 2026](/technical-seo-guide/)
- [GEO คืออะไร? Generative Engine Optimization](/geo-ai-search-optimization-2026/)
- [Next.js vs WordPress 2026](/nextjs-vs-wordpress-2026/)

## คำถามที่พบบ่อย {#faq}

### Core Web Vitals วัดจาก Lab หรือ Field?
Google ใช้ **field data** (CrUX จาก user จริง) ในการ rank ไม่ใช่ lab data จาก Lighthouse Lighthouse score ดีไม่ได้แปลว่า rank ดี ต้องดู field data ที่ Search Console > Core Web Vitals report

### INP มาแทน FID เมื่อไหร่?
ตั้งแต่ **12 มีนาคม 2024** INP เข้ามาแทน FID อย่างเป็นทางการ FID ถูกถอดออกจาก Core Web Vitals แล้ว

### CWV ผ่านแล้วจะ rank ขึ้นแน่ไหม?
CWV เป็น 1 ใน 200+ ranking signal ของ Google ผ่าน CWV ช่วย **ไม่โดนหัก** แต่ยังต้องมีเนื้อหาดี, backlinks ดี, technical SEO ครบ การ rank ดีขึ้นเกิดจากภาพรวม ไม่ใช่ CWV อย่างเดียว

### WordPress ผ่าน CWV ได้ไหม?
ได้ แต่ต้อง config ถูก: managed hosting, lightweight theme, ไม่ใช้ heavy plugin (Elementor, WPBakery ระวัง), ใช้ Cloudflare APO, optimize image WebP/AVIF เว็บ WordPress ที่ผ่าน CWV เขียวต้องลงทุน technical setup พอสมควร

### LCP element หาเจอยังไง?
เปิด Chrome DevTools > Performance > record > ดู Web Vitals lane → click LCP marker → จะ highlight element ใน Elements panel หรือใช้ PageSpeed Insights ก็มีระบุให้

### ราคาแก้ Core Web Vitals เท่าไหร่?
- **DIY/Plugin tweak**: 0 - 10,000 บาท (ผลลัพธ์จำกัด)
- **Audit + fix** โดยทีม: 30,000 - 80,000 บาท (CWV เหลือง → เขียว)
- **Rebuild เว็บใหม่บน modern stack**: 80,000 บาท ขึ้นไป (CWV เขียวการันตี)

ดูเพิ่ม: [บริการรับทำเว็บไซต์ SEO-Ready](/services/seo-ready-website/) เริ่ม 80,000 บาท CWV เขียวการันตี

---

**สรุป:** Core Web Vitals (LCP, INP, CLS) คือมาตรฐาน UX ที่ Google ใช้ rank เว็บไซต์ในปี 2026 เป้าหมายคือ LCP < 2.5s, INP < 200ms, CLS < 0.1 วัดจาก field data ใน Search Console การ optimize ต้องครอบคลุม server response, render-blocking resources, image preload, JavaScript bundling, layout stability ถ้าแก้ทั้งระบบไม่ไหว ให้พิจารณา rebuild บน Next.js/Astro stack ที่ออกแบบมาให้ CWV เขียวตั้งแต่ต้น
