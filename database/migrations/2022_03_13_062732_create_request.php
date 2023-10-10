<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true)->length(20);
            $table->string('request_num',10)->unique();
            $table->unsignedBigInteger('user_id')->length(20);
            $table->float('shipping_amount')->default(0);
            $table->enum('request_type',['delivery','pickup'])->nullable();
            $table->float('total_amount')->default(0);
            $table->integer('customer_point_avail')->nullable();
            $table->double('lat')->nullable()->default(0);
            $table->double('long')->nullable()->default(0);
            $table->string('location',225)->nullable()->default(null);
            $table->string('name', 50)->nullable()->default(null);
            $table->string('phone', 25)->nullable()->default(null);
            $table->text('note')->nullable()->default(null);
            $table->dateTime('rejected_date_time')->nullable()->default(null);
            $table->dateTime('confirm_date_time')->nullable()->default(null);
            $table->dateTime('delivery_date_time')->nullable()->default(null);
            $table->string('transaction_id')->nullable()->default(null);
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
        Schema::dropIfExists('request');
    }
}
