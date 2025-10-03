@extends('layouts.dashboard')

@section('page-title', 'Signalements')

@section('content')
<div class="space-y-4 sm:space-y-6 lg:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Signalements
            </h1>
            <p class="text-sm sm:text-base text-[#cccccc] mt-1 sm:mt-2">
                Traitez les signalements et gérez la modération
            </p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Total</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">24</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/>
                        <line x1="4" x2="4" y1="22" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">En attente</p>
                    <p class="text-xl sm:text-2xl font-bold text-yellow-400">8</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">En cours</p>
                    <p class="text-xl sm:text-2xl font-bold text-blue-400">6</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5 sm:w-6 sm:h-6 text-blue-400"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Résolus</p>
                    <p class="text-xl sm:text-2xl font-bold text-green-400">7</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="M22 4 12 14.01l-3-3"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Rejetés</p>
                    <p class="text-xl sm:text-2xl font-bold" style="color: rgb(156 163 175 / var(--tw-text-opacity, 1));">3</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(17 24 39 / 0.3);">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(156 163 175 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" x2="9" y1="9" y2="15"/>
                        <line x1="9" x2="15" y1="9" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher par nom ou motif..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <select class="w-full pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="reviewed">En cours</option>
                    <option value="resolved">Résolu</option>
                    <option value="dismissed">Rejeté</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Reports List --}}
    <div class="space-y-4 sm:space-y-6">
        {{-- Report 1 - Ahmed Belkacem --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4 mb-4">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                A
                            </div>
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                    Ahmed Belkacem
                                </h3>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">
                                        Candidat
                                    </span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-900/30 text-yellow-400">
                                        En attente
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs sm:text-sm text-[#cccccc]">
                            Il y a 2 heures
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Signalé par :</p>
                            <p class="font-medium text-sm sm:text-base text-[#f5f5f5]">Recruiter User</p>
                            <p class="text-xs sm:text-sm text-[#00b6b4]">IMPACTOME</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Motif :</p>
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-red-900/30 text-red-400">
                                Faux profil
                            </span>
                        </div>
                    </div>

                    <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4 mb-4">
                        <p class="text-xs sm:text-sm text-[#cccccc] mb-2">Description :</p>
                        <p class="text-sm sm:text-base text-[#f5f5f5]">Les informations du profil semblent fictives, pas de cohérence dans l'expérience.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row lg:flex-col gap-2 sm:gap-3 lg:gap-3 min-w-0 lg:min-w-[200px]">
                    <button onclick="openActionModal('dismiss', 'Ahmed Belkacem')" class="bg-gray-600 hover:bg-gray-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" x2="9" y1="9" y2="15"/>
                            <line x1="9" x2="15" y1="9" y2="15"/>
                        </svg>
                        Rejeter
                    </button>
                    <button onclick="openActionModal('warn', 'Ahmed Belkacem')" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>
                        Avertir
                    </button>
                    <button onclick="openActionModal('suspend', 'Ahmed Belkacem')" class="bg-orange-600 hover:bg-orange-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                        Suspendre
                    </button>
                    <button onclick="openActionModal('delete', 'Ahmed Belkacem')" class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18"/>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                        </svg>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>

        {{-- Report 2 - Fatima Zohra --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4 mb-4">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                F
                            </div>
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                    Fatima Zohra
                                </h3>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">
                                        Candidat
                                    </span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-900/30 text-blue-400">
                                        En cours
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs sm:text-sm text-[#cccccc]">
                            Il y a 1 jour
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Signalé par :</p>
                            <p class="font-medium text-sm sm:text-base text-[#f5f5f5]">Recruiter User</p>
                            <p class="text-xs sm:text-sm text-[#00b6b4]">CONDOR</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Motif :</p>
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-orange-900/30 text-orange-400">
                                Contenu inapproprié
                            </span>
                        </div>
                    </div>

                    <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4 mb-4">
                        <p class="text-xs sm:text-sm text-[#cccccc] mb-2">Description :</p>
                        <p class="text-sm sm:text-base text-[#f5f5f5]">Photo de profil non professionnelle et commentaires déplacés.</p>
                    </div>

                    <div class="bg-green-900/20 border border-green-800 rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-green-400 mb-1">Action prise :</p>
                        <p class="text-sm sm:text-base text-[#f5f5f5] font-medium">Avertissement envoyé</p>
                        <p class="text-xs sm:text-sm text-[#cccccc] mt-2">Premier avertissement envoyé. Profil surveillé.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Report 3 - Karim Boudjadar --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4 mb-4">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                K
                            </div>
                            <div>
                                <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                    Karim Boudjadar
                                </h3>
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">
                                        Candidat
                                    </span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-900/30 text-green-400">
                                        Résolu
                                    </span>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs sm:text-sm text-[#cccccc]">
                            Il y a 3 jours
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Signalé par :</p>
                            <p class="font-medium text-sm sm:text-base text-[#f5f5f5]">Recruiter User</p>
                            <p class="text-xs sm:text-sm text-[#00b6b4]">SONATRACH</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Motif :</p>
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-900/30 text-purple-400">
                                Spam
                            </span>
                        </div>
                    </div>

                    <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4 mb-4">
                        <p class="text-xs sm:text-sm text-[#cccccc] mb-2">Description :</p>
                        <p class="text-sm sm:text-base text-[#f5f5f5]">Envoi de messages répétitifs et non sollicités.</p>
                    </div>

                    <div class="bg-green-900/20 border border-green-800 rounded-lg p-3 sm:p-4">
                        <p class="text-xs sm:text-sm text-green-400 mb-1">Action prise :</p>
                        <p class="text-sm sm:text-base text-[#f5f5f5] font-medium">Compte suspendu 7 jours</p>
                        <p class="text-xs sm:text-sm text-[#cccccc] mt-2">Suspension temporaire appliquée. Utilisateur contacté.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex items-center justify-between">
        <div class="text-sm text-[#9ca3af]">
            Affichage de 1 à 3 sur 24 résultats
        </div>
        <div class="flex items-center gap-2">
            <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                Précédent
            </button>
            <button class="px-3 py-2 text-sm bg-[#00b6b4] text-white rounded-lg">
                1
            </button>
            <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                2
            </button>
            <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                3
            </button>
            <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                Suivant
            </button>
        </div>
    </div>

    {{-- Action Modal --}}
    <div id="actionModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl max-w-md w-full shadow-2xl">
            <div class="p-6 border-b border-[#444444]">
                <h2 class="text-xl font-bold text-[#f5f5f5]">
                    Confirmer l'action
                </h2>
                <p class="text-[#cccccc] mt-2">
                    Action sur le profil de <span id="modalUserName"></span>
                </p>
            </div>
            
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-[#cccccc] mb-2">
                        Notes administratives
                    </label>
                    <textarea
                        id="actionNotes"
                        rows="3"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                        placeholder="Ajoutez des notes sur cette action..."
                    ></textarea>
                </div>
            </div>
            
            <div class="p-6 border-t border-[#444444] flex justify-end gap-3">
                <button
                    onclick="closeActionModal()"
                    class="px-6 py-3 border border-[#444444] rounded-lg text-[#cccccc] hover:bg-[#333333] transition-colors"
                >
                    Annuler
                </button>
                <button
                    id="confirmButton"
                    onclick="executeAction()"
                    class="px-6 py-3 rounded-lg font-medium transition-colors text-white"
                >
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentActionType = '';
let currentUserName = '';

function openActionModal(actionType, userName) {
    currentActionType = actionType;
    currentUserName = userName;
    
    document.getElementById('modalUserName').textContent = userName;
    document.getElementById('actionNotes').value = '';
    
    const modal = document.getElementById('actionModal');
    const confirmButton = document.getElementById('confirmButton');
    
    // Set button color based on action type
    confirmButton.className = 'px-6 py-3 rounded-lg font-medium transition-colors text-white ';
    
    switch(actionType) {
        case 'dismiss':
            confirmButton.className += 'bg-gray-600 hover:bg-gray-700';
            break;
        case 'warn':
            confirmButton.className += 'bg-yellow-600 hover:bg-yellow-700';
            break;
        case 'suspend':
            confirmButton.className += 'bg-orange-600 hover:bg-orange-700';
            break;
        case 'delete':
            confirmButton.className += 'bg-red-600 hover:bg-red-700';
            break;
    }
    
    modal.classList.remove('hidden');
}

function closeActionModal() {
    document.getElementById('actionModal').classList.add('hidden');
}

function executeAction() {
    const notes = document.getElementById('actionNotes').value;
    
    let actionDescription = '';
    switch (currentActionType) {
        case 'dismiss':
            actionDescription = 'Signalement rejeté';
            break;
        case 'warn':
            actionDescription = 'Avertissement envoyé';
            break;
        case 'suspend':
            actionDescription = 'Compte suspendu';
            break;
        case 'delete':
            actionDescription = 'Compte supprimé';
            break;
    }
    
    // Here you would normally send the action to the server
    console.log(`Action: ${actionDescription} for ${currentUserName}`);
    console.log(`Notes: ${notes}`);
    
    // Show success message (you can replace this with actual notification)
    alert(`${actionDescription} pour ${currentUserName}`);
    
    closeActionModal();
}

// Close modal when clicking outside
document.getElementById('actionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeActionModal();
    }
});
</script>
@endsection
