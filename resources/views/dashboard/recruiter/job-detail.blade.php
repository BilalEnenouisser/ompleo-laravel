@extends('layouts.dashboard')

@section('title', 'Détails de l\'offre')

@section('content')
<div class="min-h-screen bg-[#1a1a1a] text-[#f5f5f5]">
    <div class="container mx-auto px-4 py-6 sm:py-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6 sm:mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5] mb-2">
                    Détails de l'offre
                </h1>
                <p class="text-sm sm:text-base text-[#9ca3af]">
                    Consultez les détails de votre offre d'emploi
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('recruiter.jobs.edit', $job) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    Modifier
                </a>
                <a href="{{ route('recruiter.jobs') }}" class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-4 py-2 rounded-lg font-medium transition-colors">
                    Retour
                </a>
            </div>
        </div>

        {{-- Job Details --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 sm:p-8 shadow-lg">
            {{-- Job Header --}}
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h2 class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">
                            {{ $job->title }}
                        </h2>
                        @if($job->is_featured)
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                            </svg>
                            Vedette
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-4 text-sm text-[#9ca3af] mb-4">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ $job->location }}
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            {{ $job->type }}
                        </div>
                        <div class="flex items-center gap-1">
                            <span>🏠</span>
                            {{ ucfirst($job->work_type) }}
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="text-lg font-bold text-[#f5f5f5] mb-1">
                        @if($job->salary_min && $job->salary_max)
                            {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                        @elseif($job->salary_min)
                            À partir de {{ number_format($job->salary_min) }} DA
                        @else
                            Salaire non spécifié
                        @endif
                    </div>
                    <div class="text-sm text-[#9ca3af]">
                        @if($job->application_deadline)
                            Expire le {{ \Carbon\Carbon::parse($job->application_deadline)->format('d/m/Y') }}
                        @else
                            Pas de date limite
                        @endif
                    </div>
                </div>
            </div>

            {{-- Job Description --}}
            <div class="mb-6">
                <h3 class="text-lg font-bold text-[#f5f5f5] mb-3">Description du poste</h3>
                <div class="text-[#d1d5db] leading-relaxed">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>

            {{-- Requirements --}}
            @if($job->requirements && count($job->requirements) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-bold text-[#f5f5f5] mb-3">Exigences</h3>
                <ul class="space-y-2">
                    @foreach($job->requirements as $requirement)
                    <li class="flex items-start gap-2 text-[#d1d5db]">
                        <svg class="w-4 h-4 mt-1 text-[#00b6b4] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20,6 9,17 4,12"/>
                        </svg>
                        {{ $requirement }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Benefits --}}
            @if($job->benefits && count($job->benefits) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-bold text-[#f5f5f5] mb-3">Avantages</h3>
                <ul class="space-y-2">
                    @foreach($job->benefits as $benefit)
                    <li class="flex items-start gap-2 text-[#d1d5db]">
                        <svg class="w-4 h-4 mt-1 text-green-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 12l2 2 4-4"/>
                            <path d="M21 12c.552 0 1-.448 1-1V5c0-.552-.448-1-1-1H3c-.552 0-1 .448-1 1v6c0 .552.448 1 1 1h18z"/>
                        </svg>
                        {{ $benefit }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Tags --}}
            @if($job->tags && count($job->tags) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-bold text-[#f5f5f5] mb-3">Compétences requises</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($job->tags as $tag)
                    <span class="bg-[#333333] text-[#f5f5f5] px-3 py-1 rounded-full text-sm">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Job Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t border-[#333333]">
                <div class="text-center">
                    <div class="text-2xl font-bold text-[#f5f5f5]">{{ $job->applications->count() }}</div>
                    <div class="text-sm text-[#9ca3af]">Candidatures</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-[#f5f5f5]">{{ $job->views ?? 0 }}</div>
                    <div class="text-sm text-[#9ca3af]">Vues</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-[#f5f5f5]">
                        @if($job->status == 'published') Actif
                        @elseif($job->status == 'draft') Brouillon
                        @elseif($job->status == 'closed') Fermé
                        @else {{ ucfirst($job->status) }} @endif
                    </div>
                    <div class="text-sm text-[#9ca3af]">Statut</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
