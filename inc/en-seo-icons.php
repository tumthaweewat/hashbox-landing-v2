<?php
/**
 * Curated Lucide icons for the English SEO service page.
 *
 * Icon paths: https://github.com/lucide-icons/lucide/tree/main/icons
 * Retrieved 2026-09-20, under ISC / MIT (Feather-derived icons).
 * Copyright (c) 2026 Lucide Icons and Contributors.
 * Copyright (c) 2013-present Cole Bemis (Feather-derived icons).
 * Complete notices: assets/services/seo/LUCIDE-LICENSE.txt
 *
 * SVGs are decorative; the adjacent visible label supplies accessible text.
 * Only the fixed, locally reviewed paths below are ever returned.
 *
 * @package Hashbox_Studio_V2
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return a decorative, currentColor SVG from the approved page icon set.
 *
 * @param string $name Lucide icon name. Unknown names return an empty string.
 * @return string Trusted inline SVG markup.
 */
function hashbox_en_seo_icon($name) {
    static $paths = array(
        'search-check' => '<path d="m8 11 2 2 4-4"/><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'gauge' => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
        'code-xml' => '<path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/>',
        'file-text' => '<path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>',
        'map-pin' => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
        'bot' => '<path d="M12 8V4H8"/><rect width="16" height="12" x="4" y="8" rx="2"/><path d="M2 14h2"/><path d="M20 14h2"/><path d="M15 13v2"/><path d="M9 13v2"/>',
        'mouse-pointer-click' => '<path d="M14 4.1 12 6"/><path d="m5.1 8-2.9-.8"/><path d="m6 12-1.9 2"/><path d="M7.2 2.2 8 5.1"/><path d="M9.037 9.69a.498.498 0 0 1 .653-.653l11 4.5a.5.5 0 0 1-.074.949l-4.349 1.041a1 1 0 0 0-.74.739l-1.04 4.35a.5.5 0 0 1-.95.074z"/>',
        'chart-no-axes-combined' => '<path d="M12 16v5"/><path d="M16 14.639V21"/><path d="M20 10.656V21"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18.463V21"/><path d="M8 14.656V21"/>',
        'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
        'plus' => '<path d="M5 12h14"/><path d="M12 5v14"/>',
        'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
    );

    if (!is_string($name) || !isset($paths[$name])) {
        return '';
    }

    return '<svg class="en-seo-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[$name] . '</svg>';
}
