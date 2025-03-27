<?php

use App\Http\Controllers\EspecialController;
use Illuminate\Support\Facades\Route;

Route::get('/especiales-destacados', [EspecialController::class, 'apiIndex']);
Route::get('/especiales-destacados/{id}', [EspecialController::class, 'apiShow']);