<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payout_trid')->unique();
            $table->boolean('payout_status')->default('0');
            $table->string('payout_mode');
            $table->integer('payout_amount')->default('0');
            $table->string('payout_email');
            $table->string('payout_acc_no');
            $table->string('payout_acc_ifsc_code');
            $table->integer('payout_vendor_id');
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
        Schema::dropIfExists('payouts');
    }
}
