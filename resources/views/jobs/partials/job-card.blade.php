@foreach($jobs as $job)
<a href="{{ route('jobs.show', $job->slug) }}" class="block p-6 rounded-2xl transition-all duration-300 hover:-translate-y-1 job-card-link" style="background: rgba(43, 43, 43, 0.73); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08);">
    <style>
        .job-card-link {
            position: relative;
        }
        .job-card-link:hover {
            border-color: rgba(0, 182, 180, 0.3);
        }
        .job-card-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
            position: absolute;
            top: 0;
            right: 0;
        }
        .job-card-view {
            display: flex;
            align-items: center;
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
        @media (max-width: 767px) {
            .job-card-date, .job-card-view {
                position: relative !important;
                right: auto !important;
                top: auto !important;
                justify-content: flex-start !important;
            }
        }
    </style>

    <!-- Row 1: Logo, Title + Company, Featured Badge -->
    <div class="flex items-start gap-4 md:gap-6 mb-6 md:mb-4">
        <!-- Logo -->
        <div class="flex-shrink-0">
            @if($job->company && $job->company->logo)
                <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-12 h-12 md:w-16 md:h-16 rounded-lg object-cover">
            @else
                <div class="w-12 h-12 md:w-16 md:h-16 rounded-lg bg-gradient-to-br from-[#165c5b] to-[#00b6b4] flex items-center justify-center">
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

        <!-- Featured Badge -->
        @if($job->is_featured)
        <div class="flex-shrink-0">
            <span class="text-xs font-medium" style="color: #00b6b4;">
                Featured
            </span>
        </div>
        @endif
    </div>

    <!-- Row 2: Details and Posted Date -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-y-3 md:gap-4 pt-2 md:pt-0 border-t border-white/5 md:border-none">
        <!-- Details -->
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
                    {{ number_format($job->salary_min, 0, ',', ' ') }} - {{ number_format($job->salary_max, 0, ',', ' ') }} DA
                @elseif($job->salary_min)
                    À partir de {{ number_format($job->salary_min, 0, ',', ' ') }} DA
                @else
                    Salaire non spécifié
                @endif
            </span>
        </div>

        <!-- Date / View Job -->
        <div class="flex-shrink-0 relative md:min-w-[210px] min-h-[1.5rem]">
            <p class="text-sm text-gray-400 job-card-date">
                Posted on: {{ $job->created_at->format('M d, Y') }}
            </p>
            <p class="text-sm text-[#00b6b4] font-medium job-card-view">
                <span>Voir l'offre</span>
                <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </p>
        </div>
    </div>
</a>
@endforeach
