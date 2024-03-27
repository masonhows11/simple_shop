@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.new_ticket') }}
@endsection
@section('main_content')

    <div class="container">

        <div class="row justify-content-center" style="height: 125px">
            <div class="col-md-6 mt-5">
                @include('layouts.alert.alert')
            </div>
        </div>

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-md-8 col-lg-6 col-xl-5 py-2 rounded shadow-lg p-10 ticket-form">
                <div class="bg-white  mx-auto">

                    <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mx-3 mt-4">
                            <label for="title" class="form-label  text-dark">{{ __('messages.title_ticket') }}</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title') }}">
                        </div>


                        <div class="mx-3 mt-3">
                            <label for="priority" class="form-label  text-dark">{{ __('messages.priority_ticket') }}</label>
                            <select class="form-select  @error('priority') is-invalid @enderror" name="priority" id="priority" aria-label="Default select example">
                                <option selected>{{ __('messages.choose') }}</option>
                                <option value="0">کم</option>
                                <option value="1">متوسط</option>
                                <option value="2">زیاد</option>
                            </select>
                        </div>

                        <div class="mx-3 mt-3">
                            <label for="department" class="form-label  text-dark">{{ __('messages.department_ticket') }}</label>
                            <select class="form-select  @error('department') is-invalid @enderror" name="department" id="department" aria-label="Default select example">
                                <option selected>{{ __('messages.choose') }}</option>
                                <option value="0">فنی</option>
                                <option value="1">پشتیبانی</option>
                                <option value="2">مالی</option>
                            </select>
                        </div>

                        <div class="mx-3 mt-3">
                            <label for="message" class="form-label">{{ __('messages.message_ticket') }}</label>
                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                        </div>

                        <div class="mx-3 mt-3">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">{{ __('messages.upload_file') }}</button>
                            </div>
                        </div>


                        <div class="mx-3 my-3">
                            <button type="submit" class="btn btn-success w-100">{{ __('messages.save') }}</button>
                        </div>

                        <div class="my-2">
                            @include('auth_admin.validate_error')
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

@endsection

