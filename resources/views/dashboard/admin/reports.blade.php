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
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7,10 12,15 17,10"/>
                    <line x1="12" y1="15" x2="12" y2="3"/>
                </svg>
                Exporter CSV
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Total</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total'] }}</p>
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
                    <p class="text-xl sm:text-2xl font-bold text-yellow-400">{{ $stats['pending'] }}</p>
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
                    <p class="text-xl sm:text-2xl font-bold text-blue-400">{{ $stats['reviewed'] }}</p>
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
                    <p class="text-xl sm:text-2xl font-bold text-green-400">{{ $stats['resolved'] }}</p>
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
                    <p class="text-xl sm:text-2xl font-bold text-gray-400">{{ $stats['dismissed'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 sm:gap-4">
            <div class="relative">
                <svg id="searchIcon" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <div id="loadingSpinner" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#00b6b4] w-4 h-4 sm:w-5 sm:h-5 hidden">
                    <svg class="animate-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 11-6.219-8.56"/>
                    </svg>
                </div>
                <input
                    type="text"
                    id="searchInput"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par nom ou motif..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                    autocomplete="off"
                />
                
                <!-- Search Suggestions Dropdown -->
                <div id="searchSuggestions" class="absolute top-full left-0 right-0 mt-1 bg-[#2b2b2b] border border-[#333333] rounded-lg shadow-xl z-50 hidden max-h-60 overflow-y-auto">
                    <div id="suggestionsList" class="py-2">
                        <!-- Suggestions will be populated here -->
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <select id="statusSelect" class="w-full pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>En cours</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Résolu</option>
                    <option value="dismissed" {{ request('status') == 'dismissed' ? 'selected' : '' }}>Rejeté</option>
                </select>
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.reports.export', request()->query()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7,10 12,15 17,10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    Exporter CSV
                </a>
            </div>
        </div>
    </div>

    {{-- Reports List --}}
    <div class="space-y-4 sm:space-y-6">
        @forelse($reports as $report)
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4 mb-4">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                                    {{ strtoupper(substr($report->reportedUser->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                                        {{ $report->reportedUser->name }}
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">
                                            {{ ucfirst($report->reportedUser->user_type) }}
                                        </span>
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-900/30 text-yellow-400',
                                                'reviewed' => 'bg-blue-900/30 text-blue-400',
                                                'resolved' => 'bg-green-900/30 text-green-400',
                                                'dismissed' => 'bg-gray-900/30 text-gray-400'
                                            ];
                                            $statusLabels = [
                                                'pending' => 'En attente',
                                                'reviewed' => 'En cours',
                                                'resolved' => 'Résolu',
                                                'dismissed' => 'Rejeté'
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$report->status] }}">
                                            {{ $statusLabels[$report->status] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs sm:text-sm text-[#cccccc]">
                                {{ $report->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4">
                            <div>
                                <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Signalé par :</p>
                                <p class="font-medium text-sm sm:text-base text-[#f5f5f5]">{{ $report->reporterUser->name }}</p>
                                <p class="text-xs sm:text-sm text-[#00b6b4]">{{ $report->reporterUser->company_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs sm:text-sm text-[#cccccc] mb-1">Motif :</p>
                                @php
                                    $reasonColors = [
                                        'Faux profil' => 'bg-red-900/30 text-red-400',
                                        'Contenu inapproprié' => 'bg-orange-900/30 text-orange-400',
                                        'Spam' => 'bg-purple-900/30 text-purple-400',
                                        'Harcèlement' => 'bg-pink-900/30 text-pink-400',
                                        'Informations frauduleuses' => 'bg-yellow-900/30 text-yellow-400'
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $reasonColors[$report->reason] ?? 'bg-gray-900/30 text-gray-400' }}">
                                    {{ $report->reason }}
                                </span>
                            </div>
                        </div>

                        <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4 mb-4">
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-2">Description :</p>
                            <p class="text-sm sm:text-base text-[#f5f5f5]">{{ $report->description }}</p>
                        </div>

                        @if($report->action_taken)
                            <div class="bg-green-900/20 border border-green-800 rounded-lg p-3 sm:p-4">
                                <p class="text-xs sm:text-sm text-green-400 mb-1">Action prise :</p>
                                <p class="text-sm sm:text-base text-[#f5f5f5] font-medium">{{ $report->action_taken }}</p>
                                @if($report->admin_notes)
                                    <p class="text-xs sm:text-sm text-[#cccccc] mt-2">{{ $report->admin_notes }}</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if($report->status === 'pending')
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-2 sm:gap-3 lg:gap-3 min-w-0 lg:min-w-[200px]">
                            <button onclick="openActionModal('dismiss', {{ $report->id }}, '{{ $report->reportedUser->name }}')" class="bg-gray-600 hover:bg-gray-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="15" x2="9" y1="9" y2="15"/>
                                    <line x1="9" x2="15" y1="9" y2="15"/>
                                </svg>
                                Rejeter
                            </button>
                            <button onclick="openActionModal('warn', {{ $report->id }}, '{{ $report->reportedUser->name }}')" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                    <path d="M12 9v4"/>
                                    <path d="M12 17h.01"/>
                                </svg>
                                Avertir
                            </button>
                            <button onclick="openActionModal('suspend', {{ $report->id }}, '{{ $report->reportedUser->name }}')" class="bg-orange-600 hover:bg-orange-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="M9 12l2 2 4-4"/>
                                </svg>
                                Suspendre
                            </button>
                            <button onclick="openActionModal('delete', {{ $report->id }}, '{{ $report->reportedUser->name }}')" class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                                Supprimer
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-12 shadow-lg text-center">
                <div class="w-16 h-16 mx-auto mb-4 text-[#666666]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-x">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14,2 14,8 20,8"/>
                        <line x1="9" x2="15" y1="15" y2="9"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#f5f5f5] mb-2">Aucun signalement</h3>
                <p class="text-[#9ca3af]">Aucun signalement trouvé pour les critères sélectionnés.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="flex items-center justify-between">
        <div class="text-sm text-[#9ca3af]">
            Affichage de {{ $reports->firstItem() ?? 0 }} à {{ $reports->lastItem() ?? 0 }} sur {{ $reports->total() }} résultats
        </div>
        <div class="flex items-center gap-2">
            @if($reports->onFirstPage())
                <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors" disabled>
                    Précédent
                </button>
            @else
                <a href="{{ $reports->previousPageUrl() }}" class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                    Précédent
                </a>
            @endif
            
            @for($page = 1; $page <= $reports->lastPage(); $page++)
                @if($page == $reports->currentPage())
                    <button class="px-3 py-2 text-sm bg-[#00b6b4] text-white rounded-lg">
                        {{ $page }}
                    </button>
                @else
                    <a href="{{ $reports->url($page) }}" class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endfor
            
            @if($reports->hasMorePages())
                <a href="{{ $reports->nextPageUrl() }}" class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors">
                    Suivant
                </a>
            @else
                <button class="px-3 py-2 text-sm text-[#9ca3af] hover:text-[#f5f5f5] hover:bg-[#333333] rounded-lg transition-colors" disabled>
                    Suivant
                </button>
            @endif
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
let currentReportId = '';
let currentUserName = '';
let searchTimeout;

// Real-time search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusSelect = document.getElementById('statusSelect');
    const suggestionsDropdown = document.getElementById('searchSuggestions');
    const suggestionsList = document.getElementById('suggestionsList');
    let suggestionTimeout;
    
    // Search suggestions as you type
    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(suggestionTimeout);
        
        if (query.length >= 1) {
            // Show loading spinner
            document.getElementById('searchIcon').classList.add('hidden');
            document.getElementById('loadingSpinner').classList.remove('hidden');
            
            suggestionTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 200);
        } else {
            hideSuggestions();
        }
    });
    
    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionsDropdown.contains(e.target)) {
            hideSuggestions();
        }
    });
    
    // Filter on status change
    statusSelect.addEventListener('change', function() {
        performSearch();
    });
});

