@extends('layouts.app')

@section('title', 'Blog - OMPLEO')
@section('description', 'Découvrez nos derniers articles et conseils pour booster votre carrière')

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="liquid-shape w-96 h-96 bg-[#00b6b4]/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-[#00b6b4]/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl lg:text-5xl font-semibold mb-6">
                Blog OMPLEO
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Restez informé des dernières tendances emploi, conseils carrière et actualités du recrutement
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1 mb-8 lg:mb-0">
                <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-6 sticky top-24">
                    <!-- Search -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Rechercher</h3>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="M21 21l-4.35-4.35"></path>
                            </svg>
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Rechercher un article..."
                                class="w-full pl-10 pr-4 py-3 bg-white/10 dark:bg-[#333333]/50 border border-white/20 dark:border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400"
                            />
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Catégories</h3>
                        <div class="space-y-2">
                            <button onclick="filterByCategory('')" class="category-filter w-full text-left px-4 py-2 rounded-lg transition-colors duration-200 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4] active">
                                Tous
                            </button>
                            <button onclick="filterByCategory('Formation')" class="category-filter w-full text-left px-4 py-2 rounded-lg transition-colors duration-200 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Formation
                            </button>
                            <button onclick="filterByCategory('Emploi')" class="category-filter w-full text-left px-4 py-2 rounded-lg transition-colors duration-200 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Emploi
                            </button>
                            <button onclick="filterByCategory('Conseils')" class="category-filter w-full text-left px-4 py-2 rounded-lg transition-colors duration-200 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Conseils
                            </button>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            <button onclick="filterByTag('')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-[#00b6b4]/10 text-[#00b6b4] font-medium border border-[#00b6b4]/20 active">
                                Tous
                            </button>
                            <button onclick="filterByTag('CV')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                CV
                            </button>
                            <button onclick="filterByTag('Entretien')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Entretien
                            </button>
                            <button onclick="filterByTag('Compétences')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Compétences
                            </button>
                            <button onclick="filterByTag('Carrière')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Carrière
                            </button>
                            <button onclick="filterByTag('Télétravail')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Télétravail
                            </button>
                            <button onclick="filterByTag('Formation')" class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 bg-white/10 dark:bg-[#333333]/50 text-gray-700 dark:text-gray-300 hover:bg-[#00b6b4]/10 hover:text-[#00b6b4] dark:hover:bg-[#00b6b4]/20 dark:hover:text-[#00b6b4]">
                                Formation
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div id="blogContainer" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($blogs as $blog)
                    <article class="blog-card bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=400' }}"
                                alt="{{ $blog->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            />
                            <div class="absolute top-4 left-4">
                                <span class="bg-[#00b6b4]/20 backdrop-blur-sm text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium border border-[#00b6b4]/30">
                                    {{ $blog->category ?? 'Article' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3 line-clamp-2 group-hover:text-[#00b6b4] transition-colors duration-200">
                                    {{ $blog->title }}
                                </h2>
                            </a>
                            
                            <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                                {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span>{{ $blog->author ?? 'OMPLEO' }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>{{ $blog->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12,6 12,12 16,14"></polyline>
                                    </svg>
                                    <span>{{ $blog->reading_time ?? '5 min' }}</span>
                                </div>
                            </div>
                            
                            <a 
                                href="{{ route('blog.show', $blog->slug) }}"
                                class="flex items-center gap-2 text-[#00b6b4] hover:text-[#009e9c] font-medium group/btn"
                            >
                                Lire la suite
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <polyline points="9,18 15,12 9,6"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-2 text-center py-12 bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl">
                        <svg class="w-16 h-16 text-[#00b6b4] mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                            Aucun article trouvé
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Essayez de modifier vos critères de recherche
                        </p>
                    </div>
                    @endforelse
                </div>

                <!-- Load More Button -->
                @if($blogs->count() > 0)
                <div class="text-center mt-12">
                    <button class="bg-[#00b6b4]/10 hover:bg-[#00b6b4]/20 text-[#00b6b4] px-8 py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105 border border-[#00b6b4]/20 hover:border-[#00b6b4]/30">
                        Charger plus d'articles
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
@include('components.footer')

<style>
.liquid-shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(0, 182, 180, 0.1), rgba(0, 158, 156, 0.1));
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.blog-card {
    transition: all 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 182, 180, 0.1);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.category-filter.active,
.tag-filter.active {
    background: rgba(0, 182, 180, 0.1) !important;
    color: #00b6b4 !important;
    font-weight: 500;
}
</style>

<script>
let currentCategory = '';
let currentTag = '';
let currentSearch = '';

function filterByCategory(category) {
    currentCategory = category;
    updateActiveFilters();
    filterBlogs();
}

function filterByTag(tag) {
    currentTag = tag;
    updateActiveFilters();
    filterBlogs();
}

function updateActiveFilters() {
    // Update category buttons
    document.querySelectorAll('.category-filter').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Update tag buttons
    document.querySelectorAll('.tag-filter').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
}

function filterBlogs() {
    const cards = document.querySelectorAll('.blog-card');
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    
    cards.forEach(card => {
        const title = card.querySelector('h2').textContent.toLowerCase();
        const excerpt = card.querySelector('p').textContent.toLowerCase();
        const category = card.querySelector('.bg-\\[\\#00b6b4\\]\\/20').textContent.trim();
        
        const matchesSearch = title.includes(searchTerm) || excerpt.includes(searchTerm);
        const matchesCategory = currentCategory === '' || category === currentCategory;
        const matchesTag = currentTag === '' || card.dataset.tags?.includes(currentTag);
        
        if (matchesSearch && matchesCategory && matchesTag) {
            card.style.display = 'block';
            card.style.animation = 'fadeIn 0.3s ease-in-out';
        } else {
            card.style.display = 'none';
        }
    });
    
    // Show no results message if needed
    const visibleCards = document.querySelectorAll('.blog-card[style*="block"], .blog-card:not([style*="none"])');
    const noResults = document.querySelector('.col-span-2');
    
    if (visibleCards.length === 0 && noResults) {
        noResults.style.display = 'block';
    } else if (noResults) {
        noResults.style.display = 'none';
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    currentSearch = this.value.toLowerCase();
    filterBlogs();
});

// Add fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endsection