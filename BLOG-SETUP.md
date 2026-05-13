# Blog Setup Guide — Hashbox Studio V2

Step-by-step WP admin checklist after theme deploy.

## 1. Reading settings

WP admin → **Settings → Reading**
- Your homepage displays: **A static page**
- Homepage: select an existing front page (or leave Home)
- Posts page: create new page named `Blog` (slug `/blog/`) → select it here
- Save

## 2. Permalink structure

WP admin → **Settings → Permalinks**
- Select **Post name** (`/%postname%/`)
- Category base: `category` (default)
- Tag base: `tag` (default)
- Save (this also flushes rewrite rules)

## 3. Create categories

WP admin → **Posts → Categories**

Create 5 categories:

| Name | Slug | Description (for SEO intro on category page) |
|------|------|----------------------------------------------|
| Web Development | `web-development` | บทความเรื่อง web stack, performance, framework — เขียนโดยทีมที่ build เว็บลูกค้าจริง |
| AI Consulting | `ai-consulting` | กรณีศึกษา AI Workforce, automation และ agent — ลด manual work 40%+ |
| Marketing | `marketing` | CRO, paid ads, analytics — กลยุทธ์ที่วัดผลได้จริง |
| SEO | `seo` | Technical SEO, content SEO, GEO/AI search — ทำให้ Google และ AI หาเจอ |
| Case Studies | `case-studies` | เคสจริงจากลูกค้า Hashbox — ปัญหา, แนวทาง, ผลลัพธ์ |

For each category:
- Edit → fill **Description** with 150-300 words intro (shows on category page + SEO meta)
- Rank Math meta box → set custom title + meta description

## 4. Polylang (bilingual TH + EN)

Install plugin: **Polylang** (free) — `Plugins → Add New → search "polylang"`

Setup:
1. Languages → Add Thai (default) + English
2. Settings → URL modifications → "The language is set from the directory name in pretty permalinks" (`/en/`)
3. Strings translation → translate site title, tagline, menu labels
4. Posts list → assign language to each post + link translations

Note: hreflang tags are auto-emitted by Polylang.

## 5. Rank Math sitemap

WP admin → **Rank Math → Sitemap Settings**
- General → Posts: ON
- General → Pages: ON
- General → Images: ON
- Categories: ON
- Tags: ON

Submit `https://hashbox.co.th/sitemap_index.xml` to Google Search Console.

## 6. Rank Math defaults

WP admin → **Rank Math → Titles & Meta**
- Posts → schema type: **Article**
- Posts → Article type: **BlogPosting**
- Categories → schema type: **CollectionPage**

Note: theme also emits Article + BreadcrumbList JSON-LD as fallback when Rank Math schema module not detected.

## 7. Author bio (E-E-A-T)

WP admin → **Users → Your Profile**
- Biographical Info: 80-120 word bio + credentials
- Website: link to author social or service page
- Profile picture (Gravatar): upload via gravatar.com

Custom field (optional): `expertise`, `years_experience`, `linkedin_url`

## 8. Featured images

Every post needs featured image:
- 1200 x 675px (16:9)
- WebP or AVIF format
- < 200 KB
- Descriptive filename: `hashbox-ai-workforce-2026.webp` (not `IMG_1234.jpg`)
- Alt text required

## 9. Importing existing markdown content

3 starter markdown files in `content/blog/`:
- `01-why-we-build-with-nextjs-2026.md`
- `02-5-ways-ai-save-team-20-hours.md`
- `03-from-spreadsheets-to-systems.md`

To import:
1. WP admin → Posts → Add New
2. Copy markdown body → paste into block editor (auto-converts most markdown)
3. Set category, tags, featured image, excerpt
4. Set Rank Math focus keyword + meta description
5. Publish

Or use **Markdown Importer** plugin for batch import.

## 10. First-publish SEO checklist (per post)

- [ ] Title 50-60 chars, contains primary keyword
- [ ] Slug short, keyword-rich
- [ ] Meta description 150-160 chars, has CTA
- [ ] Featured image with descriptive alt
- [ ] First paragraph contains primary keyword
- [ ] H2/H3 structure (3+ H2 minimum)
- [ ] 1500+ words for pillar / 800+ for cluster
- [ ] 2-3 internal links to related posts
- [ ] 1-2 outbound authority links
- [ ] Reading time displayed (auto from theme)
- [ ] Author bio visible
- [ ] Schema validates (test: search.google.com/test/rich-results)

## 11. Analytics

Already installed:
- Rank Math Analytics (if connected to GSC)

Recommended adds:
- **Google Analytics 4** — `Plugins → Site Kit by Google`
- **Microsoft Clarity** (free heatmaps) — add tracking snippet via Insert Headers and Footers plugin

## 12. Performance

- Install **WP Rocket** or **W3 Total Cache**
- Enable WebP delivery
- Lazy load below-fold images (already in theme via `loading="lazy"`)

## 13. Spam protection (if comments enabled)

Comments disabled by default in this theme — better SEO, no spam.

If you enable: install **Akismet** + use reCAPTCHA v3.

---

## Architecture map (for devs)

| File | Purpose |
|------|---------|
| `home.php` | Blog index — featured + grid |
| `single.php` | Single post — TOC, reading column, CTA, related |
| `category.php` | Category archive (topic hub) |
| `tag.php` | Tag archive |
| `archive.php` | Generic archive (date, author) |
| `search.php` | Search results |
| `template-parts/breadcrumbs.php` | Visible breadcrumb nav |
| `template-parts/post-card.php` | Reusable card (hero / standard / compact) |
| `template-parts/post-meta.php` | Author + date + reading time |
| `template-parts/post-toc.php` | Auto TOC from H2/H3 |
| `template-parts/post-related.php` | 3 related posts (same category) |
| `template-parts/post-share.php` | FB / X / LinkedIn / LINE / copy |
| `css/blog.css` | Editorial styles (loaded conditionally) |
| `functions.php` (blog section) | Reading time, TOC parser, related posts, schema, pagination |

## Helpers exposed to templates

```php
hashbox_reading_time( $post_id )      // int minutes
hashbox_get_toc( $post_id )           // array of headings
hashbox_related_posts( $id, $count )  // WP_Query
hashbox_og_image_url( $post_id )      // string URL
hashbox_pagination()                  // echoes numbered pagination
```
