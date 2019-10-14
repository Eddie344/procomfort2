@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Заказы</h2>
    <div class="row mb-2">
        <div class="input-group mb-3 col-md-3">
            <input type="text" class="form-control" placeholder="Поиск..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="input-group mb-3 col-md-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                Добавить заказ
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Добавление заказа</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Form::open(['route' => 'orders.store']) }}
                        {{ Form::token() }}
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('diller_id', 'Заказчик:') }}
                                {{ Form::select('diller_id', \App\Models\User::pluck('alias','id'), null, ['placeholder' => 'Выберите заказчика...', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('prefix', 'Префикс заказчика:') }}
                                {{ Form::text('prefix', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('product_type', 'Вид изделий:') }}
                                {{ Form::select('product_type', \App\Models\ProductType::pluck('label','id'), null, ['placeholder' => 'Выберите вид изделий...', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('payment_type_id', 'Тип оплаты:') }}
                                {{ Form::select('payment_type_id', \App\Models\PaymentType::pluck('label','id'), null, ['placeholder' => 'Выберите тип оплаты...', 'class' => 'form-control', 'required'])}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{ Form::submit('Создать', ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Заказчик</th>
            <th scope="col">Префикс заказчика</th>
            <th scope="col">Вид изделий</th>
            <th scope="col">Тип оплаты</th>
            <th scope="col">Статус</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row"><a href="{{ route('orders.show', ['id' => $order->id]) }}">{{ $order->id }}</a></th>
                <td><a href="{{ route('customers.show', ['id' => $order->diller->id]) }}">{{ $order->diller->getFullName() }}</a></td>
                <td>{{ $order->prefix }}</td>
                <td>{{ $order->productType->label }}</td>
                <td>{{ $order->paymentType->label }}</td>
                <td class="{{ $order->status->color }}">{{ $order->status->label }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
