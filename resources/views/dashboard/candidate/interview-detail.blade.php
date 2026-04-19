@extends('layouts.dashboard')
@section('page-title', 'Détails de l\'Entretien')

@php
    $todayDate = now()->toDateString();
@endphp

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5] mb-2">Détails de l'Entretien</h1>
            <p class="text-[#9ca3af]">{{ $interview->job->company->name }} • {{ $interview->job->title }}</p>
        </div>
        <a href="{{ route('candidate.dashboard') }}" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-6 py-3 rounded-lg transition-colors inline-flex items-center gap-2">
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Retour
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-4 flex items-center gap-3">
            <svg class="w-7 h-7 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Interview Details Card --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 sm:p-8 shadow-lg">
        {{-- Status Badge --}}
        <div class="mb-6">
            <x-status-badge :status="$interview->status" :label="$interview->status_in_french" />
        </div>

        {{-- Interview Information Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            {{-- Date --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Date</p>
                    <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->formatted_date }}</p>
                </div>
            </div>

            {{-- Time --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Heure</p>
                    <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->full_time }}</p>
                </div>
            </div>

            {{-- Type --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <x-interview-type-icon :type="$interview->type" class="w-7 h-7 text-[#00b6b4]" />
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Type</p>
                    <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->type_in_french }}</p>
                </div>
            </div>

            {{-- Location/Meeting Link --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Lieu</p>
                    @if($interview->meeting_link)
                        <a href="{{ $interview->meeting_link }}" target="_blank" class="text-base font-semibold text-[#00b6b4] hover:text-[#009999] break-all">
                            {{ $interview->meeting_link }}
                        </a>
                    @else
                        <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->location ?? 'Non spécifié' }}</p>
                    @endif
                </div>
            </div>

            {{-- Company --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Entreprise</p>
                    <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->job->company->name }}</p>
                </div>
            </div>

            {{-- Job Title --}}
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#00b6b4]/10 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" x2="8" y1="13" y2="13"/>
                        <line x1="16" x2="8" y1="17" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-[#9ca3af] mb-1">Poste</p>
                    <p class="text-base font-semibold text-[#f5f5f5]">{{ $interview->job->title }}</p>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        @if($interview->notes)
            <div class="mb-8 p-4 bg-[#333333] rounded-lg border border-[#444444]">
                <p class="text-sm text-[#9ca3af] mb-2">Notes</p>
                <p class="text-[#f5f5f5] whitespace-pre-line">{{ $interview->notes }}</p>
            </div>
        @endif

        {{-- Action Buttons --}}
        @if($interview->status != 'annule' && $interview->status != 'termine')
            <div class="border-t border-[#333333] pt-6">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Actions</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Confirm Button --}}
                    @if($interview->status != 'confirme')
                        <form method="POST" action="{{ route('candidate.interviews.confirm', $interview) }}" class="contents">
                            @csrf
                            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center gap-2 font-medium">
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Confirmer
                            </button>
                        </form>
                    @endif

                    {{-- Cancel Button --}}
                    <button type="button" onclick="openCancelModal()" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center gap-2 font-medium">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="15" x2="9" y1="9" y2="15"/>
                            <line x1="9" x2="15" y1="9" y2="15"/>
                        </svg>
                        Annuler
                    </button>

                    {{-- Request Change Button --}}
                    <button type="button" onclick="openChangeModal()" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center gap-2 font-medium">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Demander un changement
                    </button>

                    {{-- Report Problem Button --}}
                    <button type="button" onclick="openProblemModal()" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center gap-2 font-medium">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                            <path d="M12 9v4"/>
                            <path d="M12 17h.01"/>
                        </svg>
                        Signaler un problème
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Cancel Modal --}}
<div id="cancelModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 max-w-md w-full">
        <h3 class="text-xl font-bold text-[#f5f5f5] mb-4">Annuler l'entretien</h3>
        <form method="POST" action="{{ route('candidate.interviews.cancel', $interview) }}">
            @csrf
            <div class="mb-4">
                <label for="cancellation_reason" class="block text-sm font-medium text-[#f5f5f5] mb-2">Raison de l'annulation *</label>
                <textarea id="cancellation_reason" name="cancellation_reason" rows="4" required class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none" placeholder="Expliquez pourquoi vous annulez cet entretien..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeCancelModal()" class="flex-1 bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">Confirmer l'annulation</button>
            </div>
        </form>
    </div>
</div>

{{-- Change Request Modal --}}
<div id="changeModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 max-w-md w-full">
        <h3 class="text-xl font-bold text-[#f5f5f5] mb-4">Demander une modification</h3>
        <form method="POST" action="{{ route('candidate.interviews.request-change', $interview) }}">
            @csrf
            <div class="mb-4">
                <label for="change_request" class="block text-sm font-medium text-[#f5f5f5] mb-2">Votre demande *</label>
                <textarea id="change_request" name="change_request" rows="4" required class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none" placeholder="Expliquez la modification souhaitée..."></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="suggested_date" class="block text-sm font-medium text-[#f5f5f5] mb-2">Date suggérée (optionnel)</label>
                    <input type="date" id="suggested_date" name="suggested_date" min="{{ $todayDate }}" class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-2 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                </div>
                <div>
                    <label for="suggested_time" class="block text-sm font-medium text-[#f5f5f5] mb-2">Heure suggérée (optionnel)</label>
                    <input type="time" id="suggested_time" name="suggested_time" class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-2 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                </div>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeChangeModal()" class="flex-1 bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">Envoyer la demande</button>
            </div>
        </form>
    </div>
</div>

{{-- Problem Report Modal --}}
<div id="problemModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 max-w-md w-full">
        <h3 class="text-xl font-bold text-[#f5f5f5] mb-4">Signaler un problème</h3>
        <form method="POST" action="{{ route('candidate.interviews.report-problem', $interview) }}">
            @csrf
            <div class="mb-4">
                <label for="problem_description" class="block text-sm font-medium text-[#f5f5f5] mb-2">Description du problème *</label>
                <textarea id="problem_description" name="problem_description" rows="4" required class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none" placeholder="Décrivez le problème rencontré..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeProblemModal()" class="flex-1 bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg transition-colors">Annuler</button>
                <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-colors">Signaler</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script src="{{ asset('js/recruiter-interviews.js') }}"></script>
@endsection
@endsection

