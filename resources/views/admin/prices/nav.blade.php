@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Прайсы</h2>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                        @foreach($roll_constructions as $roll_construction)
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">{{ $roll_construction->label }}</a>
                            <ul class="dropdown-menu">
                                @foreach($catalogs as $catalog)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">{{ $catalog->label }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($roll_categories as $roll_category)
                                            <li><a class="dropdown-item" href="#">Категория {{ $roll_category->label }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        День-ночь
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach($zebra_constructions as $zebra_construction)
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#">{{ $zebra_construction->label }}</a>
                            <ul class="dropdown-menu">
                                @foreach($catalogs as $catalog)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">{{ $catalog->label }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($zebra_categories as $zebra_category)
                                        <li><a class="dropdown-item" href="#">Категория {{ $zebra_category->label }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
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
