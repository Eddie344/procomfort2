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
    <input id="row" placeholder="Enter Item Name"/><button id="irow">Insert Row</button><br/><br/>
    <input id="col" placeholder="Enter Heading"/><button id="icol">Insert Column</button>
    <price-table-component :heightdata="{{ json_encode($heights) }}" :widthdata="{{ json_encode($widths) }}"></price-table-component>
@endsection
