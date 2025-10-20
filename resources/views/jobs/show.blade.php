@extends('layouts.app')

@section('title', $job->title . ' - ' . $job->company->name . ' | OMPLEO')
@section('description', 'Découvrez cette offre d\'emploi : ' . $job->title . ' chez ' . $job->company->name)

@section('content')
<!-- Header -->
@include('components.header')

<div class="min-h-screen bg-gray-50 dark:bg-[#1f1f1f] pt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <button
                onclick="history.back()"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2b2b2b] transition-colors"
            >
                <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <div class="flex-1">
                <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                    <span>Offres d'emploi</span>
                    <span>/</span>
                    <span>{{ $job->company->name }}</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $job->title }}
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Job Header -->
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <div class="flex items-start gap-6 mb-6">
                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 flex-shrink-0">
                            @if($job->company->logo)
                                <img
                                    src="{{ asset('storage/' . $job->company->logo) }}"
                                    alt="{{ $job->company->name }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#00b6b4] to-[#009e9c] flex items-center justify-center text-white font-bold text-xl">
                                    {{ strtoupper(substr($job->company->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $job->title }}
                                </h2>
                                @if($job->is_featured)
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        Vedette
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-1 mb-4">
                                <svg class="w-5 h-5 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                    <path d="M10 6h4"></path>
                                    <path d="M10 10h4"></path>
                                    <path d="M10 14h4"></path>
                                    <path d="M10 18h4"></path>
                                </svg>
                                <span class="text-lg font-medium text-[#00b6b4]">
                                    {{ $job->company->name }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12,6 12,12 16,14"></polyline>
                                    </svg>
                                    <span>{{ $job->type }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span>{{ $job->experience_level ?? 'Non spécifié' }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"></rect>
                                        <line x1="16" x2="16" y1="2" y2="6"></line>
                                        <line x1="8" x2="8" y1="2" y2="6"></line>
                                        <line x1="3" x2="21" y1="10" y2="10"></line>
                                    </svg>
                                    <span>Publié {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            @if($job->salary_min && $job->salary_max)
                                {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                            @elseif($job->salary_min)
                                À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                            @else
                                Salaire non spécifié
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-[#00b6b4] transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="18" cy="5" r="3"></circle>
                                    <circle cx="6" cy="12" r="3"></circle>
                                    <circle cx="18" cy="19" r="3"></circle>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Description du poste
                    </h3>
                    <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- Requirements -->
                @if($job->requirements && count($job->requirements) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Profil recherché
                    </h3>
                    <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300">
                        <ul class="list-disc list-inside space-y-2">
                            @foreach($job->requirements as $requirement)
                                <li>{{ $requirement }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Skills -->
                @if($job->tags && count($job->tags) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Compétences requises
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($job->tags as $tag)
                            <span class="px-4 py-2 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full font-medium">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($job->benefits && count($job->benefits) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        Avantages
                    </h3>
                    <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300">
                        <ul class="list-disc list-inside space-y-2">
                            @foreach($job->benefits as $benefit)
                                <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Apply Card -->
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg sticky top-8">
                    <div class="text-center mb-6">
                        <div class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                            @if($job->salary_min && $job->salary_max)
                                {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                            @elseif($job->salary_min)
                                À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                            @else
                                Salaire non spécifié
                            @endif
                        </div>
                        @if($job->application_deadline)
                            <p class="text-gray-600 dark:text-gray-400">
                                Date limite : {{ $job->application_deadline->format('d/m/Y') }}
                            </p>
                        @endif
                    </div>
                    
                    @auth
                        @if(auth()->user()->user_type === 'candidate')
                            <button
                                onclick="applyForJob({{ $job->id }})"
                                class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-4 text-lg font-bold rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                                </svg>
                                Postuler maintenant
                            </button>
                        @else
                            <div class="text-center p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <p class="text-gray-600 dark:text-gray-400">
                                    Connectez-vous en tant que candidat pour postuler
                                </p>
                            </div>
                        @endif
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-4 text-lg font-bold rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                            </svg>
                            Se connecter pour postuler
                        </a>
                    @endauth
                    
                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-4">
                        En postulant, vous acceptez nos conditions d'utilisation
                    </p>
                </div>

                <!-- Company Info -->
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg">
                    <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-4">
                        À propos de {{ $job->company->name }}
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600 dark:text-gray-400">
                        <p>
                            {{ $job->company->description ?? 'Découvrez les opportunités chez ' . $job->company->name . '.' }}
                        </p>
                        <div class="pt-3 border-t border-gray-200 dark:border-[#333333]">
                            <a href="{{ route('companies.show', $job->company->slug) }}" class="text-[#00b6b4] hover:text-[#009e9c] font-medium">
                                Voir toutes les offres de {{ $job->company->name }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Related Jobs -->
                @if($relatedJobs->count() > 0)
                <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-lg">
                    <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Offres similaires
                    </h3>
                    <div class="space-y-4">
                        @foreach($relatedJobs as $relatedJob)
                            <a
                                href="{{ route('jobs.show', $relatedJob->slug) }}"
                                class="block p-4 border border-gray-100 dark:border-[#333333] rounded-lg hover:bg-gray-50 dark:hover:bg-[#333333] transition-colors group"
                            >
                                <div class="flex items-start justify-between mb-2">
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100 group-hover:text-[#00b6b4] transition-colors">
                                        {{ $relatedJob->title }}
                                    </h4>
                                    @if($relatedJob->is_featured)
                                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                            Vedette
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                                    <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                        <path d="M10 6h4"></path>
                                        <path d="M10 10h4"></path>
                                        <path d="M10 14h4"></path>
                                        <path d="M10 18h4"></path>
                                    </svg>
                                    <span class="font-medium">{{ $relatedJob->company->name }}</span>
                                </div>
                                
                                <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span>{{ $relatedJob->location }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12,6 12,12 16,14"></polyline>
                                        </svg>
                                        <span>{{ $relatedJob->type }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12,6 12,12 16,14"></polyline>
                                        </svg>
                                        <span>{{ $relatedJob->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-[#00b6b4]">
                                        @if($relatedJob->salary_min && $relatedJob->salary_max)
                                            {{ number_format($relatedJob->salary_min, 0, ',', ' ') }} - {{ number_format($relatedJob->salary_max, 0, ',', ' ') }} DA
                                        @elseif($relatedJob->salary_min)
                                            À partir de {{ number_format($relatedJob->salary_min, 0, ',', ' ') }} DA
                                        @else
                                            Salaire non spécifié
                                        @endif
                                    </p>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-[#00b6b4] transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-[#333333]">
                        <a 
                            href="{{ route('jobs.index') }}" 
                            class="text-[#00b6b4] hover:text-[#009e9c] font-medium text-sm flex items-center gap-1"
                        >
                            Voir toutes les offres
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function applyForJob(jobId) {
    // TODO: Implement job application logic
    alert('Fonctionnalité de candidature en cours de développement');
}
</script>

<!-- Footer -->
@include('components.footer')
@endsection
