@extends('layouts.dashboard')

@section('content')
<div class="space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-[#00b6b4] to-[#009999] rounded-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">
                    Bonjour Ahmed ! 👋
                </h1>
                <p class="text-white/80 text-lg">
                    Voici un aperçu de votre activité récente
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
                </div>
                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">12</h3>
            <p class="text-[#9ca3af] text-sm mb-2">Candidatures envoyées</p>
            <p class="text-green-400 text-xs font-medium">+3 cette semaine</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">47</h3>
            <p class="text-[#9ca3af] text-sm mb-2">Profil consulté</p>
            <p class="text-green-400 text-xs font-medium">+12 cette semaine</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>
                </div>
                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">8</h3>
            <p class="text-[#9ca3af] text-sm mb-2">Offres sauvegardées</p>
            <p class="text-green-400 text-xs font-medium">+2 cette semaine</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">5</h3>
            <p class="text-[#9ca3af] text-sm mb-2">Messages reçus</p>
            <p class="text-green-400 text-xs font-medium">+1 aujourd'hui</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Applications --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#f5f5f5]">
                    Candidatures récentes
                </h2>
                <button class="text-[#00b6b4] hover:text-[#009999] text-sm font-medium">
                    Voir tout
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Développeur Frontend React
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            IMPACTOME • 2024-01-15
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium text-yellow-400 bg-yellow-400/20">
                        En cours
                    </span>
                </div>
                
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Designer UX/UI
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            OMPLEO • 2024-01-12
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium text-green-400 bg-green-400/20">
                        Accepté
                    </span>
                </div>
                
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Community Manager
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            CONDOR • 2024-01-10
                        </p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-medium text-red-400 bg-red-400/20">
                        Refusé
                    </span>
                </div>
            </div>
        </div>

        {{-- Recommended Jobs --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#f5f5f5]">
                    Offres recommandées
                </h2>
                <button class="text-[#00b6b4] hover:text-[#009999] text-sm font-medium">
                    Voir plus
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Développeur Full Stack
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            TechCorp • Alger
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-[#00b6b4] font-bold text-sm mb-1">
                            95% match
                        </div>
                        <button class="text-xs text-[#00b6b4] hover:text-[#009999] font-medium">
                            Postuler
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Product Manager
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            StartupXYZ • Remote
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-[#00b6b4] font-bold text-sm mb-1">
                            88% match
                        </div>
                        <button class="text-xs text-[#00b6b4] hover:text-[#009999] font-medium">
                            Postuler
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] mb-1">
                            Data Analyst
                        </h3>
                        <p class="text-[#9ca3af] text-sm">
                            DataCorp • Oran
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="text-[#00b6b4] font-bold text-sm mb-1">
                            82% match
                        </div>
                        <button class="text-xs text-[#00b6b4] hover:text-[#009999] font-medium">
                            Postuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
        <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
            Actions rapides
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="flex items-center gap-3 p-4 border-2 border-dashed border-[#444444] rounded-xl hover:border-[#00b6b4] hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="text-left">
                    <div class="font-medium text-[#f5f5f5]">Compléter mon profil</div>
                    <div class="text-sm text-[#9ca3af]">85% complété</div>
                </div>
            </button>

            <button class="flex items-center gap-3 p-4 border-2 border-dashed border-[#444444] rounded-xl hover:border-[#00b6b4] hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-10 h-10 bg-green-400/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="text-left">
                    <div class="font-medium text-[#f5f5f5]">Parrainer un ami</div>
                    <div class="text-sm text-[#9ca3af]">Gagnez des points</div>
                </div>
            </button>
        </div>
    </div>

    {{-- Upcoming Events --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
        <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
            Prochains événements
        </h2>
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-4 bg-blue-400/20 rounded-xl">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-[#f5f5f5]">
                        Entretien avec IMPACTOME
                    </h3>
                    <p class="text-[#9ca3af] text-sm">
                        Demain à 14h00 • Visioconférence
                    </p>
                </div>
                <button class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                    Détails
                </button>
            </div>
        </div>
    </div>
</div>
@endsection