<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ __('messages.site_name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">{{ __('messages.home_page') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{__('messages.login')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('messages.register_user') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
