@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.users') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">

        <div class="row">
            <table class="table table-striped">
                <thead >
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.roles') }}</th>
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
                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-danger" title="حذف">{{ __('messages.delete_model') }}</a>
                            <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-primary" title="ویرایش">{{ __('messages.edit_model') }}</a>
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

