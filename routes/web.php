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

Route::get('/', 'TodosController@index');
Route::post('/', 'TodosController@store');
Route::get('todos/{id}', 'TodosController@show');
Route::delete('/todo{id}', 'TodosController@destroy');

Route::post('/todos/{todo}/posts', 'PostsController@store');
Route::patch('todos/{id}', 'PostsController@update');

Route::get('/search', 'SearchController@index');
Route::get('/search/ajax', 'SearchController@search');
