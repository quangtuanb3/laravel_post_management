<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('../layout/head')
</head>

<body>
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
                        @if (Auth::check())
                            @if (Auth::user()->hasrole('user'))
                                <a class="nav-link"
                                    href="{{ route('user.post.index', ['author' => 'all']) }}">{{ __('layout.navbar.post') }}</a>
                            @elseif(Auth::user()->hasrole('admin'))
                                <a class="nav-link"
                                    href="{{ route('admin.dashboard') }}">{{ __('layout.navbar.post') }}</a>
                            @endif
                        @endif
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
                                <a class="nav-link" href="{{ \App\Utilities\AppLanguage::languageUrl('vi') }}">VI</a>
                            @else
                                <a class="nav-link" href="{{ \App\Utilities\AppLanguage::languageUrl('en') }}">EN</a>
                            @endif
                        </div>

                        <li class="nav-item">
                            @if (Route::has('auth.login'))
                                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right d-flex">
                                    @auth
                                        @if (Auth::check())
                                            @if (Auth::user()->hasrole('user'))
                                                <a class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                                    href="{{ route('user.post.index', ['author' => 'all']) }}">{{ __('layout.navbar.post') }}</a>
                                            @elseif(Auth::user()->hasrole('admin'))
                                                <a class=" nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                                    href="{{ route('admin.post.index') }}">{{ __('layout.navbar.post') }}</a>
                                            @endif
                                        @endif
                                        <a href="{{ route('auth.logout') }}"
                                            class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                                            style="margin-left: 20px">{{ __('layout.navbar.logout') }}</a>
                                    @else
                                        <a href="{{ route('auth.showLogin') }}"
                                            class="nav-link font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('layout.navbar.login') }}</a>

                                        @if (Route::has('auth.register.info'))
                                            <a href="{{ route('auth.register.info') }}"
                                                class=" nav-link ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('layout.navbar.register') }}</a>
                                        @endif
                                    @endauth

                                </div>
                            @endif
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    @yield('header')

    @include('../layout/alert')

    <div style="clear: both"></div>
    @yield('content')
   

    @include('../layout/footer')

    @include('../layout/foot')
</body>

</html>
