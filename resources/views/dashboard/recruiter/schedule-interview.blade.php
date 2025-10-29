@extends('layouts.dashboard')
@section('page-title', 'Programmer un entretien')

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                Programmer un entretien
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Planifiez un entretien avec un candidat
            </p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
            <a href="{{ route('recruiter.interviews') }}" class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                Annuler
            </a>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 lg:p-8 shadow-lg">
        <form method="POST" action="{{ route('recruiter.interviews.store') }}" class="space-y-4 sm:space-y-6">
            @csrf

            {{-- Application Selection --}}
            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">Sélectionner la candidature</h3>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <select name="application_id" id="application_id" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required>
                        <option value="">Sélectionner une candidature</option>
                        @foreach($applications as $application)
                            <option value="{{ $application->id }}" {{ $selectedApplication && $selectedApplication->id == $application->id ? 'selected' : '' }}>
                                {{ $application->candidate->name }} - {{ $application->job->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('application_id')
                        <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Interview Details --}}
            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">Détails de l'entretien</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 md:gap-6">
                    {{-- Date --}}
                    <div>
                        <label for="interview_date" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Date de l'entretien *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <input type="date" name="interview_date" id="interview_date" value="{{ old('interview_date') }}" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required>
                        </div>
                        @error('interview_date')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Time --}}
                    <div>
                        <label for="start_time" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Heure de début *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required>
                        </div>
                        @error('start_time')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Duration --}}
                    <div>
                        <label for="duration_minutes" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Durée (minutes) *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                            <select name="duration_minutes" id="duration_minutes" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required>
                                <option value="">Sélectionner la durée</option>
                                <option value="15" {{ old('duration_minutes') == '15' ? 'selected' : '' }}>15 minutes</option>
                                <option value="30" {{ old('duration_minutes') == '30' ? 'selected' : '' }}>30 minutes</option>
                                <option value="45" {{ old('duration_minutes') == '45' ? 'selected' : '' }}>45 minutes</option>
                                <option value="60" {{ old('duration_minutes') == '60' ? 'selected' : '' }}>60 minutes</option>
                                <option value="90" {{ old('duration_minutes') == '90' ? 'selected' : '' }}>90 minutes</option>
                                <option value="120" {{ old('duration_minutes') == '120' ? 'selected' : '' }}>120 minutes</option>
                            </select>
                        </div>
                        @error('duration_minutes')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Type --}}
                    <div>
                        <label for="type" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Type d'entretien *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <select name="type" id="type" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required onchange="toggleLocationFields()">
                                <option value="">Sélectionner le type</option>
                                <option value="visioconference" {{ old('type') == 'visioconference' ? 'selected' : '' }}>Visioconférence</option>
                                <option value="presentiel" {{ old('type') == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                                <option value="telephonique" {{ old('type') == 'telephonique' ? 'selected' : '' }}>Téléphonique</option>
                            </select>
                        </div>
                        @error('type')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Location/Platform Details --}}
            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">Détails de localisation</h3>
                
                {{-- Location Field (changes based on type) --}}
                <div id="location-field">
                    <label for="location" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        <span id="location-label">Lien de la réunion *</span>
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="https://meet.google.com/..." class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base" required>
                    </div>
                    @error('location')
                        <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Meeting Details (for visioconference) --}}
                <div id="meeting-details" class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 md:gap-6" style="display: none;">
                    <div>
                        <label for="meeting_id" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            ID de la réunion
                        </label>
                        <input type="text" name="meeting_id" id="meeting_id" value="{{ old('meeting_id') }}" placeholder="Ex: abc-defg-hij" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base">
                        @error('meeting_id')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meeting_password" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                            Mot de passe
                        </label>
                        <input type="text" name="meeting_password" id="meeting_password" value="{{ old('meeting_password') }}" placeholder="Mot de passe (optionnel)" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base">
                        @error('meeting_password')
                            <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="space-y-3 sm:space-y-4">
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">Notes</h3>
                <div>
                    <label for="notes" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Notes sur l'entretien
                    </label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Ajoutez des notes sur l'entretien, les sujets à aborder, etc." class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base resize-none">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-400 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-4 sm:pt-6 border-t border-[#333333]">
                <a href="{{ route('recruiter.interviews') }}" class="w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors text-center text-xs sm:text-sm md:text-base">
                    Annuler
                </a>
                <button type="submit" class="w-full sm:w-auto bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base">
                    <svg class="w-3 h-3 sm:w-4 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    <span class="hidden sm:inline">Programmer l'entretien</span>
                    <span class="sm:hidden">Programmer</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleLocationFields() {
    const type = document.getElementById('type').value;
    const locationField = document.getElementById('location');
    const locationLabel = document.getElementById('location-label');
    const meetingDetails = document.getElementById('meeting-details');
    const locationInput = document.getElementById('location');

    // Reset location field
    locationInput.value = '';
    locationInput.placeholder = '';

    if (type === 'visioconference') {
        locationLabel.textContent = 'Lien de la réunion *';
        locationInput.placeholder = 'https://meet.google.com/... ou https://zoom.us/j/...';
        meetingDetails.style.display = 'grid';
    } else if (type === 'presentiel') {
        locationLabel.textContent = 'Lieu de l\'entretien *';
        locationInput.placeholder = 'Bureau Chéraga';
        meetingDetails.style.display = 'none';
    } else if (type === 'telephonique') {
        locationLabel.textContent = 'Numéro de téléphone *';
        locationInput.placeholder = '+213 XXX XXX XXX';
        meetingDetails.style.display = 'none';
    } else {
        locationLabel.textContent = 'Localisation *';
        locationInput.placeholder = '';
        meetingDetails.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleLocationFields();
});
</script>
@endsection
