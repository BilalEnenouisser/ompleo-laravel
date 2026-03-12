@php
use Illuminate\Support\Facades\Storage;
// Use the jobs passed from the controller, or fallback to empty array
$jobs = $jobs ?? collect();
@endphp

<section class="platform-section relative bg-[#212221] overflow-hidden jobs-section">
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

    <div class="platform-container relative z-10">
        <!-- Header -->
        <div class="text-center mb-6 pb-8">
            <div class="flex items-center justify-center gap-2 mb-4 pb-2">
                <img src="{{ asset('storage/home_page/job/icon.svg') }}" alt="Icon" class="w-7 h-7">
                <span class="text-base" style="color: #d9d9d9;">Les meilleurs emplois</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white pb-4">
                Offres à la une
            </h2>
        </div>

        <!-- Search Input -->
        <div class="max-w-2xl mx-auto mb-12">
            <div class="relative cursor-pointer" onclick="openSearchPopup()">
                <div class="p-[1px]" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px;">
                    <div class="relative overflow-hidden" style="border-radius: 12px;">
                        <div class="w-full px-6 py-4 pr-14 text-gray-400 font-medium" style="background-color: #212221; border-radius: 12px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);">
                            Rechercher des offres d'emploi
                        </div>
                        <!-- Right Icon -->
                        <div class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Cards -->
        <div class="max-w-4xl mx-auto space-y-4">
            @forelse($jobs->take(3) as $job)
            <a href="{{ route('jobs.show', $job->slug) }}" class="block job-card-link">
                <div class="p-[1px] hover:opacity-90 transition-opacity duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px; cursor: pointer;">
                    <div class="p-6 transition-all duration-300 job-card-inner" style="background-color: #212221; border-radius: 12px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);">
                        <style>
                            .job-card-date-container {
                                position: relative;
                                min-height: 1.5rem;
                            }
                            .job-card-date {
                                display: flex;
                                align-items: center;
                                justify-content: flex-end;
                                transition: opacity 0.3s ease, transform 0.3s ease;
                                position: absolute;
                                top: 0;
                                right: 0;
                            }
                            .job-card-view {
                                display: flex;
                                align-items: center;
                                justify-content: flex-end;
                                gap: 0.5rem;
                                opacity: 0;
                                transform: translateX(10px);
                                transition: opacity 0.3s ease, transform 0.3s ease;
                                position: absolute;
                                top: 0;
                                right: 0;
                            }
                            .job-card-link:hover .job-card-date {
                                opacity: 0;
                                transform: translateX(-10px);
                            }
                            .job-card-link:hover .job-card-view {
                                opacity: 1;
                                transform: translateX(0);
                            }
                            
                            /* Mobile styles for job cards */
                            @media (max-width: 767px) {
                                .job-card-row-1 {
                                    display: flex !important;
                                    align-items: flex-start !important;
                                    justify-content: space-between !important;
                                    gap: 1rem !important;
                                    margin-bottom: 1rem !important;
                                }
                                
                                .job-card-left-section {
                                    display: flex !important;
                                    flex-direction: column !important;
                                    align-items: flex-start !important;
                                    gap: 0.5rem !important;
                                    flex: 1 !important;
                                    min-width: 0 !important;
                                }
                                
                                .job-card-logo-container {
                                    flex-shrink: 0 !important;
                                }
                                
                                .job-card-logo-container .job-card-logo,
                                .job-card-logo-container > div {
                                    width: 3rem !important;
                                    height: 3rem !important;
                                }
                                
                                .job-card-title-company {
                                    width: 100% !important;
                                    display: flex !important;
                                    flex-direction: column !important;
                                    gap: 0.25rem !important;
                                }
                                
                                .job-card-title-company h3 {
                                    font-size: 1rem !important;
                                    margin-bottom: 0 !important;
                                    line-height: 1.3 !important;
                                    word-wrap: break-word !important;
                                }
                                
                                .job-card-title-company p {
                                    font-size: 0.875rem !important;
                                    margin: 0 !important;
                                }
                                
                                .job-card-featured {
                                    flex-shrink: 0 !important;
                                    align-self: flex-start !important;
                                }
                                
                                .job-card-row-2 {
                                    display: flex !important;
                                    flex-direction: column !important;
                                    gap: 0.75rem !important;
                                }
                                
                                .job-card-details {
                                    width: 100% !important;
                                }
                                
                                .job-card-details-line {
                                    display: flex !important;
                                    flex-wrap: wrap !important;
                                    align-items: center !important;
                                    gap: 0.5rem !important;
                                    font-size: 0.875rem !important;
                                    color: #9ca3af !important;
                                    line-height: 1.5 !important;
                                }
                                
                                .job-card-date-container {
                                    position: relative !important;
                                    min-height: 1.5rem !important;
                                    width: 100% !important;
                                    display: flex !important;
                                    justify-content: flex-start !important;
                                }
                                
                                .job-card-date {
                                    position: relative !important;
                                    justify-content: flex-start !important;
                                }
                                
                                .job-card-view {
                                    position: relative !important;
                                    justify-content: flex-start !important;
                                }
                            }
                        </style>
                        <!-- Row 1: Logo, Job Title + Company, Featured Badge -->
                        <div class="flex items-start gap-4 md:gap-6 mb-6 md:mb-4">
                            <!-- Logo -->
                            <div class="flex-shrink-0">
                                @if($job->company && $job->company->logo)
                                    <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-12 h-12 md:w-16 md:h-16 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00fadc] flex items-center justify-center">
                                        <span class="text-white font-bold text-lg md:text-xl">
                                            {{ $job->company ? strtoupper(substr($job->company->name, 0, 1)) : 'J' }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Title and Company -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg md:text-xl font-bold text-white mb-1 truncate">
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
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 md:gap-4 pt-2 md:pt-0 border-t border-white/5 md:border-none">
                            <!-- Left: Keywords | Type | City | Salary -->
                            <div class="flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-gray-400">
                                @if($job->tags && is_array($job->tags) && count($job->tags) > 0)
                                    <span class="whitespace-nowrap">{{ implode(', ', array_slice($job->tags, 0, 2)) }}</span>
                                    <span class="text-gray-600">|</span>
                                @endif
                                <span class="whitespace-nowrap">{{ $job->work_type ?? $job->type ?? 'Full Time' }}</span>
                                <span class="text-gray-600">|</span>
                                <span class="whitespace-nowrap">{{ $job->location }}</span>
                                <span class="text-gray-600">|</span>
                                <span class="whitespace-nowrap">
                                    @if($job->salary_min && $job->salary_max)
                                        {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA/year
                                    @elseif($job->salary_min)
                                        À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA/year
                                    @else
                                        Salaire non spécifié
                                    @endif
                                </span>
                            </div>

                            <!-- Right: Posted Date / View Job -->
                            <div class="flex-shrink-0 relative md:min-w-[210px] min-h-[1.5rem]">
                                <!-- Posted Date (default) -->
                                <p class="text-sm text-gray-400 job-card-date">
                                    Posted on: {{ $job->created_at->format('M d, Y') }}
                                </p>
                                <!-- View Job (on hover) -->
                                <p class="text-sm text-[#00fadc] font-medium job-card-view">
                                    <span>View Job</span>
                                    <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
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

        <!-- View All Jobs Button -->
        <div class="text-center mt-12">
                    <a href="{{ route('jobs.index') }}" class="btn-premium-green mx-auto">
                        <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon">
                        <span>Voir toutes les offres</span>
                    </a>
        </div>
    </div>
</section>
