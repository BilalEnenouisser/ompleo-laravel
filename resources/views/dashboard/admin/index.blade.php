@extends('layouts.dashboard')

@section('title', 'Tableau de bord Admin - OMPLEO')
@section('description', 'Tableau de bord administrateur pour gérer la plateforme OMPLEO.')
@section('page-title', 'Tableau de bord')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="w-full space-y-3 sm:space-y-4 md:space-y-6 lg:space-y-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-[#00b6b4] to-[#009e9c] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 lg:p-8 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold mb-1 md:mb-2 text-white drop-shadow-sm whitespace-nowrap overflow-hidden">
                            <span class="block sm:hidden">Admin 👋</span>
                            <span class="hidden sm:block">Tableau de bord Administrateur 👋</span>
                        </h1>
                        <p class="text-white/90 text-xs sm:text-sm md:text-base lg:text-lg drop-shadow-sm truncate">
                            Vue d'ensemble de la plateforme OMPLEO
                        </p>
                    </div>
                    <div class="hidden sm:block flex-shrink-0 ml-2">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 lg:w-24 lg:h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                <button onclick="window.location.href='{{ route('admin.blog.editor') }}'" class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl p-2 sm:p-3 md:p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-1 sm:gap-2 md:gap-3 hover:scale-105">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                            <path d="M14 2v6h6"/>
                            <path d="M16 13H8"/>
                            <path d="M16 17H8"/>
                            <path d="M10 9H8"/>
                        </svg>
                    </div>
                    <div class="text-left min-w-0 flex-1">
                        <div class="font-medium text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">
                            <span class="hidden sm:inline">Créer un article</span>
                            <span class="sm:hidden">Article</span>
                        </div>
                        <div class="text-xs sm:text-xs md:text-sm text-[#cccccc] truncate">Blog</div>
                    </div>
                </button>

                <button onclick="window.location.href='{{ route('admin.notifications') }}'" class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl p-2 sm:p-3 md:p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-1 sm:gap-2 md:gap-3 hover:scale-105">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                    </div>
                    <div class="text-left min-w-0 flex-1">
                        <div class="font-medium text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">
                            <span class="hidden sm:inline">Notification</span>
                            <span class="sm:hidden">Notif</span>
                        </div>
                        <div class="text-xs sm:text-xs md:text-sm text-[#cccccc] truncate">Envoyer</div>
                    </div>
                </button>

                <button onclick="showExportModal()" class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl p-2 sm:p-3 md:p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-1 sm:gap-2 md:gap-3 hover:scale-105">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M12 15V3"/>
                        </svg>
                    </div>
                    <div class="text-left min-w-0 flex-1">
                        <div class="font-medium text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">
                            <span class="hidden sm:inline">Exporter stats</span>
                            <span class="sm:hidden">Export</span>
                        </div>
                        <div class="text-xs sm:text-xs md:text-sm text-[#cccccc] truncate">Excel/PDF</div>
                    </div>
                </button>

                <button onclick="window.location.href='{{ route('admin.payments') }}'" class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl p-2 sm:p-3 md:p-4 hover:bg-[#333333] transition-all duration-300 flex items-center gap-1 sm:gap-2 md:gap-3 hover:scale-105">
                    <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart3 w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]"><path d="M3 3v18h18"></path><path d="M18 17V9"></path><path d="M13 17V5"></path><path d="M8 17v-3"></path></svg>
                    </div>
                    <div class="text-left min-w-0 flex-1">
                        <div class="font-medium text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">Analytics</div>
                        <div class="text-xs sm:text-xs md:text-sm text-[#cccccc] truncate">Détaillées</div>
                    </div>
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
                <!-- Utilisateurs totaux -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2 sm:mb-3 md:mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1 truncate">{{ number_format($stats['total_users']) }}</h3>
                    <p class="text-[#cccccc] text-xs sm:text-sm mb-1 sm:mb-2 truncate">Utilisateurs totaux</p>
                    <p class="text-[#00b6b4] text-xs font-medium truncate">+{{ $stats['users_this_month'] }} ce mois</p>
                </div>

                <!-- Offres d'emploi -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2 sm:mb-3 md:mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1 truncate">{{ number_format($stats['total_jobs']) }}</h3>
                    <p class="text-[#cccccc] text-xs sm:text-sm mb-1 sm:mb-2 truncate">Offres d'emploi</p>
                    <p class="text-[#00b6b4] text-xs font-medium truncate">+{{ $stats['jobs_this_week'] }} cette semaine</p>
                </div>

                <!-- Revenus -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2 sm:mb-3 md:mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" x2="12" y1="2" y2="22"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1 truncate">{{ number_format($stats['total_applications'] * 50) }} DA</h3>
                    <p class="text-[#cccccc] text-xs sm:text-sm mb-1 sm:mb-2 truncate">Revenus</p>
                    <p class="text-[#00b6b4] text-xs font-medium truncate">+{{ $stats['applications_this_month'] }} ce mois</p>
                </div>

                <!-- Actions aujourd'hui -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-2 sm:mb-3 md:mb-4">
                        <div class="bg-[#00b6b4]/10 text-[#00b6b4] w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5 text-[#00b6b4]"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                    </div>
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5] mb-1 truncate">{{ $stats['actions_today'] }}</h3>
                    <p class="text-[#cccccc] text-xs sm:text-sm mb-1 sm:mb-2 truncate">Actions aujourd'hui</p>
                    <p class="text-[#00b6b4] text-xs font-medium truncate">Temps réel</p>
                </div>
            </div>

            <!-- Tracking en temps réel -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-3 sm:mb-4 md:mb-6 gap-3 sm:gap-4">
                    <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] flex items-center gap-2 md:gap-3">
                        <svg class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                        </svg>
                        <span class="hidden sm:inline">Tracking en temps réel</span>
                        <span class="sm:hidden">Tracking</span>
                    </h2>
                    <div class="flex items-center gap-2 md:gap-3">
                        <!-- Time Filter Dropdown -->
                        <select id="timeFilter" class="px-2 md:px-3 py-1.5 sm:py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] text-xs md:text-sm focus:outline-none focus:border-[#00b6b4] transition-colors">
                            <option value="all">Tout</option>
                            <option value="1h" selected>1h</option>
                            <option value="24h">24h</option>
                            <option value="7d">7j</option>
                            <option value="30d">30j</option>
                        </select>
                        
                        <!-- Refresh Button -->
                        <button id="refreshTracking" class="p-1.5 sm:p-2 bg-[#333333] border border-[#444444] rounded-lg text-[#cccccc] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                                <path d="M21 3v5h-5"/>
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                                <path d="M3 21v-5h5"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Filtres de tracking -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-3 md:gap-4 mb-3 sm:mb-4 md:mb-6">
                    <div class="relative">
                        <svg class="absolute left-2 sm:left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.35-4.35"/>
                        </svg>
                        <input type="text" id="activitySearch" placeholder="Rechercher..." class="w-full pl-8 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#cccccc] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none text-xs sm:text-sm">
                    </div>
                    
                    <div class="relative">
                        <svg class="absolute left-2 sm:left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                        </svg>
                        <select id="userTypeFilter" class="w-full pl-8 sm:pl-10 pr-3 sm:pr-4 py-1.5 sm:py-2 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none text-xs sm:text-sm">
                            <option value="">Tous les utilisateurs</option>
                            <option value="candidate">Candidats</option>
                            <option value="recruiter">Recruteurs</option>
                            <option value="admin">Administrateurs</option>
                        </select>
                    </div>

                    <button id="exportLogs" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-lg font-medium transition-colors flex items-center gap-1 sm:gap-2 text-xs sm:text-sm justify-center">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M12 15V3"/>
                        </svg>
                        <span class="hidden sm:inline">Exporter logs</span>
                        <span class="sm:hidden">Exporter</span>
                    </button>
                </div>

                <!-- Liste des événements de tracking -->
                <div id="trackingContainer" class="space-y-2 md:space-y-3 max-h-80 sm:max-h-96 md:max-h-[500px] overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #4a5568 #2d3748;">
                    @forelse($recentActivities as $activity)
                    <div class="flex items-start md:items-center gap-2 sm:gap-3 md:gap-4 p-2 sm:p-3 md:p-4 bg-[#333333] border border-[#444444] rounded-lg hover:bg-[#3a3a3a] transition-colors"
                         data-activity="true"
                         data-user-name="{{ $activity['user_name'] ?? '' }}"
                         data-activity="{{ $activity['activity'] ?? '' }}"
                         data-description="{{ $activity['description'] ?? '' }}"
                         data-user-type="{{ $activity['user_type'] ?? '' }}"
                         data-time="{{ isset($activity['time']) ? $activity['time']->toISOString() : '' }}"
                         data-type="{{ $activity['type'] ?? '' }}">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center 
                            @if(isset($activity['icon_color']) && $activity['icon_color'] == 'blue') text-blue-400 bg-blue-900/30
                            @elseif(isset($activity['icon_color']) && $activity['icon_color'] == 'green') text-green-400 bg-green-900/30
                            @else text-purple-400 bg-purple-900/30
                            @endif flex-shrink-0">
                            @if(isset($activity['type']) && $activity['type'] == 'application')
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            @elseif(isset($activity['type']) && $activity['type'] == 'job')
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            @else
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 mb-1">
                                <span class="font-medium text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">{{ $activity['user_name'] ?? 'Utilisateur inconnu' }}</span>
                                <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-medium 
                                    @if(isset($activity['user_type']) && $activity['user_type'] == 'candidate') text-blue-400 bg-blue-900/30
                                    @elseif(isset($activity['user_type']) && $activity['user_type'] == 'recruiter') text-green-400 bg-green-900/30
                                    @else text-purple-400 bg-purple-900/30
                                    @endif w-fit">{{ $activity['user_type'] ?? 'admin' }}</span>
                            </div>
                            <p class="text-xs sm:text-sm text-[#cccccc] mb-1 line-clamp-2">
                                <strong class="text-[#00b6b4]">{{ $activity['activity'] ?? 'Activité' }}</strong> - {{ $activity['description'] ?? 'Description non disponible' }}
                            </p>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 text-xs text-[#999999]">
                                <span class="hidden sm:inline truncate">{{ $activity['url'] ?? '/' }}</span>
                                <span class="hidden sm:inline">•</span>
                                <span class="truncate">{{ isset($activity['time']) && method_exists($activity['time'], 'diffForHumans') ? $activity['time']->diffForHumans() : 'Maintenant' }}</span>
                                <span class="hidden sm:inline">•</span>
                                <span class="text-green-400 truncate">{{ $activity['status'] ?? 'Succès' }}</span>
                            </div>
                        </div>
                        
                        <button class="p-1 sm:p-1.5 md:p-2 text-[#cccccc] hover:text-[#00b6b4] transition-colors flex-shrink-0">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <path d="M15 3h6v6"/>
                                <path d="M10 14L21 3"/>
                            </svg>
                        </button>
                    </div>
                    @empty
                    <div class="text-center py-6 sm:py-8">
                        <p class="text-[#cccccc] text-xs sm:text-sm">Aucune activité récente</p>
                    </div>
                    @endforelse

                </div>
            </div>

            <!-- Actions en attente -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] mb-3 sm:mb-4 md:mb-6">
                    Actions en attente
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-3 md:gap-4">
                    <div class="border border-[#444444] rounded-xl p-3 sm:p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-2 sm:mb-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg flex items-center justify-center bg-red-900/30 text-red-400 flex-shrink-0">
                                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/>
                                    <path d="M12 9v4"/>
                                    <path d="M12 17h.01"/>
                                </svg>
                            </div>
                            <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-medium text-red-400 bg-red-900/30 whitespace-nowrap flex-shrink-0">{{ $stats['pending_applications'] }}</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2 text-xs sm:text-sm md:text-base truncate">Candidatures en attente</h3>
                        <a href="{{ route('admin.jobs') }}" class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium transition-colors block text-center">
                            Traiter
                        </a>
                    </div>

                    <div class="border border-[#444444] rounded-xl p-3 sm:p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-2 sm:mb-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg flex items-center justify-center bg-yellow-900/30 text-yellow-400 flex-shrink-0">
                                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </div>
                            <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-medium text-yellow-400 bg-yellow-900/30 whitespace-nowrap flex-shrink-0">{{ $stats['draft_jobs'] }}</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2 text-xs sm:text-sm md:text-base truncate">Offres à modérer</h3>
                        <a href="{{ route('admin.jobs') }}" class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium transition-colors block text-center">
                            Modérer
                        </a>
                    </div>

                    <div class="border border-[#444444] rounded-xl p-3 sm:p-4 hover:shadow-lg transition-all duration-300 hover:transform hover:scale-105 bg-[#333333]">
                        <div class="flex items-center justify-between mb-2 sm:mb-3">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg flex items-center justify-center bg-green-900/30 text-green-400 flex-shrink-0">
                                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                            </div>
                            <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-medium text-green-400 bg-green-900/30 whitespace-nowrap flex-shrink-0">{{ $stats['total_companies'] }}</span>
                        </div>
                        <h3 class="font-semibold text-[#f5f5f5] mb-2 text-xs sm:text-sm md:text-base truncate">Entreprises actives</h3>
                        <a href="{{ route('admin.companies') }}" class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-1.5 sm:py-2 rounded-lg text-xs sm:text-sm font-medium transition-colors block text-center">
                            Gérer
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4 md:gap-6 lg:gap-8">
                <!-- Recent Activities -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                        <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                            Activités récentes
                        </h2>
                        <button id="showAllActivities" class="text-[#00b6b4] hover:text-[#009e9c] text-xs sm:text-sm md:text-base font-medium">
                            Voir tout
                        </button>
                    </div>
                    <div class="space-y-3 sm:space-y-4">
                        @forelse($recentActivities as $activity)
                        <div class="flex items-center justify-between p-3 sm:p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                            <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-xs sm:text-sm flex-shrink-0">
                                    {{ substr($activity['user_name'] ?? 'U', 0, 2) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">
                                        {{ $activity['user_name'] ?? 'Utilisateur inconnu' }}
                                    </h3>
                                    <p class="text-xs sm:text-sm text-[#9ca3af] line-clamp-2">
                                        {{ $activity['activity'] ?? 'Activité' }} - {{ $activity['description'] ?? 'Description non disponible' }}
                                    </p>
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 text-xs text-[#9ca3af] mt-1">
                                        <span class="flex items-center gap-1 truncate">
                                            <svg class="w-3 h-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                                <circle cx="12" cy="10" r="3"/>
                                            </svg>
                                            <span class="truncate">{{ $activity['url'] ?? '/' }}</span>
                                        </span>
                                        <span class="hidden sm:inline">•</span>
                                        <span class="truncate">{{ isset($activity['time']) && method_exists($activity['time'], 'diffForHumans') ? $activity['time']->diffForHumans() : 'Maintenant' }}</span>
                                        <span class="hidden sm:inline">•</span>
                                        <span class="text-green-400 truncate">{{ $activity['status'] ?? 'Succès' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0 ml-2">
                                <span class="px-1.5 sm:px-2 md:px-3 py-0.5 sm:py-1 rounded-full text-xs font-medium 
                                    @if(isset($activity['user_type']) && $activity['user_type'] == 'candidate') text-blue-400 bg-blue-900/30
                                    @elseif(isset($activity['user_type']) && $activity['user_type'] == 'recruiter') text-green-400 bg-green-900/30
                                    @else text-purple-400 bg-purple-900/30
                                    @endif whitespace-nowrap">
                                    {{ $activity['user_type'] ?? 'admin' }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-6 sm:py-8">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                            <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5] mb-2">Aucune activité récente</h3>
                            <p class="text-xs sm:text-sm text-[#9ca3af]">Aucune activité enregistrée pour le moment.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Top Companies -->
                <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
                    <div class="flex items-center justify-between mb-3 sm:mb-4 md:mb-6">
                        <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5]">
                            Top entreprises
                        </h2>
                        <button id="showAllCompanies" class="text-[#00b6b4] hover:text-[#009e9c] text-xs sm:text-sm md:text-base font-medium">
                            Voir tout
                        </button>
                    </div>
                    <div class="space-y-2 sm:space-y-3 md:space-y-4">
                        @forelse($topCompanies as $company)
                        <div class="flex items-center justify-between p-2 sm:p-3 md:p-4 border border-[#444444] rounded-lg md:rounded-xl hover:bg-[#333333] transition-colors">
                            <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center flex-shrink-0">
                                    @if($company->logo)
                                        <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <svg class="w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                            <path d="M10 6h4"/>
                                            <path d="M10 10h4"/>
                                            <path d="M10 14h4"/>
                                            <path d="M10 18h4"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">{{ $company->name }}</h3>
                                    <p class="text-xs sm:text-sm text-[#cccccc] truncate">{{ $company->jobs_count }} offres • {{ $company->applications_count }} candidatures</p>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0 ml-2">
                                <p class="font-bold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">{{ number_format($company->applications_count * 50) }} DA</p>
                                <p class="text-xs text-[#999999]">Revenus</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-6 sm:py-8">
                            <p class="text-[#cccccc] text-xs sm:text-sm">Aucune entreprise trouvée</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- System Health -->
            <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
                <h2 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] mb-3 sm:mb-4 md:mb-6">
                    État du système
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6">
                    <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">Serveurs</p>
                            <p class="text-xs sm:text-sm text-green-400 truncate">Opérationnels</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">Base de données</p>
                            <p class="text-xs sm:text-sm text-green-400 truncate">Normale</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-green-900/20 border border-green-800 rounded-lg">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">API</p>
                            <p class="text-xs sm:text-sm text-green-400 truncate">Fonctionnelle</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Activities Popup Modal -->
    <div id="activitiesModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 max-w-4xl w-full mx-2 sm:mx-4 max-h-[80vh] overflow-hidden flex flex-col">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5]">Toutes les activités</h2>
                <button id="closeActivitiesModal" class="text-[#cccccc] hover:text-[#f5f5f5] text-xl sm:text-2xl">&times;</button>
            </div>
            <div class="overflow-y-auto flex-1 space-y-3 sm:space-y-4">
                @forelse($allRecentActivities as $activity)
                <div class="flex items-center justify-between p-3 sm:p-4 border border-[#444444] rounded-xl hover:bg-[#333333] transition-colors duration-200">
                    <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold text-xs sm:text-sm flex-shrink-0">
                            {{ substr($activity['user_name'] ?? 'U', 0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">
                                {{ $activity['user_name'] ?? 'Utilisateur inconnu' }}
                            </h3>
                            <p class="text-xs sm:text-sm text-[#9ca3af] line-clamp-2">
                                {{ $activity['activity'] ?? 'Activité' }} - {{ $activity['description'] ?? 'Description non disponible' }}
                            </p>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 text-xs text-[#9ca3af] mt-1">
                                <span class="flex items-center gap-1 truncate">
                                    <svg class="w-3 h-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    <span class="truncate">{{ $activity['url'] ?? '/' }}</span>
                                </span>
                                <span class="hidden sm:inline">•</span>
                                <span class="truncate">{{ isset($activity['time']) && method_exists($activity['time'], 'diffForHumans') ? $activity['time']->diffForHumans() : 'Maintenant' }}</span>
                                <span class="hidden sm:inline">•</span>
                                <span class="text-green-400 truncate">{{ $activity['status'] ?? 'Succès' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right flex-shrink-0 ml-2">
                        <span class="px-1.5 sm:px-2 md:px-3 py-0.5 sm:py-1 rounded-full text-xs font-medium 
                            @if(isset($activity['user_type']) && $activity['user_type'] == 'candidate') text-blue-400 bg-blue-900/30
                            @elseif(isset($activity['user_type']) && $activity['user_type'] == 'recruiter') text-green-400 bg-green-900/30
                            @else text-purple-400 bg-purple-900/30
                            @endif whitespace-nowrap">
                            {{ $activity['user_type'] ?? 'admin' }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 sm:py-8">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-3 sm:mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5] mb-2">Aucune activité récente</h3>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">Aucune activité enregistrée pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Companies Popup Modal -->
    <div id="companiesModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-3 sm:p-4 md:p-6 max-w-4xl w-full mx-2 sm:mx-4 max-h-[80vh] overflow-hidden flex flex-col">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5]">Toutes les entreprises</h2>
                <button id="closeCompaniesModal" class="text-[#cccccc] hover:text-[#f5f5f5] text-xl sm:text-2xl">&times;</button>
            </div>
            <div class="overflow-y-auto flex-1 space-y-2 sm:space-y-3">
                @forelse(\App\Models\Company::withCount(['jobs', 'applications'])->orderBy('applications_count', 'desc')->get() as $company)
                <div class="flex items-center justify-between p-3 sm:p-4 border border-[#444444] rounded-lg hover:bg-[#333333] transition-colors">
                    <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center flex-shrink-0">
                            @if($company->logo)
                                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <svg class="w-7 h-7 sm:w-6 sm:h-6 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="font-semibold text-[#f5f5f5] text-xs sm:text-sm md:text-base truncate">{{ $company->name }}</h3>
                            <p class="text-xs sm:text-sm text-[#cccccc] truncate">{{ $company->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-4 text-xs sm:text-sm flex-shrink-0">
                        <div class="text-center">
                            <p class="font-semibold text-[#f5f5f5] truncate">{{ $company->jobs_count }}</p>
                            <p class="text-[#cccccc]">Offres</p>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold text-[#f5f5f5] truncate">{{ $company->applications_count }}</p>
                            <p class="text-[#cccccc]">Candidatures</p>
                        </div>
                        <div class="text-center">
                            <p class="font-semibold text-[#00b6b4] truncate">{{ number_format($company->applications_count * 50) }} DA</p>
                            <p class="text-[#cccccc]">Revenus</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 sm:py-8">
                    <p class="text-[#cccccc] text-xs sm:text-sm">Aucune entreprise trouvée</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('activitySearch');
    const userTypeFilter = document.getElementById('userTypeFilter');
    const timeFilter = document.getElementById('timeFilter');
    const refreshButton = document.getElementById('refreshTracking');
    const exportButton = document.getElementById('exportLogs');
    const trackingContainer = document.getElementById('trackingContainer');
    
    let allActivities = [];
    
    // Store all activities on page load
    function storeActivities() {
        const activityElements = trackingContainer.querySelectorAll('[data-activity]');
        allActivities = Array.from(activityElements).map(element => ({
            element: element,
            user_name: element.dataset.userName || '',
            activity: element.dataset.activity || '',
            description: element.dataset.description || '',
            user_type: element.dataset.userType || '',
            time: element.dataset.time || '',
            type: element.dataset.type || ''
        }));
    }
    
    // Filter activities based on search, user type, and time
    function filterActivities() {
        const searchTerm = searchInput.value.toLowerCase();
        const userTypeValue = userTypeFilter.value;
        const timeFilterValue = timeFilter.value;
        
        allActivities.forEach(activity => {
            let show = true;
            
            // Search filter
            if (searchTerm) {
                const searchableText = `${activity.user_name} ${activity.activity} ${activity.description} ${activity.user_type}`.toLowerCase();
                if (!searchableText.includes(searchTerm)) {
                    show = false;
                }
            }
            
            // User type filter
            if (userTypeValue && activity.user_type !== userTypeValue) {
                show = false;
            }
            
            // Time filter - only apply if not "all"
            if (timeFilterValue !== 'all') {
                let activityTime;
                
                // Handle different time formats
                if (activity.time) {
                    try {
                        activityTime = new Date(activity.time);
                    } catch (e) {
                        activityTime = new Date(); // Use current time as fallback
                    }
                } else {
                    activityTime = new Date(); // Use current time as fallback
                }
                
                const now = new Date();
                const timeDiff = now - activityTime;
                
                let timeLimit;
                switch(timeFilterValue) {
                    case '1h':
                        timeLimit = 60 * 60 * 1000; // 1 hour in milliseconds
                        break;
                    case '24h':
                        timeLimit = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
                        break;
                    case '7d':
                        timeLimit = 7 * 24 * 60 * 60 * 1000; // 7 days in milliseconds
                        break;
                    case '30d':
                        timeLimit = 30 * 24 * 60 * 60 * 1000; // 30 days in milliseconds
                        break;
                    default:
                        timeLimit = Infinity;
                }
                
                
                if (timeDiff > timeLimit) {
                    show = false;
                }
            }
            
            // Show/hide activity
            activity.element.style.display = show ? 'flex' : 'none';
        });
        
        // Update activity count display
        const visibleCount = allActivities.filter(activity => 
            activity.element.style.display !== 'none'
        ).length;
        
    }
    
    // Export filtered activities to CSV
    function exportToCSV() {
        const visibleActivities = allActivities.filter(activity => 
            activity.element.style.display !== 'none'
        );
        
        if (visibleActivities.length === 0) {
            alert('Aucune activité à exporter');
            return;
        }
        
        // Create CSV content
        let csvContent = 'Nom Utilisateur,Type Utilisateur,Activité,Description,Date,Type\n';
        
        visibleActivities.forEach(activity => {
            const date = new Date(activity.time).toLocaleString('fr-FR');
            csvContent += `"${activity.user_name}","${activity.user_type}","${activity.activity}","${activity.description}","${date}","${activity.type}"\n`;
        });
        
        // Create and download file
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', `tracking_logs_${new Date().toISOString().split('T')[0]}.csv`);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    
    // Refresh tracking data
    function refreshTracking() {
        refreshButton.innerHTML = `
            <svg class="w-7 h-7 animate-spin" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
            </svg>
        `;
        
        // Simulate refresh (in real implementation, this would fetch new data)
        setTimeout(() => {
            // Reload the page to get fresh data
            window.location.reload();
        }, 1000);
    }
    
    // Event listeners
    searchInput.addEventListener('input', filterActivities);
    userTypeFilter.addEventListener('change', filterActivities);
    timeFilter.addEventListener('change', filterActivities);
    refreshButton.addEventListener('click', refreshTracking);
    exportButton.addEventListener('click', exportToCSV);
    
    // Initialize
    storeActivities();
    
    // Apply default filter (1h) on page load
    filterActivities();
    
    // Auto-refresh every 30 seconds
    setInterval(() => {
        if (document.visibilityState === 'visible') {
            refreshTracking();
        }
    }, 30000);
    
    // Popup Modal Functionality
    const showAllActivitiesBtn = document.getElementById('showAllActivities');
    const showAllCompaniesBtn = document.getElementById('showAllCompanies');
    const activitiesModal = document.getElementById('activitiesModal');
    const companiesModal = document.getElementById('companiesModal');
    const closeActivitiesModal = document.getElementById('closeActivitiesModal');
    const closeCompaniesModal = document.getElementById('closeCompaniesModal');
    
    // Show activities modal
    showAllActivitiesBtn.addEventListener('click', () => {
        activitiesModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    
    // Show companies modal
    showAllCompaniesBtn.addEventListener('click', () => {
        companiesModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    
    // Close activities modal
    closeActivitiesModal.addEventListener('click', () => {
        activitiesModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    // Close companies modal
    closeCompaniesModal.addEventListener('click', () => {
        companiesModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    // Close modals when clicking outside
    activitiesModal.addEventListener('click', (e) => {
        if (e.target === activitiesModal) {
            activitiesModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    companiesModal.addEventListener('click', (e) => {
        if (e.target === companiesModal) {
            companiesModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Close modals with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            activitiesModal.classList.add('hidden');
            companiesModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
});

// Export Modal Functions
function showExportModal() {
    const modal = document.getElementById('exportModal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function hideExportModal() {
    const modal = document.getElementById('exportModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

function exportStats(format) {
    // Show loading state
    const button = event.target;
    const originalText = button.textContent;
    button.textContent = 'Export en cours...';
    button.disabled = true;
    
    // Create download URL
    const url = `/admin/export/stats?format=${format}`;
    
    // Create temporary link and trigger download
    const link = document.createElement('a');
    link.href = url;
    link.download = `stats_ompleo_${new Date().toISOString().split('T')[0]}.${format}`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Reset button state
    setTimeout(() => {
        button.textContent = originalText;
        button.disabled = false;
        hideExportModal();
    }, 2000);
}
</script>

<!-- Export Modal -->
<div id="exportModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl p-4 sm:p-6 w-full max-w-md mx-2 sm:mx-4">
        <div class="flex items-center justify-between mb-4 sm:mb-6">
            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">Exporter les statistiques</h3>
            <button onclick="hideExportModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                <svg class="w-7 h-7 sm:w-6 sm:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18"/>
                    <path d="M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <p class="text-[#9ca3af] text-xs sm:text-sm mb-4 sm:mb-6">Choisissez le format d'export pour les statistiques de la plateforme.</p>
        
        <div class="space-y-2 sm:space-y-3">
            <button onclick="exportStats('excel')" class="w-full bg-[#00b6b4] hover:bg-[#009e9c] text-white py-2.5 sm:py-3 px-3 sm:px-4 rounded-lg transition-colors flex items-center justify-center gap-1.5 sm:gap-2 text-xs sm:text-sm">
                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <path d="M7 10l5 5 5-5"/>
                    <path d="M12 15V3"/>
                </svg>
                Exporter en Excel (.xlsx)
            </button>
            
            <button onclick="exportStats('pdf')" class="w-full bg-red-600 hover:bg-red-700 text-white py-2.5 sm:py-3 px-3 sm:px-4 rounded-lg transition-colors flex items-center justify-center gap-1.5 sm:gap-2 text-xs sm:text-sm">
                <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <path d="M14 2v6h6"/>
                    <path d="M16 13H8"/>
                    <path d="M16 17H8"/>
                    <path d="M10 9H8"/>
                </svg>
                Exporter en PDF (.pdf)
            </button>
        </div>
        
        <div class="mt-4 sm:mt-6 flex justify-end gap-2 sm:gap-3">
            <button onclick="hideExportModal()" class="px-3 sm:px-4 py-1.5 sm:py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors text-xs sm:text-sm">
                Annuler
            </button>
        </div>
    </div>
</div>
