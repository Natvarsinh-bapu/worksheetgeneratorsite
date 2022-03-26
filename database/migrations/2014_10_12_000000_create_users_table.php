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
            $table->bigIncrements('id');
            $table->string('enrollment_no')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_reset_token')->nullable();
            $table->timestamp('password_reset_token_expiry')->nullable();
            $table->string('verification_token')->nullable();
            $table->integer('is_verified')->default(0)->comment('0 = Not verified , 1 = Verified');
            $table->integer('status')->default(0)->comment('0 = Requested , 1 = Active , 2 = Blocked');
            $table->string('role')->default('student');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('class')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
