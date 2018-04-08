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

Auth::routes();


Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::get('o-nas', 'AboutController@index')
    ->name('about.index');

Route::get('produkty', 'ProductsController@index')
    ->name('products.index');

Route::get('produkt/show/{id}', 'ProductsController@show')
    ->name('product.index');

Route::get('kontakt', 'ContactController@index')
    ->name('contact.index');

Route::post('kontakt', 'ContactController@postContact')
    ->name('contact.postContact');

Route::get('produkt/dodaj', 'ProductsController@create')
    ->name('product.create');

Route::post('produkty', 'ProductsController@store')
    ->name('product.store');

Route::get('produkt/edytuj/{id}', 'ProductsController@edit')
    ->name('product.edit');

Route::get('produkt/usun/{id}', 'ProductsController@destroy')
    ->name('product.delete');

Route::post('produkt/update/{id}', 'ProductsController@update')
    ->name('product.update');

Route::get('galeria', 'GalleryController@index')
    ->name('gallery.index');

Route::get('galeria/dodaj', 'GalleryController@create')
    ->name('gallery.create');

Route::post('galeria', 'GalleryController@store')
    ->name('gallery.store');

Route::get('galeria/usun/{id}', 'GalleryController@destroy')
    ->name('gallery.delete');

Route::get('koszyk', 'KoszykController@index')
    ->name('koszyk.index');

Route::get('profile', 'ProfileController@index')
    ->name('profile.index');

Route::get('profile/edit/{id}', 'ProfileController@edit')
    ->name('profile.edit');

Route::post('profile/update/{id}', 'ProfileController@update')
    ->name('profile.update');

Route::get('/changePassword','HomeController@showChangePasswordForm')
    ->name('password.change');

Route::post('/changePassword','HomeController@changePassword')
    ->name('changePassword');

Route::get('order/show/{id}', 'OrderController@show')
    ->name('order.show');

Route::post('order/store/{id}', 'OrderController@store')
    ->name('order.store');

Route::get('order/edit/{id}', 'OrderController@edit')
    ->name('order.edit');

Route::post('order/update/{id}', 'OrderController@update')
    ->name('order.update');

Route::get('order/delete/{id}', 'OrderController@destroy')
    ->name('order.delete');

Route::get('zamowienia', 'KoszykController@show')
    ->name('zamowienia.show');

Route::get('koszyk/update', 'KoszykController@update')
    ->name('koszyk.update');

Route::get('uzytkownicy', 'UsersController@index')
    ->name('users.index');

Route::get('orders', 'OrderController@index')
    ->name('order.index');

Route::get('orders/realizowane', 'OrderController@index_wTrakcie')
    ->name('order.index_wTrakcie');

Route::get('orders/zrealizowane', 'OrderController@index_zrealizowane')
    ->name('order.index_zrealizowane');

Route::get('order/update/realizacja/{id}', 'OrderController@updateDoRealizacji')
    ->name('order.updateDoRealizacji');

Route::get('order/update/zrealizowane/{id}', 'OrderController@updateZrealizowane')
    ->name('order.updateZrealizowane');

Route::get('user/delete/{id}', 'ProfileController@destroy')
    ->name('user.delete');

Route::get('kalendarz', 'KalendarzController@index')
    ->name('kalendarz.index');

Route::post('kalendarz/dodaj', 'KalendarzController@store')
    ->name('kalendarz.dodaj');

Route::post('kalendarz/usun', 'KalendarzController@destroy')
    ->name('kalendarz.usun');