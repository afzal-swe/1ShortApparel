<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SmtpController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\BDPaymentController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/admin-login', [HomeController::class, 'login_from'])->name('admin_login');
Route::get('/customer-logout', [HomeController::class, 'customer_logout'])->name('customer.logout');

// Route::group(['prefix' => 'author'], function () {
//     // Admin Home Route Section Start //
//     Route::controller(AdminController::class)->group(function () {
//         Route::get('/', 'Admin_dashboard')->name('dashboard');
//     });
// });

Route::middleware(['SupperAdmin'])->group(function () {
    Route::group(['prefix' => 'author'], function () {
        // Admin Home Route Section Start //
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'Admin_dashboard')->name('dashboard');
            // Route::get('/admin-dashboard', 'Admin_dashboard')->name('admin_login');
            Route::get('/logout', 'Admin_logout')->name('admin.logout');
            Route::get('/password-change', 'password_change')->name('admin.password_change');
            Route::post('/password-update', 'update_change')->name('pass.update');
        });

        // Brand Route Section Start //
        Route::group(['prefix' => 'Brands'], function () {
            Route::controller(BrandController::class)->group(function () {
                Route::get('/', 'All_Brands')->name('brand.index');
                Route::post('/add', 'Add_Brand')->name('brand.add');
                Route::get('/edit/{id}', 'edit_brand')->name('brand.edit');
                Route::post('/update/{id}', 'brand_update')->name('brand.update');
                Route::get('/delete/{id}', 'Brand_Delete')->name('brand.delete');
            });
        }); // Brand Route Section End //

        // Category Route Section Start //
        Route::group(['prefix' => 'categorys'], function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/', 'All_categorys')->name('category.index');
                Route::post('/add', 'Add_category')->name('category.add');
                Route::get('/edit/{id}', 'edit_category')->name('category.edit');
                Route::post('/update/{id}', 'category_update')->name('category.update');
                Route::get('/delete/{id}', 'category_Delete')->name('category.delete');
            });
        }); // Category Route Section End //

        // Sub Category Route Section Start //
        Route::group(['prefix' => 'sub-categorys'], function () {
            Route::controller(SubCategoryController::class)->group(function () {
                Route::get('/', 'All_subcategorys')->name('subcategory.index');
                Route::post('/add', 'Add_subcategory')->name('subcategory.add');
                Route::get('/edit/{id}', 'edit_subcategory')->name('subcategory.edit');
                Route::post('/update/{id}', 'subcategory_update')->name('subcategory.update');
                Route::get('/delete/{id}', 'subcategory_Delete')->name('subcategory.delete');
            });
        }); // Sub Category Route Section End //

        // Ware House Route Section Start
        Route::group(['prefix' => 'warehouse'], function () {
            Route::controller(WarehouseController::class)->group(function () {
                Route::get('/', 'all_warehouse')->name('warehouse.all_warehouse');
                Route::post('/store', 'warehouse_store')->name('warehouse.store');
                Route::get('/edit/{id}', 'warehouse_edit')->name('warehouse.edit');
                Route::post('/update/{id}', 'warehouse_update')->name('warehouse.update');
                Route::get('/delete/{id}', 'warehouse_delete')->name('warehouse.delete');
            });
        }); // End Product Route section //

        // Coupon Route Section Start
        Route::group(['prefix' => 'coupon'], function () {
            Route::controller(CouponController::class)->group(function () {
                Route::get('/', 'all_coupon')->name('coupon.all_coupon');
                Route::post('/store', 'coupon_add')->name('coupon.add');
                Route::get('/edit/{id}', 'coupon_edit')->name('coupon.edit');
                Route::post('/update/{id}', 'coupon_update')->name('coupon.update');
                Route::get('/delete/{id}', 'coupon_delete')->name('coupon.delete');
            });
        }); // End Coupon Route section //

        // campaign Route Section Start
        Route::group(['prefix' => 'campaign'], function () {
            Route::controller(CampaignController::class)->group(function () {
                Route::get('/', 'all_campaign')->name('campaign.all_campaign');
                Route::post('/store', 'campaign_add')->name('campaign.add');
                Route::get('/edit/{id}', 'campaign_edit')->name('campaign.edit');
                Route::post('/update/{id}', 'campaign_update')->name('campaign.update');
                Route::get('/delete/{id}', 'campaign_delete')->name('campaign.delete');
            });
        }); // End campaign Route section //

        // pickup-point Route Section Start
        Route::group(['prefix' => 'pickup-point'], function () {
            Route::controller(PickupController::class)->group(function () {
                Route::get('/', 'all_pickup_point')->name('all_pickup_point');
                Route::post('/store', 'pickup_point_add')->name('pickup_point.add');
                Route::get('/edit/{id}', 'pickup_point_edit')->name('pickup_point.edit');
                Route::post('/update/{id}', 'pickup_point_update')->name('pickup_point.update');
                Route::get('/delete/{id}', 'pickup_point_delete')->name('pickup_point.delete');
            });
        }); // End pickup-point Route section //

        // Product Route Section Start
        Route::group(['prefix' => 'product'], function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'all_product')->name('product.all_product');
                Route::get('/add', 'product_add')->name('product_add');
                Route::post('/store', 'product_store')->name('product_store');
                Route::get('/edit/{id}', 'product_edit')->name('product_edit');
                Route::post('/update/{id}', 'product_update')->name('product_update');
            });
        }); // End Product Route section //

        // Tickets Route Section Start
        Route::group(['prefix' => 'ticket'], function () {
            Route::controller(TicketController::class)->group(function () {
                Route::get('/', 'all_ticket')->name('ticket.index');
                Route::get('/show/{id}', 'admin_ticket_show')->name('admin.ticket.show');
                Route::get('/delete/{id}', 'admin_ticket_delete')->name('admin.ticket.delete');
                Route::post('/store', 'admin_store_reply')->name('admin.store.reply');
                Route::get('/close/{id}', 'close_ticket')->name('admin.close.ticket');
            });
        }); // End Tickets Route section //

        Route::group(['prefix' => 'mail'], function () {
            Route::controller(MailController::class)->group(function () {
                Route::get('/', 'mailbox')->name('mail_mailbox');
                Route::get('/send', 'send_mail')->name('send_mail');
                // Route::post('/store', 'product_store')->name('product_store');
                // Route::get('/edit/{id}', 'product_edit')->name('product_edit');
                // Route::post('/update/{id}', 'product_update')->name('product_update');
            });
        }); // End Product Route section //

        // Product Route Section Start
        Route::group(['prefix' => 'profile'], function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/', 'profile')->name('main_profile');
                // Route::get('/add', 'product_add')->name('product_add');
                // Route::post('/store', 'product_store')->name('product_store');
                // Route::get('/edit/{id}', 'product_edit')->name('product_edit');
                // Route::post('/update/{id}', 'product_update')->name('product_update');
            });
        }); // End Product Route section //

        // Prder Route Section Start
        Route::group(['prefix' => 'order'], function () {
            Route::controller(OrderController::class)->group(function () {
                Route::get('/all', 'All_Order')->name('admin_order.view');
            });
        }); // End Prder Route section //

        // Setting Route Section //
        Route::group(['prefix' => 'setting'], function () {
            Route::group(['prefix' => 'seo'], function () {
                Route::controller(SeoController::class)->group(function () {
                    Route::get('/', 'seo_create')->name('seo.create');
                    Route::post('/add', 'seo_add')->name('seo.add');
                    Route::post('/update/{id}', 'seo_edit')->name('seo.update');
                });
            }); // End SEO Route section //
            Route::group(['prefix' => 'smtp'], function () {
                Route::controller(SmtpController::class)->group(function () {
                    Route::get('/', 'smtp_create')->name('smtp.create');
                    Route::post('/store', 'smtp_store')->name('smtp.store');
                    Route::post('/update/{id}', 'smtp_edit')->name('smtp.update');
                });
            });
            Route::group(['prefix' => 'page'], function () {
                Route::controller(PageController::class)->group(function () {
                    Route::get('/', 'all_page')->name('page.all');
                    Route::get('/create', 'page_create')->name('page.create');
                    Route::post('/store', 'page_added')->name('page.store');
                    Route::get('/edit/{id}', 'page_edit')->name('page.edit');
                    Route::post('/update/{id}', 'page_update')->name('page.update');
                    Route::get('/delete/{id}', 'page_delete')->name('page.delete');
                });
            });
            Route::group(['prefix' => 'website-setting'], function () {
                Route::controller(WebsiteSettingController::class)->group(function () {
                    Route::get('/', 'website_create')->name('website.create');
                    Route::post('/store', 'website_store')->name('website.setting.store');
                    Route::post('/update/{id}', 'website_update')->name('website.setting_update');
                });
            });
            Route::group(['prefix' => 'social'], function () {
                Route::controller(SocialController::class)->group(function () {
                    Route::get('/', 'social_create')->name('social.create');
                    Route::post('/store', 'social_store')->name('social.store');
                    Route::post('/update/{id}', 'social_update')->name('social.update');
                });
            });
            Route::group(['prefix' => 'payment-gateway'], function () {
                Route::controller(BDPaymentController::class)->group(function () {
                    Route::get('/', 'Payment_All')->name('payment.all');
                    Route::post('/add', 'Payment_Gateway_Add')->name('payment_gateway.store');
                    Route::get('/delete/{id}', 'Payment_Gateway_Delete')->name('payment.gateway.delete');

                    Route::get('/edit', 'Payment_Gateway_Edit')->name('payment.gateway_edit');
                    Route::post('/aamarpay-update', 'Aamarpay_update')->name('update.aamarpay');
                    Route::post('/surjopay-update', 'Surjopay_update')->name('update.surjopay');
                    Route::post('/ssl-update', 'Ssl_update')->name('update.ssl');
                });
            });
        });
        // Setting Route Group End. //
    });
});



// Route::get('test', function () {
//     return view('auth.admin_login');
// });
