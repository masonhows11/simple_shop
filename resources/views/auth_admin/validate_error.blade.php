@if ( session('error'))
    <div class="alert alert-danger alert-dive">
        {{ session('error') }}
    </div>
@endif
@if ( session('success'))
    <div class="alert alert-success alert-div">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
<ul>
    @foreach ($errors->all() as $error)
     <ul class="small mt-4 mb-2 list-unstyled">
        <li class="text-danger ">{{ $error }}</li>
     </ul>
    @endforeach
</ul>
@endif
