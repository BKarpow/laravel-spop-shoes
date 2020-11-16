<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('title');
            $table->integer('reviews')->default(0);
            $table->string('alias');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('price_id');
            $table->unsignedBigInteger('image_id');


            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories');
            $table->foreign('price_id')
                ->references('id')
                ->on('prices')
                ->onDelete('cascade');
            $table->foreign('image_id')
                ->references('id')
                ->on('image_products')
                ->onDelete('cascade');

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
