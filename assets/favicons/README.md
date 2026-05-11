# Hashbox Studio Favicons

This folder contains favicon and app icon files for the Hashbox Studio website.

## Files Included:

### Core Favicon Files:
- `favicon.svg` - Modern SVG favicon (32x32) with Hashbox "H" logo
- `favicon-16x16.png` - PNG favicon for older browsers (16x16)
- `favicon-32x32.png` - PNG favicon for standard displays (32x32)

### Mobile App Icons:
- `apple-touch-icon.png` - Apple iOS home screen icon (180x180)
- `android-chrome-192x192.png` - Android Chrome icon (192x192)
- `android-chrome-512x512.png` - Android Chrome icon (512x512)

### Web App Manifest:
- `site.webmanifest` - PWA manifest file for installable web app

## Design Elements:

The favicon uses Hashbox Studio's brand colors:
- **Background**: `#09090B` (Dark zinc)
- **Primary**: `#2563EB` (Blue accent)
- **Secondary**: `#F59E0B` (Amber highlight)
- **Accent**: `#06B6D4` (Cyan details)

## Logo Design:
- Stylized "H" representing "Hashbox"
- Vertical bars in blue (`#2563EB`)
- Horizontal connector in amber (`#F59E0B`)
- Accent dots in cyan (`#06B6D4`)
- Dark background matching site theme

## Browser Support:
- ✅ Modern browsers (Chrome, Firefox, Safari, Edge) - SVG favicon
- ✅ Older browsers - PNG fallbacks
- ✅ iOS Safari - Apple touch icon
- ✅ Android Chrome - Android app icons
- ✅ PWA support - Web app manifest

## File Generation:
To generate PNG files from SVG:
1. Use online tools like RealFaviconGenerator.net
2. Or use ImageMagick: `convert favicon.svg -resize 32x32 favicon-32x32.png`
3. Ensure proper sizing and optimization for web

## Installation:
Files are automatically loaded via `header.php` and `functions.php`.