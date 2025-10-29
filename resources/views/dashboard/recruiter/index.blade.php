@extends('layouts.dashboard')

@section('title', 'Tableau de bord - OMPLEO')
@section('description', 'Gérez vos recrutements depuis votre tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Welcome Section --}}
    <div class="bg-gradient-to-r from-[#00b6b4] to-[#009e9c] rounded-2xl p-4 sm:p-6 md:p-8 text-white">
        <div class="flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2 truncate">
                    Bonjour {{ auth()->user()->name }} ! 👋
                </h1>
                <p class="text-[#b3e5e4] text-sm sm:text-base md:text-lg">
                    Gérez vos recrutements depuis votre tableau de bord
                </p>
                <p class="text-[#80d4d2] mt-2 text-xs sm:text-sm md:text-base truncate">
                    {{ $company->name ?? 'Entreprise' }} • Recruteur
                </p>
            </div>
            <div class="hidden sm:block flex-shrink-0 ml-4">
                <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-white"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
        {{-- Offres actives --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1));">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" style="color: rgb(37 99 235 / var(--tw-text-opacity, 1));"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                </div>
                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1">
                {{ $stats['active_jobs'] }}
            </h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-1 sm:mb-2">
                Offres actives
            </p>
            <p class="text-green-400 text-xs font-medium">
                +{{ $stats['recent_applications'] }} cette semaine
            </p>
        </div>

        {{-- Candidatures reçues --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1));">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1">
                {{ $stats['total_applications'] }}
            </h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-1 sm:mb-2">
                Candidatures reçues
            </p>
            <p class="text-green-400 text-xs font-medium">
                +{{ $stats['recent_applications'] }} cette semaine
            </p>
        </div>

        {{-- Profils consultés --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(243 232 255 / var(--tw-bg-opacity, 1));">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(147 51 234 / var(--tw-text-opacity, 1));">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1">
                {{ $stats['profiles_viewed'] }}
            </h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-1 sm:mb-2">
                Profils consultés
            </p>
            <p class="text-green-400 text-xs font-medium">
                +{{ $stats['recent_applications'] * 2 }} cette semaine
            </p>
        </div>

        {{-- Entretiens programmés --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(255 237 213 / var(--tw-bg-opacity, 1));">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: rgb(234 88 12 / var(--tw-text-opacity, 1));">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1">
                {{ $stats['scheduled_interviews'] }}
            </h3>
            <p class="text-[#9ca3af] text-xs sm:text-sm mb-1 sm:mb-2">
                Entretiens programmés
            </p>
            <p class="text-green-400 text-xs font-medium">
                +{{ $stats['recent_applications'] }} cette semaine
            </p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Actions rapides
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            <a href="{{ route('recruiter.create-offer') }}" class="flex items-center gap-3 p-3 sm:p-4 border-2 border-dashed border-[#00b6b4]/30 rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </div>
                <div class="text-left min-w-0 flex-1">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base truncate">Publier une offre</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af] truncate">Créer une nouvelle annonce</div>
                </div>
            </a>

            <a href="{{ route('recruiter.candidates') }}" class="flex items-center gap-3 p-3 sm:p-4 border-2 border-dashed border-[#333333] rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="text-left min-w-0 flex-1">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base truncate">Parcourir les CV</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af] truncate">Rechercher des candidats</div>
                </div>
            </a>

            <a href="{{ route('recruiter.interviews.create') }}" class="flex items-center gap-3 p-3 sm:p-4 border-2 border-dashed border-[#333333] rounded-xl hover:border-[#00b6b4]/50 hover:bg-[#00b6b4]/10 transition-all duration-200 group sm:col-span-2 lg:col-span-1">
                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-orange-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <div class="text-left min-w-0 flex-1">
                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base truncate">Programmer entretien</div>
                    <div class="text-xs sm:text-sm text-[#9ca3af] truncate">Organiser un RDV</div>
                </div>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
        {{-- Recent Applications --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Candidatures récentes
                </h2>
                <a href="{{ route('recruiter.jobs') }}" class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                    Voir tout
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentApplications as $application)
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 sm:p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200 gap-3">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                            {{ substr($application->candidate->name, 0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                                {{ $application->candidate->name }}
                            </h3>
                            <p class="text-sm text-[#9ca3af] truncate">
                                {{ $application->job->title }}
                            </p>
                            <div class="flex items-center gap-2 text-xs text-[#9ca3af] mt-1">
                                <span class="truncate">{{ $application->job->location }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 sm:gap-1">
                        @php
                            $statusColors = [
                                'pending' => 'color: rgb(37 99 235 / var(--tw-text-opacity, 1)); background-color: rgb(219 234 254 / var(--tw-bg-opacity, 1));',
                                'reviewed' => 'background-color: rgb(254 249 195 / var(--tw-bg-opacity, 1)); color: rgb(202 138 4 / var(--tw-text-opacity, 1));',
                                'accepted' => 'color: rgb(22 163 74 / var(--tw-text-opacity, 1)); background-color: rgb(220 252 231 / var(--tw-bg-opacity, 1));',
                                'rejected' => 'color: rgb(239 68 68 / var(--tw-text-opacity, 1)); background-color: rgb(254 226 226 / var(--tw-bg-opacity, 1));'
                            ];
                            $statusLabels = [
                                'pending' => 'Nouveau',
                                'reviewed' => 'En cours',
                                'accepted' => 'Accepté',
                                'rejected' => 'Rejeté'
                            ];
                        @endphp
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap" style="{{ $statusColors[$application->status] ?? $statusColors['pending'] }}">
                            {{ $statusLabels[$application->status] ?? 'Nouveau' }}
                        </span>
                        <p class="text-xs text-[#9ca3af] whitespace-nowrap">
                            {{ $application->created_at->format('Y-m-d') }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucune candidature</h3>
                    <p class="text-[#9ca3af]">Aucune candidature reçue pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Active Jobs --}}
        <div class="bg-[#2b2b2b] border rounded-2xl p-4 sm:p-6 shadow-lg" style="border-color: rgb(71 85 105 / var(--tw-border-opacity, 1));">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                    Offres actives
                </h2>
                <a href="{{ route('recruiter.jobs') }}" class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                    Gérer
                </a>
            </div>
            <div class="space-y-4">
                @forelse($activeJobs as $job)
                <div class="p-3 sm:p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-start justify-between mb-3 gap-2">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate flex-1 min-w-0">
                            {{ $job->title }}
                        </h3>
                        <span class="text-green-400 bg-green-900/30 px-2 py-1 rounded-full text-xs font-medium whitespace-nowrap flex-shrink-0">
                            {{ ucfirst($job->status) }}
                        </span>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-[#9ca3af] gap-2">
                        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                <span class="truncate">{{ $job->applications()->count() }} candidatures</span>
                            </span>
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span class="truncate">{{ $job->applications()->count() * 7 }} vues</span>
                            </span>
                        </div>
                        <span class="text-xs sm:text-sm whitespace-nowrap">{{ $job->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucune offre active</h3>
                    <p class="text-[#9ca3af]">Vous n'avez pas encore publié d'offres d'emploi.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Upcoming Interviews --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4 sm:mb-6">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                Entretiens à venir
            </h2>
            <a href="{{ route('recruiter.interviews') }}" class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                Voir tout
            </a>
        </div>
        <div class="space-y-3 sm:space-y-4">
            @forelse($upcomingInterviews->take(5) as $interview)
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 sm:p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200 gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ substr($interview->candidate->name, 0, 2) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">
                            {{ $interview->candidate->name }}
                        </h3>
                        <p class="text-sm text-[#9ca3af] truncate">
                            {{ $interview->job->title }}
                        </p>
                        <div class="flex flex-wrap items-center gap-2 text-xs text-[#9ca3af] mt-1">
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" x2="16" y1="2" y2="6"/>
                                    <line x1="8" x2="8" y1="2" y2="6"/>
                                    <line x1="3" x2="21" y1="10" y2="10"/>
                                </svg>
                                <span class="truncate">{{ $interview->formatted_date }}</span>
                            </span>
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12,6 12,12 16,14"/>
                                </svg>
                                <span class="truncate">{{ $interview->formatted_start_time }}</span>
                            </span>
                            <span class="flex items-center gap-1 whitespace-nowrap">
                                <svg class="w-3 h-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span class="truncate">{{ $interview->type_in_french }}</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 sm:gap-1">
                    @php
                        $statusColors = [
                            'programme' => 'color: rgb(0, 182, 180); background-color: rgba(0, 182, 180, 0.1);',
                            'confirme' => 'color: rgb(16, 185, 129); background-color: rgba(16, 185, 129, 0.1);',
                            'en_attente' => 'color: rgb(245, 158, 11); background-color: rgba(245, 158, 11, 0.1);',
                            'annule' => 'color: rgb(239, 68, 68); background-color: rgba(239, 68, 68, 0.1);',
                            'termine' => 'color: rgb(107, 114, 128); background-color: rgba(107, 114, 128, 0.1);'
                        ];
                        $statusLabels = [
                            'programme' => 'Programmé',
                            'confirme' => 'Confirmé',
                            'en_attente' => 'En attente',
                            'annule' => 'Annulé',
                            'termine' => 'Terminé'
                        ];
                    @endphp
                    <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-medium whitespace-nowrap" style="{{ $statusColors[$interview->status] ?? $statusColors['programme'] }}">
                        {{ $statusLabels[$interview->status] ?? 'Programmé' }}
                    </span>
                    <p class="text-xs text-[#9ca3af] whitespace-nowrap">
                        {{ $interview->formatted_duration }}
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucun entretien programmé</h3>
                <p class="text-[#9ca3af] mb-4">Vous n'avez pas encore programmé d'entretiens.</p>
                <a href="{{ route('recruiter.interviews.create') }}" class="inline-flex items-center gap-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 py-2 rounded-lg transition-colors duration-200 text-sm font-medium">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                    Programmer un entretien
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
