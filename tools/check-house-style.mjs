#!/usr/bin/env node
/**
 * House style linter for Hashbox article drafts.
 *
 * The team's writing prompt bans two punctuation habits that read as
 * machine-written: quotation marks used to emphasise a word, and dashes
 * used as mid-sentence punctuation. Both are easy to reintroduce by
 * accident on every edit, so check them mechanically.
 *
 * Hyphens inside English technical terms (answer-first, zero-click,
 * Next.js) are part of the word, not punctuation, and are left alone.
 * Markdown structure (--- rules, |---| table separators, list bullets)
 * is skipped for the same reason.
 *
 *   node tools/check-house-style.mjs seo-handoff/articles/*.md
 *
 * Exits non-zero when something needs a human decision.
 */

import { readFileSync } from 'node:fs';

const RULES = [
  {
    name: 'quotation marks',
    // Straight and curly double quotes anywhere in prose.
    pattern: /["“”]/g,
    hint: 'ใช้ตัวหนาแทนการครอบด้วยเครื่องหมายคำพูด',
  },
  {
    name: 'dash as punctuation',
    // A dash with whitespace on at least one side is doing a comma's job.
    // A hyphen tight between word characters belongs to the word.
    pattern: /(?:\s[—–-]\s|\s[—–-](?=\S)|(?<=\S)[—–]\s)/g,
    hint: 'ตัดเป็นประโยคใหม่ หรือใช้วงเล็บแทน',
  },
];

/** Lines that are markdown scaffolding rather than prose. */
function isStructural(line) {
  const trimmed = line.trim();
  return (
    trimmed === '---' ||
    /^\|[\s|:-]+\|$/.test(trimmed) || // table separator row
    /^[-*]\s/.test(trimmed) // list bullet
  );
}

/** Fenced code blocks and inline code are exempt. */
function stripCode(line) {
  return line.replace(/`[^`]*`/g, (match) => ' '.repeat(match.length));
}

function lint(path) {
  const lines = readFileSync(path, 'utf8').split('\n');
  const findings = [];
  let inFence = false;

  lines.forEach((line, index) => {
    if (/^\s*```/.test(line)) {
      inFence = !inFence;
      return;
    }
    if (inFence || isStructural(line)) return;

    const prose = stripCode(line);
    for (const rule of RULES) {
      rule.pattern.lastIndex = 0;
      let match;
      while ((match = rule.pattern.exec(prose)) !== null) {
        findings.push({
          line: index + 1,
          rule: rule.name,
          hint: rule.hint,
          excerpt: line.slice(Math.max(0, match.index - 40), match.index + 40).trim(),
        });
      }
    }
  });

  return findings;
}

const paths = process.argv.slice(2);
if (!paths.length) {
  console.error('Usage: node tools/check-house-style.mjs <file.md> [file.md ...]');
  process.exit(1);
}

let total = 0;
for (const path of paths) {
  const findings = lint(path);
  total += findings.length;
  if (!findings.length) {
    console.log(`✓ ${path}`);
    continue;
  }
  console.log(`\n✗ ${path} — ${findings.length} to fix`);
  for (const finding of findings) {
    console.log(`  line ${finding.line}  ${finding.rule}`);
    console.log(`    ${finding.excerpt}`);
    console.log(`    → ${finding.hint}`);
  }
}

if (total) {
  console.log(`\n${total} issue(s). See .claude/skills/seo-keyword/references/house-style.md`);
  process.exit(1);
}
console.log('\nHouse style OK.');
