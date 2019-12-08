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

        Route::apiResource('roll_parts', 'RollPartsStorageController');
        Route::post('/roll_parts/getAll', 'RollPartsStorageController@getAll')->name('storage.roll_parts.getAll');
        Route::apiResource('roll_actions', 'RollActionsStorageController');
        Route::post('/roll_actions/getAll', 'RollActionsStorageController@getAll')->name('storage.roll_actions.getAll');
        Route::apiResource('roll', 'RollStorageController');
        Route::post('/roll/getAll', 'RollStorageController@getAll')->name('storage.roll.getAll');
        Route::post('/roll/get/{id}', 'RollStorageController@get')->name('storage.roll.get');


        Route::apiResource('zebra_part', 'ZebraPartsStorageController');
        Route::post('/zebra_parts/getAll', 'ZebraPartsStorageController@getAll')->name('storage.zebra_parts.getAll');
        Route::apiResource('zebra_actions', 'ZebraActionsStorageController');
        Route::post('/zebra_actions/getAll', 'ZebraActionsStorageController@getAll')->name('storage.zebra_actions.getAll');
        Route::apiResource('zebra', 'ZebraStorageController');
        Route::post('/zebra/getAll', 'ZebraStorageController@getAll')->name('storage.zebra.getAll');
        Route::post('/zebra/get/{id}', 'ZebraStorageController@get')->name('storage.zebra.get');

        Route::resource('vert_part', 'VertPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('vert', 'VertStorageController')->except(['create', 'edit']);
        Route::post('/vert/get', 'VertStorageController@get')->name('storage.vert.get');

        Route::resource('goriz_part', 'GorizPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('goriz', 'GorizStorageController')->except(['create', 'edit']);
        Route::post('/goriz/get', 'GorizStorageController@get')->name('storage.goriz.get');

        Route::resource('metal_part', 'MetalPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('metal', 'MetalStorageController')->except(['create', 'edit']);
        Route::post('/metal/get', 'MetalStorageController@get')->name('storage.metal.get');

        Route::resource('furn_part', 'FurnPartsStorageController')->only(['store', 'update', 'destroy']);
        Route::resource('furn', 'FurnStorageController')->except(['create', 'edit']);
        Route::post('/furn/get', 'FurnStorageController@get')->name('storage.furn.get');
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
