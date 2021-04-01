<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternetPackageController;
use App\Http\Controllers\Pages\AddSimPageController;
use App\Http\Controllers\Pages\CheckoutPageController;
use App\Http\Controllers\Pages\FaqPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\HowToPageController;
use App\Http\Controllers\Pages\PackagesPageController;
use App\Http\Controllers\Pages\SimPageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Sim\SimController;
use App\Http\Controllers\SimCardController;
use App\Http\Controllers\UserController;
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

Route::get('/e-sim/order', [SimPageController::class, 'orderESim']);
Route::post('/e-sim/checkout', [SimPageController::class, 'checkoutESim']);

Route::get('/physical-sim/order', [SimPageController::class, 'orderPhysicalSim']);
Route::post('/physical-sim/checkout', [SimPageController::class, 'checkoutPhysicalSim']);

Route::get('/how-to', [HowToPageController::class, 'index']);

Route::get('/faq', [FaqPageController::class, 'index']);

Route::get('/checkout', [PagesController::class, 'checkout']);
Route::get('/checkout/e-sim', [PagesController::class, 'checkoutESim']);
Route::get('/checkout/result', [PagesController::class, 'checkoutResult']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/create', [UserController::class, 'store']);

    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);

    Route::get('/sim-cards', [SimController::class, 'index']);
    Route::post('/sim-cards/upload_sim_cards', [SimController::class, 'uploadSimCards']);
});
