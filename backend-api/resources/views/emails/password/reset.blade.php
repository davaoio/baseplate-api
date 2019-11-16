@component('mail::message')
# Hi {{ $passwordReset->user->first_name }},

{{ Lang::getFromJson('You have requested to reset your password for your :app account.', ['app' => config('app.name')]) }}

{{ Lang::getFromJson('Simply copy this code') }}

@component('mail::panel')
# {{ $passwordReset->token }}
@endcomponent

{{ Lang::getFromJson('and paste it into the app’s reset password form.') }}

{{ Lang::getFromJson('Your code will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]) }}

{{ Lang::getFromJson('If you did not make this request, no further action is required.') }}

The {{ config('app.name') }} Team. <br>
@endcomponent
