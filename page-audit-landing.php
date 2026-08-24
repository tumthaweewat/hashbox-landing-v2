<?php
/**
 * Campaign audit landing page template.
 *
 * Renders the five paid-media audit entry points from hashbox_audit_landing_pages().
 *
 * @package Hashbox_Studio_V2
 */

$landing = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
if ( ! $landing ) {
    status_header( 404 );
    get_template_part( '404' );
    return;
}

$contact_status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
$confirmation_status = isset( $_GET['confirmation'] ) ? sanitize_key( wp_unslash( $_GET['confirmation'] ) ) : '';
$current_url    = hashbox_audit_landing_canonical_url( $landing );
$wide_image     = hashbox_audit_landing_asset_uri( $landing['wide_image'] );
$portrait_image = hashbox_audit_landing_asset_uri( $landing['portrait_image'] );
$proof_url      = home_url( $landing['proof']['href'] );
$is_ai_landing  = 'ai-workflow-audit' === $landing['slug'];
$confirmed_ai_lead_ref = $is_ai_landing && function_exists( 'hashbox_get_confirmed_ai_audit_lead_ref' )
    ? hashbox_get_confirmed_ai_audit_lead_ref()
    : '';
$confirmed_ai_lead = '' !== $confirmed_ai_lead_ref;

$service_options = $is_ai_landing
    ? array(
        'AI / LINE Chatbot',
        'Workflow Automation / n8n',
        'RAG / Internal Knowledge Assistant',
        'Custom AI Integration',
        'ยังไม่แน่ใจ ขอ AI Screening ก่อน',
    )
    : array(
        'SEO-Ready Website',
        'AI Tool / LINE Bot',
        'Digital Marketing + CRO',
        'Bundle ทั้ง 3 บริการ',
        'ยังไม่แน่ใจ ขอ Audit ก่อน',
    );
$budget_options = $is_ai_landing
    ? array(
        'ต่ำกว่า 60,000',
        '60,000-150,000',
        '150,001-300,000',
        '300,001-1,000,000',
        'มากกว่า 1,000,000',
        'ยังไม่แน่ใจ',
    )
    : array(
        'ต่ำกว่า 50,000',
        '50,000-100,000',
        '100,000-300,000',
        '300,000+',
        'ยังไม่แน่ใจ',
    );
$timeline_options = array(
    'ภายใน 30 วัน',
    '1-3 เดือน',
    '3 เดือนขึ้นไป',
    'ยังสำรวจอยู่',
);
$contact_options = array( 'LINE', 'โทร', 'Email' );
$attribution_keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'gclid', 'wbraid', 'gbraid' );

get_header();
?>

