<?php
/**
 * Template Name: About Page
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url = get_permalink();
?>

<section class="hb-hero">
    <div class="hb-hero__bg"></div>
    <div class="hb-hero__grid"></div>
    <div class="hb-container">
        <div class="hb-hero__inner">
            <nav class="hb-breadcrumb" aria-label="Breadcrumb">
                <ol class="hb-breadcrumb__list">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><span class="hb-breadcrumb__sep">/</span></li>
                    <li aria-current="page">About</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">About Hashbox</span>
            <h1 class="hb-hero__title">
                เรารวม Web, Marketing<br>
                และ AI ไว้ใน <em>ทีมเดียว</em><br>
                ที่ <em>รับผิดชอบผลรวม</em>
            </h1>
            <p class="hb-hero__sub">
                Hashbox Studio ตั้งขึ้นจากความเชื่อง่าย ๆ ว่าลูกค้า SME ไทยไม่ควรต้องจ้าง 3 บริษัทมาทำงานที่จริง ๆ แล้วต้องเชื่อมกัน เราจึงรวม Technical Web Development, Digital Marketing พร้อม CRO และ AI Workforce Consulting ไว้ในทีมเดียว ใต้ KPI ชุดเดียวกัน เพื่อให้ลูกค้าเห็นผลลัพธ์ที่จับต้องและวัดได้จริง
            </p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Team Background</span>
            <h2 class="hb-h2">Corporate-grade craft + Agency speed</h2>
            <p class="hb-section__sub">ทีมงานของเรามาจากทั้งฝั่ง Agency ระดับท็อปของไทยประมาณ 7 ปี และจาก ทีม In-house Corporate อีกประมาณ 10 ปี รวมแล้วเคยดูแลแบรนด์ทั้งของไทยและต่างประเทศมามากกว่า 300 ราย</p>
        </div>

        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2 hb-bento__cell--feature">
                <span class="hb-bento__label">7 ปี · AGENCY</span>
                <h3 class="hb-h3">Agency Experience</h3>
                <ul class="hb-prose" style="padding-left: var(--hb-space-5);">
                    <li>ดูแลโปรเจกต์ Brand + Web ครอบคลุม Banking, E-commerce, Real Estate, FMCG</li>
                    <li>เข้าใจ Brand Tone, Visual Direction และ Campaign Integration</li>
                    <li>คุ้นเคยกับ Speed-to-Market และ Iteration Cycle สั้น</li>
                    <li>เคยทำงานกับ Award-winning Creative Studios ในกรุงเทพฯ</li>
                </ul>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">10 ปี · CORPORATE</span>
                <h3 class="hb-h3">Corporate Experience</h3>
                <ul class="hb-prose" style="padding-left: var(--hb-space-5);">
                    <li>ทำงาน In-house ที่องค์กรขนาดใหญ่ ผ่าน Scale Constraint จริง</li>
                    <li>เชี่ยวชาญ Performance Budget, Security Policy, PDPA Compliance</li>
                    <li>เข้าใจ Multi-stakeholder Engineering + Governance Process</li>
                    <li>คุ้นเคยกับ Enterprise Architecture และ Multi-region Deployment</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Tools</span>
            <h2 class="hb-h2">Tech Stack + เครื่องมือ In-House</h2>
        </div>
        <div class="hb-bento">
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">TECH STACK</span>
                <h3 class="hb-h4">ที่เราใช้กับลูกค้าทุกราย</h3>
                <div class="hb-rail">
                    <span class="hb-badge hb-badge--blue">Next.js</span>
                    <span class="hb-badge hb-badge--blue">React</span>
                    <span class="hb-badge hb-badge--blue">Tailwind</span>
                    <span class="hb-badge hb-badge--cyan">WordPress Headless</span>
                    <span class="hb-badge hb-badge--cyan">Sanity</span>
                    <span class="hb-badge hb-badge--amber">Node.js</span>
                    <span class="hb-badge hb-badge--amber">Python</span>
                    <span class="hb-badge hb-badge--blue">Vercel</span>
                    <span class="hb-badge hb-badge--blue">Cloudflare</span>
                    <span class="hb-badge hb-badge--cyan">GA4</span>
                    <span class="hb-badge hb-badge--cyan">Looker Studio</span>
                    <span class="hb-badge hb-badge--violet">OpenAI</span>
                    <span class="hb-badge hb-badge--violet">Claude</span>
                    <span class="hb-badge hb-badge--violet">LangChain</span>
                    <span class="hb-badge hb-badge--violet">n8n</span>
                </div>
            </div>
            <div class="hb-bento__cell hb-bento__cell--c2">
                <span class="hb-bento__label">IN-HOUSE TOOLS</span>
                <h3 class="hb-h4">5 ตัวที่ทีมเราสร้างเอง</h3>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:var(--hb-space-3);">
                    <li><strong style="color:var(--hb-accent-amber);">Paid Media Alert</strong> — เตือนเมื่อ Cost-per-Lead เกิน Threshold</li>
                    <li><strong style="color:var(--hb-accent-blue);">SEO Tracker</strong> — Track Keyword Position รายวันแบบ Realtime</li>
                    <li><strong style="color:var(--hb-accent-cyan);">Asearchlab</strong> — เครื่องมือ AI Visibility Audit</li>
                    <li><strong style="color:var(--hb-accent-amber);">peec.AI</strong> — AI Citation Monitor</li>
                    <li><strong style="color:var(--hb-accent-blue);">Query Fan-out</strong> — สร้าง Topic Cluster อัตโนมัติ</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">By the numbers</span>
            <h2 class="hb-h2">ตัวเลขที่ทีมเราภูมิใจ</h2>
        </div>
        <div class="hb-stats__grid hb-stats__grid--divided">
            <div class="hb-stat">
                <span class="hb-stat__value" data-target="17">17</span>
                <p class="hb-stat__label">ปี ประสบการณ์รวม</p>
                <p class="hb-stat__caption">Agency 7 + Corporate 10</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value">300<span class="hb-stat__unit">+</span></span>
                <p class="hb-stat__label">แบรนด์ที่ทีมดูแล</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value" data-target="100">100</span>
                <p class="hb-stat__label">Lighthouse เฉลี่ย</p>
            </div>
            <div class="hb-stat">
                <span class="hb-stat__value hb-stat__value--gradient">5</span>
                <p class="hb-stat__label">In-House Tools</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">พร้อมเริ่มงานกับเรา?</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">รับ SEO + Performance Audit ฟรี 15-20 หน้า ก่อนตัดสินใจเริ่มงาน</p>
        <div class="hb-rail" style="justify-content:center;">
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
            <a href="https://lin.ee/Xagx6i4" class="hb-btn hb-btn--outline hb-btn--lg" target="_blank" rel="noopener noreferrer">คุยทาง LINE</a>
        </div>
    </div>
</section>

<?php
hashbox_jsonld( array(
    '@context'    => 'https://schema.org',
    '@type'       => 'AboutPage',
    '@id'         => $page_url . '#aboutpage',
    'url'         => $page_url,
    'name'        => 'About Hashbox Studio',
    'inLanguage'  => 'th-TH',
    'mainEntity'  => array( '@id' => home_url( '/#organization' ) ),
) );
hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'About', 'item' => $page_url ),
    ),
) );

get_footer();
