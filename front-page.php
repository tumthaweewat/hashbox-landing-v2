<?php
/**
 * Hashbox Studio V2 — Homepage
 *
 * Modern Dev-Tools aesthetic. Composes design-system primitives + composed
 * sections into the full one-page landing.
 *
 * @package Hashbox_Studio_V2
 */

get_header();
?>

<!-- ============ HERO ============ -->
<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <span class="hb-hero__pill">
                <span class="hb-hero__pill-mark">H</span>
                Website Craft · Performance Marketing · AI Workforce
            </span>
            <h1 class="hb-hero__title">
                ที่ Hashbox เรารวม<br>
                <em>Web + Marketing + AI</em><br>
                ไว้ในทีมเดียว<br>
                <em>เพื่อผลลัพธ์ที่วัดได้จริง</em><span class="hb-hero__cursor"></span>
            </h1>
            <p class="hb-hero__sub">
                SME ไทยส่วนใหญ่ต้องจ้างเอเจนซีคนละบริษัทมาทำเว็บ ทำ SEO และวาง AI ในขณะที่ทุกทีมก็มี KPI ของตัวเอง เราจึงรวม 3 ศาสตร์นี้ไว้ใต้ทีมเดียวกัน ส่งมอบเว็บที่ผ่านมาตรฐาน <strong>Lighthouse 100</strong> ติดตั้งระบบ Marketing ที่เพิ่ม Conversion ต่อเนื่อง และวาง AI Workforce ที่ลด Manual Work — โดยลูกค้าจะเริ่มเห็นผลภายใน <strong>90 วันแรก</strong>
            </p>
            <div class="hb-hero__actions">
                <a href="#contact" class="hb-btn hb-btn--gradient hb-btn--lg">รับ SEO Audit ฟรี
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline hb-btn--lg">ดูเคสที่เราทำให้ลูกค้า</a>
            </div>
            <div class="hb-hero__trust">
                <div class="hb-hero__trust-item"><span class="hb-hero__trust-value" data-target="17">17</span><span>ปี ประสบการณ์ทีม</span></div>
                <div class="hb-hero__trust-item"><span class="hb-hero__trust-value">300+</span><span>แบรนด์ที่ผ่านมือ</span></div>
                <div class="hb-hero__trust-item"><span class="hb-hero__trust-value">100</span><span>Lighthouse Score</span></div>
                <div class="hb-hero__trust-item"><span class="hb-hero__trust-value">90</span><span>วัน เห็นผล</span></div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SERVICES ============ -->
<section id="services" class="hb-section hb-section--light">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">What we do</span>
            <h2 class="hb-h2">3 บริการที่ออกแบบมาให้ทำงานร่วมกัน</h2>
            <p class="hb-section__sub">ทุกบริการของเราสามารถจ้างแยกได้ แต่จะให้ผลลัพธ์สูงสุดเมื่อทำงานร่วมกันใต้ทีมเดียว เพราะ Web, Marketing และ AI ส่งผลถึงกันตลอด Customer Journey</p>
        </div>

        <div class="hb-bento">
            <a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c2" data-accent="blue" style="text-decoration:none;">
                <span class="hb-service__num">01</span>
                <span class="hb-service__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><polyline points="7 8 10 11 7 14"/><line x1="13" y1="14" x2="17" y2="14"/></svg>
                </span>
                <h3 class="hb-service__title">SEO-Ready Website</h3>
                <p class="hb-service__desc">เว็บไซต์ที่พร้อมติด Google ตั้งแต่วันเปิดตัว ผ่าน Build Gate: Lighthouse 100 ทั้ง 4 หมวด, CWV เขียวทุก URL, Schema ครบ ลูกค้าเห็นผล Ranking ขยับใน 60-90 วัน</p>
                <div class="hb-service__stack">Next.js · Headless WordPress · Cloudflare · Vercel</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>

            <a href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c2" data-accent="cyan" style="text-decoration:none;">
                <span class="hb-service__num">02</span>
                <span class="hb-service__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M7 14l4-4 4 4 5-5"/><circle cx="20" cy="9" r="1.5"/></svg>
                </span>
                <h3 class="hb-service__title">Digital Marketing + CRO</h3>
                <p class="hb-service__desc">การมี Traffic เยอะแต่ Conversion ต่ำคือเสียโอกาส ติดตั้งและดูแลเครื่องมือ Marketing ครบวงจร พร้อม CRO Sprint รายเดือนเพิ่ม Conversion ต่อเนื่อง ดูผลผ่าน Looker Studio Real-time</p>
                <div class="hb-service__stack">GA4 · GSC · GrowthBook · Microsoft Clarity</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>

            <a href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c4" data-accent="violet" style="text-decoration:none;">
                <span class="hb-service__num">03</span>
                <span class="hb-service__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><circle cx="5" cy="6" r="2"/><circle cx="19" cy="6" r="2"/><circle cx="5" cy="18" r="2"/><circle cx="19" cy="18" r="2"/></svg>
                </span>
                <h3 class="hb-service__title">AI Expert Consulting</h3>
                <p class="hb-service__desc">ที่ปรึกษา AI ที่ลงมือเขียนโค้ดและ Deploy เอง ไม่ใช่จบที่ Slide ทุกโปรเจกต์เริ่มจากการคำนวณ AI ROI ถ้าผลตอบแทนคุ้มค่าจึงจะลงมือ Implement พร้อม Knowledge Transfer ให้ทีมลูกค้าดูแลต่อเองได้</p>
                <div class="hb-service__stack">OpenAI · Claude · LangChain · LINE Messaging API · n8n · RAG</div>
                <span class="hb-service__link">รายละเอียดเพิ่มเติม &rarr;</span>
            </a>
        </div>
    </div>
