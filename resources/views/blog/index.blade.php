@extends('layouts.app')

@section('title', 'Blog - OMPLEO')
@section('description', 'Restez informé des dernières tendances emploi, conseils carrière et actualités du recrutement')

@section('content')
<!-- Header -->
@include('components.header')

@php
$blogPosts = [
    [
        'id' => 1,
        'title' => 'Comment rédiger un CV qui attire l\'attention des recruteurs',
        'excerpt' => 'Découvrez les secrets pour créer un CV percutant qui vous démarque de la concurrence et attire l\'œil des recruteurs.',
        'content' => '<p>Dans le monde compétitif d\'aujourd\'hui, votre CV est souvent votre première impression auprès des recruteurs. Il est crucial de le rendre mémorable et efficace.</p><h2>1. Structure claire et professionnelle</h2><p>Un CV bien structuré facilite la lecture et permet aux recruteurs de trouver rapidement les informations importantes.</p>',
        'image' => 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=400',
        'category' => 'Conseils',
        'date' => '15 Janvier 2024',
        'author' => 'Sarah Benali',
        'authorRole' => 'Experte en Recrutement',
        'authorAvatar' => 'https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg?auto=compress&cs=tinysrgb&w=100',
        'readTime' => '5 min',
        'slug' => 'comment-rediger-cv-attire-attention-recruteurs',
        'tags' => ['CV', 'Recrutement', 'Conseils'],
        'status' => 'published',
    ],
    [
        'id' => 2,
        'title' => 'Les compétences digitales les plus recherchées en 2024',
        'excerpt' => 'Explorez les compétences numériques essentielles que les entreprises recherchent activement cette année.',
        'content' => '<p>Le marché du travail évolue rapidement et les compétences digitales sont de plus en plus demandées. Voici les compétences les plus recherchées en 2024.</p><h2>1. Intelligence artificielle et Machine Learning</h2><p>Les professionnels capables de travailler avec l\'IA et le ML sont très demandés dans tous les secteurs.</p>',
        'image' => 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=400',
        'category' => 'Formation',
        'date' => '12 Janvier 2024',
        'author' => 'Ahmed Belkacem',
        'authorRole' => 'Consultant Digital',
        'authorAvatar' => 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=100',
        'readTime' => '7 min',
        'slug' => 'competences-digitales-recherchees-2024',
        'tags' => ['Compétences', 'Digital', 'Tendances'],
        'status' => 'published',
    ],
    [
        'id' => 3,
        'title' => 'Préparer son entretien d\'embauche : guide complet',
        'excerpt' => 'Un guide détaillé pour réussir votre entretien d\'embauche, de la préparation aux questions fréquentes.',
        'content' => '<p>L\'entretien d\'embauche est une étape cruciale dans votre recherche d\'emploi. Voici comment vous y préparer efficacement.</p><h2>1. Recherchez l\'entreprise</h2><p>Renseignez-vous sur l\'entreprise, sa culture, ses produits et services, et ses valeurs.</p>',
        'image' => 'https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&w=400',
        'category' => 'Emploi',
        'date' => '10 Janvier 2024',
        'author' => 'Fatima Zohra',
        'authorRole' => 'Responsable RH',
        'authorAvatar' => 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=100',
        'readTime' => '6 min',
        'slug' => 'preparer-entretien-embauche-guide-complet',
        'tags' => ['Entretien', 'Emploi', 'Conseils'],
        'status' => 'published',
    ],
];

$categories = [
    ['name' => 'Tous', 'value' => ''],
    ['name' => 'Formation', 'value' => 'Formation'],
    ['name' => 'Emploi', 'value' => 'Emploi'],
    ['name' => 'Conseils', 'value' => 'Conseils'],
];

