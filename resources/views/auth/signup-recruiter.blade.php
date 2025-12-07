@extends('layouts.app')

@section('title', 'Inscription Recruteur - OMPLEO')
@section('description', 'Créez votre compte recruteur et trouvez les meilleurs talents sur OMPLEO.')

@section('content')
@include('components.header')

<div class="min-h-screen bg-gradient-to-br from-primary-50 to-accent-50 dark:from-dark-900 dark:to-dark-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center animate-fade-in-up">
            <a href="{{ route('signup.choice') }}" class="inline-flex items-center gap-2 text-[#0058f0] hover:text-[#0050e0] dark:text-[#00f0a8] dark:hover:text-[#00e0a0] mb-6 transition-colors duration-200 group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7"/>
                    <path d="M19 12H5"/>
                </svg>
                Retour au choix
            </a>
            
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-16 w-auto">
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                Créer un compte recruteur
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Trouvez les meilleurs talents
            </p>
        </div>

        <div class="bg-white dark:bg-dark-800 rounded-2xl shadow-2xl p-8 animate-fade-in-up" style="animation-delay: 0.2s;">
            <!-- Free Trial Banner -->
            <div class="bg-gradient-to-r from-green-50 to-blue-50 dark:from-green-900/20 dark:to-blue-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-[#00f0a8] rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 10h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 18h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 dark:text-gray-100">Essai gratuit 24h</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Publiez 1 offre gratuitement</p>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-sm">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="user_type" value="recruiter">
                
                <!-- Name Fields -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Prénom *
                        </label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Entreprise *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 10h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 18h4"></path>
                        </svg>
                        <input
                            id="company"
                            name="company"
                            type="text"
                            required
                            value="{{ old('company') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-[#0058f0] focus:border-[#0058f0] outline-none transition-all duration-300 bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                            placeholder="Nom de votre entreprise"
                        />
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Adresse email *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
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
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
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
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line x1="2" x2="22" y1="2" y2="22"></line>
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
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
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
                            <svg id="eyeIconConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg id="eyeOffIconConfirm" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
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
                        class="w-4 h-4 text-[#0058f0] border-gray-300 rounded focus:ring-[#0058f0] mt-1"
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
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" x2="19" y1="8" y2="14"/>
                        <line x1="22" x2="16" y1="11" y2="11"/>
                    </svg>
                    Créer mon compte recruteur
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

@include('components.footer')

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
