@extends('layouts.app')

@section('title', $blog->title . ' - Blog OMPLEO')
@section('description', $blog->excerpt ?? Str::limit(strip_tags($blog->content), 160))

@section('content')
<!-- Header -->
@include('components.header')

<div class="blog-show-page min-h-screen bg-white dark:bg-[#1f1f1f] pt-0 md:pt-20 relative overflow-x-hidden">
    <!-- Hero Section with Background Image -->
    <div class="w-full h-[60vh] relative overflow-hidden">
        <img 
            src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.pexels.com/photos/3184432/pexels-photo-3184432.jpeg?auto=compress&cs=tinysrgb&w=1200' }}" 
            alt="{{ $blog->title }}" 
            class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        
        <div class="absolute bottom-0 left-0 right-0 p-4 md:p-16 text-white">
        <div class="platform-container">
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-[#0058f0] px-3 py-1 rounded-full text-[0.9375rem] font-medium">
                        {{ $blog->category ?? 'Article' }}
                    </span>
                </div>
                
                <h1 class="font-bold mb-6 leading-tight md:text-5xl lg:text-6xl">
                    {{ $blog->title }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-2.5 md:gap-6 text-white/80 text-xs md:text-[0.9375rem] lg:text-base">
                    <div class="flex items-center gap-2 md:gap-3">
                        <div class="w-8 h-8 md:w-10 md:h-10 rounded-full overflow-hidden bg-white/20 flex items-center justify-center flex-shrink-0">
                            @if($blog->author_avatar)
                                <img 
                                    src="{{ $blog->author_avatar }}" 
                                    alt="{{ $blog->author ?? 'OMPLEO' }}" 
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <div class="font-medium leading-snug">{{ $blog->author ?? 'OMPLEO' }}</div>
                            <div class="text-[0.6875rem] md:text-[0.9375rem] opacity-90 leading-snug">{{ $blog->author_role ?? 'Équipe OMPLEO' }}</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-7 md:h-7 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span class="leading-snug">{{ $blog->created_at->format('d F Y') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-7 md:h-7 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12,6 12,12 16,14"></polyline>
                        </svg>
                        <span class="leading-snug">{{ $blog->reading_time ?? '5 min' }} de lecture</span>
                    </div>
                    
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <svg class="w-4 h-4 md:w-7 md:h-7 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <span class="leading-snug">{{ $blog->views ?? '135' }} vues</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <section class="platform-section relative z-10 blog-show-section">
        <style>
            /* Desktop is default - py-16, grid-cols-3 */
            @media (max-width: 1023px) {
                .blog-show-section {
                    padding-top: 3rem !important;
                    padding-bottom: 3rem !important;
                }
                .blog-show-grid {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>
        <div class="platform-container">
            <div class="grid grid-cols-3 gap-0 lg:gap-8 blog-show-grid">
                <!-- Main Article -->
                <article class="col-span-2 min-w-0">
                    <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-6 lg:p-16">
                        <div class="max-w-none text-gray-600 dark:text-[#9ca3af] text-[0.9375rem] md:text-base leading-relaxed space-y-10 md:space-y-12">
                            @php
                                $decodedContent = null;
                                $rawContent = is_string($blog->content) ? trim($blog->content) : '';
                                $hasHtmlContent = $rawContent !== '' && \Illuminate\Support\Str::contains($rawContent, ['<p', '<h1', '<h2', '<h3', '<h4', '<h5', '<h6', '<img', '<ul', '<ol', '<li', '<blockquote', '<pre', '<code', '<div', '<br', '<hr']);
                                if (is_string($blog->content)) {
                                    $decodedContent = json_decode($blog->content, true);
                                }
                            @endphp

                            @if(is_array($decodedContent) && count($decodedContent) > 0)
                                @foreach($decodedContent as $block)
                                    @if(($block['type'] ?? '') === 'heading')
                                        <div>
                                            <h3 class="font-bold text-gray-900 dark:text-white mb-6 text-lg md:text-xl">{{ $block['content'] ?? '' }}</h3>
                                        </div>
                                    @elseif(($block['type'] ?? '') === 'list' && is_array($block['items'] ?? null))
                                        <div>
                                            <ul class="space-y-4 text-[0.9375rem] md:text-base leading-relaxed">
                                                @foreach($block['items'] as $item)
                                                    <li class="flex items-start gap-3">
                                                        <span class="mt-2 w-1.5 h-1.5 bg-[#00b6b4] rounded-full flex-shrink-0"></span>
                                                        <span>{{ $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @elseif(($block['type'] ?? '') === 'paragraph')
                                        <div class="space-y-6">
                                            <p>{{ $block['content'] ?? '' }}</p>
                                        </div>
                                    @elseif(($block['type'] ?? '') === 'quote')
                                        <div class="space-y-6">
                                            <p><strong class="text-gray-900 dark:text-white">{{ $block['content'] ?? '' }}</strong></p>
                                        </div>
                                    @elseif(($block['type'] ?? '') === 'image' && !empty($block['url']))
                                        <div>
                                            <img src="{{ $block['url'] }}" alt="{{ $block['alt'] ?? $blog->title }}" class="w-full rounded-xl object-cover">
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                @if($hasHtmlContent)
  @if(auth()->check() && auth()->user()->isAdmin())
    @php
        $allowedTags = '<p><br><strong><em><ul><ol><li><blockquote><h2><h3><h4><h5><h6>';
        $stripped = strip_tags((string) $rawContent, $allowedTags);
        // نمنع أي event attributes مثل onclick, onload, onerror
        $safeHtmlContent = preg_replace('/\s*on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]*)/i', '', $stripped);
        // نمنع javascript: في الـ href و src
        $safeHtmlContent = preg_replace('/(href|src)\s*=\s*["\']\s*javascript:[^"\']*["\']/i', '', $safeHtmlContent);
    @endphp
    <div class="space-y-6 blog-content-html text-gray-600 dark:text-[#9ca3af]">
        {!! $safeHtmlContent !!}
    </div>
                                    @else
                                        <div class="space-y-6">
                                            <p>{!! nl2br(e(strip_tags((string) $rawContent))) !!}</p>
                                        </div>
                                    @endif
                                @else
                                    <div class="space-y-6">
                                        <p>{!! nl2br(e((string) $blog->content)) !!}</p>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Tags -->
                        <div class="mt-8 pt-8 border-t border-white/20 dark:border-[#333333]">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @forelse(($blog->tags ?? []) as $tag)
                                    <span class="bg-[#00b6b4]/10 text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium border border-[#00b6b4]/20">{{ $tag }}</span>
                                @empty
                                    <span class="bg-[#00b6b4]/10 text-[#00b6b4] px-3 py-1 rounded-full text-sm font-medium border border-[#00b6b4]/20">OMPLEO</span>
                                @endforelse
                            </div>
                        </div>
                        
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
                <aside class="col-span-1 mt-6 w-full min-w-0 lg:mt-0">
                    <div class="space-y-6 lg:sticky lg:top-24 lg:space-y-8">
                        <!-- Share Buttons -->
                        <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-6 lg:p-8 w-full">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Partager</h3>
                            <div class="space-y-4 blog-share-stack">
                                <button type="button" class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl md:rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                    <span class="font-medium">Twitter</span>
                                </button>
                                
                                <button type="button" class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-blue-800 hover:bg-blue-900 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    <span class="font-medium">LinkedIn</span>
                                </button>
                                
                                <button type="button" id="copyLinkBtn" onclick="copyBlogLink()" class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl bg-gray-600 hover:bg-gray-700 text-white transition-all duration-200 hover:scale-105">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span id="copyLinkText" class="font-medium">Copier le lien</span>
                                </button>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        @if($relatedBlogs->count() > 0)
                        <div class="bg-white/10 dark:bg-[#2b2b2b]/50 backdrop-blur-lg border border-white/20 dark:border-[#333333] rounded-2xl p-6 lg:p-8 w-full">
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

@include('components.footer')

<style>
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

<script>
function copyBlogLink() {
    const url = window.location.href;
    const copyLinkBtn = document.getElementById('copyLinkBtn');
    const copyLinkText = document.getElementById('copyLinkText');
    
    // Use the Clipboard API if available
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(function() {
            // Success feedback
            copyLinkText.textContent = 'Lien copié!';
            copyLinkBtn.classList.remove('bg-gray-600', 'hover:bg-gray-700');
            copyLinkBtn.classList.add('bg-green-600');
            
            // Reset after 2 seconds
            setTimeout(function() {
                copyLinkText.textContent = 'Copier le lien';
                copyLinkBtn.classList.remove('bg-green-600');
                copyLinkBtn.classList.add('bg-gray-600', 'hover:bg-gray-700');
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            fallbackCopyTextToClipboard(url, copyLinkText, copyLinkBtn);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyTextToClipboard(url, copyLinkText, copyLinkBtn);
    }
}

function fallbackCopyTextToClipboard(text, textElement, buttonElement) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.width = "2em";
    textArea.style.height = "2em";
    textArea.style.padding = "0";
    textArea.style.border = "none";
    textArea.style.outline = "none";
    textArea.style.boxShadow = "none";
    textArea.style.background = "transparent";
    
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            textElement.textContent = 'Lien copié!';
            buttonElement.classList.remove('bg-gray-600', 'hover:bg-gray-700');
            buttonElement.classList.add('bg-green-600');
            
            setTimeout(function() {
                textElement.textContent = 'Copier le lien';
                buttonElement.classList.remove('bg-green-600');
                buttonElement.classList.add('bg-gray-600', 'hover:bg-gray-700');
            }, 2000);
        }
    } catch (err) {
        console.error('Fallback: Failed to copy', err);
    }
    
    document.body.removeChild(textArea);
}
</script>
@endsection