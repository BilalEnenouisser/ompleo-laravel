// OMPLEO Animations - React to Laravel Animation Migration
document.addEventListener('DOMContentLoaded', function() {
    
    // Intersection Observer for scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                
                // Trigger counter animation if element has counter
                if (entry.target.classList.contains('counter-element')) {
                    animateCounter(entry.target);
                }
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
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

    // Stagger animation for lists
    function staggerAnimation(container, selector, delay = 0.1) {
        const elements = container.querySelectorAll(selector);
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * delay}s`;
            element.classList.add('animate-stagger-fade-in');
        });
    }

    // Apply stagger animations
    document.querySelectorAll('.stagger-container').forEach(container => {
        staggerAnimation(container, '.stagger-item');
    });

    // Liquid shape animations
    document.querySelectorAll('.liquid-shape').forEach(shape => {
        shape.style.animation = 'liquidMorph 8s ease-in-out infinite';
    });

    // Pulse glow animations
    document.querySelectorAll('.pulse-glow').forEach(element => {
        element.style.animation = 'pulseGlow 2s ease-in-out infinite';
    });

    // Shimmer effect for loading states
    function addShimmerEffect(element) {
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        
        const shimmer = document.createElement('div');
        shimmer.style.position = 'absolute';
        shimmer.style.top = '0';
        shimmer.style.left = '-100%';
        shimmer.style.width = '100%';
        shimmer.style.height = '100%';
        shimmer.style.background = 'linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent)';
        shimmer.style.animation = 'shimmer 2s infinite';
        
        element.appendChild(shimmer);
    }

    // Add shimmer to loading elements
    document.querySelectorAll('.shimmer-loading').forEach(addShimmerEffect);

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

    // Fade in animations for sections
    function fadeInOnScroll() {
        const sections = document.querySelectorAll('.fade-in-section');
        
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (isVisible) {
                section.classList.add('animate-fade-in-up');
            }
        });
    }

    // Throttled scroll handler
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(fadeInOnScroll, 10);
    });

    // Initial check
    fadeInOnScroll();
});

// CSS Animation Classes (to be added to CSS)
const animationStyles = `
    .animate-fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .animate-fade-in.animate-fade-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .scale-on-hover {
        transition: transform 0.2s ease;
    }
    
    .shimmer-loading {
        position: relative;
        overflow: hidden;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
`;

// Inject animation styles
const styleSheet = document.createElement('style');
styleSheet.textContent = animationStyles;
document.head.appendChild(styleSheet);
