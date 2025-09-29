@extends('layouts.app')

@section('title', 'OMPLEO - Plateforme de Recrutement')
@section('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="bg-gradient-to-b from-[#e0e3df] via-[#dadad2] to-[#dee0db] dark:bg-[#1f1f1f] dark:from-[#1f1f1f] dark:via-[#1f1f1f] dark:to-[#1f1f1f]">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden bg-[#1f1f1f]">
        <div 
            class="absolute inset-0 bg-cover bg-center opacity-40" 
            style="background-image: url('{{ asset('NEW HERO PIC copy.png') }}')"
        ></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="lg:order-1">
                    <div class="text-left lg:text-left mb-8 lg:mb-0 pl-8">
                        <div class="inline-flex items-center gap-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full px-4 py-2 mb-6 animate-bounce">
                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2 2m0 0l2 2m-2-2l-2 2m2-2l2 2M7 7l2 2m0 0l2 2m-2-2l-2 2m2-2l2 2M7 7l2 2m0 0l2 2m-2-2l-2 2m2-2l2 2M7 7l2 2m0 0l2 2m-2-2l-2 2m2-2l2 2"></path>
                            </svg>
                            <span class="text-sm font-medium text-[#00b6b4]">Plateforme #1 en Algérie</span>
                        </div>

                        <div class="text-6xl font-bold text-white mb-6 leading-tight text-shadow">
                            <div class="whitespace-nowrap">Trouvez le talent idéal</div>
                            <div class="whitespace-nowrap">ou l'emploi de vos rêves</div>
                        </div>

                        <form class="mt-10 space-y-4">
                            <!-- Job Search -->
                            <div class="relative w-full">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    placeholder="Intitulé du poste, mot-clé ou compétence"
                                    class="w-full h-12 pl-12 pr-4 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] placeholder-[#cccccc] focus:outline-none focus:ring-2 focus:ring-[#00b6b4] shadow-lg"
                                />
                            </div>

                            <!-- Wilaya -->
                            <div class="relative w-full">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <select class="w-full h-12 pl-12 pr-4 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] focus:outline-none focus:ring-2 focus:ring-[#00b6b4] shadow-lg">
                                    <option value="">Région / Wilaya</option>
                                    <option value="Adrar">Adrar</option>
                                    <option value="Chlef">Chlef</option>
                                    <option value="Laghouat">Laghouat</option>
                                    <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                                    <option value="Batna">Batna</option>
                                    <option value="Béjaïa">Béjaïa</option>
                                    <option value="Biskra">Biskra</option>
                                    <option value="Béchar">Béchar</option>
                                    <option value="Blida">Blida</option>
                                    <option value="Bouira">Bouira</option>
                                    <option value="Tamanrasset">Tamanrasset</option>
                                    <option value="Tébessa">Tébessa</option>
                                    <option value="Tlemcen">Tlemcen</option>
                                    <option value="Tiaret">Tiaret</option>
                                    <option value="Tizi Ouzou">Tizi Ouzou</option>
                                    <option value="Alger">Alger</option>
                                    <option value="Djelfa">Djelfa</option>
                                    <option value="Jijel">Jijel</option>
                                    <option value="Sétif">Sétif</option>
                                    <option value="Saïda">Saïda</option>
                                    <option value="Skikda">Skikda</option>
                                    <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                                    <option value="Annaba">Annaba</option>
                                    <option value="Guelma">Guelma</option>
                                    <option value="Constantine">Constantine</option>
                                    <option value="Médéa">Médéa</option>
                                    <option value="Mostaganem">Mostaganem</option>
                                    <option value="M'Sila">M'Sila</option>
                                    <option value="Mascara">Mascara</option>
                                    <option value="Ouargla">Ouargla</option>
                                    <option value="Oran">Oran</option>
                                    <option value="El Bayadh">El Bayadh</option>
                                    <option value="Illizi">Illizi</option>
                                    <option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
                                    <option value="Boumerdès">Boumerdès</option>
                                    <option value="El Tarf">El Tarf</option>
                                    <option value="Tindouf">Tindouf</option>
                                    <option value="Tissemsilt">Tissemsilt</option>
                                    <option value="El Oued">El Oued</option>
                                    <option value="Khenchela">Khenchela</option>
                                    <option value="Souk Ahras">Souk Ahras</option>
                                    <option value="Tipaza">Tipaza</option>
                                    <option value="Mila">Mila</option>
                                    <option value="Aïn Defla">Aïn Defla</option>
                                    <option value="Naâma">Naâma</option>
                                    <option value="Aïn Témouchent">Aïn Témouchent</option>
                                    <option value="Ghardaïa">Ghardaïa</option>
                                    <option value="Relizane">Relizane</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <button
                                type="submit"
                                class="w-full h-14 text-lg rounded-lg bg-[#00b6b4] text-white font-bold shadow-lg hover:bg-[#009e9c] transition-all duration-300"
                            >
                                Trouver un emploi
                            </button>
                        </form>

                        <!-- Recherches populaires -->
                        <div class="mt-6">
                            <p class="text-white text-shadow mb-3">Recherches populaires :</p>
                            <div class="flex flex-wrap gap-2">
                                <button class="px-4 py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b]">
                                    Développeur
                                </button>
                                <button class="px-4 py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b]">
                                    Marketing
                                </button>
                                <button class="px-4 py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b]">
                                    Commercial
                                </button>
                                <button class="px-4 py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b]">
                                    Design
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:order-2 hidden lg:block">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Articles Section -->
    @include('components.featured-articles')

    <!-- Why Choose Section -->
    @include('components.why-choose-section')

    <!-- Jobs Section -->
    @include('components.jobs-section')

    <!-- Partners Section -->
    @include('components.partners-section')

    <!-- Recruiter CTA Section -->
    @include('components.recruiter-cta')
</div>

<!-- Footer -->
@include('components.footer')
@endsection