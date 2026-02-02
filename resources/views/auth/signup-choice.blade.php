@extends('layouts.app')

@section('title', 'Inscription - OMPLEO')
@section('description', 'Créez votre compte sur OMPLEO pour trouver un emploi ou recruter les meilleurs talents.')

@section('content')
@include('components.header')

<div class="bg-[#1f1f1f] relative overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('storage/nos_solutions/midsing.png') }}" alt="Background" class="w-full h-full object-cover opacity-80">
    </div>
    
    <style>
        /* Page load animation */
        .page-fade-in {
            opacity: 0;
            transform: translateY(40px) scale(0.95);
            animation: pageFadeIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }
        @keyframes pageFadeIn {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .signup-card {
            background: rgba(54, 54, 54, 0.7);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 20px;
            border: 1px solid #16b6b4;
            max-width: 470px;
            margin: 0 auto;
        }
        .signup-tab {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid #16b6b4;
            color: #ffffff;
            padding: 10px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .signup-tab:hover {
            background: rgba(22, 182, 180, 0.15);
        }
        .signup-tab.active {
            background: rgba(22, 182, 180, 0.25);
            border-color: #00fadc;
            color: #ffffff;
        }
        .signup-input {
            background: rgba(40, 40, 40, 0.8);
            border: 1px solid #16b6b4;
            border-radius: 10px;
            padding: 14px 16px;
            padding-left: 44px;
            color: white;
            width: 100%;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .signup-input::placeholder {
            color: #888;
        }
        .signup-input:focus {
            outline: none;
            border-color: #00fadc;
            background: rgba(40, 40, 40, 0.95);
            box-shadow: 0 0 10px rgba(22, 182, 180, 0.2);
        }
        .signup-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            width: 20px;
            height: 20px;
        }
        .signup-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            min-width: 18px;
            border: 2px solid #16b6b4;
            border-radius: 4px;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            flex-shrink: 0;
        }
        .signup-checkbox:checked {
            background: #16b6b4;
            border-color: #16b6b4;
        }
        .signup-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 4px;
            top: 1px;
            width: 5px;
            height: 9px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .signup-submit-btn {
            background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b);
            background-size: 200% 200%;
            background-position: 0% 50%;
            color: white;
            font-weight: 600;
            padding: 14px 40px;
            border-radius: 10px;
            border: none;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            width: 100%;
        }
        .signup-submit-btn:hover {
            background-position: 100% 50%;
            transform: translateY(-2px);
        }
        .signup-link {
            color: #16b6b4;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .signup-link:hover {
            color: #00fadc;
        }
        .form-label {
            color: #d8d4d4;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
    </style>
    
    <div class="signup-page min-h-screen flex items-center justify-center py-24 md:py-32 lg:py-40 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="w-full">
            <div class="signup-card p-6 sm:p-8 page-fade-in">
                <!-- Header -->
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">
                        Trouvez l'emploi qui vous correspond
                    </h2>
                    <p class="text-sm leading-relaxed">
                        Accédez aux offres d'emploi, postulez facilement et recevez des opportunités adaptées à votre profil.
                    </p>
                </div>
                
                <!-- Tabs -->
                <div class="mb-6">
                    <p class="text-center  text-sm mb-4">Quel est votre besoin ?*</p>
                    <div class="flex justify-center gap-3">
                        <button type="button" id="tabRecruiter" class="signup-tab" onclick="switchTab('recruiter')">
                            Je souhaite recruter
                        </button>
                        <button type="button" id="tabCandidate" class="signup-tab active" onclick="switchTab('candidate')">
                            Je cherche un emploi
                        </button>
                    </div>
                </div>
                
                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-900/30 border border-red-500/50 rounded-lg text-red-400 text-sm">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                
                <!-- Candidate Form -->
                <form id="candidateForm" method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="user_type" value="candidate">
                    
                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Prénom *</label>
                            <div class="relative">
                                <svg class="signup-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <input type="text" name="firstName" class="signup-input" placeholder="Prenom" value="{{ old('firstName') }}" required>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Nom *</label>
                            <input type="text" name="lastName" class="signup-input" style="padding-left: 16px;" placeholder="Nom" value="{{ old('lastName') }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="form-label">Adresse e-mail*</label>
                        <input type="email" name="email" class="signup-input" style="padding-left: 16px;" placeholder="Votre@gmail.com" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="form-label">Mot de passe *</label>
                        <input type="password" name="password" id="passwordCandidate" class="signup-input" style="padding-left: 16px;" placeholder="••••••••" required>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="form-label">Confirmer le mot de passe *</label>
                        <input type="password" name="password_confirmation" class="signup-input" style="padding-left: 16px;" placeholder="••••••••" required>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 mt-6">
                        <input type="checkbox" name="acceptTerms" class="signup-checkbox mt-0.5" required>
                        <span class="text-xs  leading-relaxed">
                            J'accepte les <a href="#" class="signup-link">conditions d'utilisation</a> et la <a href="#" class="signup-link">politique de confidentialité</a>
                        </span>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="signup-submit-btn mt-6">
                        Commencer mon essai gratuit
                    </button>
                </form>
                
                <!-- Recruiter Form (Hidden by default) -->
                <form id="recruiterForm" method="POST" action="{{ route('register') }}" class="space-y-4 hidden">
                    @csrf
                    <input type="hidden" name="user_type" value="recruiter">
                    
                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Prénom *</label>
                            <div class="relative">
                                <svg class="signup-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <input type="text" name="firstName" class="signup-input" placeholder="Prenom" value="{{ old('firstName') }}" required>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Nom *</label>
                            <input type="text" name="lastName" class="signup-input" style="padding-left: 16px;" placeholder="Nom" value="{{ old('lastName') }}" required>
                        </div>
                    </div>

                    <!-- Company -->
                    <div>
                        <label class="form-label">Entreprise *</label>
                        <input type="text" name="company" class="signup-input" style="padding-left: 16px;" placeholder="Nom de votre entreprise" value="{{ old('company') }}" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="form-label">Adresse e-mail*</label>
                        <input type="email" name="email" class="signup-input" style="padding-left: 16px;" placeholder="Votre@gmail.com" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="form-label">Mot de passe *</label>
                        <input type="password" name="password" id="passwordRecruiter" class="signup-input" style="padding-left: 16px;" placeholder="••••••••" required>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="form-label">Confirmer le mot de passe *</label>
                        <input type="password" name="password_confirmation" class="signup-input" style="padding-left: 16px;" placeholder="••••••••" required>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 mt-6">
                        <input type="checkbox" name="acceptTerms" class="signup-checkbox mt-0.5" required>
                        <span class="text-xs text-gray-400 leading-relaxed">
                            J'accepte les <a href="#" class="signup-link">conditions d'utilisation</a> et la <a href="#" class="signup-link">politique de confidentialité</a>
                        </span>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="signup-submit-btn mt-6">
                        Commencer mon essai gratuit
                    </button>
                </form>
                
                <!-- Login Link -->
                <div class="text-center mt-6">
                    <p class="text-sm">
                        Déjà inscrit ? <a href="{{ route('login') }}" class="signup-link">Connectez-vous</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    @include('components.footer')
</div>

<script>
function switchTab(tab) {
    const tabCandidate = document.getElementById('tabCandidate');
    const tabRecruiter = document.getElementById('tabRecruiter');
    const candidateForm = document.getElementById('candidateForm');
    const recruiterForm = document.getElementById('recruiterForm');
    
    if (tab === 'candidate') {
        tabCandidate.classList.add('active');
        tabRecruiter.classList.remove('active');
        candidateForm.classList.remove('hidden');
        recruiterForm.classList.add('hidden');
    } else {
        tabRecruiter.classList.add('active');
        tabCandidate.classList.remove('active');
        recruiterForm.classList.remove('hidden');
        candidateForm.classList.add('hidden');
    }
}
</script>
@endsection
