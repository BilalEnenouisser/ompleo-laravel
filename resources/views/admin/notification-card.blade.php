<div class="bg-[#2b2b2b] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-[#333333] {{ !$userNotification->is_read ? 'border-l-4 border-l-[#00b6b4]' : '' }}">
    @include('admin.notification-item')
</div>

