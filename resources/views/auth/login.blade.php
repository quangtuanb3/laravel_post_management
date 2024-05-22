@extends('../layout/auth-master')
@section('title', __('page-titles.login'))
@section('content')
    <div style="width: 30%; margin:auto">
        <h1 class="pt-5 text-center">{{ __('page-titles.login') }}</h1>
        <form method="post">
            @csrf
            <!-- Email input -->
            <x-input-field field="email" label="{{ __('form.email') }}" type="email"
                value='user@example.com'></x-input-field>

            <!-- Password input -->
            <x-input-field field="password" label="{{ __('form.password') }}" type="password" value='password'></x-input-field>

            <!-- Submit button -->
            <x-button type="submit" text="{{ __('layout.navbar.login') }}" btn_class="primary"></x-button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>{{__('form.not-a-member')}} <a href="{{ route('auth.register.info') }}">{{ __('layout.navbar.register') }}</a></p>
            </div>
        </form>
    </div>
@endsection
