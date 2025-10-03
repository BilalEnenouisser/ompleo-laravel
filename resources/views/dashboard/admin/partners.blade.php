@extends('layouts.dashboard')

@section('page-title', 'Partenaires')
@section('description', 'Gérez les entreprises partenaires affichées sur la page d\'accueil')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Partenaires
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-2">
                Gérez les entreprises partenaires affichées sur la page d'accueil
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button 
                onclick="showAddModal()"
                class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 sm:px-6 py-2 sm:py-3 flex items-center gap-2 rounded-lg transition-colors text-sm sm:text-base"
            >
                <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                <span class="hidden sm:inline">Ajouter un partenaire</span>
                <span class="sm:hidden">Ajouter</span>
            </button>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher un partenaire..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    id="search-input"
                    onkeyup="filterPartners()"
                />
            </div>
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="checkbox"
                        id="featured-filter"
                        onchange="filterPartners()"
                        class="w-4 h-4 text-[#00b6b4] border-gray-300 rounded focus:ring-[#00b6b4]"
                    />
                    <span class="text-[#cccccc] text-sm sm:text-base">Afficher uniquement les partenaires mis en avant</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Partners Table --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base hidden md:table-cell">Logo</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Nom</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base hidden lg:table-cell">Site web</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base hidden xl:table-cell">Description</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Mis en avant</th>
                        <th class="text-left py-3 sm:py-4 px-3 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Actions</th>
                    </tr>
                </thead>
                <tbody id="partners-table">
                    @php
                    $partners = [
                        ['id' => 1, 'name' => 'Mobilis', 'logo' => '/partners/mobilis.png', 'is_featured' => true, 'website' => 'https://www.mobilis.dz', 'description' => 'Opérateur de téléphonie mobile'],
                        ['id' => 2, 'name' => 'Sonelgaz', 'logo' => '/partners/sonelgaz.png', 'is_featured' => true, 'website' => 'https://www.sonelgaz.dz', 'description' => 'Société nationale d\'électricité et de gaz'],
                        ['id' => 3, 'name' => 'Algérie Télécom', 'logo' => '/partners/algerie-telecom.png', 'is_featured' => true, 'website' => 'https://www.algerietelecom.dz', 'description' => 'Opérateur de télécommunications'],
                        ['id' => 4, 'name' => 'Cevital', 'logo' => '/partners/cevital.png', 'is_featured' => true, 'website' => 'https://www.cevital.com', 'description' => 'Groupe agroalimentaire et industriel'],
                        ['id' => 5, 'name' => 'Ooredoo', 'logo' => '/partners/ooredoo.png', 'is_featured' => true, 'website' => 'https://www.ooredoo.dz', 'description' => 'Opérateur de téléphonie mobile'],
                        ['id' => 6, 'name' => 'Air Algérie', 'logo' => '/partners/air-algerie.png', 'is_featured' => true, 'website' => 'https://www.airalgerie.dz', 'description' => 'Compagnie aérienne nationale'],
                        ['id' => 7, 'name' => 'BNA', 'logo' => '/partners/bna.png', 'is_featured' => true, 'website' => 'https://www.bna.dz', 'description' => 'Banque Nationale d\'Algérie'],
                        ['id' => 8, 'name' => 'Djezzy', 'logo' => '/partners/djezzy.png', 'is_featured' => true, 'website' => 'https://www.djezzy.dz', 'description' => 'Opérateur de téléphonie mobile'],
                        ['id' => 9, 'name' => 'ENTP', 'logo' => '/partners/entp.png', 'is_featured' => true, 'website' => 'https://www.entp.dz', 'description' => 'Entreprise Nationale des Travaux aux Puits'],
                        ['id' => 10, 'name' => 'Benamor', 'logo' => '/partners/benamor.png', 'is_featured' => true, 'website' => 'https://www.benamor.dz', 'description' => 'Groupe agroalimentaire'],
                        ['id' => 11, 'name' => 'Entreprise Test', 'logo' => '/partners/default.png', 'is_featured' => false, 'website' => 'https://www.example.com', 'description' => 'Description de test'],
                    ];
                    @endphp

                    @foreach($partners as $partner)
                    <tr class="partner-row border-b border-[#444444] hover:bg-[#333333]" data-featured="{{ $partner['is_featured'] ? 'true' : 'false' }}" data-name="{{ strtolower($partner['name']) }}">
                        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden md:table-cell">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg overflow-hidden bg-[#333333] flex items-center justify-center">
                                <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="w-full h-full object-contain p-2" />
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-3 sm:px-6">
                            <div class="flex items-center gap-3 md:hidden mb-2">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-[#333333] flex items-center justify-center flex-shrink-0">
                                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="w-full h-full object-contain p-1" />
                                </div>
                            </div>
                            <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">{{ $partner['name'] }}</div>
                        </td>
                        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden lg:table-cell">
                            <a href="{{ $partner['website'] }}" target="_blank" rel="noopener noreferrer" class="text-[#00b6b4] hover:text-[#009e9c] text-sm sm:text-base">
                                {{ $partner['website'] }}
                            </a>
                        </td>
                        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden xl:table-cell">
                            <div class="text-[#9ca3af] max-w-xs truncate text-sm sm:text-base">
                                {{ $partner['description'] }}
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-3 sm:px-6">
                            <button 
                                onclick="toggleFeatured({{ $partner['id'] }}, this)"
                                class="p-1.5 sm:p-2 rounded-lg {{ $partner['is_featured'] ? 'bg-green-900/30 text-green-600' : 'bg-[#333333] text-[#9ca3af]' }}"
                            >
                                @if($partner['is_featured'])
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/>
                                        <path d="M3 3l18 18"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/>
                                    </svg>
                                @endif
                            </button>
                        </td>
                        <td class="py-3 sm:py-4 px-3 sm:px-6">
                            <div class="flex items-center gap-1 sm:gap-2">
                                <button 
                                    onclick="editPartner({{ json_encode($partner) }})"
                                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200"
                                >
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button 
                                    onclick="deletePartner({{ $partner['id'] }}, '{{ $partner['name'] }}')"
                                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200"
                                >
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="no-results" class="text-center py-12 hidden">
            <h3 class="text-xl font-semibold text-[#f5f5f5] mb-2">
                Aucun partenaire trouvé
            </h3>
            <p class="text-[#9ca3af]">
                Essayez de modifier vos critères de recherche
            </p>
        </div>
    </div>
</div>

{{-- Add Partner Modal --}}
<div id="add-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl max-w-md w-full shadow-2xl">
        <div class="p-4 sm:p-6 border-b border-[#444444]">
            <div class="flex items-center justify-between">
                <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">
                    Ajouter un partenaire
                </h2>
                <button
                    onclick="hideAddModal()"
                    class="text-[#9ca3af] hover:text-[#f5f5f5]"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4 sm:p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Nom *
                </label>
                <input
                    type="text"
                    id="partner-name"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="Nom de l'entreprise"
                    required
                />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Logo *
                </label>
                <div class="border-2 border-dashed border-[#444444] rounded-lg p-4 text-center">
                    <div id="logo-preview" class="hidden">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#333333] rounded-lg flex items-center justify-center overflow-hidden">
                                    <img id="logo-preview-img" src="" alt="Preview" class="w-full h-full object-contain" />
                                </div>
                                <div class="text-left">
                                    <p id="logo-filename" class="text-sm font-medium text-[#cccccc] truncate max-w-[200px]"></p>
                                    <p id="logo-filesize" class="text-xs text-[#9ca3af]"></p>
                                </div>
                            </div>
                            <button type="button" onclick="clearLogo()" class="text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6L6 18"/>
                                    <path d="M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="logo-upload-area">
                        <input type="file" id="logo-input" class="hidden" accept="image/jpeg,image/png,image/svg+xml" onchange="handleLogoChange(this)" />
                        <label for="logo-input" class="cursor-pointer">
                            <div class="flex flex-col items-center">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 text-[#9ca3af] mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                                    <circle cx="12" cy="13" r="3"/>
                                </svg>
                                <p class="text-sm font-medium text-[#cccccc] mb-1">
                                    Cliquez pour téléverser
                                </p>
                                <p class="text-xs text-[#9ca3af]">
                                    JPG, PNG, SVG (max 2 Mo)
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Site web
                </label>
                <input
                    type="url"
                    id="partner-website"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="https://www.example.com"
                />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Description
                </label>
                <textarea
                    id="partner-description"
                    rows="3"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="Description de l'entreprise"
                ></textarea>
            </div>
            
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="partner-featured"
                    class="w-4 h-4 text-[#00b6b4] border-gray-300 rounded focus:ring-[#00b6b4]"
                />
                <label for="partner-featured" class="ml-2 text-sm text-[#cccccc]">
                    Mettre en avant sur la page d'accueil
                </label>
            </div>
        </div>
        
        <div class="p-4 sm:p-6 border-t border-[#444444] flex justify-end gap-3">
            <button
                onclick="hideAddModal()"
                class="px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#cccccc] hover:bg-[#333333] transition-colors duration-200 text-sm sm:text-base"
            >
                Annuler
            </button>
            <button
                onclick="addPartner()"
                class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors text-sm sm:text-base"
            >
                Ajouter
            </button>
        </div>
    </div>
</div>

{{-- Edit Partner Modal --}}
<div id="edit-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl max-w-md w-full shadow-2xl">
        <div class="p-4 sm:p-6 border-b border-[#444444]">
            <div class="flex items-center justify-between">
                <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">
                    Modifier un partenaire
                </h2>
                <button
                    onclick="hideEditModal()"
                    class="text-[#9ca3af] hover:text-[#f5f5f5]"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4 sm:p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Nom *
                </label>
                <input
                    type="text"
                    id="edit-partner-name"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="Nom de l'entreprise"
                    required
                />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Logo
                </label>
                <div class="border-2 border-dashed border-[#444444] rounded-lg p-4 text-center">
                    <div id="edit-logo-preview" class="hidden">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#333333] rounded-lg flex items-center justify-center overflow-hidden">
                                    <img id="edit-logo-preview-img" src="" alt="Preview" class="w-full h-full object-contain" />
                                </div>
                                <div class="text-left">
                                    <p id="edit-logo-filename" class="text-sm font-medium text-[#cccccc] truncate max-w-[200px]"></p>
                                    <p id="edit-logo-filesize" class="text-xs text-[#9ca3af]"></p>
                                </div>
                            </div>
                            <button type="button" onclick="clearEditLogo()" class="text-red-500 hover:text-red-700">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6L6 18"/>
                                    <path d="M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="edit-logo-upload-area">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-16 h-16 sm:w-24 sm:h-24 bg-[#333333] rounded-lg flex items-center justify-center overflow-hidden">
                                <img id="current-logo" src="" alt="Current Logo" class="w-full h-full object-contain p-2" />
                            </div>
                        </div>
                        <input type="file" id="edit-logo-input" class="hidden" accept="image/jpeg,image/png,image/svg+xml" onchange="handleEditLogoChange(this)" />
                        <label for="edit-logo-input" class="cursor-pointer">
                            <div class="flex flex-col items-center">
                                <p class="text-sm font-medium text-[#00b6b4]">
                                    Changer le logo
                                </p>
                                <p class="text-xs text-[#9ca3af]">
                                    JPG, PNG, SVG (max 2 Mo)
                                </p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Site web
                </label>
                <input
                    type="url"
                    id="edit-partner-website"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="https://www.example.com"
                />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#cccccc] mb-2">
                    Description
                </label>
                <textarea
                    id="edit-partner-description"
                    rows="3"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    placeholder="Description de l'entreprise"
                ></textarea>
            </div>
            
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="edit-partner-featured"
                    class="w-4 h-4 text-[#00b6b4] border-gray-300 rounded focus:ring-[#00b6b4]"
                />
                <label for="edit-partner-featured" class="ml-2 text-sm text-[#cccccc]">
                    Mettre en avant sur la page d'accueil
                </label>
            </div>
        </div>
        
        <div class="p-4 sm:p-6 border-t border-[#444444] flex justify-end gap-3">
            <button
                onclick="hideEditModal()"
                class="px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#cccccc] hover:bg-[#333333] transition-colors duration-200 text-sm sm:text-base"
            >
                Annuler
            </button>
            <button
                onclick="saveEditPartner()"
                class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors text-sm sm:text-base"
            >
                Enregistrer
            </button>
        </div>
    </div>
</div>

{{-- Toast Notifications --}}
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

<script>
function filterPartners() {
    const searchValue = document.getElementById('search-input').value.toLowerCase();
    const featuredOnly = document.getElementById('featured-filter').checked;
    const rows = document.querySelectorAll('.partner-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const isFeatured = row.getAttribute('data-featured') === 'true';
        
        const matchesSearch = name.includes(searchValue);
        const matchesFeatured = !featuredOnly || isFeatured;
        
        if (matchesSearch && matchesFeatured) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('no-results').classList.toggle('hidden', visibleCount > 0);
}

function toggleFeatured(id, button) {
    const row = button.closest('tr');
    const isFeatured = row.getAttribute('data-featured') === 'true';
    const partnerName = row.querySelector('td:nth-child(2) .font-medium').textContent;
    
    row.setAttribute('data-featured', !isFeatured);
    
    if (isFeatured) {
        button.className = 'p-1.5 sm:p-2 rounded-lg bg-[#333333] text-[#9ca3af]';
        button.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/><path d="M3 3l18 18"/><path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/></svg>';
        showToast('Partenaire retiré', `${partnerName} n'apparaîtra plus sur la page d'accueil`, 'success');
    } else {
        button.className = 'p-1.5 sm:p-2 rounded-lg bg-green-900/30 text-green-600';
        button.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        showToast('Partenaire mis en avant', `${partnerName} apparaîtra maintenant sur la page d'accueil`, 'success');
    }
    
    filterPartners();
}

function deletePartner(id, name) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer ${name} ?`)) {
        const row = document.querySelector(`tr[data-name="${name.toLowerCase()}"]`);
        if (row) {
            row.remove();
            filterPartners();
        }
    }
}

// Modal Functions
function showAddModal() {
    document.getElementById('add-modal').classList.remove('hidden');
    // Reset form
    document.getElementById('partner-name').value = '';
    document.getElementById('partner-website').value = '';
    document.getElementById('partner-description').value = '';
    document.getElementById('partner-featured').checked = false;
    clearLogo();
}

function hideAddModal() {
    document.getElementById('add-modal').classList.add('hidden');
}

function showEditModal(partner) {
    document.getElementById('edit-modal').classList.remove('hidden');
    // Fill form with partner data
    document.getElementById('edit-partner-name').value = partner.name;
    document.getElementById('edit-partner-website').value = partner.website || '';
    document.getElementById('edit-partner-description').value = partner.description || '';
    document.getElementById('edit-partner-featured').checked = partner.is_featured;
    document.getElementById('current-logo').src = partner.logo;
    clearEditLogo();
}

function hideEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
}

// Logo handling
let selectedLogoFile = null;
let selectedEditLogoFile = null;

function handleLogoChange(input) {
    const file = input.files[0];
    if (!file) return;
    
    // Check file size (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        showToast('Fichier trop volumineux', 'La taille maximale autorisée est de 2 Mo', 'error');
        return;
    }
    
    // Check file type
    if (!['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type)) {
        showToast('Format non supporté', 'Formats acceptés : JPG, PNG, SVG', 'error');
        return;
    }
    
    selectedLogoFile = file;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('logo-preview-img').src = e.target.result;
        document.getElementById('logo-filename').textContent = file.name;
        document.getElementById('logo-filesize').textContent = (file.size / 1024).toFixed(1) + ' Ko';
        document.getElementById('logo-preview').classList.remove('hidden');
        document.getElementById('logo-upload-area').classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

function handleEditLogoChange(input) {
    const file = input.files[0];
    if (!file) return;
    
    // Check file size (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
        showToast('Fichier trop volumineux', 'La taille maximale autorisée est de 2 Mo', 'error');
        return;
    }
    
    // Check file type
    if (!['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type)) {
        showToast('Format non supporté', 'Formats acceptés : JPG, PNG, SVG', 'error');
        return;
    }
    
    selectedEditLogoFile = file;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('edit-logo-preview-img').src = e.target.result;
        document.getElementById('edit-logo-filename').textContent = file.name;
        document.getElementById('edit-logo-filesize').textContent = (file.size / 1024).toFixed(1) + ' Ko';
        document.getElementById('edit-logo-preview').classList.remove('hidden');
        document.getElementById('edit-logo-upload-area').classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

function clearLogo() {
    selectedLogoFile = null;
    document.getElementById('logo-input').value = '';
    document.getElementById('logo-preview').classList.add('hidden');
    document.getElementById('logo-upload-area').classList.remove('hidden');
}

function clearEditLogo() {
    selectedEditLogoFile = null;
    document.getElementById('edit-logo-input').value = '';
    document.getElementById('edit-logo-preview').classList.add('hidden');
    document.getElementById('edit-logo-upload-area').classList.remove('hidden');
}

// Partner management
function addPartner() {
    const name = document.getElementById('partner-name').value.trim();
    const website = document.getElementById('partner-website').value.trim();
    const description = document.getElementById('partner-description').value.trim();
    const featured = document.getElementById('partner-featured').checked;
    
    if (!name) {
        showToast('Erreur', 'Le nom du partenaire est requis', 'error');
        return;
    }
    
    if (!selectedLogoFile) {
        showToast('Erreur', 'Le logo du partenaire est requis', 'error');
        return;
    }
    
    // Create new partner row
    const newId = Math.max(...Array.from(document.querySelectorAll('.partner-row')).map(row => parseInt(row.getAttribute('data-id') || '0'))) + 1;
    const logoUrl = URL.createObjectURL(selectedLogoFile);
    
    const newRow = document.createElement('tr');
    newRow.className = 'partner-row border-b border-[#444444] hover:bg-[#333333]';
    newRow.setAttribute('data-featured', featured);
    newRow.setAttribute('data-name', name.toLowerCase());
    newRow.setAttribute('data-id', newId);
    
    newRow.innerHTML = `
        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden md:table-cell">
            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg overflow-hidden bg-[#333333] flex items-center justify-center">
                <img src="${logoUrl}" alt="${name}" class="w-full h-full object-contain p-2" />
            </div>
        </td>
        <td class="py-3 sm:py-4 px-3 sm:px-6">
            <div class="flex items-center gap-3 md:hidden mb-2">
                <div class="w-10 h-10 rounded-lg overflow-hidden bg-[#333333] flex items-center justify-center flex-shrink-0">
                    <img src="${logoUrl}" alt="${name}" class="w-full h-full object-contain p-1" />
                </div>
            </div>
            <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">${name}</div>
        </td>
        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden lg:table-cell">
            <a href="${website}" target="_blank" rel="noopener noreferrer" class="text-[#00b6b4] hover:text-[#009e9c] text-sm sm:text-base">
                ${website}
            </a>
        </td>
        <td class="py-3 sm:py-4 px-3 sm:px-6 hidden xl:table-cell">
            <div class="text-[#9ca3af] max-w-xs truncate text-sm sm:text-base">
                ${description}
            </div>
        </td>
        <td class="py-3 sm:py-4 px-3 sm:px-6">
            <button 
                onclick="toggleFeatured(${newId}, this)"
                class="p-1.5 sm:p-2 rounded-lg ${featured ? 'bg-green-900/30 text-green-600' : 'bg-[#333333] text-[#9ca3af]'}"
            >
                ${featured ? 
                    '<svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>' :
                    '<svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/><path d="M3 3l18 18"/><path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/></svg>'
                }
            </button>
        </td>
        <td class="py-3 sm:py-4 px-3 sm:px-6">
            <div class="flex items-center gap-1 sm:gap-2">
                <button 
                    onclick="editPartner({id: ${newId}, name: '${name}', logo: '${logoUrl}', is_featured: ${featured}, website: '${website}', description: '${description}'})"
                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </button>
                <button 
                    onclick="deletePartner(${newId}, '${name}')"
                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
            </div>
        </td>
    `;
    
    document.getElementById('partners-table').appendChild(newRow);
    hideAddModal();
    showToast('Partenaire ajouté', `${name} a été ajouté avec succès`, 'success');
    filterPartners();
}

function editPartner(partner) {
    showEditModal(partner);
}

function saveEditPartner() {
    showToast('Partenaire modifié', 'Le partenaire a été modifié avec succès', 'success');
    hideEditModal();
}

// Toast notifications
function showToast(title, message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    
    const bgColor = type === 'success' ? 'bg-green-900/30' : 'bg-red-900/30';
    const borderColor = type === 'success' ? 'border-green-500' : 'border-red-500';
    const iconColor = type === 'success' ? 'text-green-600' : 'text-red-600';
    
    toast.className = `${bgColor} border ${borderColor} rounded-lg p-4 max-w-sm shadow-lg backdrop-blur-sm`;
    toast.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                ${type === 'success' ? 
                    '<svg class="w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>' :
                    '<svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>'
                }
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-[#f5f5f5]">${title}</h4>
                <p class="text-xs text-[#9ca3af] mt-1">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-[#9ca3af] hover:text-[#f5f5f5]">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
        </div>
    `;
    
    container.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.remove();
        }
    }, 5000);
}
</script>
@endsection

