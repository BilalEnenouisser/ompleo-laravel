<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Notifications - OMPLEO</title>
    <meta name="description" content="Gérez vos notifications OMPLEO">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-[#1f1f1f] dark">
    @include('components.header')
    
    <div class="pt-20">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                    <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                        Notifications
                    </h1>
                    <div class="flex items-center gap-3">
                        <button class="flex items-center gap-2 px-4 py-2 bg-[#00b6b4]/10 text-[#00b6b4] rounded-lg hover:bg-[#00b6b4]/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check w-4 h-4">
                                <path d="M18 6 7 17l-5-5"/>
                                <path d="M22 6 11 17l-5-5"/>
                            </svg>
                            <span>Tout marquer comme lu</span>
                        </button>
                        <button class="flex items-center gap-2 px-4 py-2 bg-red-900/20 text-red-400 rounded-lg hover:bg-red-900/30 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                            <span>Tout supprimer</span>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-[#333333] mb-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                            <input
                                type="text"
                                placeholder="Rechercher dans les notifications..."
                                class="w-full pl-10 pr-4 py-3 border border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#2b2b2b] text-[#f5f5f5] placeholder-[#9ca3af]"
                            />
                        </div>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                            </svg>
                            <select class="pl-10 pr-8 py-3 border border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#2b2b2b] text-[#f5f5f5] min-w-[150px]">
                                <option value="all">Toutes</option>
                                <option value="unread">Non lues</option>
                                <option value="read">Lues</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Notifications List -->
                <div class="space-y-4">
                    <!-- Notification Item 1 -->
                    <div class="bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-[#333333] border-l-4 border-l-[#00b6b4]">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 bg-[#00b6b4]/10 text-[#00b6b4]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-6 h-6">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                </svg>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-xl font-bold text-[#f5f5f5]">
                                        Nouvelle candidature reçue
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <button class="p-1 text-[#00b6b4] hover:text-[#009e9c] bg-[#00b6b4]/10 rounded-full" title="Marquer comme lu">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
                                                <path d="M20 6 9 17l-5-5"/>
                                            </svg>
                                        </button>
                                        <button class="p-1 text-[#9ca3af] hover:text-red-500 bg-[#333333] rounded-full" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <p class="text-[#9ca3af] mb-4">
                                    Ahmed Belkacem a postulé pour le poste de <span class="text-[#00b6b4] font-medium">Développeur Frontend React</span> dans votre entreprise.
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-sm text-[#666666]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                            <path d="M8 2v4"/>
                                            <path d="M16 2v4"/>
                                            <rect width="18" height="18" x="3" y="4" rx="2"/>
                                            <path d="M3 10h18"/>
                                        </svg>
                                        <span>Il y a 2 heures</span>
                                    </div>
                                    
                                    <a href="#" class="flex items-center gap-2 text-sm text-[#00b6b4] hover:text-[#009e9c] font-medium">
                                        <span>Voir plus</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-4 h-4">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15 3 21 3 21 9"/>
                                            <line x1="10" x2="21" y1="14" y2="3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Item 2 -->
                    <div class="bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-[#333333]">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 bg-[#333333] text-[#9ca3af]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-6 h-6">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                </svg>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-xl font-bold text-[#f5f5f5]">
                                        Entretien confirmé
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <button class="p-1 text-[#9ca3af] hover:text-red-500 bg-[#333333] rounded-full" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <p class="text-[#9ca3af] mb-4">
                                    L'entretien avec <span class="text-[#00b6b4] font-medium">Fatima Zohra</span> a été confirmé pour demain à 14h00.
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-sm text-[#666666]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                            <path d="M8 2v4"/>
                                            <path d="M16 2v4"/>
                                            <rect width="18" height="18" x="3" y="4" rx="2"/>
                                            <path d="M3 10h18"/>
                                        </svg>
                                        <span>Il y a 4 heures</span>
                                    </div>
                                    
                                    <a href="#" class="flex items-center gap-2 text-sm text-[#00b6b4] hover:text-[#009e9c] font-medium">
                                        <span>Voir plus</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-4 h-4">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15 3 21 3 21 9"/>
                                            <line x1="10" x2="21" y1="14" y2="3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Item 3 -->
                    <div class="bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-[#333333]">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 bg-[#333333] text-[#9ca3af]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-6 h-6">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                </svg>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-xl font-bold text-[#f5f5f5]">
                                        Rappel d'entretien
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <button class="p-1 text-[#9ca3af] hover:text-red-500 bg-[#333333] rounded-full" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                                                <path d="M3 6h18"/>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <p class="text-[#9ca3af] mb-4">
                                    Vous avez un entretien avec <span class="text-[#00b6b4] font-medium">Karim Boudjadar</span> dans 30 minutes.
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-sm text-[#666666]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                                            <path d="M8 2v4"/>
                                            <path d="M16 2v4"/>
                                            <rect width="18" height="18" x="3" y="4" rx="2"/>
                                            <path d="M3 10h18"/>
                                        </svg>
                                        <span>Il y a 1 jour</span>
                                    </div>
                                    
                                    <a href="#" class="flex items-center gap-2 text-sm text-[#00b6b4] hover:text-[#009e9c] font-medium">
                                        <span>Voir plus</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-4 h-4">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15 3 21 3 21 9"/>
                                            <line x1="10" x2="21" y1="14" y2="3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
</body>
</html>
