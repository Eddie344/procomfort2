@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-4">Ткани рулонные</h2>
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
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Наименование">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Цвет">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Каталог...</option>
                                    <option>Амиго</option>
                                    <option>Межароль</option>
                                    <option>Прокомфорт</option>
                                    <option>Амилюкс</option>
                                    <option>Гарден</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Категория...</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Ширина">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Направление рисунка...</option>
                                    <option>Вертикальное</option>
                                    <option>Горизонтальне</option>
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
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Наименование</th>
            <th scope="col">Каталог</th>
            <th scope="col">Категория</th>
            <th scope="col">Ширина</th>
            <th scope="col">Направление рисунка</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td><a href="roll_fabric_1.html">L-0800</a></td>
            <td>Амиго</td>
            <td>1</td>
            <td>1,6</td>
            <td>Горизонтальное</td>
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
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td><a href="">L-0810</a></td>
            <td>Амиго</td>
            <td>1</td>
            <td>1,6</td>
            <td>Вертикальное</td>
            <td>
                <a href=""><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
            </td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td><a href="">L-0868</a></td>
            <td>Амиго</td>
            <td>1</td>
            <td>1,6</td>
            <td>Любое</td>
            <td>
                <a href=""><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>
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
@endsection
