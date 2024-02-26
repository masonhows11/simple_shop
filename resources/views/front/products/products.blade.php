@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.products') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
            <div class="card-body">
                <div class="row mb-5">
                    @foreach($products as $product)

                        <div class="col-md-4">

                            <div class="card" style="width:18rem">

                                <img src="{{ asset('default_image/no-image-icon-23494.png') }}" alt="product-image.{{ $product->id }}">
                                <div class="card-body">
                                    <h5 class="title">{{ $product->title }}</h5>
                                    <p class="card-text">{{ substr($product->description,0,50) }}</p>
                                    <a href="" class="btn btn-primary">{{ __('messages.add_to_cart') }}</a>
                                </div>
                            </div>

                        </div>

                    @endforeach
                </div>
            </div>
        </div>

    </div>

@endsection

