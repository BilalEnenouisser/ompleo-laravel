@foreach($notifications as $userNotification)
    @include('recruiter.notification-card', ['userNotification' => $userNotification])
@endforeach

