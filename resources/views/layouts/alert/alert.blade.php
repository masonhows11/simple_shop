@if( session()->has('error') )
        <div class="alert alert-danger text-center">
            {{  session('error') }}
        </div>
@elseif( session()->has('success'))
    <div class="alert alert-success text-center">
        {{  session('success') }}
    </div>
@endif

