@php
$partners = [
    [
        'id' => 1,
        'name' => 'Air Algérie',
        'logo' => asset('partners/air-algerie.png'),
        'is_featured' => true,
    ],
    [
        'id' => 2,
        'name' => 'Algérie Télécom',
        'logo' => asset('partners/algerie-telecom.png'),
        'is_featured' => true,
    ],
    [
        'id' => 3,
        'name' => 'Benamor',
        'logo' => asset('partners/benamor.png'),
        'is_featured' => true,
    ],
    [
        'id' => 4,
        'name' => 'BNA',
        'logo' => asset('partners/bna.png'),
        'is_featured' => true,
    ],
    [
        'id' => 5,
        'name' => 'Cevital',
        'logo' => asset('partners/cevital.png'),
        'is_featured' => true,
    ],
    [
        'id' => 6,
        'name' => 'Djezzy',
        'logo' => asset('partners/djezzy.png'),
        'is_featured' => true,
    ],
    [
        'id' => 7,
        'name' => 'ENTP',
        'logo' => asset('partners/entp.png'),
        'is_featured' => true,
    ],
    [
        'id' => 8,
        'name' => 'Mobilis',
        'logo' => asset('partners/mobilis.png'),
        'is_featured' => true,
    ],
    [
        'id' => 9,
        'name' => 'Ooredoo',
        'logo' => asset('partners/ooredoo.png'),
        'is_featured' => true,
    ],
    [
        'id' => 10,
        'name' => 'Sonelgaz',
        'logo' => asset('partners/sonelgaz.png'),
        'is_featured' => true,
    ],
];
@endphp

<section class="relative py-16 overflow-hidden bg-[#e0e3df] dark:bg-[#1f1f1f]">
    <div class="absolute inset-0 bg-[#00b6b4]/5 dark:bg-[#00b6b4]/5 mix-blend-overlay animate-pulse-slow"></div>
    <div class="relative container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 dark:text-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">Nos partenaires de confiance</h2>
            <p class="text-gray-600 dark:text-gray-400">Ils nous font confiance pour trouver leurs talents</p>
        </div>
        
        <!-- Mobile Swiper -->
        <div class="block md:hidden">
            <div class="swiper partners-swiper">
                <div class="swiper-wrapper">
                    @for($i = 0; $i < count($partners); $i += 4)
                    <div class="swiper-slide">
                        <div class="grid grid-cols-2 gap-4">
                            @for($j = $i; $j < min($i + 4, count($partners)); $j++)
                                @php $partner = $partners[$j]; @endphp
                                <div class="relative w-full h-32 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-3 hover:-translate-y-2">
                                    <div class="w-full h-full rounded-2xl bg-white/80 dark:bg-[#2b2b2b]/80 backdrop-blur-sm shadow-lg flex items-center justify-center overflow-hidden p-4">
                                        <img 
                                            src="{{ $partner['logo'] }}" 
                                            alt="{{ $partner['name'] }}" 
                                            class="w-full h-full object-contain filter drop-shadow-sm dark:brightness-90" 
                                        />
                                    </div>
                                    <div class="absolute -bottom-4 bg-white/80 dark:bg-[#2b2b2b]/80 backdrop-blur-sm px-3 py-1 text-xs rounded-full shadow-md text-gray-800 dark:text-gray-200 font-medium">
                                        {{ $partner['name'] }}
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    @endfor
                </div>
                <!-- Mobile Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Desktop Grid -->
        <div class="hidden md:flex flex-wrap justify-center gap-8">
            @foreach($partners as $index => $partner)
            <div class="relative w-32 h-32 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:rotate-3 hover:-translate-y-2">
                <div class="w-full h-full rounded-2xl bg-white/80 dark:bg-[#2b2b2b]/80 backdrop-blur-sm shadow-lg flex items-center justify-center overflow-hidden p-4">
                    <img 
                        src="{{ $partner['logo'] }}" 
                        alt="{{ $partner['name'] }}" 
                        class="w-full h-full object-contain filter drop-shadow-sm dark:brightness-90" 
                    />
                </div>
                <div class="absolute -bottom-4 bg-white/80 dark:bg-[#2b2b2b]/80 backdrop-blur-sm px-3 py-1 text-xs rounded-full shadow-md text-gray-800 dark:text-gray-200 font-medium">
                    {{ $partner['name'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
/* Partners swiper default height - same as desktop */
.partners-swiper {
    height: 340px !important;
}

.partners-swiper .swiper-wrapper {
    height: 340px !important;
}

.partners-swiper .swiper-slide {
    height: 340px !important;
}



/* Custom pagination positioning and styling for partners */
.partners-swiper .swiper-pagination-bullets.swiper-pagination-horizontal {
    position: absolute !important;
    bottom: 10px !important;
    top: auto !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    width: auto !important;
    margin-top: 0 !important;
}

.partners-swiper .swiper-pagination-bullet {
    width: 8px !important;
    height: 8px !important;
    background-color: #d1d5db !important; /* gray-300 */
    opacity: 1 !important;
    transition: all 0.2s ease !important;
}

.partners-swiper .swiper-pagination-bullet-active {
    background-color: #00b6b4 !important; /* teal color */
    transform: scale(1.2) !important;
}

/* Dark mode pagination for partners */
.dark .partners-swiper .swiper-pagination-bullet {
    background-color: #4b5563 !important; /* gray-600 */
}

.dark .partners-swiper .swiper-pagination-bullet-active {
    background-color: #00b6b4 !important; /* teal color */
}
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper for partners section
    const partnersSwiper = new Swiper('.partners-swiper', {
        direction: 'horizontal',
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.partners-swiper .swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        loop: true,
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            }
        }
    });
});
</script>
