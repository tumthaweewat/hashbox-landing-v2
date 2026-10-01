/** Render isolated PHP fixtures using the CI runner's Chrome. Never submit forms. */
import { readFile, mkdir, writeFile } from 'node:fs/promises';
import { execFileSync } from 'node:child_process';
import { pathToFileURL } from 'node:url';
import { createServer } from 'node:http';
import { resolve, extname, sep } from 'node:path';
import assert from 'node:assert/strict';

const root = resolve('.');
const output = resolve('artifacts/ai-solution-preview');
await mkdir(output, { recursive: true });
const fixtures = new Map();
for (const page of ['audit', 'service']) {
  let html = execFileSync('php', ['tools/test-ai-solution-intake.php', `--render-${page}`], { encoding: 'utf8' });
  html = html.replace('<details class="hb-ai-form__optional">', '<details class="hb-ai-form__optional" open>');
  fixtures.set(`/${page}.html`, html);
}
const types = {'.css': 'text/css', '.woff2': 'font/woff2', '.webp': 'image/webp', '.png': 'image/png', '.svg': 'image/svg+xml'};
const server = createServer(async (req, res) => {
  const path = new URL(req.url, 'http://localhost').pathname;
  if (fixtures.has(path)) { res.setHeader('Content-Type', 'text/html; charset=utf-8'); res.end(fixtures.get(path)); return; }
  const file = resolve(root, path.replace(/^\/theme\//, ''));
  if (!path.startsWith('/theme/') || !file.startsWith(root + sep)) { res.writeHead(404); res.end(); return; }
  try { res.setHeader('Content-Type', types[extname(file)] || 'application/octet-stream'); res.end(await readFile(file)); }
  catch { res.writeHead(404); res.end(); }
});
await new Promise(done => server.listen(0, '127.0.0.1', done));
const port = server.address().port;
const reports = [];
const { chromium } = await import(pathToFileURL(process.env.AI_QA_PLAYWRIGHT));
const browser = await chromium.launch({ executablePath: process.env.AI_TEST_CHROME || '/usr/bin/google-chrome', headless: true });
try {
  for (const target of ['audit', 'service']) for (const width of [390, 1440]) {
    const page = await browser.newPage({ viewport: { width, height: 900 } });
    await page.route('**/*', route => route.request().url().startsWith(`http://127.0.0.1:${port}/`) ? route.continue() : route.abort());
    await page.goto(`http://127.0.0.1:${port}/${target}.html`, { waitUntil: 'networkidle' });
    await page.evaluate(() => document.fonts.ready);
    const report = await page.evaluate(() => ({
      width: innerWidth, scrollWidth: document.documentElement.scrollWidth,
      examples: document.querySelectorAll('.hb-solution-example').length,
      badFacts: [...document.querySelectorAll('.hb-solution-example dd')].filter(n => n.scrollWidth > n.clientWidth + 1).length,
      fields: [...document.querySelectorAll('[name="workflow_type"], [name="current_systems"], [name="work_volume"]')].map(n => ({name: n.name, required: n.required, visible: n.getBoundingClientRect().height > 0}))
    }));
    await page.screenshot({ path: `${output}/${target}-${width}-hero.png` });
    await page.locator('.hb-solution-examples').screenshot({ path: `${output}/${target}-${width}-examples.png` });
    assert.equal(report.width, width);
    assert.ok(report.scrollWidth <= width + 1, `${target}: horizontal overflow`);
    assert.equal(report.examples, 3);
    assert.equal(report.badFacts, 0);
    if (target === 'audit') {
      assert.equal(report.fields.length, 3);
      assert.ok(report.fields.every(field => field.visible && !field.required));
      await page.locator('.hb-ai-form__optional').screenshot({ path: `${output}/audit-${width}-fields.png` });
    }
    reports.push({ page: target, ...report });
    await page.close();
  }
} finally {
  await browser.close();
  await new Promise(done => server.close(done));
}
await writeFile(output + '/layout.json', JSON.stringify(reports, null, 2));
console.log(JSON.stringify(reports));
