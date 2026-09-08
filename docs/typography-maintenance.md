# Production typography

Signal V3 font roles are defined in `design-system/fonts.css`:

- `--ci-font-display`: IBM Plex Sans Thai — headings.
- `--ci-font-body`: Noto Sans Thai — paragraphs, navigation, forms and buttons.
- `--ci-font-data`: IBM Plex Mono, with Thai fallback — code and selected data slots.

Legacy tokens reference these roles. Do not redeclare literal font families in
page-level font tokens. `css/heading-ci.css` applies the public typography
contract after page styles; it does not migrate their colours or layouts.

After editing design-system layers, run:

```sh
node tools/build-css-bundle.mjs
node tools/test-typography-contract.mjs
```

The GitHub workflow runs the contract on pushes and pull requests. It detects
literal font-role overrides, missing font assets, optional heading-font loading,
missing global enqueue and a stale production CSS bundle. It is a source check,
not a browser rendering test or a deployment blocker by itself.

For new templates, also inspect computed fonts and wrapping on desktop/mobile.
Check headings, body copy, navigation, form controls and open accordion states.
Existing ad artwork font definitions are assets, not a public-page font policy.
