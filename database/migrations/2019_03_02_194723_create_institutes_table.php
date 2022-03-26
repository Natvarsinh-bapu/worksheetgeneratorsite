<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('image')->default('default.png');
            $table->string('password');            
            $table->timestamp('password_reset_token_expiry')->nullable();
            $table->string('verification_token')->nullable();
            $table->integer('is_verified')->default(0)->comment('0 = Not verified , 1 = Verified');
            $table->integer('status')->default(0)->comment('0 = Requested , 1 = Active , 2 = Blocked');
            $table->string('password_reset_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('no_of_teacher')->default(0);
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
        Schema::dropIfExists('institutes');
    }
}
