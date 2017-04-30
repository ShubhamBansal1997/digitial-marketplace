<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCustomOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_custom_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->text('product_message1')->nullable();
            $table->text('product_message2')->nullable();
            $table->string('product_name');
            $table->string('product_sample_file')->nullable();
            $table->boolean('product_completed')->default('0');
            $table->boolean('product_active')->default('0');
            $table->string('product_customizations');
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
        Schema::dropIfExists('product__custom__orders');
    }
}
