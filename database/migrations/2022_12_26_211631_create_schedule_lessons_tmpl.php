<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleLessonsTmpl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_lessons_tmpl', function (Blueprint $table) {
            $table->id();
            $table->string('title', 192)->nullable();
            $table->bigInteger('schedule_id')->index();
            $table->dateTime('time_start');
            $table->tinyInteger('day_num');
            $table->tinyInteger('position')->default(1);
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
        Schema::dropIfExists('schedule_lessons_tmpl');
    }
}
