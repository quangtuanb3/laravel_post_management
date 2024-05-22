@extends('../layout/home-master')
@section('content')
    <section>

        <div id="content" class="container">
            <h3 class="p-3">{{ __('layout.new') }}</h3>
            <div class="d-flex justify-content-around">

                @foreach ($new_posts as $item)
                    @php
                        $item->image ? $item->image : ($item->image = ' http://127.0.0.1:8000/images/upload.jpg');
                        if (!stristr($item->image, 'http')) {
                            $item->image = 'http://127.0.0.1:8000/' . $item->image;
                        }

                    @endphp
                    <div class="card" style="width: 19rem; margin: 10px; display: flex; flex-direction: column;">
                        <img src="{{ $item->image }}" class="card-img-top" alt="image-{{ $item->id }}">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <h5 class="card-title col-9">
                                    <x-truncate :text="$item->subject" length="40"></x-truncate>
                                </h5>
                                <p class="col-3"><i class="fa fa-eye" style="padding-right: 5px">
                                    </i>{{ $item->view_number }}</p>
                            </div>

                            <p class="card-text">
                            <p style="color: darkblue"><span>@</span> {{ $item->user->username }}</p>
                            <p style="color: rgb(0, 138, 148)">
                                {{ $item->hashtags->map(function ($hashtag) {
                                        return '#' . $hashtag->name;
                                    })->implode(', ') }}
                            </p>
                            <x-truncate :text="$item->content" length="200" />
                            </p>
                            <div class="d-flex justify-content-center mt-auto">
                                <a href="{{ route('show', $item->id) }}"
                                    class="btn btn-primary">{{ __('layout.detail') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <h3 class="p-3">{{ __('layout.most-view') }}</h3>
            <div class="d-flex justify-content-around">

                @foreach ($mostViewPosts as $item)
                    @php
                        $item->image ? $item->image : ($item->image = ' http://127.0.0.1:8000/images/upload.jpg');
                        if (!stristr($item->image, 'http')) {
                            $item->image = 'http://127.0.0.1:8000/' . $item->image;
                        }

                    @endphp
                    <div class="card" style="width: 19rem; margin: 10px; display: flex; flex-direction: column;">
                        <img src="{{ $item->image }}" class="card-img-top" alt="image-{{ $item->id }}">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <h5 class="card-title col-9">
                                    <x-truncate :text="$item->subject" length="40"></x-truncate>
                                </h5>
                                <p class="col-3"><i class="fa fa-eye" style="padding-right: 5px">
                                    </i>{{ $item->view_number }}</p>
                            </div>
                            <p class="card-text">
                            <p style="color: darkblue"><span>@</span> {{ $item->user->username }}</p>
                            <p style="color: rgb(0, 138, 148)">
                                {{ $item->hashtags->map(function ($hashtag) {
                                        return '#' . $hashtag->name;
                                    })->implode(', ') }}
                            </p>
                            <x-truncate :text="$item->content" length="200" />
                            </p>
                            <div class="d-flex justify-content-center mt-auto">
                                <a href="{{ route('show', $item->id) }}"
                                    class="btn btn-primary">{{ __('layout.detail') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
