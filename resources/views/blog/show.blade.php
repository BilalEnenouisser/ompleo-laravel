@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#1f1f1f] pt-20">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <article class="bg-[#2b2b2b] rounded-lg shadow-lg overflow-hidden border border-[#333333]">
            @if($post->featured_image)
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
            </div>
            @endif
            
            <div class="p-8">
                <header class="mb-6">
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $post->title }}</h1>
                    
                    <div class="flex items-center text-sm text-gray-400 mb-4">
                        <span class="mr-4">Par {{ $post->author_name }}</span>
                        <span class="mr-4">{{ $post->created_at->format('d M Y') }}</span>
                        <span class="mr-4">{{ $post->reading_time }} min de lecture</span>
                        <span class="px-2 py-1 bg-[#00b6b4] text-white rounded-full text-xs">{{ $post->category }}</span>
                    </div>
                    
                    <p class="text-xl text-gray-300 leading-relaxed">{{ $post->excerpt }}</p>
                </header>
                
                <div class="prose prose-lg max-w-none text-gray-300">
                    {!! $post->content !!}
                </div>
                
                @if($post->tags && count($post->tags) > 0)
                <div class="mt-8 pt-6 border-t border-[#333333]">
                    <h3 class="text-lg font-semibold text-white mb-3">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                        <span class="px-3 py-1 bg-[#333333] text-gray-300 rounded-full text-sm">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </article>
    </div>
</div>

@push('styles')
<style>
.prose {
    color: #d1d5db !important;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #ffffff !important;
}

.prose p {
    color: #d1d5db !important;
}

.prose strong {
    color: #ffffff !important;
}

.prose a {
    color: #00b6b4 !important;
}

.prose a:hover {
    color: #009e9c !important;
}

.prose blockquote {
    color: #9ca3af !important;
    border-left-color: #374151 !important;
}

.prose code {
    background-color: #374151 !important;
    color: #f3f4f6 !important;
}

.prose pre {
    background-color: #1f2937 !important;
    color: #f3f4f6 !important;
}

.prose pre code {
    background-color: transparent !important;
    color: #f3f4f6 !important;
}
</style>
@endpush
@endsection
