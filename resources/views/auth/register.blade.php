@extends('layouts.app')

@section('title', 'Inscription - OMPLEO')
@section('description', 'Créez votre compte OMPLEO et rejoignez des milliers de professionnels. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 via-white to-accent-50 dark:from-dark-900 dark:via-dark-800 dark:to-dark-900 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="liquid-shape w-96 h-96 bg-primary-200/20 dark:bg-primary-500/10 top-20 right-10 animate-liquid"></div>
        <div class="liquid-shape w-80 h-80 bg-accent-200/20 dark:bg-accent-500/10 bottom-20 left-20 animate-liquid-shift"></div>
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
                Créer un compte
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Rejoignez OMPLEO et commencez votre aventure professionnelle
            </p>
        </div>

        <!-- Register Form -->
        <div class="glass-card p-8 rounded-2xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nom complet
                    </label>
                    <input 
                        id="name" 
                        name="name" 
                        type="text" 
                        autocomplete="name" 
                        required 
                        value="{{ old('name') }}"
                        class="glass-input w-full px-4 py-3 rounded-lg @error('name') border-red-500 @enderror"
                        placeholder="Votre nom complet"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

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
                            autocomplete="new-password" 
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

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Confirmer le mot de passe
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password" 
                            required 
                            class="glass-input w-full px-4 py-3 rounded-lg pr-12"
                            placeholder="Confirmer votre mot de passe"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordConfirmation()" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <svg id="eyeIconConfirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eyeOffIconConfirmation" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- User Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                        Je suis un(e) :
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input 
                                type="radio" 
                                name="user_type" 
                                value="candidate" 
                                class="sr-only peer" 
                                {{ old('user_type') == 'candidate' ? 'checked' : '' }}
                            >
                            <div class="glass-card p-4 rounded-lg peer-checked:ring-2 peer-checked:ring-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 transition-all duration-200">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div class="font-medium text-gray-900 dark:text-gray-100">Candidat</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Chercher un emploi</div>
                                </div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input 
                                type="radio" 
                                name="user_type" 
                                value="recruiter" 
                                class="sr-only peer" 
                                {{ old('user_type') == 'recruiter' ? 'checked' : '' }}
                            >
                            <div class="glass-card p-4 rounded-lg peer-checked:ring-2 peer-checked:ring-primary-500 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/20 transition-all duration-200">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <div class="font-medium text-gray-900 dark:text-gray-100">Recruteur</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Recruter des talents</div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('user_type')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input 
                        id="terms" 
                        name="terms" 
                        type="checkbox" 
                        required 
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1"
                    >
                    <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        J'accepte les 
                        <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">conditions d'utilisation</a>
                        et la 
                        <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">politique de confidentialité</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full btn-primary py-3 px-4 text-lg font-semibold"
                >
                    Créer mon compte
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

                <!-- Social Register -->
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

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">
                        Se connecter
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

function togglePasswordConfirmation() {
    const passwordInput = document.getElementById('password_confirmation');
    const eyeIcon = document.getElementById('eyeIconConfirmation');
    const eyeOffIcon = document.getElementById('eyeOffIconConfirmation');
    
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

