@extends('layouts.dashboard')

@section('title', 'Candidatures - ' . $job->title . ' - OMPLEO')
@section('description', 'Consultez et gérez les candidatures pour cette offre d\'emploi.')
@section('page-title', 'Candidatures')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div id="successNotification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="errorNotification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('recruiter.jobs') }}" class="text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </a>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                    Candidatures pour "{{ $job->title }}"
                </h1>
            </div>
            <p class="text-sm sm:text-base text-[#9ca3af]">
                {{ $job->company->name }} • {{ $job->location }}
            </p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        {{-- Total candidatures --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Total candidatures</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#333333] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- En attente --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">En attente</p>
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

        {{-- Acceptées --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Acceptées</p>
                    <p class="text-xl sm:text-2xl font-bold text-green-400">{{ $stats['accepted'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Rejetées --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Rejetées</p>
                    <p class="text-xl sm:text-2xl font-bold text-red-400">{{ $stats['rejected'] }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Applications List --}}
    <div class="space-y-4 sm:space-y-6">
        @forelse($applications as $application)
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-start gap-4 sm:gap-6">
                {{-- Candidate Info --}}
                <div class="flex items-start gap-4 flex-1">
                    {{-- Avatar --}}
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#333333] rounded-full flex items-center justify-center flex-shrink-0">
                        @if($application->candidate->candidateProfile && $application->candidate->candidateProfile->avatar)
                            <img src="{{ Storage::url($application->candidate->candidateProfile->avatar) }}" alt="{{ $application->candidate->name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Candidate Details --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] truncate">
                                {{ $application->candidate->name }}
                            </h3>
                            <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium
                                @if($application->status === 'pending') text-yellow-600 bg-yellow-100 dark:text-yellow-400 dark:bg-yellow-900/20
                                @elseif($application->status === 'accepted') text-green-600 bg-green-100 dark:text-green-400 dark:bg-green-900/20
                                @elseif($application->status === 'rejected') text-red-600 bg-red-100 dark:text-red-400 dark:bg-red-900/20
                                @else text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-gray-900/20 @endif">
                                @if($application->status === 'pending') En attente
                                @elseif($application->status === 'accepted') Acceptée
                                @elseif($application->status === 'rejected') Rejetée
                                @else {{ ucfirst($application->status) }} @endif
                            </span>
                        </div>

                        @if($application->candidate->candidateProfile)
                            <div class="text-sm text-[#9ca3af] mb-3">
                                @if($application->candidate->candidateProfile->title)
                                    <p class="font-medium text-[#f5f5f5]">{{ $application->candidate->candidateProfile->title }}</p>
                                @endif
                                @if($application->candidate->candidateProfile->location)
                                    <p class="flex items-center gap-1 mt-1">
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        {{ $application->candidate->candidateProfile->location }}
                                    </p>
                                @endif
                            </div>
                        @endif

                        {{-- Application Date --}}
                        <p class="text-xs text-[#9ca3af] mb-3">
                            Candidature envoyée le {{ $application->applied_at->format('d/m/Y à H:i') }}
                        </p>

                        {{-- Cover Letter Preview --}}
                        @if($application->cover_letter)
                            <div class="bg-[#333333] rounded-lg p-3 mb-3">
                                <p class="text-sm text-[#9ca3af] mb-2 font-medium">Lettre de motivation :</p>
                                <p class="text-sm text-[#f5f5f5] line-clamp-3">{{ Str::limit($application->cover_letter, 200) }}</p>
                            </div>
                        @endif

                        {{-- Resume File --}}
                        @if($application->resume_path)
                            <div class="flex items-center gap-2 text-sm text-[#9ca3af] mb-3">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14,2 14,8 20,8"/>
                                    <line x1="16" x2="8" y1="13" y2="13"/>
                                    <line x1="16" x2="8" y1="17" y2="17"/>
                                    <polyline points="10,9 9,9 8,9"/>
                                </svg>
                                <a href="{{ Storage::url($application->resume_path) }}" target="_blank" class="text-[#00b6b4] hover:text-[#009999] transition-colors">
                                    Télécharger le CV
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 lg:flex-col lg:items-end">
                    {{-- View Profile Button --}}
                    <a href="{{ route('candidate.profile', $application->candidate->id) }}" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-3 sm:px-4 py-2 rounded-lg transition-colors text-xs sm:text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        Voir le profil
                    </a>

                    {{-- Accept/Reject Buttons --}}
                    @if($application->status === 'pending')
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('applications.update-status', $application) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors text-xs sm:text-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Accepter
                                </button>
                            </form>
                            <form method="POST" action="{{ route('applications.update-status', $application) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors text-xs sm:text-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6L6 18M6 6l12 12"/>
                                    </svg>
                                    Rejeter
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-sm text-[#9ca3af] text-center">
                            @if($application->status === 'accepted')
                                <span class="text-green-400">✓ Candidature acceptée</span>
                            @elseif($application->status === 'rejected')
                                <span class="text-red-400">✗ Candidature rejetée</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @empty
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 sm:p-12 text-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-2 sm:mb-3">
                Aucune candidature
            </h3>
            <p class="text-sm sm:text-base text-[#9ca3af] mb-4 sm:mb-6">
                Aucun candidat n'a encore postulé pour cette offre d'emploi.
            </p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($applications->hasPages())
    <div class="flex justify-center">
        {{ $applications->links() }}
    </div>
    @endif
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
</script>

@endsection
