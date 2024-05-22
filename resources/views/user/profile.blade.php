@extends('../layout/user-master')
@section('title', __('page-titles.profile'))
@section('username', auth()->user()->username)

@section('content')
    @php
        $user->avatar ? $user->avatar : ($user->avatar = ' http://127.0.0.1:8000/images/defaultAvatar.png');
        if (!stristr($user->avatar, 'http')) {
            $user->avatar = 'http://127.0.0.1:8000/' . $user->avatar;
        }
        // dd($user->avatar ? ($user->avatar = '../' . $user->avatar) : ' ../images/defaultAvatar.png');
    @endphp
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row justify-content-center">
                <div style=" width: 70%">
                    <div class="form-group col-12">
                        <input type="file" id="file" name="file" style="display: none;">
                    </div>
                    <input type="hidden" name="avatar" id="avatar">
                    <div class="form-group col-12 d-flex justify-content-center mt-5 mb-3" id="preview_image">
                        <label style="cursor: pointer;" class=" align-items-center" for="file"
                            style="margin-left: 15px"> <img src= "{{ $user->avatar }}" alt="default-avatar"
                                style="border-radius: 30%;height:150px; width:150px; overflow:hidden;"></label>
                    </div>
                    <div class="row">
                        <div class="row justify-content-center">
                            @php
                                $positions = Session::get('positions') ?? null;
                            @endphp
                            <x-input-field :value="$user ? $user['username'] : ''" field="username" label="{{ __('form.username') }}"
                                col='6' type="username"></x-input-field>
                            <x-input-field disabled='true' :value="$user ? $user['email'] : ''" field="email" label="{{ __('form.email') }}"
                                col='6' type="email"></x-input-field>

                            <x-input-field :value="$user ? $user['password'] : ''" field="password" label="{{ __('form.password') }}"
                                col='6' type="password"></x-input-field>

                            <x-input-field :value="$user ? $user['password'] : ''" field="password_confirmation"
                                label="{{ __('form.password_confirmation') }}" col='6'
                                type="password"></x-input-field>

                            <x-input-field field="current_password" label="{{ __('form.current_password') }}" col='6'
                                type="password"></x-input-field>


                            <x-input-field :value="$user ? $user['phone'] : ''" field="phone" col='6' label="{{ __('form.phone') }}"
                                type="phone"></x-input-field>


                            <x-select-option class='col-6' id="position_id" name="position_id"
                                label="{{ __('form.position') }}" :options="$positions" :selected="$user['position_id']"></x-select-option>

                            <x-input-field :value="$user ? $user['address'] : ''" field="address" label="{{ __('form.address') }}"
                                col='6'></x-input-field>

                            <x-radio-button class='col-12 ' subclass='d-flex' name="gender"
                                label="{{ __('form.gender') }}" :options="[
                                    'male' => __('form.male'),
                                    'female' => __('form.female'),
                                    'other' => __('form.other'),
                                ]" :selected="$user['gender']" />
                            <div class="d-flex justify-content-center">
                                <x-button type="submit" text="{{ __('layout.update') }}"
                                    btn_class="primary m-3"></x-button>
                            </div>

                        </div>
                    </div>
        </form>


    </div>

@endsection

@section('foot')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Upload file

        $(document).ready(function() {
            $('#file').change(async function() {
                const locale = getLocaleFromUrl();
                let url = `http://127.0.0.1:8000/user/upload/avatar`;
                if (locale == 'vi') {
                    url = `http://127.0.0.1:8000/${locale}/user/upload/avatar`;
                }

                const file = $(this)[0].files[0];

                const formData = new FormData();
                formData.append('file', file);

                $.ajax({
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    data: formData,
                    url: url,
                    success: function(result) {
                        if (!result.error) {
                            $('#preview_image').html(`<label style="cursor: pointer;" class=" align-items-center" for="file" style="margin-left: 15px">
                        <img src="../../${result.path}" alt="default" style="height:200px; width:200px; overflow:hidden; border-radius:18%">
                    </label>`);
                            $('#avatar').val(result.path);
                        } else {
                            alert('Fail!!!')
                        }
                    },
                    error: function(xhr, status, error) {
                        const response = JSON.parse(xhr.responseText);

                        // Access and alert the message property
                        if (response.message) {
                            alert(response.message);
                        } else {
                            alert('An error occurred, but no message was provided.');
                        }
                    }
                });
            });
        });

        function getLocaleFromUrl() {
            // Get the current URL path
            const path = window.location.pathname;

            // Split the path into segments
            const segments = path.split('/');

            // Assuming the locale is the first segment
            // segments[0] would be empty because path starts with '/', so use segments[1]
            const locale = segments[1];

            return locale;
        }
    </script>
@endsection
