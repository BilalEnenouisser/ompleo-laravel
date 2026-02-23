@extends('layouts.dashboard')

@section('title', 'Mes Offres d\'Emploi - OMPLEO')
@section('description', 'Gérez vos annonces et suivez les candidatures.')
@section('page-title', 'Mes Offres')

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div id="successNotification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="errorNotification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5] truncate">
                Mes Offres d'Emploi
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Gérez vos annonces et suivez les candidatures
            </p>
        </div>
        <a href="{{ route('recruiter.create-offer') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 md:px-6 py-2 sm:py-3 rounded-lg font-medium transition-colors flex items-center gap-2 text-xs sm:text-sm md:text-base whitespace-nowrap flex-shrink-0">
            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
            </svg>
            <span class="hidden sm:inline">Publier une offre</span>
            <span class="sm:hidden">Publier</span>
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
        {{-- Total offres --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-[#9ca3af] truncate">Total offres</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5]">{{ $totalJobs }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-[#333333] rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2 w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-[#9ca3af]"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                </div>
            </div>
        </div>

        {{-- Actives --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-[#9ca3af] truncate">Actives</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-green-400">{{ $activeJobs }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-green-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-green-400"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </div>
            </div>
        </div>

        {{-- Expirées --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-[#9ca3af] truncate">Expirées</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-red-400">{{ $expiredJobs }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-red-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-red-400"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        {{-- Brouillons --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-[#9ca3af] truncate">Brouillons</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-[#9ca3af]">{{ $draftJobs }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-[#333333] rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pen-line w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-[#9ca3af]"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
        <div class="flex flex-row gap-3 sm:gap-4 jobs-filters-row">
            <style>
                /* Desktop is default - flex-row */
                @media (max-width: 767px) {
                    .jobs-filters-row {
                        flex-direction: column !important;
                    }
                }
            </style>
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher par titre..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-2.5 md:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                />
            </div>
            <div class="relative w-full sm:w-auto">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <select class="w-full sm:min-w-[180px] md:min-w-[200px] pl-8 sm:pl-10 pr-6 sm:pr-8 py-2 sm:py-2.5 md:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="Actif">Actif</option>
                    <option value="Expiré">Expiré</option>
                    <option value="Brouillon">Brouillon</option>
                    <option value="Suspendu">Suspendu</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Jobs List --}}
    <div class="space-y-4 sm:space-y-6">
        @forelse($jobs as $job)
        <div class="bg-[#2b2b2b] border {{ $job->is_featured ? 'border-[#00b6b4]/30 ring-2 ring-[#00b6b4]/20' : 'border-[#333333]' }} rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-3 sm:gap-4 md:gap-6">
                <div class="flex-1 min-w-0">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 sm:mb-4 gap-2 sm:gap-3">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 min-w-0 flex-1">
                            <h3 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold text-[#f5f5f5] truncate">
                                {{ $job->title }}
                            </h3>
                            {{-- Mobile: badges on same line --}}
                            <div class="flex sm:hidden items-center gap-2 flex-wrap">
                                @if($job->is_featured)
                                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1 whitespace-nowrap flex-shrink-0">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                                    </svg>
                                    Vedette
                                </span>
                                @endif
                                <span class="px-2 py-1 rounded-full text-xs font-medium whitespace-nowrap flex-shrink-0
                                    @if($job->status == 'published') text-green-600 bg-green-100
                                    @elseif($job->status == 'draft') text-gray-600 bg-gray-100
                                    @elseif($job->status == 'closed') text-red-600 bg-red-100
                                    @else text-gray-600 bg-gray-100 @endif">
                                    @if($job->status == 'published') Actif
                                    @elseif($job->status == 'draft') Brouillon
                                    @elseif($job->status == 'closed') Fermé
                                    @else {{ ucfirst($job->status) }} @endif
                                </span>
                            </div>
                            {{-- Desktop: only Vedette badge on left --}}
                            @if($job->is_featured)
                            <span class="hidden sm:flex bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium items-center gap-1 whitespace-nowrap flex-shrink-0">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                                </svg>
                                Vedette
                            </span>
                            @endif
                        </div>
                        {{-- Desktop: Actif badge on right --}}
                        <span class="hidden sm:block px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium whitespace-nowrap flex-shrink-0
                            @if($job->status == 'published') text-green-600 bg-green-100
                            @elseif($job->status == 'draft') text-gray-600 bg-gray-100
                            @elseif($job->status == 'closed') text-red-600 bg-red-100
                            @else text-gray-600 bg-gray-100 @endif">
                            @if($job->status == 'published') Actif
                            @elseif($job->status == 'draft') Brouillon
                            @elseif($job->status == 'closed') Fermé
                            @else {{ ucfirst($job->status) }} @endif
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 text-xs sm:text-sm text-[#9ca3af] mb-3 sm:mb-4">
                        <div class="flex items-center gap-1 sm:gap-2 min-w-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            <span class="truncate">{{ $job->type ?? 'Non spécifié' }}</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 min-w-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <span class="truncate">{{ $job->location ?? 'Non spécifié' }}</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 min-w-0">
                            <span class="flex-shrink-0">🏠</span>
                            <span class="truncate">{{ ucfirst($job->work_type ?? 'Non spécifié') }}</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 min-w-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                <line x1="16" x2="16" y1="2" y2="6"/>
                                <line x1="8" x2="8" y1="2" y2="6"/>
                                <line x1="3" x2="21" y1="10" y2="10"/>
                            </svg>
                            <span class="truncate">@if($job->application_deadline) Expire le {{ \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') }} @else Pas de date limite @endif</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2 sm:gap-3 md:gap-4">
                        <div class="text-xs sm:text-sm md:text-base lg:text-lg font-bold text-[#f5f5f5] truncate">
                            @if($job->salary_min && $job->salary_max)
                                {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                            @elseif($job->salary_min)
                                À partir de {{ number_format($job->salary_min) }} DA
                            @else
                                Salaire non spécifié
                            @endif
                        </div>
                        <div class="flex flex-wrap items-center gap-2 sm:gap-3 md:gap-4 lg:gap-6 text-xs sm:text-sm text-[#9ca3af]">
                            <div class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <span>{{ $job->applications->count() }} candidatures</span>
                            </div>
                            <div class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>{{ $job->views ?? 0 }} vues</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row lg:flex-col lg:items-end gap-2 sm:gap-3">
                    <div class="flex items-center gap-1 sm:gap-2 justify-center sm:justify-start">
                        <a href="{{ route('recruiter.jobs.show', $job) }}" class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200" title="Voir l'offre">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </a>
                        <a href="{{ route('recruiter.jobs.edit', $job) }}" class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200" title="Modifier l'offre">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>
                        <button type="button" onclick="showDeleteModal({{ $job->id }}, '{{ $job->title }}')" class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200" title="Supprimer l'offre">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                        <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="1"/>
                                <circle cx="19" cy="12" r="1"/>
                                <circle cx="5" cy="12" r="1"/>
                            </svg>
                        </button>
                    </div>
                    <a href="{{ route('recruiter.jobs.applications', $job) }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-lg font-medium transition-colors whitespace-nowrap text-xs sm:text-sm inline-flex items-center justify-center gap-1 sm:gap-2 w-full sm:w-auto">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span class="hidden sm:inline">Voir candidatures</span>
                        <span class="sm:hidden">Candidatures</span>
                    </a>
                </div>
            </div>
        </div>

        @empty
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 sm:p-12 text-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                    <path d="M10 6h4"/>
                    <path d="M10 10h4"/>
                    <path d="M10 14h4"/>
                    <path d="M10 18h4"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-2 sm:mb-3">
                Aucune offre d'emploi
            </h3>
            <p class="text-sm sm:text-base text-[#9ca3af] mb-4 sm:mb-6">
                Vous n'avez pas encore créé d'offres d'emploi. Commencez par publier votre première offre !
            </p>
            <a href="{{ route('recruiter.create-offer') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium transition-colors inline-flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Publier une offre
            </a>
        </div>
        @endforelse
    </div>
</div>

<script>
// Show notification animation
document.addEventListener('DOMContentLoaded', function() {
    const successNotification = document.getElementById('successNotification');
    const errorNotification = document.getElementById('errorNotification');
    
    if (successNotification) {
        // Show notification
        setTimeout(() => {
            successNotification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            successNotification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                successNotification.remove();
            }, 300);
        }, 3000);
    }
    
    if (errorNotification) {
        // Show notification
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto hide after 4 seconds
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                errorNotification.remove();
            }, 300);
        }, 4000);
    }
});

// Delete Modal Functions
function showDeleteModal(jobId, jobTitle) {
    const modal = document.getElementById('deleteModal');
    const titleElement = document.getElementById('jobTitle');
    const form = document.getElementById('deleteForm');
    
    // Set job title
    titleElement.textContent = jobTitle;
    
    // Set form action
    form.action = `/recruiter/jobs/${jobId}`;
    
    // Show modal with animation
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Trigger scale animation
    setTimeout(() => {
        const modalContent = modal.querySelector('.bg-\\[\\#2b2b2b\\]');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function hideDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = modal.querySelector('.bg-\\[\\#2b2b2b\\]');
    
    // Trigger scale out animation
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 300);
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDeleteModal();
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideDeleteModal();
    }
});
</script>

{{-- Custom Delete Modal --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 sm:p-8 shadow-2xl max-w-md w-full mx-4 transform scale-95 transition-all duration-300">
        <div class="text-center">
            {{-- Warning Icon --}}
            <div class="w-16 h-16 bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
            </div>
            
            {{-- Modal Content --}}
            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-2">
                Supprimer l'offre
            </h3>
            <p class="text-sm sm:text-base text-[#9ca3af] mb-6">
                Êtes-vous sûr de vouloir supprimer l'offre <span id="jobTitle" class="font-medium text-[#f5f5f5]"></span> ? Cette action est irréversible.
            </p>
            
            {{-- Action Buttons --}}
            <div class="flex items-center justify-center gap-3">
                <button 
                    onclick="hideDeleteModal()" 
                    class="px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] hover:text-[#f5f5f5] transition-colors duration-200 text-sm sm:text-base"
                >
                    Annuler
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-medium transition-colors duration-200 text-sm sm:text-base"
                    >
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
