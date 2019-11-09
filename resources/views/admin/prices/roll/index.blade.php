@extends('admin.prices.nav')

@section('prices')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0">
            <li class="breadcrumb-item text-black-50">Рулонные шторы</li>
            <li class="breadcrumb-item text-black-50">Mini</li>
            <li class="breadcrumb-item text-black-50">Амиго</li>
            <li class="breadcrumb-item text-black-50">Категория 1</li>
        </ol>
    </nav>
    <price-table-component :pricedata="{{ json_encode($prices) }}" :constructions="{{ json_encode($roll_constructions) }}" :catalogs="{{ json_encode($catalogs) }}" :categories="{{ json_encode($roll_categories) }}"></price-table-component>
@endsection
