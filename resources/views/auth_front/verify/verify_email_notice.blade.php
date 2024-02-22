@extends('layouts.include.master_auth')
@section('page_title')
    {{ __('messages.register_user') }}
@endsection
@section('main_content')
    <div class="container register-section">


        <div class="flex justify-content-center align-items-center">
            <div class="my-4">
                <p class="text-center">{{ __('messages.verification_email_has_sent') }}</p>
                <a class="text-center" href="{{ route('verification.send') }}">{{ __('messages.resend_verification_email') }}</a>
            </div>
        </div>


    </div>
@endsection