</section>

<!-- ============ WHY HASHBOX ============ -->
<section id="why" class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Why Hashbox</span>
            <h2 class="hb-h2">ทีมเดียวที่รับผิดชอบทั้ง Traffic, Conversion และ Workforce Capacity</h2>
            <p class="hb-section__sub">SME ไทยมักต้องจ้าง 3 เอเจนซีพร้อมกัน ทีมหนึ่งทำเว็บ ทีมหนึ่งดูแล Marketing อีกทีมหนึ่งให้คำปรึกษา AI ทุกฝ่ายมี KPI ของตัวเอง แต่ไม่มีใครรับผิดชอบผลรวม ที่ Hashbox เรารวมทุกอย่างไว้ใต้ KPI ชุดเดียวกัน</p>
        </div>

        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat">
                <span class="hb-stat__value" data-target="17">17</span>
                <p class="hb-stat__label">ปี ประสบการณ์รวม</p>
                <p class="hb-stat__caption">Agency 7 + Corporate 10</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value">300<span class="hb-stat__unit">+</span></span>
                <p class="hb-stat__label">แบรนด์ที่ดูแล</p>
                <p class="hb-stat__caption">งานสะสมของทีม</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value" data-target="100">100</span>
                <p class="hb-stat__label">Lighthouse Score</p>
                <p class="hb-stat__caption">ทุกหมวด ทุก URL</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient" data-target="90">90<span class="hb-stat__unit">วัน</span></span>
                <p class="hb-stat__label">เห็นผล SEO</p>
                <p class="hb-stat__caption">เฉลี่ยจากลูกค้าจริง</p>
            </div>
        </div>
    </div>
</section>

