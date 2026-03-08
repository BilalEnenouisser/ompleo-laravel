@extends('layouts.app')

@section('title', 'Nos Solutions - OMPLEO')
@section('description', 'Découvrez nos solutions de recrutement pour publier vos offres et atteindre les meilleurs candidats.')

@section('content')
<div class="bg-[#212221] min-h-screen">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="relative min-h-[60vh] md:min-h-[70vh] lg:min-h-[80vh] flex items-center overflow-hidden bg-[#212221]">
        <style>
            .hero-bg-image {
                width: 40%;
            }
            .hero-bg-image img {
                object-fit: cover;
                object-position: left center;
            }
            @media (max-width: 1023px) {
                .hero-bg-image {
                    width: 25% !important;
                }
            }
            @media (max-width: 767px) {
                .hero-bg-image {
                    display: none !important;
                }
            }
        </style>
        <!-- Background Image on Right -->
        <div class="hero-bg-image absolute top-0 right-0 bottom-0 hidden lg:block pointer-events-none z-0">
            <img src="{{ asset('storage/nos_solutions/header.png') }}" alt="Background" class="w-full h-full">
        </div>
        
        <!-- Content -->
        <div class="w-full md:w-[90%] mx-auto relative z-10 px-4 md:px-5">
            <style>
                .nos-solutions-hero h1 {
                    font-size: 56px;
                    max-width: 850px;
                }
                .nos-solutions-hero .hero-subtitle {
                    max-width: 600px;
                    
                }
                .nos-solutions-hero .hero-subtitle p {
                    font-size: 24px;
                }
                @media (max-width: 1023px) {
                    .nos-solutions-hero h1 {
                        font-size: 42px !important;
                        max-width: 850px !important;
                    }
                    .nos-solutions-hero .hero-subtitle {
                        max-width: 600px !important;
                    }
                }
                @media (max-width: 767px) {
                    .nos-solutions-hero {
                        padding-top: 2rem !important;
                        padding-bottom: 2rem !important;
                    }
                    .nos-solutions-hero h1 {
                        font-size: 28px !important;
                        max-width: 100% !important;
                        margin-bottom: 1.5rem !important;
                    }
                    .nos-solutions-hero .hero-subtitle {
                        max-width: 100% !important;
                        margin-bottom: 2rem !important;
                    }
                    .nos-solutions-hero .hero-subtitle p {
                        font-size: 14px !important;
                    }
                }
                /* Hero Character Animation */
                .hero-char {
                    opacity: 0;
                    transform: translateY(20px);
                    filter: blur(8px);
                    animation: heroCharFadeIn 0.6s ease forwards;
                    display: inline-block;
                    will-change: transform, opacity, filter;
                }
                @keyframes heroCharFadeIn {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                        filter: blur(0);
                    }
                }
                .hero-subtitle-animate {
                    opacity: 0;
                    transform: translateY(20px);
                    filter: blur(8px);
                    animation: heroCharFadeIn 0.6s ease forwards;
                    will-change: transform, opacity, filter;
                }
                .hero-btn-animate {
                    opacity: 0;
                    transform: translateY(20px);
                    filter: blur(8px);
                    animation: heroCharFadeIn 0.6s ease forwards;
                    will-change: transform, opacity, filter;
                }
            </style>
            <div class="nos-solutions-hero">
                <!-- Title -->
                <h1 class="font-bold mb-8 leading-tight text-white tracking-tighter nos-solutions-hero-title" style="font-size: 0;">
                    @php
                        $heroTitle = "Recrutez plus vite, avec les bons profils";
                        
                        if (!function_exists('renderAnimateTextNos')) {
                            function renderAnimateTextNos($text) {
                                $words = explode(' ', $text);
                                $output = '';
                                foreach ($words as $wIndex => $word) {
                                    $output .= '<span style="white-space:nowrap; font-size: 0;">';
                                    $chars = mb_str_split($word);
                                    foreach ($chars as $char) {
                                        $output .= '<span class="hero-char" style="display: inline-block;">' . $char . '</span>';
                                    }
                                    $output .= '</span>';
                                    if ($wIndex < count($words) - 1) {
                                        $output .= '<span class="hero-space">&nbsp;</span>';
                                    }
                                }
                                return $output;
                            }
                        }
                    @endphp
                    {!! renderAnimateTextNos($heroTitle) !!}
                </h1>
                
                <style>
                    .nos-solutions-hero-title .hero-char {
                        font-size: 56px;
                    }
                    .nos-solutions-hero-title .hero-space {
                        font-size: 56px;
                    }
                    @media (max-width: 1023px) {
                        .nos-solutions-hero-title .hero-char,
                        .nos-solutions-hero-title .hero-space {
                            font-size: 42px !important;
                        }
                    }
                    @media (max-width: 767px) {
                        .nos-solutions-hero-title .hero-char,
                        .nos-solutions-hero-title .hero-space {
                            font-size: 28px !important;
                        }
                    }
                </style>
                
                <!-- Subtitle with left border -->
                <div class="mb-10 pl-6 hero-subtitle hero-subtitle-animate" style="border-left: 3px solid #16b6b4;">
                    <p class="text-white leading-relaxed">
                        Publiez vos offres et améliorez leur visibilité auprès des candidats qualifiés.
                    </p>
                </div>
                
                <!-- Button -->
                <a href="#nos-solutions-section" class="btn-premium-green hero-btn-animate hover:scale-105 transition-all duration-300">
                    <span>Essayez gratuitement</span>
                </a>
            </div>
        </div>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate hero characters with stagger
            const heroChars = document.querySelectorAll('.nos-solutions-hero-title .hero-char, .nos-solutions-hero-title .hero-space');
            heroChars.forEach((char, index) => {
                char.style.animationDelay = (index * 0.03) + 's';
            });
            
            // Animate subtitle after title
            const subtitle = document.querySelector('.nos-solutions-hero .hero-subtitle-animate');
            if (subtitle) {
                subtitle.style.animationDelay = (heroChars.length * 0.03 + 0.2) + 's';
            }
            
            // Animate button after subtitle
            const btn = document.querySelector('.nos-solutions-hero .hero-btn-animate');
            if (btn) {
                btn.style.animationDelay = (heroChars.length * 0.03 + 0.45) + 's';
            }
        });
        </script>
    </section>

    <!-- Pricing Section -->
    <section id="nos-solutions-section" class="relative py-20 md:py-32 lg:py-72 overflow-hidden animate-on-scroll" data-stagger-selector=".pricing-card" data-stagger-delay="0.1">
        <style>
            .pricing-card {
                position: relative;
                background: rgba(30, 30, 30, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 40px;
                overflow: visible;
                width: 340px;
                height: 600px;
                margin: 0 auto;
            }
            .paddingtp {
                margin-top: 60px;
            }
            .pricing-card-inner {
                position: relative;
                z-index: 1;
                padding: 2rem;
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            /* Fixed heights for consistent alignment */
            .pricing-card .card-header {
                height:140px ;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }
            .pricing-card .card-title {
                font-size: 24px;
                font-weight: bold;
                color: white;
                text-align: center;
                margin-bottom: 16px;
            }
            .pricing-card .card-desc {
                font-size: 18px;
                color: #ffffff;
                text-align: center;
                line-height: 1.4;
            }
            .pricing-card .card-btn-wrapper {
                
                display: flex;
                align-items: center;
                justify-content: center;
                padding-bottom: 50px;
                padding-top: 10px;
            }
            .pricing-card .card-features {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            .pricing-card .card-discover {
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            /* Corner border images */
            .pricing-card .corner {
                position: absolute;
                width: 110px;
                height: 110px;
                z-index: 2;
                pointer-events: none;
            }
            .pricing-card .corner-tl {
                top: -2px;
                left: -2px;
            }
            .pricing-card .corner-tr {
                top: -2px;
                right: -2px;
                transform: rotate(90deg);
            }
            .pricing-card .corner-bl {
                bottom: -2px;
                left: -2px;
                transform: rotate(-90deg);
            }
            .pricing-card .corner-br {
                bottom: -2px;
                right: -2px;
                transform: rotate(180deg);
            }
            /* Button styling */
            .pricing-btn {
                @apply btn-premium text-white;
                background: linear-gradient(135deg, #1aa2a0, #39fffc) !important;
                border: 1px solid #47fffd !important;
                text-shadow: 0 1px 2px rgb(0 0 0 / 66%) !important;
                transition: all 0.3s ease !important;
            }
            .pricing-btn:hover {
                filter: brightness(1.1) !important;
                transform: scale(1.05) !important;
            }
            /* Discover link - hidden by default, shown on hover */
            .discover-link {
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .pricing-card:hover .discover-link {
                opacity: 1;
            }
            /* Featured card (URGENCE) */
            .pricing-card-featured {
                transform: scale(1.12);
            }
            @media (max-width: 1200px) {
                .pricing-card {
                    width: 300px;
                    height: 580px;
                }
            }
            @media (max-width: 768px) {
                .pricing-card {
                    width: 100%;
                    max-width: 320px;
                    height: auto;
                    min-height: 480px;
                    border-radius: 30px;
                }
                .pricing-card-inner {
                    padding: 1.5rem;
                }
                .pricing-card .card-header {
                    height: auto;
                    margin-bottom: 1rem;
                }
                .pricing-card .card-title {
                    font-size: 20px;
                }
                .pricing-card .card-desc {
                    font-size: 15px;
                }
                .pricing-card .card-btn-wrapper {
                    padding-bottom: 30px;
                }
                .pricing-card .corner {
                    width: 80px;
                    height: 80px;
                }
                .pricing-card-featured {
                    transform: scale(1);
                }
                .paddingtp {
                    margin-top: 0;
                }
                .discover-link {
                    opacity: 1;
                }
            }
        </style>
        
        <!-- Background Image - Full Width -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/nos_solutions/mid.png') }}" alt="Background" class="w-full h-full object-cover">
        </div>
        
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-12 md:mb-20 lg:mb-36">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 md:mb-6">Nos solutions</h2>
                <p class="text-white text-base md:text-lg lg:text-xl mb-2 px-4">Des outils simples pour recruter plus efficacement</p>
                <p class="text-white text-base md:text-lg lg:text-xl px-4">Diffusez vos offres et touchez les bons profils, sans complexité.</p>
            </div>
            
            <!-- Top Row: 3 Cards -->
            <div class="flex flex-col md:flex-row flex-wrap justify-center gap-6 md:gap-8 items-center md:items-end mb-6 md:mb-8">
                
                <!-- Card 1: Essentiel -->
                <div class="pricing-card animate-stagger-item">
                    <!-- Corner borders -->
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tr">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-bl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-br">
                    
                    <div class="pricing-card-inner">
                        <!-- Header Section -->
                        <div class="card-header">
                            <h3 class="card-title">Essentiel</h3>
                            <p class="card-desc">Diffusez vos annonces d'emploi & accédez à l'ensemble des candidatures</p>
                        </div>
                        
                        <!-- Button Section -->
                        <div class="card-btn-wrapper">
                            <a href="{{ route('signup.choice') }}" class="pricing-btn inline-flex items-center justify-center px-6 py-3 rounded-full text-white font-bold hover:brightness-90">
                                48H d'essais gratuit
                            </a>
                        </div>
                        
                        <!-- Features Section -->
                        <div class="card-features">
                            <ul class="space-y-2 text-left">
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>1 annonce d'emploi publiée sur OMPLEO</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Diffusion standard sur la plateforme</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Accès aux candidatures reçues</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Gestion simple des candidatures</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Aucune commission</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Discover Link Section -->
                        <div class="card-discover">
                            <a href="{{ route('jobs.index') }}" class="discover-link inline-flex items-center gap-2 text-[#16b6b4] hover:text-[#39fffc] transition-colors text-sm font-medium">
                                <span>Découvrir nos offres</span>
                                <img src="{{ asset('storage/nos_solutions/arrow.svg') }}" alt="Arrow" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2: URGENCE (Featured - Bigger) -->
                <div class="pricing-card pricing-card-featured animate-stagger-item">
                    <!-- Corner borders -->
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tr">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-bl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-br">
                    
                    <div class="pricing-card-inner">
                        <!-- Header Section -->
                        <div class="card-header">
                            <h3 class="card-title">URGENCE</h3>
                            <p class="card-desc" style="color: white;">La solution la plus rapide pour rendre votre offre visible</p>
                        </div>
                        
                        <!-- Button Section -->
                        <div class="card-btn-wrapper">
                            <a href="#devis-section" class="pricing-btn inline-flex items-center justify-center px-6 py-3 rounded-full text-white font-bold">
                                Demandez un devis
                            </a>
                        </div>
                        
                        <!-- Features Section -->
                        <div class="card-features">
                            <ul class="space-y-2 text-left">
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Boost de l'annonce</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Visibilité maximale</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Ads ciblées</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Support VIP</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Discover Link Section -->
                        <div class="card-discover">
                            <a href="{{ route('jobs.index') }}" class="discover-link inline-flex items-center gap-2 text-[#16b6b4] hover:text-[#39fffc] transition-colors text-sm font-medium">
                                <span>Découvrir nos offres</span>
                                <img src="{{ asset('storage/nos_solutions/arrow.svg') }}" alt="Arrow" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Card 3: Croissance -->
                <div class="pricing-card animate-stagger-item">
                    <!-- Corner borders -->
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tr">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-bl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-br">
                    
                    <div class="pricing-card-inner">
                        <!-- Header Section -->
                        <div class="card-header">
                            <h3 class="card-title">Croissance</h3>
                            <p class="card-desc">Diffusez plusieurs annonces et gagnez en visibilité</p>
                        </div>
                        
                        <!-- Button Section -->
                        <div class="card-btn-wrapper">
                            <a href="#devis-section" class="pricing-btn inline-flex items-center justify-center px-6 py-3 rounded-full text-white font-bold">
                                Demandez un devis
                            </a>
                        </div>
                        
                        <!-- Features Section -->
                        <div class="card-features">
                            <ul class="space-y-2 text-left">
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>5 annonces d'emploi publiées</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Visibilité renforcée sur la plateforme</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Accès complet aux candidatures</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Priorité d'affichage</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Support client standard</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Discover Link Section -->
                        <div class="card-discover">
                            <a href="{{ route('jobs.index') }}" class="discover-link inline-flex items-center gap-2 text-[#16b6b4] hover:text-[#39fffc] transition-colors text-sm font-medium">
                                <span>Découvrir nos offres</span>
                                <img src="{{ asset('storage/nos_solutions/arrow.svg') }}" alt="Arrow" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Bottom Row: 1 Card Centered -->
            <div class="flex justify-center">
                <!-- Card 4: Performance -->
                <div class="pricing-card paddingtp animate-stagger-item">
                    <!-- Corner borders -->
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-tr">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-bl">
                    <img src="{{ asset('storage/nos_solutions/border.png') }}" alt="" class="corner corner-br">
                    
                    <div class="pricing-card-inner ">
                        <!-- Header Section -->
                        <div class="card-header">
                            <h3 class="card-title">Performance</h3>
                            <p class="card-desc">Maximisez la visibilité de vos offres et accélérez vos recrutements</p>
                        </div>
                        
                        <!-- Button Section -->
                        <div class="card-btn-wrapper">
                            <a href="#devis-section" class="pricing-btn inline-flex items-center justify-center px-6 py-3 rounded-full text-white font-bold">
                                Demandez un devis
                            </a>
                        </div>
                        
                        <!-- Features Section -->
                        <div class="card-features">
                            <ul class="space-y-2 text-left">
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>10 annonces d'emploi publiées</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Mise en avant des annonces sur la plateforme</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Visibilité maximale auprès des candidats</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Accès prioritaire aux candidatures</span>
                                </li>
                                <li class="flex items-start gap-3 text-white text-sm">
                                    <svg class="w-6 h-6 text-[#16b6b4] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Support client prioritaire</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Discover Link Section -->
                        <div class="card-discover">
                            <a href="{{ route('jobs.index') }}" class="discover-link inline-flex items-center gap-2 text-[#16b6b4] hover:text-[#39fffc] transition-colors text-sm font-medium">
                                <span>Découvrir nos offres</span>
                                <img src="{{ asset('storage/nos_solutions/arrow.svg') }}" alt="Arrow" class="w-6 h-6">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="devis-section" class="relative py-12 md:py-16 lg:py-20 overflow-hidden bg-[#1f1f1f] animate-on-scroll">
        <!-- Background Image at Bottom -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/nos_solutions/bottom.png') }}" alt="Background" class="w-full h-full object-cover">
        </div>
        
        <style>
            .contact-form-input {
                background: rgba(33, 34, 33, 0.8);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid #16b6b4;
                border-radius: 12px;
                padding: 22px 28px;
                color: white;
                width: 100%;
                font-size: 18px;
                transition: all 0.3s ease;
            }
            .contact-form-input::placeholder {
                color: #a0a0a0;
                font-size: 18px;
            }
            .contact-form-input:focus {
                outline: none;
                border-color: #00fadc;
                box-shadow: 0 0 10px rgba(0, 250, 220, 0.2);
            }
            /* Select wrapper */
            .select-wrapper {
                position: relative;
            }
            .contact-form-select {
                background: rgba(33, 34, 33, 0.8);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid #16b6b4;
                border-radius: 12px;
                padding: 22px 28px;
                padding-right: 50px;
                color: white;
                width: 100%;
                font-size: 18px;
                cursor: pointer;
                appearance: none;
                transition: all 0.3s ease;
            }
            .contact-form-select option {
                background: #1f1f1f;
                color: white;
                padding: 16px 20px;
                border-left: 1px solid #16b6b4;
                border-right: 1px solid #16b6b4;
            }
            .contact-form-select option:first-child {
                border-top: 1px solid #16b6b4;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .contact-form-select option:last-child {
                border-bottom: 1px solid #16b6b4;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
            }
            .contact-form-select option:hover,
            .contact-form-select option:focus {
                background: #2b2b2b;
            }
            .contact-form-select:focus,
            .contact-form-select:active {
                outline: none;
                border-color: #00fadc;
                box-shadow: 0 0 10px rgba(0, 250, 220, 0.2);
            }
            .select-wrapper:focus-within .contact-form-select {
                border-color: #00fadc;
                box-shadow: 0 0 10px rgba(0, 250, 220, 0.2);
            }
            /* Dropdown arrow overlay */
            .select-wrapper::after {
                content: '';
                position: absolute;
                right: 22px;
                top: 50%;
                transform: translateY(-50%);
                width: 24px;
                height: 24px;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%2316b6b4' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-size: contain;
                pointer-events: none;
            }
            .contact-form-checkbox {
                appearance: none;
                -webkit-appearance: none;
                width: 20px;
                height: 20px;
                min-width: 20px;
                border: 2px solid #16b6b4;
                border-radius: 4px;
                background: transparent;
                cursor: pointer;
                transition: all 0.2s ease;
                position: relative;
                flex-shrink: 0;
            }
            .contact-form-checkbox:checked {
                background: #16b6b4;
                border-color: #16b6b4;
            }
            .contact-form-checkbox:checked::after {
                content: '';
                position: absolute;
                left: 5px;
                top: 2px;
                width: 6px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }
            .contact-form-checkbox:focus {
                outline: none;
                border-color: #00fadc;
            }
            .contact-form-checkbox-label {
                color: #a0a0a0;
                font-size: 13px;
                line-height: 1.4;
            }
            .contact-form-checkbox-label a {
                color: #16b6b4;
                text-decoration: none;
            }
            .contact-form-checkbox-label a:hover {
                color: #39fffc;
            }
            .contact-submit-btn {
                background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b);
                background-size: 200% 200%;
                background-position: 0% 50%;
                color: white;
                font-weight: bold;
                padding: 22px 80px;
                border-radius: 12px;
                border: none;
                font-size: 20px;
                cursor: pointer;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5), 0 4px 12px rgba(0, 0, 0, 0.3);
            }
            .contact-submit-btn:hover {
                background-position: 100% 50%;
                transform: scale(1.03) translateY(-2px);
            }
            
            /* Mobile responsive styles */
            @media (max-width: 767px) {
                .contact-form-input {
                    padding: 16px 20px;
                    font-size: 16px;
                    border-radius: 10px;
                }
                .contact-form-input::placeholder {
                    font-size: 16px;
                }
                .contact-form-select {
                    padding: 16px 20px;
                    padding-right: 45px;
                    font-size: 16px;
                    border-radius: 10px;
                }
                .select-wrapper::after {
                    right: 16px;
                    width: 20px;
                    height: 20px;
                }
                .contact-form-checkbox-label {
                    font-size: 12px;
                }
                .contact-submit-btn {
                    padding: 16px 40px;
                    font-size: 16px;
                    border-radius: 10px;
                    width: 100%;
                    max-width: 280px;
                }
            }
        </style>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-3xl md:text-5xl lg:text-7xl font-bold mb-4 md:mb-8 text-white">Demandez un devis</h2>
                <p class="text-sm md:text-base lg:text-lg max-w-3xl mx-auto leading-relaxed px-2" style="color: #d8d4d4;">
                    Des offres adaptées à vos besoins de recrutement et à votre budget.<br class="hidden md:block">
                    Contactez-nous pour recevoir un devis gratuit, notre équipe vous répondra rapidement.
                </p>
            </div>
            
            <!-- Contact Form -->
            <form action="{{ route('contact.submit') }}" method="POST" class="max-w-6xl mx-auto px-2 md:px-0">
                @csrf
                
                <!-- Row 1: Name & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mb-4 md:mb-8">
                    <input type="text" name="name" class="contact-form-input" placeholder="Nom & Prénom" required>
                    <input type="email" name="email" class="contact-form-input" placeholder="Adresse email" required>
                </div>
                
                <!-- Row 2: Company & Phone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mb-4 md:mb-8">
                    <input type="text" name="company" class="contact-form-input" placeholder="Nom de votre entreprise">
                    <input type="tel" name="phone" class="contact-form-input" placeholder="Numéro de téléphone">
                </div>
                
                <!-- Row 3: Select Offer & Checkboxes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 mb-6 md:mb-10">
                    <div class="select-wrapper">
                        <select name="offer" class="contact-form-select">
                            <option value="" disabled selected>Choisissez votre offre</option>
                            <option value="essentiel">Essentiel</option>
                            <option value="urgence">Urgence</option>
                            <option value="croissance">Croissance</option>
                            <option value="performance">Performance</option>
                        </select>
                    </div>
                    
                    <div class="space-y-3 md:space-y-4">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="terms" class="contact-form-checkbox mt-0.5" required>
                            <span class="contact-form-checkbox-label">
                                J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a>
                            </span>
                        </label>
                        
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="marketing" class="contact-form-checkbox mt-0.5">
                            <span class="contact-form-checkbox-label">
                                J'accepte de recevoir des e-mails marketing et promotionnels de la part d'Ompleo.
                            </span>
                        </label>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="contact-submit-btn">
                        Envoyer
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</div>
@endsection
