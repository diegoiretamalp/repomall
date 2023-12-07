<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">

    <title>Dashboard Mall Vivo - Domotica Technology</title>

    {{-- Highcharts --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/annotations.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Theme CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .img-logo {
            max-width: 100%;
            max-height: 100%;
        }

        .logo-content {
            height: 100px;
            margin-left: 10px;
            margin-top: 10px
        }

        .texto-ini {
            max-width: 100%;
            max-height: 100%;
        }

        .texto-box {
            height: 100%;
        }

        .link_nav:hover {
            border-radius: 25px;
            {{ Route::currentRouteNamed('searchDate') ? 'background-color: #acbcd7;' : '' }} 
            {{ Route::currentRouteNamed('marketing') ? 'background-color: #f4d064;' : '' }}
            {{ Route::currentRouteNamed('marketing_yesterday') ? 'background-color: #f4d064;' : '' }}
            {{ Route::currentRouteNamed('inicio') ? 'background-color: #7d95bf;' : '' }} 
            {{ Route::currentRouteNamed('vehicle') ? 'background-color: #00a429;' : '' }} 
            {{ Route::currentRouteNamed('search') ? 'background-color: #00df38;' : '' }} 
            {{ Route::currentRouteNamed('patio') ? 'background-color: #b39c8a;' : '' }} 
            {{ Route::currentRouteNamed('cambiarContraseña') ? 'background-color: #bedaf3;' : '' }}
        }
    </style>
</head>

<body style="background-color: #E4E9F7;">
    <div id="app">
        <nav class="navbar navbar-expand-lg"
            style="
        {{ Route::currentRouteNamed('inicio') ? 'background-color: #4a6595' : '' }};
        {{ Route::currentRouteNamed('patio') ? 'background-color: rgb(146, 118, 96)' : '' }};
        {{ Route::currentRouteNamed('cambiarContraseña') ? 'background-color: #7EB6E9' : '' }};
        {{ Route::currentRouteNamed('marketing') ? 'background-color: #EBB211' : '' }};
        {{ Route::currentRouteNamed('marketing_yesterday') ? 'background-color: #EBB211' : '' }};
        {{ Route::currentRouteNamed('search') ? 'background-color: #00a429;' : '' }};
        {{ Route::currentRouteNamed('vehicle') ? 'background-color: #009925' : '' }};
        {{ Route::currentRouteNamed('searchDate') ? 'background-color: #7d95bf' : '' }};">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('inicio')}}">Domotica Technology</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-5">
                        <li class="nav-item" style="width: 170px; text-align: center">
                            <a class="nav-link link_nav" style="color: white;" aria-current="page"
                                href="{{ route('inicio') }}">Acceso General</a>
                        </li>
                        @if ($idmall == 1)
                        <li class="nav-item" style="width: 170px; text-align: center">
                            <a class="nav-link link_nav" style="color: white;" aria-current="page"
                                href="{{ route('patio') }}">Patio de Comidas</a>
                        </li>
                        @endif
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle link_nav" style="width: 170px; text-align: center; color: white;"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Marketing
                            </a>
                            <div class="dropdown-content" style="border-radius: 25px;">
                                <li>
                                    <a class="dropdown-item link_nav" href="{{ route('marketing') }}">
                                        Marketing día actual
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item link_nav" href="{{ route('marketing_yesterday') }}">
                                        Marketing día anterior
                                    </a>
                                </li>
                            </div>
                        </div>
                        @if($idmall == 3)
                            <li class="nav-item" style="width: 170px; text-align: center">
                                <a class="nav-link link_nav" style="color: white;" aria-current="page"
                                    href="{{ route('vehicle') }}">Vehículos</a>
                            </li>
                            @if ($_SERVER['REQUEST_URI'] == '/vehicle')
                                <li class="nav-item" style="width: 170px; text-align: center">
                                    <a class="nav-link link_nav" style="color: white;" aria-current="page"
                                        href="{{ route('search') }}">Buscar Patentes</a>
                                </li>
                            @endif
                        @endif
                        <li class="nav-item" style="width: 170px; text-align: center">
                            <a href="{{route('searchDate')}}" style="color: white;"
                             aria-current="page" class="nav-link link_nav">Buscar por fecha</a>
                        </li>
                        {{-- <div class="dropdown">
                            <a class="nav-link dropdown-toggle link_nav" style="width: 170px; text-align: center; color: white;"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Monitores
                            </a>
                            @switch($idmall)
                                @case(1)
                                    <div class="dropdown-content" style="border-radius: 25px;">
                                        <li>
                                            <a class="dropdown-item link_nav" href="{{ route('accesos_concentrado') }}">
                                                Monitor Principal
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item link_nav" href="{{ route('food_concentrate') }}">
                                                Monitor Patio de Comidas
                                            </a>
                                        </li>
                                    </div>
                                    @break
                                @case(2)
                                    <div class="dropdown-content" style="border-radius: 25px;">
                                        <li>
                                            <a href="{{ route('accesos_concentrado') }}" class="dropdown-item link_nav">Monitor Principal</a>
                                        </li>
                                    </div>
                                    @break
                                @case(3)
                                    <div class="dropdown-content" style="border-radius: 25px;">
                                        <li>
                                            <a href="{{ route('accesos_concentrado') }}" class="dropdown-item link_nav">Monitor Principal</a>
                                        </li>
                                    </div>
                                    @break
                                @case(4)
                                    <div class="dropdown-content" style="border-radius: 25px;">
                                        <li>
                                            <a href="{{ route('accesos_concentrado') }}" class="dropdown-item link_nav">Monitor Principal</a>
                                        </li>
                                    </div>
                                    @break
                                @default
                                    
                            @endswitch
                        </div> --}}

                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle link_nav" style="width: 170px; text-align: center; color: white;"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-content" style="border-radius: 25px;">
                                <li>
                                    <a class="dropdown-item link_nav" href="{{ route('cambiarContraseña') }}">
                                        Cambiar Contraseña
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item link_nav" href="{{ route('login') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logoutSession') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        @auth
            <section class="">
            @endauth
            <main class="py-4">
                @yield('content')
            </main>
            <main>
                @include('layouts.footer')
            </main>
        </section>
        <!-- MDB -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
    </div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

