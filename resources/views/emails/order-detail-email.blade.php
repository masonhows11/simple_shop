<x-mail::message>
# Reset Password

 Dear User : {{ $user }}

<x-mail::button :url="$link">
    click here for reset your password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
