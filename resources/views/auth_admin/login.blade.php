@extends('auth_admin.auth_master')
@section('auth_admin_title')
    {{ __('messages.admin_login') }}
@endsection
@section('main_content')
    <div class="container vh-100">


        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 my-2 login-title">
                <p class="text-center h3 "> {{ __('messages.admin_login') }}</p>
                <h3 class="text-center my-5 admin-logo-login">{{ env('app_name') }}</h3>
            </div>
        </div>


        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 admin-login-form">
                <div class="bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form action="{{ route('admin.login') }}" method="post" class="form w-100" novalidate="novalidate">
                        @csrf
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">ورود به پنل مدیریت</h1>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark" for="email">ایمیل</label>
                            <input class="form-control form-control-lg form-control-solid"
                                   id="email"
                                   type="text"
                                   dir="ltr"
                                   style="direction: ltr"
                                   name="email"/>
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            @include('auth_admin.validate_error')
                        </div>
                        <div class="text-center">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">ادامه</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
