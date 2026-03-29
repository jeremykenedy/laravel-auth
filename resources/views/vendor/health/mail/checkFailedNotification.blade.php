@component('mail::message')
# Laravel Health

{{ __('health::notifications.check_failed_mail_body') }}

@foreach($results as $result)
- {{ $result->check->getLabel() }}: {{ $result->getNotificationMessage() }}
@endforeach

@endcomponent
