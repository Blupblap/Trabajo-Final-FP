<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TownsController;

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes(['verify' => true]);
});

Route::get('/home', HomeController::class)->name('home')->middleware(['auth', 'verified']);

Route::get('/town_name', [TownsController::class, 'edit'])->middleware(['auth', 'verified'])->name('town_name');

Route::post('/town_name', [TownsController::class, 'update'])->middleware(['auth', 'verified']);
