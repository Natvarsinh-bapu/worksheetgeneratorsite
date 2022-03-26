<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question');
            $table->unsignedBigInteger('answer_type_id');
            $table->foreign('answer_type_id')->references('id')->on('answer_types')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('question_type_id');
            $table->foreign('question_type_id')->references('id')->on('question_types')->onDelete('cascade');
            $table->unsignedBigInteger('concept_id');
            $table->foreign('concept_id')->references('id')->on('concepts')->onDelete('cascade');
            $table->unsignedBigInteger('sub_concept_id');
            $table->foreign('sub_concept_id')->references('id')->on('sub_concepts')->onDelete('cascade');
            $table->unsignedBigInteger('medium_id');
            $table->foreign('medium_id')->references('id')->on('medium')->onDelete('cascade');
            $table->unsignedBigInteger('level_id')->default(1);
            $table->foreign('level_id')->references('id')->on('level')->onDelete('cascade');
            $table->string('question_file')->nullable();
            $table->string('created_by');
            $table->unsignedInteger('created_by_id')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('questions');
    }
}
