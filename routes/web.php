<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\TownsController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes(['verify' => true]);
});

Route::get('/home', HomeController::class)->name('home')->middleware(['auth', 'verified']);

Route::get('/town_name', [TownsController::class, 'edit'])->middleware(['auth', 'verified'])->name('town_name');

Route::post('/town_name', [TownsController::class, 'update'])->middleware(['auth', 'verified']);

Route::get('/ranking', RankingController::class)->name('ranking');