@extends('layouts.include.master_auth')
@section('page_title')
    {{ __('messages.recover_password_form') }}
@endsection
@section('main_content')
    <div class="container login-section">



        <div class="row d-flex  justify-content-center mb-5 mt-2">

            <div class="col-xl-5 col-lg-5 col-md-5 px-4">
                <div class="row d-flex flex-column">

                    <div class="alert-section mt-2 text-center">
                        @include('layouts.alert.alert')
                    </div>

                    <h3 class="h3 text-center mt-4 ">
                        <a href="{{ route('home') }}" class="text-danger text-decoration-none">  {{ __('messages.site_name') }}</a>
                    </h3>

                    <div class="col mt-4  border border-2 login-form-title rounded-3 py-4">
                        <h3 class="text-center">{{ __('messages.recover_password_form') }}</h3>
                    </div>

                    <div class="col mt-4 border border-2  rounded-3 py-4 px-4 login-form">
                        <form action="{{ route('auth.send.recover.password.link') }}" method="post">
                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="email" class="@error('email') is-invalid @enderror form-control" id="email"
                                       name="email">
                            </div>

                            {{-- @error('email')
                             <div class="alert alert-danger">{{ $message }}</div>
                             @enderror--}}

                            {{--<div class="mb-3">
                                <label for="pwd" class="form-label">رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"
                                       id="pwd" name="password">
                            </div>--}}


                            <div class="mb-3">
                                @include('layouts.alert.validate_error')
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success rounded-3 w-100">{{ __('messages.send_recover_password_link') }}</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>
@endsection

