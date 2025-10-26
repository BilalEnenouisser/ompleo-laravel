@extends('layouts.dashboard')

@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-[#00b6b4] to-[#009999] rounded-2xl p-4 sm:p-6 lg:p-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-1 sm:mb-2">
                    Bonjour {{ $user->name }} ! 👋
                </h1>
                <p class="text-white/80 text-sm sm:text-base lg:text-lg">
                    Voici un aperçu de votre activité récente
                </p>
            </div>
            <div class="hidden sm:block ml-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-white"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(37 99 235 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['total_applications'] }}</h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-2">Candidatures envoyées</p>
            <p class="text-green-400 text-xs font-medium">{{ $stats['pending_applications'] }} en attente</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['reviewed_applications'] }}</h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-2">Candidatures examinées</p>
            <p class="text-green-400 text-xs font-medium">{{ $stats['shortlisted_applications'] }} présélectionnées</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(254 226 226 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(220 38 38 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $stats['success_rate'] }}%</h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-2">Taux de réussite</p>
            <p class="text-green-400 text-xs font-medium">Performance</p>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(243 232 255 / var(--tw-bg-opacity, 1));">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(147 51 234 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path></svg>
                </div>
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/><polyline points="16,7 22,7 22,13"/></svg>
            </div>
            <h3 class="text-xl sm:text-2xl font-bold text-[#f5f5f5] mb-1">{{ $recentApplications->count() }}</h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-2">Candidatures récentes</p>
            <p class="text-green-400 text-xs font-medium">Dernières activités</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
        {{-- Recent Applications --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Candidatures récentes
                </h2>
                <a href="{{ route('candidate.applications') }}" class="text-[#00b6b4] hover:text-[#009999] text-xs sm:text-sm font-medium">
                    Voir tout
                </a>
            </div>
            <div class="space-y-3 sm:space-y-4">
                @forelse($recentApplications as $application)
                    <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-[#f5f5f5] mb-1 text-sm sm:text-base">
                                {{ $application->job->title }}
                            </h3>
                            <p class="text-[#9ca3af] text-xs sm:text-sm">
                                {{ $application->job->company->name }} • {{ $application->applied_at->format('d/m/Y') }}
                            </p>
                        </div>
                        @php
                            $statusMap = [
                                'pending' => ['text' => 'En cours', 'class' => 'text-yellow-600 bg-yellow-100'],
                                'accepted' => ['text' => 'Accepté', 'class' => 'text-green-600 bg-green-100'],
                                'rejected' => ['text' => 'Refusé', 'class' => 'text-red-600 bg-red-100'],
                                'shortlisted' => ['text' => 'Présélectionné', 'class' => 'text-blue-600 bg-blue-100'],
                                'reviewed' => ['text' => 'Examiné', 'class' => 'text-purple-600 bg-purple-100']
                            ];
                            $statusInfo = $statusMap[$application->status] ?? ['text' => $application->status, 'class' => 'text-gray-600 bg-gray-100'];
                        @endphp
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium flex-shrink-0 {{ $statusInfo['class'] }}">
                            {{ $statusInfo['text'] }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                                <rect width="20" height="14" x="2" y="6" rx="2"/>
                            </svg>
                        </div>
                        <p class="text-[#9ca3af] text-sm">Aucune candidature récente</p>
                        <a href="{{ route('jobs.index') }}" class="text-[#00b6b4] hover:text-[#009999] text-sm font-medium mt-2 inline-block">
                            Voir les offres d'emploi
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recommended Jobs --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Offres recommandées
                </h2>
                <a href="{{ route('jobs.index') }}" class="text-[#00b6b4] hover:text-[#009999] text-xs sm:text-sm font-medium">
                    Voir plus
                </a>
            </div>
            <div class="space-y-3 sm:space-y-4">
                @forelse($recommendedJobs as $job)
                    <div class="flex items-center justify-between p-3 sm:p-4 border border-[#333333] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-[#f5f5f5] mb-1 text-sm sm:text-base">
                                {{ $job->title }}
                            </h3>
                            <p class="text-[#9ca3af] text-xs sm:text-sm">
                                {{ $job->company->name }} • {{ $job->location }}
                            </p>
                        </div>
                        <div class="text-right flex-shrink-0 ml-2">
                            <div class="text-[#00b6b4] font-bold text-xs sm:text-sm mb-1">
                                {{ rand(75, 95) }}% match
                            </div>
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-xs text-[#00b6b4] hover:text-[#009999] font-medium">
                                Voir l'offre
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                            </svg>
                        </div>
                        <p class="text-[#9ca3af] text-sm">Aucune offre recommandée</p>
                        <a href="{{ route('jobs.index') }}" class="text-[#00b6b4] hover:text-[#009999] text-sm font-medium mt-2 inline-block">
                            Voir toutes les offres
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Actions rapides
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            <a href="{{ route('candidate.profile') }}" class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 border-2 border-dashed border-[#444444] rounded-xl hover:border-[#00b6b4] hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <div class="text-left min-w-0">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">Compléter mon profil</div>
                    <div class="text-xs sm:text-sm {{ $stats['profile_completion'] == 100 ? 'text-green-400' : 'text-[#9ca3af]' }}">
                        {{ $stats['profile_completion'] }}% complété
                        @if($stats['profile_completion'] == 100)
                            ✅
                        @endif
                    </div>
                </div>
            </a>

            <button class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 border-2 border-dashed border-[#444444] rounded-xl hover:border-[#00b6b4] hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-400/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="text-left min-w-0">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base">Parrainer un ami</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af]">Gagnez des points</div>
                </div>
            </button>
        </div>
    </div>

    {{-- Upcoming Events --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Prochains événements
        </h2>
        <div class="space-y-3 sm:space-y-4">
            @php
                // Get upcoming interviews (applications with status 'shortlisted' or 'accepted' that might have interviews)
                $upcomingInterviews = $user->applications()
                    ->whereIn('status', ['shortlisted', 'accepted'])
                    ->with(['job.company'])
                    ->orderBy('updated_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            
            @forelse($upcomingInterviews as $application)
                <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 bg-blue-400/20 rounded-xl">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base">
                            {{ $application->status === 'accepted' ? 'Candidature acceptée' : 'Entretien possible' }} - {{ $application->job->company->name }}
                        </h3>
                        <p class="text-[#9ca3af] text-xs sm:text-sm">
                            {{ $application->job->title }} • {{ $application->updated_at->format('d/m/Y') }}
                        </p>
                    </div>
                    <a href="{{ route('jobs.show', $application->job->slug) }}" class="text-blue-400 hover:text-blue-300 text-xs sm:text-sm font-medium flex-shrink-0">
                        Détails
                    </a>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                    </div>
                    <p class="text-[#9ca3af] text-sm">Aucun événement à venir</p>
                    <p class="text-[#9ca3af] text-xs mt-1">Continuez à postuler pour voir vos prochains entretiens</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
