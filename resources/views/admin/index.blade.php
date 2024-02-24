@extends('admin.include.master_dash')
@section('dash_page_title')
{{ __('messages.admin_panel') }}
@endsection
@section('dash_main_content')
    <div class="container-fluid">
        <h1 class="h1">{{ __('messages.admin_panel') }}</h1>
    </div>
@endsection
