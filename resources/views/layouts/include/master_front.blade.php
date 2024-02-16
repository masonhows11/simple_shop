<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    @include('front.layouts.header_styles')
</head>
<body>
<!-- start header -->
@include('front.layouts.include.header')
<!-- end header -->

<!-- start responsive header-->
@include('front.layouts.include.header_responsive')
<!-- end responsive header-->

<!-- start main menu -->
@include('front.layouts.include.nav')
<!-- end main menu -->

<!-- start main -->
<main>
    @yield('main_content')
</main>
<!-- end main -->

<!-- start footer -->
@include('front.layouts.include.footer')
<!-- end footer -->

@include('front.layouts.footer_scripts' )
@include('front.layouts.alert.delete_confirm',['className'=> 'delete-item'])
@include('front.layouts.alert.alert')
@stack('front_custom_scripts')
</body>

</html>
