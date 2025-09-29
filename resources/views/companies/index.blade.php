@extends('layouts.app')

@section('title', 'Entreprises - OMPLEO')
@section('description', 'Découvrez toutes les entreprises partenaires sur OMPLEO')

@section('content')
<!-- Header -->
@include('components.header')

@php
$companies = [
    [
        'id' => 1,
        'name' => 'IMPACTOME Agency',
        'description' => 'Agence Marketing Digital qui accompagne les entreprises du monde entier.',
        'logo' => 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=100',
        'location' => 'Chéraga, Alger',
        'size' => '11-50 employés',
        'sector' => 'Marketing Digital',
        'jobCount' => 5,
        'founded' => '2022',
    ],
    [
        'id' => 2,
        'name' => 'CONDOR Electronics',
        'description' => 'Leader algérien dans l\'industrie électronique et électroménager.',
        'logo' => 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=100',
        'location' => 'El Harrach, Alger',
        'size' => '500+ employés',
        'sector' => 'Industrie',
        'jobCount' => 4,
        'founded' => '1978',
    ],
    [
        'id' => 3,
        'name' => 'SONATRACH',
        'description' => 'Compagnie nationale des hydrocarbures, leader énergétique en Afrique.',
        'logo' => 'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=100',
        'location' => 'El Mouradia, Alger',
        'size' => '10000+ employés',
        'sector' => 'Énergie',
        'jobCount' => 10,
        'founded' => '1963',
    ],
    [
        'id' => 4,
        'name' => 'OMPLEO Platform',
        'description' => 'Plateforme de recrutement innovante connectant talents et entreprises.',
        'logo' => 'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=100',
        'location' => 'Chéraga, Alger',
        'size' => '11-50 employés',
        'sector' => 'Tech',
        'jobCount' => 5,
        'founded' => '2024',
    ],
];
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f]">
    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="liquid-shape w-96 h-96 bg-white/10 top-20 -left-20"></div>
            <div class="liquid-shape w-80 h-80 bg-white/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6 text-shadow">
                Entreprises
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Explorez notre réseau d'entreprises partenaires et découvrez votre prochain employeur
            </p>
        </div>
    </section>

    <!-- Search and Filters -->
    <section class="py-8 bg-white dark:bg-[#2b2b2b] shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-[#333333]">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            placeholder="Rechercher une entreprise..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <select class="pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5] min-w-[150px]">
                                <option value="">Toutes les villes</option>
                                <option value="Alger">Alger</option>
                                <option value="Chéraga">Chéraga</option>
                                <option value="El Harrach">El Harrach</option>
                            </select>
                        </div>
                        
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <select class="pl-10 pr-8 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-gray-900 dark:text-[#f5f5f5] min-w-[150px]">
                                <option value="">Toutes tailles</option>
                                <option value="11-50">11-50 employés</option>
                                <option value="500+">500+ employés</option>
                                <option value="10000+">10000+ employés</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Companies Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($companies as $company)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 group hover:transform hover:scale-105 border border-gray-100 dark:border-[#333333] hover:-translate-y-2">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0">
                            <img
                                src="{{ $company['logo'] }}"
                                alt="{{ $company['name'] }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <span class="bg-[#00b6b4]/10 border border-[#00b6b4]/30 text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium">
                            {{ $company['sector'] }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 group-hover:text-[#00b6b4] transition-colors duration-200">
                        {{ $company['name'] }}
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                        {{ $company['description'] }}
                    </p>
                    
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $company['location'] }}</span>
                        </div>
                        
                        <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>{{ $company['size'] }}</span>
                        </div>
                        
                        <div class="flex items-center text-[#00b6b4] text-sm font-medium">
                            <svg class="w-4 h-4 mr-2 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H10a2 2 0 00-2-2V6m8 0H8m0 0v2a2 2 0 002 2h4a2 2 0 002-2V6"></path>
                            </svg>
                            <span>{{ $company['jobCount'] }} postes</span>
                        </div>
                    </div>
                    
                    <button class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-3 rounded-lg font-medium transition-colors duration-200">
                        Voir les emplois
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- Footer -->
@include('components.footer')
@endsection
