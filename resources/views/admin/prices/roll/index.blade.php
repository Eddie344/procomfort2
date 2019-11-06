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
    <table class="table table-bordered table-price">
        <thead>
        <tr>
            <th scope="col" rowspan="2">Высота</th>
            <th scope="row" colspan="11">Ширина</th>
        </tr>
        <tr>
            @foreach($widths as $key => $value)
                <th scope="col">{{ $key }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
            @foreach($heights as $key1 => $value1)
                <tr>
                    <th scope="row">{{ $key1 }}</th>
                    @foreach($value1 as $value2)
                        <td>{{ $value2['price'] }}</td>
                    @endforeach
                </tr>
            @endforeach
{{--        <tr>--}}
{{--            <th scope="row">1.7</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.0</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.3</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.5</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">1.7</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.0</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.3</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
{{--        <tr>--}}
{{--            <th scope="row">2.5</th>--}}
{{--            <td>8,5</td>--}}
{{--            <td>9,0</td>--}}
{{--            <td>9,5</td>--}}
{{--            <td>10,0</td>--}}
{{--            <td>10,6</td>--}}
{{--            <td>11,1</td>--}}
{{--            <td>11,6</td>--}}
{{--            <td>12,1</td>--}}
{{--            <td>12,6</td>--}}
{{--            <td>13,1</td>--}}
{{--            <td>13,6</td>--}}
{{--        <tr>--}}
        </tbody>
    </table>
@endsection
