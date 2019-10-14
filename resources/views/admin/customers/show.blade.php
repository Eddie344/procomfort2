@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Общая информация о пользователе
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$user->name}} {{$user->surname}}</h4>

                    <dl class="row">
                        <dt class="col-sm-5">Псевдоним:</dt>
                        <dd class="col-sm-7">{{$user->alias}}</dd>

                        <dt class="col-sm-5">Город:</dt>
                        <dd class="col-sm-7">{{$user->city}}</dd>

                        <dt class="col-sm-5">E-mail:</dt>
                        <dd class="col-sm-7">{{$user->email}}</dd>

                        <dt class="col-sm-5">Телефон:</dt>
                        <dd class="col-sm-7">{{$user->phone}}</dd>

                        <dt class="col-sm-5">Реквизиты:</dt>
                        <dd class="col-sm-7">р/с 3602916010009, код 795, УНП 100437065</dd>
                    </dl>

                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Информация о заказах
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Все заказы:</dt>
                        <dd class="col-sm-7">139</dd>

                        <dt class="col-sm-5">Выполненные:</dt>
                        <dd class="col-sm-7">100</dd>

                        <dt class="col-sm-5">В работе:</dt>
                        <dd class="col-sm-7">4</dd>

                        <dt class="col-sm-5">Черновики:</dt>
                        <dd class="col-sm-7">2</dd>
                    </dl>
                    <a class="btn btn-primary" href="#" role="button">Заказы пользователя</a>

                </div>
            </div>
        </div>
        <div class="col-md-10 mt-4">
            <div class="card">
                <div class="card-header">
                    Баланс и операции
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-center">
                            <p><strong>Текущий баланс:</strong> {{$user->balance}}$</p>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <p><strong>Баланс с заказами в работе:</strong> 180$</p>
                        </div>
                        <div class="input-group mb-3 col-md-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                Пополнить
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Пополнение баланса</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Сумма">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary">Пополнить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1">
                                <option>Операция...</option>
                                <option>Пополнение</option>
                                <option>Списание</option>
                            </select>
                        </div>
                        <form>
                            <div class="input-group" id="date_container">
                                <input type="text" name="date_period" class="form-control" placeholder="Сортировка по датам">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="button-addon2">Показать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Операция</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Причина</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Время</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td class="table-success">Пополнение</td>
                            <td>100$</td>
                            <td></td>
                            <td>28.08.19</td>
                            <td>12:50</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td class="table-danger">Списание</td>
                            <td>45$</td>
                            <td>Заказ №156</td>
                            <td>28.08.19</td>
                            <td>12:50</td>
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
