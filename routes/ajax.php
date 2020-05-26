<?php

use App\Http\Controllers\Ajax\TownsController;
use App\Http\Controllers\Ajax\BuildingsController;

Route::get('/town', [TownsController::class, 'show'])->middleware(['auth', 'verified']);

Route::put('/building', [BuildingsController::class, 'update'])->middleware(['auth', 'verified']);