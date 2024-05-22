@extends('../layout/user-master')
@section('title', __('page-titles.post_detail'))
@section('username', auth()->user()->username ?? '')

@section('content')
    <div class="container">
        <div class="pt-2">
            <h5 style="color:blue">{{ $post->user->username }}</h5>
            <p style="font-size: 11px; margin-bottom">{{ $post->updated_at }}</p>
            <p><i class="fa fa-eye" style="padding-right: 5px"> </i>{{ $post->view_number }}</p>
        </div>
        @if (isset(auth()->user()->id) && auth()->user()->id === $post->user_id)
            <div class="d-flex" style="position: absolute; right:50px; top:5em">
                <a class="btn btn-primary m-2" href="{{ route('user.post.edit', $post->id) }}"><i class="fa fa-edit"></i></a>
                <form id="delete-post-form-{{ $post->id }}" action="{{ route('user.post.destroy', $post->id) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger m-2 delete-post-btn"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        @endif

        @php
            $post->image ? $post->image : ($post->image = ' http://127.0.0.1:8000/images/upload.jpg');
            if (!stristr($post->image, 'http')) {
                $post->image = 'http://127.0.0.1:8000/' . $post->image;
            }
        @endphp

        <div class="row">
            <div class="col-5">

                <img style="width:400px; height:300px" src="{{ $post->image }}" alt="image-{{ $post->id }}">
            </div>
            <div class="col-7">
                <h3>{{ $post->subject }}</h3>
                <p style="color: blue">
                    {{ $post->hashtags->map(function ($tag) {
                            return '#' . $tag->name;
                        })->implode(', ') }}
                </p>
                <p>
                    {{ $post->content }}
                </p>
            </div>
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
        // Add event listener to all delete buttons with the class "delete-post-btn"
        document.querySelectorAll('.delete-post-btn').forEach(btn => {
            btn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent form submission

                // Ask for confirmation
                const isConfirmed = confirm('Are you sure you want to delete this post?');

                // If confirmed, submit the form
                if (isConfirmed) {
                    const formId = this.closest('form').id; // Get the ID of the form
                    document.getElementById(formId).submit(); // Submit the form
                }
            });
        });
    </script>s
@endsection
