@extends('layouts.app')

@section('title', 'OMPLEO - Plateforme de Recrutement')
@section('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="bg-gradient-to-b from-[#e0e3df] via-[#dadad2] to-[#dee0db] dark:bg-[#1f1f1f] dark:from-[#1f1f1f] dark:via-[#1f1f1f] dark:to-[#1f1f1f]">
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden bg-[#1f1f1f] mb-16">
        <!-- Background Image -->
        <div class="absolute top-0 right-0 bottom-0  hidden lg:block">
            <img src="{{ asset('storage/home_page/hero.png') }}" alt="Hero" class="w-full h-full object-cover" style="object-position: right;">
        </div>
        
        <!-- Content Overlay -->
        <div class="w-[90%] mx-auto relative z-10" style="padding-left: 20px; padding-right: 700px;">
            <div class="text-left">
                <!-- Icon + Text Badge -->
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('storage/home_page/heroico.svg') }}" alt="Icon" class="w-6 h-6">
                    <span class="text-xl font-normal" style="color: #2cbcba;">La plateforme d'offres d'emploi n°1</span>
                </div>

                <!-- Headline -->
                <h1 class="font-bold mb-6 leading-tight" style="font-size: 83px;">
                    <span class="block" style="color: #ffffff;">Là où les offres d'emploi</span>
                    <span class="block" style="color: #d9d9d9;">Gagnent en visibilité.</span>
                </h1>

                <!-- Sub-headline -->
                <p class="mb-12 mt-12" style="color: #ffffff; font-size: 34px;">
                    Postulez gratuitement ou publiez une offre et amplifiez votre recrutement.
                </p>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-12">
                    <!-- Button 1: Publier une annonce -->
                    <a href="{{ route('signup.recruiter') }}" class="flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #1aa2a0, #39fffc); border: 1px solid #47fffd; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                        <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon" class="w-5 h-5">
                        <span>Publier une annonce</span>
                    </a>

                    <!-- Button 2: Rechercher toutes les offres -->
                    <div class="rounded-full p-[1px]" style="background: linear-gradient(135deg, #39fffc, #1aa2a0);">
                        <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #136b6a, #004948); text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                            <img src="{{ asset('storage/home_page/btton2.svg') }}" alt="Icon" class="w-5 h-5">
                            <span>Rechercher toutes les offres</span>
                        </a>
                    </div>
                </div>

                <!-- Trust Section -->
                <div>
                    <p class="mb-3" style="color: #a6a6a6; font-size: 16px;">Ils nous font confiance:</p>
                    
                    <!-- Marquee/Slider for Brand Logos -->
                    <div class="overflow-hidden relative">
                        <!-- Left fade gradient -->
                        <div class="absolute left-0 top-0 bottom-0 w-20 z-10 pointer-events-none" style="background: linear-gradient(to right, #1f1f1f, transparent);"></div>
                        <!-- Right fade gradient -->
                        <div class="absolute right-0 top-0 bottom-0 w-20 z-10 pointer-events-none" style="background: linear-gradient(to left, #1f1f1f, transparent);"></div>
                        <div class="flex animate-marquee gap-4">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/home_page/brand' . $i . '.png') }}" alt="Brand {{ $i }}" class="h-6 sm:h-8 w-auto opacity-70 hover:opacity-100 transition-opacity">
                                </div>
                            @endfor
                            <!-- Duplicate for seamless loop -->
                            @for($i = 1; $i <= 8; $i++)
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('storage/home_page/brand' . $i . '.png') }}" alt="Brand {{ $i }}" class="h-6 sm:h-8 w-auto opacity-70 hover:opacity-100 transition-opacity">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Why Choose Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.why-choose-section')
    </div> --}}
    
    <!-- Popular Jobs Section -->
    <div class="animate-on-scroll">
        @include('components.jobs-section')
    </div>

    

    

    <!-- Companies Section -->
    <div class="animate-on-scroll">
        @include('components.companies-section')
    </div>

    <!-- Categories Section -->
    <div class="animate-on-scroll">
        @include('components.categories-section')
    </div>

    <!-- Search Job Section -->
    <div class="animate-on-scroll">
        @include('components.search-job-section')
    </div>

    <!-- FAQ Section -->
    <div class="animate-on-scroll">
        @include('components.faq-section')
    </div>

    <!-- CTA Section -->
    <div class="animate-on-scroll">
        @include('components.cta-section')
    </div>

    <!-- Partners Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.partners-section')
    </div> --}}

    <!-- Featured Articles Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.featured-articles')
    </div> --}}

    <!-- Recruiter CTA Section -->
    {{-- <div class="animate-on-scroll">
        @include('components.recruiter-cta')
    </div> --}}
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
