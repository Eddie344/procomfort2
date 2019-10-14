@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Заказчики</h2>
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
                Добавить заказчика
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Добавление заказчика</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Form::open(['route' => 'customers.store']) }}
                            {{ Form::token() }}
                            <div class="modal-body row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('name', 'Имя:') }}
                                    {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('surname', 'Фамилия:') }}
                                    {{ Form::text('surname', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('alias', 'Псевдоним:') }}
                                    {{ Form::text('alias', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('city', 'Город:') }}
                                    {{ Form::text('city', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('email', 'E-mail:') }}
                                    {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('phone', 'Телефон:') }}
                                    {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-info" role="alert">
                                        Пароль будет отправлен на указанный адрес электронной почты
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible col-md-6 fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Заказчик</th>
            <th scope="col">Псевдоним</th>
            <th scope="col">Город</th>
            <th scope="col">Телефон</th>
            <th scope="col">E-mail</th>
            <th scope="col">Баланс</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
        <tr>
            <td><a href="{{ route('customers.show', ['id' => $user->id]) }}">{{$user->name}} {{$user->surname}}</a></td>
            <td>{{$user->alias}}</td>
            <td>{{$user->city}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->balance}}$</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
