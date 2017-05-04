<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customization_name');
            $table->integer('customization_price');
            $table->boolean('customization_active')->default(1);
            $table->boolean('customization_delete')->default(0);
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
        Schema::dropIfExists('customizations');
    }
}
