@php
// Use the jobs passed from the controller, or fallback to empty array
$jobs = $jobs ?? collect();
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
            @if($jobs->count() > 0)
            <div class="swiper jobs-swiper">
                <div class="swiper-wrapper">
                    @for($i = 0; $i < $jobs->count(); $i += 2)
                    <div class="swiper-slide">
                        <div class="space-y-4">
                            @for($j = $i; $j < min($i + 2, $jobs->count()); $j++)
                                @php $job = $jobs[$j]; @endphp
                                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-4 shadow-md border border-gray-200 dark:border-[#333333]">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ $job->title }}
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
                                            <span class="font-medium text-gray-700 dark:text-gray-300 text-sm">{{ $job->company->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <!-- MapPin icon from Lucide React -->
                                            <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                                <circle cx="12" cy="10" r="3"></circle>
                                            </svg>
                                            <span class="text-sm">{{ $job->location }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-2 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-xs font-medium">
                                            {{ $job->type }}
                                        </span>
                                        <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                            <!-- Clock icon from Lucide React -->
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12,6 12,12 16,14"></polyline>
                                            </svg>
                                            <span>{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="text-base font-bold text-gray-900 dark:text-gray-100">
                                            @if($job->salary_min && $job->salary_max)
                                                {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                                            @elseif($job->salary_min)
                                                À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                                            @else
                                                Salaire non spécifié
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <a 
                                        href="{{ route('jobs.show', $job->slug) }}"
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
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aucune offre disponible</h3>
                <p class="text-gray-600 dark:text-gray-400">Revenez bientôt pour découvrir de nouvelles opportunités !</p>
            </div>
            @endif
        </div>

        <!-- Desktop Grid -->
        <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-500 border border-gray-200 dark:border-[#333333] hover:-translate-y-2">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-[#00b6b4] transition-colors duration-200">
                        {{ $job->title }}
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
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $job->company->name }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <!-- MapPin icon from Lucide React -->
                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span>{{ $job->location }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <span class="px-3 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-sm font-medium">
                        {{ $job->type }}
                    </span>
                    <div class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400">
                        <!-- Clock icon from Lucide React -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12,6 12,12 16,14"></polyline>
                        </svg>
                        <span>{{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        @if($job->salary_min && $job->salary_max)
                            {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                        @elseif($job->salary_min)
                            À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                        @else
                            Salaire non spécifié
                        @endif
                    </div>
                </div>
                
                <a 
                    href="{{ route('jobs.show', $job->slug) }}"
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
            @empty
            <div class="col-span-full text-center py-12">
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
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Aucune offre disponible</h3>
                <p class="text-gray-600 dark:text-gray-400">Revenez bientôt pour découvrir de nouvelles opportunités !</p>
            </div>
            @endforelse
        </div>
        
        <!-- Mobile Pagination -->
        @if($jobs->count() > 0)
        <div class="block md:hidden text-center mt-6 mb-6">
            <div class="swiper-pagination"></div>
        </div>
        @endif
        
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
