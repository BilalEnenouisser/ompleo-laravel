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
            Trouvez les talents faits pour votre entreprise

            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto" data-animate="hero-subtitle">
            Parcourez des profils qualifiés et trouvez le bon profil grâce à une sélection intelligente
            </p>
        </div>
    </section>

   
    @if(request('search') || request('size') || request('location'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
        <strong>Filtres appliqués:</strong>
        @if(request('search'))
            <span class="inline-block bg-blue-200 px-2 py-1 rounded mr-2">Recherche: "{{ request('search') }}"</span>
        @endif
        @if(request('size'))
            <span class="inline-block bg-blue-200 px-2 py-1 rounded mr-2">Taille: {{ request('size') }}</span>
        @endif
        @if(request('location'))
            <span class="inline-block bg-blue-200 px-2 py-1 rounded mr-2">Localisation: {{ request('location') }}</span>
        @endif
        <br>
        <strong>{{ $companies->count() }} entreprise(s) trouvée(s)</strong>
    </div>
    @endif

    <!-- Companies Grid -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($companies as $company)
                <a href="{{ route('companies.show', $company->slug) }}" class="block bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group hover:transform hover:scale-105 border border-gray-100 dark:border-[#333333] animate-on-scroll" data-animate="company-card">
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
                        
                        @if($company->specialisation)
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
                            <span>{{ $company->specialisation }}</span>
                        </div>
                        @endif
                        
                        @if($company->years_experience)
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                <rect width="20" height="14" x="2" y="6" rx="2"></rect>
                            </svg>
                            <span>{{ $company->years_experience }} ans d'expérience</span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-3 rounded-lg font-medium transition-colors duration-200 text-center">
                        Voir les offres
                    </div>
                </a>
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


    <!-- Stats Section -->
    <section class="py-16 bg-[#00b6b4] text-white relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="liquid-shape w-96 h-96 bg-white/10 top-20 -left-20"></div>
            <div class="liquid-shape w-80 h-80 bg-white/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="animate-fade-in-up" data-animate="stat-1">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"></polyline>
                            <polyline points="16,7 22,7 22,13"></polyline>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter">
                        98%
                    </div>
                    <div class="text-white/80">Taux de satisfaction</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-2" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle" style="animation-delay: 0.5s;">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter" style="animation-delay: 0.4s;">
                        {{ number_format($candidateCount) }}+
                    </div>
                    <div class="text-white/80">Profils disponible</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-3" style="animation-delay: 0.4s;">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle" style="animation-delay: 1s;">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22,4 12,14.01 9,11.01"></polyline>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter" style="animation-delay: 0.6s;">
                        24h
                    </div>
                    <div class="text-white/80">Temps de réponse moyen</div>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="py-20 bg-gray-50 dark:bg-[#2b2b2b]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6 animate-fade-in-up" data-animate="cta-title">
            Recrutez plus intelligemment
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 animate-fade-in-up" data-animate="cta-subtitle" style="animation-delay: 0.2s;">
            Créez votre compte entreprise et laissez notre système intelligent vous connecter aux bons talents, plus rapidement
            </p>
            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 animate-fade-in-up" data-animate="cta-button" style="animation-delay: 0.4s;">
                Créer mon compte maintenant
            </button>
        </div>
    </section>
</div>

@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const locationFilter = document.getElementById('locationFilter');
    const sizeFilter = document.getElementById('sizeFilter');
    const filterButton = document.getElementById('filterButton');
    
    // Filter button functionality
    filterButton.addEventListener('click', function() {
        performFilterSearch();
    });
    
    // Enter key in search input
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performFilterSearch();
        }
    });
    
    function performFilterSearch() {
        const searchValue = searchInput.value;
        const locationValue = locationFilter.value;
        const sizeValue = sizeFilter.value;
        
        // Build URL manually to ensure it works
        let url = window.location.origin + window.location.pathname;
        let params = [];
        
        if (searchValue.trim()) {
            params.push('search=' + encodeURIComponent(searchValue.trim()));
        }
        
        if (locationValue) {
            params.push('location=' + encodeURIComponent(locationValue));
        }
        
        if (sizeValue) {
            params.push('size=' + encodeURIComponent(sizeValue));
        }
        
        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        
        window.location.href = url;
    }
});
</script>
@endsection