<article class="hb-audit<?php echo $is_ai_landing ? ' hb-ai' : ''; ?>" data-audit-slug="<?php echo esc_attr( $landing['slug'] ); ?>" data-service-interest="<?php echo esc_attr( $landing['service_interest'] ); ?>" data-utm-content="<?php echo esc_attr( isset( $landing['utm_content'] ) ? $landing['utm_content'] : '' ); ?>">
    <?php if ( $is_ai_landing ) : ?>
        <header class="hb-ai-hero">
            <div class="hb-container">
                <div class="hb-ai-hero__layout">
                    <div class="hb-ai-hero__copy">
                        <p class="hb-ai-hero__availability">AI Opportunity Screening · 30 นาที · ไม่มีค่าใช้จ่าย</p>
                        <p class="hb-ai-hero__vendor"><?php echo esc_html( $landing['hero_vendor'] ); ?></p>
                        <h1 class="hb-ai-hero__title"><?php echo esc_html( $landing['hero_headline'] ); ?></h1>
                        <p class="hb-ai-hero__lede"><?php echo esc_html( $landing['hero_subcopy'] ); ?></p>
                        <div class="hb-ai-hero__actions">
                            <a class="hb-btn hb-btn--gradient hb-btn--lg hb-ai-button hb-ai-hero__primary" href="#audit-form" data-track-event="ai_cta_click">
                                <?php echo esc_html( $landing['primary_cta'] ); ?> <span aria-hidden="true">→</span>
                            </a>
                            <a class="hb-btn hb-btn--outline hb-btn--lg" href="#proof">ดูเคส AutoBot</a>
                        </div>
                        <p class="hb-ai-hero__reassurance">คุยกับทีมที่ทำระบบจริง · รู้ว่าควรเริ่มตรงไหน · ติดต่อกลับภายใน 1–3 วันทำการ</p>
                    </div>

                    <div class="hb-ai-hero__stat">
                        <p class="hb-ai-hero__figure">
                            <?php echo esc_html( str_replace( '-', '−', rtrim( $landing['proof']['metric'], '%' ) ) ); ?><sup>%</sup>
                        </p>
                        <p class="hb-ai-hero__qualifier">Support cost ในเคส AutoBot ที่ทีม Hashbox ลงมือทำด้วย LINE Bot + RAG ภายใน 8 สัปดาห์ ผลลัพธ์จริงขึ้นอยู่กับโจทย์และข้อมูลของแต่ละธุรกิจ</p>
                    </div>
                </div>
            </div>
        </header>

        <section id="proof" class="hb-ai-section hb-ai-case">
            <div class="hb-container hb-ai-case__layout">
                <div class="hb-ai-case__copy">
                    <p class="hb-ai-case__label">AutoBot × Hashbox</p>
                    <h2>ตอบอัตโนมัติเมื่อควรตอบ ส่งต่อคนเมื่อควรคิด</h2>
                    <p><?php echo esc_html( $landing['proof']['body'] ); ?></p>
                    <a class="hb-ai-text-link" href="<?php echo esc_url( $proof_url ); ?>">ดูรายละเอียดเคส AutoBot <span aria-hidden="true">→</span></a>
                </div>
                <ol class="hb-ai-case__flow" aria-label="โครงสร้างระบบในเคส AutoBot">
                    <li>
                        <span>01</span>
                        <div><h3>รับคำถามจาก LINE</h3><p>รับบริบทจากลูกค้าได้ตลอด 24 ชั่วโมง โดยไม่ต้องรอเจ้าหน้าที่เปิดแชท</p></div>
                    </li>
                    <li>
                        <span>02</span>
                        <div><h3>ค้นคำตอบจาก Knowledge Base</h3><p>RAG ดึงข้อมูลที่เกี่ยวข้องมาใช้ตอบ แทนการเดาจากโมเดลเพียงอย่างเดียว</p></div>
                    </li>
                    <li>
                        <span>03</span>
                        <div><h3>ส่งต่อ Human พร้อมบริบท</h3><p>เคสซับซ้อนถูกส่งต่อให้ทีมงาน โดยยังคงประวัติและเหตุผลที่ต้องรับช่วง</p></div>
                    </li>
                </ol>
                <dl class="hb-ai-case__metrics" aria-label="ผลลัพธ์จากเคส AutoBot">
                    <?php foreach ( $landing['case_metrics'] as $metric ) : ?>
                        <div>
                            <dt><?php echo esc_html( $metric['metric'] ); ?></dt>
                            <dd><strong><?php echo esc_html( $metric['label'] ); ?></strong><span><?php echo esc_html( $metric['detail'] ); ?></span></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
            </div>
        </section>

        <section class="hb-ai-section hb-ai-usecases">
            <div class="hb-container">
                <div class="hb-ai-usecases__intro">
                    <h2 class="hb-ai-section__heading">3 โจทย์ที่มีเหตุผลให้เริ่ม Screening</h2>
                    <p class="hb-ai-section__lede">เริ่มจากปัญหาที่เกิดซ้ำและวัดผลได้ก่อน ไม่เริ่มจากชื่อเทคโนโลยีหรือทำ AI เพราะกำลังเป็นกระแส</p>
                </div>
                <ol class="hb-ai-usecases__list">
                    <?php foreach ( $landing['use_cases'] as $index => $use_case ) : ?>
                        <li class="hb-ai-usecase">
                            <span class="hb-ai-usecase__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
                            <div>
                                <h3 class="hb-ai-usecase__title"><?php echo esc_html( $use_case['title'] ); ?></h3>
                                <p class="hb-ai-usecase__body"><?php echo esc_html( $use_case['body'] ); ?></p>
                            </div>
                            <p class="hb-ai-usecase__fit"><strong>เหมาะเมื่อ:</strong> <?php echo esc_html( $use_case['fit'] ); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <p class="hb-ai-usecases__note"><strong>Dashboard เป็นชั้นวัดผล ไม่ใช่จุดเริ่มต้น:</strong> ถ้าโจทย์ต้องติดตาม SLA, usage, accuracy หรือ handoff เราจะวาง Dashboard เป็นส่วนหนึ่งของระบบหลังเลือก use case แล้ว</p>
            </div>
        </section>

        <section class="hb-ai-screening">
            <div class="hb-container">
                <h2 class="hb-ai-section__heading">รู้ให้ชัดว่าควรเริ่มตรงไหน ก่อนทำ PoC</h2>
                <p class="hb-ai-section__lede">Screening 30 นาทีช่วยคัดโจทย์ที่มีโอกาสคุ้ม ตรวจความพร้อมของข้อมูล และชี้ขั้นตอนถัดไปโดยไม่ผูกมัดให้จ้างต่อ</p>
                <div class="hb-ai-screening__layout">
                    <div class="hb-ai-screening__signals">
                        <h3>ควรคุยตอนนี้ ถ้า…</h3>
                        <ul>
                            <?php foreach ( $landing['pain_points'] as $pain ) : ?>
                                <li><?php echo esc_html( $pain ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="hb-ai-screening__outputs">
                        <h3>หลังคุย คุณจะรู้…</h3>
                        <dl>
                            <?php foreach ( $landing['audit_includes'] as $item ) : ?>
                                <div>
                                    <dt><?php echo esc_html( $item['title'] ); ?></dt>
                                    <dd><?php echo esc_html( $item['body'] ); ?></dd>
                                </div>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                </div>
            </div>
        </section>

        <section class="hb-ai-engagements" aria-labelledby="ai-engagements-heading">
            <div class="hb-container">
                <div class="hb-ai-engagements__intro">
                    <h2 id="ai-engagements-heading" class="hb-ai-section__heading">เริ่มเล็ก แล้วเพิ่มงบเมื่อข้อมูลยืนยัน</h2>
                    <p class="hb-ai-section__lede">Screening ช่วยเลือกทางที่เหมาะ จากนั้นค่อยตัดสินใจว่าจะหยุด จัดทำ business case ทดลอง PoC หรือขึ้นระบบ Production</p>
                </div>
                <ol class="hb-ai-engagements__list">
                    <?php foreach ( $landing['engagements'] as $index => $engagement ) : ?>
                        <li>
                            <span class="hb-ai-engagements__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
                            <div class="hb-ai-engagements__copy">
                                <h3><?php echo esc_html( $engagement['title'] ); ?></h3>
                                <p><?php echo esc_html( $engagement['body'] ); ?></p>
                                <?php if ( ! empty( $engagement['decision'] ) ) : ?>
                                    <p class="hb-ai-engagements__decision"><strong>สิ่งที่คุณได้รับ:</strong> <?php echo esc_html( $engagement['decision'] ); ?></p>
                                <?php endif; ?>
                            </div>
                            <dl class="hb-ai-engagements__meta">
                                <div><dt>งบเริ่มต้น</dt><dd><?php echo esc_html( $engagement['price'] ); ?></dd></div>
                                <div><dt>ระยะเวลา</dt><dd><?php echo esc_html( $engagement['timeline'] ); ?></dd></div>
                            </dl>
                        </li>
                    <?php endforeach; ?>
                </ol>
                <p class="hb-ai-engagements__note"><?php echo esc_html( $landing['engagement_note'] ); ?></p>
            </div>
        </section>
    <?php else : ?>
        <header class="hb-audit-hero">
            <div class="hb-audit-hero__grid"></div>
            <div class="hb-container hb-container--xl">
                <div class="hb-audit-hero__inner">
                    <div class="hb-audit-hero__copy" data-reveal>
                        <span class="hb-audit-kicker">
                            <span class="hb-audit-kicker__mark">H</span>
                            <?php echo esc_html( $landing['service_label'] ); ?> · Free Audit
                        </span>
                        <h1 class="hb-audit-hero__title"><?php echo esc_html( $landing['hero_headline'] ); ?></h1>
                        <p class="hb-audit-hero__sub"><?php echo esc_html( $landing['hero_subcopy'] ); ?></p>
                        <div class="hb-audit-hero__actions">
                            <a class="hb-btn hb-btn--gradient hb-btn--lg" href="#audit-form">
                                <?php echo esc_html( $landing['primary_cta'] ); ?>
                                <span aria-hidden="true">→</span>
                            </a>
                            <a class="hb-btn hb-btn--outline hb-btn--lg" href="<?php echo esc_url( $proof_url ); ?>">ดู proof ที่เกี่ยวข้อง</a>
                        </div>
                        <div class="hb-audit-proofline">
                            <span class="hb-audit-proofline__dot"></span>
                            <?php echo esc_html( $landing['proof_line'] ); ?>
                        </div>
                    </div>

                    <figure class="hb-audit-hero__visual" data-reveal>
                        <picture>
                            <source media="(max-width: 720px)" srcset="<?php echo esc_attr( hashbox_ad_webp_srcset( $landing['portrait_image'], array( 540, 1080 ) ) ); ?>" sizes="100vw">
                            <img src="<?php echo esc_url( hashbox_ad_webp_uri( $landing['wide_image'], 1200 ) ); ?>" srcset="<?php echo esc_attr( hashbox_ad_webp_srcset( $landing['wide_image'], array( 640, 1200 ) ) ); ?>" sizes="(min-width: 900px) 640px, 100vw" alt="<?php echo esc_attr( 'Hashbox ' . $landing['service_label'] . ' campaign artwork' ); ?>" width="1200" height="627" fetchpriority="high" decoding="async">
                        </picture>
                    </figure>
                </div>
            </div>
        </header>

        <section class="hb-audit-section">
            <div class="hb-container">
                <div class="hb-audit-section__head" data-reveal>
                    <span class="hb-eyebrow">Pain points</span>
                    <h2 class="hb-h2">ถ้าอาการเหล่านี้เกิดขึ้น Audit จะช่วยจัดลำดับให้ชัด</h2>
                </div>
                <div class="hb-audit-card-grid hb-audit-card-grid--three">
                    <?php foreach ( $landing['pain_points'] as $index => $pain ) : ?>
                        <div class="hb-audit-card" data-reveal>
                            <span class="hb-audit-card__num"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
                            <p><?php echo esc_html( $pain ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="hb-audit-section hb-audit-section--surface">
            <div class="hb-container">
                <div class="hb-audit-section__head" data-reveal>
                    <span class="hb-eyebrow">What the audit includes</span>
                    <h2 class="hb-h2">สิ่งที่คุณจะได้จาก Audit ฟรี</h2>
                    <p class="hb-audit-section__sub">สรุปเป็น report และ action backlog ที่ทีมธุรกิจ, marketing และ dev อ่านร่วมกันได้</p>
                </div>
                <div class="hb-audit-card-grid hb-audit-card-grid--three">
                    <?php foreach ( $landing['audit_includes'] as $item ) : ?>
                        <div class="hb-audit-card hb-audit-card--accent" data-reveal>
                            <h3><?php echo esc_html( $item['title'] ); ?></h3>
                            <p><?php echo esc_html( $item['body'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="hb-audit-proof">
            <div class="hb-container">
                <div class="hb-audit-proof__inner" data-reveal>
                    <div>
                        <span class="hb-eyebrow">Proof-led</span>
                        <p class="hb-audit-proof__metric"><?php echo esc_html( $landing['proof']['metric'] ); ?></p>
                    </div>
                    <div class="hb-audit-proof__copy">
                        <h2><?php echo esc_html( $landing['proof']['title'] ); ?></h2>
                        <p><?php echo esc_html( $landing['proof']['body'] ); ?></p>
                        <a class="hb-audit-link" href="<?php echo esc_url( $proof_url ); ?>">อ่านรายละเอียดเพิ่มเติม <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="hb-audit-section">
            <div class="hb-container">
                <div class="hb-audit-section__head" data-reveal>
                    <span class="hb-eyebrow">Process</span>
                    <h2 class="hb-h2">3 ขั้นตอนก่อนส่ง roadmap ให้ตัดสินใจ</h2>
                </div>
                <ol class="hb-audit-steps">
                    <?php foreach ( $landing['process'] as $index => $step ) : ?>
                        <li class="hb-audit-step" data-reveal>
                            <span class="hb-audit-step__index"><?php echo esc_html( (string) ( $index + 1 ) ); ?></span>
                            <div>
                                <h3><?php echo esc_html( $step['title'] ); ?></h3>
                                <p><?php echo esc_html( $step['body'] ); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>
    <?php endif; ?>

    <section id="audit-form" class="hb-audit-form-section">
        <div class="hb-container">
            <div class="hb-audit-form-layout">
                <div class="hb-audit-form-copy"<?php if ( ! $is_ai_landing ) : ?> data-reveal<?php endif; ?>>
                    <?php if ( ! $is_ai_landing ) : ?><span class="hb-eyebrow">Request audit</span><?php endif; ?>
                    <h2 class="hb-h2"><?php echo esc_html( $landing['primary_cta'] ); ?></h2>
                    <p><?php echo esc_html( $is_ai_landing ? 'กรอกบริบทสั้น ๆ ทีมเราจะติดต่อกลับเพื่อนัดเวลา Screening 30 นาทีภายใน 1–3 วันทำการ' : 'กรอกข้อมูลให้พอเห็นบริบท ทีมเราจะตรวจ baseline และส่ง next-step recommendation กลับไปภายใน 1–3 วันทำการ' ); ?></p>
                    <?php if ( $is_ai_landing ) : ?>
                        <aside class="hb-ai-project-lead" aria-label="ผู้ดูแลโครงการ">
                            <p class="hb-ai-project-lead__label">Project lead</p>
                            <h3><?php echo esc_html( $landing['project_lead']['name'] ); ?></h3>
                            <p class="hb-ai-project-lead__role"><?php echo esc_html( $landing['project_lead']['role'] ); ?> · <?php echo esc_html( $landing['project_lead']['experience'] ); ?></p>
                            <p>ดูแลตั้งแต่เลือก use case, architecture, integration ไปจนถึง production monitoring</p>
                            <a class="hb-ai-text-link" href="<?php echo esc_url( $landing['project_lead']['linkedin'] ); ?>" target="_blank" rel="noopener noreferrer">ดูประสบการณ์บน LinkedIn <span aria-hidden="true">↗</span></a>
                        </aside>
                    <?php endif; ?>
                    <div class="hb-audit-contact-strip">
                        <a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click">LINE OA</a>
                        <a href="tel:+66625169868" data-track-event="phone_click">062-516-9868</a>
                        <a href="mailto:business@hashbox.co.th" data-track-event="email_click">business@hashbox.co.th</a>
                    </div>
                </div>

                <form class="hb-audit-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-audit-form<?php if ( ! $is_ai_landing ) : ?> data-reveal<?php endif; ?>>
                    <input type="hidden" name="action" value="hashbox_contact">
                    <input type="hidden" name="form_context" value="<?php echo esc_attr( $is_ai_landing ? 'ai_consulting' : 'audit_landing' ); ?>">
                    <input type="hidden" name="landing_slug" value="<?php echo esc_attr( $landing['slug'] ); ?>">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $current_url ); ?>#audit-form">
                    <?php foreach ( $attribution_keys as $attribution_key ) : ?>
                        <?php $attribution_default = 'utm_content' === $attribution_key && isset( $landing['utm_content'] ) ? $landing['utm_content'] : ''; ?>
                        <input type="hidden" name="<?php echo esc_attr( $attribution_key ); ?>" data-attribution-field="<?php echo esc_attr( $attribution_key ); ?>" data-attribution-default="<?php echo esc_attr( $attribution_default ); ?>" value="<?php echo esc_attr( $attribution_default ); ?>">
                    <?php endforeach; ?>
                    <?php wp_nonce_field( 'hashbox_contact', 'hashbox_nonce' ); ?>
                    <?php if ( $is_ai_landing ) : ?>
                        <?php wp_nonce_field( 'hashbox_ai_contact', 'hashbox_ai_nonce', false ); ?>
                    <?php endif; ?>

                    <?php if ( $confirmed_ai_lead ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--success hb-ai-success" role="status" aria-live="polite" aria-atomic="true" tabindex="-1" data-contact-alert>
                            <strong>ได้รับโจทย์แล้ว</strong>
                            <?php if ( 'queued' === $confirmation_status ) : ?>
                                <p>ทีม Hashbox จะติดต่อกลับภายใน 1–3 วันทำการ ระบบกำลังส่งอีเมลยืนยันพร้อมรายการข้อมูลที่ควรเตรียมไว้ให้คุณ</p>
                            <?php else : ?>
                                <p>ทีม Hashbox จะติดต่อกลับภายใน 1–3 วันทำการ หากต้องการส่งข้อมูลเพิ่มสามารถคุยต่อทาง LINE ได้ทันที</p>
                            <?php endif; ?>
                            <a class="hb-ai-text-link" href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click">คุยต่อทาง LINE <span aria-hidden="true">→</span></a>
                        </div>
                    <?php elseif ( ! $is_ai_landing && 'sent' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--success" role="status" aria-live="polite" aria-atomic="true" tabindex="-1" data-contact-alert>ส่งคำขอสำเร็จ ทีม Hashbox จะติดต่อกลับภายใน 1-3 วันทำการ</div>
                    <?php elseif ( 'invalid' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--error" role="alert" aria-live="assertive" aria-atomic="true" tabindex="-1" data-contact-alert><?php echo esc_html( $is_ai_landing ? 'ข้อมูลยังไม่ครบ กรุณากรอกชื่อ บริษัท อีเมล โจทย์ และช่องทางติดต่อที่เลือก พร้อมยินยอม PDPA' : 'กรุณากรอกข้อมูลที่จำเป็นให้ครบ และยินยอม PDPA ก่อนส่งฟอร์ม' ); ?></div>
                    <?php elseif ( 'error' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--error" role="alert" aria-live="assertive" aria-atomic="true" tabindex="-1" data-contact-alert>ส่งฟอร์มไม่สำเร็จ กรุณาลองใหม่หรือทัก LINE OA</div>
                    <?php endif; ?>

                    <?php if ( ! $confirmed_ai_lead ) : ?>
                    <?php if ( $is_ai_landing ) : ?>
                        <div class="hb-ai-form__essential">
                            <div class="hb-ai-form__identity">
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-name">ชื่อผู้ติดต่อ <span class="hb-label__required">*</span></label>
                                    <input id="audit-name" class="hb-input" type="text" name="name" required aria-required="true" autocomplete="name" placeholder="ชื่อและนามสกุล">
                                </div>
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-company">บริษัท <span class="hb-label__required">*</span></label>
                                    <input id="audit-company" class="hb-input" type="text" name="company" required aria-required="true" autocomplete="organization" placeholder="ชื่อบริษัทหรือองค์กร">
                                </div>
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-email">อีเมลสำหรับนัดหมาย <span class="hb-label__required">*</span></label>
                                <input id="audit-email" class="hb-input" type="email" name="email" required aria-required="true" autocomplete="email" inputmode="email" placeholder="you@company.com">
                            </div>
                            <div class="hb-ai-form__qualification">
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-service">โจทย์ที่สนใจ</label>
                                    <select id="audit-service" class="hb-select" name="service">
                                        <?php foreach ( $service_options as $option ) : ?>
                                            <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, 'ยังไม่แน่ใจ ขอ AI Screening ก่อน' ); ?>><?php echo esc_html( $option ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-timeline">ช่วงเวลาที่อยากเริ่ม</label>
                                    <select id="audit-timeline" class="hb-select" name="timeline">
                                        <option value="">ยังไม่ระบุ</option>
                                        <?php foreach ( $timeline_options as $option ) : ?>
                                            <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-problem">โจทย์หลักที่อยากแก้คืออะไร? <span class="hb-label__required">*</span></label>
                                <textarea id="audit-problem" class="hb-textarea" name="problem" rows="4" required aria-required="true" placeholder="เช่น ทีมตอบคำถามซ้ำ ข้อมูลอยู่หลายระบบ หรือต้องการค้นเอกสารด้วย AI"></textarea>
                            </div>
                        </div>

                        <details class="hb-ai-form__optional">
                            <summary>เพิ่มข้อมูลเพื่อให้คำแนะนำแม่นขึ้น (ไม่บังคับ)</summary>
                            <div class="hb-ai-form__optional-fields">
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-website">เว็บไซต์ปัจจุบัน</label>
                                    <input id="audit-website" class="hb-input" type="url" name="website" inputmode="url" autocomplete="url" placeholder="https://company.com">
                                </div>
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-budget">งบประมาณโดยประมาณ</label>
                                    <select id="audit-budget" class="hb-select" name="budget">
                                        <option value="">ยังไม่ระบุ</option>
                                        <?php foreach ( $budget_options as $option ) : ?>
                                            <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-contact">ช่องทางติดต่ออื่นที่สะดวก</label>
                                    <select id="audit-contact" class="hb-select" name="contact_preference" data-ai-contact-preference>
                                        <option value="">ใช้อีเมลด้านบน</option>
                                        <?php foreach ( array( 'LINE', 'โทร' ) as $option ) : ?>
                                            <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="hb-field">
                                    <label class="hb-label" for="audit-contact-detail">เบอร์โทร / LINE ID <span class="hb-label__required" data-ai-contact-required hidden>*</span></label>
                                    <input id="audit-contact-detail" class="hb-input" type="text" name="contact_detail" autocomplete="tel" aria-describedby="audit-contact-detail-help" data-ai-contact-detail placeholder="ระบุเมื่ออยากให้ติดต่อช่องทางอื่น">
                                    <p id="audit-contact-detail-help" class="hb-field__help">จำเป็นเมื่อเลือก LINE หรือโทรศัพท์</p>
                                </div>
                            </div>
                        </details>
                    <?php else : ?>
                        <div class="hb-audit-form__grid">
                            <div class="hb-field">
                                <label class="hb-label" for="audit-name">ชื่อ / บริษัท <span class="hb-label__required">*</span></label>
                                <input id="audit-name" class="hb-input" type="text" name="name" required autocomplete="name" placeholder="ชื่อคุณ · บริษัท">
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-website">เว็บไซต์ปัจจุบัน <span class="hb-label__required">*</span></label>
                                <input id="audit-website" class="hb-input" type="url" name="website" required inputmode="url" placeholder="https://company.com">
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-email">อีเมลสำหรับส่ง Audit</label>
                                <input id="audit-email" class="hb-input" type="email" name="email" autocomplete="email" placeholder="you@company.com">
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-service">สนใจบริการไหน? <span class="hb-label__required">*</span></label>
                                <select id="audit-service" class="hb-select" name="service" required>
                                    <?php foreach ( $service_options as $option ) : ?>
                                        <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $option, $landing['service_interest'] ); ?>><?php echo esc_html( $option ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-budget">งบประมาณโดยประมาณ <span class="hb-label__required">*</span></label>
                                <select id="audit-budget" class="hb-select" name="budget" required>
                                    <option value="">เลือกช่วงงบประมาณ</option>
                                    <?php foreach ( $budget_options as $option ) : ?>
                                        <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-timeline">ต้องการเริ่มเมื่อไหร่? <span class="hb-label__required">*</span></label>
                                <select id="audit-timeline" class="hb-select" name="timeline" required>
                                    <option value="">เลือก timeline</option>
                                    <?php foreach ( $timeline_options as $option ) : ?>
                                        <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="hb-field">
                            <label class="hb-label" for="audit-problem">โจทย์หลักที่อยากแก้คืออะไร? <span class="hb-label__required">*</span></label>
                            <textarea id="audit-problem" class="hb-textarea" name="problem" rows="4" required placeholder="เล่าอาการปัจจุบัน เช่น traffic ตก, lead ไม่มา, ทีมตอบแชทซ้ำเยอะ"></textarea>
                        </div>

                        <div class="hb-audit-form__grid">
                            <div class="hb-field">
                                <label class="hb-label" for="audit-contact">ช่องทางติดต่อที่สะดวก <span class="hb-label__required">*</span></label>
                                <select id="audit-contact" class="hb-select" name="contact_preference" required>
                                    <option value="">เลือกช่องทาง</option>
                                    <?php foreach ( $contact_options as $option ) : ?>
                                        <option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="hb-field">
                                <label class="hb-label" for="audit-contact-detail">อีเมล / เบอร์ / LINE ID <span class="hb-label__required">*</span></label>
                                <input id="audit-contact-detail" class="hb-input" type="text" name="contact_detail" required placeholder="ช่องทางที่ให้ติดต่อกลับ">
                            </div>
                        </div>
                    <?php endif; ?>

                    <label class="hb-checkbox-wrap">
                        <input type="checkbox" class="hb-checkbox" name="pdpa" required>
                        <span class="hb-checkbox-wrap__label">ยินยอมให้ Hashbox เก็บข้อมูลเพื่อติดต่อกลับตาม <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">นโยบาย PDPA</a></span>
                    </label>

                    <button class="hb-btn hb-btn--gradient hb-btn--lg hb-audit-form__submit<?php echo $is_ai_landing ? ' hb-ai-button' : ''; ?>" type="submit"><?php echo esc_html( $landing['primary_cta'] ); ?> <span aria-hidden="true">→</span></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </section>

    <section class="hb-audit-section">
        <div class="hb-container hb-container--md">
            <div class="hb-audit-section__head hb-audit-section__head--center"<?php if ( ! $is_ai_landing ) : ?> data-reveal<?php endif; ?>>
                <span class="hb-eyebrow">FAQ</span>
                <h2 class="hb-h2">คำถามที่พบบ่อย</h2>
            </div>
            <div class="hb-audit-faq">
                <?php foreach ( $landing['faqs'] as $faq ) : ?>
                    <details class="hb-audit-faq__item"<?php if ( ! $is_ai_landing ) : ?> data-reveal<?php endif; ?>>
                        <summary><?php echo esc_html( $faq['q'] ); ?></summary>
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ( $is_ai_landing ) : ?>
        <aside class="hb-ai-mobile-cta" data-ai-sticky-cta aria-hidden="true" inert>
            <span class="hb-ai-mobile-cta__note">Screening ฟรี · 30 นาที</span>
            <a class="hb-btn hb-btn--gradient hb-ai-button" href="#audit-form" data-track-event="ai_cta_click">ส่งโจทย์ AI</a>
        </aside>
    <?php else : ?>
        <div class="hb-audit-mobile-cta">
            <a class="hb-btn hb-btn--gradient" href="#audit-form"><?php echo esc_html( $landing['primary_cta'] ); ?></a>
        </div>
    <?php endif; ?>
</article>

<?php
get_footer();
