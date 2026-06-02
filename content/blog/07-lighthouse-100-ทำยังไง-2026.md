---
title: "Lighthouse 100 ทำยังไง? คู่มือทำเว็บผ่าน 100/100/100/100 ปี 2026"
slug: "lighthouse-100-ทำยังไง-2026"
category: "Technical SEO"
tag_color: "blue"
read_time: "9 min read"
date: "2026-06-02"
featured: true
excerpt: "Lighthouse คือเครื่องมือวัดคุณภาพเว็บของ Google ครอบคลุม Performance, Accessibility, Best Practices, SEO บทความอธิบายวิธี optimize ให้ได้ 100/100/100/100 ทั้ง WordPress และ Next.js"
author: "Tum Thaweewat"
---

# Lighthouse 100 ทำยังไง? คู่มือทำเว็บผ่าน 100/100/100/100

> **คำตอบสั้น:** Lighthouse คือเครื่องมือ open-source ของ Google ที่วัดคุณภาพเว็บ 4 หมวด: Performance, Accessibility, Best Practices, SEO คะแนนเต็ม 100/100 ต่อหมวด เว็บที่ผ่าน 100/100/100/100 มีโอกาส rank ดีกว่าและ user experience ดีกว่ามาก

Lighthouse 100 ไม่ใช่ "เป้าหมายในตัวเอง" — แต่เป็น proxy สำหรับ web quality ที่ Google ใช้ตัดสิน ranking โดยตรงผ่าน Page Experience Signal บทความนี้อธิบายวิธีไล่ score แต่ละหมวดให้ผ่าน 100

## สารบัญ

