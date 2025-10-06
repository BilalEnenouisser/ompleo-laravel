@extends('layouts.dashboard')

@section('title', 'Tableau de bord - OMPLEO')
@section('description', 'Gérez vos recrutements depuis votre tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-[#00b6b4] to-[#009e9c] rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold mb-2">
                    Bonjour {{ auth()->user()->first_name ?? 'Recruteur' }} ! 👋
                </h1>
                <p class="text-[#b3e5e4] text-base sm:text-lg">
                    Gérez vos recrutements depuis votre tableau de bord
                </p>
                <p class="text-[#80d4d2] mt-2 text-sm sm:text-base">
                    {{ auth()->user()->company ?? 'Entreprise' }} • Recruteur
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 sm:w-24 sm:h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-10 h-10 sm:w-12 sm:h-12 text-white"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        {{-- Offres actives --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1));">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(37 99 235 / var(--tw-text-opacity, 1));"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">
                8
            </h3>
            <p class="text-[#9ca3af] text-sm mb-2">
                Offres actives
            </p>
            <p class="text-green-400 text-xs font-medium">
                +2 cette semaine
            </p>
        </div>

        {{-- Candidatures reçues --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1));">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">
                47
            </h3>
            <p class="text-[#9ca3af] text-sm mb-2">
                Candidatures reçues
            </p>
            <p class="text-green-400 text-xs font-medium">
                +12 cette semaine
            </p>
        </div>

        {{-- Profils consultés --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(243 232 255 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(147 51 234 / var(--tw-text-opacity, 1));">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">
                156
            </h3>
            <p class="text-[#9ca3af] text-sm mb-2">
                Profils consultés
            </p>
            <p class="text-green-400 text-xs font-medium">
                +23 cette semaine
            </p>
        </div>

        {{-- Entretiens programmés --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(255 237 213 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(234 88 12 / var(--tw-text-opacity, 1));">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">
                5
            </h3>
            <p class="text-[#9ca3af] text-sm mb-2">
                Entretiens programmés
            </p>
            <p class="text-green-400 text-xs font-medium">
                +3 cette semaine
            </p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Actions rapides
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="flex items-center gap-3 p-4 border-2 border-dashed border-[#00b6b4]/30 rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">Publier une offre</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af]">Créer une nouvelle annonce</div>
                </div>
            </button>

            <button class="flex items-center gap-3 p-4 border-2 border-dashed border-[#333333] rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">Parcourir les CV</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af]">Rechercher des candidats</div>
                </div>
            </button>

            <button class="flex items-center gap-3 p-4 border-2 border-dashed border-[#333333] rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-orange-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">Programmer entretien</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af]">Organiser un RDV</div>
                </div>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
        {{-- Recent Applications --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Candidatures récentes
                </h2>
                <button class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                    Voir tout
                </button>
            </div>
            <div class="space-y-4">
                {{-- Application 1 --}}
                <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-sm">
                            AB
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                                Ahmed Belkacem
                            </h3>
                            <p class="text-sm text-[#9ca3af]">
                                Développeur Frontend React
                            </p>
                            <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                                <span>3 ans</span>
                                <span>•</span>
                                <span>Alger</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium" style="color: rgb(37 99 235 / var(--tw-text-opacity, 1)); background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1));">
                            Nouveau
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-18
                        </p>
                    </div>
                </div>

                {{-- Application 2 --}}
                <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-sm">
                            FZ
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                                Fatima Zohra
                            </h3>
                            <p class="text-sm text-[#9ca3af]">
                                Designer UX/UI
                            </p>
                            <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                                <span>2 ans</span>
                                <span>•</span>
                                <span>Oran</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium" style="background-color: rgb(254 249 195 / var(--tw-bg-opacity, 1)); color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            En cours
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-17
                        </p>
                    </div>
                </div>

                {{-- Application 3 --}}
                <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-sm">
                            KB
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                                Karim Boudjadar
                            </h3>
                            <p class="text-sm text-[#9ca3af]">
                                Community Manager
                            </p>
                            <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                                <span>4 ans</span>
                                <span>•</span>
                                <span>Constantine</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1)); background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                            Entretien
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-16
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Active Jobs --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Offres actives
                </h2>
                <button class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                    Gérer
                </button>
            </div>
            <div class="space-y-4">
                {{-- Job 1 --}}
                <div class="p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            Développeur Frontend React
                        </h3>
                        <span class="text-green-400 bg-green-900/30 px-2 py-1 rounded-full text-xs font-medium">
                            Actif
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-[#9ca3af]">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                12 candidatures
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                89 vues
                            </span>
                        </div>
                        <span>2024-01-10</span>
                    </div>
                </div>

                {{-- Job 2 --}}
                <div class="p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            Designer UX/UI
                        </h3>
                        <span class="text-green-400 bg-green-900/30 px-2 py-1 rounded-full text-xs font-medium">
                            Actif
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-[#9ca3af]">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                8 candidatures
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                67 vues
                            </span>
                        </div>
                        <span>2024-01-12</span>
                    </div>
                </div>

                {{-- Job 3 --}}
                <div class="p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            Community Manager
                        </h3>
                        <span class="text-green-400 bg-green-900/30 px-2 py-1 rounded-full text-xs font-medium">
                            Actif
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm text-[#9ca3af]">
                        <div class="flex items-center gap-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                15 candidatures
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                134 vues
                            </span>
                        </div>
                        <span>2024-01-08</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Upcoming Interviews --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Entretiens à venir
        </h2>
        <div class="space-y-4">
            {{-- Interview 1 --}}
            <div class="flex items-center justify-between p-4 bg-blue-900/20 rounded-xl border border-blue-800">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            Nadia Mammeri
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            Développeur Full Stack
                        </p>
                        <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                            <span>2024-01-20</span>
                            <span>•</span>
                            <span>14:00</span>
                            <span>•</span>
                            <span>Visioconférence</span>
                        </div>
                    </div>
                </div>
                <button class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Détails
                </button>
            </div>

            {{-- Interview 2 --}}
            <div class="flex items-center justify-between p-4 bg-blue-900/20 rounded-xl border border-blue-800">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            Youcef Slimani
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            Product Manager
                        </p>
                        <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                            <span>2024-01-21</span>
                            <span>•</span>
                            <span>10:30</span>
                            <span>•</span>
                            <span>Présentiel</span>
                        </div>
                    </div>
                </div>
                <button class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Détails
                </button>
            </div>
        </div>
    </div>
</div>
@endsection