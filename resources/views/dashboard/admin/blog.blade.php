@extends('layouts.dashboard')

@section('page-title', 'Blog')
@section('description', 'Créez et gérez les articles du blog')

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Gestion du Blog
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-2">
                Créez et gérez les articles du blog
            </p>
        </div>
        <a 
            href="{{ route('admin.blog.editor') }}"
            class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 sm:px-6 py-2 sm:py-3 flex items-center gap-2 rounded-lg transition-colors text-sm sm:text-base"
        >
            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
                <path d="M12 5v14"/>
            </svg>
            <span class="hidden sm:inline">Nouvel article</span>
            <span class="sm:hidden">Nouvel</span>
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Total articles</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">2</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(0 86 84 / 0.3);">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(80 178 255 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                        <path d="M7 7h.01"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Publiés</p>
                    <p class="text-xl sm:text-2xl font-bold" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1));">2</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(20 83 45 / 0.3);">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(22 163 74 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Brouillons</p>
                    <p class="text-xl sm:text-2xl font-bold" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));">0</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center" style="background-color: rgb(113 63 18 / 0.3);">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" style="color: rgb(202 138 4 / var(--tw-text-opacity, 1));" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Vues totales</p>
                    <p class="text-xl sm:text-2xl font-bold text-blue-600">288</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher un article..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    id="search-input"
                    onkeyup="filterArticles()"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <select
                    id="status-filter"
                    onchange="filterArticles()"
                    class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                >
                    <option value="">Tous les statuts</option>
                    <option value="published">Publié</option>
                    <option value="draft">Brouillon</option>
                </select>
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                    <path d="M7 7h.01"/>
                </svg>
                <select
                    id="category-filter"
                    onchange="filterArticles()"
                    class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                >
                    <option value="">Toutes les catégories</option>
                    <option value="Conseils">Conseils</option>
                    <option value="Formation">Formation</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Blog Posts List --}}
    <div class="space-y-6">
        @php
        $posts = [
            [
                'id' => 1,
                'title' => 'Comment rédiger un CV qui attire l\'attention des recruteurs',
                'excerpt' => 'Découvrez les secrets pour créer un CV percutant qui vous démarque de la concurrence et attire l\'œil des recruteurs.',
                'image' => 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'category' => 'Conseils',
                'date' => '15 Janvier 2024',
                'author' => 'Sarah Benali',
                'readTime' => '5 min',
                'slug' => 'comment-rediger-cv-attire-attention-recruteurs',
                'tags' => ['CV', 'Recrutement', 'Conseils'],
                'status' => 'draft',
                'views' => 156,
            ],
            [
                'id' => 2,
                'title' => 'Les compétences digitales les plus recherchées en 2024',
                'excerpt' => 'Explorez les compétences numériques essentielles que les entreprises recherchent activement cette année.',
                'image' => 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=1200',
                'category' => 'Formation',
                'date' => '12 Janvier 2024',
                'author' => 'Ahmed Belkacem',
                'readTime' => '7 min',
                'slug' => 'competences-digitales-recherchees-2024',
                'tags' => ['Compétences', 'Digital', 'Tendances'],
                'status' => 'published',
                'views' => 132,
            ],
        ];
        @endphp

        @foreach($posts as $post)
        <div class="article-card bg-[#2b2b2b] border border-[#333333] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300" data-status="{{ $post['status'] }}" data-category="{{ $post['category'] }}" data-title="{{ strtolower($post['title']) }}" data-excerpt="{{ strtolower($post['excerpt']) }}" data-author="{{ strtolower($post['author']) }}">
            <div class="flex flex-col lg:flex-row gap-4 sm:gap-6">
                {{-- Featured Image --}}
                <div class="lg:w-48 h-32 sm:h-40 rounded-xl overflow-hidden flex-shrink-0">
                    <img
                        src="{{ $post['image'] }}"
                        alt="{{ $post['title'] }}"
                        class="w-full h-full object-cover"
                    />
                </div>
                
                {{-- Content --}}
                <div class="flex-1">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] hover:text-[#00b6b4] transition-colors">
                                {{ $post['title'] }}
                            </h3>
                            <div class="flex items-center gap-3 sm:gap-4 text-xs sm:text-sm text-[#9ca3af] mt-1">
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    <span>{{ $post['author'] }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    <span>{{ $post['date'] }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                        <path d="M7 7h.01"/>
                                    </svg>
                                    <span>{{ $post['category'] }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-medium flex-shrink-0 {{ $post['status'] === 'published' ? '' : '' }}" style="{{ $post['status'] === 'published' ? 'background-color: rgb(20 83 45 / 0.3); color: rgb(22 163 74 / var(--tw-text-opacity, 1));' : 'background-color: rgb(113 63 18 / 0.3); color: rgb(202 138 4 / var(--tw-text-opacity, 1));' }}">
                            {{ $post['status'] === 'published' ? 'Publié' : 'Brouillon' }}
                        </span>
                    </div>
                    
                    <p class="text-sm sm:text-base text-[#9ca3af] mb-3 sm:mb-4 line-clamp-2">
                        {{ $post['excerpt'] }}
                    </p>
                    
                    <div class="flex flex-wrap gap-1 sm:gap-2 mb-3 sm:mb-4">
                        @foreach($post['tags'] as $tag)
                        <span class="px-2 py-1 bg-[#333333] text-[#9ca3af] rounded-full text-xs">
                            {{ $tag }}
                        </span>
                        @endforeach
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="flex items-center gap-3 sm:gap-4 text-xs sm:text-sm text-[#9ca3af]">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <span>{{ $post['views'] }} vues</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                <span>{{ $post['readTime'] }}</span>
                            </div>
                        </div>
                        
                        {{-- Actions --}}
                        <div class="flex items-center gap-2 sm:gap-3">
                            <button
                                onclick="editArticle({{ json_encode($post) }})"
                                class="p-2 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] hover:bg-[#333333] transition-colors duration-200"
                            >
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 20h9"/>
                                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                </svg>
                            </button>
                            
                            <button
                                onclick="toggleArticleStatus({{ $post['id'] }}, this)"
                                class="p-2 rounded-lg"
                                style="{{ $post['status'] === 'published' ? 'background-color: rgb(113 63 18 / 0.3); color: rgb(202 138 4 / var(--tw-text-opacity, 1));' : 'background-color: rgb(20 83 45 / 0.3); color: rgb(22 163 74 / var(--tw-text-opacity, 1));' }}"
                            >
                                @if($post['status'] === 'published')
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/>
                                        <path d="M3 3l18 18"/>
                                        <path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                @endif
                            </button>
                            
                            <button
                                onclick="deleteArticle({{ $post['id'] }}, '{{ $post['title'] }}')"
                                class="p-2 rounded-lg transition-colors duration-200 text-[#9ca3af] hover:bg-red-900/20 hover:text-red-600"
                            >
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10" x2="10" y1="11" y2="17"/>
                                    <line x1="14" x2="14" y1="11" y2="17"/>
                                </svg>
                            </button>
                            
                            <button
                                onclick="viewArticle('{{ $post['slug'] }}')"
                                class="p-2 rounded-lg bg-[#00b6b4] text-white hover:bg-[#009e9c] transition-colors duration-200"
                            >
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        <div id="no-results" class="text-center py-12 hidden">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                <path d="M7 7h.01"/>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">
                Aucun article trouvé
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Essayez de modifier vos critères de recherche
            </p>
        </div>
    </div>
</div>

{{-- Toast Notifications --}}
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

<script>
function filterArticles() {
    const searchValue = document.getElementById('search-input').value.toLowerCase();
    const statusFilter = document.getElementById('status-filter').value;
    const categoryFilter = document.getElementById('category-filter').value;
    const cards = document.querySelectorAll('.article-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const title = card.getAttribute('data-title');
        const excerpt = card.getAttribute('data-excerpt');
        const author = card.getAttribute('data-author');
        const status = card.getAttribute('data-status');
        const category = card.getAttribute('data-category');
        
        const matchesSearch = title.includes(searchValue) || excerpt.includes(searchValue) || author.includes(searchValue);
        const matchesStatus = statusFilter === '' || status === statusFilter;
        const matchesCategory = categoryFilter === '' || category === categoryFilter;
        
        if (matchesSearch && matchesStatus && matchesCategory) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('no-results').classList.toggle('hidden', visibleCount > 0);
}

function toggleArticleStatus(id, button) {
    const card = button.closest('.article-card');
    const isPublished = card.getAttribute('data-status') === 'published';
    const title = card.querySelector('h3').textContent;
    
    card.setAttribute('data-status', isPublished ? 'draft' : 'published');
    
    if (isPublished) {
        button.className = 'p-2 rounded-lg';
        button.style.backgroundColor = 'rgb(113 63 18 / 0.3)';
        button.style.color = 'rgb(202 138 4 / var(--tw-text-opacity, 1))';
        button.innerHTML = '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/><path d="M3 3l18 18"/><path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/></svg>';
        showToast('Article masqué', `L'article "${title}" a été retiré du site`, 'success');
    } else {
        button.className = 'p-2 rounded-lg';
        button.style.backgroundColor = 'rgb(20 83 45 / 0.3)';
        button.style.color = 'rgb(22 163 74 / var(--tw-text-opacity, 1))';
        button.innerHTML = '<svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
        showToast('Article publié', `L'article "${title}" est maintenant visible sur le site`, 'success');
    }
    
    filterArticles();
}

function deleteArticle(id, title) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'article "${title}" ?`)) {
        const card = document.querySelector(`[data-id="${id}"]`);
        if (card) {
            card.remove();
            showToast('Article supprimé', `L'article "${title}" a été supprimé avec succès`, 'success');
            filterArticles();
        }
    }
}

function editArticle(article) {
    showToast('Modification', `Ouverture de l'éditeur pour "${article.title}"`, 'success');
}

function viewArticle(slug) {
    window.open(`/blog/${slug}`, '_blank');
}

function showNewArticleModal() {
    showToast('Nouvel article', 'Ouverture de l\'éditeur d\'article', 'success');
}

// Toast notifications
function showToast(title, message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    
    const bgColor = type === 'success' ? 'bg-green-900/30' : 'bg-red-900/30';
    const borderColor = type === 'success' ? 'border-green-500' : 'border-red-500';
    
    toast.className = `${bgColor} border ${borderColor} rounded-lg p-4 max-w-sm shadow-lg backdrop-blur-sm`;
    toast.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                ${type === 'success' ? 
                    '<svg class="w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>' :
                    '<svg class="w-5 h-5 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>'
                }
            </div>
            <div class="flex-1">
                <h4 class="text-sm font-semibold text-[#f5f5f5]">${title}</h4>
                <p class="text-xs text-[#9ca3af] mt-1">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-[#9ca3af] hover:text-[#f5f5f5]">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
        </div>
    `;
    
    container.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.remove();
        }
    }, 5000);
}
</script>
@endsection
