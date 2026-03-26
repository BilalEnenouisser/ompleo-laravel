@extends('layouts.app')

@section('title', 'Emplois - OMPLEO')
@section('description', 'Découvrez toutes les offres d\'emploi disponibles sur OMPLEO')

@section('content')
<!-- Header -->
@include('components.header')

@php
    $tabTitles = [
        'all' => 'Toutes les offres',
        'category' => 'Catégorie',
        'location' => 'Lieu',
        'type' => 'Type'
    ];
    
    $sidebarTitle = '';
    $sidebarItems = [];
    $allLabel = '';
    $currentFilter = '';
    
    if ($tab === 'category') {
        $sidebarTitle = 'Catégories';
        $sidebarItems = $categories;
        $allLabel = 'Toutes les catégories';
        $currentFilter = request('category') ?: request('search');
    } elseif ($tab === 'location') {
        $sidebarTitle = 'Lieux';
        $sidebarItems = $locations;
        $allLabel = 'Tous les lieux';
        $currentFilter = request('location');
    } elseif ($tab === 'type') {
        $sidebarTitle = 'Types';
        $sidebarItems = $types;
        $allLabel = 'Tous les types';
        $currentFilter = request('type');
    }
@endphp

<div class="min-h-screen bg-[#212221] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="relative pt-16 pb-4 md:pt-20 md:pb-12 overflow-hidden z-10 jobs-hero">
        <style>
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
            <div class="mb-4 md:mb-6">
                <h1 class="font-bold text-white mb-4 md:mb-6 leading-[1.1] tracking-tighter" style="font-size: 0;">
                    @php
                        $title = "Parcourir les offres";
                        if (request('work_type') === 'remote') {
                            $title = "Offres à distance";
                        } elseif (request('type') === 'Stage') {
                            $title = "Offres de Stages";
                        } elseif (request('search')) {
                            $title = "Résultats pour \"" . request('search') . "\"";
                        }
                        
                        $tabText = $tab !== 'all' ? " - par " . $tabTitles[$tab] : "";
                        
                        if (!function_exists('renderAnimateText')) {
                            function renderAnimateText($text) {
                                $words = explode(' ', $text);
                                $output = '';
                                foreach ($words as $wIndex => $word) {
                                    $output .= '<span style="white-space:nowrap; font-size: 0;">';
                                    $chars = mb_str_split($word);
                                    foreach ($chars as $char) {
                                        $output .= '<span class="hero-char md:text-6xl xl:text-8xl" style="display: inline-block;">' . $char . '</span>';
                                    }
                                    $output .= '</span>';
                                    if ($wIndex < count($words) - 1) {
                                        $output .= '<span class="hero-char md:text-6xl xl:text-8xl" style="display: inline-block;">&nbsp;</span>';
                                    }
                                }
                                return $output;
                            }
                        }
                    @endphp
                    {!! renderAnimateText($title) !!}
                    <br>
                    @if($tab !== 'all')
                        <span class="text-[#f5f5f5] opacity-90" style="font-size: 0;">
                            {!! renderAnimateText($tabText) !!}
                        </span>
                    @endif
                </h1>
                <p class="text-xl text-[#9ca3af] mb-6 md:mb-8 leading-relaxed max-w-2xl hero-subtitle-animate">
                    Explorez les meilleures offres pour vous aider à grandir et à réussir.
                </p>
            </div>
        </div>
    </section>

    <!-- Navigation Tabs -->
    <section class="platform-section !py-0 mb-8 md:mb-12 relative z-10">
        <div class="platform-container">
            <div class="flex items-center gap-6 overflow-x-auto no-scrollbar pt-2 md:pt-6">
                @foreach($tabTitles as $tabKey => $title)
                    <a href="{{ route('jobs.index', ['tab' => $tabKey]) }}" 
                       class="text-base font-semibold transition-colors whitespace-nowrap {{ $tab === $tabKey ? 'text-[#00b6b4]' : 'text-[#9ca3af] hover:text-white' }}">
                        {{ $title }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="platform-section !pt-0 relative z-10">
        <div class="platform-container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-12">
                
                <!-- Sidebar (1/3) -->
                <div class="lg:col-span-1 space-y-6 lg:space-y-10 order-2 lg:order-1">
                    
                    <!-- Filters List -->
                    @if($tab !== 'all')
                    <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-6 lg:p-8 backdrop-blur-sm animate-on-scroll">
                        <div class="space-y-5">
                            <a href="{{ route('jobs.index', ['tab' => $tab]) }}" 
                               class="block text-base transition-colors {{ !$currentFilter ? 'text-[#00b6b4] font-bold' : 'text-[#9ca3af] hover:text-white' }}">
                                {{ $allLabel }}
                            </a>
                            @foreach($sidebarItems as $key => $item)
                                @php
                                    $itemLabel = is_string($item) ? $item : $item;
                                    $itemValue = is_string($key) ? $key : $item;
                                    
                                    $isActive = false;
                                    $urlParams = ['tab' => $tab];
                                    
                                    if ($tab === 'category') {
                                        $isActive = request('search') === $item || request('category') === $item;
                                        $urlParams['category'] = $item;
                                    } elseif ($tab === 'location') {
                                        $isActive = request('location') === $itemValue;
                                        $urlParams['location'] = $itemValue;
                                    } elseif ($tab === 'type') {
                                        $isActive = request('type') === $itemValue;
                                        $urlParams['type'] = $itemValue;
                                    }
                                @endphp
                                <a href="{{ route('jobs.index', $urlParams) }}" 
                                   class="block text-base transition-colors {{ $isActive ? 'text-[#00b6b4] font-bold' : 'text-gray-400 hover:text-white' }}">
                                    {{ $itemLabel }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Search Box (Visible only on Desktop in Sidebar) -->
                    <div class="hidden lg:flex bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-1.5 items-center gap-2 animate-on-scroll cursor-pointer group hover:border-[#00b6b4]/50 transition-colors" onclick="openSearchPopup()">
                        <div class="flex-1 px-6 py-4 text-[#9ca3af] select-none text-[0.9375rem]">
                            Search all Jobs
                        </div>
                        <div class="p-4 text-gray-500 group-hover:text-[#00b6b4] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Newsletter Signup (Visible only on Desktop in Sidebar) -->
                    <div class="hidden lg:block bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-6 lg:p-8 backdrop-blur-sm animate-on-scroll">
                        <h3 class="font-bold text-white mb-3">
                            Sign-up to stay updated
                        </h3>
                        <p class="text-[#9ca3af] mb-8 text-[0.9375rem]">
                            Get the latest AI jobs in your inbox every Monday.
                        </p>
                        <form action="#" method="POST" class="space-y-5">
                            <input 
                                type="email" 
                                placeholder="Email Address" 
                                class="w-full px-6 py-4 bg-[#1f1f1f] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#333333] focus:border-[#00b6b4]"
                                required
                            >
                            <button 
                                type="submit" 
                                class="newsletter-subscribe-btn"
                            >
                                Subscribe
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Job List (2/3) -->
                <div class="lg:col-span-2 space-y-6 order-1 lg:order-2">
                    
                    <!-- Search Box (Visible only on Mobile at Top) -->
                    <div class="lg:hidden bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-1.5 flex items-center gap-2 animate-on-scroll cursor-pointer group hover:border-[#00b6b4]/50 transition-colors" onclick="openSearchPopup()">
                        <div class="flex-1 px-6 py-4 text-[#9ca3af] select-none text-[0.9375rem]">
                            Search all Jobs
                        </div>
                        <div class="p-4 text-gray-500 group-hover:text-[#00b6b4] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>

                    <div id="jobs-container" class="lg:!mt-0 space-y-4 animate-on-scroll">
                        @if($jobs->count() > 0)
                            @include('jobs.partials.job-card', ['jobs' => $jobs])
                        @else
                            <div class="text-center py-24 bg-[#2b2b2b]/30 rounded-2xl border border-[#333333]">
                                <p class="text-gray-500 font-medium text-[0.9375rem]">Aucune offre trouvée.</p>
                                <a href="{{ route('jobs.index') }}" class="text-[#00b6b4] hover:underline mt-6 inline-block font-bold">Voir toutes les offres</a>
                            </div>
                        @endif
                    </div>

                    <!-- Pagination / Show More -->
                    @if($jobs->hasMorePages())
                    <div class="text-center pt-8">
                        <button 
                            id="show-more-btn" 
                            class="px-8 py-3 bg-transparent border border-[#333333] text-white rounded-xl hover:bg-[#333333] transition-colors font-semibold"
                            data-page="2"
                        >
                            Voir plus d'offres
                        </button>
                    </div>
                    @endif

                    <!-- Newsletter Signup (Visible only on Mobile at Bottom) -->
                    <div class="lg:hidden bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-6 lg:p-8 backdrop-blur-sm animate-on-scroll mt-12">
                        <h3 class="font-bold text-white mb-3">
                            Sign-up to stay updated
                        </h3>
                        <p class="text-[#9ca3af] mb-8 text-[0.9375rem]">
                            Get the latest AI jobs in your inbox every Monday.
                        </p>
                        <form action="#" method="POST" class="space-y-5">
                            <input 
                                type="email" 
                                placeholder="Email Address" 
                                class="w-full px-6 py-4 bg-[#1f1f1f] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#333333] focus:border-[#00b6b4]"
                                required
                            >
                            <button 
                                type="submit" 
                                class="newsletter-subscribe-btn"
                            >
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@include('components.footer')

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Animation for job cards if needed */
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate hero characters with stagger
    const heroChars = document.querySelectorAll('.jobs-hero .hero-char');
    heroChars.forEach((char, index) => {
        char.style.animationDelay = (index * 0.035) + 's';
    });
    
    // Animate subtitle after title
    const subtitle = document.querySelector('.jobs-hero .hero-subtitle-animate');
    if (subtitle) {
        subtitle.style.animationDelay = (heroChars.length * 0.035 + 0.2) + 's';
    }

    // Intersection Observer for scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all elements with animation class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    const showMoreBtn = document.getElementById('show-more-btn');
    const jobsContainer = document.getElementById('jobs-container');
    
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            const page = this.dataset.page;
            this.textContent = 'Chargement...';
            this.disabled = true;
            
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.html) {
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    const newCards = tempDiv.querySelectorAll('.job-card-link');
                    
                    newCards.forEach(card => {
                        jobsContainer.appendChild(card);
                    });
                }
                
                if (data.hasMore) {
                    this.dataset.page = data.nextPage;
                    this.textContent = 'Voir plus d\'offres';
                    this.disabled = false;
                } else {
                    this.remove();
                }
            })
            .catch(err => {
                console.error(err);
                this.textContent = 'Voir plus d\'offres';
                this.disabled = false;
            });
        });
    }
});
</script>

@endsection
