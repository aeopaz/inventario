<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CarteraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

// Authentication Routes...
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

// Email Verification Routes...
Route::emailVerification();

Route::middleware(['checklogin'])->group(function () {//Middleware que verifica que el usuario este autenticado para acceder a las rutas


// Registration  Routes... Para el registro de usuarios
Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class,'register']);

Route::get('/home', [HomeController::class,'index'])->name('home');

//Rutas de usuario
Route::get('/usuarios/index',[UserController::class,'index'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}',[UserController::class,'edit'])->name('usuarios.edit');
Route::put('/usuarios/update/{id}',[UserController::class,'update'])->name('usuarios.update');

//Rutas de Artículos
Route::get('/articulo/index',[ArticuloController::class,'index'])->name('articulo.index');
Route::get('/articulo/create',[ArticuloController::class,'create'])->name('articulo.create');
Route::post('/articulo/store',[ArticuloController::class,'store'])->name('articulo.store');
Route::get('/articulo/show/{id}',[ArticuloController::class,'show'])->name('articulo.show');
Route::get('/articulo/edit/{id}',[ArticuloController::class,'edit'])->name('articulo.edit');
Route::put('/articulo/update/{id}',[ArticuloController::class,'update'])->name('articulo.update');
Route::get('/articulo/edit_image/{id}',[ArticuloController::class,'edit_image'])->name('articulo.edit_image');
Route::put('/articulo/change_image/{id}',[ArticuloController::class,'change_image'])->name('articulo.change_image');
Route::delete('/articulo/destroy/{id}',[ArticuloController::class,'destroy'])->name('articulo.destroy');

//Rutas de clientes
Route::get('/cliente/index',[ClienteController::class,'index'])->name('cliente.index');
Route::get('/cliente/create',[ClienteController::class,'create'])->name('cliente.create');
Route::post('/cliente/store',[ClienteController::class,'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}',[ClienteController::class,'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}',[ClienteController::class,'update'])->name('cliente.update');
Route::delete('/cliente/destroy/{id}',[ClienteController::class,'destroy'])->name('cliente.destroy');

//Rutas de proveedores
Route::get('/proveedor/index',[ProveedorController::class,'index'])->name('proveedor.index');
Route::get('/proveedor/create',[ProveedorController::class,'create'])->name('proveedor.create');
Route::post('/proveedor/store',[ProveedorController::class,'store'])->name('proveedor.store');
Route::get('/proveedor/edit/{id}',[ProveedorController::class,'edit'])->name('proveedor.edit');
Route::put('/proveedor/update/{id}',[ProveedorController::class,'update'])->name('proveedor.update');
Route::delete('/proveedor/destroy/{id}',[ProveedorController::class,'destroy'])->name('proveedor.destroy');

//Rutas de Entradas
Route::get('/entrada/index',[EntradasController::class,'index'])->name('entrada.index');
Route::get('/entrada/create',[EntradasController::class,'create'])->name('entrada.create');
Route::post('/entrada/store',[EntradasController::class,'store'])->name('entrada.store');
Route::get('/entrada/edit/{id}',[EntradasController::class,'edit'])->name('entrada.edit');
Route::put('/entrada/update/{id}',[EntradasController::class,'update'])->name('entrada.update');
Route::get('/entrada/show/{id}',[EntradasController::class,'show'])->name('entrada.show');
Route::delete('/entrada/destroy/{id}',[EntradasController::class,'destroy'])->name('entrada.destroy');

//Rutas de salidas
Route::get('/salida/index',[SalidasController::class,'index'])->name('salida.index');
Route::get('/salida/create',[SalidasController::class,'create'])->name('salida.create');
Route::post('/salida/store',[SalidasController::class,'store'])->name('salida.store');
Route::get('/salida/edit/{id}',[SalidasController::class,'edit'])->name('salida.edit');
Route::put('/salida/update/{id}',[SalidasController::class,'update'])->name('salida.update');
Route::get('/salida/show/{id}',[SalidasController::class,'show'])->name('salida.show');
Route::delete('/salida/destroy/{id}',[SalidasController::class,'destroy'])->name('salida.destroy');
Route::post('/salida/consultar_articulo',[SalidasController::class,'consultar_articulo'])->name('salida.consultar_articulo');

//Rutas de Cartera
Route::get('/cartera/index',[CarteraController::class,'index'])->name('cartera.index');
Route::get('/cartera/show/{id}',[CarteraController::class,'show'])->name('cartera.show');
Route::put('/cartera/update_detalle_cartera/{id}/{id_cartera}',[CarteraController::class,'update_detalle_cartera'])->name('cartera.update_detalle_cartera');

//Rutas de gráficos
Route::get('graficos/index',[GraficosController::class,'index'])->name('graficos.index');

});//Aquí se cierra el middleware que verifica que el usuario este autenticado
