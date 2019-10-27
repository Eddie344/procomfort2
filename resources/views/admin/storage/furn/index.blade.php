@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Фурнитура</h2>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#exampleModalCenter">
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
                    {{ Form::open(['route' => 'furn.store']) }}
                    {{ Form::token() }}
                    <div class="modal-body">
                        <div class="form-group">
                            {{ Form::label('label', 'Наименование:') }}
                            {{ Form::text('label', null, ['class' => 'form-control', 'required']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('unit', 'Единица измерения:') }}
                            {{ Form::text('unit', null, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Фильтр
            </button>
            <div class="dropdown-menu p-3" style="width: 250px" aria-labelledby="dropdownMenuButton">
                {{ Form::open(['route' => 'furn.index', 'method' => 'get', 'class' => '']) }}
                <div class="form-group">
                    {{ Form::label('label', 'Наименование:') }}
                    {{ Form::text('label', Request::get('label'), ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('unit', 'Единица измерения:') }}
                    {{ Form::text('unit', Request::get('unit'), ['class' => 'form-control'])}}
                </div>
                {{ Form::submit('Применить', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
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
            <th scope="col">Единица измерения</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($furns as $furn)
            <tr>
                <td><a href="{{ route('furn.show', ['id' => $furn->id]) }}">{{ $furn->label }}</a></td>
                <td>{{ $furn->unit }}</td>
                <td>
                    <a href="" data-toggle="modal" data-target={{ '#modalDelete'.$furn->id }}><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
                    <div class="modal fade" id={{ 'modalDelete'.$furn->id }} tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                {{ Form::open(['route' => ['furn.destroy' , $furn->id], 'method' => 'delete']) }}
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
    {{ $furns->links() }}
@endsection
