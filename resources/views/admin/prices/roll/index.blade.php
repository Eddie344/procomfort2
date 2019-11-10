@extends('admin.prices.nav')

@section('prices')
    <price-table-component :constructions="{{ json_encode($roll_constructions) }}" :catalogs="{{ json_encode($catalogs) }}" :categories="{{ json_encode($roll_categories) }}"></price-table-component>
@endsection
