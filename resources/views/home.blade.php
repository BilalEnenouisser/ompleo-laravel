@extends('layouts.app')

@section('title', 'OMPLEO - Plateforme de Recrutement')
@section('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="bg-gradient-to-b from-[#e0e3df] via-[#dadad2] to-[#dee0db] dark:bg-[#1f1f1f] dark:from-[#1f1f1f] dark:via-[#1f1f1f] dark:to-[#1f1f1f]">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section id="home" class="relative h-[80vh] md:h-screen flex items-center overflow-hidden bg-[#1f1f1f]">
        <div 
            class="absolute inset-0 bg-cover bg-center opacity-50" 
            style="background-image: url('{{ asset('herosection.jpg') }}')"
        ></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="lg:order-1 animate-fade-in-up">
                    <div class="text-left lg:text-left mb-8 lg:mb-0 lg:pl-8">
                        <div class="inline-flex items-center gap-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full px-4 py-2 mb-6 animate-float-gentle">
                            <!-- Sparkles icon from Lucide React -->
                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                <path d="M20 3v4"></path>
                                <path d="M22 5h-4"></path>
                                <path d="M4 17v2"></path>
                                <path d="M5 18H3"></path>
                            </svg>
                            <span class="text-sm font-medium text-[#00b6b4]">Plateforme #1 en Algérie</span>
                        </div>

                        <div class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight text-shadow">
                            <div class="sm:whitespace-nowrap">Trouvez le talent idéal</div>
                            <div class="sm:whitespace-nowrap">ou l'emploi de vos rêves</div>
                        </div>

                        <form id="homeSearchForm" method="GET" action="{{ route('jobs.index') }}" class="mt-6 sm:mt-10 space-y-3 sm:space-y-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                            <!-- Job Search -->
                            <div class="relative w-full">
                                <div class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    id="homeSearchInput"
                                    name="search"
                                    placeholder="Intitulé du poste, mot-clé ou compétence"
                                    class="w-full h-10 sm:h-12 pl-10 sm:pl-12 pr-3 sm:pr-4 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] placeholder-[#cccccc] focus:outline-none focus:ring-2 focus:ring-[#00b6b4] shadow-lg text-sm sm:text-base"
                                />
                            </div>

                            <!-- Wilaya -->
                            <div class="relative w-full">
                                <div class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <select id="homeLocationSelect" name="location" class="w-full h-10 sm:h-12 pl-10 sm:pl-12 pr-3 sm:pr-4 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] focus:outline-none focus:ring-2 focus:ring-[#00b6b4] shadow-lg text-sm sm:text-base">
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
                                class="w-full h-10 sm:h-12 md:h-14 text-sm sm:text-base md:text-lg rounded-lg bg-[#00b6b4] text-white font-bold shadow-lg hover:bg-[#009e9c] transition-all duration-300 hover:scale-105 active:scale-95"
                            >
                                Trouver un emploi
                            </button>
                        </form>

                        <!-- Recherches populaires -->
                        <div class="mt-4 sm:mt-6 animate-fade-in-up" style="animation-delay: 0.9s;">
                            <p class="text-white text-shadow mb-2 sm:mb-3 text-sm sm:text-base">Recherches populaires :</p>
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                <button type="button" onclick="searchPopular('Développeur')" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-xs sm:text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b] hover:scale-105 active:scale-95">
                                    Développeur
                                </button>
                                <button type="button" onclick="searchPopular('Marketing')" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-xs sm:text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b] hover:scale-105 active:scale-95">
                                    Marketing
                                </button>
                                <button type="button" onclick="searchPopular('Commercial')" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-xs sm:text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b] hover:scale-105 active:scale-95">
                                    Commercial
                                </button>
                                <button type="button" onclick="searchPopular('Design')" class="px-3 sm:px-4 py-1.5 sm:py-2 bg-[#2b2b2b]/80 backdrop-blur-sm border border-[#00b6b4]/20 rounded-full text-xs sm:text-sm text-[#00b6b4] transition-all duration-300 hover:bg-[#2b2b2b] hover:scale-105 active:scale-95">
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

    <!-- Why Choose Section -->
    <div class="animate-on-scroll">
        @include('components.why-choose-section')
    </div>

    <!-- Jobs Section -->
    <div class="animate-on-scroll">
        @include('components.jobs-section')
    </div>

    <!-- Partners Section -->
    <div class="animate-on-scroll">
        @include('components.partners-section')
    </div>


    <!-- Featured Articles Section -->
    <div class="animate-on-scroll">
        @include('components.featured-articles')
    </div>


    <!-- Recruiter CTA Section -->
    <div class="animate-on-scroll">
        @include('components.recruiter-cta')
    </div>
</div>

<!-- Footer -->
@include('components.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle popular search buttons
    window.searchPopular = function(keyword) {
        const searchInput = document.getElementById('homeSearchInput');
        if (searchInput) {
            searchInput.value = keyword;
        }
        
        // Submit the form
        const form = document.getElementById('homeSearchForm');
        if (form) {
            form.submit();
        }
    };

    // Handle form submission with validation
    const form = document.getElementById('homeSearchForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const searchInput = document.getElementById('homeSearchInput');
            const locationSelect = document.getElementById('homeLocationSelect');
            
            // If both search and location are empty, prevent submission
            if (!searchInput.value.trim() && !locationSelect.value) {
                e.preventDefault();
                // Focus on search input to encourage user to enter something
                searchInput.focus();
                return false;
            }
            
            // Form will submit normally with GET parameters
        });
    }
});
</script>
@endsection
