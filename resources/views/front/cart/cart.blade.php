@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.basket') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>
        <div class="row d-flex justify-content-between ">

            @if($products->isEmpty())
                <div class="col mt-4 bg-light-subtle py-4 text-center rounded-2">
                    {{ __('messages.your_shopping_cart_is_empty') }}
                </div>
            @else
                <div class="col-lg-7 mt-4 bg-light-subtle py-2 rounded-2 border border-dark">
                    <table class="table table-light mt-2">
                        <thead>
                        <tr class="text-center">
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.product_price') }}</th>
                            <th>{{ __('messages.product_quantity') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)

                            <tr class="text-center mt-4 py-2">
                                <td>{{ $product->title }}</td>
                                <td>{{ number_format($product->price) }} {{ __('messages.toman') }}</td>
                                <td>
                                    <form action="{{ route('cart.update',$product->id) }}" method="post" class="row d-flex justify-content-center">
                                        @csrf
                                        <div class="col-auto">
                                            <select name="stock" id="stock" class="form-select small">
                                                @for($i = 0 ; $i <= $product->quantity ; $i++)
                                                    <option {{ $product->stock == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.update') }}</button>
                                        </div>

                                    </form>

                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4 border-2 border-secondary   py-4">
                    @include('front.payment.summery')
                    <div class="mt-4">
                        <form action="">
                            <button class="btn btn-primary w-100 py-3"
                                    type="submit">{{ __('messages.register_and_pay') }}</button>
                        </form>
                    </div>
                </div>
            @endif


        </div>

    </div>

@endsection
