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
    <link rel="stylesheet" href="{{ asset('build/assets/app-b7de3c0d.css') }}">
    <script type="module" src="{{ asset('build/assets/app-09eaf0bc.js') }}"></script>
    
    <!-- Vite Assets - Automatically handles both dev and production builds -->
    @vite(['resources/css/app.css', 'resources/css/hero-animations.css', 'resources/js/app.js'])
    
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
        <!-- Backdrop with Blur -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md transition-opacity duration-300" onclick="closeNewsletterPopup()"></div>
        
        <!-- Modal Content Container -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <div class="bg-[#2b2b2b]/95 border border-[#333333] rounded-2xl p-8 md:p-12 backdrop-blur-md w-full max-w-2xl pointer-events-auto transform transition-all duration-300 scale-95 opacity-0 newsletter-modal-box relative shadow-2xl">
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
                            placeholder="Email Address" 
                            class="w-full px-6 py-4 bg-[#1f1f1f] text-white placeholder-gray-500 focus:outline-none transition-colors rounded-xl border border-[#333333] focus:border-[#00b6b4]"
                            required
                        >
                    </div>
                    <button 
                        type="submit" 
                        class="px-8 py-4 bg-[#333333] text-white rounded-xl font-bold hover:bg-[#444444] transition-all whitespace-nowrap"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    @stack('scripts')
    
    <script>
        function openNewsletterPopup() {
            const popup = document.getElementById('newsletterPopup');
            const box = popup.querySelector('.newsletter-modal-box');
            
            if (!popup || !box) return;
            
            popup.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Short delay to allow browser to trigger transition
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeNewsletterPopup() {
            const popup = document.getElementById('newsletterPopup');
            const box = popup.querySelector('.newsletter-modal-box');
            
            if (!popup || !box) return;

            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                popup.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Close on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeNewsletterPopup();
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
