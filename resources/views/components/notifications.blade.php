@auth
<div class="relative" x-data="notificationComponent()">
    <!-- Notification Bell -->
    <button 
        @click="toggleNotifications()"
        class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-[#00b6b4] transition-colors duration-200"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        
        <!-- Notification Badge -->
        <span 
            x-show="unreadCount > 0"
            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"
            x-text="unreadCount"
        ></span>
    </button>

    <!-- Notifications Dropdown -->
    <div 
        x-show="isOpen"
        @click.away="isOpen = false"
        class="absolute right-0 mt-2 w-80 bg-white dark:bg-[#2b2b2b] rounded-lg shadow-lg border border-gray-200 dark:border-[#333333] z-50"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 dark:border-[#333333]">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Notifications
                </h3>
                <button 
                    @click="markAllAsRead()"
                    x-show="unreadCount > 0"
                    class="text-sm text-[#00b6b4] hover:text-[#009e9c] transition-colors"
                >
                    Marquer tout comme lu
                </button>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto">
            <template x-if="notifications.length === 0">
                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                    Aucune notification
                </div>
            </template>
            
            <template x-for="notification in notifications" :key="notification.id">
                <div 
                    class="p-4 border-b border-gray-100 dark:border-[#333333] hover:bg-gray-50 dark:hover:bg-[#333333] transition-colors cursor-pointer"
                    :class="{ 'bg-blue-50 dark:bg-blue-900/20': !notification.is_read }"
                    @click="markAsRead(notification.id)"
                >
                    <div class="flex items-start gap-3">
                        <!-- Notification Icon -->
                        <div class="flex-shrink-0">
                            <div 
                                class="w-8 h-8 rounded-full flex items-center justify-center"
                                :class="{
                                    'bg-green-100 text-green-600': notification.notification.type === 'success',
                                    'bg-blue-100 text-blue-600': notification.notification.type === 'info',
                                    'bg-yellow-100 text-yellow-600': notification.notification.type === 'warning',
                                    'bg-red-100 text-red-600': notification.notification.type === 'error'
                                }"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Notification Content -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="notification.notification.title"></h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" x-text="notification.notification.message"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1" x-text="formatDate(notification.created_at)"></p>
                        </div>
                        
                        <!-- Unread Indicator -->
                        <div x-show="!notification.is_read" class="flex-shrink-0">
                            <div class="w-2 h-2 bg-[#00b6b4] rounded-full"></div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-200 dark:border-[#333333]">
            <a 
                href="{{ route('notifications') }}"
                class="block text-center text-sm text-[#00b6b4] hover:text-[#009e9c] transition-colors"
            >
                Voir toutes les notifications
            </a>
        </div>
    </div>
</div>

<script>
function notificationComponent() {
    return {
        isOpen: false,
        notifications: [],
        unreadCount: 0,
        loading: false,

        init() {
            this.loadNotifications();
            // Refresh notifications every 30 seconds
            setInterval(() => {
                this.loadNotifications();
            }, 30000);
        },

        async loadNotifications() {
            try {
                const response = await fetch('/api/notifications?per_page=5');
                const data = await response.json();
                
                if (data.success) {
                    this.notifications = data.data.data;
                    this.unreadCount = data.data.data.filter(n => !n.is_read).length;
                }
            } catch (error) {
                console.error('Error loading notifications:', error);
            }
        },

        async loadUnreadCount() {
            try {
                const response = await fetch('/api/notifications/unread-count');
                const data = await response.json();
                
                if (data.success) {
                    this.unreadCount = data.count;
                }
            } catch (error) {
                console.error('Error loading unread count:', error);
            }
        },

        toggleNotifications() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.loadNotifications();
            }
        },

        async markAsRead(notificationId) {
            try {
                const response = await fetch(`/api/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    // Update local state
                    const notification = this.notifications.find(n => n.id === notificationId);
                    if (notification) {
                        notification.is_read = true;
                        this.unreadCount = Math.max(0, this.unreadCount - 1);
                    }
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        },

        async markAllAsRead() {
            try {
                const response = await fetch('/api/notifications/read-all', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    // Update local state
                    this.notifications.forEach(notification => {
                        notification.is_read = true;
                    });
                    this.unreadCount = 0;
                }
            } catch (error) {
                console.error('Error marking all notifications as read:', error);
            }
        },

        formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInHours = Math.floor((now - date) / (1000 * 60 * 60));
            
            if (diffInHours < 1) {
                return 'Il y a quelques minutes';
            } else if (diffInHours < 24) {
                return `Il y a ${diffInHours}h`;
            } else {
                const diffInDays = Math.floor(diffInHours / 24);
                return `Il y a ${diffInDays} jour${diffInDays > 1 ? 's' : ''}`;
            }
        }
    }
}
</script>
@endauth
