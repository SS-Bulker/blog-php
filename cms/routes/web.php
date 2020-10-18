<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('plantilla');
});

Route::view('/', 'paginas.blog');
Route::view('/administradores', 'paginas.administradores');
Route::view('/categorias', 'paginas.categorias');
Route::view('/articulos', 'paginas.articulos');
Route::view('/opiniones', 'paginas.opiniones');
Route::view('/banner', 'paginas.banner');
Route::view('/anuncios', 'paginas.anuncios');


Route::get('/', 'App\Http\Controllers\BlogController@traerBlog');
Route::get('/administradores', 'App\Http\Controllers\AdministradoresController@traerAdministradores');
Route::get('/categorias', 'App\Http\Controllers\CategoriasController@traerCategorias');
Route::get('/articulos', 'App\Http\Controllers\ArticulosController@traerArticulos');
Route::get('/opiniones', 'App\Http\Controllers\OpinionesController@traerOpiniones');
Route::get('/banner', 'App\Http\Controllers\BannerController@traerBanner');
Route::get('/anuncios', 'App\Http\Controllers\AnunciosController@traerAnuncios');








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
