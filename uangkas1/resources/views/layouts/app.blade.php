<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            font-weight: 600;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 20px;
            background: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-box-arrow-in-right"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-people"></i>
                                    Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('siswa.index') }}"><i class="bi bi-people"></i>
                                    Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pembayaran.index') }}"><i class="bi bi-cash"></i>
                                    Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('uang_kas.index') }}"><i class="bi bi-cash"></i>
                                    Seluruh Saldo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pengurangansaldo.index') }}"><i
                                        class="bi bi-cash"></i>
                                    Pengeluaran</a>
                            </li>
                        </ul>
                    @endif

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                                <script>
                                    function confirmLogout(event) {
                                        event.preventDefault();
                                        if (confirm('Apakah Anda yakin ingin logout?')) {
                                            document.getElementById('logout-form').submit();
                                        }
                                    }
                                </script>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            @yield('content')
        </main>
    </div>
</body>

</html>
