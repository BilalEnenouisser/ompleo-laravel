@extends('layouts.app')

@section('title', 'OMPLEO - Plateforme de Recrutement')
@section('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="bg-gradient-to-b from-[#e0e3df] via-[#dadad2] to-[#dee0db] dark:bg-[#212221] dark:from-[#212221] dark:via-[#212221] dark:to-[#212221]">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section (right art: Group 51.svg — layout from test index.html / style.css) -->
    <section id="home" class="relative min-h-screen flex flex-col lg:flex-row lg:items-center overflow-hidden bg-[#212221] mb-16 hero-section isolate">
        <style>
            /* Match style.css .hero-art / .hero-art-image (scoped to #home) */
            #home.hero-section .hero-art {
                position: absolute;
                right: -14.5rem;
                top: 50%;
                width: min(54rem, 61vw);
                aspect-ratio: 549 / 686;
                transform: translateY(-47%);
                pointer-events: none;
                z-index: 1;
            }
            #home.hero-section .hero-art-image {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: contain;
                filter: saturate(108%) blur(0.2px);
            }
            @media (max-width: 960px) {
                #home.hero-section .hero-art {
                    position: relative;
                    right: auto;
                    top: auto;
                    width: min(36rem, 128vw);
                    margin: 1.25rem -7rem 0 auto;
                    transform: none;
                }
            }
            /* Mobile: same SVG faintly behind left copy (desktop/tablet: off) */
            #home.hero-section .hero-art-mobile-bg {
                display: none;
            }
            @media (max-width: 767px) {
                /* One SVG on phone: faint watermark only — hide the in-flow copy at the bottom */
                #home.hero-section .hero-art {
                    display: none !important;
                }
                #home.hero-section .hero-art-mobile-bg {
                    display: block;
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: 50%;
                    width: 100%;
                    transform: translateY(-50%);
                    pointer-events: none;
                    z-index: 3;
                    opacity: 0.3;
                }
                #home.hero-section .hero-art-mobile-bg img {
                    display: block;
                    width: 100%;
                    height: auto;
                    max-width: 100%;
                    object-fit: contain;
                    object-position: center center;
                }
            }
        </style>

        <!-- Gradient over art area (below text) -->
        <div class="absolute inset-y-0 right-0 left-[44%] hidden lg:block pointer-events-none z-[2]" style="background: linear-gradient(to left, rgba(33, 34, 33, 0.25), transparent);"></div>

        <!-- Mobile: low-opacity SVG watermark behind headline / buttons -->
        <div class="hero-art-mobile-bg" aria-hidden="true">
            <img src="{{ asset('storage/home_page/' . rawurlencode('Group 51.svg')) }}" alt="">
        </div>
        
        <!-- Content -->
        <div class="w-[90%] mx-auto relative z-[10] hero-content-wrapper" style="padding-left: 20px; padding-right: 33%;">
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
                    h1.hero-headline span[style*="white-space:nowrap"],
                    h1.hero-headline .hero-char {
                        display: inline-block !important;
                        white-space: nowrap !important;
                    }
                    h1.hero-headline .hero-headline-line-1,
                    h1.hero-headline .hero-headline-line-2 {
                        display: block !important;
                        width: 100% !important;
                    }
                    .hero-headline .hero-char,
                    .hero-subheadline .hero-char {
                        display: inline-block !important;
                        vertical-align: baseline !important;
                        line-height: inherit !important;
                    }
                    .hero-headline span[style*="white-space:nowrap"],
                    .hero-subheadline span[style*="white-space:nowrap"] {
                        white-space: nowrap !important;
                        display: inline-block !important;
                    }
                    p.hero-subheadline {
                        margin-top: 1rem !important;
                        margin-bottom: 1.5rem !important;
                    }
                    .hero-buttons {
                        margin-bottom: 1.5rem !important;
                    }
                    .hero-badge-container {
                        margin-bottom: 1.25rem !important;
                        flex-wrap: wrap !important;
                    }
                    .hero-badge-container img {
                        flex-shrink: 0 !important;
                    }
                    .hero-trust-section {
                        margin-top: 1.5rem !important;
                    }
                    .hero-trust-text {
                        margin-bottom: 0.75rem !important;
                    }
                    .hero-marquee {
                        gap: 1.5rem !important;
                    }
                    .hero-marquee-container {
                        margin-top: 0.5rem !important;
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
                
                /* Ensure hero text displays horizontally and words stay whole */
                .hero-char {
                    display: inline-block !important;
                    white-space: nowrap !important;
                }
                
                /* Ensure characters and words don't break internally */
                .hero-char,
                .hero-headline span[style*="white-space:nowrap"],
                .hero-subheadline span[style*="white-space:nowrap"] {
                    display: inline-block !important;
                    white-space: nowrap !important;
                }
                
                /* Mobile fixes for hero text */
                @media (max-width: 767px) {
                    .hero-headline .hero-headline-line-1,
                    .hero-headline .hero-headline-line-2 {
                        display: block !important;
                        white-space: normal !important;
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
                <div class="flex flex-wrap flex-row gap-2 mb-12 hero-buttons justify-start">
                    <!-- Button 1: Publier une annonce with Glow Effect -->
                    <a href="{{ route('nos-solutions') }}" class="btn-premium-green mx-0">
                        <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon" class="hero-button-icon">
                        <span class="text-sm sm:text-lg">Publier une annonce</span>
                    </a>

                    <a href="{{ route('jobs.index') }}" class="btn-premium-dark mx-0">
                        <img src="{{ asset('storage/home_page/btton2.svg') }}" alt="Icon" class="hero-button-icon">
                        <span class="text-sm sm:text-lg">Rechercher toutes les offres</span>
                    </a>
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
                            @php
                                $marqueePartners = isset($heroPartners) ? $heroPartners : collect();
                            @endphp
                            @foreach($marqueePartners as $partner)
                                <div class="flex-shrink-0">
                                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-8 w-auto opacity-70 hover:opacity-100 transition-opacity hero-brand-logo">
                                </div>
                            @endforeach
                            <!-- Duplicate for seamless loop -->
                            @foreach($marqueePartners as $partner)
                                <div class="flex-shrink-0">
                                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="h-8 w-auto opacity-70 hover:opacity-100 transition-opacity hero-brand-logo">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-art" aria-hidden="true">
            <img class="hero-art-image" src="{{ asset('storage/home_page/' . rawurlencode('Group 51.svg')) }}" alt="">
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
