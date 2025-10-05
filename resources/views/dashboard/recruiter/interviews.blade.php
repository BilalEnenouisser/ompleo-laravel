@extends('layouts.dashboard')
@section('page-title', 'Entretiens')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#f5f5f5]">
                Entretiens
            </h1>
            <p class="text-[#9ca3af] mt-2">
                Planifiez et gérez vos entretiens candidats
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex bg-[#333333] rounded-lg p-1">
                <button id="listView" class="px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#2b2b2b] text-[#f5f5f5] shadow-sm">
                    Liste
                </button>
                <button id="calendarViewBtn" class="px-4 py-2 rounded-md text-sm font-medium transition-colors text-[#9ca3af]">
                    Calendrier
                </button>
            </div>
            <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Programmer entretien
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Total</p>
                    <p class="text-2xl font-bold text-[#f5f5f5]">5</p>
                </div>
                <div class="w-12 h-12 bg-[#ffffff] rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-6 h-6 text-[#9ca3af]"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Programmés</p>
                    <p class="text-2xl font-bold text-blue-600">1</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-blue-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Confirmés</p>
                    <p class="text-2xl font-bold text-green-600">1</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-6 h-6 text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><path d="m9 11 3 3L22 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Terminés</p>
                    <p class="text-2xl font-bold text-gray-600">1</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-6 h-6 text-gray-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><path d="m9 11 3 3L22 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Annulés</p>
                    <p class="text-2xl font-bold text-red-600">1</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle w-6 h-6 text-red-600"><circle cx="12" cy="12" r="10"></circle><path d="m15 9-6 6"></path><path d="m9 9 6 6"></path></svg>
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
                    placeholder="Rechercher par candidat ou poste..."
                    class="w-full pl-10 pr-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/></svg>
                <select class="pl-10 pr-8 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] min-w-[200px]">
                    <option value="">Tous les statuts</option>
                    <option value="Programmé">Programmé</option>
                    <option value="Confirmé">Confirmé</option>
                    <option value="En attente">En attente</option>
                    <option value="Terminé">Terminé</option>
                    <option value="Annulé">Annulé</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Interviews List --}}
    <div id="interviewsList" class="space-y-6">
        {{-- Interview 1 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                        AB
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                    Ahmed Belkacem
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                    Développeur Frontend React
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-blue-400 bg-blue-400/20">
                                Programmé
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>2024-01-20</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                <span>14:00 (60min)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Visioconférence</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate">Google Meet</span>
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Notes :</strong> Premier entretien technique
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                        <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors">
                            Rejoindre
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interview 2 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                        FZ
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                    Fatima Zohra
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                    Designer UX/UI
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-green-400 bg-green-400/20">
                                Confirmé
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>2024-01-21</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                <span>10:30 (45min)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Présentiel</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate">Bureau Chéraga</span>
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Notes :</strong> Présentation du portfolio
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interview 3 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                        KB
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                    Karim Boudjadar
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                    Community Manager
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-yellow-400 bg-yellow-400/20">
                                En attente
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>2024-01-22</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                <span>16:00 (30min)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <span>Téléphonique</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate">+213 XXX XXX XXX</span>
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Notes :</strong> Entretien de pré-sélection
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interview 4 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                        NM
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                    Nadia Mammeri
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                    Data Analyst
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-[#9ca3af] bg-[#333333]">
                                Terminé
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>2024-01-18</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                <span>11:00 (90min)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Visioconférence</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate">Zoom</span>
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Notes :</strong> Entretien technique approfondi
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interview 5 --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                        YS
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                    Youcef Slimani
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                    Product Manager
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium text-red-400 bg-red-400/20">
                                Annulé
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>2024-01-19</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                <span>15:30 (60min)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Présentiel</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="truncate">Bureau Chéraga</span>
                            </div>
                        </div>
                        
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Notes :</strong> Candidat indisponible
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </button>
                        <button class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Calendar View --}}
    <div id="calendarView" class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg hidden">
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-[#9ca3af] mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
            <h3 class="text-xl font-semibold text-[#f5f5f5] mb-2">
                Vue Calendrier
            </h3>
            <p class="text-[#9ca3af]">
                La vue calendrier sera disponible prochainement
            </p>
        </div>
    </div>

    <script>
        // View mode toggle
        document.getElementById('listView').addEventListener('click', function() {
            // Show list view, hide calendar view
            document.getElementById('interviewsList').classList.remove('hidden');
            document.getElementById('calendarView').classList.add('hidden');
            
            // Update button styles
            this.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            this.classList.remove('text-[#9ca3af]');
            
            // Reset calendar button
            const calendarBtn = document.getElementById('calendarViewBtn');
            calendarBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            calendarBtn.classList.add('text-[#9ca3af]');
        });

        document.getElementById('calendarViewBtn').addEventListener('click', function() {
            // Hide list view, show calendar view
            document.getElementById('interviewsList').classList.add('hidden');
            document.getElementById('calendarView').classList.remove('hidden');
            
            // Update button styles
            this.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            this.classList.remove('text-[#9ca3af]');
            
            // Reset list button
            const listBtn = document.getElementById('listView');
            listBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            listBtn.classList.add('text-[#9ca3af]');
        });
    </script>
</div>
@endsection