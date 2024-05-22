@extends('../layout/user-master')
@section('title', __('page-titles.post_list'))
@section('username', auth()->user()->username)

@section('content')
    <div class="container">
        <div class="d-flex align-items-center">
            <h3>{{ __('page-titles.post_list') }}</h3>
            <div class="m-3">
                <select name="post_by_author" id="post_by_author" onchange="handleSelection(this)">
                    <option value="OWNER" data-url="{{ route('user.post.index') }}?author={{ auth()->user()->id }}"
                        {{ request()->input('author') == auth()->user()->id ? 'selected' : '' }}>
                        {{ __('layout.owner') }}
                    </option>
                    <option value="ALL" data-url="{{ route('user.post.index') }}?author=all"
                        {{ request()->input('author') == 'all' ? 'selected' : '' }}>
                        {{ __('layout.all') }}
                    </option>
                </select>


            </div>
            <div style="position: absolute; right:10px">
                <x-button-link type="text" :href="route('user.post.create')" text="{{ __('layout.create_post') }}"
                    btn_class="success m-3"></x-button-link>
            </div>
        </div>

        @if (count($posts) == 0)
            <p>{{ __('layout.no-record') }}</p>
        @endif
        @foreach ($posts as $item)
            @php
                $item->image ? $item->image : ($item->image = ' http://127.0.0.1:8000/images/upload.jpg');
                if (!stristr($item->image, 'http')) {
                    $item->image = 'http://127.0.0.1:8000/' . $item->image;
                }
            @endphp
            <div id="posts" style="background-color:rgba(26, 10, 132, 0.411); padding:10px; border-radius:5px">
                <div class="d-flex row bg-light m-3 p-3" style="border-radius: 5px">
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <img src="{{ $item->image }}" alt="post-image-{{ $item->id }}"
                            style="width: 120px;height:120px">
                    </div>
                    <div class="col-8">
                        <h5>{{ $item->subject }}</h5>
                        <p style="color: blue"> {{ '@' . $item->user->username }}</p>
                        <p style="color: rgb(173, 173, 173)">
                            {{ $item->hashtags->map(function ($hashtag) {
                                    return '#' . $hashtag->name;
                                })->implode(', ') }}
                        </p>
                        <p style="font-size: 17px"><x-truncate :text="$item->content" length="80" /></p>

                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                        <div>
                            <h5 class="text-center">{{ $item->view_number }}</h5>
                            <x-button-link type="text" :href="route('user.post.show', ['id' => $item->id])" text="{{ __('layout.detail') }}"
                                btn_class="primary m-3"></x-button-link>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach
        <div class="d-flex justify-content-center pt-3">
            @php
                $queryParams = request()->query();
                $authorParam = isset($queryParams['author']) ? $queryParams['author'] : null;
            @endphp

            {{ $posts->appends(['author' => $authorParam])->links('pagination::bootstrap-4') }}
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
@endsection
