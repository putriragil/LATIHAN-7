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

Auth::routes();

Route::get('/', [App\Http\Controller::class, 'index'])->name('index');
Route::get('/product/{slug}', [App\Http\Controllers\HomeControllers::class, 'detail'])->name('detail');
Route::get('/lacak', [App\Http\Controllers\User\DassbordControllers::class, ';lacak'])->name('detail');

Route::middleware(['auht', 'role:user,admin, dontback'])->group(funcion (){
    Route::post('/', [App\Http\Controllers\HomeController::class, 'cart'])->name('addtocart');
    Route::get('/cart', [App\Http\Controllers\HomeControllers::class, 'showcart'])->name('cart');
    Route::get('/cart{id}', [App\Http\Controllers\HomeController::class, 'deletecart'])->name('cartDelete');
    Route::get('/paymet', [App\Http\Controllers\HomeController::class, 'payment'])->name('pay');
    Route::get('/invoice/{id}', [App\Http\Controllers\HomeControllers::class, 'invoice'])->name('inv');
    Route::get(/'dashboard', [App\Http\Conrollers\User\DashboardController::class, 'index'])->name('dashboard');
});
