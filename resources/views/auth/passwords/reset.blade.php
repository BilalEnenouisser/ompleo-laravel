@extends('layouts.app')

@section('title', 'Nouveau mot de passe - OMPLEO')
@section('description', 'Définissez votre nouveau mot de passe OMPLEO')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#1a1a1a] via-[#2b2b2b] to-[#1a1a1a] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center">
                <div class="w-16 h-16 bg-[#00b6b4] rounded-2xl flex items-center justify-center">
                    <img src="{{ asset('icon.png') }}" alt="OMPLEO" class="w-10 h-10 object-contain filter brightness-0 invert">
                </div>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-[#f5f5f5]">
                Nouveau mot de passe
            </h2>
            <p class="mt-2 text-sm text-[#9ca3af]">
                Définissez votre nouveau mot de passe
            </p>
        </div>

        <!-- Form -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-xl">
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-[#f5f5f5] mb-2">
                        Adresse email
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ $email ?? old('email') }}"
                        required 
                        autocomplete="email"
                        readonly
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg bg-[#333333] text-[#9ca3af] cursor-not-allowed"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-[#f5f5f5] mb-2">
                        Nouveau mot de passe
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af]"
                        placeholder="Minimum 8 caractères"
                    />
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#f5f5f5] mb-2">
                        Confirmer le mot de passe
                    </label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af]"
                        placeholder="Confirmez votre mot de passe"
                    />
                </div>

                <div>
                    <button 
                        type="submit"
                        class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-[#00b6b4] hover:text-[#009999] text-sm font-medium transition-colors">
                    ← Retour à la connexion
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
