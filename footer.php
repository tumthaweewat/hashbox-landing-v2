    </main>

    <footer class="hb-footer">
        <div class="hb-container">
            <div class="hb-footer__grid">
                <div class="hb-footer__brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hb-footer__brand-mark">
                        <span class="hb-nav__brand-mark">H</span>
                        HASHBOX<span class="hb-nav__brand-accent">.STUDIO</span>
                    </a>
                    <p class="hb-footer__desc">
                        เอเจนซีที่รวม Web Development, Digital Marketing + CRO และ AI Consulting ไว้ในทีมเดียว ส่งมอบเว็บที่ผ่าน Lighthouse 100 และ AI Workforce ที่ใช้ได้จริง
                    </p>
                    <div class="hb-footer__socials">
                        <a href="https://www.linkedin.com/company/hashbox-studio" class="hb-footer__social" aria-label="LinkedIn LI" target="_blank" rel="noopener noreferrer">LI</a>
                        <a href="https://www.facebook.com/hashboxstudio" class="hb-footer__social" aria-label="Facebook FB" target="_blank" rel="noopener noreferrer">FB</a>
                        <a href="https://www.instagram.com/hashboxstudio" class="hb-footer__social" aria-label="Instagram IG" target="_blank" rel="noopener noreferrer">IG</a>
                        <a href="https://lin.ee/Xagx6i4" class="hb-footer__social" aria-label="LINE @hashboxstudio" target="_blank" rel="noopener noreferrer">LINE</a>
                    </div>
                </div>

                <div class="hb-footer__col">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/services/seo-ready-website/' ) ); ?>">SEO-Ready Website</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/digital-marketing-tools/' ) ); ?>">Marketing Tools + CRO</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/ai-consulting/' ) ); ?>">AI Expert Consulting</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">All Services</a></li>
                    </ul>
                </div>

                <div class="hb-footer__col">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>">Case Studies</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/#insights' ) ); ?>">Insights</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Contact</a></li>
                    </ul>
                </div>

                <div class="hb-footer__col">
                    <h3>Contact</h3>
                    <ul>
                        <li><a href="mailto:hello@hashbox.co.th">hello@hashbox.co.th</a></li>
                        <li><a href="tel:+6622666222">02 266 6222</a></li>
                        <li><a href="https://lin.ee/Xagx6i4" target="_blank" rel="noopener noreferrer">LINE: @hashboxstudio</a></li>
                        <li style="color: var(--hb-text-faint); font-size: var(--hb-text-sm);">จันทร์-ศุกร์ 9:00-18:00</li>
                        <li style="color: var(--hb-text-faint); font-size: var(--hb-text-sm);">139 Pan Rd, Si Lom, Bang Rak, Bangkok 10500</li>
                    </ul>
                </div>
            </div>

            <div class="hb-footer__bottom">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Hashbox Studio. All rights reserved.</p>
                <div class="hb-footer__legal">
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Terms</a>
                    <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">PDPA</a>
                </div>
            </div>
        </div>
    </footer>

    <div class="hb-toast-stack"></div>

    <?php wp_footer(); ?>
</body>
</html>
