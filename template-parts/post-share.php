<?php
/**
 * Template Part: Social share buttons
 *
 * @package Hashbox_Studio_V2
 */

$url   = rawurlencode( get_permalink() );
$title = rawurlencode( get_the_title() );
?>
<div class="hb-post-share" role="group" aria-label="Share this post">
    <span class="hb-post-share__label">แชร์:</span>
    <a class="hb-post-share__btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" rel="noopener" aria-label="Share on Facebook">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.87v-6.98H7.9V12h2.5V9.8c0-2.47 1.47-3.83 3.72-3.83 1.08 0 2.21.19 2.21.19v2.43h-1.25c-1.23 0-1.61.76-1.61 1.54V12h2.74l-.44 2.89H13.5v6.98A10 10 0 0 0 22 12Z"/></svg>
    </a>
    <a class="hb-post-share__btn" href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>" target="_blank" rel="noopener" aria-label="Share on X">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2H21l-6.52 7.45L22 22h-6.83l-5.36-7.01L3.64 22H.88l6.98-7.98L0 2h7l4.84 6.4L18.244 2Zm-2.4 18h1.66L7.24 4H5.46l10.384 16Z"/></svg>
    </a>
    <a class="hb-post-share__btn" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $url; ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.55V14.9c0-1.32-.02-3.03-1.85-3.03-1.85 0-2.13 1.45-2.13 2.94v5.64H9.36V9h3.41v1.56h.05c.47-.9 1.63-1.85 3.36-1.85 3.6 0 4.27 2.37 4.27 5.46v6.28ZM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12ZM7.12 20.45H3.56V9h3.56v11.45Z"/></svg>
    </a>
    <a class="hb-post-share__btn" href="https://social-plugins.line.me/lineit/share?url=<?php echo $url; ?>" target="_blank" rel="noopener" aria-label="Share on LINE">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.36 4.64a10 10 0 0 0-14.72 0 9.9 9.9 0 0 0 0 14.05c.35.35.7.65 1.09.94l-.7 2.55 2.85-1.41a10 10 0 0 0 4.12.87 9.95 9.95 0 0 0 7.36-3.05 9.9 9.9 0 0 0 0-13.95Zm-8.06 8.62h-.04l-1.87-2.6v2.6H8.55V9.93h.83l1.87 2.6V9.93h.85v3.33h-.8Zm1.92 0V9.93h.85v3.33h-.85Zm3.07-.74h-1.62v-.65h1.62v-.6h-1.62V9.93h2.46v.78h-1.61v.55h1.61v.78h-1.61v.55h1.61v.67h-2.46Z"/></svg>
    </a>
    <button class="hb-post-share__btn hb-post-share__btn--copy" type="button" data-url="<?php echo esc_url( get_permalink() ); ?>" aria-label="Copy link">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
    </button>
</div>
