<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->string('product_num', 10);
            $table->string('name', 50);
            $table->string('name_ar', 50)->nullable()->default(null);
            $table->string('image_1', 255)->nullable()->default(null);
            $table->string('image_2', 255)->nullable()->default(null);
            $table->string('image_3', 255)->nullable()->default(null);
            $table->unsignedBigInteger('brand_id')->length(20)->default(0);
            $table->unsignedBigInteger('category_id')->length(20)->default(0);
            $table->string('description', 255)->nullable()->default(null);
            $table->string('description_ar', 255)->nullable()->default(null);
            $table->float('price')->default(0);
            $table->float('rating')->default(0);
            $table->float('reviews')->default(0);
            $table->text('policy')->nullable()->default(null);
            $table->text('policy_ar')->nullable()->default(null);
            $table->string('shipping_days', 255)->nullable()->default(null);
            $table->string('shipping_days_ar', 255)->nullable()->default(null);
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
        Schema::dropIfExists('product');
    }
}
