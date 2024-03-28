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
                    <th>#</th>
                    <th>{{ __('messages.title_ticket') }}</th>
                    <th>{{ __('messages.message_ticket') }}</th>
                    <th>{{ __('messages.ticket_from') }}</th>
                    <th>{{ __('messages.priority_ticket') }}</th>
                    <th>{{ __('messages.department_ticket') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.created_at') }}</th>
                    <th>{{__('messages.operation')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $tickets as $ticket)
                    <tr class="text-center">
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->department }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ customJalaliDate($ticket->created_at) }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">{{ __('messages.download') }}</a>
                            <a href="" class="btn btn-primary" title="">{{ __('messages.response_ticket') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
