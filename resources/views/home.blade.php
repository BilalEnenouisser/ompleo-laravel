@extends('layouts.app')

@section('title', 'OMPLEO - Plateforme de Recrutement')
@section('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="bg-gradient-to-b from-[#e0e3df] via-[#dadad2] to-[#dee0db] dark:bg-[#212221] dark:from-[#212221] dark:via-[#212221] dark:to-[#212221]">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden bg-[#212221] mb-16 hero-section">
        <!-- Background Image with Parallax & Blur Effect -->
        <div class="absolute top-0 right-0 bottom-0 hidden lg:block hero-image-container" style="overflow: hidden;">
            <img src="{{ asset('storage/home_page/hero.png') }}" 
                 alt="Hero" 
                 class="w-full h-full object-cover hero-parallax-image" 
                 data-parallax="hero-image"
                 style="object-position: right; will-change: transform; backface-visibility: hidden; transition: filter 0.3s ease, transform 0.02s linear;">
        </div>
        
        <!-- Blur Overlay for Smooth Transition -->
        <div class="absolute top-0 right-0 bottom-0 hidden lg:block pointer-events-none" style="background: linear-gradient(to left, rgba(33, 34, 33, 0.3), transparent);"></div>
        
        <!-- Content Overlay -->
        <div class="w-[90%] mx-auto relative z-10 hero-content-wrapper" style="padding-left: 20px; padding-right: 33%;">
            <style>
                /* Desktop is default - no media query needed */
                
                /* Tablet (768px - 1023px) */
                @media (max-width: 1023px) {
                    .hero-content-wrapper {
                        width: 95% !important;
                        padding-left: 20px !important;
                        padding-right: 20px !important;
                    }
                    .hero-content-overlay {
                        width: 100% !important;
                    }
                    .hero-headline {
                        font-size: 48px !important;
                    }
                    .hero-subheadline {
                        font-size: 24px !important;
                        margin-top: 1.5rem !important;
                        margin-bottom: 2rem !important;
                    }
                    .hero-badge-text {
                        font-size: 18px !important;
                    }
                }
                
                /* Mobile (max-width: 767px) */
                @media (max-width: 767px) {
                    section#home.hero-section {
                        min-height: auto !important;
                        padding-top: 3rem !important;
                        padding-bottom: 3rem !important;
                        margin-bottom: 2rem !important;
                        display: flex !important;
                        align-items: flex-start !important;
                    }
                    .hero-content-wrapper {
                        width: 100% !important;
                        padding-left: 1rem !important;
                        padding-right: 1rem !important;
                        margin: 0 auto !important;
                    }
                    .hero-content-overlay {
                        width: 100% !important;
                        max-width: 100% !important;
                    }
                    h1.hero-headline {
                        font-size: 28px !important;
                        margin-bottom: 1.5rem !important;
                        line-height: 1.3 !important;
                        letter-spacing: -0.5px !important;
                        word-wrap: break-word !important;
                        overflow-wrap: break-word !important;
                    }
                    h1.hero-headline span {
                        display: block !important;
                    }
                    h1.hero-headline .hero-headline-line-1,
                    h1.hero-headline .hero-headline-line-2 {
                        display: block !important;
                        width: 100% !important;
                    }
                    /* Fix for hero characters to display horizontally */
                    .hero-headline .hero-char,
                    .hero-subheadline .hero-char {
                        display: inline-block !important;
                        vertical-align: baseline !important;
                        line-height: inherit !important;
                    }
                    .hero-headline span[style*="white-space:nowrap"],
                    .hero-subheadline span[style*="white-space:nowrap"] {
                        white-space: normal !important;
                        display: inline !important;
                    }
                    p.hero-subheadline {
                        font-size: 16px !important;
                        margin-top: 1rem !important;
                        margin-bottom: 2rem !important;
                        line-height: 1.5 !important;
                        word-wrap: break-word !important;
                        overflow-wrap: break-word !important;
                    }
                    .hero-buttons {
                        flex-direction: column !important;
                        flex-wrap: wrap !important;
                        gap: 0.75rem !important;
                        width: 100% !important;
                        max-width: 100% !important;
                        margin-bottom: 2rem !important;
                    }
                    .hero-buttons a,
                    .hero-buttons > div {
                        flex: 1 1 auto !important;
                        min-width: 100% !important;
                        max-width: 100% !important;
                        width: 100% !important;
                    }
                    .hero-buttons a {
                        padding-left: 1.25rem !important;
                        padding-right: 1.25rem !important;
                        padding-top: 0.875rem !important;
                        padding-bottom: 0.875rem !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        text-align: center !important;
                        width: 100% !important;
                        max-width: 100% !important;
                        box-sizing: border-box !important;
                        border-radius: 9999px !important;
                    }
                    .hero-buttons a span {
                        font-size: 0.875rem !important;
                        line-height: 1.4 !important;
                        white-space: normal !important;
                        word-break: break-word !important;
                        display: block !important;
                        text-align: center !important;
                    }
                    .hero-buttons img {
                        flex-shrink: 0 !important;
                        width: 1rem !important;
                        height: 1rem !important;
                        margin-right: 0.5rem !important;
                    }
                    .hero-buttons > div {
                        width: 100% !important;
                        max-width: 100% !important;
                        box-sizing: border-box !important;
                    }
                    .hero-buttons > div a {
                        width: 100% !important;
                        max-width: 100% !important;
                        padding-left: 1.25rem !important;
                        padding-right: 1.25rem !important;
                        padding-top: 0.875rem !important;
                        padding-bottom: 0.875rem !important;
                    }
                    .hero-buttons > div a span {
                        font-size: 0.875rem !important;
                        line-height: 1.4 !important;
                        white-space: normal !important;
                        word-break: break-word !important;
                    }
                    span.hero-badge-text {
                        font-size: 14px !important;
                        line-height: 1.4 !important;
                    }
                    img.hero-brand-logo {
                        height: 1.25rem !important;
                    }
                    img.hero-badge-icon {
                        width: 1.125rem !important;
                        height: 1.125rem !important;
                    }
                    img.hero-button-icon {
                        width: 1rem !important;
                        height: 1rem !important;
                    }
                    .hero-badge-container {
                        margin-bottom: 1.5rem !important;
                        flex-wrap: wrap !important;
                    }
                    .hero-badge-container img {
                        flex-shrink: 0 !important;
                    }
                    /* Trust section mobile */
                    .hero-trust-section {
                        margin-top: 2rem !important;
                    }
                    .hero-trust-text {
                        font-size: 14px !important;
                        margin-bottom: 1rem !important;
                    }
                    .hero-marquee {
                        gap: 1.5rem !important;
                    }
                    .hero-marquee-container {
                        margin-top: 0.5rem !important;
                    }
                    /* Better spacing overall */
                    .hero-content-overlay > * {
                        margin-bottom: 1rem !important;
                    }
                    .hero-content-overlay > *:last-child {
                        margin-bottom: 0 !important;
                    }
                }
            </style>
            <style>
                /* Hero Text Animation */
                .hero-char {
                    opacity: 0;
                    transform: translateY(10px);
                    filter: blur(8px);
                    animation: heroCharFadeIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
                    display: inline-block !important;
                    vertical-align: baseline !important;
                    line-height: inherit !important;
                    will-change: transform, opacity, filter;
                }
                
                @keyframes heroCharFadeIn {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                        filter: blur(0);
                    }
                }

                /* Initially hide non-text elements for sequence */
                .hero-badge-container,
                .hero-buttons,
                .hero-trust-section {
                    opacity: 0;
                    transform: translateY(10px);
                    filter: blur(4px);
                    transition: opacity 0.8s ease, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1), filter 0.8s ease;
                    will-change: opacity, transform, filter;
                }

                .hero-reveal-active {
                    opacity: 1 !important;
                    transform: translateY(0) !important;
                    filter: blur(0) !important;
                }
                
                /* Ensure hero text displays horizontally */
                .hero-headline,
                .hero-subheadline {
                    display: block !important;
                    white-space: normal !important;
                }
                
                .hero-headline .hero-headline-line-1,
                .hero-headline .hero-headline-line-2 {
                    display: block !important;
                    white-space: normal !important;
                }
                
                /* Force all hero characters to display inline */
                .hero-headline span,
                .hero-subheadline span {
                    display: inline !important;
                    white-space: normal !important;
                }
                
                .hero-headline span[style*="white-space:nowrap"],
                .hero-subheadline span[style*="white-space:nowrap"] {
                    white-space: normal !important;
                    display: inline !important;
                }
                
                /* Mobile fixes for hero text */
                @media (max-width: 767px) {
                    .hero-char {
                        display: inline-block !important;
                        vertical-align: baseline !important;
                        line-height: 1.3 !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }
                    
                    .hero-headline,
                    .hero-subheadline {
                        display: block !important;
                        white-space: normal !important;
                    }
                    
                    .hero-headline .hero-headline-line-1,
                    .hero-headline .hero-headline-line-2 {
                        display: block !important;
                        white-space: normal !important;
                        line-height: 1.3 !important;
                    }
                    
                    .hero-headline span,
                    .hero-subheadline span {
                        display: inline !important;
                        white-space: normal !important;
                    }
                    
                    .hero-headline span[style*="white-space:nowrap"],
                    .hero-subheadline span[style*="white-space:nowrap"] {
                        white-space: normal !important;
                        display: inline !important;
                    }
                }
            </style>
            <div class="text-left hero-content-overlay">
                <!-- Icon + Text Badge with Float Animation -->
                <div class="flex items-center gap-3 mb-6 hero-badge-container badge-float" style="animation: badgeFloat 3s ease-in-out infinite;">
                    <img src="{{ asset('storage/home_page/heroico.svg') }}" alt="Icon" class="w-6 h-6 hero-badge-icon">
                    <span class="text-xl font-normal hero-badge-text" style="color: #2cbcba;">La plateforme d'offres d'emploi n°1</span>
                </div>

                <!-- Headline -->
                <h1 class="font-bold mb-6 leading-tight hero-headline" style="font-size: 83px; color: #ffffff;">
                    <span class="block hero-headline-line-1" style="color: #ffffff;">
                        <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">L</span><span class="hero-char" style="display: inline-block; will-change: transform;">à</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">o</span><span class="hero-char" style="display: inline-block; will-change: transform;">ù</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">l</span><span class="hero-char" style="display: inline-block; will-change: transform;">e</span><span class="hero-char" style="display: inline-block; will-change: transform;">s</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">o</span><span class="hero-char" style="display: inline-block; will-change: transform;">f</span><span class="hero-char" style="display: inline-block; will-change: transform;">f</span><span class="hero-char" style="display: inline-block; will-change: transform;">r</span><span class="hero-char" style="display: inline-block; will-change: transform;">e</span><span class="hero-char" style="display: inline-block; will-change: transform;">s</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">d</span><span class="hero-char" style="display: inline-block; will-change: transform;">'</span><span class="hero-char" style="display: inline-block; will-change: transform;">e</span><span class="hero-char" style="display: inline-block; will-change: transform;">m</span><span class="hero-char" style="display: inline-block; will-change: transform;">p</span><span class="hero-char" style="display: inline-block; will-change: transform;">l</span><span class="hero-char" style="display: inline-block; will-change: transform;">o</span><span class="hero-char" style="display: inline-block; will-change: transform;">i</span></span>
                    </span>
                    <span class="block hero-headline-line-2" style="color: #d9d9d9;">
                        <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">G</span><span class="hero-char" style="display: inline-block; will-change: transform;">a</span><span class="hero-char" style="display: inline-block; will-change: transform;">g</span><span class="hero-char" style="display: inline-block; will-change: transform;">n</span><span class="hero-char" style="display: inline-block; will-change: transform;">e</span><span class="hero-char" style="display: inline-block; will-change: transform;">n</span><span class="hero-char" style="display: inline-block; will-change: transform;">t</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">e</span><span class="hero-char" style="display: inline-block; will-change: transform;">n</span></span> <span style="white-space:nowrap"><span class="hero-char" style="display: inline-block; will-change: transform;">v</span><span class="hero-char" style="display: inline-block; will-change: transform;">i</span><span class="hero-char" style="display: inline-block; will-change: transform;">s</span><span class="hero-char" style="display: inline-block; will-change: transform;">i</span><span class="hero-char" style="display: inline-block; will-change: transform;">b</span><span class="hero-char" style="display: inline-block; will-change: transform;">i</span><span class="hero-char" style="display: inline-block; will-change: transform;">l</span><span class="hero-char" style="display: inline-block; will-change: transform;">i</span><span class="hero-char" style="display: inline-block; will-change: transform;">t</span><span class="hero-char" style="display: inline-block; will-change: transform;">é</span><span class="hero-char" style="display: inline-block; will-change: transform;">.</span></span>
                    </span>
                </h1>

                <!-- Sub-headline -->
                <p class="mb-12 mt-12 hero-subheadline" style="color: #ffffff; font-size: 34px;">
                    <span style="white-space:nowrap"><span class="hero-char">P</span><span class="hero-char">o</span><span class="hero-char">s</span><span class="hero-char">t</span><span class="hero-char">u</span><span class="hero-char">l</span><span class="hero-char">e</span><span class="hero-char">z</span></span> <span style="white-space:nowrap"><span class="hero-char">g</span><span class="hero-char">r</span><span class="hero-char">a</span><span class="hero-char">t</span><span class="hero-char">u</span><span class="hero-char">i</span><span class="hero-char">t</span><span class="hero-char">e</span><span class="hero-char">m</span><span class="hero-char">e</span><span class="hero-char">n</span><span class="hero-char">t</span></span> <span style="white-space:nowrap"><span class="hero-char">o</span><span class="hero-char">u</span></span> <span style="white-space:nowrap"><span class="hero-char">p</span><span class="hero-char">u</span><span class="hero-char">b</span><span class="hero-char">l</span><span class="hero-char">i</span><span class="hero-char">e</span><span class="hero-char">z</span></span> <span style="white-space:nowrap"><span class="hero-char">u</span><span class="hero-char">n</span><span class="hero-char">e</span></span> <span style="white-space:nowrap"><span class="hero-char">o</span><span class="hero-char">f</span><span class="hero-char">f</span><span class="hero-char">r</span><span class="hero-char">e</span></span> <span style="white-space:nowrap"><span class="hero-char">e</span><span class="hero-char">t</span></span> <span style="white-space:nowrap"><span class="hero-char">a</span><span class="hero-char">m</span><span class="hero-char">p</span><span class="hero-char">l</span><span class="hero-char">i</span><span class="hero-char">f</span><span class="hero-char">i</span><span class="hero-char">e</span><span class="hero-char">z</span></span> <span style="white-space:nowrap"><span class="hero-char">v</span><span class="hero-char">o</span><span class="hero-char">t</span><span class="hero-char">r</span><span class="hero-char">e</span></span> <span style="white-space:nowrap"><span class="hero-char">r</span><span class="hero-char">e</span><span class="hero-char">c</span><span class="hero-char">r</span><span class="hero-char">u</span><span class="hero-char">t</span><span class="hero-char">e</span><span class="hero-char">m</span><span class="hero-char">e</span><span class="hero-char">n</span><span class="hero-char">t</span><span class="hero-char">.</span></span>
                </p>

                <!-- Buttons with Glow Animation -->
                <div class="flex flex-wrap flex-row gap-2 mb-12 hero-buttons justify-center lg:justify-start">
                    <!-- Button 1: Publier une annonce with Glow Effect -->
                    <a href="{{ route('nos-solutions') }}" class="btn-premium-green mx-auto lg:mx-0">
                        <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon" class="hero-button-icon">
                        <span class="text-sm sm:text-lg">Publier une annonce</span>
                    </a>

                    <!-- Button 2: Rechercher toutes les offres with Glow Effect -->
                    <div class="rounded-full overflow-hidden">
                        <a href="{{ route('jobs.index') }}" class="btn-premium-dark mx-auto lg:mx-0">
                            <img src="{{ asset('storage/home_page/btton2.svg') }}" alt="Icon" class="hero-button-icon">
                            <span class="text-sm sm:text-lg">Rechercher toutes les offres</span>
                        </a>
                    </div>
                </div>

                <!-- Trust Section -->
                <div class="hero-trust-section">
                    <p class="mb-3 hero-trust-text" style="color: #a6a6a6; font-size: 16px;">Ils nous font confiance:</p>
                    
                    <!-- Marquee/Slider for Brand Logos -->
                    <div class="overflow-hidden relative hero-marquee-container">
                        <!-- Left fade gradient -->
                        <div class="absolute left-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none" style="background: linear-gradient(to right, #212221, transparent);"></div>
                        <!-- Right fade gradient -->
                        <div class="absolute right-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none" style="background: linear-gradient(to left, #212221, transparent);"></div>
                        <div class="flex animate-marquee gap-4 hero-marquee">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/home_page/brand' . $i . '.png') }}" alt="Brand {{ $i }}" class="h-8 w-auto opacity-70 hover:opacity-100 transition-opacity hero-brand-logo">
                                </div>
                            @endfor
                            <!-- Duplicate for seamless loop -->
                            @for($i = 1; $i <= 8; $i++)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/home_page/brand' . $i . '.png') }}" alt="Brand {{ $i }}" class="h-8 w-auto opacity-70 hover:opacity-100 transition-opacity hero-brand-logo">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Why Choose Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.why-choose-section')
    </div> --}}
    
    <!-- Popular Jobs Section -->
    <div class="animate-on-scroll">
        @include('components.jobs-section')
    </div>

    

    

    <!-- Companies Section -->
    <div class="animate-on-scroll">
        @include('components.companies-section')
    </div>

    <!-- Categories Section -->
    <div class="animate-on-scroll">
        @include('components.categories-section')
    </div>

    <!-- Search Job Section -->
    <div class="animate-on-scroll">
        @include('components.search-job-section')
    </div>

    <!-- FAQ Section -->
    <div class="animate-on-scroll">
        @include('components.faq-section')
    </div>

    <!-- CTA Section -->
    <div class="animate-on-scroll">
        @include('components.cta-section')
    </div>

    <!-- Partners Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.partners-section')
    </div> --}}

    <!-- Featured Articles Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.featured-articles')
    </div> --}}

    <!-- Recruiter CTA Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.recruiter-cta')
    </div> --}}

    <!-- Footer -->
    @include('components.footer')
