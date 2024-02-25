@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.edit_model') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">

        <div class="row">
            <form action="{{ route('admin.roles.store') }}" method="post">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>

                <div class="mb-3 mt-3">
                    <label for="persian_name" class="form-label">{{ __('messages.name_persian') }}</label>
                    <input type="text" name="persian_name" class="form-control" id="persian_name">
                </div>

                <div class="mb-3 mt-3">
                    @include('admin.include.alert.validate_error')
                </div>



                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
            </form>

        </div>

        <div class="row mt-4">
            <table class="table table-striped">
                <thead >
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.name_persian') }}</th>
                    <th>{{__('messages.operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @forelse( $roles as $role)
                    <tr class="text-center">
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->persian_name }}</td>
                        <td>
                            <a href="{{ route('admin.roles.delete',$role->id) }}" class="btn btn-danger" title="حذف">{{ __('messages.delete_model') }}</a>
                            <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-primary" title="ویرایش">{{ __('messages.edit_model') }}</a>
                        </td>
                    </tr>
                @empty
                    <p>
                        {{__('messages.not_record_found')}}
                    </p>

                @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection


