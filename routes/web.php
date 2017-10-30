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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

// User routes
Route::get('/users', 'Backend\UsersController@index')->name('users.index');
Route::get('/users/create', 'Backend\UsersController@create')->name('users.create');
Route::get('/users/delete/{id}', 'Backend\UsersController@destroy')->name('users.destroy');
Route::post('/users/store', 'Backend\UsersController@store')->name('users.store');