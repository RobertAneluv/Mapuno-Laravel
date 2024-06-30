<?php

use App\Http\Controllers\TreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/alivetrees', [TreeController::class, 'aliveTree']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
