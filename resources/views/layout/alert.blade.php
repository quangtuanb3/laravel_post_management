{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

@if (Session::has('error'))
    <div class="alert-container" style="position: fixed; right: 10px; top: 10px; z-index: 100;">
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert-container" style="position: fixed; right: 10px; top: 10px; z-index: 100; margin-top: 50px;">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
@endif
