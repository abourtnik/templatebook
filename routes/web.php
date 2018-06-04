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

Route::get('/confirm/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@confirm')->name('confirm-user');

Route::get('/home', 'HomeController@index')->name('home');

Route::any('/template/add', 'TemplatesController@add')->name('template-add');

Route::any('/template/update/{id}', 'TemplatesController@update')->name('template-update');

Route::post('/template/remove/{id}', 'TemplatesController@remove')->name('template-remove');

Route::any('/template/download/{id}', 'TemplatesController@download')->name('template-download');


Route::get('/storage/template/{file}', function ($file) {
    return response()->download(storage_path('app/templates/'.$file));
})->where('file', '[A-Za-z0-9]+.zip');


Route::get('/users/show/{id}', 'UsersController@show')->name('user-show');
Route::get('/templates/show/{id}', 'TemplatesController@show')->name('template-show');

Route::get('/basket', 'BasketController@index')->name('basket');
Route::get('/basket/add/{id}', 'BasketController@add')->name('basket-add');
Route::get('/basket/delete/{id}', 'BasketController@delete')->name('basket-delete');
Route::post('/basket/recalculate/{id}', 'BasketController@recalculate')->name('basket-recalculate');

Route::get('/order', 'OrdersController@index')->name('order');

Route::get('/categories/show/{id}', 'CategoriesController@show')->name('category-show');

Route::get('/order/pay', 'OrdersController@pay')->name('pay-order');
Route::get('/order/cancel', 'OrdersController@cancel')->name('cancel-order');

Route::get('/order/test', 'OrdersController@test')->name('test');

Route::get('/order/show/{id}', 'OrdersController@show')->name('order-show');

Route::get('/storage/facture/{order_id}', function ($order_id) {
    return response()->file(storage_path('app/factures/'.$order_id .'.pdf'));
})->where('order_id', '[0-9]+');

Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/mentions-legales', 'PagesController@mentions_legales')->name('mentions-legales');

Route::any('/facture/show/{id}', 'FacturesController@show')->name('facture-show');
