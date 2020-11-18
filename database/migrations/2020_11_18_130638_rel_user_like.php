<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelUserLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_user_like', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('like_id');
            $table->boolean('like')->default(true);
            $table->boolean('dislike')->default(false);

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('like_id')
                ->references('id')
                ->on('likes');
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
        Schema::dropIfExists('rel_user_like');
    }
}
