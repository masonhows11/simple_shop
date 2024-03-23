@extends('layouts.include.master_front')
@section('page_title')
    {{ __('messages.profile') }}
@endsection
@section('main_content')
    <div class="container">

        <div class="row mt-5">

            <div class="col">

                <form class="row">

                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('default_image/no-image-icon-23494.png') }}" class="card-img-top"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title">عنوان</h5>
                                <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                                <a href="#" class="btn btn-primary mt-3">{{  __('messages.avatar_file') }}</a>
                            </div>
                        </div>
                    </div>


                    <div class="col  d-flex flex-column ">

                        <div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">{{ __('messages.upload_file') }}</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">{{  __('messages.upload_file') }}</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
