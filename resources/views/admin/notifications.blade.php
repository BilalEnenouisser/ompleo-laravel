<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Notifications - OMPLEO</title>
    <meta name="description" content="Gérez toutes les notifications">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Build Assets -->
    @if(vite_asset('resources/css/app.css'))
    <link rel="stylesheet" href="{{ vite_asset('resources/css/app.css') }}">
    @endif
</head>
<body class="font-sans antialiased min-h-screen bg-[#1f1f1f] dark">
    @include('components.header')
    
    <div class="pt-20">
        <div class="container mx-auto px-3 sm:px-4 py-4 sm:py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col gap-4 mb-6 sm:mb-8">
                    <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                        Toutes les notifications
                    </h1>
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <button onclick="markAllAsRead()" class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 bg-[#00b6b4]/10 text-[#00b6b4] rounded-lg hover:bg-[#00b6b4]/20 transition-colors text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check w-4 h-4">
                                <path d="M18 6 7 17l-5-5"/>
                                <path d="M22 6 11 17l-5-5"/>
                            </svg>
                            <span class="hidden xs:inline">Tout marquer comme lu</span>
                            <span class="xs:hidden">Marquer tout lu</span>
                        </button>
                        <button onclick="deleteAllNotifications()" class="flex items-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 bg-red-900/20 text-red-400 rounded-lg hover:bg-red-900/30 transition-colors text-sm sm:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                            <span class="hidden xs:inline">Tout supprimer</span>
                            <span class="xs:hidden">Tout supprimer</span>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-[#2b2b2b] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-[#333333] mb-4 sm:mb-6">
                    <form id="filterForm" method="GET" action="{{ route('admin.notifications') }}">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="m21 21-4.35-4.35"/>
                                </svg>
                                <input
                                    type="text"
                                    id="searchInput"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Rechercher..."
                                    class="w-full pl-10 pr-4 py-2.5 sm:py-3 border border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#2b2b2b] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                                />
                            </div>
                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                                </svg>
                                <select id="filterSelect" name="filter" class="w-full sm:w-auto pl-10 pr-8 py-2.5 sm:py-3 border border-[#333333] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#2b2b2b] text-[#f5f5f5] text-sm sm:text-base sm:min-w-[150px]">
                                    <option value="all" {{ request('filter') == 'all' || !request('filter') ? 'selected' : '' }}>Toutes</option>
                                    <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Non lues</option>
                                    <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Lues</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Notifications List -->
                <div id="notificationsList" class="space-y-3 sm:space-y-4">
                    @if($notifications->count() > 0)
                        @foreach($notifications as $userNotification)
                            @include('admin.notification-card', ['userNotification' => $userNotification])
                        @endforeach
                    @else
                        <div class="bg-[#2b2b2b] rounded-xl sm:rounded-2xl p-8 sm:p-12 shadow-lg border border-[#333333] text-center">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-4 text-[#666666]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                </svg>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-2">Aucune notification</h3>
                            <p class="text-sm sm:text-base text-[#9ca3af]">Il n'y a pas encore de notifications dans le système.</p>
                        </div>
                    @endif
                </div>
                
                <!-- Load More Button -->
                @if($notifications->hasMorePages())
                    <div class="mt-4 sm:mt-6 text-center">
                        <button id="loadMoreBtn" class="w-full sm:w-auto px-6 py-2.5 sm:py-3 bg-[#00b6b4] hover:bg-[#009999] text-white rounded-lg transition-colors font-medium text-sm sm:text-base">
                            Charger plus
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <script>
        let currentPage = {{ $notifications->currentPage() }};
        let hasMore = {{ $notifications->hasMorePages() ? 'true' : 'false' }};
        let isLoading = false;

        // Search functionality
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        // Filter functionality
        document.getElementById('filterSelect').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // Load More functionality
        document.getElementById('loadMoreBtn')?.addEventListener('click', function() {
            if (isLoading || !hasMore) return;
            
            isLoading = true;
            const btn = this;
            btn.disabled = true;
            btn.textContent = 'Chargement...';
            
            const search = document.getElementById('searchInput').value;
            const filter = document.getElementById('filterSelect').value;
            
            fetch(`{{ route('admin.notifications.view') }}?page=${currentPage + 1}&search=${encodeURIComponent(search)}&filter=${encodeURIComponent(filter)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                // Create a temporary container to parse the HTML
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.html;
                
                // Select all top-level notification card divs (direct children)
                const notificationsList = document.getElementById('notificationsList');
                const newNotifications = Array.from(tempDiv.children);
                
                newNotifications.forEach(notification => {
                    notificationsList.appendChild(notification);
                });
                
                currentPage = data.next_page;
                hasMore = data.has_more;
                
                if (!hasMore) {
                    btn.parentElement.remove();
                } else {
                    btn.disabled = false;
                    btn.textContent = 'Charger plus';
                }
                isLoading = false;
            })
            .catch(error => {
                console.error('Error loading more notifications:', error);
                btn.disabled = false;
                btn.textContent = 'Charger plus';
                isLoading = false;
            });
        });
        
        function markAsRead(id) {
            fetch(`/admin/notifications/view/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
            });
        }

        function deleteNotification(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette notification ?')) {
                fetch(`/admin/notifications/view/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                });
            }
        }

        function markAllAsRead() {
            fetch('/admin/notifications/view/read-all', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
            });
        }

        function deleteAllNotifications() {
            if (confirm('Êtes-vous sûr de vouloir supprimer toutes les notifications ?')) {
                fetch('/admin/notifications/view', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                });
            }
        }

        // Add event listeners to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const markAllButton = document.querySelector('button[onclick*="markAllAsRead"]');
            if (markAllButton) {
                markAllButton.addEventListener('click', markAllAsRead);
            }

            const deleteAllButton = document.querySelector('button[onclick*="deleteAllNotifications"]');
            if (deleteAllButton) {
                deleteAllButton.addEventListener('click', deleteAllNotifications);
            }
        });
    </script>
    
    <!-- Build Assets JS -->
    @if(vite_asset('resources/js/app.js'))
    <script type="module" src="{{ vite_asset('resources/js/app.js') }}"></script>
    @endif
</body>
</html>