@foreach($candidates as $candidate)
    @if($candidate->candidateProfile)
        @php $profile = $candidate->candidateProfile; $initials = ''; if ($candidate->name) { $nameParts = explode(' ', $candidate->name); $initials = strtoupper(substr($nameParts[0], 0, 1)); if (count($nameParts) > 1) { $initials .= strtoupper(substr($nameParts[1], 0, 1)); } } // Parse skills - they are already cast as array in the model $skills = []; if ($profile && $profile->skills && is_array($profile->skills)) { $skills = array_filter(array_map(function($skill) { return is_string($skill) ? trim($skill) : (string) $skill; }, $profile->skills)); } // Parse experience $experienceText = $profile->experience_years ?? 'Non spécifié'; // Parse education $educationText = 'Non spécifié'; if ($profile && isset($profile->education) && is_array($profile->education) && !empty($profile->education)) { try { $firstEducation = $profile->education[0]; if (is_array($firstEducation)) { $educationText = $firstEducation['degree'] ?? $firstEducation['title'] ?? $firstEducation['diploma'] ?? $firstEducation['name'] ?? 'Non spécifié'; $educationText = trim($educationText); if (empty($educationText)) { $educationText = 'Non spécifié'; } } elseif (is_string($firstEducation)) { $educationText = trim($firstEducation); if (empty($educationText)) { $educationText = 'Non spécifié'; } } } catch (Exception $e) { $educationText = 'Non spécifié'; } } @endphp
        
        <div class="bg-white dark:bg-[#2b2b2b] rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-[#333333] flex flex-col">
            {{-- Top Section: Image on Left, Compétences on Right --}}
            <div class="flex gap-4 mb-4">
                {{-- Profile Image on Left --}}
                <div class="flex-shrink-0">
                    @if($profile->avatar)
                        <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $candidate->name }}" class="w-20 h-20 rounded-lg object-cover">
                    @else
                        <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                            <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'U' }}</span>
                        </div>
                    @endif
                </div>

                {{-- Compétences on Right --}}
                <div class="flex-1 min-w-0">
                    @if(count($skills) > 0)
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice($skills, 0, 2) as $skill)
                            <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium text-center sm:text-left">{{ $skill }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Bottom Section: Name, Description, Details --}}
            <div class="mb-4 flex-1">
                {{-- Name --}}
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1.5">{{ strtoupper($candidate->name) }}</h3>

                {{-- Description --}}
                @if($profile->bio)
                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 line-clamp-2 leading-relaxed">{{ $profile->bio }}</p>
                @endif

                {{-- Ville --}}
                @if($profile->city)
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                    <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>{{ $profile->city }}</span>
                </div>
                @endif

                {{-- Titre professionnel --}}
                @php
                    // Get title from profile, or extract from first experience entry if title field doesn't exist
                    $professionalTitle = $profile->title ?? null;
                    if (!$professionalTitle && isset($profile->experience) && is_array($profile->experience) && !empty($profile->experience)) {
                        $firstExp = $profile->experience[0];
                        if (is_array($firstExp) && isset($firstExp['title'])) {
                            $professionalTitle = $firstExp['title'];
                        }
                    }
                @endphp
                @if($professionalTitle)
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                    <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                    <span>{{ $professionalTitle }}</span>
                </div>
                @endif

                {{-- Years of Experience --}}
                @if($experienceText && $experienceText !== 'Non spécifié')
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                    <svg class="w-7 h-7 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <span>{{ $experienceText }}</span>
                </div>
                @endif
            </div>

            {{-- Button at Bottom --}}
            <a href="{{ route('companies.candidates.show', $candidate->id) }}" class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white py-2.5 rounded-lg transition-colors text-center font-semibold text-sm mt-auto">
                Voir le profils
            </a>
        </div>
    @endif
@endforeach

