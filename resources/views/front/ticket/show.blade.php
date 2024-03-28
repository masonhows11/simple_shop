@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.show_ticket') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-2">
                @include('layouts.alert.alert')
            </div>
        </div>

        <div class="row d-flex flex-column border my-4 bg-white">

            <div class="col my-2">
                <a href="{{ route('ticket.index') }}" class="btn btn-sm btn-primary">{{ __('messages.all_tickets') }}</a>
            </div>
            <div class="col   my-2">
                <div class="alert alert-light shadow-sm my-4">
                    <h3>{{ __('messages.ticket') }} : {{ $ticket->title }}  </h3>
                </div>
            </div>


            <div class="col  mt-2 mb-2 ">

                <div class="card">
                    <div class="card-header">
                        <p class="my-auto"> {{ __('messages.user') }}: {{ $ticket->user->first_name ?? '-'  }} {{ $ticket->user->last_name ?? '-' }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title my-2">{{ __('messages.title_ticket') }} : {{ $ticket->title }}</h5>
                        <p class="card-text my-2">{{ __('messages.message_ticket') }} : {{ $ticket->message }}</p>
                    </div>
                    <div class="card-footer">
                        @if($ticket->hasFile())
                            <div>
                                <a href="{{ $ticket->get_file_path() }}" class="btn btn-sm btn-primary">{{ __('messages.download') }}</a>

                            </div>
                        @endif
                        <div class="mt-2">
                            {{ __('messages.created_at') }} : {{ convertEngToPersian(jdate($ticket->created_at)->ago())  }}
                        </div>

                    </div>
                </div>
            </div>

            <div class="col  mt-4 mb-4">
                <div class="row d-flex flex-column   mx-2 my-2">
                    @foreach( $ticket->replies as $reply )
                        <div class="col my-4">
                            <div class="card me-4">
                                <div class="card-header bg-light">
                                    <div>
                                        <p class="card-title">{{ $reply->repliable->name }}</p>
                                        <p class=""> تاریح : {{ convertEngToPersian(jdate($reply->created_at)->ago())  }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text my-2">{{ __('messages.description') }} : {{ $reply->message }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="row  my-4 bg-white">
            <div>
                <form action="{{ route('ticket.reply',$ticket->id) }}" method="post">
                    @csrf

                    <div class="row product-stock-list mt-5 py-5 bg-white">

                        <div class="col">
                            <div class="mt-3">
                                <label for=message" class="form-label">{{ __('messages.message_ticket') }}</label>
                                <textarea class="form-control" rows="6" id="message" name="message"></textarea>
                            </div>
                            @error('description')
                            <div class="alert alert-danger mt-3">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-12 discount-common-save">
                            <div class="mt-3">
                                <input type="submit" class="btn btn-success" value="{{ __('messages.save') }}">
                            </div>
                        </div>

                    </div>

                </form>
            </div>

        </div>

    </div>

@endsection


