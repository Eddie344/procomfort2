@extends('admin.layouts.app')

@section('content')
    <div class="row mb-2">


    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Общая информация
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-6">Наименование:</dt>
                        <dd class="col-sm-6"><h4>{{ $storage->label }}</h4></dd>

                        <dt class="col-sm-6">Категория:</dt>
                        <dd class="col-sm-6">{{ $storage->categoriable_id }}</dd>

                        <dt class="col-sm-6">Направление рисунка:</dt>
                        <dd class="col-sm-6">Горизонтальное</dd>

                    </dl>
                    <button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#order_edit">
                        Изменить информацию
                    </button>
                    <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#add-part">
                        Добавить партию
                    </button>

                    <button type="button" class="btn btn-secondary my-1" data-toggle="modal" data-target="#add-fragment">
                        Добавить фрагмент
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="order_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Изменить информацию</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Наименование:</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="L-0880">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Категория:</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option selected>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Направление рисунка:</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>Вертикальное</option>
                                            <option selected>Горизонтальное</option>
                                            <option>Любое</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal-1 -->
                    <div class="modal fade" id="add-part" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Добавление партии</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поставщик">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Цена">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Длина">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <small>Сложить с существующей партией, если цена одинакова</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Добавить</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal-2 -->
                    <div class="modal fade" id="add-fragment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Добавление фрагмента</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Поставщик">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Цена">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Ширина">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Длина">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Добавить</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal-3 -->
                    <div class="modal fade" id="minus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Списание остатка</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Ширина">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Длина">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Причина">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Списать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Поставщик</th>
            <th scope="col">Цена</th>
            <th scope="col">Ширина</th>
            <th scope="col">Длина</th>
            <th scope="col">Статус</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Амиго</td>
            <td>3,6</td>
            <td>1,6</td>
            <td>12</td>
            <td class="table-primary">В работе</td>
            <td><a href="#" data-toggle="modal" data-target="#minus">Списать</a></td>
        </tr>
        <tr>
            <td>Амиго</td>
            <td>3,6</td>
            <td>0,5</td>
            <td>1,8</td>
            <td class="table-secondary">Фрагмент</td>
            <td><a href="">Списать</a></td>
        </tr>
        <tr>
            <td>Амиго</td>
            <td>3,6</td>
            <td>1,0</td>
            <td>1,8</td>
            <td class="table-secondary">Фрагмент</td>
            <td><a href="">Списать</a></td>
        </tr>
        <tr>
            <td>Амиго</td>
            <td>3,6</td>
            <td>1,3</td>
            <td>1,2</td>
            <td class="table-secondary">Фрагмент</td>
            <td><a  href="">Списать</a></td>
        </tr>
        <tr>
            <td>Межароль</td>
            <td>3,8</td>
            <td>1,6</td>
            <td>32</td>
            <td class="table-warning">Ожидание</td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <div class="mt-5 mb-3">
        <div class="operations mb-2 d-flex flex-row align-items-center justify-content-between">
            <h4>Операции</h4>
            <form>
                <div class="input-group">
                    <input type="text" name="date_period" class="form-control" id="exampleInputPassword1" placeholder="Сортировка по датам">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">Показать</button>
                    </div>
                </div>
            </form>
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item list-group-item-success">Приход: <strong>156 м</strong></li>
                <li class="list-group-item list-group-item-danger">Расход: <strong>65 м</strong></li>
            </ul>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Действие</th>
                <th scope="col">Причина</th>
                <th scope="col">Пользователь</th>
                <th scope="col">Ширина</th>
                <th scope="col">Длина</th>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td class="table-danger">Списание</td>
                <td>Заказ №32</td>
                <td>КФ</td>
                <td>0,8</td>
                <td>1,3</td>
                <td>28.08.19</td>
                <td>12:50</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td class="table-danger">Списание</td>
                <td>Заказ №32</td>
                <td>КФ</td>
                <td>0,8</td>
                <td>1,3</td>
                <td>28.08.19</td>
                <td>12:50</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td class="table-danger">Списание</td>
                <td>Заказ №32</td>
                <td>КФ</td>
                <td>1,0</td>
                <td>1,3</td>
                <td>28.08.19</td>
                <td>12:50</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td class="table-danger">Списание</td>
                <td>Брак</td>
                <td>Сергей</td>
                <td>0,9</td>
                <td>1,1</td>
                <td>28.08.19</td>
                <td>12:50</td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td class="table-success">Пополнение</td>
                <td>Партия Амиго</td>
                <td>Саша</td>
                <td>1,6</td>
                <td>30</td>
                <td>28.08.19</td>
                <td>12:50</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
