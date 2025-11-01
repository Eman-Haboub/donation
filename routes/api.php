<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| هنا تضعين جميع Routes الخاصة بالـ API
|
*/

Route::get('/test', function () {
    return response()->json(['message' => 'API working!']);
});
use App\Http\Controllers\API\UserController;

Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/users/{id}/donations', [UserController::class, 'donorDonations'])->middleware('auth:sanctum');

use App\Http\Controllers\Api\FamilyController;



Route::get('/families', [FamilyController::class, 'index']);
Route::get('/families/{id}', [FamilyController::class, 'show']);
Route::post('/families', [FamilyController::class, 'store'])->middleware('auth:sanctum');
Route::put('/families/{id}', [FamilyController::class, 'update'])->middleware(['auth:sanctum','role:admin']);
Route::delete('/families/{id}', [FamilyController::class, 'destroy'])->middleware(['auth:sanctum','role:admin']);
use App\Http\Controllers\API\DonationController;

Route::post('/donations', [DonationController::class, 'store'])->middleware('auth:sanctum');
Route::get('/families/{id}/donations', [DonationController::class, 'familyDonations'])->middleware(['auth:sanctum','role:admin']);
 use App\Http\Controllers\API\AdminController;

Route::get('/admin/reports', [AdminController::class, 'reports'])->middleware(['auth:sanctum','role:admin']);
