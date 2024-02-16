<nav class="d-none d-lg-block navigation"><!-- start main menu -->
    <div class="container">
        <ul class="main-menu">
            <li class="has-mega-menu">
                <a href="#"> {{ __('messages.category_products') }} <i class="fa fa-angle-down"></i></a>
                <!-- start mega menu-->
                <ul class="row mega-menu">
                    @foreach( $categories as $child )
                        <li class="col-3 mega-menu-box">
                            <ul>
                                <li class="menu-title">
                                    <a href="{{ route('search.category',['slug' => $child->title]) }}"><i
                                            class="fa fa-angle-left me-2"></i>{{ $child->title}}</a>
                                </li>
                                @if( $child->children != null  )
                                    @include('front.layouts.partials.child_category',['category' => $child->children])
                                @endif
                            </ul>
                        </li>
                    @endforeach
                </ul>
                <!-- end mega menu-->
            </li>
            <li><a href="{{ route('not.found') }}">تخفیف‌ها و پیشنهادها</a></li>
            @guest
                <li><a href="{{ route('auth.login.form') }}">ثبت نام / ورود</a></li>
            @endguest
            @auth
                <li><a href="{{ route('cart.check') }}">سبد خرید</a></li>
            @endauth
            <li><a href="{{ route('not.found') }}">وبلاگ</a></li>
            <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
            <li><a href="{{ route('about_us') }}">درباره ما</a></li>
        </ul>
    </div>
</nav>
