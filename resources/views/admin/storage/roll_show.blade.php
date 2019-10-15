@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Склад</h2>
    <div class="row mb-2">
        <div class="form-group col-md-3">
            <select class="form-control" id="exampleFormControlSelect1">
                <option>Выберите каталог...</option>
                <option>Амиго</option>
                <option>Межароль</option>
                <option>Прокомфорт</option>
                <option>Амилюкс</option>
                <option>Гарден</option>
            </select>
        </div>
        <div class="input-group mb-3 col-md-3">
            <input type="text" class="form-control" placeholder="Поиск ткани" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="input-group mb-3 col-md-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                Добавить +
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Добавление пункта</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Form::open(['route' => 'storage.store']) }}
                        {{ Form::token() }}
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('label', 'Наименование:') }}
                                {{ Form::text('label', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type_id', 'Тип:') }}
                                {{ Form::select('type_id', \App\Models\StoragesType::pluck('label','id'), null, ['placeholder' => 'Выберите тип...', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('provider_id', 'Поставщик:') }}
                                {{ Form::select('provider_id', \App\Models\Provider::pluck('label','id'), null, ['placeholder' => 'Выберите поставщика...', 'class' => 'form-control', 'required'])}}
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
            <th scope="col">Наименование</th>
            <th scope="col">Тип</th>
            <th scope="col">Поставщик</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($storages as $storage)
            <tr>
                <td><a href="{{ route('storage.show', ['id' => $storage->id]) }}">{{ $storage->label }}</a></td>
                <td>{{ $storage->type->label }}</td>
                <td>{{ $storage->provider->label }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $storages->links() }}
@endsection
