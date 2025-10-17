@extends('layouts.app')

@section('content')
@include('components.header')

@php
$benefits = [
    [
        'title' => 'Profil Valorisé',
        'description' => 'Créez un profil professionnel qui met en valeur vos compétences et votre expérience.',
        'color' => 'text-[#00b6b4]',
        'bgColor' => 'bg-[#00b6b4]/10',
    ],
    [
        'title' => 'Accès Prioritaire',
        'description' => 'Soyez les premiers informés des nouvelles opportunités correspondant à votre profil.',
        'color' => 'text-[#00b6b4]',
        'bgColor' => 'bg-[#00b6b4]/10',
    ],
    [
        'title' => 'Alertes Personnalisées',
        'description' => 'Recevez des notifications pour les offres qui correspondent à vos critères.',
        'color' => 'text-[#00b6b4]',
        'bgColor' => 'bg-[#00b6b4]/10',
    ],
    [
        'title' => 'Suivi Candidatures',
        'description' => 'Suivez l\'état de vos candidatures en temps réel et ne ratez aucune opportunité.',
        'color' => 'text-[#00b6b4]',
        'bgColor' => 'bg-[#00b6b4]/10',
    ],
];

$steps = [
    [
        'number' => '01',
        'title' => 'Création Rapide',
        'description' => 'Inscrivez-vous en quelques minutes et créez votre profil professionnel.',
    ],
    [
        'number' => '02',
        'title' => 'Candidature 1-Clic',
        'description' => 'Postulez aux offres qui vous intéressent d\'un simple clic.',
    ],
    [
        'number' => '03',
        'title' => 'Suivi & Alertes',
        'description' => 'Recevez des alertes personnalisées et suivez vos candidatures.',
    ],
];
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="liquid-shape w-96 h-96 bg-[#00b6b4]/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-[#00b6b4]/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-[#00b6b4]/5 to-[#00b6b4]/10 dark:from-[#00b6b4]/10 dark:to-[#00b6b4]/5 py-20 relative">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                <div class="text-center lg:text-left animate-fade-in-left" data-animate="hero-text">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-6 leading-tight">
                        Créez un profil pour attirer les
                        <span class="text-[#00b6b4]">meilleurs recruteurs</span>
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                        Rejoignez OMPLEO et donnez un nouvel élan à votre carrière. 
                        Notre plateforme vous connecte avec les meilleures opportunités.
                    </p>
                    <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                        🔵 JE CRÉE MON COMPTE CANDIDAT
                    </button>
                </div>
                
                <div class="mt-12 lg:mt-0 animate-fade-in-right" data-animate="hero-image" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <img
                            src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="Professional candidate"
                            class="w-full h-96 object-cover rounded-2xl shadow-2xl border border-[#00b6b4]/10"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#00b6b4]/20 to-transparent rounded-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Create Account Section -->
    <section class="py-20 bg-gray-50 dark:bg-[#2b2b2b] animate-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up" data-animate="benefits-title">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Pourquoi créer un compte candidat ?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Découvrez tous les avantages d'avoir un profil candidat sur OMPLEO
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($benefits as $index => $benefit)
                <div class="bg-white dark:bg-[#333333] rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105 animate-stagger-fade-in" data-animate="benefit-card" data-delay="{{ $index * 0.1 }}" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="{{ $benefit['bgColor'] }} {{ $benefit['color'] }} w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                        @if($index === 0)
                        <!-- User Icon -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        @elseif($index === 1)
                        <!-- Search Icon -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        @elseif($index === 2)
                        <!-- Bell Icon -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        @elseif($index === 3)
                        <!-- CheckCircle Icon -->
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22,4 12,14.01 9,11.01"></polyline>
                        </svg>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $benefit['title'] }}
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ $benefit['description'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section class="py-20 bg-white dark:bg-[#1f1f1f]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up" data-animate="steps-title">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Comment ça marche ?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Trois étapes simples pour commencer votre parcours professionnel
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 ">
                @foreach($steps as $index => $step)
                <div class="text-center relative animate-stagger-fade-in " data-animate="step-card" data-delay="{{ $index * 0.2 }}" style="animation-delay: {{ $index * 0.2 }}s;">
                    <div class="relative mb-8 group step-icon-hover">
                        <div class="w-20 h-20 bg-[#00b6b4] text-white rounded-full flex items-center justify-center mx-auto shadow-lg ">
                            @if($index === 0)
                            <!-- User Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            @elseif($index === 1)
                            <!-- Search Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            @elseif($index === 2)
                            <!-- Bell Icon -->
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg>
                            @endif
                        </div>
                        <div class="absolute -top-2 -right-2 bg-white dark:bg-[#333333] border-2 border-[#00b6b4]/30 rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold text-[#00b6b4] ">
                            {{ $step['number'] }}
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $step['title'] }}
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        {{ $step['description'] }}
                    </p>

                    <!-- Connection Line -->
                    @if($index < count($steps) - 1)
                    <div class="hidden md:block absolute top-10 left-1/2 transform translate-x-1/2 w-full h-0.5 bg-gray-300 dark:bg-gray-700 -z-10">
                        <div class="absolute top-0 left-0 h-full bg-[#00b6b4] connection-line" data-delay="{{ $index * 0.5 + 0.5 }}"></div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-[#00b6b4] text-white relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="liquid-shape w-96 h-96 bg-white/10 top-20 -left-20"></div>
            <div class="liquid-shape w-80 h-80 bg-white/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="animate-fade-in-up" data-animate="stat-1">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"></polyline>
                            <polyline points="16,7 22,7 22,13"></polyline>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter">
                        98%
                    </div>
                    <div class="text-white/80">Taux de satisfaction</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-2" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle" style="animation-delay: 0.5s;">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter" style="animation-delay: 0.4s;">
                        1187+
                    </div>
                    <div class="text-white/80">Offres disponibles</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-3" style="animation-delay: 0.4s;">
                    <div class="flex items-center justify-center mb-4 animate-bounce-gentle" style="animation-delay: 1s;">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22,4 12,14.01 9,11.01"></polyline>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2 animate-counter" style="animation-delay: 0.6s;">
                        24h
                    </div>
                    <div class="text-white/80">Temps de réponse moyen</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50 dark:bg-[#2b2b2b]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6 animate-fade-in-up" data-animate="cta-title">
                Prêt à donner un nouveau souffle à votre carrière ?
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 animate-fade-in-up" data-animate="cta-subtitle" style="animation-delay: 0.2s;">
                Rejoignez des milliers de candidats qui ont trouvé leur emploi idéal sur OMPLEO
            </p>
            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 animate-fade-in-up" data-animate="cta-button" style="animation-delay: 0.4s;">
                Créer mon compte maintenant
            </button>
        </div>
    </section>
</div>

@include('components.footer')
@endsection
