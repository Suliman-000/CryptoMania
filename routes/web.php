<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/coins', [CoinController::class, 'index'])->name('coins.index');
    Route::get('/coin/{id}', [CoinController::class, 'show'])->name('coins.show');

    Route::get('/wallet', function () {
        return view('wallet');
    })->name('wallet');

    Route::get('/exchange', function () {
        return view('exchange');
    })->name('exchange');

    Route::get('/cryptonews', function () {
        return view('cryptonews');
    })->name('cryptonews');
});

require __DIR__.'/auth.php';
