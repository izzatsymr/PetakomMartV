<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PaymentMethodController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-cash', [CashController::class, 'index'])->name(
            'all-cash.index'
        );
        Route::post('all-cash', [CashController::class, 'store'])->name(
            'all-cash.store'
        );
        Route::get('all-cash/create', [CashController::class, 'create'])->name(
            'all-cash.create'
        );
        Route::get('all-cash/{cash}', [CashController::class, 'show'])->name(
            'all-cash.show'
        );
        Route::get('all-cash/{cash}/edit', [
            CashController::class,
            'edit',
        ])->name('all-cash.edit');
        Route::put('all-cash/{cash}', [CashController::class, 'update'])->name(
            'all-cash.update'
        );
        Route::delete('all-cash/{cash}', [
            CashController::class,
            'destroy',
        ])->name('all-cash.destroy');

        Route::resource('inventories', InventoryController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('payment-methods', PaymentMethodController::class);
        Route::resource('products', ProductController::class);
        Route::resource('sales', SaleController::class);
        Route::resource('schedules', ScheduleController::class);
        Route::resource('users', UserController::class);
    });
