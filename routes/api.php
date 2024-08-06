<?php

use App\Http\Controllers\TreeController;
use App\Http\Controllers\GovernmentTreeCuttingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:api')->name('user');  

    
// Ensure this route exists
});
Route::get('/users', [UserController::class, 'getAllUsers'])->name('users.all');
Route::post('/approve-user/{id}', [UserController::class, 'approveUser'])->name('user.approve');
Route::post('/decline-user/{id}', [UserController::class, 'declineUser'])->name('user.decline');
Route::get('/approved-users-count', [UserController::class, 'approvedUsersCount'])->name('users.approved.count');
Route::get('/pending-users-count', [UserController::class, 'getPendingUsersCount'])->name('users.pending.count');
Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.update.profile');

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
