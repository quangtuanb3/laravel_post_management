<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">BAP HUE</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">{{ __('layout.navbar.home') }}</a>
                </li>
                <li class="nav-item">
                    @if (Auth::check())
                        @if (Auth::user()->hasrole('user'))
                            <a class="nav-link"
                                href="{{ route('user.post.index', ['author' => 'all']) }}">{{ __('layout.navbar.post') }}</a>
                        @elseif(Auth::user()->hasrole('admin'))
                            <a class="nav-link"
                                href="{{ route('admin.post.index') }}">{{ __('layout.navbar.post') }}</a>
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
                    <div style="font-size: 24px; font-weight: 700; color: Blue; text-align: center; margin-right: 10px">
                        @if (App::getLocale() == 'en')
                            <a class="nav-link" href="{{ \App\Utilities\AppLanguage::languageUrl('vi') }}">VI</a>
                        @else
                            <a class="nav-link" href="{{ \App\Utilities\AppLanguage::languageUrl('en') }}">EN</a>
                        @endif
                    </div>

                    <li class="nav-item">
                        @if (Auth::check())
                            @if (Auth::user()->hasrole('user'))
                                <a class="nav-link" href="{{ route('user.profile') }}">@yield('username')</a>
                            @elseif(Auth::user()->hasrole('admin'))
                                <a class="nav-link" href="{{ route('admin.profile') }}">@yield('username')</a>
                            @endif
                        @endif

                    </li>
                    @php
                        if (isset(auth()->user()->avatar)) {
                            auth()->user()->avatar
                                ? ($avatar = auth()->user()->avatar)
                                : ($avatar = 'http://127.0.0.1:8000/images/defaultAvatar.png');

                            if (!stristr($avatar, 'http')) {
                                $avatar = 'http://127.0.0.1:8000/' . $avatar;
                            }
                        } else {
                            $avatar = 'http://127.0.0.1:8000/images/defaultAvatar.png';
                        }

                    @endphp
                    <li class="nav-item dropdown">
                        <img style="display: block; width: 50px;height:50px; border-radius: 15px"
                            src="{{ $avatar }}" alt="avatar" class="nav-link dropdown-toggle"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </img>
                        @if (Auth::check())
                            <ul class="dropdown-menu" style="left:-50%; top:40px; min-width:50px"
                                aria-labelledby="navbarDropdown">

                                <li>
                                    @if (Auth::user()->hasrole('user'))
                                        <a class="dropdown-item"
                                            href="{{ route('user.profile') }}">{{ __('layout.navbar.setting') }}
                                        </a>
                                    @elseif(Auth::user()->hasrole('admin'))
                                        <a class="dropdown-item"
                                            href="{{ route('admin.profile') }}">{{ __('layout.navbar.setting') }}
                                        </a>
                                    @endif

                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('auth.logout') }}">{{ __('layout.navbar.logout') }}</a></li>
                            </ul>
                        @endif

                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>
@yield('header')
