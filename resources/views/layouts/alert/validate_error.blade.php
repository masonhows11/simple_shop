@if($errors->any())

<ul>
    @foreach ($errors->all() as $error)
     <ul class="small mt-4 mb-2 list-unstyled">
        <li class="text-danger ">{{ $error }}</li>
     </ul>
    @endforeach
</ul>

@endif
