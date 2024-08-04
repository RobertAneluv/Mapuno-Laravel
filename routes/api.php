<?php

use App\Http\Controllers\TreeController;
use App\Http\Controllers\GovernmentTreeCuttingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api')->name('user');  
    Route::get('/users', [AuthController::class, 'getAllUsers'])->middleware('auth:api')->name('users.all');
    Route::post('/approve-user/{id}', [AuthController::class, 'approveUser'])->middleware('auth:api');
    Route::post('/decline-user/{id}', [AuthController::class, 'declineUser'])->middleware('auth:api');
    Route::get('/approved-users-count', [AuthController::class, 'approvedUsersCount']);
    Route::get('/pending-users-count', [AuthController::class, 'getPendingUsersCount']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    
// Ensure this route exists
});

Route::get('/trees', [TreeController::class, 'Trees']);
Route::get('/searchquery', [TreeController::class, 'SearchQuery']);
Route::put('/editTree/{id}', [TreeController::class, 'treeUpdate']);
Route::put('/deleteTree/{id}', [TreeController::class, 'deleteTree']);
Route::get('/pendingGovernment', [GovernmentTreeCuttingController::class, 'pendingGovernment']);
Route::put('/approvedGovernment/{id}', [GovernmentTreeCuttingController::class, 'approvedGovernment']);
Route::put('/declinedGovernment/{id}', [GovernmentTreeCuttingController::class, 'declinedGovernment']);
Route::get('/approvedGovernment', [GovernmentTreeCuttingController::class, 'approvedGovernment']);
Route::get('/declinedGovernment', [GovernmentTreeCuttingController::class, 'declinedGovernment']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
