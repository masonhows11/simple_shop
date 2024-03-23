<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">

    <title>@yield('page_title')</title>
    @include('layouts.include.header_styles')
 

</head>
<body>
@include('layouts.include.header')
<main>
    @yield('main_content')
</main>
@include('layouts.include.footer')
@include('layouts.include.footer_scripts')
{{--@include('layouts.alert.alert')--}}
@stack('front_custom_scripts')
@stack('front_custom_style')
</body>
</html>
