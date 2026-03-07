@extends('layouts.app')

@section('title', 'À propos - OMPLEO')
@section('description', 'Découvrez OMPLEO, la plateforme de recrutement qui simplifie la façon de trouver un emploi.')

@section('content')
<div class="bg-[#212221] min-h-screen">
    <!-- Header -->
    @include('components.header')

    <!-- About Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <style>
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
            .hero-content-animate {
                opacity: 0;
                transform: translateY(20px);
                filter: blur(8px);
                animation: heroCharFadeIn 0.6s ease forwards;
                will-change: transform, opacity, filter;
            }
        </style>
        
        <!-- Background Image on Right -->
        <div class="absolute top-0 right-0 bottom-0 w-[25%] hidden lg:block pointer-events-none z-0">
            <img src="{{ asset('storage/company_page/right.png') }}" alt="Background" class="w-full h-full object-cover object-left">
        </div>
        
        <div class="w-[90%] mx-auto relative z-10 animate-on-scroll" style="padding-left: 20px; padding-right: 20px;">
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
                    <p class="animate-stagger-item">
                        Chez OMPLEO, nous avons une mission claire : connecter les talents aux entreprises qui recrutent, simplement et efficacement.<br>
                        Nous avons créé une plateforme pensée pour faciliter l'accès aux opportunités professionnelles, quel que soit le secteur ou le niveau d'expérience.
                    </p>
                    
                    <p class="animate-stagger-item">
                        Notre objectif est d'offrir un espace fiable et intuitif où les candidats peuvent découvrir des offres pertinentes et où les entreprises peuvent gagner en visibilité et toucher les bons profils.<br>
                        Nous croyons que chaque parcours professionnel mérite les bonnes opportunités au bon moment. Que vous soyez débutant, confirmé ou en reconversion, OMPLEO vous aide à trouver un poste en adéquation avec vos compétences et vos ambitions.
                    </p>
                    
                    <div class="animate-stagger-item">
                        <p class="mb-3">OMPLEO a été conçue pour être simple, efficace et transparente :</p>
                        <ul class="list-disc list-inside space-y-1 ml-4">
                            <li>une navigation claire,</li>
                            <li>des offres vérifiées,</li>
                            <li>une mise en relation directe entre candidats et recruteurs.</li>
                        </ul>
                    </div>
                    
                    <p class="animate-stagger-item">
                        Rejoignez une communauté grandissante de professionnels et d'entreprises, et trouvez votre prochaine opportunité dès aujourd'hui avec OMPLEO.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 md:py-28 relative z-10 animate-on-scroll">
        <div class="w-full max-w-[95%] md:max-w-5xl mx-auto px-4">
            <div class="bg-[#141414] border border-white/[0.05] rounded-[20px] p-6 md:p-16 text-center shadow-2xl relative overflow-hidden">
                <h3 class="font-bold text-white mb-4 relative z-10" style="font-size: 28px; line-height: 1.2;">Sign-up to stay updated</h3>
                <p class="text-gray-500 mb-10 relative z-10" style="font-size: 18px; line-height: 1.5;">Get the latest AI jobs in your inbox every Monday.</p>
                
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto items-center relative z-10">
                    <div class="w-full sm:flex-grow">
                        <input type="email" placeholder="Email Address" required
                               class="w-full px-6 py-4 rounded-lg bg-[#0d0d0d] border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:border-[#1aa2a0] focus:ring-1 focus:ring-[#1aa2a0] transition-all"
                               style="font-size: 15px;">
                    </div>
                    <button type="submit" class="btn-premium-dark !rounded-lg !px-10 !py-4 font-bold whitespace-nowrap w-full sm:w-auto transition-all"
                            style="font-size: 15px;">
                        Subscribe
                    </button>
                </form>
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
        char.style.animationDelay = (index * 0.035) + 's';
    });
    
    // Animate subtitle characters after title (starts later for more deliberate feel)
    const subtitleChars = document.querySelectorAll('.about-hero-subtitle .hero-char');
    const subtitleStartDelay = 1.2; // Deliberate delay before subtitle starts
    subtitleChars.forEach((char, index) => {
        char.style.animationDelay = (subtitleStartDelay + index * 0.015) + 's';
    });
    
    // Animate content after subtitle
    const content = document.querySelector('.hero-content-animate');
    if (content) {
        content.style.animationDelay = (subtitleStartDelay + subtitleChars.length * 0.015 + 0.3) + 's';
    }
});
</script>
@endsection
