<x-mail::message>
# Verify your email

Dear User : {{ $user }}

<x-mail::button :url="$link">
Verify your email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
