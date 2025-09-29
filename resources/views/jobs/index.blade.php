@extends('layouts.app')

@section('title', 'Emplois - OMPLEO')
@section('description', 'Découvrez toutes les offres d\'emploi disponibles sur OMPLEO')

@section('content')
<!-- Header -->
@include('components.header')
@php
$jobs = [
    [
        'id' => 1,
        'title' => 'Développeur Frontend React',
        'company' => 'IMPACTOME',
        'location' => 'Chéraga, Alger',
        'type' => 'CDI',
        'workType' => 'remote',
        'salary' => '80,000 - 120,000 DA',
        'experience' => '2-5 ans',
        'postedDate' => '2024-01-15',
        'description' => 'Nous recherchons un développeur Frontend passionné pour rejoindre notre équipe dynamique.',
        'skills' => ['React', 'TypeScript', 'Tailwind CSS', 'Next.js'],
        'featured' => true,
    ],
    [
        'id' => 2,
        'title' => 'Community Manager',
        'company' => 'CONDOR',
        'location' => 'El Harrach, Alger',
        'type' => 'CDI',
        'workType' => 'onsite',
        'salary' => '60,000 - 80,000 DA',
        'experience' => '1-3 ans',
        'postedDate' => '2024-01-14',
        'description' => 'Gérez notre présence sur les réseaux sociaux et développez notre communauté.',
        'skills' => ['Social Media', 'Content Creation', 'Analytics', 'Photoshop'],
        'featured' => false,
    ],
    [
        'id' => 3,
        'title' => 'Ingénieur DevOps',
        'company' => 'SONATRACH',
        'location' => 'El Mouradia, Alger',
        'type' => 'CDI',
        'workType' => 'hybrid',
        'salary' => '150,000 - 200,000 DA',
        'experience' => '3-7 ans',
        'postedDate' => '2024-01-13',
        'description' => 'Automatisez et optimisez nos infrastructures cloud et nos processus de déploiement.',
        'skills' => ['Docker', 'Kubernetes', 'AWS', 'Jenkins', 'Terraform'],
        'featured' => true,
    ],
    [
        'id' => 4,
        'title' => 'Designer UX/UI',
        'company' => 'OMPLEO',
        'location' => 'Chéraga, Alger',
        'type' => 'CDI',
        'workType' => 'remote',
        'salary' => '70,000 - 100,000 DA',
        'experience' => '2-4 ans',
        'postedDate' => '2024-01-12',
        'description' => 'Créez des expériences utilisateur exceptionnelles pour notre plateforme.',
        'skills' => ['Figma', 'Adobe XD', 'Prototyping', 'User Research'],
        'featured' => false,
    ],
];

function getWorkTypeLabel($type) {
    switch ($type) {
        case 'remote': return 'Télétravail';
        case 'onsite': return 'Présentiel';
        case 'hybrid': return 'Hybride';
        default: return $type;
    }
}

function getWorkTypeIcon($type) {
    switch ($type) {
        case 'remote': return '🏠';
        case 'onsite': return '🏢';
        case 'hybrid': return '🔄';
        default: return '💼';
    }
}
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="liquid-shape w-96 h-96 bg-[#00b6b4]/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-[#00b6b4]/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-16 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                Trouvez votre emploi idéal
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Plus de 1187 offres d'emploi vous attendent
            </p>
        </div>
    </section>

    <!-- Search and Filters -->
    <section class="py-8 relative z-20 -mt-8 bg-white dark:bg-[#1f1f1f]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-[#333333]">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="lg:col-span-2 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            placeholder="Poste, entreprise, compétences..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <select class="w-full pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Toutes les villes</option>
                            <option value="Alger">Alger</option>
                            <option value="Chéraga">Chéraga</option>
                            <option value="El Harrach">El Harrach</option>
                            <option value="El Mouradia">El Mouradia</option>
                        </select>
                    </div>
                    
                    <div class="relative">
                        <select class="w-full px-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Type de travail</option>
                            <option value="remote">Télétravail</option>
                            <option value="onsite">Présentiel</option>
                            <option value="hybrid">Hybride</option>
                        </select>
                    </div>
                    
                    <div class="relative">
                        <select class="w-full px-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Expérience</option>
                            <option value="0-1">0-1 an</option>
                            <option value="1-3">1-3 ans</option>
                            <option value="2-5">2-5 ans</option>
                            <option value="3-7">3-7 ans</option>
                            <option value="5+">5+ ans</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jobs List -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-[#111111] dark:text-[#f5f5f5]">
                    {{ count($jobs) }} offres trouvées
                </h2>
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 border border-gray-200 dark:border-[#333333] rounded-lg bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                        <option>Plus récentes</option>
                        <option>Salaire croissant</option>
                        <option>Salaire décroissant</option>
                        <option>Pertinence</option>
                    </select>
                </div>
            </div>

            <div class="space-y-6">
                @foreach($jobs as $job)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border {{ $job['featured'] ? 'border-[#00b6b4]/20 dark:border-[#00b6b4]/30 ring-2 ring-[#00b6b4]/10 dark:ring-[#00b6b4]/20' : 'border-gray-100 dark:border-[#333333]' }} hover:-translate-y-1">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-[#00b6b4] rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                    {{ substr($job['company'], 0, 1) }}
                                </div>
                                
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-xl font-bold text-[#111111] dark:text-[#f5f5f5] hover:text-[#00b6b4] cursor-pointer">
                                            {{ $job['title'] }}
                                        </h3>
                                        @if($job['featured'])
                                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                            Vedette
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-4 text-[#111111] dark:text-[#cccccc] mb-3">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                            <span class="font-medium text-[#111111] dark:text-[#f5f5f5]">{{ $job['company'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $job['location'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="text-[#00b6b4]">{{ getWorkTypeIcon($job['workType']) }}</span>
                                            <span>{{ getWorkTypeLabel($job['workType']) }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $job['experience'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <p class="text-[#111111] dark:text-[#cccccc] mb-4 line-clamp-2">
                                        {{ $job['description'] }}
                                    </p>
                                    
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($job['skills'] as $skill)
                                        <span class="px-3 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-sm font-medium">
                                            {{ $skill }}
                                        </span>
                                        @endforeach
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="text-lg font-bold text-[#111111] dark:text-[#f5f5f5]">
                                            {{ $job['salary'] }}
                                        </div>
                                        <div class="text-sm text-[#111111] dark:text-[#cccccc]">
                                            Publié il y a 2 jours
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                            <button class="p-2 text-gray-400 hover:text-red-500 transition-colors duration-200 hover:scale-110">
                                <svg class="w-5 h-5 text-[#111111] dark:text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white font-medium py-3 px-6 rounded-xl transition-all duration-300 whitespace-nowrap hover:scale-105">
                                Postuler
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load More -->
            <div class="text-center mt-12">
                <button class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] text-[#111111] dark:text-[#f5f5f5] hover:bg-gray-100 dark:hover:bg-[#333333] font-medium py-3 px-8 rounded-xl transition-all duration-300 hover:scale-105">
                    Charger plus d'offres
                </button>
            </div>
        </div>
    </section>
</div>

<!-- Footer -->
@include('components.footer')
@endsection