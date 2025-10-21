@extends('layouts.dashboard')

@section('page-title', 'Article')
@section('description', 'Aperçu de l\'article')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                {{ $blog->title }}
            </h1>
            <div class="flex items-center gap-4 text-sm text-[#9ca3af] mt-2">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>{{ $blog->author_name }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    <span>{{ $blog->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                        <path d="M7 7h.01"/>
                    </svg>
                    <span>{{ $blog->category }}</span>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $blog->status === 'published' ? 'bg-green-900/30 text-green-400' : 'bg-yellow-900/30 text-yellow-400' }}">
                    {{ $blog->status === 'published' ? 'Publié' : 'Brouillon' }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a 
                href="{{ route('admin.blog.editor.edit', $blog->id) }}"
                class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 py-2 flex items-center gap-2 rounded-lg transition-colors text-sm"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                </svg>
                Modifier
            </a>
            <a 
                href="{{ route('admin.blog') }}"
                class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 flex items-center gap-2 rounded-lg transition-colors text-sm"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                Retour
            </a>
        </div>
    </div>

    {{-- Featured Image --}}
    @if($blog->featured_image)
    <div class="rounded-xl overflow-hidden">
        <img
            src="{{ asset('storage/' . $blog->featured_image) }}"
            alt="{{ $blog->title }}"
            class="w-full h-64 sm:h-80 object-cover"
        />
    </div>
    @endif

    {{-- Blog Content --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-6 sm:p-8">
        {{-- Excerpt --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-[#f5f5f5] mb-3">Résumé</h2>
            <p class="text-[#9ca3af] leading-relaxed">{{ $blog->excerpt }}</p>
        </div>

        {{-- Tags --}}
        @if($blog->tags && count($blog->tags) > 0)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-[#f5f5f5] mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($blog->tags as $tag)
                <span class="px-3 py-1 bg-[#333333] text-[#9ca3af] rounded-full text-sm">
                    {{ $tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Stats --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-[#f5f5f5] mb-3">Statistiques</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="flex items-center gap-2 text-[#9ca3af]">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <span>{{ $blog->views }} vues</span>
                </div>
                <div class="flex items-center gap-2 text-[#9ca3af]">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    <span>{{ $blog->reading_time }} min de lecture</span>
                </div>
                <div class="flex items-center gap-2 text-[#9ca3af]">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    <span>Créé le {{ $blog->created_at->format('d/m/Y à H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Contenu</h3>
            <div class="prose prose-invert max-w-none">
                {!! $blog->content !!}
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-[#333333]">
            <a 
                href="{{ route('admin.blog.editor.edit', $blog->id) }}"
                class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-6 py-3 flex items-center justify-center gap-2 rounded-lg transition-colors"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                </svg>
                Modifier l'article
            </a>
            
            <button
                onclick="toggleArticleStatus({{ $blog->id }}, this)"
                class="px-6 py-3 rounded-lg border border-[#333333] bg-[#2b2b2b] text-[#f5f5f5] hover:bg-[#333333] transition-colors flex items-center justify-center gap-2"
            >
                @if($blog->status === 'published')
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 11 8 11 8a18.5 18.5 0 0 1-2.27 3.14"/>
                        <path d="M3 3l18 18"/>
                        <path d="M6.61 6.61A13.526 13.526 0 0 0 1 12s4 8 11 8c1.98 0 3.75-.51 5.39-1.39"/>
                    </svg>
                    Masquer
                @else
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    Publier
                @endif
            </button>
            
            <button
                onclick="deleteArticle({{ $blog->id }}, '{{ $blog->title }}')"
                class="px-6 py-3 rounded-lg border border-red-500/20 bg-red-900/10 text-red-400 hover:bg-red-900/20 transition-colors flex items-center justify-center gap-2"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    <line x1="10" x2="10" y1="11" y2="17"/>
                    <line x1="14" x2="14" y1="11" y2="17"/>
                </svg>
                Supprimer
            </button>
        </div>
    </div>
</div>

{{-- Include JavaScript functions from the main blog page --}}
<script>
// Toggle Article Status
function toggleArticleStatus(id, button) {
    fetch(`/admin/blog/${id}/toggle-status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page to show updated status
            window.location.reload();
        } else {
            alert('Erreur lors du changement de statut');
        }
    })
    .catch(error => {
        alert('Erreur lors du changement de statut');
    });
}

// Delete Article
function deleteArticle(id, title) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer l'article "${title}" ?`)) {
        fetch(`/admin/blog/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to blog list
                window.location.href = '/admin/blog';
            } else {
                alert('Erreur lors de la suppression');
            }
        })
        .catch(error => {
            alert('Erreur lors de la suppression');
        });
    }
}
</script>
@endsection
