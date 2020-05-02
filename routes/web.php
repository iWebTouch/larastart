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
        Route::post('/', 'UserController@store')->name('create.user');
        Route::get('/{user}/edit', 'UserController@edit')->name('edit.user');
        Route::put('/{user}', 'UserController@update')->name('update.user');
        Route::delete('/{user}', 'UserController@destroy')->name('delete.user');  
    });

});