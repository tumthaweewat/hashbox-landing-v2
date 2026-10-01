/** Render isolated PHP fixtures using the CI runner's Chrome. Never submit forms. */
import { readFile, mkdir, writeFile } from 'node:fs/promises';
import { execFileSync, spawn } from 'node:child_process';
import { createServer } from 'node:http';
import { resolve, extname, sep } from 'node:path';
import assert from 'node:assert/strict';

const root = resolve('.');
const output = resolve('artifacts/ai-solution-preview');
await mkdir(output, { recursive: true });
const fixtures = new Map();
const probe = `<script>document.fonts.ready.then(() => {
 const fields = [...document.querySelectorAll('[name="workflow_type"], [name="current_systems"], [name="work_volume"]')];
 const report = {width: innerWidth, scrollWidth: document.documentElement.scrollWidth,
 examples: document.querySelectorAll('.hb-solution-example').length,
 badFacts: [...document.querySelectorAll('.hb-solution-example dd')].filter(n => n.scrollWidth > n.clientWidth + 1).length,
 fields: fields.map(n => ({name: n.name, required: n.required, visible: n.getBoundingClientRect().height > 0}))};
 document.documentElement.setAttribute('data-qa-layout', btoa(JSON.stringify(report)));
});</script>`;
for (const page of ['audit', 'service']) {
  let html = execFileSync('php', ['tools/test-ai-solution-intake.php', `--render-${page}`], { encoding: 'utf8' });
  html = html.replace('<details class="hb-ai-form__optional">', '<details class="hb-ai-form__optional" open>');
  fixtures.set(`/${page}.html`, html.replace('</body>', probe + '</body>'));
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
try {
  for (const page of ['audit', 'service']) for (const width of [390, 1440]) {
    const args = ['--headless', '--no-sandbox', '--disable-gpu', '--hide-scrollbars', '--force-device-scale-factor=1', '--no-first-run', '--disable-background-networking', '--virtual-time-budget=5000', `--window-size=${width},900`, `--screenshot=${output}/${page}-${width}.png`, '--dump-dom', `http://127.0.0.1:${port}/${page}.html`];
    const html = await new Promise((done, reject) => {
      const child = spawn(process.env.AI_TEST_CHROME || 'google-chrome', args);
      let out = '', err = '';
      child.stdout.on('data', chunk => { out += chunk; });
      child.stderr.on('data', chunk => { err += chunk; });
      child.on('error', reject);
      child.on('close', code => code === 0 ? done(out) : reject(new Error(err)));
    });
    const encoded = html.match(/data-qa-layout="([A-Za-z0-9+/=]+)"/)?.[1];
    assert.ok(encoded, 'Fonts and page layout must finish before capture');
    const report = JSON.parse(Buffer.from(encoded, 'base64').toString());
    assert.equal(report.width, width);
    assert.ok(report.scrollWidth <= width + 1, `${page}: horizontal overflow`);
    assert.equal(report.examples, 3);
    assert.equal(report.badFacts, 0);
    if (page === 'audit') {
      assert.equal(report.fields.length, 3);
      assert.ok(report.fields.every(field => field.visible && !field.required));
    }
    reports.push({ page, ...report });
  }
} finally { await new Promise(done => server.close(done)); }
await writeFile(output + '/layout.json', JSON.stringify(reports, null, 2));
console.log(JSON.stringify(reports));
