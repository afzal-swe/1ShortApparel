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
        Schema::table('users', function (Blueprint $table) {
            //
            // You probably want to make the new column nullable
            // $table->integer('store_id')->unsigned()->nullable()->after('password');
            $table->integer('category')->unsigned()->default(0)->after('password');
            $table->integer('product')->unsigned()->default(0)->after('category');
            $table->integer('offer')->unsigned()->default(0)->after('product');
            $table->integer('order')->unsigned()->default(0)->after('offer');
            $table->integer('blog')->unsigned()->default(0)->after('order');
            $table->integer('pickup')->unsigned()->default(0)->after('blog');
            $table->integer('ticket')->unsigned()->default(0)->after('pickup');
            $table->integer('contact')->unsigned()->default(0)->after('ticket');
            $table->integer('report')->unsigned()->default(0)->after('contact');
            $table->integer('setting')->unsigned()->default(0)->after('report');
            $table->integer('userrole')->unsigned()->default(0)->after('setting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
