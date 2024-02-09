<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\indexController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;



// home page route section
Route::group(['prefix' => '/'], function () {
    Route::controller(indexController::class)->group(function () {
        Route::get('/', 'home_page')->name('home_page');
        Route::get('/product-details/{slug}', 'product_details')->name('product.details');
    });
}); // End phome page route section




Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'review'], function () {
        // Route::get('/', function () {
        //     return view('dashboard'); 
        // })->name('dashboard');

        Route::post('/', [ReviewController::class, 'review_add'])->name('review_add');
        Route::get('/store/{id}', [ReviewController::class, 'add_wishlist'])->name('add.wishlist');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__ . '/auth.php';
