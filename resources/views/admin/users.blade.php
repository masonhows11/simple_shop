@extends('admin.include.master_front')
@section('admin_title')
    {{ __('messages.users') }}
@endsection
@section('admin_main_content')
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>{{ __('messages.id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.roles') }}</th>
                <th>{{__('messages.operation')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $users as $user)
            <tr role="row" class="">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach( $user->roles as $role)
                        <span> {{ $role->name    }} </span>
                    @endforeach
                </td>
                <td>
                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                    <a href="" class="item-confirm mlg-15" title="تایید"></a>
                    <a href="" class="item-reject mlg-15" title="رد"></a>
                    <a href="#" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                    <a href="#" class="item-edit " title="ویرایش"></a>
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
@endsection
