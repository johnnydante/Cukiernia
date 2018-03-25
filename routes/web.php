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

Route::get('register', function () {
    return view('home.home');
})->name('register');

Route::get('/', function () {
    return view('home.home');
})->name('home');

Route::get('o-nas', [
    'uses' => 'AboutController@index',
    'as' => 'about.index'
]);

Route::get('produkty', [
    'uses' => 'ProductsController@index',
    'as' => 'products.index'
]);

Route::get('produkt/show/{id}', 'ProductsController@show')
    ->name('product.index');

Route::get('kontakt', [
    'uses' => 'ContactController@index',
    'as' => 'contact.index'
]);

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