@extends('layouts.dashboard')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#f5f5f5]">
                Mes Candidatures
            </h1>
            <p class="text-[#9ca3af] mt-2">
                Suivez l'état de vos candidatures en temps réel
            </p>
        </div>
        <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-5 h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
            Exporter PDF
        </button>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Total</p>
                    <p class="text-2xl font-bold text-[#f5f5f5]">2</p>
                </div>
                <div class="w-12 h-12 bg-[#333333] rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-6 h-6 text-[#9ca3af]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">En cours</p>
                    <p class="text-2xl font-bold text-yellow-400">1</p>
                </div>
                <div class="w-12 h-12 bg-yellow-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Acceptées</p>
                    <p class="text-2xl font-bold text-green-400">1</p>
                </div>
                <div class="w-12 h-12 bg-green-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Refusées</p>
                    <p class="text-2xl font-bold text-red-400">0</p>
                </div>
                <div class="w-12 h-12 bg-red-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-2xl font-bold text-blue-400">0</p>
                </div>
                <div class="w-12 h-12 bg-blue-400/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input
                    type="text"
                    placeholder="Rechercher par poste ou entreprise..."
                    class="w-full pl-10 pr-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/></svg>
                <select class="pl-10 pr-8 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] min-w-[200px]">
                    <option value="">Tous les statuts</option>
                    <option value="En cours">En cours</option>
                    <option value="Accepté">Accepté</option>
                    <option value="Refusé">Refusé</option>
                    <option value="En attente">En attente</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Applications List --}}
    <div class="space-y-6">
        {{-- Application 1 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#333333] flex-shrink-0">
                        <img
                            src="https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=100"
                            alt="IMPACTOME"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-xl font-bold text-[#f5f5f5] hover:text-[#00b6b4] cursor-pointer">
                                Développeur Frontend React
                            </h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1)); background-color: rgb(254 249 195 / var(--tw-bg-opacity, 1));">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                En cours
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 text-[#9ca3af] mb-3">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                                <span class="font-medium">IMPACTOME</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Chéraga, Alger</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>Postulé le 2024-01-15</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-lg font-bold text-[#f5f5f5]">
                                80,000 - 120,000 DA
                            </div>
                            <div class="text-sm text-[#9ca3af]">
                                Dernière mise à jour : 2024-01-15
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Note :</strong> Entretien prévu pour la semaine prochaine
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Voir l'offre
                    </button>
                    <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Contacter
                    </button>
                </div>
            </div>
        </div>

        {{-- Application 2 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-[#333333] flex-shrink-0">
                        <img
                            src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=100"
                            alt="OMPLEO"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-xl font-bold text-[#f5f5f5] hover:text-[#00b6b4] cursor-pointer">
                                Designer UX/UI
                            </h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium flex items-center gap-2" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1)); background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                                Accepté
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-4 text-[#9ca3af] mb-3">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                                <span class="font-medium">OMPLEO</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Chéraga, Alger</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>Postulé le 2024-01-12</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-lg font-bold text-[#f5f5f5]">
                                70,000 - 100,000 DA
                            </div>
                            <div class="text-sm text-[#9ca3af]">
                                Dernière mise à jour : 2024-01-13
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Note :</strong> Félicitations ! Début prévu le 1er février
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Voir l'offre
                    </button>
                    <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Contacter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
