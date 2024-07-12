<?php

use App\Http\Controllers\TreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trees', [TreeController::class, 'Trees']);
Route::get('/searchquery', [TreeController::class, 'SearchQuery']);
Route::put('/editTree/{id}', [TreeController::class, 'treeUpate']);
Route::put('/deleteTree/{id}', [TreeController::class, 'deleteTree']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
