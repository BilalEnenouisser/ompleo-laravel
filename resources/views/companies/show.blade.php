@extends('layouts.app')

@section('title', $company->name . ' - OMPLEO')
@section('description', $company->description ?? 'Découvrez les offres d\'emploi de ' . $company->name)

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-gray-50 dark:bg-[#1f1f1f]">
    <!-- Banner Section -->
    <div class="relative h-64 bg-gradient-to-r from-[#00b6b4] to-[#009e9c] overflow-hidden">
        @if($company->banner_image)
        <img
            src="{{ asset('storage/' . $company->banner_image) }}"
            alt="{{ $company->name }}"
            class="w-full h-full object-cover opacity-20"
        />
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-[#00b6b4]/80 to-[#009e9c]/80"></div>
    </div>

    <!-- Company Header -->
    <div class="relative -mt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl shadow-xl p-8 border border-gray-100 dark:border-[#333333]">
                <div class="flex flex-col lg:flex-row lg:items-start gap-8">
                    <!-- Left Content -->
                    <div class="flex-1">
                        <!-- Mobile Layout -->
                        <div class="block lg:hidden text-center mb-6">
                            <!-- Company Image -->
                            <div class="w-32 h-32 rounded-2xl overflow-hidden bg-gray-100 dark:bg-[#333333] mx-auto mb-6">
                                @if($company->logo)
                                <img
                                    src="{{ asset('storage/' . $company->logo) }}"
                                    alt="{{ $company->name }}"
                                    class="w-full h-full object-cover"
                                />
                                @else
                                <div class="w-full h-full bg-[#00b6b4] flex items-center justify-center text-white font-bold text-3xl">
                                    {{ substr($company->name, 0, 2) }}
                                </div>
                                @endif
                            </div>
                            
                            <!-- Company Name -->
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                                {{ $company->name }}
                            </h1>
                            
                            <!-- Company Description -->
                            <div class="prose prose-lg max-w-none dark:prose-invert text-center mb-6">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                    {{ $company->description }}
                                </p>
                                @if($company->about)
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $company->about }}
                                </p>
                                @endif
                            </div>
                            
                            <!-- Button - Full Width -->
                            <a href="#jobs" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center justify-center gap-2 w-full">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                Postes disponibles
                            </a>
                        </div>

                        <!-- Desktop Layout -->
                        <div class="hidden lg:block">
                            <div class="flex items-start gap-6 mb-6">
                                <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-100 dark:bg-[#333333] flex-shrink-0">
                                    @if($company->logo)
                                    <img
                                        src="{{ asset('storage/' . $company->logo) }}"
                                        alt="{{ $company->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                    @else
                                    <div class="w-full h-full bg-[#00b6b4] flex items-center justify-center text-white font-bold text-2xl">
                                        {{ substr($company->name, 0, 2) }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                        {{ $company->name }}
                                    </h1>
                                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-4">
                                        {{ $company->industry ?? 'Entreprise' }}
                                    </p>
                                    <a href="#jobs" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center gap-2 w-full sm:w-auto justify-center sm:justify-start">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        </svg>
                                        Postes disponibles
                                    </a>
                                </div>
                            </div>

                            <div class="prose prose-lg max-w-none dark:prose-invert">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                    {{ $company->description }}
                                </p>
                                @if($company->about)
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $company->about }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    <div class="lg:w-80">
                        <div class="bg-gray-50 dark:bg-[#333333] rounded-xl p-6 space-y-6 border border-gray-200 dark:border-[#444444]">
                            <div class="grid grid-cols-1 gap-4">
                                @if($company->founded_year)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Fondée en</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->founded_year }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->company_type)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Type d'entreprise</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->company_type }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->size)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 00-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 010 7.75"></path>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Taille</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->size }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->website)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="2" x2="22" y2="22"></line>
                                        <path d="M8.5 8.5a7 7 0 010 7"></path>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Site web</div>
                                        <a href="{{ $company->website }}" target="_blank" class="font-medium text-[#00b6b4] hover:text-[#009e9c]">
                                            {{ $company->website }}
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if($company->location)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Localisation</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->location }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->specialisation)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                        <path d="M10 6h4"></path>
                                        <path d="M10 10h4"></path>
                                        <path d="M10 14h4"></path>
                                        <path d="M6 18h.01"></path>
                                        <path d="M6 15h.01"></path>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Spécialisation</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->specialisation }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->years_experience)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                        <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Années d'expérience</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->years_experience }} ans</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->phone)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"></path>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Téléphone</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->phone }}</div>
                                    </div>
                                </div>
                                @endif

                                @if($company->email)
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Email</div>
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $company->email }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Social Links -->
                            @if($company->social_links)
                            <div class="pt-4 border-t border-gray-200 dark:border-[#444444]">
                                <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-3">Réseaux sociaux</h4>
                                <div class="flex gap-3">
                                    @if($company->social_links['facebook'] ?? null)
                                    <a href="{{ $company->social_links['facebook'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white dark:bg-[#444444] border border-gray-200 dark:border-[#555555] flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-blue-600 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    
                                    @if($company->social_links['twitter'] ?? null)
                                    <a href="{{ $company->social_links['twitter'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white dark:bg-[#444444] border border-gray-200 dark:border-[#555555] flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-sky-500 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    
                                    @if($company->social_links['linkedin'] ?? null)
                                    <a href="{{ $company->social_links['linkedin'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white dark:bg-[#444444] border border-gray-200 dark:border-[#555555] flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-blue-700 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    
                                    @if($company->social_links['youtube'] ?? null)
                                    <a href="{{ $company->social_links['youtube'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white dark:bg-[#444444] border border-gray-200 dark:border-[#555555] flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-red-600 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    
                                    @if($company->social_links['github'] ?? null)
                                    <a href="{{ $company->social_links['github'] }}" target="_blank" class="w-10 h-10 rounded-lg bg-white dark:bg-[#444444] border border-gray-200 dark:border-[#555555] flex items-center justify-center text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Map Placeholder -->
                            @if($company->location)
                            <div class="pt-4 border-t border-gray-200 dark:border-[#444444]">
                                <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-3">Localisation</h4>
                                <div class="w-full h-32 bg-gray-200 dark:bg-[#444444] rounded-lg flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Jobs Section -->
    @if($company->jobs && $company->jobs->count() > 0)
    <section id="jobs" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-8">Postes disponibles</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($company->jobs as $job)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 dark:border-[#333333]">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $job->title }}</h3>
                    <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-4">
                        <span class="bg-[#00b6b4]/10 text-[#00b6b4] px-2 py-1 rounded">{{ $job->type ?? 'CDI' }}</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            {{ $job->location }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="font-medium text-gray-900 dark:text-gray-100">
                            @if($job->salary_min && $job->salary_max)
                                {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                            @elseif($job->salary_min)
                                À partir de {{ number_format($job->salary_min) }} DA
                            @else
                                À négocier
                            @endif
                        </span>
                        <a href="{{ route('jobs.show', $job->slug) }}" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Postuler
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<!-- Footer -->
@include('components.footer')
@endsection
