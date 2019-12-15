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

    Route::resource('users', 'UserController');
    Route::post('/users/getAll', 'UserController@getAll');
    Route::post('/users/get/{id}', 'UserController@get');
    Route::resource('users/operations', 'UserBalanceOperationController');
    Route::post('users/operations/getAll', 'UserBalanceOperationController@getAll');

    Route::resource('orders', 'OrderController');
    Route::prefix('storage')->group(function () {
        Route::get('/', 'StorageController@index')->name('storage.index');

        Route::apiResource('roll', 'RollStorageController');
        Route::post('/roll/getAll', 'RollStorageController@getAll');
        Route::post('/roll/get/{id}', 'RollStorageController@get');
        Route::apiResource('roll_parts', 'RollPartsStorageController');
        Route::post('/roll_parts/getAll', 'RollPartsStorageController@getAll');
        Route::apiResource('roll_actions', 'RollActionsStorageController');
        Route::post('/roll_actions/getAll', 'RollActionsStorageController@getAll');

        Route::apiResource('zebra', 'ZebraStorageController');
        Route::post('/zebra/getAll', 'ZebraStorageController@getAll');
        Route::post('/zebra/get/{id}', 'ZebraStorageController@get');
        Route::apiResource('zebra_parts', 'ZebraPartsStorageController');
        Route::post('/zebra_parts/getAll', 'ZebraPartsStorageController@getAll');
        Route::apiResource('zebra_actions', 'ZebraActionsStorageController');
        Route::post('/zebra_actions/getAll', 'ZebraActionsStorageController@getAll');

        Route::apiResource('vert', 'VertStorageController');
        Route::post('/vert/getAll', 'VertStorageController@getAll');
        Route::post('/vert/get/{id}', 'VertStorageController@get');
        Route::apiResource('vert_parts', 'VertPartsStorageController');
        Route::post('/vert_parts/getAll', 'VertPartsStorageController@getAll');
        Route::apiResource('vert_actions', 'VertActionsStorageController');
        Route::post('/vert_actions/getAll', 'VertActionsStorageController@getAll');

        Route::apiResource('goriz', 'GorizStorageController');
        Route::post('/goriz/getAll', 'GorizStorageController@getAll');
        Route::post('/goriz/get/{id}', 'GorizStorageController@get');
        Route::apiResource('goriz_parts', 'GorizPartsStorageController');
        Route::post('/goriz_parts/getAll', 'GorizPartsStorageController@getAll');
        Route::apiResource('goriz_actions', 'GorizActionsStorageController');
        Route::post('/goriz_actions/getAll', 'GorizActionsStorageController@getAll');

        Route::apiResource('metal', 'MetalStorageController');
        Route::post('/metal/getAll', 'MetalStorageController@getAll');
        Route::post('/metal/get/{id}', 'MetalStorageController@get');
        Route::apiResource('metal_parts', 'MetalPartsStorageController');
        Route::post('/metal_parts/getAll', 'MetalPartsStorageController@getAll');
        Route::apiResource('metal_actions', 'MetalActionsStorageController');
        Route::post('/metal_actions/getAll', 'MetalActionsStorageController@getAll');

        Route::apiResource('furn', 'FurnStorageController');
        Route::post('/furn/getAll', 'FurnStorageController@getAll');
        Route::post('/furn/get/{id}', 'FurnStorageController@get');
        Route::apiResource('furn_parts', 'FurnPartsStorageController');
        Route::post('/furn_parts/getAll', 'FurnPartsStorageController@getAll');
        Route::apiResource('furn_actions', 'FurnActionsStorageController');
        Route::post('/furn_actions/getAll', 'FurnActionsStorageController@getAll');
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
        Route::apiResource('/construction_types', 'ConstructionTypeController', [
        'names' => [
            'index' => 'construction_types.index',
            'show' => 'construction_types.show',
            ]
        ]);
        Route::post('/construction_types/get', 'ConstructionTypeController@get')->name('other.constructions.get');

        Route::apiResource('/picture_types', 'PictureTypeController', [
            'names' => [
                'index' => 'picture_types.index',
                'show' => 'picture_types.show',
            ]
        ]);
        Route::post('/picture_types/get', 'PictureTypeController@get')->name('other.picture_types.get');

        Route::apiResource('/product_types', 'ProductTypeController', [
            'names' => [
                'index' => 'product_types.index',
                'show' => 'product_types.show',
            ]
        ]);
        Route::post('/product_types/get', 'ProductTypeController@get')->name('other.product_types.get');

        Route::prefix('/categories')->group(function () {
            Route::get('/', 'CategoryController@index')->name('other.categories.index');
            Route::apiResource('/roll', 'RollCategoryController', [
            'names' => [
                'index' => 'categories.roll.index',
				'show' => 'categories.roll.show',
            ]
        ]);
            Route::post('/roll/get', 'RollCategoryController@get')->name('other.categories.roll.get');
            Route::apiResource('/zebra', 'ZebraCategoryController', [
            'names' => [
                'index' => 'categories.zebra.index',
				'show' => 'categories.zebra.show',
            ]
        ]);
            Route::post('/zebra/get', 'ZebraCategoryController@get')->name('other.categories.zebra.get');
        });
        Route::apiResource('/catalogs', 'CatalogController', [
            'names' => [
                'index' => 'other.catalogs.index',
                'show' => 'other.catalogs.show',
            ]
        ]);
        Route::post('/catalogs/get', 'CatalogController@get')->name('other.catalogs.get');
        Route::apiResource('/part_types', 'PartTypeController', [
            'names' => [
                'index' => 'part_types.index',
                'show' => 'part_types.show',
            ]
        ]);
        Route::post('/part_types/get', 'PartTypeController@get')->name('other.part_types.get');

        Route::apiResource('/part_statuses', 'PartStatusController', [
            'names' => [
                'index' => 'part_statuses.index',
                'show' => 'part_statuses.show',
            ]
        ]);
        Route::post('/part_statuses/get', 'PartStatusController@get')->name('other.part_statuses.get');

        Route::apiResource('/providers', 'ProviderController', [
            'names' => [
                'index' => 'other.providers.index',
                'show' => 'part_types.show',
            ]
        ]);
        Route::post('/providers/get', 'ProviderController@get')->name('other.providers.get');

    });
});

Route::prefix('cabinet')->middleware('islogged', 'iscustomer')->group(function () {
    Route::get('/', function () {
        echo 'Кабинет';
    })->name('cabinet');
});
