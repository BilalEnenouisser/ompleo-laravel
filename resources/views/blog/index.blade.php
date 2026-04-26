@extends('layouts.app')

@section('title', 'Blog - OMPLEO')
@section('description', 'Découvrez nos derniers articles et conseils pour booster votre carrière')

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-[#1f1f1f] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-12 overflow-hidden z-10 blog-hero" style="background: #1a1a1a;">
        <style>
            .blog-hero h1 {
                font-size: 70px;
                max-width: 1000px;
                white-space: nowrap;
            }
            .blog-hero p {
                max-width: 800px;
            }
            @media (max-width: 1023px) {
                .blog-hero h1 {
                    font-size: 48px !important;
                    white-space: normal !important;
                }
            }
            @media (max-width: 767px) {
                .blog-hero {
                    padding-top: 5.5rem !important;
                    padding-bottom: 1.5rem !important;
                }
                .blog-hero h1 {
                    white-space: normal !important;
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
        </style>
        <div class="platform-container">
            <h1 class="font-bold mb-6 leading-tight tracking-tighter blog-hero-title" style="font-size: 0;">
                @php
                    $heroTitle = "Blog - Guides et Ressources";
                    
                    if (!function_exists('renderAnimateTextBlog')) {
                        function renderAnimateTextBlog($text) {
                            $words = explode(' ', $text);
                            $output = '';
                            foreach ($words as $wIndex => $word) {
                                $output .= '<span style="white-space:nowrap; font-size: 0;">';
                                $chars = mb_str_split($word);
                                foreach ($chars as $char) {
                                    $output .= '<span class="hero-char" style="display: inline-block;">' . e($char) . '</span>';
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
                {!! renderAnimateTextBlog($heroTitle) !!}
            </h1>
            
            <style>
                .blog-hero-title .hero-char {
                    font-size: 70px;
                    color: #ffffff;
                }
                .blog-hero-title .hero-space {
                    font-size: 70px;
                }
                @media (max-width: 1023px) and (min-width: 768px) {
                    .blog-hero-title .hero-char,
                    .blog-hero-title .hero-space {
                        font-size: 48px !important;
                    }
                }
            </style>
            
            <p class="text-xl hero-subtitle-animate" style="color: #ffffff;">
                Restez informé des dernières tendances en IA et du marché du travail
            </p>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate hero characters with stagger
        const heroChars = document.querySelectorAll('.blog-hero .hero-char, .blog-hero .hero-space');
        heroChars.forEach((char, index) => {
            char.style.animationDelay = (index * 0.03) + 's';
        });
        
        // Animate subtitle after title
        const subtitle = document.querySelector('.blog-hero .hero-subtitle-animate');
        if (subtitle) {
            subtitle.style.animationDelay = (heroChars.length * 0.03 + 0.2) + 's';
        }
    });
    </script>

    <!-- Blog Grid -->
    <section class="platform-section relative z-10">
        <style>
            /* Blog Card Scroll Animations */
            .blog-card {
                opacity: 0;
                transform: translateY(40px);
                animation: blogCardFadeInUp 0.6s ease-out forwards;
            }
            
            @keyframes blogCardFadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Staggered animation delays */
            @media (min-width: 1024px) {
                .blog-card:nth-child(1) { animation-delay: 0s; }
                .blog-card:nth-child(2) { animation-delay: 0.1s; }
                .blog-card:nth-child(3) { animation-delay: 0.2s; }
                .blog-card:nth-child(4) { animation-delay: 0.1s; }
                .blog-card:nth-child(5) { animation-delay: 0.2s; }
                .blog-card:nth-child(6) { animation-delay: 0.3s; }
                .blog-card:nth-child(7) { animation-delay: 0.2s; }
                .blog-card:nth-child(8) { animation-delay: 0.3s; }
                .blog-card:nth-child(9) { animation-delay: 0.4s; }
            }
            
            @media (max-width: 1023px) and (min-width: 768px) {
                .blog-card:nth-child(1) { animation-delay: 0s; }
                .blog-card:nth-child(2) { animation-delay: 0.1s; }
                .blog-card:nth-child(n+3) { animation-delay: 0.2s; }
            }
            
            @media (max-width: 767px) {
                .blog-card { animation-delay: 0s !important; }
                .blog-card-title {
                    font-size: 16px !important;
                    line-height: 1.35 !important;
                }
            }
            
            /* Image parallax on hover */
            .blog-card-image {
                position: relative;
                overflow: hidden;
            }
            
            .blog-card-image img {
                transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
            
            .blog-card:hover .blog-card-image img {
                transform: scale(1.08);
            }
        </style>
        <div class="platform-container">
            <div id="blogContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($blogs as $blog)
                <article class="blog-card group rounded-2xl transition-all duration-300 hover:-translate-y-2 p-4 bg-[#2b2b2b] group-hover:bg-[#383838]" style="backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08);">
                    <!-- Image Section -->
                    <div class="blog-card-image relative h-48 overflow-hidden rounded-lg">
                        <img
                            src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=400' }}"
                            alt="{{ $blog->title }}"
                            class="w-full h-full object-cover transition-transform duration-500"
                        />
                    </div>
                    
                    <!-- Content Section -->
                    <div class="pt-4">
                        <!-- Meta Information -->
                        <div class="mb-4 text-[0.9375rem]" style="color: #9a9a9a;">
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                            <span>&nbsp;&nbsp;&nbsp;</span>
                            <span>{{ $blog->reading_time ?? '3' }} min read</span>
                        </div>
                        
                        <!-- Title -->
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            <h2 class="blog-card-title font-bold text-white mb-3 line-clamp-2 group-hover:text-[#16b6b4] transition-colors duration-200">
                                {{ $blog->title }}
                            </h2>
                        </a>
                        
                        <!-- Excerpt (3 lines max) -->
                        <p class="line-clamp-3 text-[0.9375rem] leading-relaxed" style="color: #a0a0a0;">
                            {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 150) }}
                        </p>
                    </div>
                </article>
                @empty
                <div class="col-span-3 text-center py-12 rounded-2xl" style="background: rgba(43, 43, 43, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <h3 class="text-xl font-semibold text-white mb-2">
                        Aucun article trouvé
                    </h3>
                    <p style="color: #b0b0b0;">
                        Essayez de modifier vos critères de recherche
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

@include('components.footer')

<script>
// Blog scroll animation handler
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all blog cards
    const blogCards = document.querySelectorAll('.blog-card');
    blogCards.forEach((card, index) => {
        // Set initial state for scroll animation
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        observer.observe(card);
    });
    
    // Smooth reveal on initial page load
    window.addEventListener('load', function() {
        blogCards.forEach((card, index) => {
            card.style.animation = `blogCardFadeInUp 0.6s ease-out forwards`;
            if (window.innerWidth >= 1024) {
                const row = Math.floor(index / 3);
                const col = index % 3;
                card.style.animationDelay = (col * 0.1 + row * 0.1) + 's';
            } else {
                card.style.animationDelay = '0s';
            }
        });
    });
});
</script>
@endsection
