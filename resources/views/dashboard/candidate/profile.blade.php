@extends('layouts.dashboard')
@section('page-title', 'Mon profil')
@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-[#f5f5f5]">
            Mon Profil
        </h1>
        <div class="flex items-center gap-3">
            <button id="cancelBtn" class="hidden px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                Annuler
            </button>
            <button id="saveBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                Sauvegarder
            </button>
            <button id="editBtn" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
            </button>
        </div>
    </div>

    {{-- Profile Header --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex flex-col items-center lg:items-start">
                <div class="relative">
                    @if($profile->avatar)
                        <img id="avatarImage" src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#00b6b4]">
                    @else
                        <div id="avatarInitials" class="w-32 h-32 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white text-4xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr($user->name, strpos($user->name, ' ') + 1, 1)) }}
                        </div>
                    @endif
                    <label for="avatarUpload" class="absolute bottom-0 right-0 w-10 h-10 bg-[#00b6b4] rounded-full flex items-center justify-center text-white hover:bg-[#009999] transition-colors cursor-pointer">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                    </label>
                    <input id="avatarUpload" type="file" accept="image/*" class="hidden" />
                </div>
            </div>

            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                     <div>
                         <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                             Prénom
                         </label>
                         <div id="firstNameDisplay" class="text-lg font-semibold text-[#f5f5f5]">{{ explode(' ', $user->name)[0] ?? 'Prénom' }}</div>
                         <input id="firstName" type="text" value="{{ explode(' ', $user->name)[0] ?? '' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                     </div>

                     <div>
                         <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                             Nom
                         </label>
                         <div id="lastNameDisplay" class="text-lg font-semibold text-[#f5f5f5]">{{ explode(' ', $user->name)[1] ?? 'Nom' }}</div>
                         <input id="lastName" type="text" value="{{ explode(' ', $user->name)[1] ?? '' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                     </div>

                     <div>
                         <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                             Titre professionnel
                         </label>
                         <div id="titleDisplay" class="text-[#00b6b4] font-medium">{{ $profile->bio ? 'Développeur' : 'Développeur Frontend' }}</div>
                         <input id="title" type="text" value="{{ $profile->bio ? 'Développeur' : 'Développeur Frontend' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                     </div>

                     <div>
                         <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                             Localisation
                         </label>
                         <div id="locationDisplay" class="flex items-center gap-2 text-[#9ca3af]">
                             <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                             <span>{{ $profile->city ?? 'Alger, Algérie' }}</span>
                         </div>
                         <input id="location" type="text" value="{{ $profile->city ?? 'Alger, Algérie' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                     </div>
                </div>

                 <div class="mt-6">
                     <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                         À propos
                     </label>
                     <div id="bioDisplay" class="text-[#9ca3af]">{{ $profile->bio ?? 'Passionné par le développement web moderne et les nouvelles technologies.' }}</div>
                     <textarea id="bio" rows="3" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">{{ $profile->bio ?? 'Passionné par le développement web moderne et les nouvelles technologies.' }}</textarea>
                 </div>
            </div>
        </div>
    </div>

    {{-- Contact Information --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
            Informations de contact
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                 <div>
                     <p class="text-sm text-[#9ca3af]">Email</p>
                     <p class="font-medium text-[#f5f5f5]">{{ $user->email }}</p>
                 </div>
             </div>
             <div class="flex items-center gap-3">
                 <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                 <div>
                     <p class="text-sm text-[#9ca3af]">Téléphone</p>
                     <p id="phoneDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->phone ?? '+213 XXX XXX XXX' }}</p>
                     <input id="phone" type="text" value="{{ $profile->phone ?? '+213 XXX XXX XXX' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                 </div>
            </div>
        </div>
    </div>

    {{-- Experience --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#f5f5f5]">
                Expérience professionnelle
            </h2>
            <button id="addExperienceBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
         <div class="space-y-6" id="experienceContainer">
             @if($profile->experience && is_array($profile->experience))
                 @foreach($profile->experience as $index => $exp)
                     <div class="border-l-4 border-[#00b6b4] pl-6 relative">
                         <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeExperience({{ $index }})">
                             <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                         </button>
                         <div class="flex items-center gap-2 mb-2">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-5 h-5 text-[#00b6b4]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                             <h3 class="font-semibold text-[#f5f5f5]">{{ $exp['title'] ?? 'Titre du poste' }}</h3>
                         </div>
                         <p class="text-[#00b6b4] font-medium">{{ $exp['company'] ?? 'Entreprise' }}</p>
                         <p class="text-sm text-[#9ca3af] mb-2">{{ $exp['period'] ?? 'Période' }}</p>
                         <p class="text-[#9ca3af]">{{ $exp['description'] ?? 'Description' }}</p>
                     </div>
                 @endforeach
             @else
                 <div class="border-l-4 border-[#00b6b4] pl-6 relative">
                     <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600">
                         <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                     </button>
                     <div class="flex items-center gap-2 mb-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-5 h-5 text-[#00b6b4]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                         <h3 class="font-semibold text-[#f5f5f5]">Développeur Frontend</h3>
                     </div>
                     <p class="text-[#00b6b4] font-medium">TechCorp</p>
                     <p class="text-sm text-[#9ca3af] mb-2">2022 - Présent</p>
                     <p class="text-[#9ca3af]">Développement d'applications React et Vue.js</p>
                 </div>
             @endif
         </div>
    </div>

    {{-- Education --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#f5f5f5]">
                Formation
            </h2>
            <button id="addEducationBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
         <div class="space-y-6" id="educationContainer">
             @if($profile->education && is_array($profile->education))
                 @foreach($profile->education as $index => $edu)
                     <div class="border-l-4 border-[#009999] pl-6 relative">
                         <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeEducation({{ $index }})">
                             <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                         </button>
                         <div class="flex items-center gap-2 mb-2">
                             <svg class="w-5 h-5 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                             <h3 class="font-semibold text-[#f5f5f5]">{{ $edu['degree'] ?? 'Diplôme' }}</h3>
                         </div>
                         <p class="text-[#009999] font-medium">{{ $edu['school'] ?? 'École' }}</p>
                         <p class="text-sm text-[#9ca3af] mb-2">{{ $edu['period'] ?? 'Période' }}</p>
                         <p class="text-[#9ca3af]">{{ $edu['description'] ?? 'Description' }}</p>
                     </div>
                 @endforeach
             @else
                 <div class="border-l-4 border-[#009999] pl-6 relative">
                     <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600">
                         <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                     </button>
                     <div class="flex items-center gap-2 mb-2">
                         <svg class="w-5 h-5 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                         <h3 class="font-semibold text-[#f5f5f5]">Master en Informatique</h3>
                     </div>
                     <p class="text-[#009999] font-medium">Université d'Alger</p>
                     <p class="text-sm text-[#9ca3af] mb-2">2020 - 2022</p>
                     <p class="text-[#9ca3af]">Spécialisation en développement web</p>
                 </div>
             @endif
         </div>
    </div>

    {{-- Skills & Languages --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Skills --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#f5f5f5]">
                    Compétences
                </h2>
                <button id="addSkillBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter
                </button>
            </div>
             <div class="flex flex-wrap gap-2" id="skillsContainer">
                 @if($profile->skills && is_array($profile->skills))
                     @foreach($profile->skills as $skill)
                         <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                             {{ $skill }}
                             <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill('{{ $skill }}')">
                                 <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                             </button>
                         </span>
                     @endforeach
                 @else
                     <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                         React
                         <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill('React')">
                             <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                         </button>
                     </span>
                     <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                         TypeScript
                         <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill('TypeScript')">
                             <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                         </button>
                     </span>
                     <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                         Node.js
                         <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill('Node.js')">
                             <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                         </button>
                     </span>
                 @endif
             </div>
        </div>

        {{-- Languages --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-[#f5f5f5]">
                    Langues
                </h2>
                <button id="addLanguageBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter
                </button>
            </div>
            <div class="space-y-3" id="languagesContainer">
                @if($profile->languages && is_array($profile->languages))
                    @foreach($profile->languages as $index => $language)
                        <div class="flex items-center justify-between border border-[#444444] rounded-lg p-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                <span class="font-medium text-[#f5f5f5]">{{ $language['name'] ?? 'Langue' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-[#9ca3af]">{{ $language['level'] ?? 'Niveau' }}</span>
                                <button class="hidden text-red-500 hover:text-red-700" onclick="removeLanguage({{ $index }})">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            <span class="font-medium text-[#f5f5f5]">Français</span>
                        </div>
                        <span class="text-sm text-[#9ca3af]">Natif</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            <span class="font-medium text-[#f5f5f5]">Anglais</span>
                        </div>
                        <span class="text-sm text-[#9ca3af]">Avancé</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            <span class="font-medium text-[#f5f5f5]">Arabe</span>
                        </div>
                        <span class="text-sm text-[#9ca3af]">Natif</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.getElementById('editBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveBtn = document.getElementById('saveBtn');
        const addExperienceBtn = document.getElementById('addExperienceBtn');
        const addEducationBtn = document.getElementById('addEducationBtn');
        const addSkillBtn = document.getElementById('addSkillBtn');
        const addLanguageBtn = document.getElementById('addLanguageBtn');
        const avatarUpload = document.getElementById('avatarUpload');
    
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], textarea');
    const displays = document.querySelectorAll('[id$="Display"]');
    const skillButtons = document.querySelectorAll('#skillsContainer button');
    
    let isEditing = false;
    
    function toggleEditMode() {
        isEditing = !isEditing;
        
        
        if (isEditing) {
            // Show edit mode
            editBtn.classList.add('hidden');
            cancelBtn.classList.remove('hidden');
            saveBtn.classList.remove('hidden');
            addExperienceBtn.classList.remove('hidden');
            addEducationBtn.classList.remove('hidden');
            addSkillBtn.classList.remove('hidden');
            addLanguageBtn.classList.remove('hidden');
            
            // Show inputs, hide displays
            inputs.forEach(input => input.classList.remove('hidden'));
            displays.forEach(display => display.classList.add('hidden'));
            
            // Show skill delete buttons
            skillButtons.forEach(btn => btn.classList.remove('hidden'));
        } else {
            // Show view mode
            editBtn.classList.remove('hidden');
            cancelBtn.classList.add('hidden');
            saveBtn.classList.add('hidden');
            addExperienceBtn.classList.add('hidden');
            addEducationBtn.classList.add('hidden');
            addSkillBtn.classList.add('hidden');
            addLanguageBtn.classList.add('hidden');
            
            // Hide inputs, show displays
            inputs.forEach(input => input.classList.add('hidden'));
            displays.forEach(display => display.classList.remove('hidden'));
            
            // Hide skill delete buttons
            skillButtons.forEach(btn => btn.classList.add('hidden'));
        }
    }
    
    editBtn.addEventListener('click', toggleEditMode);
    cancelBtn.addEventListener('click', toggleEditMode);
     saveBtn.addEventListener('click', function() {
         // Collect form data
         const formData = new FormData();
         formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
         formData.append('_method', 'PUT');
         formData.append('firstName', document.getElementById('firstName').value);
         formData.append('lastName', document.getElementById('lastName').value);
         formData.append('title', document.getElementById('title').value);
         formData.append('location', document.getElementById('location').value);
         formData.append('bio', document.getElementById('bio').value);
         const phoneValue = document.getElementById('phone').value;
         console.log('Phone value:', phoneValue);
         formData.append('phone', phoneValue);
         
         // Add avatar file if selected
         if (avatarUpload.files[0]) {
             formData.append('avatar', avatarUpload.files[0]);
         }
         
         // Collect experience data
         const experienceData = [];
         const experienceItems = document.querySelectorAll('#experienceContainer .border-l-4');
         experienceItems.forEach(item => {
             const titleInput = item.querySelector('input[placeholder="Titre du poste"]');
             const companyInput = item.querySelector('input[placeholder="Entreprise"]');
             const periodInput = item.querySelector('input[placeholder*="Période"]');
             const descriptionInput = item.querySelector('textarea[placeholder="Description"]');
             
             let title, company, period, description;
             
             if (titleInput) {
                 // New entry with input fields
                 title = titleInput.value.trim();
                 company = companyInput?.value?.trim() || '';
                 period = periodInput?.value?.trim() || '';
                 description = descriptionInput?.value?.trim() || '';
             } else {
                 // Existing entry with text content
                 title = item.querySelector('h3')?.textContent?.trim() || '';
                 company = item.querySelector('.text-\\[\\#00b6b4\\]')?.textContent?.trim() || '';
                 period = item.querySelector('.text-sm')?.textContent?.trim() || '';
                 description = item.querySelector('.text-\\[\\#9ca3af\\]')?.textContent?.trim() || '';
             }
             
             if (title && company) {
                 experienceData.push({
                     title: title,
                     company: company,
                     period: period,
                     description: description
                 });
             }
         });
         formData.append('experience', JSON.stringify(experienceData));
         
         // Collect education data
         const educationData = [];
         const educationItems = document.querySelectorAll('#educationContainer .border-l-4');
         educationItems.forEach(item => {
             const degreeInput = item.querySelector('input[placeholder="Diplôme"]');
             const schoolInput = item.querySelector('input[placeholder="École/Université"]');
             const periodInput = item.querySelector('input[placeholder*="Période"]');
             const descriptionInput = item.querySelector('textarea[placeholder="Description"]');
             
             let degree, school, period, description;
             
             if (degreeInput) {
                 // New entry with input fields
                 degree = degreeInput.value.trim();
                 school = schoolInput?.value?.trim() || '';
                 period = periodInput?.value?.trim() || '';
                 description = descriptionInput?.value?.trim() || '';
             } else {
                 // Existing entry with text content
                 degree = item.querySelector('h3')?.textContent?.trim() || '';
                 school = item.querySelector('.text-\\[\\#009999\\]')?.textContent?.trim() || '';
                 period = item.querySelector('.text-sm')?.textContent?.trim() || '';
                 description = item.querySelector('.text-\\[\\#9ca3af\\]')?.textContent?.trim() || '';
             }
             
             if (degree && school) {
                 educationData.push({
                     degree: degree,
                     school: school,
                     period: period,
                     description: description
                 });
             }
         });
         formData.append('education', JSON.stringify(educationData));
         
         // Collect skills data
         const skillsData = [];
         const skillItems = document.querySelectorAll('#skillsContainer span');
         skillItems.forEach(item => {
             const skillInput = item.querySelector('input[placeholder="Nouvelle compétence"]');
             if (skillInput) {
                 const skillText = skillInput.value.trim();
                 if (skillText) {
                     skillsData.push(skillText);
                 }
             } else {
                 // Handle existing skills (not input fields)
                 const skillText = item.textContent.trim();
                 if (skillText && !skillText.includes('×') && !skillText.includes('Ajouter')) {
                     skillsData.push(skillText);
                 }
             }
         });
         formData.append('skills', JSON.stringify(skillsData));
         
         // Collect languages data
         const languagesData = [];
         const languageItems = document.querySelectorAll('#languagesContainer .flex.items-center.justify-between');
         languageItems.forEach(item => {
             const nameInput = item.querySelector('input[placeholder="Nom de la langue"]');
             const levelElement = item.querySelector('select');
             
             if (nameInput && levelElement) {
                 const name = nameInput.value.trim();
                 const level = levelElement.value;
                 if (name) {
                     languagesData.push({
                         name: name,
                         level: level
                     });
                 }
             } else {
                 // Handle existing languages (not input fields)
                 const nameElement = item.querySelector('span.font-medium');
                 if (nameElement && levelElement) {
                     languagesData.push({
                         name: nameElement.textContent.trim(),
                         level: levelElement.value
                     });
                 }
             }
         });
         formData.append('languages', JSON.stringify(languagesData));
         
         console.log('Sending profile update request...');
         console.log('Form data:', Object.fromEntries(formData));
         console.log('Skills data:', skillsData);
         console.log('Experience data:', experienceData);
         console.log('Education data:', educationData);
         console.log('Languages data:', languagesData);
         console.log('Experience items found:', document.querySelectorAll('#experienceContainer .border-l-4').length);
         console.log('Education items found:', document.querySelectorAll('#educationContainer .border-l-4').length);
         
         // Send to backend
         fetch('{{ route("candidate.profile.update") }}', {
             method: 'POST',
             body: formData,
             headers: {
                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                 'Accept': 'application/json'
             }
         })
         .then(response => {
             console.log('Response status:', response.status);
             console.log('Response headers:', response.headers);
             
             if (!response.ok) {
                 return response.text().then(text => {
                     console.error('Error response:', text);
                     throw new Error(`HTTP ${response.status}: ${text}`);
                 });
             }
             return response.json();
         })
         .then(data => {
             if (data.success) {
                 // Update display values
                 document.getElementById('firstNameDisplay').textContent = document.getElementById('firstName').value;
                 document.getElementById('lastNameDisplay').textContent = document.getElementById('lastName').value;
                 document.getElementById('titleDisplay').textContent = document.getElementById('title').value;
                 document.getElementById('locationDisplay').querySelector('span').textContent = document.getElementById('location').value;
                 document.getElementById('bioDisplay').textContent = document.getElementById('bio').value;
                 document.getElementById('phoneDisplay').textContent = document.getElementById('phone').value;
                 
                 alert('Profil sauvegardé avec succès!');
                 toggleEditMode();
             } else {
                 console.error('Server error:', data);
                 alert('Erreur lors de la sauvegarde: ' + (data.message || data.debug || 'Erreur inconnue'));
             }
         })
         .catch(error => {
             console.error('Error:', error);
             alert('Erreur lors de la sauvegarde: ' + error.message);
         });
     });
    
        addExperienceBtn.addEventListener('click', function() {
            const container = document.getElementById('experienceContainer');
            const newExp = document.createElement('div');
            newExp.className = 'border-l-4 border-[#00b6b4] pl-6 relative';
            newExp.innerHTML = `
                <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeExperience(${container.children.length})">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-5 h-5 text-[#00b6b4]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <input type="text" placeholder="Titre du poste" class="bg-transparent border-none text-lg font-semibold text-[#f5f5f5] w-full focus:outline-none" />
                </div>
                <input type="text" placeholder="Entreprise" class="text-[#00b6b4] font-medium bg-transparent border-none w-full focus:outline-none mb-2" />
                <input type="text" placeholder="Période (ex: 2022 - Présent)" class="text-sm text-[#9ca3af] bg-transparent border-none w-full focus:outline-none mb-2" />
                <textarea placeholder="Description" class="text-[#9ca3af] bg-transparent border-none w-full focus:outline-none" rows="2"></textarea>
            `;
            container.appendChild(newExp);
        });
    
    addEducationBtn.addEventListener('click', function() {
        const container = document.getElementById('educationContainer');
        const newEdu = document.createElement('div');
        newEdu.className = 'border-l-4 border-[#009999] pl-6 relative';
        newEdu.innerHTML = `
            <button class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeEducation(${container.children.length})">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </button>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                <input type="text" placeholder="Diplôme" class="bg-transparent border-none text-lg font-semibold text-[#f5f5f5] w-full focus:outline-none" />
            </div>
            <input type="text" placeholder="École/Université" class="text-[#009999] font-medium bg-transparent border-none w-full focus:outline-none mb-2" />
            <input type="text" placeholder="Période (ex: 2020 - 2022)" class="text-sm text-[#9ca3af] bg-transparent border-none w-full focus:outline-none mb-2" />
            <textarea placeholder="Description" class="text-[#9ca3af] bg-transparent border-none w-full focus:outline-none" rows="2"></textarea>
        `;
        container.appendChild(newEdu);
    });
    
    addSkillBtn.addEventListener('click', function() {
        const container = document.getElementById('skillsContainer');
        const newSkill = document.createElement('span');
        newSkill.className = 'px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2';
        newSkill.innerHTML = `
            <input type="text" placeholder="Nouvelle compétence" class="bg-transparent border-none text-[#00b6b4] text-sm font-medium w-32 focus:outline-none" />
            <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill(this)">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
        `;
        container.appendChild(newSkill);
    });
    
        addLanguageBtn.addEventListener('click', function() {
            const container = document.getElementById('languagesContainer');
            const newLanguage = document.createElement('div');
            newLanguage.className = 'flex items-center justify-between border border-[#444444] rounded-lg p-3';
            newLanguage.innerHTML = `
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    <input type="text" placeholder="Nom de la langue" class="bg-transparent border-none font-medium text-[#f5f5f5] w-32 focus:outline-none" />
                </div>
                <div class="flex items-center gap-2">
                    <select class="bg-[#333333] border border-[#444444] rounded px-2 py-1 text-[#f5f5f5] text-sm">
                        <option value="Débutant">Débutant</option>
                        <option value="Intermédiaire">Intermédiaire</option>
                        <option value="Avancé">Avancé</option>
                        <option value="Natif">Natif</option>
                    </select>
                    <button class="hidden text-red-500 hover:text-red-700" onclick="removeLanguage(this)">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </div>
            `;
            container.appendChild(newLanguage);
        });
        
        // Avatar upload functionality
        avatarUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Veuillez sélectionner un fichier image valide.');
                    return;
                }
                
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('La taille du fichier ne doit pas dépasser 2MB.');
                    return;
                }
                
                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarContainer = document.querySelector('.relative');
                    const existingImage = document.getElementById('avatarImage');
                    const existingInitials = document.getElementById('avatarInitials');
                    
                    if (existingImage) {
                        existingImage.src = e.target.result;
                    } else if (existingInitials) {
                        // Replace initials with image
                        const newImage = document.createElement('img');
                        newImage.id = 'avatarImage';
                        newImage.src = e.target.result;
                        newImage.alt = 'Avatar';
                        newImage.className = 'w-32 h-32 rounded-full object-cover border-4 border-[#00b6b4]';
                        existingInitials.parentNode.replaceChild(newImage, existingInitials);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    
});

 function removeSkill(button) {
     if (confirm('Êtes-vous sûr de vouloir supprimer cette compétence?')) {
         const skillElement = button.closest('span');
         skillElement.remove();
     }
 }

    function removeExperience(index) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette expérience?')) {
            const container = document.getElementById('experienceContainer');
            const items = container.querySelectorAll('.border-l-4');
            if (items[index]) {
                items[index].remove();
            }
        }
    }

    function removeEducation(index) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette formation?')) {
            const container = document.getElementById('educationContainer');
            const items = container.querySelectorAll('.border-l-4');
            if (items[index]) {
                items[index].remove();
            }
        }
    }

 function removeLanguage(button) {
     if (confirm('Êtes-vous sûr de vouloir supprimer cette langue?')) {
         const languageElement = button.closest('.flex.items-center.justify-between');
         languageElement.remove();
     }
 }
</script>
@endsection