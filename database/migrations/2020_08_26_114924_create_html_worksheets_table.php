<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHtmlWorksheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('html_worksheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('html')->nullable();
            $table->string('question')->nullable();
            $table->string('file_name')->nullable();
            $table->string('created_by');
            $table->unsignedInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('html_worksheets');
    }
}
