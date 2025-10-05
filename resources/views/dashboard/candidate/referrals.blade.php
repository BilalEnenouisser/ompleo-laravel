@extends('layouts.dashboard')

@section('page-title', 'Parrainer un ami')
@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="text-center">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 animate-pulse-glow">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-8 h-8 sm:w-10 sm:h-10 text-white"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5] mb-3 sm:mb-4">
            Programme de Parrainage
        </h1>
        <p class="text-base sm:text-xl text-[#9ca3af] max-w-3xl mx-auto px-4">
            Invitez vos amis à rejoindre OMPLEO et gagnez des points pour chaque inscription réussie
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Total parrainages</p>
                    <p class="text-lg sm:text-2xl font-bold text-[#f5f5f5]">8</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-4 h-4 sm:w-6 sm:h-6 text-[#00b6b4]"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Réussis</p>
                    <p class="text-lg sm:text-2xl font-bold text-green-400">5</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-green-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4 sm:w-6 sm:h-6 text-green-400"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-lg sm:text-2xl font-bold text-blue-400">3</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-blue-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target w-4 h-4 sm:w-6 sm:h-6 text-blue-400"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Points totaux</p>
                    <p class="text-lg sm:text-2xl font-bold text-yellow-400">250</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-yellow-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 sm:w-6 sm:h-6 text-yellow-400"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Récompenses</p>
                    <p class="text-lg sm:text-2xl font-bold text-purple-400">2</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-purple-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-4 h-4 sm:w-6 sm:h-6 text-purple-400"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Referral Tools --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Partagez votre lien de parrainage
        </h2>
        
        <div class="space-y-4 sm:space-y-6">
            {{-- Referral Code --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Votre code de parrainage
                </label>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <input
                        type="text"
                        value="OMPLEO-REF-2024"
                        readonly
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] font-mono text-sm sm:text-base"
                    />
                    <button id="copyCodeBtn" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 sm:py-3 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy w-4 h-4"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        <span id="copyCodeText">Copier</span>
                    </button>
                </div>
            </div>

            {{-- Referral Link --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Lien de parrainage
                </label>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <input
                        type="text"
                        value="https://ompleo.com/register?ref=OMPLEO-REF-2024"
                        readonly
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm"
                    />
                    <button id="shareLinkBtn" class="px-4 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share w-4 h-4"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16,6 12,2 8,6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                        Partager
                    </button>
                </div>
            </div>

            {{-- Social Sharing --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-3 sm:mb-4">
                    Partager sur les réseaux sociaux
                </label>
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                    <button class="flex items-center justify-center gap-2 px-3 sm:px-4 py-2 sm:py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook w-4 h-4 sm:w-5 sm:h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        Facebook
                    </button>
                    <button class="flex items-center justify-center gap-2 px-3 sm:px-4 py-2 sm:py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter w-4 h-4 sm:w-5 sm:h-5"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                        Twitter
                    </button>
                    <button class="flex items-center justify-center gap-2 px-3 sm:px-4 py-2 sm:py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition-colors text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin w-4 h-4 sm:w-5 sm:h-5"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        LinkedIn
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- How it Works --}}
    <div class="bg-gradient-to-br from-[#00b6b4]/10 to-[#009999]/10 rounded-xl sm:rounded-2xl p-4 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-6 sm:mb-8 text-center">
            Comment ça marche ?
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
            <div class="text-center">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#00b6b4] text-white rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2 w-6 h-6 sm:w-8 sm:h-8"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2 text-sm sm:text-base">1. Partagez</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Envoyez votre lien de parrainage à vos amis</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#009999] text-white rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus w-6 h-6 sm:w-8 sm:h-8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2 text-sm sm:text-base">2. Inscription</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Vos amis s'inscrivent avec votre code</p>
            </div>
            <div class="text-center">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-yellow-500 text-white rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-6 h-6 sm:w-8 sm:h-8"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2 text-sm sm:text-base">3. Récompenses</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Gagnez des points et débloquez des récompenses</p>
            </div>
        </div>
    </div>

    {{-- Rewards --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Récompenses disponibles
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <div class="border-2 border-[#00b6b4]/30 rounded-2xl p-6 transition-all duration-300 hover:border-[#00b6b4]/50 hover:shadow-lg">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-[#f5f5f5] mb-2">
                            Consultation CV gratuite
                        </h3>
                        <p class="text-[#9ca3af] text-sm mb-3">
                            Bénéficiez d'une révision professionnelle de votre CV
                        </p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 text-yellow-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-medium text-[#f5f5f5]">
                                100 points
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors">
                            Échanger
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-2 border-[#00b6b4]/30 rounded-2xl p-6 transition-all duration-300 hover:border-[#00b6b4]/50 hover:shadow-lg">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-[#f5f5f5] mb-2">
                            Formation en ligne
                        </h3>
                        <p class="text-[#9ca3af] text-sm mb-3">
                            Accès à une formation de votre choix
                        </p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 text-yellow-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-medium text-[#f5f5f5]">
                                200 points
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors">
                            Échanger
                        </button>
                    </div>
                </div>
            </div>

            <div class="border-2 border-[#333333] rounded-2xl p-6 opacity-60">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-[#f5f5f5] mb-2">
                            Entretien coaching
                        </h3>
                        <p class="text-[#9ca3af] text-sm mb-3">
                            Session de coaching pour vos entretiens
                        </p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 text-yellow-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-medium text-[#f5f5f5]">
                                300 points
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="px-4 py-2 bg-[#333333] text-[#9ca3af] rounded-lg">
                            Indisponible
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-2 border-[#333333] rounded-2xl p-6 opacity-60">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="font-bold text-[#f5f5f5] mb-2">
                            Certification premium
                        </h3>
                        <p class="text-[#9ca3af] text-sm mb-3">
                            Certification avancée avec photo professionnelle
                        </p>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-4 h-4 text-yellow-500"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-medium text-[#f5f5f5]">
                                500 points
                            </span>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="px-4 py-2 bg-[#333333] text-[#9ca3af] rounded-lg">
                            Indisponible
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Referral History --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-8 shadow-lg">
        <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Historique des parrainages
        </h2>
        <div class="space-y-3 sm:space-y-4">
            <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        AB
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            Ahmed Belkacem
                        </h3>
                        <p class="text-xs sm:text-sm text-[#9ca3af] truncate">
                            ahmed.b@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1)); background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                            Inscrit
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-15
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 sm:w-4 sm:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-bold text-sm sm:text-base">50</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        FZ
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            Fatima Zohra
                        </h3>
                        <p class="text-xs sm:text-sm text-[#9ca3af] truncate">
                            fatima.z@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1)); background-color: rgb(254 249 195 / var(--tw-bg-opacity, 1));">
                            Certifié
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-12
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 sm:w-4 sm:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-bold text-sm sm:text-base">100</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        KB
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            Karim Boudjadar
                        </h3>
                        <p class="text-xs sm:text-sm text-[#9ca3af] truncate">
                            karim.b@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium" style="background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1)); color: rgb(37 99 235 / var(--tw-text-opacity, 1));">
                            En attente
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-18
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 sm:w-4 sm:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-bold text-sm sm:text-base">0</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        NM
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            Nadia Mammeri
                        </h3>
                        <p class="text-xs sm:text-sm text-[#9ca3af] truncate">
                            nadia.m@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1)); background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                            Inscrit
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-10
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 sm:w-4 sm:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-bold text-sm sm:text-base">50</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                        YS
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            Youcef Slimani
                        </h3>
                        <p class="text-xs sm:text-sm text-[#9ca3af] truncate">
                            youcef.s@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                    <div class="text-right">
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1)); background-color: rgb(254 249 195 / var(--tw-bg-opacity, 1));">
                            Certifié
                        </span>
                        <p class="text-xs text-[#9ca3af] mt-1">
                            2024-01-08
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star w-3 h-3 sm:w-4 sm:h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="font-bold text-sm sm:text-base">100</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyCodeBtn = document.getElementById('copyCodeBtn');
    const copyCodeText = document.getElementById('copyCodeText');
    const shareLinkBtn = document.getElementById('shareLinkBtn');
    
    copyCodeBtn.addEventListener('click', function() {
        navigator.clipboard.writeText('OMPLEO-REF-2024').then(function() {
            copyCodeText.textContent = 'Copié';
            setTimeout(function() {
                copyCodeText.textContent = 'Copier';
            }, 2000);
        });
    });
    
    shareLinkBtn.addEventListener('click', function() {
        navigator.clipboard.writeText('https://ompleo.com/register?ref=OMPLEO-REF-2024').then(function() {
            alert('Lien copié dans le presse-papiers !');
        });
    });
});
</script>
@endsection
