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

Route::group(['prefix'=>'admin'],function(){


    Route::resource('users','UsersController');

Route::get('users/{id}/destroy',[
'uses'=> 'UsersController@destroy',
'as' => 'admin.users.destroy'
]);



 Route::resource('categorias','CategoriaController');

 Route::get('categorias/{id}/destroy',[
'uses'=> 'CategoriaController@destroy',
'as' => 'admin.categoria.destroy'
]);
/*
Route::get('view/{id}',[
'uses'=> 'PruebaController@show',
'as' => 'articulosShow'
]);
*/
});