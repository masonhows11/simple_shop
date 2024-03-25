@extends('auth_admin.auth_master')
@section('auth_admin_title')
    ثبت نام
@endsection
@section('main_content')
    <div class="container vh-100">


        <div class="row d-flex mt-5 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 my-2 register-title">
                <p class="text-center h3">  {{ __('messages.admin_register') }}</p>
                <h3 class="text-center my-5 admin-logo-login">{{ env('app_name') }}</h3>
            </div>
        </div>


        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 register-form">
                <div class="bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">

                    <form action="{{ route('admin.register') }}" method="post" novalidate>
                        @csrf
                        <div class="mx-3 mt-3">
                            <label for="name" class="form-label fs-6 fw-bolder text-dark">نام کاربری</label>
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
                        {{--   <div class="mx-3 mt-3">
                               <label for="first_name" class="form-label">نام</label>
                               <input type="text"
                                      class="form-control @error('first_name') is-invalid @enderror"
                                      id="first_name"
                                      placeholder="نام خود را وارد کنید..."
                                      name="first_name"
                                      value="{{ old('first_name') }}">
                           </div>--}}
                        {{--  @error('first_name')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror--}}
                        {{-- <div class="mx-3 mt-3">
                             <label for="last_name" class="form-label">نام خانوادگی</label>
                             <input type="text"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name"
                                    placeholder="نام خانوادگی خود را وارد کنید..."
                                    name="last_name"
                                    value="{{ old('last_name') }}">
                         </div>--}}
                        {{-- @error('last_name')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror--}}
                        {{-- <div class="mx-3 mt-3">
                             <label for="mobile" class="form-label">موبایل</label>
                             <input type="text"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    id="mobile"
                                    placeholder="شماره موبایل خود را وارد کنید..."
                                    name="mobile"
                                    value="{{ old('mobile') }}">
                         </div>--}}
                        {{--  @error('mobile')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror--}}
                        <div class="mx-3 mt-3">
                            <label for="email" class="form-label fs-6 fw-bolder text-dark">ایمیل</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   style="direction:rtl;text-align:right"
                                   placeholder="ایمیل خود را وارد کنید..."
                                   name="email"
                                   value="{{ old('email') }}">
                        </div>

                        <div class="mx-3 mt-3">
                            <label for="password" class="form-label fs-6 fw-bolder text-dark">رمز عبور</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   placeholder="رمز عبور خود را وارد کنید..."
                                   name="password">
                        </div>

                        <div class="mx-3 mt-3">
                            <label for="password_confirmation" class="form-label fs-6 fw-bolder text-dark">تکرار رمز عبور</label>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation"
                                   placeholder="تکرار رمز عبور خود را وارد کنید..."
                                   name="password_confirmation">
                        </div>
                        <div class="mx-3 mt-3">
                            <label for="department" class="form-label fs-6 fw-bolder text-dark">بخش</label>
                            <select class="form-select @error('department') is-invalid @enderror" id="department" aria-label="Default select example">
                                <option selected>{{ __('messages.choose') }}</option>
                                <option value="0">فنی</option>
                                <option value="1">پشتیبانی</option>
                                <option value="2">مالی</option>
                            </select>
                        </div>

                        <div class="mx-3 my-3">
                            <button type="submit" class="btn btn-success w-100">ثبت نام</button>
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
