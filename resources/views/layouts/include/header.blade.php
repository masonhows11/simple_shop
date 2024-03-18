{{-- for inject  class into blade & use it --}}
@inject('basket','App\Services\Basket\Basket')
<nav class="navbar navbar-expand-lg bg-dark-subtle bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ __('messages.site_name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">{{ __('messages.home_page') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products') }}">{{ __('messages.products') }}</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            {{ __('messages.basket') }}  <span class="badge text-bg-primary">{{ $basket->itemCount() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">{{__('messages.profile')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">{{__('messages.profile')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">{{ \Illuminate\Support\Facades\Auth::user()->name  }}</a>
                    </li>

                   {{--  @role('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('messages.admin_dashboard') }}</a>
                    </li>
                    @endrole--}}

                    {{-- if u want use @can directive u can define a gate --}}
                    @can('show_panel')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('messages.admin_dashboard') }}</a>
                    </li>
                    @endcan



                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log.out') }}">{{ __('messages.log_out') }}</a>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login.form') }}">{{__('messages.login')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.register.form') }}">{{ __('messages.register_user') }}</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
