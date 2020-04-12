<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Semesters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('semester_id');
            $table->integer('level_id')->unsigned();
            $table->integer('faculty_id')->unsigned();
            $table->string('semester_title')->nullable();
            $table->string('yearorsemester')->nullable();
            $table->string('numberofsemester')->nullable();
            $table->string('numberofyear')->nullable();
            $table->foreign('level_id')->references('level_id')->on('levels');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties');
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
        Schema::dropIfExists('semesters');
    }
}

