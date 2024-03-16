{{--@inject('basket','App\Services\Basket\Basket')--}}
{{--<div class="p-4 bg-light-subtle rounded-2 border border-dark">
    <h4 class="h4">{{ __('messages.payment') }}</h4>
    <hr>
    <div class="d-flex justify-content-between">
        <div>{{ __('messages.total_price') }}</div>
        <div>{{ number_format($basket->subTotal() )  }} {{ __('messages.toman') }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div>{{ __('messages.shipment_price') }}</div>
        <div>{{ number_format(10000) }} {{ __('messages.toman') }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div>{{ __('messages.the_amount_payable') }}</div>
        <div>{{ number_format(10000 + $basket->subTotal()) }} {{ __('messages.toman') }}</div>
    </div>
    <hr>
</div>--}}
@inject('cost','App\Services\Price\Contracts\PriceInterface')
<div class="p-4 bg-light-subtle rounded-2 border border-dark">
    <h4 class="h4">{{ __('messages.payment') }}</h4>
    <hr>
    @foreach($cost->getSummary() as $description => $price)
        <div class="d-flex justify-content-between">
            <div> {{ $description }} </div>
            <div> {{ number_format($price)  }} {{ __('messages.toman') }}</div>
        </div>
        <hr>
    @endforeach
    <div class="d-flex justify-content-between">
        <div>{{ __('messages.the_amount_payable') }}</div>
        <div>{{ number_format( $cost->getTotalPrices() ) }} {{ __('messages.toman') }}</div>
    </div>
    <hr>

    @auth
        @if(session()->has('coupon'))
            <form action="#" method="get">
                @csrf
                <div class="mb-3 d-flex justify-content-between">
                    <div class="my-auto">{{ __('messages.coupon_code') }}</div>
                    <div>
                        <input type="text" class="form-control" name="code" placeholder="کد تخفیف را وارد کنید...">
                    </div>
                </div>
                <div class="mb-3">
                    <input type="submit"  class="btn btn-primary" value="{{ __('messages.apply_coupon') }}">
                </div>
            </form>
        @else
            <form class="row" action="{{ route('coupon.store') }}" method="post">
                @csrf
                <div class="col  my-auto">{{ __('messages.coupon_code') }}</div>
                <div class="col  my-auto">
                        <input type="text" class="form-control" name="code">
                </div>
                <div class="col  my-auto">
                    <input type="submit"  class="btn btn-primary" value="{{ __('messages.apply_coupon') }}">
                </div>
            </form>

        @endif

    @endauth

</div>



