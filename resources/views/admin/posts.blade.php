@extends('../layout/user-master')
@section('title', __('page-titles.post_list'))
@section('title', 'Dashboard')
@section('head')
    <style>
        table {
            text-align: center;
        }

        th,
        td {
            text-align: center;
        }
    </style>

@endsection
@section('username', auth()->user()->username)
@section('content')
    <div class="container-fluid">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">{{ __('form.image') }}</th>
                    <th scope="col">{{ __('form.subject') }}</th>
                    <th scope="col">{{ __('form.hashtags') }}</th>
                    <th scope="col">{{ __('form.author') }}</th>
                    <th scope="col">{{ __('form.view_number') }}</th>
                    <th scope="col">{{ __('form.created_at') }}</th>
                    <th scope="col">{{ __('form.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $index => $post)
                    @php
                        $post->image ? $post->image : ($post->image = ' http://127.0.0.1:8000/images/upload.jpg');
                        if (!stristr($post->image, 'http')) {
                            $post->image = 'http://127.0.0.1:8000/' . $post->image;
                        }
                    @endphp
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td><img src="{{ $post->image }}" alt="Post Image" style="max-width: 100px;"></td>
                        <td title="{{ $post->subject }}"><x-truncate :text="$post->subject" length="30" /></td>
                        <td>
                            @foreach ($post->hashtags as $tag)
                                #{{ $tag->name }}
                            @endforeach
                        </td>
                        <td>{{ $post->user->username }}</td>
                        <td>{{ $post->view_number }}</td>
                        <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-info"></i></a>
                            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-edit"></i></a>

                            <form action="{{ route('admin.post.destroy', $post->id) }}" method="post"
                                style="display: inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center pt-3">

            {{ $posts->appends(['author' => 'all'])->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
