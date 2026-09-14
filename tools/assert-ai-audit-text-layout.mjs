// Browser regression guard. Call after document.fonts.ready in a page.evaluate.
// At zoom/mobile widths wrapping is intentional; desktop targets start at 1280px.
export function auditTextLayout() {
  const selectors = [
    '.hb-ai-hero__vendor',
    '.hb-ai-usecases__note',
    '.hb-ai-screening__signals li',
    '.hb-ai-engagements__intro .hb-ai-section__lede',
    '.hb-ai-engagements__note',
  ];
  const results = selectors.flatMap(selector => {
    const nodes = [...document.querySelectorAll(selector)];
    if (!nodes.length) throw new Error(`Missing text-layout target: ${selector}`);
    return nodes.map(node => {
      const range = document.createRange();
      range.selectNodeContents(node);
      const lines = [];
      const tolerance = parseFloat(getComputedStyle(node).lineHeight) / 2;
      for (const rect of range.getClientRects()) {
        if (rect.width && rect.height && !lines.some(top => Math.abs(top - rect.top) < tolerance)) lines.push(rect.top);
      }
      const result = { selector, lines: lines.length, width: innerWidth };
      if (innerWidth >= 1280 && result.lines !== 1) throw new Error(JSON.stringify(result));
      if (node.scrollWidth > node.clientWidth + 1) throw new Error(`Text overflow: ${selector}`);
      return result;
    });
  });
  if (document.documentElement.scrollWidth > innerWidth) throw new Error('Page overflow');
  return results;
}
