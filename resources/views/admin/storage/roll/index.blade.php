@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Ткани рулонные</h2>
    <div class="row mb-2">
        {{ Form::open(['route' => 'roll.index']) }}
        {{ Form::token() }}
        <div class="input-group col-md-9">
            {{ Form::select('catalog_id', \App\Models\Catalog::pluck('label','id'), null, ['placeholder' => 'Выберите каталог...', 'class' => 'form-control'])}}
            {{ Form::select('category_id', \App\Models\RollCategory::pluck('label','id'), null, ['placeholder' => 'Выберите категорию...', 'class' => 'form-control'])}}
            {{ Form::select('picture_id', \App\Models\RollPicture::pluck('label','id'), null, ['placeholder' => 'Выберите направление рисунка...', 'class' => 'form-control'])}}
            <div class="input-group-append mb-3">
                {{ Form::submit('Применить', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        {{ Form::close() }}
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
                        {{ Form::open(['route' => 'roll.store']) }}
                        {{ Form::token() }}
                        <div class="modal-body">
                            <div class="form-group">
                                {{ Form::label('label', 'Наименование:') }}
                                {{ Form::text('label', null, ['class' => 'form-control', 'required']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('catalog_id', 'Каталог:') }}
                                {{ Form::select('catalog_id', \App\Models\Catalog::pluck('label','id'), null, ['placeholder' => 'Выберите каталог...', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('category_id', 'Категория:') }}
                                {{ Form::select('category_id', \App\Models\RollCategory::pluck('label', 'id'), null, ['placeholder' => 'Выберите категорию...', 'class' => 'form-control', 'required'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('picture_id', 'Направление рисунка:') }}
                                {{ Form::select('picture_id', \App\Models\RollPicture::pluck('label', 'id'), null, ['placeholder' => 'Выберите направление рисунка...', 'class' => 'form-control', 'required'])}}
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
            <th scope="col">Каталог</th>
            <th scope="col">Категория</th>
            <th scope="col">Направление рисунка</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rolls as $roll)
            <tr>
                <td><a href="{{ route('roll.show', ['id' => $roll->id]) }}">{{ $roll->label }}</a></td>
                <td>{{ $roll->catalog->label }}</td>
                <td>{{ $roll->category->id }}</td>
                <td>{{ $roll->picture->label }}</td>
                <td>
                    <a href="" data-toggle="modal" data-target={{ '#modalDelete'.$roll->id }}><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
                    <div class="modal fade" id={{ 'modalDelete'.$roll->id }} tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                {{ Form::open(['route' => ['roll.destroy' , $roll->id], 'method' => 'delete']) }}
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
    {{ $rolls->links() }}
@endsection
