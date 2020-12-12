<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('phone')->default('');
            $table->string('country')->default('');
            $table->string('region')->default('');
            $table->integer('zip_code')->default(0);
            $table->string('city')->default('');
            $table->string('street')->default('');
            $table->string('number_house')->default('');
            $table->string('dop_info')->default('');
            $table->integer('orders')->default(0);

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
        Schema::dropIfExists('user_info');
    }
}
