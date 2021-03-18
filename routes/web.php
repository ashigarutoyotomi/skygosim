<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternetPackageController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/internet', function () {
    return view('internet');
});

Route::get('/internet-packages', [InternetPackageController::class, 'index']);

Route::get('/checkout', function () {
    return view('checkout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

//    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);
});
