<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    @include('admin.include.header_styles')
</head>
<body>
@include('admin.include.header')
@include('admin.include.header_responsive')
@include('admin.include.nav')
<main>
    @yield('main_content')
</main>
@include('admin.include.footer')
@include('admin.alert.delete_confirm',['className'=> 'delete-item'])
@include('admin.alert.alert')
@stack('admin_custom_scripts')
</body>

</html>
