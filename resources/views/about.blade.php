@extends('layouts.app')

@section('title', 'À propos - OMPLEO')
@section('description', 'Découvrez OMPLEO, la plateforme de recrutement qui révolutionne la recherche d\'emploi et le recrutement en Algérie.')

@section('content')
<!-- Header -->
@include('components.header')

<!-- Hero Section -->
<section class="pt-20 pb-16 bg-gradient-to-br from-primary-50 via-white to-accent-50 dark:from-dark-900 dark:via-dark-800 dark:to-dark-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                À propos de 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-accent-600">
                    OMPLEO
                </span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                Nous révolutionnons le recrutement en connectant les talents aux opportunités. 
                Découvrez notre mission, nos valeurs et notre vision pour l'avenir du travail.
            </p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="py-20 bg-white dark:bg-dark-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Notre Mission
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
                    Chez OMPLEO, nous croyons que chaque talent mérite de trouver sa place idéale. 
                    Notre mission est de simplifier et d'humaniser le processus de recrutement en 
                    connectant les candidats aux entreprises qui partagent leurs valeurs.
                </p>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                    Nous utilisons la technologie pour créer des connexions authentiques, 
                    réduire les biais et permettre à chacun de révéler son potentiel.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-2">10,000+</div>
                        <div class="text-gray-600 dark:text-gray-400">Emplois disponibles</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-accent-600 dark:text-accent-400 mb-2">5,000+</div>
                        <div class="text-gray-600 dark:text-gray-400">Entreprises partenaires</div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="glass-card p-8 rounded-2xl">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset('images/about-mission.jpg') }}" alt="Notre mission" class="w-full h-64 object-cover rounded-xl">
                    </div>
                </div>
                <!-- Floating elements -->
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-primary-200/30 dark:bg-primary-500/20 rounded-full animate-float"></div>
                <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-accent-200/30 dark:bg-accent-500/20 rounded-full animate-bounce-gentle"></div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-gray-50 dark:bg-dark-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Nos Valeurs
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Ces valeurs guident chacune de nos décisions et façonnent notre culture d'entreprise
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Transparence</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous croyons en la transparence totale dans nos processus de recrutement et nos relations avec nos utilisateurs.
                </p>
            </div>

            <!-- Value 2 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-accent-100 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Diversité</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous célébrons la diversité et l'inclusion, créant un environnement où chacun peut s'épanouir.
                </p>
            </div>

            <!-- Value 3 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Innovation</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous repoussons constamment les limites pour améliorer l'expérience de recrutement.
                </p>
            </div>

            <!-- Value 4 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-accent-100 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Qualité</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous nous engageons à fournir des services de la plus haute qualité à nos utilisateurs.
                </p>
            </div>

            <!-- Value 5 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Équité</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous nous battons pour un recrutement équitable et sans discrimination.
                </p>
            </div>

            <!-- Value 6 -->
            <div class="glass-card p-8 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-accent-100 dark:bg-accent-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Empathie</h3>
                <p class="text-gray-600 dark:text-gray-400">
                    Nous comprenons les défis de la recherche d'emploi et du recrutement.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-white dark:bg-dark-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Notre Équipe
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Rencontrez les passionnés qui font d'OMPLEO une plateforme exceptionnelle
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="glass-card p-6 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                    AK
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Ahmed Khelil</h3>
                <p class="text-primary-600 dark:text-primary-400 mb-4">Fondateur & CEO</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Passionné par l'innovation et l'entrepreneuriat, Ahmed a créé OMPLEO pour révolutionner le recrutement en Algérie.
                </p>
            </div>

            <!-- Team Member 2 -->
            <div class="glass-card p-6 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-24 h-24 bg-gradient-to-br from-accent-400 to-accent-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                    SM
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Sarah Merabet</h3>
                <p class="text-primary-600 dark:text-primary-400 mb-4">CTO</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Experte en technologie, Sarah dirige notre équipe technique pour créer des solutions innovantes.
                </p>
            </div>

            <!-- Team Member 3 -->
            <div class="glass-card p-6 rounded-2xl text-center hover:shadow-xl transition-all duration-300 group">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-400 to-accent-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                    YB
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Yasmine Benali</h3>
                <p class="text-primary-600 dark:text-primary-400 mb-4">Head of Marketing</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Créative et stratégique, Yasmine développe notre présence sur le marché algérien.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 bg-gray-50 dark:bg-dark-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                    Notre Histoire
                </h2>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary-600 dark:text-primary-400 font-bold">2020</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Les débuts</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Fondation d'OMPLEO avec la vision de révolutionner le recrutement en Algérie.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent-600 dark:text-accent-400 font-bold">2021</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Première version</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Lancement de notre plateforme avec 100 entreprises partenaires et 1000 candidats.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-primary-600 dark:text-primary-400 font-bold">2023</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Expansion</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Plus de 5000 entreprises et 50000 candidats nous font confiance.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-accent-600 dark:text-accent-400 font-bold">2024</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Innovation continue</h3>
                            <p class="text-gray-600 dark:text-gray-400">
                                Lancement de nouvelles fonctionnalités d'IA et d'expansion régionale.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="glass-card p-8 rounded-2xl">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset('images/about-story.jpg') }}" alt="Notre histoire" class="w-full h-64 object-cover rounded-xl">
                    </div>
                </div>
                <!-- Floating elements -->
                <div class="absolute -top-4 -left-4 w-20 h-20 bg-primary-200/30 dark:bg-primary-500/20 rounded-full animate-float"></div>
                <div class="absolute -bottom-4 -right-4 w-28 h-28 bg-accent-200/30 dark:bg-accent-500/20 rounded-full animate-bounce-gentle"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary-600 to-accent-600">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Rejoignez l'aventure OMPLEO
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Que vous soyez candidat ou recruteur, découvrez comment OMPLEO peut transformer votre expérience professionnelle.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white text-primary-600 hover:bg-gray-100 font-semibold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105">
                Commencer maintenant
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-primary-600 font-semibold py-3 px-8 rounded-xl transition-all duration-300">
                Nous contacter
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
@include('components.footer')
@endsection

