<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFavourite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_favorite', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->bigInteger('users_id');
            $table->bigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->length(20)->default(0);
            $table->unsignedBigInteger('updated_by')->length(20)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_favorite');
    }
}
