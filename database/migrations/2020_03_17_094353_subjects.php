<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('subject_id');
            $table->integer('level_id')->unsigned();
            $table->integer('faculty_id')->unsigned();
            $table->integer('semester_id')->nullable()->unsigned();
            $table->string('semester_choosen');
            $table->string('subject_title');
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties');
            $table->foreign('semester_id')->references('semester_id')->on('semesters');
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
        Schema::dropIfExists('subjects');
    }
}
