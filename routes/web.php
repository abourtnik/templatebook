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

Route::any('/template/add', 'TemplatesController@add')->name('template-add');

Route::any('/template/update/{id}', 'TemplatesController@update')->name('template-update');

Route::any('/template/remove/{id}', 'TemplatesController@remove')->name('template-remove');


Route::get('/storage/template/{file}', function ($file) {
    return response()->download(storage_path('app/templates/'.$file));
})->where('file', '[A-Za-z0-9]+.zip');

Route::get('/users/show/{id}', 'UsersController@show')->name('user-show');
Route::get('/templates/show/{id}', 'TemplatesController@show')->name('template-show');

Route::get('/basket', 'BasketController@index')->name('basket');
Route::get('/basket/add/{id}', 'BasketController@add')->name('basket-add');

Route::get('/order', 'OrdersController@index')->name('order');

Route::get('/categories/show/{id}', 'CategoriesController@show')->name('category-show');