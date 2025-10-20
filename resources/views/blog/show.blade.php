@extends('layouts.app')

@section('title', $blog->title . ' - Blog OMPLEO')
@section('description', $blog->excerpt ?? Str::limit(strip_tags($blog->content), 160))

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20 relative overflow-hidden">
    <!-- Background Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="liquid-shape w-96 h-96 bg-[#00b6b4]/10 top-20 -left-20"></div>
        <div class="liquid-shape w-80 h-80 bg-[#00b6b4]/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
    </div>

    <!-- Hero Section with Background Image -->
    <div class="w-full h-[60vh] relative overflow-hidden">
        <img 
            src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=1200' }}" 
            alt="{{ $blog->title }}" 
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16 text-white">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-[#0058f0] px-3 py-1 rounded-full text-sm font-medium">
                        {{ $blog->category ?? 'Article' }}
                    </span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                    {{ $blog->title }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-white/80">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden bg-white/20 flex items-center justify-center">
                            @if($blog->author_avatar)
                                <img 
                                    src="{{ $blog->author_avatar }}" 
                                    alt="{{ $blog->author ?? 'OMPLEO' }}" 
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <div class="font-medium">{{ $blog->author ?? 'OMPLEO' }}</div>
                            <div class="text-sm">{{ $blog->author_role ?? 'Équipe OMPLEO' }}</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>{{ $blog->created_at->format('d F Y') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12,6 12,12 16,14"></polyline>
                        </svg>
                        <span>{{ $blog->reading_time ?? '5 min' }} de lecture</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <span>{{ $blog->views ?? '135' }} vues</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-16 relative z-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Main Article -->
                <article class="lg:col-span-2">
                    <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-8 lg:p-16">
                        <div class="prose prose-xl max-w-none dark:prose-invert prose-headings:font-bold prose-p:leading-relaxed prose-p:text-lg">
                            {!! $blog->content !!}
                        </div>
                        
                        <!-- Tags -->
                        @if($blog->tags && count($blog->tags) > 0)
                        <div class="mt-8 pt-8 border-t border-white/20 dark:border-[#333333]">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($blog->tags as $tag)
                                <span class="bg-[#00b6b4]/10 text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium border border-[#00b6b4]/20">
                                    {{ $tag }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Author Bio -->
                        <div class="mt-8 pt-8 border-t border-white/20 dark:border-[#333333]">
                            <div class="flex items-start gap-4">
                                <div class="w-16 h-16 bg-[#00b6b4]/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-8 h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $blog->author ?? 'OMPLEO' }}</h4>
                                    <p class="text-[#00b6b4] text-sm mb-2">{{ $blog->author_role ?? 'Équipe OMPLEO' }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        {{ $blog->author_bio ?? 'Expert en recrutement et carrière, partageant des conseils pratiques pour vous aider à réussir professionnellement.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 mt-8 lg:mt-0">
                    <div class="sticky top-24 space-y-8">
                        <!-- Share Buttons -->
                        <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-8">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Partager</h3>
                            <div class="space-y-4">
                                <button class="w-full flex items-center justify-center gap-3 p-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                    <span class="font-medium">Twitter</span>
                                </button>
                                
                                <button class="w-full flex items-center justify-center gap-3 p-4 rounded-xl bg-blue-800 hover:bg-blue-900 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    <span class="font-medium">LinkedIn</span>
                                </button>
                                
                                <button class="w-full flex items-center justify-center gap-3 p-4 rounded-xl bg-gray-600 hover:bg-gray-700 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">Copier le lien</span>
                                </button>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        @if($relatedBlogs->count() > 0)
                        <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-8">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Articles similaires</h3>
                            <div class="space-y-6">
                                @foreach($relatedBlogs as $relatedBlog)
                                <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="block group">
                                    <div class="flex gap-4">
                                        <div class="w-20 h-20 bg-gray-200 dark:bg-[#333333] rounded-xl overflow-hidden flex-shrink-0">
                                            <img 
                                                src="{{ $relatedBlog->featured_image ? asset('storage/' . $relatedBlog->featured_image) : 'https://images.pexels.com/photos/3184454/pexels-photo-3184454.jpeg?auto=compress&cs=tinysrgb&w=100' }}"
                                                alt="{{ $relatedBlog->title }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                            />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-base font-medium text-gray-900 dark:text-gray-100 group-hover:text-[#00b6b4] transition-colors duration-200 line-clamp-2 mb-2">
                                                {{ $relatedBlog->title }}
                                            </h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                                {{ Str::limit(strip_tags($relatedBlog->content), 80) }}
                                            </p>
                                            <div class="flex items-center gap-2 text-xs text-gray-400 dark:text-gray-500">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                                <span>{{ $relatedBlog->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>
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

.prose {
    color: #374151;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
}

.prose h2 {
    font-size: 1.5rem;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h3 {
    font-size: 1.25rem;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}

.prose p {
    margin-bottom: 1rem;
    line-height: 1.7;
}

.prose ul, .prose ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose strong {
    font-weight: 600;
    color: #00b6b4;
}

.prose a {
    color: #00b6b4;
    text-decoration: none;
}

.prose a:hover {
    text-decoration: underline;
}

.dark .prose {
    color: #d1d5db;
}

.dark .prose h1, .dark .prose h2, .dark .prose h3, .dark .prose h4, .dark .prose h5, .dark .prose h6 {
    color: #f9fafb;
}

.dark .prose strong {
    color: #00b6b4;
}

.dark .prose a {
    color: #00b6b4;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection