<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_products', function (Blueprint $table) {
            $table->id();
            $table->string('main');
            $table->string('image_a')->default('');
            $table->string('image_b')->default('');
            $table->string('image_c')->default('');
            $table->string('image_d')->default('');
            $table->string('image_e')->default('');
            $table->json('other_image_set');
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
        Schema::dropIfExists('image_products');
    }
}
