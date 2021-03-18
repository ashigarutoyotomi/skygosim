<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternetPackageController;
use App\Http\Controllers\PagesController;
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

Auth::routes();

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/internet', [PagesController::class, 'internet']);
Route::get('/checkout', [PagesController::class, 'checkout']);
Route::get('/checkout/result', [PagesController::class, 'checkoutResult']);


Route::post('/internet-packages/purchase', [InternetPackageController::class, 'purchase']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);
});
