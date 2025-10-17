@extends('layouts.dashboard')

@section('page-title', 'Partenaires')
@section('description', 'Gérez les entreprises partenaires affichées sur la page d\'accueil')

@php
use Illuminate\Support\Facades\Storage;
@endphp

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
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Logo</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Nom</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Site web</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Description</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Mis en avant</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Actions</th>
                    </tr>
                </thead>
                <tbody id="partners-table">
                    @forelse($partners as $partner)
                    <tr class="partner-row border-b border-[#444444] hover:bg-[#333333]" data-featured="{{ $partner->is_featured ? 'true' : 'false' }}" data-name="{{ strtolower($partner->name) }}" data-id="{{ $partner->id }}">
                        <td class="py-4 px-6 min-w-[340px] sm:min-w-0">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-[#333333] flex items-center justify-center">
                                <img src="{{ $partner->logo ? Storage::url($partner->logo) : '/partners/default.png' }}" alt="{{ $partner->name }}" class="w-full h-full object-contain p-2" />
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-medium text-[#f5f5f5]">{{ $partner->name }}</div>
                        </td>
                        <td class="py-4 px-6">
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer" class="text-[#00b6b4] hover:text-[#009e9c] text-sm">
                                    {{ $partner->website }}
                                </a>
                            @else
                                <span class="text-[#9ca3af] text-sm">Non renseigné</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-[#9ca3af] max-w-xs truncate text-sm">
                                {{ $partner->description ?: 'Aucune description' }}
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <button 
                                onclick="toggleFeatured({{ $partner->id }}, this)"
                                class="p-2 rounded-lg {{ $partner->is_featured ? 'bg-green-900/30 text-green-600' : 'bg-[#333333] text-[#9ca3af]' }}"
                            >
                                @if($partner->is_featured)
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/>
                                        <path d="M3 3l18 18"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/>
                                    </svg>
                                @endif
                            </button>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button 
                                    onclick="editPartner({{ $partner->id }})"
                                    class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button 
                                    onclick="deletePartner({{ $partner->id }}, '{{ $partner->name }}')"
                                    class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="text-[#9ca3af]">
                                <svg class="w-12 h-12 mx-auto mb-4 text-[#666666]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucun partenaire</h3>
                                <p class="text-sm">Commencez par ajouter votre premier partenaire</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
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

{{-- Delete Confirmation Modal --}}
<div id="delete-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl max-w-md w-full shadow-2xl">
        <div class="p-4 sm:p-6 border-b border-[#444444]">
            <div class="flex items-center justify-between">
                <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">
                    Confirmer la suppression
                </h2>
                <button
                    onclick="hideDeleteModal()"
                    class="text-[#9ca3af] hover:text-[#f5f5f5]"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18"/>
                        <path d="M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4 sm:p-6">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-red-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[#f5f5f5]">Êtes-vous sûr ?</h3>
                    <p class="text-sm text-[#9ca3af]">Cette action ne peut pas être annulée.</p>
                </div>
            </div>
            
            <div class="bg-[#333333] rounded-lg p-4 mb-6">
                <p class="text-[#cccccc] text-sm">
                    Vous êtes sur le point de supprimer le partenaire 
                    <span id="delete-partner-name" class="font-semibold text-[#f5f5f5]"></span>.
                </p>
                <p class="text-[#9ca3af] text-xs mt-2">
                    Toutes les données associées à ce partenaire seront définitivement supprimées.
                </p>
            </div>
        </div>
        
        <div class="p-4 sm:p-6 border-t border-[#444444] flex justify-end gap-3">
            <button
                onclick="hideDeleteModal()"
                class="px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#cccccc] hover:bg-[#333333] transition-colors duration-200 text-sm sm:text-base"
            >
                Annuler
            </button>
            <button
                onclick="confirmDelete()"
                class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors text-sm sm:text-base"
            >
                Supprimer
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

        searchValue: searchValue,
        featuredOnly: featuredOnly,
        totalRows: rows.length
    });

    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        const isFeatured = row.getAttribute('data-featured') === 'true';
        
        const matchesSearch = name.includes(searchValue);
        const matchesFeatured = !featuredOnly || isFeatured;
        
            name: name,
            isFeatured: isFeatured,
            matchesSearch: matchesSearch,
            matchesFeatured: matchesFeatured,
            willShow: matchesSearch && matchesFeatured
        });
        
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
    const partnerName = row.querySelector('td:nth-child(2) .font-medium').textContent;
    
    fetch(`/admin/partners/${id}/toggle-featured`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            row.setAttribute('data-featured', data.is_featured);
            
            if (data.is_featured) {
                button.className = 'p-2 rounded-lg bg-green-900/30 text-green-600';
                button.innerHTML = '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
            } else {
                button.className = 'p-2 rounded-lg bg-[#333333] text-[#9ca3af]';
                button.innerHTML = '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/><path d="M3 3l18 18"/><path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/></svg>';
            }
            
            showToast('Succès', data.message, 'success');
            // Update the data-featured attribute
            row.setAttribute('data-featured', data.is_featured);
            // Reapply filters
            filterPartners();
        } else {
            showToast('Erreur', data.error || 'Erreur lors de la modification', 'error');
        }
    })
    .catch(error => {
        console.error('Error toggling featured:', error);
        showToast('Erreur', 'Erreur lors de la modification', 'error');
    });
}

