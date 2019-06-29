<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ mix('css/app.css','build') }}" rel="stylesheet">
</head>
<body id="app">
<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/',app()->getLocale()) }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login',app()->getLocale()) }}"><i
                                        class="fa fa-sign-in"></i> {{ __('auth.sign_in') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register',app()->getLocale()) }}"><i
                                            class="fa fa-lock"></i> {{ __('auth.sign_up') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                   href="{{ route('admin.home',app()->getLocale()) }}">{{ __('Admin') }}</a>
                                <a class="dropdown-item"
                                   href="{{ route('cabinet.home',app()->getLocale()) }}">{{ __('Cabinet') }}</a>
                                <a class="dropdown-item" href="{{ route('logout',app()->getLocale()) }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout', app()->getLocale())}}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-language"></i> {{ strtoupper(app()->getLocale()) }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach(config('app.available_locales') as $locale)
                                <a class="dropdown-item" href="{{ route(Route::currentRouteName(), $locale) }}">
                                    {{ strtoupper($locale) }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="app-content py-3">
    <div class="container">
        {{--        @section('breadcrumbs',Breadcrumbs::render())--}}
        {{--        @yield('breadcrumbs')--}}
        @include('layouts.partials.flash')
        @yield('content')
    </div>
</main>
<footer>
    <div class="container">
        <div class="border-top pt-3">
            <p>&copy; {{ date('Y') }} - Booking</p>
        </div>
    </div>
</footer>
<script src="{{ mix('js/app.js','build') }}" defer></script>
</body>
</html>
