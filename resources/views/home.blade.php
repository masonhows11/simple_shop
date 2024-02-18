<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('messages.site_name') }}</title>
    <!-- Styles -->
    @include('layouts.include.header_styles')
</head>
<body>
@include('layouts.include.header')
@yield('main_content')
@include('layouts.include.footer')
@include('layouts.include.footer_scripts')
</body>
</html>

