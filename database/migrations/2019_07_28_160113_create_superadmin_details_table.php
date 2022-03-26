<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperadminDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superadmin_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('superadmin_id');
            $table->foreign('superadmin_id')->references('id')->on('superadmins')->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->string('image')->default('default.png');
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
        Schema::dropIfExists('superadmin_details');
    }
}
