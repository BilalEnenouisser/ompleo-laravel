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
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Retour
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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

            {{-- Interview Type --}}
            <div class="space-y-2">
                <label for="type" class="block text-sm font-medium text-[#f5f5f5]">Type d'entretien *</label>
                <select id="type" name="type" 
                        class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('type') border-red-500 @enderror" required>
                    <option value="visioconference" {{ old('type', $interview->type) == 'visioconference' ? 'selected' : '' }}>Visioconférence</option>
                    <option value="presentiel" {{ old('type', $interview->type) == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                    <option value="telephonique" {{ old('type', $interview->type) == 'telephonique' ? 'selected' : '' }}>Téléphonique</option>
                </select>
                @error('type')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Location/Meeting Details --}}
            <div id="locationField" class="space-y-2" style="display: none;">
                <label for="location" class="block text-sm font-medium text-[#f5f5f5]">Lieu / Détails *</label>
                <input type="text" id="location" name="location" value="{{ old('location', $interview->location) }}" 
                       class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('location') border-red-500 @enderror">
                @error('location')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Meeting Link (for visioconference) --}}
            <div id="meetingLinkField" class="space-y-2" style="display: none;">
                <label for="meeting_link" class="block text-sm font-medium text-[#f5f5f5]">Lien de la réunion</label>
                <input type="url" id="meeting_link" name="meeting_link" value="{{ old('meeting_link', $interview->meeting_link) }}" 
                       class="w-full bg-[#333333] border border-[#444444] rounded-lg px-4 py-3 text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none @error('meeting_link') border-red-500 @enderror" 
                       placeholder="https://meet.google.com/xxx-xxxx-xxx">
                @error('meeting_link')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
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
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const locationField = document.getElementById('locationField');
    const locationInput = document.getElementById('location');
    const meetingLinkField = document.getElementById('meetingLinkField');
    const meetingLinkInput = document.getElementById('meeting_link');

    function updateFields() {
        const type = typeSelect.value;
        
        // Hide all fields first
        locationField.style.display = 'none';
        meetingLinkField.style.display = 'none';
        locationInput.required = false;
        meetingLinkInput.required = false;

        if (type === 'visioconference') {
            locationField.style.display = 'block';
            meetingLinkField.style.display = 'block';
            locationInput.placeholder = 'Google Meet, Zoom, Teams, etc.';
            locationInput.required = true;
        } else if (type === 'presentiel') {
            locationField.style.display = 'block';
            locationInput.placeholder = 'Bureau Chéraga';
            locationInput.required = true;
        } else if (type === 'telephonique') {
            locationField.style.display = 'block';
            locationInput.placeholder = 'Numéro de téléphone';
            locationInput.required = true;
        }
    }

    // Initialize fields on page load
    updateFields();

    // Update fields when type changes
    typeSelect.addEventListener('change', updateFields);
});
</script>
@endpush
@endsection
