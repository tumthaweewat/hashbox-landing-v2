<?php
/**
 * Template Part: Blog/Insights Section
 *
 * @package Hashbox_Studio
 */

$hashbox_insights_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'ignore_sticky_posts' => true,
) );

$hashbox_tag_classes = array( 'insight-tag-blue', 'insight-tag-cyan', 'insight-tag-amber' );
$hashbox_accents     = array( 'blue', 'cyan', 'amber' );

// Fallback teaser cards rendered when no posts have been published yet.
$hashbox_fallback = array(
    array(
        'tag'   => 'Web Development',
        'title' => 'ทำไมเราเลือก Next.js สำหรับโปรเจกต์ปี 2026',
        'desc'  => 'Speed, SEO และ Developer Experience — เหตุผลที่ Next.js ยังเป็น Framework หลักของเราในงานลูกค้าทุกราย',
        'time'  => '5 min read',
        'url'   => '#',
    ),
    array(
        'tag'   => 'AI Workforce',
        'title' => '5 วิธี AI ช่วยทีมประหยัด 20 ชั่วโมง/สัปดาห์',
        'desc'  => 'ตั้งแต่ Automated Report ถึง Smart Customer Routing — Use Case AI ที่ส่งผล ROI จริงสำหรับ SME ไทย',
        'time'  => '4 min read',
        'url'   => '#',
    ),
    array(
        'tag'   => 'Case Study',
        'title' => 'From Spreadsheets to Systems: Digital Workforce Story',
        'desc'  => 'เคสจริงที่เราช่วยลูกค้าเปลี่ยน Manual Process เป็น AI Workflow ลดเวลาทำงาน 40%',
        'time'  => '6 min read',
        'url'   => '#',
    ),
);
?>
<!-- ============ SECTION 8 — INSIGHTS ============ -->
<section id="insights" class="section-padding insights-section" aria-labelledby="insights-h2">
    <div class="container">
        <div class="insights-header">
            <div class="insights-header-left">
                <span class="section-label">INSIGHTS</span>
                <h2 id="insights-h2" class="section-title">บทความล่าสุดจากทีม</h2>
                <p class="section-sub">เนื้อหาเทคนิคจริง เขียนโดยทีมที่ Code, Run Ads และ Implement AI เอง</p>
            </div>
            <div class="insights-header-right">
                <a href="<?php echo esc_url( home_url( '/insights/' ) ); ?>" class="btn btn-outline insights-view-all">
                    บทความทั้งหมด
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="insights-grid">
            <?php if ( $hashbox_insights_query->have_posts() ) :
                $i = 0;
                while ( $hashbox_insights_query->have_posts() ) :
                    $hashbox_insights_query->the_post();
                    $accent     = $hashbox_accents[ $i % count( $hashbox_accents ) ];
                    $tag_class  = $hashbox_tag_classes[ $i % count( $hashbox_tag_classes ) ];
                    $categories = get_the_category();
                    $cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Insight';
                    $featured   = 0 === $i ? ' insight-card-featured' : '';
                ?>
                <article class="insight-card<?php echo esc_attr( $featured ); ?>" data-accent="<?php echo esc_attr( $accent ); ?>">
                    <div class="insight-card-accent"></div>
                    <div class="insight-card-number"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
                    <div class="insight-card-content">
                        <div class="insight-tag <?php echo esc_attr( $tag_class ); ?>"><?php echo esc_html( $cat_name ); ?></div>
                        <h3 class="insight-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="insight-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
                        <div class="insight-meta">
                            <span class="insight-author">โดย <strong>Hashbox Studio</strong></span>
                            <span class="insight-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></time></span>
                            <a href="<?php the_permalink(); ?>" class="insight-link">
                                อ่านต่อ
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
                <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
            else :
                foreach ( $hashbox_fallback as $idx => $post_card ) :
                    $accent    = $hashbox_accents[ $idx % count( $hashbox_accents ) ];
                    $tag_class = $hashbox_tag_classes[ $idx % count( $hashbox_tag_classes ) ];
                    $featured  = 0 === $idx ? ' insight-card-featured' : '';
                ?>
                <article class="insight-card<?php echo esc_attr( $featured ); ?>" data-accent="<?php echo esc_attr( $accent ); ?>">
                    <div class="insight-card-accent"></div>
                    <div class="insight-card-number"><?php echo esc_html( sprintf( '%02d', $idx + 1 ) ); ?></div>
                    <div class="insight-card-content">
                        <div class="insight-tag <?php echo esc_attr( $tag_class ); ?>"><?php echo esc_html( $post_card['tag'] ); ?></div>
                        <h3 class="insight-title"><?php echo esc_html( $post_card['title'] ); ?></h3>
                        <p class="insight-excerpt"><?php echo esc_html( $post_card['desc'] ); ?></p>
                        <div class="insight-meta">
                            <span class="insight-author">โดย <strong>Hashbox Studio</strong></span>
                            <span class="read-time"><?php echo esc_html( $post_card['time'] ); ?></span>
                            <a href="<?php echo esc_url( $post_card['url'] ); ?>" class="insight-link">
                                เร็ว ๆ นี้
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17 17 7"/><path d="M7 7h10v10"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>
