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

Route::get('/', 'PagesController@index')->name('index');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/template/add', 'TemplatesController@add')->name('template-add');
Route::post('/template/add', 'TemplatesController@add')->name('template-add');

Route::get('/storage/template/{file}', function ($file) {
    return response()->download(storage_path('app/templates/'.$file));
})->where('file', '[A-Za-z0-9]+.zip');

Route::get('/users/show/{id}', ['uses' =>'UsersController@show', 'as'=>'user-show']);

Route::get('/templates/show/{id}', ['uses' =>'TemplatesController@show', 'as'=>'template-show']);