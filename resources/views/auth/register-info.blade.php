@extends('../layout/auth-master')
@section('title', __('page-titles.register'))
@section('content')
    <div style="width: 80%; margin:auto">
        <h1 class="pt-5 text-center">{{ __('page-titles.register') }}</h1>
        <div class="pt-3 pb-3 d-flex justify-content-center">
            <ul class="d-flex list-unstyled m-0 p-0">
                <li class="m-3 fs-5 text-primary"> {{ __('form.register') }}</li>
                <li class="m-3 fs-5 text-primary">>></li>
                <li class="m-3 fs-5">{{ __('form.confirm') }}</li>
                <li class="m-3 fs-5">>></li>
                <li class="m-3 fs-5">{{ __('form.complete') }}</li>
            </ul>
        </div>
        <div class="container">
            <form method="POST">
                @csrf
                <div class="row justify-content-center">
                    @php
                        $registerData = Session::get('register') ?? null;
                        $gender = $registerData ? $registerData['gender'] : '';
                        $position_id = $registerData ? $registerData['position_id'] : '';
                        $positions = Session::get('positions') ?? null;

                    @endphp
                    <x-input-field :value="$registerData ? $registerData['username'] : ''" field="username" label="{{ __('form.username') }}" col='6'
                        type="username"></x-input-field>
                    <x-input-field :value="$registerData ? $registerData['email'] : ''" field="email" col='6' label="{{ __('form.email') }}"
                        type="email"></x-input-field>
                    <x-input-field :value="$registerData ? $registerData['password'] : ''" field="password" label="{{ __('form.password') }}" col='6'
                        type="password"></x-input-field>
                    <x-input-field :value="$registerData ? $registerData['password'] : ''" field="password_confirmation"
                        label="{{ __('form.password_confirmation') }}" col='6' type="password"></x-input-field>
                    <x-input-field :value="$registerData ? $registerData['phone'] : ''" field="phone" label="{{ __('form.phone') }}" col='6'
                        type="phone"></x-input-field>


                    <x-select-option class='col-6' id="position_id" name="position_id" label="{{ __('form.position') }}"
                        :options="$positions" :selected="$position_id"></x-select-option>

                    <x-input-field :value="$registerData ? $registerData['address'] : ''" field="address" label="{{ __('form.address') }}"
                        col='12'></x-input-field>

                    <x-radio-button class='col-12 ' subclass='d-flex' name="gender" label="{{ __('form.gender') }}"
                        :options="[
                            'male' => __('form.male'),
                            'female' => __('form.female'),
                            'other' => __('form.other'),
                        ]" :selected="$gender"></x-radio-button>

                    <div class="d-flex justify-content-center">
                        <x-button type="reset" text="{{ __('form.clear') }}" btn_class="secondary m-3"></x-button>
                        <x-button type="submit" text="{{ __('form.next') }}" btn_class="primary m-3"></x-button>
                    </div>

                </div>
            </form>

            <a href="{{ route('auth.showLogin') }}" class="pb-5 text-center">{{ __('form.a-member') }}</a>
        </div>
    </div>

@endsection
