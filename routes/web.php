<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dealer\DealerController;
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
use App\Http\Controllers\Sim\SimOrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Route::get('/', [HomePageController::class, 'index']);

Route::get('/packages', [PackagesPageController::class, 'index']);
Route::post('/packages/checkout', [PackagesPageController::class, 'checkout']);

Route::get('/add-sim', [AddSimPageController::class, 'index']);
Route::post('/add-sim', [AddSimPageController::class, 'addSim']);

Route::get('/e-sim/order', [SimPageController::class, 'orderESim']);
Route::post('/e-sim/checkout', [SimPageController::class, 'checkoutESim']);

Route::get('/physical-sim/order', [SimPageController::class, 'orderPhysicalSim']);
Route::post('/physical-sim/checkout', [SimPageController::class, 'checkoutPhysicalSim']);

Route::get('/how-to', [HowToPageController::class, 'index']);

Route::get('/faq', [FaqPageController::class, 'index']);

Route::get('/checkout', [PagesController::class, 'checkout']);
Route::get('/checkout/e-sim', [PagesController::class, 'checkoutESim']);
Route::get('/checkout/result', [PagesController::class, 'checkoutResult']);




Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user_id}/show', [UserController::class, 'show']);
    Route::get('/users/{user_id}/edit', [UserController::class, 'edit']);
    Route::get('/users/{user_id}/orders', [UserController::class, 'orders']);

    Route::post('/users/create', [UserController::class, 'store']);
    Route::post('/users/{user_id}/update', [UserController::class, 'update']);
    Route::delete('/users/{user_id}/delete', [UserController::class, 'delete']);

    // Dealers
    Route::get('/dealers', [DealerController::class, 'index']);
    Route::get('/dealers/{dealer_id}/physical-sims', [DealerController::class, 'getPhysicalSims']);
    Route::get('/dealers/{dealer_id}/physical-sim-orders', [DealerController::class, 'getPhysicalSimOrders']);

    Route::post('/dealers/create', [DealerController::class, 'store']);
    Route::post('/dealers/address/create', [DealerController::class, 'storeAddress']);
    Route::post('/dealers/set-physical-sims', [DealerController::class, 'setPhysicalSims']);

    // Internet Packages
    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);

    // Sims
    Route::get('/sims/physical', [SimController::class, 'getPhysicalSims']);
    Route::get('/sims/physical/available', [SimController::class, 'getAvailablePhysicalSims']);
    Route::get('/sims/e-sims', [SimController::class, 'getESims']);
    Route::get('/sims/upload-file', [SimController::class, 'uploadSimsFromFile']);

    Route::get('/sim-orders', [SimOrderController::class, 'index']);
    Route::get('/sim-orders/{sim_order_id}/show', [SimOrderController::class, 'showPhysicalSim']);
    Route::post('/sim-orders/{sim_order_id}/add-physical-sim', [SimOrderController::class, 'addPhysicalSim']);
    Route::put('/sim-orders/{sim_order_id}/finish', [SimOrderController::class, 'finish']);
});
