@if( session()->has('error') )
        <div class="alert alert-danger text-center" role="alert">
            <strong>  {{  session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@elseif( session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{  session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif( session()->has('warning'))
    <div class="alert alert-warning text-center" role="alert">
        <strong>{{  session('warning') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
