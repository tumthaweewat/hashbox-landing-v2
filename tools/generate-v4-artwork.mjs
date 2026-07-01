#!/usr/bin/env node
import { copyFileSync, existsSync, mkdirSync, unlinkSync, writeFileSync } from 'node:fs';
import { join } from 'node:path';
import { spawnSync } from 'node:child_process';

const chrome = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
const tmpDir = `/tmp/hashbox-v4-artwork-render-${process.pid}`;
const themeOut = '/Users/tumthaweewat/hashbox-landing-v2/assets/ads/hashbox';
const kitOut = '/Users/tumthaweewat/hashbox-ads/hashbox_codex_ads_kit_v4/artwork/final_png';

mkdirSync(tmpDir, { recursive: true });
mkdirSync(themeOut, { recursive: true });
mkdirSync(kitOut, { recursive: true });

const routes = {
  ai_workforce: {
    label: 'AI WORKFORCE AUDIT',
    service: 'AI Workforce',
    headline: ['ลดงานซ้ำ', 'ด้วย AI ที่วัด ROI ได้'],
    sub: 'LINE Bot • RAG • Workflow Automation',
    chips: ['Use case', 'ROI', 'Deploy จริง'],
    cta: 'รับ AI Audit ฟรี',
    micro: 'สำหรับ Sales / Support / Ops',
    url: 'hashbox.co.th',
    metric: '-60%',
    metricLabel: 'support cost',
    visual: 'ai',
    accent: '#2F73FF',
    accent2: '#7B5CFF',
  },
  seo_ready: {
    label: 'SEO-READY WEBSITE',
    service: 'SEO-Ready Website',
    headline: ['เว็บใหม่', 'ต้องพร้อมติด Google'],
    sub: 'Technical SEO • Schema • Core Web Vitals',
    chips: ['Lighthouse 100', 'GA4/GSC', 'CRO'],
    cta: 'ขอ SEO Audit ฟรี',
    micro: 'Build Gate ก่อน Deploy',
    url: 'hashbox.co.th',
    metric: '100',
    metricLabel: 'Lighthouse',
    visual: 'seoReady',
    accent: '#2A68FF',
    accent2: '#25D9FF',
  },
  seo_recovery: {
    label: 'TECHNICAL SEO AUDIT',
    service: 'Technical SEO',
    headline: ['Traffic ตก?', 'ให้ทีมตรวจ SEO'],
    sub: 'Indexation • CWV • Schema • Competitor Gap',
    chips: ['GSC', 'Backlinks', 'Roadmap'],
    cta: 'รับ Audit ฟรี',
    micro: 'Case: Impressions +2,200%',
    url: 'hashbox.co.th',
    metric: '+2,200%',
    metricLabel: 'impressions',
    visual: 'seoRecovery',
    accent: '#2A68FF',
    accent2: '#61F4B1',
  },
  cro_sprint: {
    label: 'CRO + MARKETING TOOLS',
    service: 'CRO Sprint',
    headline: ['มี Traffic', 'แต่ Lead ไม่มา?'],
    sub: 'GA4 • GSC • Heatmap • A/B Test',
    chips: ['Funnel', 'Heatmap', 'Test plan'],
    cta: 'ตรวจ Funnel ฟรี',
    micro: 'หา Lead leak ก่อนเพิ่มงบ',
    url: 'hashbox.co.th',
    metric: '3x',
    metricLabel: 'conversion',
    visual: 'cro',
    accent: '#25D9FF',
    accent2: '#FF7AD9',
  },
  growth_bundle: {
    label: 'WEB + ADS + SEO + AI',
    service: 'Web + Marketing + AI',
    headline: ['ทีมเดียวดูครบ', 'Traffic → Lead → AI'],
    sub: 'Website • Performance • CRO • AI Workforce',
    chips: ['1 KPI', '1 Dashboard', '1 Team'],
    cta: 'เริ่มด้วย Audit ฟรี',
    micro: 'ทีมเดียวรับผิดชอบ Growth KPI',
    url: 'hashbox.co.th',
    metric: '1 KPI',
    metricLabel: 'one growth team',
    visual: 'growth',
    accent: '#2A68FF',
    accent2: '#25D9FF',
  },
};

