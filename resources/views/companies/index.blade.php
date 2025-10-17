@extends('layouts.app')

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
$companies = \App\Models\Company::where('is_active', true)->get();
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] relative overflow-hidden">
    

    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6" data-animate="hero-title">
                Découvrez les entreprises qui recrutent

            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto" data-animate="hero-subtitle">
                Explorez notre réseau d'entreprises partenaires et découvrez votre prochain employeur
            </p>
        </div>
    </section>

    <!-- Search and Filters -->
    <section class="py-8 bg-white dark:bg-[#2b2b2b] shadow-sm relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-[#333333]">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input
                            type="text"
                            placeholder="Rechercher une entreprise..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <select class="pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5] min-w-[150px]">
                                <option value="">Toutes les villes</option>
                                <option value="Alger">Alger</option>
                                <option value="Chéraga">Chéraga</option>
                                <option value="El Harrach">El Harrach</option>
                            </select>
                        </div>
                        
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                <path d="M10 6h4"></path>
                                <path d="M10 10h4"></path>
                                <path d="M10 14h4"></path>
                                <path d="M6 18h.01"></path>
                                <path d="M6 15h.01"></path>
                            </svg>
                            <select class="pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5] min-w-[150px]">
                                <option value="">Toutes tailles</option>
                                <option value="11-50">11-50 employés</option>
                                <option value="500+">500+ employés</option>
                                <option value="10000+">10000+ employés</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Companies Grid -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($companies as $company)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group hover:transform hover:scale-105 border border-gray-100 dark:border-[#333333] animate-on-scroll" data-animate="company-card">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($company->logo)
                                <img
                                    src="{{ Storage::url($company->logo) }}"
                                    alt="{{ $company->name }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div class="w-full h-full bg-[#00b6b4] flex items-center justify-center text-white text-xl font-bold">
                                    {{ substr($company->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <span class="bg-[#00b6b4]/10 border border-[#00b6b4]/30 text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium">
                            {{ $company->industry }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 group-hover:text-[#00b6b4] transition-colors duration-200">
                        {{ $company->name }}
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                        {{ $company->description }}
                    </p>
                    
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $company->location }}</span>
                        </div>
                        
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                <path d="M10 6h4"></path>
                                <path d="M10 10h4"></path>
                                <path d="M10 14h4"></path>
                                <path d="M6 18h.01"></path>
                                <path d="M6 15h.01"></path>
                            </svg>
                            <span>{{ $company->size }}</span>
                        </div>
                        
                        <div class="flex items-center text-[#00b6b4] text-sm font-medium">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                            </svg>
                            <span>{{ $company->jobs()->count() }} postes</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-3 rounded-lg font-medium transition-colors duration-200">
                        Voir les offres
                    </button>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                            <path d="M10 6h4"></path>
                            <path d="M10 10h4"></path>
                            <path d="M10 14h4"></path>
                            <path d="M6 18h.01"></path>
                            <path d="M6 15h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Aucune entreprise trouvée</h3>
                    <p class="text-gray-600 dark:text-gray-400">Aucune entreprise n'est actuellement enregistrée sur la plateforme.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>

@include('components.footer')
@endsection
