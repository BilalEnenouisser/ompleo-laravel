@php
use Illuminate\Support\Facades\Storage;
$isDashboard = request()->routeIs('admin.*') || request()->routeIs('recruiter.*') || request()->routeIs('candidate.*');
$currentUserType = auth()->check() ? auth()->user()->user_type : null;
@endphp
<header class="w-full z-[10000] relative {{ $isDashboard ? 'bg-[#1f1f1f] border-b border-[#333333]' : 'bg-transparent' }}" style="{{ $isDashboard ? '' : 'background: transparent !important;' }}">
    <div class="w-full px-4 min-[1201px]:px-[2%]" style="{{ $isDashboard ? '' : 'background: transparent;' }}">
        <div class="relative flex justify-between items-center h-24" style="{{ $isDashboard ? '' : 'background: transparent;' }}">
            <!-- Left Side: Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 group">
                    <div class="flex items-center">
                        <!-- Dark mode logo -->
                        <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-14 w-auto dark:block">
                    </div>
                </a>
            </div>

            <!-- Center: Desktop Navigation -->
            <nav class="desktop-nav absolute left-1/2 transform -translate-x-1/2 z-[10001]">
                <!-- Parcourir les offres with dropdown -->
                <div class="relative group z-[10001]">
                    <button class="ompleo-btn !font-normal flex items-center {{ request()->routeIs('jobs.*') ? 'text-[#39fffc]' : 'text-white hover:text-[#39fffc]' }} transition-all duration-300">
                        <span>Parcourir les offres</span>
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full left-0 mt-2 w-64 bg-[#2b2b2b]/95 backdrop-blur-sm rounded-lg shadow-lg border border-[#333333] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[10001]">
                        <div class="py-2">
                            <a href="{{ route('jobs.index', ['tab' => 'all']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Dernières offres
                            </a>
                            <a href="{{ route('jobs.index', ['tab' => 'all', 'work_type' => 'remote']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Offres à distance
                            </a>
                            <a href="{{ route('jobs.index', ['tab' => 'type', 'type' => 'Stage']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Stages
                            </a>
                            <a href="{{ route('jobs.index', ['tab' => 'category']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Offres par catégorie
                            </a>
                            <a href="{{ route('jobs.index', ['tab' => 'location']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Offres par localisation
                            </a>
                            <a href="{{ route('jobs.index', ['tab' => 'type']) }}" class="block px-4 py-2 text-sm text-white hover:bg-[#333333] hover:text-[#39fffc] transition-colors">
                                Offres par type
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('companies.index') }}" class="px-4 py-2 text-base font-normal transition-all duration-300 {{ request()->routeIs('companies.*') ? 'text-[#39fffc]' : 'text-white hover:text-[#39fffc]' }}">
                    Entreprises
                </a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-base font-normal transition-all duration-300 {{ request()->routeIs('about') ? 'text-[#39fffc]' : 'text-white hover:text-[#39fffc]' }}">
                    À propos
                </a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-base font-normal transition-all duration-300 {{ request()->routeIs('blog.*') ? 'text-[#39fffc]' : 'text-white hover:text-[#39fffc]' }}">
                    Blog
                    </a>
                </nav>

            <!-- Right Side -->
            <div class="items-center space-x-4 desktop-right">
                <!-- Language Selector -->
                <div class="relative">
                    <button onclick="toggleLanguageMenu()" class="ompleo-btn text-[#00b6b4] hover:bg-[#2b2b2b] transition-all duration-300">
                        <!-- Globe icon from Lucide React -->
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"></path>
                            <path d="M2 12h20"></path>
                        </svg>
                        <span>{{ app()->getLocale() === 'fr' ? '🇫🇷' : (app()->getLocale() === 'en' ? '🇫🇷' : '🇩🇿') }}</span>
                    </button>
                    
                    <!-- Language Menu -->
                    <div id="languageMenu" class="hidden absolute right-0 mt-2 w-48 bg-[#2b2b2b]/90 backdrop-blur-sm py-2 z-50 rounded-lg shadow-lg ">
                        <a href="{{ route('locale', 'fr') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm transition-all duration-200 text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]">
                            <span>🇫🇷</span>
                            <span>Français</span>
                        </a>
                        <a href="{{ route('locale', 'en') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm transition-all duration-200 text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]">
                            <span>🇬🇧</span>
                            <span>English</span>
                        </a>
                        <a href="{{ route('locale', 'ar') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm transition-all duration-200 text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4]">
                            <span>🇩🇿</span>
                            <span>العربية</span>
                        </a>
                    </div>
                </div>

                <!-- User Menu or Auth Buttons -->
                @auth
                    <!-- Notification Bell -->
                    <div class="relative mr-2">
                        <button onclick="toggleNotificationMenu()" class="relative p-2 text-[#cccccc] hover:text-[#00b6b4] rounded-lg hover:bg-[#333333] transition-colors">
                            <!-- Bell icon from Lucide React -->
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                            </svg>
                            <!-- Unread count badge -->
                            <span id="notificationBadge" class="absolute top-0 right-0 w-7 h-7 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center hidden">
                                0
                            </span>
                        </button>

                        <!-- Notification Dropdown -->
                        <div id="notificationMenu" class="hidden absolute right-0 mt-2 w-[32rem] max-w-[calc(100vw-1rem)] max-h-[70vh] overflow-y-auto bg-[#2b2b2b] rounded-xl shadow-lg border border-[#333333] z-50">
                            <div class="p-4 border-b border-[#333333] flex items-center justify-between">
                                <h3 class="font-semibold text-[#f5f5f5]">Notifications</h3>
                                <div class="flex items-center gap-2">
                                    <button onclick="markAllAsRead()" class="text-xs text-[#00b6b4] hover:text-[#009e9c] flex items-center gap-1 hidden" id="markAllReadBtn">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M20 6 9 17l-5-5"></path>
                                        </svg>
                                        Tout marquer comme lu
                                    </button>
                                    <button onclick="toggleNotificationMenu()" class="text-[#9ca3af] hover:text-[#f5f5f5]">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M18 6 6 18"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div id="notificationList" class="divide-y divide-[#333333]">
                                <!-- Notifications will be loaded here -->
                            </div>

                            <div class="p-3 border-t border-[#333333] text-center">
                                <a href="{{ route('notifications') }}" class="text-sm text-[#00b6b4] hover:text-[#009e9c] font-medium" onclick="toggleNotificationMenu()">
                                    Voir toutes les notifications
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="relative">
            <button onclick="toggleUserMenu()" class="ompleo-btn text-[#00b6b4] hover:bg-[#2b2b2b] transition-all duration-300">
                @if(auth()->user()->user_type === 'recruiter' && auth()->user()->recruiterProfile && auth()->user()->recruiterProfile->company && auth()->user()->recruiterProfile->company->logo)
                    <img src="{{ Storage::url(auth()->user()->recruiterProfile->company->logo) }}" alt="Company Logo" class="w-8 h-8 rounded-full object-cover border-2 border-[#00b6b4] shadow-md">
                @elseif(auth()->user()->user_type === 'admin' && auth()->user()->avatar)
                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover border-2 border-[#00b6b4] shadow-md">
                @elseif(auth()->user()->candidateProfile && auth()->user()->candidateProfile->avatar)
                    <img src="{{ Storage::url(auth()->user()->candidateProfile->avatar) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover border-2 border-[#00b6b4] shadow-md">
                @else
                    <div class="w-8 h-8 bg-[#00b6b4] rounded-full flex items-center justify-center text-white text-sm font-bold shadow-md">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
                <span>
                    @if(auth()->user()->user_type === 'recruiter' && auth()->user()->recruiterProfile && auth()->user()->recruiterProfile->company)
                        {{ auth()->user()->recruiterProfile->company->name }}
                    @else
                        {{ auth()->user()->name }}
                    @endif
                </span>
                <!-- ChevronDown icon from Lucide React -->
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="m6 9 6 6 6-6"></path>
                </svg>
            </button>

                        <!-- User Dropdown Menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-[#2b2b2b]/90 backdrop-blur-sm py-2 z-50 rounded-lg shadow-lg">
                            <div class="px-4 py-3 border-b border-gray-200/20 dark:border-[#333333]/20">
                                <p class="text-sm font-medium text-[#f5f5f5]">
                                    @if(auth()->user()->user_type === 'recruiter' && auth()->user()->recruiterProfile && auth()->user()->recruiterProfile->company)
                                        {{ auth()->user()->recruiterProfile->company->name }}
                                    @else
                                        {{ auth()->user()->name }}
                                    @endif
                                </p>
                                <p class="text-xs text-[#cccccc] mt-1">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            
                            <a href="@if(auth()->user()->user_type === 'admin'){{ route('admin.dashboard') }}@elseif(auth()->user()->user_type === 'recruiter'){{ route('recruiter.dashboard') }}@elseif(auth()->user()->user_type === 'candidate'){{ route('candidate.dashboard') }}@else{{ route('dashboard') }}@endif" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- User icon from Lucide React -->
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Mon espace</span>
                            </a>
                            
                            @if(auth()->user()->user_type === 'recruiter')
                                <a href="{{ route('recruiter.company-profile') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                    <!-- Building icon from Lucide React -->
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                                        <path d="M10 6h4"></path>
                                        <path d="M10 10h4"></path>
                                        <path d="M10 14h4"></path>
                                        <path d="M10 18h4"></path>
                                    </svg>
                                    <span>Profil entreprise</span>
                                </a>
                            @elseif(auth()->user()->user_type === 'candidate')
                                <a href="{{ route('candidate.profile') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                    <!-- User icon from Lucide React -->
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Mon profil</span>
                                </a>
                            @elseif(auth()->user()->user_type === 'admin')
                                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                    <!-- User icon from Lucide React -->
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span>Mon profil</span>
                                </a>
                            @endif
                            
                            @if(auth()->user()->user_type === 'candidate')
                            <a href="{{ route('candidate.settings') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- Settings icon from Lucide React -->
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span>Paramètres</span>
                            </a>
                            @elseif(auth()->user()->user_type === 'recruiter')
                            <a href="{{ route('recruiter.settings') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- Settings icon from Lucide React -->
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span>Paramètres</span>
                            </a>
                            @endif
                            
                            <a href="{{ route('notifications') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200 relative">
                                <!-- Bell icon from Lucide React -->
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                </svg>
                                <span>Notifications</span>
                            </a>
                            
                            <div class="border-t border-[#444444] my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 transition-all duration-200">
                                    <!-- LogOut icon from Lucide React -->
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16,17 21,12 16,7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Publier une offre d'emploi button -->
                    <a href="{{ route('nos-solutions') }}" class="btn-premium-green">
                        Publier une offre d'emploi
                    </a>
                    
                    <!-- Se connecter button -->
                    <a href="{{ route('signup.choice') }}" class="btn-premium-dark">
                        Se connecter
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center space-x-2 mobile-menu-btn">
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                    <!-- Menu icon from Lucide React -->
                    <svg id="menuIcon" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                    <!-- X icon from Lucide React -->
                    <svg id="closeIcon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6 6 18"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden py-4 border-t border-[#333333] bg-[#2b2b2b]">
            <div class="space-y-2">
                <!-- Mobile "Parcourir les offres" with dropdown -->
                <div class="space-y-1">
                    <button onclick="toggleMobileDropdown('jobsMobileDropdown')" class="w-full flex items-center justify-between px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('jobs.*') ? 'bg-[#333333] text-[#00b6b4]' : 'text-white hover:bg-[#333333]' }}">
                        <span>Parcourir les offres</span>
                        <svg id="jobsMobileArrow" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </button>
                    <div id="jobsMobileDropdown" class="hidden pl-6 space-y-1">
                        <a href="{{ route('jobs.index', ['tab' => 'all']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Dernières offres</a>
                        <a href="{{ route('jobs.index', ['tab' => 'all', 'work_type' => 'remote']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Offres à distance</a>
                        <a href="{{ route('jobs.index', ['tab' => 'type', 'type' => 'Stage']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Stages</a>
                        <a href="{{ route('jobs.index', ['tab' => 'category']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Offres par catégorie</a>
                        <a href="{{ route('jobs.index', ['tab' => 'location']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Offres par localisation</a>
                        <a href="{{ route('jobs.index', ['tab' => 'type']) }}" onclick="closeMobileMenu()" class="block px-3 py-2 text-sm text-[#cccccc] hover:text-[#00b6b4]">Offres par type</a>
                    </div>
                </div>
                <a href="{{ route('companies.index') }}" onclick="closeMobileMenu()" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('companies.*') ? 'bg-[#333333] text-[#00b6b4]' : 'text-white hover:bg-[#333333]' }}">
                    Entreprises
                </a>
                <a href="{{ route('about') }}" onclick="closeMobileMenu()" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('about') ? 'bg-[#333333] text-[#00b6b4]' : 'text-white hover:bg-[#333333]' }}">
                    À propos
                </a>
                <a href="{{ route('blog.index') }}" onclick="closeMobileMenu()" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('blog.*') ? 'bg-[#333333] text-[#00b6b4]' : 'text-white hover:bg-[#333333]' }}">
                    Blog
                </a>
                <a href="{{ route('contact') }}" onclick="closeMobileMenu()" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-[#333333] text-[#00b6b4]' : 'text-white hover:bg-[#333333]' }}">
                    Contact
                </a>
                
                <div class="border-t border-[#444444] pt-4 mt-4">
                    <div class="space-y-2">
                        <a href="{{ route('locale', 'fr') }}" class="flex items-center space-x-3 w-full text-left px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                            <span>🇫🇷</span>
                            <span>Français</span>
                        </a>
                        <a href="{{ route('locale', 'en') }}" class="flex items-center space-x-3 w-full text-left px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                            <span>🇬🇧</span>
                            <span>English</span>
                        </a>
                        <a href="{{ route('locale', 'ar') }}" class="flex items-center space-x-3 w-full text-left px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                            <span>🇩🇿</span>
                            <span>العربية</span>
                        </a>
                    </div>
                    
                    <div class="mt-4 space-y-2">
                        @auth
                            <a href="{{ route('dashboard') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                Mon espace
                            </a>

                            @if(auth()->user()->user_type === 'recruiter')
                                <a href="{{ route('recruiter.company-profile') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                    Profil entreprise
                                </a>
                            @elseif(auth()->user()->user_type === 'candidate' || auth()->user()->user_type === 'admin')
                                <a href="{{ auth()->user()->user_type === 'candidate' ? route('candidate.profile') : route('admin.profile') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                    Mon profil
                                </a>
                            @endif

                            @if(auth()->user()->user_type === 'candidate')
                                <a href="{{ route('candidate.settings') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                    Paramètres
                                </a>
                            @elseif(auth()->user()->user_type === 'recruiter')
                                <a href="{{ route('recruiter.settings') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                    Paramètres
                                </a>
                            @endif

                            <a href="{{ route('notifications') }}" onclick="closeMobileMenu()" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                Notifications
                            </a>

                            <div class="border-t border-[#444444] my-2"></div>

                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" onclick="closeMobileMenu()" class="block w-full text-left text-red-400 px-3 py-3 text-base font-medium rounded-lg hover:bg-red-900/20 transition-all duration-300">
                                    Déconnexion
                                </button>
                            </form>
                        @else
                            <div class="px-3 space-y-3 pt-2">
                                <a href="{{ route('nos-solutions') }}" onclick="closeMobileMenu()" class="btn-premium-green !w-full">
                                    Publier une offre d'emploi
                                </a>
                                <a href="{{ route('signup.choice') }}" onclick="closeMobileMenu()" class="btn-premium-dark !w-full text-center">
                                    Connexion
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Mobile state: hide desktop nav, show mobile button */
    @media (max-width: 1200px) {
        .desktop-nav {
            display: none !important;
        }
        .desktop-right {
            display: none !important;
        }
        .mobile-menu-btn {
            display: flex !important;
        }
        /* Mobile menu padding adjustment */
        #mobileMenu {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }
    
    /* Small desktop state: compact navigation to prevent overlap */
    @media (min-width: 1201px) and (max-width: 1700px) {
        .desktop-nav {
            position: relative !important;
            left: 0 !important;
            transform: none !important;
            margin: 0 auto !important;
        }
        .desktop-nav a, .desktop-nav button {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
            font-size: 0.925rem !important;
        }
        .desktop-right {
            gap: 0.5rem !important;
        }
        .btn-premium-green, .btn-premium-dark {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
            font-size: 0.875rem !important;
        }
    }

    /* Desktop state: show desktop nav, hide mobile elements */
    @media (min-width: 1201px) {
        .desktop-nav {
            display: flex !important;
        }
        .desktop-right {
            display: flex !important;
        }
        .mobile-menu-btn {
            display: none !important;
        }
        #mobileMenu {
            display: none !important;
        }
    }
</style>

<script>
function toggleLanguageMenu() {
    const menu = document.getElementById('languageMenu');
    menu.classList.toggle('hidden');
}

function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}


