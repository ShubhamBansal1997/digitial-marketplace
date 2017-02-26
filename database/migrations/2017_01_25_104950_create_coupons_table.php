<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coupon_name');
            $table->string('coupon_code');
            $table->integer('coupon_amount')->default('0');
            $table->string('coupon_type');
            $table->string('coupon_category');
            $table->integer('coupon_minimumamount')->default('0');
            //$table->integer('coupon_number');
            $table->datetime('coupon_valid_date');
            $table->boolean('coupon_active')->default('0');
            $table->boolean('coupon_delete')->default('0');
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
        Schema::dropIfExists('coupons');
    }
}
