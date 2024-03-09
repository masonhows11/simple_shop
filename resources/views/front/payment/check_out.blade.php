@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.payment_check_out') }}
@endsection
@section('main_content')
    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <form action="{{ route('cart.pay') }}" method="post">
            @csrf
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
                        <div class="card">
                            <div class="card-header py-4">
                                {{ __('messages.payment_type') }}
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">

                                    <li class="list-group-item my-2 ">
                                        <div class="mt-2 form-check form-check-inline">
                                            <input class="form-check-input" value="online" type="radio" id="online" name="method">
                                            <label class="form-check-label pt-1" for="online">
                                                {{ __('messages.online_pay') }}
                                            </label>
                                            <p class="fs-6 fw-light mt-3">
                                                پرداخت آنلاین سفارش از طریق درگاهای موجود
                                            </p>
                                        </div>
                                        <div>
                                            <label for="gateway"></label>
                                            <select class="form-select" name="gateway" id="gateway">
                                                <option value="">{{__('messages.choose')}}</option>
                                                <option value="idPay">ای دی پی</option>
                                                <option value="zarinpal">زرین پال</option>
                                            </select>
                                        </div>
                                    </li>

                                    <li class="list-group-item my-2">
                                        <div class="mt-2 form-check form-check-inline">
                                            <input class="form-check-input" value="cash" type="radio" id="cash"
                                                   name="method">
                                            <label class="form-check-label pt-1" for="cash">
                                                {{ __('messages.cash_pay') }}
                                            </label>
                                            <p class="fs-6 fw-light mt-3">
                                                پرداخت درب منزل
                                            </p>
                                        </div>
                                    </li>

                                    <li class="list-group-item my-2">
                                        <div class="mt-2 form-check form-check-inline">
                                            <input class="form-check-input" value="cart-to-cart" type="radio"
                                                   id="cart-to-cart" name="method">
                                            <label class="form-check-label pt-1" for="cart-to-cart">
                                                {{ __('messages.cart_to_cart') }}
                                            </label>
                                            <p class="fs-6 fw-light mt-3">
                                                انتقال مبلغ سفارش به شماره کارت 5982-1015-0091-8541 و ارسال فیش انتقال
                                            </p>
                                        </div>
                                    </li>

                                    <li class="list-group-item my-2">
                                        @include('layouts.alert.validate_error')
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    @include('front.payment.summery')
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100 py-3">{{ __('messages.pay') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
