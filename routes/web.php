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
        Route::resource('roll', 'RollStorageController');

        Route::resource('zebra_part', 'ZebraPartsStorageController');
        Route::resource('zebra', 'ZebraStorageController');

        Route::resource('vert_part', 'VertPartsStorageController');
        Route::resource('vert', 'VertStorageController');

        Route::resource('goriz', 'GorizStorageController');
        Route::resource('metal', 'MetalStorageController');
        Route::resource('furn', 'FurnStorageController');
    });
});

Route::prefix('cabinet')->middleware('islogged', 'iscustomer')->group(function () {
    Route::get('/', function () {
        echo 'Кабинет';
    })->name('cabinet');
});
