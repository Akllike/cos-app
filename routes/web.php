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

Route::get('/', function () {
    return view('main');
});
/*Route::get('/catalog', 'App\Http\Controllers\CatalogController@index')->name('catalog');*/
Route::get('/catalog/musses', 'App\Http\Controllers\CatalogController@showProductMuses')->name('catalog.showmuses');
Route::get('/catalog/musses/{id}', 'App\Http\Controllers\CatalogController@showCardMuse')->name('catalog.showcardmuse');
Route::get('/catalog/gels', 'App\Http\Controllers\CatalogController@showProductGels')->name('catalog.showgels');
Route::get('/catalog/gels/{id}', 'App\Http\Controllers\CatalogController@showCardGel')->name('catalog.showcardgel');
Route::get('/catalog/scrabs', 'App\Http\Controllers\CatalogController@showProductScrabs')->name('catalog.showscrabs');
Route::get('/catalog/scrabs/{id}', 'App\Http\Controllers\CatalogController@showCardScrab')->name('catalog.showcardscrab');