let currentDeleteId = null;
let currentDeleteName = null;

function deletePartner(id, name) {
    currentDeleteId = id;
    currentDeleteName = name;
    
    // Set the partner name in the modal
    document.getElementById('delete-partner-name').textContent = name;
    
    // Show the delete modal
    document.getElementById('delete-modal').classList.remove('hidden');
}

function hideDeleteModal() {
    document.getElementById('delete-modal').classList.add('hidden');
    currentDeleteId = null;
    currentDeleteName = null;
}

function confirmDelete() {
    if (!currentDeleteId) return;
    
    fetch(`/admin/partners/${currentDeleteId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = document.querySelector(`tr[data-id="${currentDeleteId}"]`);
            if (row) {
                row.remove();
            }
            showToast('Partenaire supprimé', data.message, 'success');
            hideDeleteModal();
            // Reapply filters after deletion
            filterPartners();
        } else {
            showToast('Erreur', data.error || 'Erreur lors de la suppression', 'error');
        }
    })
    .catch(error => {
        console.error('Error deleting partner:', error);
        showToast('Erreur', 'Erreur lors de la suppression', 'error');
    });
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
    
    // Set current logo
    const logoUrl = partner.logo ? `/storage/${partner.logo}` : '/partners/default.png';
    document.getElementById('current-logo').src = logoUrl;
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
    
        name: name,
        website: website,
        description: description,
        featured: featured,
        selectedLogoFile: selectedLogoFile
    });
    
    if (!name) {
        showToast('Erreur', 'Le nom du partenaire est requis', 'error');
        return;
    }
    
    if (!selectedLogoFile) {
        showToast('Erreur', 'Le logo du partenaire est requis', 'error');
        return;
    }
    
    // Create FormData for file upload
    const formData = new FormData();
    formData.append('name', name);
    formData.append('logo', selectedLogoFile);
    formData.append('website', website);
    formData.append('description', description);
    formData.append('is_featured', featured ? '1' : '0');
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    formData.append('_token', csrfToken);
    
        name: name,
        website: website,
        description: description,
        featured: featured,
        hasLogo: !!selectedLogoFile
    });

    fetch('/admin/partners', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        return response.json();
    })
    .then(data => {
        if (data.success) {
            hideAddModal();
            showToast('Partenaire ajouté', data.message, 'success');
            // Reload to show new partner and reapply filters
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showToast('Erreur', data.error || 'Erreur lors de l\'ajout du partenaire', 'error');
        }
    })
    .catch(error => {
        console.error('Error adding partner:', error);
        showToast('Erreur', 'Erreur lors de l\'ajout du partenaire', 'error');
    });
}

let currentEditId = null;

function editPartner(id) {
    currentEditId = id;
    
    fetch(`/admin/partners/${id}`)
    .then(response => {
        return response.json();
    })
    .then(data => {
        showEditModal(data);
    })
    .catch(error => {
        console.error('Error loading partner:', error);
        showToast('Erreur', 'Erreur lors du chargement du partenaire', 'error');
    });
}

function saveEditPartner() {
    if (!currentEditId) {
        return;
    }
    
    const name = document.getElementById('edit-partner-name').value.trim();
    const website = document.getElementById('edit-partner-website').value.trim();
    const description = document.getElementById('edit-partner-description').value.trim();
    const featured = document.getElementById('edit-partner-featured').checked;
    
        id: currentEditId,
        name: name,
        website: website,
        description: description,
        featured: featured,
        hasNewLogo: !!selectedEditLogoFile
    });
    
    if (!name) {
        showToast('Erreur', 'Le nom du partenaire est requis', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('name', name);
    formData.append('website', website);
    formData.append('description', description);
    formData.append('is_featured', featured ? '1' : '0');
    formData.append('_method', 'PUT');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Add logo if new one selected
    if (selectedEditLogoFile) {
        formData.append('logo', selectedEditLogoFile);
    }
    
    fetch(`/admin/partners/${currentEditId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            hideEditModal();
            showToast('Partenaire modifié', data.message, 'success');
            location.reload(); // Reload to show updated partner
        } else {
            showToast('Erreur', data.error || 'Erreur lors de la modification', 'error');
        }
    })
    .catch(error => {
        console.error('Error updating partner:', error);
        showToast('Erreur', 'Erreur lors de la modification', 'error');
    });
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

// Initialize filters when page loads
document.addEventListener('DOMContentLoaded', function() {
    filterPartners();
});
</script>
@endsection

