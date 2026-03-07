<section class="relative bg-[#212221] overflow-hidden cta-section">
    <style>
        /* Desktop (1024px and above) */
        @media (min-width: 1024px) {
            section.cta-section {
                padding-top: 10rem;
                padding-bottom: 10rem;
            }
        }
        
        /* Tablet (768px - 1023px) */
        @media (min-width: 768px) and (max-width: 1023px) {
            section.cta-section {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }
        }
        
        /* Mobile (max-width: 767px) */
        @media (max-width: 767px) {
            section.cta-section {
                padding-top: 5rem;
                padding-bottom: 5rem;
            }
        }
    </style>
    <!-- Background Image -->
    <div class="absolute bottom-0 right-0 hidden lg:block pointer-events-none z-0 cta-bg-image" style="right: 0; width: 25%;">
        <img src="{{ asset('storage/home_page/search_job/cta.png') }}" alt="Background" class="w-full h-auto object-cover" style="object-position: right bottom;">
    </div>
    <style>
        /* Desktop image size */
        @media (min-width: 1024px) {
            .cta-bg-image {
                width: 25% !important;
            }
        }
        
        /* Tablet - smaller image */
        @media (min-width: 768px) and (max-width: 1023px) {
            .cta-bg-image {
                width: 20% !important;
            }
        }
    </style>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl mx-auto">
            <!-- Card -->
            <div class="p-6 sm:p-8 md:p-12 rounded-lg text-center" style="background-color: rgba(43, 43, 43, 0.73); border-radius: 10px; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid transparent; border-image: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) 1; border-image-slice: 1;">
                    <!-- Title -->
                    <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-3xl font-bold mb-4 sm:mb-6" style="color: #d9d9d9; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                        Prêt(e) à trouver votre prochain emploi ?
                    </h2>
                    
                    <!-- Description -->
                    <p class="text-base sm:text-lg mb-6 sm:mb-8 max-w-2xl mx-auto px-2 sm:px-4 md:px-8" style="color: #d9d9d9;">
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
    </div>
</section>
