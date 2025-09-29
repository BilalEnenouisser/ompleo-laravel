<header class="w-full z-50 bg-white dark:bg-[#1f1f1f]">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0 group">
                <div class="flex items-center space-x-3 px-4">
                    <!-- Light mode logo (default) -->
                    <img src="{{ asset('LOGO OMPLEO LINE.png') }}" alt="OMPLEO" class="h-14 w-auto dark:hidden">
                    <!-- Dark mode logo -->
                    <img src="{{ asset('logo mode nuit.png') }}" alt="OMPLEO" class="h-14 w-auto hidden dark:block">
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Accueil</span>
                </a>
                <a href="{{ route('jobs.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Emplois</span>
                </a>
                <a href="{{ route('companies.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Entreprises</span>
                </a>
                <a href="{{ route('candidates') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Candidats</span>
                </a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Blog</span>
                </a>
                <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 relative overflow-hidden group text-[#00b6b4] hover:bg-gray-50 dark:hover:bg-[#2b2b2b]">
                    <span class="relative z-10">Contact</span>
                </a>
            </nav>

            <!-- Right Side -->
            <div class="hidden md:flex items-center space-x-4">
                <!-- Language Selector -->
                <div class="relative">
                    <button onclick="toggleLanguageMenu()" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                        <span>{{ app()->getLocale() === 'fr' ? '🇫🇷' : (app()->getLocale() === 'en' ? '🇬🇧' : '🇩🇿') }}</span>
                    </button>
                    
                    <!-- Language Menu -->
                    <div id="languageMenu" class="hidden absolute right-0 mt-2 w-48 bg-white/90 dark:bg-[#2b2b2b]/90 backdrop-blur-sm py-2 z-50 rounded-lg shadow-lg border border-gray-200 dark:border-[#333333]">
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- User Dropdown Menu -->
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-56 bg-white/90 dark:bg-[#2b2b2b]/90 backdrop-blur-sm py-2 z-50 rounded-lg shadow-lg border border-gray-200 dark:border-[#333333]">
                            <div class="px-4 py-3 border-b border-gray-200/20 dark:border-[#333333]/20">
                                <p class="text-sm font-medium text-[#f5f5f5]">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-[#cccccc] mt-1">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Mon espace</span>
                            </a>
                            
                            <a href="{{ route('profile') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Mon profil</span>
                            </a>
                            
                            <a href="/settings" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Paramètres</span>
                            </a>
                            
                            <a href="{{ route('notifications') }}" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-[#cccccc] hover:bg-[#333333] hover:text-[#00b6b4] transition-all duration-200 relative">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.828 7l2.586 2.586a2 2 0 002.828 0L12 7H4.828z"></path>
                                </svg>
                                <span>Notifications</span>
                            </a>
                            
                            <div class="border-t border-[#444444] my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 w-full text-left px-4 py-3 text-sm text-red-400 hover:bg-red-900/20 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3m13 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 px-3 py-2 text-sm font-medium rounded-lg transition-all duration-300 hover:scale-105 text-[#00b6b4] hover:bg-[#2b2b2b]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Connexion</span>
                    </a>
                    
                    <a href="{{ route('register') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#00b6b4] text-white rounded-lg hover:bg-[#009e9c] transition-all duration-300 hover:scale-105 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>S'inscrire</span>
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center space-x-2">
                <button onclick="toggleMobileMenu()" class="p-2 rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#2b2b2b]">
                    <svg id="menuIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="closeIcon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden py-4 border-t border-[#333333] bg-[#2b2b2b]">
            <div class="space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                    Accueil
                </a>
                <a href="{{ route('jobs.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                    Emplois
                </a>
                <a href="{{ route('companies.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                    Entreprises
                </a>
                <a href="{{ route('candidates') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                    Candidats
                </a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
                    Blog
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-3 text-base font-medium rounded-lg transition-all duration-300 text-[#00b6b4] hover:bg-[#333333]">
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
