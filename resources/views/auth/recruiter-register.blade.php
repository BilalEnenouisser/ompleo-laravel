@extends('layouts.app')

@section('title', 'Inscription Recruteur - OMPLEO')
@section('description', 'Inscrivez-vous en tant que recruteur sur OMPLEO et trouvez les meilleurs talents pour votre entreprise.')

@section('content')
<div class="min-h-screen bg-[#1f1f1f] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <img src="{{ asset('LOGO OMPLEO LINE.png') }}" alt="OMPLEO" class="h-16 w-auto dark:hidden">
                <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-16 w-auto hidden dark:block">
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-white">
                Inscription Recruteur
            </h2>
            <p class="mt-2 text-center text-sm text-gray-300">
                Créez votre compte recruteur et trouvez les meilleurs talents
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="user_type" value="recruiter">
            
            <div class="space-y-4">
                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nom de l'entreprise
                    </label>
                    <input id="company_name" name="company_name" type="text" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="Nom de votre entreprise">
                </div>

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nom complet
                    </label>
                    <input id="name" name="name" type="text" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="Votre nom complet">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Adresse email
                    </label>
                    <input id="email" name="email" type="email" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="votre@email.com">
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">
                        Téléphone
                    </label>
                    <input id="phone" name="phone" type="tel" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="+213 XXX XXX XXX">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Mot de passe
                    </label>
                    <input id="password" name="password" type="password" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="Mot de passe">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                        Confirmer le mot de passe
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="w-full px-3 py-2 border border-gray-600 bg-[#2b2b2b] text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                           placeholder="Confirmer le mot de passe">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#00b6b4] hover:bg-[#009e9c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00b6b4] transition-all duration-300">
                    Créer mon compte recruteur
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-400">
                    Déjà un compte ? 
                    <a href="{{ route('login') }}" class="font-medium text-[#00b6b4] hover:text-[#009e9c] transition-colors">
                        Se connecter
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
