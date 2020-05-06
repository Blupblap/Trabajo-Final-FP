<?php

use App\Http\Controllers\Ajax\TownsController;

Route::get('/town', [TownsController::class, 'show'])->middleware(['auth', 'verified']);