const formats = [
  { key: 'meta_square', width: 1080, height: 1080, prefix: 'meta_square' },
  { key: 'meta_portrait', width: 1080, height: 1350, prefix: 'meta_portrait' },
  { key: 'meta_story', width: 1080, height: 1920, prefix: 'meta_story' },
  { key: 'linkedin_wide', width: 1200, height: 627, prefix: 'linkedin_wide' },
];

const routeOrder = ['ai_workforce', 'seo_ready', 'seo_recovery', 'cro_sprint', 'growth_bundle'];

function esc(text) {
  return String(text)
    .replaceAll('&', '&amp;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;')
    .replaceAll('"', '&quot;');
}

function layout(format, routeKey) {
  const w = format.width;
  const h = format.height;
  const isWide = format.key === 'linkedin_wide';
  const isStory = format.key === 'meta_story';
  const isPortrait = format.key === 'meta_portrait';
  const isSquare = format.key === 'meta_square';
  const longHeadline = routeKey === 'growth_bundle' || routeKey === 'seo_recovery';

  if (isWide) {
    return {
      safe: 54,
      brandTop: 54,
      brandLeft: 68,
      brandScale: 0.9,
      badgeTop: 132,
      badgeLeft: 68,
      headlineTop: 176,
      headlineLeft: 68,
      headlineSize: longHeadline ? 55 : 60,
      headlineWidth: 610,
      subTop: 324,
      subSize: longHeadline ? 25 : 27,
      chipTop: 372,
      visualLeft: 710,
      visualTop: 102,
      visualWidth: 420,
      visualHeight: 340,
      ctaTop: 476,
      ctaLeft: 68,
      microTop: 536,
      urlRight: 60,
      urlBottom: 38,
      frameInset: 34,
    };
  }

  if (isStory) {
    return {
      safe: 82,
      brandTop: 112,
      brandLeft: 108,
      brandScale: 1.08,
      badgeTop: 345,
      badgeLeft: 108,
      headlineTop: 455,
      headlineLeft: 108,
      headlineSize: longHeadline ? 78 : 86,
      headlineWidth: 860,
      subTop: 680,
      subSize: 36,
      chipTop: 752,
      visualLeft: 108,
      visualTop: 910,
      visualWidth: 864,
      visualHeight: 420,
      ctaTop: 1465,
      ctaLeft: 108,
      microTop: 1570,
      urlRight: 96,
      urlBottom: 95,
      frameInset: 58,
    };
  }

  if (isPortrait) {
    return {
      safe: 76,
      brandTop: 80,
      brandLeft: 104,
      brandScale: 1.0,
      badgeTop: 270,
      badgeLeft: 104,
      headlineTop: 350,
      headlineLeft: 104,
      headlineSize: longHeadline ? 72 : 80,
      headlineWidth: 860,
      subTop: 560,
      subSize: 34,
      chipTop: 630,
      visualLeft: 104,
      visualTop: 755,
      visualWidth: 872,
      visualHeight: 310,
      ctaTop: 1110,
      ctaLeft: 104,
      microTop: 1210,
      urlRight: 94,
      urlBottom: 78,
      frameInset: 56,
    };
  }

  if (isSquare) {
    return {
      safe: 72,
      brandTop: 82,
      brandLeft: 106,
      brandScale: 1.0,
      badgeTop: 242,
      badgeLeft: 106,
      headlineTop: 320,
      headlineLeft: 106,
      headlineSize: longHeadline ? 68 : 76,
      headlineWidth: 850,
      subTop: 520,
      subSize: 32,
      chipTop: 582,
      visualLeft: 106,
      visualTop: 690,
      visualWidth: 868,
      visualHeight: 220,
      ctaTop: 935,
      ctaLeft: 106,
      microLeft: 382,
      microTop: 954,
      urlRight: 78,
      urlBottom: 43,
      frameInset: 54,
    };
  }

  throw new Error(`Unknown format ${format.key}`);
}

function brand() {
  return `
    <div class="brand">
      <div class="brandMark"></div>
      <div class="brandText"><span>HASHBOX</span><b>.STUDIO</b></div>
    </div>
  `;
}

function chips(route) {
  return route.chips.map((chip) => `<span>${esc(chip)}</span>`).join('');
}

function visual(route, box) {
  const common = `
    <div class="visualTop">
      <div class="trafficDots"><i></i><i></i><i></i></div>
      <strong>${esc(visualTitle(route.visual))}</strong>
    </div>
    <div class="visualMetric">
      <b>${esc(route.metric)}</b>
      <span>${esc(route.metricLabel)}</span>
    </div>
  `;

  return `
    <div class="visualCard">
      ${common}
      ${visualSvg(route, box)}
    </div>
  `;
}

