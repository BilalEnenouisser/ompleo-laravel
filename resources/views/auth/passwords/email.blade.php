@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe - OMPLEO')
@section('description', 'Réinitialisez votre mot de passe OMPLEO')

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
                Réinitialiser le mot de passe
            </h2>
            <p class="mt-2 text-sm text-[#9ca3af]">
                Entrez votre adresse email pour recevoir un lien de réinitialisation
            </p>
        </div>

        <!-- Form -->
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-xl">
            @if (session('status'))
                <div class="mb-4 bg-green-900/30 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-[#f5f5f5] mb-2">
                        Adresse email
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autocomplete="email"
                        class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af]"
                        placeholder="votre@email.com"
                    />
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button 
                        type="submit"
                        class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Envoyer le lien de réinitialisation
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
