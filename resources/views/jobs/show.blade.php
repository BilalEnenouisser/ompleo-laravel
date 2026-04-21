@extends('layouts.app')

@section('title', $job->title . ' - ' . $job->company->name . ' | OMPLEO')
@section('description', 'Découvrez cette offre d\'emploi : ' . $job->title . ' chez ' . $job->company->name)

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-[#212221] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="platform-section relative overflow-hidden z-10 job-details-hero bg-[#151515]">

        <style>
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
            .job-card-date-container { position: relative; min-height: 1.5rem; }
            .job-card-date { display: flex; align-items: center; justify-content: flex-end; transition: opacity 0.3s ease, transform 0.3s ease; position: absolute; top: 0; right: 0; }
            .job-card-view { display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem; opacity: 0; transform: translateX(10px); transition: opacity 0.3s ease, transform 0.3s ease; position: absolute; top: 0; right: 0; }
            .job-card-link:hover .job-card-date { opacity: 0; transform: translateX(-10px); }
            .job-card-link:hover .job-card-view { opacity: 1; transform: translateX(0); }

        </style>
        <div class="platform-container">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-2 text-[#9ca3af] text-xs md:text-sm mb-6 md:mb-8 hero-subtitle-animate" style="animation-delay: 0.1s;">
                <a href="{{ route('jobs.index') }}" class="hover:text-[#00b6b4] transition-colors whitespace-nowrap">All Jobs</a>
                <svg class="w-3 h-3 md:w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white truncate">{{ $job->title }}</span>
            </div>

            <div >
                <h1 class="font-bold text-white mb-4 md:mb-6 leading-[1.1] tracking-tighter" style="font-size: 0;">
                    @php if (!function_exists('renderAnimateTextJob')) { function renderAnimateTextJob($text) { $words = explode(' ', $text); $output = ''; foreach ($words as $wIndex => $word) { $output .= '<span style="white-space:nowrap; font-size: 0;">'; $chars = mb_str_split($word); foreach ($chars as $char) { $output .= '<span class="hero-char md:text-4xl lg:text-7xl" style="display: inline-block;">' . e($char) . '</span>'; } $output .= '</span>'; if ($wIndex < count($words) - 1) { $output .= '<span class="hero-char md:text-4xl lg:text-7xl" style="display: inline-block;">&nbsp;</span>'; } } return $output; } } @endphp
                    {{ clean(renderAnimateTextJob($job->title)) }}
                </h1>
                
                <!-- Company Row -->
                <div class="flex items-center gap-3 md:gap-4 mb-4 md:mb-6 hero-subtitle-animate" style="animation-delay: 0.4s;">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-[#2b2b2b] rounded-lg border border-[#333333] flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if($job->company->logo)
                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#00b6b4] to-[#009e9c] flex items-center justify-center text-white font-bold text-xs md:text-sm">
                                {{ strtoupper(substr($job->company->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <span class="font-bold text-white md:text-2xl">{{ $job->company->name }}</span>
                </div>

                <!-- Metadata Row -->
                <div class="flex flex-wrap items-center gap-2 md:gap-4 text-[#9ca3af] md:text-base text-[0.9375rem] hero-subtitle-animate" style="animation-delay: 0.6s;">
                    <span class="whitespace-nowrap">{{ $job->tags[0] ?? 'General' }}</span>
                    <span class="text-[#333333]">|</span>
                    <span class="whitespace-nowrap">{{ $job->type }}</span>
                    <span class="text-[#333333]">|</span>
                    <span class="whitespace-nowrap">{{ ucfirst($job->work_type) }}</span>
                    <span class="text-[#333333]">|</span>
                    <span class="whitespace-nowrap">{{ $job->location }}</span>
                    @if($job->salary_min)
                        <span class="text-[#333333] hidden md:inline">|</span>
                        <span class="whitespace-nowrap">
                            @if($job->salary_max)
                                {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                            @else
                                From {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                            @endif
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="platform-section relative z-10">
        <div class="platform-container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-12">
                
                <!-- Role Details (2/3) -->
                <div class="lg:col-span-2 space-y-10 md:space-y-12 animate-on-scroll">
                    <!-- Intro -->
                    <div class="max-w-none text-[#9ca3af] text-[0.9375rem] leading-relaxed space-y-6">
                        <p>{{ clean(nl2br(e($job->description))) }}</p>
                    </div>

                    <!-- Responsibilities -->
                    <div>
                        <h3 class="font-bold text-white mb-6">Responsibilities:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-[0.9375rem] leading-relaxed">
                            @php
                                $responsibilities = is_array($job->responsibilities)
                                    ? $job->responsibilities
                                    : preg_split('/\r\n|\r|\n/', (string) $job->responsibilities, -1, PREG_SPLIT_NO_EMPTY);
                            @endphp
                            @forelse($responsibilities as $responsibility)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $responsibility }}</span>
                                </li>
                            @empty
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>Responsibilities will be provided by the recruiter.</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <h3 class="font-bold text-white mb-6">Requirements:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-[0.9375rem] leading-relaxed">
                            @php
                                $requirements = is_array($job->requirements)
                                    ? $job->requirements
                                    : preg_split('/\r\n|\r|\n/', (string) $job->requirements, -1, PREG_SPLIT_NO_EMPTY);
                            @endphp
                            @forelse($requirements as $requirement)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $requirement }}</span>
                                </li>
                            @empty
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>Requirements will be provided by the recruiter.</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Perks -->
                    <div>
                        <h3 class="font-bold text-white mb-6">Perks:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-[0.9375rem] leading-relaxed">
                            @php
                                $benefits = is_array($job->benefits)
                                    ? $job->benefits
                                    : preg_split('/\r\n|\r|\n/', (string) $job->benefits, -1, PREG_SPLIT_NO_EMPTY);
                            @endphp
                            @forelse($benefits as $benefit)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $benefit }}</span>
                                </li>
                            @empty
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>Benefits will be provided by the recruiter.</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 sm:gap-6 pt-8">
                        @auth
                            @if(auth()->user()->user_type === 'candidate')
                                @if($existingApplication)
                                    <button disabled class="px-8 py-4 bg-gray-600 text-white rounded-full font-bold opacity-50 cursor-not-allowed text-center">
                                        Candidature envoyée
                                    </button>
                                @else
                                    <a href="{{ route('applications.create', $job) }}" class="btn-premium-green !w-full sm:!w-auto justify-center">
                                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="brightness-0 invert" alt="">
                                        Apply now
                                    </a>
                                @endif
                            @else
                                <div class="px-8 py-4 bg-[#2b2b2b] text-[#9ca3af] rounded-full font-bold text-center border border-[#333333]">
                                    Log in as candidate to apply
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-premium-green !w-full sm:!w-auto justify-center">
                                <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="brightness-0 invert" alt="">
                                Apply now
                            </a>
                        @endauth

                        <a href="{{ route('jobs.index') }}" class="btn-premium-dark !w-full sm:!w-auto justify-center">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l9-9m-9 9l9 9"></path>
                            </svg>
                            Back to all jobs
                        </a>
                    </div>

                    <!-- Recent jobs — same cards as home “Offres à la une” -->
                    @if(isset($recentJobs) && $recentJobs->count() > 0)
                    <div class="pt-20 recent-jobs-offres-une max-w-4xl">
                        <div class="mb-8 pb-4">
                            <h2 class="font-bold text-white md:text-3xl text-2xl">Offres récentes</h2>
                        </div>
                        <style>
                            .recent-jobs-offres-une .job-card-date-container {
                                position: relative;
                                min-height: 1.5rem;
                            }
                            .recent-jobs-offres-une .job-card-date {
                                display: flex;
                                align-items: center;
                                justify-content: flex-end;
                                transition: opacity 0.3s ease, transform 0.3s ease;
                                position: absolute;
                                top: 0;
                                right: 0;
                            }
                            .recent-jobs-offres-une .job-card-view {
                                display: flex;
                                align-items: center;
                                justify-content: flex-end;
                                gap: 0.5rem;
                                opacity: 0;
                                transform: translateX(10px);
                                transition: opacity 0.3s ease, transform 0.3s ease;
                                position: absolute;
                                top: 0;
                                right: 0;
                            }
                            .recent-jobs-offres-une .job-card-link:hover .job-card-date {
                                opacity: 0;
                                transform: translateX(-10px);
                            }
                            .recent-jobs-offres-une .job-card-link:hover .job-card-view {
                                opacity: 1;
                                transform: translateX(0);
                            }
                            @media (max-width: 767px) {
                                .recent-jobs-offres-une .job-card-date-container {
                                    position: relative !important;
                                    min-height: 1.5rem !important;
                                    width: 100% !important;
                                    display: block !important;
                                }
                                .recent-jobs-offres-une .job-card-date {
                                    position: absolute !important;
                                    top: 0 !important;
                                    left: 0 !important;
                                    right: auto !important;
                                    justify-content: flex-start !important;
                                }
                                .recent-jobs-offres-une .job-card-view {
                                    position: absolute !important;
                                    top: 0 !important;
                                    left: 0 !important;
                                    right: auto !important;
                                    justify-content: flex-start !important;
                                }
                            }
                        </style>
                        <div class="space-y-4">
                            @foreach($recentJobs as $rJob)
                            <a href="{{ route('jobs.show', $rJob->slug) }}" class="block job-card-link group">
                                <div class="p-[1px] transition-colors duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px; cursor: pointer;">
                                    <div class="p-4 md:p-6 transition-all duration-300 job-card-inner bg-[#2b2b2b] group-hover:bg-[#323432] rounded-xl border border-transparent group-hover:border-[#00b6b4]/30">
                                        <div class="flex items-start gap-4 md:gap-6 mb-6 md:mb-4">
                                            <div class="flex-shrink-0">
                                                @if($rJob->company && $rJob->company->logo)
                                                    <img src="{{ Storage::url($rJob->company->logo) }}" alt="{{ $rJob->company->name }}" class="w-12 h-12 md:w-16 md:h-16 rounded-lg object-cover">
                                                @else
                                                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00fadc] flex items-center justify-center">
                                                        <span class="text-white font-bold text-lg md:text-xl">
                                                            {{ $rJob->company ? strtoupper(substr($rJob->company->name, 0, 1)) : 'J' }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg md:text-xl font-bold text-white mb-1 truncate">
                                                    {{ $rJob->title }}
                                                </h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{ $rJob->company ? $rJob->company->name : 'Entreprise non spécifiée' }}
                                                </p>
                                            </div>
                                            @if($rJob->is_featured)
                                            <div class="flex-shrink-0">
                                                <span class="text-xs font-medium" style="color: #5997E3;">Featured</span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 md:gap-4 pt-2 md:pt-0 border-t border-white/5 md:border-none">
                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-gray-400">
                                                @if($rJob->tags && is_array($rJob->tags) && count($rJob->tags) > 0)
                                                    <span class="whitespace-nowrap">{{ implode(', ', array_slice($rJob->tags, 0, 2)) }}</span>
                                                    <span class="text-gray-600">|</span>
                                                @endif
                                                <span class="whitespace-nowrap">{{ $rJob->work_type ?? $rJob->type ?? 'Full Time' }}</span>
                                                <span class="text-gray-600">|</span>
                                                <span class="whitespace-nowrap">{{ $rJob->location }}</span>
                                                <span class="text-gray-600">|</span>
                                                <span class="whitespace-nowrap">
                                                    @if($rJob->salary_min && $rJob->salary_max)
                                                        {{ number_format($rJob->salary_min, 0, ',', ' ') }} - {{ number_format($rJob->salary_max, 0, ',', ' ') }} DA/year
                                                    @elseif($rJob->salary_min)
                                                        À partir de {{ number_format($rJob->salary_min, 0, ',', ' ') }} DA/year
                                                    @else
                                                        Salaire non spécifié
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex-shrink-0 relative md:min-w-[210px] min-h-[1.5rem] job-card-date-container">
                                                <p class="text-sm text-gray-400 job-card-date">
                                                    Posted on: {{ $rJob->created_at->format('M d, Y') }}
                                                </p>
                                                <p class="text-sm text-[#00fadc] font-medium job-card-view">
                                                    <span>View Job</span>
                                                    <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-12 text-left">
                            <a href="{{ route('jobs.index') }}" class="btn-premium-green justify-center sm:justify-start">
                                <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon">
                                <span>Voir toutes les offres</span>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar (1/3) -->
                <div class="lg:col-span-1">
                    <div class="space-y-8">
                        <!-- Search — opens same live search modal as home “Rechercher des offres d’emploi” -->
                        <div
                            class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-2 flex items-center gap-2 animate-on-scroll cursor-pointer hover:border-[#00b6b4]/40 transition-colors select-none"
                            onclick="openSearchPopup()"
                            role="button"
                            tabindex="0"
                            aria-label="Rechercher des offres"
                            onkeydown="if(event.key==='Enter'||event.key===' '){ event.preventDefault(); openSearchPopup(); }"
                        >
                            <div class="flex-1 relative pointer-events-none">
                                <div class="w-full px-6 py-4 text-gray-500 rounded-xl text-left font-medium">
                                    Search all Jobs
                                </div>
                            </div>
                            <div class="p-4 text-gray-500 pointer-events-none flex-shrink-0" aria-hidden="true">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Job Summary Card -->
                        <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-6 lg:p-8 backdrop-blur-sm animate-on-scroll">
                            <h3 class="font-bold text-white mb-2">{{ $job->title }}</h3>
                            <p class="text-[#00b6b4] font-semibold mb-6">{{ $job->company->name }}</p>
                            
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-[#333333] rounded-lg flex items-center justify-center overflow-hidden">
                                    @if($job->company->logo)
                                        <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-[#00b6b4] flex items-center justify-center text-white font-bold text-xs">
                                            {{ strtoupper(substr($job->company->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-lg font-semibold text-white">{{ $job->company->name }}</span>
                            </div>

                            <div class="text-[#9ca3af] mb-8">
                                Job posted on: <span class="text-white">{{ $job->created_at->format('M d, Y') }}</span>
                            </div>

                            @auth
                                @if(auth()->user()->user_type === 'candidate')
                                    @if(!$existingApplication)
                                        <a href="{{ route('applications.create', $job) }}" class="w-full block text-center px-8 py-4 bg-[#00b6b4] text-white rounded-full font-bold hover:bg-[#009999] transition-all flex items-center justify-center gap-3">
                                            <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="w-5 h-5 brightness-0 invert" alt="">
                                            Apply now
                                        </a>
                                    @else
                                        <button disabled class="w-full px-8 py-4 bg-gray-600 text-white rounded-full font-bold opacity-50 cursor-not-allowed">
                                            Postulé
                                        </button>
                                    @endif
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn-premium-green !w-full">
                                    <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="brightness-0 invert" alt="">
                                    Apply now
                                </a>
                            @endauth
                        </div>

                        <!-- Newsletter Signup -->
                        <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-6 lg:p-8 backdrop-blur-sm animate-on-scroll">
                            <h3 class="font-bold text-white mb-3">
                                Sign-up to stay updated
                            </h3>
                            <p class="text-[#9ca3af] mb-8 text-[0.9375rem]">
                                Get the latest jobs in your inbox every Monday.
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
        </div>
    </section>
</div>

@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate hero characters with stagger
    const heroChars = document.querySelectorAll('.job-details-hero .hero-char');
    heroChars.forEach((char, index) => {
        char.style.animationDelay = (index * 0.035) + 's';
    });

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
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>

@endsection
