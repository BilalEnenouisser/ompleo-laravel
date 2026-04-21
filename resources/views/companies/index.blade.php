@extends('layouts.app')

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="min-h-screen bg-[#212221] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="relative pt-32 pb-12 overflow-hidden z-10 companies-hero">
        <style>
            .companies-hero h1 {
                font-size: 70px;
            }
            @media (max-width: 1023px) {
                .companies-hero h1 {
                    font-size: 48px !important;
                }
            }
            @media (max-width: 767px) {
                .companies-hero {
                    padding-top: 5.5rem !important;
                    padding-bottom: 1.5rem !important;
                }
            }
            /* Hero Character Animation */
            .hero-char {
                opacity: 0;
                transform: translateY(20px);
                filter: blur(8px);
                animation: heroCharFadeIn 0.6s ease forwards;
                display: inline-block;
                will-change: transform, opacity, filter;
            }
            @keyframes heroCharFadeIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                    filter: blur(0);
                }
            }
            .hero-subtitle-animate {
                opacity: 0;
                transform: translateY(20px);
                filter: blur(8px);
                animation: heroCharFadeIn 0.6s ease forwards;
                will-change: transform, opacity, filter;
            }
        </style>
        <div class="platform-container">
            <h1 class="font-bold mb-6 leading-tight tracking-tighter companies-hero-title" style="font-size: 0;">
                @php $heroTitle = "Découvrez les entreprises qui recrutent"; if (!function_exists('renderAnimateTextCompanies')) { function renderAnimateTextCompanies($text) { $words = explode(' ', $text); $output = ''; foreach ($words as $wIndex => $word) { $output .= '<span style="white-space:nowrap; font-size: 0;">'; $chars = mb_str_split($word); foreach ($chars as $char) { $output .= '<span class="hero-char" style="display: inline-block;">' . $char . '</span>'; } $output .= '</span>'; if ($wIndex < count($words) - 1) { $output .= '<span class="hero-space">&nbsp;</span>'; } } return $output; } } @endphp
                {{ clean(renderAnimateTextCompanies($heroTitle)) }}
            </h1>
            
            <style>
                .companies-hero-title .hero-char {
                    font-size: 70px;
                    color: #ffffff;
                }
                .companies-hero-title .hero-space {
                    font-size: 70px;
                }
                /* Tablet only — mobile uses global typography in app.css (≤767px) */
                @media (max-width: 1023px) and (min-width: 768px) {
                    .companies-hero-title .hero-char,
                    .companies-hero-title .hero-space {
                        font-size: 48px !important;
                    }
                }
            </style>
            
            <p class="text-xl hero-subtitle-animate" style="color: #ffffff;">
                Explorez les entreprises actuellement à la recherche de talents qualifiés
            </p>
        </div>
    </section>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate hero characters with stagger
        const heroChars = document.querySelectorAll('.companies-hero .hero-char, .companies-hero .hero-space');
        heroChars.forEach((char, index) => {
            char.style.animationDelay = (index * 0.03) + 's';
        });
        
        // Animate subtitle after title
        const subtitle = document.querySelector('.companies-hero .hero-subtitle-animate');
        if (subtitle) {
            subtitle.style.animationDelay = (heroChars.length * 0.03 + 0.2) + 's';
        }
    });
    </script>

    <!-- Search and Filters -->
    <section class="platform-section relative z-10 animate-on-scroll">
        <div class="platform-container">
            <form method="GET" action="{{ route('companies.index') }}" class="rounded-2xl p-6" style="background: rgba(43, 43, 43, 0.6); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                <!-- Company Count - Top -->
                <div class="mb-6">
                    <div class="text-lg lg:text-xl text-white text-center lg:text-left">
                        <span class="font-medium">{{ number_format($companyCount) }}</span> entreprises actives sur Ompleo
                    </div>
                </div>
                
                <style>
                    .companies-filter-select {
                        background-color: rgba(33, 34, 33, 0.8) !important;
                        border: 1px solid rgba(255, 255, 255, 0.1) !important;
                        color: #f5f5f5 !important;
                    }
                    .companies-filter-select:focus {
                        border-color: #00b6b4 !important;
                    }
                    .companies-filter-select option {
                        background-color: #212221 !important;
                        color: #f5f5f5 !important;
                    }
                    
                    .company-card-wrapper {
                        background: transparent !important;
                        transition: background 0.3s ease;
                    }
                    .company-card-wrapper:hover {
                        background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) !important;
                    }
                </style>
                
                <!-- Mobile Layout -->
                <div class="block lg:hidden space-y-4">
                    <!-- Company Name Select - Full Width -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <select name="company_name" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                            <option value="">Nom de l'entreprise</option>
                            @foreach($companyNames as $name)
                                <option value="{{ $name }}" {{ request('company_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    
                    <!-- Location and Industry - Same Line -->
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Location Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <select name="location" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                                <option value="">Région, Wilaya</option>
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
                                @foreach($locations as $loc)
                                    @if(!in_array($loc, ['Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Béjaïa', 'Biskra', 'Béchar', 'Blida', 'Bouira', 'Tamanrasset', 'Tébessa', 'Tlemcen', 'Tiaret', 'Tizi Ouzou', 'Alger', 'Djelfa', 'Jijel', 'Sétif', 'Saïda', 'Skikda', 'Sidi Bel Abbès', 'Annaba', 'Guelma', 'Constantine', 'Médéa', 'Mostaganem', 'M\'Sila', 'Mascara', 'Ouargla', 'Oran', 'El Bayadh', 'Illizi', 'Bordj Bou Arreridj', 'Boumerdès', 'El Tarf', 'Tindouf', 'Tissemsilt', 'El Oued', 'Khenchela', 'Souk Ahras', 'Tipaza', 'Mila', 'Aïn Defla', 'Naâma', 'Aïn Témouchent', 'Ghardaïa', 'Relizane']))
                                        <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Industry Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <select name="industry" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                                <option value="">Secteur d'activité</option>
                                @foreach($industries as $ind)
                                    <option value="{{ $ind }}" {{ request('industry') == $ind ? 'selected' : '' }}>{{ $ind }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Action Buttons - Same Line -->
                    <div class="grid grid-cols-2 gap-3">
                        <button type="submit" class="btn-premium-green !w-full justify-center">
                            Rechercher
                        </button>
                        <a href="{{ route('companies.index') }}" class="btn-premium-dark !w-full justify-center !p-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Desktop Layout -->
                <div class="hidden lg:flex flex-row gap-4 items-end mb-4">
                    <!-- Left side - All filters in one line -->
                    <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4">
                        <!-- Company Name Select -->
                        <div class="lg:col-span-3 relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <select name="company_name" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                                <option value="">Nom de l'entreprise</option>
                                @foreach($companyNames as $name)
                                    <option value="{{ $name }}" {{ request('company_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Location Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <select name="location" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                                <option value="">Région, Wilaya</option>
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
                                @foreach($locations as $loc)
                                    @if(!in_array($loc, ['Adrar', 'Chlef', 'Laghouat', 'Oum El Bouaghi', 'Batna', 'Béjaïa', 'Biskra', 'Béchar', 'Blida', 'Bouira', 'Tamanrasset', 'Tébessa', 'Tlemcen', 'Tiaret', 'Tizi Ouzou', 'Alger', 'Djelfa', 'Jijel', 'Sétif', 'Saïda', 'Skikda', 'Sidi Bel Abbès', 'Annaba', 'Guelma', 'Constantine', 'Médéa', 'Mostaganem', 'M\'Sila', 'Mascara', 'Ouargla', 'Oran', 'El Bayadh', 'Illizi', 'Bordj Bou Arreridj', 'Boumerdès', 'El Tarf', 'Tindouf', 'Tissemsilt', 'El Oued', 'Khenchela', 'Souk Ahras', 'Tipaza', 'Mila', 'Aïn Defla', 'Naâma', 'Aïn Témouchent', 'Ghardaïa', 'Relizane']))
                                        <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        
                        <!-- Industry Filter -->
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <select name="industry" class="companies-filter-select w-full pl-10 pr-10 py-3 rounded-lg focus:ring-2 focus:ring-[#00b6b4] outline-none appearance-none">
                                <option value="">Secteur d'activité</option>
                                @foreach($industries as $ind)
                                    <option value="{{ $ind }}" {{ request('industry') == $ind ? 'selected' : '' }}>{{ $ind }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Right side - Action buttons -->
                    <div class="flex flex-row gap-2 flex-shrink-0">
                        <button type="submit" class="btn-premium-green min-w-[140px] justify-center">
                            Rechercher
                        </button>
                        <a href="{{ route('companies.index') }}" class="btn-premium-dark w-[50px] !p-0 justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Companies Grid -->
    <section class="platform-section relative z-10 animate-on-scroll companies-index-listing">
        <!-- Background Images -->
        <div class="absolute top-0 left-0 hidden lg:block pointer-events-none z-0" style="width: 25%; max-width: 450px;">
            <img src="{{ asset('storage/company_page/left.png') }}" alt="Background" class="w-full h-auto object-cover" style="object-position: left top;">
        </div>
        <div class="absolute top-0 right-0 hidden lg:block pointer-events-none z-0" style="width: 25%; max-width: 450px;">
            <img src="{{ asset('storage/company_page/right.png') }}" alt="Background" class="w-full h-auto object-cover" style="object-position: right top;">
        </div>
        
        <div class="platform-container relative z-10 animate-on-scroll">
            <style>
                @media (max-width: 1023px) {
                    .companies-index-listing .companies-grid {
                        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                    }
                }
                @media (max-width: 767px) {
                    .companies-index-listing .companies-grid {
                        grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
                    }
                }
            </style>
            <div id="companiesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 companies-grid">
                @forelse($companies as $company)
                                @php
                                    $initials = '';
                                    if ($company->name) {
                                        $nameParts = explode(' ', $company->name);
                                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                                        if (count($nameParts) > 1) {
                                            $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                        }
                                    }
                                @endphp
                                
                                <div class="company-card-wrapper group rounded-xl p-[1px] transition-all duration-300" style="border-radius: 12px;">
                                    <div class="rounded-xl p-5 flex flex-col h-full bg-[#2b2b2b] group-hover:bg-[#383838] transition-colors duration-300" style="border-radius: 11px;">
                                        {{-- Top Section: Logo on Left, Industry on Right --}}
                                        <div class="flex gap-4 mb-4 items-center">
                                            {{-- Company Logo on Left --}}
                                            <div class="flex-shrink-0">
                                                @if($company->logo)
                                                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-20 h-20 rounded-lg object-cover">
                                                @else
                                                    <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                                                        <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'C' }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Industry/Specialisation on Right --}}
                                            <div class="flex-1 min-w-0 flex justify-end">
                                                @if($company->industry || $company->specialisation)
                                                <div class="flex flex-wrap gap-1.5 justify-end">
                                                    @if($company->industry)
                                                        <span class="px-2.5 py-1 bg-[#322D23] text-[#71695B] rounded-full border border-[#5E5440] text-xs font-medium">{{ $company->industry }}</span>
                                                    @endif
                                                    @if($company->specialisation)
                                                        <span class="px-2.5 py-1 bg-[#322D23] text-[#71695B] rounded-full border border-[#5E5440] text-xs font-medium">{{ $company->specialisation }}</span>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Bottom Section: Name, Description, Details --}}
                                        <div class="mb-4 flex-1">
                                            {{-- Company Name --}}
                                            <h3 class="text-lg font-bold text-white mb-1.5">{{ $company->name }}</h3>

                                            {{-- Description --}}
                                            @if($company->description)
                                            <p class="text-sm text-[#86878C] mb-3 line-clamp-2 leading-relaxed">{{ $company->description }}</p>
                                            @endif

                                            {{-- Location --}}
                                            @if($company->location)
                                            <div class="flex items-center gap-2 text-sm text-[#86878C] mb-1.5">
                                                <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                                <span>{{ $company->location }}</span>
                                            </div>
                                            @endif

                                            {{-- Company Size --}}
                                            @if($company->size)
                                            <div class="flex items-center gap-2 text-sm text-[#86878C] mb-1.5">
                                                <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                                <span>{{ $company->size }}</span>
                                            </div>
                                            @endif

                                            {{-- Job Count --}}
                                            <div class="flex items-center gap-2 text-sm text-[#646464]">
                                                <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                                <span>{{ $company->jobs_count }} postes</span>
                                            </div>
                                        </div>

                                        {{-- Button at Bottom --}}
                                        <a href="{{ route('company.detail', $company->slug ?? $company->id) }}" class="ompleo-btn w-full bg-[#646464] text-white" style="font-size: 16px !important; font-weight: 400 !important;">
                                            Voir les offres
                                        </a>
                                    </div>
                                </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-24 h-24 mx-auto mb-6 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Aucune entreprise trouvée</h3>
                        <p class="text-gray-600 dark:text-gray-400">Aucune entreprise ne correspond à vos critères de recherche.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($companies->hasPages())
            <div class="mt-12 flex items-center justify-center gap-2">
                @php
                    // Preserve filter parameters in pagination
                    $companies->appends(request()->query());
                @endphp
                {{-- First Page Button (Double Left Arrow) --}}
                @if($companies->currentPage() > 1)
                    <a href="{{ $companies->url(1) }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M11 17l-5-5 5-5M18 17l-5-5 5-5"></path>
                        </svg>
                    </span>
                @endif

                {{-- Previous Button (Single Left Arrow) --}}
                @if($companies->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                    </span>
                @else
                    <a href="{{ $companies->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M15 18l-6-6 6-6"></path>
                        </svg>
                    </a>
                @endif

                {{-- Page Numbers (Circular Buttons) --}}
                <div class="flex items-center gap-2">
                    @php $currentPage = $companies->currentPage(); $lastPage = $companies->lastPage(); $startPage = max(1, $currentPage - 2); $endPage = min($lastPage, $currentPage + 2); // Adjust if we're near the start or end if ($endPage - $startPage < 4) { if ($startPage == 1) { $endPage = min($lastPage, $startPage + 4); } else { $startPage = max(1, $endPage - 4); } } @endphp

                    @if($startPage > 1)
                        <a href="{{ $companies->url(1) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50 transition-colors font-medium">
                            1
                        </a>
                        @if($startPage > 2)
                            <span class="text-gray-400 dark:text-gray-500 px-2">...</span>
                        @endif
                    @endif

                    @for($i = $startPage; $i <= $endPage; $i++)
                        <a href="{{ $companies->url($i) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white transition-colors font-medium {{ $i == $currentPage ? 'bg-[#00b6b4]' : 'bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="text-gray-400 dark:text-gray-500 px-2">...</span>
                        @endif
                        <a href="{{ $companies->url($lastPage) }}" class="w-10 h-10 rounded-full flex items-center justify-center text-white bg-[#00b6b4]/30 hover:bg-[#00b6b4]/50 transition-colors font-medium">
                            {{ $lastPage }}
                        </a>
                    @endif
                </div>

                {{-- Next Button (Single Right Arrow) --}}
                @if($companies->hasMorePages())
                    <a href="{{ $companies->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 18l6-6-6-6"></path>
                        </svg>
                    </span>
                @endif

                {{-- Last Page Button (Double Right Arrow) --}}
                @if($companies->currentPage() < $companies->lastPage())
                    <a href="{{ $companies->url($companies->lastPage()) }}" class="w-10 h-10 flex items-center justify-center text-gray-700 dark:text-gray-300 hover:text-[#00b6b4] transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 7l5 5-5 5M6 7l5 5-5 5"></path>
                        </svg>
                    </a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center text-gray-300 dark:text-gray-600 cursor-not-allowed">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 7l5 5-5 5M6 7l5 5-5 5"></path>
                        </svg>
                    </span>
                @endif
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="companies-cta-outer platform-section relative bg-[#1f1f1f] overflow-hidden">
        <style>
            /* Extra space above/below this band (section shell), not inside the card */
            section.companies-cta-outer.platform-section {
                padding-top: clamp(3.5rem, 9vw, 7rem) !important;
                padding-bottom: clamp(3.5rem, 9vw, 7rem) !important;
            }
            @media (min-width: 1024px) {
                section.companies-cta-outer.platform-section {
                    padding-top: 160px !important;
                    padding-bottom: 160px !important;
                }
            }
            @media (max-width: 767px) {
                .cta-title {
                    line-height: 1.4 !important;
                }
            }
        </style>
        
        <!-- Background Image - Center Bottom -->
        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 pointer-events-none z-0" style="width: 50%; max-width: 540px;">
            <img src="{{ asset('storage/company_page/midbotom.png') }}" alt="Background" class="w-full h-auto object-cover">
        </div>
        
        <div class="platform-container relative z-10">
            <div class="max-w-3xl mx-auto">
                <!-- Card -->
                <div class="p-6 sm:p-8 md:p-12 text-center relative overflow-hidden" style="background-color: rgba(50, 51, 50, 0.25); border-radius: 12px; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                    <!-- Gradient Border Donut -->
                    <div style="position: absolute; inset: 0; border: 1px solid transparent; border-radius: 12px; background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; pointer-events: none;"></div>
                    <!-- Title -->
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-3xl font-bold mb-4 sm:mb-6 cta-title" style="color: #d9d9d9; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                        Prêt(e) à booster la visibilité de vos offres d'emploi ?
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-base sm:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto px-2 sm:px-4 md:px-8" style="color: #d9d9d9;">
                        Publiez, diffusez et atteignez les candidats qui correspondent vraiment à vos besoins.
                    </p>
                    
                    <!-- Button -->
                    <a href="{{ route('nos-solutions') }}" class="btn-premium-green mx-auto">
                        <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon">
                        <span class="whitespace-nowrap">Découvrir nos solutions</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</div>

@endsection
