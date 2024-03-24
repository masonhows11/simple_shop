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
                                <label class="form-check-label"
                                       for="exampleCheck1">{{ __('messages.upload_file_is_private') }}</label>
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

        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('messages.name')}}</th>
                    <th scope="col">{{__('messages.file_type')}}</th>
                    <th scope="col">{{ __('messages.file_size') }}</th>
                    <th scope="col">{{ __('messages.file_duration') }}</th>
                    <th scope="col">{{ __('messages.file_access') }}</th>
                    <th scope="col">{{ __('messages.operation') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->type }}</td>
                        <td>{{ number_format($file->size / (1024 * 1024),2) }} {{ __('messages.MB') }}</td>
                        <td>{{ $file->time }} {{ __('messages.seconds') }}</td>
                        <td>{{ $file->is_private == 0 ? __('messages.is_public') : __('messages.is_private') }}</td>
                        <td>
                            <a href="{{ route('file.delete',$file->id) }}"
                               class="btn btn-primary">{{ __('messages.delete_model') }}</a>
                            <a href="{{ route('file.download',$file->id) }}"
                               class="btn btn-primary">{{ __('messages.download') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


    </div>
@endsection
