@extends('layouts.dashboard')
@section('page-title', 'Modifier Entretien')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <h1 class="text-3xl font-bold text-[#f5f5f5] mb-2">Modifier l'Entretien</h1>
            <p class="text-[#9ca3af]">Modifiez les détails de l'entretien avec {{ $interview->candidate->name }}</p>
        </div>
        <a href="{{ route('recruiter.interviews') }}" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-6 py-3 rounded-lg transition-colors inline-flex items-center gap-2">
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

    {{-- Form --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <form method="POST" action="{{ route('recruiter.interviews.update', $interview) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Interview Information --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Candidate Info (Read-only) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#f5f5f5]">Candidat</label>
                    <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 text-[#9ca3af]">
                        {{ $interview->candidate->name }}
                    </div>
                </div>

                {{-- Job Info (Read-only) --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-[#f5f5f5]">Poste</label>
                    <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 text-[#9ca3af]">
                        {{ $interview->job->title }}
                    </div>
                </div>
            </div>

            {{-- Date and Time --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Interview Date --}}
                <div class="space-y-2">
                    <label for="interview_date" class="block text-sm font-medium text-[#f5f5f5]">Date de l'entretien *</label>
                    <input type="date" id="interview_date" name="interview_date" value="{{ old('interview_date', $interview->formatted_date) }}" 
                           class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('interview_date') border-red-500 @enderror" required>
                    @error('interview_date')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Start Time --}}
                <div class="space-y-2">
                    <label for="start_time" class="block text-sm font-medium text-[#f5f5f5]">Heure de début *</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time', $interview->formatted_start_time) }}" 
                           class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('start_time') border-red-500 @enderror" required>
                    @error('start_time')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Duration --}}
                <div class="space-y-2">
                    <label for="duration_minutes" class="block text-sm font-medium text-[#f5f5f5]">Durée (minutes) *</label>
                    <select id="duration_minutes" name="duration_minutes" 
                            class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('duration_minutes') border-red-500 @enderror" required>
                        <option value="15" {{ old('duration_minutes', $interview->duration_minutes) == 15 ? 'selected' : '' }}>15 minutes</option>
                        <option value="30" {{ old('duration_minutes', $interview->duration_minutes) == 30 ? 'selected' : '' }}>30 minutes</option>
                        <option value="45" {{ old('duration_minutes', $interview->duration_minutes) == 45 ? 'selected' : '' }}>45 minutes</option>
                        <option value="60" {{ old('duration_minutes', $interview->duration_minutes) == 60 ? 'selected' : '' }}>1 heure</option>
                        <option value="90" {{ old('duration_minutes', $interview->duration_minutes) == 90 ? 'selected' : '' }}>1h30</option>
                        <option value="120" {{ old('duration_minutes', $interview->duration_minutes) == 120 ? 'selected' : '' }}>2 heures</option>
                    </select>
                    @error('duration_minutes')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Location/Platform Details Section --}}
            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">Détails de localisation</h3>
                
                {{-- Interview Type --}}
                <div class="space-y-2">
                    <label for="type" class="block text-sm font-medium text-[#f5f5f5]">Type d'entretien *</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <select id="type" name="type"
                                class="w-full pl-10 pr-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] @error('type') border-red-500 @enderror" required>
                            <option value="">Sélectionner le type</option>
                            <option value="visioconference" {{ old('type', $interview->type) == 'visioconference' ? 'selected' : '' }}>Visioconférence</option>
                            <option value="presentiel" {{ old('type', $interview->type) == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                            <option value="telephonique" {{ old('type', $interview->type) == 'telephonique' ? 'selected' : '' }}>Téléphonique</option>
                        </select>
                    </div>
                    @error('type')
                        <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Location Field (changes based on type) --}}
                <div id="location-field">
                    <label for="location" class="block text-sm font-medium text-[#9ca3af] mb-2">
                        <span id="location-label">
                            @if(old('type', $interview->type) == 'visioconference')
                                Lien de la réunion *
                            @elseif(old('type', $interview->type) == 'presentiel')
                                Lieu de l'entretien *
                            @elseif(old('type', $interview->type) == 'telephonique')
                                Numéro de téléphone *
                            @else
                                Localisation *
                            @endif
                        </span>
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        @php $currentType = old('type', $interview->type); $placeholder = ''; if ($currentType == 'visioconference') { $placeholder = 'https://meet.google.com/... ou https://zoom.us/j/...'; } elseif ($currentType == 'presentiel') { $placeholder = 'Bureau Chéraga'; } elseif ($currentType == 'telephonique') { $placeholder = '+213 XXX XXX XXX'; } @endphp
                        <input type="text" id="location" name="location" value="{{ old('location', $interview->location) }}" 
                               placeholder="{{ $placeholder }}"
                               class="w-full pl-10 pr-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] @error('location') border-red-500 @enderror" required>
                    </div>
                    @error('location')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meeting Details (for visioconference) --}}
                <div id="meeting-details" class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6" style="{{ old('type', $interview->type) == 'visioconference' ? '' : 'display: none;' }}">
                    <div>
                        <label for="meeting_id" class="block text-sm font-medium text-[#9ca3af] mb-2">
                            ID de la réunion
                        </label>
                        <input type="text" id="meeting_id" name="meeting_id" value="{{ old('meeting_id', $interview->meeting_id) }}" placeholder="Ex: abc-defg-hij" 
                               class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                        @error('meeting_id')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meeting_password" class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Mot de passe
                        </label>
                        <input type="text" id="meeting_password" name="meeting_password" value="{{ old('meeting_password', $interview->meeting_password) }}" placeholder="Mot de passe (optionnel)" 
                               class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                        @error('meeting_password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="space-y-2">
                <label for="notes" class="block text-sm font-medium text-[#f5f5f5]">Notes</label>
                <textarea id="notes" name="notes" rows="4" 
                          class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('notes') border-red-500 @enderror" 
                          placeholder="Ajoutez des notes ou des instructions pour l'entretien...">{{ old('notes', $interview->notes) }}</textarea>
                @error('notes')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('recruiter.interviews') }}" class="px-6 py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors">
                    Annuler
                </a>
                <button type="submit" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors">
                    Mettre à jour l'entretien
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function toggleLocationFields() {
    const type = document.getElementById('type').value;
    const locationInput = document.getElementById('location');
    const locationLabel = document.getElementById('location-label');
    const meetingDetails = document.getElementById('meeting-details');

    // Always show location field
    const locationField = document.getElementById('location-field');
    locationField.style.display = 'block';

    // Hide meeting details first, then show if needed
    if (meetingDetails) {
        meetingDetails.style.display = 'none';
    }

    if (type === 'visioconference') {
        locationLabel.textContent = 'Lien de la réunion *';
        locationInput.placeholder = 'https://meet.google.com/... ou https://zoom.us/j/...';
        if (meetingDetails) {
            meetingDetails.style.display = 'grid';
        }
        locationInput.required = true;
    } else if (type === 'presentiel') {
        locationLabel.textContent = 'Lieu de l\'entretien *';
        locationInput.placeholder = 'Bureau Chéraga';
        if (meetingDetails) {
            meetingDetails.style.display = 'none';
        }
        locationInput.required = true;
    } else if (type === 'telephonique') {
        locationLabel.textContent = 'Numéro de téléphone *';
        locationInput.placeholder = '+213 XXX XXX XXX';
        if (meetingDetails) {
            meetingDetails.style.display = 'none';
        }
        locationInput.required = true;
    } else {
        locationLabel.textContent = 'Localisation *';
        locationInput.placeholder = '';
        if (meetingDetails) {
            meetingDetails.style.display = 'none';
        }
        locationInput.required = false;
    }
}

// Initialize on page load and when type changes
document.addEventListener('DOMContentLoaded', function() {
    // Set up event listener for type changes
    const typeSelect = document.getElementById('type');
    if (typeSelect) {
        typeSelect.addEventListener('change', toggleLocationFields);
        // Initialize with current value
        toggleLocationFields();
    }
});
</script>
@endpush
@endsection
