#!/usr/bin/env node
/**
 * แปลงไฟล์ handoff (.md) เป็นบล็อก Gutenberg (.gutenberg.html) สำหรับวางลง WordPress
 *
 *   node tools/md-to-gutenberg.mjs seo-handoff/articles/<ชื่อ>.md
 *
 * กติกา:
 * - แปลงเฉพาะส่วนใต้หัวข้อ `## บทความ` — ส่วน Meta/Slug/หมายเหตุทีมด้านบนเป็นของทีม ไม่ใช่เนื้อโพสต์
 * - บรรทัด `# ...` บรรทัดแรกคือชื่อโพสต์ (ตั้งในช่อง Title ของ WP) จึงไม่ถูกใส่ลงในเนื้อหา
 * - หัวข้อ `## FAQ` และทุกอย่างใต้มันถูกแปลงเป็น **Rank Math FAQ block** เพื่อให้ได้ FAQPage schema
 *   (บทความคู่แข่งที่ถืออันดับอยู่มี FAQ แต่ไม่มี schema — ช่องว่างที่เราปิดได้ฟรี)
 * - **แก้ที่ .md เสมอ แล้ว generate ใหม่** ห้ามแก้ .gutenberg.html ด้วยมือ
 */
import { readFileSync, writeFileSync } from 'node:fs';

const src = process.argv[2];
if (!src) {
  console.error('ใช้: node tools/md-to-gutenberg.mjs <ไฟล์.md>');
  process.exit(1);
}

const esc = (s) => s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

/** inline: **หนา** · `โค้ด` · [ข้อความ](ลิงก์) — ทำหลัง escape แล้วเท่านั้น */
const inline = (s) =>
  esc(s)
    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    .replace(/`([^`]+?)`/g, '<code>$1</code>')
    .replace(/\[([^\]]+?)\]\(([^)]+?)\)/g, '<a href="$2">$1</a>');

/** คำตอบ FAQ เป็น **ข้อความล้วน** ตามบทความเดิม — schema ของ FAQPage ไม่ควรมีมาร์กอัปปน */
const plain = (s) =>
  s
    .replace(/\*\*(.+?)\*\*/g, '$1')
    .replace(/`([^`]+?)`/g, '$1')
    .replace(/\[([^\]]+?)\]\([^)]+?\)/g, '$1');

const body = (() => {
  const raw = readFileSync(src, 'utf8');
  const i = raw.indexOf('\n## บทความ');
  if (i < 0) throw new Error('ไม่พบหัวข้อ "## บทความ" ในไฟล์ — ไฟล์นี้ไม่ใช่รูปแบบ handoff');
  return raw.slice(raw.indexOf('\n', i + 1) + 1).split('\n');
})();

const out = [];
const faq = [];
let title = '';
let inFaq = false;
let i = 0;

const pushPara = (text) => out.push(`<!-- wp:paragraph -->\n<p>${inline(text)}</p>\n<!-- /wp:paragraph -->`);

