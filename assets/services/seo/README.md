# English SEO page assets

## Consultation photograph

- Photographer: **Kindel Media**.
- Source: [Business People Working Together In Front of Their Laptops — Pexels photo 7651734](https://www.pexels.com/photo/business-people-working-together-in-front-of-their-laptops-7651734/).
- Source image: `https://images.pexels.com/photos/7651734/pexels-photo-7651734.jpeg?cs=srgb&dl=pexels-kindelmedia-7651734.jpg&fm=jpg`.
- Original dimensions: 5184 × 3888, 4:3.
- Retrieved and license checked: **2026-09-20**.
- License: [Pexels License](https://www.pexels.com/license/). Free website and commercial marketing use; attribution is appreciated but not required. Do not suggest that pictured people endorse Hashbox or are Hashbox employees.
- Context: illustrative consultation/process photo, not a team portrait, case study, client testimonial, or proof of results.
- Suggested alt: `People reviewing charts and reports together at a table with laptops`.
- Transform: resize and WebP encoding only; no cropping, recolouring, or generative modification. Original framing retained.
- Generated using `cwebp -q 84 -m 6 -resize WIDTH 0`.

Responsive assets:

| File | Dimensions | Bytes |
| --- | --- | --- |
| `seo-consultation-pexels-kindel-media-1200w.webp` | 1200 × 900 | 86,144 |
| `seo-consultation-pexels-kindel-media-640w.webp` | 640 × 480 | 36,352 |

Use explicit width/height, responsive `srcset`/`sizes`, and lazy loading below the fold. A visible credit `Illustrative photo · Kindel Media / Pexels` clarifies context.

## Lucide icons

- Author: Lucide Icons and Contributors; Feather-derived icons by Cole Bemis.
- Source: [official Lucide repository](https://github.com/lucide-icons/lucide/tree/main/icons).
- Retrieved: **2026-09-20**.
- Files read from: `https://raw.githubusercontent.com/lucide-icons/lucide/main/icons/NAME.svg`.
- License: ISC, plus MIT for Feather-derived icons; complete upstream notice in `LUCIDE-LICENSE.txt`.
- Implementation: `inc/en-seo-icons.php`, a fixed allowlist of 12 icons. SVG viewBox, paths, stroke width, round joins, and round caps match upstream. Added decorative accessibility attributes and a scoped CSS class; removed nonessential whitespace.
- Names: `search-check`, `gauge`, `code-xml`, `file-text`, `map-pin`, `bot`, `mouse-pointer-click`, `chart-no-axes-combined`, `arrow-right`, `check`, `plus`, `chevron-down`.
- API: `hashbox_en_seo_icon($name)` returns trusted inline SVG markup; unknown or non-string names return an empty string. The SVG is `aria-hidden="true"`; keep a visible text label with it.

## Evidence image

The separately maintained PageSpeed image in `assets/proof/psi-report-2026-08-1600w.webp` is Hashbox's existing evidence. The Pexels photo is not evidence and must not be used to imply measured SEO performance.
