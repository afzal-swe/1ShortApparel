<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\indexController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContectController;


Route::group(['prefix' => '/'], function () {
    Route::controller(indexController::class)->group(function () {
        Route::get('/', 'home_page')->name('home_page');
        Route::get('/product-details/{slug}', 'product_details')->name('product.details');
    });

    Route::group(['prefix' => 'contact'], function () {
        Route::get('/page', [ContectController::class, 'contact_page'])->name('contact.page');
        Route::post('/send/message', [ContectController::class, 'contact_send'])->name('contact.send_message');
    });
});




Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'review'], function () {
        // Route::get('/', function () {
        //     return view('dashboard'); 
        // })->name('dashboard');

        Route::post('/', [ReviewController::class, 'review_add'])->name('review_add');
        // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::group(['prefix' => 'wishlist'], function () {
        Route::get('/store/{id}', [WishlistController::class, 'add_wishlist'])->name('add.wishlist');
        Route::get('/view', [WishlistController::class, 'wishlist_view'])->name('wishlist.view');
        Route::get('/delete/{id}', [WishlistController::class, 'wishlist_product_delete'])->name('wishlist_product.delete');
        Route::get('/clear', [WishlistController::class, 'clear_wishlist'])->name('clear.wishlist');
    });
    Route::group(['prefix' => 'add'], function () {
        Route::post('/cart/{id}', [CartController::class, 'addToCart'])->name('add.to_cart');
        Route::get('/my/cart', [CartController::class, 'my_cart'])->name('cart');
        Route::get('/cart/remove/{rowId}', [CartController::class, 'cart_product_remove'])->name('cartproduct.remove');
        Route::get('/destory', [CartController::class, 'cart_destory'])->name('cart.destory');
    });
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__ . '/auth.php';
