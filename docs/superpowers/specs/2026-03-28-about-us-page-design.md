# About Us Page — Design Spec

**Date:** 2026-03-28
**URL:** `/about`
**Content source:** `Hashbox_About_Portfolio_v2.docx.txt`

## Overview

Standalone WordPress page template for Hashbox Studio's About Us page. Uses the existing Signal design system (dark theme) with alternating lighter surface sections for visual contrast. All content in Thai.

## SEO

- **Title Tag:** เกี่ยวกับเรา — Hashbox Studio | Website Craft + Digital Workforce
- **Meta Description:** Hashbox Studio คือ agency ที่รวม Web Development ระดับ technical กับ AI Workflow Consulting ไว้ด้วยกัน นำทีมโดย Fullstack Developer 19 ปี อดีต Tech Evangelist จาก agency ระดับ award-winning
- **H1:** เราทำเว็บที่ perform และสร้าง AI workforce ที่วัดผลได้
- **Schema:** Organization + Person + AboutPage JSON-LD (from content doc)

## Files

| File | Action | Purpose |
|------|--------|---------|
| `page-about.php` | Create | Page template — all 7 sections |
| `css/about-page.css` | Create | About-specific styles |
| `js/about.js` | Create | Counter animation, scroll reveal |
| `functions.php` | Edit | Enqueue about CSS/JS conditionally |

## Sections

### 1. Hero (dark bg + orbs)

- Background: `--color-bg` with blue/cyan gradient orbs + dot grid (reuse hero pattern)
- Section label: "ABOUT US"
- H1: "เราทำเว็บที่ perform และสร้าง AI workforce ที่วัดผลได้"
- Intro text: agency description from doc
- 2 CTA buttons: "นัดปรึกษาฟรี" (amber, links to /contact) + "ดูผลงาน" (outline, links to /portfolio)
- Not full-height like landing hero — shorter, content-focused

### 2. ทำไมต้อง Hashbox (lighter surface)

- 2-column layout: Problem (left) vs Solution (right)
- Problem card: red-tinted border, 3 items with ✕ icon
  - จ้างบริษัททำเว็บ — สวยแต่ช้า
  - จ้างบริษัททำ SEO — แนะนำได้แต่แก้ code ไม่เป็น
  - จ้างบริษัททำ AI — ขายฝันแต่ implement ไม่ได้
  - Footer: "3 ทีมที่ไม่คุยกัน = ผลลัพธ์ที่ไม่ต่อกัน"
- Solution card: cyan-tinted border, 3 items with ✓ icon
  - Web + SEO + AI ในทีมเดียว
  - Developer ที่เข้าใจ SEO เขียน code ได้เลย
  - AI ที่ implement ได้จริง วัด ROI ได้
  - Footer: "Website Craft Agency + Digital Workforce Studio"
- Mobile: stack vertically

### 3. สิ่งที่เราทำ (dark bg)

- Section label: "สิ่งที่เราทำ"
- 2x2 grid of service cards, each with:
  - Accent color (blue/cyan/amber)
  - Title + short description
  - Link arrow "ดูบริการ →" linking to services section on landing page
- Cards:
  1. Website Development (blue) — Corporate, Brand, E-commerce ด้วย Next.js, WordPress, Headless
  2. Technical SEO & Performance (cyan) — SEO audit, Core Web Vitals, Schema Markup
  3. Digital Workforce Studio (amber) — AI assistant, workflow automation, chatbot
  4. E-commerce (blue) — Conversion, payment gateway ไทย, SEO
- Mobile: stack 1 column

### 4. Tech Stack + AI Tools (lighter surface)

- 2-column layout
- Left column — "TECH STACK":
  - Pill/tag style badges with accent borders
  - Next.js, React, Tailwind CSS (blue), WordPress, WP Headless (cyan), Node.js, Python (amber)
- Right column — "AI TOOLS ที่สร้างเอง":
  - Bullet list with colored dots
  - Paid Media Alert Tool, SEO Tracker, Asearchlab, peec.AI, Query Fan-out, + 1 more
- Mobile: stack vertically

### 5. สิ่งที่เราเชื่อ + ตัวเลข (dark bg)

- Section label: "สิ่งที่เราเชื่อ"
- Top: 3-column value cards
  1. Technical Excellence (blue) — ไม่ตัดมุม ทุกโปรเจคผ่าน Core Web Vitals, SEO built-in, test ครบก่อน launch
  2. Measurable Results (cyan) — ไม่ขายความรู้สึก ทุกสิ่งวัดผลได้ PageSpeed, organic traffic, cost reduction
  3. Transparency (amber) — ราคาชัดเจน ไม่มีค่าใช้จ่ายซ่อนเร้น timeline realistic
- Bottom: 4-column stats bar (separated by top border)
  - 19 ปี ประสบการณ์ (blue)
  - 300+ แบรนด์ที่เคยดูแล (cyan)
  - 90+ คะแนน CWV Desktop (amber)
  - 6 AI tools ที่สร้างเอง (blue)
- Stats use counter animation (IntersectionObserver, animate on scroll into view)
- Mobile: values stack 1 col, stats 2x2 grid

### 6. ประสบการณ์ที่หล่อหลอมเรา (lighter surface)

- Section label: "ประสบการณ์ที่หล่อหลอมเรา"
- Intro text: agency ระดับ award-winning ที่ Tum เป็น Tech Evangelist
- 2-column case study cards:
  1. HR Tech Platform (blue border)
     - Description: Full technical SEO overhaul ใน 12 เดือน
     - Metric pills: +2,200% impressions (blue), +700% traffic (cyan), +540% users (amber)
  2. Home Service App (cyan border)
     - Description: Technical SEO + CWV optimization ใน 6 เดือน
     - Metric pills: 50x impressions (amber), +300% clicks (blue), +200% audience (cyan)
- Mobile: stack 1 column

### 7. CTA + Contact (dark gradient bg)

- Gradient background (blue-tinted)
- Heading: "พร้อมคุยกับเรา?"
- Sub: "นัดหมายปรึกษาฟรี 30 นาที"
- Contact info row: Email: project@hashbox.co.th · โทร: 02 266 6222 · LINE: @hashboxstudio
- Address: 139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500
- Hours: จันทร์ - ศุกร์ 9:00 - 18:00
- 2 CTA buttons: "นัดปรึกษาฟรี →" (amber) + "LINE OA" (cyan outline)
- Internal links: → Services, → Portfolio, → Contact (on landing page)

## Technical Notes

- **Template:** WordPress page template (`Template Name: About Page`)
- **Header/Footer:** Reuse `get_header()` / `get_footer()`
- **CSS:** Separate file `css/about-page.css`, enqueued only on about page via `is_page_template()` check in `functions.php`
- **JS:** Separate file `js/about.js`, enqueued only on about page. Handles:
  - Counter animation (reuse IntersectionObserver pattern from `js/script.js`)
  - Scroll reveal for sections (reuse `.reveal` class pattern)
- **Responsive breakpoints:** Follow existing pattern — stack to 1 column below 768px
- **Schema markup:** JSON-LD injected in template, Organization + Person + AboutPage graph from content doc
- **Internal links:** Service cards link to `home_url() . '#services'`, portfolio CTA to `/portfolio`, contact CTA to `home_url() . '#contact'`
