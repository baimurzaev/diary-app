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
            $table->bigInteger('subject_id')->index();
            $table->bigInteger('schedule_id')->index();
            $table->string('title', 192)->nullable();
            $table->string('homework', 255)->nullable();
            $table->dateTime('lesson_start');
            $table->dateTime('lesson_end');
            $table->tinyInteger('day_num');
            $table->tinyInteger('position')->default(1);
            //$table->foreignId('subject_id')->constrained('subjects');
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
