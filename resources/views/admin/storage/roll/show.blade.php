@extends('admin.layouts.app')

@section('content')
    <roll-storage-single-component id="{{ $id }}"></roll-storage-single-component>
{{--    <div class="row mb-3">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    Общая информация--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success alert-dismissible col-md-12 fade show" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <dl class="row">--}}
{{--                        <dt class="col-sm-6">Наименование:</dt>--}}
{{--                        <dd class="col-sm-6"><h4>{{ $roll->label }}</h4></dd>--}}

{{--                        <dt class="col-sm-6">Каталог:</dt>--}}
{{--                        <dd class="col-sm-6">{{ $roll->catalog->label }}</dd>--}}

{{--                        <dt class="col-sm-6">Категория:</dt>--}}
{{--                        <dd class="col-sm-6">{{ $roll->category->label }}</dd>--}}

{{--                        <dt class="col-sm-6">Направление рисунка:</dt>--}}
{{--                        <dd class="col-sm-6">{{ $roll->picture->label }}</dd>--}}

{{--                    </dl>--}}
{{--                    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#order_edit">--}}
{{--                        Изменить--}}
{{--                    </button>--}}

{{--                    <!-- Modal -->--}}
{{--                    <div class="modal fade" id="order_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                        <div class="modal-dialog modal-sm" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title" id="exampleModalLongTitle">Изменить информацию</h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                {{ Form::open(['route' => ['roll.update', $roll->id], 'method' => 'put']) }}--}}
{{--                                {{ Form::token() }}--}}
{{--                                <div class="modal-body">--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('label', 'Наименование:') }}--}}
{{--                                        {{ Form::text('label', $roll->label, ['class' => 'form-control', 'required']) }}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('catalog_id', 'Каталог:') }}--}}
{{--                                        {{ Form::select('catalog_id', \App\Models\Catalog::pluck('label','id'), $roll->catalog_id, ['placeholder' => 'Выберите каталог...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('category_id', 'Категория:') }}--}}
{{--                                        {{ Form::select('category_id', \App\Models\RollCategory::pluck('label', 'id'), $roll->category_id, ['placeholder' => 'Выберите категорию...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('picture_id', 'Направление рисунка:') }}--}}
{{--                                        {{ Form::select('picture_id', \App\Models\RollPicture::pluck('label', 'id'), $roll->picture_id, ['placeholder' => 'Выберите направление рисунка...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}--}}
{{--                                </div>--}}
{{--                                {{ Form::close() }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card mt-4">--}}
{{--                <div class="card-header">Партии и остатки</div>--}}
{{--                <div class="card-body">--}}
{{--                    @if (session('part_status'))--}}
{{--                        <div class="alert alert-{{ session('part_color') }} alert-dismissible col-md-6 fade show" role="alert">--}}
{{--                            {{ session('part_status') }}--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <table class="table table-striped">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="col">Ширина</th>--}}
{{--                            <th scope="col">Длина</th>--}}
{{--                            <th scope="col">Цена</th>--}}
{{--                            <th scope="col">Поставщик</th>--}}
{{--                            <th scope="col">Тип</th>--}}
{{--                            <th scope="col">Статус</th>--}}
{{--                            <th scope="col">Действия</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($parts as $part)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $part->width }}</td>--}}
{{--                                <td>{{ $part->lenght }}</td>--}}
{{--                                <td>{{ $part->price }}</td>--}}
{{--                                <td>{{ $part->provider->label }}</td>--}}
{{--                                <td>{{ $part->type->label }}</td>--}}
{{--                                <td><strong class="text-{{ $part->status->color }}">{{ $part->status->label }}</strong></td>--}}
{{--                                <td>--}}
{{--                                    <a href="#" data-toggle="modal" data-target="#edit_{{ $part->id }}"><i class="fa fa-arrow-down text-secondary"></i></a>--}}
{{--                                    <!-- Списать -->--}}
{{--                                    <div class="modal fade" id="edit_{{ $part->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h5 class="modal-title" id="exampleModalLongTitle">Списание остатка</h5>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                {{ Form::open(['route' => ['roll_part.update', $part->id], 'method' => 'put']) }}--}}
{{--                                                {{ Form::token() }}--}}
{{--                                                {{ Form::hidden('roll_storage_id', $roll->id) }}--}}
{{--                                                {{ Form::hidden('price', $part->price) }}--}}
{{--                                                {{ Form::hidden('provider', $part->provider_id) }}--}}
{{--                                                {{ Form::hidden('type_id', 2) }}--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        {{ Form::label('width', 'Ширина:') }}--}}
{{--                                                        {{ Form::number('width', null, ['class' => 'form-control', 'step' => "0.001", 'required']) }}--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        {{ Form::label('lenght', 'Длина:') }}--}}
{{--                                                        {{ Form::number('lenght', null, ['class' => 'form-control', 'step' => "0.001", 'required']) }}--}}
{{--                                                    </div>--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        {{ Form::label('reason', 'Причина:') }}--}}
{{--                                                        {{ Form::text('reason', null, ['class' => 'form-control', 'required']) }}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    {{ Form::submit('Списать', ['class' => 'btn btn-primary']) }}--}}
{{--                                                </div>--}}
{{--                                                {{ Form::close() }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <a href="" data-toggle="modal" data-target="#delete_{{ $part->id }}"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>--}}
{{--                                    <div class="modal fade" id="delete_{{ $part->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">--}}
{{--                                            <div class="modal-content">--}}
{{--                                                {{ Form::open(['route' => ['roll_part.destroy' , $part->id], 'method' => 'delete']) }}--}}
{{--                                                {{ Form::token() }}--}}
{{--                                                {{ Form::hidden('roll_storage_id', $roll->id) }}--}}
{{--                                                {{ Form::hidden('width', $part->width) }}--}}
{{--                                                {{ Form::hidden('lenght', $part->lenght) }}--}}
{{--                                                {{ Form::hidden('type_id', 2) }}--}}
{{--                                                <div class="modal-header">--}}
{{--                                                    <h5 class="modal-title" id="exampleModalLongTitle">Удаление</h5>--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-body">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        {{ Form::label('reason', 'Укажите причину:') }}--}}
{{--                                                        {{ Form::text('reason', null, ['class' => 'form-control', 'required']) }}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="modal-footer">--}}
{{--                                                    {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}--}}
{{--                                                </div>--}}
{{--                                                {{ Form::close() }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#add-part">--}}
{{--                        Добавить--}}
{{--                    </button>--}}
{{--                    <!-- Добавить -->--}}
{{--                    <div class="modal fade" id="add-part" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title" id="exampleModalLongTitle">Добавление партии</h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <span aria-hidden="true">&times;</span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                {{ Form::open(['route' => 'roll_part.store']) }}--}}
{{--                                {{ Form::token() }}--}}
{{--                                {{ Form::hidden('roll_storage_id', $roll->id) }}--}}
{{--                                <div class="modal-body">--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('type_id', 'Тип предмета:') }}--}}
{{--                                        {{ Form::select('type_id', \App\Models\PartType::pluck('label','id'), null, ['placeholder' => 'Выберите тип предмета...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('width', 'Ширина:') }}--}}
{{--                                        {{ Form::number('width', null, ['class' => 'form-control', 'step' => "0.001", 'required']) }}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('lenght', 'Длина:') }}--}}
{{--                                        {{ Form::number('lenght', null, ['class' => 'form-control', 'step' => "0.001", 'required']) }}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('price', 'Цена:') }}--}}
{{--                                        {{ Form::number('price', null, ['class' => 'form-control', 'step' => "0.01", 'required']) }}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('provider_id', 'Поставщик:') }}--}}
{{--                                        {{ Form::select('provider_id', \App\Models\Provider::pluck('label','id'), null, ['placeholder' => 'Выберите поставщика...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('reason', 'Причина:') }}--}}
{{--                                        {{ Form::text('reason', null, ['class' => 'form-control', 'required']) }}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        {{ Form::label('status_id', 'Статус:') }}--}}
{{--                                        {{ Form::select('status_id', \App\Models\PartStatus::pluck('label','id'), null, ['placeholder' => 'Выберите статус предмета...', 'class' => 'form-control', 'required'])}}--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">--}}
{{--                                        <label class="form-check-label" for="defaultCheck1">--}}
{{--                                            <small>Сложить с существующей партией, если цена одинакова</small>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}--}}
{{--                                </div>--}}
{{--                                {{ Form::close() }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card mt-4">--}}
{{--                <div class="card-header">Операции</div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row mb-4">--}}
{{--                        <div class="col-md-9">--}}
{{--                            <form id="date_container">--}}
{{--                                <div class="input-group">--}}
{{--                                    {{ Form::open(['route' => ['roll.index', $roll->id], 'method' => 'get']) }}--}}
{{--                                    {{ Form::select('type', \App\Models\StorageActionType::pluck('label','id'), Request::get('type'), ['placeholder' => 'Тип действия...', 'class' => 'form-control'])}}--}}
{{--                                    {{ Form::text('date_period', Request::get('date_period'), ['placeholder' => 'Сортировка по датам', 'class' => 'form-control', 'autocomplete' => 'off'])}}--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        {{ Form::submit('Показать', ['class' => 'btn btn-primary']) }}--}}
{{--                                    </div>--}}
{{--                                    {{ Form::close() }}--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <ul class="list-group list-group-horizontal col-md-6">--}}
{{--                            <li class="list-group-item list-group-item-success">Приход: <strong>156 м</strong></li>--}}
{{--                            <li class="list-group-item list-group-item-danger">Расход: <strong>65 м</strong></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <table class="table table-hover">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th scope="col">Действие</th>--}}
{{--                            <th scope="col">Пользователь</th>--}}
{{--                            <th scope="col">Причина</th>--}}
{{--                            <th scope="col">Ширина</th>--}}
{{--                            <th scope="col">Длина</th>--}}
{{--                            <th scope="col">Дата</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($actions as $action)--}}
{{--                            <tr>--}}
{{--                                <td class="table-{{ $action->type->color }}">{{ $action->type->label }}</td>--}}
{{--                                <td>{{ $action->user->alias }}</td>--}}
{{--                                <td>{{ $action->reason }}</td>--}}
{{--                                <td>{{ $action->width }}</td>--}}
{{--                                <td>{{ $action->lenght }}</td>--}}
{{--                                <td>{{ $action->created_at }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    {{ $actions->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
