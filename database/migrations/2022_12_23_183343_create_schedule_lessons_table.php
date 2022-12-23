<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('classroom_id');
            $table->integer('subject_id');
            $table->string('note', 128);
            $table->string('homework', 255);
            $table->dateTime('lesson_start');
            $table->dateTime('lesson_end');
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
        Schema::dropIfExists('schedule_lessons');
    }
}