<!-- ============ PROCESS ============ -->
<section id="process" class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">How it works</span>
            <h2 class="hb-h2">From Audit to AI — กระบวนการที่ใช้กับลูกค้าทุกราย</h2>
            <p class="hb-section__sub">เราเชื่อในการวัด Baseline ก่อนเริ่มงาน ลูกค้าจึงเห็นภาพชัดว่าเว็บปัจจุบันอยู่ที่ไหนและจะไปต่ออย่างไร ก่อนจะ Sign-off กับเรา</p>
        </div>

        <ol class="hb-steps">
            <li class="hb-step">
                <span class="hb-step__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg></span>
                <h3 class="hb-step__title">Discovery + Free Audit</h3>
                <p class="hb-step__desc">วัด Baseline ปัจจุบัน — CWV, Schema, Indexation, Backlinks, Competitor Gap ส่งรายงาน 15-20 หน้าฟรี</p>
            </li>
            <li class="hb-step">
                <span class="hb-step__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg></span>
                <h3 class="hb-step__title">Strategy + KPI Sign-off</h3>
                <p class="hb-step__desc">วาง Target KW, Conversion Goal, Tech Stack, Roadmap 90/180/365 วัน ลูกค้า Sign-off ก่อนเริ่ม Code</p>
            </li>
            <li class="hb-step">
                <span class="hb-step__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></span>
                <h3 class="hb-step__title">SEO-Ready Build</h3>
                <p class="hb-step__desc">Code + Schema + Performance ผ่าน Lighthouse Build Gate Deploy บน Cloudflare หรือ Vercel</p>
            </li>
            <li class="hb-step">
                <span class="hb-step__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3v18h18"/><path d="M7 14l4-4 4 4 5-5"/></svg></span>
                <h3 class="hb-step__title">Marketing + CRO Setup</h3>
                <p class="hb-step__desc">ติดตั้ง GA4, GSC, Heatmap, A/B Framework เริ่ม CRO Sprint รายเดือน Hypothesize → Test → Measure</p>
            </li>
            <li class="hb-step">
                <span class="hb-step__icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="3"/><circle cx="5" cy="6" r="2"/><circle cx="19" cy="6" r="2"/></svg></span>
                <h3 class="hb-step__title">AI Workforce + Handover</h3>
                <p class="hb-step__desc">Implement AI Bot/Tool ฝึกทีมลูกค้า ส่งมอบ Documentation, Runbook และ Retainer สำหรับ Optimize ต่อเนื่อง</p>
            </li>
        </ol>

        <div style="text-align:center;margin-top:var(--hb-space-12);">
            <a href="#contact" class="hb-btn hb-btn--gradient hb-btn--lg">เริ่มต้นด้วย Audit ฟรี &rarr;</a>
        </div>
    </div>
</section>

<!-- ============ PORTFOLIO ============ -->
<section id="portfolio" class="hb-section hb-section--light">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Selected work</span>
            <h2 class="hb-h2">งานจริงที่ผลลัพธ์วัดได้ทุกตัวเลข</h2>
            <p class="hb-section__sub">ทุกเคสคัดจากงานจริงในอุตสาหกรรม HR-Tech, E-commerce, On-demand Service และ SaaS ผลลัพธ์ทั้งหมดมาจาก GA4 + GSC จริง</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <a href="<?php echo esc_url( home_url( '/work/nexus-corp/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #1D4ED8, #2563EB);">
                <div class="hb-case__head"><span class="hb-case__industry">Enterprise · 2025</span><span class="hb-badge hb-badge--blue">Corporate</span></div>
                <h3 class="hb-case__name">Nexus Corp</h3>
                <p class="hb-case__metric">+540%</p>
                <p class="hb-case__desc">Headless WordPress + Next.js corporate site กับ SEO recovery ครบใน 12 เดือน Users เพิ่ม 540%</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>

            <a href="<?php echo esc_url( home_url( '/work/flow-store/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #0369A1, #06B6D4);">
                <div class="hb-case__head"><span class="hb-case__industry">E-commerce · 2025</span><span class="hb-badge hb-badge--cyan">CRO</span></div>
                <h3 class="hb-case__name">Flow Store</h3>
                <p class="hb-case__metric">3×</p>
                <p class="hb-case__desc">Storefront ใหม่บน Next.js + CRO Sprint 4 เดือน Conversion Rate 3 เท่า ใน 6 เดือน</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>

            <a href="<?php echo esc_url( home_url( '/work/rank-project/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #1E3A5F, #2563EB);">
                <div class="hb-case__head"><span class="hb-case__industry">HR-Tech · 2024</span><span class="hb-badge hb-badge--blue">SEO Recovery</span></div>
                <h3 class="hb-case__name">Rank Project</h3>
                <p class="hb-case__metric">+2,200%</p>
                <p class="hb-case__desc">Technical SEO overhaul + 12-month content programme — Impressions เพิ่ม 22 เท่า, Traffic +700%</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>

            <a href="<?php echo esc_url( home_url( '/work/autobot-line/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #064E3B, #059669);">
                <div class="hb-case__head"><span class="hb-case__industry">On-demand · 2025</span><span class="hb-badge hb-badge--emerald">AI Workforce</span></div>
                <h3 class="hb-case__name">AutoBot LINE</h3>
                <p class="hb-case__metric">−60%</p>
                <p class="hb-case__desc">LINE Bot + OpenAI + RAG ตอบลูกค้าไทย 24/7 ลด Support Cost 60% ใน 8 สัปดาห์</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>

            <a href="<?php echo esc_url( home_url( '/work/gold-brand/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #78350F, #F59E0B);">
                <div class="hb-case__head"><span class="hb-case__industry">Luxury · 2024</span><span class="hb-badge hb-badge--amber">Brand + Web</span></div>
                <h3 class="hb-case__name">Gold Brand</h3>
                <p class="hb-case__metric">+180%</p>
                <p class="hb-case__desc">Brand refresh + Performance site บน Next.js Branded Search เพิ่ม 180% ใน 5 เดือน</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>

            <a href="<?php echo esc_url( home_url( '/work/pitch-deck/' ) ); ?>" class="hb-case" style="--case-bg: linear-gradient(135deg, #312E81, #7C3AED);">
                <div class="hb-case__head"><span class="hb-case__industry">SaaS · 2025</span><span class="hb-badge hb-badge--violet">Investor Web</span></div>
                <h3 class="hb-case__name">Pitch Deck Microsite</h3>
                <p class="hb-case__metric">Series A</p>
                <p class="hb-case__desc">Investor Microsite + Live Metrics Dashboard ใน 3 สัปดาห์ ปิด Series A ที่ Valuation 1.4×</p>
                <div class="hb-case__cta"><span>อ่าน Case Study</span><span class="hb-case__cta-arrow">→</span></div>
            </a>
        </div>

        <div style="text-align:center;margin-top:var(--hb-space-12);">
            <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="hb-btn hb-btn--outline">ดูผลงานทั้งหมด &rarr;</a>
        </div>
    </div>