function visualTitle(type) {
  return {
    ai: 'AI workflow map',
    seoReady: 'SEO launch gate',
    seoRecovery: 'Recovery dashboard',
    cro: 'Conversion leak map',
    growth: 'Growth command center',
  }[type];
}

function visualSvg(route, box) {
  const a = route.accent;
  const b = route.accent2;
  if (route.visual === 'ai') {
    return `
      <svg class="visualSvg" viewBox="0 0 840 260" aria-hidden="true">
        <defs>
          <linearGradient id="line-ai" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient>
          <filter id="glow-ai"><feGaussianBlur stdDeviation="4" result="b"/><feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge></filter>
        </defs>
        <g fill="none" stroke="rgba(221,232,255,.13)" stroke-width="1">
          <path d="M35 52H805M35 130H805M35 208H805"/>
        </g>
        <g filter="url(#glow-ai)" stroke="url(#line-ai)" stroke-width="4" fill="none" stroke-linecap="round">
          <path d="M160 130 C270 52 394 70 500 95 S648 130 714 130"/>
          <path d="M160 130 C275 198 402 190 500 160 S650 130 714 130"/>
        </g>
        <g class="node"><rect x="58" y="96" width="205" height="68" rx="22"/><text x="160" y="137">Manual</text></g>
        <g class="node hot"><rect x="332" y="64" width="178" height="62" rx="21"/><text x="421" y="101">AI Bot</text></g>
        <g class="node"><rect x="332" y="148" width="178" height="62" rx="21"/><text x="421" y="185">RAG</text></g>
        <g class="node"><rect x="610" y="96" width="180" height="68" rx="22"/><text x="700" y="137">CRM</text></g>
        <g class="pulse" fill="${b}">
          <circle cx="421" cy="95" r="5"/><circle cx="610" cy="130" r="5"/><circle cx="332" cy="179" r="5"/>
        </g>
      </svg>
    `;
  }
  if (route.visual === 'seoReady') {
    return `
      <svg class="visualSvg" viewBox="0 0 840 260" aria-hidden="true">
        <defs>
          <linearGradient id="ring-seo" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient>
        </defs>
        <g transform="translate(64 44)">
          <circle cx="82" cy="82" r="70" fill="none" stroke="rgba(221,232,255,.12)" stroke-width="18"/>
          <circle cx="82" cy="82" r="70" fill="none" stroke="url(#ring-seo)" stroke-width="18" stroke-dasharray="410 440" stroke-linecap="round" transform="rotate(-90 82 82)"/>
          <text class="big" x="82" y="82">100</text>
          <text class="small" x="82" y="112">Lighthouse</text>
        </g>
        <g class="checklist" transform="translate(250 42)">
          <rect x="0" y="0" width="520" height="178" rx="26" fill="rgba(255,255,255,.035)" stroke="rgba(37,217,255,.22)"/>
          <g class="row" transform="translate(34 38)"><circle cx="13" cy="13" r="13"/><path d="M7 13l5 5 9-12"/><text x="45" y="18">Core Web Vitals</text><rect x="330" y="3" width="118" height="20" rx="10"/></g>
          <g class="row" transform="translate(34 82)"><circle cx="13" cy="13" r="13"/><path d="M7 13l5 5 9-12"/><text x="45" y="18">Schema + Sitemap</text><rect x="330" y="3" width="94" height="20" rx="10"/></g>
          <g class="row" transform="translate(34 126)"><circle cx="13" cy="13" r="13"/><path d="M7 13l5 5 9-12"/><text x="45" y="18">GA4 / GSC events</text><rect x="330" y="3" width="136" height="20" rx="10"/></g>
        </g>
      </svg>
    `;
  }
  if (route.visual === 'seoRecovery') {
    return `
      <svg class="visualSvg" viewBox="0 0 840 260" aria-hidden="true">
        <defs><linearGradient id="chart-recovery" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
        <g class="chartGrid" stroke="rgba(221,232,255,.12)">
          <path d="M74 62H764M74 112H764M74 162H764M74 212H764"/>
        </g>
        <path d="M74 190 C160 178 186 194 255 170 S354 152 426 160 548 144 618 92 706 64 764 48" fill="none" stroke="url(#chart-recovery)" stroke-width="8" stroke-linecap="round"/>
        <path d="M74 190 C160 178 186 194 255 170 S354 152 426 160 548 144 618 92 706 64 764 48 L764 220 L74 220Z" fill="url(#chart-recovery)" opacity=".12"/>
        <g class="pillGroup">
          <rect x="96" y="70" width="134" height="40" rx="20"/><text x="163" y="96">Indexation</text>
          <rect x="268" y="44" width="110" height="40" rx="20"/><text x="323" y="70">CWV</text>
          <rect x="418" y="88" width="124" height="40" rx="20"/><text x="480" y="114">Schema</text>
        </g>
      </svg>
    `;
  }
  if (route.visual === 'cro') {
    return `
      <svg class="visualSvg" viewBox="0 0 840 260" aria-hidden="true">
        <defs><linearGradient id="funnel-cro" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
        <g transform="translate(68 48)">
          <path d="M0 0H460L394 54H66Z" fill="rgba(37,217,255,.14)" stroke="rgba(37,217,255,.34)"/>
          <path d="M66 68H394L336 122H124Z" fill="rgba(47,115,255,.18)" stroke="rgba(47,115,255,.40)"/>
          <path d="M124 136H336L294 186H166Z" fill="rgba(255,122,217,.14)" stroke="rgba(255,122,217,.36)"/>
          <text x="28" y="35">Traffic</text><text x="145" y="103">Landing</text><text x="182" y="171">Lead</text>
        </g>
        <g transform="translate(570 40)" class="heat">
          <rect x="0" y="0" width="190" height="180" rx="24"/>
          <circle cx="45" cy="46" r="18"/><circle cx="100" cy="70" r="12"/><circle cx="148" cy="42" r="22"/>
          <circle cx="62" cy="124" r="10"/><circle cx="126" cy="132" r="28"/><circle cx="160" cy="104" r="9"/>
          <text x="95" y="212">Heatmap signal</text>
        </g>
      </svg>
    `;
  }
  return `
    <svg class="visualSvg" viewBox="0 0 840 260" aria-hidden="true">
      <defs><linearGradient id="flow-growth" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
      <g class="dashTiles">
        <rect x="58" y="48" width="176" height="132" rx="24"/><text x="146" y="100">Traffic</text><path d="M94 138h104"/>
        <rect x="332" y="48" width="176" height="132" rx="24"/><text x="420" y="100">Lead</text><path d="M368 138h104"/>
        <rect x="606" y="48" width="176" height="132" rx="24"/><text x="694" y="100">AI</text><path d="M642 138h104"/>
      </g>
      <g stroke="url(#flow-growth)" stroke-width="6" stroke-linecap="round" fill="none">
        <path d="M238 114H322"/><path d="M512 114H596"/>
      </g>
      <g fill="url(#flow-growth)"><circle cx="280" cy="114" r="7"/><circle cx="554" cy="114" r="7"/></g>
      <rect x="236" y="200" width="370" height="38" rx="19" fill="rgba(37,217,255,.11)" stroke="rgba(37,217,255,.28)"/>
      <text class="centerSmall" x="421" y="225">1 Dashboard • 1 KPI • 1 Team</text>
    </svg>
  `;
}

