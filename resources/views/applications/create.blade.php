@extends('layouts.app')

@section('title', 'Postuler à ' . $job->title . ' | OMPLEO')
@section('description', 'Postulez à l\'offre d\'emploi : ' . $job->title . ' chez ' . $job->company->name)

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-gray-50 dark:bg-[#1f1f1f] pt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <button
                onclick="history.back()"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2b2b2b] transition-colors"
            >
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="flex-1">
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                    <span>Offres d'emploi</span>
                    <span>/</span>
                    <span>{{ $job->company->name }}</span>
                    <span>/</span>
                    <span>Postuler</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Postuler à {{ $job->title }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Job Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Résumé de l'offre
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Entreprise</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $job->company->name }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Localisation</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $job->location }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Salaire</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    @if($job->salary_min && $job->salary_max)
                                        {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                                    @else
                                        Non spécifié
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Type de contrat</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $job->type }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Formulaire de candidature
                    </h2>

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <p class="text-red-600 dark:text-red-400">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="job_id" value="{{ $job->id }}">

                        <!-- Cover Letter -->
                        <div>
                            <label for="cover_letter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Lettre de motivation *
                            </label>
                            <textarea
                                id="cover_letter"
                                name="cover_letter"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#333333] text-gray-900 dark:text-gray-100"
                                placeholder="Expliquez pourquoi vous êtes le candidat idéal pour ce poste..."
                                required
                            >{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resume Upload -->
                        <div>
                            <label for="resume" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                CV (PDF, DOC, DOCX) *
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="resume" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Cliquez pour télécharger</span> votre CV
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOC, DOCX (MAX. 2MB)</p>
                                    </div>
                                    <input id="resume" name="resume" type="file" class="hidden" accept=".pdf,.doc,.docx" required />
                                </label>
                            </div>
                            @error('resume')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <div>
                            <label for="additional_info" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Informations complémentaires
                            </label>
                            <textarea
                                id="additional_info"
                                name="additional_info"
                                rows="4"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#333333] text-gray-900 dark:text-gray-100"
                                placeholder="Toute information supplémentaire que vous souhaitez partager..."
                            >{{ old('additional_info') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4">
                            <button
                                type="button"
                                onclick="history.back()"
                                class="flex-1 px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                            >
                                Annuler
                            </button>
                            <button
                                type="submit"
                                class="flex-1 bg-[#00b6b4] hover:bg-[#009e9c] text-white py-3 px-6 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                                </svg>
                                Envoyer ma candidature
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
