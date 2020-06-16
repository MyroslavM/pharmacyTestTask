<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientForm043Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('patient_form043', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->unsignedBigInteger('patient_id')->nullable();
		    $table->string('diagnose')->nullable();
		    $table->string('complaint')->nullable();
		    $table->string('transferred_diseases')->nullable();
		    $table->string('current_disease')->nullable();
		    $table->string('research_data')->nullable();
		    $table->json('data')->nullable();
		    $table->json('epicriz')->nullable();
		    $table->timestamps();

		    $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('patient_form043');
    }
}
