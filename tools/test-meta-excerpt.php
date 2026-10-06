<?php
/**
 * Offline contract for generated meta descriptions (audit 2026-10-06: 40 pages
 * over 170 chars). wp_trim_words( …, 28 ) counts space-separated words, and Thai
 * has no spaces between words — 28 "words" came out at 250–410 characters.
 */
error_reporting( E_ALL );
define( 'ABSPATH', __DIR__ . '/../' );
function meta_expect( $condition, $message ) { if ( ! $condition ) { throw new RuntimeException( $message ); } }
require __DIR__ . '/../inc/meta-excerpt.php';

// Thai above/below marks take no width: "ที่" is 1 visible character.
meta_expect( 1 === hashbox_visible_length( 'ที่' ), 'Thai marks must not count as width' );
meta_expect( 5 === hashbox_visible_length( 'hello' ), 'Latin counts per character' );

$short = 'รับทำเว็บไซต์ SEO-Ready';
meta_expect( $short === hashbox_meta_excerpt( $short ), 'Short text passes through unchanged' );

$privacy = '<p>อัพเดตล่าสุด: มีนาคม 2026 | มีผลบังคับใช้ตาม พ.ร.บ. คุ้มครองข้อมูลส่วนบุคคล (PDPA) พ.ศ. 2562</p><p>Hashbox Co., Ltd. ("Hashbox", "เรา", "ของเรา") ให้ความสำคัญกับความเป็นส่วนตัวของผู้ใช้บริการ นโยบายความเป็นส่วนตัวฉบับนี้อธิบายการเก็บรวบรวม ใช้ และเปิดเผยข้อมูลส่วนบุคคลของท่านเมื่อเยี่ยมชม hashbox.co.th</p>';
$out = hashbox_meta_excerpt( $privacy );
meta_expect( hashbox_visible_length( $out ) <= 150, 'Long Thai text must fit 150 visible chars, got ' . hashbox_visible_length( $out ) );
meta_expect( '…' === mb_substr( $out, -1 ), 'Cut text ends with an ellipsis' );
meta_expect( false === strpos( $out, '<' ), 'No HTML in the description' );
meta_expect( false !== strpos( $out, '2562 Hashbox' ), 'Paragraph boundaries become a space, not glued words' );
// A cut never strands a mark without its base character, and never splits a byte sequence.
meta_expect( mb_check_encoding( $out, 'UTF-8' ), 'Valid UTF-8' );

$cat = "<p>บทความเรื่อง Web Development จากทีมที่ build เว็บไซต์ลูกค้าจริง</p>\n<p>เนื้อหาเขียนโดยวิศวกร</p>";
meta_expect( false !== strpos( hashbox_meta_excerpt( $cat ), 'จริง เนื้อหา' ), 'Category paragraphs are joined with a space' );

$fn = file_get_contents( __DIR__ . '/../functions.php' );
$meta = substr( $fn, strpos( $fn, 'function hashbox_get_seo_metadata' ), strpos( $fn, 'function hashbox_get_seo_title' ) - strpos( $fn, 'function hashbox_get_seo_metadata' ) );
meta_expect( false === strpos( $meta, 'wp_trim_words' ), 'Generated descriptions must not use wp_trim_words (word count ≠ length in Thai)' );
echo "Meta excerpt: Thai-aware visible length, 150 cap, clean paragraph joins, no wp_trim_words in metadata.\n";
