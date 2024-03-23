@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.profile') }}
@endsection
@section('main_content')
    <div class="container">

        <div class="row justify-content-center" style="height:80px">
            <div class="col-lg-4 col-md-4 col-sm-4 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <form action="{{  route('profile.avatar.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center  mt-5">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="row d-flex flex-column">

                        <div class="col mt-3  d-flex flex-column ">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">{{ __('messages.upload_file') }}</label>
                                    <input class="form-control" name="file" type="file" id="formFile">
                                </div>
                                <div class="mb-3">
                                    @include('layouts.alert.validate_error')
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="is_private" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label"  for="exampleCheck1">{{ __('messages.upload_file_is_private') }}</label>
                                  </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">{{  __('messages.avatar_file') }}</button>
                                </div>
                        </div>

                        <div class="col">
                            <div class="card" style="">
                                <img src="{{ asset('default_image/no-image-icon-23494.png') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
           </div>
        </form>


    </div>
@endsection