</div>

        
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ======================================
    // Hero Text Character Animation Sequence
    // ======================================
    function animateHeroSequence() {
        const headlineChars = document.querySelectorAll('.hero-headline .hero-char');
        const subheadlineChars = document.querySelectorAll('.hero-subheadline .hero-char');
        const secondaryElements = document.querySelectorAll('.hero-badge-container, .hero-buttons, .hero-trust-section');
        
        // Ensure initial states
        headlineChars.forEach(char => {
            char.style.opacity = '0';
            char.style.transform = 'translateY(10px)';
            char.style.filter = 'blur(8px)';
        });
        subheadlineChars.forEach(char => {
            char.style.opacity = '0';
            char.style.transform = 'translateY(10px)';
            char.style.filter = 'blur(8px)';
        });

        // 1. Animate Headline (35ms stagger)
        headlineChars.forEach((char, index) => {
            const delay = index * 0.035;
            char.style.animationDelay = delay + 's';
        });

        // 2. Animate Sub-headline (starts at ~1.7s, 12ms stagger)
        const subHeadlineStart = 1.7;
        subheadlineChars.forEach((char, index) => {
            const delay = subHeadlineStart + (index * 0.012);
            char.style.animationDelay = delay + 's';
        });

        // 3. Reveal secondary elements (triggers when sub-headline reaches "et amplifiez", ~2.2s total)
        const finalRevealDelay = 2.2; 
        setTimeout(() => {
            secondaryElements.forEach(el => {
                el.classList.add('hero-reveal-active');
            });
        }, finalRevealDelay * 1000);
    }
    function initParallaxWithBlur() {
        const heroImage = document.querySelector('[data-parallax="hero-image"]');
        const heroSection = document.querySelector('section#home');
        
        if (!heroImage || !heroSection) return;
        
        let ticking = false;
        
        function updateParallax() {
            const scrolled = window.pageYOffset;
            const heroRect = heroSection.getBoundingClientRect();
            const heroBottom = heroRect.top + heroRect.height;
            
            // Parallax effect (slower scroll)
            const parallaxOffset = scrolled * 0.5;
            heroImage.style.transform = `translateY(${parallaxOffset}px)`;
            
            // Blur effect based on scroll (more blur as user scrolls down past hero)
            if (scrolled < heroRect.height) {
                const blurAmount = (scrolled / heroRect.height) * 5;
                heroImage.style.filter = `blur(${blurAmount}px)`;
            } else {
                heroImage.style.filter = 'blur(5px)';
            }
            
            ticking = false;
        }
        
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });
    }
    
    // ======================================
    // Button Glow Animation Handler
    // ======================================
    function initBadgeAnimation() {
        const badge = document.querySelector('.hero-badge-container');
        if (badge) {
            // Animation is handled by CSS badgeFloat keyframes
            badge.style.animationPlayState = 'running';
        }
    }
    
    // ======================================
    // Hero Marquee Animation
    // ======================================
    function initMarqueeAnimation() {
        const marquee = document.querySelector('.hero-marquee');
        if (marquee) {
            marquee.style.animation = 'marqueeScroll 30s linear infinite';
        }
    }
    
    // Initialize all animations
    animateHeroSequence();
    initParallaxWithBlur();
    // initButtonGlowAnimation(); // Removed
    initBadgeAnimation();
    initMarqueeAnimation();
    
    // ======================================
    // Popular Search Functionality
    // ======================================
    window.searchPopular = function(keyword) {
        const searchInput = document.getElementById('homeSearchInput');
        if (searchInput) {
            searchInput.value = keyword;
        }
        
        const form = document.getElementById('homeSearchForm');
        if (form) {
            form.submit();
        }
    };

    // Handle form submission with validation
    const form = document.getElementById('homeSearchForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const searchInput = document.getElementById('homeSearchInput');
            const locationSelect = document.getElementById('homeLocationSelect');
            
            if (!searchInput.value.trim() && !locationSelect.value) {
                e.preventDefault();
                searchInput.focus();
                return false;
            }
        });
    }
    
    console.log('✨ Hero animations fully initialized!');
});
</script>
@endsection
