@extends('admin.include.master_front')
@section('admin_title')
    {{ __('messages.edit_user') }}
@endsection
@section('admin_main_content')
    <div class="row no-gutters bg-white margin-bottom-20">
        <div class="col-12">
            <p class="box__title">{{ __('messages.edit_user') }}</p>

            {{--<form action="" class="padding-30" method="post">
                <input type="text" class="text" placeholder="نام و نام خانوادگی">
                <input type="text" class="text" placeholder="ایمیل">
                <input type="text" class="text" placeholder="شماره موبایل">
                <input type="text" class="text" placeholder="آی پی">
                <select name="" id="">
                    <option value="0">سطح کاربری</option>
                    <option value="1">کاربر عادی</option>
                    <option value="2">مدرس</option>
                    <option value="3">نویسنده</option>
                    <option value="4">مدیر</option>
                </select>
                <button class="btn btn-brand">ایجاد کاربر</button>
            </form>--}}

        </div>
    </div>
@endsection
