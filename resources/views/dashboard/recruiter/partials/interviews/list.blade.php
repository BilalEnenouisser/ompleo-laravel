<div id="interviewsList" class="space-y-4 sm:space-y-6">
    @forelse($interviews as $interview)
        <x-interview-card :interview="$interview" />
    @empty
        <div class="text-center py-8 sm:py-12">
            <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 bg-blue-500/10 rounded-full flex items-center justify-center">
                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                </svg>
            </div>
            <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5] mb-2">{{ __('Aucun entretien trouve') }}</h3>
            <p class="text-xs sm:text-sm text-[#9ca3af] mb-3 sm:mb-4">{{ __('Vous n\'avez pas encore programme d\'entretiens.') }}</p>
            <a href="{{ route('recruiter.interviews.create') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition-colors inline-flex items-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-5 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                <span class="hidden sm:inline">{{ __('Programmer un entretien') }}</span>
                <span class="sm:hidden">{{ __('Programmer') }}</span>
            </a>
        </div>
    @endforelse
</div>
