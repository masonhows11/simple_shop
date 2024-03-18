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
@if(!isset($re_paid))
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

</div>
@else
    <div class="p-4 bg-light-subtle rounded-2 border border-dark">
        <h4 class="h4">{{ __('messages.payment') }}</h4>
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <hr>
            <div class="d-flex justify-content-between">
                <div> {{ __('messages.order_price')  }} </div>
                <div> {{ number_format($order->amount)  }} {{ __('messages.toman') }}</div>
            </div>
            <hr>
        <div class="d-flex justify-content-between">
            <div>{{ __('messages.the_amount_payable') }}</div>
            <div>{{ number_format( $order->payment->amount ) }} {{ __('messages.toman') }}</div>
        </div>
        <hr>

    </div>
@endif



