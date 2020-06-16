<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_time', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->bigInteger('clinic_id')->unsigned()->nullable();
            $table->boolean('is_holiday')->nullable();

            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
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
        Schema::dropIfExists('work_time');
    }
}
