#!/usr/bin/env node
/**
 * DataForSEO client for Hashbox keyword research.
 *
 * Pulls the three things `.claude/skills/seo-keyword/SKILL.md` asks for:
 * search volume, keyword ideas, and live SERP composition — including
 * whether the SERP carries an AI Overview, which is the signal the
 * current content plan is built around.
 *
 * Credentials come from the environment, never from a file in the repo:
 *   export DATAFORSEO_LOGIN=...
 *   export DATAFORSEO_PASSWORD=...
 *
 * Usage:
 *   node tools/dataforseo.mjs check
 *   node tools/dataforseo.mjs volume "geo คือ" "llms.txt ต้องทำไหม"
 *   node tools/dataforseo.mjs ideas "ai overview"
 *   node tools/dataforseo.mjs serp "ทำเว็บ wordpress ให้ติด ai overview"
 *   node tools/dataforseo.mjs plan seo-handoff/keyword-plan-2026-08.md
 *
 * Add --json to any command to get the parsed rows instead of a table.
 *
 * Endpoint shapes were written without access to docs.dataforseo.com
 * (blocked by the egress proxy from the environment this was authored in).
 * `check` verifies credentials and connectivity before anything else runs;
 * if an endpoint has moved, the API returns its own status_message and this
 * script prints it verbatim rather than guessing.
 */

import { readFileSync } from 'node:fs';

const API = 'https://api.dataforseo.com/v3';

// Thailand / Thai. Override with DATAFORSEO_LOCATION + DATAFORSEO_LANGUAGE
// when researching the English pages (/en/ai-consulting/ targets US/UK queries).
const LOCATION = Number(process.env.DATAFORSEO_LOCATION ?? 2764);
const LANGUAGE = process.env.DATAFORSEO_LANGUAGE ?? 'th';

function credentials() {
  const login = process.env.DATAFORSEO_LOGIN;
  const password = process.env.DATAFORSEO_PASSWORD;
  if (!login || !password) {
    console.error(
      'Missing credentials.\n\n' +
        '  export DATAFORSEO_LOGIN=your-api-login\n' +
        '  export DATAFORSEO_PASSWORD=your-api-password\n\n' +
        'Both are on the DataForSEO dashboard under API Access. They are not\n' +
        'your website login. Never commit them — set them in the shell, or in\n' +
        'the Claude Code environment settings for web sessions.'
    );
    process.exit(1);
  }
  return Buffer.from(`${login}:${password}`).toString('base64');
}

const UNREACHABLE =
  'If this is a Claude Code web session, the environment only allows outbound\n' +
  'traffic to hosts on its allowlist, and api.dataforseo.com is not on it.\n' +
  'Add it to the environment network policy, or run this script locally.';

async function request(path, body) {
  let response;
  try {
    response = await fetch(`${API}${path}`, {
      method: body ? 'POST' : 'GET',
      headers: {
        Authorization: `Basic ${credentials()}`,
        ...(body ? { 'Content-Type': 'application/json' } : {}),
      },
      ...(body ? { body: JSON.stringify(body) } : {}),
    });
  } catch (cause) {
    throw new Error(`Could not reach api.dataforseo.com — ${cause.message}\n\n${UNREACHABLE}`);
  }

  if (response.status === 401) {
    throw new Error('DataForSEO rejected the credentials (401). Check DATAFORSEO_LOGIN and DATAFORSEO_PASSWORD.');
  }

  // A proxy sitting in front of us answers with its own non-JSON body, so
  // parse defensively — otherwise the real problem shows up as a JSON error.
  const text = await response.text();
  let payload;
  try {
    payload = JSON.parse(text);
  } catch {
    throw new Error(
      `api.dataforseo.com answered HTTP ${response.status} with a non-JSON body:\n` +
        `  ${text.slice(0, 200).replace(/\s+/g, ' ').trim()}\n\n${UNREACHABLE}`
    );
  }

  // DataForSEO reports failures inside a 200 body, so status_code is the
  // thing to trust, not the HTTP code. 20000 means the request was accepted.
  if (payload.status_code !== 20000) {
    throw new Error(`DataForSEO: ${payload.status_code} ${payload.status_message}`);
  }

  const task = payload.tasks?.[0];
  if (!task) throw new Error('DataForSEO returned no task.');
  if (task.status_code !== 20000) {
    throw new Error(`DataForSEO task: ${task.status_code} ${task.status_message}`);
  }

  return task.result ?? [];
}

