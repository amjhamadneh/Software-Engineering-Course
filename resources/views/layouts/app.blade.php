<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="/image/icon.png" type="image-vi/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WorldEye') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ajax -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        ::-webkit-scrollbar {
            display: none;
        }

        body{
            background-image: url('/image/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height:100vh;
        }
        h1{
             color:white;
        }

        .img{
            border-radius: 5px;
            margin: 1px;
        }

        .img:hover{
            box-shadow: black 1px 1px 3px;
        }

        @media (min-width: 992px)
        {
            .card-columns {
                column-count: 4;
            }
        }

        @media (min-width: 576px)
        {
            .card-columns {
                column-count: 4;
            }
        }

    </style>
    @yield('style')
</head>

<body>
<div >
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex shadow  pl-3 fixed-top">
        <a class="navbar-brand font-weight-bold d-flex" href="{{ url('/') }}">
            <img src="/image/logo.png" width="60px" height="30px">
            <h4 class="font-weight-bold ">World<span class="text-danger">E</span>ye</h4>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContentLeft navbarSupportedContentRight" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContentLeft">
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a id="nav-picture" class="nav-link font-weight-bold" href="{{ route('home') }}">Pictures</a>
                    </li>
                    <li class="nav-item">
                        <a id="nav-profile" class="nav-link font-weight-bold" href="{{ route('profile', auth()->user()->id) }}" >Profile</a>
                    </li>
                </ul>
            @endauth
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContentRight">
            <ul class="navbar-nav ">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a id="nav-login" class="nav-link font-weight-bold" href="{{ route('login') }}">{{ __('Login') }} <span class="sr-only">(current)</span></a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a id="nav-register" class="nav-link font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                @else
                    <li class="nav-item mr-2">
                        <a id="nav-notification" class="nav-link font-weight-bold" href="{{ route('notification') }}">Notification <i class="fa fa-bell"></i></a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link bg-dark text-light rounded p-2" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }} <i class="fa fa-sign-out fa-lg"></i></a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf

                    </form>
                @endguest
            </ul>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
@yield('scripts')
