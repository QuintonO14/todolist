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

Route::resource('/todo', 'ThingsController');

Route::get('/todo/edit', [
    'uses' => 'ThingsController@edit',
    'as' => 'todo.edit',
    'middleware' => 'auth'
]);

Route::delete('/todo/delete/{id}', [
    'uses' => 'ThingsController@destroy',
    'as' => 'todo.destroy',
    'middleware' => 'auth'
]);

Route::put('/todo/update/{id}', [
    'uses' => 'ThingsController@update',
    'as' => 'todo.update',
    'middleware' => 'auth'
]);