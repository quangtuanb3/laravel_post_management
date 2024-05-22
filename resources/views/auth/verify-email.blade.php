@extends('../layout/auth-master')
@section('title', 'Login')
@section('content')
    <div style="width:50%; margin:auto">
        <h5 class="pt-5 text-center">{{__('messages.alert-verify-email')}}</h5>
    </div>


    <div style="display:flex; justify-content: center; padding-top: 40px">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-button type="submit" text="{{ __('messages.resend-email') }}" btn_class="primary"></x-button>
            </div>
            <a href="{{ route('home') }}" style="width: 150px; margin:auto"
                class="btn btn-info d-flex justify-content-center">
                {{ __('layout.navbar.home') }}</a>
        </form>



    </div>

@endsection
