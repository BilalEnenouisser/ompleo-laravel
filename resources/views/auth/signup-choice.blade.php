@extends('layouts.app')

@section('title', 'Choisir votre profil - OMPLEO')
@section('description', 'Choisissez votre profil pour commencer votre parcours professionnel sur OMPLEO.')

@section('content')
@include('components.header')

<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="liquid-shape w-96 h-96 bg-gradient-to-br from-primary-200/20 to-accent-200/20 dark:from-primary-800/10 dark:to-accent-800/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-gradient-to-br from-accent-200/20 to-primary-200/20 dark:from-accent-800/10 dark:to-primary-800/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
        <div class="liquid-shape w-64 h-64 bg-gradient-to-br from-primary-100/20 to-accent-100/20 dark:from-primary-900/10 dark:to-accent-900/10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" style="animation-delay: 4s;"></div>
    </div>
    
    <div class="max-w-4xl w-full space-y-8 relative z-10">
        <div class="text-center animate-fade-in-up">
            <div class="flex items-center justify-center space-x-3 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center p-2 shadow-glass-glow hover:scale-110 transition-transform duration-200">
                    <img 
                        src="{{ asset('icon.png') }}" 
                        alt="OMPLEO" 
                        class="w-full h-full object-contain filter brightness-0 invert"
                    />
                </div>
                <h1 class="text-3xl font-semibold gradient-text hover:scale-105 transition-transform duration-200">
                    OMPLEO
                </h1>
            </div>
            <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                Rejoignez OMPLEO
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Choisissez votre profil pour commencer votre parcours professionnel
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
            <!-- Candidat -->
            <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                <a href="{{ route('signup.candidate') }}" class="group liquid-glass-card p-8 block h-full hover:-translate-y-2 transition-all duration-300">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500 shadow-glass-glow">
                            <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 gradient-text">
                            Je suis candidat
                        </h3>
                        
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            Créez votre profil, postulez aux offres qui vous correspondent et boostez votre carrière
                        </p>
                        
                        <ul class="text-left space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-primary-500 dark:text-primary-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Accès à toutes les offres d'emploi</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-primary-500 dark:text-primary-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Profil professionnel valorisant</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-primary-500 dark:text-primary-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Profil mis en avant</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-primary-500 dark:text-primary-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Suivi des candidatures</span>
                            </li>
                        </ul>
                        
                        <div class="flex items-center justify-center gap-2 text-primary-600 dark:text-primary-400 font-medium group-hover:gap-4 transition-all duration-300">
                            <span>Créer mon compte candidat</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recruteur -->
            <div class="animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="{{ route('signup.recruiter') }}" class="group liquid-glass-card p-8 block h-full hover:-translate-y-2 transition-all duration-300">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-accent-500 to-accent-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-500 shadow-glass-glow">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h4"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 10h4"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14h4"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 18h4"></path>
                            </svg>
                        </div>
                        
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 gradient-text">
                            Je suis recruteur
                        </h3>
                        
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                            Publiez vos offres, trouvez les meilleurs talents et gérez vos recrutements efficacement
                        </p>
                        
                        <ul class="text-left space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-accent-500 dark:text-accent-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Essai gratuit 24h (1 offre)</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-accent-500 dark:text-accent-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Accès aux profils certifiés</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-accent-500 dark:text-accent-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Outils de gestion avancés</span>
                            </li>
                            <li class="flex items-center gap-3 text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-accent-500 dark:text-accent-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <path d="m9 11 3 3L22 4"/>
                                </svg>
                                <span>Support prioritaire</span>
                            </li>
                        </ul>
                        
                        <div class="flex items-center justify-center gap-2 text-accent-600 dark:text-accent-400 font-medium group-hover:gap-4 transition-all duration-300">
                            <span>Créer mon compte recruteur</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="text-center mt-8 animate-fade-in-up" style="animation-delay: 0.6s;">
            <p class="text-gray-600 dark:text-gray-400">
                Vous avez déjà un compte ?{' '}
                <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors duration-200">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>

@include('components.footer')
@endsection
