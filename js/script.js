// HASHBOX STUDIO — Script.js
// All interactions: nav scroll, mobile menu, scroll reveal,
// service card → contact, counter animation, form submit, orb parallax

document.addEventListener('DOMContentLoaded', () => {

    // =============================================
    // 1. NAVIGATION — Sticky blur on scroll
    // =============================================
    const header = document.getElementById('siteHeader');
    const handleScroll = () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    // =============================================
    // 2. ACTIVE NAV LINK on scroll
    // =============================================
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id]');

    const updateActiveNav = () => {
        const scrollY = window.scrollY + 120;
        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');
            if (scrollY >= top && scrollY < top + height) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    };
    window.addEventListener('scroll', updateActiveNav, { passive: true });

    // =============================================
    // 3. MOBILE MENU TOGGLE
    // =============================================
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    if (hamburger && mobileMenu) {
        const setOpen = (isOpen) => {
            hamburger.classList.toggle('active', isOpen);
            hamburger.setAttribute('aria-expanded', String(isOpen));
            mobileMenu.classList.toggle('open', isOpen);
            document.body.classList.toggle('no-scroll', isOpen);
        };

        hamburger.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('open');
            setOpen(isOpen);
        });

        // Close mobile menu on link click
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                setOpen(false);
            });
        });

        // Close on Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('open')) {
                setOpen(false);
            }
        });
    }

    // =============================================
    // 4. SCROLL REVEAL — IntersectionObserver
    // =============================================
    const revealElements = document.querySelectorAll(
        '.service-card, .stat-block, .timeline-step, .work-card, ' +
        '.about-bento-card, .pricing-card, .section-header, .why-left, ' +
        '.why-right, .about-header, .contact-left, ' +
        '.contact-right, .retainer-note'
    );

    revealElements.forEach(el => el.classList.add('reveal'));

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Stagger sibling elements
                const parent = entry.target.parentElement;
                const siblings = parent ? Array.from(parent.children).filter(c => c.classList.contains('reveal')) : [];
                const siblingIndex = siblings.indexOf(entry.target);
                const delay = siblingIndex >= 0 ? siblingIndex * 80 : 0;

                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, delay);

                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

    // =============================================
    // 5. COUNTER ANIMATION
    // =============================================
    const counterElements = document.querySelectorAll('[data-target]');

    const animateCounter = (el) => {
        const target = parseInt(el.getAttribute('data-target'), 10);
        const duration = 1800;
        const startTime = performance.now();

        const easeOutQuart = (t) => 1 - Math.pow(1 - t, 4);

        const update = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            const current = Math.round(easedProgress * target);
            el.textContent = current;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        };

        requestAnimationFrame(update);
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counterElements.forEach(el => counterObserver.observe(el));

    // =============================================
    // 6. SERVICE CARD CLICK → Scroll to contact + set dropdown
    // =============================================
    const serviceCards = document.querySelectorAll('.service-card');
    const serviceDropdown = document.getElementById('service');
    const contactSection = document.getElementById('contact');

    serviceCards.forEach(card => {
        card.addEventListener('click', () => {
            const serviceValue = card.getAttribute('data-service');

            if (serviceDropdown && serviceValue) {
                // service-card data-service slugs match dropdown option values 1:1
                // (seo-website, marketing-cro, ai-consulting).
                const allowed = new Set(['seo-website', 'marketing-cro', 'ai-consulting']);
                serviceDropdown.value = allowed.has(serviceValue) ? serviceValue : '';
            }

            // Smooth scroll to contact
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Pricing card CTA → set dropdown value
    const pricingBtns = document.querySelectorAll('.pricing-btn[data-service-value]');
    pricingBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const serviceValue = btn.getAttribute('data-service-value');
            if (serviceDropdown && serviceValue) {
                serviceDropdown.value = serviceValue;
            }
        });
    });

    // =============================================
    // 7. FORM SUBMIT — Success state
    // =============================================
    const contactForm = document.getElementById('contactForm');
    const submitBtn = contactForm ? contactForm.querySelector('.btn-submit') : null;

    if (contactForm && submitBtn) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Show success state
            submitBtn.textContent = 'Message Sent!';
            submitBtn.classList.add('success');
            submitBtn.disabled = true;

            // Reset after 4 seconds
            setTimeout(() => {
                contactForm.reset();
                submitBtn.textContent = 'Send Message →';
                submitBtn.classList.remove('success');
                submitBtn.disabled = false;
            }, 4000);
        });
    }

    // =============================================
    // 8. ORB PARALLAX on scroll
    // =============================================
    const orbBlue = document.querySelector('.hero-orb-blue');
    const orbCyan = document.querySelector('.hero-orb-cyan');

    if (orbBlue && orbCyan) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const maxScroll = window.innerHeight;

            if (scrollY < maxScroll) {
                const factor = scrollY / maxScroll;
                orbBlue.style.transform = `translateY(${factor * 60}px)`;
                orbCyan.style.transform = `translateY(${factor * -40}px) translateX(${factor * 20}px)`;
            }
        }, { passive: true });
    }

    // =============================================
    // 9. FAQ ACCORDION
    // =============================================
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const isOpen = question.getAttribute('aria-expanded') === 'true';
            
            // Close all other FAQ items
            faqQuestions.forEach(otherQuestion => {
                if (otherQuestion !== question) {
                    otherQuestion.setAttribute('aria-expanded', 'false');
                    otherQuestion.nextElementSibling.classList.remove('open');
                }
            });
            
            // Toggle current FAQ item
            question.setAttribute('aria-expanded', !isOpen);
            if (!isOpen) {
                answer.classList.add('open');
            } else {
                answer.classList.remove('open');
            }
        });
    });

    // =============================================
    // 10. SMOOTH SCROLL for all anchor links
    // =============================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');
            if (href === '#') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

});
