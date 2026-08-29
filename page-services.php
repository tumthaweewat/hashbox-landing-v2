<?php
/**
 * Template Name: Service: Services Hub
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
                    <li aria-current="page">Services</li>
                </ol>
            </nav>
            <span class="hb-eyebrow">Services</span>
            <h1 class="hb-hero__title">รับทำเว็บไซต์ SEO-Ready,<br><em>ที่ปรึกษา AI, รับทำ SEO และ AI Search</em><br>ในทีมเดียว</h1>
            <p class="hb-hero__sub">
                บริการของ Hashbox Studio คือ 5 บริการที่ต่อกันเป็นระบบเดียว: รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI สำหรับธุรกิจ, รับทำ SEO สายเทคนิค, รับทำ AI Search (GEO) และ Workflow Automation ด้วย n8n — ทุกบริการเริ่มแยกได้ ราคาเปิดเผย และวัดผลจากข้อมูลจริงรายวัน
            </p>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-bento">
            <?php $hb_i = 0; foreach ( hashbox_service_catalog_live() as $svc ) : $hb_i++; ?>
            <a href="<?php echo esc_url( hashbox_service_url( $svc ) ); ?>" class="hb-service hb-bento__cell <?php echo ! empty( $svc['featured'] ) ? 'hb-bento__cell--c2' : 'hb-bento__cell--c2'; ?>" data-accent="<?php echo esc_attr( $svc['accent'] ); ?>" style="text-decoration:none;">
                <span class="hb-service__num"><?php echo esc_html( str_pad( (string) $hb_i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                <h2 class="hb-service__title"><?php echo esc_html( $svc['name'] ); ?></h2>
                <p class="hb-service__desc"><?php echo esc_html( $svc['desc'] ); ?></p>
                <?php echo hashbox_service_bullets_html( $svc, 'hb-service__subs' ); ?>
                <?php if ( ! empty( $svc['price'] ) ) : ?><div class="hb-service__stack" style="font-weight:600;"><?php echo esc_html( $svc['price'] ); ?></div><?php endif; ?>
                <span class="hb-service__link">ดูรายละเอียด<?php echo esc_html( $svc['name'] ); ?> &rarr;</span>
            </a>
            <?php endforeach; ?>

            <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>" class="hb-service hb-bento__cell hb-bento__cell--c2" data-accent="cyan" style="text-decoration:none;" hreflang="en">
                <span class="hb-service__num">EN</span>
                <span class="hb-service__icon"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 2.7 2.5 15.3 0 18M12 3c-2.5 2.7-2.5 15.3 0 18"/></svg></span>
                <h2 class="hb-service__title">English: AI Consulting · SEO · AI Search</h2>
                <p class="hb-service__desc">For English-speaking teams in Thailand — <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>" style="color:inherit;text-decoration:underline;">AI consulting in Bangkok</a>, <a href="<?php echo esc_url( home_url( '/en/seo/' ) ); ?>" style="color:inherit;text-decoration:underline;">technical-first SEO agency</a> and <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>" style="color:inherit;text-decoration:underline;">AI Search (GEO)</a> and <a href="<?php echo esc_url( home_url( '/en/website-development/' ) ); ?>" style="color:inherit;text-decoration:underline;">website development</a> — same prices, PDPA, LINE and Thai-language context.</p>
                <div class="hb-service__stack">English delivery · Public THB pricing · 100% source code</div>
                <span class="hb-service__link">Read in English &rarr;</span>
            </a>
        </div>
    </div>
</section>

<section class="hb-section">
    <div class="hb-container">
        <div class="hb-section__head">
            <span class="hb-eyebrow">Service fit</span>
            <h2 class="hb-h2">ควรเริ่มจากบริการไหนก่อน?</h2>
            <p class="hb-section__sub">เลือกจากปัญหาหลักของธุรกิจตอนนี้ แล้วค่อยขยายเป็นระบบ Web + SEO + AI ที่ทำงานร่วมกัน</p>
        </div>
        <div class="hb-bento">
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Website first</span>
                <h3 class="hb-card__title">เว็บช้า ติด Google ยาก หรือกำลังทำเว็บใหม่</h3>
                <p class="hb-card__body">เริ่มด้วย SEO-Ready Website เพื่อแก้ technical foundation ก่อนลงงบ marketing เพิ่ม.</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Traffic first</span>
                <h3 class="hb-card__title">มีเว็บแล้ว แต่ traffic หรือ lead ยังไม่พอ</h3>
                <p class="hb-card__body">เริ่มด้วยรับทำ SEO สายเทคนิค พร้อม CRO + tracking — เริ่มจาก Technical SEO Audit ฟรี.</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Operations first</span>
                <h3 class="hb-card__title">ทีมเสียเวลากับงานซ้ำ ตอบลูกค้าช้า หรือข้อมูลกระจาย</h3>
                <p class="hb-card__body">เริ่มด้วย AI Consulting เพื่อหา use case ที่ ROI สูงก่อนลงทุน build ระบบจริง.</p>
            </a>
            <a class="hb-card hb-bento__cell hb-bento__cell--c2" href="<?php echo esc_url( home_url( '/work/' ) ); ?>" style="text-decoration:none;">
                <span class="hb-eyebrow">Case studies</span>
                <h3 class="hb-card__title">อยากเห็นตัวเลขจากงานจริงก่อนคุยรายละเอียด</h3>
                <p class="hb-card__body">ดู case studies SEO, เว็บไซต์ และ AI ที่วัดผลจาก GA4, Search Console และ operation metrics.</p>
            </a>
        </div>
    </div>
</section>

<!-- Bundle -->
<section class="hb-section hb-section--surface">
    <div class="hb-container">
        <div class="hb-section__head hb-section__head--center">
            <span class="hb-eyebrow">Why bundle?</span>
            <h2 class="hb-h2">ทำไมควรใช้บริการรวมกันในทีมเดียว</h2>
            <p class="hb-section__sub">Web · SEO · AI แยกกัน = 3 KPI ที่ไม่คุยกัน รวมกัน = ทีมเดียวที่รับผิดชอบผลรวมและ Optimize ข้ามฟังก์ชันได้</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:var(--hb-space-4);">
            <div class="hb-card">
                <h3 class="hb-card__title">1 + 1 + 1 = 5</h3>
                <p class="hb-card__body">เว็บ SEO-Ready ทำให้ติด Google · SEO + AI Search ทำให้ traffic โต · AI ทำให้ทีม scale หลังลูกค้าเข้ามา ผลลัพธ์ทบต้นกว่าทำแยก</p>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">Data ต่อเนื่อง</h3>
                <p class="hb-card__body">GA4 + GSC + AI Chat Log อยู่ใน Dashboard เดียว ทำให้เห็น Pattern ที่ทีมแยกไม่มีวันเห็น</p>
            </div>
            <div class="hb-card">
                <h3 class="hb-card__title">ราคา Bundle</h3>
                <p class="hb-card__body">เลือก Retainer หลายบริการรวมกัน ประหยัดกว่าจ้างหลายบริษัทแยก ~30% และคุยกับทีมเดียว</p>
            </div>
        </div>
    </div>
</section>

<section class="hb-section hb-section--surface">
    <div class="hb-container hb-container--md" style="text-align:center;">
        <h2 class="hb-h2">เริ่มด้วย Audit ฟรี</h2>
        <p class="hb-lead" style="margin: var(--hb-space-4) auto var(--hb-space-6);">ส่งรายงาน 15-20 หน้าให้ภายใน 3 วันทำการ ก่อนตัดสินใจเริ่มงาน</p>
        <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-btn hb-btn--gradient hb-btn--lg">รับ Audit ฟรี &rarr;</a>
    </div>
</section>

<?php
$service_items = array();
foreach ( hashbox_service_catalog_live() as $svc ) {
    $service_items[] = array(
        'name'        => $svc['name'],
        'alt'         => $svc['en_name'],
        'url'         => hashbox_service_url( $svc ),
        'description' => $svc['en_desc'],
        'serviceType' => $svc['service_type'],
    );
}

$item_list_elements = array();
foreach ( $service_items as $i => $svc ) {
    $item_list_elements[] = array(
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'item'     => array(
            '@type'       => 'Service',
            '@id'         => $svc['url'] . '#service',
            'name'        => $svc['name'],
            'alternateName' => $svc['alt'],
            'url'         => $svc['url'],
            'description' => $svc['description'],
            'serviceType' => $svc['serviceType'],
            'provider'    => array( '@id' => home_url( '/#organization' ) ),
            'areaServed'  => 'Thailand',
        ),
    );
}

hashbox_jsonld( array(
    '@context'        => 'https://schema.org',
    '@type'           => 'ItemList',
    '@id'             => $page_url . '#services-list',
    'name'            => 'Hashbox Studio Services',
    'numberOfItems'   => count( $service_items ),
    'itemListElement' => $item_list_elements,
) );

hashbox_jsonld( array(
    '@context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => array(
        array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ),
        array( '@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $page_url ),
    ),
) );

get_footer();
