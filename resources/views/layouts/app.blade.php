<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <nav>
            <div class="nav__bar">
                <div class="logo">
                    <a href="#"><img src="{{ asset('images/logo.png') }}" alt="logo" /></a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <i class="ri-menu-line"></i>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="{{ route('chambres') }}">Chambres</a></li>
                <li><a href="#explore">Explore</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            @guest
               
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn nav__btn">login</a>
                @endif
            @else
                <div class="nav__user">
                    <a href="#" class="nav__user__icon">
                        <i class="fas fa-user"></i> <!-- Icône utilisateur -->
                        <span>{{ Auth::user()->name }}</span> <!-- Nom de l'utilisateur -->
                    </a>
                    <a href="#" class="btn nav__btn" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
