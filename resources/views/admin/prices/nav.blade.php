@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Прайсы</h2>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('*/price/roll') ? 'active' : '' }}" href="{{ route('price.roll.index') }}">Рулонные шторы</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{ request()->is('*/price/zebra') ? 'active' : '' }}" href="{{ route('price.zebra.index')}}">День-ночь</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{ request()->is('*/price/goriz') ? 'active' : '' }}" href="{{ route('price.zebra.index')}}">Горизонтальные жалюзи</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{ request()->is('*/price/vert') ? 'active' : '' }}" href="{{ route('price.zebra.index')}}">Вертикальные жалюзи</a>
                </li>

            </ul>
        </div>
    </nav>
    @yield('prices')
@endsection
