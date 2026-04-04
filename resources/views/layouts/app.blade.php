<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'OMPLEO - Plateforme de Recrutement')</title>
    <meta name="description" content="@yield('description', 'OMPLEO - La plateforme de recrutement qui connecte les talents aux opportunités. Trouvez votre emploi idéal ou recrutez les meilleurs candidats.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
        

    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    
    <!-- Vite Assets - Automatically handles both dev and production builds -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-[#212221] text-gray-100">
    <!-- Dark mode toggle script -->
    <script>
        // Force dark mode to match React project
        document.documentElement.classList.add('dark');
        document.body.style.backgroundColor = '#212221';
    </script>

    <!-- Main Content -->
    <div id="app" class="min-h-screen">
        @yield('content')
    </div>

    <div id="newsletterPopup" class="fixed inset-0 z-[10002] hidden">
        <!-- Backdrop with Strong Blur -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-xl transition-opacity duration-300" onclick="closeNewsletterPopup()"></div>
        
        <!-- Modal Content Container -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-[rgba(50,51,50,0.25)] rounded-2xl p-8 md:p-12 backdrop-blur-lg w-full max-w-2xl pointer-events-auto transform transition-all duration-300 scale-95 opacity-0 newsletter-modal-box relative shadow-2xl">
                <!-- Gradient Border Donut -->
                <div style="position: absolute; inset: 0; border: 1px solid transparent; border-radius: 1rem; background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; pointer-events: none;"></div>
                <!-- Close Button -->
                <button onclick="closeNewsletterPopup()" class="absolute top-4 right-4 p-2 text-gray-500 hover:text-white hover:bg-white/10 rounded-full transition-colors z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Text Content -->
                <div class="mb-8 text-center">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-3">
                        Sign-up to stay updated
                    </h3>
                    <p class="text-[#9ca3af] text-base md:text-lg">
                        Get the latest AI jobs in your inbox every Monday.
                    </p>
                </div>

                <!-- Form -->
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <div class="flex-1">
                        <input 
                            type="email" 
                            name="email"
                            placeholder="Email Address" 
                            class="w-full px-6 py-4 bg-[#0a0a0a] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#333333] focus:border-[#00b6b4]"
                        >
                    </div>
                    <button 
                        type="submit" 
                        class="px-8 py-4 bg-[#333333] text-white rounded-xl md:rounded-xl max-md:rounded-full font-bold hover:bg-[#444444] transition-all whitespace-nowrap max-md:min-h-[48px] max-md:w-full"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="searchPopup" class="fixed inset-0 z-[10002] hidden">
        <!-- Backdrop with Strong Blur -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-xl transition-opacity duration-300" onclick="closeSearchPopup()"></div>
        
        <!-- Modal Content Container -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-[rgba(50,51,50,0.25)] rounded-2xl overflow-hidden backdrop-blur-lg w-full max-w-md pointer-events-auto transform transition-all duration-300 scale-95 opacity-0 search-modal-box relative shadow-2xl">
                <!-- Gradient Border Donut -->
                <div style="position: absolute; inset: 0; border: 1px solid transparent; border-radius: 1rem; background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) border-box; -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0); -webkit-mask-composite: destination-out; mask-composite: exclude; pointer-events: none;"></div>
                <!-- Search Input Header -->
                <div class="p-4 border-b border-white/10 flex items-center gap-4 bg-[#0a0a0a]/50">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input 
                        type="text" 
                        id="liveSearchInput"
                        placeholder="Rechercher des offres..." 
                        class="flex-1 text-sm text-white placeholder-gray-500 focus:outline-none bg-transparent"
                        autocomplete="off"
                    >
                    <button onclick="closeSearchPopup()" class="p-1 text-gray-400 hover:text-white rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Results List -->
                <div id="searchResults" class="max-h-[50vh] overflow-y-auto">
                    <!-- Default state / No results -->
                    <div class="p-6 text-center text-sm text-gray-500 search-empty-state">
                        Commencez à taper pour rechercher des offres...
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
    
    <script>
        // Newsletter Popup Functions
        function openNewsletterPopup() {
            const popup = document.getElementById('newsletterPopup');
            const box = popup ? popup.querySelector('.newsletter-modal-box') : null;
            if (!popup || !box) return;
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeNewsletterPopup() {
            const popup = document.getElementById('newsletterPopup');
            const box = popup ? popup.querySelector('.newsletter-modal-box') : null;
            if (!popup || !box) return;
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                popup.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Search Popup Functions
        let searchTimeout = null;

        function openSearchPopup() {
            const popup = document.getElementById('searchPopup');
            const box = popup ? popup.querySelector('.search-modal-box') : null;
            const input = document.getElementById('liveSearchInput');
            
            if (!popup || !box) return;
            
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
                if (input) input.focus();
            }, 10);
        }

        function closeSearchPopup() {
            const popup = document.getElementById('searchPopup');
            const box = popup ? popup.querySelector('.search-modal-box') : null;
            if (!popup || !box) return;
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                popup.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Live Search Logic
        const liveSearchInput = document.getElementById('liveSearchInput');
        const searchResults = document.getElementById('searchResults');

        if (liveSearchInput) {
            liveSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    searchResults.innerHTML = `
                        <div class="p-8 text-center text-gray-500 search-empty-state">
                            ${query.length === 0 ? 'Commencez à taper pour rechercher des offres...' : 'Tapez au moins 2 caractères...'}
                        </div>
                    `;
                    return;
                }

                // Show loading state
                searchResults.innerHTML = `
                    <div class="p-8 text-center">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-[#00b6b4]"></div>
                    </div>
                `;

                searchTimeout = setTimeout(() => {
                    fetch(`/api/jobs/search?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.jobs && data.jobs.length > 0) {
                                let html = '<div class="py-2">';
                                data.jobs.forEach(job => {
                                    const jobPath = new URL(job.url).pathname;
                                    html += `
                                        <a href="${job.url}" class="block px-6 py-3 hover:bg-white/5 transition-colors group">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-semibold text-white group-hover:text-[#00b6b4] transition-colors">${job.title}</span>
                                                <span class="text-xs text-gray-500 font-medium">${jobPath}</span>
                                            </div>
                                        </a>
                                    `;
                                });
                                html += '</div>';
                                searchResults.innerHTML = html;
                            } else {
                                searchResults.innerHTML = `
                                    <div class="p-8 text-center text-gray-500 search-empty-state">
                                        Aucun résultat trouvé pour "${query}"
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            searchResults.innerHTML = `
                                <div class="p-8 text-center text-red-500">
                                    Une erreur est survenue lors de la recherche.
                                </div>
                            `;
                        });
                }, 300);
            });
        }

        // Close on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeNewsletterPopup();
                closeSearchPopup();
            }
        });
    </script>

    <!-- Dark mode toggle functionality -->
    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        }
        
        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const theme = localStorage.getItem('theme') || 'light';
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</body>
</html>
