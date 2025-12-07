@extends('layouts.app')

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6" data-animate="hero-title">
                Découvrez l'entreprise faite pour vous
            </h1>
            
        </div>
    </section>


    <!-- Companies Grid -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div id="companiesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($companies as $company)
                    @php
                        $initials = '';
                        if ($company->name) {
                            $nameParts = explode(' ', $company->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1));
                            if (count($nameParts) > 1) {
                                $initials .= strtoupper(substr($nameParts[1], 0, 1));
                            }
                        }
                    @endphp
                    
                    <div class="bg-white dark:bg-[#2b2b2b] rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-[#333333] flex flex-col">
                        {{-- Top Section: Logo on Left, Industry on Right --}}
                        <div class="flex gap-4 mb-4 items-center">
                            {{-- Company Logo on Left --}}
                            <div class="flex-shrink-0">
                                @if($company->logo)
                                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-20 h-20 rounded-lg object-cover">
                                @else
                                    <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                                        <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'C' }}</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Industry/Specialisation on Right --}}
                            <div class="flex-1 min-w-0 flex justify-end">
                                @if($company->industry || $company->specialisation)
                                <div class="flex flex-wrap gap-1.5 justify-end">
                                    @if($company->industry)
                                        <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium">{{ $company->industry }}</span>
                                    @endif
                                    @if($company->specialisation)
                                        <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium">{{ $company->specialisation }}</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Bottom Section: Name, Description, Details --}}
                        <div class="mb-4 flex-1">
                            {{-- Company Name --}}
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1.5">{{ $company->name }}</h3>

                            {{-- Description --}}
                            @if($company->description)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 line-clamp-2 leading-relaxed">{{ $company->description }}</p>
                            @endif

                            {{-- Location --}}
                            @if($company->location)
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>{{ $company->location }}</span>
                            </div>
                            @endif

                            {{-- Company Size --}}
                            @if($company->size)
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>{{ $company->size }}</span>
                            </div>
                            @endif

                            {{-- Job Count --}}
                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                <span>{{ $company->jobs_count }} {{ $company->jobs_count == 1 ? 'offre d\'emploi' : 'offres d\'emploi' }}</span>
                            </div>
                        </div>

                        {{-- Button at Bottom --}}
                        <a href="{{ route('jobs.index', ['company' => $company->id]) }}" class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white py-2.5 rounded-lg transition-colors text-center font-semibold text-sm mt-auto">
                            Voir les offres
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-6 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Aucune entreprise trouvée</h3>
                        <p class="text-gray-600 dark:text-gray-400">Aucune entreprise ne correspond à vos critères de recherche.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($companies->hasPages())
            <div class="mt-12 flex items-center justify-center gap-2">
                {{-- First Page Button (Double Left Arrow) --}}
                @if($companies->currentPage() > 1)
                    <a href="{{ $companies->url(1) }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"></path>
                        </svg>
                    </span>
                @endif

                {{-- Previous Button (Single Left Arrow) --}}
                @if($companies->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                    </span>
                @else
                    <a href="{{ $companies->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                    </a>
                @endif

                {{-- Page Numbers (Circular Buttons) --}}
                <div class="flex items-center gap-2">
                    @php
                        $currentPage = $companies->currentPage();
                        $lastPage = $companies->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                        
                        // Adjust if we're near the start or end
                        if ($endPage - $startPage < 4) {
                            if ($startPage == 1) {
                                $endPage = min($lastPage, $startPage + 4);
                            } else {
                                $startPage = max(1, $endPage - 4);
                            }
                        }
                    @endphp

                    @if($startPage > 1)
                        <a href="{{ $companies->url(1) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50 transition-colors font-medium">
                            1
                        </a>
                        @if($startPage > 2)
                            <span class="text-gray-400 dark:text-gray-500 px-2">...</span>
                        @endif
                    @endif

                    @for($i = $startPage; $i <= $endPage; $i++)
                        <a href="{{ $companies->url($i) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white transition-colors font-medium {{ $i == $currentPage ? 'bg-[#00b6b4]' : 'bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="text-gray-400 dark:text-gray-500 px-2">...</span>
                        @endif
                        <a href="{{ $companies->url($lastPage) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50 transition-colors font-medium">
                            {{ $lastPage }}
                        </a>
                    @endif
                </div>

                {{-- Next Button (Single Right Arrow) --}}
                @if($companies->hasMorePages())
                    <a href="{{ $companies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </span>
                @endif

                {{-- Last Page Button (Double Right Arrow) --}}
                @if($companies->currentPage() < $companies->lastPage())
                    <a href="{{ $companies->url($companies->lastPage()) }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 7l5 5-5 5M6 7l5 5-5 5"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 7l5 5-5 5M6 7l5 5-5 5"></path>
                        </svg>
                    </span>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- Featured Companies Banner -->
    <section class="py-16 bg-[#1F1F1F]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#2F2F2F] rounded-3xl p-8 md:p-10 lg:p-12 flex flex-col md:flex-row items-center justify-between gap-6 md:gap-8">
                <div class="flex-1">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3">
                        Faites partie des entreprises mises en avant
                    </h2>
                    <p class="text-base md:text-lg text-white">
                        Créez votre page et connectez-vous aux bons talents.
                    </p>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('signup.recruiter') }}" class="inline-block bg-[#B3B3B3] hover:bg-[#A0A0A0] text-[#2F2F2F] px-10 py-4 rounded-full font-semibold text-base md:text-lg transition-all duration-300 whitespace-nowrap">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@include('components.footer')

@endsection
