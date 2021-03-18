<?php

use App\Http\Controllers\InternetPackageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::middleware(['auth'])->group(function () {

//    Route::get('/dashboard', [DashboardController::class, 'index'])
//        ->name('dashboard');
//
//    Route::get('/internet-packages', [InternetPackageController::class, 'index'])
//        ->name('dashboard_internet_packages');

//    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);
//});
