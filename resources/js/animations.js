// OMPLEO Smooth Scroll Animations
document.addEventListener('DOMContentLoaded', function() {
    
    // Enhanced Intersection Observer for smooth scroll animations
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -100px 0px'
    };

    // Main scroll animation observer for .animate-on-scroll elements
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animated class to trigger CSS animation
                entry.target.classList.add('animated');
                
                // Handle stagger animations for child elements
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
                
                // Once animated, stop observing
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        scrollObserver.observe(el);
    });

    // Special handling for job cards, company cards, and category cards
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('card-animated');
                cardObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    // Observe job cards
    document.querySelectorAll('.job-card-link, .job-card-inner').forEach(el => {
        cardObserver.observe(el);
    });

    // Observe company cards
    document.querySelectorAll('.companies-grid > div').forEach(el => {
        cardObserver.observe(el);
    });

    // Observe category cards
    document.querySelectorAll('.categories-section a').forEach(el => {
        cardObserver.observe(el);
    });

    // Observe FAQ items
    document.querySelectorAll('.faq-item').forEach(el => {
        cardObserver.observe(el);
    });

    // Counter Animation (similar to React AnimatedCounter)
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
            
            // Easing function for smooth animation (easeOutQuart)
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const currentValue = Math.floor(easeOutQuart * endValue);
            
            element.textContent = prefix + currentValue.toLocaleString() + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(animateCounterStep);
            }
        }
        
        requestAnimationFrame(animateCounterStep);
    }

    // Trigger counter animation if element has counter
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

    // Hover animations for cards and buttons
    document.querySelectorAll('.hover-lift').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 30px rgba(0, 182, 180, 0.1), 0 0 10px rgba(0, 182, 180, 0.1)';
        });
        
        element.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    // Scale animations for buttons
    document.querySelectorAll('.scale-on-hover').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
        
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.95)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = 'scale(1.05)';
        });
    });
});

// Enhanced CSS Animation Styles
const animationStyles = `
    /* Base animation styles for scroll-triggered elements */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: opacity, transform;
    }
    
    .animate-on-scroll.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Stagger animation for child elements */
    .animate-stagger-item {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .animate-stagger-item.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Card animations */
    .job-card-link,
    .job-card-inner,
    .companies-grid > div,
    .categories-section a,
    .faq-item {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
        transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .job-card-link.card-animated,
    .job-card-inner.card-animated,
    .companies-grid > div.card-animated,
    .categories-section a.card-animated,
    .faq-item.card-animated {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
    
    /* Stagger delay for job cards */
    .jobs-section .job-card-link:nth-child(1) {
        transition-delay: 0.1s;
    }
    
    .jobs-section .job-card-link:nth-child(2) {
        transition-delay: 0.2s;
    }
    
    .jobs-section .job-card-link:nth-child(3) {
        transition-delay: 0.3s;
    }
    
    /* Stagger delay for company cards */
    .companies-grid > div:nth-child(1) { transition-delay: 0.05s; }
    .companies-grid > div:nth-child(2) { transition-delay: 0.1s; }
    .companies-grid > div:nth-child(3) { transition-delay: 0.15s; }
    .companies-grid > div:nth-child(4) { transition-delay: 0.2s; }
    .companies-grid > div:nth-child(5) { transition-delay: 0.25s; }
    .companies-grid > div:nth-child(6) { transition-delay: 0.3s; }
    
    /* Stagger delay for category cards */
    .categories-section a:nth-child(1) { transition-delay: 0.05s; }
    .categories-section a:nth-child(2) { transition-delay: 0.1s; }
    .categories-section a:nth-child(3) { transition-delay: 0.15s; }
    .categories-section a:nth-child(4) { transition-delay: 0.2s; }
    .categories-section a:nth-child(5) { transition-delay: 0.25s; }
    .categories-section a:nth-child(6) { transition-delay: 0.3s; }
    .categories-section a:nth-child(7) { transition-delay: 0.35s; }
    .categories-section a:nth-child(8) { transition-delay: 0.4s; }
    
    /* Stagger delay for FAQ items */
    .faq-item:nth-child(1) { transition-delay: 0.1s; }
    .faq-item:nth-child(2) { transition-delay: 0.2s; }
    .faq-item:nth-child(3) { transition-delay: 0.3s; }
    .faq-item:nth-child(4) { transition-delay: 0.4s; }
    
    /* Hover lift effect */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    /* Scale on hover */
    .scale-on-hover {
        transition: transform 0.2s ease;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
    
    /* Performance optimizations */
    .animate-on-scroll,
    .animate-stagger-item,
    .job-card-link,
    .job-card-inner,
    .companies-grid > div,
    .categories-section a,
    .faq-item {
        backface-visibility: hidden;
        perspective: 1000px;
    }
    
    /* Reduce motion for users who prefer it */
    @media (prefers-reduced-motion: reduce) {
        .animate-on-scroll,
        .animate-stagger-item,
        .job-card-link,
        .job-card-inner,
        .companies-grid > div,
        .categories-section a,
        .faq-item {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }
    }
`;

// Inject animation styles
const styleSheet = document.createElement('style');
styleSheet.textContent = animationStyles;
document.head.appendChild(styleSheet);
