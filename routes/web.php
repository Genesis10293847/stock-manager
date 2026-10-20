<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('items.index');
})->name('home');

Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');

Route::get('/items/{item}/edit', [ItemController::class, 'edit'])
->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])
->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])
->name('items.destroy');