function toggleNotificationMenu() {
    const menu = document.getElementById('notificationMenu');
    menu.classList.toggle('hidden');
    
    // Load notifications when opening
    if (!menu.classList.contains('hidden')) {
        loadNotifications();
    }
}

function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

function closeMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.add('hidden');
}

function toggleMobileDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const arrow = document.getElementById('jobsMobileArrow');
    
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        dropdown.classList.add('hidden');
        arrow.style.transform = 'rotate(0deg)';
    }
}




// Notification functions
function loadNotifications() {
    // Load real notifications from API
    fetch('/api/notifications?header=true', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.notifications) {
            const notifications = data.notifications.map(notification => ({
                id: notification.id,
                title: notification.title,
                message: notification.message,
                timestamp: new Date(notification.created_at),
                isRead: notification.is_read || notification.isRead,
                type: notification.type,
                rich_content: notification.rich_content,
                background_color: notification.background_color,
                interview: notification.interview || null
            }));
            
            renderNotifications(notifications);
            updateNotificationBadge(notifications);
        }
    })
    .catch(error => {
        // Show empty state on error
        renderNotifications([]);
        updateNotificationBadge([]);
    });
}

function renderNotifications(notifications) {
    const container = document.getElementById('notificationList');
    
    if (!container) {
        return;
    }
    
    if (notifications.length === 0) {
        container.innerHTML = `
            <div class="p-4 text-center text-[#9ca3af]">
                <svg class="w-8 h-8 mx-auto mb-2 text-[#666666]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                </svg>
                <p>Aucune notification</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = notifications.map(notification => {
        // Check if notification has rich content
        if (notification.rich_content && notification.rich_content.length > 0) {
            return renderRichNotification(notification);
        } else {
            return renderBasicNotification(notification);
        }
    }).join('');
}

function renderRichNotification(notification) {
    const interviewSection = notification.interview ? `
        <div class="mt-2 p-2 bg-[#333333] rounded border border-[#444444] text-xs">
            <div class="flex items-center gap-1.5 mb-1">
                <svg class="w-3 h-3 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                </svg>
                <span class="text-[#00b6b4] font-medium">Entretien</span>
            </div>
            <div class="space-y-1 text-[#9ca3af]">
                ${notification.interview.job_title ? `<div class="truncate text-[#f5f5f5] font-medium">${notification.interview.job_title}</div>` : ''}
                ${notification.interview.company ? `<div class="truncate">${notification.interview.company}</div>` : ''}
                <div class="flex items-center gap-2 flex-wrap">
                    ${notification.interview.date ? `<span>${notification.interview.date}</span>` : ''}
                    ${notification.interview.time ? `<span>${notification.interview.time}</span>` : ''}
                    ${notification.interview.type_in_french ? `<span>${notification.interview.type_in_french}</span>` : ''}
                </div>
                ${notification.interview.location ? `<div class="truncate">${notification.interview.location}</div>` : ''}
                ${notification.interview.notes ? `<div class="line-clamp-2">${notification.interview.notes}</div>` : ''}
            </div>
        </div>
    ` : '';
    
    return `
        <div class="p-4 hover:bg-[#333333] transition-colors cursor-pointer ${!notification.isRead ? 'bg-[#00b6b4]/10' : ''}">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center ${!notification.isRead ? 'bg-[#00b6b4]/10 text-[#00b6b4]' : 'bg-[#333333] text-[#9ca3af]'}">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                    </svg>
                </div>
                
                <div class="flex-1 min-w-0" onclick="handleNotificationClick(${notification.id})">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-medium text-[#f5f5f5]">${notification.title}</h4>
                        ${notification.rich_content && notification.rich_content.length > 0 ? `<span class="px-2 py-0.5 text-xs bg-[#00b6b4]/20 text-[#00b6b4] rounded-full whitespace-nowrap">De l'administration</span>` : ''}
                    </div>
                    <p class="text-sm text-[#9ca3af] line-clamp-2">${notification.message}</p>
                    ${interviewSection}
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-[#9ca3af]">${formatTime(new Date(notification.timestamp))}</span>
                        <div class="flex items-center gap-1">
                            ${!notification.isRead ? `
                                <button onclick="event.stopPropagation(); markAsRead(${notification.id})" class="p-1 text-[#00b6b4] hover:text-[#009e9c]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                </button>
                            ` : ''}
                            <button onclick="event.stopPropagation(); deleteNotification(${notification.id})" class="p-1 text-[#9ca3af] hover:text-red-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function renderBasicNotification(notification) {
    const interviewSection = notification.interview ? `
        <div class="mt-2 p-2 bg-[#333333] rounded border border-[#444444] text-xs">
            <div class="flex items-center gap-1.5 mb-1">
                <svg class="w-3 h-3 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                </svg>
                <span class="text-[#00b6b4] font-medium">Entretien</span>
            </div>
            <div class="space-y-1 text-[#9ca3af]">
                ${notification.interview.job_title ? `<div class="truncate text-[#f5f5f5] font-medium">${notification.interview.job_title}</div>` : ''}
                ${notification.interview.company ? `<div class="truncate">${notification.interview.company}</div>` : ''}
                <div class="flex items-center gap-2 flex-wrap">
                    ${notification.interview.date ? `<span>${notification.interview.date}</span>` : ''}
                    ${notification.interview.time ? `<span>${notification.interview.time}</span>` : ''}
                    ${notification.interview.type_in_french ? `<span>${notification.interview.type_in_french}</span>` : ''}
                </div>
                ${notification.interview.location ? `<div class="truncate">${notification.interview.location}</div>` : ''}
                ${notification.interview.notes ? `<div class="line-clamp-2">${notification.interview.notes}</div>` : ''}
            </div>
        </div>
    ` : '';
    
    return `
        <div class="p-4 hover:bg-[#333333] transition-colors cursor-pointer ${!notification.isRead ? 'bg-[#00b6b4]/10' : ''}">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center ${!notification.isRead ? 'bg-[#00b6b4]/10 text-[#00b6b4]' : 'bg-[#333333] text-[#9ca3af]'}">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                    </svg>
                </div>
                
                <div class="flex-1 min-w-0" onclick="handleNotificationClick(${notification.id})">
                    <h4 class="font-medium text-[#f5f5f5] mb-1">${notification.title}</h4>
                    <p class="text-sm text-[#9ca3af] line-clamp-2">${notification.message}</p>
                    ${interviewSection}
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-xs text-[#9ca3af]">${formatTime(new Date(notification.timestamp))}</span>
                        <div class="flex items-center gap-1">
                            ${!notification.isRead ? `
                                <button onclick="event.stopPropagation(); markAsRead(${notification.id})" class="p-1 text-[#00b6b4] hover:text-[#009e9c]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M20 6 9 17l-5-5"></path>
                                    </svg>
                                </button>
                            ` : ''}
                            <button onclick="event.stopPropagation(); deleteNotification(${notification.id})" class="p-1 text-[#9ca3af] hover:text-red-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Icon SVG helper function (same as in admin notifications)
function getIconSVG(iconName) {
    const iconMap = {
        'Bell': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>',
        'AlertTriangle': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
        'Info': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>',
        'CheckCircle': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>',
        'Gift': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-7 h-7"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path></svg>',
        'Clock': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'Star': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'Heart': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>',
        'ThumbsUp': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>',
        'MessageCircle': '<svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>'
    };
    return iconMap[iconName] || iconMap['Bell'];
}

function formatTime(date) {
    const now = new Date();
    const diffInSeconds = Math.floor((now.getTime() - date.getTime()) / 1000);
    
    if (diffInSeconds < 60) {
        return 'À l\'instant';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `Il y a ${minutes} minute${minutes > 1 ? 's' : ''}`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `Il y a ${hours} heure${hours > 1 ? 's' : ''}`;
    } else {
        const days = Math.floor(diffInSeconds / 86400);
        return `Il y a ${days} jour${days > 1 ? 's' : ''}`;
    }
}

function handleNotificationClick(notificationId) {
    // Mark as read when clicked
    markAsRead(notificationId);
    // Redirect to notifications page (the full page will handle the routing)
    window.location.href = '{{ route("notifications") }}';
}

function updateNotificationBadge(notifications) {
    const badge = document.getElementById('notificationBadge');
    const markAllBtn = document.getElementById('markAllReadBtn');
    const unreadCount = notifications.filter(n => !n.isRead).length;
    
    if (unreadCount > 0) {
        badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
        badge.classList.remove('hidden');
        markAllBtn.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
        markAllBtn.classList.add('hidden');
    }
}

function markAsRead(notificationId) {
    const currentUserType = @json($currentUserType);
    const url = currentUserType === 'admin'
        ? `/admin/notifications/view/${notificationId}/read`
        : `/notifications/${notificationId}/read`;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
            // Update badge count
            loadNotificationCount();
        }
    })
    .catch(error => {
        // Error handling - fail silently
    });
}

function markAllAsRead() {
    const currentUserType = @json($currentUserType);
    const url = currentUserType === 'admin'
        ? '/admin/notifications/view/read-all'
        : '/notifications/read-all';

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadNotifications();
            // Update badge count
            loadNotificationCount();
        }
    })
    .catch(error => {
        // Error handling - fail silently
    });
}

function deleteNotification(notificationId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette notification ?')) {
        const currentUserType = @json($currentUserType);
        const url = currentUserType === 'admin'
            ? `/admin/notifications/view/${notificationId}`
            : `/notifications/${notificationId}`;

        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();
                // Update badge count
                loadNotificationCount();
            }
        })
        .catch(error => {
            // Error handling - fail silently
        });
    }
}

// Load notifications on page load to show badge
@auth
document.addEventListener('DOMContentLoaded', function() {
    // Load notifications count on page load
    loadNotificationCount();
});
@endauth

// Load only notification count (lighter request)
function loadNotificationCount() {
    fetch('/api/notifications?header=true', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        const badge = document.getElementById('notificationBadge');
        const markAllBtn = document.getElementById('markAllReadBtn');
        
        if (data.unread_count !== undefined) {
            const unreadCount = data.unread_count;
            
            if (unreadCount > 0) {
                if (badge) {
                    badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                    badge.classList.remove('hidden');
                }
                if (markAllBtn) {
                    markAllBtn.classList.remove('hidden');
                }
            } else {
                if (badge) {
                    badge.classList.add('hidden');
                }
                if (markAllBtn) {
                    markAllBtn.classList.add('hidden');
                }
            }
        }
    })
    .catch(error => {
        // Silently fail - badge will remain hidden
    });
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const languageMenu = document.getElementById('languageMenu');
    const userMenu = document.getElementById('userMenu');
    const notificationMenu = document.getElementById('notificationMenu');
    
    if (!event.target.closest('[onclick="toggleLanguageMenu()"]')) {
        if (languageMenu) languageMenu.classList.add('hidden');
    }
    
    if (!event.target.closest('[onclick="toggleUserMenu()"]')) {
        if (userMenu) userMenu.classList.add('hidden');
    }
    
    if (!event.target.closest('[onclick="toggleNotificationMenu()"]')) {
        if (notificationMenu) notificationMenu.classList.add('hidden');
    }
});
</script>
