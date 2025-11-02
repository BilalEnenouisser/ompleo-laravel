@foreach($notifications as $userNotification)
    @include('admin.notification-card', ['userNotification' => $userNotification])
@endforeach

