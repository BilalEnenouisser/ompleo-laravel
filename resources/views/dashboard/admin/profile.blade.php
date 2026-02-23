@extends('layouts.dashboard')

@section('title', 'Mon Profil - Admin - OMPLEO')
@section('description', 'Gérez vos informations de profil administrateur')
@section('page-title', 'Mon Profil')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                Mon Profil
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Gérez vos informations personnelles
            </p>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="bg-green-900/30 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-900/30 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-900/30 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile Form --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 md:p-8 shadow-lg">
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Avatar Section --}}
            <div class="flex flex-col items-center mb-6">
                <div class="relative mb-4">
                    @if($user->avatar)
                        <img id="avatarPreview" src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#00b6b4]">
                    @else
                        <div id="avatarInitials" class="w-32 h-32 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white text-4xl font-bold border-4 border-[#00b6b4]">
                            @php
                                $nameParts = explode(' ', $user->name);
                                $initials = strtoupper(substr($nameParts[0], 0, 1));
                                if (count($nameParts) > 1) {
                                    $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                }
                            @endphp
                            {{ $initials }}
                        </div>
                        <img id="avatarPreview" src="" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-[#00b6b4] hidden">
                    @endif
                    <label for="avatar" class="absolute bottom-0 right-0 w-10 h-10 bg-[#00b6b4] rounded-full flex items-center justify-center text-white hover:bg-[#009999] transition-colors cursor-pointer shadow-lg">
                        <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                            <circle cx="12" cy="13" r="3"></circle>
                        </svg>
                    </label>
                    <input id="avatar" type="file" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                </div>
                <p class="text-sm text-[#9ca3af] text-center">
                    Cliquez sur l'icône pour changer votre photo de profil
                </p>
            </div>

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Nom complet <span class="text-red-400">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    required
                    class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                    placeholder="Votre nom complet"
                />
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Email <span class="text-red-400">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    required
                    class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                    placeholder="votre@email.com"
                />
            </div>

            {{-- Password Section --}}
            <div class="border-t border-[#444444] pt-6">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">
                    Modifier le mot de passe
                </h3>
                <p class="text-sm text-[#9ca3af] mb-4">
                    Laissez vide si vous ne souhaitez pas modifier le mot de passe.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Nouveau mot de passe
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full px-4 py-3 pr-10 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                                placeholder="Minimum 8 caractères"
                                autocomplete="new-password"
                            />
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility('password', 'passwordToggle')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors"
                                id="passwordToggle"
                            >
                                <svg id="passwordToggleIcon" class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Confirmer le mot de passe
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full px-4 py-3 pr-10 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                                placeholder="Répétez le mot de passe"
                                autocomplete="new-password"
                            />
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility('password_confirmation', 'passwordConfirmToggle')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors"
                                id="passwordConfirmToggle"
                            >
                                <svg id="passwordConfirmToggleIcon" class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#444444]">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors">
                    Annuler
                </a>
                <button 
                    type="submit" 
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-2 rounded-lg transition-colors flex items-center gap-2"
                >
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17,21 17,13 7,13 7,21"></polyline>
                        <polyline points="7,3 7,8 15,8"></polyline>
                    </svg>
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>

    {{-- Account Information --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 md:p-8 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4">
            Informations du compte
        </h2>
        <div class="space-y-3">
            <div class="flex items-center justify-between py-2 border-b border-[#444444]">
                <span class="text-sm text-[#9ca3af]">Type de compte</span>
                <span class="text-sm font-medium text-[#f5f5f5]">Administrateur</span>
            </div>
            <div class="flex items-center justify-between py-2 border-b border-[#444444]">
                <span class="text-sm text-[#9ca3af]">Date de création</span>
                <span class="text-sm font-medium text-[#f5f5f5]">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>
            <div class="flex items-center justify-between py-2">
                <span class="text-sm text-[#9ca3af]">Dernière mise à jour</span>
                <span class="text-sm font-medium text-[#f5f5f5]">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                const initials = document.getElementById('avatarInitials');
                
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (initials) {
                    initials.classList.add('hidden');
                }
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePasswordVisibility(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);
        const icon = document.getElementById(buttonId + 'Icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            // Eye off icon
            icon.innerHTML = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" y1="2" x2="22" y2="22"></line>';
        } else {
            input.type = 'password';
            // Eye icon
            icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
</script>
@endsection

