# Site Structure — หลัง restructure

```
/                                   H1: รับทำเว็บไซต์ SEO-Ready พร้อม Marketing + AI ไว้ในทีมเดียว
├── /services/                      hub · ItemList(Service ×5) + BreadcrumbList
│   ├── /services/website-development/          รับทำเว็บไซต์ SEO-Ready (H1 คงเดิม)      ← "รับทำเว็บไซต์", "ออกแบบเว็บไซต์ธุรกิจ"
│   │   └── /services/website-development/wordpress/   รับทำเว็บไซต์ WordPress
│   ├── /services/ai-consulting/                ที่ปรึกษา AI สำหรับธุรกิจไทย              ← "ปรึกษาทำระบบ ai solution", "ที่ปรึกษา ai"
│   │   (EN twin) /en/ai-consulting/            ← "ai consulting bangkok" (hreflang pair)
│   ├── /services/seo/                          รับทำ SEO Technical-first                ← "รับทำ seo", "บริษัทรับทำ seo"
│   │   └── #cro  (ย้ายจาก DM: GA4/GSC/Heatmap/A-B/CRO Sprint)
│   ├── /services/ai-search/  ★ใหม่             รับทำ AI Search (GEO)                    ← "รับทำ ai search", "ai seo", "geo agency", "บริการ geo"
│   └── /services/n8n-automation/               รับทำ n8n Automation                     ← "รับทำ n8n", "workflow automation"
│   ✂ /services/digital-marketing-tools/  →  301 → /services/seo/#cro
├── /work/  + 6 case studies (→ ชื่อจริง 3 เคสแรก)
├── /about/  (+ Person schema Tum Thaweewat — มีแล้ว)
├── /blog/  18 โพสต์ — hub-and-spoke:
│     AI Consulting hub ← 170, 220, 224, 69, 129, 196, 68
│     GEO hub (post 66) ← 208 + spoke อื่น  → ลิงก์ขึ้น /services/ai-search/
│     SEO hub (post 210) ← 17, 81, 80, 89, 91, 92 → ลิงก์ขึ้น /services/seo/
├── /website-audit/  (lead LP, page 136) · /ai-workflow-audit/ · /seo-audit/ ฯลฯ (noindex? ตรวจ)
└── /#contact  (คง id)
```

## Nav (desktop dropdown + mobile sheet — ต้องเป็น `<a href>` จริงใน DOM)
1. รับทำเว็บไซต์ SEO-Ready → /services/website-development/
2. ปรึกษาทำระบบ AI Solution → /services/ai-consulting/
3. รับทำ SEO → /services/seo/
4. รับทำ AI Search (GEO) → /services/ai-search/
5. Workflow Automation (n8n) → /services/n8n-automation/
+ ผลงาน / บทความ / เกี่ยวกับเรา / รับ Audit ฟรี

## หน้าแรก — section "บริการของเรา" (แทนการ์ด 3 ใบ)
| # | H3 / anchor | sub-service bullets (long-tail) |
|---|---|---|
| 1 | รับทำเว็บไซต์ SEO-Ready | WordPress · Headless Next.js · E-commerce · Landing Page · Website Audit ฟรี |
| 2 | ปรึกษาทำระบบ AI Solution สำหรับธุรกิจ | LINE Chatbot AI · RAG / Knowledge Base · Sales GPT · AI Tool / Prototype · AI Transformation |
| 3 | รับทำ SEO | Technical SEO · Content · Local SEO · SEO Recovery · Tracking + CRO |
| 4 | รับทำ AI Search (GEO) | AI Overview · ChatGPT · Perplexity · Gemini · llms.txt · Citation tracking |
| 5 | รับทำ Workflow Automation (n8n) | n8n · LINE OA · CRM sync · Sheets/Notion |

## Schema ต่อหน้า
| หน้า | Schema |
|---|---|
| Home | Organization (+hasOfferCatalog 5 Service), ProfessionalService/LocalBusiness, WebSite, FAQPage, WebPage |
| /services/ | ItemList → ListItem → Service {name, url, description, provider @id, offers{priceSpecification}} + BreadcrumbList |
| Service page | Service (+Offer), FAQPage, BreadcrumbList, Speakable |
| Case study | Article + BreadcrumbList (มีแล้ว) |
| Blog | BlogPosting + FAQPage (Rank Math) |

## URL rules
- ไม่สร้างหน้าใหม่ที่ซ้ำ keyword หน้าเดิม (เช่น "รับทำเว็บไซต์" หน้าที่ 2)
- slug ใหม่ = `/services/ai-search/` (EN slug, ตรงกับ Metier pattern, สั้น) — Title/H1 ภาษาไทย
- ทุก 301 ทำใน theme (`template_redirect`) ไม่ใช้ plugin
