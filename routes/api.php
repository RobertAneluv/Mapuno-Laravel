<?php

use App\Http\Controllers\TreeController;
use App\Http\Controllers\GovernmentTreeCuttingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trees', [TreeController::class, 'Trees']);
Route::get('/searchquery', [TreeController::class, 'SearchQuery']);
Route::put('/editTree/{id}', [TreeController::class, 'treeUpdate']);
Route::put('/deleteTree/{id}', [TreeController::class, 'deleteTree']);
Route::get('/pendingGovernment', [GovernmentTreeCuttingController::class, 'pendingGovernment']);
Route::put('/approvedGovernment/{id}', [GovernmentTreeCuttingController::class, 'approvedGovernment']);
Route::put('/declinedGovernment/{id}', [GovernmentTreeCuttingController::class, 'declinedGovernment']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
