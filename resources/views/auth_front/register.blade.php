@extends('layouts.include.master_auth')
@section('page_title')
    {{ __('messages.register_user') }}
@endsection
@section('main_content')
    <div class="container register-section">

        <div class="alert-section mt-2">
            @include('layouts.alert.alert')
        </div>

        <div class="row d-flex justify-content-center mb-5 mt-2">


            <div class="col-xl-5 col-lg-6 col-md-6 px-4">
                <div class="row d-flex flex-column">

                    <div class="alert-section mt-2">
                        @include('layouts.alert.alert')
                    </div>

                    <h3 class="h3 text-center mt-4 ">
                        <a href="{{ route('home') }}" class="text-danger text-decoration-none">  {{ __('messages.site_name') }}</a>
                    </h3>

                    <div class="col mt-4  border border-2 register-form-title rounded-3 py-4">
                        <h3 class="text-center">ثبت نام</h3>
                    </div>

                    <div class="col mt-4 border border-2  rounded-3 py-4 px-4 register-form">
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label">نام کاربری</label>
                                <input type="text" class="@error('name') is-invalid @enderror form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>

                            {{--  @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror  --}}

                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">ایمیل</label>
                                <input type="email" class="@error('email') is-invalid @enderror form-control" id="email"  name="email" value="{{ old('email') }}">
                            </div>

                            {{--  @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror  --}}



                            <div class="mb-3 mt-3">
                                <label for="mobile" class="form-label">موبایل</label>
                                <input type="text" class="@error('mobile') is-invalid @enderror form-control" id="mobile"  name="mobile" value="{{ old('mobile') }}">
                            </div>

                            {{--  @error('mobile')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror  --}}

                            <div class="mb-3 mt-3">
                                <label for="pwd" class="form-label">رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"  id="pwd"  name="password">
                            </div>

                             {{--  @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                             @enderror  --}}

                            <div class="mb-3 mt-3">
                                <label for="pwd-confirm" class="form-label">تکرار رمز عبور</label>
                                <input type="password" class="@error('password') is-invalid @enderror form-control"
                                       id="pwd-confirm"
                                       name="password_confirmation">
                            </div>

                            <div class="mb-3 mt-3">
                                @include('layouts.alert.validate_error')
                            </div>





                            <div class="mb-3">
                                <button type="submit" class="btn btn-success w-100 rounded-3">عضویت</button>
                            </div>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
