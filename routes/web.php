<?php

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
Route::get('/catalog', 'App\Http\Controllers\CatalogController@index')->name('catalog');

Route::get('/catalog/musses', 'App\Http\Controllers\MuseController@showProductMuses')->name('muse.show');
Route::get('/catalog/musses/{id}', 'App\Http\Controllers\MuseController@showCardMuse')->name('muse.card');
Route::get('/create/musses', 'App\Http\Controllers\MuseController@createMuse')->name('muse.create');
Route::post('/create/musses/add', 'App\Http\Controllers\MuseController@addCardMuse')->name('muse.addcard');

Route::get('/catalog/gels', 'App\Http\Controllers\GelController@showProductGels')->name('gel.show');
Route::get('/catalog/gels/{id}', 'App\Http\Controllers\GelController@showCardGel')->name('gel.card');
Route::get('/create/gels', 'App\Http\Controllers\GelController@createGel')->name('gel.create');
Route::post('/create/gels/add', 'App\Http\Controllers\GelController@addCardGel')->name('gel.addcard');

Route::get('/catalog/scrabs', 'App\Http\Controllers\ScrabController@showProductScrabs')->name('scrab.show');
Route::get('/catalog/scrabs/{id}', 'App\Http\Controllers\ScrabController@showCardScrab')->name('scrab.card');
Route::get('/create/scrabs', 'App\Http\Controllers\ScrabController@createScrab')->name('scrab.create');
Route::post('/create/scrabs/add', 'App\Http\Controllers\ScrabController@addCardScrab')->name('scrab.addcard');


Route::get('/admin', 'App\Http\Controllers\HomeController@index');

Route::get('/search', 'App\Http\Controllers\SearchController@viewSearch')->name('search.view');
Route::post('/search/result', 'App\Http\Controllers\SearchController@index')->name('search.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