</section>

<!-- ============ TESTIMONIAL ============ -->
<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">Client voice</span>
            <h2 class="hb-h2">ลูกค้าพูดถึงเรา</h2>
        </div>
        <div class="hb-quote">
            <span class="hb-quote__mark">"</span>
            <p class="hb-quote__body">ที่ผ่านมาเคยจ้าง 2 เอเจนซีและไม่เคยขยับ Performance ได้ Hashbox เป็นทีมแรกที่เข้าใจทั้ง WordPress, Next.js และ SEO ผลลัพธ์เห็นภายใน 60 วันแรกเลย</p>
            <div class="hb-quote__attrib">
                <span class="hb-quote__avatar">N</span>
                <div>
                    <p class="hb-quote__name">Head of Digital</p>
                    <p class="hb-quote__role">Nexus Corp · Enterprise Software</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ INSIGHTS ============ -->
<section id="insights" class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Insights</span>
            <h2 class="hb-h2">บทความล่าสุดจากทีม</h2>
            <p class="hb-section__sub">เนื้อหาเทคนิคจริง เขียนโดยทีมที่ Code, Run Ads และ Implement AI เอง</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <?php
            $insights = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ) );

            if ( $insights->have_posts() ) :
                while ( $insights->have_posts() ) : $insights->the_post();
                    $cats = get_the_category();
                    $cat = ! empty( $cats ) ? $cats[0]->name : 'Insight';
            ?>
                <a href="<?php the_permalink(); ?>" class="hb-insight">
                    <div class="hb-insight__meta">
                        <span class="hb-insight__cat"><?php echo esc_html( $cat ); ?></span>
                        <span>· <?php echo esc_html( get_the_date( 'd M Y' ) ); ?></span>
                    </div>
                    <h3 class="hb-insight__title"><?php the_title(); ?></h3>
                    <p class="hb-insight__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
                    <div class="hb-insight__foot">
                        <span class="hb-insight__author">Hashbox Studio</span>
                        <span>· 5 min read</span>
                    </div>
                </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                $fallback = array(
                    array( 'cat' => 'Web Dev',      'title' => 'ทำไมเราเลือก Next.js สำหรับโปรเจกต์ปี 2026', 'excerpt' => 'Speed, SEO และ Developer Experience — เหตุผลที่ Next.js ยังเป็น Framework หลักของเรา' ),
                    array( 'cat' => 'AI Workforce', 'title' => '5 วิธี AI ช่วยทีมประหยัด 20 ชั่วโมง/สัปดาห์',  'excerpt' => 'Use Case AI ที่ส่งผล ROI จริงสำหรับ SME ไทย' ),
                    array( 'cat' => 'Case Study',   'title' => 'From Spreadsheets to Systems',                'excerpt' => 'เคสจริงที่ทีมเราเปลี่ยน Manual Process เป็น AI Workflow ลดเวลา 40%' ),
                );
                foreach ( $fallback as $p ) : ?>
                <a href="#" class="hb-insight">
                    <div class="hb-insight__meta"><span class="hb-insight__cat"><?php echo esc_html( $p['cat'] ); ?></span><span>· เร็ว ๆ นี้</span></div>
                    <h3 class="hb-insight__title"><?php echo esc_html( $p['title'] ); ?></h3>
                    <p class="hb-insight__excerpt"><?php echo esc_html( $p['excerpt'] ); ?></p>
                    <div class="hb-insight__foot"><span class="hb-insight__author">Hashbox Studio</span><span>· 5 min</span></div>
                </a>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<!-- ============ FAQ ============ -->
