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
Route::get('/users/group/{role}', 'Backend\UsersController@index')->name('users.index');
Route::get('/users/create', 'Backend\UsersController@create')->name('users.create');
Route::get('/users/delete/{id}', 'Backend\UsersController@destroy')->name('users.destroy');
Route::post('/users/store', 'Backend\UsersController@store')->name('users.store');

// Account settings routes
Route::get('/account/settings', 'Backend\AccountSettingsController@index')->name('account.settings');
Route::post('/account/settings/info', 'Backend\AccountSettingsController@updateInfo')->name('account.settings.info');
Route::post('/account/settings/security', 'Backend\AccountSettingsController@updateSecurity')->name('account.settings.security');

// User ban routes
Route::get('/users/ban/{id}', 'Backend\BlockUserController@create')->name('users.ban');
Route::get('/users/unban/{id}', 'Backend\BlockUserController@destroy')->name('users.ban.undo');
Route::post('/users/ban/store/{id}', 'Backend\BlockUserController@store')->name('users.ban.store');

// Log routes
Route::get('/logs', 'Backend\LogController@index')->name('logs.index');
Route::get('/logs/{id}', 'Backend\LogController@show')->name('logs.show');