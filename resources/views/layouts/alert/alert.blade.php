@if( session()->has('error') )
        <div class="alert alert-danger text-center">
            <strong>  {{  session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@elseif( session()->has('success'))
    <div class="alert alert-success text-center">
        <strong>{{  session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