while (i < body.length) {
  const line = body[i];

  if (!line.trim()) { i++; continue; }

  // --- เส้นคั่น
  if (/^---+$/.test(line.trim())) {
    out.push('<!-- wp:separator -->\n<hr class="wp-block-separator has-alpha-channel-opacity"/>\n<!-- /wp:separator -->');
    i++; continue;
  }

  // --- หัวข้อ
  const h = line.match(/^(#{1,4})\s+(.*)$/);
  if (h) {
    const level = h[1].length;
    const text = h[2].trim();
    if (level === 1 && !title) { title = text; i++; continue; }   // ชื่อโพสต์
    if (level === 2 && /^FAQ/i.test(text)) inFaq = true;           // หัวข้อยังแสดงตามเดิม คำถามใต้มันเข้าบล็อก FAQ
    else if (inFaq) { i++; continue; }                             // ไม่ควรมีหัวข้ออื่นใต้ FAQ
    const attr = level === 2 ? '' : ` {"level":${level}}`;         // h2 คือค่าปริยายของบล็อก heading
    out.push(`<!-- wp:heading${attr} -->\n<h${level} class="wp-block-heading">${inline(text)}</h${level}>\n<!-- /wp:heading -->`);
    i++; continue;
  }

  // --- FAQ: คู่ "คำถามตัวหนา" + ย่อหน้าคำตอบ
  if (inFaq) {
    const q = line.match(/^\*\*(.+?)\*\*$/);
    if (q) {
      const answer = [];
      i++;
      while (i < body.length && body[i].trim() && !/^\*\*(.+?)\*\*$/.test(body[i])) { answer.push(body[i].trim()); i++; }
      faq.push({ q: q[1].trim(), a: answer.join(' ') });
      continue;
    }
    i++; continue;
  }

  // --- โค้ดบล็อก (สูตรคำนวณ — ต้องอยู่บรรทัดเดี่ยวเพื่อให้ AI หยิบไปอ้างง่าย)
  if (line.trim().startsWith('```')) {
    const code = [];
    i++;
    while (i < body.length && !body[i].trim().startsWith('```')) { code.push(body[i]); i++; }
    i++;
    out.push(`<!-- wp:code -->\n<pre class="wp-block-code"><code>${esc(code.join('\n'))}</code></pre>\n<!-- /wp:code -->`);
    continue;
  }

  // --- ตาราง
  if (line.trim().startsWith('|')) {
    const rows = [];
    while (i < body.length && body[i].trim().startsWith('|')) { rows.push(body[i].trim()); i++; }
    const cells = (r) => r.split('|').slice(1, -1).map((c) => c.trim());
    const head = cells(rows[0]);
    const data = rows.slice(2).map(cells);                         // ข้ามแถวเส้นคั่น
    const th = head.map((c) => `<th>${inline(c)}</th>`).join('');
    const tb = data.map((r) => `<tr>${r.map((c) => `<td>${inline(c)}</td>`).join('')}</tr>`).join('');
    out.push(
      `<!-- wp:table -->\n<figure class="wp-block-table"><table><thead><tr>${th}</tr></thead><tbody>${tb}</tbody></table></figure>\n<!-- /wp:table -->`,
    );
    continue;
  }

  // --- quote (TL;DR)
  if (line.trim().startsWith('>')) {
    const q = [];
    while (i < body.length && body[i].trim().startsWith('>')) { q.push(body[i].replace(/^\s*>\s?/, '')); i++; }
    const inner = [];
    let list = [];
    const flush = () => {
      if (!list.length) return;
      inner.push(`<ul>${list.map((t) => `<li>${inline(t)}</li>`).join('')}</ul>`);
      list = [];
    };
    for (const l of q) {
      if (!l.trim()) continue;
      const li = l.match(/^\s*[-*]\s+(.*)$/);
      if (li) { list.push(li[1]); continue; }
      flush();
      inner.push(`<p>${inline(l)}</p>`);
    }
    flush();
    out.push(`<!-- wp:quote -->\n<blockquote class="wp-block-quote">${inner.join('')}</blockquote>\n<!-- /wp:quote -->`);
    continue;
  }

  // --- รายการ
  const li = line.match(/^\s*[-*]\s+(.*)$/);
  if (li) {
    const items = [];
    while (i < body.length) {
      const m = body[i].match(/^\s*[-*]\s+(.*)$/);
      if (!m) break;
      items.push(m[1]); i++;
    }
    const inner = items.map((t) => `<!-- wp:list-item -->\n<li>${inline(t)}</li>\n<!-- /wp:list-item -->`).join('\n');
    out.push(`<!-- wp:list -->\n<ul class="wp-block-list">\n${inner}\n</ul>\n<!-- /wp:list -->`);
    continue;
  }

  const ol = line.match(/^\s*\d+\.\s+(.*)$/);
  if (ol) {
    const items = [];
    while (i < body.length) {
      const m = body[i].match(/^\s*\d+\.\s+(.*)$/);
      if (!m) break;
      items.push(m[1]); i++;
    }
    const inner = items.map((t) => `<!-- wp:list-item -->\n<li>${inline(t)}</li>\n<!-- /wp:list-item -->`).join('\n');
    out.push(`<!-- wp:list {"ordered":true} -->\n<ol class="wp-block-list">\n${inner}\n</ol>\n<!-- /wp:list -->`);
    continue;
  }

  pushPara(line.trim());
  i++;
}

// --- FAQ → Rank Math FAQ block (ได้ FAQPage schema อัตโนมัติ)
if (faq.length) {
  const questions = faq.map((f, n) => ({
    id: `faq-question-${n + 1}`,
    title: plain(f.q),
    content: plain(f.a),
    visible: true,
  }));
  const html = questions
    .map((q) => `<div class="rank-math-faq-item"><h3 class="rank-math-question">${esc(q.title)}</h3><div class="rank-math-answer">${esc(q.content)}</div></div>`)
    .join('');
  out.push(
    `<!-- wp:rank-math/faq-block ${JSON.stringify({ titleWrapper: 'h3', questions })} -->\n<div class="wp-block-rank-math-faq-block">${html}</div>\n<!-- /wp:rank-math/faq-block -->`,
  );
}

const dest = src.replace(/\.md$/, '.gutenberg.html');
writeFileSync(dest, out.join('\n\n') + '\n', 'utf8');
console.log(`✅ ${dest}`);
console.log(`   ชื่อโพสต์: ${title}`);
console.log(`   บล็อก: ${out.length} · FAQ: ${faq.length} ข้อ (Rank Math FAQ block — ได้ FAQPage schema)`);
