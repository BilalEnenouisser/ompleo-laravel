@extends('layouts.dashboard')

@section('title', 'Mes Offres d\'Emploi - OMPLEO')
@section('description', 'Gérez vos annonces et suivez les candidatures.')
@section('page-title', 'Mes Offres')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Mes Offres d'Emploi
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Gérez vos annonces et suivez les candidatures
            </p>
        </div>
        <a href="{{ route('recruiter.create-offer') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium transition-colors flex items-center gap-2 text-sm sm:text-base">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
            </svg>
            Publier une offre
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        {{-- Total offres --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Total offres</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">2</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#333333] rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-5 h-5 sm:w-6 sm:h-6 text-[#9ca3af]"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                </div>
            </div>
        </div>

        {{-- Actives --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Actives</p>
                    <p class="text-xl sm:text-2xl font-bold text-green-400">2</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5 sm:w-6 sm:h-6 text-green-400"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </div>
            </div>
        </div>

        {{-- Expirées --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Expirées</p>
                    <p class="text-xl sm:text-2xl font-bold text-red-400">0</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-900/30 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-5 h-5 sm:w-6 sm:h-6 text-red-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        {{-- Brouillons --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Brouillons</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#9ca3af]">0</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#333333] rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-line w-5 h-5 sm:w-6 sm:h-6 text-[#9ca3af]"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-3 sm:gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher par titre ou département..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <select class="pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base min-w-[200px]">
                    <option value="">Tous les statuts</option>
                    <option value="Actif">Actif</option>
                    <option value="Expiré">Expiré</option>
                    <option value="Brouillon">Brouillon</option>
                    <option value="Suspendu">Suspendu</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Jobs List --}}
    <div class="space-y-4 sm:space-y-6">
        {{-- Job 1 --}}
        <div class="bg-[#2b2b2b] border border-[#00b6b4]/30 rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300 ring-2 ring-[#00b6b4]/20">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 sm:gap-6">
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                Développeur Frontend React
                            </h3>
                            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                                </svg>
                                Vedette
                            </span>
                        </div>
                        <span class="px-2 sm:px-3 ml-4 py-1 rounded-full text-xs sm:text-sm font-medium text-green-600 bg-green-100">
                            Actif
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 text-xs sm:text-sm text-[#9ca3af] mb-3 sm:mb-4">
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            <span>Développement</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>Chéraga, Alger</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <span>🏠</span>
                            <span>Remote</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                <line x1="16" x2="16" y1="2" y2="6"/>
                                <line x1="8" x2="8" y1="2" y2="6"/>
                                <line x1="3" x2="21" y1="10" y2="10"/>
                            </svg>
                            <span>Expire le 2024-02-18</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4">
                        <div class="text-base sm:text-lg font-bold text-[#f5f5f5]">
                            80,000 - 120,000 DA
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6 text-xs sm:text-sm text-[#9ca3af]">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <span>12 candidatures</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>89 vues</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 sm:gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-1 sm:gap-2">
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="1"/>
                                <circle cx="19" cy="12" r="1"/>
                                <circle cx="5" cy="12" r="1"/>
                            </svg>
                        </button>
                    </div>
                    <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg font-medium transition-colors whitespace-nowrap text-xs sm:text-sm">
                        Voir candidatures
                    </button>
                </div>
            </div>
        </div>

        {{-- Job 2 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 sm:gap-6">
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                Designer UX/UI
                            </h3>
                        </div>
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium text-green-600 bg-green-100">
                            Actif
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 text-xs sm:text-sm text-[#9ca3af] mb-3 sm:mb-4">
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            <span>Design</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span>Chéraga, Alger</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <span>🔄</span>
                            <span>Hybride</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                <line x1="16" x2="16" y1="2" y2="6"/>
                                <line x1="8" x2="8" y1="2" y2="6"/>
                                <line x1="3" x2="21" y1="10" y2="10"/>
                            </svg>
                            <span>Expire le 2024-02-18</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 sm:gap-4">
                        <div class="text-base sm:text-lg font-bold text-[#f5f5f5]">
                            70,000 - 100,000 DA
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6 text-xs sm:text-sm text-[#9ca3af]">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <span>8 candidatures</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>67 vues</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 sm:gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-1 sm:gap-2">
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="1"/>
                                <circle cx="19" cy="12" r="1"/>
                                <circle cx="5" cy="12" r="1"/>
                            </svg>
                        </button>
                    </div>
                    <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg font-medium transition-colors whitespace-nowrap text-xs sm:text-sm">
                        Voir candidatures
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
