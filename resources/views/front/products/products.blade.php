@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.products') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
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

@endsection

