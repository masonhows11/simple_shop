@if(session('user_unverified'))
    <div class="row">
        <div class="alert alert-danger text-center d-flex flex-column" role="alert">
            <p> {{ __('messages.user_unverified') }}</p>
            <a class="text-center my-3" href="{{ route('verification.send') }}">{{ __('messages.resend_verification_email') }}</a>
        </div>
    </div>
@endif
