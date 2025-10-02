<header class="w-full z-50 {{ request()->routeIs('admin.*') || request()->routeIs('recruiter.*') || request()->routeIs('candidate.*') ? 'bg-[#1f1f1f]' : 'bg-white dark:bg-[#1f1f1f]' }}">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0 group">
                <div class="flex items-center  px-4">
                  
                    <!-- Dark mode logo -->
                    <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-14 w-auto  dark:block">
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-1">
                @php
                    $isDashboard = request()->routeIs('admin.*') || request()->routeIs('recruiter.*') || request()->routeIs('candidate.*');
                @endphp
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('home') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Accueil</span>
                </a>
                <a href="{{ route('jobs.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('jobs.*') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Emplois</span>
                </a>
                <a href="{{ route('companies.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('companies.*') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Entreprises</span>
                </a>
                <a href="{{ route('candidates') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('candidates') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Candidats</span>
                </a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('blog.*') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Blog</span>
                </a>
                <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group {{ request()->routeIs('contact') ? 'bg-[#2b2b2b] text-[#00b6b4] font-semibold' : ($isDashboard ? 'text-[#00b6b4] hover:bg-[#2b2b2b]' : 'text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]') }}">
                    <span class="relative z-10">Contact</span>
                </a>
            </nav>

            <!-- Right Side -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Language Selector -->
                <div class="relative">
                    <button onclick="toggleLanguageMenu()" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                        <!-- Globe icon from Lucide React -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                    <div class="relative">
                        <button onclick="toggleUserMenu()" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                            <div class="w-8 h-8 bg-[#00b6b4] rounded-full flex items-center justify-center text-white text-sm font-bold shadow-md">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <!-- ChevronDown icon from Lucide React -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="m6 9 6 6 6-6"></path>
                            </svg>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-[#2b2b2b]/90 backdrop-blur-sm py-2 z-50 rounded-lg shadow-lg">
                            <div class="px-4 py-3 border-b border-gray-200/20 dark:border-[#333333]/20">
                                <p class="text-sm font-medium text-[#f5f5f5]">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-[#cccccc] mt-1">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- User icon from Lucide React -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Mon espace</span>
                            </a>
                            
                            <a href="{{ route('profile') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- User icon from Lucide React -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Mon profil</span>
                            </a>
                            
                            <a href="/settings" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <!-- Settings icon from Lucide React -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <span>Paramètres</span>
                            </a>
                            
                            <a href="{{ route('notifications') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200 relative">
                                <!-- Bell icon from Lucide React -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 hover:scale-105 text-[#00b6b4] hover:bg-[#2b2b2b]">
                        <!-- User icon from Lucide React -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Connexion</span>
                    </a>
                    
                    <a href="{{ route('register') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#00b6b4] text-white rounded-lg hover:bg-[#009e9c] transition-all duration-300 hover:scale-105 shadow-sm">
                        <!-- Building2 icon from Lucide React -->
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                            <path d="M10 6h4"></path>
                            <path d="M10 10h4"></path>
                            <path d="M10 14h4"></path>
                            <path d="M10 18h4"></path>
                        </svg>
                        <span>S'inscrire</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-2">
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                    <!-- Menu icon from Lucide React -->
                    <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                    <!-- X icon from Lucide React -->
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 6 6 18"></path>
                        <path d="M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-[#333333] bg-[#2b2b2b]">
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('home') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
                    Accueil
                </a>
                <a href="{{ route('jobs.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('jobs.*') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
                    Emplois
                </a>
                <a href="{{ route('companies.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('companies.*') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
                    Entreprises
                </a>
                <a href="{{ route('candidates') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('candidates') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
                    Candidats
                </a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('blog.*') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
                    Blog
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-[#333333] text-[#00b6b4] font-semibold' : 'text-[#00b6b4] hover:bg-[#333333]' }}">
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
                            <a href="{{ route('dashboard') }}" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                Mon espace
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="block w-full text-left text-red-400 px-3 py-3 text-base font-medium rounded-lg hover:bg-red-900/20 transition-all duration-300">
                                    Déconnexion
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-left text-[#00b6b4] px-3 py-3 text-base font-medium rounded-lg hover:bg-[#333333] transition-all duration-300">
                                Connexion
                            </a>
                            <a href="{{ route('register') }}" class="block w-full bg-[#00b6b4] text-white px-4 py-3 rounded-lg text-base font-medium text-center hover:bg-[#009e9c] transition-all duration-300 shadow-sm">
                                S'inscrire
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
function toggleLanguageMenu() {
    const menu = document.getElementById('languageMenu');
    menu.classList.toggle('hidden');
}

function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}

function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    const languageMenu = document.getElementById('languageMenu');
    const userMenu = document.getElementById('userMenu');
    
    if (!event.target.closest('[onclick="toggleLanguageMenu()"]')) {
        languageMenu.classList.add('hidden');
    }
    
    if (!event.target.closest('[onclick="toggleUserMenu()"]')) {
        userMenu.classList.add('hidden');
    }
});
</script>
