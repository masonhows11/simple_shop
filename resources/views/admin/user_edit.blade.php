@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_user') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">
        <div class="row">
                <form action="{{ route('admin.user.update') }}" method="post" class="my-4">
                    @csrf

                    <input type="hidden" name="user" value="{{ $user->id }}">

                    <div class="my-4">
                        <label for="role" class="form-label">{{ __('messages.roles_assignment') }}</label>
                        <hr/>

                        @forelse($roles as $role)
                            <input class="form-check-input" {{ $user->roles->contains($role) ? 'checked' : '' }} name="roles[]" type="checkbox" value="{{ $role->name }}" id="{{'role'.$role->id }}">
                            <label class="form-check-label me-2" for="{{'role'.$role->id }}">
                                {{ $role->persian_name }}
                            </label>
                        @empty
                            <label for="role" class="form-label">{{ __('messages.not_record_found') }}</label>
                        @endforelse
                    </div>

                    <div class="my-4">
                        <label for="perm" class="form-label">{{ __('messages.perms_assignment') }}</label>
                        <hr/>

                        @forelse($perms as $perm)
                            <input class="form-check-input" {{ $user->permissions->contains($perm) ? 'checked' : '' }} name="perms[]" type="checkbox" value="{{ $perm->name }}" id="{{'perm'.$perm->id }}">
                            <label class="form-check-label me-2" for="{{'perm'.$perm->id }}">
                                {{ $perm->persian_name }}
                            </label>
                        @empty
                            <label for="role" class="form-label">{{ __('messages.not_record_found') }}</label>
                        @endforelse
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.return') }}</a>
                </form>

        </div>
    </div>
@endsection
