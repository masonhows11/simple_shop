@inject('basket','App\Services\Basket\Basket')
<div class="p-4 bg-light-subtle rounded-2 border border-dark">
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
</div>

