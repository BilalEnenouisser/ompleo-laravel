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

            <div class="mb-4 md:mb-8">
                <h1 class="font-bold text-white mb-4 md:mb-6 leading-[1.1] tracking-tighter" style="font-size: 0;">
                    @php
                        if (!function_exists('renderAnimateTextJob')) {
                            function renderAnimateTextJob($text) {
                                $words = explode(' ', $text);
                                $output = '';
                                foreach ($words as $wIndex => $word) {
                                    $output .= '<span style="white-space:nowrap; font-size: 0;">';
                                    $chars = mb_str_split($word);
                                    foreach ($chars as $char) {
                                        $output .= '<span class="hero-char text-3xl md:text-7xl" style="display: inline-block;">' . $char . '</span>';
                                    }
                                    $output .= '</span>';
                                    if ($wIndex < count($words) - 1) {
                                        $output .= '<span class="text-3xl md:text-7xl">&nbsp;</span>';
                                    }
                                }
                                return $output;
                            }
                        }
                    @endphp
                    {!! renderAnimateTextJob($job->title) !!}
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
                    <span class="text-xl md:text-2xl font-bold text-white">{{ $job->company->name }}</span>
                </div>

                <!-- Metadata Row -->
                <div class="flex flex-wrap items-center gap-2 md:gap-4 text-[#9ca3af] text-sm md:text-base hero-subtitle-animate" style="animation-delay: 0.6s;">
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Role Details (2/3) -->
                <div class="lg:col-span-2 space-y-10 md:space-y-12 animate-on-scroll">
                    <!-- Intro -->
                    <div class="max-w-none text-[#9ca3af] text-base leading-relaxed space-y-6">
                        <p>
                            We are seeking a skilled <strong class="text-white">{{ $job->title }}</strong> to join our growing team in the <strong class="text-white">Development</strong> department.
                        </p>
                        <p>
                            This role is ideal for professionals who are excited about working on cutting-edge AI projects and who thrive in collaborative environments.
                        </p>
                    </div>

                    <!-- Responsibilities -->
                    <div>
                        <h3 class="text-base font-bold text-white mb-6">Responsibilities:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-base leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Collaborate with cross-functional teams to align on project goals and requirements.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Design, develop, and deploy features or models relevant to the role.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Contribute to ongoing improvement of systems, tools, or customer experience.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Stay informed on industry trends and emerging technologies.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Requirements -->
                    <div>
                        <h3 class="text-base font-bold text-white mb-6">Requirements:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-base leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Proven experience in the relevant field or function.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Strong understanding of tools, techniques, or technologies specific to the job.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Excellent communication and collaboration skills.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Ability to work in a fast-paced, dynamic environment.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Perks -->
                    <div>
                        <h3 class="text-base font-bold text-white mb-6">Perks:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-base leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Flexible work environment (remote options available).</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Competitive salary and equity package.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Learning and development budget.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                <span>Inclusive, innovative team culture.</span>
                            </li>
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

                    <!-- Recent Jobs Section -->
                    @if(isset($recentJobs) && $recentJobs->count() > 0)
                    <div class="pt-20">
                        <div class="mb-8 pb-4">
                            <div class="flex items-center gap-2 mb-3">
                                <img src="{{ asset('storage/home_page/job/icon.svg') }}" alt="Icon" class="w-6 h-6">
                                <span class="text-base font-medium" style="color: #d9d9d9;">Offres récentes</span>
                            </div>
                            <h3 class="text-3xl font-bold text-white">Emplois récents</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($recentJobs as $rJob)
                            <a href="{{ route('jobs.show', $rJob->slug) }}" class="block job-card-link">
                                <div class="p-[1px] hover:opacity-90 transition-opacity duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px; cursor: pointer;">
                                    <div class="p-6 transition-all duration-300 job-card-inner" style="background-color: #212221; border-radius: 12px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);">
                                        <!-- Row 1: Logo, Job Title + Company -->
                                        <div class="flex items-start gap-4 md:gap-6 mb-4">
                                            <!-- Logo -->
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

                                            <!-- Title and Company -->
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg md:text-xl font-bold text-white mb-1 truncate">
                                                    {{ $rJob->title }}
                                                </h3>
                                                <p class="text-gray-400 text-sm">
                                                    {{ $rJob->company ? $rJob->company->name : 'Entreprise non spécifiée' }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Row 2: Details and Posted Date -->
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 md:gap-4 pt-2 md:pt-0 border-t border-white/5 md:border-none">
                                            <!-- Left: Keywords | Type | City -->
                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-gray-400">
                                                <span class="whitespace-nowrap">{{ is_array($rJob->tags) ? ($rJob->tags[0] ?? 'General') : ($rJob->tags ?: 'General') }}</span>
                                                <span class="text-gray-600">|</span>
                                                <span class="whitespace-nowrap">{{ $rJob->type }}</span>
                                                <span class="text-gray-600">|</span>
                                                <span class="whitespace-nowrap">{{ $rJob->location }}</span>
                                            </div>

                                            <!-- Right: Posted Date / View Job -->
                                            <div class="flex-shrink-0 relative md:min-w-[210px] min-h-[1.5rem] job-card-date-container">
                                                <!-- Posted Date (default) -->
                                                <p class="text-sm text-gray-400 job-card-date">
                                                    Posted on: {{ $rJob->created_at->format('M d, Y') }}
                                                </p>
                                                <!-- View Job (on hover) -->
                                                <p class="text-sm text-[#00fadc] font-medium job-card-view">
                                                    <span>Voir l'offre</span>
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
                        <div class="mt-8 flex justify-center sm:justify-start">
                            <a href="{{ route('jobs.index') }}" class="btn-premium-green !w-full sm:!w-auto justify-center">
                                Show all jobs
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar (1/3) -->
                <div class="lg:col-span-1">
                    <div class="space-y-8">
                        <!-- Search Box -->
                        <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-2 flex items-center gap-2 animate-on-scroll">
                            <div class="flex-1 relative">
                                <form action="{{ route('jobs.index') }}" method="GET">
                                    <input 
                                        type="text" 
                                        name="search"
                                        placeholder="Search all Jobs" 
                                        class="w-full px-6 py-4 bg-transparent text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl"
                                    >
                                </form>
                            </div>
                            <button class="p-4 text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Job Summary Card -->
                        <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-8 backdrop-blur-sm animate-on-scroll">
                            <h3 class="text-xl font-bold text-white mb-2">{{ $job->title }}</h3>
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
                        <div class="bg-[#2b2b2b]/50 border border-[#333333] rounded-2xl p-8 backdrop-blur-sm animate-on-scroll">
                            <h3 class="text-xl font-bold text-white mb-3">
                                Sign-up to stay updated
                            </h3>
                            <p class="text-[#9ca3af] mb-8 text-base">
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
                                    class="w-full px-8 py-4 bg-transparent border border-[#333333] text-white rounded-xl font-bold hover:bg-[#333333] transition-all"
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
