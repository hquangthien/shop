@component('mail::message')
@component('mail::panel')
    {{ $title }}
@endcomponent

{{ $email['detail'] }}

Thanks,<br>
Hoàng Quang Thiên
@endcomponent
