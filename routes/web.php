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

Route::redirect('/', '/cabinet')->middleware('redirectfrommain');


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('admin')->middleware('isadmin')->group(function () {
    Route::view('/', 'admin.home')->name('admin');
});

Route::prefix('cabinet')->middleware('iscustomer')->group(function () {
    Route::get('/', function () {
        echo 'Кабинет';
    })->name('cabinet');
});
