@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.tickets') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <div class="row  ">


        </div>
    </div>

@endsection

