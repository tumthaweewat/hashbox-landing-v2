<?php
/**
 * Template Name: Service: Services Hub
 *
 * @package Hashbox_Studio_V2
 */

get_header();
$page_url   = get_permalink();
$hb_services = hashbox_service_catalog_live();
?>

<div class="hb-services-page">
    <section class="hb-services-hero" aria-labelledby="services-page-title">
        <div class="hb-services-container">
            <nav class="hb-services-breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page">Services</li>
                </ol>
            </nav>

            <div class="hb-services-hero__grid">
                <div class="hb-services-hero__copy">
                    <p class="hb-services-kicker">Services</p>
                    <h1 id="services-page-title" class="hb-services-hero__title">
                        <span>รับทำเว็บไซต์ SEO-Ready,</span>
                        <span class="hb-services-hero__accent">ที่ปรึกษา AI, รับทำ SEO</span>
                        <span>และ AI Search ในทีมเดียว</span>
                    </h1>
                    <p class="hb-services-hero__lede">
                        บริการของ Hashbox Studio คือ 5 บริการที่ต่อกันเป็นระบบเดียว: รับทำเว็บไซต์ SEO-Ready, ที่ปรึกษา AI สำหรับธุรกิจ, รับทำ SEO สายเทคนิค, รับทำ AI Search (GEO) และ Workflow Automation ด้วย n8n — ทุกบริการเริ่มแยกได้ ราคาเปิดเผย และวัดผลจากข้อมูลจริงรายวัน
                    </p>
                    <a class="hb-services-btn hb-services-btn--primary" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">รับ Audit ฟรี <span aria-hidden="true">&rarr;</span></a>
                </div>

                <aside class="hb-services-index" aria-label="บริการทั้งหมด">
                    <p class="hb-services-index__title">บริการทั้งหมด</p>
                    <ol>
                        <?php $hb_i = 0; foreach ( $hb_services as $svc ) : $hb_i++; ?>
                        <li>
                            <a href="#service-<?php echo esc_attr( $svc['key'] ); ?>">
                                <span class="hb-services-index__num"><?php echo esc_html( str_pad( (string) $hb_i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                                <span><?php echo esc_html( $svc['short'] ); ?></span>
                                <span aria-hidden="true">&darr;</span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                </aside>
            </div>
        </div>
    </section>

    <section id="service-catalog" class="hb-services-catalog" aria-labelledby="service-catalog-title">
        <div class="hb-services-container">
            <header class="hb-services-section-head">
                <h2 id="service-catalog-title">5 บริการที่ต่อกันเป็นระบบเดียว</h2>
                <p>ทุกบริการเริ่มแยกได้ ราคาเปิดเผย และวัดผลจากข้อมูลจริงรายวัน</p>
            </header>

            <div class="hb-services-ledger">
                <?php $hb_i = 0; foreach ( $hb_services as $svc ) : $hb_i++; ?>
                <article id="service-<?php echo esc_attr( $svc['key'] ); ?>" class="hb-services-ledger__item">
                    <span class="hb-services-ledger__num"><?php echo esc_html( str_pad( (string) $hb_i, 2, '0', STR_PAD_LEFT ) ); ?></span>
                    <div class="hb-services-ledger__body">
                        <h3><a href="<?php echo esc_url( hashbox_service_url( $svc ) ); ?>"><?php echo esc_html( $svc['name'] ); ?></a></h3>
                        <p><?php echo esc_html( $svc['desc'] ); ?></p>
                    </div>
                    <div class="hb-services-ledger__detail">
                        <?php echo hashbox_service_bullets_html( $svc, 'hb-services-ledger__links' ); ?>
                        <div class="hb-services-ledger__actions">
                            <?php if ( ! empty( $svc['price'] ) ) : ?>
                            <span class="hb-services-ledger__price"><?php echo esc_html( $svc['price'] ); ?></span>
                            <?php endif; ?>
                            <a class="hb-services-ledger__cta" href="<?php echo esc_url( hashbox_service_url( $svc ) ); ?>" aria-label="ดูรายละเอียด<?php echo esc_attr( $svc['name'] ); ?>">
                                <span class="hb-services-ledger__cta-full">ดูรายละเอียด<?php echo esc_html( $svc['name'] ); ?></span>
                                <span class="hb-services-ledger__cta-compact" aria-hidden="true">ดูรายละเอียด</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>

                <article class="hb-services-ledger__item hb-services-ledger__item--english" lang="en">
                    <span class="hb-services-ledger__num">EN</span>
                    <div class="hb-services-ledger__body">
                        <h3><a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>" hreflang="en">English: AI Consulting · SEO · AI Search</a></h3>
                        <p>For English-speaking teams in Thailand — <a href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>">AI consulting in Bangkok</a>, <a href="<?php echo esc_url( home_url( '/en/seo/' ) ); ?>">technical-first SEO agency</a> and <a href="<?php echo esc_url( home_url( '/en/ai-search/' ) ); ?>">AI Search (GEO)</a> and <a href="<?php echo esc_url( home_url( '/en/website-development/' ) ); ?>">website development</a> — same prices, PDPA, LINE and Thai-language context.</p>
                    </div>
                    <div class="hb-services-ledger__detail">
                        <p class="hb-services-ledger__delivery">English delivery · Public THB pricing · 100% source code</p>
                        <div class="hb-services-ledger__actions">
                            <a class="hb-services-ledger__cta" href="<?php echo esc_url( home_url( '/en/ai-consulting/' ) ); ?>" hreflang="en">Read in English <span aria-hidden="true">&rarr;</span></a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="hb-services-fit" aria-labelledby="service-fit-title">
        <div class="hb-services-container">
            <header class="hb-services-section-head">
                <p class="hb-services-kicker">Service fit</p>
                <h2 id="service-fit-title">ควรเริ่มจากบริการไหนก่อน?</h2>
                <p>เลือกจากปัญหาหลักของธุรกิจตอนนี้ แล้วค่อยขยายเป็นระบบ Web + SEO + AI ที่ทำงานร่วมกัน</p>
            </header>

            <div class="hb-services-fit__list">
                <a class="hb-services-fit__row" href="<?php echo esc_url( home_url( '/services/website-development/' ) ); ?>">
                    <span class="hb-services-fit__label">Website first</span>
                    <h3>เว็บช้า ติด Google ยาก หรือกำลังทำเว็บใหม่</h3>
                    <p>เริ่มด้วย SEO-Ready Website เพื่อแก้ technical foundation ก่อนลงงบ marketing เพิ่ม.</p>
                    <span class="hb-services-fit__arrow" aria-hidden="true">&rarr;</span>
                </a>
                <a class="hb-services-fit__row" href="<?php echo esc_url( home_url( '/services/seo/' ) ); ?>">
                    <span class="hb-services-fit__label">Traffic first</span>
                    <h3>มีเว็บแล้ว แต่ traffic หรือ lead ยังไม่พอ</h3>
                    <p>เริ่มด้วยรับทำ SEO สายเทคนิค พร้อม CRO + tracking — เริ่มจาก Technical SEO Audit ฟรี.</p>
                    <span class="hb-services-fit__arrow" aria-hidden="true">&rarr;</span>
                </a>
                <a class="hb-services-fit__row" href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>">
                    <span class="hb-services-fit__label">Operations first</span>
                    <h3>ทีมเสียเวลากับงานซ้ำ ตอบลูกค้าช้า หรือข้อมูลกระจาย</h3>
                    <p>เริ่มด้วย AI Consulting เพื่อหา use case ที่ ROI สูงก่อนลงทุน build ระบบจริง.</p>
                    <span class="hb-services-fit__arrow" aria-hidden="true">&rarr;</span>
                </a>
                <a class="hb-services-fit__row" href="<?php echo esc_url( home_url( '/work/' ) ); ?>">
                    <span class="hb-services-fit__label">Case studies</span>
                    <h3>อยากเห็นตัวเลขจากงานจริงก่อนคุยรายละเอียด</h3>
                    <p>ดู case studies SEO, เว็บไซต์ และ AI ที่วัดผลจาก GA4, Search Console และ operation metrics.</p>
                    <span class="hb-services-fit__arrow" aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <section class="hb-services-bundle" aria-labelledby="services-bundle-title">
        <div class="hb-services-container">
            <header class="hb-services-bundle__head">
                <p>Why bundle?</p>
                <h2 id="services-bundle-title">ทำไมควรใช้บริการรวมกันในทีมเดียว</h2>
                <p>Web · SEO · AI แยกกัน = 3 KPI ที่ไม่คุยกัน รวมกัน = ทีมเดียวที่รับผิดชอบผลรวมและ Optimize ข้ามฟังก์ชันได้</p>
            </header>
            <div class="hb-services-bundle__grid">
                <article>
                    <h3>1 + 1 + 1 = 5</h3>
                    <p>เว็บ SEO-Ready ทำให้ติด Google · SEO + AI Search ทำให้ traffic โต · AI ทำให้ทีม scale หลังลูกค้าเข้ามา ผลลัพธ์ทบต้นกว่าทำแยก</p>
                </article>
                <article>
                    <h3>Data ต่อเนื่อง</h3>
                    <p>GA4 + GSC + AI Chat Log อยู่ใน Dashboard เดียว ทำให้เห็น Pattern ที่ทีมแยกไม่มีวันเห็น</p>
                </article>
                <article>
                    <h3>ราคา Bundle</h3>
                    <p>เลือก Retainer หลายบริการรวมกัน ประหยัดกว่าจ้างหลายบริษัทแยก ~30% และคุยกับทีมเดียว</p>
                </article>
            </div>
        </div>
    </section>

    <section id="services-audit" class="hb-services-audit" aria-labelledby="services-audit-title">
        <div class="hb-services-container hb-services-audit__grid">
            <div>
                <h2 id="services-audit-title">เริ่มด้วย Audit ฟรี</h2>
                <p>ส่งรายงาน 15-20 หน้าให้ภายใน 3 วันทำการ ก่อนตัดสินใจเริ่มงาน</p>
            </div>
            <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hb-services-btn hb-services-btn--primary">รับ Audit ฟรี <span aria-hidden="true">&rarr;</span></a>
        </div>
    </section>
</div>

<?php
$service_items = array();
foreach ( $hb_services as $svc ) {
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
