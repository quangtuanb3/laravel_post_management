@extends('../layout/user-master')
@section('title', __('page-titles.post_edit'))
@section('username', auth()->user()->username)

@section('content')
    <div class="container">
        <h4 class="text-center pt-4">{{ __('page-titles.post_edit') }}</h4>
        <div class="row">

            <form enctype="multipart/form-data" method="POST" action="{{ route('user.post.update', $post->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group col-12">
                    <input type="file" id="file" name="file" style="display: none;">
                </div>
                <input type="hidden" name="image" id="image" value="{{ $post->image }}">
                @php

                    $post->image ? $post->image : ($post->image = ' http://127.0.0.1:8000/images/upload.jpg');
                    if (!stristr($post->image, 'http')) {
                        $post->image = 'http://127.0.0.1:8000/' . $post->image;
                    }

                @endphp
                <div class="form-group col-12 d-flex justify-content-center mt-5 mb-3" id="preview_image">
                    <div>
                        <label for="file" class="align-items-center @error('image') is-invalid @enderror"
                            style="cursor: pointer; margin-left: 15px;">
                            <img src="{{ $post->image }}" alt="post-image-{{ $post->id }}"
                                style="height: 200px; width: 200px; overflow: hidden;">

                        </label>
                        <x-input-error field="image" />
                    </div>
                </div>
                <x-input-field field="subject" label="{{ __('form.subject') }}" type="text"
                    :value="$post->subject"></x-input-field>

                <div class="form-group">
                    <label for="content"><strong>{{ __('form.content') }}</strong></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5">{{ old('content', $post->content) }}</textarea>

                    <x-input-error field="content" />
                </div>
                <x-input-field field="hashtags" label="{{ __('form.hashtags') }}" type="text"
                    :value="$post->hashtags
                        ->map(function ($tag) {
                            return '#' . $tag->name;
                        })
                        ->implode(', ')"></x-input-field>

                <div class="d-flex justify-content-center">

                    <input type="submit" value="{{ __('layout.update') }}" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('foot')
    <script>
        function handleSelection(select) {
            var url = select.options[select.selectedIndex].getAttribute('data-url');
            window.location.href = url;
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Upload file

        $(document).ready(function() {
            const locale = getLocaleFromUrl();
            let url = `http://127.0.0.1:8000/user/upload/avatar`;
            if (locale == 'vi') {
                url = `http://127.0.0.1:8000/${locale}/user/upload/avatar`;
            }
            $('#file').change(async function() {
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
                        <img src="http://127.0.0.1:8000/${result.path}" alt="default" style="height:300px; width:400px; overflow:hidden;">
                    </label>`);
                            $('#image').val(result.path);
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
