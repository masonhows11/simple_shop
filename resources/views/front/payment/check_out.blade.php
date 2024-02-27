@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.payment_check_out') }}
@endsection
@section('main_content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <div class="row">

            <div class="col-lg-7 d-flex flex-column">

                <div>
                    <div class="card">
                        <div class="card-header py-4">
                           {{ __('messages.user_info') }}
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($info as $item)
                            <li class="list-group-item my-2"> {{ __('messages.recipient') . ' : ' . $item->recipient_first_name . '  ' . $item->recipient_last_name }}</li>
                            <li class="list-group-item my-2">{{ __('messages.address') . ' : ' . $item->address_description }}</li>
                            <li class="list-group-item my-2">{{ __('messages.mobile') . ' :  ' . $item->mobile }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="mt-5">
                    <div class="card" >
                        <div class="card-header py-4">
                            {{ __('messages.payment_type') }}
                        </div>
                        <form action="">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item my-2">{{ __('messages.online_pay') }}</li>
                                <li class="list-group-item my-2">{{ __('messages.cash_pay') }}</li>
                                <li class="list-group-item my-2">{{ __('messages.add_to_cart') }}</li>
                            </ul>
                        </form>

                    </div>

                </div>

            </div>

            <div class="col-lg-5">
                @include('front.payment.summery')
                <div class="mt-4">
                    <a href="{{ route('cart.check-out.form') }}" class="btn btn-primary w-100 py-3" >{{ __('messages.register_and_pay') }}</a>
                </div>
            </div>



        </div>

    </div>
@endsection
