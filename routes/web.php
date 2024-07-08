<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\indexController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContectController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\F_PageController;
use App\Http\Controllers\Frontend\OrderContdroller;


Route::group(['prefix' => '/'], function () {
    Route::controller(indexController::class)->group(function () {
        Route::get('/', 'home_page')->name('home_page');
        Route::get('/product-details/{slug}', 'product_details')->name('product.details');
        Route::post('/store/newsletter', 'storeNewsletter')->name('store.newsletter');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::controller(UserProfileController::class)->group(function () {
            Route::get('/deshboard', 'deshboard')->name('deshboard');
            Route::get('/info', 'user_info')->name('user_info');
            Route::post('/update/{id}', 'userInfo_Update')->name('userInfo.update');
            Route::get('/review', 'write_userReview')->name('write_user.review');
            Route::post('/review/store', 'store_websiteReview')->name('store_website.review');
            Route::get('/setting', 'User_Setting')->name('user.setting');
            Route::post('/setting', 'customer_PasswordChange')->name('customer.password.change');
            Route::get('/open/ticket', 'Ticket')->name('open.ticket');
            Route::get('/create/ticket', 'new_ticket')->name('new.ticket');
            Route::post('/store/ticket', 'store_ticket')->name('store.ticket');
            Route::get('/show/ticket/{id}', 'show_Ticket')->name('show.ticket');
            Route::post('/reply/ticket', 'reply_Ticket')->name('reply.ticket');
        });
    });

    Route::group(['prefix' => 'contact'], function () {
        Route::get('/page', [ContectController::class, 'contact_page'])->name('contact.page');
        Route::post('/send/message', [ContectController::class, 'contact_send'])->name('contact.send_message');
    });
    Route::group(['prefix' => 'page'], function () {
        Route::get('/{page_slug}', [F_PageController::class, 'view_Page'])->name('view.page');
    });
});




Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'review'], function () {

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
        Route::get('/cart/remove/{rowId}', [CartController::class, 'cart_product_remove'])->name('delete.cart');
        Route::get('/destory', [CartController::class, 'cart_destory'])->name('cart.destory');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
        Route::get('/remove', [CartController::class, 'couponRemove'])->name('coupon.remove');
    });
    Route::group(['prefix' => 'order'], function () {
        Route::post('/place', [OrderContdroller::class, 'OrderPlace'])->name('order.place');
        Route::get('/list', [OrderContdroller::class, 'Order_List'])->name('order.list');
        Route::get('/view/{id}', [OrderContdroller::class, 'Order_View'])->name('view.order');
    });
});

Route::group(['prefix' => 'category'], function () {
    Route::get('/product/{id}', [indexController::class, 'categorywise_product'])->name('categorywise.product');
    Route::get('/sub-category/{id}', [indexController::class, 'subcategorywise_product'])->name('subcategorywise.product');
});

Route::group(['prefix' => 'tracking'], function () {
    Route::get('/order', [indexController::class, 'Order_Tracking'])->name('order.tracking');
    Route::post('/order/check', [indexController::class, 'Check_Order'])->name('check.order');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__ . '/auth.php';
