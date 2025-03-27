<?php

use App\Http\Controllers\EspecialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EspecialController::class, 'create'])->name('especiales.create');
Route::post('/especiales', [EspecialController::class, 'store'])->name('especiales.store');
Route::get('/especiales', [EspecialController::class, 'index'])->name('especiales.index');
Route::get('/especiales/{id}/edit', [EspecialController::class, 'edit'])->name('especiales.edit');
Route::put('/especiales/{id}', [EspecialController::class, 'update'])->name('especiales.update');
Route::delete('/especiales/{id}', [EspecialController::class, 'destroy'])->name('especiales.destroy');
Route::delete('/especial-fotos/{fotoId}', [EspecialController::class, 'destroyPhoto'])->name('especial-fotos.destroy');