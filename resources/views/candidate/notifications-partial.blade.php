@foreach($notifications as $userNotification)
    @php
        // Ensure the transform logic runs (this is handled in controller)
        // We'll just render the notification as-is since transform already happened
    @endphp
    @include('candidate.notification-card', ['userNotification' => $userNotification])
@endforeach
