<?php


use App\Http\Controllers\InternetPackageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
