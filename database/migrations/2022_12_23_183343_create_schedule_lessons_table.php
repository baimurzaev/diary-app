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
            $table->integer('subject_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->string('note', 128)->nullable();
            $table->string('homework', 255)->nullable();
            $table->dateTime('lesson_start');
            $table->dateTime('lesson_end');
            $table->foreignId('subject_id')->constrained('subjects');
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
