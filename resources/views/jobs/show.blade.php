@extends('layouts.app')

@section('title', $job->title . ' - ' . $job->company->name . ' | OMPLEO')
@section('description', 'Découvrez cette offre d\'emploi : ' . $job->title . ' chez ' . $job->company->name)

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-[#1f1f1f] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="bg-[#1a1a1a] pt-32 pb-12 relative overflow-hidden z-10 job-details-hero">
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
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1200px;">
            <!-- Breadcrumbs -->
            <div class="flex items-center gap-2 text-[#9ca3af] text-sm mb-8 hero-subtitle-animate" style="animation-delay: 0.1s;">
                <a href="{{ route('jobs.index') }}" class="hover:text-[#00b6b4] transition-colors">All Jobs</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-white">{{ $job->title }}</span>
            </div>

            <div class="mb-8">
                <h1 class="font-bold text-white mb-6 leading-[1.1] tracking-tighter" style="font-size: 0;">
                    @php
                        if (!function_exists('renderAnimateTextJob')) {
                            function renderAnimateTextJob($text) {
                                $words = explode(' ', $text);
                                $output = '';
                                foreach ($words as $wIndex => $word) {
                                    $output .= '<span style="white-space:nowrap; font-size: 0;">';
                                    $chars = mb_str_split($word);
                                    foreach ($chars as $char) {
                                        $output .= '<span class="hero-char text-5xl md:text-7xl" style="display: inline-block;">' . $char . '</span>';
                                    }
                                    $output .= '</span>';
                                    if ($wIndex < count($words) - 1) {
                                        $output .= '<span class="text-5xl md:text-7xl">&nbsp;</span>';
                                    }
                                }
                                return $output;
                            }
                        }
                    @endphp
                    {!! renderAnimateTextJob($job->title) !!}
                </h1>
                
                <!-- Company Row -->
                <div class="flex items-center gap-4 mb-6 hero-subtitle-animate" style="animation-delay: 0.4s;">
                    <div class="w-10 h-10 bg-[#2b2b2b] rounded-lg border border-[#333333] flex items-center justify-center overflow-hidden">
                        @if($job->company->logo)
                            <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#00b6b4] to-[#009e9c] flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($job->company->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <span class="text-2xl font-bold text-white">{{ $job->company->name }}</span>
                </div>

                <!-- Metadata Row -->
                <div class="flex flex-wrap items-center gap-4 text-[#9ca3af] text-lg hero-subtitle-animate" style="animation-delay: 0.6s;">
                    <span>{{ $job->tags[0] ?? 'General' }}</span>
                    <span class="text-[#333333]">|</span>
                    <span>{{ $job->type }}</span>
                    <span class="text-[#333333]">|</span>
                    <span>{{ ucfirst($job->work_type) }}</span>
                    @if($job->salary_min)
                        <span class="text-[#333333]">|</span>
                        <span>
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
    <section class="pt-20 pb-20 relative z-10">
        <div class="mx-auto px-4 sm:px-6 lg:px-8" style="max-width: 1200px;">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Role Details (2/3) -->
                <div class="lg:col-span-2 space-y-12 animate-on-scroll">
                    <!-- Intro -->
                    <div class="prose prose-invert prose-lg max-w-none text-[#9ca3af]">
                        <p class="text-xl">
                            We are looking to find a skilled <strong class="text-white">{{ $job->title }}</strong> to join our growing team@if($job->tags) in the <strong class="text-white">{{ $job->tags[0] }}</strong> department@endif.
                        </p>
                        <p>
                            {!! nl2br(e($job->description)) !!}
                        </p>
                    </div>

                    <!-- Responsibilities -->
                    @if($job->responsibilities && count($job->responsibilities) > 0)
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6">Responsibilities:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-lg">
                            @foreach($job->responsibilities as $resp)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2.5 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $resp }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Requirements -->
                    @if($job->requirements && count($job->requirements) > 0)
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6">Requirements:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-lg">
                            @foreach($job->requirements as $req)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2.5 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $req }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Perks -->
                    @if($job->benefits && count($job->benefits) > 0)
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-6">Perks:</h3>
                        <ul class="space-y-4 text-[#9ca3af] text-lg">
                            @foreach($job->benefits as $benefit)
                                <li class="flex items-start gap-3">
                                    <span class="mt-2.5 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                    <span>{{ $benefit }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex flex-row items-center gap-6 pt-8">
                        @auth
                            @if(auth()->user()->user_type === 'candidate')
                                @if($existingApplication)
                                    <button disabled class="px-8 py-4 bg-gray-600 text-white rounded-full font-bold opacity-50 cursor-not-allowed w-fit">
                                        Candidature envoyée
                                    </button>
                                @else
                                    <a href="{{ route('applications.create', $job) }}" class="btn-premium-green">
                                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="brightness-0 invert" alt="">
                                        Apply now
                                    </a>
                                @endif
                            @else
                                <div class="px-8 py-4 bg-[#2b2b2b] text-[#9ca3af] rounded-full font-bold text-center border border-[#333333] w-fit">
                                    Log in as candidate to apply
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-premium-green">
                                <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" class="brightness-0 invert" alt="">
                                Apply now
                            </a>
                        @endauth

                        <a href="{{ route('jobs.index') }}" class="btn-premium-dark">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l9-9m-9 9l9 9"></path>
                            </svg>
                            Back to all jobs
                        </a>
                    </div>

                    <!-- Recent Jobs Section -->
                    @if(isset($recentJobs) && $recentJobs->count() > 0)
                    <div class="pt-20">
                        <div class="mb-8">
                            <h3 class="text-3xl font-bold text-white">Recent Jobs</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($recentJobs as $rJob)
                            <a href="{{ route('jobs.show', $rJob->slug) }}" class="block p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1" style="background: rgba(43, 43, 43, 0.73); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08);">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-[#333333] rounded-lg overflow-hidden flex-shrink-0">
                                            @if($rJob->company->logo)
                                                <img src="{{ asset('storage/' . $rJob->company->logo) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-[#00b6b4] flex items-center justify-center text-white font-bold text-xs">
                                                    {{ strtoupper(substr($rJob->company->name, 0, 2)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="text-xl font-bold text-white">{{ $rJob->title }}</h4>
                                            <p class="text-[#9ca3af]">{{ $rJob->company->name }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-white font-semibold">{{ $rJob->salary_min ? number_format($rJob->salary_min, 0, ',', ' ') . ' DA' : 'Confidential' }}</p>
                                        <p class="text-[#9ca3af] text-sm">{{ $rJob->type }} • {{ $rJob->location }}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-8 flex justify-start">
                            <a href="{{ route('jobs.index') }}" class="btn-premium-green">
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
