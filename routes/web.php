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

// Pages

Route::get('/', 'PagesController@index')->name('index');
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/mentions-legales', 'PagesController@mentions_legales')->name('mentions-legales');

// Auth

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/confirm/{id}/{token}', '\App\Http\Controllers\Auth\RegisterController@confirm')->name('confirm-user');

// Home

Route::get('/home', 'HomeController@index')->name('home');

// Templates

Route::match(['get', 'post'] , '/templates/add', 'TemplatesController@add')->name('template-add');
Route::match(['get', 'post'] , '/templates/update/{id}', 'TemplatesController@update')->name('template-update');
Route::get('/templates/remove/{id}/{crsf_token}', 'TemplatesController@remove')->name('template-remove');
Route::get('/templates/download/{id}', 'TemplatesController@download')->name('template-download');
Route::get('/templates/show/{id}', 'TemplatesController@show')->name('template-show');
Route::post('/templates/vote/{id}', 'TemplatesController@vote')->name('template-vote');
Route::post('/templates/comment/{id}', 'TemplatesController@comment')->name('template-comment');

// Users

Route::get('/users/show/{id}', 'UsersController@show')->name('user-show');
Route::get('/users/isconnected', 'UsersController@isconnected')->name('user-connected');
Route::post('/users/avatar', 'UsersController@avatar')->name('user-avatar');

// Basket

Route::get('/basket', 'BasketController@index')->name('basket');
Route::get('/basket/add/{id}', 'BasketController@add')->name('basket-add');
Route::get('/basket/delete/{id}', 'BasketController@delete')->name('basket-delete');
Route::post('/basket/recalculate/{id}', 'BasketController@recalculate')->name('basket-recalculate');

// Orders

Route::get('/order', 'OrdersController@index')->name('order');
Route::get('/order/pay', 'OrdersController@pay')->name('pay-order');
Route::get('/order/cancel', 'OrdersController@cancel')->name('cancel-order');
Route::get('/order/test', 'OrdersController@test')->name('test');
Route::get('/order/show/{id}', 'OrdersController@show')->name('order-show');
Route::get('/categories/show/{id}', 'CategoriesController@show')->name('category-show');


// Factures

Route::get('/facture/show/{id}', 'FacturesController@show')->name('facture-show');
