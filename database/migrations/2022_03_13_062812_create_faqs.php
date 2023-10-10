<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question', 500)->nullable();
            $table->string('answer', 1000)->nullable();
            $table->string('question_ar', 500)->nullable();
            $table->string('answer_ar', 1000)->nullable();
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
        Schema::dropIfExists('faqs');
    }
}
