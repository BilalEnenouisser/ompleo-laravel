// OMPLEO Hero Section - Framer-Inspired Animations
// Enhanced animations matching JobHub.framer.website style

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎬 Enhanced animations initializing...');

    // ========================================
    // 1. HERO CHARACTER STAGGER ANIMATION
    // ========================================
    function initHeroCharacterAnimation() {
        const chars = document.querySelectorAll('.hero-char');
        
        if (chars.length > 0) {
            // Get the hero section
            const heroSection = document.querySelector('.hero-section');
            
            // Create intersection observer for hero timing
            const heroObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Animate characters with individual stagger
                        chars.forEach((char, index) => {
                            const delay = index * 0.04; // 40ms stagger between characters
                            char.style.setProperty('--animation-delay', delay + 's');
                            char.classList.add('hero-char-animated');
                        });
                        
                        heroObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            if (heroSection) {
                heroObserver.observe(heroSection);
            }
        }
    }

    // ========================================
    // 2. HERO IMAGE PARALLAX EFFECT
    // ========================================
    function initHeroParallax() {
        const heroImage = document.querySelector('[data-parallax="hero-image"]') || 
                         document.querySelector('section#home img[src*="hero"]');
        
        if (heroImage) {
            // Use requestAnimationFrame for smooth parallax
            let ticking = false;
            
            window.addEventListener('scroll', () => {
                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        const scrolled = window.pageYOffset;
                        const parallaxSpeed = 0.5; // Slower than scroll
                        
                        heroImage.style.transform = `translateY(${scrolled * parallaxSpeed}px)`;
                        ticking = false;
                    });
                    ticking = true;
                }
            });
        }
    }

    // ========================================
    // 3. HERO BADGE FLOAT ANIMATION
    // ========================================
    function initBadgeFloat() {
        const badge = document.querySelector('.hero-badge-container');
        
        if (badge) {
            badge.classList.add('badge-float');
        }
    }

    // ========================================
    // 4. BUTTON GLOW EFFECT ON HOVER
    // ========================================
    function initButtonGlowEffect() {
        const buttons = document.querySelectorAll('.hero-buttons a');
        
        buttons.forEach(button => {
            // Add glow container if not exists
            if (!button.querySelector('.button-glow')) {
                const glowElement = document.createElement('div');
                glowElement.className = 'button-glow';
                button.appendChild(glowElement);
            }
            
            button.addEventListener('mouseenter', function() {
                this.classList.add('button-glow-active');
            });
            
            button.addEventListener('mouseleave', function() {
                this.classList.remove('button-glow-active');
            });
        });
    }

    // ========================================
    // 5. MARQUEE SPEED VARIATION (Improved)
    // ========================================
    function initMarqueeAnimation() {
        const marquee = document.querySelector('.hero-marquee');
        
        if (marquee) {
            // Add data attribute for smooth continuous animation
            marquee.classList.add('marquee-smooth');
            
            // Optional: Add speed variation on scroll
            let scrollProgress = 0;
            
            window.addEventListener('scroll', () => {
                const scrollTop = window.pageYOffset;
                const heroSection = document.querySelector('section#home');
                
                if (heroSection) {
                    const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;
                    const progress = Math.min(scrollTop / (heroBottom - window.innerHeight), 1);
                    
                    // Adjust marquee speed based on scroll
                    if (progress < 0.3) {
                        marquee.style.animationPlayState = 'running';
                    }
                }
            });
        }
    }

    // ========================================
    // 6. STAGGER ANIMATION FOR SECTIONS
    // ========================================
    function initScrollStaggerAnimations() {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -100px 0px'
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    
                    // Handle stagger animations
                    const staggerDelay = parseFloat(entry.target.dataset.staggerDelay) || 0.1;
                    const staggerSelector = entry.target.dataset.staggerSelector || '.animate-stagger-item';
                    
                    const staggerItems = entry.target.querySelectorAll(staggerSelector);
                    if (staggerItems.length > 0) {
                        staggerItems.forEach((item, index) => {
                            setTimeout(() => {
                                item.classList.add('animated');
                            }, index * staggerDelay * 1000);
                        });
                    }
                    
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });
    }

    // ========================================
    // 7. CARD ANIMATIONS WITH IMPROVED EASING
    // ========================================
    function initCardAnimations() {
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('card-animated');
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        // Observe all card types
        [
            '.job-card-link', '.job-card-inner',
            '.companies-grid > div',
            '.categories-section a',
            '.faq-item'
        ].forEach(selector => {
            document.querySelectorAll(selector).forEach(el => {
                cardObserver.observe(el);
            });
        });
    }

    // ========================================
    // 8. ENHANCED HOVER LIFT EFFECT
    // ========================================
    function initEnhancedHoverEffects() {
        document.querySelectorAll('.hover-lift').forEach(element => {
            element.addEventListener('mouseenter', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                this.style.transform = 'translateY(-8px) perspective(600px) rotateX(2deg) rotateY(2deg)';
                this.style.boxShadow = '0 20px 40px rgba(0, 182, 180, 0.2), 0 0 20px rgba(0, 182, 180, 0.1)';
                this.style.transition = 'all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            });
            
            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) perspective(600px) rotateX(0) rotateY(0)';
                this.style.boxShadow = '';
            });
        });
    }

    // ========================================
    // 9. SMOOTH COUNTER ANIMATION
    // ========================================
    function initCounterAnimation() {
        function animateCounter(element) {
            const endValue = parseInt(element.dataset.end) || 0;
            const duration = parseInt(element.dataset.duration) || 2000;
            const suffix = element.dataset.suffix || '';
            const prefix = element.dataset.prefix || '';
            
            let startTime = null;
            const startValue = 0;
            
            function animateCounterStep(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                
                // Smooth easing (easeOutQuart)
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const currentValue = Math.floor(easeOutQuart * endValue);
                
                element.textContent = prefix + currentValue.toLocaleString() + suffix;
                
                if (progress < 1) {
                    requestAnimationFrame(animateCounterStep);
                }
            }
            
            requestAnimationFrame(animateCounterStep);
        }

        document.querySelectorAll('.counter-element').forEach(el => {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            counterObserver.observe(el);
        });
    }

    // ========================================
    // INITIALIZE ALL ANIMATIONS
    // ========================================
    
    // Run all animation initializers
    initHeroCharacterAnimation();
    initHeroParallax();
    initBadgeFloat();
    initButtonGlowEffect();
    initMarqueeAnimation();
    initScrollStaggerAnimations();
    initCardAnimations();
    initEnhancedHoverEffects();
    initCounterAnimation();

    console.log('✨ All animations initialized successfully!');
});

// ========================================
// RESPONSIVE ANIMATION ADJUSTMENTS
// ========================================

// Disable heavy animations on mobile for better performance
function adjustAnimationsForDevice() {
    const isMobile = window.innerWidth < 768;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    if (isMobile) {
        document.documentElement.style.setProperty('--parallax-speed', '0.2');
        console.log('📱 Mobile animations adjusted for performance');
    }
    
    if (prefersReducedMotion) {
        document.documentElement.style.setProperty('--animation-duration', '0s');
        console.log('♿ Reduced motion applied');
    }
}

window.addEventListener('load', adjustAnimationsForDevice);
window.addEventListener('resize', adjustAnimationsForDevice);

// ========================================
// PERFORMANCE MONITORING (optional)
// ========================================

function monitorAnimationPerformance() {
    // Log animation frame rate
    let lastTime = performance.now();
    let frameCount = 0;
    
    function checkFPS() {
        const currentTime = performance.now();
        frameCount++;
        
        if (currentTime - lastTime >= 1000) {
            console.log(`📊 FPS: ${frameCount}`);
            frameCount = 0;
            lastTime = currentTime;
        }
        
        requestAnimationFrame(checkFPS);
    }
    
    // Uncomment to enable FPS monitoring
    // checkFPS();
}
