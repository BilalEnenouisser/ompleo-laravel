@php
use Illuminate\Support\Facades\Storage;
// Use the companies passed from the controller, or fallback to empty array
$companies = $companies ?? collect();
@endphp

<section class="lg:py-20 bg-[#dadad2] dark:bg-[#1f1f1f] relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100">
                Entreprises qui recrutent
            </h2>
        </div>

        @if($companies->count() > 0)
        <!-- Navigation Arrows (Between title and slider) -->
        <div class="flex items-center justify-center gap-3 mb-6">
            <div class="swiper-button-prev companies-swiper-button-prev">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 12H5"></path>
                    <path d="m12 19-7-7 7-7"></path>
                </svg>
            </div>
            <div class="swiper-button-next companies-swiper-button-next">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </div>
        </div>
        <!-- Companies Slider Container - Full width for partial cards -->
        <div class="w-full overflow-hidden">
            <!-- Slider Wrapper with same container constraints -->
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="swiper companiesSwiper -mx-4 sm:-mx-6 lg:-mx-8">
                    <div class="swiper-wrapper px-4 sm:px-6 lg:px-8" style="padding-left: 2rem; padding-right: 2rem;">
                        @foreach($companies as $company)
                        <div class="swiper-slide">
                        <div class="bg-[#141414] rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-[#141414] hover:-translate-y-2 h-full flex flex-col items-center text-center" style="width: 90%;">
                            <!-- Company Logo -->
                            <div class="mb-4 flex items-center justify-center h-20 w-40 mx-auto bg-[#141414] border border-[#9B9B9B] rounded-xl p-3">
                                @if($company->logo)
                                    <img 
                                        src="{{ Storage::url($company->logo) }}" 
                                        alt="{{ $company->name }}" 
                                        class="max-h-12 max-w-full object-contain"
                                    >
                                @else
                                    <div class="w-12 h-12 bg-[#141414] border border-[#9B9B9B] rounded-lg flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">
                                            {{ strtoupper(substr($company->name, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Company Name -->
                            <h3 class="text-lg font-bold text-white mb-2 line-clamp-2">
                                {{ $company->name }}
                            </h3>
                            
                            <!-- Job Count -->
                            <p class="text-lg text-[#9B9B9B]">
                                {{ $company->jobs_count }} {{ $company->jobs_count == 1 ? 'offre d\'emploi' : 'offres d\'emploi' }}
                            </p>
                            
                            <!-- View Offers Button -->
                            <a 
                                href="{{ route('jobs.index', ['company' => $company->id]) }}"
                                class="mt-auto text-sm w-full text-[#9B9B9B] py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-center gap-2 hover:backdrop-blur-md hover:bg-white/5 hover:text-white/80"
                            >
                                Voir ces offres
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                    <path d="M10 6h4"></path>
                    <path d="M10 10h4"></path>
                    <path d="M10 14h4"></path>
                    <path d="M10 18h4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aucune entreprise disponible</h3>
            <p class="text-gray-600 dark:text-gray-400">Revenez bientôt pour découvrir de nouvelles entreprises !</p>
        </div>
        @endif
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
/* Swiper Container */
.companiesSwiper {
    overflow: visible !important;
    padding: 0 !important;
}

.companiesSwiper .swiper-wrapper {
    align-items: stretch;
}

.companiesSwiper .swiper-slide {
    height: auto;
    display: flex;
}

/* Custom Navigation Buttons */
.companies-swiper-button-prev,
.companies-swiper-button-next {
    position: static !important;
    width: 52px !important;
    height: 52px !important;
    margin: 0 !important;
    background: #00b6b4 !important;
    border-radius: 50% !important;
    color: white !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.companies-swiper-button-prev:after,
.companies-swiper-button-next:after {
    display: none !important;
}

.companies-swiper-button-prev svg,
.companies-swiper-button-next svg {
    width: 50% !important;
}

.companies-swiper-button-prev:hover,
.companies-swiper-button-next:hover {
    background: #009e9c !important;
}

.companies-swiper-button-prev.swiper-button-disabled,
.companies-swiper-button-next.swiper-button-disabled {
    opacity: 0.5 !important;
    cursor: not-allowed !important;
}
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper
    const swiper = new Swiper('.companiesSwiper', {
        slidesPerView: 1, // Mobile: 1 card at a time
        spaceBetween: 24, // 1.5rem = 24px
        speed: 500,
        grabCursor: true,
        allowTouchMove: true, // Enable touch on all devices
        navigation: {
            nextEl: '.companies-swiper-button-next',
            prevEl: '.companies-swiper-button-prev',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 12,
            },
            640: {
                slidesPerView: 1.2, // Show 1 full card + 20% of next
                spaceBetween: 12,
            },
            768: {
                slidesPerView: 2.2, // Show 2 full cards + 20% of next
                spaceBetween: 12,
            },
            1024: {
                slidesPerView: 4.4, // Desktop: 4 full cards + 20% partial on edges
                spaceBetween: 12,
            },
        },
    });
});
</script>

