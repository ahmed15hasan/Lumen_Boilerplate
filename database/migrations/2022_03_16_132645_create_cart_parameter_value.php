<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartParameterValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_parameter_value', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->unsignedBigInteger('cart_id')->length(20);
            $table->unsignedBigInteger('product_id')->length(20);
            $table->unsignedBigInteger('parameter_value_id')->length(20);
            $table->unsignedBigInteger('parameter_id')->length(20);
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
        Schema::drop('cart_parameter_value');
    }
}
