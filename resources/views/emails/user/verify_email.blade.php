@component('mail::message')
# Hi {{ $user->first_name }}

{{ Lang::getFromJson('Please copy the following code to verify your account:') }}

@component('mail::panel')
# {{ $user->email_verification_code }}
@endcomponent

Your verification code will expire in 3 days.

{{ Lang::getFromJson('If you did not request a confirmation, no further action is required.') }}

The {{ config('app.name') }} Team. <br>
@endcomponent
