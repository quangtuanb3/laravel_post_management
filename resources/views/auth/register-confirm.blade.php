@extends('../layout/auth-master')
@section('title', __('page-titles.register'))
@section('content')
    <div style="width: 80%; margin:auto">
        <h1 class="pt-5 text-center">{{ __('page-titles.register') }}</h1>
        <div class="pt-3 pb-3 d-flex justify-content-center">
            <ul class="d-flex list-unstyled m-0 p-0">
                <li class="m-3 fs-5 "> {{ __('form.register') }}</li>
                <li class="m-3 fs-5">>></li>
                <li class="m-3 fs-5 text-primary">{{ __('form.confirm') }}</li>
                <li class="m-3 fs-5  text-primary">>></li>
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
                        $registerData ? Session::flash('register', $registerData) : '';
                        $positions = Session::get('positions') ?? null;
                    @endphp

                    <x-input-field :disabled="true" :value="$registerData ? $registerData['username'] : ''" field="username" label="{{ __('form.username') }}"
                        col='6' type="username"></x-input-field>
                    <x-input-field :disabled="true" :value="$registerData ? $registerData['email'] : ''" field="email" label="{{ __('form.email') }}"
                        col='6' type="email"></x-input-field>
                    <x-input-field :disabled="true" :value="$registerData ? $registerData['password'] : ''" field="password" label="{{ __('form.password') }}"
                        col='6' type="text"></x-input-field>

                    <x-input-field :disabled="true" :value="$registerData ? $registerData['phone'] : ''" field="phone" label="{{ __('form.phone') }}"
                        col='6' type="phone"></x-input-field>


                    <x-select-option :disabled="true" class='col-6' id="position_id" name="position_id"
                        label="{{ __('form.position') }}" :options="$positions"
                        selected="{{ $registerData ? $registerData['position_id'] : '' }}" />

                    <x-input-field :disabled="true" label="{{ __('form.address') }}" :value="$registerData ? $registerData['address'] : ''" field="address"
                        col='6'></x-input-field>


                    <x-radio-button :disabled="true" class='col-12 ' subclass='d-flex' name="gender"
                        label="{{ __('form.gender') }}" :options="[
                            'male' => __('form.male'),
                            'female' => __('form.female'),
                            'other' => __('form.other'),
                        ]"
                        selected="{{ $registerData ? $registerData['gender'] : '' }}" />

                    <div class="d-flex justify-content-center">
                        <x-button-link type="text" :href="route('auth.register.info')" text="{{ __('form.back') }}"
                            btn_class="secondary m-3"></x-button-link>

                        <x-button type="submit" text="{{ __('form.confirm') }}" btn_class="success m-3 "></x-button>
                    </div>


                </div>
            </form>


        </div>
    </div>


@endsection
