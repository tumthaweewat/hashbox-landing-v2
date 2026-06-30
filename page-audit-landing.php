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
$current_url    = hashbox_audit_landing_canonical_url( $landing );
$wide_image     = hashbox_audit_landing_asset_uri( $landing['wide_image'] );
$portrait_image = hashbox_audit_landing_asset_uri( $landing['portrait_image'] );
$proof_url      = home_url( $landing['proof']['href'] );

$service_options = array(
    'SEO-Ready Website',
    'AI Tool / LINE Bot',
    'Digital Marketing + CRO',
    'Bundle ทั้ง 3 บริการ',
    'ยังไม่แน่ใจ ขอ Audit ก่อน',
);
$budget_options = array(
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
$utm_keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' );

get_header();
?>

<article class="hb-audit" data-audit-slug="<?php echo esc_attr( $landing['slug'] ); ?>" data-service-interest="<?php echo esc_attr( $landing['service_interest'] ); ?>">
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
                        <source media="(max-width: 720px)" srcset="<?php echo esc_url( $portrait_image ); ?>">
                        <img src="<?php echo esc_url( $wide_image ); ?>" alt="<?php echo esc_attr( 'Hashbox ' . $landing['service_label'] . ' campaign artwork' ); ?>" width="1200" height="627" fetchpriority="high">
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

    <section id="audit-form" class="hb-audit-form-section">
        <div class="hb-container">
            <div class="hb-audit-form-layout">
                <div class="hb-audit-form-copy" data-reveal>
                    <span class="hb-eyebrow">Request audit</span>
                    <h2 class="hb-h2"><?php echo esc_html( $landing['primary_cta'] ); ?></h2>
                    <p>กรอกข้อมูลให้พอเห็นบริบท ทีมเราจะตรวจ baseline และส่ง next-step recommendation กลับไปภายใน 1-3 วันทำการ</p>
                    <div class="hb-audit-contact-strip">
                        <a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click">LINE OA</a>
                        <a href="tel:+66625169868" data-track-event="phone_click">062-516-9868</a>
                        <a href="mailto:business@hashbox.co.th" data-track-event="email_click">business@hashbox.co.th</a>
                    </div>
                </div>

                <form class="hb-audit-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-audit-form data-reveal>
                    <input type="hidden" name="action" value="hashbox_contact">
                    <input type="hidden" name="form_context" value="audit_landing">
                    <input type="hidden" name="landing_slug" value="<?php echo esc_attr( $landing['slug'] ); ?>">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url( $current_url ); ?>#audit-form">
                    <?php foreach ( $utm_keys as $utm_key ) : ?>
                        <input type="hidden" name="<?php echo esc_attr( $utm_key ); ?>" data-utm-field="<?php echo esc_attr( $utm_key ); ?>" value="">
                    <?php endforeach; ?>
                    <?php wp_nonce_field( 'hashbox_contact', 'hashbox_nonce' ); ?>

                    <?php if ( 'sent' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--success">ส่งคำขอสำเร็จ ทีม Hashbox จะติดต่อกลับภายใน 1-3 วันทำการ</div>
                    <?php elseif ( 'invalid' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--error">กรุณากรอกข้อมูลที่จำเป็นให้ครบ และยินยอม PDPA ก่อนส่งฟอร์ม</div>
                    <?php elseif ( 'error' === $contact_status ) : ?>
                        <div class="hb-audit-alert hb-audit-alert--error">ส่งฟอร์มไม่สำเร็จ กรุณาลองใหม่หรือทัก LINE OA</div>
                    <?php endif; ?>

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

                    <label class="hb-checkbox-wrap">
                        <input type="checkbox" class="hb-checkbox" name="pdpa" required>
                        <span class="hb-checkbox-wrap__label">ยินยอมให้ Hashbox เก็บข้อมูลเพื่อติดต่อกลับตาม <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">นโยบาย PDPA</a></span>
                    </label>

                    <button class="hb-btn hb-btn--gradient hb-btn--lg hb-audit-form__submit" type="submit"><?php echo esc_html( $landing['primary_cta'] ); ?> <span aria-hidden="true">→</span></button>
                </form>
            </div>
        </div>
    </section>

    <section class="hb-audit-section">
        <div class="hb-container hb-container--md">
            <div class="hb-audit-section__head hb-audit-section__head--center" data-reveal>
                <span class="hb-eyebrow">FAQ</span>
                <h2 class="hb-h2">คำถามที่พบบ่อย</h2>
            </div>
            <div class="hb-audit-faq">
                <?php foreach ( $landing['faqs'] as $faq ) : ?>
                    <details class="hb-audit-faq__item" data-reveal>
                        <summary><?php echo esc_html( $faq['q'] ); ?></summary>
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="hb-audit-mobile-cta">
        <a class="hb-btn hb-btn--gradient" href="#audit-form"><?php echo esc_html( $landing['primary_cta'] ); ?></a>
    </div>
</article>

<?php
get_footer();
