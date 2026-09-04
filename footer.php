<?php $hb_en = function_exists( 'hashbox_page_is_english' ) && hashbox_page_is_english(); ?>
    </main>

    <?php
    $hashbox_footer_landing   = function_exists( 'hashbox_get_audit_landing_for_path' ) ? hashbox_get_audit_landing_for_path() : null;
    $hashbox_is_ai_audit      = is_array( $hashbox_footer_landing ) && 'ai-workflow-audit' === $hashbox_footer_landing['slug'];
    $hashbox_is_website_audit = is_page( 'website-audit' );
    ?>

    <?php if ( $hashbox_is_website_audit ) : ?>
        <footer class="hb-footer hb5-site-footer" style="margin-top: 0; padding-block: var(--hb-space-6);">
            <div class="hb-container">
                <div class="hb-footer__bottom" style="margin-top: 0; padding-top: 0; border-top: 0;">
                    <span class="hb-footer__brand-mark">
                        <span class="hb-nav__brand-mark">H</span>
                        HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span>
                    </span>
                    <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Hashbox Studio</span>
                    <nav class="hb-footer__legal hb5-footer-contact" aria-label="ช่องทางติดต่อและข้อมูลส่วนบุคคล">
                        <a class="hb5-footer-contact__link" href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click" aria-label="ติดต่อ Hashbox ทาง LINE">
                            <svg class="hb5-footer-contact__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.8 9.8 0 0 1-3.8-.8L3 21l1.7-4.6A8.2 8.2 0 0 1 3 11.5 8.4 8.4 0 0 1 12 3a8.4 8.4 0 0 1 9 8.5Z" />
                                <path d="M8 12h.01M12 12h.01M16 12h.01" />
                            </svg>
                            <span>LINE <small>@hashboxstudio</small></span>
                        </a>
                        <a class="hb5-footer-contact__link" href="mailto:business@hashbox.co.th" data-track-event="email_click" aria-label="ส่งอีเมลถึง business@hashbox.co.th">
                            <svg class="hb5-footer-contact__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path d="m3 7 9 6 9-6" />
                            </svg>
                            <span>อีเมล <small>business@hashbox.co.th</small></span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy / PDPA</a>
                    </nav>
                </div>
            </div>
        </footer>
    <?php elseif ( $hashbox_is_ai_audit ) : ?>
        <footer class="hb-ai-footer">
            <div class="hb-container">
                <p class="hb-ai-footer__statement">เริ่มจากโจทย์ที่ชัด ก่อนลงทุนทำ AI</p>
                <div class="hb-ai-footer__meta">
                    <a class="hb-ai-footer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">HASHBOX.STUDIO</a>
                    <nav class="hb-ai-footer__links" aria-label="ช่องทางติดต่อและข้อมูลส่วนบุคคล">
                        <a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer" data-track-event="line_click">LINE OA</a>
                        <a href="mailto:business@hashbox.co.th" data-track-event="email_click">business@hashbox.co.th</a>
                        <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy / PDPA</a>
                    </nav>
                    <span>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Hashbox Studio</span>
                </div>
            </div>
        </footer>
    <?php else : ?>
        <footer class="hb-footer">
        <div class="hb-container">
            <div class="hb-footer__grid">
                <div class="hb-footer__brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hb-footer__brand-mark">
                        <span class="hb-nav__brand-mark">H</span>
                        HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span>
                    </a>
                    <p class="hb-footer__desc">
                        <?php echo $hb_en
                            ? 'One studio for SEO-ready websites, SEO / AI Search and AI consulting — we ship sites that pass Lighthouse 100 and AI systems that run in production.'
                            : 'สตูดิโอที่รวม รับทำเว็บไซต์ SEO-Ready, รับทำ SEO / AI Search และที่ปรึกษา AI ไว้ในทีมเดียว ส่งมอบเว็บที่ผ่าน Lighthouse 100 และระบบ AI ที่ใช้งานจริงใน production'; ?>
                    </p>
                    <div class="hb-footer__socials">
                        <a href="https://www.linkedin.com/in/tumthaweewat/" class="hb-footer__social" aria-label="LinkedIn LI" target="_blank" rel="me noopener noreferrer">LI</a>
                        <a href="https://www.facebook.com/profile.php?id=61590390615650" class="hb-footer__social" aria-label="Facebook FB" target="_blank" rel="me noopener noreferrer">FB</a>
                        <a href="https://www.instagram.com/hashbox.studio/" class="hb-footer__social" aria-label="Instagram IG" target="_blank" rel="me noopener noreferrer">IG</a>
                        <a href="https://lin.ee/Xagx6i4" class="hb-footer__social" aria-label="LINE @hashboxstudio" target="_blank" rel="me noopener noreferrer">LINE</a>
                    </div>
                </div>

                <div class="hb-footer__col">
                    <h3><?php echo $hb_en ? 'Services' : 'บริการ'; ?></h3>
                    <ul>
                        <?php foreach ( hashbox_service_catalog_live() as $svc ) : ?>
                        <li><a href="<?php echo esc_url( hashbox_service_url( $svc ) ); ?>"><?php echo esc_html( $hb_en && ! empty( $svc['en_name'] ) ? $svc['en_name'] : $svc['name'] ); ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="<?php echo esc_url( home_url( '/seo-audit/' ) ); ?>"><?php echo $hb_en ? 'Free SEO Audit' : 'SEO Audit ฟรี'; ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php echo $hb_en ? 'All services' : 'บริการทั้งหมด'; ?></a></li>
                    </ul>
                </div>

                <div class="hb-footer__col">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Case Studies</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a></li>
                    </ul>
                </div>

                <div class="hb-footer__col">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="mailto:business@hashbox.co.th">business@hashbox.co.th</a></li>
                        <li><a href="tel:+66625169868">Hotline: 062-516-9868</a></li>
                        <li><a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer">LINE: @hashboxstudio</a></li>
                        <li style="color: var(--hb-text-faint); font-size: var(--hb-text-sm);"><?php echo $hb_en ? 'Mon–Fri 9:00–18:00' : 'จันทร์-ศุกร์ 9:00-18:00'; ?></li>
                        <li style="color: var(--hb-text-faint); font-size: var(--hb-text-sm);">139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500</li>
                    </ul>
                </div>
            </div>

            <div class="hb-footer__bottom">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Hashbox Studio. All rights reserved.</p>
                <div class="hb-footer__legal">
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/#terms' ) ); ?>">Terms</a>
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/#pdpa' ) ); ?>">PDPA</a>
                </div>
            </div>
        </div>
        </footer>
    <?php endif; ?>

    <div class="hb-toast-stack"></div>

    <?php wp_footer(); ?>
</body>
</html>
