<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->default(3);
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('password', 255)->nullable()->default(null);
            $table->string('avatar', 255)->nullable()->default(null); 
            $table->integer('total_reward_points')->nullable()->default(null);
            $table->string('social_login', 255)->nullable()->default(null);
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->string('social_id', 25)->nullable()->default(null);
            $table->string('access_token', 50)->nullable()->default(null);
            $table->string('gcm_token', 500)->nullable()->default(null);
            $table->string('device_type', 50)->nullable()->default(null);
            $table->boolean('get_notification')->default(1);
            $table->integer('otp_code')->nullable()->default(0);
            $table->tinyInteger('is_verified')->default(0);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('map_address')->nullable();
            $table->boolean('is_organic')->nullable()->default(0);
            $table->boolean('is_featured')->nullable()->default(0);
            $table->boolean('is_organic_health')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
