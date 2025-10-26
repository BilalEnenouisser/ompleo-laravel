@extends('layouts.dashboard')
@section('page-title', 'Rapports')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Rapports & Analytics
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Analysez les performances de vos recrutements
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
            <select class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none text-sm sm:text-base">
                <option value="7">7 derniers jours</option>
                <option value="30" selected>30 derniers jours</option>
                <option value="90">3 derniers mois</option>
                <option value="365">12 derniers mois</option>
            </select>
            <button class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
                <span class="hidden sm:inline">Actualiser</span>
                <span class="sm:hidden">Actualiser</span>
            </button>
            <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                <span class="hidden sm:inline">Exporter</span>
                <span class="sm:hidden">Exporter</span>
            </button>
        </div>
    </div>

    {{-- Report Type Tabs --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex flex-wrap gap-2 mb-4 sm:mb-6">
            <button id="overviewTab" class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors bg-[#00b6b4] text-white text-sm sm:text-base">
                Vue d'ensemble
            </button>
            <button id="jobsTab" class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors bg-[#333333] text-[#9ca3af] hover:bg-[#444444] text-sm sm:text-base">
                Performance des offres
            </button>
            <button id="candidatesTab" class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors bg-[#333333] text-[#9ca3af] hover:bg-[#444444] text-sm sm:text-base">
                Analyse candidats
            </button>
            <button id="trendsTab" class="px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors bg-[#333333] text-[#9ca3af] hover:bg-[#444444] text-sm sm:text-base">
                Tendances
            </button>
        </div>
    </div>

    {{-- Overview Stats --}}
    <div id="overviewContent" class="space-y-6 sm:space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="bg-blue-100 text-blue-600 w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target w-5 h-5 sm:w-6 sm:h-6"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                    </div>
                    <div class="flex items-center gap-1 text-xs sm:text-sm font-medium text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        +3
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['total_jobs'] }}</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Offres publiées</p>
            </div>

            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="bg-green-100 text-green-600 w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 sm:w-6 sm:h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="flex items-center gap-1 text-xs sm:text-sm font-medium text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        +23
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['total_applications'] }}</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Candidatures reçues</p>
            </div>

            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="bg-purple-100 text-purple-600 w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-5 h-5 sm:w-6 sm:h-6"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </div>
                    <div class="flex items-center gap-1 text-xs sm:text-sm font-medium text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        +156
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ number_format($stats['total_views']) }}</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Vues des offres</p>
            </div>

            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <div class="bg-orange-100 text-orange-600 w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-5 h-5 sm:w-6 sm:h-6"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <div class="flex items-center gap-1 text-xs sm:text-sm font-medium text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        +1.2%
                    </div>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['conversion_rate'] }}%</h3>
                <p class="text-[#9ca3af] text-xs sm:text-sm">Taux de conversion</p>
            </div>
        </div>

        {{-- Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            {{-- Application Trends --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Évolution des candidatures
                </h2>
                <div class="space-y-4">
                    @foreach($stats['applications_trend'] as $trend)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                                <span class="font-bold text-[#00b6b4]">{{ $trend['month'] }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">{{ $trend['applications'] }} candidatures</p>
                                <p class="text-sm text-[#9ca3af]">{{ number_format($trend['views']) }} vues</p>
                            </div>
                        </div>
                        <div class="w-24 h-2 bg-[#333333] rounded-full overflow-hidden">
                            <div class="h-full bg-[#00b6b4] rounded-full" style="width: {{ $trend['percentage'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Candidate Sources --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                    Sources des candidats
                </h2>
                <div class="space-y-4">
                    @foreach($stats['candidate_sources'] as $source)
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-[#f5f5f5]">{{ $source['name'] }}</span>
                            <span class="text-sm text-[#9ca3af]">{{ $source['count'] }} candidats</span>
                        </div>
                        <div class="w-full h-2 bg-[#333333] rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-[#00b6b4] to-[#009999] rounded-full" style="width: {{ $source['percentage'] }}%"></div>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-[#9ca3af]">{{ $source['percentage'] }}%</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Job Performance --}}
    <div id="jobsContent" class="hidden">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                Performance des offres d'emploi
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-[#333333]">
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Offre</th>
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Vues</th>
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Candidatures</th>
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Taux conversion</th>
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Statut</th>
                            <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5]">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['job_performance'] as $job)
                        <tr class="border-b border-[#333333] hover:bg-[#333333]">
                            <td class="py-4 px-4">
                                <div class="font-medium text-[#f5f5f5]">{{ $job['title'] }}</div>
                            </td>
                            <td class="py-4 px-4 text-[#9ca3af]">{{ $job['views'] }}</td>
                            <td class="py-4 px-4 text-[#9ca3af]">{{ $job['applications'] }}</td>
                            <td class="py-4 px-4">
                                <span class="font-medium text-[#f5f5f5]">{{ $job['conversion_rate'] }}</span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $job['status'] == 'Actif' ? 'text-green-400 bg-green-400/20' : 'text-red-400 bg-red-400/20' }}">
                                    {{ $job['status'] }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-[#9ca3af]">{{ $job['date'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-[#9ca3af]">
                                Aucune offre d'emploi trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Candidate Analysis --}}
    <div id="candidatesContent" class="hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                    Statut des candidatures
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-blue-400/20 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">En cours</p>
                                <p class="text-sm text-[#9ca3af]">Candidatures en attente</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-blue-400">{{ $stats['application_status']['pending'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-green-400/20 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Acceptées</p>
                                <p class="text-sm text-[#9ca3af]">Candidatures retenues</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-green-400">{{ $stats['application_status']['accepted'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-red-400/20 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Refusées</p>
                                <p class="text-sm text-[#9ca3af]">Candidatures non retenues</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-red-400">{{ $stats['application_status']['rejected'] }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                    Temps de réponse moyen
                </h2>
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#00b6b4] mb-2">{{ $stats['response_time'] }} jours</div>
                        <p class="text-[#9ca3af]">Temps moyen de première réponse</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-[#333333] rounded-lg">
                            <div class="text-2xl font-bold text-[#f5f5f5]">1.8j</div>
                            <p class="text-sm text-[#9ca3af]">Le plus rapide</p>
                        </div>
                        <div class="text-center p-4 bg-[#333333] rounded-lg">
                            <div class="text-2xl font-bold text-[#f5f5f5]">4.2j</div>
                            <p class="text-sm text-[#9ca3af]">Le plus lent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Trends --}}
    <div id="trendsContent" class="hidden space-y-6 sm:space-y-8">
        {{-- Charts Row 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            {{-- Weekly Applications Trend --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Tendances des candidatures (7 derniers jours)
                </h2>
                <div class="h-64">
                    <canvas id="weeklyApplicationsChart"></canvas>
                </div>
            </div>

            {{-- Conversion Rate Trend --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Taux de conversion (7 derniers jours)
                </h2>
                <div class="h-64">
                    <canvas id="conversionRateChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Charts Row 2 --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            {{-- Monthly Job Performance --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Performance mensuelle des offres
                </h2>
                <div class="h-64">
                    <canvas id="monthlyJobChart"></canvas>
                </div>
            </div>

            {{-- Application Status Trend --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Évolution du statut des candidatures
                </h2>
                <div class="h-64">
                    <canvas id="statusTrendChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Tables Row --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            {{-- Top Job Categories Table --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Top catégories d'emploi
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#333333]">
                                <th class="text-left py-3 px-2 text-sm font-medium text-[#9ca3af]">Catégorie</th>
                                <th class="text-right py-3 px-2 text-sm font-medium text-[#9ca3af]">Offres</th>
                                <th class="text-right py-3 px-2 text-sm font-medium text-[#9ca3af]">Vues</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['trends']['job_categories'] as $category)
                            <tr class="border-b border-[#333333]/50">
                                <td class="py-3 px-2 text-sm text-[#f5f5f5]">{{ $category['category'] }}</td>
                                <td class="py-3 px-2 text-sm text-[#f5f5f5] text-right">{{ $category['jobs'] }}</td>
                                <td class="py-3 px-2 text-sm text-[#f5f5f5] text-right">{{ number_format($category['views']) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-[#9ca3af]">Aucune donnée disponible</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Performance Summary Table --}}
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                    Résumé des performances
                </h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-[#00b6b4]/10 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Candidatures totales</p>
                                <p class="text-sm text-[#9ca3af]">Toutes les candidatures reçues</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-[#00b6b4]">{{ $stats['total_applications'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-green-400/10 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-400/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Taux de conversion</p>
                                <p class="text-sm text-[#9ca3af]">Candidatures / Vues</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-green-400">{{ $stats['conversion_rate'] }}%</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-blue-400/10 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-400/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10,9 9,9 8,9"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Offres actives</p>
                                <p class="text-sm text-[#9ca3af]">Offres publiées</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-blue-400">{{ $stats['total_jobs'] }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-purple-400/10 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-400/20 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-[#f5f5f5]">Vues totales</p>
                                <p class="text-sm text-[#9ca3af]">Toutes les vues d'offres</p>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-purple-400">{{ number_format($stats['total_views']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = {
        overview: document.getElementById('overviewTab'),
        jobs: document.getElementById('jobsTab'),
        candidates: document.getElementById('candidatesTab'),
        trends: document.getElementById('trendsTab')
    };
    
    const contents = {
        overview: document.getElementById('overviewContent'),
        jobs: document.getElementById('jobsContent'),
        candidates: document.getElementById('candidatesContent'),
        trends: document.getElementById('trendsContent')
    };

    function setActiveTab(activeTab) {
        // Reset all tabs
        Object.values(tabs).forEach(tab => {
            tab.classList.remove('bg-[#00b6b4]', 'text-white');
            tab.classList.add('bg-[#333333]', 'text-[#9ca3af]', 'hover:bg-[#444444]');
        });
        
        // Hide all contents
        Object.values(contents).forEach(content => {
            content.classList.add('hidden');
        });
        
        // Set active tab
        tabs[activeTab].classList.add('bg-[#00b6b4]', 'text-white');
        tabs[activeTab].classList.remove('bg-[#333333]', 'text-[#9ca3af]', 'hover:bg-[#444444]');
        
        // Show active content
        contents[activeTab].classList.remove('hidden');
    }

    // Add event listeners
    Object.keys(tabs).forEach(tabKey => {
        tabs[tabKey].addEventListener('click', () => setActiveTab(tabKey));
    });

    // Set initial tab
    setActiveTab('overview');
    
    // Initialize charts when trends tab is shown
    let chartsInitialized = false;
    
    function initializeCharts() {
        if (chartsInitialized) return;
        
        // Chart.js configuration
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#f5f5f5'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: '#333333'
                    }
                },
                y: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: '#333333'
                    }
                }
            }
        };
        
        // Weekly Applications Chart
        const weeklyCtx = document.getElementById('weeklyApplicationsChart');
        if (weeklyCtx) {
            new Chart(weeklyCtx, {
                type: 'line',
                data: {
                    labels: @json(array_column($stats['trends']['weekly_applications'], 'date')),
                    datasets: [{
                        label: 'Candidatures',
                        data: @json(array_column($stats['trends']['weekly_applications'], 'applications')),
                        borderColor: '#00b6b4',
                        backgroundColor: 'rgba(0, 182, 180, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: chartOptions
            });
        }
        
        // Conversion Rate Chart
        const conversionCtx = document.getElementById('conversionRateChart');
        if (conversionCtx) {
            new Chart(conversionCtx, {
                type: 'line',
                data: {
                    labels: @json(array_column($stats['trends']['conversion_trend'], 'date')),
                    datasets: [{
                        label: 'Taux de conversion (%)',
                        data: @json(array_column($stats['trends']['conversion_trend'], 'rate')),
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: chartOptions
            });
        }
        
        // Monthly Job Performance Chart
        const monthlyCtx = document.getElementById('monthlyJobChart');
        if (monthlyCtx) {
            new Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($stats['trends']['monthly_job_trend'], 'month')),
                    datasets: [{
                        label: 'Offres créées',
                        data: @json(array_column($stats['trends']['monthly_job_trend'], 'jobs')),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: '#3b82f6',
                        borderWidth: 1
                    }, {
                        label: 'Vues (÷100)',
                        data: @json(array_map(function($item) { return $item / 100; }, array_column($stats['trends']['monthly_job_trend'], 'views'))),
                        backgroundColor: 'rgba(168, 85, 247, 0.8)',
                        borderColor: '#a855f7',
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }
        
        // Status Trend Chart
        const statusCtx = document.getElementById('statusTrendChart');
        if (statusCtx) {
            new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($stats['trends']['status_trend'], 'month')),
                    datasets: [{
                        label: 'En attente',
                        data: @json(array_column($stats['trends']['status_trend'], 'pending')),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: '#3b82f6',
                        borderWidth: 1
                    }, {
                        label: 'Acceptées',
                        data: @json(array_column($stats['trends']['status_trend'], 'accepted')),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: '#10b981',
                        borderWidth: 1
                    }, {
                        label: 'Refusées',
                        data: @json(array_column($stats['trends']['status_trend'], 'rejected')),
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: '#ef4444',
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }
        
        chartsInitialized = true;
    }
    
    // Initialize charts when trends tab is clicked
    tabs.trends.addEventListener('click', function() {
        setTimeout(initializeCharts, 100);
    });
});
</script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
