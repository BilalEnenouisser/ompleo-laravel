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
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-[#1f1f1f] text-gray-100">
    <!-- Dark mode toggle script -->
    <script>
        // Force dark mode to match React project
        document.documentElement.classList.add('dark');
        document.body.style.backgroundColor = '#1f1f1f';
    </script>

    <!-- Main Content -->
    <div id="app" class="min-h-screen">
        @yield('content')
    </div>


    <!-- Scripts -->
    @stack('scripts')
    
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
