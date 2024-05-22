<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('../layout/head')
</head>

<body>
    @include('../layout/alert')
    <section id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BAP HUE</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('home') }}">{{ __('layout.navbar.home') }}</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('layout.navbar.contact') }}</a>
                        </li>
                    </ul>
                    <div class="d-flex">

                        <ul class="navbar-nav me-4 mb-2 mb-lg-0 d-flex align-items-center">
                            {{-- <x-select-option id="language" name="language" :options="['VN' => 'Vietnamese', 'ENG' => 'English']"
                                selected="{{ old('language') }}" /> --}}
                            <div
                                style="font-size: 24px; font-weight: 700; color: Blue; text-align: center; margin-right: 10px">
                                @if (App::getLocale() == 'en')
                                    <a class="nav-link"
                                        href="{{ \App\Utilities\AppLanguage::languageUrl('vi') }}">VI</a>
                                @else
                                    <a class="nav-link"
                                        href="{{ \App\Utilities\AppLanguage::languageUrl('en') }}">EN</a>
                                @endif
                            </div>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
        @yield('header')

    </section>

    <section style="min-height: 80vh">
        @yield('content')
    </section>
    @include('../layout/footer')

    @include('../layout/foot')

</body>

</html>
