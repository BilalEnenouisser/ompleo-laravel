@extends('layouts.app')

@section('title', $company->name . ' - OMPLEO')
@section('description', $company->description ?? 'Découvrez les opportunités chez ' . $company->name)

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="min-h-screen bg-[#1f1f1f] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="platform-section relative overflow-hidden z-10 hero-section-balanced">
        <div class="platform-container">
            <!-- Company Header - Left Aligned -->
            <div class="mb-6">
                <!-- Logo -->
                <div class="w-20 h-20 bg-[#2b2b2b] rounded-xl border border-[#333333] flex items-center justify-center overflow-hidden mb-6">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-10 h-10 text-[#646464]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                            <path d="M10 6h4"/>
                            <path d="M10 10h4"/>
                            <path d="M10 14h4"/>
                            <path d="M10 18h4"/>
                        </svg>
                    @endif
                </div>

                <!-- Company Name -->
                <h1 class="font-bold text-white mb-4 md:text-5xl lg:text-6xl">
                    {{ $company->name }}
                </h1>

                <!-- Description -->
                <p class="text-[0.9375rem] md:text-lg text-[#9ca3af] mb-6 leading-relaxed max-w-3xl">
                    {{ $company->description ?? 'Découvrez les opportunités chez ' . $company->name }}
                </p>

                <!-- Visit Website Button -->
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="flex w-full md:inline-flex md:w-auto items-center justify-center gap-2 px-6 py-3 min-h-[48px] bg-[#00b6b4] hover:bg-[#009999] text-white rounded-full md:rounded-lg transition-colors font-semibold">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Visit Company Website
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Company Image/Banner (if available) -->
    @if($company->image)
    <section class="platform-container relative z-10">
        <div class="rounded-2xl overflow-hidden border border-[#333333] mb-12">
            <img src="{{ asset('storage/' . $company->image) }}" alt="{{ $company->name }}" class="w-full h-48 md:h-64 object-cover">
        </div>
    </section>
    @endif

    <!-- Jobs Section with Sidebar -->
    <section class="platform-section relative z-10 !pt-0 !pb-12">
        <div class="platform-container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Left: Jobs List (2/3) -->
                <div class="lg:col-span-2">
                    <!-- Breadcrumb above cards -->
                    <div class="flex items-center gap-2 text-[#9ca3af] text-sm mb-6">
                        <a href="{{ route('companies.index') }}" class="hover:text-[#00b6b4] transition-colors">All Companies</a>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-white">{{ $company->name }}</span>
                    </div>

                    <!-- Jobs Cards -->
                    @if($jobs->count() > 0)
                    <style>
                        /* Same sophisticated hover logic as home page */
                        .company-detail-job-card .job-card-date-container {
                            position: relative;
                            min-height: 1.5rem;
                        }
                        .company-detail-job-card .job-card-date {
                            display: flex;
                            align-items: center;
                            justify-content: flex-end;
                            transition: opacity 0.3s ease, transform 0.3s ease;
                            position: absolute;
                            top: 0;
                            right: 0;
                        }
                        .company-detail-job-card .job-card-view {
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
                        .company-detail-job-card:hover .job-card-date {
                            opacity: 0;
                            transform: translateX(-10px);
                        }
                        .company-detail-job-card:hover .job-card-view {
                            opacity: 1;
                            transform: translateX(0);
                        }
                        
                        /* Mobile override to keep it simple and readable */
                        @media (max-width: 767px) {
                            .company-detail-job-card .job-card-date {
                                position: relative !important;
                                opacity: 1 !important;
                                transform: none !important;
                                justify-content: flex-start !important;
                            }
                            .company-detail-job-card .job-card-view {
                                display: none !important;
                            }
                            .company-detail-job-card .job-card-date-container {
                                min-height: auto !important;
                            }
                        }
                    </style>
                    <div class="space-y-4 animate-on-scroll">
                        @foreach($jobs as $job)
                        <a href="{{ route('jobs.show', $job->slug) }}" class="company-detail-job-card block m-px group relative">
                            <!-- Gradient Border Wrapper -->
                            <div class="p-[1px] transition-all duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px; cursor: pointer;">
                                <div class="p-4 md:p-6 transition-all duration-300 bg-[#2b2b2b] group-hover:bg-[#323432] rounded-xl border border-[#00b6b4]/20 group-hover:border-[#00b6b4]/50">
                                    
                                    <!-- Row 1: Logo, Job Title + Company, Featured Badge -->
                                    <div class="flex items-start gap-4 md:gap-6 mb-6 md:mb-4">
                                        <!-- Logo -->
                                        <div class="flex-shrink-0">
                                            @if($job->company && $job->company->logo)
                                                <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-12 h-12 md:w-16 md:h-16 rounded-lg object-cover">
                                            @else
                                                <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00fadc] flex items-center justify-center">
                                                    <span class="text-white font-bold text-lg md:text-xl">
                                                        {{ $job->company ? strtoupper(substr($job->company->name, 0, 1)) : 'J' }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
            
                                        <!-- Title and Company -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg md:text-xl font-bold text-white mb-1 truncate">
                                                {{ $job->title }}
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                {{ $job->company ? $job->company->name : 'Entreprise non spécifiée' }}
                                            </p>
                                        </div>
            
                                        <!-- Featured Badge -->
                                        @if($job->is_featured)
                                        <div class="flex-shrink-0">
                                            <span class="text-xs font-medium" style="color: #5997E3;">
                                                Featured
                                            </span>
                                        </div>
                                        @endif
                                    </div>
            
                                    <!-- Row 2: Details and Date/View Toggle -->
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 md:gap-4 pt-2 md:pt-0 border-t border-white/5 md:border-none">
                                        <!-- Left: Keywords | Type | City | Salary -->
                                        <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-gray-400">
                                            @if($job->tags && is_array($job->tags) && count($job->tags) > 0)
                                                <span class="whitespace-nowrap">{{ implode(', ', array_slice($job->tags, 0, 2)) }}</span>
                                                <span class="text-gray-600">|</span>
                                            @endif
                                            <span class="whitespace-nowrap">{{ $job->work_type ?? $job->type ?? 'Full Time' }}</span>
                                            <span class="text-gray-600">|</span>
                                            <span class="whitespace-nowrap">{{ $job->location }}</span>
                                            <span class="text-gray-600">|</span>
                                            <span class="whitespace-nowrap">
                                                @if($job->salary_min && $job->salary_max)
                                                    {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA/year
                                                @elseif($job->salary_min)
                                                    À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA/year
                                                @else
                                                    Salaire non spécifié
                                                @endif
                                            </span>
                                        </div>
            
                                        <!-- Right: Posted Date / View Job Toggle -->
                                        <div class="flex-shrink-0 relative md:min-w-[210px] job-card-date-container">
                                            <p class="text-sm text-gray-400 job-card-date">
                                                Posted on: {{ $job->created_at->format('M d, Y') }}
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
                    @else
                    <div class="text-center py-16 bg-[#2b2b2b] border border-[#333333] rounded-2xl">
                        <div class="w-16 h-16 mx-auto mb-4 text-[#646464]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Aucune offre disponible</h3>
                        <p class="text-[#9ca3af]">Cette entreprise n'a pas d'offres d'emploi pour le moment.</p>
                    </div>
                    @endif
                </div>

                <!-- Right: Sidebar (1/3) -->
                <div class="lg:col-span-1 space-y-6 sidebar-desktop-aligned">
                    <!-- Search All Jobs -->
                    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 animate-on-scroll">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                            <span>Search all Jobs</span>
                        </h3>
                        {{-- Same live search modal as home “Rechercher des offres d’emploi” (layouts.app openSearchPopup) --}}
                        <div
                            class="bg-[#1f1f1f] border border-[#00b6b4] rounded-xl p-2 flex items-center gap-2 cursor-pointer hover:border-[#00b6b4]/80 transition-colors select-none"
                            onclick="openSearchPopup()"
                            role="button"
                            tabindex="0"
                            aria-label="Rechercher des offres"
                            onkeydown="if(event.key==='Enter'||event.key===' '){ event.preventDefault(); openSearchPopup(); }"
                        >
                            <div class="flex-1 relative pointer-events-none">
                                <div class="w-full px-4 py-3 text-gray-500 rounded-xl text-left font-medium">
                                    Search jobs...
                                </div>
                            </div>
                            <div class="p-2 text-[#00b6b4] pointer-events-none flex-shrink-0" aria-hidden="true">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.3-4.3"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 animate-on-scroll">
                        <h3 class="text-xl font-bold text-white mb-3">
                            Sign-up to stay updated
                        </h3>
                        <p class="text-[#9ca3af] mb-6 text-sm">
                            Get the latest AI jobs in your inbox every Monday.
                        </p>
                        <form action="#" method="POST" class="space-y-4">
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Email Address" 
                                class="w-full px-4 py-3 bg-[#1f1f1f] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#00b6b4]"
                                required
                            >
                            <button 
                                type="submit" 
                                class="w-full px-6 py-3 text-white rounded-lg font-semibold hover:brightness-90"
                                style="background: linear-gradient(135deg, #1aa2a0, #39fffc); border: 1px solid #47fffd; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);"
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
    /* Job Card Animations */
    .company-detail-job-card {
        opacity: 0;
        transform: translateY(20px);
        animation: jobCardFadeIn 0.5s ease-out forwards;
    }
    
    @keyframes jobCardFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .company-detail-job-card:nth-child(1) { animation-delay: 0s; }
    .company-detail-job-card:nth-child(2) { animation-delay: 0.1s; }
    .company-detail-job-card:nth-child(3) { animation-delay: 0.2s; }
    .company-detail-job-card:nth-child(4) { animation-delay: 0.3s; }
    .company-detail-job-card:nth-child(5) { animation-delay: 0.4s; }
    .company-detail-job-card:nth-child(n+6) { animation-delay: 0.5s; }

    /* Scoped overrides to ensure requested spacing applies */
    .hero-section-balanced {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }
    
    @media (min-width: 1024px) {
        .sidebar-desktop-aligned {
            padding-top: 47px !important;
        }
    }
</style>
@endsection
