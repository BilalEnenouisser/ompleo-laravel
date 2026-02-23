<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Page introuvable - OMPLEO</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#00b6b4',
                            600: '#00b6b4',
                            700: '#0e7490',
                            800: '#155e75',
                            900: '#164e63',
                        },
                        accent: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#00b6b4',
                            600: '#00b6b4',
                            700: '#0e7490',
                            800: '#155e75',
                            900: '#164e63',
                        },
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        bounceGentle: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <style>
        .btn-primary {
            background-color: #00b6b4 !important;
            color: white !important;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .btn-primary:hover {
            background-color: #009e9c !important;
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .btn-secondary {
            background-color: #333333 !important;
            color: #cccccc !important;
            font-weight: 500;
            border-radius: 0.5rem;
            border: 1px solid #444444 !important;
            transition: all 0.2s;
        }
        .btn-secondary:hover {
            background-color: #444444 !important;
            color: white !important;
            border-color: #555555 !important;
            transform: scale(1.05);
        }
    </style>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Build Assets -->
    @if(vite_asset('resources/css/app.css'))
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    @endif
</head>
<body class="font-sans antialiased min-h-screen" style="background-color: #2b2b2b;">
    @include('components.header')
    
    <main class="flex-1 flex items-center justify-center px-4 py-20">
        <div class="text-center max-w-2xl mx-auto">
        <div class="animate-fade-in-up">
            <!-- 404 Animation -->
            <div class="relative mb-8">
                <div class="text-9xl font-bold text-primary-800 select-none">
                    404
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-32 h-32 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center animate-bounce-gentle">
                        <!-- Search icon from Lucide React -->
                        <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <h1 class="text-4xl lg:text-5xl font-bold text-gray-100 mb-6">
                Page introuvable
            </h1>
            
            <p class="text-xl text-gray-400 mb-8 leading-relaxed">
                Oups ! La page que vous recherchez semble avoir disparu. 
                Elle a peut-être été déplacée, supprimée ou l'URL est incorrecte.
            </p>

            <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 btn-primary px-8 py-4 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home w-6 h-6">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Retour à l'accueil
                </a>
                
                <button onclick="window.history.back()" class="inline-flex items-center gap-2 btn-secondary px-8 py-4 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-6 h-6">
                        <path d="m12 19-7-7 7-7"></path>
                        <path d="M19 12H5"></path>
                    </svg>
                    Page précédente
                </button>
            </div>

            <!-- Suggestions -->
            <div class="mt-12 p-6 bg-dark-800/80 backdrop-blur-sm rounded-2xl border border-dark-700">
                <h3 class="text-lg font-semibold text-gray-100 mb-4">
                    Suggestions :
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                    <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-900/30 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-primary-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-6 h-6 text-primary-400">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-100">Offres d'emploi</div>
                            <div class="text-sm text-gray-400">Découvrir les opportunités</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('companies.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-900/30 transition-colors duration-200 group">
                        <div class="w-10 h-10 bg-primary-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home w-6 h-6 text-primary-400">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-100">Entreprises</div>
                            <div class="text-sm text-gray-400">Nos partenaires</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
    
    
    <!-- Build Assets JS -->
    @if(vite_asset('resources/js/app.js'))
    <script type="module" src="{{ vite_asset('resources/js/app.js') }}"></script>
    @endif
</body>
</html>
