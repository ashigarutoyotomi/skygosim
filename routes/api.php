<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\InternetPackageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//login api
Route::post("/login", [AuthController::class, "login"]);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/me', [AuthController::class, "me"]);
    Route::get('/logout', [AuthController::class, 'logout']);
});
