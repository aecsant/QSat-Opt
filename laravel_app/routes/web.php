<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatelliteController;
use App\Http\Controllers\OptimizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SatelliteController::class, 'index']);
Route::get('/optimize/{id}', [OptimizationController::class, 'optimize']);

