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
                @forelse( $users as $user)
                    <tr class="text-center">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->persian_name }}</td>
                        <td>
                            {{--  <a href="" class="" title="حذف"></a>
                              <a href="" class="" title="تایید"></a>
                              <a href="" class="" title="رد"></a>
                              <a href="#" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>--}}
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

