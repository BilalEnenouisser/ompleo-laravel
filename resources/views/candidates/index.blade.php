@extends('layouts.app')

@section('title', 'Candidats - OMPLEO')
@section('description', 'Créez un profil candidat et trouvez votre emploi idéal sur OMPLEO')

@section('content')
<!-- Header -->
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
                <div class="text-center lg:text-left" data-animate="hero-text">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-6 leading-tight">
                        Créez un profil pour attirer les{' '}
                        <span class="text-[#00b6b4]">meilleurs recruteurs</span>
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
                        Rejoignez OMPLEO et donnez un nouvel élan à votre carrière. 
                        Notre plateforme vous connecte avec les meilleures opportunités.
                    </p>
                    <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95" data-animate="hero-button">
                        🔵 JE CRÉE MON COMPTE CANDIDAT
                    </button>
                </div>
                
                <div class="mt-12 lg:mt-0" data-animate="hero-image">
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
    <section class="py-20 bg-gray-50 dark:bg-[#2b2b2b]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-animate="benefits-title">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Pourquoi créer un compte candidat ?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                    Découvrez tous les avantages d'avoir un profil candidat sur OMPLEO
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($benefits as $index => $benefit)
                <div class="bg-white dark:bg-[#333333] rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group hover:scale-105" data-animate="benefit-card" data-delay="{{ $index * 0.1 }}">
                    <div class="{{ $benefit['bgColor'] }} {{ $benefit['color'] }} w-16 h-16 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-md">
                        @if($index === 0)
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @elseif($index === 1)
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        @elseif($index === 2)
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 00-15 0v5h5l-5 5-5-5h5v-5a7.5 7.5 0 0115 0v5z"></path>
                            </svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
            <div class="text-center mb-16" data-animate="steps-title">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Comment ça marche ?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">
                    Trois étapes simples pour commencer votre parcours professionnel
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($steps as $index => $step)
                <div class="text-center relative" data-animate="step-card" data-delay="{{ $index * 0.2 }}">
                    <div class="relative mb-8 group">
                        <div class="w-20 h-20 bg-[#00b6b4] text-white rounded-full flex items-center justify-center mx-auto shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            @if($index === 0)
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            @elseif($index === 1)
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            @else
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 00-15 0v5h5l-5 5-5-5h5v-5a7.5 7.5 0 0115 0v5z"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="absolute -top-2 -right-2 bg-white dark:bg-[#333333] border-2 border-[#00b6b4]/30 rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold text-[#00b6b4]">
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
                            <div class="absolute top-0 left-0 h-full bg-[#00b6b4] w-0 connection-line" data-animate="connection-line" data-delay="{{ $index * 0.2 + 0.5 }}"></div>
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
                <div data-animate="stat-card">
                    <div class="flex items-center justify-center mb-4" data-animate="stat-icon">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2" data-animate="stat-number">
                        98%
                    </div>
                    <div class="text-white/80">Taux de satisfaction</div>
                </div>
                
                <div data-animate="stat-card" data-delay="0.2">
                    <div class="flex items-center justify-center mb-4" data-animate="stat-icon">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2" data-animate="stat-number">
                        1187+
                    </div>
                    <div class="text-white/80">Offres disponibles</div>
                </div>
                
                <div data-animate="stat-card" data-delay="0.4">
                    <div class="flex items-center justify-center mb-4" data-animate="stat-icon">
                        <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold mb-2" data-animate="stat-number">
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
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6" data-animate="cta-title">
                Prêt à donner un nouveau souffle à votre carrière ?
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8" data-animate="cta-text">
                Rejoignez des milliers de candidats qui ont trouvé leur emploi idéal sur OMPLEO
            </p>
            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95" data-animate="cta-button">
                Créer mon compte maintenant
            </button>
        </div>
    </section>
</div>

<!-- Footer -->
@include('components.footer')

@push('styles')
<style>
[data-animate] {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-animate].animate-fade-in {
    opacity: 1;
    transform: translateY(0);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple scroll animations using Intersection Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush
@endsection