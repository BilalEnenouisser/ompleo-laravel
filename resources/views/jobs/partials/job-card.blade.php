@foreach($jobs as $job)
<div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300 border {{ $job->is_featured ? 'border-[#00b6b4]/20 dark:border-[#00b6b4]/30 ring-2 ring-[#00b6b4]/10 dark:ring-[#00b6b4]/20' : 'border-gray-100 dark:border-[#333333]' }} hover:-translate-y-1">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div class="flex-1">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-[#00b6b4] rounded-xl flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                    @if($job->company && $job->company->logo)
                        <img src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }}" class="w-full h-full object-cover rounded-xl">
                    @else
                        {{ substr($job->company->name ?? 'CO', 0, 2) }}
                    @endif
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2">
                        <a href="{{ route('jobs.show', $job->slug) }}" class="text-lg sm:text-xl font-bold text-[#111111] dark:text-[#f5f5f5] hover:text-[#00b6b4] transition-colors duration-200">
                            {{ $job->title }}
                        </a>
                        @if($job->is_featured)
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1 w-fit">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            Vedette
                        </span>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-2 sm:flex sm:flex-row gap-4 text-[#111111] dark:text-[#cccccc] mb-3">
                        <div class="flex items-center gap-1">
                            <svg class="w-6 h-6 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="font-medium text-[#111111] dark:text-[#f5f5f5] text-sm sm:text-base">{{ $job->company->name ?? 'Entreprise' }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-6 h-6 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">{{ $job->location }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="text-[#00b6b4]">{{ getWorkTypeIcon($job->work_type) }}</span>
                            <span class="text-sm sm:text-base">{{ getWorkTypeLabel($job->work_type) }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-6 h-6 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">{{ $job->experience ?? $job->experience_level ?? 'Non spécifié' }}</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-6 h-6 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-sm sm:text-base">{{ $job->type ?? 'Non spécifié' }}</span>
                        </div>
                    </div>
                    
                    <p class="text-sm sm:text-base text-[#111111] dark:text-[#cccccc] mb-4 line-clamp-2">
                        {{ $job->description }}
                    </p>
                    
                    @if($job->tags && count($job->tags) > 0)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($job->tags as $skill)
                        <span class="px-2 sm:px-3 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-xs sm:text-sm font-medium">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="text-base sm:text-lg font-bold text-[#111111] dark:text-[#f5f5f5]">
                            @if($job->salary_min && $job->salary_max)
                                {{ number_format($job->salary_min) }} - {{ number_format($job->salary_max) }} DA
                            @elseif($job->salary_min)
                                À partir de {{ number_format($job->salary_min) }} DA
                            @else
                                Salaire non spécifié
                            @endif
                        </div>
                        <div class="text-xs sm:text-sm text-[#111111] dark:text-[#cccccc]">
                            Publié {{ $job->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex items-center justify-between sm:justify-end gap-3 lg:flex-col lg:items-end">
            <button class="p-2 text-gray-400 hover:text-red-500 transition-colors duration-200 hover:scale-110">
                <svg class="w-6 h-6 sm:w-5 sm:h-5 text-[#111111] dark:text-[#cccccc]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </button>
            
            @auth
                @if(auth()->user()->user_type === 'candidate')
                    @php
                        $existingApplication = \App\Models\Application::where('job_id', $job->id)
                            ->where('candidate_id', auth()->id())
                            ->first();
                    @endphp
                    
                    @if($existingApplication)
                        <div class="bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400 font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-xl text-sm sm:text-base inline-flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            @if($existingApplication->status === 'pending')
                                En attente
                            @elseif($existingApplication->status === 'accepted')
                                Acceptée
                            @elseif($existingApplication->status === 'rejected')
                                Rejetée
                            @else
                                {{ ucfirst($existingApplication->status) }}
                            @endif
                        </div>
                    @else
                        <a href="{{ route('jobs.show', $job->slug) }}" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-xl transition-all duration-300 whitespace-nowrap hover:scale-105 text-sm sm:text-base inline-flex items-center justify-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                            </svg>
                            Postuler
                        </a>
                    @endif
                @else
                    <a href="{{ route('jobs.show', $job->slug) }}" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-xl transition-all duration-300 whitespace-nowrap hover:scale-105 text-sm sm:text-base inline-flex items-center justify-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                        </svg>
                        Voir l'offre
                    </a>
                @endif
            @else
                <a href="{{ route('jobs.show', $job->slug) }}" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white font-medium py-2 sm:py-3 px-4 sm:px-6 rounded-xl transition-all duration-300 whitespace-nowrap hover:scale-105 text-sm sm:text-base inline-flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                    </svg>
                    Postuler
                </a>
            @endauth
        </div>
    </div>
</div>
@endforeach
