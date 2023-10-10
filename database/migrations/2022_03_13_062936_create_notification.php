<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->string('title_ar', 50);
            $table->string('avatar', 225)->nullable();
            $table->string('description', 225)->nullable()->default(null);
            $table->string('description_ar', 225)->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->length(20)->default(0);
            $table->unsignedBigInteger('updated_by')->length(20)->default(0);
            $table->softDeletes();
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
        Schema::drop('notification');
    }
}
