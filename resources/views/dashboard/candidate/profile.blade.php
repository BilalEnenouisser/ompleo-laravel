@extends('layouts.dashboard')
@section('page-title', 'Mon profil')
@section('content')
@php
    use Illuminate\Support\Facades\Storage;
    $isOwnProfile = $candidate->id === auth()->id();
@endphp
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#f5f5f5]">
                @if($isOwnProfile)
                    Mon Profil
                @else
                    Profil de {{ $candidate->name }}
                @endif
            </h1>
            @if(!$isOwnProfile)
                <div class="flex items-center gap-2 mt-2">
                    <a href="{{ url()->previous() }}" class="text-[#9ca3af] hover:text-[#00b6b4] transition-colors flex items-center gap-1">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>
                        Retour
                    </a>
                </div>
            @endif
        </div>
        @if($isOwnProfile)
        <div class="flex items-center gap-3">
            <button id="cancelBtn" class="hidden px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                Annuler
            </button>
            <button id="saveBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                Sauvegarder
            </button>
            <button id="editBtn" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
            </button>
        </div>
        @endif
    </div>

    <!-- Custom Glass Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white bg-opacity-10 backdrop-blur-md border border-white border-opacity-20 rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div id="modalIcon" class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500 bg-opacity-20 backdrop-blur-sm mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-white mb-2" id="confirmTitle">Confirmer la suppression</h3>
                <p class="text-white text-opacity-80 mb-6" id="confirmMessage">Êtes-vous sûr de vouloir supprimer cet élément ? Cette action ne peut pas être annulée.</p>
                <div class="flex gap-3 justify-center">
                    <button id="confirmCancel" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300 border border-white border-opacity-30">
                        Annuler
                    </button>
                    <button id="confirmOk" class="bg-red-500 bg-opacity-80 hover:bg-opacity-100 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Profile Header --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex flex-col items-center lg:items-start">
                <div class="relative" id="avatar-container">
                    @if($profile->avatar)
                        <img id="avatarImage" src="{{ Storage::url($profile->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#00b6b4]">
                    @else
                        <div id="avatarInitials" class="w-32 h-32 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white text-4xl font-bold">
                            {{ strtoupper(substr($candidate->name, 0, 1)) }}{{ strtoupper(substr($candidate->name, strpos($candidate->name, ' ') + 1, 1)) }}
                    </div>
                    @endif
                    <label for="avatarUpload" id="avatarUploadBtn" class="hidden absolute bottom-0 right-0 w-10 h-10 bg-[#00b6b4] rounded-full flex items-center justify-center text-white hover:bg-[#009999] transition-colors cursor-pointer">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
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
                         <div id="firstNameDisplay" class="text-lg font-semibold text-[#f5f5f5]">{{ explode(' ', $candidate->name)[0] ?? 'Prénom' }}</div>
                         <input id="firstName" type="text" value="{{ explode(' ', $candidate->name)[0] ?? '' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Nom
                        </label>
                         <div id="lastNameDisplay" class="text-lg font-semibold text-[#f5f5f5]">{{ explode(' ', $candidate->name)[1] ?? 'Nom' }}</div>
                         <input id="lastName" type="text" value="{{ explode(' ', $candidate->name)[1] ?? '' }}" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
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
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                             <span>{{ $profile->city ?? 'Alger' }}</span>
                        </div>
                         <select id="location" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                            <option value="">Sélectionner une ville</option>
                            <option value="Adrar" {{ ($profile->city ?? '') == 'Adrar' ? 'selected' : '' }}>Adrar</option>
                            <option value="Chlef" {{ ($profile->city ?? '') == 'Chlef' ? 'selected' : '' }}>Chlef</option>
                            <option value="Laghouat" {{ ($profile->city ?? '') == 'Laghouat' ? 'selected' : '' }}>Laghouat</option>
                            <option value="Oum El Bouaghi" {{ ($profile->city ?? '') == 'Oum El Bouaghi' ? 'selected' : '' }}>Oum El Bouaghi</option>
                            <option value="Batna" {{ ($profile->city ?? '') == 'Batna' ? 'selected' : '' }}>Batna</option>
                            <option value="Béjaïa" {{ ($profile->city ?? '') == 'Béjaïa' ? 'selected' : '' }}>Béjaïa</option>
                            <option value="Biskra" {{ ($profile->city ?? '') == 'Biskra' ? 'selected' : '' }}>Biskra</option>
                            <option value="Béchar" {{ ($profile->city ?? '') == 'Béchar' ? 'selected' : '' }}>Béchar</option>
                            <option value="Blida" {{ ($profile->city ?? '') == 'Blida' ? 'selected' : '' }}>Blida</option>
                            <option value="Bouira" {{ ($profile->city ?? '') == 'Bouira' ? 'selected' : '' }}>Bouira</option>
                            <option value="Tamanrasset" {{ ($profile->city ?? '') == 'Tamanrasset' ? 'selected' : '' }}>Tamanrasset</option>
                            <option value="Tébessa" {{ ($profile->city ?? '') == 'Tébessa' ? 'selected' : '' }}>Tébessa</option>
                            <option value="Tlemcen" {{ ($profile->city ?? '') == 'Tlemcen' ? 'selected' : '' }}>Tlemcen</option>
                            <option value="Tiaret" {{ ($profile->city ?? '') == 'Tiaret' ? 'selected' : '' }}>Tiaret</option>
                            <option value="Tizi Ouzou" {{ ($profile->city ?? '') == 'Tizi Ouzou' ? 'selected' : '' }}>Tizi Ouzou</option>
                            <option value="Alger" {{ ($profile->city ?? 'Alger') == 'Alger' ? 'selected' : '' }}>Alger</option>
                            <option value="Djelfa" {{ ($profile->city ?? '') == 'Djelfa' ? 'selected' : '' }}>Djelfa</option>
                            <option value="Jijel" {{ ($profile->city ?? '') == 'Jijel' ? 'selected' : '' }}>Jijel</option>
                            <option value="Sétif" {{ ($profile->city ?? '') == 'Sétif' ? 'selected' : '' }}>Sétif</option>
                            <option value="Saïda" {{ ($profile->city ?? '') == 'Saïda' ? 'selected' : '' }}>Saïda</option>
                            <option value="Skikda" {{ ($profile->city ?? '') == 'Skikda' ? 'selected' : '' }}>Skikda</option>
                            <option value="Sidi Bel Abbès" {{ ($profile->city ?? '') == 'Sidi Bel Abbès' ? 'selected' : '' }}>Sidi Bel Abbès</option>
                            <option value="Annaba" {{ ($profile->city ?? '') == 'Annaba' ? 'selected' : '' }}>Annaba</option>
                            <option value="Guelma" {{ ($profile->city ?? '') == 'Guelma' ? 'selected' : '' }}>Guelma</option>
                            <option value="Constantine" {{ ($profile->city ?? '') == 'Constantine' ? 'selected' : '' }}>Constantine</option>
                            <option value="Médéa" {{ ($profile->city ?? '') == 'Médéa' ? 'selected' : '' }}>Médéa</option>
                            <option value="Mostaganem" {{ ($profile->city ?? '') == 'Mostaganem' ? 'selected' : '' }}>Mostaganem</option>
                            <option value="M'Sila" {{ ($profile->city ?? '') == "M'Sila" ? 'selected' : '' }}>M'Sila</option>
                            <option value="Mascara" {{ ($profile->city ?? '') == 'Mascara' ? 'selected' : '' }}>Mascara</option>
                            <option value="Ouargla" {{ ($profile->city ?? '') == 'Ouargla' ? 'selected' : '' }}>Ouargla</option>
                            <option value="Oran" {{ ($profile->city ?? '') == 'Oran' ? 'selected' : '' }}>Oran</option>
                            <option value="El Bayadh" {{ ($profile->city ?? '') == 'El Bayadh' ? 'selected' : '' }}>El Bayadh</option>
                            <option value="Illizi" {{ ($profile->city ?? '') == 'Illizi' ? 'selected' : '' }}>Illizi</option>
                            <option value="Bordj Bou Arreridj" {{ ($profile->city ?? '') == 'Bordj Bou Arreridj' ? 'selected' : '' }}>Bordj Bou Arreridj</option>
                            <option value="Boumerdès" {{ ($profile->city ?? '') == 'Boumerdès' ? 'selected' : '' }}>Boumerdès</option>
                            <option value="El Tarf" {{ ($profile->city ?? '') == 'El Tarf' ? 'selected' : '' }}>El Tarf</option>
                            <option value="Tindouf" {{ ($profile->city ?? '') == 'Tindouf' ? 'selected' : '' }}>Tindouf</option>
                            <option value="Tissemsilt" {{ ($profile->city ?? '') == 'Tissemsilt' ? 'selected' : '' }}>Tissemsilt</option>
                            <option value="El Oued" {{ ($profile->city ?? '') == 'El Oued' ? 'selected' : '' }}>El Oued</option>
                            <option value="Khenchela" {{ ($profile->city ?? '') == 'Khenchela' ? 'selected' : '' }}>Khenchela</option>
                            <option value="Souk Ahras" {{ ($profile->city ?? '') == 'Souk Ahras' ? 'selected' : '' }}>Souk Ahras</option>
                            <option value="Tipaza" {{ ($profile->city ?? '') == 'Tipaza' ? 'selected' : '' }}>Tipaza</option>
                            <option value="Mila" {{ ($profile->city ?? '') == 'Mila' ? 'selected' : '' }}>Mila</option>
                            <option value="Aïn Defla" {{ ($profile->city ?? '') == 'Aïn Defla' ? 'selected' : '' }}>Aïn Defla</option>
                            <option value="Naâma" {{ ($profile->city ?? '') == 'Naâma' ? 'selected' : '' }}>Naâma</option>
                            <option value="Aïn Témouchent" {{ ($profile->city ?? '') == 'Aïn Témouchent' ? 'selected' : '' }}>Aïn Témouchent</option>
                            <option value="Ghardaïa" {{ ($profile->city ?? '') == 'Ghardaïa' ? 'selected' : '' }}>Ghardaïa</option>
                            <option value="Relizane" {{ ($profile->city ?? '') == 'Relizane' ? 'selected' : '' }}>Relizane</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Année d'expérience
                        </label>
                        <div id="experienceYearsDisplay" class="flex items-center gap-2 text-[#9ca3af]">
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            <span>{{ $profile->experience_years ?? 'Non spécifié' }}</span>
                        </div>
                        <select id="experienceYears" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                            <option value="">Sélectionner l'expérience</option>
                            <option value="0-1 ans" {{ ($profile->experience_years ?? '') == '0-1 ans' ? 'selected' : '' }}>0-1 ans</option>
                            <option value="1-2 ans" {{ ($profile->experience_years ?? '') == '1-2 ans' ? 'selected' : '' }}>1-2 ans</option>
                            <option value="2-3 ans" {{ ($profile->experience_years ?? '') == '2-3 ans' ? 'selected' : '' }}>2-3 ans</option>
                            <option value="3-5 ans" {{ ($profile->experience_years ?? '') == '3-5 ans' ? 'selected' : '' }}>3-5 ans</option>
                            <option value="5-7 ans" {{ ($profile->experience_years ?? '') == '5-7 ans' ? 'selected' : '' }}>5-7 ans</option>
                            <option value="7-10 ans" {{ ($profile->experience_years ?? '') == '7-10 ans' ? 'selected' : '' }}>7-10 ans</option>
                            <option value="10+ ans" {{ ($profile->experience_years ?? '') == '10+ ans' ? 'selected' : '' }}>10+ ans</option>
                            <option value="Débutant" {{ ($profile->experience_years ?? '') == 'Débutant' ? 'selected' : '' }}>Débutant</option>
                            <option value="Junior" {{ ($profile->experience_years ?? '') == 'Junior' ? 'selected' : '' }}>Junior</option>
                            <option value="Intermédiaire" {{ ($profile->experience_years ?? '') == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire</option>
                            <option value="Senior" {{ ($profile->experience_years ?? '') == 'Senior' ? 'selected' : '' }}>Senior</option>
                            <option value="Expert" {{ ($profile->experience_years ?? '') == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Disponible
                        </label>
                        <div id="availabilityDisplay" class="flex items-center gap-2 text-[#9ca3af]">
                            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                            <span>{{ $profile->availability ?? 'Non spécifié' }}</span>
                        </div>
                        <select id="availability" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                            <option value="">Sélectionner la disponibilité</option>
                            <option value="Immédiate" {{ ($profile->availability ?? '') == 'Immédiate' ? 'selected' : '' }}>Immédiate</option>
                            <option value="1 semaine" {{ ($profile->availability ?? '') == '1 semaine' ? 'selected' : '' }}>1 semaine</option>
                            <option value="2 semaines" {{ ($profile->availability ?? '') == '2 semaines' ? 'selected' : '' }}>2 semaines</option>
                            <option value="1 mois" {{ ($profile->availability ?? '') == '1 mois' ? 'selected' : '' }}>1 mois</option>
                            <option value="2 mois" {{ ($profile->availability ?? '') == '2 mois' ? 'selected' : '' }}>2 mois</option>
                            <option value="3 mois" {{ ($profile->availability ?? '') == '3 mois' ? 'selected' : '' }}>3 mois</option>
                            <option value="À négocier" {{ ($profile->availability ?? '') == 'À négocier' ? 'selected' : '' }}>À négocier</option>
                        </select>
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
            {{-- Email (Always shown) --}}
            <div class="flex items-center gap-3">
                <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <div>
                    <p class="text-sm text-[#9ca3af]">Email</p>
                    <p class="font-medium text-[#f5f5f5]">{{ $candidate->email }}</p>
                </div>
            </div>
            
            {{-- Phone --}}
            <div class="flex items-center gap-3">
                <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <div>
                    <p class="text-sm text-[#9ca3af]">Téléphone</p>
                    <p id="phoneDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->phone ?? 'Non renseigné' }}</p>
                    <input id="phone" type="text" value="{{ $profile->phone ?? '' }}" placeholder="Votre numéro de téléphone" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                </div>
            </div>
        </div>
        
        {{-- Social Media Section --}}
        <div class="mt-6 pt-6 border-t border-[#444444]">
            <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Réseaux sociaux</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- LinkedIn --}}
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                    <div>
                        <p class="text-sm text-[#9ca3af]">LinkedIn</p>
                        <p id="linkedinDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->linkedin_url ?? 'Non renseigné' }}</p>
                        <input id="linkedin" type="url" value="{{ $profile->linkedin_url ?? '' }}" placeholder="https://linkedin.com/in/votre-profil" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                    </div>
                </div>
                
                {{-- Facebook --}}
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    <div>
                        <p class="text-sm text-[#9ca3af]">Facebook</p>
                        <p id="facebookDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->facebook_url ?? 'Non renseigné' }}</p>
                        <input id="facebook" type="url" value="{{ $profile->facebook_url ?? '' }}" placeholder="https://facebook.com/votre-profil" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                    </div>
                </div>
                
                {{-- Portfolio --}}
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    <div>
                        <p class="text-sm text-[#9ca3af]">Portfolio</p>
                        <p id="portfolioDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->portfolio_url ?? 'Non renseigné' }}</p>
                        <input id="portfolio" type="url" value="{{ $profile->portfolio_url ?? '' }}" placeholder="https://votre-portfolio.com" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                    </div>
                </div>
                
                {{-- Twitter --}}
                <div class="flex items-center gap-3">
                    <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    <div>
                        <p class="text-sm text-[#9ca3af]">Twitter</p>
                        <p id="twitterDisplay" class="font-medium text-[#f5f5f5]">{{ $profile->twitter_url ?? 'Non renseigné' }}</p>
                        <input id="twitter" type="url" value="{{ $profile->twitter_url ?? '' }}" placeholder="https://twitter.com/votre-profil" class="hidden w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" />
                    </div>
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
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
        <div class="space-y-6" id="experienceContainer">
             @if($profile->experience && is_array($profile->experience) && count($profile->experience) > 0)
                 @foreach($profile->experience as $index => $exp)
            <div class="border-l-4 border-[#00b6b4] pl-6 pr-10 relative">
                         <button class="hidden absolute right-0 top-0 w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeExperience(this)">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-7 h-7 text-[#00b6b4]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                    <h3 class="font-semibold text-[#f5f5f5]">{{ $exp['title'] ?? 'Titre du poste' }}</h3>
                    <input type="text" value="{{ $exp['title'] ?? '' }}" placeholder="Titre du poste" class="hidden bg-transparent border-none text-lg font-semibold text-[#f5f5f5] w-full focus:outline-none" />
                </div>
                <p class="text-[#00b6b4] font-medium">{{ $exp['company'] ?? 'Entreprise' }}</p>
                <input type="text" value="{{ $exp['company'] ?? '' }}" placeholder="Entreprise" class="hidden text-[#00b6b4] font-medium bg-transparent border-none w-full focus:outline-none mb-2" />
                <p class="text-sm text-[#9ca3af] mb-2">{{ $exp['period'] ?? 'Période' }}</p>
                <input type="text" value="{{ $exp['period'] ?? '' }}" placeholder="Période (ex: 2022 - Présent)" class="hidden text-sm text-[#9ca3af] bg-transparent border-none w-full focus:outline-none mb-2" />
                <p class="text-[#9ca3af]">{{ $exp['description'] ?? 'Description' }}</p>
                <textarea placeholder="Description" class="hidden text-[#9ca3af] bg-transparent border-none w-full focus:outline-none" rows="2">{{ $exp['description'] ?? '' }}</textarea>
                </div>
                 @endforeach
             @else
                 <div class="text-center py-8">
                     <p class="text-[#9ca3af]">Aucune expérience professionnelle ajoutée</p>
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
                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
        <div class="space-y-6" id="educationContainer">
             @if($profile->education && is_array($profile->education) && count($profile->education) > 0)
                 @foreach($profile->education as $index => $edu)
            <div class="border-l-4 border-[#009999] pl-6 pr-10 relative">
                         <button class="hidden absolute right-0 top-0 w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeEducation(this)">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-7 h-7 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <h3 class="font-semibold text-[#f5f5f5]">{{ $edu['degree'] ?? 'Diplôme' }}</h3>
                    <input type="text" value="{{ $edu['degree'] ?? '' }}" placeholder="Diplôme" class="hidden bg-transparent border-none text-lg font-semibold text-[#f5f5f5] w-full focus:outline-none" />
                </div>
                <p class="text-[#009999] font-medium">{{ $edu['school'] ?? 'École' }}</p>
                <input type="text" value="{{ $edu['school'] ?? '' }}" placeholder="École/Université" class="hidden text-[#009999] font-medium bg-transparent border-none w-full focus:outline-none mb-2" />
                <p class="text-sm text-[#9ca3af] mb-2">{{ $edu['period'] ?? 'Période' }}</p>
                <input type="text" value="{{ $edu['period'] ?? '' }}" placeholder="Période (ex: 2020 - 2024)" class="hidden text-sm text-[#9ca3af] bg-transparent border-none w-full focus:outline-none mb-2" />
                <p class="text-[#9ca3af]">{{ $edu['description'] ?? 'Description' }}</p>
                <textarea placeholder="Description" class="hidden text-[#9ca3af] bg-transparent border-none w-full focus:outline-none" rows="2">{{ $edu['description'] ?? '' }}</textarea>
                </div>
                 @endforeach
             @else
                 <div class="text-center py-8">
                     <p class="text-[#9ca3af]">Aucune formation ajoutée</p>
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
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter
                </button>
            </div>
            <div class="flex flex-wrap gap-2" id="skillsContainer">
                 @if($profile->skills && is_array($profile->skills) && count($profile->skills) > 0)
                     @foreach($profile->skills as $skill)
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                             {{ $skill }}
                             <button class="hidden text-red-500 hover:text-red-700" onclick="removeSkill(this)">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
                     @endforeach
                 @else
                     <div class="text-center py-8 w-full">
                         <p class="text-[#9ca3af]">Aucune compétence ajoutée</p>
                     </div>
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
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Ajouter
                </button>
            </div>
            <div class="space-y-3" id="languagesContainer">
                @if($profile->languages && is_array($profile->languages) && count($profile->languages) > 0)
                    @foreach($profile->languages as $index => $language)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                <span class="font-medium text-[#f5f5f5]">{{ $language['name'] ?? 'Langue' }}</span>
                </div>
                    <div class="flex items-center gap-2">
                                <span class="text-sm text-[#9ca3af]">{{ $language['level'] ?? 'Niveau' }}</span>
                                <button class="hidden text-red-500 hover:text-red-700" onclick="removeLanguage(this)">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                                </button>
                    </div>
                </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <p class="text-[#9ca3af]">Aucune langue ajoutée</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($isOwnProfile)
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
    
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], textarea, select');
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
            
            // Show avatar upload button
            document.getElementById('avatarUploadBtn').classList.remove('hidden');
            
            // Show social media inputs
            document.getElementById('linkedin').classList.remove('hidden');
            document.getElementById('facebook').classList.remove('hidden');
            document.getElementById('portfolio').classList.remove('hidden');
            document.getElementById('twitter').classList.remove('hidden');
            
            // Show new dropdown fields
            document.getElementById('experienceYears').classList.remove('hidden');
            document.getElementById('availability').classList.remove('hidden');
            
            // Hide social media displays
            document.getElementById('linkedinDisplay').classList.add('hidden');
            document.getElementById('facebookDisplay').classList.add('hidden');
            document.getElementById('portfolioDisplay').classList.add('hidden');
            document.getElementById('twitterDisplay').classList.add('hidden');
            
            // Hide new dropdown displays
            document.getElementById('experienceYearsDisplay').classList.add('hidden');
            document.getElementById('availabilityDisplay').classList.add('hidden');
            
            // Show delete buttons for all sections
            skillButtons.forEach(btn => btn.classList.remove('hidden'));
            document.querySelectorAll('#experienceContainer button').forEach(btn => btn.classList.remove('hidden'));
            document.querySelectorAll('#educationContainer button').forEach(btn => btn.classList.remove('hidden'));
            document.querySelectorAll('#languagesContainer button').forEach(btn => btn.classList.remove('hidden'));
            
            // Show input fields for existing experience and education items
            document.querySelectorAll('#experienceContainer input, #experienceContainer textarea').forEach(input => input.classList.remove('hidden'));
            document.querySelectorAll('#educationContainer input, #educationContainer textarea').forEach(input => input.classList.remove('hidden'));
            
            // Hide display text for existing experience and education items
            document.querySelectorAll('#experienceContainer h3, #experienceContainer p').forEach(text => text.classList.add('hidden'));
            document.querySelectorAll('#educationContainer h3, #educationContainer p').forEach(text => text.classList.add('hidden'));
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
            
            // Hide avatar upload button
            document.getElementById('avatarUploadBtn').classList.add('hidden');
            
            // Hide social media inputs, show displays
            document.getElementById('linkedin').classList.add('hidden');
            document.getElementById('facebook').classList.add('hidden');
            document.getElementById('portfolio').classList.add('hidden');
            document.getElementById('twitter').classList.add('hidden');
            
            // Hide new dropdown fields, show displays
            document.getElementById('experienceYears').classList.add('hidden');
            document.getElementById('availability').classList.add('hidden');
            
            document.getElementById('linkedinDisplay').classList.remove('hidden');
            document.getElementById('facebookDisplay').classList.remove('hidden');
            document.getElementById('portfolioDisplay').classList.remove('hidden');
            document.getElementById('twitterDisplay').classList.remove('hidden');
            
            // Show new dropdown displays
            document.getElementById('experienceYearsDisplay').classList.remove('hidden');
            document.getElementById('availabilityDisplay').classList.remove('hidden');
            
            // Hide delete buttons for all sections
            skillButtons.forEach(btn => btn.classList.add('hidden'));
            document.querySelectorAll('#experienceContainer button').forEach(btn => btn.classList.add('hidden'));
            document.querySelectorAll('#educationContainer button').forEach(btn => btn.classList.add('hidden'));
            document.querySelectorAll('#languagesContainer button').forEach(btn => btn.classList.add('hidden'));
            
            // Hide input fields for existing experience and education items
            document.querySelectorAll('#experienceContainer input, #experienceContainer textarea').forEach(input => input.classList.add('hidden'));
            document.querySelectorAll('#educationContainer input, #educationContainer textarea').forEach(input => input.classList.add('hidden'));
            
            // Show display text for existing experience and education items
            document.querySelectorAll('#experienceContainer h3, #experienceContainer p').forEach(text => text.classList.remove('hidden'));
            document.querySelectorAll('#educationContainer h3, #educationContainer p').forEach(text => text.classList.remove('hidden'));
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
         formData.append('phone', phoneValue);
         
         // Add new dropdown fields
         const experienceYearsValue = document.getElementById('experienceYears').value;
         const availabilityValue = document.getElementById('availability').value;
         formData.append('experience_years', experienceYearsValue);
         formData.append('availability', availabilityValue);
         
         // Add social media fields
         const linkedinValue = document.getElementById('linkedin').value;
         const facebookValue = document.getElementById('facebook').value;
         const portfolioValue = document.getElementById('portfolio').value;
         const twitterValue = document.getElementById('twitter').value;
         
         formData.append('linkedin_url', linkedinValue);
         formData.append('facebook_url', facebookValue);
         formData.append('portfolio_url', portfolioValue);
         formData.append('twitter_url', twitterValue);
         
         // Add avatar file if selected
         if (avatarUpload.files[0]) {
             formData.append('avatar', avatarUpload.files[0]);
         }
         
         // Collect experience data
         const experienceData = [];
         const experienceItems = document.querySelectorAll('#experienceContainer .border-l-4');
         experienceItems.forEach(item => {
             // Look for input fields first (new entries or edit mode)
             const titleInput = item.querySelector('input[placeholder="Titre du poste"]');
             const companyInput = item.querySelector('input[placeholder="Entreprise"]');
             const periodInput = item.querySelector('input[placeholder*="Période"]');
             const descriptionInput = item.querySelector('textarea[placeholder="Description"]');
             
             let title, company, period, description;
             
             if (titleInput && titleInput.value.trim()) {
                 // New entry with input fields
                 title = titleInput.value.trim();
                 company = companyInput?.value?.trim() || '';
                 period = periodInput?.value?.trim() || '';
                 description = descriptionInput?.value?.trim() || '';
             } else {
                 // Existing entry - try to get from text content or input values
                 const titleElement = item.querySelector('h3');
                 const companyElement = item.querySelector('p.text-\\[\\#00b6b4\\]');
                 const periodElement = item.querySelector('p.text-sm');
                 const descriptionElement = item.querySelector('p.text-\\[\\#9ca3af\\]');
                 
                 title = titleElement?.textContent?.trim() || '';
                 company = companyElement?.textContent?.trim() || '';
                 period = periodElement?.textContent?.trim() || '';
                 description = descriptionElement?.textContent?.trim() || '';
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
             // Look for input fields first (new entries or edit mode)
             const degreeInput = item.querySelector('input[placeholder="Diplôme"]');
             const schoolInput = item.querySelector('input[placeholder="École/Université"]');
             const periodInput = item.querySelector('input[placeholder*="Période"]');
             const descriptionInput = item.querySelector('textarea[placeholder="Description"]');
             
             let degree, school, period, description;
             
             if (degreeInput && degreeInput.value.trim()) {
                 // New entry with input fields
                 degree = degreeInput.value.trim();
                 school = schoolInput?.value?.trim() || '';
                 period = periodInput?.value?.trim() || '';
                 description = descriptionInput?.value?.trim() || '';
             } else {
                 // Existing entry - try to get from text content
                 const degreeElement = item.querySelector('h3');
                 const schoolElement = item.querySelector('p.text-\\[\\#009999\\]');
                 const periodElement = item.querySelector('p.text-sm');
                 const descriptionElement = item.querySelector('p.text-\\[\\#9ca3af\\]');
                 
                 degree = degreeElement?.textContent?.trim() || '';
                 school = schoolElement?.textContent?.trim() || '';
                 period = periodElement?.textContent?.trim() || '';
                 description = descriptionElement?.textContent?.trim() || '';
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
             
             let name, level;
             
             if (nameInput && nameInput.value.trim()) {
                 // New entry with input fields
                 name = nameInput.value.trim();
                 level = levelElement?.value || 'Débutant';
             } else {
                 // Existing entry - try to get from text content
                 const nameElement = item.querySelector('span.font-medium');
                 const levelSpan = item.querySelector('span.text-sm');
                 
                 name = nameElement?.textContent?.trim() || '';
                 level = levelSpan?.textContent?.trim() || levelElement?.value || 'Débutant';
             }
             
             if (name) {
                 languagesData.push({
                     name: name,
                     level: level
                 });
             }
         });
         formData.append('languages', JSON.stringify(languagesData));
         
         
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
             if (!response.ok) {
                 return response.json().then(data => {
                     if (response.status === 422 && data.errors) {
                         let errorMessages = [];
                         for (const key in data.errors) {
                             errorMessages.push(data.errors[key][0]);
                         }
                         throw new Error(errorMessages.join('\\n'));
                     }
                     throw new Error(data.message || 'Erreur serveur');
                 }).catch(e => {
                     if (e.message) throw e;
                     throw new Error('Erreur de connexion');
                 });
             }
             return response.json();
         })
         .then(data => {
             if (data.success) {
                 showSuccessModal();
             } else {
                 showErrorModal(data.message || 'Erreur inconnue');
             }
         })
         .catch(error => {
             showErrorModal(error.message);
         });
    });
    
    addExperienceBtn.addEventListener('click', function() {
        const container = document.getElementById('experienceContainer');
        
        // Hide empty message if it exists
        const emptyMessage = container.querySelector('.text-center');
        if (emptyMessage) {
            emptyMessage.style.display = 'none';
        }
        
        const newExp = document.createElement('div');
        newExp.className = 'border-l-4 border-[#00b6b4] pl-6 pr-10 relative';
        newExp.innerHTML = `
            <button class="absolute right-0 top-0 w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeExperience(this)">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </button>
            <div class="flex items-center gap-2 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-7 h-7 text-[#00b6b4]"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
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
        
        // Hide empty message if it exists
        const emptyMessage = container.querySelector('.text-center');
        if (emptyMessage) {
            emptyMessage.style.display = 'none';
        }
        
        const newEdu = document.createElement('div');
        newEdu.className = 'border-l-4 border-[#009999] pl-6 pr-10 relative';
        newEdu.innerHTML = `
            <button class="absolute right-0 top-0 w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600" onclick="removeEducation(this)">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
            </button>
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-7 h-7 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
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
        
        // Hide empty message if it exists
        const emptyMessage = container.querySelector('.text-center');
        if (emptyMessage) {
            emptyMessage.style.display = 'none';
        }
        
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
        
        // Hide empty message if it exists
        const emptyMessage = container.querySelector('.text-center');
        if (emptyMessage) {
            emptyMessage.style.display = 'none';
        }
        
        const newLanguage = document.createElement('div');
        newLanguage.className = 'flex items-center justify-between border border-[#444444] rounded-lg p-3';
        newLanguage.innerHTML = `
            <div class="flex items-center gap-2">
                <svg class="w-7 h-7 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
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
                const avatarContainer = document.getElementById('avatar-container');
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
    showConfirmModal(
        'Supprimer la compétence',
        'Êtes-vous sûr de vouloir supprimer cette compétence ?',
        () => {
            const skillElement = button.closest('span');
            if (skillElement) {
                skillElement.remove();
            }
        }
    );
}

function removeExperience(button) {
    showConfirmModal(
        'Supprimer l\'expérience',
        'Êtes-vous sûr de vouloir supprimer cette expérience ?',
        () => {
            const experienceElement = button.closest('.border-l-4');
            if (experienceElement) {
                experienceElement.remove();
            }
        }
    );
}

function removeEducation(button) {
    showConfirmModal(
        'Supprimer la formation',
        'Êtes-vous sûr de vouloir supprimer cette formation ?',
        () => {
            const educationElement = button.closest('.border-l-4');
            if (educationElement) {
                educationElement.remove();
            }
        }
    );
}

function removeLanguage(button) {
    showConfirmModal(
        'Supprimer la langue',
        'Êtes-vous sûr de vouloir supprimer cette langue ?',
        () => {
            const languageElement = button.closest('.flex.items-center.justify-between');
            languageElement.remove();
        }
    );
}

// Custom confirmation modal functions
let confirmCallback = null;

function showConfirmModal(title, message, callback) {
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMessage').textContent = message;
    confirmCallback = callback;
    
    // Update icon for delete confirmation
    const iconDiv = document.getElementById('modalIcon');
    iconDiv.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500 bg-opacity-20 backdrop-blur-sm mb-4';
    iconDiv.innerHTML = `
        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    `;
    
    // Ensure buttons are visible for delete confirmations
    document.getElementById('confirmCancel').classList.remove('hidden');
    document.getElementById('confirmOk').classList.remove('hidden');
    
    // Reset button styles for delete confirmation
    const okButton = document.getElementById('confirmOk');
    okButton.className = 'bg-red-500 bg-opacity-80 hover:bg-opacity-100 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300';
    okButton.textContent = 'Supprimer';
    
    const cancelButton = document.getElementById('confirmCancel');
    cancelButton.className = 'bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300 border border-white border-opacity-30';
    cancelButton.textContent = 'Annuler';
    
    document.getElementById('confirmModal').classList.remove('hidden');
}

function hideConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
    confirmCallback = null;
    
    // Reset modal for next use (delete confirmation) with glass effects
    const iconDiv = document.getElementById('modalIcon');
    iconDiv.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500 bg-opacity-20 backdrop-blur-sm mb-4';
    iconDiv.innerHTML = `
        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
    `;
    
    const okButton = document.getElementById('confirmOk');
    okButton.className = 'bg-red-500 bg-opacity-80 hover:bg-opacity-100 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300';
    okButton.textContent = 'Supprimer';
    
    document.getElementById('confirmCancel').classList.remove('hidden');
    document.getElementById('confirmOk').classList.remove('hidden');
}

// Success modal function
function showSuccessModal() {
    // Update icon to green checkmark with glass effect
    const iconDiv = document.getElementById('modalIcon');
    iconDiv.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-500 bg-opacity-20 backdrop-blur-sm mb-4';
    iconDiv.innerHTML = `
        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
    `;
    
    document.getElementById('confirmTitle').textContent = 'Succès !';
    document.getElementById('confirmMessage').textContent = 'Profil sauvegardé avec succès !';
    
    // Hide all buttons for notification style
    document.getElementById('confirmCancel').classList.add('hidden');
    document.getElementById('confirmOk').classList.add('hidden');
    
    document.getElementById('confirmModal').classList.remove('hidden');
    
    // Auto close after 3 seconds and reload
    setTimeout(() => {
        hideConfirmModal();
        window.location.reload();
    }, 3000);
}

// Error modal function
function showErrorModal(message) {
    // Update icon to red X with glass effect
    const iconDiv = document.getElementById('modalIcon');
    iconDiv.className = 'mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-500 bg-opacity-20 backdrop-blur-sm mb-4';
    iconDiv.innerHTML = `
        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    `;
    
    // Update button to glass style
    const okButton = document.getElementById('confirmOk');
    okButton.className = 'bg-red-500 bg-opacity-80 hover:bg-opacity-100 backdrop-blur-sm text-white px-6 py-2 rounded-xl transition-all duration-300';
    okButton.textContent = 'OK';
    
    document.getElementById('confirmTitle').textContent = 'Erreur';
    document.getElementById('confirmMessage').textContent = message;
    document.getElementById('confirmCancel').classList.add('hidden');
    document.getElementById('confirmModal').classList.remove('hidden');
}

// Modal event handlers
document.getElementById('confirmCancel').addEventListener('click', hideConfirmModal);
document.getElementById('confirmOk').addEventListener('click', function() {
    if (confirmCallback) {
        confirmCallback();
    }
    hideConfirmModal();
});

// Close modal when clicking outside
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideConfirmModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('confirmModal').classList.contains('hidden')) {
        hideConfirmModal();
    }
});
</script>
@endif
@endsection
