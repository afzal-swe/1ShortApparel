<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\indexController;


Route::controller(indexController::class)->group(function () {
    Route::get('/', 'home_page');
});



// Route::get('/', function () {
//     return view('welcome');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::group(['prefix' => 'author'], function () {
//         // Route::get('/', function () {
//         //     return view('dashboard'); 
//         // })->name('dashboard');

//         Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//         Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//         Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     });
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// Route::get('/', function () {
//     return view('frontend.layouts.main');
// });

require __DIR__ . '/auth.php';
