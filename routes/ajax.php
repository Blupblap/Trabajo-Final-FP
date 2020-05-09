<?php

use App\Http\Controllers\Ajax\TownsController;

Route::get('/town', [TownsController::class, 'show'])->middleware(['auth', 'verified']);

Route::get('/building/{id}', [TownsController::class, 'update'])->middleware(['auth', 'verified']);