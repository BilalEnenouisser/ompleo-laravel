<div class="bg-[#2b2b2b] rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg border border-[#333333] {{ !$userNotification->is_read ? 'border-l-4 border-l-[#00b6b4]' : '' }} {{ isset($userNotification->related_route) && $userNotification->related_route ? 'cursor-pointer hover:bg-[#333333] transition-colors' : '' }}" 
     @if(isset($userNotification->related_route) && $userNotification->related_route)
     onclick="window.location.href='{{ $userNotification->related_route }}'"
     @endif>
    @include('recruiter.notification-item')
</div>

