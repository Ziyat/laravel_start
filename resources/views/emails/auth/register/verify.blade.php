@component('mail::message')
    # Email Confirmation

    please refer to the following link:

    @component('mail::button',['url' => route('register.verify',['token'=> $user->verify_token])])
        Verify Email
    @endComponent()

    Thanks, <br>
    {{ config('app.name') }}
@endcomponent()