function html(routeKey, format) {
  const route = routes[routeKey];
  const box = layout(format, routeKey);
  const isWide = format.key === 'linkedin_wide';
  const logoSize = 42 * box.brandScale;
  const brandFont = 26 * box.brandScale;
  const badgeFont = isWide ? 13 : 15;
  const ctaFont = isWide ? 18 : 22;
  const ctaPadX = isWide ? 20 : 26;
  const ctaPadY = isWide ? 11 : 15;
  const visualClass = isWide ? 'wide' : format.key.replace('meta_', '');
  const visualSvgHeight = isWide ? 210 : format.key === 'meta_story' ? 280 : format.key === 'meta_portrait' ? 210 : 150;
  const microFont = isWide ? 19 : format.key === 'meta_square' ? 22 : 28;

  return `<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<style>
  * { box-sizing: border-box; }
  html, body { margin: 0; width: ${format.width}px; height: ${format.height}px; overflow: hidden; background: #030712; }
  body {
    font-family: "Sukhumvit Set", "Arial Unicode MS", -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    text-rendering: geometricPrecision;
  }
  .art {
    position: relative;
    width: ${format.width}px;
    height: ${format.height}px;
    overflow: hidden;
    color: #f5f8ff;
    background:
      radial-gradient(circle at 84% 12%, rgba(42,104,255,.38), transparent 24%),
      radial-gradient(circle at 15% 82%, rgba(37,217,255,.18), transparent 28%),
      linear-gradient(135deg, #030712 0%, #071330 52%, #081026 100%);
  }
  .noise, .grid, .beam, .frame, .innerFrame { position: absolute; inset: 0; pointer-events: none; }
  .noise {
    opacity: .17;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='96' height='96'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='96' height='96' filter='url(%23n)' opacity='.55'/%3E%3C/svg%3E");
    mix-blend-mode: soft-light;
  }
  .grid {
    opacity: .18;
    background-image:
      linear-gradient(rgba(174,188,215,.35) 1px, transparent 1px),
      linear-gradient(90deg, rgba(174,188,215,.35) 1px, transparent 1px);
    background-size: ${isWide ? 52 : 72}px ${isWide ? 52 : 72}px;
  }
  .beam {
    inset: -15% 26% -18% 42%;
    transform: skewX(-9deg);
    background: linear-gradient(180deg, rgba(42,104,255,.24), rgba(37,217,255,.05));
    filter: blur(.2px);
  }
  .frame {
    inset: ${box.frameInset}px;
    border: 3px solid rgba(42,104,255,.62);
    border-radius: ${isWide ? 34 : 44}px;
    box-shadow: inset 0 0 48px rgba(42,104,255,.15);
  }
  .innerFrame {
    inset: ${box.frameInset + (isWide ? 18 : 22)}px;
    border-radius: ${isWide ? 24 : 34}px;
    background: linear-gradient(145deg, rgba(255,255,255,.035), transparent 46%);
  }
  .dot {
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: ${route.accent};
    opacity: .5;
    box-shadow: 0 0 18px ${route.accent};
  }
  .brand {
    position: absolute;
    left: ${box.brandLeft}px;
    top: ${box.brandTop}px;
    display: flex;
    align-items: center;
    gap: ${14 * box.brandScale}px;
  }
  .brandMark {
    width: ${logoSize}px;
    height: ${logoSize}px;
    border-radius: ${12 * box.brandScale}px;
    background: linear-gradient(135deg, #2A68FF, #3B7CFF);
    box-shadow: 0 18px 42px rgba(42,104,255,.38);
  }
  .brandText {
    font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif;
    font-size: ${brandFont}px;
    font-weight: 900;
    letter-spacing: -0.02em;
    line-height: 1;
  }
  .brandText span { color: #f5f8ff; }
  .brandText b { color: #2A68FF; font-weight: 900; }
  .badge {
    position: absolute;
    left: ${box.badgeLeft}px;
    top: ${box.badgeTop}px;
    display: inline-flex;
    align-items: center;
    min-height: ${isWide ? 30 : 34}px;
    padding: 0 ${isWide ? 15 : 18}px;
    border-radius: 999px;
    color: #f5f8ff;
    font-size: ${badgeFont}px;
    font-weight: 800;
    letter-spacing: 0;
    background: linear-gradient(135deg, ${route.accent}, ${route.accent2});
    box-shadow: 0 12px 34px rgba(42,104,255,.35);
  }
  .headline {
    position: absolute;
    left: ${box.headlineLeft}px;
    top: ${box.headlineTop}px;
    width: ${box.headlineWidth}px;
    color: #f5f8ff;
    font-size: ${box.headlineSize}px;
    font-weight: 900;
    line-height: 1.12;
    letter-spacing: 0;
  }
  .headline .line {
    display: block;
    white-space: nowrap;
    text-shadow: 0 12px 34px rgba(0,0,0,.34);
  }
  .headline .em {
    color: #ffffff;
  }
  .sub {
    position: absolute;
    left: ${box.headlineLeft}px;
    top: ${box.subTop}px;
    width: ${isWide ? 630 : 880}px;
    color: #c8d5ee;
    font-size: ${box.subSize}px;
    font-weight: 500;
    line-height: 1.28;
    white-space: nowrap;
  }
  .chips {
    position: absolute;
    left: ${box.headlineLeft}px;
    top: ${box.chipTop}px;
    display: flex;
    gap: ${isWide ? 8 : 10}px;
  }
  .chips span {
    display: inline-flex;
    align-items: center;
    height: ${isWide ? 24 : 30}px;
    padding: 0 ${isWide ? 10 : 12}px;
    border: 1px solid rgba(37,217,255,.46);
    border-radius: 999px;
    color: #dce8ff;
    background: rgba(6,14,33,.68);
    font-size: ${isWide ? 11 : 13}px;
    font-weight: 700;
  }
  .visualWrap {
    position: absolute;
    left: ${box.visualLeft}px;
    top: ${box.visualTop}px;
    width: ${box.visualWidth}px;
    height: ${box.visualHeight}px;
  }
  .visualCard {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    border: 1.5px solid rgba(37,217,255,.58);
    border-radius: ${isWide ? 24 : 28}px;
    background:
      radial-gradient(circle at 82% 18%, rgba(42,104,255,.24), transparent 34%),
      linear-gradient(180deg, rgba(6,14,33,.98), rgba(3,7,18,.92));
    box-shadow: 0 30px 90px rgba(0,0,0,.38), inset 0 1px 0 rgba(255,255,255,.06);
  }
  .visualTop {
    position: absolute;
    left: ${isWide ? 22 : 36}px;
    top: ${isWide ? 20 : 28}px;
    display: flex;
    align-items: center;
    gap: ${isWide ? 12 : 16}px;
    color: #f5f8ff;
    font-size: ${isWide ? 15 : 18}px;
    font-weight: 800;
  }
  .trafficDots { display: flex; gap: 7px; }
  .trafficDots i { width: 10px; height: 10px; border-radius: 999px; display: block; }
  .trafficDots i:nth-child(1) { background: #ff6b82; }
  .trafficDots i:nth-child(2) { background: #ffd166; }
  .trafficDots i:nth-child(3) { background: #61f4b1; }
  .visualMetric {
    position: absolute;
    right: ${isWide ? 24 : 38}px;
    top: ${isWide ? 42 : 52}px;
    text-align: right;
  }
  .visualMetric b {
    display: block;
    color: #f5f8ff;
    font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif;
    font-size: ${isWide ? 40 : 48}px;
    font-weight: 900;
    line-height: .9;
    letter-spacing: -0.04em;
  }
  .visualMetric span {
    display: block;
    margin-top: 5px;
    color: #aebcd7;
    font-size: ${isWide ? 11 : 13}px;
    font-weight: 800;
    text-transform: uppercase;
  }
  .visualSvg {
    position: absolute;
    left: ${isWide ? 20 : 28}px;
    right: ${isWide ? 20 : 28}px;
    bottom: ${isWide ? 20 : 28}px;
    width: calc(100% - ${isWide ? 40 : 56}px);
    height: ${visualSvgHeight}px;
  }
  .visualCard text {
    fill: #dce8ff;
    font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif;
    font-size: 22px;
    font-weight: 800;
    text-anchor: middle;
  }
  .visualCard .small { fill: #aebcd7; font-size: 15px; font-weight: 800; }
  .visualCard .big { fill: #fff; font-size: 44px; font-weight: 900; dominant-baseline: middle; text-anchor: middle; }
  .visualCard .node rect { fill: rgba(42,104,255,.08); stroke: rgba(37,217,255,.55); stroke-width: 2.2; }
  .visualCard .node.hot rect { fill: rgba(37,217,255,.12); stroke: rgba(37,217,255,.8); }
  .visualCard .node text { font-size: 20px; dominant-baseline: middle; }
  .visualCard .row circle { fill: rgba(37,217,255,.15); stroke: rgba(37,217,255,.8); }
  .visualCard .row path { fill: none; stroke: #61f4b1; stroke-width: 4; stroke-linecap: round; stroke-linejoin: round; }
  .visualCard .row text { text-anchor: start; font-size: 20px; fill: #f5f8ff; }
  .visualCard .row rect { fill: rgba(37,217,255,.2); }
  .pillGroup rect { fill: rgba(37,217,255,.1); stroke: rgba(37,217,255,.35); }
  .pillGroup text { font-size: 17px; dominant-baseline: middle; }
  .heat rect { fill: rgba(255,255,255,.035); stroke: rgba(37,217,255,.26); }
  .heat circle { fill: url(#funnel-cro); opacity: .58; }
  .heat text { fill: #aebcd7; font-size: 15px; }
  .dashTiles rect { fill: rgba(255,255,255,.04); stroke: rgba(37,217,255,.28); }
  .dashTiles text { dominant-baseline: middle; }
  .dashTiles path { stroke: url(#flow-growth); stroke-width: 8; stroke-linecap: round; opacity: .75; }
  .centerSmall { fill: #c8d5ee; font-size: 18px; dominant-baseline: middle; }
  .cta {
    position: absolute;
    left: ${box.ctaLeft}px;
    top: ${box.ctaTop}px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    min-height: ${isWide ? 44 : 56}px;
    padding: ${ctaPadY}px ${ctaPadX}px;
    border-radius: 999px;
    color: #fff;
    background: linear-gradient(135deg, ${route.accent}, ${route.accent2});
    box-shadow: 0 18px 46px rgba(42,104,255,.36);
    font-size: ${ctaFont}px;
    font-weight: 900;
    line-height: 1;
  }
  .cta svg { width: ${isWide ? 18 : 22}px; height: ${isWide ? 18 : 22}px; }
  .micro {
    position: absolute;
    left: ${box.microLeft || box.headlineLeft}px;
    top: ${box.microTop}px;
    color: #aebcd7;
    font-size: ${microFont}px;
    font-weight: 600;
    line-height: 1.2;
  }
  .url {
    position: absolute;
    right: ${box.urlRight}px;
    bottom: ${box.urlBottom}px;
    color: rgba(174,188,215,.76);
    font-size: ${isWide ? 16 : 20}px;
    font-weight: 800;
  }
</style>
</head>
<body>
  <main class="art ${visualClass}">
    <div class="grid"></div><div class="beam"></div><div class="noise"></div><div class="innerFrame"></div><div class="frame"></div>
    <i class="dot" style="left:14%;top:72%"></i>
    <i class="dot" style="left:42%;top:8%"></i>
    <i class="dot" style="left:78%;top:22%"></i>
    <i class="dot" style="left:88%;top:65%"></i>
    ${brand()}
    <div class="badge">${esc(route.label)}</div>
    <div class="headline">
      <span class="line">${esc(route.headline[0])}</span>
      <span class="line em">${esc(route.headline[1])}</span>
    </div>
    <div class="sub">${esc(route.sub)}</div>
    <div class="chips">${chips(route)}</div>
    <div class="visualWrap">${visual(route, box)}</div>
    <div class="cta">${esc(route.cta)} <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h13M13 6l6 6-6 6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
    <div class="micro">${esc(route.micro)}</div>
    <div class="url">${esc(route.url)}</div>
  </main>
</body>
</html>`;
}