<section id="faq" class="hb-section hb-section--light">
    <div class="hb-container hb-container--md">
        <div class="hb-section__head">
            <span class="hb-eyebrow">FAQ</span>
            <h2 class="hb-h2">คำถามที่พบบ่อย</h2>
            <p class="hb-section__sub">รวบรวมคำถามที่ลูกค้ามักถามเราในช่วงคุยกันก่อนเริ่มงาน</p>
        </div>

        <div class="hb-accordion">
            <?php
            $faqs = function_exists( 'hashbox_get_home_faqs' ) ? hashbox_get_home_faqs() : array();
            foreach ( $faqs as $i => $faq ) : ?>
                <details class="hb-accordion__item" <?php echo $i === 0 ? 'open' : ''; ?>>
                    <summary class="hb-accordion__trigger"><?php echo esc_html( $faq['q'] ); ?></summary>
                    <div class="hb-accordion__content">
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ PRICING ============ -->
<section id="pricing" class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Pricing</span>
            <h2 class="hb-h2">แพ็กเกจที่ทีมเราส่งมอบ</h2>
            <p class="hb-section__sub">ราคาเริ่มต้นชัดเจน ไม่มี Hidden Cost ทุก Quote ออกหลังการ Audit ฟรี</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <div class="hb-tier">
                <span class="hb-tier__name">Landing Page</span>
                <div class="hb-tier__price">80,000<span class="hb-tier__price-unit">บาท+</span></div>
                <p class="hb-caption">2-3 สัปดาห์</p>
                <ul class="hb-tier__features">
                    <li>Next.js + Lighthouse 100</li>
                    <li>Schema markup ครบ</li>
                    <li>GA4 + GSC setup</li>
                    <li>30 วัน support</li>
                </ul>
                <a href="#contact" class="hb-btn hb-btn--outline" style="margin-top:auto;">ขอใบเสนอราคา</a>
            </div>
            <div class="hb-tier hb-tier--featured">
                <span class="hb-tier__ribbon">Most Popular</span>
                <span class="hb-tier__name">Corporate Site</span>
                <div class="hb-tier__price">200,000<span class="hb-tier__price-unit">บาท+</span></div>
                <p class="hb-caption">4-6 สัปดาห์</p>
                <ul class="hb-tier__features">
                    <li>Headless WP + Next.js</li>
                    <li>Multilingual TH/EN</li>
                    <li>Schema เต็มชุด + CWV เขียว</li>
                    <li>CRO setup 3 เดือนแรก</li>
                    <li>60 วัน support</li>
                </ul>
                <a href="#contact" class="hb-btn hb-btn--gradient" style="margin-top:auto;">ขอใบเสนอราคา</a>
            </div>
            <div class="hb-tier">
                <span class="hb-tier__name">E-commerce</span>
                <div class="hb-tier__price">350,000<span class="hb-tier__price-unit">บาท+</span></div>
                <p class="hb-caption">6-10 สัปดาห์</p>
                <ul class="hb-tier__features">
                    <li>Next.js + Shopify Headless</li>
                    <li>Payment gateway ไทย</li>
                    <li>Stock + Order management</li>
                    <li>CRO Sprint รายเดือน</li>
                    <li>90 วัน support</li>
                </ul>
                <a href="#contact" class="hb-btn hb-btn--outline" style="margin-top:auto;">ขอใบเสนอราคา</a>
            </div>
        </div>
    </div>
</section>

