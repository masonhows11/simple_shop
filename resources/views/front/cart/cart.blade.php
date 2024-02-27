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
                <div class="col mt-4 bg-secondary-subtle py-4 text-center rounded-2">
                    {{ __('messages.your_shopping_cart_is_empty') }}
                </div>
            @else
                <div class="col-lg-7 mt-4 bg-secondary-subtle py-2">
                    <table class="table table-secondary mt-2">
                        <thead>
                        <tr>
                            <th>{{ __('messages.product_name') }}</th>
                            <th>{{ __('messages.product_price') }}</th>
                            <th>{{ __('messages.product_quantity') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4 mt-4 bg-secondary-subtle py-4">
                    <h4 class="mt-4 h4">{{ __('messages.payment') }}</h4>
                    <hr>
                    <div>{{ __('messages.total_price') }}</div>
                    <hr>
                    <div>{{ __('messages.shipment_price') }}</div>
                    <hr>
                    <div>{{ __('messages.the_amount_payable') }}</div>
                    <hr>
                    <div>
                        <form action="">
                            <button class="btn btn-primary w-100"
                                    type="submit">{{ __('messages.register_and_pay') }}</button>
                        </form>
                    </div>
                </div>
            @endif



        </div>

    </div>

@endsection
