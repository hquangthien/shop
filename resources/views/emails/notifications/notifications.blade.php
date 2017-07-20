@component('mail::message')
@component('mail::panel')
    {{ $title }}
@endcomponent

{{ $email['detail'] }}

@component('mail::button', ['url' => $email['links']])
Chi tiết đơn hàng
@endcomponent

Thanks,<br>
Hoàng Quang Thiên
@endcomponent
