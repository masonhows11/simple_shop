@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.tickets') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2">
                <a href="{{ route('ticket.create') }}" class="btn btn-primary">{{ __('messages.new_ticket') }}</a>

            </div>
        </div>

        <div class="row mt-4">
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>{{ __('messages.title_ticket') }}</th>
                    <th>{{ __('messages.message_ticket') }}</th>
                    <th>{{ __('messages.priority_ticket') }}</th>
                    <th>{{ __('messages.department_ticket') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.ticket_attachment') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr class="text-center">
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->department }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->file_path }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

