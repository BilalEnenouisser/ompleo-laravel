@extends('layouts.app')

@section('title', 'Connexion - OMPLEO')
@section('description', 'Connectez-vous à votre compte OMPLEO pour accéder à votre tableau de bord et gérer vos candidatures ou offres d\'emploi.')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 via-white to-accent-50 dark:from-dark-900 dark:via-dark-800 dark:to-dark-900 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="liquid-shape w-96 h-96 bg-primary-200/20 dark:bg-primary-500/10 top-20 left-10 animate-liquid"></div>
        <div class="liquid-shape w-80 h-80 bg-accent-200/20 dark:bg-accent-500/10 bottom-20 right-20 animate-liquid-shift"></div>
    </div>

    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Header -->
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="OMPLEO" class="h-10 w-auto">
                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">OMPLEO</span>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                Connexion
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Accédez à votre compte pour continuer
            </p>
        </div>

        <!-- Login Form -->
        <div class="glass-card p-8 rounded-2xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Adresse e-mail
                    </label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        autocomplete="email" 
                        required 
                        value="{{ old('email') }}"
                        class="glass-input w-full px-4 py-3 rounded-lg @error('email') border-red-500 @enderror"
                        placeholder="votre@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required 
                            class="glass-input w-full px-4 py-3 rounded-lg pr-12 @error('password') border-red-500 @enderror"
                            placeholder="Votre mot de passe"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword()" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full btn-primary py-3 px-4 text-lg font-semibold"
                >
                    Se connecter
                </button>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white dark:bg-dark-800 text-gray-500 dark:text-gray-400">Ou</span>
                    </div>
                </div>

                <!-- Social Login -->
                <div class="space-y-3">
                    <button 
                        type="button" 
                        class="w-full flex justify-center items-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-dark-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-600 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continuer avec Google
                    </button>
                    
                    <button 
                        type="button" 
                        class="w-full flex justify-center items-center px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-dark-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-dark-600 transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Continuer avec Facebook
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">
                        Créer un compte
                    </a>
                </p>
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

