@extends('admin.include.master_dash')
@section('dash_page_title')
    {{ __('messages.all_tickets') }}
@endsection
@section('dash_main_content')
    <div class="container bg-white">

        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.roles') }}</th>
                    <th>{{__('messages.operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $tickets as $ticket)
                    <tr class="text-center">
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->name }}</td>
                        <td>{{ $ticket->email }}</td>

                        <td>
                            <a href="" class="btn btn-primary" title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

