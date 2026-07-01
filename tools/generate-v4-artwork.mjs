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
    chips: ['ROI Map', 'Use Case', 'Deploy Plan'],
    cta: 'รับ AI Audit ฟรี',
    micro: 'สำหรับทีม Sales, Support, Ops',
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
    chips: ['Lighthouse 100', 'Schema', 'GA4/GSC'],
    cta: 'ขอ SEO Audit ฟรี',
    micro: 'ตรวจ Build Gate ก่อน Deploy',
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
    chips: ['GSC Audit', 'Index Fix', 'Roadmap'],
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
    chips: ['Funnel', 'Heatmap', 'Test Plan'],
    cta: 'ตรวจ Funnel ฟรี',
    micro: 'หา Lead Leak ก่อนเพิ่มงบ',
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
    chips: ['One KPI', 'Dashboard', 'One Team'],
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
const uiFontStack = '"Sukhumvit Set", "Thonburi", "Tahoma", "Arial Unicode MS", sans-serif';

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
      visualTop: 665,
      visualWidth: 868,
      visualHeight: 250,
      ctaTop: 922,
      ctaLeft: 106,
      microTop: 980,
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

function visual(route) {
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
    <div class="visualCard visual-${route.visual}">
      ${common}
      <div class="visualBody">${visualBody(route)}</div>
    </div>
  `;
}

function visualTitle(type) {
  return {
    ai: 'ROI workflow',
    seoReady: 'Launch readiness',
    seoRecovery: 'GSC trend',
    cro: 'Funnel diagnostics',
    growth: 'Growth dashboard',
  }[type];
}

function visualBody(route) {
  const a = route.accent;
  const b = route.accent2;
  if (route.visual === 'ai') {
    return `
      <div class="workflowMap">
        <svg class="flowLines" viewBox="0 0 820 180" preserveAspectRatio="none" aria-hidden="true">
          <defs><linearGradient id="flow-ai" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
          <path d="M150 94 C278 24 398 34 512 68 S650 94 724 94"/>
          <path d="M150 94 C278 150 398 150 512 122 S650 94 724 94"/>
          <circle cx="150" cy="94" r="7"/><circle cx="410" cy="44" r="7"/><circle cx="410" cy="138" r="7"/><circle cx="724" cy="94" r="7"/>
        </svg>
        <div class="flowNode manual"><b>Manual</b><span>handoff</span></div>
        <div class="flowNode aiBot"><b>AI Bot</b><span>answer</span></div>
        <div class="flowNode rag"><b>RAG</b><span>knowledge</span></div>
        <div class="flowNode crm"><b>CRM</b><span>sync</span></div>
      </div>
    `;
  }
  if (route.visual === 'seoReady') {
    return `
      <div class="readyVisual">
        <div class="scoreRing">
          <svg viewBox="0 0 160 160" aria-hidden="true">
            <defs><linearGradient id="ring-seo" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
            <circle cx="80" cy="80" r="64"></circle>
            <circle class="score" cx="80" cy="80" r="64"></circle>
          </svg>
          <b>100</b><span>Lighthouse</span>
        </div>
        <div class="qualityList">
          <div><i></i><span>Core Web Vitals</span><b>Pass</b></div>
          <div><i></i><span>Schema + Sitemap</span><b>Ready</b></div>
          <div><i></i><span>GA4 / GSC Events</span><b>Live</b></div>
        </div>
      </div>
    `;
  }
  if (route.visual === 'seoRecovery') {
    return `
      <div class="recoveryVisual">
        <svg class="trendChart" viewBox="0 0 820 190" preserveAspectRatio="none" aria-hidden="true">
          <defs><linearGradient id="chart-recovery" x1="0" x2="1"><stop stop-color="${a}"/><stop offset="1" stop-color="${b}"/></linearGradient></defs>
          <path class="gridLine" d="M38 36H782M38 84H782M38 132H782M38 180H782"/>
          <path class="area" d="M38 158 C150 150 228 154 316 132 S462 116 560 86 698 56 782 38 L782 190 L38 190Z"/>
          <path class="line" d="M38 158 C150 150 228 154 316 132 S462 116 560 86 698 56 782 38"/>
          <g class="points"><circle cx="38" cy="158" r="7"/><circle cx="316" cy="132" r="7"/><circle cx="560" cy="86" r="7"/><circle cx="782" cy="38" r="7"/></g>
        </svg>
        <div class="signalPills"><span>Index</span><span>CWV</span><span>Schema</span></div>
      </div>
    `;
  }
  if (route.visual === 'cro') {
    return `
      <div class="croVisual">
        <div class="funnelStack">
          <div class="wideStep"><b>Traffic</b><span>visits</span></div>
          <div class="midStep"><b>Landing</b><span>intent</span></div>
          <div class="smallStep"><b>Lead</b><span>submit</span></div>
        </div>
        <div class="heatPanel">
          <i class="h1"></i><i class="h2"></i><i class="h3"></i><i class="h4"></i><i class="h5"></i>
        </div>
      </div>
    `;
  }
  return `
    <div class="growthVisual">
      <div class="growthTile"><b>Traffic</b><span>SEO + Ads</span><i></i></div>
      <div class="growthArrow"></div>
      <div class="growthTile"><b>Lead</b><span>CRO</span><i></i></div>
      <div class="growthArrow"></div>
      <div class="growthTile"><b>AI</b><span>Ops</span><i></i></div>
      <div class="dashboardPill">1 Dashboard • 1 KPI • 1 Team</div>
    </div>
  `;
}

function html(routeKey, format) {
  const route = routes[routeKey];
  const box = layout(format, routeKey);
  const isWide = format.key === 'linkedin_wide';
  const isSquare = format.key === 'meta_square';
  const logoSize = 42 * box.brandScale;
  const brandFont = 26 * box.brandScale;
  const badgeFont = isWide ? 14 : 17;
  const chipFont = isWide ? 12 : format.key === 'meta_square' ? 15 : 16;
  const ctaFont = isWide ? 19 : 23;
  const ctaPadX = isWide ? 20 : 28;
  const ctaPadY = isWide ? 11 : 15;
  const visualClass = isWide ? 'wide' : format.key.replace('meta_', '');
  const visualInset = isWide ? 24 : 34;
  const visualBodyTop = isWide ? 92 : format.key === 'meta_square' ? 88 : 102;
  const visualTitleFont = isWide ? 15 : 19;
  const visualLabelFont = isWide ? 13 : format.key === 'meta_square' ? 15 : 17;
  const visualSmallFont = isWide ? 10 : format.key === 'meta_square' ? 12 : 13;
  const funnelStepHeight = isWide ? 39 : isSquare ? 35 : format.key === 'meta_portrait' ? 42 : 48;
  const funnelGap = isWide ? 9 : isSquare ? 8 : 12;
  const croHeatWidth = isWide ? 132 : isSquare ? 150 : 170;
  const croGap = isWide ? 18 : isSquare ? 18 : 26;
  const microFont = isWide ? 19 : format.key === 'meta_square' ? 22 : 28;

  return `<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<style>
  * { box-sizing: border-box; }
  html, body { margin: 0; width: ${format.width}px; height: ${format.height}px; overflow: hidden; background: #030712; }
  body {
    font-family: ${uiFontStack};
    -webkit-font-smoothing: antialiased;
    text-rendering: geometricPrecision;
    font-synthesis: none;
    font-kerning: normal;
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
    font-family: ${uiFontStack};
    font-size: ${brandFont}px;
    font-weight: 900;
    letter-spacing: 0;
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
    min-height: ${isWide ? 32 : 38}px;
    padding: ${isWide ? 2 : 3}px ${isWide ? 16 : 20}px 0;
    border-radius: 999px;
    color: #f5f8ff;
    font-size: ${badgeFont}px;
    font-weight: 800;
    letter-spacing: 0;
    line-height: 1;
    white-space: nowrap;
    background: linear-gradient(135deg, ${route.accent}, ${route.accent2});
    box-shadow: 0 12px 34px rgba(42,104,255,.35);
  }
  .headline {
    position: absolute;
    left: ${box.headlineLeft}px;
    top: ${box.headlineTop}px;
    width: ${box.headlineWidth}px;
    color: #f5f8ff;
    font-family: ${uiFontStack};
    font-size: ${box.headlineSize}px;
    font-weight: 900;
    line-height: 1.18;
    letter-spacing: 0;
    padding-top: .08em;
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
    font-family: ${uiFontStack};
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
    height: ${isWide ? 28 : 34}px;
    padding: ${isWide ? 1 : 2}px ${isWide ? 12 : 15}px 0;
    border: 1px solid rgba(37,217,255,.46);
    border-radius: 999px;
    color: #dce8ff;
    background: rgba(6,14,33,.68);
    font-family: ${uiFontStack};
    font-size: ${chipFont}px;
    font-weight: 800;
    line-height: 1;
    white-space: nowrap;
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
    left: ${isWide ? 22 : 34}px;
    top: ${isWide ? 20 : 27}px;
    display: flex;
    align-items: center;
    gap: ${isWide ? 12 : 16}px;
    color: #f5f8ff;
    font-family: ${uiFontStack};
    font-size: ${visualTitleFont}px;
    font-weight: 800;
    line-height: 1;
    z-index: 3;
  }
  .trafficDots { display: flex; gap: 7px; }
  .trafficDots i { width: 10px; height: 10px; border-radius: 999px; display: block; }
  .trafficDots i:nth-child(1) { background: #ff6b82; }
  .trafficDots i:nth-child(2) { background: #ffd166; }
  .trafficDots i:nth-child(3) { background: #61f4b1; }
  .visualMetric {
    position: absolute;
    right: ${isWide ? 26 : 38}px;
    top: ${isWide ? 44 : 52}px;
    text-align: right;
    z-index: 3;
  }
  .visualMetric b {
    display: block;
    color: #f5f8ff;
    font-family: ${uiFontStack};
    font-size: ${isWide ? 39 : 48}px;
    font-weight: 900;
    line-height: 1;
    letter-spacing: 0;
  }
  .visualMetric span {
    display: block;
    margin-top: 5px;
    color: #aebcd7;
    font-family: ${uiFontStack};
    font-size: ${isWide ? 11 : 13}px;
    font-weight: 800;
    text-transform: uppercase;
  }
  .visualBody {
    position: absolute;
    left: ${visualInset}px;
    right: ${visualInset}px;
    top: ${visualBodyTop}px;
    bottom: ${visualInset}px;
    font-family: ${uiFontStack};
    font-size: ${visualLabelFont}px;
    z-index: 1;
  }
  .workflowMap, .readyVisual, .recoveryVisual, .croVisual, .growthVisual {
    position: relative;
    width: 100%;
    height: 100%;
  }
  .flowLines {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    overflow: visible;
  }
  .flowLines path {
    fill: none;
    stroke: ${route.accent};
    stroke-width: 6;
    stroke-linecap: round;
    opacity: .86;
  }
  .flowLines circle { fill: ${route.accent2}; }
  .flowNode {
    position: absolute;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 40%;
    min-height: 48px;
    border: 1.5px solid rgba(37,217,255,.48);
    border-radius: 999px;
    background: linear-gradient(180deg, rgba(42,104,255,.14), rgba(6,14,33,.88));
    box-shadow: inset 0 1px 0 rgba(255,255,255,.07), 0 16px 34px rgba(0,0,0,.22);
  }
  .flowNode b {
    color: #f5f8ff;
    font-size: ${visualLabelFont}px;
    font-weight: 900;
    line-height: 1;
  }
  .flowNode span {
    margin-top: 4px;
    color: #aebcd7;
    font-size: ${visualSmallFont}px;
    font-weight: 700;
    line-height: 1;
  }
  .flowNode.manual { left: 0; top: 31%; width: 25%; }
  .flowNode.aiBot { left: 36%; top: 0; width: 28%; }
  .flowNode.rag { left: 36%; bottom: 0; width: 28%; }
  .flowNode.crm { right: 0; top: 31%; width: 25%; }
  .readyVisual {
    display: flex;
    align-items: center;
    gap: ${isWide ? 22 : 30}px;
  }
  .scoreRing {
    position: relative;
    width: ${isWide ? 112 : 132}px;
    height: ${isWide ? 112 : 132}px;
    flex: 0 0 auto;
  }
  .scoreRing svg { position: absolute; inset: 0; width: 100%; height: 100%; }
  .scoreRing circle {
    fill: none;
    stroke: rgba(221,232,255,.13);
    stroke-width: 15;
  }
  .scoreRing .score {
    stroke: ${route.accent2};
    stroke-linecap: round;
    stroke-dasharray: 386 402;
    transform: rotate(-90deg);
    transform-origin: 50% 50%;
  }
  .scoreRing b {
    position: absolute;
    inset: 35% 0 auto;
    color: #fff;
    text-align: center;
    font-size: ${isWide ? 30 : 38}px;
    font-weight: 900;
    line-height: 1;
  }
  .scoreRing span {
    position: absolute;
    left: 0;
    right: 0;
    top: 62%;
    color: #aebcd7;
    text-align: center;
    font-size: ${visualSmallFont}px;
    font-weight: 800;
    line-height: 1;
  }
  .qualityList {
    flex: 1;
    display: grid;
    gap: ${isWide ? 10 : 13}px;
  }
  .qualityList div {
    display: grid;
    grid-template-columns: ${isWide ? 18 : 22}px 1fr auto;
    align-items: center;
    gap: ${isWide ? 10 : 12}px;
    min-height: ${isWide ? 34 : 42}px;
    padding: 0 ${isWide ? 12 : 16}px;
    border: 1px solid rgba(37,217,255,.22);
    border-radius: 999px;
    background: rgba(255,255,255,.04);
  }
  .qualityList i {
    width: ${isWide ? 18 : 22}px;
    height: ${isWide ? 18 : 22}px;
    border-radius: 999px;
    background: radial-gradient(circle at 50% 50%, #61f4b1 0 34%, rgba(97,244,177,.2) 36% 100%);
  }
  .qualityList span {
    color: #f5f8ff;
    font-size: ${visualLabelFont}px;
    font-weight: 800;
    line-height: 1;
  }
  .qualityList b {
    color: #61f4b1;
    font-size: ${visualSmallFont}px;
    font-weight: 900;
    line-height: 1;
    text-transform: uppercase;
  }
  .trendChart {
    position: absolute;
    left: 0;
    right: 0;
    top: ${isWide ? 4 : 0}px;
    width: 100%;
    height: calc(100% - ${isWide ? 38 : 44}px);
  }
  .visual-seoRecovery .trendChart {
    right: ${isWide ? 146 : isSquare ? 230 : 250}px;
    width: auto;
  }
  .trendChart .gridLine {
    fill: none;
    stroke: rgba(221,232,255,.15);
    stroke-width: 1.5;
  }
  .trendChart .area { fill: ${route.accent2}; opacity: .16; }
  .trendChart .line {
    fill: none;
    stroke: ${route.accent2};
    stroke-width: 8;
    stroke-linecap: round;
  }
  .trendChart .points circle { fill: #f5f8ff; stroke: ${route.accent2}; stroke-width: 4; }
  .signalPills {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    gap: ${isWide ? 10 : 13}px;
  }
  .signalPills span {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: ${isWide ? 28 : 34}px;
    border: 1px solid rgba(37,217,255,.28);
    border-radius: 999px;
    color: #dce8ff;
    background: rgba(37,217,255,.08);
    font-size: ${visualLabelFont}px;
    font-weight: 800;
    line-height: 1;
  }
  .croVisual {
    display: grid;
    grid-template-columns: 1fr ${croHeatWidth}px;
    gap: ${croGap}px;
    align-items: stretch;
  }
  .funnelStack {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: ${funnelGap}px;
  }
  .funnelStack div {
    height: ${funnelStepHeight}px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 ${isWide ? 18 : 24}px;
    color: #f5f8ff;
    border: 1px solid rgba(37,217,255,.28);
    background: linear-gradient(90deg, rgba(37,217,255,.18), rgba(255,122,217,.1));
    box-shadow: inset 0 1px 0 rgba(255,255,255,.06);
  }
  .funnelStack .wideStep { width: 100%; border-radius: 18px; }
  .funnelStack .midStep { width: 78%; margin-left: 11%; border-radius: 17px; }
  .funnelStack .smallStep { width: 56%; margin-left: 22%; border-radius: 16px; }
  .funnelStack b { font-size: ${visualLabelFont}px; font-weight: 900; line-height: 1; }
  .funnelStack span { color: #aebcd7; font-size: ${visualSmallFont}px; font-weight: 800; line-height: 1; }
  .heatPanel {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,122,217,.26);
    border-radius: ${isWide ? 20 : 24}px;
    background: radial-gradient(circle at 70% 58%, rgba(255,122,217,.34), transparent 38%), rgba(255,255,255,.04);
  }
  .heatPanel b {
    position: absolute;
    left: ${isWide ? 14 : 18}px;
    top: ${isWide ? 14 : 18}px;
    color: #f5f8ff;
    font-size: ${visualLabelFont}px;
    font-weight: 900;
    line-height: 1;
  }
  .heatPanel i {
    position: absolute;
    display: block;
    border-radius: 999px;
    background: linear-gradient(135deg, ${route.accent}, ${route.accent2});
    opacity: .7;
    filter: blur(.3px);
  }
  .heatPanel .h1 { width: 32px; height: 32px; left: 22%; top: 38%; }
  .heatPanel .h2 { width: 52px; height: 52px; right: 16%; top: 42%; }
  .heatPanel .h3 { width: 22px; height: 22px; left: 44%; top: 24%; }
  .heatPanel .h4 { width: 18px; height: 18px; left: 22%; bottom: 18%; }
  .heatPanel .h5 { width: 28px; height: 28px; right: 34%; bottom: 12%; }
  .growthVisual {
    display: grid;
    grid-template-columns: 1fr ${isWide ? 28 : 36}px 1fr ${isWide ? 28 : 36}px 1fr;
    gap: ${isWide ? 10 : 14}px;
    align-items: start;
    padding-bottom: ${isWide ? 42 : 48}px;
  }
  .growthTile {
    min-height: ${isWide ? 92 : 104}px;
    padding: ${isWide ? 18 : 22}px ${isWide ? 16 : 20}px;
    border: 1px solid rgba(37,217,255,.26);
    border-radius: ${isWide ? 20 : 24}px;
    background: rgba(255,255,255,.045);
    box-shadow: inset 0 1px 0 rgba(255,255,255,.06);
  }
  .growthTile b {
    display: block;
    color: #f5f8ff;
    font-size: ${visualLabelFont}px;
    font-weight: 900;
    line-height: 1;
  }
  .growthTile span {
    display: block;
    margin-top: 8px;
    color: #aebcd7;
    font-size: ${visualSmallFont}px;
    font-weight: 800;
    line-height: 1;
  }
  .growthTile i {
    display: block;
    width: 70%;
    height: 8px;
    margin-top: ${isWide ? 16 : 20}px;
    border-radius: 999px;
    background: linear-gradient(90deg, ${route.accent}, ${route.accent2});
  }
  .growthArrow {
    align-self: center;
    height: 4px;
    border-radius: 999px;
    background: linear-gradient(90deg, ${route.accent}, ${route.accent2});
    box-shadow: 0 0 14px rgba(37,217,255,.3);
  }
  .dashboardPill {
    position: absolute;
    left: 18%;
    right: 18%;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: ${isWide ? 30 : 36}px;
    border: 1px solid rgba(37,217,255,.28);
    border-radius: 999px;
    color: #dce8ff;
    background: rgba(37,217,255,.08);
    font-size: ${visualLabelFont}px;
    font-weight: 800;
    line-height: 1;
  }
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
    font-family: ${uiFontStack};
    font-size: ${ctaFont}px;
    font-weight: 900;
    line-height: 1;
    white-space: nowrap;
  }
  .cta svg { width: ${isWide ? 18 : 22}px; height: ${isWide ? 18 : 22}px; }
  .micro {
    position: absolute;
    left: ${box.microLeft || box.headlineLeft}px;
    top: ${box.microTop}px;
    color: #aebcd7;
    font-family: ${uiFontStack};
    font-size: ${microFont}px;
    font-weight: 600;
    line-height: 1.2;
    white-space: nowrap;
  }
  .url {
    position: absolute;
    right: ${box.urlRight}px;
    bottom: ${box.urlBottom}px;
    color: rgba(174,188,215,.76);
    font-family: ${uiFontStack};
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
