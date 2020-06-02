<?php

use App\Http\Controllers\Ajax\TownsController;
use App\Http\Controllers\Ajax\BuildingsController;
use App\Http\Controllers\Ajax\RankingController;

Route::get('/town', [TownsController::class, 'show'])->middleware(['auth', 'verified']);

Route::put('/building', [BuildingsController::class, 'update'])->middleware(['auth', 'verified']);

Route::get('/ranking', [RankingController::class, 'show']);