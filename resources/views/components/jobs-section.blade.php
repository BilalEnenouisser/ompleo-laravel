@php
$jobs = [
    [
        'id' => 1,
        'title' => 'Community Manager',
        'company' => 'Impactome',
        'type' => 'CDI',
        'location' => 'Alger',
        'workType' => 'Présentiel',
        'postedDate' => 'Il y a 2 jours',
        'salary' => '60,000 - 80,000 DA',
        'slug' => 'community-manager-impactome'
    ],
    [
        'id' => 2,
        'title' => 'Conseiller Commercial',
        'company' => 'Condor',
        'type' => 'CDI',
        'location' => 'Kouba',
        'workType' => 'Hybride',
        'postedDate' => 'Il y a 3 jours',
        'salary' => '70,000 - 90,000 DA',
        'slug' => 'conseiller-commercial-condor'
    ],
    [
        'id' => 3,
        'title' => 'Frontend Developer',
        'company' => 'Impactome',
        'type' => 'CDI',
        'location' => 'Remote',
        'workType' => 'Télétravail',
        'postedDate' => 'Il y a 1 jour',
        'salary' => '80,000 - 120,000 DA',
        'slug' => 'frontend-developer-impactome'
    ],
    [
        'id' => 4,
        'title' => 'Graphic Designer',
        'company' => 'Condor',
        'type' => 'CDI',
        'location' => 'Hydra',
        'workType' => 'Présentiel',
        'postedDate' => 'Il y a 4 jours',
        'salary' => '65,000 - 85,000 DA',
        'slug' => 'graphic-designer-condor'
    ],
    [
        'id' => 5,
        'title' => 'Data Analyst',
        'company' => 'Sonatrach',
        'type' => 'CDI',
        'location' => 'Alger',
        'workType' => 'Hybride',
        'postedDate' => 'Il y a 2 jours',
        'salary' => '90,000 - 130,000 DA',
        'slug' => 'data-analyst-sonatrach'
    ],
    [
        'id' => 6,
        'title' => 'Product Manager',
        'company' => 'Ompleo',
        'type' => 'CDI',
        'location' => 'Remote',
        'workType' => 'Télétravail',
        'postedDate' => 'Il y a 1 jour',
        'salary' => '100,000 - 150,000 DA',
        'slug' => 'product-manager-ompleo'
    ],
];
@endphp

<section class="lg:py-20  bg-[#dadad2] dark:bg-[#1f1f1f] relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 dark:text-gray-100">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Nos Offres d'emploi populaires
            </h2>
        </div>

        <!-- Mobile Swiper -->
        <div class="block md:hidden">
            <div class="swiper jobs-swiper">
                <div class="swiper-wrapper">
                    @for($i = 0; $i < count($jobs); $i += 2)
                    <div class="swiper-slide">
                        <div class="space-y-4">
                            @for($j = $i; $j < min($i + 2, count($jobs)); $j++)
                                @php $job = $jobs[$j]; @endphp
                                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-4 shadow-md border border-gray-200 dark:border-[#333333]">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ $job['title'] }}
                                        </h3>
                                    </div>
                                    
                                    <div class="flex items-center gap-3 text-gray-600 dark:text-gray-400 mb-3">
                                        <div class="flex items-center gap-1">
                                            <!-- Building2 icon from Lucide React -->
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                                <path d="M10 6h4"></path>
                                                <path d="M10 10h4"></path>
                                                <path d="M10 14h4"></path>
                                                <path d="M10 18h4"></path>
                                            </svg>
                                            <span class="font-medium text-gray-700 dark:text-gray-300 text-sm">{{ $job['company'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <!-- MapPin icon from Lucide React -->
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <span class="text-sm">{{ $job['location'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-2 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-xs font-medium">
                                            {{ $job['type'] }}
                                        </span>
                                        <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                            <!-- Clock icon from Lucide React -->
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12,6 12,12 16,14"></polyline>
                                            </svg>
                                            <span>{{ $job['postedDate'] }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-base font-bold text-gray-900 dark:text-gray-100">
                                            {{ $job['salary'] }}
                                        </div>
                                    </div>
                                    
                                    <a 
                                        href="{{ route('jobs.show', $job['slug']) }}"
                                        class="w-full bg-[#00b6b4] text-white py-2 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center gap-2 hover:bg-[#009e9c] shadow-sm text-sm"
                                    >
                                        Voir l'offre
                                        <!-- ArrowRight icon from Lucide React -->
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M5 12h14"></path>
                                            <path d="m12 5 7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Desktop Grid -->
        <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-500 border border-gray-200 dark:border-[#333333] hover:-translate-y-2">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-[#00b6b4] transition-colors duration-200">
                        {{ $job['title'] }}
                    </h3>
                </div>
                
                <div class="flex items-center gap-4 text-gray-600 dark:text-gray-400 mb-3">
                    <div class="flex items-center gap-1">
                        <!-- Building2 icon from Lucide React -->
                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                            <path d="M10 6h4"></path>
                            <path d="M10 10h4"></path>
                            <path d="M10 14h4"></path>
                            <path d="M10 18h4"></path>
                        </svg>
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $job['company'] }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <!-- MapPin icon from Lucide React -->
                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ $job['location'] }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <span class="px-3 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-sm font-medium">
                        {{ $job['type'] }}
                    </span>
                    <div class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400">
                        <!-- Clock icon from Lucide React -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12,6 12,12 16,14"></polyline>
                        </svg>
                        <span>{{ $job['postedDate'] }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        {{ $job['salary'] }}
                    </div>
                </div>
                
                <a 
                    href="{{ route('jobs.show', $job['slug']) }}"
                    class="w-full bg-[#00b6b4] text-white py-3 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center gap-2 hover:bg-[#009e9c] shadow-sm"
                >
                    Voir l'offre
                    <!-- ArrowRight icon from Lucide React -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
        
        <!-- Mobile Pagination -->
        <div class="block md:hidden text-center mt-6 mb-6">
            <div class="swiper-pagination"></div>
        </div>
        
        <div class="text-center mt-12 dark:text-gray-100">
            <a 
                href="{{ route('jobs.index') }}"
                class="inline-flex items-center gap-2 px-8 py-3 bg-white dark:bg-[#2b2b2b] text-[#00b6b4] rounded-xl font-medium border border-[#00b6b4] hover:bg-[#00b6b4] hover:text-white transition-all duration-300"
            >
                Voir toutes les offres
                <!-- ArrowRight icon from Lucide React -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
/* Custom pagination positioning and styling */
.swiper-pagination-bullets.swiper-pagination-horizontal {
    bottom: 60px !important;
    top: auto !important;
    left: 0;
    width: 100%;
}

.swiper-pagination-bullet {
    width: 8px !important;
    height: 8px !important;
    background-color: #d1d5db !important; /* gray-300 */
    opacity: 1 !important;
    transition: all 0.2s ease !important;
}

.swiper-pagination-bullet-active {
    background-color: #00b6b4 !important; /* teal color */
    transform: scale(1.2) !important;
}

/* Dark mode pagination */
.dark .swiper-pagination-bullet {
    background-color: #4b5563 !important; /* gray-600 */
}

.dark .swiper-pagination-bullet-active {
    background-color: #00b6b4 !important; /* teal color */
}
</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Swiper for jobs section
    const jobsSwiper = new Swiper('.jobs-swiper', {
        direction: 'horizontal',
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
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
