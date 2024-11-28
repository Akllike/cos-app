<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\IndexController@index')->name('index');
Route::get('/stock', 'App\Http\Controllers\IndexController@stock')->name('stock');
Route::get('/about', 'App\Http\Controllers\IndexController@showAbout')->name('about');
Route::get('/delivery', 'App\Http\Controllers\IndexController@showDelivery')->name('delivery');
Route::get('/sitemap.xml', 'App\Http\Controllers\SitemapController')->name('sitemap');

Route::prefix('search')->group(function () {
    Route::get('/', 'App\Http\Controllers\SearchController')->name('search');
    Route::post('/result', 'App\Http\Controllers\SearchController@viewSearch')->name('search.view');
});

Route::prefix('catalog')->group(function () {
    Route::get('/', 'App\Http\Controllers\CatalogController')->name('catalog');

    Route::get('/hairs', 'App\Http\Controllers\HairController@showProductHairs')->name('hair.show');
    Route::get('/hairs/{id}', 'App\Http\Controllers\HairController@showCardHairs')->name('hair.card');

    Route::get('/faces', 'App\Http\Controllers\FaceController@showProductFaces')->name('face.show');
    Route::get('/faces/{id}', 'App\Http\Controllers\FaceController@showCardFaces')->name('face.card');

    Route::get('/bodies', 'App\Http\Controllers\BodyController@showProductBodies')->name('body.show');
    Route::get('/bodies/{id}', 'App\Http\Controllers\BodyController@showCardBodies')->name('body.card');
});

Route::prefix('cart')->group(function () {
    Route::get('/', 'App\Http\Controllers\CartController@index')->name('cart.index');
    Route::post('/add', 'App\Http\Controllers\CartController@add')->name('cart.add');
    Route::post('/remove', 'App\Http\Controllers\CartController@remove')->name('cart.remove');
    Route::post('/telegram', 'App\Http\Controllers\CartController@sendTelegram')->name('cart.tg');
});

Auth::routes();

Route::get('/admin', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('admin/create', 'App\Http\Controllers\HomeController@create')->name('home.create');
Route::post('admin/edit', 'App\Http\Controllers\HomeController@edit')->name('home.edit');
Route::post('admin/delete', 'App\Http\Controllers\HomeController@delete')->name('home.delete');
Route::post('/admin/instock', 'App\Http\Controllers\HomeController@inStock')->name('home.instock');
