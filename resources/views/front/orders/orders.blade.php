@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.orders') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <div class="row  ">

            @if($orders->isEmpty())
                <div class="col mt-4 bg-light-subtle py-4 text-center rounded-2">
                    {{ __('messages.not_record_found') }}
                </div>
            @else
                <div class="col mt-4 bg-light-subtle py-2 rounded-2 border border-dark overflow-y-auto">
                    <table class="table table-light mt-2">
                        <thead>
                        <tr class="text-center">
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.order_code') }}</th>
                            <th>{{ __('messages.order_price') }}</th>
                            <th>{{ __('messages.order_status') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            <th>{{ __('messages.operation') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)

                            <tr class="text-center mt-4 py-2">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->getStatus() }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @if($order->status == 0 || $order->status == 2)
                                        <a href="{{ route('invoice.pay',$order) }}" class="btn btn-primary btn-sm">{{ __('messages.pay') }}</a>
                                    @endif
                                    <a href="{{ route('invoice',$order) }}" class="btn btn-primary btn-sm">{{ __('messages.download_invoice') }}</a>
                                    {{-- <form action="#" method="post" class="row d-flex justify-content-center">
                                         @csrf
                                         <div class="col-auto">
                                             <button type="submit" class="btn btn-primary btn-sm">{{ __('messages.update') }}</button>
                                         </div>
                                     </form>--}}

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
