<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/cabinet')->middleware('islogged', 'redirectfrommain');


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->middleware('islogged', 'isadmin')->group(function () {
    Route::view('/', 'admin.home')->name('admin');
    Route::view('rollstorage', 'admin.storage.roll')->name('rollstorage');
    Route::resource('customers', 'UserController');
    Route::resource('orders', 'OrderController');
    Route::prefix('storage')->group(function () {
        Route::get('/', 'StorageController@index')->name('storage.index');

        Route::resource('roll_part', 'RollPartsStorageController');
        Route::resource('roll', 'RollStorageController')->except(['create', 'edit']);

        Route::resource('zebra_part', 'ZebraPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('zebra', 'ZebraStorageController')->except(['create', 'edit']);

        Route::resource('vert_part', 'VertPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('vert', 'VertStorageController')->except(['create', 'edit']);

        Route::resource('goriz_part', 'GorizPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('goriz', 'GorizStorageController')->except(['create', 'edit']);

        Route::resource('metal_part', 'MetalPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('metal', 'MetalStorageController')->except(['create', 'edit']);

        Route::resource('furn_part', 'FurnPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('furn', 'FurnStorageController')->except(['create', 'edit']);
    });
    Route::prefix('/price')->group(function () {
        Route::view('/', 'admin.prices.nav')->name('price.index');
        //Рулонные
        Route::apiResource('/roll', 'RollPriceController', [
            'names' => [
                'index' => 'price.roll.index',
                'show' => 'price.roll.show',
            ]
        ]);
        Route::post('/roll/get', 'RollPriceController@get')->name('price.roll.get');
        //Зебра
        Route::apiResource('/zebra', 'ZebraPriceController', [
            'names' => [
                'index' => 'price.zebra.index',
                'show' => 'price.zebra.show',
            ]
        ]);
        Route::post('/zebra/get', 'ZebraPriceController@get')->name('price.zebra.get');
        //Вертикалка
        Route::apiResource('/vert', 'VertPriceController', [
            'names' => [
                'index' => 'price.vert.index',
                'show' => 'price.vert.show',
            ]
        ]);
        Route::post('/vert/get', 'VertPriceController@get')->name('price.vert.get');
        //Вертикалка
        Route::apiResource('/goriz', 'GorizPriceController', [
            'names' => [
                'index' => 'price.goriz.index',
                'show' => 'price.goriz.show',
            ]
        ]);
        Route::post('/goriz/get', 'GorizPriceController@get')->name('price.goriz.get');
        //Доп. комплектация
        Route::apiResource('/add', 'AddPriceController', [
            'names' => [
                'index' => 'price.add.index',
                'show' => 'price.add.show',
            ]
        ]);
        Route::post('/add/get', 'AddPriceController@get')->name('price.add.get');
    });
    Route::prefix('/other')->group(function () {
        Route::prefix('/constructions')->group(function () {
            Route::apiResource('/roll', 'RollConstructionController');
            Route::post('/roll/get', 'RollConstructionController@get')->name('other.constructions.roll.get');
            Route::apiResource('/zebra', 'ZebraConstructionController');
            Route::post('/zebra/get', 'ZebraConstructionController@get')->name('other.constructions.zebra.get');
        });
        Route::prefix('/categories')->group(function () {
            Route::apiResource('/roll', 'RollCategoryController');
            Route::post('/roll/get', 'RollCategoryController@get')->name('other.categories.roll.get');
            Route::apiResource('/zebra', 'ZebraCategoryController');
            Route::post('/zebra/get', 'ZebraCategoryController@get')->name('other.categories.zebra.get');
            Route::apiResource('/vert', 'VertCategoryController');
            Route::post('/vert/get', 'VertCategoryController@get')->name('other.categories.vert.get');
            Route::apiResource('/goriz', 'GorizCategoryController');
            Route::post('/goriz/get', 'GorizCategoryController@get')->name('other.categories.goriz.get');
        });
        Route::apiResource('/catalogs', 'CatalogController');
        Route::post('/catalogs/get', 'CatalogController@get')->name('other.catalogs.get');

    });
});

Route::prefix('cabinet')->middleware('islogged', 'iscustomer')->group(function () {
    Route::get('/', function () {
        echo 'Кабинет';
    })->name('cabinet');
});
