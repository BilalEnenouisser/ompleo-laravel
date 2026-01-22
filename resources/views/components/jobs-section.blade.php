@php
use Illuminate\Support\Facades\Storage;
// Use the jobs passed from the controller, or fallback to empty array
$jobs = $jobs ?? collect();
@endphp

<section class="relative py-20 bg-[#1f1f1f] overflow-hidden jobs-section">
    <style>
        /* Desktop is default - py-20 */
        @media (max-width: 1023px) {
            .jobs-section {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }
        }
        @media (max-width: 767px) {
            .jobs-section {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .jobs-section h2 {
                font-size: 2rem !important;
            }
        }
    </style>
    <!-- Background Images -->
    <div class="absolute top-0 left-0 bottom-0 hidden lg:block pointer-events-none">
        <img src="{{ asset('storage/home_page/job/left.png') }}" alt="Background" class="h-full w-auto object-cover" style="object-position: left;">
    </div>
    <div class="absolute top-0 right-0 bottom-0 hidden lg:block pointer-events-none">
        <img src="{{ asset('storage/home_page/job/right.png') }}" alt="Background" class="h-full w-auto object-cover" style="object-position: right;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-6 pb-8">
            <div class="flex items-center justify-center gap-2 mb-4 pb-2">
                <img src="{{ asset('storage/home_page/job/icon.svg') }}" alt="Icon" class="w-5 h-5">
                <span class="text-base" style="color: #d9d9d9;">Les meilleurs emplois</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white pb-4">
                Offres à la une
            </h2>
        </div>

        <!-- Search Input -->
        <div class="max-w-2xl mx-auto mb-12">
            <form action="{{ route('jobs.index') }}" method="GET" class="relative">
                <div class="p-[1px]" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 10px;">
                    <div class="relative" style="border-radius: 10px;">
                        <input 
                            type="text" 
                            name="search"
                            placeholder="Rechercher des offres d'emploi" 
                            class="w-full px-6 py-4 pr-14 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#00fadc]/50 transition-all"
                            style="background-color: #212221; border-radius: 10px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);"
                        >
                        <button 
                            type="submit"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-[#00fadc] transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Job Cards -->
        <div class="max-w-4xl mx-auto space-y-4">
            @forelse($jobs->take(3) as $job)
            <a href="{{ route('jobs.show', $job->slug) }}" class="block">
                <div class="p-[1px] hover:opacity-90 transition-opacity duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 10px; cursor: pointer;">
                    <div class="p-6 transition-all duration-300" style="background-color: #212221; border-radius: 10px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);">
                        <!-- Row 1: Logo, Job Title + Company, Featured Badge -->
                        <div class="flex items-start gap-6 mb-4">
                            <!-- Left: Logo -->
                            <div class="flex-shrink-0">
                                @if($job->company && $job->company->logo)
                                    <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-16 h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00fadc] flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">
                                            {{ $job->company ? strtoupper(substr($job->company->name, 0, 1)) : 'J' }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Middle: Job Title and Company Name -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xl font-bold text-white mb-1">
                                    {{ $job->title }}
                                </h3>
                                <p class="text-gray-400 text-sm">
                                    {{ $job->company ? $job->company->name : 'Entreprise non spécifiée' }}
                                </p>
                            </div>

                            <!-- Right: Featured Badge -->
                            @if($job->is_featured)
                            <div class="flex-shrink-0">
                                <span class="text-xs font-medium" style="color: #5997E3;">
                                    Featured
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Row 2: Details and Posted Date -->
                        <div class="flex items-center justify-between">
                            <!-- Left: Keywords | Type | City | Salary -->
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400">
                                @if($job->tags && is_array($job->tags) && count($job->tags) > 0)
                                    <span>{{ implode(', ', array_slice($job->tags, 0, 2)) }}</span>
                                    <span class="text-gray-600">|</span>
                                @endif
                                <span>{{ $job->work_type ?? $job->type ?? 'Full Time' }}</span>
                                <span class="text-gray-600">|</span>
                                <span>{{ $job->location }}</span>
                                <span class="text-gray-600">|</span>
                                <span>
                                    @if($job->salary_min && $job->salary_max)
                                        {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA/year
                                    @elseif($job->salary_min)
                                        À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA/year
                                    @else
                                        Salaire non spécifié
                                    @endif
                                </span>
                            </div>

                            <!-- Right: Posted Date -->
                            <div class="flex-shrink-0">
                                <p class="text-sm text-gray-400">
                                    Posted on: {{ $job->created_at->format('M d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                        <path d="M10 6h4"></path>
                        <path d="M10 10h4"></path>
                        <path d="M10 14h4"></path>
                        <path d="M10 18h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Aucune offre disponible</h3>
                <p class="text-gray-400">Revenez bientôt pour découvrir de nouvelles opportunités !</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
