@if(session('user_unverified'))
    <div class="row">
        <div class="alert alert-danger text-center" role="alert">
            {{ __('messages.user_unverified') }}
        </div>
    </div>
@endif
