@extends('layouts.dashboard')

@section('title', 'Base de Candidats - OMPLEO')
@section('description', 'Découvrez et contactez les meilleurs talents.')
@section('page-title', 'Candidats')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">Base de Candidats</h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">Découvrez et contactez les meilleurs talents</p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3">
            <button class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                Exporter
            </button>
            <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filtres avancés
            </button>
        </div>
    </div>

    {{-- Search and Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
            <div class="lg:col-span-2 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" placeholder="Nom, poste, compétences..." class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"/>
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <select class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Toutes les villes</option>
                    <option value="Alger">Alger</option>
                    <option value="Oran">Oran</option>
                    <option value="Constantine">Constantine</option>
                </select>
            </div>
            <div class="relative">
                <select class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Expérience</option>
                    <option value="0-1">0-1 an</option>
                    <option value="2-3">2-3 ans</option>
                    <option value="4-5">4-5 ans</option>
                    <option value="5+">5+ ans</option>
                </select>
            </div>
            <div class="relative">
                <input type="text" placeholder="Compétence..." class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"/>
            </div>
        </div>
    </div>

    {{-- Results Count --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm sm:text-base text-[#9ca3af]">4 candidat(s) trouvé(s)</p>
        <select class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
            <option>Pertinence</option>
            <option>Plus récents</option>
            <option>Mieux notés</option>
            <option>Expérience</option>
        </select>
    </div>

    {{-- Candidates Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Candidate 1 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-[1.02]">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-full flex items-center justify-center">
                    <span class="text-[#00b6b4] font-bold text-lg">AB</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-[#f5f5f5]">Ahmed Belkacem</h3>
                            <p class="text-[#00b6b4] font-medium">Développeur Frontend React</p>
                        </div>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <span class="text-sm text-[#9ca3af]">(4.8)</span>
                    </div>
                </div>
            </div>
            <p class="text-[#9ca3af] text-sm mb-4 line-clamp-2">Développeur passionné avec 3 ans d'expérience en React et TypeScript.</p>
            <div class="space-y-3 mb-4">
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Alger, Chéraga</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>3 ans d'expérience</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>Master en Informatique</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span>Disponible : Immédiate</span>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-sm text-[#9ca3af] mb-2">Compétences :</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">React</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">TypeScript</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Node.js</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">MongoDB</span>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-[#f5f5f5]">80,000 - 120,000 DA</div>
                <div class="text-sm text-[#9ca3af]">Actif le 2024-01-18</div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Contacter
                </button>
                <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Voir profil
                </button>
            </div>
        </div>

        {{-- Candidate 2 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-[1.02]">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-full flex items-center justify-center">
                    <span class="text-[#00b6b4] font-bold text-lg">FZ</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-[#f5f5f5]">Fatima Zohra</h3>
                            <p class="text-[#00b6b4] font-medium">Designer UX/UI</p>
                        </div>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <span class="text-sm text-[#9ca3af]">(4.5)</span>
                    </div>
                </div>
            </div>
            <p class="text-[#9ca3af] text-sm mb-4 line-clamp-2">Designer créative spécialisée en UX/UI avec un portfolio diversifié.</p>
            <div class="space-y-3 mb-4">
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Oran</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>2 ans d'expérience</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>Licence en Design Graphique</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span>Disponible : 1 mois</span>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-sm text-[#9ca3af] mb-2">Compétences :</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Figma</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Adobe XD</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Photoshop</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Illustrator</span>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-[#f5f5f5]">60,000 - 90,000 DA</div>
                <div class="text-sm text-[#9ca3af]">Actif le 2024-01-17</div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Contacter
                </button>
                <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Voir profil
                </button>
            </div>
        </div>

        {{-- Candidate 3 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-[1.02]">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-full flex items-center justify-center">
                    <span class="text-[#00b6b4] font-bold text-lg">KB</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-[#f5f5f5]">Karim Boudjadar</h3>
                            <p class="text-[#00b6b4] font-medium">Community Manager</p>
                        </div>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <span class="text-sm text-[#9ca3af]">(4.9)</span>
                    </div>
                </div>
            </div>
            <p class="text-[#9ca3af] text-sm mb-4 line-clamp-2">Expert en gestion de communautés avec une forte expertise en marketing digital.</p>
            <div class="space-y-3 mb-4">
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Constantine</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>4 ans d'expérience</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>Master en Marketing Digital</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span>Disponible : 2 semaines</span>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-sm text-[#9ca3af] mb-2">Compétences :</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Social Media</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Content Creation</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Analytics</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">SEO</span>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-[#f5f5f5]">50,000 - 80,000 DA</div>
                <div class="text-sm text-[#9ca3af]">Actif le 2024-01-16</div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Contacter
                </button>
                <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Voir profil
                </button>
            </div>
        </div>

        {{-- Candidate 4 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-[1.02]">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-full flex items-center justify-center">
                    <span class="text-[#00b6b4] font-bold text-lg">NM</span>
                </div>
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-[#f5f5f5]">Nadia Mammeri</h3>
                            <p class="text-[#00b6b4] font-medium">Data Analyst</p>
                        </div>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <svg class="w-4 h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                        <span class="text-sm text-[#9ca3af]">(4.7)</span>
                    </div>
                </div>
            </div>
            <p class="text-[#9ca3af] text-sm mb-4 line-clamp-2">Analyste de données expérimentée avec une expertise en visualisation.</p>
            <div class="space-y-3 mb-4">
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>Alger, Hydra</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>5 ans d'expérience</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <span>Master en Statistiques</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <span>Disponible : Immédiate</span>
                </div>
            </div>
            <div class="mb-4">
                <p class="text-sm text-[#9ca3af] mb-2">Compétences :</p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Python</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">SQL</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Tableau</span>
                    <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">Power BI</span>
                </div>
            </div>
            <div class="flex items-center justify-between mb-4">
                <div class="text-lg font-bold text-[#f5f5f5]">90,000 - 130,000 DA</div>
                <div class="text-sm text-[#9ca3af]">Actif le 2024-01-15</div>
            </div>
            <div class="flex items-center gap-2">
                <button class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Contacter
                </button>
                <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Voir profil
                </button>
            </div>
        </div>
    </div>

    {{-- Load More --}}
    <div class="text-center">
        <button class="px-6 sm:px-8 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors text-sm sm:text-base">
            Charger plus de candidats
        </button>
    </div>
</div>
@endsection
