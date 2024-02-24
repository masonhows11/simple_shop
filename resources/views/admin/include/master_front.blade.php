<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('front/image/icon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('admin_title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.include.header_styles')
</head>
<body>
@include('admin.include.sidebar')


<div class="content">
    @include('admin.include.header')
    @include('admin.include.sub_header')
    <div class="main-content">
        @yield('admin_main_content')
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> موجودی حساب فعلی </p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> کل فروش دوره ها</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> کارمزد کسر شده </p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> درآمد خالص </p>
                <p>2,500,000 تومان</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد امروز </p>
                <p>500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> درآمد 30 روز گذاشته</p>
                <p>2,500,000 تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p> تسویه حساب در حال انجام </p>
                <p>0 تومان </p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
                <p>تراکنش های موفق امروز (0) تراکنش </p>
                <p>2,500,000 تومان</p>
            </div>
        </div>
        <div class="row no-gutters font-size-13 margin-bottom-10">
            <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
                محل قرار گیری نمودار
            </div>
            <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

                <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
                <p class="amount-show color-444">600,000<span> تومان </span></p>
                <p class="title icon-sync">در حال تسویه</p>
                <p class="amount-show color-444">0<span> تومان </span></p>
                <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13">
            <div class="title__row">
                <p>تراکنش های اخیر شما</p>
                <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه تراکنش ها</a>
            </div>
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه پرداخت</th>
                        <th>ایمیل پرداخت کننده</th>
                        <th>مبلغ (تومان)</th>
                        <th>درامد شما</th>
                        <th>درامد سایت</th>
                        <th>نام دوره</th>
                        <th>تاریخ و ساعت</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr role="row">
                        <td><a href=""> 1</a></td>
                        <td><a href="">mmd@gmail.com</a></td>
                        <td><a href="">600,000</a></td>
                        <td><a href="">400,000</a></td>
                        <td><a href="">400,000</a></td>
                        <td><a href="">دوره اچی تی ام ال</a></td>
                        <td><a href=""> 22:14:48 1399/02/23</a></td>
                        <td><a href="" class="text-success">پرداخت موفق</a></td>
                        <td class="i__oprations">
                            <a href="" class="item-delete margin-left-10" title="حذف"></a>
                            <a href="edit-transaction.html" class="item-edit" title='ویرایش'></a>
                        </td>
                    </tr>
                    <tr role="row">
                        <td><a href=""> 1</a></td>
                        <td><a href="">abol@gmail.com</a></td>
                        <td><a href="">600,000</a></td>
                        <td><a href="">400,000</a></td>
                        <td><a href="">400,000</a></td>
                        <td><a href="">دوره اچی تی ام ال</a></td>
                        <td><a href=""> 22:14:48 1399/02/23</a></td>
                        <td><a href="" class="text-error">پرداخت ناموفق</a></td>
                        <td class="i__oprations">
                            <a href="" class="item-delete margin-left-10" title="حذف"></a>
                            <a href="edit-transaction.html" class="item-edit" title='ویرایش'></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>

@include('admin.include.footer_scripts')
@stack('admin_custom_scripts')
</html>
