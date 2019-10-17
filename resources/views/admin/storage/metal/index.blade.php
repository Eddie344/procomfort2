@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Метал</h2>
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
                        {{ Form::open(['route' => 'metal.store']) }}
                        {{ Form::token() }}
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('label', 'Наименование:') }}
                                {{ Form::text('label', null, ['class' => 'form-control', 'required']) }}
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
    <div class="alert alert-{{ session('color') }} alert-dismissible col-md-6 fade show" role="alert">
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
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($metals as $metal)
            <tr>
                <td><a href="{{ route('metal.show', ['id' => $metal->id]) }}">{{ $metal->label }}</a></td>
                <td>
                    <a href="" data-toggle="modal" data-target={{ '#modalDelete'.$metal->id }}><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
                    <div class="modal fade" id={{ 'modalDelete'.$metal->id }} tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                {{ Form::open(['route' => ['metal.destroy' , $metal->id], 'method' => 'delete']) }}
                                {{ Form::token() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Вы уверены?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $metals->links() }}
@endsection
