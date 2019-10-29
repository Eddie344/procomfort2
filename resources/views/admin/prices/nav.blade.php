@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Прайсы</h2>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Рулонные шторы
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Mini</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Амиго</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Категория 1</a></li>
                                        <li><a class="dropdown-item" href="#">Категория 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                        <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">UNI-1</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Амиго</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Категория 1</a></li>
                                        <li><a class="dropdown-item" href="#">Категория 2</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Межароль</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Категория 1</a></li>
                                        <li><a class="dropdown-item" href="#">Категория 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        День-ночь
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">Submenu</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Submenu action</a></li>
                                <li><a class="dropdown-item" href="#">Another submenu action</a></li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Subsubmenu</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                        <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Second subsubmenu</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Subsubmenu action</a></li>
                                        <li><a class="dropdown-item" href="#">Another subsubmenu action</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Горизонтальные жалюзи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Амиго</a>
                        <a class="dropdown-item" href="#">Межароль</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Вертикальные жалюзи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Амиго</a>
                        <a class="dropdown-item" href="#">Межароль</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
    @yield('prices')
@endsection
