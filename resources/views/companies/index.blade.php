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
                            id="searchInput"
                            placeholder="Rechercher une entreprise..."
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <select id="locationFilter" class="w-full h-10 sm:h-12 pl-10 sm:pl-12 pr-3 sm:pr-4 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] focus:outline-none focus:ring-2 focus:ring-[#00b6b4] shadow-lg text-sm sm:text-base">
                                <option value="">Région / Wilaya</option>
                                <option value="Adrar" {{ request('location') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                                <option value="Chlef" {{ request('location') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                                <option value="Laghouat" {{ request('location') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                                <option value="Oum El Bouaghi" {{ request('location') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                                <option value="Batna" {{ request('location') == 'Batna' ? 'selected' : '' }}>Batna</option>
                                <option value="Béjaïa" {{ request('location') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                                <option value="Biskra" {{ request('location') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                                <option value="Béchar" {{ request('location') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                                <option value="Blida" {{ request('location') == 'Blida' ? 'selected' : '' }}>Blida</option>
                                <option value="Bouira" {{ request('location') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                                <option value="Tamanrasset" {{ request('location') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                                <option value="Tébessa" {{ request('location') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                                <option value="Tlemcen" {{ request('location') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                                <option value="Tiaret" {{ request('location') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                                <option value="Tizi Ouzou" {{ request('location') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                                <option value="Alger" {{ request('location') == 'Alger' ? 'selected' : '' }}>Alger</option>
                                <option value="Djelfa" {{ request('location') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                                <option value="Jijel" {{ request('location') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                                <option value="Sétif" {{ request('location') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                                <option value="Saïda" {{ request('location') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                                <option value="Skikda" {{ request('location') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                                <option value="Sidi Bel Abbès" {{ request('location') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                                <option value="Annaba" {{ request('location') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                                <option value="Guelma" {{ request('location') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                                <option value="Constantine" {{ request('location') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                                <option value="Médéa" {{ request('location') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                                <option value="Mostaganem" {{ request('location') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                                <option value="M'Sila" {{ request('location') == 'M\'Sila' ? 'selected' : '' }}>M'Sila</option>
                                <option value="Mascara" {{ request('location') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                                <option value="Ouargla" {{ request('location') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                                <option value="Oran" {{ request('location') == 'Oran' ? 'selected' : '' }}>Oran</option>
                                <option value="El Bayadh" {{ request('location') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                                <option value="Illizi" {{ request('location') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                                <option value="Bordj Bou Arreridj" {{ request('location') == 'Bordj Bou Arreridj' ? 'selected' : '' }}>Bordj Bou Arreridj</option>
                                <option value="Boumerdès" {{ request('location') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                                <option value="El Tarf" {{ request('location') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                                <option value="Tindouf" {{ request('location') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                                <option value="Tissemsilt" {{ request('location') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                                <option value="El Oued" {{ request('location') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                                <option value="Khenchela" {{ request('location') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                                <option value="Souk Ahras" {{ request('location') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                                <option value="Tipaza" {{ request('location') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                                <option value="Mila" {{ request('location') == 'Mila' ? 'selected' : '' }}>Mila</option>
                                <option value="Aïn Defla" {{ request('location') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                                <option value="Naâma" {{ request('location') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                                <option value="Aïn Témouchent" {{ request('location') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                                <option value="Ghardaïa" {{ request('location') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                                <option value="Relizane" {{ request('location') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
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
                            <select id="sizeFilter" class="pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5] min-w-[150px]">
                                <option value="">Toutes tailles</option>
                                <option value="1-10 employés" {{ request('size') == '1-10 employés' ? 'selected' : '' }}>1-10 employés</option>
                                <option value="10-50 employés" {{ request('size') == '10-50 employés' ? 'selected' : '' }}>10-50 employés</option>
                                <option value="20-50 employés" {{ request('size') == '20-50 employés' ? 'selected' : '' }}>20-50 employés</option>
                                <option value="50-100 employés" {{ request('size') == '50-100 employés' ? 'selected' : '' }}>50-100 employés</option>
                                <option value="51-200 employés" {{ request('size') == '51-200 employés' ? 'selected' : '' }}>51-200 employés</option>
                            </select>
                        </div>
                        
                        <button 
                            type="button" 
                            id="filterButton"
                            class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:scale-105 flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
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