/** Cost is per request and adds up over a research session — always show it. */
async function postWithCost(path, body, label) {
  const started = Date.now();
  const result = await request(path, body);
  const seconds = ((Date.now() - started) / 1000).toFixed(1);
  console.error(`  ${label} — ${seconds}s`);
  return result;
}

// ---------------------------------------------------------------- commands

async function check() {
  const result = await request('/appendix/user_data');
  const money = result[0]?.money;
  console.log('Credentials OK.');
  if (money) {
    console.log(`Balance: ${money.balance} ${money.currency ?? ''}`.trim());
    if (money.balance !== undefined && money.balance < 5) {
      console.log('Balance is low — top up before a full research run.');
    }
  }
  console.log(`Querying as location_code=${LOCATION} language_code=${LANGUAGE}`);
}

async function volume(keywords) {
  const result = await postWithCost(
    '/keywords_data/google_ads/search_volume/live',
    [{ keywords, location_code: LOCATION, language_code: LANGUAGE }],
    `search volume for ${keywords.length} keyword(s)`
  );

  return result
    .map((row) => ({
      keyword: row.keyword,
      volume: row.search_volume,
      competition: row.competition,
      cpc: row.cpc,
      // A rising trend on a low-volume keyword is exactly the "emerging"
      // signal the plan is chasing — surface it rather than burying it.
      trend: trendOf(row.monthly_searches),
    }))
    .sort((a, b) => (b.volume ?? 0) - (a.volume ?? 0));
}

/** Compare the last 3 months against the 3 before them. */
function trendOf(monthly) {
  if (!Array.isArray(monthly) || monthly.length < 6) return null;
  const sum = (rows) => rows.reduce((total, row) => total + (row.search_volume ?? 0), 0);
  const recent = sum(monthly.slice(0, 3));
  const previous = sum(monthly.slice(3, 6));
  if (previous === 0) return recent > 0 ? 'new' : null;
  return `${recent > previous ? '+' : ''}${Math.round(((recent - previous) / previous) * 100)}%`;
}

async function ideas(seed, limit = 50) {
  const result = await postWithCost(
    '/dataforseo_labs/google/keyword_ideas/live',
    [{ keywords: [seed], location_code: LOCATION, language_code: LANGUAGE, limit }],
    `keyword ideas for "${seed}"`
  );

  return (result[0]?.items ?? [])
    .map((item) => ({
      keyword: item.keyword,
      volume: item.keyword_info?.search_volume,
      competition: item.keyword_info?.competition,
      difficulty: item.keyword_properties?.keyword_difficulty,
      trend: trendOf(item.keyword_info?.monthly_searches),
    }))
    .sort((a, b) => (b.volume ?? 0) - (a.volume ?? 0));
}

async function serp(keyword) {
  const result = await postWithCost(
    '/serp/google/organic/live/advanced',
    [{ keyword, location_code: LOCATION, language_code: LANGUAGE, device: 'desktop', depth: 20 }],
    `SERP for "${keyword}"`
  );

  const items = result[0]?.items ?? [];

  // Which SERP features are present matters more than the ranking list:
  // an ai_overview block means the click is already being intercepted, and
  // that changes whether the keyword is worth an article at all.
  const features = [...new Set(items.map((item) => item.type))];
  const aiOverview = items.find((item) => item.type === 'ai_overview');

  return {
    keyword,
    hasAiOverview: Boolean(aiOverview),
    aiOverviewSources: (aiOverview?.references ?? []).map((ref) => ref.domain).filter(Boolean),
    features,
    organic: items
      .filter((item) => item.type === 'organic')
      .slice(0, 10)
      .map((item) => ({ rank: item.rank_group, domain: item.domain, title: item.title })),
  };
}

/**
 * Read the hero keywords out of a plan file and fill in the numbers that
 * were left as N/A when it was written without API access.
 */
