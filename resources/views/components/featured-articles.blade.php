@php
// Use the featuredBlogs passed from the controller, or fallback to empty collection
$articles = $featuredBlogs ?? collect();
@endphp

<section class="py-16 bg-[#e0e3df] dark:bg-[#1f1f1f]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                À la <span class="text-[#00b6b4] dark:text-[#00b6b4]">une</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Découvrez nos derniers articles et conseils pour booster votre carrière
            </p>
        </div>

        <div class="relative">
            <!-- Carousel -->
            <div class="overflow-hidden rounded-2xl shadow-lg">
                <div id="articlesCarousel" class="flex transition-transform duration-500 ease-in-out h-[500px]">
                    @forelse($articles as $index => $article)
                    <div class="w-full flex-shrink-0 relative">
                        <img 
                            src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=400' }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover dark:opacity-90"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <div class="flex items-center gap-4 mb-3 text-sm">
                                <div class="flex items-center gap-1">
                                    <!-- Calendar icon from Lucide React -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>{{ $article->created_at->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <!-- User icon from Lucide React -->
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>{{ $article->author ?? 'OMPLEO' }}</span>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl md:text-3xl font-bold mb-3">
                                {{ $article->title }}
                            </h3>
                            
                            <p class="text-white/80 mb-4 line-clamp-2">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 150) }}
                            </p>
                            
                            <a 
                                href="{{ route('blog.show', $article->slug) }}"
                                class="inline-flex items-center gap-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105"
                            >
                                Lire l'article
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="w-full flex-shrink-0 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#00b6b4] to-[#009e9c]"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <div class="w-16 h-16 mx-auto mb-4 text-white/80">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 text-center">
                                Aucun article disponible
                            </h3>
                            <p class="text-white/80 mb-4 text-center">
                                Revenez bientôt pour découvrir nos derniers articles et conseils !
                            </p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button
                onclick="prevSlide()"
                class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white/80 dark:bg-[#2b2b2b]/80 hover:bg-white dark:hover:bg-[#333333] text-gray-800 dark:text-gray-200 p-3 rounded-full shadow-lg z-10 transition-all duration-300 hover:scale-110"
            >
                <!-- ChevronLeft icon from Lucide React -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="15,18 9,12 15,6"></polyline>
                </svg>
            </button>
            
            <button
                onclick="nextSlide()"
                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white/80 dark:bg-[#2b2b2b]/80 hover:bg-white dark:hover:bg-[#333333] text-gray-800 dark:text-gray-200 p-3 rounded-full shadow-lg z-10 transition-all duration-300 hover:scale-110"
            >
                <!-- ChevronRight icon from Lucide React -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="9,18 15,12 9,6"></polyline>
                </svg>
            </button>

            <!-- Dots Indicator -->
            @if($articles->count() > 0)
            <div class="flex justify-center mt-6 space-x-2">
                @foreach($articles as $index => $article)
                <button
                    onclick="setCurrentSlide({{ $index }})"
                    id="dot-{{ $index }}"
                    class="w-3 h-3 rounded-full transition-colors duration-200 {{ $index === 0 ? 'bg-[#00b6b4]' : 'bg-gray-300 dark:bg-gray-600' }}"
                ></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

<script>
let currentSlide = 0;
const totalSlides = {{ count($articles) }};

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateCarousel();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

function setCurrentSlide(index) {
    currentSlide = index;
    updateCarousel();
}

function updateCarousel() {
    const carousel = document.getElementById('articlesCarousel');
    carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
    
    // Update dots
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.getElementById(`dot-${i}`);
        if (i === currentSlide) {
            dot.classList.remove('bg-gray-300', 'dark:bg-gray-600');
            dot.classList.add('bg-[#00b6b4]');
        } else {
            dot.classList.remove('bg-[#00b6b4]');
            dot.classList.add('bg-gray-300', 'dark:bg-gray-600');
        }
    }
}

// Auto-slide every 5 seconds
setInterval(() => {
    nextSlide();
}, 5000);
</script>
