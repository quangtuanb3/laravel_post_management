@extends('../layout/auth-master')
@section('title', __('page-titles.register'))
@section('content')
    <div style="width: 80%; margin:auto">
        <h1 class="pt-5 text-center"> {{ __('page-titles.register') }}</h1>
        <div class="pt-3 pb-3 d-flex justify-content-center">
            <ul class="d-flex list-unstyled m-0 p-0">
                <li class="m-3 fs-5 "> {{ __('form.register') }}</li>
                <li class="m-3 fs-5">>></li>
                <li class="m-3 fs-5">{{ __('form.confirm') }}</li>
                <li class="m-3 fs-5 ">>></li>
                <li class="m-3 fs-5
                text-primary">{{ __('form.complete') }}</li>

            </ul>
        </div>
        <div class="container">
            <p class="text-center">
                {{ __('messages.verify-email') }}
            </p>
            <div class="d-flex justify-content-center">
                <x-button-link type="text" :href="route('home')" text="{{__('layout.navbar.home')}}" btn_class="primary m-3"></x-button-link>
            </div>


        </div>
    </div>


@endsection
