<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\OverlapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/items', [ItemController::class, 'apiIndex']);
Route::get('/items/{id}', [ItemController::class, 'apiShow']);
Route::post('/overlap', [OverlapController::class, 'apiCalc']);
