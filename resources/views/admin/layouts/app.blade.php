<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('js/common.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/admin') }}">
                {{ config('app.name', 'ProComfort') }}
            </a>

            <div class="dropdown">
                <a class="nav-link dropdown-toggle user-dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i>{{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu user-dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-cog"></i>Настройки</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-arrow-up"></i>Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <div class="nav flex-column">
                    <div class="accordion" id="sidebar-accordion">

                        <div class="card">
                            <a href="#" class="card-header">
                                <span><i class="fa fa-home"></i>Главная</span>
                            </a>
                        </div>

                        <div class="card">
                            <a href="{{ route('orders.index') }}" class="card-header">
                                <span><i class="fa fa-clipboard"></i>Заказы</span>
                                <span class="badge badge-primary py-2">4</span>
                            </a>
                        </div>

                        <div class="card">
                            <a href="{{ route('customers.index') }}" class="card-header">
                                <span><i class="fa fa-users"></i>Заказчики</span>
                            </a>
                        </div>

                        <div class="card">
                            <a href="#" class="card-header" id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                <span><i class="fa fa-th-list"></i>Склад</span>
                            </a>
                            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#sidebar-accordion">
                                <div class="list-group">
                                    <a class="list-group-item" href="{{ route('roll.index') }}">Ткани рулонные</a>
                                    <a class="list-group-item" href="{{ route('zebra.index') }}">Ткани день-ночь</a>
                                    <a class="list-group-item" href="{{ route('vert.index') }}">Ткани вертикальные</a>
                                    <a class="list-group-item" href="{{ route('goriz.index') }}">Лента горизонтальная</a>
                                    <a class="list-group-item" href="{{ route('metal.index') }}">Метал</a>
                                    <a class="list-group-item" href="{{ route('furn.index') }}">Фурнитура</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="accordion" id="sidebar-prices">
                                <a href="#" class="card-header" id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    <span><i class="fa fa-money"></i>Прайсы</span>
                                </a>
                                <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#sidebar-prices">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item" id="heading5" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                            Рулонные шторы
                                        </a>
                                        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#sidebar-accordion">
                                            <div class="list-group">
                                                <a class="list-group-item price-padding" href="{{ route('price.index') }}">Mini</a>
                                                <a class="list-group-item price-padding" href="#">UNI-1</a>
                                                <a class="list-group-item price-padding" href="#">UNI-2</a>
                                                <a class="list-group-item price-padding" href="#">D-25</a>
                                            </div>
                                        </div>

                                        <a href="#" class="list-group-item" id="heading6" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                            Зебра
                                        </a>
                                        <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#sidebar-accordion">
                                            <div class="list-group">
                                                <a class="list-group-item price-padding" href="#">Mini</a>
                                                <a class="list-group-item price-padding" href="#">UNI-1</a>
                                                <a class="list-group-item price-padding" href="#">UNI-2</a>
                                                <a class="list-group-item price-padding" href="#">MGS</a>
                                            </div>
                                        </div>
                                        <a class="list-group-item" href="price_vert.html">Вертикальные жалюзи</a>
                                        <a class="list-group-item" href="price_goriz.html">Горизонтальные жалюзи</a>
                                        <a class="list-group-item" href="price_dop.html">Дополнительная комплектация</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="row justify-content-end mt-5">
            <div class="col-md-10 px-5 py-5">
                @yield('content')
            </div>
        </main>
    </div>
    {{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav mr-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
</body>
</html>
