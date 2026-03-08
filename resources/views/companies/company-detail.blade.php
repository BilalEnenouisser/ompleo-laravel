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
    <section class="bg-[#1a1a1a] pt-32 pb-12 relative overflow-hidden z-10">
        <div class="mx-auto px-4 md:px-5" style="max-width: 1200px;">
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
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-4">
                    {{ $company->name }}
                </h1>

                <!-- Description -->
                <p class="text-lg text-[#9ca3af] mb-6 leading-relaxed max-w-3xl">
                    {{ $company->description ?? 'Découvrez les opportunités chez ' . $company->name }}
                </p>

                <!-- Visit Website Button -->
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-[#00b6b4] hover:bg-[#009999] text-white rounded-lg transition-colors font-semibold">
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
    <section class="relative z-10" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="rounded-2xl overflow-hidden border border-[#333333] mb-12">
            <img src="{{ asset('storage/' . $company->image) }}" alt="{{ $company->name }}" class="w-full h-48 md:h-64 object-cover">
        </div>
    </section>
    @endif

    <!-- Jobs Section with Sidebar -->
    <section class="py-12 relative z-10">
        <div class="mx-auto px-4 md:px-5" style="max-width: 1200px;">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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
                    <div class="space-y-4 animate-on-scroll">
                        @foreach($jobs as $job)
                        <a href="{{ route('jobs.show', $job->slug) }}" class="block p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1 job-card-link" style="background: rgba(43, 43, 43, 0.73); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08);">
                            <style>
                                .job-card-link {
                                    position: relative;
                                }
                                .job-card-link:hover {
                                    border-color: rgba(0, 250, 220, 0.3);
                                }
                                .job-card-date {
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                    opacity: 1;
                                    transform: translateX(0);
                                    transition: opacity 0.3s ease, transform 0.3s ease;
                                    position: absolute;
                                    top: 0;
                                    right: 0;
                                }
                                .job-card-view {
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                    opacity: 0;
                                    transform: translateX(10px);
                                    transition: opacity 0.3s ease, transform 0.3s ease;
                                    position: absolute;
                                    top: 0;
                                    right: 0;
                                }
                                .job-card-link:hover .job-card-date {
                                    opacity: 0;
                                    transform: translateX(-10px);
                                }
                                .job-card-link:hover .job-card-view {
                                    opacity: 1;
                                    transform: translateX(0);
                                }
                            </style>

                            <!-- Row 1: Logo, Title + Company, Featured Badge -->
                            <div class="flex items-start gap-6 mb-4">
                                <!-- Logo -->
                                <div class="flex-shrink-0">
                                    @if($job->company && $job->company->logo)
                                        <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-16 h-16 rounded-lg object-cover">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00fadc] flex items-center justify-center">
                                            <span class="text-white font-bold text-xl">
                                                {{ $job->company ? strtoupper(substr($job->company->name, 0, 1)) : 'J' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Title and Company -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-white mb-1">
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

                            <!-- Row 2: Details and Posted Date -->
                            <div class="flex items-center justify-between">
                                <!-- Details -->
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400">
                                    @if($job->tags && is_array($job->tags) && count($job->tags) > 0)
                                        <span>{{ implode(', ', array_slice($job->tags, 0, 2)) }}</span>
                                        <span class="text-gray-600">|</span>
                                    @endif
                                    <span>{{ $job->work_type ?? $job->type ?? 'Full Time' }}</span>
                                    <span class="text-gray-600">|</span>
                                    <span>{{ $job->location }}</span>
                                    <span class="text-gray-600">|</span>
                                    <span>
                                        @if($job->salary_min && $job->salary_max)
                                            {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA/year
                                        @elseif($job->salary_min)
                                            À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA/year
                                        @else
                                            Salaire non spécifié
                                        @endif
                                    </span>
                                </div>

                                <!-- Date / View Job -->
                                <div class="flex-shrink-0 relative" style="min-width: 210px; min-height: 1.5rem;">
                                    <p class="text-sm text-gray-400 job-card-date">
                                        Posted on: {{ $job->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="text-sm text-[#00fadc] font-medium job-card-view">
                                        <span>View Job</span>
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </p>
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
                <div class="lg:col-span-1 space-y-6">
                    <!-- Search All Jobs -->
                    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 animate-on-scroll">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.3-4.3"/>
                            </svg>
                            <span>Search all Jobs</span>
                        </h3>
                        <form action="{{ route('jobs.index') }}" method="GET">
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="search"
                                    id="jobSearchInput" 
                                    placeholder="Search jobs..." 
                                    class="w-full px-4 py-3 pr-12 bg-[#1f1f1f] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#00b6b4]"
                                    autocomplete="off"
                                >
                                <button 
                                    type="submit" 
                                    class="absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-lg transition-colors hover:bg-[#00b6b4]/20"
                                >
                                    <svg class="w-6 h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"/>
                                        <path d="m21 21-4.3-4.3"/>
                                    </svg>
                                </button>
                                <!-- Dropdown Results -->
                                <div id="searchResults" class="absolute z-50 w-full mt-2 bg-[#2b2b2b] border border-[#00b6b4] rounded-xl shadow-lg max-h-80 overflow-y-auto hidden">
                                </div>
                            </div>
                        </form>
                    </div>

                    <script>
                        const searchInput = document.getElementById('jobSearchInput');
                        const searchResults = document.getElementById('searchResults');
                        let searchTimeout;

                        searchInput.addEventListener('input', function() {
                            const query = this.value.trim();
                            
                            clearTimeout(searchTimeout);
                            
                            if (query.length < 1) {
                                searchResults.classList.add('hidden');
                                return;
                            }
                            
                            searchTimeout = setTimeout(() => {
                                fetch(`/api/jobs?search=${encodeURIComponent(query)}&per_page=8`)
                                    .then(response => response.json())
                                    .then(result => {
                                        const jobs = result.data?.data || [];
                                        if (jobs.length > 0) {
                                            let html = '';
                                            jobs.forEach(job => {
                                                html += `
                                                    <a href="/jobs/${job.slug}" class="block px-4 py-3 hover:bg-[#1f1f1f] border-b border-[#333333] last:border-b-0 transition-colors">
                                                        <div class="flex items-start gap-3">
                                                            ${job.company && job.company.logo ? 
                                                                `<img src="/storage/${job.company.logo}" alt="${job.company.name}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0">` :
                                                                `<div class="w-10 h-10 rounded-lg bg-[#00b6b4]/10 flex items-center justify-center flex-shrink-0">
                                                                    <span class="text-[#00b6b4] font-bold text-sm">${job.company?.name?.charAt(0) || 'J'}</span>
                                                                </div>`
                                                            }
                                                            <div class="flex-1 min-w-0">
                                                                <h4 class="text-white font-semibold text-sm truncate">${job.title}</h4>
                                                                <p class="text-[#9ca3af] text-xs mt-1">${job.company?.name || 'Company'}</p>
                                                                ${job.location ? `<p class="text-[#9ca3af] text-xs">${job.location}</p>` : ''}
                                                            </div>
                                                        </div>
                                                    </a>
                                                `;
                                            });
                                            searchResults.innerHTML = html;
                                            searchResults.classList.remove('hidden');
                                        } else {
                                            searchResults.innerHTML = `
                                                <div class="px-4 py-3 text-[#9ca3af] text-sm">
                                                    No jobs found
                                                </div>
                                            `;
                                            searchResults.classList.remove('hidden');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Search error:', error);
                                        searchResults.classList.add('hidden');
                                    });
                            }, 200);
                        });

                        // Hide results when clicking outside
                        document.addEventListener('click', function(e) {
                            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                                searchResults.classList.add('hidden');
                            }
                        });

                        // Show results when focusing back on input if it has content
                        searchInput.addEventListener('focus', function() {
                            if (this.value.trim().length >= 1 && searchResults.innerHTML) {
                                searchResults.classList.remove('hidden');
                            }
                        });
                    </script>

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
    .job-card-link {
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
    
    .job-card-link:nth-child(1) { animation-delay: 0s; }
    .job-card-link:nth-child(2) { animation-delay: 0.1s; }
    .job-card-link:nth-child(3) { animation-delay: 0.2s; }
    .job-card-link:nth-child(4) { animation-delay: 0.3s; }
    .job-card-link:nth-child(5) { animation-delay: 0.4s; }
    .job-card-link:nth-child(n+6) { animation-delay: 0.5s; }
</style>
@endsection
