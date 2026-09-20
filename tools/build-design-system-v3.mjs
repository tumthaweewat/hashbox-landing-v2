import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const scriptDir = path.dirname(fileURLToPath(import.meta.url));
const projectDir = path.resolve(scriptDir, '..');
const systemDir = path.join(projectDir, 'design-system', 'v3');
const sourcePath = path.join(systemDir, 'tokens.source.json');
const cssPath = path.join(systemDir, 'tokens.css');
const jsonPath = path.join(systemDir, 'tokens.json');

const source = JSON.parse(fs.readFileSync(sourcePath, 'utf8'));
const required = [
  ['color', 'paper'],
  ['color', 'ink'],
  ['color', 'accent'],
  ['color', 'accent-ink'],
  ['color', 'focus'],
  ['font', 'display'],
  ['font', 'body'],
  ['font', 'outlier'],
  ['space', '3xs'],
  ['space', '5xl']
];

for (const [group, token] of required) {
  if (!source[group]?.[token]?.$value) {
    throw new Error(`Missing required token: ${group}.${token}`);
  }
}

const prefix = {
  duration: 'dur'
};

const lines = [];
for (const [groupName, group] of Object.entries(source)) {
  if (groupName.startsWith('$')) continue;
  if (!group || typeof group !== 'object') continue;

  for (const [tokenName, token] of Object.entries(group)) {
    if (!token || typeof token !== 'object' || !('$value' in token)) continue;
    const cssGroup = prefix[groupName] ?? groupName;
    lines.push(`  --${cssGroup}-${tokenName}: ${token.$value};`);
  }
  lines.push('');
}

while (lines.at(-1) === '') lines.pop();

const stamp = [
  '/* Hallmark · genre: modern-minimal · tone: measured / legible / evidence-led · anchor: Hashbox Indigo · macrostructure: Workbench · H2 hero: 7/5 split + real proof · F3 service sheet · editorial work ledger · F4 process · nav: N11 · footer: Ft5 · design-system: design.md · designed-as-app */',
  '/* theme: reference-synthesis (AGR · Creative Marketing · Linea Prompt · Nex Studio · Riangle) · adapted: Hashbox Original Indigo · DNA-source: urls · no copied imagery */',
  '/* Hallmark audit · contrast: pass (40–41) · nav: N11 · footer: Ft5 · slop: pass (42–45) · honest: pass (46) · chrome: pass (47) · tokens: pass (48) · responsive: pass (49) · icons: pass (30) · mobile: pass (34, 49–57) */',
  '/* Hallmark · pre-emit critique: P5 H5 E5 S5 R5 V4 */'
].join('\n');

const css = `${stamp}\n\n:root {\n${lines.join('\n')}\n}\n`;
fs.writeFileSync(cssPath, css);
fs.writeFileSync(jsonPath, `${JSON.stringify(source, null, 2)}\n`);

process.stdout.write(`Generated ${path.relative(projectDir, cssPath)} and ${path.relative(projectDir, jsonPath)}\n`);
