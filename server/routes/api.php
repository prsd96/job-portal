<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserJobApplicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/jobs', [JobListingController::class, 'index'])->middleware(['auth:sanctum']);
    Route::post('/job-data', [JobListingController::class, 'jobData'])->middleware(['auth:sanctum']);
    Route::post('/save-job', [JobListingController::class, 'saveJob'])->middleware(['auth:sanctum']);
    Route::post('/update-job', [JobListingController::class, 'updateJob'])->middleware(['auth:sanctum']);

    Route::post('/job-apply', [UserJobApplicationController::class, 'store'])->middleware(['auth:sanctum']);
});