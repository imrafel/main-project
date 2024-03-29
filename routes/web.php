<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\DetallePrestamoController;
use App\Http\Controllers\MaterialYEquipoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\StockController;

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

Route::get('prestamo/{prestamo}/export', [PrestamoController::class, 'export']);

//Ruta para el controller de Material y equipo con verificacoin al login
Route::resource('material', MaterialYEquipoController::class)->middleware('auth');

//Ruta para el controller de Stocks con verificaion al login
Route::resource('stock', StockController::class)->middleware('auth');

//Ruta a todo el controller de Articulo, con verificacion al login
Route::resource('articulo', ArticuloController::class)->middleware('auth', 'role');

//Ruta a todo el controller de Prestamo, con verificacion al login
Route::resource('prestamo', PrestamoController::class)->middleware('auth');

Route::get('prestamo/{prestamo}/pdf', [PrestamoController::class, 'pdf']);

Route::resource('detalle_prestamo', DetallePrestamoController::class)->middleware('auth');




//Quitamos del login, las opciones de registrar usuario y cambiar la contrase;a

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



Route::resource('user', UserController::class)->middleware('auth', 'role');

