<?php
/** Compact English form, routed through the existing contact handler. */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$seo_result = hashbox_en_seo_contact_result();
$seo_status = $seo_result['status'];
$seo_messages = array(
    'sent' => 'Thank you — your SEO audit request has been sent to our team. We will follow up by email.',
    'invalid' => 'Please check your name, email, website and privacy consent, then try again.',
    'error' => 'We could not send your request. Your details are kept in this tab so you can try again, or email business@hashbox.co.th.',
    'unconfirmed' => 'Your request was processed, but we could not load its confirmation. Please email business@hashbox.co.th before submitting again.',
    'expired' => 'This confirmation link has expired. If you already sent your request, please contact business@hashbox.co.th before submitting again.',
);
?>
<section class="en-seo-contact" id="seo-contact" aria-labelledby="en-seo-contact-title">
    <div class="hb-container en-seo-contact__layout">
        <div class="en-seo-contact__intro">
            <span class="en-seo-eyebrow">Start with your website</span>
            <h2 id="en-seo-contact-title">Get a free technical SEO audit</h2>
            <p>Share your website and the result you want to improve. We will review the technical foundation before recommending a scope.</p>
            <p class="en-seo-contact__hint">For your existing website · English communication · No obligation</p>
            <div class="en-seo-contact__aside">
                <p>Prefer to talk first?</p>
                <a href="mailto:business@hashbox.co.th" data-track-event="email_click">business@hashbox.co.th</a>
                <a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click">Talk to Hashbox on LINE <span aria-hidden="true">↗</span></a>
            </div>
        </div>
        <form id="en-seo-contact-form" class="en-seo-contact__form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" data-en-seo-contact data-status="<?php echo esc_attr( $seo_status ); ?>" data-nonce-url="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"<?php if ( 'sent' === $seo_status && ! empty( $seo_result['receipt'] ) ) : ?> data-confirmed-receipt="<?php echo esc_attr( $seo_result['receipt'] ); ?>"<?php endif; ?>>
            <input type="hidden" name="action" value="hashbox_contact">
            <input type="hidden" name="contact_context" value="en-seo">
            <input type="hidden" name="service" value="seo">
            <input type="hidden" name="project_type" value="Technical SEO audit (English)">
            <input type="hidden" name="contact_preference" value="email">
            <input type="hidden" name="redirect_to" value="<?php echo esc_url( hashbox_en_seo_contact_url() ); ?>">
            <?php wp_nonce_field( 'hashbox_contact', 'hashbox_nonce' ); ?>
            <div class="en-seo-contact__status" id="en-seo-contact-status" role="status" aria-live="polite" tabindex="-1"<?php echo '' === $seo_status ? ' hidden' : ''; ?>><?php echo esc_html( $seo_messages[ $seo_status ] ?? '' ); ?></div>
            <p class="en-seo-contact__hint">Fields marked * are required.</p>
            <div class="en-seo-contact__row">
                <div class="en-seo-contact__field">
                    <label class="en-seo-contact__label" for="en-seo-name">Name <span aria-hidden="true">*</span></label>
                    <input id="en-seo-name" name="name" type="text" autocomplete="name" maxlength="100" required aria-describedby="en-seo-name-error">
                    <small class="en-seo-contact__error" id="en-seo-name-error" aria-live="polite"></small>
                </div>
                <div class="en-seo-contact__field">
                    <label class="en-seo-contact__label" for="en-seo-email">Email <span aria-hidden="true">*</span></label>
                    <input id="en-seo-email" name="email" type="email" autocomplete="email" maxlength="254" required placeholder="you@company.com" aria-describedby="en-seo-email-error">
                    <small class="en-seo-contact__error" id="en-seo-email-error" aria-live="polite"></small>
                </div>
            </div>
            <div class="en-seo-contact__field">
                <label class="en-seo-contact__label" for="en-seo-website">Website to audit <span aria-hidden="true">*</span></label>
                <input id="en-seo-website" name="website" type="text" inputmode="url" autocomplete="url" autocapitalize="off" spellcheck="false" maxlength="2048" placeholder="example.com" required aria-describedby="en-seo-website-hint en-seo-website-error">
                <small class="en-seo-contact__hint" id="en-seo-website-hint">Your public website, rather than a Facebook Page.</small>
                <small class="en-seo-contact__error" id="en-seo-website-error" aria-live="polite"></small>
            </div>
            <div class="en-seo-contact__field">
                <label class="en-seo-contact__label" for="en-seo-message">What would you like to improve? <span class="en-seo-contact__optional">(optional)</span></label>
                <textarea id="en-seo-message" name="message" rows="3" maxlength="2000" placeholder="For example: more qualified enquiries, a traffic drop, or reaching customers in Bangkok."></textarea>
            </div>
            <div hidden aria-hidden="true"><label for="en-seo-fax">Leave this empty</label><input id="en-seo-fax" name="company_fax" type="text" tabindex="-1" autocomplete="off"></div>
            <label class="en-seo-contact__consent" for="en-seo-pdpa">
                <input id="en-seo-pdpa" name="pdpa" type="checkbox" value="1" required aria-describedby="en-seo-pdpa-error">
                <span>I agree to Hashbox using my details to respond to this request, as described in the <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" target="_blank" rel="noopener">Privacy Policy</a>. <span aria-hidden="true">*</span></span>
            </label>
            <small class="en-seo-contact__error" id="en-seo-pdpa-error" aria-live="polite"></small>
            <button class="en-seo-contact__submit" type="submit" data-en-seo-submit><span>Request SEO audit</span><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
        </form>
    </div>
</section>
