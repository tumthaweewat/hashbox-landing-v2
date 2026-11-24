/** Run against a local WordPress preview with the same Playwright/Chrome setup as the layout tests. */
import assert from 'node:assert/strict';
import { pathToFileURL } from 'node:url';
const { chromium } = await import(pathToFileURL(process.env.AI_QA_PLAYWRIGHT));
const origin = new URL(process.argv[2]).origin;
assert.ok(['127.0.0.1', 'localhost'].includes(new URL(origin).hostname));
const browser = await chromium.launch({ executablePath: process.env.AI_TEST_CHROME || '/usr/bin/google-chrome' });
const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));
try {
  for (const width of [390, 1512]) {
    const height = width === 390 ? 844 : 808;
    const page = await browser.newPage({ viewport: { width, height } });
    const cdp = await page.context().newCDPSession(page);
    await cdp.send('Network.enable');
    await cdp.send('Network.setCacheDisabled', { cacheDisabled: true });
    await cdp.send('Fetch.enable', { patterns: [{ urlPattern: '*.woff2*' }] });
    cdp.on('Fetch.requestPaused', async ({ requestId }) => {
      await sleep(3000);
      await cdp.send('Fetch.continueRequest', { requestId }).catch(() => {});
    });
    async function pressVisible(selector) {
      const point = await page.evaluate(selector => {
        const el = document.querySelector(selector);
        const rect = el.getBoundingClientRect();
        const x = Math.min(innerWidth - 1, rect.x + rect.width / 2);
        const y = Math.min(innerHeight - 1, rect.y + rect.height / 2);
        return el.contains(document.elementFromPoint(x, y)) ? {x, y} : null;
      }, selector);
      if (!point) return false;
      await page.mouse.click(point.x, point.y);
      return true;
    }
    await page.addInitScript(() => {
      window.contactHits = [];
      document.addEventListener('click', event => {
        const link = event.target.closest('a');
        if (link?.hash === '#contact') window.contactHits.push([performance.now(), document.readyState, event.isTrusted]);
      }, true);
    });
    for (const entry of ['plain', 'seo', 'ai-search', 'from-seo', 'from-ai-search']) {
      const service = entry === 'plain' ? '' : entry.replace(/^from-/, '');
      const destination = origin + '/' + (service ? '?service=' + service : '') + '#contact';
      for (const waitMs of [0, 100, 250, 500, 1200]) {
        await page.goto('about:blank');
        if (entry.startsWith('from-')) {
          await page.goto(origin + '/services/' + service + '/');
          await Promise.all([
            page.waitForURL(destination, { waitUntil: 'domcontentloaded' }),
            page.locator('a[href$="?service=' + service + '#contact"]').first().click({ noWaitAfter: true })
          ]);
        } else {
          await page.goto(destination, { waitUntil: 'domcontentloaded' });
        }
        if (process.argv.includes('--landed')) {
          await page.waitForFunction(() => scrollY > innerHeight, null, {polling: 20});
        }
        const beforeY = await page.evaluate(() => scrollY);
        if (width === 390) assert.ok(await pressVisible('#navBurger'));
        const elapsed = await page.evaluate(() => performance.now() - performance.getEntriesByType('navigation')[0].domContentLoadedEventEnd);
        await sleep(Math.max(0, waitMs - elapsed));
        // Hit-test the fixed header/drawer in place. Locator.click() could scroll the page.
        const selector = width === 390 ? '.hb-sheet__footer a' : '.hb-nav__cta--drawer-backed';
        let clicked = false;
        for (let attempt = 0; attempt < 60 && !clicked; attempt++) {
          clicked = await pressVisible(selector);
          if (!clicked) await sleep(10);
        }
        assert.ok(clicked, 'Menu contact link must be reachable from the landing position');
        await page.waitForLoadState('load');
        await page.evaluate(() => document.fonts.ready);
        const samples = [];
        for (let frame = 0; frame < 4; frame++) {
          await sleep(150);
          samples.push(await page.evaluate(() => [
            document.querySelector('.hb-contact-v3 h2').getBoundingClientRect().top,
            document.querySelector('#contact-name').getBoundingClientRect().top
          ]));
        }
        const state = await page.evaluate(() => ({
          url: location.href, active: document.activeElement.id,
          hits: window.contactHits, domReady: performance.getEntriesByType('navigation')[0].domContentLoadedEventEnd,
          services: [...document.querySelectorAll('[name="services[]"]:checked')].map(el => el.value),
          leads: (window.dataLayer || []).filter(e => ['generate_lead', 'hb_home_lead_v1'].includes(e.event)).length
        }));
        console.log(JSON.stringify({width, entry, waitMs, beforeY, samples, state}));
        assert.equal(state.url, destination);
        assert.equal(state.active, 'contact');
        assert.deepEqual(state.services, service ? [service] : []);
        assert.equal(state.leads, 0);
        assert.ok(state.hits.at(-1)?.[2]);
        for (const [heading, name] of samples) {
          assert.ok(Math.abs(heading - 84) <= 2 && name > 68 && name < height);
        }
      }
    }
    await page.close();
  }
} finally { await browser.close(); }
