<section class="relative pt-62 md:pt-60 pb-80 md:pb-80 bg-[#1f1f1f] overflow-hidden">
    <!-- Background Image -->
    <div class="absolute bottom-0 right-0 hidden lg:block pointer-events-none z-0" style="right: 0; width: 40%;">
        <img src="{{ asset('storage/home_page/search_job/cta.png') }}" alt="Background" class="w-full h-auto object-cover" style="object-position: right bottom;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl mx-auto">
            <!-- Card -->
            <div class="p-8 md:p-12 rounded-lg text-center" style="background-color: rgba(43, 43, 43, 0.73); border-radius: 10px; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid transparent; border-image: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) 1; border-image-slice: 1;">
                    <!-- Title -->
                    <h2 class="text-2xl md:text-3xl lg:text-3xl font-bold mb-6" style="color: #d9d9d9; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                        Prêt(e) à trouver votre prochain emploi ?
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-lg mb-8 max-w-2xl mx-auto px-4 md:px-8" style="color: #d9d9d9;">
                        Rejoignez des milliers de professionnels qui ont trouvé leur emploi idéal grâce à OMPLEO. Commencez dès aujourd'hui.
                    </p>

                    <!-- Button -->
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #1aa2a0, #39fffc); border: 1px solid #47fffd; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" alt="Icon" class="w-5 h-5">
                        <span>Parcourir toutes les offres</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
