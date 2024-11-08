<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', 'App\Http\Controllers\IndexController@index');

Route::prefix('search')->group(function () {
    Route::get('/', 'App\Http\Controllers\SearchController@viewSearch')->name('search.view');
    Route::post('/result', 'App\Http\Controllers\SearchController@index')->name('search.index');
});

Route::prefix('catalog')->group(function () {
    Route::get('/', 'App\Http\Controllers\CatalogController@index')->name('catalog');

    Route::get('/musses', 'App\Http\Controllers\MuseController@showProductMuses')->name('muse.show');
    Route::get('/musses/{id}', 'App\Http\Controllers\MuseController@showCardMuse')->name('muse.card');

    Route::get('/gels', 'App\Http\Controllers\GelController@showProductGels')->name('gel.show');
    Route::get('/gels/{id}', 'App\Http\Controllers\GelController@showCardGel')->name('gel.card');

    Route::get('/scrabs', 'App\Http\Controllers\ScrabController@showProductScrabs')->name('scrab.show');
    Route::get('/scrabs/{id}', 'App\Http\Controllers\ScrabController@showCardScrab')->name('scrab.card');
});

Auth::routes();

Route::get('/admin', 'App\Http\Controllers\HomeController@index')->name('home');
Route::post('admin/create', 'App\Http\Controllers\HomeController@create')->name('home.create');
Route::post('admin/edit', 'App\Http\Controllers\HomeController@edit')->name('home.edit');
Route::post('admin/delete', 'App\Http\Controllers\HomeController@delete')->name('home.delete');