function fetchSuggestions(query) {
    fetch(`/admin/reports/search-suggestions?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(suggestions => {
            showSuggestions(suggestions);
        })
        .catch(error => {
            hideSuggestions();
        })
        .finally(() => {
            // Hide loading spinner
            document.getElementById('searchIcon').classList.remove('hidden');
            document.getElementById('loadingSpinner').classList.add('hidden');
        });
}

function showSuggestions(suggestions) {
    const suggestionsList = document.getElementById('suggestionsList');
    const suggestionsDropdown = document.getElementById('searchSuggestions');
    
    if (suggestions.length === 0) {
        hideSuggestions();
        return;
    }
    
    suggestionsList.innerHTML = suggestions.map(suggestion => `
        <div class="px-4 py-3 hover:bg-[#333333] cursor-pointer border-b border-[#444444] last:border-b-0" 
             onclick="selectSuggestion('${suggestion.value}')">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#00b6b4] to-[#009e9c] flex items-center justify-center text-white text-sm font-bold">
                    ${suggestion.type === 'user' ? suggestion.text.charAt(0).toUpperCase() : '📋'}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-[#f5f5f5]">${suggestion.text}</div>
                    <div class="text-xs text-[#9ca3af]">${suggestion.subtext}</div>
                </div>
                <div class="text-xs px-2 py-1 rounded-full ${suggestion.type === 'user' ? 'bg-blue-900/30 text-blue-400' : 'bg-orange-900/30 text-orange-400'}">
                    ${suggestion.type === 'user' ? 'Utilisateur' : 'Motif'}
                </div>
            </div>
        </div>
    `).join('');
    
    suggestionsDropdown.classList.remove('hidden');
}

function hideSuggestions() {
    document.getElementById('searchSuggestions').classList.add('hidden');
}

function selectSuggestion(value) {
    document.getElementById('searchInput').value = value;
    hideSuggestions();
    performSearch();
}

function performSearch() {
    const searchValue = document.getElementById('searchInput').value;
    const statusValue = document.getElementById('statusSelect').value;
    
    // Build URL with current parameters
    const url = new URL(window.location);
    
    // Only add search parameter if there's a value
    if (searchValue.trim()) {
        url.searchParams.set('search', searchValue);
    } else {
        url.searchParams.delete('search');
    }
    
    // Only add status parameter if there's a value
    if (statusValue) {
        url.searchParams.set('status', statusValue);
    } else {
        url.searchParams.delete('status');
    }
    
    url.searchParams.delete('page'); // Reset to first page
    
    // Navigate to new URL
    window.location.href = url.toString();
}

function openActionModal(actionType, reportId, userName) {
    currentActionType = actionType;
    currentReportId = reportId;
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
    
    // Show loading state
    const confirmButton = document.getElementById('confirmButton');
    const originalText = confirmButton.textContent;
    confirmButton.textContent = 'Traitement...';
    confirmButton.disabled = true;
    
    // Send action to server
    fetch(`/admin/reports/${currentReportId}/action`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            action: currentActionType,
            admin_notes: notes
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showToast('Action effectuée', data.message, 'success');
            
            // Reload page after a short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast('Erreur', data.message || 'Une erreur est survenue', 'error');
        }
    })
    .catch(error => {
        showToast('Erreur', 'Une erreur est survenue lors du traitement', 'error');
    })
    .finally(() => {
        // Reset button
        confirmButton.textContent = originalText;
        confirmButton.disabled = false;
        closeActionModal();
    });
}

// Close modal when clicking outside
document.getElementById('actionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeActionModal();
    }
});

// Toast notification function
function showToast(title, message, type) {
    const container = document.createElement('div');
    container.className = 'fixed top-4 right-4 z-50';
    
    const toast = document.createElement('div');
    toast.className = `bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 shadow-2xl max-w-sm transform transition-all duration-300 translate-x-full opacity-0`;
    
    toast.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                ${type === 'success' ? 
                    '<svg class="w-5 h-5 text-green-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>' :
                    '<svg class="w-5 h-5 text-red-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>'
                }
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-semibold text-white mb-1">${title}</h4>
                <p class="text-xs text-gray-300 leading-relaxed">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="flex-shrink-0 text-gray-400 hover:text-white transition-colors duration-200 p-1 rounded-full hover:bg-white/10">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="absolute bottom-0 left-0 h-1 ${type === 'success' ? 'bg-green-400' : 'bg-red-400'} rounded-b-xl animate-pulse"></div>
    `;
    
    container.appendChild(toast);
    document.body.appendChild(container);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 10);
    
    // Auto-hide after 4 seconds
    setTimeout(() => {
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (container.parentElement) {
                container.parentElement.removeChild(container);
            }
        }, 300);
    }, 4000);
}
</script>
@endsection
