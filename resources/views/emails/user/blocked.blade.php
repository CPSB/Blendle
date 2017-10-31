@component('mail::message')
# Your account has been suspended.

An administrator has blocked your account. Because you abused our Community Guidelines.

### End date:
{{ $input['endDate'] }}

### Reason:
{{ $input['reason'] }}

Best regards,<br>
{{ config('app.name') }}
@endcomponent
