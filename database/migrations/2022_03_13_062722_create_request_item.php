<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_item', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->unsignedBigInteger('request_id')->length(20);
            $table->unsignedBigInteger('user_id')->length(20);
            $table->unsignedBigInteger('product_id')->length(20)->default(0);
            $table->unsignedBigInteger('promotion_id')->length(20)->default(0);
            $table->integer('quantity')->default(1);
            $table->float('orignal_price')->default(0);
            $table->float('discounted_price')->default(0);
            $table->float('total_price')->default(0);
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
        Schema::drop('request_item');
    }
}
