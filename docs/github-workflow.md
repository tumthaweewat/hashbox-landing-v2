# GitHub workflow for Codex and Claude

Use a separate branch and worktree per task, especially when agents run concurrently.
Never stage unrelated user changes. Open a pull request targeting `main`, wait for
all required checks, then merge only when the user has authorized publishing.
Do not push directly to `main`, force push it, or bypass protection.

Required checks:
- `typography`
- `PHP syntax (7.4)`
- `PHP syntax (8.3)`

Branches must be up to date before merging. Pull requests do not require another
person's approval, so a solo owner can merge after checks pass. These rules also
apply to administrators. PHP lint checks syntax only, not WordPress runtime behavior;
browser and functional testing remain necessary.

Before pushing a task branch, confirm in Plesk that this repository deploys only
`main` to `/httpdocs/wp-content/themes/hashbox-studio-v2/`. The checked-in deploy
config specifies `main`, but does not prove the live Plesk setting. A webhook HTTP
204 confirms receipt, not deployment success or branch filtering.

Local checks:
```sh
node tools/test-typography-contract.mjs
node tools/test-php-syntax.mjs
```
