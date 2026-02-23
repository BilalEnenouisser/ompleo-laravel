@extends('layouts.dashboard')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Mes Candidatures
            </h1>
            <p class="text-[#9ca3af] mt-2 text-sm sm:text-base">
                Suivez l'état de vos candidatures en temps réel
            </p>
        </div>
        <a href="{{ route('applications.export-pdf', request()->query()) }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-7 h-7 sm:w-5 sm:h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>
            <span class="hidden sm:inline">Exporter PDF</span>
            <span class="sm:hidden">PDF</span>
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Total</p>
                    <p class="text-lg sm:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-[#333333] rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-7 h-7 sm:w-6 sm:h-6 text-[#9ca3af]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">En cours</p>
                    <p class="text-lg sm:text-2xl font-bold text-yellow-400">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-yellow-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 sm:w-6 sm:h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Acceptées</p>
                    <p class="text-lg sm:text-2xl font-bold text-green-400">{{ $stats['accepted'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-green-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Refusées</p>
                    <p class="text-lg sm:text-2xl font-bold text-red-400">{{ $stats['rejected'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-red-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 sm:w-6 sm:h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-3 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-lg sm:text-2xl font-bold text-blue-400">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-blue-400/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 sm:w-6 sm:h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
        <form method="GET" action="{{ route('applications.index') }}" class="space-y-4 lg:space-y-0 lg:flex lg:flex-row lg:gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par poste ou entreprise..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/></svg>
                <select name="status" class="w-full lg:w-auto pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] lg:min-w-[200px] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="En cours" {{ request('status') == 'En cours' ? 'selected' : '' }}>En cours</option>
                    <option value="En attente" {{ request('status') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="Présélectionné" {{ request('status') == 'Présélectionné' ? 'selected' : '' }}>Présélectionné</option>
                    <option value="Examiné" {{ request('status') == 'Examiné' ? 'selected' : '' }}>Examiné</option>
                    <option value="Accepté" {{ request('status') == 'Accepté' ? 'selected' : '' }}>Accepté</option>
                    <option value="Refusé" {{ request('status') == 'Refusé' ? 'selected' : '' }}>Refusé</option>
                </select>
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <button type="submit" class="flex-1 sm:flex-none bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="hidden sm:inline">Rechercher</span>
                    <span class="sm:hidden">Recherche</span>
                </button>
                <a href="{{ route('applications.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 sm:py-3 rounded-lg transition-colors flex items-center justify-center">
                    <svg class="w-7 h-7 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>
        </form>
    </div>

    {{-- Applications List --}}
    <div class="space-y-4 sm:space-y-6">
        @forelse($applications as $application)
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-4 sm:gap-6">
                <div class="flex items-start gap-3 sm:gap-4 flex-1">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg sm:rounded-xl overflow-hidden bg-[#333333] flex-shrink-0">
                        @if($application->job->company->logo)
                            <img
                                src="{{ Storage::url($application->job->company->logo) }}"
                                alt="{{ $application->job->company->name }}"
                                class="w-full h-full object-cover"
                            />
                        @else
                            <div class="w-full h-full bg-[#333333] flex items-center justify-center">
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between mb-2 gap-2">
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] hover:text-[#00b6b4] cursor-pointer">
                                {{ $application->job->title }}
                            </h3>
                            @php
                                $statusConfig = [
                                    'pending' => ['text' => 'En cours', 'class' => 'text-yellow-600 bg-yellow-100'],
                                    'accepted' => ['text' => 'Accepté', 'class' => 'text-green-600 bg-green-100'],
                                    'rejected' => ['text' => 'Refusé', 'class' => 'text-red-600 bg-red-100'],
                                ];
                                $status = $statusConfig[$application->status] ?? $statusConfig['pending'];
                            @endphp
                            <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium flex items-center gap-1 sm:gap-2 {{ $status['class'] }} w-fit">
                                @if($application->status === 'pending')
                                    <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                @elseif($application->status === 'accepted')
                                    <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                                @else
                                    <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                                @endif
                                {{ $status['text'] }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-[#9ca3af] mb-3 text-sm sm:text-base">
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-3 h-3 sm:w-4 sm:h-4"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                                <span class="font-medium">{{ $application->job->company->name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-3 h-3 sm:w-4 sm:h-4"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>{{ $application->job->location }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-3 h-3 sm:w-4 sm:h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                <span>Postulé le {{ $application->applied_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
                            <div class="text-base sm:text-lg font-bold text-[#f5f5f5]">
                                @if($application->job->salary_min && $application->job->salary_max)
                                    {{ number_format($application->job->salary_min) }} - {{ number_format($application->job->salary_max) }} DA
                                @else
                                    Salaire non spécifié
                                @endif
                            </div>
                            <div class="text-xs sm:text-sm text-[#9ca3af]">
                                Dernière mise à jour : {{ $application->updated_at->format('d/m/Y') }}
                            </div>
                        </div>
                        
                        @if($application->cover_letter)
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                <strong>Lettre de motivation :</strong> {{ Str::limit($application->cover_letter, 100) }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row lg:flex-col items-stretch sm:items-center lg:items-end gap-2 sm:gap-3">
                    <a href="{{ route('jobs.show', $application->job->slug) }}" class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Voir l'offre
                    </a>
                    <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Contacter
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-12 text-center">
            <div class="w-16 h-16 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-[#f5f5f5] mb-2">Aucune candidature</h3>
            <p class="text-[#9ca3af] mb-6">Vous n'avez pas encore postulé à des offres d'emploi.</p>
            <a href="{{ route('jobs.index') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors inline-flex items-center gap-2">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14m7-7H5"/>
                </svg>
                Voir les offres d'emploi
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
        <p class="text-xs md:text-sm lg:text-base text-[#9ca3af]">
            Affichage de {{ $applications->count() }} candidature(s) sur {{ $applications->total() }}
        </p>
        <div class="flex items-center gap-2">
            @if($applications->hasPages())
                {{-- Previous Button --}}
                @if($applications->onFirstPage())
                    <button disabled class="bg-[#2b2b2b] border border-[#333333] text-[#666666] px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm lg:text-base cursor-not-allowed">
                        Précédent
                    </button>
                @else
                    <a href="{{ $applications->previousPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">
                        Précédent
                    </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex items-center gap-1">
                    @php
                        $currentPage = $applications->currentPage();
                        $lastPage = $applications->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $applications->url(1) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">1</a>
                        @if($start > 2)
                            <span class="text-[#666666] px-2">...</span>
                        @endif
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $currentPage)
                            <span class="bg-[#00b6b4] text-white px-3 py-2 rounded-lg text-xs md:text-sm font-medium">{{ $i }}</span>
                        @else
                            <a href="{{ $applications->url($i) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">{{ $i }}</a>
                        @endif
                    @endfor

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="text-[#666666] px-2">...</span>
                        @endif
                        <a href="{{ $applications->url($lastPage) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">{{ $lastPage }}</a>
                    @endif
                </div>

                {{-- Next Button --}}
                @if($applications->hasMorePages())
                    <a href="{{ $applications->nextPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">
                        Suivant
                    </a>
                @else
                    <button disabled class="bg-[#2b2b2b] border border-[#333333] text-[#666666] px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm lg:text-base cursor-not-allowed">
                        Suivant
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
