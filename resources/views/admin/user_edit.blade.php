@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_user') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">
        <div class="row">
                <form class="my-4">

                    <div class="my-4">
                        <label for="role" class="form-label">{{ __('messages.roles_assignment') }}</label>
                        <hr/>

                        @foreach($roles as $role)
                            <input class="form-check-input" type="checkbox" value="{{ $role->id }}" id="role">
                            <label class="form-check-label me-2" for="role">
                                {{ $role->persian_name }}
                            </label>
                        @endforeach
                    </div>

                    <div class="my-4">
                        <label for="perm" class="form-label">{{ __('messages.perms_assignment') }}</label>
                        <hr/>

                        @foreach($perms as $perm)
                            <input class="form-check-input" type="checkbox" value="{{ $perm->id }}" id="perm">
                            <label class="form-check-label me-2" for="perm">
                                {{ $perm->persian_name }}
                            </label>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                </form>

        </div>
    </div>
@endsection
