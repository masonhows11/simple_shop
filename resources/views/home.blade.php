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
@include('layouts.alert.alert_unverified')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            @include('layouts.alert.alert')
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">

        @foreach($products as $product)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('default_image/no-image-icon-23494.png') }}" alt="product-image.{{ $product->id }}">
                    <div class="card-body">
                        <h5 class="title mt-2">{{ $product->title }}</h5>
                        <p class="card-text mt-2">{{ Str::substr($product->description,0,60) . "..."  }}</p>
                        <p class="card-text mt-2">{{ number_format($product->price) }} {{ __('messages.toman') }}</p>
                        <a href="{{ route('cart.add-to-cart',$product->id) }}" class="btn btn-primary mt-2">{{ __('messages.add_to_cart') }}</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>
@include('layouts.include.footer')
@include('layouts.include.footer_scripts')
{{--@include('layouts.alert.alert_swal')--}}
</body>
</html>

