<section class="platform-section relative bg-[#212221] overflow-hidden cta-section">
    <!-- Background Image -->
    <div class="absolute bottom-0 right-0 hidden lg:block pointer-events-none z-0 cta-bg-image" style="right: 0; width: 25%;">
        <img src="{{ asset('storage/home_page/search_job/cta.png') }}" alt="Background" class="w-full h-auto object-cover" style="object-position: right bottom;">
    </div>
    <style>
        .cta-bg-image { width: 25%; }
        @media (max-width: 1023px) { .cta-bg-image { width: 20% !important; } }
    </style>

    <div class="platform-container relative z-10">
        <div class="max-w-3xl mx-auto">
            <!-- Card -->
            <div class="p-6 sm:p-8 md:p-12 text-center relative" style="background-color: rgba(50, 51, 50, 0.25); border-radius: 12px; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                <!-- Gradient Border Donut -->
                <div style="position: absolute; inset: 0; border: 1px solid transparent; border-radius: 12px; background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; pointer-events: none;"></div>
                    <!-- Title -->
                    <h2 class="font-bold mb-4 sm:mb-6 md:text-3xl" style="color: #d9d9d9; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                        Prêt(e) à trouver votre prochain emploi ?
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-[0.9375rem] md:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto px-2 sm:px-4 md:px-8" style="color: #d9d9d9;">
                        Rejoignez des milliers de professionnels qui ont trouvé leur emploi idéal grâce à OMPLEO. Commencez dès aujourd'hui.
                    </p>

                    <!-- Button -->
                    <a href="{{ route('jobs.index') }}" class="btn-premium-green mx-auto">
                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" alt="Icon">
                        <span class="whitespace-nowrap">Parcourir toutes les offres</span>
                    </a>
            </div>
        </div>
    </div>
</section>
