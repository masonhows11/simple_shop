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
                        <div class="card-header">
                            Featured
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                        </ul>
                    </div>
                </div>


                <div class="mt-5">
                    <div class="card" >
                        <div class="card-header">
                            Featured
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">An item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item">A third item</li>
                        </ul>
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