$tags = [
    ['name' => 'Tous', 'value' => ''],
    ['name' => 'CV', 'value' => 'CV'],
    ['name' => 'Entretien', 'value' => 'Entretien'],
    ['name' => 'Compétences', 'value' => 'Compétences'],
    ['name' => 'Carrière', 'value' => 'Carrière'],
    ['name' => 'Télétravail', 'value' => 'Télétravail'],
    ['name' => 'Formation', 'value' => 'Formation'],
];
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="liquid-shape w-96 h-96 bg-[#00b6b4]/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-[#00b6b4]/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20  relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-semibold mb-4 sm:mb-6" data-animate="hero-title">
                Conseils emploi, carrière & recrutement
            </h1>
            <p class="text-base sm:text-lg md:text-xl opacity-90 max-w-2xl mx-auto px-4" data-animate="hero-subtitle">
                Restez informé des dernières tendances emploi, conseils carrière et actualités du recrutement
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1 mb-8 lg:mb-0" data-animate="sidebar">
                <div class="glass-card sticky top-24">
                    <!-- Search -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Rechercher</h3>
                        <div class="relative">
                            <!-- Search icon from Lucide React -->
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input
                                type="text"
                                placeholder="Rechercher un article..."
                                class="liquid-glass-input w-full pl-10 pr-4 py-3"
                                id="search-input"
                            />
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Catégories</h3>
                        <div class="space-y-2">
                            @foreach($categories as $category)
                            <button
                                class="category-filter w-full text-left px-4 py-2 rounded-lg transition-colors duration-200 {{ request('category') == $category['value'] ? 'bg-primary-50/50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 font-medium' : 'text-gray-700 dark:text-gray-300 hover:bg-primary-50/50 hover:text-primary-600 dark:hover:bg-primary-900/30 dark:hover:text-primary-400' }}"
                                data-category="{{ $category['value'] }}"
                            >
                                {{ $category['name'] }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tags -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                            <button
                                class="tag-filter px-3 py-1 rounded-full text-sm transition-colors duration-200 {{ request('tag') == $tag['value'] ? 'bg-primary-50/50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 font-medium border border-primary-200/30 dark:border-primary-700/30' : 'glass-badge hover:bg-primary-50/50 hover:text-primary-600 dark:hover:bg-primary-900/30 dark:hover:text-primary-400' }}"
                                data-tag="{{ $tag['value'] }}"
                            >
                                {{ $tag['name'] }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8" id="blog-posts">
                    @foreach($blogPosts as $post)
                    <article class="liquid-glass-card group hover:-translate-y-2 transition-all duration-300" data-animate="blog-post">
                        <div class="relative h-48 overflow-hidden rounded-t-2xl">
                            <img
                                src="{{ $post['image'] }}"
                                alt="{{ $post['title'] }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            />
                            <div class="absolute top-4 left-4">
                                <span class="glass-badge-highlight">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4 sm:p-6">
                            <a href="{{ route('blog.show', $post['slug']) }}">
                                <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2 sm:mb-3 line-clamp-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200">
                                    {{ $post['title'] }}
                                </h2>
                            </a>
                            
                            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-3 sm:mb-4 line-clamp-3">
                                {{ $post['excerpt'] }}
                            </p>
                            
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-4 gap-2 sm:gap-0">
                                <div class="flex items-center gap-2 sm:gap-4">
                                    <div class="flex items-center gap-1">
                                        <!-- User icon from Lucide React -->
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="truncate">{{ $post['author'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <!-- Calendar icon from Lucide React -->
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-accent-500 dark:text-accent-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span class="truncate">{{ $post['date'] }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1">
                                    <!-- Clock icon from Lucide React -->
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-primary-500 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12,6 12,12 16,14"></polyline>
                                    </svg>
                                    <span>{{ $post['readTime'] }}</span>
                                </div>
                            </div>
                            
                            <a 
                                href="{{ route('blog.show', $post['slug']) }}"
                                class="flex items-center gap-2 text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium group/btn"
                            >
                                Lire la suite
                                <!-- ArrowRight icon from Lucide React -->
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M5 12h14"></path>
                                    <path d="m12 5 7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- No Results -->
                <div class="text-center py-12 glass-card hidden" id="no-results">
                    <!-- Search icon from Lucide React -->
                    <svg class="w-16 h-16 text-primary-500 dark:text-primary-400 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                        Aucun article trouvé
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Essayez de modifier vos critères de recherche
                    </p>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12" data-animate="load-more">
                    <button class="glass-button-highlight px-8 py-3">
                        Charger plus d'articles
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
@include('components.footer')

@push('styles')
<style>
[data-animate] {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-animate].animate-fade-in {
    opacity: 1;
    transform: translateY(0);
}

.blog-post {
    transition: all 0.3s ease;
}

.blog-post:hover {
    transform: translateY(-10px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple scroll animations using Intersection Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });

    // Search functionality
    const searchInput = document.getElementById('search-input');
    const blogPosts = document.getElementById('blog-posts');
    const noResults = document.getElementById('no-results');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const posts = blogPosts.querySelectorAll('article');
        let visibleCount = 0;

        posts.forEach(post => {
            const title = post.querySelector('h2').textContent.toLowerCase();
            const excerpt = post.querySelector('p').textContent.toLowerCase();
            const author = post.querySelector('.flex.items-center.gap-1 span').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || excerpt.includes(searchTerm) || author.includes(searchTerm)) {
                post.style.display = 'block';
                visibleCount++;
            } else {
                post.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            blogPosts.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            blogPosts.style.display = 'grid';
            noResults.classList.add('hidden');
        }
    });

    // Category filter
    document.querySelectorAll('.category-filter').forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active state
            document.querySelectorAll('.category-filter').forEach(btn => {
                btn.classList.remove('bg-primary-50/50', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400', 'font-medium');
                btn.classList.add('text-gray-700', 'dark:text-gray-300');
            });
            
            this.classList.remove('text-gray-700', 'dark:text-gray-300');
            this.classList.add('bg-primary-50/50', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400', 'font-medium');
            
            // Filter posts
            filterPosts();
        });
    });

    // Tag filter
    document.querySelectorAll('.tag-filter').forEach(button => {
        button.addEventListener('click', function() {
            const tag = this.dataset.tag;
            
            // Update active state
            document.querySelectorAll('.tag-filter').forEach(btn => {
                btn.classList.remove('bg-primary-50/50', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400', 'font-medium', 'border', 'border-primary-200/30', 'dark:border-primary-700/30');
                btn.classList.add('glass-badge');
            });
            
            this.classList.remove('glass-badge');
            this.classList.add('bg-primary-50/50', 'dark:bg-primary-900/30', 'text-primary-600', 'dark:text-primary-400', 'font-medium', 'border', 'border-primary-200/30', 'dark:border-primary-700/30');
            
            // Filter posts
            filterPosts();
        });
    });

    function filterPosts() {
        const activeCategory = document.querySelector('.category-filter.bg-primary-50\\/50, .category-filter.dark\\:bg-primary-900\\/30')?.dataset.category || '';
        const activeTag = document.querySelector('.tag-filter.bg-primary-50\\/50, .tag-filter.dark\\:bg-primary-900\\/30')?.dataset.tag || '';
        const searchTerm = searchInput.value.toLowerCase();
        
        const posts = blogPosts.querySelectorAll('article');
        let visibleCount = 0;

        posts.forEach(post => {
            const category = post.querySelector('.glass-badge-highlight').textContent;
            const title = post.querySelector('h2').textContent.toLowerCase();
            const excerpt = post.querySelector('p').textContent.toLowerCase();
            const author = post.querySelector('.flex.items-center.gap-1 span').textContent.toLowerCase();
            
            const matchesCategory = activeCategory === '' || category === activeCategory;
            const matchesSearch = searchTerm === '' || title.includes(searchTerm) || excerpt.includes(searchTerm) || author.includes(searchTerm);
            
            if (matchesCategory && matchesSearch) {
                post.style.display = 'block';
                visibleCount++;
            } else {
                post.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            blogPosts.style.display = 'none';
            noResults.classList.remove('hidden');
        } else {
            blogPosts.style.display = 'grid';
            noResults.classList.add('hidden');
        }
    }
});
</script>
@endpush
@endsection

