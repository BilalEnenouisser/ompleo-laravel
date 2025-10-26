@extends('layouts.dashboard')

@section('title', 'Base de Candidats - OMPLEO')
@section('description', 'Découvrez et contactez les meilleurs talents.')
@section('page-title', 'Candidats')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="space-y-6 sm:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">Base de Candidats</h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">Découvrez et contactez les meilleurs talents</p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3">
            <button class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7,10 12,15 17,10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                Exporter
            </button>
            <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2 rounded-lg transition-colors flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                Filtres avancés
            </button>
        </div>
    </div>

    {{-- Search and Filters --}}
    <form method="GET" action="{{ route('recruiter.candidates') }}" class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
            {{-- Search Input --}}
            <div class="flex-1 min-w-[200px] relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, poste, compétences..." class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"/>
            </div>
            
            {{-- Location Dropdown --}}
            <div class="min-w-[150px] relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <select name="location" class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Toutes les villes</option>
                    <option value="Adrar" {{ request('location') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                    <option value="Chlef" {{ request('location') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                    <option value="Laghouat" {{ request('location') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                    <option value="Oum El Bouaghi" {{ request('location') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                    <option value="Batna" {{ request('location') == 'Batna' ? 'selected' : '' }}>Batna</option>
                    <option value="Béjaïa" {{ request('location') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                    <option value="Biskra" {{ request('location') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                    <option value="Béchar" {{ request('location') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                    <option value="Blida" {{ request('location') == 'Blida' ? 'selected' : '' }}>Blida</option>
                    <option value="Bouira" {{ request('location') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                    <option value="Tamanrasset" {{ request('location') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                    <option value="Tébessa" {{ request('location') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                    <option value="Tlemcen" {{ request('location') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                    <option value="Tiaret" {{ request('location') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                    <option value="Tizi Ouzou" {{ request('location') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                    <option value="Alger" {{ request('location') == 'Alger' ? 'selected' : '' }}>Alger</option>
                    <option value="Djelfa" {{ request('location') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                    <option value="Jijel" {{ request('location') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                    <option value="Sétif" {{ request('location') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                    <option value="Saïda" {{ request('location') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                    <option value="Skikda" {{ request('location') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                    <option value="Sidi Bel Abbès" {{ request('location') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                    <option value="Annaba" {{ request('location') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                    <option value="Guelma" {{ request('location') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                    <option value="Constantine" {{ request('location') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                    <option value="Médéa" {{ request('location') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                    <option value="Mostaganem" {{ request('location') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                    <option value="M'Sila" {{ request('location') == "M'Sila" ? 'selected' : '' }}>M'Sila</option>
                    <option value="Mascara" {{ request('location') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                    <option value="Ouargla" {{ request('location') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                    <option value="Oran" {{ request('location') == 'Oran' ? 'selected' : '' }}>Oran</option>
                    <option value="El Bayadh" {{ request('location') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                    <option value="Illizi" {{ request('location') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                    <option value="Bordj Bou Arreridj" {{ request('location') == 'Bordj Bou Arreridj' ? 'selected' : '' }}>Bordj Bou Arreridj</option>
                    <option value="Boumerdès" {{ request('location') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                    <option value="El Tarf" {{ request('location') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                    <option value="Tindouf" {{ request('location') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                    <option value="Tissemsilt" {{ request('location') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                    <option value="El Oued" {{ request('location') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                    <option value="Khenchela" {{ request('location') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                    <option value="Souk Ahras" {{ request('location') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                    <option value="Tipaza" {{ request('location') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                    <option value="Mila" {{ request('location') == 'Mila' ? 'selected' : '' }}>Mila</option>
                    <option value="Aïn Defla" {{ request('location') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                    <option value="Naâma" {{ request('location') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                    <option value="Aïn Témouchent" {{ request('location') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                    <option value="Ghardaïa" {{ request('location') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                    <option value="Relizane" {{ request('location') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
                </select>
            </div>
            
            {{-- Experience Dropdown --}}
            <div class="min-w-[120px] relative">
                <select name="experience" class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Expérience</option>
                    <option value="0-1 ans" {{ request('experience') == '0-1 ans' ? 'selected' : '' }}>0-1 an</option>
                    <option value="1-2 ans" {{ request('experience') == '1-2 ans' ? 'selected' : '' }}>1-2 ans</option>
                    <option value="2-3 ans" {{ request('experience') == '2-3 ans' ? 'selected' : '' }}>2-3 ans</option>
                    <option value="3-5 ans" {{ request('experience') == '3-5 ans' ? 'selected' : '' }}>3-5 ans</option>
                    <option value="5+ ans" {{ request('experience') == '5+ ans' ? 'selected' : '' }}>5+ ans</option>
                </select>
            </div>
            
            {{-- Skills Input --}}
            <div class="min-w-[150px] relative">
                <input type="text" name="skills" value="{{ request('skills') }}" placeholder="Compétence..." class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"/>
            </div>
            
            {{-- Action Buttons --}}
            <div class="flex items-center gap-2">
                <button type="submit" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                    Rechercher
                </button>
                <a href="{{ route('recruiter.candidates') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg transition-colors flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </a>
            </div>
        </div>
    </form>

    {{-- Results Count --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-sm sm:text-base text-[#9ca3af]">{{ $candidates->total() }} candidat(s) trouvé(s)</p>
        <form method="GET" action="{{ route('recruiter.candidates') }}" class="flex items-center gap-2">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('location'))
                <input type="hidden" name="location" value="{{ request('location') }}">
            @endif
            @if(request('experience'))
                <input type="hidden" name="experience" value="{{ request('experience') }}">
            @endif
            @if(request('skills'))
                <input type="hidden" name="skills" value="{{ request('skills') }}">
            @endif
            <select name="sort" onchange="this.form.submit()" class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récents</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Mieux notés</option>
                <option value="experience" {{ request('sort') == 'experience' ? 'selected' : '' }}>Expérience</option>
            </select>
        </form>
    </div>

    {{-- Candidates Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($candidates as $candidate)
            @if($candidate->candidateProfile)
                @php
                    $profile = $candidate->candidateProfile;
                    $initials = '';
                    if ($candidate->name) {
                        $nameParts = explode(' ', $candidate->name);
                        $initials = strtoupper(substr($nameParts[0], 0, 1));
                        if (count($nameParts) > 1) {
                            $initials .= strtoupper(substr($nameParts[1], 0, 1));
                        }
                    }
                
                // Parse skills - they are already cast as array in the model
                $skills = [];
                if ($profile && $profile->skills && is_array($profile->skills)) {
                    $skills = array_filter(array_map(function($skill) {
                        return is_string($skill) ? trim($skill) : (string) $skill;
                    }, $profile->skills));
                }
                
                // Parse experience - it's cast as array in the model
                $experienceText = 'Non spécifié';
                if ($profile && isset($profile->experience) && is_array($profile->experience) && !empty($profile->experience)) {
                    try {
                        // Convert all array elements to strings safely
                        $experienceStrings = array_map(function($item) {
                            if (is_string($item)) {
                                return $item;
                            } elseif (is_array($item)) {
                                return implode(', ', array_map('strval', $item));
                            } else {
                                return (string) $item;
                            }
                        }, $profile->experience);
                        
                        $experienceText = implode(', ', array_filter($experienceStrings));
                    } catch (Exception $e) {
                        $experienceText = 'Non spécifié';
                    }
                }
                
                // Parse education - show only the title of the first education entry
                $educationText = 'Non spécifié';
                if ($profile && isset($profile->education) && is_array($profile->education) && !empty($profile->education)) {
                    try {
                        $firstEducation = $profile->education[0];
                        
                        // If it's an array (structured education data), get the title/degree
                        if (is_array($firstEducation)) {
                            // Look for common title fields - prioritize degree field
                            $educationText = $firstEducation['degree'] ?? 
                                           $firstEducation['title'] ?? 
                                           $firstEducation['diploma'] ?? 
                                           $firstEducation['name'] ?? 
                                           'Non spécifié';
                            
                            // Clean up the text - remove extra spaces and ensure it's not empty
                            $educationText = trim($educationText);
                            if (empty($educationText)) {
                                $educationText = 'Non spécifié';
                            }
                        } elseif (is_string($firstEducation)) {
                            // If it's a string, use it directly
                            $educationText = trim($firstEducation);
                            if (empty($educationText)) {
                                $educationText = 'Non spécifié';
                            }
                        } else {
                            $educationText = 'Non spécifié';
                        }
                    } catch (Exception $e) {
                        $educationText = 'Non spécifié';
                    }
                }
                
                // Generate random rating for demo (4.0 to 5.0)
                $rating = number_format(4.0 + (rand(0, 10) / 10), 1);
                $fullStars = floor($rating);
                $hasHalfStar = ($rating - $fullStars) >= 0.5;
            @endphp
            
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:transform hover:scale-[1.02]">
                {{-- Profile Image --}}
                <div class="flex items-center gap-4 mb-4">
                    @if($profile->avatar)
                        <img src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border-2 border-[#00b6b4]">
                    @else
                        <div class="w-16 h-16 bg-[#00b6b4]/20 rounded-full flex items-center justify-center border-2 border-[#00b6b4]">
                            <span class="text-[#00b6b4] font-bold text-xl">{{ $initials ?: 'U' }}</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        {{-- Name --}}
                        <h3 class="text-xl font-bold text-[#f5f5f5] mb-1">{{ is_string($candidate->name) ? $candidate->name : 'Candidat' }}</h3>
                        
                        {{-- Titre professionnel --}}
                        <p class="text-[#00b6b4] font-medium mb-2">{{ $profile->bio ? 'Développeur Frontend React' : 'Développeur Frontend' }}</p>
                        
                        {{-- Rating Stars --}}
                        <div class="flex items-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <svg class="w-4 h-4 text-yellow-400 fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                                @else
                                    <svg class="w-4 h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/></svg>
                                @endif
                            @endfor
                            <span class="text-sm text-[#9ca3af]">({{ $rating }})</span>
                        </div>
                    </div>
                </div>

                {{-- À propos --}}
                <div class="mb-4">
                    <p class="text-[#f5f5f5] text-sm">{{ is_string($profile->bio ?? null) ? $profile->bio : 'Développeur passionné avec 3 ans d\'expérience en React et TypeScript.' }}</p>
                </div>

                {{-- Profile Details with Icons --}}
                <div class="space-y-2 mb-4">
                    {{-- Location --}}
                    <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>{{ is_string($profile->city ?? null) ? $profile->city : 'Alger, Chéraga' }}</span>
                    </div>

                    {{-- Experience --}}
                    <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        <span>{{ $profile->experience_years ?? '3 ans d\'expérience' }}</span>
                    </div>

                    {{-- Education --}}
                    <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        <span>{{ $educationText ?: 'Master en Informatique' }}</span>
                    </div>

                    {{-- Availability --}}
                    <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                        <span>Disponible: {{ $profile->availability ?? 'Immédiate' }}</span>
                    </div>
                </div>

                {{-- Compétences --}}
                @if(count($skills) > 0)
                    <div class="mb-4">
                        <p class="text-sm font-medium text-[#9ca3af] mb-2">Compétences:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(array_slice($skills, 0, 4) as $skill)
                                <span class="px-2 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-xs font-medium">{{ $skill }}</span>
                            @endforeach
                            @if(count($skills) > 4)
                                <span class="px-2 py-1 bg-[#333333] text-[#9ca3af] rounded-full text-xs font-medium">+{{ count($skills) - 4 }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Buttons --}}
                <div class="flex items-center gap-2">
                    <button class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Contacter
                    </button>
                    <a href="{{ route('recruiter.candidate.profile', $candidate->id) }}" class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Voir profil
                    </a>
                </div>
            </div>
            @endif
        @empty
            <div class="col-span-2 text-center py-12">
                <div class="w-16 h-16 bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucun candidat trouvé</h3>
                <p class="text-[#9ca3af] text-sm mb-4">Essayez de modifier vos critères de recherche</p>
                <a href="{{ route('recruiter.candidates') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Effacer les filtres
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($candidates->hasPages())
        <div class="flex justify-center mt-8">
            {{ $candidates->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection
