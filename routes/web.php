<?php
use App\Http\Middleware\CheckAge;

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


    Route::resource('users','UsersController')->middleware('auth');

Route::get('users/{id}/destroy',[
'uses'=> 'UsersController@destroy',
'as' => 'admin.users.destroy'
])->middleware('auth');



 Route::resource('categorias','CategoriaController')->middleware('auth');

 Route::get('categorias/{id}/destroy',[
'uses'=> 'CategoriaController@destroy',
'as' => 'admin.categorias.destroy'
]);

 

Route::resource('articulos','ArticulosController');


Route::resource('tags','TagsController');

Route::get('tags/{id}/destroy',[
'uses'=> 'TagsController@destroy',
'as' => 'admin.tags.destroy'
]);
/*
Route::get('view/{id}',[
'uses'=> 'PruebaController@show',
'as' => 'articulosShow'
]);
*/
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

