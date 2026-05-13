<?php
/**
 * Template Part: Table of contents (auto-generated from H2/H3)
 *
 * @package Hashbox_Studio_V2
 */

$toc = hashbox_get_toc( get_the_ID() );
if ( count( $toc ) < 3 ) {
    return; // Skip TOC for short posts.
}
?>
<aside class="hb-post-toc" aria-labelledby="hb-post-toc-title">
    <h2 id="hb-post-toc-title" class="hb-post-toc__title">เนื้อหา</h2>
    <ol class="hb-post-toc__list">
        <?php foreach ( $toc as $item ) : ?>
            <li class="hb-post-toc__item hb-post-toc__item--h<?php echo (int) $item['level']; ?>">
                <a href="#<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['text'] ); ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</aside>
