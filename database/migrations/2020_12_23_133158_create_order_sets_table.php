<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->json('products_set');
            $table->json('address_set');
            $table->string('payment');
            $table->integer('price_product');
            $table->integer('price_delivery');

            $table->foreign('status_id')
                ->references('id')
                ->on('order_statuses');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('order_sets');
    }
}
