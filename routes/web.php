<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternetPackageController;
use App\Http\Controllers\Pages\AddSimPageController;
use App\Http\Controllers\Pages\FaqPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\HowToPageController;
use App\Http\Controllers\Pages\PackagesPageController;
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

Route::get('/', [HomePageController::class, 'index']);

Route::get('/packages', [PackagesPageController::class, 'index']);
Route::post('/packages/purchase', [InternetPackageController::class, 'purchase']);

Route::get('/add-sim', [AddSimPageController::class, 'index']);

Route::get('/how-to', [HowToPageController::class, 'index']);

Route::get('/faq', [FaqPageController::class, 'index']);

Route::get('/checkout', [PagesController::class, 'checkout']);
Route::get('/checkout/physical-sim', [PagesController::class, 'checkoutPhysicalSim']);
Route::get('/checkout/e-sim', [PagesController::class, 'checkoutESim']);
Route::get('/checkout/result', [PagesController::class, 'checkoutResult']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);
});