async function plan(path) {
  const text = readFileSync(path, 'utf8');

  // Heroes are the bolded cell in each table row: | A1 | **keyword** | ...
  const keywords = [...text.matchAll(/^\|\s*[A-C]\d+\s*\|\s*\*\*(.+?)\*\*/gm)].map((match) =>
    match[1].replace(/\s*🔥\s*/g, '').trim()
  );

  if (!keywords.length) {
    throw new Error(`No hero keywords found in ${path}. Expected rows like: | A1 | **keyword** | ...`);
  }

  console.error(`Found ${keywords.length} hero keywords in ${path}\n`);

  const volumes = await volume(keywords);
  const byKeyword = new Map(volumes.map((row) => [row.keyword, row]));

  const rows = [];
  for (const keyword of keywords) {
    const serpData = await serp(keyword);
    const volumeData = byKeyword.get(keyword) ?? {};
    rows.push({
      keyword,
      volume: volumeData.volume,
      trend: volumeData.trend,
      competition: volumeData.competition,
      hasAiOverview: serpData.hasAiOverview,
      aiOverviewSources: serpData.aiOverviewSources,
      topDomains: serpData.organic.slice(0, 5).map((row) => row.domain),
    });
  }
  return rows;
}

// ----------------------------------------------------------------- output

function table(rows) {
  if (!rows.length) return 'No results.';
  const columns = Object.keys(rows[0]);
  const cell = (value) => {
    if (value === null || value === undefined) return '—';
    if (Array.isArray(value)) return value.join(', ') || '—';
    if (typeof value === 'boolean') return value ? 'yes' : 'no';
    return String(value);
  };
  const widths = columns.map((column) =>
    Math.max(column.length, ...rows.map((row) => cell(row[column]).length))
  );
  const line = (cells) => cells.map((value, index) => cell(value).padEnd(widths[index])).join('  ');
  return [line(columns), widths.map((width) => '-'.repeat(width)).join('  '), ...rows.map((row) => line(columns.map((column) => row[column])))].join('\n');
}

// -------------------------------------------------------------------- cli

const [command, ...rest] = process.argv.slice(2);
const asJson = rest.includes('--json');
const args = rest.filter((arg) => arg !== '--json');

try {
  switch (command) {
    case 'check':
      await check();
      break;
    case 'volume': {
      if (!args.length) throw new Error('Usage: volume "keyword" ["keyword" ...]');
      const rows = await volume(args);
      console.log(asJson ? JSON.stringify(rows, null, 2) : table(rows));
      break;
    }
    case 'ideas': {
      if (!args[0]) throw new Error('Usage: ideas "seed keyword" [limit]');
      const rows = await ideas(args[0], args[1] ? Number(args[1]) : undefined);
      console.log(asJson ? JSON.stringify(rows, null, 2) : table(rows));
      break;
    }
    case 'serp': {
      if (!args[0]) throw new Error('Usage: serp "keyword"');
      const result = await serp(args[0]);
      if (asJson) {
        console.log(JSON.stringify(result, null, 2));
      } else {
        console.log(`\n${result.keyword}`);
        console.log(`AI Overview: ${result.hasAiOverview ? `yes — cites ${result.aiOverviewSources.join(', ') || 'unknown'}` : 'no'}`);
        console.log(`SERP features: ${result.features.join(', ')}\n`);
        console.log(table(result.organic));
      }
      break;
    }
    case 'plan': {
      if (!args[0]) throw new Error('Usage: plan path/to/keyword-plan.md');
      const rows = await plan(args[0]);
      console.log(asJson ? JSON.stringify(rows, null, 2) : `\n${table(rows)}`);
      break;
    }
    default:
      console.error(
        [
          'DataForSEO client for Hashbox keyword research.',
          '',
          '  node tools/dataforseo.mjs check',
          '  node tools/dataforseo.mjs volume "keyword" ["keyword" ...]',
          '  node tools/dataforseo.mjs ideas "seed keyword" [limit]',
          '  node tools/dataforseo.mjs serp "keyword"',
          '  node tools/dataforseo.mjs plan seo-handoff/keyword-plan-2026-08.md',
          '',
          'Add --json for raw rows. Needs DATAFORSEO_LOGIN and DATAFORSEO_PASSWORD',
          `in the environment. Querying location_code=${LOCATION} language_code=${LANGUAGE}.`,
        ].join('\n')
      );
      process.exit(1);
  }
} catch (error) {
  console.error(`\n${error.message}`);
  process.exit(1);
}
