@extends('layouts.app')

@section('title', 'Inscription Candidat - OMPLEO')
@section('description', 'Créez votre compte candidat et rejoignez la communauté des talents sur OMPLEO.')

@section('content')
@include('components.header')

<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 dark:from-dark-900 dark:to-dark-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center animate-fade-in-up">
            <a href="{{ route('signup.choice') }}" class="inline-flex items-center gap-2 text-[#0058f0] hover:text-[#0050e0] dark:text-[#00f0a8] dark:hover:text-[#00e0a0] mb-6 transition-colors duration-200 group">
                <svg class="w-7 h-7 group-hover:-translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
                Retour au choix
            </a>
            
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-16 w-auto">
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                Créer un compte candidat
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Rejoignez la communauté des talents
            </p>
        </div>

        <div class="bg-white dark:bg-dark-800 rounded-2xl shadow-2xl p-8 animate-fade-in-up" style="animation-delay: 0.2s;">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-sm">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="user_type" value="candidate">
                
                <!-- Name Fields -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Prénom *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <input
                                id="firstName"
                                name="firstName"
                                type="text"
                                required
                                value="{{ old('firstName') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                                placeholder="Prénom"
                            />
                        </div>
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nom *
                        </label>
                        <input
                            id="lastName"
                            name="lastName"
                            type="text"
                            required
                            value="{{ old('lastName') }}"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                            placeholder="Nom"
                        />
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Adresse email *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            value="{{ old('email') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                            placeholder="votre@email.com"
                        />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Mot de passe *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="w-full pl-10 pr-12 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                            placeholder="••••••••"
                        />
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <svg id="eyeIcon" class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOffIcon" class="w-7 h-7 hidden" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                                <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                                <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                                <line x1="2" x2="22" y1="2" y2="22"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Confirmer le mot de passe *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <input
                            id="confirmPassword"
                            name="password_confirmation"
                            type="password"
                            required
                            class="w-full pl-10 pr-12 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                            placeholder="••••••••"
                        />
                        <button
                            type="button"
                            onclick="toggleConfirmPassword()"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                        >
                            <svg id="eyeIconConfirm" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eyeOffIconConfirm" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" x2="22" y1="2" y2="22"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input
                        id="acceptTerms"
                        name="acceptTerms"
                        type="checkbox"
                        required
                        class="w-7 h-7 text-[#0058f0] border-gray-300 rounded focus:ring-[#0058f0] mt-1"
                    />
                    <label for="acceptTerms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                        J'accepte les 
                        <a href="#" class="text-[#0058f0] hover:text-[#0050e0] dark:text-[#00f0a8] dark:hover:text-[#00e0a0]">
                            conditions d'utilisation
                        </a> 
                        et la 
                        <a href="#" class="text-[#0058f0] hover:text-[#0050e0] dark:text-[#00f0a8] dark:hover:text-[#00e0a0]">
                            politique de confidentialité
                        </a>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full btn-primary py-3 flex items-center justify-center gap-2"
                >
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" x2="19" y1="8" y2="14"/>
                        <line x1="22" x2="16" y1="11" y2="11"/>
                    </svg>
                    Créer mon compte candidat
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Déjà un compte ? 
                    <a href="{{ route('login') }}" class="font-medium text-[#0058f0] hover:text-[#0050e0] dark:text-[#00f0a8] dark:hover:text-[#00e0a0]">
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

function toggleConfirmPassword() {
    const passwordInput = document.getElementById('confirmPassword');
    const eyeIcon = document.getElementById('eyeIconConfirm');
    const eyeOffIcon = document.getElementById('eyeOffIconConfirm');
    
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
