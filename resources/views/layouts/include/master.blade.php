<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Styles -->
    @include('layouts.include.header_styles')
</head>
<body>
@include('layouts.include.header')



@include('layouts.include.footer')
@include('layouts.include.footer_scripts')
</body>
</html>

