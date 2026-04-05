@extends('layouts.app')

@section('title', 'Connexion - OMPLEO')
@section('description', 'Connectez-vous à votre compte OMPLEO pour accéder à votre tableau de bord et gérer vos candidatures ou offres d\'emploi.')

@section('content')
@include('components.header')
<div class="min-h-screen bg-white dark:bg-[#1f1f1f] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="max-w-md w-full space-y-8 relative z-10">
        <div class="text-center animate-fade-in-up">
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-16 w-auto">
            </div>
            <h2 class="text-3xl font-semibold text-[#111111] dark:text-[#f5f5f5] mb-2">
                Connexion
            </h2>
            <p class="text-[#111111] dark:text-[#cccccc]">
                Accédez à votre espace personnel
            </p>
        </div>

        <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 shadow-lg border border-gray-200 dark:border-[#333333] animate-fade-in-up" style="animation-delay: 0.2s;">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#111111] dark:text-[#cccccc] mb-2">
                        Adresse email
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5] @error('email') border-red-500 @enderror"
                            placeholder="votre@email.com"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#111111] dark:text-[#cccccc] mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="w-full pl-10 pr-12 py-3 border border-gray-200 dark:border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#f5f5f5] @error('password') border-red-500 @enderror"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <svg id="eyeIcon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eyeOffIcon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" x2="22" y1="2" y2="22"></line>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="w-7 h-7 bg-white dark:bg-[#2b2b2b] border-gray-300 dark:border-[#444444] rounded focus:ring-[#00b6b4] text-[#00b6b4]"
                        >
                        <span class="ml-2 text-sm text-[#111111] dark:text-[#cccccc]">Se souvenir de moi</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-[#00b6b4] hover:text-[#009e9c] transition-colors duration-200">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-3 rounded-xl flex items-center justify-center gap-2 shadow-sm hover:scale-102 transition-all duration-200"
                >
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10,17 15,12 10,7"></polyline>
                        <line x1="15" x2="3" y1="12" y2="12"></line>
                    </svg>
                    Se connecter
                </button>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-[#333333]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-[#2b2b2b] text-[#111111] dark:text-[#cccccc]">Ou continuer avec</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <button 
                        type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] text-[#111111] dark:text-[#f5f5f5] rounded-lg hover:bg-gray-50 dark:hover:bg-[#333333] hover:scale-102 transition-all duration-200"
                    >
                        <svg class="w-7 h-7 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M21.17 8H12"></path>
                            <path d="M3.95 6.06L8.54 14"></path>
                            <path d="M10.88 21.94L15.46 14"></path>
                        </svg>
                        <span class="ml-2">Google</span>
                    </button>
                    <button 
                        type="button" 
                        class="w-full inline-flex justify-center py-2 px-4 bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] text-[#111111] dark:text-[#f5f5f5] rounded-lg hover:bg-gray-50 dark:hover:bg-[#333333] hover:scale-102 transition-all duration-200"
                    >
                        <svg class="w-7 h-7 text-[#00b6b4]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        <span class="ml-2">Facebook</span>
                    </button>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-[#111111] dark:text-[#cccccc]">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="font-medium text-[#00b6b4] hover:text-[#009e9c] transition-colors duration-200">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>

        <!-- Demo Accounts -->
        <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-4 text-center shadow-lg border border-gray-200 dark:border-[#333333] animate-fade-in-up" style="animation-delay: 0.4s;">
            <div>
                <p class="text-sm text-[#111111] dark:text-[#cccccc] mb-2">Comptes de démonstration :</p>
                <div class="space-y-1 text-xs">
                    <p><strong class="text-[#00b6b4]">Candidat:</strong> candidate@ompleo.com</p>
                    <p><strong class="text-[#00b6b4]">Recruteur:</strong> recruiter@ompleo.com</p>
                    <p><strong class="text-[#00b6b4]">Admin:</strong> admin@ompleo.com</p>
                    <p class="text-[#111111] dark:text-[#cccccc]">Mot de passe : password</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeOffIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeOffIcon.classList.add('hidden');
    }
}
</script>
@endsection

