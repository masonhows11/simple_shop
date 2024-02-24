<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('admin_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.include.header_styles')
</head>
<body>
@include('admin.include.sidebar')
<div class="content">
    @include('admin.include.header')
    @include('admin.include.sub_header')
    <div class="main-content">
        @yield('admin_main_content')
    </div>
</div>
</body>

@include('admin.include.footer_scripts')
@stack('admin_custom_scripts')
</html>
