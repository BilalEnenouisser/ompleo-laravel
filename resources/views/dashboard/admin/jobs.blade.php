@extends('layouts.dashboard')

@section('title', 'Offres d\'Emploi - OMPLEO')
@section('description', 'Modérez et gérez toutes les offres d\'emploi de la plateforme OMPLEO.')
@section('page-title', 'Offres d\'Emploi')

@section('content')
<div class="w-full space-y-4 md:space-y-6 lg:space-y-8">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Offres d'Emploi
            </h1>
            <p class="text-sm md:text-base text-[#9ca3af] mt-1 md:mt-2">
                Modérez et gérez toutes les offres d'emploi
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 md:gap-4 lg:gap-6">
        <!-- Total -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Total</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#f5f5f5]">5</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                        <path d="M10 6h4"/>
                        <path d="M10 10h4"/>
                        <path d="M10 14h4"/>
                        <path d="M10 18h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Actives -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Actives</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-green-600">2</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="M22 4 12 14.01l-3-3"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- En attente -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-yellow-600">1</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-yellow-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Expirées -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Expirées</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-red-600">1</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-red-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Suspendues -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Suspendues</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#9ca3af]">1</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- À modérer -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">À modérer</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-orange-600">1</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-orange-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher par titre ou entreprise..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <select class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="active">Actif</option>
                    <option value="pending">En attente</option>
                    <option value="expired">Expiré</option>
                    <option value="suspended">Suspendu</option>
                </select>
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                    <path d="M10 6h4"/>
                    <path d="M10 10h4"/>
                    <path d="M10 14h4"/>
                    <path d="M10 18h4"/>
                </svg>
                <select class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Toutes les entreprises</option>
                    <option value="IMPACTOME">IMPACTOME</option>
                    <option value="OMPLEO">OMPLEO</option>
                    <option value="CONDOR">CONDOR</option>
                    <option value="TechCorp">TechCorp</option>
                    <option value="DataCorp">DataCorp</option>
                </select>
            </div>
            
            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-3 sm:px-4 py-2 sm:py-3 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <span class="hidden sm:inline">Filtres avancés</span>
                <span class="sm:hidden">Filtres</span>
            </button>
        </div>
    </div>

    {{-- Jobs Table --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Offre</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5] min-w-[200px] sm:min-w-0">Entreprise</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Statut</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Modération</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Performance</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Dates</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Job 1 --}}
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6 min-w-[340px] sm:min-w-0">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2">
                                    <span>Développeur Frontend React</span>
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-medium">Vedette</span>
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        Chéraga, Alger
                                    </span>
                                    <span>CDI</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">IMPACTOME</div>
                            <div class="text-sm text-[#9ca3af]">80,000 - 120,000 DA</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                Actif
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                Approuvé
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    18 candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    234 vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    2024-01-10
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Expire: 2024-02-10
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Job 2: Designer UX/UI --}}
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2">
                                    <span>Designer UX/UI</span>
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        Chéraga, Alger
                                    </span>
                                    <span>CDI</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">OMPLEO</div>
                            <div class="text-sm text-[#9ca3af]">70,000 - 100,000 DA</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                Actif
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                Approuvé
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    12 candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    189 vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    2024-01-12
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Expire: 2024-02-12
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Job 3: Community Manager --}}
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2">
                                    <span>Community Manager</span>
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        El Harrach, Alger
                                    </span>
                                    <span>CDI</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">CONDOR</div>
                            <div class="text-sm text-[#9ca3af]">60,000 - 80,000 DA</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-red-600 bg-red-100">
                                Expiré
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                Approuvé
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    15 candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    156 vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    2024-01-08
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Expire: 2024-01-18
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Job 4: Développeur Full Stack --}}
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2">
                                    <span>Développeur Full Stack</span>
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        Remote
                                    </span>
                                    <span>Freelance</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">TechCorp</div>
                            <div class="text-sm text-[#9ca3af]">100,000 - 150,000 DA</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-yellow-600 bg-yellow-100">
                                En attente
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-yellow-600 bg-yellow-100">
                                En attente
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    0 candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    0 vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    2024-01-15
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Expire: 2024-02-15
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-[#9ca3af] hover:text-green-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <path d="M22 4 12 14.01l-3-3"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="m15 9-6 6"/>
                                        <path d="m9 9 6 6"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- Job 5: Data Analyst --}}
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2">
                                    <span>Data Analyst</span>
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        Oran
                                    </span>
                                    <span>CDI</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">DataCorp</div>
                            <div class="text-sm text-[#9ca3af]">90,000 - 130,000 DA</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-[#9ca3af] bg-gray-100">
                                Suspendu
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-red-600 bg-red-100">
                                Rejeté
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    8 candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    98 vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    2024-01-13
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Expire: 2024-02-13
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
        <p class="text-xs md:text-sm lg:text-base text-[#9ca3af]">
            Affichage de 5 offre(s)
        </p>
        <div class="flex items-center gap-2">
            <button class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">Précédent</button>
            <button class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">Suivant</button>
        </div>
    </div>
</div>
@endsection
