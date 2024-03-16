<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\CommodityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KomoditasController;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\ExpenditureController;
use App\Http\Controllers\Auth\AuthenticateController;

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

Route::get('/', [AuthenticateController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthenticateController::class, 'authenticate'])->name('authenticate');

Route::name('admin.')->prefix('/admin')->group(function() {
    Route::middleware('auth')->group(function() {
        Route::resource('/dashboard', DashboardController::class);
        Route::post('/logout', [AuthenticateController::class, 'logout'])->name('logout');

        Route::resource('/commodity', CommodityController::class);
        Route::resource('/material', MaterialController::class);
        Route::get('/cetak-struk/{id}', [SaleController::class, 'cetak_struk'])->name('cetak-struk');
        Route::get('/getMaterials', [SaleController::class, 'getMaterials'])->name('getMaterials');
        Route::resource('/sale', SaleController::class);
        Route::get('/export', [ExportController::class, 'index'])->name('export.index');
        Route::post('/export-data', [ExportController::class, 'export'])->name('export.store');

        Route::resource('/expenditure', ExpenditureController::class);
        Route::resource('/user', UserController::class);
    });
});