<!-- ============ CONTACT ============ -->
<section id="contact" class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">Get in touch</span>
            <h2 class="hb-h2">เริ่มต้นด้วย Audit ฟรี</h2>
            <p class="hb-section__sub">กรอกแบบฟอร์มสั้น ๆ ทีมเราจะวัด Baseline ของเว็บคุณแล้วส่งรายงาน 15-20 หน้าให้ภายใน 3 วันทำการ ฟรีไม่มีข้อผูกมัด</p>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--hb-space-12);align-items:start;max-width:64rem;margin:0 auto;">
            <div>
                <div style="display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <p style="display:flex;align-items:center;gap:var(--hb-space-3);color:var(--hb-text);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="22,4 12,13 2,4"/></svg><a href="mailto:hello@hashbox.co.th" style="color:inherit;">hello@hashbox.co.th</a></p>
                    <p style="display:flex;align-items:center;gap:var(--hb-space-3);color:var(--hb-text);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg><a href="tel:+6622666222" style="color:inherit;">02 266 6222</a></p>
                    <p style="display:flex;align-items:center;gap:var(--hb-space-3);color:var(--hb-text);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500</p>
                    <p style="display:flex;align-items:center;gap:var(--hb-space-3);color:var(--hb-text);"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>จันทร์-ศุกร์ 9:00-18:00</p>
                </div>
                <a href="https://lin.ee/Xagx6i4" class="hb-btn hb-btn--gradient hb-btn--lg" target="_blank" rel="noopener noreferrer" style="margin-top:var(--hb-space-6);">คุยทาง LINE OA</a>
            </div>

            <?php
            $contact_status = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
            ?>
            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" style="display:flex;flex-direction:column;gap:var(--hb-space-4);">
                <input type="hidden" name="action" value="hashbox_contact">
                <?php wp_nonce_field( 'hashbox_contact', 'hashbox_nonce' ); ?>

                <?php if ( $contact_status === 'sent' ) : ?>
                    <div class="hb-badge hb-badge--emerald hb-badge--lg">ส่งข้อความสำเร็จ ทีมเราจะติดต่อกลับใน 1-3 วันทำการ</div>
                <?php elseif ( $contact_status === 'invalid' ) : ?>
                    <div class="hb-badge hb-badge--rose hb-badge--lg">กรุณากรอกชื่อ อีเมล และยินยอม PDPA</div>
                <?php endif; ?>

                <div class="hb-field">
                    <label class="hb-label" for="contact-name">ชื่อ <span class="hb-label__required">*</span></label>
                    <input id="contact-name" class="hb-input" type="text" name="name" required placeholder="ชื่อ-นามสกุล">
                </div>
                <div class="hb-field">
                    <label class="hb-label" for="contact-email">อีเมล <span class="hb-label__required">*</span></label>
                    <input id="contact-email" class="hb-input" type="email" name="email" required placeholder="you@company.com">
                </div>
                <div class="hb-field">
                    <label class="hb-label" for="contact-service">สนใจบริการ</label>
                    <select id="contact-service" class="hb-select" name="service">
                        <option value="">เลือกบริการ</option>
                        <option value="seo-website">SEO-Ready Website</option>
                        <option value="marketing-cro">Digital Marketing + CRO</option>
                        <option value="ai-consulting">AI Expert Consulting</option>
                        <option value="all">ทั้ง 3 บริการ Bundle</option>
                        <option value="audit-only">SEO Audit ฟรีก่อน</option>
                    </select>
                </div>
                <div class="hb-field">
                    <label class="hb-label" for="contact-msg">โจทย์ของโปรเจกต์</label>
                    <textarea id="contact-msg" class="hb-textarea" name="message" rows="3" placeholder="เล่าสั้น ๆ ว่าอยากแก้ปัญหาอะไร"></textarea>
                </div>
                <label class="hb-checkbox-wrap">
                    <input type="checkbox" class="hb-checkbox" name="pdpa" required>
                    <span class="hb-checkbox-wrap__label">ยินยอมให้ Hashbox เก็บข้อมูลตาม <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color: var(--hb-accent-blue-soft); text-decoration: underline;">นโยบาย PDPA</a></span>
                </label>
                <button type="submit" class="hb-btn hb-btn--gradient hb-btn--lg">ส่งและรับ Audit ฟรี &rarr;</button>
            </form>
        </div>
    </div>
</section>

<?php
get_footer();
