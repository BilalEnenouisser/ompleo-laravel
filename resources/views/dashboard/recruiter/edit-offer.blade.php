@extends('layouts.dashboard')

@section('title', 'Modifier l\'offre d\'emploi - OMPLEO')
@section('description', 'Modifiez votre offre d\'emploi.')
@section('page-title', 'Modifier l\'offre d\'emploi')

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
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Modifier l'offre d'emploi
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Modifiez les détails de votre offre d'emploi
            </p>
        </div>
    </div>

    {{-- Form --}}
    <form id="editOfferForm" action="{{ route('recruiter.jobs.update', $job) }}" method="POST" class="space-y-6 sm:space-y-8">
        @csrf
        @method('PUT')
        {{-- Basic Information --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                Informations de base
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="title" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Titre du poste *
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $job->title) }}"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        placeholder="Ex: Développeur Frontend React"
                    />
                </div>
                
                <div>
                    <label for="location" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Localisation *
                    </label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ old('location', $job->location) }}"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        placeholder="Ex: Alger, Algérie"
                    />
                </div>
            </div>
            
            <div class="mt-4 sm:mt-6">
                <label for="description" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                    Description du poste *
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base resize-none"
                    placeholder="Décrivez le poste, les responsabilités principales..."
                >{{ old('description', $job->description) }}</textarea>
            </div>
        </div>

        {{-- Job Details --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                Détails du poste
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label for="type" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Type de contrat *
                    </label>
                    <select 
                        id="type" 
                        name="type" 
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                    >
                        <option value="">Sélectionnez un type</option>
                        <option value="CDI" {{ old('type', $job->type) == 'CDI' ? 'selected' : '' }}>CDI</option>
                        <option value="CDD" {{ old('type', $job->type) == 'CDD' ? 'selected' : '' }}>CDD</option>
                        <option value="Freelance" {{ old('type', $job->type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="Stage" {{ old('type', $job->type) == 'Stage' ? 'selected' : '' }}>Stage</option>
                        <option value="Alternance" {{ old('type', $job->type) == 'Alternance' ? 'selected' : '' }}>Alternance</option>
                    </select>
                </div>
                
                <div>
                    <label for="workType" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Mode de travail *
                    </label>
                    <select 
                        id="workType" 
                        name="workType" 
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                    >
                        <option value="">Sélectionnez un mode</option>
                        <option value="onsite" {{ old('workType', $job->work_type) == 'onsite' ? 'selected' : '' }}>Sur site</option>
                        <option value="remote" {{ old('workType', $job->work_type) == 'remote' ? 'selected' : '' }}>Télétravail</option>
                        <option value="hybrid" {{ old('workType', $job->work_type) == 'hybrid' ? 'selected' : '' }}>Hybride</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mt-4 sm:mt-6">
                <div>
                    <label for="salary_min" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Salaire minimum (DA) *
                    </label>
                    <input 
                        type="number" 
                        id="salary_min" 
                        name="salary_min" 
                        value="{{ old('salary_min', $job->salary_min) }}"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        placeholder="Ex: 50000"
                    />
                </div>
                
                <div>
                    <label for="salary_max" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Salaire maximum (DA) *
                    </label>
                    <input 
                        type="number" 
                        id="salary_max" 
                        name="salary_max" 
                        value="{{ old('salary_max', $job->salary_max) }}"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        placeholder="Ex: 80000"
                    />
                </div>
            </div>
            
            <div class="mt-4 sm:mt-6">
                <label for="expiryDate" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                    Date limite de candidature *
                </label>
                <input 
                    type="date" 
                    id="expiryDate" 
                    name="expiryDate" 
                    value="{{ old('expiryDate', $job->application_deadline ? \Carbon\Carbon::parse($job->application_deadline)->format('Y-m-d') : '') }}"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                />
            </div>
        </div>

        {{-- Requirements --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                Exigences
            </h2>
            
            <div id="requirementsContainer">
                @if($job->requirements && count($job->requirements) > 0)
                    @foreach($job->requirements as $index => $requirement)
                    <div class="requirement-item flex items-center gap-2 mb-3">
                        <input 
                            type="text" 
                            name="requirements[]" 
                            value="{{ $requirement }}"
                            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                            placeholder="Ex: 3 ans d'expérience en React"
                        />
                        <button type="button" onclick="removeRequirement(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <button type="button" onclick="addRequirement()" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Ajouter une exigence
            </button>
        </div>

        {{-- Benefits --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                Avantages
            </h2>
            
            <div id="benefitsContainer">
                @if($job->benefits && count($job->benefits) > 0)
                    @foreach($job->benefits as $index => $benefit)
                    <div class="benefit-item flex items-center gap-2 mb-3">
                        <input 
                            type="text" 
                            name="benefits[]" 
                            value="{{ $benefit }}"
                            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                            placeholder="Ex: Assurance santé"
                        />
                        <button type="button" onclick="removeBenefit(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <button type="button" onclick="addBenefit()" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Ajouter un avantage
            </button>
        </div>

        {{-- Skills --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
                Compétences requises
            </h2>
            
            <div id="skillsContainer">
                @if($job->tags && count($job->tags) > 0)
                    @foreach($job->tags as $index => $skill)
                    <div class="skill-item flex items-center gap-2 mb-3">
                        <input 
                            type="text" 
                            name="skills[]" 
                            value="{{ $skill }}"
                            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                            placeholder="Ex: React, JavaScript, HTML/CSS"
                        />
                        <button type="button" onclick="removeSkill(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @endif
            </div>
            
            <button type="button" onclick="addSkill()" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                Ajouter une compétence
            </button>
        </div>

        {{-- Featured Option --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center gap-3">
                <input 
                    type="checkbox" 
                    id="featured" 
                    name="featured" 
                    value="1"
                    {{ old('featured', $job->is_featured) ? 'checked' : '' }}
                    class="w-4 h-4 text-[#00b6b4] bg-[#333333] border-[#444444] rounded focus:ring-[#00b6b4] focus:ring-2"
                />
                <label for="featured" class="text-sm sm:text-base text-[#f5f5f5]">
                    Mettre en vedette cette offre (recommandé)
                </label>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3 sm:gap-4 mt-6 sm:mt-8">
            <a href="{{ route('recruiter.jobs') }}" class="px-4 sm:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] hover:text-[#f5f5f5] transition-colors duration-200 text-sm sm:text-base">
                Annuler
            </a>
            
            <button
                type="submit"
                name="save_draft"
                value="1"
                class="px-3 sm:px-4 py-2 sm:py-2.5 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] hover:text-[#f5f5f5] transition-colors duration-200 flex items-center gap-1 sm:gap-2 text-sm sm:text-base"
            >
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17,21 17,13 7,13 7,21"/>
                    <polyline points="7,3 7,8 15,8"/>
                </svg>
                Enregistrer brouillon
            </button>
            
            <button
                type="submit"
                class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-1 sm:gap-2 text-sm sm:text-base"
            >
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17,21 17,13 7,13 7,21"/>
                    <polyline points="7,3 7,8 15,8"/>
                </svg>
                Mettre à jour l'offre
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show notifications
    const successNotification = document.getElementById('successNotification');
    const errorNotification = document.getElementById('errorNotification');
    
    if (successNotification) {
        setTimeout(() => {
            successNotification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            successNotification.style.transform = 'translateX(100%)';
        }, 3000);
    }
    
    if (errorNotification) {
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(100%)';
        }, 5000);
    }
});

function addRequirement() {
    const container = document.getElementById('requirementsContainer');
    const div = document.createElement('div');
    div.className = 'requirement-item flex items-center gap-2 mb-3';
    div.innerHTML = `
        <input 
            type="text" 
            name="requirements[]" 
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Ex: 3 ans d'expérience en React"
        />
        <button type="button" onclick="removeRequirement(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 6h18"/>
                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeRequirement(button) {
    button.closest('.requirement-item').remove();
}

function addBenefit() {
    const container = document.getElementById('benefitsContainer');
    const div = document.createElement('div');
    div.className = 'benefit-item flex items-center gap-2 mb-3';
    div.innerHTML = `
        <input 
            type="text" 
            name="benefits[]" 
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Ex: Assurance santé"
        />
        <button type="button" onclick="removeBenefit(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 6h18"/>
                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeBenefit(button) {
    button.closest('.benefit-item').remove();
}

function addSkill() {
    const container = document.getElementById('skillsContainer');
    const div = document.createElement('div');
    div.className = 'skill-item flex items-center gap-2 mb-3';
    div.innerHTML = `
        <input 
            type="text" 
            name="skills[]" 
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
            placeholder="Ex: React, JavaScript, HTML/CSS"
        />
        <button type="button" onclick="removeSkill(this)" class="p-2 text-red-400 hover:text-red-300 transition-colors">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 6h18"/>
                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
            </svg>
        </button>
    `;
    container.appendChild(div);
}

function removeSkill(button) {
    button.closest('.skill-item').remove();
}
</script>
@endsection
