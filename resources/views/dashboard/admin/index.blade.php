@extends('layouts.dashboard')

@section('title', 'Tableau de bord Admin - OMPLEO')
@section('description', 'Tableau de bord administrateur pour gérer la plateforme OMPLEO.')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="space-y-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-[#00b6b4] to-[#009e9c] rounded-2xl p-8 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2 text-white drop-shadow-sm">
                            Tableau de bord Administrateur 👋
                        </h1>
                        <p class="text-white/90 text-lg drop-shadow-sm">
                            Vue d'ensemble de la plateforme OMPLEO
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-12 h-12 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <button class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-3 hover:scale-105">
                    <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M16 13H8"/>
                            <path d="M16 17H8"/>
                            <path d="M10 9H8"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-[#f5f5f5]">Créer un article</div>
                        <div class="text-sm text-[#cccccc]">Blog</div>
                    </div>
                </button>

                <button class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-3 hover:scale-105">
                    <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-[#f5f5f5]">Notification</div>
                        <div class="text-sm text-[#cccccc]">Envoyer</div>
                    </div>
                </button>

                <button class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-3 hover:scale-105">
                    <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M12 15V3"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-[#f5f5f5]">Exporter stats</div>
                        <div class="text-sm text-[#cccccc]">Excel/PDF</div>
                    </div>
                </button>

                <button class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-3 hover:scale-105">
                    <div class="w-10 h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-[#f5f5f5]">Analytics</div>
                        <div class="text-sm text-[#cccccc]">Détaillées</div>
                    </div>
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Utilisateurs totaux -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">2,847</h3>
                    <p class="text-[#cccccc] text-sm mb-2">Utilisateurs totaux</p>
                    <p class="text-[#00b6b4] text-xs font-medium">+127 ce mois</p>
                </div>

                <!-- Offres d'emploi -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">1,187</h3>
                    <p class="text-[#cccccc] text-sm mb-2">Offres d'emploi</p>
                    <p class="text-[#00b6b4] text-xs font-medium">+89 cette semaine</p>
                </div>

                <!-- Revenus -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" x2="12" y1="2" y2="22"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">847,500 DA</h3>
                    <p class="text-[#cccccc] text-sm mb-2">Revenus</p>
                    <p class="text-[#00b6b4] text-xs font-medium">+12.5% ce mois</p>
                </div>

                <!-- Actions aujourd'hui -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-12 h-12 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18"/>
                            <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#f5f5f5] mb-1">5</h3>
                    <p class="text-[#cccccc] text-sm mb-2">Actions aujourd'hui</p>
                    <p class="text-[#00b6b4] text-xs font-medium">Temps réel</p>
                </div>
            </div>

            <!-- Tracking en temps réel -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-[#f5f5f5] flex items-center gap-3">
                        <svg class="w-6 h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                        Tracking en temps réel
                    </h2>
                    <div class="flex items-center gap-3">
                        <select class="px-3 py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] text-sm">
                            <option value="1h">Dernière heure</option>
                            <option value="24h">Dernières 24h</option>
                            <option value="7d">7 derniers jours</option>
                            <option value="30d">30 derniers jours</option>
                        </select>
                        <button class="p-2 bg-[#333333] border border-[#444444] rounded-lg text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                                <path d="M21 3v5h-5"/>
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                                <path d="M3 21v-5h5"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Filtres de tracking -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input type="text" placeholder="Rechercher utilisateur, action..." class="w-full pl-10 pr-4 py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#cccccc] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                    </div>
                    
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                        </svg>
                        <select class="w-full pl-10 pr-4 py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none">
                            <option value="">Tous les utilisateurs</option>
                            <option value="candidate">Candidats</option>
                            <option value="recruiter">Recruteurs</option>
                            <option value="admin">Administrateurs</option>
                        </select>
                    </div>

                    <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M12 15V3"/>
                        </svg>
                        Exporter logs
                    </button>
                </div>

                <!-- Liste des événements de tracking -->
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    <div class="flex items-center gap-4 p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-blue-400 bg-blue-900/30">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5]">Ahmed Belkacem</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">candidate</span>
                            </div>
                            <p class="text-sm text-[#cccccc] mb-1">
                                <strong class="text-[#00b6b4]">Connexion</strong> - Connexion réussie depuis Chrome
                            </p>
                            <div class="flex items-center gap-4 text-xs text-[#999999]">
                                <span>/login</span>
                                <span>•</span>
                                <span>Il y a 5 minutes</span>
                                <span>•</span>
                                <span class="text-green-400">Succès</span>
                            </div>
                        </div>
                        
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-green-400 bg-green-900/30">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5]">Recruiter User</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-green-400 bg-green-900/30">recruiter</span>
                            </div>
                            <p class="text-sm text-[#cccccc] mb-1">
                                <strong class="text-[#00b6b4]">Publication offre</strong> - Nouvelle offre "Développeur React" publiée
                            </p>
                            <div class="flex items-center gap-4 text-xs text-[#999999]">
                                <span>/recruiter/create-offer</span>
                                <span>•</span>
                                <span>Il y a 17 minutes</span>
                                <span>•</span>
                                <span class="text-green-400">Succès</span>
                            </div>
                        </div>
                        
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-blue-400 bg-blue-900/30">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5]">Ahmed Belkacem</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-400 bg-blue-900/30">candidate</span>
                            </div>
                            <p class="text-sm text-[#cccccc] mb-1">
                                <strong class="text-[#00b6b4]">Candidature envoyée</strong> - Candidature pour "Développeur Frontend React" chez IMPACTOME
                            </p>
                            <div class="flex items-center gap-4 text-xs text-[#999999]">
                                <span>/job/developpeur-frontend-react</span>
                                <span>•</span>
                                <span>Il y a 32 minutes</span>
                                <span>•</span>
                                <span class="text-green-400">Succès</span>
                            </div>
                        </div>
                        
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-green-400 bg-green-900/30">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5]">Recruiter User</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-green-400 bg-green-900/30">recruiter</span>
                            </div>
                            <p class="text-sm text-[#cccccc] mb-1">
                                <strong class="text-[#00b6b4]">Consultation CV</strong> - Téléchargement CV de Ahmed Belkacem
                            </p>
                            <div class="flex items-center gap-4 text-xs text-[#999999]">
                                <span>/recruiter/candidates</span>
                                <span>•</span>
                                <span>Il y a 47 minutes</span>
                                <span>•</span>
                                <span class="text-green-400">Succès</span>
                            </div>
                        </div>
                        
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-purple-400 bg-purple-900/30">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5]">Admin User</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-purple-400 bg-purple-900/30">admin</span>
                            </div>
                            <p class="text-sm text-[#cccccc] mb-1">
                                <strong class="text-[#00b6b4]">Création article blog</strong> - Nouvel article "Comment rédiger un CV"
                            </p>
                            <div class="flex items-center gap-4 text-xs text-[#999999]">
                                <span>/admin/blog</span>
                                <span>•</span>
                                <span>Il y a 1 heure</span>
                                <span>•</span>
                                <span class="text-green-400">Succès</span>
                            </div>
                        </div>
                        
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actions en attente -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                    Actions en attente
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="border border-[#444444] rounded-xl p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-red-900/30 text-red-400">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                    <path d="M12 9v4"/>
                                    <path d="M12 17h.01"/>
                                </svg>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-red-400 bg-red-900/30">3</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2">Signalements à traiter</h3>
                        <button class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-2 rounded-lg text-sm font-medium transition-colors">
                            Traiter
                        </button>
                    </div>

                    <div class="border border-[#444444] rounded-xl p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-yellow-900/30 text-yellow-400">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-yellow-400 bg-yellow-900/30">5</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2">Offres à modérer</h3>
                        <button class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-2 rounded-lg text-sm font-medium transition-colors">
                            Modérer
                        </button>
                    </div>

                    <div class="border border-[#444444] rounded-xl p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-green-900/30 text-green-400">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-400 bg-green-900/30">2</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2">Nouveaux partenaires</h3>
                        <button class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-2 rounded-lg text-sm font-medium transition-colors">
                            Valider
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Activities -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-[#f5f5f5]">
                            Activités récentes
                        </h2>
                        <button class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                            Voir tout
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-3 hover:bg-[#333333] rounded-lg transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-blue-400 bg-blue-900/30">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#f5f5f5]">Connexion</p>
                                <p class="text-sm text-[#cccccc]">Ahmed Belkacem - Connexion réussie depuis Chrome</p>
                            </div>
                            <span class="text-xs text-[#999999]">Il y a 7 minutes</span>
                        </div>

                        <div class="flex items-center gap-4 p-3 hover:bg-[#333333] rounded-lg transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-green-400 bg-green-900/30">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#f5f5f5]">Publication offre</p>
                                <p class="text-sm text-[#cccccc]">Recruiter User - Nouvelle offre "Développeur React" publiée</p>
                            </div>
                            <span class="text-xs text-[#999999]">Il y a 17 minutes</span>
                        </div>

                        <div class="flex items-center gap-4 p-3 hover:bg-[#333333] rounded-lg transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-blue-400 bg-blue-900/30">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#f5f5f5]">Candidature envoyée</p>
                                <p class="text-sm text-[#cccccc]">Ahmed Belkacem - Candidature pour "Développeur Frontend React" chez IMPACTOME</p>
                            </div>
                            <span class="text-xs text-[#999999]">Il y a 32 minutes</span>
                        </div>

                        <div class="flex items-center gap-4 p-3 hover:bg-[#333333] rounded-lg transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-green-400 bg-green-900/30">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#f5f5f5]">Consultation CV</p>
                                <p class="text-sm text-[#cccccc]">Recruiter User - Téléchargement CV de Ahmed Belkacem</p>
                            </div>
                            <span class="text-xs text-[#999999]">Il y a 47 minutes</span>
                        </div>

                        <div class="flex items-center gap-4 p-3 hover:bg-[#333333] rounded-lg transition-colors">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-purple-400 bg-purple-900/30">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    <path d="M9 12l2 2 4-4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-[#f5f5f5]">Création article blog</p>
                                <p class="text-sm text-[#cccccc]">Admin User - Nouvel article "Comment rédiger un CV"</p>
                            </div>
                            <span class="text-xs text-[#999999]">Il y a 1 heure</span>
                        </div>
                    </div>
                </div>

                <!-- Top Companies -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-[#f5f5f5]">
                            Top entreprises
                        </h2>
                        <button class="text-[#00b6b4] hover:text-[#009e9c] text-sm font-medium">
                            Voir tout
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-[#f5f5f5]">IMPACTOME</h3>
                                    <p class="text-sm text-[#cccccc]">12 offres • 89 candidatures</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-[#f5f5f5]">45,000 DA</p>
                                <p class="text-xs text-[#999999]">Revenus</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-[#f5f5f5]">CONDOR</h3>
                                    <p class="text-sm text-[#cccccc]">8 offres • 67 candidatures</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-[#f5f5f5]">32,000 DA</p>
                                <p class="text-xs text-[#999999]">Revenus</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-[#f5f5f5]">SONATRACH</h3>
                                    <p class="text-sm text-[#cccccc]">15 offres • 134 candidatures</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-[#f5f5f5]">78,000 DA</p>
                                <p class="text-xs text-[#999999]">Revenus</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-[#f5f5f5]">OMPLEO</h3>
                                    <p class="text-sm text-[#cccccc]">6 offres • 45 candidatures</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-[#f5f5f5]">24,000 DA</p>
                                <p class="text-xs text-[#999999]">Revenus</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
                <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                    État du système
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-8 h-8 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-[#f5f5f5]">Serveurs</p>
                            <p class="text-sm text-green-400">Opérationnels</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-8 h-8 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-[#f5f5f5]">Base de données</p>
                            <p class="text-sm text-green-400">Normale</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-8 h-8 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-[#f5f5f5]">API</p>
                            <p class="text-sm text-green-400">Fonctionnelle</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
