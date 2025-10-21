@extends('layouts.dashboard')

@section('title', 'Offres d\'Emploi - OMPLEO')
@section('description', 'Modérez et gérez toutes les offres d\'emploi de la plateforme OMPLEO.')
@section('page-title', 'Offres d\'Emploi')

@section('content')
<div class="w-full space-y-4 md:space-y-6 lg:space-y-8">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Offres d'Emploi
            </h1>
            <p class="text-sm md:text-base text-[#9ca3af] mt-1 md:mt-2">
                Modérez et gérez toutes les offres d'emploi
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 md:gap-4 lg:gap-6">
        <!-- Total -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Total</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                        <path d="M10 6h4"/>
                        <path d="M10 10h4"/>
                        <path d="M10 14h4"/>
                        <path d="M10 18h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Actives -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Actives</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-green-600">{{ $stats['published_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="M22 4 12 14.01l-3-3"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- En attente -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-yellow-600">{{ $stats['pending_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-yellow-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Expirées -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Expirées</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-red-600">{{ $stats['expired_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-red-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Suspendues -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Suspendues</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#9ca3af]">{{ $stats['suspended_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- À modérer -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">À modérer</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-orange-600">{{ $stats['draft_jobs'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-orange-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
        <form method="GET" action="{{ route('admin.jobs') }}" id="filterForm">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 md:gap-4">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                    <input
                        type="text"
                        name="search"
                        id="jobSearch"
                        value="{{ request('search') }}"
                        placeholder="Rechercher par titre..."
                        class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    />
                </div>
                
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                    </svg>
                    <select name="status" id="statusFilter" class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                        <option value="">Tous les statuts</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expiré</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Fermé</option>
                        <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                </div>
                
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                    </svg>
                    <select name="company_id" id="companyFilter" class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                        <option value="">Toutes les entreprises</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    <select name="date_filter" id="dateFilter" class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                        <option value="">Toutes les dates</option>
                        <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                        <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Cette semaine</option>
                        <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Ce mois</option>
                        <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>Cette année</option>
                    </select>
                </div>
                
                <div class="flex gap-2">
                    <button type="submit" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-3 sm:px-4 py-2 sm:py-3 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base flex-1">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                        </svg>
                        <span class="hidden sm:inline">Filtrer</span>
                        <span class="sm:hidden">Filtrer</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Jobs Table --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Offre</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5] min-w-[200px] sm:min-w-0">Entreprise</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Statut</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Modération</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Performance</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Dates</th>
                        <th class="text-left py-3 px-6 font-semibold text-[#f5f5f5]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6 min-w-[340px] sm:min-w-0">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] flex items-center gap-2 flex-wrap">
                                    <span>{{ $job->title }}</span>
                                    @if($job->is_featured)
                                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-medium flex-shrink-0">Vedette</span>
                                    @endif
                                </div>
                                <div class="text-sm text-[#9ca3af] flex items-center gap-2 mt-1 flex-wrap">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        {{ $job->location ?? 'Non spécifié' }}
                                    </span>
                                    <span>{{ $job->employment_type ?? 'CDI' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[200px] sm:min-w-0">
                            <div class="font-medium text-[#f5f5f5]">{{ $job->company->name ?? 'Entreprise inconnue' }}</div>
                            <div class="text-sm text-[#9ca3af]">
                                @if($job->salary_min && $job->salary_max)
                                    {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                                @else
                                    Salaire non spécifié
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $statusConfig = [
                                    'published' => ['text' => 'Publié', 'class' => 'text-green-600 bg-green-100'],
                                    'draft' => ['text' => 'Brouillon', 'class' => 'text-gray-600 bg-gray-100'],
                                    'pending' => ['text' => 'En attente', 'class' => 'text-yellow-600 bg-yellow-100'],
                                    'expired' => ['text' => 'Expiré', 'class' => 'text-red-600 bg-red-100'],
                                    'closed' => ['text' => 'Fermé', 'class' => 'text-gray-600 bg-gray-100'],
                                    'suspended' => ['text' => 'Suspendu', 'class' => 'text-red-600 bg-red-100']
                                ];
                                $status = $statusConfig[$job->status] ?? $statusConfig['draft'];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $status['class'] }} flex-shrink-0">
                                {{ $status['text'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $moderationConfig = [
                                    'approved' => ['text' => 'Approuvé', 'class' => 'text-green-600 bg-green-100'],
                                    'pending' => ['text' => 'En attente', 'class' => 'text-yellow-600 bg-yellow-100'],
                                    'rejected' => ['text' => 'Rejeté', 'class' => 'text-red-600 bg-red-100']
                                ];
                                $moderation = $moderationConfig[$job->moderation_status ?? 'approved'] ?? $moderationConfig['approved'];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $moderation['class'] }} flex-shrink-0">
                                {{ $moderation['text'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    {{ $job->applications_count }} candidatures
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                    {{ $job->views ?? 0 }} vues
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    {{ $job->created_at ? $job->created_at->format('d/m/Y') : 'N/A' }}
                                </div>
                                @if($job->expires_at)
                                    <div class="text-xs text-[#999999]">
                                        Expire: {{ $job->expires_at->format('d/m/Y') }}
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button onclick="viewJob({{ $job->id }})" class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200" title="Voir les détails">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button onclick="editJob({{ $job->id }})" class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200" title="Modifier">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteJob({{ $job->id }}, '{{ $job->title }}')" class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200" title="Supprimer">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-[#9ca3af]">
                            Aucune offre d'emploi trouvée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
        <p class="text-xs md:text-sm lg:text-base text-[#9ca3af]">
            Affichage de {{ $jobs->count() }} offre(s) sur {{ $jobs->total() }}
        </p>
        <div class="flex items-center gap-2">
            @if($jobs->hasPages())
                {{-- Previous Button --}}
                @if($jobs->onFirstPage())
                    <button disabled class="bg-[#2b2b2b] border border-[#333333] text-[#666666] px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm lg:text-base cursor-not-allowed">
                        Précédent
                    </button>
                @else
                    <a href="{{ $jobs->previousPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">
                        Précédent
                    </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex items-center gap-1">
                    @php
                        $currentPage = $jobs->currentPage();
                        $lastPage = $jobs->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($start > 1)
                        <a href="{{ $jobs->url(1) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">1</a>
                        @if($start > 2)
                            <span class="text-[#666666] px-2">...</span>
                        @endif
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $currentPage)
                            <span class="bg-[#00b6b4] text-white px-3 py-2 rounded-lg text-xs md:text-sm font-medium">{{ $i }}</span>
                        @else
                            <a href="{{ $jobs->url($i) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">{{ $i }}</a>
                        @endif
                    @endfor

                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="text-[#666666] px-2">...</span>
                        @endif
                        <a href="{{ $jobs->url($lastPage) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 py-2 rounded-lg transition-colors text-xs md:text-sm">{{ $lastPage }}</a>
                    @endif
                </div>

                {{-- Next Button --}}
                @if($jobs->hasMorePages())
                    <a href="{{ $jobs->nextPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] hover:border-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base">
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

{{-- View Job Modal --}}
<div id="viewJobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-[#f5f5f5]">Détails de l'offre</h3>
                <button onclick="closeViewModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" x2="6" y1="6" y2="18"/>
                        <line x1="6" x2="18" y1="6" y2="18"/>
                    </svg>
                </button>
            </div>
            
            <div id="viewJobContent" class="space-y-6">
                <!-- Job details will be loaded here -->
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-[#333333]">
                <button onclick="closeViewModal()" class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    Fermer
                </button>
                <button onclick="editJobFromView()" class="px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg transition-colors">
                    Modifier
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Edit Job Modal --}}
<div id="editJobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-[#f5f5f5]">Modifier l'offre</h3>
                <button onclick="closeEditModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" x2="6" y1="6" y2="18"/>
                        <line x1="6" x2="18" y1="6" y2="18"/>
                    </svg>
                </button>
            </div>
            
            <form id="editJobForm" class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                        Informations de base
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Titre du poste *
                            </label>
                            <input
                                type="text"
                                id="editTitle"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Ex: Développeur Frontend React"
                                required
                            />
                        </div>
                        
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Localisation *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <input
                                    type="text"
                                    id="editLocation"
                                    class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                    placeholder="Ex: Alger, Chéraga"
                                    required
                                />
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Expérience requise *
                            </label>
                            <select
                                id="editExperienceLevel"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                required
                            >
                                <option value="">Sélectionner</option>
                                <option value="Débutant">Débutant</option>
                                <option value="Intermédiaire">Intermédiaire</option>
                                <option value="Avancé">Avancé</option>
                                <option value="Expert">Expert</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Type de contrat *
                            </label>
                            <select
                                id="editType"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                required
                            >
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Stage">Stage</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Mode de travail *
                            </label>
                            <select
                                id="editWorkType"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                required
                            >
                                <option value="onsite">Sur site</option>
                                <option value="remote">À distance</option>
                                <option value="hybrid">Hybride</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Salaire minimum (DA) *
                            </label>
                            <input
                                type="number"
                                id="editSalaryMin"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Ex: 50000"
                                required
                            />
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Salaire maximum (DA) *
                            </label>
                            <input
                                type="number"
                                id="editSalaryMax"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Ex: 80000"
                                required
                            />
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Date d'expiration *
                            </label>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" x2="16" y1="2" y2="6"/>
                                    <line x1="8" x2="8" y1="2" y2="6"/>
                                    <line x1="3" x2="21" y1="10" y2="10"/>
                                </svg>
                                <input
                                    type="date"
                                    id="editApplicationDeadline"
                                    class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                    required
                                />
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                                Statut *
                            </label>
                            <select
                                id="editStatus"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                required
                            >
                                <option value="published">Publié</option>
                                <option value="draft">Brouillon</option>
                                <option value="pending">En attente</option>
                                <option value="expired">Expiré</option>
                                <option value="closed">Fermé</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="editIsFeatured"
                                class="w-4 h-4 text-[#00b6b4] border-[#444444] rounded focus:ring-[#00b6b4] bg-[#333333]"
                            />
                            <label for="editIsFeatured" class="ml-2 text-xs sm:text-sm text-[#9ca3af] flex items-center gap-1 sm:gap-2">
                                Mettre en avant cette offre
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                                </svg>
                                <span class="text-xs text-[#9ca3af]">(+1000 DA)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                        Description du poste
                    </h2>
                    
                    <div>
                        <label class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Description détaillée *
                        </label>
                        <textarea
                            id="editDescription"
                            rows="6"
                            class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                            placeholder="Décrivez le poste, l'entreprise et le profil recherché..."
                            required
                        ></textarea>
                    </div>
                </div>

                <!-- Responsibilities -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                            Responsabilités
                        </h2>
                        <button
                            type="button"
                            onclick="addEditResponsibility()"
                            class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                        >
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="editResponsibilitiesContainer" class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <input
                                type="text"
                                name="editResponsibilities[]"
                                class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Responsabilité 1"
                            />
                            <button
                                type="button"
                                onclick="removeEditResponsibility(this)"
                                class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                                disabled
                            >
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                            Exigences
                        </h2>
                        <button
                            type="button"
                            onclick="addEditRequirement()"
                            class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                        >
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="editRequirementsContainer" class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <input
                                type="text"
                                name="editRequirements[]"
                                class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Exigence 1"
                            />
                            <button
                                type="button"
                                onclick="removeEditRequirement(this)"
                                class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                                disabled
                            >
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                            Avantages
                        </h2>
                        <button
                            type="button"
                            onclick="addEditBenefit()"
                            class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                        >
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="editBenefitsContainer" class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <input
                                type="text"
                                name="editBenefits[]"
                                class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Avantage 1"
                            />
                            <button
                                type="button"
                                onclick="removeEditBenefit(this)"
                                class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                                disabled
                            >
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Skills -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                            Compétences requises
                        </h2>
                        <button
                            type="button"
                            onclick="addEditSkill()"
                            class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                        >
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="M12 5v14"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div id="editSkillsContainer" class="space-y-3 sm:space-y-4">
                        <div class="flex items-center gap-2 sm:gap-3">
                            <input
                                type="text"
                                name="editSkills[]"
                                class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                                placeholder="Compétence 1"
                            />
                            <button
                                type="button"
                                onclick="removeEditSkill(this)"
                                class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                                disabled
                            >
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3 pt-6 border-t border-[#333333]">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg transition-colors">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Delete Job Modal --}}
<div id="deleteJobModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-[#f5f5f5]">Supprimer l'offre</h3>
                <button onclick="closeDeleteModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" x2="6" y1="6" y2="18"/>
                        <line x1="6" x2="18" y1="6" y2="18"/>
                    </svg>
                </button>
            </div>
            
            <div class="mb-6">
                <p class="text-[#9ca3af] mb-2">Êtes-vous sûr de vouloir supprimer cette offre d'emploi ?</p>
                <p class="text-sm text-[#666666]" id="deleteJobTitle">Titre de l'offre</p>
            </div>
            
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    Annuler
                </button>
                <button onclick="confirmDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Jobs page loaded
});


// Job Actions
let currentJobId = null;

window.viewJob = function(jobId) {
    currentJobId = jobId;
    // Load job data and show modal
    fetch(`/admin/jobs/${jobId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('viewJobContent').innerHTML = `
                <div class="space-y-6">
                    <!-- Header Section -->
                    <div class="bg-[#333333] rounded-lg p-4">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-[#f5f5f5] mb-2">${data.title}</h2>
                                <div class="flex items-center gap-4 text-sm text-[#9ca3af]">
                                    <span>${data.company?.name || 'Entreprise non spécifiée'}</span>
                                    <span>•</span>
                                    <span>${data.location || 'Localisation non spécifiée'}</span>
                                    <span>•</span>
                                    <span>${data.type || 'Type non spécifié'}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium ${getStatusClass(data.status)}">${getStatusText(data.status)}</span>
                                ${data.is_featured ? '<span class="px-2 py-1 bg-yellow-600 text-yellow-100 rounded-full text-xs font-medium">Mise en avant</span>' : ''}
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Job Details -->
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Détails du poste</h4>
                                <div class="space-y-3">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <span class="text-sm text-[#9ca3af]">Type de contrat:</span>
                                            <p class="text-[#f5f5f5] font-medium">${data.type || 'Non spécifié'}</p>
                                        </div>
                                        <div>
                                            <span class="text-sm text-[#9ca3af]">Type de travail:</span>
                                            <p class="text-[#f5f5f5] font-medium">${data.work_type || 'Non spécifié'}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Niveau d'expérience:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.experience_level || 'Non spécifié'}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Salaire:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.salary_min && data.salary_max ? `${data.salary_min} - ${data.salary_max} DA` : 'Non spécifié'}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Date limite de candidature:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.application_deadline ? new Date(data.application_deadline).toLocaleDateString('fr-FR') : 'Non spécifiée'}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Requirements -->
                            ${data.requirements && data.requirements.length > 0 ? `
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Exigences</h4>
                                <ul class="space-y-2">
                                    ${data.requirements.map(req => `<li class="text-[#9ca3af] flex items-start"><span class="text-[#00b6b4] mr-2">•</span>${req}</li>`).join('')}
                                </ul>
                            </div>
                            ` : ''}

                            <!-- Benefits -->
                            ${data.benefits && data.benefits.length > 0 ? `
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Avantages</h4>
                                <ul class="space-y-2">
                                    ${data.benefits.map(benefit => `<li class="text-[#9ca3af] flex items-start"><span class="text-[#00b6b4] mr-2">•</span>${benefit}</li>`).join('')}
                                </ul>
                            </div>
                            ` : ''}
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Company & Recruiter Info -->
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Informations entreprise</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Entreprise:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.company?.name || 'Non spécifiée'}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Recruteur:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.recruiter?.name || 'Non spécifié'}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Email recruteur:</span>
                                        <p class="text-[#f5f5f5] font-medium">${data.recruiter?.email || 'Non spécifié'}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Statistiques</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-[#00b6b4]">${data.applications_count || 0}</div>
                                        <div class="text-sm text-[#9ca3af]">Candidatures</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-[#00b6b4]">${data.views_count || 0}</div>
                                        <div class="text-sm text-[#9ca3af]">Vues</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tags -->
                            ${data.tags && data.tags.length > 0 ? `
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Tags</h4>
                                <div class="flex flex-wrap gap-2">
                                    ${data.tags.map(tag => `<span class="px-2 py-1 bg-[#00b6b4] text-white rounded-full text-xs">${tag}</span>`).join('')}
                                </div>
                            </div>
                            ` : ''}

                            <!-- Dates -->
                            <div class="bg-[#333333] rounded-lg p-4">
                                <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Dates</h4>
                                <div class="space-y-2">
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Créé le:</span>
                                        <p class="text-[#f5f5f5]">${new Date(data.created_at).toLocaleDateString('fr-FR')}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-[#9ca3af]">Modifié le:</span>
                                        <p class="text-[#f5f5f5]">${new Date(data.updated_at).toLocaleDateString('fr-FR')}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-[#333333] rounded-lg p-4">
                        <h4 class="text-lg font-semibold text-[#f5f5f5] mb-4">Description du poste</h4>
                        <div class="text-[#9ca3af] whitespace-pre-wrap leading-relaxed">${data.description || 'Aucune description disponible'}</div>
                    </div>
                </div>
            `;
            document.getElementById('viewJobModal').classList.remove('hidden');
        })
        .catch(error => {
            alert('Erreur lors du chargement des détails de l\'offre');
        });
};

window.editJob = function(jobId) {
    currentJobId = jobId;
    // Load job data and populate form
    fetch(`/admin/jobs/${jobId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            
            // Basic Information
            document.getElementById('editTitle').value = data.title || '';
            document.getElementById('editDescription').value = data.description || '';
            document.getElementById('editLocation').value = data.location || '';
            document.getElementById('editType').value = data.type || 'CDI';
            
            // Job Details
            document.getElementById('editWorkType').value = data.work_type || '';
            document.getElementById('editExperienceLevel').value = data.experience_level || '';
            document.getElementById('editSalaryMin').value = data.salary_min || '';
            document.getElementById('editSalaryMax').value = data.salary_max || '';
            
            // Fix date field - format the date properly
            if (data.application_deadline) {
                const date = new Date(data.application_deadline);
                const formattedDate = date.toISOString().split('T')[0];
                document.getElementById('editApplicationDeadline').value = formattedDate;
            }
            
            // Populate dynamic inputs
            populateDynamicInputs('editResponsibilitiesContainer', data.responsibilities || [], 'editResponsibilities[]', 'Responsabilité');
            populateDynamicInputs('editRequirementsContainer', data.requirements || [], 'editRequirements[]', 'Exigence');
            populateDynamicInputs('editBenefitsContainer', data.benefits || [], 'editBenefits[]', 'Avantage');
            populateDynamicInputs('editSkillsContainer', data.tags || [], 'editSkills[]', 'Compétence');
            
            // Status and Featured
            document.getElementById('editStatus').value = data.status || 'draft';
            document.getElementById('editIsFeatured').checked = data.is_featured || false;
            
            document.getElementById('editJobModal').classList.remove('hidden');
        })
        .catch(error => {
            alert('Erreur lors du chargement des données de l\'offre');
        });
};

window.deleteJob = function(jobId, jobTitle) {
    currentJobId = jobId;
    document.getElementById('deleteJobTitle').textContent = jobTitle;
    document.getElementById('deleteJobModal').classList.remove('hidden');
};

// Modal functions
window.closeViewModal = function() {
    document.getElementById('viewJobModal').classList.add('hidden');
};

window.closeEditModal = function() {
    document.getElementById('editJobModal').classList.add('hidden');
};

window.closeDeleteModal = function() {
    document.getElementById('deleteJobModal').classList.add('hidden');
};

window.editJobFromView = function() {
    closeViewModal();
    editJob(currentJobId);
};

window.confirmDelete = function() {
    if (currentJobId) {
        fetch(`/admin/jobs/${currentJobId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la suppression de l\'offre');
            }
        })
        .catch(error => {
            alert('Erreur lors de la suppression de l\'offre');
        });
    }
    closeDeleteModal();
};

// Helper functions
function getStatusText(status) {
    const statusMap = {
        'published': 'Publié',
        'draft': 'Brouillon',
        'pending': 'En attente',
        'expired': 'Expiré',
        'closed': 'Fermé',
        'suspended': 'Suspendu'
    };
    return statusMap[status] || status;
}

function getStatusClass(status) {
    const classMap = {
        'published': 'text-green-600 bg-green-100',
        'draft': 'text-gray-600 bg-gray-100',
        'pending': 'text-yellow-600 bg-yellow-100',
        'expired': 'text-red-600 bg-red-100',
        'closed': 'text-red-600 bg-red-100',
        'suspended': 'text-red-600 bg-red-100'
    };
    return classMap[status] || 'text-gray-600 bg-gray-100';
}

// Dynamic input counters
let editResponsibilityCount = 1;
let editRequirementCount = 1;
let editBenefitCount = 1;
let editSkillCount = 1;

// Add/Remove functions for edit modal
function addEditResponsibility() {
    editResponsibilityCount++;
    const container = document.getElementById('editResponsibilitiesContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="editResponsibilities[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Responsabilité ${editResponsibilityCount}"
        />
        <button
            type="button"
            onclick="removeEditResponsibility(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateEditRemoveButtons('editResponsibilitiesContainer');
}

function removeEditResponsibility(button) {
    button.parentElement.remove();
    updateEditRemoveButtons('editResponsibilitiesContainer');
}

function addEditRequirement() {
    editRequirementCount++;
    const container = document.getElementById('editRequirementsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="editRequirements[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Exigence ${editRequirementCount}"
        />
        <button
            type="button"
            onclick="removeEditRequirement(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateEditRemoveButtons('editRequirementsContainer');
}

function removeEditRequirement(button) {
    button.parentElement.remove();
    updateEditRemoveButtons('editRequirementsContainer');
}

function addEditBenefit() {
    editBenefitCount++;
    const container = document.getElementById('editBenefitsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="editBenefits[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Avantage ${editBenefitCount}"
        />
        <button
            type="button"
            onclick="removeEditBenefit(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateEditRemoveButtons('editBenefitsContainer');
}

function removeEditBenefit(button) {
    button.parentElement.remove();
    updateEditRemoveButtons('editBenefitsContainer');
}

function addEditSkill() {
    editSkillCount++;
    const container = document.getElementById('editSkillsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="editSkills[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Compétence ${editSkillCount}"
        />
        <button
            type="button"
            onclick="removeEditSkill(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateEditRemoveButtons('editSkillsContainer');
}

function removeEditSkill(button) {
    button.parentElement.remove();
    updateEditRemoveButtons('editSkillsContainer');
}

function updateEditRemoveButtons(containerId) {
    const container = document.getElementById(containerId);
    const buttons = container.querySelectorAll('button[onclick*="remove"]');
    buttons.forEach((button, index) => {
        button.disabled = buttons.length <= 1;
    });
}

function populateDynamicInputs(containerId, dataArray, inputName, placeholderPrefix) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    
    if (dataArray.length === 0) {
        // Add one empty input
        addDynamicInput(container, inputName, placeholderPrefix, 1);
    } else {
        dataArray.forEach((item, index) => {
            addDynamicInput(container, inputName, placeholderPrefix, index + 1, item);
        });
    }
    
    updateEditRemoveButtons(containerId);
}

function addDynamicInput(container, inputName, placeholderPrefix, index, value = '') {
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="${inputName}"
            value="${value}"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="${placeholderPrefix} ${index}"
        />
        <button
            type="button"
            onclick="removeEditInput(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
}

function removeEditInput(button) {
    button.parentElement.remove();
    // Update all containers
    updateEditRemoveButtons('editResponsibilitiesContainer');
    updateEditRemoveButtons('editRequirementsContainer');
    updateEditRemoveButtons('editBenefitsContainer');
    updateEditRemoveButtons('editSkillsContainer');
}

// Edit form submission
document.getElementById('editJobForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Collect dynamic inputs
    const responsibilities = Array.from(document.querySelectorAll('input[name="editResponsibilities[]"]')).map(input => input.value).filter(val => val.trim() !== '');
    const requirements = Array.from(document.querySelectorAll('input[name="editRequirements[]"]')).map(input => input.value).filter(val => val.trim() !== '');
    const benefits = Array.from(document.querySelectorAll('input[name="editBenefits[]"]')).map(input => input.value).filter(val => val.trim() !== '');
    const skills = Array.from(document.querySelectorAll('input[name="editSkills[]"]')).map(input => input.value).filter(val => val.trim() !== '');
    
    const formData = {
        title: document.getElementById('editTitle').value,
        description: document.getElementById('editDescription').value,
        location: document.getElementById('editLocation').value,
        experience_level: document.getElementById('editExperienceLevel').value,
        type: document.getElementById('editType').value,
        work_type: document.getElementById('editWorkType').value,
        salary_min: document.getElementById('editSalaryMin').value,
        salary_max: document.getElementById('editSalaryMax').value,
        application_deadline: document.getElementById('editApplicationDeadline').value,
        responsibilities: responsibilities,
        requirements: requirements,
        benefits: benefits,
        skills: skills,
        status: document.getElementById('editStatus').value,
        is_featured: document.getElementById('editIsFeatured').checked
    };
    
    fetch(`/admin/jobs/${currentJobId}`, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.error || `HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Erreur lors de la mise à jour de l\'offre: ' + (data.error || 'Erreur inconnue'));
        }
    })
    .catch(error => {
        alert('Erreur lors de la mise à jour de l\'offre: ' + error.message);
    });
});
</script>
@endsection
