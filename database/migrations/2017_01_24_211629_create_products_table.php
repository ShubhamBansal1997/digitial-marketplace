<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prod_name');
            $table->string('prod_slug');
            $table->string('prod_image');
            $table->text('prod_meta_descrption');
            $table->string('prod_meta_title');
            $table->string('prod_image_alt');
            $table->string('prod_image1')->nullable();
            $table->string('prod_image_alt1')->nullable();
            $table->string('prod_image2')->nullable();
            $table->string('prod_image_alt2')->nullable();
            $table->string('prod_image3')->nullable();
            $table->string('prod_image_alt3')->nullable();
            $table->string('prod_image4')->nullable();
            $table->string('prod_image_alt4')->nullable();
            $table->string('prod_image5')->nullable();
            $table->string('prod_image_alt5')->nullable();
            $table->string('prod_image6')->nullable();
            $table->string('prod_image_alt6')->nullable();
            $table->text('prod_tags');
            $table->text('prod_descrption');
            $table->text('prod_demourl')->nullable();
            $table->text('prod_categories');
            $table->integer('prod_price');
            $table->text('prod_customizations')->nullable();
            $table->integer('prod_customize_price');
            $table->boolean('prod_status')->default('1');
            $table->boolean('prod_delete')->default('0');
            $table->integer('prod_vendor_id');
            $table->string('prod_file')->nullable();
            $table->integer('prod_download')->default('0');
            $table->boolean('prod_featured')->default('0');
            $table->boolean('is_service')->default('0');
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
}
