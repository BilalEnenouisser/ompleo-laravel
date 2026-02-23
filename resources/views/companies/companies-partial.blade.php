@php
use Illuminate\Support\Facades\Storage;
@endphp

@foreach($companies as $company)
    @php
        $initials = '';
        if ($company->name) {
            $nameParts = explode(' ', $company->name);
            $initials = strtoupper(substr($nameParts[0], 0, 1));
            if (count($nameParts) > 1) {
                $initials .= strtoupper(substr($nameParts[1], 0, 1));
            }
        }
    @endphp
    
    <div class="bg-white dark:bg-[#2b2b2b] rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-[#333333] flex flex-col">
        {{-- Top Section: Logo on Left, Industry on Right --}}
        <div class="flex gap-4 mb-4 items-center">
            {{-- Company Logo on Left --}}
            <div class="flex-shrink-0">
                @if($company->logo)
                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-20 h-20 rounded-lg object-cover">
                @else
                    <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                        <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'C' }}</span>
                    </div>
                @endif
            </div>

            {{-- Industry/Specialisation on Right --}}
            <div class="flex-1 min-w-0 flex justify-end">
                @if($company->industry || $company->specialisation)
                <div class="flex flex-wrap gap-1.5 justify-end">
                    @if($company->industry)
                        <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium">{{ $company->industry }}</span>
                    @endif
                    @if($company->specialisation)
                        <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium">{{ $company->specialisation }}</span>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Bottom Section: Name, Description, Details --}}
        <div class="mb-4 flex-1">
            {{-- Company Name --}}
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1.5">{{ $company->name }}</h3>

            {{-- Description --}}
            @if($company->description)
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 line-clamp-2 leading-relaxed">{{ $company->description }}</p>
            @endif

            {{-- Location --}}
            @if($company->location)
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>{{ $company->location }}</span>
            </div>
            @endif

            {{-- Company Size --}}
            @if($company->size)
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>{{ $company->size }}</span>
            </div>
            @endif

            {{-- Job Count --}}
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                <span>{{ $company->jobs_count }} {{ $company->jobs_count == 1 ? 'offre d\'emploi' : 'offres d\'emploi' }}</span>
            </div>
        </div>

        {{-- Button at Bottom --}}
        <a href="{{ route('jobs.index', ['company' => $company->id]) }}" class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white py-2.5 rounded-lg transition-colors text-center font-semibold text-sm mt-auto">
            Voir les offres
        </a>
    </div>
@endforeach

