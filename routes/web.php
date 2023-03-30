<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\NotificationTelegram;
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
    // return view('welcome');
    return view('auth/login');
});

Route::group(['prefix' => 'master', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user-export', [UserExportController::class, 'index'])->name('export');
    Route::get('/user_faker', [UserController::class,'user_faker']);
    Route::get('/master/transaksi/{id}/addItem', [TransaksiController::class,'addItem']);

    Route::resource('/user', UserController::class);
    Route::resource('/product-category', ProductCategoryController::class);
    Route::resource('/product', ProductController::class);
    
    Route::resource('/transaksi', TransaksiController::class);
    Route::post( '/master/transaksi/addItem', [TransaksiController::class,'addItem']);
    Route::get('/transaction-notif-tele', [NotificationTelegram::class,'transaction_notif_tele']);
});
Route::get('/product/check/{id}', [ProductController::class, 'check_product']);
Route::get('/product/add_stock/{id}', [ProductController::class, 'add_stock']);
Route::post('/product/add_stock', [ProductController::class, 'update_stock']);
