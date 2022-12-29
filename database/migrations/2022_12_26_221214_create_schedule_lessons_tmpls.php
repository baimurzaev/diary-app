<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleLessonsTmpls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_lessons_tmpls', function (Blueprint $table) {
            $table->id();
            $table->string('title', 192)->nullable();
            $table->bigInteger('schedule_id')->index();
            $table->integer('num_minutes');
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
        Schema::dropIfExists('schedule_lessons_tmpls');
    }
}
