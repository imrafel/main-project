<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestamoController;

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
    return view('auth.login');
});


// Route::get('/articulo', function() {
//     return view('articulo.index');
// });

// Route::get('/articulo/create', [ArticuloController::class, 'create']);

//Ruta a todo el controller de Articulo, con verificacion al login
Route::resource('articulo', ArticuloController::class)->middleware('auth');

//Ruta a todo el controller de Prestamo, con verificacion al login
Route::resource('prestamo', PrestamoController::class)->middleware('auth');

//Quitamos del login, las opciones de registrar usuario y cambiar la contrase;a

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



Route::resource('user', UserController::class)->middleware('auth');
