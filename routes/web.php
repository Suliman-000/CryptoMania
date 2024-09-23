<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/coins', [CoinController::class, 'index'])->name('coins.index')->middleware('auth');
Route::get('/coin/{id}', [CoinController::class, 'show'])->name('coins.show')->middleware('auth');


Route::get('/wallet', function () {
    return view('wallet');
})->name('wallet')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