function screenshot(routeKey, format) {
  const file = `${format.prefix}_${routeKey}_v4.png`;
  const htmlPath = join(tmpDir, `${file}.html`);
  const tmpPng = join(tmpDir, file);
  writeFileSync(htmlPath, html(routeKey, format), 'utf8');

  const result = spawnSync(chrome, [
    '--headless=new',
    '--disable-gpu',
    '--no-sandbox',
    '--no-first-run',
    '--no-default-browser-check',
    '--disable-background-networking',
    '--disable-component-update',
    '--disable-sync',
    '--disable-breakpad',
    '--disable-crash-reporter',
    '--disable-dev-shm-usage',
    '--disable-features=AutofillServerCommunication,MediaRouter,OptimizationHints',
    '--metrics-recording-only',
    '--hide-scrollbars',
    '--force-device-scale-factor=1',
    `--user-data-dir=${join(tmpDir, `chrome-profile-${file}`)}`,
    `--window-size=${format.width},${format.height}`,
    `--screenshot=${tmpPng}`,
    `file://${htmlPath}`,
  ], { stdio: 'pipe', timeout: 45000 });

  if (!existsSync(tmpPng)) {
    const stderr = result.stderr ? result.stderr.toString('utf8') : '';
    throw new Error(`Chrome did not create ${file}\n${stderr}`);
  }

  copyFileSync(tmpPng, join(themeOut, file));
  copyFileSync(tmpPng, join(kitOut, file));
  unlinkSync(htmlPath);
  unlinkSync(tmpPng);
  console.log(`${file} ${format.width}x${format.height}`);
}

for (const routeKey of routeOrder) {
  for (const format of formats) {
    if (process.env.ONLY_ROUTE && process.env.ONLY_ROUTE !== routeKey) continue;
    if (process.env.ONLY_FORMAT && process.env.ONLY_FORMAT !== format.key) continue;
    screenshot(routeKey, format);
  }
}
