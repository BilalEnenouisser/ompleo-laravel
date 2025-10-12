@extends('layouts.dashboard')

@section('title', 'Profil de l\'entreprise')
@section('page-title', 'Profil de l\'entreprise')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="space-y-8">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#f5f5f5]">Profil de l'entreprise</h1>
            <p class="text-[#9ca3af] mt-1">Gérez les informations de votre entreprise</p>
        </div>
    </div>

    <!-- Company Profile Form -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <form action="{{ route('recruiter.company-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Logo Section -->
            <div class="flex items-center gap-6">
                <div class="relative">
                    @if($company && $company->logo)
                        <img src="{{ Storage::url($company->logo) }}" alt="Logo" class="w-20 h-20 rounded-xl object-cover border-2 border-[#00b6b4]">
                    @else
                        <div class="w-20 h-20 bg-[#00b6b4] rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                            {{ substr($company->name ?? 'E', 0, 1) }}
                        </div>
                    @endif
                    <label for="logo" class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#00b6b4] rounded-full flex items-center justify-center text-white hover:bg-[#009999] transition-colors cursor-pointer">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                            <circle cx="12" cy="13" r="3"/>
                        </svg>
                    </label>
                    <input id="logo" name="logo" type="file" accept="image/*" class="hidden" />
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[#f5f5f5]">Logo de l'entreprise</h3>
                    <p class="text-sm text-[#9ca3af]">Cliquez sur l'icône pour changer le logo</p>
                </div>
            </div>

            <!-- Company Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Nom de l'entreprise *
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $company->name ?? '') }}"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                        placeholder="Nom de votre entreprise"
                        required
                    />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Industry -->
                <div>
                    <label for="industry" class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Secteur d'activité *
                    </label>
                    <input 
                        type="text" 
                        id="industry" 
                        name="industry" 
                        value="{{ old('industry', $company->industry ?? '') }}"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                        placeholder="Ex: Technologie, Marketing, Industrie..."
                        required
                    />
                    @error('industry')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Ville *
                    </label>
                    <input 
                        type="text" 
                        id="city" 
                        name="city" 
                        value="{{ old('city', $company->location ?? '') }}"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                        placeholder="Ville de votre entreprise"
                        required
                    />
                    @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Size -->
                <div>
                    <label for="size" class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Nombre d'employés *
                    </label>
                    <select 
                        id="size" 
                        name="size" 
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                        required
                    >
                        <option value="">Sélectionnez la taille</option>
                        <option value="1-10 employés" {{ old('size', $company->size ?? '') == '1-10 employés' ? 'selected' : '' }}>1-10 employés</option>
                        <option value="11-50 employés" {{ old('size', $company->size ?? '') == '11-50 employés' ? 'selected' : '' }}>11-50 employés</option>
                        <option value="51-200 employés" {{ old('size', $company->size ?? '') == '51-200 employés' ? 'selected' : '' }}>51-200 employés</option>
                        <option value="201-500 employés" {{ old('size', $company->size ?? '') == '201-500 employés' ? 'selected' : '' }}>201-500 employés</option>
                        <option value="501-1000 employés" {{ old('size', $company->size ?? '') == '501-1000 employés' ? 'selected' : '' }}>501-1000 employés</option>
                        <option value="1000+ employés" {{ old('size', $company->size ?? '') == '1000+ employés' ? 'selected' : '' }}>1000+ employés</option>
                    </select>
                    @error('size')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-[#9ca3af] mb-2">
                    Description de l'entreprise *
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                    placeholder="Décrivez votre entreprise, ses valeurs, sa mission..."
                    required
                >{{ old('description', $company->description ?? '') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white px-8 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2"
                >
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Logo preview functionality
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const logoContainer = document.querySelector('.relative');
            const existingImg = logoContainer.querySelector('img');
            const existingDiv = logoContainer.querySelector('div');
            
            if (existingImg) {
                existingImg.src = e.target.result;
            } else if (existingDiv) {
                const newImg = document.createElement('img');
                newImg.src = e.target.result;
                newImg.className = 'w-20 h-20 rounded-xl object-cover border-2 border-[#00b6b4]';
                logoContainer.replaceChild(newImg, existingDiv);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
