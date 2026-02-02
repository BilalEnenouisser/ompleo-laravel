@extends('layouts.app')

@section('title', 'À propos - OMPLEO')
@section('description', 'Découvrez OMPLEO, la plateforme de recrutement qui simplifie la façon de trouver un emploi.')

@section('content')
<div class="bg-[#1f1f1f] min-h-screen">
    <!-- Header -->
    @include('components.header')

    <!-- About Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <style>
            /* Hero Character Animation */
            .hero-char {
                opacity: 0;
                transform: translateY(20px);
                animation: heroCharFadeIn 0.6s ease forwards;
                display: inline-block;
            }
            @keyframes heroCharFadeIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .hero-subtitle-animate {
                opacity: 0;
                transform: translateY(20px);
                animation: heroCharFadeIn 0.6s ease forwards;
            }
            .hero-content-animate {
                opacity: 0;
                transform: translateY(20px);
                animation: heroCharFadeIn 0.6s ease forwards;
            }
        </style>
        
        <!-- Background Image on Right -->
        <div class="absolute top-0 right-0 bottom-0 w-1/3 lg:w-2/5 hidden lg:block pointer-events-none z-0">
            <img src="{{ asset('storage/company_page/right.png') }}" alt="Background" class="w-full h-full object-cover object-left">
        </div>
        
        <div class="w-[90%] mx-auto relative z-10" style="padding-left: 20px; padding-right: 20px;">
            <div class="max-w-3xl">
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 about-hero-title">
                    <span class="hero-char">À</span><span class="hero-char">&nbsp;</span><span class="hero-char">p</span><span class="hero-char">r</span><span class="hero-char">o</span><span class="hero-char">p</span><span class="hero-char">o</span><span class="hero-char">s</span><span class="hero-char">&nbsp;</span><span class="hero-char">d</span><span class="hero-char">e</span><span class="hero-char">&nbsp;</span><span class="hero-char">n</span><span class="hero-char">o</span><span class="hero-char">u</span><span class="hero-char">s</span>
                </h1>
                
                <!-- Subtitle -->
                <h2 class="text-xl md:text-2xl text-white mb-10 about-hero-subtitle hero-subtitle-animate">
                    <span class="hero-char">O</span><span class="hero-char">M</span><span class="hero-char">P</span><span class="hero-char">L</span><span class="hero-char">E</span><span class="hero-char">O</span><span class="hero-char">&nbsp;</span><span class="hero-char">s</span><span class="hero-char">i</span><span class="hero-char">m</span><span class="hero-char">p</span><span class="hero-char">l</span><span class="hero-char">i</span><span class="hero-char">f</span><span class="hero-char">i</span><span class="hero-char">e</span><span class="hero-char">&nbsp;</span><span class="hero-char">l</span><span class="hero-char">a</span><span class="hero-char">&nbsp;</span><span class="hero-char">f</span><span class="hero-char">a</span><span class="hero-char">ç</span><span class="hero-char">o</span><span class="hero-char">n</span><span class="hero-char">&nbsp;</span><span class="hero-char">d</span><span class="hero-char">e</span><span class="hero-char">&nbsp;</span><span class="hero-char">t</span><span class="hero-char">r</span><span class="hero-char">o</span><span class="hero-char">u</span><span class="hero-char">v</span><span class="hero-char">e</span><span class="hero-char">r</span><span class="hero-char">&nbsp;</span><span class="hero-char">u</span><span class="hero-char">n</span><span class="hero-char">&nbsp;</span><span class="hero-char">e</span><span class="hero-char">m</span><span class="hero-char">p</span><span class="hero-char">l</span><span class="hero-char">o</span><span class="hero-char">i</span>
                </h2>
                
                <!-- Content -->
                <div class="space-y-6 leading-relaxed text-white hero-content-animate">
                    <p>
                        Chez OMPLEO, nous avons une mission claire : connecter les talents aux entreprises qui recrutent, simplement et efficacement.<br>
                        Nous avons créé une plateforme pensée pour faciliter l'accès aux opportunités professionnelles, quel que soit le secteur ou le niveau d'expérience.
                    </p>
                    
                    <p>
                        Notre objectif est d'offrir un espace fiable et intuitif où les candidats peuvent découvrir des offres pertinentes et où les entreprises peuvent gagner en visibilité et toucher les bons profils.<br>
                        Nous croyons que chaque parcours professionnel mérite les bonnes opportunités au bon moment. Que vous soyez débutant, confirmé ou en reconversion, OMPLEO vous aide à trouver un poste en adéquation avec vos compétences et vos ambitions.
                    </p>
                    
                    <div>
                        <p class="mb-3">OMPLEO a été conçue pour être simple, efficace et transparente :</p>
                        <ul class="list-disc list-inside space-y-1 ml-4">
                            <li>une navigation claire,</li>
                            <li>des offres vérifiées,</li>
                            <li>une mise en relation directe entre candidats et recruteurs.</li>
                        </ul>
                    </div>
                    
                    <p>
                        Rejoignez une communauté grandissante de professionnels et d'entreprises, et trouvez votre prochaine opportunité dès aujourd'hui avec OMPLEO.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate title characters with stagger
    const titleChars = document.querySelectorAll('.about-hero-title .hero-char');
    titleChars.forEach((char, index) => {
        char.style.animationDelay = (index * 0.03) + 's';
    });
    
    // Animate subtitle characters after title
    const subtitleChars = document.querySelectorAll('.about-hero-subtitle .hero-char');
    const subtitleStartDelay = titleChars.length * 0.03 + 0.1;
    subtitleChars.forEach((char, index) => {
        char.style.animationDelay = (subtitleStartDelay + index * 0.02) + 's';
    });
    
    // Animate content after subtitle
    const content = document.querySelector('.hero-content-animate');
    if (content) {
        content.style.animationDelay = (subtitleStartDelay + subtitleChars.length * 0.02 + 0.2) + 's';
    }
});
</script>
@endsection
