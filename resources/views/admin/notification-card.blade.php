<div class="bg-[#2b2b2b] rounded-2xl p-6 shadow-lg border border-[#333333] {{ !$userNotification->is_read ? 'border-l-4 border-l-[#00b6b4]' : '' }}">
    @include('admin.notification-item')
</div>

