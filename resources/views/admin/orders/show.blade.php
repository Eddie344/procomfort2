@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Общая информация о заказе
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-6">№ заказа:</dt>
                        <dd class="col-sm-6">{{ $order->id }}</dd>

                        <dt class="col-sm-6">Заказчик:</dt>
                        <dd class="col-sm-6"><a href="{{ route('customers.show', ['id' => $order->diller->id]) }}">{{ $order->diller->getFullName() }}</a></dd>

                        <dt class="col-sm-6">Префикс заказчика:</dt>
                        <dd class="col-sm-6">{{ $order->prefix }}</dd>

                        <dt class="col-sm-6">Вид изделий:</dt>
                        <dd class="col-sm-6">{{ $order->productType->label }}</dd>

                        <dt class="col-sm-6">Статус:</dt>
                        <dd class="col-sm-6">{{ $order->status->label }}</dd>

                        <dt class="col-sm-6">Создан:</dt>
                        <dd class="col-sm-6">{{ $order->created_at }}</dd>

                        <dt class="col-sm-6">Дата готовности:</dt>
                        <dd class="col-sm-6">28.09.2019</dd>

                        <dt class="col-sm-6">Примечание заказчика:</dt>
                        <dd class="col-sm-6">Положить 600 м нижней цепи и 59 креплений, доставить 26.08</dd>
                    </dl>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#order_edit">
                        Изменить
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="order_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Изменить информацию о заказе</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                {{ Form::open(['route' => ['orders.update', 'id' => $order->id], 'method' => 'put']) }}
                                {{ Form::token() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {{ Form::label('prefix', 'Префикс заказчика:') }}
                                            {{ Form::text('prefix', $order->prefix, ['class' => 'form-control', 'required']) }}
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{ Form::label('status_id', 'Статус:') }}
                                            {{ Form::select('status_id', \App\Models\OrderStatus::pluck('label','id'), $order->status_id, ['class' => 'form-control', 'required'])}}
                                        </div>
                                        <div class="form-group col-md-12">
                                            {{ Form::label('admin_msg', 'Примечание администратора:') }}
                                            {{ Form::textarea('admin_msg', $order->admin_msg, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{ Form::submit('Сохранить', ['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Информация об изделиях
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-6">Количество изделий:</dt>
                        <dd class="col-sm-6">2</dd>

                        <dt class="col-sm-6">Общий объем:</dt>
                        <dd class="col-sm-6">4,4 м<sup>2</sup></dd>

                        <dt class="col-sm-6">Общая стоимость:</dt>
                        <dd class="col-sm-6">26$</dd>

                        <dt class="col-sm-6">Общая себестоимость:</dt>
                        <dd class="col-sm-6">16$</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    Изделия в заказе
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#goriz_add">
                                Добавить горизонт
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="goriz_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="goriz_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="goriz_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="goriz_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Цвет фурнитуры</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Белый</option>
                                                        <option>Коричневый</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество ламелей</label>
                                                    <input disabled type="number" class="form-control" id="goriz_lamel_number" value="0">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Нижняя фиксация</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Расцветка</label>
                                                    <select class="form-control" id="goriz_rascvetka">
                                                        <option value="Standart" selected>Стандарт</option>
                                                        <option value="Own">Свой вариант</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="goriz_color">
                                                    <label for="exampleInputEmail1">Лента</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option></option>
                                                        <option>1325</option>
                                                        <option>1322</option>
                                                        <option>1335</option>
                                                        <option>5325</option>
                                                        <option>1535</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row" id="goriz_own_color" style="display: none;">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#vert_add">
                                Добавить вертикалку
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="vert_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="vert_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="vert_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                        <option>Двойное</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="vert_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество ламелей</label>
                                                    <input disabled type="number" class="form-control" id="vert_lamel_number" value="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Комплектация</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Целое изделие</option>
                                                        <option>Только ткань</option>
                                                        <option>Только карниз</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Крепление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Потолок</option>
                                                        <option>Стена</option>
                                                        <option>Армстронг</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество креплений</label>
                                                    <input type="number" class="form-control" id="vert_rule_number" value="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Расцветка</label>
                                                    <select class="form-control" id="vert_rascvetka">
                                                        <option value="Standart" selected>Стандарт</option>
                                                        <option value="Own">Свой вариант</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="vert_cloth">
                                                    <label for="exampleInputEmail1">Ткань</label>
                                                    <select class="form-control" id="vert_cloth_select">
                                                        <option></option>
                                                        <option value="line_color">Лайн</option>
                                                        <option value="keln_color">Кельн</option>
                                                        <option value="malta_color">Мальта</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="vert_color">
                                                    <label for="exampleInputEmail1">Цвет ткани</label>
                                                    <select class="form-control" id="vert_color_select">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Арка</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row" id="vert_own_color" style="display: none;">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#rol_mini_add">
                                Добавить рулонку мини
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="rol_mini_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="rol_mini_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="rol_mini_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="rol_mini_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Комплектация</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Целое изделие</option>
                                                        <option>Только ткань</option>
                                                        <option>Только карниз</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="rol_mini_cloth">
                                                    <label for="exampleInputEmail1">Ткань</label>
                                                    <select class="form-control" id="rol_mini_cloth_select">
                                                        <option></option>
                                                        <option value="l_color">L</option>
                                                        <option value="n_color">N</option>
                                                        <option value="zh_color">ZH</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="rol_mini_color">
                                                    <label for="exampleInputEmail1">Цвет ткани</label>
                                                    <select class="form-control" id="rol_mini_color_select">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Фиксатор цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Натяжитель цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Леска</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Магниты</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Крепление без сверления</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Цвет фурнитуры</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Стандарт</option>
                                                        <option>Коричневый</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#zebra_mini_add">
                                Добавить зебра мини
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="zebra_mini_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="zebra_mini_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="zebra_mini_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="zebra_mini_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Комплектация</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Целое изделие</option>
                                                        <option>Только ткань</option>
                                                        <option>Только карниз</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_cloth">
                                                    <label for="exampleInputEmail1">Ткань</label>
                                                    <select class="form-control" id="zebra_mini_cloth_select">
                                                        <option></option>
                                                        <option value="l_color">L</option>
                                                        <option value="n_color">N</option>
                                                        <option value="zh_color">ZH</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_color">
                                                    <label for="exampleInputEmail1">Цвет ткани</label>
                                                    <select class="form-control" id="zebra_mini_color_select">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Фиксатор цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Натяжитель цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Леска</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                                        <label class="form-check-label" for="exampleCheck1">Крепление без сверления</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Цвет фурнитуры</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Стандарт</option>
                                                        <option>Коричневый</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#uni12_add">
                                Добавить уни1 и уни2
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="uni12_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="zebra_mini_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="zebra_mini_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="zebra_mini_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Комплектация</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Целое изделие</option>
                                                        <option>Только ткань</option>
                                                        <option>Только карниз</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_cloth">
                                                    <label for="exampleInputEmail1">Ткань</label>
                                                    <select class="form-control" id="zebra_mini_cloth_select">
                                                        <option></option>
                                                        <option value="l_color">L</option>
                                                        <option value="n_color">N</option>
                                                        <option value="zh_color">ZH</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_color">
                                                    <label for="exampleInputEmail1">Цвет ткани</label>
                                                    <select class="form-control" id="zebra_mini_color_select">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Фиксатор цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Натяжитель цепи</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Цвет фурнитуры</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Стандарт</option>
                                                        <option>Коричневый</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Тип замера (uni1):</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>По габариту</option>
                                                        <option>По ткани</option>
                                                        <option>По изгибу</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3 col-md-3">
                            <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#d25_add">
                                Добавить mgs, d25, d35
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="d25_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Новое изделие</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Ширина</label>
                                                    <input type="number" class="form-control" id="zebra_mini_width" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Высота</label>
                                                    <input type="number" class="form-control" id="zebra_mini_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Управление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Правое</option>
                                                        <option>Левое</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Длина управления</label>
                                                    <input type="number" class="form-control" id="zebra_mini_rule_height" placeholder="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Каталог</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Амиго</option>
                                                        <option>Межароль</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_cloth">
                                                    <label for="exampleInputEmail1">Ткань</label>
                                                    <select class="form-control" id="zebra_mini_cloth_select">
                                                        <option></option>
                                                        <option value="l_color">L</option>
                                                        <option value="n_color">N</option>
                                                        <option value="zh_color">ZH</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6" id="zebra_mini_color">
                                                    <label for="exampleInputEmail1">Цвет ткани</label>
                                                    <select class="form-control" id="zebra_mini_color_select">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Монтажный профиль</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1">Короб прикрытия</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Крепление</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Потолок</option>
                                                        <option>Стена</option>
                                                        <option>Армстронг</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество креплений</label>
                                                    <input type="number" class="form-control" id="vert_rule_number" value="0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Цвет фурнитуры</label>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Стандарт</option>
                                                        <option>Коричневый</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Количество изделий</label>
                                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="1">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleFormControlTextarea1">Примечание</label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Ширина</th>
                            <th scope="col">Высота</th>
                            <th scope="col">Управление</th>
                            <th scope="col">Ткань</th>
                            <th scope="col">Объем</th>
                            <th scope="col">Стоимость</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1,2 м</td>
                            <td>1,6 м</td>
                            <td>Левое</td>
                            <td>L-0800</td>
                            <td>2,3 м<sup>2</sup></td>
                            <td>16$</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#modalDelete"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
                                <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Вы уверены?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger">Удалить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"><h5 class="d-inline"><i class="fa fa-pencil text-success"></i></h5></a>
                                <a href="#"><h5 class="d-inline"><i class="fa fa-expand text-primary"></i></h5></a>
                            </td>
                        </tr>
                        <tr>
                            <td>1,4 м</td>
                            <td>1,5 м</td>
                            <td>Правое</td>
                            <td>L-0800</td>
                            <td>2,1 м<sup>2</sup></td>
                            <td>16$</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#modalDelete"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
                                <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Вы уверены?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger">Удалить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"><h5 class="d-inline"><i class="fa fa-pencil text-success"></i></h5></a>
                                <a href="#"><h5 class="d-inline"><i class="fa fa-expand text-primary"></i></h5></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
