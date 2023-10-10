<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->string('name', 50);
            $table->string('name_ar', 50)->nullable()->default(null);
            $table->string('description', 255)->nullable()->default(null);
            $table->string('description_ar', 255)->nullable()->default(null);
            $table->unsignedBigInteger('parent_id')->length(20)->default(0);
            $table->string('avatar', 255)->nullable()->default(null);
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
        Schema::dropIfExists('category');
    }
}
