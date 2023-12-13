<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->string('product_title')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_unit')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('post_date')->nullable();
            $table->string('post_month')->nullable();
            $table->string('slug')->nullable();
            $table->string('images')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('product_purchase_price')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('product_video')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();
            $table->integer('featured')->nullable()->default(0);
            $table->integer('today_deal')->nullable()->default(0);
            $table->integer('hot_new_arrivals')->nullable()->default(0);
            $table->integer('hot_best_sellers')->nullable()->default(0);
            $table->integer('flash_deal_id')->nullable()->default(0);
            $table->integer('cash_on_delivery')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('warehouse')->nullable();
            $table->integer('pickup_point')->nullable();
            $table->integer('product_views')->nullable()->default(0);
            $table->integer('trendy')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
