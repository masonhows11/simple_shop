@extends('auth_admin.auth_master')
@section('auth_admin_title')
    ثبت نام
@endsection
@section('main_content')
    <div class="container vh-100">


        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 my-2 register-title">
                <p class="text-center h3">  {{ __('messages.admin_register') }}</p>
            </div>
        </div>



        <div class="row d-flex justify-content-center ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 register-form">
                <div class="border border-1 rounded-2 border-dark">
                    <form action="{{ route('admin.register') }}" method="post" novalidate>
                        @csrf
                        <div class="mx-3 mt-3">
                            <label for="name" class="form-label">نام کاربری</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   placeholder="نام کاربری خود را وارد کنید..."
                                   name="name"
                                   value="{{ old('name') }}">
                        </div>
                        {{--@error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror--}}

                        <div class="mx-3 mt-3">
                            <label for="first_name" class="form-label">نام</label>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   id="first_name"
                                   placeholder="نام خود را وارد کنید..."
                                   name="first_name"
                                   value="{{ old('first_name') }}">
                        </div>
                        {{--  @error('first_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror--}}

                        <div class="mx-3 mt-3">
                            <label for="last_name" class="form-label">نام خانوادگی</label>
                            <input type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   id="last_name"
                                   placeholder="نام خانوادگی خود را وارد کنید..."
                                   name="last_name"
                                   value="{{ old('last_name') }}">
                        </div>
                        {{-- @error('last_name')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror--}}

                        <div class="mx-3 mt-3">
                            <label for="mobile" class="form-label">موبایل</label>
                            <input type="text"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   id="mobile"
                                   placeholder="شماره موبایل خود را وارد کنید..."
                                   name="mobile"
                                   value="{{ old('mobile') }}">
                        </div>
                        {{--  @error('mobile')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror--}}

                        <div class="mx-3 mt-3">
                            <label for="email" class="form-label">ایمیل خود را وارد کنید</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   style="direction:rtl;text-align:right"
                                   placeholder="ایمیل خود را وارد کنید..."
                                   name="email"
                                   value="{{ old('email') }}">
                        </div>
                        {{--   @error('email')
                           <div class="alert alert-danger">{{ $message }}</div>
                           @enderror--}}

                        <div class="mx-3 my-3">
                            <button type="submit" class="btn btn-success">ثبت نام</button>
                        </div>

                        <div class="my-2">
                            @include('auth_admin.validate_error')
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


@endsection
