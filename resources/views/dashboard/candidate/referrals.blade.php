@extends('layouts.dashboard')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="text-center">
        <div class="w-20 h-20 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
            <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <h1 class="text-3xl font-bold text-[#f5f5f5] mb-4">
            Programme de Parrainage
        </h1>
        <p class="text-xl text-[#9ca3af] max-w-3xl mx-auto">
            Invitez vos amis à rejoindre OMPLEO et gagnez des points pour chaque inscription réussie
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Total parrainages</p>
                    <p class="text-2xl font-bold text-[#f5f5f5]">8</p>
                </div>
                <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Réussis</p>
                    <p class="text-2xl font-bold text-green-400">5</p>
                </div>
                <div class="w-12 h-12 bg-green-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-2xl font-bold text-blue-400">3</p>
                </div>
                <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Points totaux</p>
                    <p class="text-2xl font-bold text-yellow-400">250</p>
                </div>
                <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Récompenses</p>
                    <p class="text-2xl font-bold text-purple-400">2</p>
                </div>
                <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5l7-7 7 7"/><path d="M17 17v-3a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Referral Tools --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-[#f5f5f5] mb-6">
            Partagez votre lien de parrainage
        </h2>
        
        <div class="space-y-6">
            {{-- Referral Code --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Votre code de parrainage
                </label>
                <div class="flex items-center gap-3">
                    <input
                        type="text"
                        value="OMPLEO-REF-2024"
                        readonly
                        class="flex-1 px-4 py-3 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] font-mono"
                    />
                    <button id="copyCodeBtn" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-3 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        <span id="copyCodeText">Copier</span>
                    </button>
                </div>
            </div>

            {{-- Referral Link --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Lien de parrainage
                </label>
                <div class="flex items-center gap-3">
                    <input
                        type="text"
                        value="https://ompleo.com/register?ref=OMPLEO-REF-2024"
                        readonly
                        class="flex-1 px-4 py-3 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] text-sm"
                    />
                    <button id="shareLinkBtn" class="px-4 py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16,6 12,2 8,6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                        Partager
                    </button>
                </div>
            </div>

            {{-- Social Sharing --}}
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-4">
                    Partager sur les réseaux sociaux
                </label>
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        Facebook
                    </button>
                    <button class="flex items-center gap-2 px-4 py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                        Twitter
                    </button>
                    <button class="flex items-center gap-2 px-4 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                        LinkedIn
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- How it Works --}}
    <div class="bg-gradient-to-br from-[#00b6b4]/10 to-[#009999]/10 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-[#f5f5f5] mb-8 text-center">
            Comment ça marche ?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-[#00b6b4] text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16,6 12,2 8,6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2">1. Partagez</h3>
                <p class="text-[#9ca3af]">Envoyez votre lien de parrainage à vos amis</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-[#009999] text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2">2. Inscription</h3>
                <p class="text-[#9ca3af]">Vos amis s'inscrivent avec votre code</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-500 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5l7-7 7 7"/><path d="M17 17v-3a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3"/></svg>
                </div>
                <h3 class="font-bold text-[#f5f5f5] mb-2">3. Récompenses</h3>
                <p class="text-[#9ca3af]">Gagnez des points et débloquez des récompenses</p>
            </div>
        </div>
    </div>

    {{-- Rewards --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-[#f5f5f5] mb-6">
            Récompenses disponibles
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
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
                            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
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
                            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
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
                            <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
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
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <h2 class="text-2xl font-bold text-[#f5f5f5] mb-6">
            Historique des parrainages
        </h2>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold">
                        AB
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5]">
                            Ahmed Belkacem
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            ahmed.b@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-green-400 bg-green-400/20">
                            Inscrit
                        </span>
                        <p class="text-sm text-[#9ca3af] mt-1">
                            2024-01-15
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                            <span class="font-bold">50</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold">
                        FZ
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5]">
                            Fatima Zohra
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            fatima.z@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-yellow-400 bg-yellow-400/20">
                            Certifié
                        </span>
                        <p class="text-sm text-[#9ca3af] mt-1">
                            2024-01-12
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                            <span class="font-bold">100</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold">
                        KB
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5]">
                            Karim Boudjadar
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            karim.b@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-blue-400 bg-blue-400/20">
                            En attente
                        </span>
                        <p class="text-sm text-[#9ca3af] mt-1">
                            2024-01-18
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                            <span class="font-bold">0</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold">
                        NM
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5]">
                            Nadia Mammeri
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            nadia.m@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-green-400 bg-green-400/20">
                            Inscrit
                        </span>
                        <p class="text-sm text-[#9ca3af] mt-1">
                            2024-01-10
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                            <span class="font-bold">50</span>
                        </div>
                        <p class="text-xs text-[#9ca3af]">points</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold">
                        YS
                    </div>
                    <div>
                        <h3 class="font-semibold text-[#f5f5f5]">
                            Youcef Slimani
                        </h3>
                        <p class="text-sm text-[#9ca3af]">
                            youcef.s@email.com
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <span class="px-3 py-1 rounded-full text-sm font-medium text-yellow-400 bg-yellow-400/20">
                            Certifié
                        </span>
                        <p class="text-sm text-[#9ca3af] mt-1">
                            2024-01-08
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14 18,18 12,17.77 7,18 8,14 2,9.27 8.91,8.26"/></svg>
                            <span class="font-bold">100</span>
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
