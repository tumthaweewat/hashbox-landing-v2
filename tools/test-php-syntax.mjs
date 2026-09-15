import { execFileSync, spawnSync } from 'node:child_process';

const files = execFileSync('git', ['ls-files', '-z', '--', '*.php'], { encoding: 'utf8' })
  .split('\0').filter(Boolean);
if (!files.length) throw new Error('No tracked PHP files found');
let failed = false;
for (const file of files) {
  const result = spawnSync('php', ['-l', file], { encoding: 'utf8' });
  if (result.error || result.status !== 0) {
    failed = true;
    console.error(`${file}: ${result.error?.message || result.stdout + result.stderr}`);
  }
}
if (failed) process.exit(1);
console.log(`PHP syntax passed: ${files.length} tracked files`);
