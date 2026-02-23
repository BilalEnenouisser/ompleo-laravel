@extends('layouts.app')

@section('title', 'Emplois - OMPLEO')
@section('description', 'Découvrez toutes les offres d\'emploi disponibles sur OMPLEO')

@section('content')
<!-- Header -->
@include('components.header')
@php
use Illuminate\Support\Facades\Storage;

@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
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
                {{ $totalPublishedJobs }} offres d'emploi vous attendent
            </p>
        </div>
    </section>

    <!-- Search and Filters -->
    <section class="py-8 relative z-10 -mt-8 bg-white dark:bg-[#1f1f1f] animate-on-scroll">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('jobs.index') }}" class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-gray-100 dark:border-[#333333]">
                <!-- Mobile Layout -->
                <div class="block lg:hidden space-y-4">
                    <!-- Search Input - Full Width -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Poste, entreprise, compétences..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <!-- Location and Work Type - Same Line -->
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Location Filter -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                            <select name="location" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Toutes les villes</option>
                                <option value="Adrar" {{ request('location') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                                <option value="Chlef" {{ request('location') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                                <option value="Laghouat" {{ request('location') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                                <option value="Oum El Bouaghi" {{ request('location') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                                <option value="Batna" {{ request('location') == 'Batna' ? 'selected' : '' }}>Batna</option>
                                <option value="Béjaïa" {{ request('location') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                                <option value="Biskra" {{ request('location') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                                <option value="Béchar" {{ request('location') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                                <option value="Blida" {{ request('location') == 'Blida' ? 'selected' : '' }}>Blida</option>
                                <option value="Bouira" {{ request('location') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                                <option value="Tamanrasset" {{ request('location') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                                <option value="Tébessa" {{ request('location') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                                <option value="Tlemcen" {{ request('location') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                                <option value="Tiaret" {{ request('location') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                                <option value="Tizi Ouzou" {{ request('location') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                                <option value="Alger" {{ request('location') == 'Alger' ? 'selected' : '' }}>Alger</option>
                                <option value="Djelfa" {{ request('location') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                                <option value="Jijel" {{ request('location') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                                <option value="Sétif" {{ request('location') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                                <option value="Saïda" {{ request('location') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                                <option value="Skikda" {{ request('location') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                                <option value="Sidi Bel Abbès" {{ request('location') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                                <option value="Annaba" {{ request('location') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                                <option value="Guelma" {{ request('location') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                                <option value="Constantine" {{ request('location') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                                <option value="Médéa" {{ request('location') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                                <option value="Mostaganem" {{ request('location') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                                <option value="M'Sila" {{ request('location') == "M'Sila" ? 'selected' : '' }}>M'Sila</option>
                                <option value="Mascara" {{ request('location') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                                <option value="Ouargla" {{ request('location') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                                <option value="Oran" {{ request('location') == 'Oran' ? 'selected' : '' }}>Oran</option>
                                <option value="El Bayadh" {{ request('location') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                                <option value="Illizi" {{ request('location') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                                <option value="Bordj Bou Arreridj" {{ request('location') == 'Bordj Bou Arreridj' ? 'selected' : '' }}>Bordj Bou Arreridj</option>
                                <option value="Boumerdès" {{ request('location') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                                <option value="El Tarf" {{ request('location') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                                <option value="Tindouf" {{ request('location') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                                <option value="Tissemsilt" {{ request('location') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                                <option value="El Oued" {{ request('location') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                                <option value="Khenchela" {{ request('location') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                                <option value="Souk Ahras" {{ request('location') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                                <option value="Tipaza" {{ request('location') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                                <option value="Mila" {{ request('location') == 'Mila' ? 'selected' : '' }}>Mila</option>
                                <option value="Aïn Defla" {{ request('location') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                                <option value="Naâma" {{ request('location') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                                <option value="Aïn Témouchent" {{ request('location') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                                <option value="Ghardaïa" {{ request('location') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                                <option value="Relizane" {{ request('location') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                    </div>
                    
                        <!-- Work Type Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <select name="type" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Type de travail</option>
                                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Télétravail</option>
                                <option value="onsite" {{ request('type') == 'onsite' ? 'selected' : '' }}>Présentiel</option>
                                <option value="hybrid" {{ request('type') == 'hybrid' ? 'selected' : '' }}>Hybride</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Experience and Sort - Same Line -->
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Experience Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <select id="experience" name="experience" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Expérience</option>
                                <option value="0-1 ans" {{ request('experience') == '0-1 ans' ? 'selected' : '' }}>0-1 ans</option>
                                <option value="1-2 ans" {{ request('experience') == '1-2 ans' ? 'selected' : '' }}>1-2 ans</option>
                                <option value="2-3 ans" {{ request('experience') == '2-3 ans' ? 'selected' : '' }}>2-3 ans</option>
                                <option value="3-5 ans" {{ request('experience') == '3-5 ans' ? 'selected' : '' }}>3-5 ans</option>
                                <option value="5-7 ans" {{ request('experience') == '5-7 ans' ? 'selected' : '' }}>5-7 ans</option>
                                <option value="7-10 ans" {{ request('experience') == '7-10 ans' ? 'selected' : '' }}>7-10 ans</option>
                                <option value="10+ ans" {{ request('experience') == '10+ ans' ? 'selected' : '' }}>10+ ans</option>
                                <option value="Débutant" {{ request('experience') == 'Débutant' ? 'selected' : '' }}>Débutant</option>
                                <option value="Junior" {{ request('experience') == 'Junior' ? 'selected' : '' }}>Junior</option>
                                <option value="Intermédiaire" {{ request('experience') == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="Senior" {{ request('experience') == 'Senior' ? 'selected' : '' }}>Senior</option>
                                <option value="Expert" {{ request('experience') == 'Expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Sort Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            <select name="sort" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récentes</option>
                                <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>Salaire croissant</option>
                                <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>Salaire décroissant</option>
                                <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre A-Z</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                    </div>
                </div>
                    
                    <!-- Action Buttons - Same Line -->
                    <div class="grid grid-cols-2 gap-3">
                        <button type="submit" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Rechercher
                        </button>
                        <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
            </div>
        </div>

                <!-- Desktop Layout -->
                <div class="hidden lg:flex flex-row gap-4 items-end mb-4">
                    <!-- Left side - All filters in one line -->
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3 sm:gap-4">
                    <!-- Search Input -->
                    <div class="lg:col-span-2 relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Poste, entreprise, compétences..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]"
                        />
                    </div>
                    
                    <!-- Location Filter -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                            <select name="location" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Toutes les villes</option>
                                <option value="Adrar" {{ request('location') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                                <option value="Chlef" {{ request('location') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                                <option value="Laghouat" {{ request('location') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                                <option value="Oum El Bouaghi" {{ request('location') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                                <option value="Batna" {{ request('location') == 'Batna' ? 'selected' : '' }}>Batna</option>
                                <option value="Béjaïa" {{ request('location') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                                <option value="Biskra" {{ request('location') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                                <option value="Béchar" {{ request('location') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                                <option value="Blida" {{ request('location') == 'Blida' ? 'selected' : '' }}>Blida</option>
                                <option value="Bouira" {{ request('location') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                                <option value="Tamanrasset" {{ request('location') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                                <option value="Tébessa" {{ request('location') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                                <option value="Tlemcen" {{ request('location') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                                <option value="Tiaret" {{ request('location') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                                <option value="Tizi Ouzou" {{ request('location') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                            <option value="Alger" {{ request('location') == 'Alger' ? 'selected' : '' }}>Alger</option>
                                <option value="Djelfa" {{ request('location') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                                <option value="Jijel" {{ request('location') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                                <option value="Sétif" {{ request('location') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                                <option value="Saïda" {{ request('location') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                                <option value="Skikda" {{ request('location') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                                <option value="Sidi Bel Abbès" {{ request('location') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                                <option value="Annaba" {{ request('location') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                                <option value="Guelma" {{ request('location') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                                <option value="Constantine" {{ request('location') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                                <option value="Médéa" {{ request('location') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                                <option value="Mostaganem" {{ request('location') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                                <option value="M'Sila" {{ request('location') == "M'Sila" ? 'selected' : '' }}>M'Sila</option>
                                <option value="Mascara" {{ request('location') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                                <option value="Ouargla" {{ request('location') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                            <option value="Oran" {{ request('location') == 'Oran' ? 'selected' : '' }}>Oran</option>
                                <option value="El Bayadh" {{ request('location') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                                <option value="Illizi" {{ request('location') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                                <option value="Bordj Bou Arreridj" {{ request('location') == 'Bordj Bou Arreridj' ? 'selected' : '' }}>Bordj Bou Arreridj</option>
                                <option value="Boumerdès" {{ request('location') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                                <option value="El Tarf" {{ request('location') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                                <option value="Tindouf" {{ request('location') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                                <option value="Tissemsilt" {{ request('location') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                                <option value="El Oued" {{ request('location') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                                <option value="Khenchela" {{ request('location') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                                <option value="Souk Ahras" {{ request('location') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                                <option value="Tipaza" {{ request('location') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                                <option value="Mila" {{ request('location') == 'Mila' ? 'selected' : '' }}>Mila</option>
                                <option value="Aïn Defla" {{ request('location') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                                <option value="Naâma" {{ request('location') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                                <option value="Aïn Témouchent" {{ request('location') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                                <option value="Ghardaïa" {{ request('location') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                                <option value="Relizane" {{ request('location') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                    </div>
                    
                        <!-- Work Type Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <select name="type" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                            <option value="">Type de travail</option>
                                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Télétravail</option>
                                <option value="onsite" {{ request('type') == 'onsite' ? 'selected' : '' }}>Présentiel</option>
                                <option value="hybrid" {{ request('type') == 'hybrid' ? 'selected' : '' }}>Hybride</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                </div>
                
                        <!-- Experience Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <select id="experience" name="experience" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5]">
                                <option value="">Expérience</option>
                                <option value="0-1 ans" {{ request('experience') == '0-1 ans' ? 'selected' : '' }}>0-1 ans</option>
                                <option value="1-2 ans" {{ request('experience') == '1-2 ans' ? 'selected' : '' }}>1-2 ans</option>
                                <option value="2-3 ans" {{ request('experience') == '2-3 ans' ? 'selected' : '' }}>2-3 ans</option>
                                <option value="3-5 ans" {{ request('experience') == '3-5 ans' ? 'selected' : '' }}>3-5 ans</option>
                                <option value="5-7 ans" {{ request('experience') == '5-7 ans' ? 'selected' : '' }}>5-7 ans</option>
                                <option value="7-10 ans" {{ request('experience') == '7-10 ans' ? 'selected' : '' }}>7-10 ans</option>
                                <option value="10+ ans" {{ request('experience') == '10+ ans' ? 'selected' : '' }}>10+ ans</option>
                                <option value="Débutant" {{ request('experience') == 'Débutant' ? 'selected' : '' }}>Débutant</option>
                                <option value="Junior" {{ request('experience') == 'Junior' ? 'selected' : '' }}>Junior</option>
                                <option value="Intermédiaire" {{ request('experience') == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="Senior" {{ request('experience') == 'Senior' ? 'selected' : '' }}>Senior</option>
                                <option value="Expert" {{ request('experience') == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Sort Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                            </svg>
                            <select name="sort" class="w-full pl-10 pr-10 py-3 border border-gray-200 dark:border-[#333333] rounded-lg bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récentes</option>
                            <option value="salary_asc" {{ request('sort') == 'salary_asc' ? 'selected' : '' }}>Salaire croissant</option>
                            <option value="salary_desc" {{ request('sort') == 'salary_desc' ? 'selected' : '' }}>Salaire décroissant</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Titre A-Z</option>
                        </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Right side - Action buttons -->
                    <div class="flex flex-row gap-2 flex-shrink-0">
                        <style>
                            /* Desktop is default - buttons on same line */
                            @media (max-width: 767px) {
                                .jobs-action-buttons {
                                    flex-wrap: wrap !important;
                                }
                            }
                        </style>
                        <button type="submit" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 jobs-action-buttons">
                            Rechercher
                        </button>
                        <a href="{{ route('jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Second Row -->
                <div class="flex flex-row gap-4 items-end">
                    <style>
                        @media (max-width: 1023px) {
                            .jobs-second-row {
                                flex-direction: column !important;
                                align-items: center !important;
                            }
                        }
                    </style>
                    <!-- Left side - Additional filters or info -->
                    <div class="flex-1">
                        <!-- You can add additional filters or information here -->
                        <div class="text-sm text-gray-600 dark:text-gray-400 text-center lg:text-left pt-4 lg:pt-0">
                            <span class="font-medium">{{ $totalPublishedJobs }}</span> offres disponibles
                        </div>
                    </div>
                    
                    <!-- Right side - Additional buttons or info -->
                    <div class="flex gap-2 flex-shrink-0">
                        <!-- You can add additional buttons or information here -->
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!-- Jobs List -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 sm:mb-8 gap-4">
                <h2 class="text-xl sm:text-2xl font-bold text-[#111111] dark:text-[#f5f5f5]">
                    {{ $jobs->total() }} offres trouvées
                </h2>
            </div>

            <div id="jobs-container" class="space-y-6">
                @include('jobs.partials.job-card', ['jobs' => $jobs])
                                </div>
                                
            <!-- Show More Button -->
            @if($jobs->hasMorePages())
            <div class="mt-12 text-center">
                <button 
                    id="show-more-btn" 
                    class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-lg font-medium transition-colors duration-200 inline-flex items-center gap-2"
                    data-page="2"
                    data-loading="false"
                >
                    <span class="btn-text">Voir plus d'offres</span>
                    <svg id="loading-spinner" class="w-6 h-6 animate-spin hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
            </div>
            @endif
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showMoreBtn = document.getElementById('show-more-btn');
    const jobsContainer = document.getElementById('jobs-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    const btnText = document.querySelector('.btn-text');
    
    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            if (this.dataset.loading === 'true') return;
            
            this.dataset.loading = 'true';
            this.disabled = true;
            loadingSpinner.classList.remove('hidden');
            btnText.textContent = 'Chargement...';
            
            const currentPage = parseInt(this.dataset.page);
            const url = new URL(window.location.href);
            url.searchParams.set('page', currentPage);
            
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    jobsContainer.insertAdjacentHTML('beforeend', data.html);
                }
                
                if (data.hasMore) {
                    this.dataset.page = data.nextPage;
                    this.dataset.loading = 'false';
                    this.disabled = false;
                    loadingSpinner.classList.add('hidden');
                    btnText.textContent = 'Voir plus d\'offres';
                } else {
                    this.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error loading more jobs:', error);
                this.dataset.loading = 'false';
                this.disabled = false;
                loadingSpinner.classList.add('hidden');
                btnText.textContent = 'Voir plus d\'offres';
            });
        });
    }
});
</script>

@endsection
