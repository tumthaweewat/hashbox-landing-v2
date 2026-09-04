<?php
/**
 * Template Name: Article layout (blog design)
 * Template Post Type: page
 *
 * Renders a WP page with the long-form editorial layout from single.php —
 * hero + Quick Scan brief, TOC sidebar, article shell (answer box, tables
 * with pinned first column, accent bars), CTA and Article schema. Meant for
 * editorial pages that are not posts, e.g. English listicles under /en/.
 * hashbox_is_article_view() keys every blog-design hook on this template.
 *
 * @package Hashbox_Studio_V2
 */

require get_template_directory() . '/single.php';
