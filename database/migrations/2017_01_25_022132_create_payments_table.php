<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_trid')->unique();
            $table->boolean('payment_status')->default('0');
            $table->string('payment_mode');
            $table->integer('payment_amount');
            $table->string('payment_email');
            $table->integer('payment_admin_commission')->default('0');
            $table->integer('payment_vendor_commission')->default('0');
            $table->integer('payment_discount')->default('0');
            $table->integer('payment_base')->default('0');
            $table->string('payment_discount_code')->nullable();
            $table->integer('payment_prod_id');
            $table->integer('payment_vendor_id');
            $table->integer('payment_user_id');
            $table->boolean('payment_is_customized')->default('0');
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
        Schema::dropIfExists('payments');
    }
}
