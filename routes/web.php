<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', 'HomeController@index')->name('user.home');
});

Route::prefix('/admin')->middleware('admin')->namespace('Admin')->group(function() {

    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::prefix('users')->group(function() {
        Route::get('/', 'UserController@index')->name('manage.users');
        Route::get('/data', 'UserController@data')->name('users.data');

        Route::get('/new', 'UserController@add')->name('add.user');
        Route::post('/new', 'UserController@store')->name('create.user');
        Route::get('/{id}', 'UserController@edit')->name('edit.user');
        Route::put('/{id}', 'UserController@update')->name('update.user');
        Route::delete('/{id}', 'UserController@destroy')->name('delete.user');  
    });

});