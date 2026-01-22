@extends('layouts.dashboard')

@section('title', 'Publier une offre d\'emploi - OMPLEO')
@section('description', 'Créez une offre attractive pour trouver les meilleurs talents.')
@section('page-title', 'Publier une offre d\'emploi')

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div id="successNotification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="errorNotification" class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                Publier une offre d'emploi
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Créez une offre attractive pour trouver les meilleurs talents
            </p>
        </div>
    </div>

    {{-- Form --}}
    <form id="createOfferForm" action="{{ route('recruiter.create-offer.store') }}" method="POST" class="space-y-4 sm:space-y-6 md:space-y-8">
        @csrf
        {{-- Basic Information --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] mb-3 sm:mb-4 md:mb-6">
                Informations de base
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 md:gap-6">
                <div>
                    <label for="title" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Titre du poste *
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Ex: Développeur Frontend React"
                    />
                </div>
                
                <div>
                    <label for="department" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Département
                    </label>
                    <input
                        type="text"
                        id="department"
                        name="department"
                        class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Ex: Développement, Marketing, RH"
                    />
                </div>
                
                <div>
                    <label for="location" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Localisation *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <select
                            id="location"
                            name="location"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        >
                            <option value="">Sélectionner une ville</option>
                            <option value="Adrar">Adrar</option>
                            <option value="Chlef">Chlef</option>
                            <option value="Laghouat">Laghouat</option>
                            <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                            <option value="Batna">Batna</option>
                            <option value="Béjaïa">Béjaïa</option>
                            <option value="Biskra">Biskra</option>
                            <option value="Béchar">Béchar</option>
                            <option value="Blida">Blida</option>
                            <option value="Bouira">Bouira</option>
                            <option value="Tamanrasset">Tamanrasset</option>
                            <option value="Tébessa">Tébessa</option>
                            <option value="Tlemcen">Tlemcen</option>
                            <option value="Tiaret">Tiaret</option>
                            <option value="Tizi Ouzou">Tizi Ouzou</option>
                            <option value="Alger">Alger</option>
                            <option value="Djelfa">Djelfa</option>
                            <option value="Jijel">Jijel</option>
                            <option value="Sétif">Sétif</option>
                            <option value="Saïda">Saïda</option>
                            <option value="Skikda">Skikda</option>
                            <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                            <option value="Annaba">Annaba</option>
                            <option value="Guelma">Guelma</option>
                            <option value="Constantine">Constantine</option>
                            <option value="Médéa">Médéa</option>
                            <option value="Mostaganem">Mostaganem</option>
                            <option value="M'Sila">M'Sila</option>
                            <option value="Mascara">Mascara</option>
                            <option value="Ouargla">Ouargla</option>
                            <option value="Oran">Oran</option>
                            <option value="El Bayadh">El Bayadh</option>
                            <option value="Illizi">Illizi</option>
                            <option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
                            <option value="Boumerdès">Boumerdès</option>
                            <option value="El Tarf">El Tarf</option>
                            <option value="Tindouf">Tindouf</option>
                            <option value="Tissemsilt">Tissemsilt</option>
                            <option value="El Oued">El Oued</option>
                            <option value="Khenchela">Khenchela</option>
                            <option value="Souk Ahras">Souk Ahras</option>
                            <option value="Tipaza">Tipaza</option>
                            <option value="Mila">Mila</option>
                            <option value="Aïn Defla">Aïn Defla</option>
                            <option value="Naâma">Naâma</option>
                            <option value="Aïn Témouchent">Aïn Témouchent</option>
                            <option value="Ghardaïa">Ghardaïa</option>
                            <option value="Relizane">Relizane</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="experience" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Expérience requise *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <select
                            id="experience"
                            name="experience"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        >
                            <option value="">Sélectionner l'expérience</option>
                            <option value="0-1 ans">0-1 ans</option>
                            <option value="1-2 ans">1-2 ans</option>
                            <option value="2-3 ans">2-3 ans</option>
                            <option value="3-5 ans">3-5 ans</option>
                            <option value="5-7 ans">5-7 ans</option>
                            <option value="7-10 ans">7-10 ans</option>
                            <option value="10+ ans">10+ ans</option>
                            <option value="Débutant">Débutant</option>
                            <option value="Junior">Junior</option>
                            <option value="Intermédiaire">Intermédiaire</option>
                            <option value="Senior">Senior</option>
                            <option value="Expert">Expert</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="type" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Type de contrat *
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        <select
                            id="type"
                            name="type"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        >
                            <option value="CDI">CDI</option>
                            <option value="CDD">CDD</option>
                            <option value="Stage">Stage</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Alternance">Alternance</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="workType" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Mode de travail *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                            <path d="M10 6h4"/>
                            <path d="M10 10h4"/>
                            <path d="M10 14h4"/>
                            <path d="M10 18h4"/>
                        </svg>
                        <select
                            id="workType"
                            name="workType"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        >
                            <option value="onsite">Présentiel</option>
                            <option value="remote">Télétravail</option>
                            <option value="hybrid">Hybride</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label for="salaryMin" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Salaire minimum (DA) *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" x2="12" y1="2" y2="22"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <input
                            type="number"
                            id="salaryMin"
                            name="salary_min"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                            placeholder="Ex: 60000"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="salaryMax" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Salaire maximum (DA) *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" x2="12" y1="2" y2="22"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <input
                            type="number"
                            id="salaryMax"
                            name="salary_max"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                            placeholder="Ex: 80000"
                        />
                    </div>
                </div>
                
                <div>
                    <label for="expiryDate" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                        Date d'expiration *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        <input
                            type="date"
                            id="expiryDate"
                            name="expiryDate"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        />
                    </div>
                </div>
                
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="featured"
                        name="featured"
                        class="w-4 h-4 text-[#00b6b4] border-[#444444] rounded focus:ring-[#00b6b4] bg-[#333333] flex-shrink-0"
                    />
                    <label for="featured" class="ml-2 text-xs sm:text-sm text-[#9ca3af] flex items-center gap-1 sm:gap-2 flex-wrap">
                        <span>Mettre en avant cette offre</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-yellow-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26 12,2"/>
                        </svg>
                        <span class="text-xs text-[#9ca3af]">(+1000 DA)</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] mb-3 sm:mb-4 md:mb-6">
                Description du poste
            </h2>
            
            <div>
                <label for="description" class="block text-xs sm:text-sm font-medium text-[#9ca3af] mb-1 sm:mb-2">
                    Description détaillée *
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                    placeholder="Décrivez le poste, l'entreprise et le profil recherché..."
                ></textarea>
            </div>
        </div>

        {{-- Responsibilities --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                    Responsabilités
                </h2>
                <button
                    type="button"
                    onclick="addResponsibility()"
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </button>
            </div>
            
            <div id="responsibilitiesContainer" class="space-y-2 sm:space-y-3 md:space-y-4">
                <div class="flex items-center gap-2 sm:gap-3">
                    <input
                        type="text"
                        name="responsibilities[]"
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Responsabilité 1"
                    />
                    <button
                        type="button"
                        onclick="removeResponsibility(this)"
                        class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                        disabled
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Requirements --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                    Exigences
                </h2>
                <button
                    type="button"
                    onclick="addRequirement()"
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </button>
            </div>
            
            <div id="requirementsContainer" class="space-y-2 sm:space-y-3 md:space-y-4">
                <div class="flex items-center gap-2 sm:gap-3">
                    <input
                        type="text"
                        name="requirements[]"
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Exigence 1"
                    />
                    <button
                        type="button"
                        onclick="removeRequirement(this)"
                        class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                        disabled
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Benefits --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                    Avantages
                </h2>
                <button
                    type="button"
                    onclick="addBenefit()"
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </button>
            </div>
            
            <div id="benefitsContainer" class="space-y-2 sm:space-y-3 md:space-y-4">
                <div class="flex items-center gap-2 sm:gap-3">
                    <input
                        type="text"
                        name="benefits[]"
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Avantage 1"
                    />
                    <button
                        type="button"
                        onclick="removeBenefit(this)"
                        class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                        disabled
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Skills --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                    Compétences requises
                </h2>
                <button
                    type="button"
                    onclick="addSkill()"
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white p-1.5 sm:p-2 rounded-lg transition-colors duration-200"
                >
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"/>
                        <path d="M12 5v14"/>
                    </svg>
                </button>
            </div>
            
            <div id="skillsContainer" class="space-y-2 sm:space-y-3 md:space-y-4">
                <div class="flex items-center gap-2 sm:gap-3">
                    <input
                        type="text"
                        name="skills[]"
                        class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                        placeholder="Compétence 1"
                    />
                    <button
                        type="button"
                        onclick="removeSkill(this)"
                        class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
                        disabled
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex flex-row items-center justify-end gap-2 sm:gap-3 md:gap-4 create-offer-buttons">
            <style>
                /* Desktop is default - buttons on same line */
                @media (max-width: 767px) {
                    .create-offer-buttons {
                        flex-wrap: wrap !important;
                    }
                }
            </style>
            <button
                type="button"
                onclick="window.location.href='{{ route('recruiter.jobs') }}'"
                class="px-3 sm:px-4 md:px-6 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] hover:text-[#f5f5f5] transition-colors duration-200 text-xs sm:text-sm md:text-base"
            >
                Annuler
            </button>
            
            <button
                type="submit"
                name="save_draft"
                value="1"
                class="px-3 sm:px-4 py-2 sm:py-2.5 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] hover:text-[#f5f5f5] transition-colors duration-200 flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base"
            >
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17,21 17,13 7,13 7,21"/>
                    <polyline points="7,3 7,8 15,8"/>
                </svg>
                <span class="hidden sm:inline">Enregistrer brouillon</span>
                <span class="sm:hidden">Brouillon</span>
            </button>
            
            <button
                type="submit"
                class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 sm:px-6 md:px-8 py-2 sm:py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base"
            >
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17,21 17,13 7,13 7,21"/>
                    <polyline points="7,3 7,8 15,8"/>
                </svg>
                <span class="hidden sm:inline">Publier l'offre</span>
                <span class="sm:hidden">Publier</span>
            </button>
        </div>
    </form>
</div>

<script>
let responsibilityCount = 1;
let requirementCount = 1;
let benefitCount = 1;
let skillCount = 1;

function addResponsibility() {
    responsibilityCount++;
    const container = document.getElementById('responsibilitiesContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="responsibilities[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
            placeholder="Responsabilité ${responsibilityCount}"
        />
        <button
            type="button"
            onclick="removeResponsibility(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateRemoveButtons('responsibilitiesContainer');
}

function removeResponsibility(button) {
    button.parentElement.remove();
    updateRemoveButtons('responsibilitiesContainer');
}

function addRequirement() {
    requirementCount++;
    const container = document.getElementById('requirementsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="requirements[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
            placeholder="Exigence ${requirementCount}"
        />
        <button
            type="button"
            onclick="removeRequirement(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateRemoveButtons('requirementsContainer');
}

function removeRequirement(button) {
    button.parentElement.remove();
    updateRemoveButtons('requirementsContainer');
}

function addBenefit() {
    benefitCount++;
    const container = document.getElementById('benefitsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="benefits[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
            placeholder="Avantage ${benefitCount}"
        />
        <button
            type="button"
            onclick="removeBenefit(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateRemoveButtons('benefitsContainer');
}

function removeBenefit(button) {
    button.parentElement.remove();
    updateRemoveButtons('benefitsContainer');
}

function addSkill() {
    skillCount++;
    const container = document.getElementById('skillsContainer');
    const newDiv = document.createElement('div');
    newDiv.className = 'flex items-center gap-2 sm:gap-3';
    newDiv.innerHTML = `
        <input
            type="text"
            name="skills[]"
            class="flex-1 px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
            placeholder="Compétence ${skillCount}"
        />
        <button
            type="button"
            onclick="removeSkill(this)"
            class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200"
        >
            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/>
            </svg>
        </button>
    `;
    container.appendChild(newDiv);
    updateRemoveButtons('skillsContainer');
}

function removeSkill(button) {
    button.parentElement.remove();
    updateRemoveButtons('skillsContainer');
}

function updateRemoveButtons(containerId) {
    const container = document.getElementById(containerId);
    const buttons = container.querySelectorAll('button[onclick*="remove"]');
    buttons.forEach((button, index) => {
        button.disabled = buttons.length <= 1;
    });
}

// Draft saving is now handled by the form submission

// Form will submit normally to the server

// Form submission is handled by the server

// Show notification animation
document.addEventListener('DOMContentLoaded', function() {
    const successNotification = document.getElementById('successNotification');
    const errorNotification = document.getElementById('errorNotification');
    
    if (successNotification) {
        // Show notification
        setTimeout(() => {
            successNotification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            successNotification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                successNotification.remove();
            }, 300);
        }, 3000);
    }
    
    if (errorNotification) {
        // Show notification
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto hide after 4 seconds
        setTimeout(() => {
            errorNotification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                errorNotification.remove();
            }, 300);
        }, 4000);
    }
});
</script>
@endsection
