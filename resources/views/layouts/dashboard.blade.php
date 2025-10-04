<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard - OMPLEO')</title>
    <meta name="description" content="@yield('description', 'Tableau de bord OMPLEO')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('components.header')
    
    <div class="min-h-screen bg-dark-900 flex w-full">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-[#2b2b2b] shadow-xl transform transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 lg:static lg:inset-0" id="sidebar">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-between p-4 sm:p-6 border-b border-[#333333]">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 sm:space-x-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-[#00b6b4] flex items-center justify-center p-1.5 sm:p-2">
                            <img 
                                src="{{ asset('fgehr.png') }}" 
                                alt="OMPLEO" 
                                class="w-full h-full object-contain filter brightness-0 invert"
                            />
                        </div>
                        <span class="text-lg sm:text-xl font-bold text-[#00b6b4]">OMPLEO</span>
                    </a>
                    <button
                        onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg bg-[#00b6b4] text-white hover:bg-[#009e9c] transition-colors"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="4" y1="12" x2="20" y2="12"/>
                            <line x1="4" y1="6" x2="20" y2="6"/>
                            <line x1="4" y1="18" x2="20" y2="18"/>
                        </svg>
                    </button>
                </div>

                <!-- User Info -->
                <div class="p-4 sm:p-6 border-b border-[#333333]">
                    <div class="flex items-center space-x-2 sm:space-x-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base">
                            {{ substr(Auth::user()->name, 0, 1) }}{{ substr(Auth::user()->name, -1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm sm:text-base font-medium text-[#f5f5f5] truncate">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs sm:text-sm text-[#cccccc] capitalize">
                                {{ Auth::user()->user_type }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-3 sm:p-4 space-y-1 sm:space-y-2">
                    @if(Auth::user()->user_type === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <path d="M9 22V12h6v10"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Tableau de bord</span>
                        </a>
                        <a href="{{ route('admin.users') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Utilisateurs</span>
                        </a>
                        <a href="{{ route('admin.jobs') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.jobs') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Offres d'emploi</span>
                        </a>
                        <a href="{{ route('admin.partners') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.partners') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                <path d="M10 6h4"/>
                                <path d="M10 10h4"/>
                                <path d="M10 14h4"/>
                                <path d="M10 18h4"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Partenaires</span>
                        </a>
                <a href="{{ route('admin.blog') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.blog') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                        <path d="M7 7h.01"/>
                    </svg>
                    <span class="font-medium text-sm sm:text-base">Blog</span>
                </a>
        <a href="{{ route('admin.notifications') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.notifications') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
            </svg>
            <span class="font-medium text-sm sm:text-base">Notifications</span>
        </a>
        <a href="{{ route('admin.reports') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.reports') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/>
                <line x1="4" x2="4" y1="22" y2="15"/>
            </svg>
            <span class="font-medium text-sm sm:text-base">Signalements</span>
        </a>
        <a href="{{ route('admin.payments') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.payments') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart3 w-5 h-5">
                <path d="M3 3v18h18"/>
                <path d="M18 17V9"/>
                <path d="M13 17V5"/>
                <path d="M8 17v-3"/>
            </svg>
            <span class="font-medium text-sm sm:text-base">Paiements</span>
        </a>
                    @elseif(Auth::user()->user_type === 'recruiter')
                        <a href="{{ route('recruiter.dashboard') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.dashboard') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                                <path d="M9 22V12h6v10"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Tableau de bord</span>
                        </a>
                        <a href="{{ route('recruiter.jobs') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.jobs') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 20V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v16"/>
                                <rect width="8" height="6" x="8" y="6" rx="1"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Mes Offres</span>
                        </a>
                        <a href="{{ route('recruiter.candidates') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.candidates') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            <span class="font-medium text-sm sm:text-base">Candidats</span>
                        </a>
                        <a href="{{ route('recruiter.interviews') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.interviews') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            <span class="font-medium text-sm sm:text-base">Entretiens</span>
                        </a>
                        <a href="{{ route('recruiter.reports') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('recruiter.reports') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
                            <span class="font-medium text-sm sm:text-base">Rapports</span>
                        </a>
                    @elseif(Auth::user()->user_type === 'candidate')
                        <a href="{{ route('candidate.dashboard') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('candidate.dashboard') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg>
                            <span class="font-medium text-sm sm:text-base">Tableau de bord</span>
                        </a>
                        <a href="{{ route('candidate.profile') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('candidate.profile') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span class="font-medium text-sm sm:text-base">Mon Profil</span>
                        </a>
                        <a href="{{ route('candidate.applications') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('candidate.applications') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v16"/><rect width="8" height="6" x="8" y="6" rx="1"/></svg>
                            <span class="font-medium text-sm sm:text-base">Mes Candidatures</span>
                        </a>
                        <a href="{{ route('candidate.referrals') }}" class="flex items-center space-x-2 sm:space-x-3 px-3 sm:px-4 py-2 sm:py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('candidate.referrals') ? 'bg-[#333333] text-[#00b6b4] border-r-2 border-[#00b6b4]' : 'text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]' }}">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span class="font-medium text-sm sm:text-base">Parrainer un ami</span>
                        </a>
                    @endif
                </nav>

                <!-- Bottom Actions -->
                <div class="p-4 border-t border-[#333333] space-y-2">
                    <button class="flex items-center space-x-3 w-full px-4 py-3 text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] rounded-xl transition-all duration-200">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                        <span class="font-medium">Paramètres</span>
                    </button>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full px-4 py-3 text-red-400 hover:bg-red-900/20 rounded-xl transition-all duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <polyline points="16,17 21,12 16,7"/>
                                <line x1="21" x2="9" y1="12" y2="12"/>
                            </svg>
                            <span class="font-medium">Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col w-full min-w-0">
            <!-- Top Bar -->
            <header class="bg-[#2b2b2b] shadow-sm border-b border-[#333333] px-4 sm:px-6 py-3 sm:py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <button
                            onclick="toggleSidebar()"
                            class="lg:hidden p-2 rounded-lg bg-[#00b6b4] text-white hover:bg-[#009e9c] transition-colors"
                        >
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M3 12h18"/>
                                <path d="M3 18h18"/>
                            </svg>
                        </button>
                        <h1 class="text-lg sm:text-2xl font-bold text-[#f5f5f5]">
                            @yield('page-title', 'Dashboard')
                        </h1>
                    </div>
                    
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <button class="p-2 text-[#cccccc] hover:text-[#00b6b4] rounded-lg hover:bg-[#333333]">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 overflow-auto bg-[#1f1f1f] w-full min-w-0">
                <div class="w-full max-w-full">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Sidebar Overlay -->
        <div
            id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"
            onclick="toggleSidebar()"
        ></div>
    </div>

    @include('components.footer')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