- [Lighthouse คืออะไร?](#what)
- [4 หมวดที่ต้องผ่าน 100](#categories)
- [Performance 100 ทำยังไง?](#performance)
- [Accessibility 100 ทำยังไง?](#a11y)
- [Best Practices 100 ทำยังไง?](#best)
- [SEO 100 ทำยังไง?](#seo)
- [Lighthouse 100 ในเครื่อง vs ใน production](#prod)
- [FAQ](#faq)

## Lighthouse คืออะไร? {#what}

Lighthouse คือ open-source automation tool ของ Google ที่ build เข้าใน Chrome DevTools + PageSpeed Insights + CI/CD pipelines วัดคุณภาพเว็บผ่าน lab simulation (ไม่ใช่ field data)

**Key insight:** Lighthouse score เป็น **lab data** — ไม่ใช่สิ่งที่ Google ใช้ rank โดยตรง Google ใช้ **field data จาก CrUX** (real user) แต่ผ่าน Lighthouse 100 = ฐานที่ดีต่อ field data

## 4 หมวดที่ต้องผ่าน 100 {#categories}

| หมวด | น้ำหนัก | สำคัญต่อ SEO |
|---|---|---|
| **Performance** | สูงสุด | ✓ ผ่าน Core Web Vitals |
| **SEO** | สูง | ✓ ผ่าน Crawlability + meta |
| **Accessibility** | กลาง | ทางอ้อม + UX |
| **Best Practices** | กลาง | ทางอ้อม + Security |

## Performance 100 ทำยังไง? {#performance}

Performance score คำนวณจาก 5 metrics:

| Metric | Weight | เป้า |
|---|---|---|
| LCP | 25% | <2.5s |
| TBT | 30% | <200ms |
| CLS | 25% | <0.1 |
| FCP | 10% | <1.8s |
| Speed Index | 10% | <3.4s |

### 10 จุดที่ต้องทำเพื่อ Performance 100

**1. Preload LCP image**
```html
<link rel="preload" as="image" href="/hero.jpg" fetchpriority="high">
```

**2. Inline critical CSS** ใน `<head>`

**3. Defer non-critical CSS**
```html
<link rel="stylesheet" href="non-critical.css" media="print" onload="this.media='all'">
```

**4. Defer หรือ async ทุก script ที่ไม่ใช่ critical**

**5. Use modern image formats** (WebP/AVIF)

**6. Set explicit width/height** ทุก img/video → ลด CLS

**7. Self-host fonts + preload + display:swap**

**8. Code splitting** — load JS เฉพาะหน้าที่ใช้

**9. Avoid large layout shifts** (no late ads, popups)

**10. Use CDN + HTTP/2 หรือ HTTP/3**

### WordPress: Plugins ที่ช่วย
- WP Rocket (paid, best)
- FlyingPress
- Perfmatters

### Next.js: ใช้ tool built-in
- `next/image`
- `next/font`
- App Router (RSC)
- ISR + Vercel Edge

## Accessibility 100 ทำยังไง? {#a11y}

Accessibility score วัด WCAG 2.1 AA compliance:

**1. ทุก `<img>` มี `alt` attribute**

**2. Form input มี label associated**
```html
<label for="email">Email</label>
<input id="email" type="email">
```

**3. Color contrast ratio ≥ 4.5:1** สำหรับ body text
- Test ใน Chrome DevTools → Accessibility tab

**4. Semantic HTML**
- ใช้ `<button>` ไม่ใช่ `<div onclick>`
- ใช้ `<nav>`, `<main>`, `<article>`

**5. ARIA labels เฉพาะที่จำเป็น** (อย่าใส่เกิน)

**6. Skip link สำหรับ keyboard nav**
```html
<a class="skip-link" href="#main">Skip to main content</a>
```

**7. Lang attribute**
```html
<html lang="th">
```

**8. Heading hierarchy** (h1 → h2 → h3, ไม่กระโดด)

## Best Practices 100 ทำยังไง? {#best}

**1. HTTPS เท่านั้น** (no mixed content)

**2. ไม่มี vulnerable JS libraries**
- Update jQuery, lodash etc.
- Scan ผ่าน `npm audit`

**3. Image aspect ratio ตรง**
ไม่ใช่ `width="100%"` แต่ stretch ไม่เท่ากับ aspect ratio จริง

**4. ไม่ใช้ deprecated APIs**

**5. CSP (Content Security Policy)** header

**6. Permissions Policy** header เปิดเฉพาะ feature ที่ใช้

**7. Console error เป็น 0** — ไม่มี 404 resource, JS error

## SEO 100 ทำยังไง? {#seo}

**1. `<title>` tag ไม่ว่าง + unique**

**2. Meta description ไม่ว่าง**

**3. robots.txt valid**

**4. Indexable** (no noindex meta)

**5. Canonical tag**

**6. Hreflang ถูก** (ถ้ามี multilingual)

**7. Tap targets ใหญ่พอ** (≥48×48px)

**8. Crawlable links** (real `<a href>` ไม่ใช่ JS handler บน div)

**9. Structured data validate**

**10. Mobile viewport meta**
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

## Lighthouse 100 ในเครื่อง vs ใน production {#prod}

| สภาพ | Score | Why |
|---|---|---|
| `localhost` | 100/100/100/100 ง่าย | ไม่มี network latency |
| Vercel preview | 95-100 | edge cache คุ้ม |
| Production + CDN | 90-100 | ขึ้นกับ user location |
| Production + heavy plugin | 60-85 | overhead เยอะ |
| Mobile + 4G | -10 to -15 จาก desktop | throttling |

**Insight:** Score 100 ใน lab ไม่ได้แปลว่าผ่าน CWV ใน production ต้องดู CrUX field data ใน GSC ด้วย

## ทำเว็บใหม่ที่ Lighthouse 100 ตั้งแต่ build แรก

การ retrofit เว็บเดิมให้ผ่าน 100 ทุกหมวดเป็นไปได้แต่ใช้เวลานาน วิธีที่ scalable ที่สุดคือ build บน stack ที่ออกแบบมาเพื่อ Lighthouse 100 ตั้งแต่ต้น (Next.js + Vercel หรือ Astro + Cloudflare)

ที่ Hashbox เราใช้ [บริการรับทำเว็บไซต์ SEO-Ready](/services/seo-ready-website/) ที่บังคับ Lighthouse 95+ Mobile / 100 Desktop เป็น Build Gate ใน CI — ไม่ผ่าน = ไม่ deploy

ดูเพิ่ม:
- [LCP คือ? วิธีแก้](/lcp-คือ-วิธีแก้-2026/)
- [Core Web Vitals คือ?](/core-web-vitals-thai-guide-2026/)
- [Schema Markup คือ?](/schema-markup-thai-guide-2026/)

## FAQ {#faq}

### Lighthouse score เป็น ranking factor ของ Google ไหม?
ไม่โดยตรง · Google ใช้ field data จาก CrUX แต่ Lighthouse 100 = พื้นฐานที่ทำให้ CWV field ผ่านง่าย

### Lighthouse 100 ทำได้ทุกเว็บไหม?
ทำได้ แต่ WordPress + heavy plugin อาจติด 92-98 · Next.js/Astro บน Vercel/Cloudflare ทำ 100/100/100/100 ได้ง่าย

### วัด Lighthouse ที่ไหนดี?
- PageSpeed Insights (Google ทำ) — มี field + lab
- Chrome DevTools Lighthouse tab — lab only
- WebPageTest — multi-location

### Mobile score ต่ำกว่า Desktop ทำไม?
Lighthouse throttle mobile: 4G + slower CPU — สะท้อน user จริงบนมือถือ

### Performance 100 ต้องเลือก Tier hosting ระดับไหน?
ขั้นต่ำ: managed WordPress (Kinsta, WP Engine) หรือ Vercel/Cloudflare Pages · shared hosting ไปไม่ถึง

### Cloudflare APO ช่วย Lighthouse แค่ไหน?
WordPress: TTFB ลด → LCP/TBT ดีขึ้น → Performance +15-25 points

### ราคา service ทำให้ Lighthouse 100?
- Audit + fix: 30,000-80,000 บาท
- Rebuild ใหม่: 80,000+ บาท
ดู [SEO-Ready pricing](/services/seo-ready-website/)

---

**สรุป:** Lighthouse 100/100/100/100 คือเป้าหมาย web quality ที่ทำได้ผ่านการ optimize Performance, Accessibility, Best Practices, SEO ครบทุกด้าน ไม่ใช่ ranking factor โดยตรงแต่เป็น proxy ที่ดีของ web quality — ผ่าน Lighthouse 100 = พื้นฐานที่ทำให้ Core Web Vitals field data ผ่านง่าย stack ที่ทำได้สะดวกที่สุดคือ Next.js + Vercel · WordPress ทำได้ถึง 95+ ถ้า config ถูก
