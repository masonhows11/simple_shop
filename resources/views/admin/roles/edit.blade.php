@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_model') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">

        <div class="row p-4">

            <form action="{{ route('admin.roles.update',$role->id) }}" method="post">
                @csrf



                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="form-control" id="name">
                </div>

                <div class="mb-3 mt-3">
                    <label for="persian_name" class="form-label">{{ __('messages.name_persian') }}</label>
                    <input type="text" name="persian_name" value="{{ $role->persian_name }}" class="form-control" id="persian_name">
                </div>

                <div class="mb-3 mt-3">
                    @include('admin.include.alert.validate_error')
                </div>



                <div class="my-4">
                    <label for="perm" class="form-label">{{ __('messages.perms_assignment') }}</label>
                    <hr/>
                    @forelse($perms as $perm)
                        <input class="form-check-input" {{ $role->permissions->contains($perm) ? 'checked' : '' }} name="perms[]" type="checkbox" value="{{ $perm->name }}" id="{{'perm'.$perm->id }}">
                        <label class="form-check-label me-2" for="{{'perm'.$perm->id }}">
                            {{ $perm->persian_name }}
                        </label>
                    @empty
                        <label for="role" class="form-label">{{ __('messages.not_record_found') }}</label>
                    @endforelse
                </div>



                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">{{ __('messages.return') }}</a>
            </form>

        </div>



    </div>
@endsection


